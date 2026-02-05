<?php

namespace App\Http\Requests\Pet;

use App\Enums\Pet\PetTamanhoEnum;
use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class PetUpdateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'nome' => ['required', 'string', 'max:255'],
            'documento' => ['required', 'string', 'max:255'],
            'tamanho' => ['required', 'string', Rule::in(PetTamanhoEnum::toValues())],
            'ativo' => ['nullable', 'boolean'],
            'tem_microship' => ['nullable', 'boolean'],
            'numero_microship' => ['nullable', 'string'],
            'cor' => ['required', 'string'],
            'especie_id' => ['required', Rule::exists('especies', 'id')]
        ];
    }
}
