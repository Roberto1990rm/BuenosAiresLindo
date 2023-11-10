<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImagesToBarriosTable extends Migration
{
    public function up()
    {
        Schema::table('barrios', function (Blueprint $table) {
            $table->string('imagen2')->nullable();
            $table->string('imagen3')->nullable();
            $table->string('imagen4')->nullable();
            $table->string('imagen5')->nullable();
        });
    }

    public function down()
    {
        Schema::table('barrios', function (Blueprint $table) {
            $table->dropColumn(['imagen2', 'imagen3', 'imagen4', 'imagen5']);
        });
    }
}

