<?php

declare(strict_types=1);

namespace App\DTOs\Servico;

use App\DTOs\BaseDTO;
use App\Http\Requests\Servico\EstoqueStoreRequest;
use App\Http\Requests\Servico\EstoqueUpdateRequest;

readonly class EstoqueDTO extends BaseDTO
{
    public function __construct(
        private readonly string $nome,
        private readonly ?string $descricao
    ) {}

    /**
     * Summary of fromApiRequest
     * @param EstoqueStoreRequest|EstoqueUpdateRequest $request
     * @return EstoqueDTO
     */
    public static function fromApiRequest(
        EstoqueStoreRequest|EstoqueUpdateRequest $request
    ): self {
        $dados = $request->validated();

        return new self(
            data_get($dados, 'nome'),
            data_get($dados, 'descricao'),
        );
    }
}
