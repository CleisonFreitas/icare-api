<?php

declare(strict_types=1);

namespace App\Services\Cliente;

use App\DTOs\Cliente\ClienteFilterDTO;
use App\Repositories\Contracts\ClienteContract;
use Illuminate\Pagination\LengthAwarePaginator;

class BuscarClientes
{
    public function __construct(
        private readonly ClienteContract $logic
    ) {}

    public function pesquisar(ClienteFilterDTO $dto): LengthAwarePaginator
    {
        $filtros = $dto->getFiltros();
        $ordenacoes = $dto->getOrdenacoes();
        $limite = $dto->getLimite();

        return $this->logic->search($filtros, $ordenacoes, $limite);
    }
}