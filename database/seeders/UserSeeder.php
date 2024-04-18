<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            "id_empresa"=>'1',
            "id_tipo_usuario"=>'1',
            "name"=>'Cesar Raul Baca',
            "dni"=>'73888312', 
            "email"=>'perlaxd365@gmail.com',
            "password"=>bcrypt('12345678'),
            "estado"=>true,
        ])->assignRole('Administrador');
        date_default_timezone_set('America/Lima');

        User::create([
            "id_empresa"=>'2',
            "id_tipo_usuario"=>'2',
            "name"=>'Perla Nelly Garcia',
            "dni"=>'76432549', 
            "email"=>'sheyla@gmail.com',
            "password"=>bcrypt('123'),
            "estado"=>true,
        ])->assignRole('Administrador');
        date_default_timezone_set('America/Lima');

        User::create([
            "id_empresa"=>'2',
            "id_tipo_usuario"=>'3',
            "name"=>'Steven Baca Escurra',
            "dni"=>'89188985', 
            "email"=>'steven@gmail.com',
            "password"=>bcrypt('123'),
            "estado"=>true,
        ])->assignRole('Doctor');
        date_default_timezone_set('America/Lima');
    }
}
