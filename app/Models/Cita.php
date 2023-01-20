<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;
    protected $name = "citas";
    protected $primaryKey = 'id_cita';
    protected $fillable = [
        'id_paciente',
        'nro_historia_clinica',
        'fecha_inicio_cita',
        'fecha_fin_cita',
        'motivo_cita',
        'descripcion_cita',
        'color_cita',
        'estado',
        'id_empresa',
    ];
}
