<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;
    protected $name = "pagos";
    protected $primaryKey = 'id_pago';
    protected $fillable = [
        'id_empresa',
        'id_paciente',
        'numero_cuotas_pago',
        'monto_total_pago',
        'monto_abonado_pago',
        'estado_pago',
        'estado'
    ];
}
