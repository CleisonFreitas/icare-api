<?php

declare(strict_types=1);

namespace App\DTOs\Cliente;

class EnderecoDTO
{
    public function __construct(
        private readonly string $cep,
        private readonly string $logradouro,
        private readonly int $numero,
        private readonly string $bairro,
        private readonly string $cidade,
        private readonly ?string $complemento,
        private readonly string $pais,
    ) {}

    public static function fromArray(array $dados): self
    {
        return new self(
            cep: data_get($dados, 'cep'),
            logradouro: data_get($dados, 'logradouro'),
            numero: data_get($dados, 'numero'),
            bairro: data_get($dados, 'bairro'),
            cidade: data_get($dados, 'cidade'),
            complemento: data_get($dados, 'complemento'),
            pais: data_get($dados, 'pais'),
        );
    }

    public function getCep(): string
    {
        return $this->cep;
    }

    public function getLogradouro(): string
    {
        return $this->logradouro;
    }

    public function getNumero(): int
    {
        return $this->numero;
    }

    public function getBairro(): string
    {
        return $this->bairro;
    }

    public function getCidade(): string
    {
        return $this->cidade;
    }

    public function getComplemento(): ?string
    {
        return $this->complemento;
    }

    public function getPais(): string
    {
        return $this->pais;
    }
}