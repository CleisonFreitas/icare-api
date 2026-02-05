<?php

namespace App\Http\Requests\Pet;

use App\Enums\Pet\PetTamanhoEnum;
use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class PetFilterRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'nome' => ['nullable', 'string'],
            'documento' => ['nullable', 'string'],
            'tamanho' => ['nullable', Rule::in(PetTamanhoEnum::toValues())],
            'cor' => ['nullable', 'string'],
            'numero_microship' => ['nullable', 'string'],
            'cliente.nome' => ['nullable', 'string'],
            'cliente.documento' => ['nullable', 'string'],
            'per_page' => ['nullable', 'string'],
            'ordenacoes' => ['nullable', 'array'],
            'ordenacoes.*.coluna' => ['required_with:ordenacoes', 'string', 'in:id,nome'],
            'ordenacoes.*.ordem' => ['required_with:ordenacoes', 'string', 'in:asc,desc'],
        ];
    }
}
