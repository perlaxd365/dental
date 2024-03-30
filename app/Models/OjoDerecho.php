<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OjoDerecho extends Model
{
    use HasFactory;
    protected $name = "ojo_derecho";
    protected $primaryKey = 'id_ojo_derecho';
    protected $fillable = [
        'esfera_derecho',
        'cilindro_derecho',
        'eje_derecho',
        'agudeza_visual_derecho',
        'dp_derecho',
        'estado_derecho',
        'id_empresa',
    ];
    
}
