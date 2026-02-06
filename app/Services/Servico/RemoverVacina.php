<?php

declare(strict_types=1);

namespace App\Services\Servico;

use App\Models\Servico\Vacina;
use App\Repositories\Contracts\VacinaContract;

class RemoverVacina
{
    public function remover(Vacina $vacina): Vacina
    {
        $vacina->delete();

        return $vacina;
    }
}
