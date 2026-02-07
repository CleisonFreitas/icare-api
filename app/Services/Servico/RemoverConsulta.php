<?php

declare(strict_types=1);

namespace App\Services\Servico;

use App\Models\Servico\Consulta;

class RemoverConsulta
{
    public function remover(Consulta $consulta): Consulta
    {
        $consulta->delete();

        return $consulta;
    }
}
