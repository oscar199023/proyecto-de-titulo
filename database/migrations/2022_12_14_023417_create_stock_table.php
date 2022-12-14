<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('local_id')->nullable()->unsigned();
            $table->integer('producto_id')->nullable()->unsigned();
            $table->integer('cantidad');
            $table->boolean('activo');
            $table->foreign('local_id')->references('id')->on('locals');
            $table->foreign('producto_id')->references('id')->on('productos');
            
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
            $table->dropForeign(['local_id']);
        });
        Schema::table('productos', function (Blueprint $table) {
            $table->dropForeign(['producto_id']);
        });
        Schema::dropIfExists('stock');
    }
}
