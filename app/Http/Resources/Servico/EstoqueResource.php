<?php

namespace App\Http\Resources\Servico;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EstoqueResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'descricao' => $this->descricao,
            'vacinas' => $this->whenLoaded('vacinas', function () {
                // Agrupa as vacinas pelo campo 'lote'.
                // Suporta quando o relacionamento fornece o campo via pivot (belongsToMany)
                // ou quando a propriedade 'lote' está diretamente na model Vacina.
                $groups = $this->vacinas->groupBy(function ($vacina) {
                    return $vacina->pivot->lote ?? ($vacina->lote ?? null);
                });

                // Para cada lote, somamos as quantidades (do pivot ou do atributo) e
                // retornamos a lista de itens associados ao lote.
                return $groups->map(function ($group, $lote) {
                    return [
                        'lote' => $lote,
                        'quantidade' => $group->sum(function ($v) {
                            return $v->pivot->quantidade ?? ($v->quantidade ?? 0);
                        }),
                    ];
                })->values();
            })
        ];
    }
}
