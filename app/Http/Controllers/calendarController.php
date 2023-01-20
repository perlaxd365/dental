<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class calendarController extends Controller
{
    public function list($id_empresa)
    {
        $citas =
            Cita::select(
                DB::raw(
                    'id_cita as id,
                    motivo_cita as title,
                    descripcion_cita as description,
                    color_cita as color,
                    fecha_inicio_cita as start'
                )
            )->where('estado', true)->where('id_empresa', $id_empresa)->get();

        return  json_encode($citas);
    }
}
