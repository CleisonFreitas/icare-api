<?php

namespace App\Repositories\Logic;

use App\DTOs\Servico\VacinaDTO;
use App\Models\Servico\Vacina;
use App\Repositories\Contracts\VacinaContract;
use Illuminate\Pagination\LengthAwarePaginator;

class VacinaLogic implements VacinaContract
{
    /**
     * @inheritDoc
     */
    public function buscar(
        array $filtros,
        array $ordenacoes,
        int $limite
    ): LengthAwarePaginator {
        return Vacina::query()
            ->filter($filtros)
            ->order($ordenacoes)
            ->with('estoques')
            ->paginate($limite);
    }

    /**
     * @inheritDoc
     */
    public function cadastrar(VacinaDTO $dto): Vacina
    {
        return Vacina::create($dto->toArray());
    }

    /**
     * @inheritDoc
     */
    public function atualizar(VacinaDTO $dto, Vacina $vacina): Vacina
    {
        $vacina->fill($dto->toArray());
        $vacina->save();

        return $vacina->refresh()->load('estoques');
    }
}
