<?php

namespace App\Http\Livewire\Cita;

use App\Models\Cita;
use App\Models\Paciente;
use Livewire\Component;

class CitaIndex extends Component
{
    public $pacientes = [];
    public
        $id_paciente,
        $dni_paciente,
        $nombres_paciente,
        $direccion_paciente,
        $estado_civil_paciente,
        $sexo_paciente,
        $fecha_nacimiento_paciente,
        $edad_paciente,
        $telefono_paciente,
        $mayor_edad_paciente,
        $grado_instruccion_paciente,
        $ocupacion_paciente,
        $dni_acompaniante_paciente,
        $nombres_acompaniante_paciente,
        $email_paciente,
        $pais_paciente,
        $departamento_paciente,
        $provincia_paciente,
        $distrito_paciente;

    //cita
    public
        $nro_historia_clinica,
        $fecha_inicio_cita,
        $fecha_fin_cita,
        $motivo_cita,
        $descripcion_cita,
        $color_cita,
        $citas;
    public function mount()
    {
        $this->pacientes = Paciente::where('estado', true)->get();
        $this->mayor_edad_paciente = true;
    }
    public function render()
    {
        return view('livewire.cita.cita-index');
    }

    public function buscarDNI()
    {
        $curl = curl_init();
        $dni = $this->dni_paciente;
        //$headers = array("authorization: token d2617b5f616372dd5dc28f7df1b2647cbf6d7c698d2fa0bec4a169b4bbb97b0f");
        $token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6InBlcmxheGQzNjVAZ21haWwuY29tIn0.3j6QnXgLgOToXNsBWCe-UTHyWl7IAHgIo-zZZGi_IaE";
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://dniruc.apisperu.com/api/v1/dni/{$dni}?token={$token}",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_SSL_VERIFYPEER => false,
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $datos = json_decode($response, true);
            if ($datos != null) {
                $nombres =  $datos["nombres"] . " " . $datos["apellidoPaterno"] . " " . $datos["apellidoMaterno"];
                $this->dispatchBrowserEvent(
                    'alert',
                    ['type' => 'success', 'title' => $nombres, 'message' => 'Exito']
                );
                $this->nombres_paciente = $nombres;
            } else {
                $this->dispatchBrowserEvent(
                    'alert',
                    ['type' => 'error', 'title' => 'No se encontraron resultados ', 'message' => 'Error']
                );
            }
        }
    }

    public function agregarPaciente()
    {

        $messages = [
            'dni_paciente.required' => 'Por favor introduce el dni del paciente',
            'nombres_paciente.required' => 'Por favor introducir nombres del paciente',
        ];

        $rules = [


            'dni_paciente' => 'required',
            'nombres_paciente' => 'required',

        ];
        $this->validate($rules, $messages);

        $paciente = Paciente::create([
            'dni_paciente' => $this->dni_paciente,
            'nombres_paciente'  => $this->nombres_paciente,
            'direccion_paciente'  => $this->direccion_paciente,
            'estado_civil_paciente'  => $this->estado_civil_paciente,
            'sexo_paciente'  => $this->sexo_paciente,
            'fecha_nacimiento_paciente'  => $this->fecha_nacimiento_paciente,
            'edad_paciente'  => $this->edad_paciente,
            'telefono_paciente'  => $this->telefono_paciente,
            'mayor_edad_paciente'  => $this->mayor_edad_paciente,
            'grado_instruccion_paciente'  => $this->grado_instruccion_paciente,
            'ocupacion_paciente'  => $this->ocupacion_paciente,
            'dni_acompaniante_paciente'  => $this->dni_acompaniante_paciente,
            'nombres_acompaniante_paciente'  => $this->nombres_acompaniante_paciente,
            'email_paciente'  => $this->email_paciente,
            'pais_paciente'  => $this->pais_paciente,
            'departamento_paciente'  => $this->departamento_paciente,
            'provincia_paciente'  => $this->provincia_paciente,
            'distrito_paciente'  => $this->distrito_paciente,
            'estado'  => true,
            'id_empresa' => auth()->user()->id_empresa

        ]);

        // show alert
        $this->dispatchBrowserEvent(
            'alert',
            ['type' => 'success', 'title' => 'Se guardó al paciente correctamente', 'message' => 'Exito']
        );
        // show alert
        $this->dispatchBrowserEvent(
            'close-modal-paciente',
            []
        );

        // show alert
        $this->dispatchBrowserEvent(
            'data',
            ['id_paciente' => $paciente->id_paciente, 'nombres_paciente' => $paciente->nombres_paciente]
        );

        $this->default();
    }

    public function default()
    {
        $this->dni_paciente = "";
        $this->nombres_paciente = "";
        $this->direccion_paciente = "";
        $this->estado_civil_paciente = "";
        $this->sexo_paciente = "";
        $this->fecha_nacimiento_paciente = "";
        $this->edad_paciente = "";
        $this->telefono_paciente = "";
        $this->mayor_edad_paciente = true;
        $this->grado_instruccion_paciente = "";
        $this->ocupacion_paciente = "";
        $this->dni_acompaniante_paciente = "";
        $this->nombres_acompaniante_paciente = "";
        $this->email_paciente = "";
        $this->pais_paciente = "";
        $this->departamento_paciente = "";
        $this->provincia_paciente = "";
        $this->distrito_paciente = "";
    }

    public function agregarCita()
    {
        $last_nro_historia_clinica = Cita::latest()->first();
        $this->nro_historia_clinica = (str_pad($last_nro_historia_clinica->id_cita + 1, 6, '0', STR_PAD_LEFT));

        $messages = [
            'id_paciente.required' => 'Por favor selecciona un paciente',
            'nro_historia_clinica.required' => 'Por favor generar un numero de historia clinica',
            'motivo_cita.required' => 'Por favor ingresa el motivo de la cita',
            'descripcion_cita.required' => 'Por favor ingresa la descripció de la cita',
            'color_cita.required' => 'Por selecciona un color para poder agendar la cita',
            'fecha_inicio_cita.required' => 'Por ingresa la fecha de inicio',
            'fecha_fin_cita.required' => 'Por ingresa la fecha de fina',
        ];

        $rules = [
            'id_paciente' => 'required',
            'nro_historia_clinica' => 'required',
            'motivo_cita' => 'required',
            'descripcion_cita' => 'required',
            'color_cita' => 'required',
            'fecha_inicio_cita' => 'required',
            'fecha_fin_cita' => 'required'

        ];
        $this->validate($rules, $messages);

        $paciente = Cita::create([
            'id_paciente' => $this->id_paciente,
            'nro_historia_clinica' => $this->nro_historia_clinica,
            'motivo_cita' => $this->motivo_cita,
            'descripcion_cita' => $this->descripcion_cita,
            'color_cita' => $this->color_cita,
            'fecha_inicio_cita' => $this->fecha_inicio_cita,
            'fecha_fin_cita' => $this->fecha_fin_cita,
            'estado' => true,
            'id_empresa' => auth()->user()->id_empresa,
        ]);
        // show alert
        $this->dispatchBrowserEvent(
            'alert',
            ['type' => 'success', 'title' => 'Se agendó la cita correctamente', 'message' => 'Exito']
        );
        // show alert
        $this->dispatchBrowserEvent(
            'update-calendar',
            []
        );
    }
}
