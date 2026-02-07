<?php

namespace App\Http\Requests\Administrador;

use App\Http\Requests\BaseRequest;

class ValidarPinRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'pin' => 'required|digits:6',
        ];
    }
}
