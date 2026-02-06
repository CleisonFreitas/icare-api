<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pets', function (Blueprint $table) {
            $table->id();
            $table->string("nome");
            $table->string("documento")->nullable();
            $table->string("tamanho")->nullable();
            $table->string("cor")->nullable();
            $table->boolean("ativo")->default(true);
            $table->date('data_nascimento')->nullable();
            $table->boolean("tem_microship")->default(false);
            $table->string("numero_microship")->nullable();
            $table->foreignId("cliente_id")->constrained("clientes")->onDelete('cascade');
            $table->foreignId("especie_id")->constrained("especies")->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pets');
    }
};
