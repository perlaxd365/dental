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
            "email_empresa"=>'perla@optica-facturito.tech',
            "email_personal_empresa"=>'perlaxd365@gmail.com',
            "telefono_empresa"=>'+51 905 455 807',
            "ruc_empresa"=>'2000000023',
            "key_empresa"=>'1234',
            "direccion_empresa"=>'Urb Garatea Mz H Lote 32',
            "pagina_empresa"=>'www.rpi.com',
            "logo_empresa"=>'assets/images/logo-icon.png',
            "tipo_soap_empresa"=>'Demo',
            "envio_soap_empresa"=>'SOAP',
            "estado"=>true
        ]);
        
        //
        Empresa::create([
            "nombre_comercial_empresa"=>'SHEYLA S.A.C.',
            "razon_social_empresa"=>"SHEYLA'S",
            "ruc_empresa"=>'200000024',
            "email_empresa"=>'sheyla@optica-facturito.tech',
            "email_personal_empresa"=>'sheyla@gmail.com',
            "telefono_empresa"=>'+51 944 455 447',
            "key_empresa"=>'5418169S23D.3',
            "direccion_empresa"=>'Urb ORDENOR',
            "pagina_empresa"=>'www.sheyla.com',
            "logo_empresa"=>'images/amengual.png',
            "tipo_soap_empresa"=>'Demo',
            "envio_soap_empresa"=>'SOAP',
            "estado"=>true
        ]); 
    }
}
