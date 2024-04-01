<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetallePago extends Model
{
    use HasFactory;
    protected $name = "detalle_pagos";
    protected $primaryKey = 'id_detalle_pago';
    protected $fillable = [
        'id_pago',
        'monto_detalle',
        'moneda_detalle',
        'tipo_cambio_detalle',
        'numero_telefono_detalle',
        'numero_transferencia_detalle',
        'numero_operación_pago',
        'observaciones_detalle',
        'estado_detalle',
        'estado'
    ];
    
}
