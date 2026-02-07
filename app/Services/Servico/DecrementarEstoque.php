<?php

declare(strict_types=1);

namespace App\Services\Servico;

use App\Repositories\Contracts\EstoqueContract;
use App\Exceptions\InsufficientStockException;

final class DecrementarEstoque
{
    public function __construct(
        private readonly EstoqueContract $estoqueLogic
    ) {}

    /**
     * Decrementa a quantidade do lote informado. Lança RuntimeException se não houver estoque suficiente
     * ou se não encontrar o registro.
     *
     * @param int|null $estoqueId
     * @param string|null $lote
     * @param int $quantidade
     *
     * @return void
     *
     * @throws InsufficientStockException
     */
    public function decrementar(?int $estoqueId, ?string $lote, int $quantidade = 1): void
    {
        $pivot = $this->estoqueLogic->findEstoqueHasVacina($estoqueId, $lote);

        if (!$pivot) {
            throw new InsufficientStockException('Registro de lote não encontrado no estoque.');
        }

        if ($pivot->quantidade < $quantidade) {
            throw new InsufficientStockException('Estoque insuficiente para o lote informado.');
        }

        $novaQuantidade = max(0, $pivot->quantidade - $quantidade);
        $resultadoOk = $this->estoqueLogic->updateQuantidadeEstoqueHasVacina($pivot->id, $novaQuantidade);

        if (!$resultadoOk) {
            throw new InsufficientStockException('Falha ao atualizar quantidade do estoque.');
        }
    }
}
