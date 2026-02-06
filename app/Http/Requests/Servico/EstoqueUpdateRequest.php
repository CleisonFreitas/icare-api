<?php

namespace App\Http\Requests\Servico;

use App\Http\Requests\BaseRequest;

class EstoqueUpdateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'nome' => ['required', 'string', 'max:255'],
            'descricao' => ['required', 'string'],
        ];
    }
}
