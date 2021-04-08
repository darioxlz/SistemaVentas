<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCuentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuentas', function (Blueprint $table) {
            $table->bigIncrements('cuenta_id');
            $table->unsignedBigInteger('cliente_id')->nullable(false);
            $table->enum('tipo', array('CPC', 'CPP'))->nullable(false);
            $table->string('descripcion')->nullable(false);
            $table->unsignedDecimal('monto', 20, 3)->nullable(false);
            $table->enum('estado', array('PENDIENTE', 'PAGADO'))->nullable(false);
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
        Schema::dropIfExists('cuentas');
    }
}
