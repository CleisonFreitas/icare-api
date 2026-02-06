<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('estoque_has_vacinas', function (Blueprint $table) {
            $table->foreignId('vacina_id')->constrained('vacinas');
            $table->foreignId('estoque_id')->constrained('estoques');
            $table->string('lote');
            $table->tinyInteger('quantidade')->default(1);
            $table->timestamps();
            $table->primary(['estoque_id', 'vacina_id', 'lote']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('estoque_has_vacinas');
    }
};
