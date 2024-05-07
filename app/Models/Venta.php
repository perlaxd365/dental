<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;
    protected $name = "ventas";
    protected $primaryKey = 'id_venta';
    protected $fillable = [
        'id_paciente',
        'id_receta',
        'sub_total_venta',
        'igv_venta',
        'total_venta',
        'monto_abonado_venta',
        'monto_restante_venta',
        'producto_entregado_venta',
        'pago_completado_venta',
        'saldo_venta',
        'estado',
        'id_empresa'
    ];
    

}
