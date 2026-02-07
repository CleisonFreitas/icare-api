<?php

declare(strict_types=1);

namespace App\DTOs\Servico;

use App\DTOs\BaseDTO;
use App\Http\Requests\Servico\ConsultaStoreRequest;
use App\Http\Requests\Servico\ConsultaUpdateRequest;

readonly class ConsultaDTO extends BaseDTO
{
    public function __construct(
        private readonly string $titulo,
        private readonly ?string $descricao,
        private readonly ?string $data_prevista,
        private readonly ?string $data_realizada,
        private readonly ?string $status,
        private readonly ?int $pet_id,
        private readonly ?int $solicitacao_id,
        private readonly array $servicos = []
    ) {}

    public static function fromApiRequest(ConsultaStoreRequest|ConsultaUpdateRequest $request): self
    {
        $dados = $request->validated();
        return new self(
            data_get($dados, 'titulo'),
            data_get($dados, 'descricao'),
            data_get($dados, 'data_prevista'),
            data_get($dados, 'data_realizada'),
            data_get($dados, 'status'),
            data_get($dados, 'pet_id'),
            data_get($dados, 'solicitacao_id'),
            data_get($dados, 'servicos', []),
        );
    }

    public function toArray(): array
    {
        return [
            'titulo' => $this->titulo,
            'descricao' => $this->descricao,
            'data_prevista' => $this->data_prevista,
            'data_realizada' => $this->data_realizada,
            'status' => $this->status,
            'pet_id' => $this->pet_id,
            'solicitacao_id' => $this->solicitacao_id,
        ];
    }

    public function getServicos(): array
    {
        return $this->servicos;
    }
}
