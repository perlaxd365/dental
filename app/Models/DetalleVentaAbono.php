<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleVentaAbono extends Model
{
    use HasFactory;
    protected $name = "detalle_venta_abonos";
    protected $primaryKey = 'id_detalle_venta_abono';
    protected $fillable = [
        'id_venta',
        'nombre_abono',
        'tipo_pago_abono',
        'monto_abono',
        'id_empresa',
        'created_at',
        'estado'
    ];
}
