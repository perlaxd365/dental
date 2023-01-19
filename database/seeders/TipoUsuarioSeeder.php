<?php

namespace Database\Seeders;

use App\Models\TipoUsuario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoUsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        //
        TipoUsuario::create([
            "nombre_tipo_usuario"=>'Administrador',
            "estado"=>true
        ]);
        //
        TipoUsuario::create([
            "nombre_tipo_usuario"=>'Doctor',
            "estado"=>true
        ]);
        //
        TipoUsuario::create([
            "nombre_tipo_usuario"=>'Empleado',
            "estado"=>true
        ]);
        
    }
}
