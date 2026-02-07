<?php

namespace App\Http\Requests\Servico;

use App\Http\Requests\BaseRequest;

class ConsultaStoreRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'titulo' => ['required', 'string', 'max:255'],
            'descricao' => ['nullable', 'string'],
            'data_prevista' => ['nullable', 'date'],
            'data_realizada' => ['nullable', 'date'],
            'status' => ['nullable', 'string'],
            'pet_id' => ['nullable', 'integer', 'exists:pets,id'],
            'solicitacao_id' => ['nullable', 'integer', 'exists:solicitacoes,id'],
            'servicos' => ['sometimes', 'array'],
            'servicos.*.nome' => ['required_with:servicos', 'string'],
            'servicos.*.detalhes' => ['nullable', 'string'],
            'servicos.*.valor' => ['nullable', 'numeric'],
            // quando for vacinação incluir dados do estoque/lote
            'servicos.*.vacina.estoque_id' => ['sometimes', 'integer', 'exists:estoques,id'],
            'servicos.*.vacina.lote' => ['sometimes', 'string'],
            'servicos.*.vacina.aplicado_por' => ['sometimes', 'exists:usuarios,id'],
            'servicos.*.vacina.dosagem' => ['sometimes', 'integer'],
            'servicos.*.vacina.servico_id' => ['sometimes', 'exists:servicos,id'],
        ];
    }
}
