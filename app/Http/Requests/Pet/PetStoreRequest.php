<?php

namespace App\Http\Requests\Pet;

use App\Enums\Pet\PetTamanhoEnum;
use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class PetStoreRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'nome' => ['required', 'string', 'max:255'],
            'documento' => ['required', 'string', 'max:255'],
            'tamanho' => ['required', 'string', Rule::in(PetTamanhoEnum::toValues())],
            'cor' => ['required', 'string'],
            'tem_microship' => ['nullable', 'boolean'],
            'numero_microship' => ['nullable', 'string'],
            'especie_id' => ['required', Rule::exists('especies', 'id')]
        ];
    }
}