<?php

namespace Database\Seeders;

use App\Models\Parametro;
use App\Models\ProductoLaboratorio;
use App\Models\TipoPago;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ParametroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //MONEDA
        Parametro::create([
            'parametro'         => 'MONEDA',
            'parametro_nombre'  => 'MONEDA SOLES',
            'valor'             => 1,
            'estado'            => true
        ]);

        Parametro::create([
            'parametro'         => 'MONEDA',
            'parametro_nombre'  => 'MONEDA DOLARES',
            'valor'             => 2,
            'estado'            => true
        ]);

        //ESTADOS DE CONTRATO
        Parametro::create([
            'parametro'         => 'ESTADO_CONTRATO',
            'parametro_nombre'  => 'CONTRATO INACTIVO',
            'valor'             => 1,
            'estado'            => true
        ]);
        Parametro::create([
            'parametro'         => 'ESTADO_CONTRATO',
            'parametro_nombre'  => 'CONTRATO ACTIVO',
            'valor'             => 2,
            'estado'            => true
        ]);
        Parametro::create([
            'parametro'         => 'ESTADO_CONTRATO',
            'parametro_nombre'  => 'CONTRATO A ESPERA DE PAGO',
            'valor'             => 3,
            'estado'            => true
        ]);
        Parametro::create([
            'parametro'         => 'ESTADO_CONTRATO',
            'parametro_nombre'  => 'CONTRATO FINALIZADO',
            'valor'             => 4,
            'estado'            => true
        ]);

        //ESTADOS DE PAGO DE EMPRESA
        Parametro::create([
            'parametro'         => 'ESTADO_PAGO',
            'parametro_nombre'  => 'PAGO COMPLETO',
            'valor'             => 1,
            'estado'            => true
        ]);
        Parametro::create([
            'parametro'         => 'ESTADO_PAGO',
            'parametro_nombre'  => 'PAGO INCOMPLETO',
            'valor'             => 2,
            'estado'            => true
        ]);
        Parametro::create([
            'parametro'         => 'ESTADO_PAGO',
            'parametro_nombre'  => 'SIN PAGO',
            'valor'             => 3,
            'estado'            => true
        ]);


        //ESTADOS DE DETALLE DE PAGO
        Parametro::create([
            'parametro'         => 'ESTADO_DETALLE_PAGO',
            'parametro_nombre'  => 'DETALLE PAGO COMPLETO',
            'valor'             => 1,
            'estado'            => true
        ]);
        Parametro::create([
            'parametro'         => 'ESTADO_DETALLE_PAGO',
            'parametro_nombre'  => 'DETALLE PAGO INCOMPLETO',
            'valor'             => 1,
            'estado'            => true
        ]);


        //NOMBREDS DE TIPO DE PRODUCTOS
        Parametro::create([
            'parametro'         => 'NOMBRE_TIPO_PRODUCTO_VENTA',
            'parametro_nombre'  => 'VARIOS',
            'valor'             => 1,
            'estado'            => true
        ]);
        Parametro::create([
            'parametro'         => 'NOMBRE_TIPO_PRODUCTO_VENTA',
            'parametro_nombre'  => 'ARMAZON',
            'valor'             => 2,
            'estado'            => true
        ]);
        Parametro::create([
            'parametro'         => 'NOMBRE_TIPO_PRODUCTO_VENTA',
            'parametro_nombre'  => 'LENTE',
            'valor'             => 3,
            'estado'            => true
        ]);
        Parametro::create([
            'parametro'         => 'NOMBRE_TIPO_PRODUCTO_VENTA',
            'parametro_nombre'  => 'MONTURA',
            'valor'             => 4,
            'estado'            => true
        ]);
    }
}
