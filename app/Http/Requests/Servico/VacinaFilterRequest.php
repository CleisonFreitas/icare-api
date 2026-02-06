<?php

namespace App\Http\Requests\Servico;

use App\Http\Requests\BaseRequest;

class VacinaFilterRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'nome' => ['sometimes', 'string'],
            'autor_aplicacao' => ['sometimes', 'string'],
            'data_administrada' => ['sometimes', 'array:inicio,fim'],
            'ordenacoes' => ['sometimes', 'array'],
            'ordenacoes.*.coluna' => ['required_with:ordenacoes', 'in:id,nome,dosagem'],
            'ordenacoes.*.ordem' => ['required_with:ordenacoes', 'in:asc,desc'],
            'limite' => ['sometimes', 'integer']
        ];
    }
}
