<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

use App\DTOs\Servico\VacinaDTO;
use App\Models\Servico\Vacina;
use Illuminate\Pagination\LengthAwarePaginator;

interface VacinaContract
{
    /**
     * Buscar vacinas com filtros, ordenações e paginação
     *
     * @param array $filtros
     * @param array $ordenacoes
     * @param int $limite
     * @return LengthAwarePaginator
     */
    public function buscar(array $filtros, array $ordenacoes, int $limite): LengthAwarePaginator;

    /**
     * Cadastrar uma vacina
     *
     * @param VacinaDTO $dto
     * @return Vacina
     */
    public function cadastrar(VacinaDTO $dto): Vacina;

    /**
     * Atualizar uma vacina existente
     *
     * @param VacinaDTO $dto
     * @param Vacina $vacina
     * @return Vacina
     */
    public function atualizar(VacinaDTO $dto, Vacina $vacina): Vacina;
}
