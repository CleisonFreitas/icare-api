<?php

namespace App\Http\Requests\Cliente;

use App\Http\Requests\BaseRequest;

class EnderecoRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'cep' => ['required', 'string'],
            'logradouro' => ['required', 'string'],
            'numero' => ['required'],
            'complemento' => ['nullable', 'string'],
            'bairro' => ['required', 'string'],
            'cidade' => ['required', 'string'],
            'uf' => ['required', 'string'],
        ];
    }
}
