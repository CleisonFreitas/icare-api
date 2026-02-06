<?php

declare(strict_types=1);

namespace App\Services\Servico;

use App\DTOs\Servico\VacinaDTO;
use App\Models\Servico\Vacina;
use App\Repositories\Contracts\VacinaContract;

class CadastrarVacina
{
    public function __construct(
        private readonly VacinaContract $logic
    ) {}

    public function cadastrar(VacinaDTO $dto): Vacina
    {
        return $this->logic->cadastrar($dto);
    }
}
