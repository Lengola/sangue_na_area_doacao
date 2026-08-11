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
        Schema::create('doadores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->date('data_nascimento')->nullable();
            $table->enum('sexo', ['M','F','O'])->nullable();
            $table->string('numero_identificacao')->nullable()->unique(); // BI
            $table->enum('tipo_sanguineo', ['A+','A-','B+','B-','AB+','AB-','O+','O-']);
            $table->dateTime('ultimo_agendamento')->nullable();
            $table->string('telefone')->nullable();
            $table->decimal('peso',5,2)->nullable();
            $table->text('observacoes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doadores');
    }
};
