<?php

namespace App\Http\Resources\Pet;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PetResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'documento' => $this->documento,
            'cor' => $this->cor,
            'tamanho' => $this->tamanho,
            'numero_microship' => $this->numero_microship,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}