<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('doacoes', function (Blueprint $table) {
            $table->dropForeign(['triagen_id']);
            $table->dropColumn('triagen_id');
        });
    }

    public function down(): void
    {
        Schema::table('doacoes', function (Blueprint $table) {
            $table->foreignId('triagen_id')
                  ->nullable()
                  ->constrained('triagens')
                  ->nullOnDelete();
        });
    }
};