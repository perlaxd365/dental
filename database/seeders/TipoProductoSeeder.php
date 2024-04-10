<?php

namespace Database\Seeders;

use App\Models\ProductoLaboratorio;
use App\Models\TipoPago;
use App\Models\TipoProducto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        TipoProducto::create([
            'nombre_tipo_producto' => 'Varios',
            'estado' => true
        ]);
        TipoProducto::create([
            'nombre_tipo_producto' => 'Armazon',
            'estado' => true
        ]);
        
        TipoProducto::create([
            'nombre_tipo_producto' => 'Lente',
            'estado' => true
        ]);
        
        TipoProducto::create([
            'nombre_tipo_producto' => 'Montura',
            'estado' => true
        ]);
        
        TipoProducto::create([
            'nombre_tipo_producto' => 'Refracción',
            'estado' => true
        ]);
        
    }
}
