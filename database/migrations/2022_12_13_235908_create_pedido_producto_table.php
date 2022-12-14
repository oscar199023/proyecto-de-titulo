<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidoProductoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedido_producto', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pedido_id')->nullable()->unsigned();
            $table->integer('producto_id')->nullable()->unsigned();
            $table->integer('cantidad');
            $table->foreign('pedido_id')->references('id')->on('pedidos');
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
        Schema::table('pedidos', function (Blueprint $table) {
            $table->dropForeign(['pedido_id']);
        });
        Schema::table('productos', function (Blueprint $table) {
            $table->dropForeign(['producto_id']);
        });
        Schema::dropIfExists('pedido_producto');
    }
}
