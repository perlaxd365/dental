<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoProducto extends Model
{
    use HasFactory;
    protected $name = "tipo_productos";
    protected $primaryKey = 'id_tipo_producto';
    protected $fillable = [
        'nombre_tipo_producto',
        'estado',
    ];
}
