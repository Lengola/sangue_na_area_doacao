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
        Schema::create('doacoes', function (Blueprint $table) {
        $table->id();
        $table->foreignId('triagen_id')->nullable()->constrained('triagens')->nullOnDelete();
        $table->foreignId('agendamento_id')->constrained('agendamentos')->onDelete('cascade'); // relacionamento com agendamento
        $table->date('data_doacao');
        $table->string('tipo_doacao')->default('Sangue'); // Pode ser sangue, plaquetas, plasma
        $table->enum('status', ['Concluída', 'Pendente', 'Cancelada'])->default('Pendente');
        $table->text('observacao')->nullable();
        $table->integer('volume_ml')->nullable();
        $table->enum('estado', ['coletada','em_teste','aprovada','rejeitada','processada'])->default('coletada');
        $table->foreignId('medico_id')->constrained('medicos')->cascadeOnDelete();
         $table->foreignId('centro_id')->constrained('centros')->cascadeOnDelete(); // centro de saúde
        $table->timestamps();
        $table->text('observacoes')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doacoes');
    }
};
