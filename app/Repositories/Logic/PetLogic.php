<?php

namespace App\Repositories\Logic;

use App\DTOs\Pet\PetDTO;
use App\DTOs\Pet\PetUpdateDTO;
use App\Models\Cliente\Cliente;
use App\Models\Cliente\Pet;
use App\Repositories\Contracts\PetContract;
use Illuminate\Pagination\LengthAwarePaginator;

class PetLogic implements PetContract
{
    /**
     * @inheritDoc
     */
    public function paginate(
        array $filtros,
        array $ordenacoes,
        int $limite
    ): LengthAwarePaginator {
        return Pet::query()
            ->filter($filtros)
            ->order($ordenacoes)
            ->paginate($limite);
    }

    /**
     * @inheritDoc
     */
    public function register(PetDTO $dto, Cliente $cliente): Pet
    {
        $pet = new Pet();

        $pet->nome = $dto->getNome();
        $pet->documento = $dto->getDocumento();
        $pet->tamanho = $dto->getTamanho();
        $pet->cor = $dto->getCor();
        $pet->tem_microship = $dto->getTemMicroship();
        $pet->numero_microship = $dto->getNumeroMicroship();
        $pet->cliente_id = $cliente->id;
        $pet->especie_id = $dto->getEspecieId();

        $pet->save();
        return $pet->refresh();
    }

    /**
     * @inheritDoc
     */
    public function atualizar(PetUpdateDTO $dto, Pet $pet): Pet
    {
        $pet->fill($dto->toArray());
        $pet->save();

        return $pet->refresh();
    }
}
