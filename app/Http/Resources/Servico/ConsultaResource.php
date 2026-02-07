<?php

namespace App\Http\Resources\Servico;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ConsultaResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'titulo' => $this->titulo,
            'descricao' => $this->descricao,
            'data_prevista' => $this->data_prevista,
            'data_realizada' => $this->data_realizada,
            'status' => $this->status,
            'pet_id' => $this->pet_id,
            'servicos' => ServicoResource::collection($this->whenLoaded('servicos'))
        ];
    }
}
