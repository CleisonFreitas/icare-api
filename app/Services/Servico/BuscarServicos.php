<?php

declare(strict_types=1);

namespace App\Services\Servico;

use App\DTOs\Servico\ServicoFilterDTO;
use App\Repositories\Contracts\ServicoContract;
use Illuminate\Pagination\LengthAwarePaginator;

class BuscarServicos
{
    public function __construct(
        private readonly ServicoContract $logic,
    ) {}

    public function buscar(ServicoFilterDTO $dto): LengthAwarePaginator
    {
        $filtros = $dto->getFiltros();
        $ordenacoes = $dto->getOrdenacoes();
        $limite = $dto->getLimite();

        return $this->logic->buscar($filtros, $ordenacoes, $limite);
    }
}
