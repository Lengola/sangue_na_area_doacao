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
        Schema::create('campanhas', function (Blueprint $table) {
            $table->id();
            $table->string('titulo')->index();
            $table->text('descricao')->nullable();
            $table->string('local')->nullable();
            $table->date('data_inicio')->nullable();
            $table->date('data_fim')->nullable();
             $table->foreignId('centro_id')->constrained('centros')->cascadeOnDelete(); // centro de saúde
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campanhas');
    }
};
