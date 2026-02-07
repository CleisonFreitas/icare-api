<?php

declare(strict_types=1);

namespace App\Services\Servico;

use App\Models\Servico\Servico;

class RemoverServico
{
    public function remover(Servico $servico): Servico
    {
        $servico->delete();

        return $servico;
    }
}
