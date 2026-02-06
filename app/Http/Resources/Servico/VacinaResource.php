<?php

namespace App\Http\Resources\Servico;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VacinaResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'pet_id' => $this->pet_id,
            'nome' => $this->nome,
            'data_administrada' => $this->data_administrada,
            'aplicado_por' => $this->aplicado_por,
            'fabricante' => $this->fabricante,
            'dosagem' => $this->dosagem,
            'servicos_id' => $this->servico_id,
            'estoques' => EstoqueResource::collection($this->whenLoaded('estoques'))
        ];
    }
}
