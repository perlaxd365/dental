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
        Schema::create('detalle_venta_abonos', function (Blueprint $table) {
            $table->bigIncrements('id_detalle_venta_abono');
            $table->unsignedBigInteger('id_venta')->comment('id de la venta');
            $table->string('nombre_abono')->comment('nombre del abono');
            $table->string('tipo_pago_abono')->comment('nombre del tipo de pago abono');
            $table->decimal('monto_abono', 6, 2);
            
            $table->boolean('estado');
            $table->string('id_empresa');
            $table->timestamps();

            //claves foraneas
            $table->foreign('id_venta')->references('id_venta')->on('ventas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_venta_abonos');
    }
};
