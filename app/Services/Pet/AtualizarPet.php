<?php

declare(strict_types=1);

namespace App\Services\Pet;

use App\DTOs\Pet\PetUpdateDTO;
use App\Models\Cliente\Pet;
use App\Repositories\Contracts\PetContract;

class AtualizarPet
{
    public function __construct(
        private readonly PetContract $logic
    ) {}

    public function atualizar(PetUpdateDTO $dto, Pet $pet): Pet
    {
        $petAtualizado = $this->logic->atualizar($dto, $pet);

        return $petAtualizado;
    }
}