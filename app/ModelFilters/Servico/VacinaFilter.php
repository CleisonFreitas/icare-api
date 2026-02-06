<?php

namespace App\ModelFilters\Servico;

use EloquentFilter\ModelFilter;

class VacinaFilter extends ModelFilter
{
    public function nome(string $nome): self
    {
        return $this->where('nome', 'regexp', $nome);
    }

    public function autorAplicacao(string $nome): self
    {
        return $this->whereHas(
            'autor',
            fn($query)
                => $query->where('nome', 'regexp', $nome)
        );
    }

    public function dataAdministrada(array $datas): self
    {
        $inicio = data_get($datas, 'inicio');
        $fim = data_get($datas, 'fim');

        return $this->whereBetween('data_administrada', [
            $inicio,
            $fim
        ]);
    }

    public $relations = [
        'estoque',
        'servico',
        'autor',
        'estoques'
    ];
}
