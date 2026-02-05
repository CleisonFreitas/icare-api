<?php

namespace App\ModelFilters\Pet;

use App\Enums\Pet\PetTamanhoEnum;
use EloquentFilter\ModelFilter;

class PetFilter extends ModelFilter
{
    public function nome(string $nome): self
    {
        return $this->where('nome', 'regexp', $nome);
    }

    public function documento(string $documento): self
    {
        return $this->where('documento', 'regexp', $documento);
    }

    public function tamanho(string $tamanho): self
    {
        $tamanhoEnum = PetTamanhoEnum::tryFrom($tamanho);

        return $this->where('tamanho', $tamanhoEnum);
    }

    public function temMicroship(bool $value): self
    {
        return $this->where('tem_microship', $value);
    }

    public function numeroMicroship(string $numero): self
    {
        return $this->where('numero_microship', 'like', "%$numero%");
    }

    public function clienteId(int $clienteId): self
    {
        return $this->where('cliente_id', $clienteId);
    }

    public function especieId(int $especieId): self
    {
        return $this->where('especie_id', $especieId);
    }

    public $relations = [
        'cliente',
        'especie',
        'solicitacoes'
    ];
}
