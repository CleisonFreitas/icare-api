<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

use App\DTOs\Servico\EstoqueDTO;
use App\Models\Servico\Estoque;
use App\Models\Servico\EstoqueHasVacina;
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

    /**
     * Decrementa a quantidade de uma vacina no estoque (pivot `estoque_has_vacinas`).
     * Busca pelo par estoque_id/lote (um dos dois pode ser nulo) e decrementa `quantidade`.
     * Retorna true se uma linha foi encontrada e atualizada, false caso contrário.
     *
     * @param int|null $estoqueId
     * @param string|null $lote
     * @param int $quantidade
     * @return bool
     */
    public function decrementarQuantidadeVacina(?int $estoqueId, ?string $lote, int $quantidade = 1): bool;

    /**
     * Procura um registro em `estoque_has_vacinas` pelo par estoque_id/lote.
     * Retorna a instância do modelo se encontrada ou null.
     *
     * @param int|null $estoqueId
     * @param string|null $lote
     * @return EstoqueHasVacina|null
     */
    public function findEstoqueHasVacina(?int $estoqueId, ?string $lote): ?EstoqueHasVacina;

    /**
     * Atualiza a quantidade de um registro `estoque_has_vacinas` por id.
     * Retorna true se a atualização ocorreu.
     *
     * @param int $id
     * @param int $novaQuantidade
     * @return bool
     */
    public function updateQuantidadeEstoqueHasVacina(int $id, int $novaQuantidade): bool;
}
