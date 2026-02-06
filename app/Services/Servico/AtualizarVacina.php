<?php
declare(strict_types=1);
namespace App\Services\Servico;

use App\DTOs\Servico\VacinaDTO;
use App\Models\Servico\Vacina;
use App\Repositories\Contracts\VacinaContract;

class AtualizarVacina
{
    public function __construct(
        private readonly VacinaContract $logic
    ) {}

    public function atualizar(VacinaDTO $dto, Vacina $vacina): Vacina
    {
        return $this->logic->atualizar($dto, $vacina);
    }
}
