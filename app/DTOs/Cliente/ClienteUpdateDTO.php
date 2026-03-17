<?php

declare(strict_types=1);

namespace App\DTOs\Cliente;

use App\Http\Requests\Cliente\ClienteUpdateRequest;

readonly class ClienteUpdateDTO
{
    public function __construct(
        private readonly string $nome,
        private readonly string $email,
        private readonly string $documento,
        private readonly string $dataNascimento,
    ) {}

    public function getNome(): string
    {
        return $this->nome;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getDocumento(): string
    {
        return $this->documento;
    }

    public function getDataNascimento(): string
    {
        return $this->dataNascimento;
    }

    public static function fromApiRequest(ClienteUpdateRequest $request): self
    {
        $dados = $request->validated();
        return new self(
            data_get($dados, 'nome'),
            data_get($dados, 'email'),
            data_get($dados, 'documento'),
            data_get($dados, 'data_nascimento')
        );
    }
}
