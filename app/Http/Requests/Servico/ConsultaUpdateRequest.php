<?php

namespace App\Http\Requests\Servico;

use App\Http\Requests\BaseRequest;

class ConsultaUpdateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'titulo' => ['sometimes', 'required', 'string', 'max:255'],
            'descricao' => ['nullable', 'string'],
            'data_prevista' => ['nullable', 'date'],
            'data_realizada' => ['nullable', 'date'],
            'solicitacao_id' => ['sometimes', 'exists:solicitacoes,id'],
            'status' => ['nullable', 'string'],
            'pet_id' => ['nullable', 'integer', 'exists:pets,id'],
            'servicos' => ['sometimes', 'array'],
            'servicos.*.nome' => ['required_with:servicos', 'string'],
            'servicos.*.detalhes' => ['nullable', 'string'],
            'servicos.*.valor' => ['nullable', 'numeric'],
            'servicos.*.vacina.estoque_id' => ['sometimes', 'integer', 'exists:estoques,id'],
            'servicos.*.vacina.lote' => ['sometimes', 'string']
        ];
    }
}
