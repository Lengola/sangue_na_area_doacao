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
        Schema::create('agendamentos', function (Blueprint $table) {
        $table->id();
       // $table->foreignId('doador_id')->constrained('doadors')->cascadeOnDelete();
        $table->foreignId('user_id')->constrained('users')->cascadeOnDelete(); // deve ser uder doador
        $table->foreignId('centro_id')->constrained('centros')->cascadeOnDelete(); // centro de saúde
         $table->foreignId('campanha_id')->nullable()->constrained('campanhas')->nullOnDelete();
        $table->date('data_agendamento');
        $table->time('hora_agendada')->nullable();
        $table->enum('status', ['pendente', 'confirmado', 'concluido', 'cancelado'])->default('pendente');
        $table->string('motivo_cancelamento')->nullable();
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agendamentos');
    }
};
