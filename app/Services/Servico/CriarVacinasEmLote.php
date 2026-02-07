<?php

declare(strict_types=1);

namespace App\Services\Servico;

use App\Repositories\Contracts\VacinaContract;

class CriarVacinasEmLote
{
    public function __construct(
        private readonly VacinaContract $vacinaLogic
    ) {}

    /**
     * Cria vacinas em lote delegando para o repositório.
     *
     * @param array $dados
     * @return void
     */
    public function criar(array $dados): void
    {
        $this->vacinaLogic->criarEmLote($dados);
    }
}
