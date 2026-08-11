<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('doacoes', function (Blueprint $table) {

            $table->unique('agendamento_id');

        });
    }

    public function down()
    {
        Schema::table('doacoes', function (Blueprint $table) {

            $table->dropUnique(['agendamento_id']);

        });
    }
};