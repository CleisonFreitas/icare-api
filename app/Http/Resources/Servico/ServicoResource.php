<?php

namespace App\Http\Resources\Servico;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServicoResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'detalhes' => $this->detalhes,
            'status' => $this->status,
            'data_conclusao' => $this->data_conclusao,
            'pet_id' => $this->pet_id,
            'consulta_id' => $this->consulta_id,
            'valor' => $this->valor,
            'pet' => $this->whenLoaded('pet', fn($pet) => [
                'id' => $pet->id,
                'nome' => $pet->nome ?? null
            ]),
            'consulta' => $this->whenLoaded('consulta', fn($c) => [
                'id' => $c->id,
                'detalhes' => $c->detalhes ?? null
            ])
        ];
    }
}
