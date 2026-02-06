<?php

declare(strict_types=1);

namespace App\Services\Servico;

use App\DTOs\Servico\EstoqueFilterDTO;
use App\Repositories\Contracts\EstoqueContract;
use Illuminate\Pagination\LengthAwarePaginator;

class BuscarEstoques
{
    public function __construct(
        private readonly EstoqueContract $logic,
    ) {}

    public function buscar(EstoqueFilterDTO $dto): LengthAwarePaginator
    {
        $filtros = $dto->getFiltros();
        $ordenacoes = $dto->getOrdenacoes();
        $limite = $dto->getLimite();

        return $this->logic->buscar($filtros, $ordenacoes, $limite);
    }
}