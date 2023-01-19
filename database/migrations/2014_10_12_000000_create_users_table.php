<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_empresa')->nullable()->comment('id de empresa');
            $table->unsignedBigInteger('id_tipo_usuario')->nullable()->comment('id de tipo_usuarios');
            $table->string('name');
            $table->string('dni');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->boolean('estado');
            $table->timestamps();
            $table->foreign('id_empresa')->references('id_empresa')->on('empresas');
            $table->foreign('id_tipo_usuario')->references('id_tipo_usuario')->on('tipo_usuarios');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
