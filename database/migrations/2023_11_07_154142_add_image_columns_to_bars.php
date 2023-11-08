<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImageColumnsToBars extends Migration
{
    public function up()
    {
        Schema::table('bars', function (Blueprint $table) {
            $table->string('image1'); // Obligatoria
            $table->string('image2')->nullable();
            $table->string('image3')->nullable();
            $table->string('image4')->nullable();
        });
    }

    public function down()
    {
        Schema::table('bars', function (Blueprint $table) {
            $table->dropColumn('image1');
            $table->dropColumn('image2');
            $table->dropColumn('image3');
            $table->dropColumn('image4');
        });
    }
}

