<?php

use App\Enums\Servico\StatusConsultaEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('consultas', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('descricao');
            $table->dateTime('data_prevista');
            $table->dateTime('data_realizada')->nullable();
            $table->string('status')->default(StatusConsultaEnum::PENDENTE->value);
            $table->foreignId('pet_id')->constrained('pets');
            $table->foreignId('solicitacao_id')->constrained('solicitacoes');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('consultas');
    }
};
