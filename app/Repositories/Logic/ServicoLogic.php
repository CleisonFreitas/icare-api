<?php

namespace App\Repositories\Logic;

use App\DTOs\Servico\ServicoDTO;
use App\Models\Servico\Servico;
use App\Repositories\Contracts\ServicoContract;
use Illuminate\Pagination\LengthAwarePaginator;

class ServicoLogic implements ServicoContract
{
    public function buscar(array $filtros, array $ordenacoes, int $limite): LengthAwarePaginator
    {
        return Servico::query()
            ->filter($filtros)
            ->order($ordenacoes)
            ->with(['pet', 'consulta'])
            ->paginate($limite);
    }

    public function cadastrar(ServicoDTO $dto): Servico
    {
        return Servico::create($dto->toArray());
    }

    public function atualizar(ServicoDTO $dto, Servico $servico): Servico
    {
        $servico->fill($dto->toArray());
        $servico->save();

        return $servico->refresh()->load(['pet', 'consulta']);
    }
}
