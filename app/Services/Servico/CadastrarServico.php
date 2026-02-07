<?php

declare(strict_types=1);

namespace App\Services\Servico;

use App\DTOs\Servico\ServicoDTO;
use App\Models\Servico\Servico;
use App\Repositories\Contracts\ServicoContract;

class CadastrarServico
{
    public function __construct(private readonly ServicoContract $logic) {}

    public function cadastrar(ServicoDTO $dto): Servico
    {
        return $this->logic->cadastrar($dto);
    }
}
