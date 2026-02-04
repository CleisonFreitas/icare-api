<?php

declare(strict_types=1);

namespace App\Services\Cliente;

use App\Models\Cliente\Cliente;

class RemoverCliente
{
    /**
     * Responsável por remover clientes.
     *
     * @param Cliente $cliente
     *
     * @return Cliente
     */
    public function delete(Cliente $cliente): Cliente
    {
        $cliente->delete();

        return $cliente->refresh();
    }
}