<?php

declare(strict_types=1);

namespace App\Services\Cliente;

use App\Models\Cliente\Cliente;
use App\Models\Cliente\Contato;
use App\Repositories\Contracts\ContatoContract;

class AtualizarContatosDoCliente
{
    public function __construct(
        private readonly ContatoContract $logic
    ) {}

    /**
     * @return Contato[]
     */
    public function atualizarContatos(Cliente $cliente, array $dados): array
    {
        return $this->logic->updateMany($dados, $cliente);
    }
}