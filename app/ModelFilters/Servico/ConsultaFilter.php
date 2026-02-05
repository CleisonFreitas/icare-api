<?php

namespace App\ModelFilters\Servico;

use App\Enums\Servico\StatusConsultaEnum;
use EloquentFilter\ModelFilter;

class ConsultaFilter extends ModelFilter
{
    public function titulo(string $titulo): self
    {
        return $this->where('titulo', 'regexp', $titulo);
    }

    public function dataPrevista(array $data): self
    {
        $inicio = data_get($data, 'inicio');
        $fim = data_get($data, 'fim');

        return $this->whereBetween('data_prevista', [$inicio, $fim]);
    }

    public function dataRealizada(array $data): self
    {
        $inicio = data_get($data, 'inicio');
        $fim = data_get($data, 'fim');

        return $this->whereBetween('data_realizada', [$inicio, $fim]);
    }

    public function status(string $status): self
    {
        $statusEnum = StatusConsultaEnum::tryFrom($status);

        return $this->where('status', $statusEnum);
    }

    public function petId(int $petId): self
    {
        return $this->where('pet_id', $petId);
    }
    public $relations = [
        'pet',
        'servicos',
        'solicitacao'
    ];
}
