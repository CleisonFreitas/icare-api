<?php

use App\Enums\Servico\StatusServicoEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('servicos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->text('detalhes');
            $table->string('status')->default(StatusServicoEnum::PENDENTE->value);
            $table->dateTime('data_conclusao')->nullable();
            $table->decimal('valor', 8, 2)->default(0);
            $table->foreignId('pet_id')->constrained('pets');
            $table->foreignId('consulta_id')->constrained('consultas');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('servicos');
    }
};
