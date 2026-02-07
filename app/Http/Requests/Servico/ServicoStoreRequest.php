<?php

namespace App\Http\Requests\Servico;

use App\Http\Requests\BaseRequest;

class ServicoStoreRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'nome' => ['required', 'string', 'max:255'],
            'detalhes' => ['nullable', 'string'],
            'status' => ['nullable', 'string'],
            'data_conclusao' => ['nullable', 'date'],
            'pet_id' => ['nullable', 'integer', 'exists:pets,id'],
            'consulta_id' => ['nullable', 'integer', 'exists:consultas,id'],
            'valor' => ['nullable', 'numeric']
        ];
    }
}
