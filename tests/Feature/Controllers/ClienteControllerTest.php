<?php

namespace Tests\Feature\Controllers;

use App\Models\Cliente\Cliente;
use App\Models\Cliente\Contato;
use App\Models\Cliente\Endereco;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

final class ClienteControllerTest extends TestCase
{
    #[Test]
    public function index(): void
    {
        $this->actingAsAdmin();
        $cliente = Cliente::factory()->create();
        Endereco::factory()->for($cliente)->create();
        Contato::factory()->for($cliente)->create();

        $pesquisa = [
            'nome' => $cliente->nome,
            'documento' => $cliente->documento,
            'data_nascimento' => [
                'inicio' => $cliente->data_nascimento->clone()->subDay()->format('Y-m-d'),
                'fim' => $cliente->data_nascimento->clone()->addDay()->format('Y-m-d')
            ]
        ];

        $response = $this->getJson('api/v1/cliente?' . http_build_query($pesquisa));
        $response->assertOk();
        $response->assertJsonStructure([
            'data' => [
                0 => [
                    'nome',
                    'email',
                    'documento',
                ]
            ],
            'links',
            'meta'
        ]);
    }

    #[Test]
    public function store(): void
    {
        $this->actingAsAdmin();
        $dados = Cliente::factory()->make()->toArray();
        $dadosEndereco = Endereco::factory()->make()->toArray();
        $dadosContato = Contato::factory()->count(2)->make()->toArray();
        data_set($dados, 'endereco', $dadosEndereco);
        data_set($dados, 'contatos', $dadosContato);
        $response = $this->postJson('api/v1/cliente', $dados);
        $response->assertCreated();
        $response->assertJsonStructure([
            'id',
            'nome',
            'email',
            'documento',
            'data_nascimento',
            'endereco',
            'contatos'
        ]);
    }

    #[Test]
    public function show(): void
    {
        $this->actingAsAdmin();

        $cliente = Cliente::factory()->create();
        Endereco::factory()->for($cliente)->create();
        Contato::factory()->for($cliente)->create();

        $response = $this->getJson("api/v1/cliente/$cliente->id");
        $response->assertOk();
        $response->assertJsonStructure([
            'id',
            'nome',
            'documento',
            'data_nascimento',
            'endereco',
            'contatos'
        ]);
    }

    #[Test]
    public function update(): void
    {
        $this->actingAsAdmin();

        $cliente = Cliente::factory()->create();
        $dados = Cliente::factory()->make()->toArray();

        $response = $this->putJson("api/v1/cliente/$cliente->id", $dados);
        $response->assertOk();
        $response->assertJsonStructure([
            'id',
            'nome',
            'email',
            'documento',
            'data_nascimento',
        ]);
    }

    #[Test]
    public function destroy(): void
    {
        $this->actingAsAdmin();

        $cliente = Cliente::factory()->create();

        $response = $this->deleteJson("api/v1/cliente/$cliente->id");
        $response->assertOk();

        $this->assertFalse(Cliente::where('id', $cliente->id)->exists());
    }
}