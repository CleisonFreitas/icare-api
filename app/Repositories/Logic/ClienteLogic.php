<?php

namespace App\Repositories\Logic;

use App\DTOs\Cliente\ClienteDTO;
use App\DTOs\Cliente\ClienteUpdateDTO;
use App\Models\Cliente\Cliente;
use App\Repositories\Contracts\ClienteContract;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;

class ClienteLogic implements ClienteContract
{
    /**
     * @inheritDoc
     */
    public function search(
        array $filtros,
        array $ordenacoes,
        int $limite
    ): LengthAwarePaginator
    {
        return Cliente::query()
            ->filter($filtros)
            ->order($ordenacoes)
            ->paginate($limite, ['*']);
    }

    /**
     * @inheritDoc
     */
    public function create(ClienteDTO $dto): Cliente
    {
        $cliente = new Cliente();
        $cliente->nome = $dto->getNome();
        $cliente->email = $dto->getEmail();
        $cliente->documento = $dto->getDocumento();
        $cliente->data_nascimento = $dto->getDataNascimento();
        $cliente->senha = Str::password();

        $cliente->save();

        return $cliente->refresh();
    }

    /**
     * @inheritDoc
     */
    public function update(ClienteUpdateDTO $dto, Cliente $cliente): Cliente
    {
        $cliente->nome = $dto->getNome();
        $cliente->email = $dto->getEmail();
        $cliente->documento = $dto->getDocumento();
        $cliente->save();

        return $cliente->refresh();
    }
}
