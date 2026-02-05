<?php

declare(strict_types=1);

namespace App\DTOs\Pet;

use App\Enums\Pet\PetTamanhoEnum;
use App\Http\Requests\Pet\PetStoreRequest;

class PetDTO
{
    public function __construct(
        private readonly string $nome,
        private readonly string $documento,
        private readonly string $tamanho,
        private readonly string $cor,
        private readonly bool $temMicroship,
        private readonly ?string $numeroMicroship = null,
        private readonly int $especieId
    ) {}

    public static function fromApiRequest(PetStoreRequest $request): self
    {
        $dados = $request->validated();

        return new self(
            nome: data_get($dados, 'nome'),
            documento: data_get($dados, 'documento'),
            tamanho: data_get($dados, 'tamanho'),
            cor: data_get($dados, 'cor'),
            temMicroship: data_get($dados, 'tem_microship', false),
            numeroMicroship: data_get($dados, 'numero_microship'),
            especieId: data_get($dados, 'especie_id'),
        );
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function getDocumento(): string
    {
        return $this->documento;
    }

    public function getTamanho(): PetTamanhoEnum
    {
        return PetTamanhoEnum::tryFrom($this->tamanho);
    }

    public function getCor(): string
    {
        return $this->cor;
    }

    public function getTemMicroship(): bool
    {
        return $this->temMicroship;
    }

    public function getNumeroMicroship(): ?string
    {
        return $this->numeroMicroship;
    }

    public function getEspecieId(): int
    {
        return $this->especieId;
    }
}
