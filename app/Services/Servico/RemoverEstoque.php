<?php

declare(strict_types=1);

namespace App\Services\Servico;

use App\Models\Servico\Estoque;

class RemoverEstoque
{
    public function remover(Estoque $estoque): Estoque
    {
        $estoque->delete();

        return $estoque->refresh();
    }
}
