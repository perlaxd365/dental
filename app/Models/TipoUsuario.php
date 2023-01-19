<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoUsuario extends Model
{
    use HasFactory;
    protected $name="tipo_usuario";
    protected $primaryKey = 'id_tipo_usuario';
    protected $fillable = [
        'id_tipo_usuario',
        'nombre_tipo_usuario',
        'estado',
    ];
}
