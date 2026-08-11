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
        Schema::create('centros', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();

            $table->string('nome_centro'); // Nome oficial do centro
            $table->string('telefone'); // Telefone de contato
            $table->string('email')->nullable(); // Email institucional
            $table->string('responsavel')->nullable(); // Nome do responsável pelo centro

            $table->string('nif')->nullable();

            $table->string('imagem')->nullable(); // Caminho da imagem do centro (logo ou foto)

            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('centros');
    }
};
