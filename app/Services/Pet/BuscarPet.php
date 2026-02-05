<?php

declare(strict_types=1);

namespace App\Services\Pet;

use App\DTOs\Pet\PetFilterDTO;
use App\Repositories\Contracts\PetContract;
use Illuminate\Pagination\LengthAwarePaginator;

class BuscarPet
{
    public function __construct(
        private readonly PetContract $logic
    ) {}

    public function buscar(PetFilterDTO $dto): LengthAwarePaginator
    {
        $filtros = $dto->getFiltros();
        $ordenacoes = $dto->getOrdenacoes();
        $limite = $dto->getLimite();

        return $this->logic->paginate($filtros, $ordenacoes, $limite);
    }
}