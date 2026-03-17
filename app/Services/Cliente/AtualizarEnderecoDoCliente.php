<?php

declare(strict_types=1);

namespace App\Services\Cliente;

use App\DTOs\Cliente\EnderecoDTO;
use App\Models\Cliente\Cliente;
use App\Models\Cliente\Endereco;
use App\Repositories\Contracts\EnderecoContract;

class AtualizarEnderecoDoCliente
{
    public function __construct(
        private readonly EnderecoContract $enderecoLogic,
    ) {}
    public function atualizar(Cliente $cliente, array $dados): Endereco
    {
        $enderecoDTO = EnderecoDTO::fromArray($dados);
        $endereco = $this->enderecoLogic->update($enderecoDTO, $cliente);
        return $endereco;
    }
}