<?php

namespace App\Http\Requests\Servico;

use App\Http\Requests\BaseRequest;

class EstoqueFilterRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'nome' => ['nullable', 'string'],
            'ordenacoes' => ['array', 'nullable'],
            'ordenacoes.*.coluna' => ['required_with:ordenacoes', 'string', 'in:nome,id'],
            'ordenacoes.*.ordem' => ['required_with:ordenacoes.*.coluna', 'string', 'in:asc,desc'],
            'limite' => ['nullable']
        ];
    }
}
