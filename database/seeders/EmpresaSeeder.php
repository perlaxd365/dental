<?php

namespace Database\Seeders;

use App\Models\Empresa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Empresa::create([
            "nombre_comercial_empresa"=>'RPI Solution E.I.R.L.',
            "razon_social_empresa"=>'RPI Solution',
            "ruc_empresa"=>'2000000023',
            "key_empresa"=>'1234',
            "direccion_empresa"=>'Urb Garatea Mz H Lote 32',
            "logo_empresa"=>'images/rpi.png',
            "tipo_soap_empresa"=>'Demo',
            "envio_soap_empresa"=>'SOAP',
            "estado"=>true
        ]);
    }
}
