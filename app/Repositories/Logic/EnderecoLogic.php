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
        $endereco = $this->montarEndereco($endereco, $dto, $cliente);
        $endereco->cliente_id = $cliente->id;
        $endereco->save();

        return $endereco;
    }

    public function update(EnderecoDTO $dto, Cliente $cliente): Endereco
    {
        $endereco = $this->montarEndereco($cliente->endereco, $dto, $cliente);
        $endereco->save();

        return $endereco;
    }

    private function montarEndereco(Endereco $endereco, EnderecoDTO $dto, Cliente $cliente): Endereco
    {
        $endereco->cep = $dto->getCep();
        $endereco->logradouro = $dto->getLogradouro();
        $endereco->numero = $dto->getNumero();
        $endereco->bairro = $dto->getBairro();
        $endereco->cidade = $dto->getCidade();
        $endereco->uf = $dto->getUf();
        $endereco->complemento = $dto->getComplemento();

        return $endereco;
    }
}
