<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoPago extends Model
{
    use HasFactory;
    protected $name = "tipo_pagos";
    protected $primaryKey = 'id_tipo_pago';
    protected $fillable = [
        'nomnbre_tipo_pago',
        'estado'
    ];
}
