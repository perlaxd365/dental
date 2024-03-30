<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OjoIzquierdo extends Model
{
    use HasFactory;
    protected $name = "ojo_izquierdo";
    protected $primaryKey = 'id_ojo_izquierdo';
    protected $fillable = [
        'esfera_izquierdo',
        'cilindro_izquierdo',
        'eje_izquierdo',
        'agudeza_visual_izquierdo',
        'dp_izquierdo',
        'estado_izquierdo',
        'id_empresa',
    ];
}
