<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    use HasFactory;
    protected $name = "promo";
    protected $primaryKey = 'id_promo';
    protected $fillable = [
        'nombre_promo',
        'precio_promo',
        'descripcion_promo',
    ];
}
