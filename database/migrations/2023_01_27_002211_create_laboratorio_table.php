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
        Schema::create('laboratorios', function (Blueprint $table) {
            
            $table->bigIncrements('id_laboratorio');
            $table->unsignedBigInteger('id_producto_lab')->nullable()->comment('id del producto');
            $table->unsignedBigInteger('id_doctor')->nullable()->comment('id del doctor');
            $table->unsignedBigInteger('id_paciente')->nullable()->comment('id del paciente');
            //datos
            $table->string('fecha_registro_lab');
            $table->string('fecha_recojo_lab');
            $table->decimal('costo_lab',10,2);
            $table->integer('cantidad_lab');
            $table->string('area_lab');
            $table->string('observaciones_lab')->nullable();
            $table->string('estado_lab');

            $table->string('id_empresa');
            $table->timestamps();

            //foreign keys
            $table->foreign('id_paciente')->references('id_paciente')->on('pacientes');
            $table->foreign('id_producto_lab')->references('id_producto_lab')->on('producto_laboratorios');
            $table->foreign('id_doctor')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('laboratorios');
    }
};
