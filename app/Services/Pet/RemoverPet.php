<?php

declare(strict_types=1);

namespace App\Services\Pet;

use App\Models\Cliente\Pet;

class RemoverPet
{
    public function remover(Pet $pet): Pet
    {
        $pet->delete();

        return $pet->refresh();
    }
}