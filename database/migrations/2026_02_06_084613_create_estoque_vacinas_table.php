<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('estoque_has_vacinas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vacina_id')->constrained('vacinas');
            $table->foreignId('estoque_id')->constrained('estoques');
            $table->string('lote');
            $table->tinyInteger('quantidade')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('estoque_has_vacinas');
    }
};
