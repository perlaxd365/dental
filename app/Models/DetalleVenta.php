<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    use HasFactory;
    protected $name = "detalle_ventas";
    protected $primaryKey = 'id_detalle_venta';
    protected $fillable = [
        'id_venta',
        'id_tipo_producto',
        'nombre_detalle',
        'unidad_detalle',
        'cantidad_detalle',
        'precio_unitario_detalle',
        'precio_total_detalle',
        'id_empresa',
        'estado',
        'id_empresa'
    ];
}
