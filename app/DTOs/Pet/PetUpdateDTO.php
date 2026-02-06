<?php

declare(strict_types=1);

namespace App\DTOs\Pet;

use App\DTOs\BaseDTO;
use App\Enums\Pet\PetTamanhoEnum;
use App\Http\Requests\Pet\PetUpdateRequest;

readonly class PetUpdateDTO extends BaseDTO
{
    public function __construct(
        private readonly string $nome,
        private readonly string $documento,
        private readonly PetTamanhoEnum $tamanho,
        private readonly string $cor,
        private readonly bool $ativo,
        private readonly ?bool $temMicroship = false,
        private readonly ?string $numeroMicroship,
        private readonly int $especieId
    ) {}
    
    public static function fromApiRequest(PetUpdateRequest $request): self
    {
        $dados = $request->validated();
        return new self(
            nome: data_get($dados, 'nome'),
            documento: data_get($dados, 'documento'),
            tamanho: PetTamanhoEnum::tryFrom(data_get($dados, 'tamanho')),
            cor: data_get($dados, 'cor'),
            ativo: data_get($dados, 'ativo', true),
            temMicroship: data_get($dados, 'tem_microship', false),
            numeroMicroship: data_get($dados, 'numero_microship'),
            especieId: data_get($dados, 'especie_id'),
        );
    }
}