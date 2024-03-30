<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;
    protected $name="empresas";
    protected $primaryKey = 'id_empresa';
    protected $fillable = [
        'nombre_comercial_empresa',
        'razon_social_empresa',
        'ruc_empresa',
        'key_empresa',
        'email_empresa',
        'direccion_empresa',
        'logo_empresa',
        'tipo_soap_empresa',
        'envio_soap_empresa',
        'estado',
    ];
}
