<?php

namespace App\Http\Livewire\Saldo;

use App\Models\DetalleVenta;
use App\Models\DetalleVentaAbono;
use App\Models\Paciente;
use App\Models\TipoPago;
use App\Models\TipoUsuario;
use App\Models\Venta;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{

    use WithPagination;
    protected $paginationTheme = "bootstrap";
    public $search;
    public $show;
    public $table;
    public $pacientes = [];
    public $view = "create";

    public $permiso;
    //venta 
    public $id_venta;
    public $fecha_inicio_venta_search,
        $fecha_fin_venta_search;

    public $lista_detalle = [];
    public $tipos_pagos = [];
    public $lista_detalle_pagos = [];

    public $paciente_delete,
        $subtotal_delete,
        $igv_delete,
        $total_delete;

    //saldos
    public $nombres_paciente,
        $monto_abonado_venta,
        $monto_restante_venta,
        $producto_entregado_venta,
        $pago_completado_venta;

    public $nombre_abono,
        $tipo_pago_abono,
        $monto_abono;


    public function mount()
    {

        $this->pacientes = Paciente::where('estado', true)
            ->where('id_empresa', auth()->user()->id_empresa)->get();

        $this->tipos_pagos = TipoPago::where('estado', true)->get();
        $this->show = 6;
        $this->table = true;
    }

    public function render()
    {
        $this->permiso = TipoUsuario::find(auth()->user()->id_tipo_usuario);

        $lista_ventas = Venta::select(DB::raw(
            "*,ventas.created_at as fecha_venta"
        ))
            ->join('pacientes', 'ventas.id_paciente', 'pacientes.id_paciente')
            ->join('empresas', 'empresas.id_empresa', 'ventas.id_empresa')
            ->where('ventas.estado', true)
            ->where('ventas.saldo_venta', true)
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

        return view('livewire.saldo.index', compact('lista'));
    }
    public function listaDetalle($id_venta)
    {
        return DetalleVenta::where("id_venta", $id_venta)->where("estado", true)->get();
    }




    public function open_modal_saldo($id_venta)
    {
        $this->id_venta = $id_venta;
        $venta = Venta::select('*')
            ->join('pacientes', 'ventas.id_paciente', 'pacientes.id_paciente')
            ->where('ventas.estado', true)
            ->where('id_venta', $id_venta)
            ->first();

        $this->nombres_paciente = $venta->nombres_paciente;
        $this->subtotal_delete = $venta->sub_total_venta;
        $this->igv_delete = $venta->igv_venta;
        $this->total_delete = $venta->total_venta;

        $this->lista_detalle = $this->listaDetalle($id_venta);
        return $this->dispatchBrowserEvent(
            'open-modal-saldo',
            []
        );
    }



    public function open_modal_pago($id_venta)
    {
        $this->id_venta = $id_venta;
        $this->lista_detalle_pagos = DetalleVentaAbono::select('*')
            ->where('estado', true)
            ->where('id_venta', $id_venta)
            ->get();
        $this->resetValidaciones();
        //buscamos el monto restante de la venta
        $venta = Venta::find($id_venta);
        $this->monto_restante_venta = $venta->monto_restante_venta;
        $this->producto_entregado_venta = $venta->producto_entregado_venta;
        $this->pago_completado_venta = $venta->pago_completado_venta;
        return $this->dispatchBrowserEvent(
            'open-modal-pagos',
            []
        );
    }

    public function closeModalSaldo()
    {
        // show alert
        return $this->dispatchBrowserEvent(
            'close-modal-saldo',
            []
        );
    }

    public function closeModalPago()
    {
        // show alert
        return $this->dispatchBrowserEvent(
            'close-modal-pagos',
            []
        );
    }

    public function agregarPago()
    {
        $messages = [
            'id_venta.required' => 'Por favor seleccionar la venta',
            'nombre_abono.required' => 'Por favor ingresar el nombre',
            'tipo_pago_abono.required' => 'Por favor ingresar el tipo de pago',
            'monto_abono.required' => 'Por favor ingresar el monto de pago'
        ];

        $rules = [

            'id_venta' => 'required',
            'nombre_abono' => 'required',
            'tipo_pago_abono' => 'required',
            'monto_abono' => 'required',

        ];
        $this->validate($rules, $messages);

        $lista_detalle = DetalleVentaAbono::create([

            'id_venta'                  => $this->id_venta,
            'nombre_abono'              => $this->nombre_abono,
            'tipo_pago_abono'           => $this->tipo_pago_abono,
            'monto_abono'               => $this->monto_abono,
            'estado'                    => true,
            'id_empresa'                => auth()->user()->id_empresa
        ]);

        $this->lista_detalle = $this->listaDetalle($this->id_venta);
        //actualizamos la venta
        $venta = Venta::find($this->id_venta);
        if ($this->monto_abono >= $venta->monto_restante_venta) {
            # code...
            $venta->pago_completado_venta = true;
            $venta->update([
                "monto_restante_venta" => 0,
                "monto_abonado_venta"  => $venta->monto_abonado_venta + $this->monto_abono,
                "producto_entregado_venta" => $this->producto_entregado_venta
            ]);
        }else{
            $venta->update([
                "monto_restante_venta" => $venta->monto_restante_venta - $this->monto_abono,
                "monto_abonado_venta"  => $venta->monto_abonado_venta + $this->monto_abono,
                "producto_entregado_venta" => $this->producto_entregado_venta
            ]);
        }

        

        $this->closeModalPago();
        // show alert
        return $this->dispatchBrowserEvent(
            'alert',
            ['type' => 'success', 'title' => 'Se registró el pago correctamente', 'message' => 'Exito']
        );
    }
    public function resetValidaciones()
    {
        $this->nombre_abono = "";
        $this->tipo_pago_abono = "";
        $this->monto_abono = "";
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function updatedProductoentregadoventa($value){
        
        Venta::find($this->id_venta)->update(['producto_entregado_venta' => $value]);
      
    }
}
