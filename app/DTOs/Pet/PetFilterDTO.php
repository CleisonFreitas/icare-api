<?php

declare(strict_types=1);

namespace App\DTOs\Pet;

use App\Http\Requests\Pet\PetFilterRequest;

class PetFilterDTO
{
    public function __construct(
        private readonly array $filtros,
        private readonly array $ordenacoes,
        private readonly int $limite
    ) {}

    public function getFiltros(): array
    {
        return $this->filtros;
    }

    public function getOrdenacoes(): array
    {
        return $this->ordenacoes;
    }

    public function getLimite(): int
    {
        return $this->limite;
    }

    public static function fromApiRequest(PetFilterRequest $request): self
    {
        $dados = $request->validated();
        return new self(
            filtros: collect($dados)
                ->except(['ordenacoes', 'limite', 'page'])
                ->toArray(),
            ordenacoes: data_get($dados, 'ordenacoes', []),
            limite: (int) data_get($dados, 'per_page', 15),
        );
    }
}
