<?php

namespace App\Http\Livewire\Paciente;

use App\Models\Paciente;
use App\Models\TipoUsuario;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\WithPagination;
use PersonaUtil;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";
    public $search;
    public $view = "create";
    public $show;
    public $table;

    public
        $idpaciente,
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
        $distrito_paciente,
        $estado;

    public function mount()
    {
        $this->pais_paciente = "Perú";
        $this->table = true;
        $this->estado = true;
        $this->mayor_edad_paciente = true;
        $this->show = 5;
    }

    public function render()
    {
        $lista_pacientes = Paciente::select('*');

        //verificamos el permiso si es admin para listar
        $permiso = TipoUsuario::find(auth()->user()->id_tipo_usuario);
        if ($permiso->nombre_tipo_usuario != 'Administrador') {
            $lista_pacientes->where('id_empresa', auth()->user()->id_empresa);
        }else{
            
            $lista_pacientes->where('id_empresa', auth()->user()->id_empresa);
        }
        $lista_pacientes->where(function ($query) {
            return $query
                ->orwhere('nombres_paciente', 'LIKE', '%' . $this->search . '%');
        });
        $lista =  $lista_pacientes->paginate($this->show);
        return view('livewire.paciente.index', compact('lista'));
    }


    public function buscarDNI()
    {
        $data_dni = PersonaUtil::getDni($this->dni_paciente);

        if ($data_dni["error"]) {
            $this->dispatchBrowserEvent(
                'alert',
                ['type' => 'error', 'title' => $data_dni["error"], 'message' => 'Error']
            );
        } else {
            $datos = json_decode($data_dni["response"], true);
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
        $verificar_paciente = Paciente::where('dni_paciente', $this->dni_paciente)->where('id_empresa', auth()->user()->id_empresa)->first();
        if ($verificar_paciente) {
            $this->dispatchBrowserEvent(
                'alert',
                ['type' => 'error', 'title' => 'El paciente ya se encuentra registrado', 'message' => 'Error']
            );
            throw ValidationException::withMessages(['dni_paciente' => 'Dni ya se encuentra agregado.']);
        }
        //verificar si existe dni
        

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
        $this->pais_paciente = "Perú";
        $this->departamento_paciente = "";
        $this->provincia_paciente = "";
        $this->distrito_paciente = "";
        $this->view = "create";
        $this->table = true;
    }
    public function edit($id)
    {
        $this->table = false;
        $this->id_paciente = $id;
        $paciente = Paciente::find($id);

        $this->view = "edit";
        $this->dni_paciente                 = $paciente->dni_paciente;
        $this->nombres_paciente             = $paciente->nombres_paciente;
        $this->direccion_paciente           = $paciente->direccion_paciente;
        $this->estado_civil_paciente        = $paciente->estado_civil_paciente;
        $this->sexo_paciente                = $paciente->sexo_paciente;
        $this->fecha_nacimiento_paciente    = $paciente->fecha_nacimiento_paciente;
        $this->edad_paciente                = $paciente->edad_paciente;
        $this->telefono_paciente            = $paciente->telefono_paciente;
        $this->mayor_edad_paciente          = $paciente->mayor_edad_paciente;
        $this->grado_instruccion_paciente   = $paciente->grado_instruccion_paciente;
        $this->ocupacion_paciente           = $paciente->ocupacion_paciente;
        $this->dni_acompaniante_paciente    = $paciente->dni_acompaniante_paciente;
        $this->nombres_acompaniante_paciente = $paciente->nombres_acompaniante_paciente;
        $this->email_paciente               = $paciente->email_paciente;
        $this->pais_paciente                = $paciente->pais_paciente;
        $this->departamento_paciente        = $paciente->departamento_paciente;
        $this->provincia_paciente           = $paciente->provincia_paciente;
        $this->distrito_paciente            = $paciente->distrito_paciente;
        $this->estado                       = $paciente->estado;
        $this->resetErrorBag();
        $this->resetValidation();
    }

    
    public function update()
    {
        $laboratorio = Paciente::find($this->id_paciente);
        $laboratorio->update([
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
            'estado'  => $this->estado,
        ]);
        // show alert
        $this->dispatchBrowserEvent(
            'alert',
            ['type' => 'success', 'title' => 'El paciente se actualizó correctamente', 'message' => 'Exito']
        );
        $this->default();
    }


    public function delete($id)
    {
        $paciente = Paciente::find($id);
        $paciente->update([
            'estado' => false
        ]);
        // show alert
        $this->dispatchBrowserEvent(
            'alert',
            ['type' => 'warning', 'title' => 'Se eliminó al paciente correctamente ', 'message' => 'Exito']
        );
    }
}
