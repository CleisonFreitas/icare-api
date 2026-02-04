<?php

declare(strict_types=1);

namespace App\DTOs\Cliente;

use App\Http\Requests\Cliente\ClienteStoreRequest;
use Carbon\Carbon;

class ClienteDTO
{
    public function __construct(
        private readonly string $nome,
        private readonly string $email,
        private readonly string $documento,
        private readonly ?string $dataNascimento,
        private readonly EnderecoDTO $enderecoDTO,
        private readonly array $contatos,
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

    public function getDataNascimento(): ?Carbon
    {
        return Carbon::parse($this->dataNascimento) ?: $this->dataNascimento;
    }

    public function getEnderecoDto(): EnderecoDTO
    {
        return $this->enderecoDTO;
    }

    public function getContatos(): array
    {
        return $this->contatos;
    }

    public static function fromApiRequest(ClienteStoreRequest $request): self
    {
        $dados = $request->validated();
        return new self(
            nome: data_get($dados, 'nome'),
            email: data_get($dados, 'email'),
            documento: data_get($dados, 'documento'),
            dataNascimento: data_get($dados, 'data_nascimento'),
            enderecoDTO: EnderecoDTO::fromArray(data_get($dados, 'endereco')),
            contatos: data_get($dados, 'contatos', [])
        );
    }
}