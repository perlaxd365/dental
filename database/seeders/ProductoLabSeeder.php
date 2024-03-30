<?php

namespace Database\Seeders;

use App\Models\ProductoLaboratorio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductoLabSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        ProductoLaboratorio::create([
            'nombre_producto_lab' => 'Producto de Laboratorio 1',
            'estado_producto_lab' => true,
            'id_empresa' => 1,
        ]);
        ProductoLaboratorio::create([
            'nombre_producto_lab' => 'Producto de Laboratorio 2',
            'estado_producto_lab' => true,
            'id_empresa' => 2,
        ]);
    }
}
