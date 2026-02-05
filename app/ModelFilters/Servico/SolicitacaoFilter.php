<?php

namespace App\ModelFilters\Servico;

use App\Enums\Servico\StatusSolicitacaoEnum;
use EloquentFilter\ModelFilter;

class SolicitacaoFilter extends ModelFilter
{
    public function titulo(string $titulo): self
    {
        return $this->where('nome', 'regexp', $titulo);
    }

    public function status(string $status): self
    {
        $statusEnum = StatusSolicitacaoEnum::tryFrom($status);

        return $this->where('status', $statusEnum);
    }

    public function createdAt(array $data): self
    {
        $inicio = data_get($data, 'inicio');
        $fim = data_get($data, 'fim');

        return $this->whereBetween('created_at', [$inicio, $fim]);
    }

    public $relations = [
        'pet'
    ];
}
