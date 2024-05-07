<?php

namespace App\Http\Livewire\Venta;

use App\Models\DetalleVenta;
use App\Models\DetalleVentaAbono;
use App\Models\Empresa;
use App\Models\Paciente;
use App\Models\Receta;
use App\Models\TipoPago;
use App\Models\TipoProducto;
use App\Models\TipoUsuario;
use App\Models\Venta;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\WithPagination;
use PersonaUtil;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class Index extends Component
{

    use WithPagination;
    protected $paginationTheme = "bootstrap";
    public $search,
        $fecha_inicio_venta_search,
        $fecha_fin_venta_search;
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
    public $tipos_pagos = [];
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
        $id_receta,
        $igv_venta,
        $sub_total_venta,
        $total_venta,
        $subtotal_afectado;

    public $paciente_delete,
        $subtotal_delete,
        $igv_delete,
        $total_delete,
        $detalle_delete;

    // VENTA
    public $monto_abonado_venta,
        $monto_restante_venta,
        $producto_entregado_venta,
        $pago_completado_venta,
        $saldo_venta;

    //DETALLE PAGOS VENTA ABONOS
    public $paciente_fin_venta,
        $nombre_abono,
        $tipo_pago_abono,
        $monto_abono,
        $show_abono;

    public function mount()
    {
        $this->carbon = new Carbon();
        $this->table = true;
        $this->show = 6;
        $this->tipo_productos = TipoProducto::where('estado', true)->get();
        $this->tipos_pagos = TipoPago::where('estado', true)->get();
        $this->empresa = Empresa::find(auth()->user()->id_empresa);
        //finalizar venta
        $this->unidad_detalle = "Unidad";
        $this->producto_entregado_venta = true;
        $this->pago_completado_venta = true;
        $this->show_abono = false;
    }
    public function render()
    {
        $this->pacientes = Paciente::where('estado', true)
            ->where('id_empresa', auth()->user()->id_empresa)->get();

        $this->permiso = TipoUsuario::find(auth()->user()->id_tipo_usuario);

        $lista_ventas = Venta::select(DB::raw(
            "*,ventas.created_at as fecha_venta"
        ))
            ->join('pacientes', 'ventas.id_paciente', 'pacientes.id_paciente')
            ->join('empresas', 'empresas.id_empresa', 'ventas.id_empresa')
            ->where('ventas.estado', true)
            ->orderby('id_venta', 'desc');

        //verificamos el permiso si es admin para listar
        if ($this->permiso->nombre_tipo_usuario != 'Administrador') {
            $lista_ventas->where('empresas.id_empresa', auth()->user()->id_empresa);
        }
        $lista_ventas->where(function ($query) {
            return $query
                ->orwhere('nombres_paciente', 'LIKE', '%' . $this->search . '%')
                ->orwhere('dni_paciente', 'LIKE', '%' . $this->search . '%');
        });

        $lista_ventas->where(function ($query) {
            if ($this->fecha_inicio_venta_search && !$this->fecha_fin_venta_search) {
                return $query

                    ->where('ventas.created_at', '>=', '' . $this->fecha_inicio_venta_search . '');
            }
            if ($this->fecha_fin_venta_search && !$this->fecha_inicio_venta_search) {
                return $query

                    ->where('ventas.created_at', '<=', '' . $this->fecha_fin_venta_search . '');
            }
            if ($this->fecha_inicio_venta_search && $this->fecha_fin_venta_search) {
                return $query

                    ->where('ventas.created_at', '>=', '' . $this->fecha_inicio_venta_search . '')
                    ->where('ventas.created_at', '<=', '' . $this->fecha_fin_venta_search . '');
            }
        });

        $lista =  $lista_ventas->paginate($this->show);

        return view('livewire.venta.index', compact('lista'));
    }

    public function listaDetalle($id_venta)
    {
        return DetalleVenta::where("id_venta", $id_venta)->where("estado", true)->get();
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
    public function defaultVenta()
    {
        $this->id_receta = "";
        $this->igv_venta = "";
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
            $igv = ($this->igv_venta) ? $this->igv_venta / 100 : 0;
            $this->subtotal_afectado = $this->sub_total_venta * $igv;
            $subtotal = $this->sub_total_venta + $this->subtotal_afectado;
            $this->total_venta = number_format($subtotal, 2, '.', '');
        }
    }

    public function deleteProducto($id)
    {
        unset($this->lista_detalle[$id]); // show alert
        $this->dispatchBrowserEvent(
            'alert',
            ['type' => 'info', 'title' => 'Se removió el producto correctamente', 'message' => 'Exito']
        );
    }

    public function updatingIgvventa($igv)
    {
        if ($igv != '') {

            $this->igv_venta = $igv;
            $this->calcularTotal();
        }
    }

    public function guardar_venta()
    {
        try {
            $messages = [
                'id_paciente.required' => 'Por favor seleccionar el paciente para la venta',
            ];

            $rules = [

                'id_paciente' => 'required',

            ];
            $this->validate($rules, $messages);

            $venta = Venta::create([

                'id_paciente'               => $this->id_paciente,
                'id_receta'                 => ($this->id_receta) ? $this->id_receta : null,
                'sub_total_venta'           => $this->sub_total_venta,
                'igv_venta'                 => ($this->igv_venta) ? $this->igv_venta : null,
                'total_venta'               => $this->total_venta,
                'monto_abonado_venta'       => ($this->monto_abono) ? $this->monto_abono : 0,
                'monto_restante_venta'      => $this->monto_restante_venta,
                'producto_entregado_venta'  => $this->producto_entregado_venta,
                'pago_completado_venta'     => $this->pago_completado_venta,
                'saldo_venta'               => ($this->pago_completado_venta) ? false : true,
                'estado'                    => true,
                'id_empresa'                => auth()->user()->id_empresa
            ]);
            $this->id_venta = $venta->id_venta;
            foreach ($this->lista_detalle as $detalle) {
                # code...

                DetalleVenta::create([
                    'id_venta' => $venta->id_venta,
                    'id_tipo_producto' => $detalle["id_tipo_producto"],
                    'nombre_detalle' => $detalle["nombre_detalle"],
                    'unidad_detalle' => $detalle["unidad_detalle"],
                    'cantidad_detalle' => $detalle["cantidad_detalle"],
                    'precio_unitario_detalle' => $detalle["precio_unitario_detalle"],
                    'precio_total_detalle' => $detalle["precio_total_detalle"],
                    'id_empresa' => auth()->user()->id_empresa,
                    'estado' => true,
                ]);
            }

            if ($this->show_abono) {
                $messages2 = [
                    'nombre_abono.required' => 'Por favor ingresar nombre',
                    'tipo_pago_abono.required' => 'Por favor seleccionar el tipo de pago',
                    'monto_abono.required' => 'Por favor ingresar el monto abonado',
                ];

                $rules2 = [

                    'id_paciente' => 'required',
                    'tipo_pago_abono' => 'required',
                    'monto_abono' => 'required',

                ];
                $ver = $this->validate($rules2, $messages2);
             
                DetalleVentaAbono::create([
                    'id_venta' => $venta->id_venta,
                    'nombre_abono' =>  $this->nombre_abono,
                    'monto_abono' => $this->monto_abono,
                    'tipo_pago_abono' => $this->tipo_pago_abono,
                    'id_empresa' => auth()->user()->id_empresa,
                    'estado' => true,
                ]);
                $this->closeModalFinalizarVenta();
                DB::commit();
            } else {
                DB::commit();
            }

            $this->closeModalFinalizarVenta();
        } catch (\Throwable $th) {
            //throw $th;
            Venta::find($venta->id_venta)->update(['estado' => false]);

            DB::rollBack();

            throw $th;
        }
    }

    public function store()
    {
        if (!$this->lista_detalle) {
            # code...
            $this->dispatchBrowserEvent(
                'alert',
                ['type' => 'error', 'title' => 'Por favor, ingresar 1 producto', 'message' => 'Exito']
            );
        }

        $this->guardar_venta();
        $this->lista_detalle = [];
        $this->defaultDetalle();
        $this->defaultVenta();
        // show alert
        $this->dispatchBrowserEvent(
            'alert',
            ['type' => 'success', 'title' => 'Se registró la venta correctamente', 'message' => 'Exito']
        );
    }

    public function store_print()
    {

        $this->guardar_venta();

        $data_venta = [
            'id_venta'  => $this->id_venta,
            'sub_total_venta' => $this->sub_total_venta,
            'igv_venta' => $this->igv_venta,
            'total_venta' => $this->total_venta,
            'fecha_venta' => now(),
        ];

        $data_detalle_venta = $this->lista_detalle;
        $empresa = Empresa::find(auth()->user()->id_empresa);
        $paciente = Paciente::find($this->id_paciente);
        date_default_timezone_set('America/Lima');
        $date = Carbon::now();
        $customPaper = array(0, 0, 204, 650);
        $writer = base64_encode(QrCode::format('svg')->size(70)->generate($empresa->pagina_empresa));
        $pdfContent = Pdf::loadView('livewire.venta.print.invoice',  compact('date', 'empresa', 'data_venta', 'data_detalle_venta', 'writer', 'paciente'))
            ->setPaper($customPaper)->output();


        $this->lista_detalle = [];
        $this->defaultDetalle();
        $this->defaultVenta();
        // show alert
        $this->dispatchBrowserEvent(
            'alert',
            ['type' => 'success', 'title' => 'Se registró la venta correctamente', 'message' => 'Exito']
        );

        return response()->streamDownload(
            fn () => print($pdfContent),
            "venta_" .  time() . ".pdf"
        );
    }

    public function delete_venta($id_venta)
    {
        $this->id_venta = $id_venta;
        $venta = Venta::select('*')
            ->join('pacientes', 'ventas.id_paciente', 'pacientes.id_paciente')
            ->where('ventas.estado', true)
            ->where('id_venta', $id_venta)
            ->first();

        $this->paciente_delete = $venta->nombres_paciente;
        $this->subtotal_delete = $venta->sub_total_venta;
        $this->igv_delete = $venta->igv_venta;
        $this->total_delete = $venta->total_venta;

        $this->detalle_delete = $this->listaDetalle($id_venta);

        // show alert
        $this->dispatchBrowserEvent(
            'open-modal-delete',
            []
        );
    }


    public function delete_detalle_venta()
    {

        $venta = Venta::find($this->id_venta);
        $venta->update([
            "estado" => false
        ]);
        $this->dispatchBrowserEvent(
            'alert',
            ['type' => 'success', 'title' => 'Se eliminó la venta correctamente', 'message' => 'Exito']
        );

        $this->close_modal_delete();
    }

    public function close_modal_delete()
    {
        $this->id_venta = null;
        // show alert
        $this->dispatchBrowserEvent(
            'close-modal-delete',
            []
        );
    }

    public function print($id_venta)
    {
        $venta = Venta::find($id_venta);
        $data_venta = [
            'id_venta'  => $id_venta,
            'sub_total_venta' => $venta->sub_total_venta,
            'igv_venta' => $venta->igv_venta,
            'total_venta' => $venta->total_venta,
            'fecha_venta' => $venta->created_at
        ];
        $data_detalle_venta = [];

        $detalle = DetalleVenta::where('id_venta', $id_venta)->get();
        foreach ($detalle as $key => $detalle_venta) {
            # code...

            array_push(
                $data_detalle_venta,
                array(
                    'id_tipo_producto' => $detalle_venta->id_tipo_producto,
                    'nombre_detalle' => $detalle_venta->nombre_detalle,
                    'cantidad_detalle' => $detalle_venta->cantidad_detalle,
                    'unidad_detalle' => $detalle_venta->unidad_detalle,
                    'precio_unitario_detalle' => $detalle_venta->precio_unitario_detalle,
                    'precio_total_detalle' => $detalle_venta->precio_total_detalle,
                    'precio_total_detalle' => $detalle_venta->precio_total_detalle,
                )
            );
        }
        $empresa = Empresa::find(auth()->user()->id_empresa);
        $paciente = Paciente::find($venta->id_paciente);
        date_default_timezone_set('America/Lima');
        $date = Carbon::now();
        $customPaper = array(0, 0, 204, 650);
        $writer = base64_encode(QrCode::format('svg')->size(70)->generate($empresa->pagina_empresa));
        $pdfContent = Pdf::loadView('livewire.venta.print.invoice',  compact('date', 'empresa', 'data_venta', 'data_detalle_venta', 'writer', 'paciente'))
            ->setPaper($customPaper)->output();
        return response()->streamDownload(
            fn () => print($pdfContent),
            "venta_" .  time() . ".pdf"
        );
    }


    public function view($id_venta)
    {
        $this->id_venta = $id_venta;
        $venta = Venta::select('*')
            ->join('pacientes', 'ventas.id_paciente', 'pacientes.id_paciente')
            ->where('ventas.estado', true)
            ->where('id_venta', $id_venta)
            ->first();

        $this->paciente_delete = $venta->nombres_paciente;
        $this->subtotal_delete = $venta->sub_total_venta;
        $this->igv_delete = $venta->igv_venta;
        $this->total_delete = $venta->total_venta;

        $this->detalle_delete = $this->listaDetalle($id_venta);

        // show alert
        $this->dispatchBrowserEvent(
            'open-modal-view',
            []
        );
    }

    public function close_modal_view()
    {
        $this->id_venta = null;
        // show alert
        $this->dispatchBrowserEvent(
            'close-modal-view',
            []
        );
    }


    public function showModalFinalizarVenta()
    {
        $messages = [
            'id_paciente.required' => 'Por favor seleccionar paciente',
        ];

        $rules = [

            'id_paciente' => 'required',

        ];
        $this->validate($rules, $messages);


        $paciente = Paciente::find($this->id_paciente);
        $this->paciente_fin_venta = $paciente->nombres_paciente;
        $this->nombre_abono       = $paciente->nombres_paciente;


        // show alert
        $this->dispatchBrowserEvent(
            'open-modal-finalizar-venta',
            []
        );
    }

    public function closeModalFinalizarVenta()
    {

        // show alert
        $this->dispatchBrowserEvent(
            'close-modal-finalizar-venta',
            []
        );
    }

    public function updatingPagocompletadoventa($completo_pago)
    {
        if (!$completo_pago) {
            # si no completo el pago se despliega el pago a cuenta...
            $this->show_abono = true;
        } else {
            $this->show_abono = false;
        }
    }

    public function updatingMontoabono($monto)
    {

        if ($monto != '') {
            # code...
            $this->monto_restante_venta = $this->total_venta - $monto;
        }
        if ($monto > $this->total_venta) {
            # code...
            $this->monto_restante_venta = 0;
        }
    }
}
