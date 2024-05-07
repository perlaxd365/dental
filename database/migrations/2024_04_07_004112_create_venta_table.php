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
        Schema::create('ventas', function (Blueprint $table) {
            $table->bigIncrements('id_venta');
            $table->unsignedBigInteger('id_paciente')->comment('id del paciente');
            $table->unsignedBigInteger('id_receta')->nullable()->comment('id de la receta');
            $table->decimal('sub_total_venta', 6, 2);
            $table->decimal('igv_venta', 6, 2)->nullable();
            $table->decimal('total_venta', 6, 2);
            $table->decimal('monto_abonado_venta', 6, 2)->nullable();
            $table->decimal('monto_restante_venta', 6, 2)->nullable();

            $table->boolean('producto_entregado_venta')->nullable();
            $table->boolean('pago_completado_venta')->nullable();
            $table->boolean('saldo_venta')->nullable();
            $table->boolean('estado');
            $table->string('id_empresa');
            $table->timestamps();

            //claves foraneas
            $table->foreign('id_paciente')->references('id_paciente')->on('pacientes');
            $table->foreign('id_receta')->references('id_receta')->on('recetas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ventas');
    }
};
