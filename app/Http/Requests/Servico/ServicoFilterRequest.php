<?php

namespace App\Http\Requests\Servico;

use App\Enums\Servico\StatusServicoEnum;
use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class ServicoFilterRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'nome' => ['sometimes', 'string'],
            'status' => ['sometimes', 'string', Rule::in(StatusServicoEnum::toValues())],
            'ordenacoes' => ['sometimes', 'array'],
            'limite' => ['sometimes', 'integer']
        ];
    }
}
