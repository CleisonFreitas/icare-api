<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

use App\DTOs\Servico\ConsultaDTO;
use App\Models\Servico\Consulta;
use Illuminate\Pagination\LengthAwarePaginator;

interface ConsultaContract
{
    /**
     * Responsável por buscar consultas e correlatos.
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
     * Responsável por cadastrar consultas
     * 
     * @param ConsultaDTO $dto
     * 
     * @return Consulta
     */
    public function cadastrar(ConsultaDTO $dto): Consulta;

    /**
     * Anexa serviços a uma consulta já criada (criação em lote)
     * Retorna os modelos de serviços criados.
     *
     * @param Consulta $consulta
     * @param array $servicosData
     * @return array
     */
    public function attachServicos(Consulta $consulta, array $servicosData): array;

    /**
     * Responsável por realizar atualização de consulta.
     * 
     * @param ConsultaDTO $dto
     * @param Consulta $consulta
     * @return Consulta
     */
    public function atualizar(ConsultaDTO $dto, Consulta $consulta): Consulta;
}
