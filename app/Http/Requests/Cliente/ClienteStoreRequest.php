<?php

namespace App\Http\Requests\Cliente;

use App\Enums\Cliente\ClienteTipoContatoEnum;
use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class ClienteStoreRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'nome' => ['required', 'string', 'max:255'],
            'email' => ['required', 'unique:clientes,email', 'email'],
            'documento' => ['required', 'max:11', 'string'],
            'data_nascimento' => ['nullable', 'date'],
            'endereco' => ['required', 'array'],
            'endereco.cep' => ['required', 'string'],
            'endereco.logradouro' => ['required', 'string'],
            'endereco.numero' => ['required'],
            'endereco.complemento' => ['nullable', 'string'],
            'endereco.bairro' => ['required', 'string'],
            'endereco.cidade' => ['required', 'string'],
            'endereco.pais' => ['required', 'string'],
            'contatos' => ['nullable', 'array'],
            'contatos.*.tipo' => ['required_with:contatos', Rule::in(ClienteTipoContatoEnum::toValues())],
            'contatos.*.valor' => ['required_with:contatos', 'string']
        ];
    }

    public function attributes(): array
    {
        return [
            'endereco.cep' => 'cep',
            'endereco.logradouro' => 'logradouro',
            'endereco.numero' => 'numero',
            'endereco.complemento' => 'complemento',
            'endereco.bairro' => 'bairro',
            'endereco.cidade' => 'cidade',
            'endereco.pais' => 'pais',
            'contatos.*.tipo' => 'tipo de contato',
            'contatos.*.valor' => 'descrição do contato',
        ];
    }
}