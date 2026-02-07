<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

use App\DTOs\Servico\ServicoDTO;
use App\Models\Servico\Servico;
use Illuminate\Pagination\LengthAwarePaginator;

interface ServicoContract
{
    public function buscar(array $filtros, array $ordenacoes, int $limite): LengthAwarePaginator;

    public function cadastrar(ServicoDTO $dto): Servico;

    public function atualizar(ServicoDTO $dto, Servico $servico): Servico;
}
