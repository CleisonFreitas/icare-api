<?php

declare(strict_types=1);

namespace App\Services\Pet;

use App\DTOs\Pet\PetDTO;
use App\Models\Cliente\Cliente;
use App\Models\Cliente\Pet;
use App\Repositories\Contracts\PetContract;

class CadastrarPet
{
    public function __construct(
        private readonly PetContract $logic
    ) {}

    public function cadastrar(PetDTO $dto, Cliente $cliente): Pet
    {
        return $this->logic->register($dto, $cliente);
    }
}
