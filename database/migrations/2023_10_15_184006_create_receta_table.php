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
        Schema::create('recetas', function (Blueprint $table) {
            $table->bigIncrements('id_receta');
            $table->unsignedBigInteger('id_paciente')->nullable()->comment('id del paciente');
            $table->unsignedBigInteger('id_ojo_derecho')->nullable()->comment('id del ojo derecho');
            $table->unsignedBigInteger('id_ojo_izquierdo')->nullable()->comment('id del ojo izquierdo');
            //datos
            $table->boolean('astigmatismo_rec')->nullable();
            $table->boolean('hipermetropia_rec')->nullable();
            $table->boolean('miopia_rec')->nullable();
            $table->boolean('presbicia_rec')->nullable();
            $table->string('adicion_rec')->nullable();
            $table->string('dip_lejos_rec')->nullable();
            $table->string('dip_cerca_rec')->nullable();
            $table->string('add_cerca_rec')->nullable();
            $table->string('add_intermedio_rec')->nullable();
            $table->string('naso_pupilar_od_rec')->nullable();
            $table->string('oi_rec')->nullable();
            $table->string('recomendacion_rec')->nullable();
            $table->string('pdf_rec')->nullable();
            $table->boolean('estado_rec');

            $table->string('id_empresa');
            $table->timestamps();

            //claves foraneas
            $table->foreign('id_paciente')->references('id_paciente')->on('pacientes');
            $table->foreign('id_ojo_derecho')->references('id_ojo_derecho')->on('ojo_derechos');
            $table->foreign('id_ojo_izquierdo')->references('id_ojo_izquierdo')->on('ojo_izquierdos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recetas');
    }
};
