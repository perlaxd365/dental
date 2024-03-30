<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laboratorio extends Model
{
    
    use HasFactory;
    protected $name = "laboratorios";
    protected $primaryKey = 'id_laboratorio';
    protected $fillable = [
        'id_paciente',
        'id_doctor',
        'id_producto_lab',
        'fecha_registro_lab',
        'fecha_recojo_lab',
        'costo_lab',
        'cantidad_lab',
        'area_lab',
        'observaciones_lab',
        'estado_lab',
        'id_empresa',
    ];
}
