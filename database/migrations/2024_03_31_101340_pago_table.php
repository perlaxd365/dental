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
        //
        Schema::create('pagos', function (Blueprint $table) {
            //ids
            $table->bigIncrements('id_pago');
            $table->unsignedBigInteger('id_empresa')->comment('id de la empresa');
            $table->unsignedBigInteger('id_paciente')->nullable()->comment('id del paciente empresa');
            //datos
            $table->integer('numero_cuotas_pago')->nullable();
            $table->decimal('monto_total_pago', 8, 2)->nullable();
            $table->decimal('monto_abonado_pago', 8, 2)->nullable();
            $table->boolean('estado_pago');
            $table->timestamps();
            $table->boolean('estado');

            //claves foraneas
            $table->foreign('id_empresa')->references('id_empresa')->on('empresas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('pagos');
    }
};
