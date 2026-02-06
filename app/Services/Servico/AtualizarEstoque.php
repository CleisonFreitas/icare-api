<?php
declare(strict_types=1);
namespace App\Services\Servico;

use App\DTOs\Servico\EstoqueDTO;
use App\Models\Servico\Estoque;
use App\Repositories\Contracts\EstoqueContract;

class AtualizarEstoque
{
    public function __construct(
        private readonly EstoqueContract $logic
    ) {}

    public function atualizar(EstoqueDTO $dto, Estoque $estoque): Estoque
    {
        return $this->logic->atualizar($dto, $estoque);
    }
}