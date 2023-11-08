<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParquesTable extends Migration
{
    public function up()
    {
        Schema::create('parques', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->text('descripcion');
            $table->string('calle');
            $table->unsignedBigInteger('barrio_id');
            $table->foreign('barrio_id')->references('id')->on('barrios');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('parques');
    }
}
