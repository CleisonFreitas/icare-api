<?php
declare(strict_types=1);
namespace App\Services\Servico;

use App\DTOs\Servico\ServicoDTO;
use App\Models\Servico\Servico;
use App\Repositories\Contracts\ServicoContract;

class AtualizarServico
{
    public function __construct(private readonly ServicoContract $logic) {}

    public function atualizar(ServicoDTO $dto, Servico $servico): Servico
    {
        return $this->logic->atualizar($dto, $servico);
    }
}
