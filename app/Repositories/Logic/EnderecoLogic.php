<?php

namespace App\Repositories\Logic;

use App\DTOs\Cliente\EnderecoDTO;
use App\Models\Cliente\Cliente;
use App\Models\Cliente\Endereco;
use App\Repositories\Contracts\EnderecoContract;

class EnderecoLogic implements EnderecoContract
{
    /**
     * @inheritDoc
     */
    public function create(EnderecoDTO $dto, Cliente $cliente): Endereco
    {
        $endereco = new Endereco();
        $endereco->cep = $dto->getCep();
        $endereco->logradouro = $dto->getLogradouro();
        $endereco->numero = $dto->getNumero();
        $endereco->bairro = $dto->getBairro();
        $endereco->cidade = $dto->getCidade();
        $endereco->pais = $dto->getPais();
        $endereco->complemento = $dto->getComplemento();
        $endereco->cliente_id = $cliente->id;
        $endereco->save();

        return $endereco;
    }
}
