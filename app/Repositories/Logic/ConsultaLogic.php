<?php

namespace App\Repositories\Logic;

use App\DTOs\Servico\ConsultaDTO;
use App\Models\Servico\Consulta;
use App\Repositories\Contracts\ConsultaContract;
use Illuminate\Pagination\LengthAwarePaginator;

class ConsultaLogic implements ConsultaContract
{
    /**
     * @inheritDoc
     */
    public function buscar(array $filtros, array $ordenacoes, int $limite): LengthAwarePaginator
    {
        return Consulta::query()
            ->filter($filtros)
            ->order($ordenacoes)
            ->with(['pet', 'servicos'])
            ->paginate($limite);
    }

    /**
     * @inheritDoc
     */
    public function cadastrar(ConsultaDTO $dto): Consulta
    {
        $consulta = Consulta::create($dto->toArray());

        return $consulta->refresh();
    }

    /**
     * @inheritDoc
     */
    public function attachServicos(Consulta $consulta, array $servicosData): array
    {
        $consultas = $consulta->servicos()->createMany($servicosData);

        return $consultas->all();
    }

    /**
     * @inheritDoc
     */
    public function atualizar(ConsultaDTO $dto, Consulta $consulta): Consulta
    {
        $consulta->fill($dto->toArray());
        $consulta->save();

        return $consulta->refresh()->load(['pet', 'servicos']);
    }
}
