<?php 

namespace App\ModelFilters\Servico;

use App\Enums\Servico\StatusServicoEnum;
use EloquentFilter\ModelFilter;

class ServicoFilter extends ModelFilter
{
    public function nome(string $nome): self
    {
        return $this->where('nome', 'regexp', $nome);
    }

    public function status(string $status): self
    {
        $statusEnum = StatusServicoEnum::tryFrom($status);

        return $this->where('status', $statusEnum);
    }
    public $relations = [
        'pet',
        'consulta'
    ];
}
