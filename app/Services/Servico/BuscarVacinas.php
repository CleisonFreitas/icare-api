<?php

declare(strict_types=1);

namespace App\Services\Servico;

use App\DTOs\Servico\VacinaFilterDTO;
use App\Repositories\Contracts\VacinaContract;
use Illuminate\Pagination\LengthAwarePaginator;

class BuscarVacinas
{
    public function __construct(
        private readonly VacinaContract $logic,
    ) {}

    public function buscar(VacinaFilterDTO $dto): LengthAwarePaginator
    {
        $filtros = $dto->getFiltros();
        $ordenacoes = $dto->getOrdenacoes();
        $limite = $dto->getLimite();

        return $this->logic->buscar($filtros, $ordenacoes, $limite);
    }
}
