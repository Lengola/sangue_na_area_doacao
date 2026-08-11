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
        Schema::create('sangues', function (Blueprint $table) {
            $table->id();
            $table->foreignId('doacao_id')->nullable()->constrained('doacoes')->nullOnDelete();
            $table->foreignId('doador_id')->nullable()->constrained('doadores')->nullOnDelete();$table->string('codigo_bolsa')->unique();
            $table->date('data_coleta')->nullable();
            $table->integer('volume_ml')->nullable();
            $table->date('data_validade')->nullable();
            $table->enum('status', ['quarentena','disponivel','reservada','emitida','transfundida','expirada','descarte'])->default('quarentena');
            $table->enum('tipo_sanguineo', ['A+','A-','B+','B-','AB+','AB-','O+','O-']);

            // Exames após a doação
            $table->boolean('hiv')->default(false);
            $table->boolean('hepatite_b')->default(false);
            $table->boolean('hepatite_c')->default(false);
            $table->boolean('sifilis')->default(false);
            $table->boolean('malaria')->default(false);

             $table->foreignId('centro_id')->constrained('centros')->cascadeOnDelete(); // centro de saúde
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sangues');
    }
};
