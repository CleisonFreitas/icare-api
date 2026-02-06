<?php

declare(strict_types=1);

namespace App\DTOs\Servico;

use App\DTOs\BaseDTO;
use App\Http\Requests\Servico\VacinaFilterRequest;

readonly class VacinaFilterDTO extends BaseDTO
{
    public function __construct(
        private readonly array $filtros,
        private readonly array $ordenacoes,
        private readonly ?int $limite = 15
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

    public static function fromApiRequest(VacinaFilterRequest $request): self
    {
        $dados = $request->validated();

        return new self(
            filtros: collect($dados)->except(['ordenacoes', 'limite', 'page'])->toArray(),
            ordenacoes: data_get($dados, 'ordenacoes', []),
            limite: (int) data_get($dados, 'limite', 15)
        );
    }
}
