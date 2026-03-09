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
            'ordenar_por' => ['sometimes', 'string', 'in:nome,id,documento'],
            'direcao' => ['required_with:ordernar_por', 'string', 'in:asc,desc'],
            'limite' => ['nullable']
        ];
    }
}
