<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use Illuminate\Http\Request;

class citaController extends Controller
{
    //
    public function index()
    {
        return view('admin.cita.index');
    }

    public function store(Request $request)
    {
        $nro_historia_clinica = '';

        $last_nro_historia_clinica = Cita::latest()->first();
        if (isset($last_nro_historia_clinica->id_cita)) {
            $nro_historia_clinica = (str_pad($last_nro_historia_clinica->id_cita + 1, 6, '0', STR_PAD_LEFT));
        } else {
            $nro_historia_clinica = (str_pad(1, 6, '0', STR_PAD_LEFT));
        }

        $messages = [
            'id_paciente.required' => 'Por favor selecciona un paciente',
            'motivo_cita.required' => 'Por favor ingresa el motivo de la cita',
            'descripcion_cita.required' => 'Por favor ingresa la descripción de la cita',
            'color_cita.required' => 'Por favor selecciona un color para poder agendar la cita',
            'fecha_inicio_cita.required' => 'Por ingresa la fecha de inicio',
            'fecha_fin_cita.required' => 'Por ingresa la fecha de fina',
        ];

        $rules = [
            'id_paciente' => 'required',
            'motivo_cita' => 'required',
            'color_cita' => 'required',
            'fecha_inicio_cita' => 'required',
            'fecha_fin_cita' => 'required'

        ];

        $rules = [
            'id_paciente' => 'required',
            'motivo_cita' => 'required',
            'color_cita' => 'required',
            'fecha_inicio_cita' => 'required',
            'fecha_fin_cita' => 'required',
        ];








        $this->validate($request, $rules, $messages);

        Cita::create([
            'id_paciente' => $request->id_paciente,
            'nro_historia_clinica' => $nro_historia_clinica,
            'motivo_cita' => $request->motivo_cita,
            'descripcion_cita' => $request->descripcion_cita,
            'color_cita' => $request->color_cita,
            'fecha_inicio_cita' => $request->fecha_inicio_cita,
            'fecha_fin_cita' => $request->fecha_fin_cita,
            'estado' => true,
            'id_empresa' => auth()->user()->id_empresa,
        ]);

        /*
        // show alert
        $this->dispatchBrowserEvent(
            'alert',
            ['type' => 'success', 'title' => 'Se agendó la cita correctamente', 'message' => 'Exito']
        );
        // show alert
        $this->dispatchBrowserEvent(
            'update-calendar',
            []
        ); */

        return $request;
    }

    public function list(Request $request)
    {
        if(isset($request->id_cita)){
            return json_encode(Cita::join('pacientes', 'pacientes.id_paciente', 'citas.id_paciente')->where('citas.id_cita', $request->id_cita)->get());
        }
    }

    public function update(Request $request)
    {
    }
}
