<?php

namespace Tests\Feature\Controllers;

use App\Models\Cliente\Cliente;
use App\Models\Cliente\Pet;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

final class PetControllerTest extends TestCase
{
    #[Test]
    public function index(): void
    {
        $this->actingAsAdmin();

        $pet = Pet::factory()->create();

        $filtros = [
            'nome' => $pet->nome,
            'documento' => $pet->documento,
            'tamanho' => $pet->tamanho,
            'numero_microship' => $pet->numero_microship
        ];

        $response = $this->getJson('api/v1/pet?'. http_build_query($filtros));
        $response->assertOk();
        $response->assertJsonStructure([
            'data' => [
                0 => [
                    'nome',
                    'documento',
                    'tamanho',
                    'numero_microship'
                ]
            ]
        ]);
    }

    #[Test]
    public function store(): void
    {
        $this->actingAsAdmin();
        $cliente = Cliente::factory()->create();
        $pet = Pet::factory()->make();

        $response = $this->postJson("api/v1/cliente/$cliente->id/pet", $pet->toArray());
        $response->assertCreated();
        $response->assertJsonStructure([
            'id',
            'nome',
            'documento'
        ]);
    }

    #[Test]
    public function show(): void
    {
        $this->actingAsAdmin();

        $pet = Pet::factory()->create();

        $response = $this->getJson("api/v1/pet/$pet->id");
        $response->assertOk();
        $response->assertJsonStructure([
            'id',
            'nome',
            'documento'
        ]);
    }

    #[Test]
    public function update(): void
    {
        $this->actingAsAdmin();

        $pet = Pet::factory()->create();
        $dados = Pet::factory()->make()->toArray();

        $response = $this->putJson("api/v1/pet/$pet->id", $dados);
        $response->assertOk();
    }

    #[Test]
    public function destroy(): void
    {
        $this->actingAsAdmin();

        $pet = Pet::factory()->create();

        $response = $this->deleteJson("api/v1/pet/$pet->id");
        $response->assertOk();

        $this->assertFalse(Pet::where('id', $pet->id)->exists());
    }
}