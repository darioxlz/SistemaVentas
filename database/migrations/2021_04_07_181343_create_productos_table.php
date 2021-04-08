<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->bigIncrements('producto_id');
            $table->string('descripcion')->nullable(false);
            $table->unsignedInteger('stock')->nullable(false);
            $table->unsignedDouble('precio', 20, 3)->nullable(false);
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
        Schema::dropIfExists('productos');
    }
}
