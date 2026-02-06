<?php 

namespace App\ModelFilters\Servico;

use EloquentFilter\ModelFilter;

class EstoqueFilter extends ModelFilter
{
    public function nome(string $nome): self
    {
        return $this->where('nome', 'regexp', $nome);
    }

    public $relations = [
        'vacinas'
    ];
}
