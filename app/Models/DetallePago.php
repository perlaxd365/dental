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
        'id_tipo_pago',
        'monto_detalle',
        'moneda_detalle',
        'tipo_cambio_detalle',
        'nombre_completo_detalle',
        'numero_cuota_detalle',
        'numero_telefono_detalle',
        'numero_transferencia_detalle',
        'numero_operacion_detalle',
        'fecha_fin_detalle',
        'observaciones_detalle',
        'notificacion_detalle',
        'adjunto_detalle',
        'fecha_notificacion_detalle',
        'estado_detalle',
        'estado'
    ];
}
