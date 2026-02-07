<?php

namespace App\Http\Requests\Servico;

use App\Enums\Servico\StatusConsultaEnum;
use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class ConsultaFilterRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'titulo' => ['sometimes', 'string'],
            'pet_id' => ['sometimes', 'integer'],
            'status' => ['sometimes', 'string', Rule::in(StatusConsultaEnum::toValues())],
            'ordenacoes' => ['sometimes', 'array'],
            'ordenacoes.*.coluna' => ['required_with:ordenacoes', 'string', 'in:id,nome'],
            'ordenacoes.*.ordem' => ['required_with:ordenacoes', 'string', 'in:asc,desc'],
            'limite' => ['sometimes', 'integer']
        ];
    }
}
