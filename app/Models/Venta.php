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
        'estado',
        'id_empresa'
    ];

}
