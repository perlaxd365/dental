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
        Schema::create('citas', function (Blueprint $table) {
          
            $table->bigIncrements('id_cita');
            $table->unsignedBigInteger('id_paciente')->nullable()->comment('id del paciente');
            $table->string('nro_historia_clinica');
            $table->string('motivo_cita');
            $table->string('descripcion_cita');
            $table->string('color_cita');
            $table->string('fecha_inicio_cita');
            $table->string('fecha_fin_cita');
            $table->boolean('estado');
            $table->string('id_empresa');
            $table->timestamps();

            //foreign keys
            $table->foreign('id_paciente')->references('id_paciente')->on('pacientes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('citas');
    }
};
