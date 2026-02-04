<?php

namespace App\ModelFilters\Cliente;

use EloquentFilter\ModelFilter;

class ClienteFilter extends ModelFilter
{
    public function nome(string $nome): self
    {
        return $this->where('nome', 'regexp', $nome);
    }

    public function email(string $email): self
    {
        return $this->where('email', 'regexp', $email);
    }

    public function documento(string $documento): self
    {
        return $this->where('documento', 'regexp', $documento);
    }

    public function dataNascimento(array $data)
    {
        $dataInicio = data_get($data, 'inicio');
        $dataFim = data_get($data, 'fim');

        return $this->whereBetween('data_nascimento',[$dataInicio, $dataFim]);
    }

    public $relations = [];
}
