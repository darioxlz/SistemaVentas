<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->bigIncrements('cliente_id');
            $table->string('nombre')->nullable(false);
            $table->enum('tipo_documento', array('CEDULA', 'RIF'))->nullable(false);
            $table->string('documento')->nullable(false);
            $table->string('telefono')->nullable(true);
            $table->string('correo')->nullable(true);
            $table->string('descripcion')->nullable(true);
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('creado_por')->nullable(false);

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
        Schema::dropIfExists('clientes');
    }
}
