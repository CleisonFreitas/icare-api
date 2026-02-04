<?php
namespace App\Repositories\Logic;

use App\Models\Cliente\Cliente;
use App\Repositories\Contracts\ContatoContract;

class ContatoLogic implements ContatoContract
{
    /**
     * @inheritDoc
     */
    public function createMany(array $dados, Cliente $cliente): void
    {
        $cliente->contatos()->createMany($dados);
    }
}