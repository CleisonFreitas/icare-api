<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

use App\Models\Cliente\Cliente;
use App\Models\Cliente\Contato;

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

    /**
     * Método responsável pela atualização dos contatos do cliente.
     * 
     * @param array $dados
     * @param Cliente $cliente
     * @return array<Contato>
     */
    public function updateMany(array $dados, Cliente $cliente): array;

}