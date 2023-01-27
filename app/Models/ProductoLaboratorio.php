<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductoLaboratorio extends Model
{
    use HasFactory;
    protected $name = "nombre_laboratorios";
    protected $primaryKey = 'id_producto_lab';
    protected $fillable = [
        'nombre_producto_lab',
        'estado_producto_lab',
        'id_empresa',
    ];
}
