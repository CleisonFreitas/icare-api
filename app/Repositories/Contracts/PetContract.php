<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

use App\DTOs\Pet\PetDTO;
use App\DTOs\Pet\PetUpdateDTO;
use App\Models\Cliente\Cliente;
use App\Models\Cliente\Pet;
use Illuminate\Pagination\LengthAwarePaginator;

interface PetContract
{
    /**
     * Buscar pets e retorna a consulta paginada.
     *
     * @param array $filtros
     * @param array $ordenacoes
     * @param int $limite
     *
     * @return LengthAwarePaginator
     */
    public function paginate(
        array $filtros,
        array $ordenacoes,
        int $limite
    ): LengthAwarePaginator;

    /**
     * Cadastrar pet através do DTO.
     *
     * @param PetDTO $dto
     * @param Cliente $cliente
     *
     * @return Pet
     */
    public function register(PetDTO $dto, Cliente $cliente): Pet;

    /**
     * Atualizar Pet através do DTO.
     * 
     * @param PetUpdateDTO $dto
     * @param Pet $pet
     *
     * @return Pet
     */
    public function atualizar(PetUpdateDTO $dto, Pet $pet): Pet;
}
