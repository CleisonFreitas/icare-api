<?php

namespace App\Repositories\Logic;

use App\DTOs\Servico\EstoqueDTO;
use App\Models\Servico\Estoque;
use App\Models\Servico\EstoqueHasVacina;
use App\Repositories\Contracts\EstoqueContract;
use Illuminate\Pagination\LengthAwarePaginator;

class EstoqueLogic implements EstoqueContract
{
    public function buscar(
        array $filtros,
        array $ordenacoes,
        int $limite
    ): LengthAwarePaginator {
        return Estoque::query()
            ->filter($filtros)
            ->order($ordenacoes)
            ->with('vacinas')
            ->paginate($limite);
    }

    public function cadastrar(EstoqueDTO $dto): Estoque
    {
        return Estoque::create($dto->toArray());
    }

    public function atualizar(EstoqueDTO $dto, Estoque $estoque): Estoque
    {
        $estoque->fill($dto->toArray());
        $estoque->save();

        $estoque->refresh()->load('vacinas');

        return $estoque;
    }

    /**
     * @inheritDoc
     */
    public function findEstoqueHasVacina(?int $estoqueId, ?string $lote): ?EstoqueHasVacina
    {
        return EstoqueHasVacina::query()
            ->when($estoqueId !== null, fn($q) => $q->where('estoque_id', $estoqueId))
            ->when($lote !== null, fn($q) => $q->where('lote', $lote))
            ->orderByDesc('id')
            ->first();
    }


    /**
     * @inheritDoc
     */
    public function updateQuantidadeEstoqueHasVacina(int $id, int $quantidade): bool
    {
        $pivot = EstoqueHasVacina::find($id);
        if (!$pivot) {
            return false;
        }

        $pivot->quantidade = $quantidade;
        $pivot->save();

        return true;
    }

    /**
     * @inheritDoc
     */
    public function decrementarQuantidadeVacina(?int $estoqueId, ?string $lote, int $quantidade = 1): bool
    {
        $pivot = $this->findEstoqueHasVacina($estoqueId, $lote);
        if ($pivot && $pivot->quantidade > 0) {
            $pivot->quantidade = max(0, $pivot->quantidade - $quantidade);
            $pivot->save();

            return true;
        }

        return false;
    }
}
