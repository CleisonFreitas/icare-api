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

    public static function fromApiRequest(ClienteSearchRequest $request): self
    {
        $dados = $request->validated();
        $ordenacao = [];
        if (array_key_exists('ordenar_por', $dados)) {
            $ordenacao = [
                'key' => $dados['ordenar_por'],
                'direction' => $dados['direcao']
            ];
        }
        return new self(
            filtros: collect($dados)->except(['ordenacoes', 'limite'])->toArray(),
            ordenacoes: $ordenacao,
            limite: (int) data_get($dados, 'limite', 15)
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