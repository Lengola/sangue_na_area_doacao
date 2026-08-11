<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('triagens', function (Blueprint $table) {
    $table->id();

    $table->foreignId('doador_id')->constrained('doadores')->cascadeOnDelete();
    $table->boolean('apto')->default(false);
    $table->foreignId('agendamento_id')->constrained('agendamentos')->cascadeOnDelete();
    $table->foreignId('medico_id')->constrained('medicos')->cascadeOnDelete();
    $table->text('observacoes')->nullable();
    $table->string('pressao_arterial')->nullable();
    $table->string('temperatura')->nullable();
    $table->string('frequencia_cardiaca')->nullable();
    $table->string('peso')->nullable();
    $table->string('altura')->nullable();
    $table->text('motivo_inapto')->nullable();
    $table->foreignId('centro_id')->constrained('centros')->cascadeOnDelete(); // centro de saúde
    $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('triagens');
    }
};
