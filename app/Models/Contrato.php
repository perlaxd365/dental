<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
    use HasFactory;
    protected $name = "contratos";
    protected $primaryKey = 'id_contrato';
    protected $fillable = [
        'id_empresa',
        'id_pago',
        'id_promo',
        'fecha_inicio_contrato',
        'meses_contrato',
        'fecha_fin_contrato',
        'monto_total_contrato',
        'pdf_contrato_ruta_contrato',
        'cantidad_sucursales_contrato',
        'estado_contrato',
        'estado'
    ];

}
