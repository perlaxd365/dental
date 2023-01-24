<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

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


        return $request;
    }

    public function list(Request $request)
    {
        if (isset($request->id_cita)) {
            return json_encode(Cita::join('pacientes', 'pacientes.id_paciente', 'citas.id_paciente')->where('citas.id_cita', $request->id_cita)->where('citas.estado', true)->get());
        }
        if (isset($request->id)) {
            return json_encode(Cita::join('pacientes', 'pacientes.id_paciente', 'citas.id_paciente')->where('citas.id_cita', $request->id)->where('citas.estado', true)->get());
        }
    }

    public function update(Request $request)
    {

        if ($request->delete == "on") {

            $cita_update = Cita::find($request->id);
            $cita_update->update([
                'estado' => false,
            ]);

            return true;
        } else {


            $messages = [
                'id.required' => 'Por favor selecciona un paciente.',
                'title_update.required' => 'Por favor ingresa el motivo de la citas',
                'color_update.required' => 'Por favor selecciona un color para poder agendar la citas',
                'fecha_inicio_cita_update.required' => 'Por ingresa la fecha de inicio',
                'fecha_fin_cita_update.required' => 'Por ingresa la fecha final',
            ];

            $rules = [
                'id' => 'required',
                'title_update' => 'required',
                'color_update' => 'required',
                'fecha_inicio_cita_update' => 'required',
                'fecha_fin_cita_update' => 'required'

            ];


            $this->validate($request, $rules, $messages);

            $cita_update = Cita::find($request->id);
            $cita_update->update([
                'motivo_cita' => $request->title_update,
                'descripcion_cita' => $request->descripcion_cita_update,
                'color_cita' => $request->color_update,
                'fecha_inicio_cita' => $request->fecha_inicio_cita_update,
                'fecha_fin_cita' => $request->fecha_fin_cita_update,
            ]);


            return true;
        }
        return false;
    }

    public function print($id_cita)
    {
        $data = Cita::join('pacientes', 'pacientes.id_paciente', 'citas.id_paciente')->where('citas.id_cita', $id_cita)->where('citas.estado', true)->first();

        date_default_timezone_set('America/Lima');
        $date = Carbon::now();
        $pdf = Pdf::loadView('livewire.cita.print.invoice', compact('data','date'));
        return $pdf->stream();



        //perfil de pdf
        /*  $pdfContent = Pdf::loadView('livewire.cita.print.invoice', compact('data'))
            ->setPaper('A4', 'landscape')
            ->output();

        //fecha y hora 

        date_default_timezone_set('America/Lima');
        $date = Carbon::now();
        $date = $date->format('Y_m_d_H_s_A');

        //respuesta
        return response()->streamDownload(
            fn () => print($pdfContent),
            "cita" . $date . ".pdf"
        ); */
    }
}
