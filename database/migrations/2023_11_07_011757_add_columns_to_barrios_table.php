<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('barrios', function (Blueprint $table) {
            $table->string('img')->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('barrios', function (Blueprint $table) {
            $table->dropColumn(['img', 'latitude', 'longitude']);
        });
    }
    
};
