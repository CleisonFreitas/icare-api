<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

use App\Models\Cliente\Cliente;

interface ContatoContract
{
    /**
     * Método responsável pela criação de diversos contatos.
     *
     * @param array $dados
     * @param Cliente $cliente
     * @return void
     */
    public function createMany(array $dados, Cliente $cliente): void;

}