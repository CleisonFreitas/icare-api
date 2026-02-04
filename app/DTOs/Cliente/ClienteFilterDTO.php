<?php

declare(strict_types=1);

namespace App\DTOs\Cliente;

use App\Http\Requests\Cliente\ClienteSearchRequest;

class ClienteFilterDTO
{
    public function __construct(
        private readonly array $filtros,
        private readonly array $ordenacoes,
        private readonly int $limite
    ) {}

    public static function fromApirequest(ClienteSearchRequest $request): self
    {
        $dados = $request->validated();
        return new self(
            filtros: collect($dados)->except(['ordenacoes', 'limite'])->toArray(),
            ordenacoes: data_get($dados, 'ordenacoes', []),
            limite: data_get($dados, 'per_page', 15)
        );
    }

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
}