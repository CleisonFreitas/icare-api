<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

use App\DTOs\Cliente\EnderecoDTO;
use App\Models\Cliente\Cliente;
use App\Models\Cliente\Endereco;

interface EnderecoContract
{
    /**
     * Responsável por cadastrar endereço do cliente.
     *
     * @param EnderecoDTO $dto
     * @param Cliente $cliente
     *
     * @return Endereco
     */
    public function create(EnderecoDTO $dto, Cliente $cliente): Endereco;

    /**
     * Responsável pela atualização de endereço.
     *
     * @param EnderecoDTO $dto
     * @param Cliente $cliente
     * 
     * @return Endereco
     */
    public function update(EnderecoDTO $dto, Cliente $cliente): Endereco;
}