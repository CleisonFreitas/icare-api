<?php

namespace App\Repositories\Logic;

use App\DTOs\Servico\EstoqueDTO;
use App\Models\Servico\Estoque;
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
}
