<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

use App\DTOs\Cliente\ClienteDTO;
use App\DTOs\Cliente\ClienteUpdateDTO;
use App\Models\Cliente\Cliente;
use Illuminate\Pagination\LengthAwarePaginator;

interface ClienteContract
{
    /**
     * Responsável por buscar clientes
     *
     * @param array $filtros
     * @param array $ordenacoes
     * @param int $limite
     * @return LengthAwarePaginator
     */
    public function search(
        array $filtros,
        array $ordenacoes,
        int $limite
    ): LengthAwarePaginator;

    /**
     * Responsável pela criação de clientes utilizando DTO
     * para abstração de dados.
     *
     * @param ClienteDTO $dto
     * @return Cliente
     */
    public function create(ClienteDTO $dto): Cliente;

    /**
     * Responsável pela atualização dos dados do cliente.
     * 
     * @param ClienteUpdateDTO $dto
     * @param Cliente $cliente
     *
     * @return Cliente
     */
    public function update(ClienteUpdateDTO $dto, Cliente $cliente): Cliente;
}