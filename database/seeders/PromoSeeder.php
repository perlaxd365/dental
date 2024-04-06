<?php

namespace Database\Seeders;

use App\Models\ProductoLaboratorio;
use App\Models\Promo;
use App\Models\TipoPago;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PromoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Promo::create([
            'nombre_promo'      => 'Promo 1',
            'descripcion_promo'  => 'Sistema de Óptica Web + Facturación electrónica Web',
            'precio_promo'      => '149.00',
            'estado' => true
        ]);
        //
        Promo::create([
            'nombre_promo'      => 'Promo 2',
            'descripcion_promo'  => 'Sistema de Óptica Web',
            'precio_promo'      => '99.00',
            'estado' => true
        ]);
        
        //
        Promo::create([
            'nombre_promo'      => 'Promo 3',
            'descripcion_promo'  => 'Sistema de Facturación Electrónica Web',
            'precio_promo'      => '99.00',
            'estado' => true
        ]);
    }
}
