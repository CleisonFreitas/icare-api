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

    /**
     * @inheritDoc
     */
    public function updateMany(array $dados, Cliente $cliente): array
    {
        $cliente->contatos()->upsert(
            $dados,
            ['id'],
            ['nome', 'tipo', 'valor']
        );

        $cliente->load('contatos');

        return $cliente->contatos->toArray();
    }
}