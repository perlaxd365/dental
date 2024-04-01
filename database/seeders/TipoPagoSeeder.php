<?php

namespace Database\Seeders;

use App\Models\ProductoLaboratorio;
use App\Models\TipoPago;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoPagoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        TipoPago::create([
            'nombre_tipo_pago' => 'Efectivo',
            'estado' => true
        ]);
        TipoPago::create([
            'nombre_tipo_pago' => 'Yape',
            'estado' => true
        ]);
        TipoPago::create([
            'nombre_tipo_pago' => 'Plin',
            'estado' => true
        ]);
        TipoPago::create([
            'nombre_tipo_pago' => 'Transferencia',
            'estado' => true
        ]);
    }
}
