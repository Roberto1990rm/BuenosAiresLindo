<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBaresTable extends Migration
{
    public function up()
    {
        Schema::create('bares', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('direccion');
            $table->unsignedBigInteger('barrio_id'); // Relacionada con la tabla de barrios
            $table->text('descripcion');
            $table->string('precios');
            $table->decimal('latitude', 10, 6);
            $table->decimal('longitude', 10, 6);
            $table->string('horario');
            $table->timestamps();

            $table->foreign('barrio_id')->references('id')->on('barrios'); // Establece una relación con la tabla de barrios
        });
    }

    public function down()
    {
        Schema::dropIfExists('bares');
    }
}

