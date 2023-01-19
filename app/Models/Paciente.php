<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;
    protected $name="pacientes";
    protected $primaryKey = 'id_paciente';
    protected $fillable = [
        'id_paciente',
        'dni_paciente',
        'nombres_paciente',
        'direccion_paciente',
        'estado_civil_paciente',
        'sexo_paciente',
        'fecha_nacimiento_paciente',
        'edad_paciente',
        'telefono_paciente',
        'mayor_edad_paciente',
        'grado_instruccion_paciente',
        'ocupacion_paciente',
        'dni_acompaniante_paciente',
        'nombres_acompaniante_paciente',
        'email_paciente',
        'pais_paciente',
        'departamento_paciente',
        'provincia_paciente',
        'distrito_paciente',
        'estado',
        'id_empresa',
    ];
}
