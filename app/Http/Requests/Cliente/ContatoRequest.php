<?php

namespace App\Http\Requests\Cliente;

use App\Enums\Cliente\ClienteTipoContatoEnum;
use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class ContatoRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'contatos' => ['nullable', 'array'],
            'contatos.*.tipo' => ['required_with:contatos', Rule::in(ClienteTipoContatoEnum::toValues())],
            'contatos.*.nome' => ['required_with:contatos', 'string'],
            'contatos.*.valor' => ['required_with:contatos', 'string'],
            'contatos.*.preferencial' => ['sometimes', 'boolean'],
        ];
    }
}