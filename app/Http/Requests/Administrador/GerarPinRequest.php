<?php

namespace App\Http\Requests\Administrador;

use App\Http\Requests\BaseRequest;

class GerarPinRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'email' => 'required|email|exists:usuarios,email',
        ];
    }
}
