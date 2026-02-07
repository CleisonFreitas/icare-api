<?php
declare(strict_types=1);
namespace App\Services\Servico;

use App\DTOs\Servico\ConsultaDTO;
use App\Models\Servico\Consulta;
use App\Repositories\Contracts\ConsultaContract;

class AtualizarConsulta
{
    public function __construct(private readonly ConsultaContract $logic) {}

    public function atualizar(ConsultaDTO $dto, Consulta $consulta): Consulta
    {
        return $this->logic->atualizar($dto, $consulta);
    }
}
