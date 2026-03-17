<?php

declare(strict_types=1);

namespace App\Services\Cliente;

use App\DTOs\Cliente\ClienteDTO;
use App\Http\Resources\Cliente\ClienteResource;
use App\Repositories\Contracts\ClienteContract;
use App\Repositories\Contracts\ContatoContract;
use App\Repositories\Contracts\EnderecoContract;
use Illuminate\Support\Facades\DB;

class CadastrarCliente
{
    public function __construct(
        private readonly ClienteContract $logic,
        private readonly EnderecoContract $enderecoLogic,
        private readonly ContatoContract $contatosLogic
    ) {}

    public function cadastrar(ClienteDTO $dto): ClienteResource
    {
        DB::beginTransaction();
        $cliente = $this->logic->create($dto);
        $enderecoDTO = $dto->getEnderecoDto();
        $contatos = $dto->getContatos();
        $this->contatosLogic->createMany($contatos, $cliente);
        $this->enderecoLogic->create($enderecoDTO, $cliente);
        DB::commit();
        return new ClienteResource($cliente
            ->refresh()
            ->load(['endereco', 'contatos']
        ));
    }
}