<?php

namespace App\Http\Resources\Cliente;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClienteResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'email' => $this->email,
            'documento' => $this->documento,
            'data_nascimento' => $this->data_nascimento,
            'endereco' => new EnderecoResource($this->whenLoaded('endereco')),
            'contatos' => $this->whenLoaded('contatos'),
        ];
    }
}
