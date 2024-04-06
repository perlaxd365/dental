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
        Schema::create('contratos', function (Blueprint $table) {
            $table->bigIncrements('id_contrato');
            $table->unsignedBigInteger('id_empresa')->comment('id de la empresa');
            $table->unsignedBigInteger('id_pago')->nullable()->comment('id de la empresa');
            $table->unsignedBigInteger('id_promo')->nullable()->comment('id de la promo');
            //datos
            $table->string('fecha_inicio_contrato');
            $table->string('meses_contrato');
            $table->string('fecha_fin_contrato');
            $table->decimal('monto_total_contrato');
            $table->string('cantidad_sucursales_contrato');
            $table->string('pdf_contrato_ruta_contrato');
            $table->integer('estado_contrato');

            
            $table->timestamps();
            $table->boolean('estado');

            //claves foraneas
            $table->foreign('id_empresa')->references('id_empresa')->on('empresas');
            $table->foreign('id_promo')->references('id_promo')->on('promos');
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
        Schema::dropIfExists('contratos');
    }
};
