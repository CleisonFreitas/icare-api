<?php

namespace App\Http\Requests\Cliente;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class ClienteUpdateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'nome' => ['required', 'string'],
            'email' => ['required', 'email', Rule::unique('clientes')->ignore($this->id)],
            'documento' => ['required', 'string']
        ];
    }
}
