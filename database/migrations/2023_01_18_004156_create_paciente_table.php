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
        Schema::create('pacientes', function (Blueprint $table) {
          
            $table->bigIncrements('id_paciente');
            $table->string('dni_paciente');
            $table->string('nombres_paciente');
            $table->string('direccion_paciente')->nullable();
            $table->string('estado_civil_paciente')->nullable();
            $table->string('sexo_paciente')->nullable();
            $table->string('fecha_nacimiento_paciente')->nullable();
            $table->string('edad_paciente')->nullable();
            $table->string('telefono_paciente')->nullable();
            $table->boolean('mayor_edad_paciente')->nullable();
            $table->string('grado_instruccion_paciente')->nullable();
            $table->string('ocupacion_paciente')->nullable();
            $table->string('dni_acompaniante_paciente')->nullable();
            $table->string('nombres_acompaniante_paciente')->nullable();
            $table->string('email_paciente')->nullable();
            $table->string('pais_paciente')->nullable();
            $table->string('departamento_paciente')->nullable();
            $table->string('provincia_paciente')->nullable();
            $table->string('distrito_paciente')->nullable();
            $table->boolean('estado');
            $table->string('id_empresa');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pacientes');
    }
};
