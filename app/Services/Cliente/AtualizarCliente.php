<?php
declare(strict_types=1);

namespace App\Services\Cliente;

use App\DTOs\Cliente\ClienteUpdateDTO;
use App\Models\Cliente\Cliente;
use App\Repositories\Contracts\ClienteContract;

class AtualizarCliente
{
    public function __construct(
        private readonly ClienteContract $logic
    ) {}

    public function atualizar(ClienteUpdateDTO $dto, Cliente $cliente): Cliente
    {
        $clienteAtualizado = $this->logic->update($dto, $cliente);
        
        return $clienteAtualizado;
    }
}