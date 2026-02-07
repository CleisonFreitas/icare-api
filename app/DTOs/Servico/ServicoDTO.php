<?php

declare(strict_types=1);

namespace App\DTOs\Servico;

use App\DTOs\BaseDTO;
use App\Http\Requests\Servico\ServicoStoreRequest;
use App\Http\Requests\Servico\ServicoUpdateRequest;
use Carbon\Carbon;

readonly class ServicoDTO extends BaseDTO
{
    public function __construct(
        private readonly string $nome,
        private readonly ?string $detalhes,
        private readonly ?string $status,
        private readonly ?Carbon $data_conclusao,
        private readonly ?int $pet_id,
        private readonly ?int $consulta_id,
        private readonly ?float $valor
    ) {}

    public static function fromApiRequest(ServicoStoreRequest|ServicoUpdateRequest $request): self
    {
        $dados = $request->validated();

        return new self(
            data_get($dados, 'nome'),
            data_get($dados, 'detalhes'),
            data_get($dados, 'status'),
            isset($dados['data_conclusao']) ? Carbon::parse($dados['data_conclusao']) : null,
            data_get($dados, 'pet_id'),
            data_get($dados, 'consulta_id'),
            isset($dados['valor']) ? (float) $dados['valor'] : null,
        );
    }
}
