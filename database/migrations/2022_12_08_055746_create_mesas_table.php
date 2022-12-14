<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMesasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mesas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('local_id')->nullable()->unsigned();
            $table->integer('nombre');
            $table->string('imagen');
            $table->foreign('local_id')->references('id')->on('locals');
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {   
        Schema::table('locals', function (Blueprint $table) {
            $table->dropForeign(['localid']);
        });
        Schema::dropIfExists('mesas');
    }
}
