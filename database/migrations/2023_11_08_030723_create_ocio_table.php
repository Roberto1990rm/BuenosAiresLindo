<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOcioTable extends Migration
{
    public function up()
    {
        Schema::create('ocio', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->text('descripcion');
            $table->binary('imagen')->nullable(); // Usamos 'binary' para almacenar la imagen
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ocio');
    }
}

