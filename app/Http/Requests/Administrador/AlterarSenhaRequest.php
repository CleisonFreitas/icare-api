<?php

namespace App\Http\Requests\Administrador;

use App\Http\Requests\BaseRequest;

class AlterarSenhaRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'pin' => 'required|digits:4',
            'senha' => 'required|string|min:6|confirmed',
        ];
    }
}
