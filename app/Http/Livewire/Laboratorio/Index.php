<?php

namespace App\Http\Livewire\Laboratorio;

use App\Models\Laboratorio;
use App\Models\Paciente;
use App\Models\ProductoLaboratorio;
use App\Models\TipoUsuario;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\WithPagination;
use PersonaUtil;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";
    public $search;
    public $show;
    public $table;
    public $view = "create";
    public $pacientes = [];
    public $productos_lab = [];
    public $doctores = [];


    //agregar paciente
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
        $distrito_paciente;
    //datos de laboratorio
    public
        $id_laboratiorio,
        $fecha_registro_lab,
        $fecha_recojo_lab,
        $id_producto_lab,
        $cantidad_lab,
        $costo_lab,
        $area_lab,
        $id_doctor,
        $observaciones_lab,
        $estado_lab;

    public $pieza = 'white';
    public function mount()
    {

        $this->pacientes = Paciente::where('estado', true)
            ->where('id_empresa', auth()->user()->id_empresa)->get();
        $this->mayor_edad_paciente = true;
        $this->show = 5;
        //productos de laboratorio
        $this->productos_lab = ProductoLaboratorio::where('id_empresa', auth()->user()->id_empresa)
            ->where('estado_producto_lab', true)
            ->get();
        //doctores
        $this->doctores = User::where('id_empresa', auth()->user()->id_empresa)->where('id_tipo_usuario', 2)->get();
        //fecha
        $this->fecha_registro_lab =  date('Y-m-d H:i:s');
        $this->table = true;
    }
    public function render()
    {
        $lista_laboratorios = Laboratorio::select('*')
            ->join('pacientes', 'pacientes.id_paciente', 'laboratorios.id_paciente')
            ->join('empresas', 'empresas.id_empresa', 'laboratorios.id_empresa')
            ->join('producto_laboratorios', 'producto_laboratorios.id_producto_lab', 'laboratorios.id_producto_lab')
            ->join('users', 'users.id', 'laboratorios.id_doctor');

        //verificamos el permiso si es admin para listar
        $permiso = TipoUsuario::find(auth()->user()->id_tipo_usuario);
        if ($permiso->nombre_tipo_usuario != 'Administrador') {
            $lista_laboratorios->where('empresas.id_empresa', auth()->user()->id_empresa);
        }
        $lista_laboratorios->where(function ($query) {
            return $query
                ->orwhere('nombres_paciente', 'LIKE', '%' . $this->search . '%')
                ->orwhere('nombre_producto_lab', 'LIKE', '%' . $this->search . '%');
        });
        $lista =  $lista_laboratorios->paginate($this->show);
        return view('livewire.laboratorio.index', compact('lista'));
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

        $this->defaultPaciente();
    }

    public function defaultPaciente()
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

    public function agregar()
    {

        $messages = [
            'id_paciente.required' => 'Por favor seleccionar al paciente',
            'fecha_registro.required' => 'Por favor ingresar la fecha de registro',
            'fecha_recojo.required' => 'Por favor ingresar la fecha de recojo',
            'id_producto_lab.required' => 'Por favor seleccionar el producto de laboratorio',
            'cantidad_lab.required' => 'Por favor ingresar la cantidad',
            'costo_lab.required' => 'Por favor ingresar el costo',
            'area_lab.required' => 'Por favor ingresar el área',
            'id_doctor.required' => 'Por favor seleccionar al doctor responsable',
            'estado_lab.required' => 'Por favor seleccionar estado del trabajo',
        ];

        $rules = [

            'id_paciente' => 'required',
            'fecha_registro_lab' => 'required',
            'fecha_recojo_lab' => 'required',
            'id_producto_lab' => 'required',
            'cantidad_lab' => 'required',
            'costo_lab' => 'required',
            'area_lab' => 'required',
            'id_doctor' => 'required',
            'estado_lab' => 'required',

        ];
        $this->validate($rules, $messages);

        Laboratorio::create([

            'id_paciente' => $this->id_paciente,
            'fecha_registro_lab' => $this->fecha_registro_lab,
            'fecha_recojo_lab' => $this->fecha_recojo_lab,
            'id_producto_lab' => $this->id_producto_lab,
            'cantidad_lab' => $this->cantidad_lab,
            'costo_lab' => $this->costo_lab,
            'area_lab' => $this->area_lab,
            'id_doctor' => $this->id_doctor,
            'estado_lab' => $this->estado_lab,
            'observaciones_lab' => $this->observaciones_lab,
            'id_empresa' => auth()->user()->id_empresa

        ]);
        // show alert
        $this->dispatchBrowserEvent(
            'alert',
            ['type' => 'success', 'title' => 'Se registró el trabajo de laboratorio correctamente', 'message' => 'Exito']
        );
        $this->default();
    }

    public function default()
    {
        $this->id_paciente = '';
        $this->fecha_registro_lab =  date('Y-m-d H:i:s');
        $this->fecha_recojo_lab = '';
        $this->id_producto_lab = '';
        $this->cantidad_lab = '';
        $this->costo_lab = '';
        $this->area_lab = '';
        $this->id_doctor = '';
        $this->estado_lab = '';
        $this->observaciones_lab = '';
        $this->view = "create";
        $this->table = true;
    }

    public function edit($id)
    {

        $laboratorio = Laboratorio::find($id);
        $this->view = "edit";
        $this->id_laboratiorio = $id;

        $this->id_paciente          =   $laboratorio->id_paciente;
        $this->fecha_registro_lab   =   $laboratorio->fecha_registro_lab;
        $this->fecha_recojo_lab     =   $laboratorio->fecha_recojo_lab;
        $this->id_producto_lab      =   $laboratorio->id_producto_lab;
        $this->cantidad_lab         =   $laboratorio->cantidad_lab;
        $this->costo_lab            =   $laboratorio->costo_lab;
        $this->area_lab             =   $laboratorio->area_lab;
        $this->id_doctor            =   $laboratorio->id_doctor;
        $this->estado_lab           =   $laboratorio->estado_lab;
        $this->observaciones_lab    =   $laboratorio->observaciones_lab;

        $this->table = false;
    }

    public function delete($id)
    {
        $laboratorio = Laboratorio::find($id);
        $laboratorio->delete();
        // show alert
        $this->dispatchBrowserEvent(
            'alert',
            ['type' => 'success', 'title' => 'Se eliminó el trabajo de laboratorio correctamente', 'message' => 'Exito']
        );
    }

    public function update()
    {
        $laboratorio = Laboratorio::find($this->id_laboratiorio);
        $laboratorio->update([

            'id_paciente' => $this->id_paciente,
            'fecha_registro_lab' => $this->fecha_registro_lab,
            'fecha_recojo_lab' => $this->fecha_recojo_lab,
            'id_producto_lab' => $this->id_producto_lab,
            'cantidad_lab' => $this->cantidad_lab,
            'costo_lab' => $this->costo_lab,
            'area_lab' => $this->area_lab,
            'id_doctor' => $this->id_doctor,
            'estado_lab' => $this->estado_lab,
            'observaciones_lab' => $this->observaciones_lab
        ]);
        // show alert
        $this->dispatchBrowserEvent(
            'alert',
            ['type' => 'success', 'title' => 'Se actualizó  el trabajo de laboratorio correctamente', 'message' => 'Exito']
        );
        $this->default();
    }

    public function hola($id)
    {
        dd($id);
        $this->pieza = 'red';
    }
}
