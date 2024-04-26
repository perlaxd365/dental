<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_venta_saldos', function (Blueprint $table) {
            $table->bigIncrements('id_detalle_venta');
            $table->unsignedBigInteger('id_venta')->comment('id de la venta');
            $table->unsignedBigInteger('id_tipo_producto')->comment('id del tipo de producto');
            $table->string('nombre_detalle')->comment('nombre del detalle de venta');
            $table->string('unidad_detalle')->comment('unidad del detalle de venta');
            $table->string('cantidad_detalle')->comment('cantidad del detalle de venta');
            $table->decimal('precio_unitario_detalle', 6, 2);
            $table->decimal('precio_total_detalle', 6, 2);
            
            $table->boolean('estado');
            $table->string('id_empresa');
            $table->timestamps();

            //claves foraneas
            $table->foreign('id_venta')->references('id_venta')->on('ventas');
            $table->foreign('id_tipo_producto')->references('id_tipo_producto')->on('tipo_productos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_ventas');
    }
};
