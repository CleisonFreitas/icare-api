<?php

namespace App\Http\Requests\Servico;

use App\Http\Requests\BaseRequest;

class VacinaUpdateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'pet_id' => ['nullable', 'integer', 'exists:pets,id'],
            'nome' => ['sometimes', 'required', 'string', 'max:255'],
            'data_administrada' => ['nullable', 'date'],
            'aplicado_por' => ['nullable', 'integer', 'exists:usuarios,id'],
            'fabricante' => ['nullable', 'string'],
            'dosagem' => ['nullable', 'integer'],
            'servico_id' => ['nullable', 'integer', 'exists:servicos,id']
        ];
    }
}
