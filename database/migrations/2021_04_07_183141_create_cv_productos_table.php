<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCVProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cv_productos', function (Blueprint $table) {
            $table->bigIncrements('cv_producto_id');
            $table->unsignedBigInteger('transaccion_id')->nullable(false);
            $table->unsignedBigInteger('producto_id')->nullable(false);
            $table->unsignedInteger('cantidad')->nullable(false);
            $table->unsignedDecimal('precio', 20, 3)->nullable(false);

            $table->foreign('transaccion_id')->references('transaccion_id')->on('transacciones');
            $table->foreign('producto_id')->references('producto_id')->on('productos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('c_v__productos');
    }
}
