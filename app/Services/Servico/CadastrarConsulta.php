<?php

declare(strict_types=1);

namespace App\Services\Servico;

use App\DTOs\Servico\ConsultaDTO;
use App\Models\Servico\Consulta;
use App\Repositories\Contracts\ConsultaContract;
use App\Services\Servico\CriarServicosEmLote;
use App\Services\Servico\CriarVacinasEmLote;
use App\Services\Servico\DecrementarEstoque;
use Illuminate\Support\Facades\DB;

final class CadastrarConsulta
{
    public function __construct(
        private readonly ConsultaContract $consultaLogic,
        private readonly CriarServicosEmLote $criarServicos,
        private readonly CriarVacinasEmLote $criarVacinas,
        private readonly DecrementarEstoque $decrementarEstoque
    ) {}

    /**
     * Orquestra a criação de consulta + serviços + vacinas e decremento de estoque de forma atômica.
     */
    public function cadastrar(ConsultaDTO $dto): Consulta
    {
        return DB::transaction(function () use ($dto) {
            $consulta = $this->consultaLogic->cadastrar($dto);

            $servicos = $dto->getServicos();
            if (empty($servicos)) {
                return $consulta->refresh()->load(['pet', 'servicos']);
            }

            $servicosCriados = $this->mappearECadastrarServicos($servicos, $consulta);

            list($vacinas, $estoqueAjustes) = $this->mappearVacinasEEstoques($servicos, $servicosCriados, $consulta);

            if (!empty($vacinas)) {
                $this->criarVacinas->criar($vacinas);
            }

            foreach ($estoqueAjustes as $ajuste) {
                $this->decrementarEstoque->decrementar(
                    $ajuste['estoque_id'],
                    $ajuste['lote'],
                    $ajuste['quantidade']
                );
            }

            return $consulta->refresh()->load(['pet', 'servicos']);
        });
    }

    /**
     * mapear serviços (sem campos de vacina)
     * criar serviços em lote via service (que usa a camada de repository internamente)
     */
    private function mappearECadastrarServicos(array $servicos, Consulta $consulta): array
    {
        $map = array_map(function ($servico) use ($consulta) {
            return [
                'nome' => data_get($servico, 'nome'),
                'detalhes' => data_get($servico, 'detalhes'),
                'valor' => data_get($servico, 'valor'),
                'pet_id' => $consulta->pet_id,
                'consulta_id' => $consulta->id,
            ];
        }, $servicos);

        return $this->criarServicos->criar($consulta, $map);
    }

    private function mappearVacinasEEstoques(
        array $servicos,
        array $servicosCriados,
        Consulta $consulta,
    ): array {
        $vacinas = [];
        $estoques = [];

        foreach ($servicos as $key => $servico) {
            $vacinaInfo = data_get($servico, 'vacina');
            if (empty($vacinaInfo)) {
                continue;
            }

            $modelo = $servicosCriados[$key] ?? null;
            if (!$modelo) {
                continue;
            }

            $vacinas[] = [
                'pet_id' => $consulta->pet_id,
                'nome' => data_get($vacinaInfo, 'nome', $modelo->nome),
                'data_administrada' => data_get($vacinaInfo, 'data_administrada', now()),
                'aplicado_por' => data_get($vacinaInfo, 'aplicado_por'),
                'fabricante' => data_get($vacinaInfo, 'fabricante'),
                'dosagem' => data_get($vacinaInfo, 'dosagem'),
                'servico_id' => $modelo->id,
                'created_at' => now(),
                'updated_at' => now(),
            ];

            $estoques[] = [
                'estoque_id' => data_get($vacinaInfo, 'estoque_id'),
                'lote' => data_get($vacinaInfo, 'lote'),
                'quantidade' => 1,
            ];
        }

        return [$vacinas, $estoques];
    }
}
