<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImagesToOcioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ocio', function (Blueprint $table) {
            $table->string('imagen2')->nullable();
            $table->string('imagen3')->nullable();
            $table->string('imagen4')->nullable();
        });
    }
    
 
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ocio', function (Blueprint $table) {
            $table->dropColumn(['imagen2', 'imagen3', 'imagen4']);
        });
    }
    
}
