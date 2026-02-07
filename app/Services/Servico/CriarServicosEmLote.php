<?php

declare(strict_types=1);

namespace App\Services\Servico;

use App\Models\Servico\Consulta;
use App\Repositories\Contracts\ConsultaContract;

final class CriarServicosEmLote
{
    public function __construct(private readonly ConsultaContract $consultaLogic) {}

    /**
     * Cria serviços em lote vinculados à consulta.
     * Retorna array de modelos criados (preservando ordem).
     *
     * @param Consulta $consulta
     * @param array $servicosData
     * @return array
     */
    public function criar(Consulta $consulta, array $servicosData): array
    {
        return $this->consultaLogic->attachServicos($consulta, $servicosData);
    }
}
