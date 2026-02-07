<?php

namespace App\Http\Requests\Administrador;

use App\Http\Requests\BaseRequest;

class LoginRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'senha' => 'required|string',
        ];
    }
}
