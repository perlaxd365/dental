<?php

namespace App\Http\Livewire\Venta;

use App\Models\Empresa;
use App\Models\Paciente;
use App\Models\Receta;
use App\Models\TipoProducto;
use App\Models\TipoUsuario;
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
    public $view = "create";
    public $show;
    public $table;

    public $carbon;
    public $permiso;
    //arrays
    public $empresa = [];
    public $pacientes = [];
    public $recetas = [];
    public $lista_detalle = [];
    public $tipo_productos = [];
    //pacientes

    //agregar paciente
    public
        $idpaciente,
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



    //DATOS DE DETALLE
    public $id_tipo_producto,
        $nombre_detalle,
        $cantidad_detalle,
        $unidad_detalle,
        $precio_unitario_detalle,
        $precio_total_detalle;

    //DATOS DE VENTA
    public $id_paciente,
        $id_venta,
        $igv_venta,
        $sub_total_venta,
        $total_venta,
        $subtotal_afectado;

    public function mount()
    {
        $this->carbon = new Carbon();
        $this->table = true;
        $this->tipo_productos = TipoProducto::where('estado', true)->get();
        $this->empresa = Empresa::find(auth()->user()->id_empresa);
    }
    public function render()
    {
        $this->pacientes = Paciente::where('estado', true)
            ->where('id_empresa', auth()->user()->id_empresa)->get();

        $this->permiso = TipoUsuario::find(auth()->user()->id_tipo_usuario);
        return view('livewire.venta.index');
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

    public function updatingIdpaciente($id_paciente)
    {
        $this->recetas = Receta::where('estado_rec', true)
            ->where("id_paciente", $id_paciente)->get();
    }

    public function showModalDetalle()
    {

        // show alert
        $this->dispatchBrowserEvent(
            'open-modal-venta',
            []
        );
    }
    public function closeModalDetalle()
    {

        // show alert
        $this->dispatchBrowserEvent(
            'close-modal-venta',
            []
        );
    }
    public function updatingPreciounitariodetalle($precio_unitario_detalle)
    {
        if ($precio_unitario_detalle != '' && $this->cantidad_detalle = !'') {
            # code...
            $this->precio_total_detalle = number_format($this->cantidad_detalle * $precio_unitario_detalle, 2, '.', '');
        }
    }

    public function updatingCantidaddetalle($cantidad_detalle)
    {
        if ($cantidad_detalle != '' && $this->precio_unitario_detalle != '') {
            # code...
            $this->precio_total_detalle = number_format($this->precio_unitario_detalle * $cantidad_detalle, 2, '.', '');
        }
    }

    public function defaultDetalle()
    {
        $this->id_tipo_producto = "";
        $this->nombre_detalle = "";
        $this->cantidad_detalle = "";
        $this->unidad_detalle = "";
        $this->precio_unitario_detalle = "";
        $this->precio_total_detalle = "";
    }

    public function addListaDetalle()
    {
        $messages = [
            'id_tipo_producto.required' => 'Por favor seleccionar el tipo se venta',
            'nombre_detalle.required' => 'Por favor introducir nombres del producto',
            'cantidad_detalle.required' => 'Por favor ingresar la cantidad de productos',
            'unidad_detalle.required' => 'Por favor seleccionar la unidad',
            'precio_unitario_detalle.required' => 'Por favor introducir el precio unitario ',
            'precio_total_detalle.required' => 'Por favor ingresar el precio total',
        ];

        $rules = [

            'id_tipo_producto' => 'required',
            'nombre_detalle' => 'required',
            'cantidad_detalle' => 'required',
            'unidad_detalle' => 'required',
            'precio_unitario_detalle' => 'required',
            'precio_total_detalle' => 'required',

        ];
        $this->validate($rules, $messages);

        array_push(
            $this->lista_detalle,
            array(
                'id_tipo_producto' => $this->id_tipo_producto,
                'nombre_detalle' => $this->nombre_detalle,
                'cantidad_detalle' => $this->cantidad_detalle,
                'unidad_detalle' => $this->unidad_detalle,
                'precio_unitario_detalle' => $this->precio_unitario_detalle,
                'precio_total_detalle' => $this->precio_total_detalle,
            )
        );
        $this->closeModalDetalle();
        $this->defaultDetalle();
        $this->calcularTotal();
    }

    public function calcularTotal()
    {
        $this->sub_total_venta = 0;
        foreach ($this->lista_detalle as $detalle) {
            # code...
            $this->sub_total_venta =  number_format($this->sub_total_venta + $detalle["precio_total_detalle"], 2, '.', '');
            $igv = $this->igv_venta / 100;
            $this->subtotal_afectado = $this->sub_total_venta * $igv;
            $subtotal = $this->sub_total_venta + $this->subtotal_afectado;
            $this->total_venta = number_format($subtotal, 2, '.', '');
        }
    }

    public function deleteProducto($id)
    {
        unset($this->lista_detalle[$id]);// show alert
        $this->dispatchBrowserEvent(
            'alert',
            ['type' => 'error', 'title' => 'Se removió el producto correctamente', 'message' => 'Exito']
        );
    }

    public function updatingIgvventa()
    {

        $this->calcularTotal();
    }
}
