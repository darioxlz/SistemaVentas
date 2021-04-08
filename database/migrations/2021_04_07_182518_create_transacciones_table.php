<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaccionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transacciones', function (Blueprint $table) {
            $table->bigIncrements('transaccion_id');
            $table->unsignedBigInteger('cliente_id')->nullable(false);
            $table->unsignedInteger('cantidad_productos')->nullable(false);
            $table->unsignedDecimal('monto_total', 30, 3)->nullable(false);
            $table->enum('tipo', array('COMPRA', 'VENTA'))->nullable(false);
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('creado_por')->nullable(false);

            $table->foreign('cliente_id')->references('cliente_id')->on('clientes');
            $table->foreign('creado_por')->references('usuario_id')->on('usuarios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaccions');
    }
}
