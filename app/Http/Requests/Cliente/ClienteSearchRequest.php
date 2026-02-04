<?php

namespace App\Http\Requests\Cliente;

use App\Http\Requests\BaseRequest;

class ClienteSearchRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'nome' => ['nullable', 'string'],
            'documento' => ['nullable', 'string'],
            'email' => ['nullable', 'string'],
            'data_nascimento' => ['nullable', 'array:inicio,fim'],
            'ordenacoes' => ['array', 'nullable'],
            'ordenacoes.*.coluna' => ['required_with:ordenacoes', 'string', 'in:nome,id,documento'],
            'ordenacoes.*.ordem' => ['required_with:ordenacoes.*.coluna', 'string', 'in:asc,desc']
        ];
    }
}
