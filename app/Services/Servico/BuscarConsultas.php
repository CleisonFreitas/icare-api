<?php

declare(strict_types=1);

namespace App\Services\Servico;

use App\DTOs\Servico\ConsultaFilterDTO;
use App\Repositories\Contracts\ConsultaContract;
use Illuminate\Pagination\LengthAwarePaginator;

class BuscarConsultas
{
    public function __construct(private readonly ConsultaContract $logic) {}

    public function buscar(ConsultaFilterDTO $dto): LengthAwarePaginator
    {
        $filtros = $dto->getFiltros();
        $ordenacoes = $dto->getOrdenacoes();
        $limite = $dto->getLimite();

        return $this->logic->buscar($filtros, $ordenacoes, $limite);
    }
}
