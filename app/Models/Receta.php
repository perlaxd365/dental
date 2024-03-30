<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receta extends Model
{
    use HasFactory;
    protected $name = "recetas";
    protected $primaryKey = 'id_receta';
    protected $fillable = [
        'id_paciente',
        'id_ojo_derecho',
        'id_ojo_izquierdo',

        'astigmatismo_rec',
        'hipermetropia_rec',
        'miopia_rec',
        'presbicia_rec',
        'adicion_rec',
        'dip_lejos_rec',
        'dip_cerca_rec',
        'add_cerca_rec',
        'add_intermedio_rec',
        'naso_pupilar_od_rec',
        'oi_rec',

        'recomendacion_rec',
        'estado_rec',
        'id_empresa',
    ];
}
