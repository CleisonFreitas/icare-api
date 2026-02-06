<?php

declare(strict_types=1);

namespace App\Services\Servico;

use App\DTOs\Servico\EstoqueDTO;
use App\Models\Servico\Estoque;
use App\Repositories\Contracts\EstoqueContract;

class CadastrarEstoque
{
    public function __construct(
        private readonly EstoqueContract $logic
    ) {}

    public function cadastrar(EstoqueDTO $dto): Estoque
    {
        return $this->logic->cadastrar($dto);
    }
}