<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParquesTable extends Migration
{
    public function up()
    {
        // Verificar si la tabla no existe antes de crearla
        if (!Schema::hasTable('parques')) {
            Schema::create('parques', function (Blueprint $table) {
                $table->id();
                $table->string('nombre', 100); // Longitud específica si es necesaria
                $table->text('descripcion');
                $table->string('calle', 100); // Longitud específica si es necesaria
                $table->unsignedBigInteger('barrio_id');
                $table->foreign('barrio_id')->references('id')->on('barrios');
                $table->timestamps();
            });
        }
    }

    public function down()
    {
        // Verificar si la tabla existe antes de intentar eliminarla
        if (Schema::hasTable('parques')) {
            // Eliminar primero la clave foránea
            Schema::table('parques', function (Blueprint $table) {
                $table->dropForeign(['barrio_id']);
            });

            // Luego eliminar la tabla
            Schema::dropIfExists('parques');
        }
    }
}

