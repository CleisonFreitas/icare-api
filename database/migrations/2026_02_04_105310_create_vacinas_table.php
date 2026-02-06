<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vacinas', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->dateTime('data_administrada')->nullable();
            $table->foreignId('aplicado_por')->constrained('usuarios');
            $table->string('fabricante')->nullable();
            $table->tinyInteger('dosagem');
            $table->foreignId('pet_id')->constrained('pets');
            $table->foreignId('servico_id')->constrained('servicos');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vacinas');
    }
};
