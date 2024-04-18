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
        Schema::create('empresas', function (Blueprint $table) {
            $table->bigIncrements('id_empresa');
            $table->string('nombre_comercial_empresa');
            $table->string('razon_social_empresa');
            $table->string('ruc_empresa');
            $table->string('email_empresa');
            $table->string('email_personal_empresa');
            $table->string('telefono_empresa');
            $table->string('direccion_empresa');
            $table->string('pagina_empresa');
            $table->string('key_empresa')->nullable();
            $table->string('logo_empresa');
            $table->string('tipo_soap_empresa');
            $table->string('envio_soap_empresa');
            $table->boolean('estado');
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
        Schema::dropIfExists('empresas');
    }
};
