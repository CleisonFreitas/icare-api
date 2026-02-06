<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

use App\DTOs\Servico\EstoqueDTO;
use App\Models\Servico\Estoque;
use Illuminate\Pagination\LengthAwarePaginator;

interface EstoqueContract
{
    /**
     * Responsável por buscar todos os estoques cadastrados
     * 
     * @param array $filtros
     * @param array $ordenacoes
     * @param int $limite
     * 
     * @return LengthAwarePaginator
     */
    public function buscar(
        array $filtros,
        array $ordenacoes,
        int $limite
    ): LengthAwarePaginator;

    /**
     * Responsável por cadastrar estoques de vacinas
     * 
     * @param EstoqueDTO $dto
     *
     * @return Estoque
     */
    public function cadastrar(EstoqueDTO $dto): Estoque;

    /**
     * Responsável por atualizar um estoque cadastrado.
     *
     * @param EstoqueDTO $dto
     * @param Estoque $estoque
     *
     * @return Estoque
     */
    public function atualizar(EstoqueDTO $dto, Estoque $estoque): Estoque;
}
