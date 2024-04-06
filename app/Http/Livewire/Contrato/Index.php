<?php

namespace App\Http\Livewire\Contrato;

use App\Models\Contrato;
use App\Models\DetallePago;
use App\Models\Empresa;
use App\Models\Pago;
use App\Models\Promo;
use App\Models\TipoPago;
use App\Models\TipoUsuario;
use Carbon\Carbon;
use ContratoUtil;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = "bootstrap";
    public $search,
        $fecha_inicio_contrato_search,
        $fecha_fin_contrato_search;
    public $view = "create";
    public $show;
    public $table;
    public $empresas = [];
    public $promos = [];
    public $tipos_pagos = [];
    public $cuotas = [];
    //datos de tabla
    public
        $id_empresa,
        $id_contrato,
        $id_pago,
        $id_promo,
        $fecha_inicio_contrato,
        $fecha_fin_contrato,
        $pdf_contrato_ruta_contrato,
        $pdf_temporal,
        $cantidad_sucursales_contrato,
        $monto_total_contrato,
        $promocion_contrato,
        $estado_contrato,
        $estado;
    public
        $carbon;
    public
        $permiso;
    //Datos de pagos
    public
        $id_detalle_pago,
        $meses_contrato,
        $numero_cuotas_pago;
    //Datos de detalle de pago
    public
        $id_tipo_pago,
        $monto_detalle,
        $moneda_detalle,
        $tipo_cambio_detalle,
        $nombre_completo_detalle,
        $numero_cuota_detalle,
        $numero_telefono_detalle,
        $numero_transferencia_detalle,
        $numero_operacion_detalle,
        $fecha_fin_detalle,
        $observaciones_detalle,
        $adjunto_detalle,
        $notificacion_detalle,
        $fecha_notificacion_detalle,
        $estado_detalle;

    //shows
    public
        $showTransferencia = false,
        $showOperacion = false,
        $showTelefono = false,
        $showPago = false,
        $showTipoCambio = false;




    public function mount()
    {
        
        $this->carbon = new Carbon();
        $this->table = true;
        $this->empresas = Empresa::where('estado', true)->get();
        $this->promos = Promo::where('estado', true)->get();
        $this->tipos_pagos = TipoPago::where('estado', true)->get();
    }
    public function render()
    {
        $lista_contratos = Contrato::select('*')
            ->join('empresas', 'contratos.id_empresa', 'empresas.id_empresa')
            ->where('contratos.estado', true);

        //verificamos el permiso si es admin para listar
        $this->permiso = TipoUsuario::find(auth()->user()->id_tipo_usuario);
        if ($this->permiso->nombre_tipo_usuario != 'Administrador') {
            $lista_contratos
                ->where('contratos.id_empresa', auth()->user()->id_empresa)
                ->where(function ($query) {
                    if ($this->fecha_inicio_contrato_search) {
                        return $query

                            ->where('fecha_inicio_contrato', '>=', '' . $this->fecha_inicio_contrato_search . '')
                            ->where('fecha_fin_contrato', '<=', '' . $this->fecha_fin_contrato_search . '');
                    }
                });
        } else {
            $lista_contratos
                ->where(function ($query) {
                    return $query
                        ->orwhere('nombre_comercial_empresa', 'LIKE', '%' . $this->search . '%')
                        ->orwhere('razon_social_empresa', 'LIKE', '%' . $this->search . '%')
                        ->orWhere('ruc_empresa', 'LIKE', '%' . $this->search . '%');
                })
                ->where(function ($query) {
                    if ($this->fecha_inicio_contrato_search) {
                        return $query

                            ->where('fecha_inicio_contrato', '>=', '' . $this->fecha_inicio_contrato_search . '')
                            ->where('fecha_fin_contrato', '<=', '' . $this->fecha_fin_contrato_search . '');
                    }
                });
        }

        $lista =  $lista_contratos->paginate($this->show);

        // dd(ContratoUtil::suspenderUsuarios(auth()->user()->id_empresa));
        return view('livewire.contrato.index', compact('lista'));
    }
    public function updatingFechainiciocontrato($fecha_inicio_contrato)
    {
        $this->calcularMeses($fecha_inicio_contrato, $this->meses_contrato);
    }
    public function updatingMesescontrato($meses_contrato)
    {
        $this->calcularMeses($this->fecha_inicio_contrato, $meses_contrato);
    }


    public function calcularMeses($fechaInicial, $meses)
    {
        $date = Carbon::parse($fechaInicial);
        $this->fecha_fin_contrato = $date->addMonth($meses)->format("Y-m-d");
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function agregar()
    {

        $messages = [
            'id_empresa.required' => 'Por favor, selecciona una empresa',
            'id_promo.required' => 'Por favor, selecciona una promoción',
            'fecha_inicio_contrato.required' => 'Por favor selecciona la fecha de inicio de contrato',
            'meses_contrato.required' => 'Por favor selecciona los meses de contrato',
            'fecha_fin_contrato.required' => 'Por favor selecciona la fecha fin de contrato',
            'monto_total_contrato.required' => 'Por favor ingresa el monto total del pago',
            'pdf_contrato_ruta_contrato.required' => 'Por favor ingresar documento de contrato',
            'cantidad_sucursales_contrato.required' => 'Por favor ingresar la cantidad de sucursales',
            'estado_contrato.required' => 'Por favor ingresar el estado de contrato',
        ];

        $rules = [


            'id_empresa' => 'required',
            'id_promo' => 'required',
            'fecha_inicio_contrato' => 'required',
            'meses_contrato' => 'required',
            'fecha_fin_contrato' => 'required',
            'monto_total_contrato' => 'required',
            'cantidad_sucursales_contrato' => 'required',
            'estado_contrato' => 'required',
            'pdf_contrato_ruta_contrato' => 'required|mimes:pdf,docs|max:2048', // 1MB Max

        ];
        $this->validate($rules, $messages);

        $filename = time() . "." . $this->pdf_contrato_ruta_contrato->getClientOriginalExtension();
        //$imagen = $this->logo_empresa->store('public/imagenes');
        $imagen =  $this->pdf_contrato_ruta_contrato->storeAs('contratos/' . $this->id_empresa, $filename, 'real_public');





        //INICIAMOS EL PAGO EN VACIO
        $pago = Pago::create([
            'id_empresa'                    => $this->id_empresa,
            'numero_cuotas_pago'            => $this->meses_contrato,
            'monto_total_pago'              => $this->monto_total_contrato,
            'estado_pago'                   => config('constants.ESTADO_PAGO_SIN_PAGO'),
            'estado'                        => true,
        ]);

        Contrato::create([
            'id_empresa'                    => $this->id_empresa,
            'id_promo'                      => $this->id_promo,
            'id_pago'                       => $pago->id_pago,
            'fecha_inicio_contrato'         => $this->fecha_inicio_contrato,
            'meses_contrato'                => $this->meses_contrato,
            'fecha_fin_contrato'            => $this->fecha_fin_contrato,
            'cantidad_sucursales_contrato'  => $this->cantidad_sucursales_contrato,
            'monto_total_contrato'          => $this->monto_total_contrato,
            'estado_contrato'               => $this->estado_contrato,
            'pdf_contrato_ruta_contrato'    => $imagen,
            'estado'                        => true,
        ]);

        $fecha_inicio = Carbon::parse($this->fecha_inicio_contrato);
        for ($i = 1; $i <= $this->meses_contrato; $i++) {
            # code...
            //INICIAMOS EL PAGO DETALLE (CUOTAS) EN VACIO

            DetallePago::create([
                'id_pago'                       => $pago->id_pago,
                'numero_cuota_detalle'          => $i,
                'fecha_fin_detalle'             => $fecha_inicio->addMonth(1)->format("Y-m-d"),
                'estado_detalle'                => config('constants.ESTADO_DETALLE_PAGO_INCOMPLETO'),
                'estado'                        => true,
            ]);
        }
        // show alert
        $this->dispatchBrowserEvent(
            'alert',
            ['type' => 'success', 'title' => 'Se registro el contrato correctamente', 'message' => 'Exito']
        );
        $this->default();
    }

    public function default()
    {
        //Limpiar
        $this->view = "create";
        $this->table = true;
        $this->id_empresa = "";
        $this->id_promo = "";
        $this->fecha_inicio_contrato = "";
        $this->meses_contrato = "";
        $this->fecha_fin_contrato = "";
        $this->monto_total_contrato = "";
        $this->pdf_contrato_ruta_contrato = "";
        $this->cantidad_sucursales_contrato = "";
        $this->estado_contrato = "";
    }
    public function edit($id)
    {
        $this->view = "edit";
        $this->table = false;
        $contrato = Contrato::find($id);
        $this->id_contrato = $id;

        //i
        $this->id_empresa                   = $contrato->id_empresa;
        $this->id_promo                     = $contrato->id_promo;
        $this->fecha_inicio_contrato        = $contrato->fecha_inicio_contrato;
        $this->meses_contrato               = $contrato->meses_contrato;
        $this->fecha_fin_contrato           = $contrato->fecha_fin_contrato;
        $this->monto_total_contrato         = $contrato->monto_total_contrato;
        $this->cantidad_sucursales_contrato = $contrato->cantidad_sucursales_contrato;
        $this->pdf_temporal                 = $contrato->pdf_contrato_ruta_contrato;
        $this->estado_contrato              = $contrato->estado_contrato;
        $this->estado                       = $contrato->estado;

        $this->resetErrorBag();
        $this->resetValidation();
        // show empresa
        $this->dispatchBrowserEvent(
            'data',
            ['id_empresa' => $contrato->id_empresa]
        );
    }


    public function update()
    {
        $messages = [
            'id_empresa.required' => 'Por favor, selecciona una empresa',
            'id_promo.required' => 'Por favor, selecciona una promoción',
            'fecha_inicio_contrato.required' => 'Por favor selecciona la fecha de inicio de contrato',
            'meses_contrato.required' => 'Por favor ingresa los mese de contrato',
            'fecha_fin_contrato.required' => 'Por favor selecciona la fecha fin de contrato',
            'monto_total_contrato.required' => 'Por favor ingresa el monto total del pago',
            'cantidad_sucursales_contrato.required' => 'Por favor ingresar la cantidad de sucursales',
            'estado_contrato.required' => 'Por favor ingresar el estado de contrato',
        ];

        $rules = [


            'id_empresa' => 'required',
            'id_promo' => 'required',
            'fecha_inicio_contrato' => 'required',
            'meses_contrato' => 'required',
            'fecha_fin_contrato' => 'required',
            'monto_total_contrato' => 'required',
            'cantidad_sucursales_contrato' => 'required',
            'estado_contrato' => 'required',

        ];
        $this->validate($rules, $messages);

        $contrato = Contrato::find($this->id_contrato);
        if ($this->pdf_contrato_ruta_contrato) {
            # code...
            $filename = time() . "." . $this->pdf_contrato_ruta_contrato->getClientOriginalExtension();
            //$imagen = $this->logo_empresa->store('public/imagenes');
            $imagen =  $this->pdf_contrato_ruta_contrato->storeAs('contratos/' . $this->id_empresa, $filename, 'real_public');
            $contrato->update([
                'id_empresa'                    => $this->id_empresa,
                'id_promo'                      => $this->id_promo,
                'fecha_inicio_contrato'         => $this->fecha_inicio_contrato,
                'meses_contrato'                => $this->meses_contrato,
                'fecha_fin_contrato'            => $this->fecha_fin_contrato,
                'monto_total_contrato'          => $this->monto_total_contrato,
                'cantidad_sucursales_contrato'  => $this->cantidad_sucursales_contrato,
                'estado_contrato'               => $this->estado_contrato,
                'pdf_contrato_ruta_contrato'    => $imagen,
                'estado'                        => $this->estado,
            ]);
        } else {
            $contrato->update([

                'id_empresa'                    => $this->id_empresa,
                'id_promo'                      => $this->id_promo,
                'fecha_inicio_contrato'         => $this->fecha_inicio_contrato,
                'meses_contrato'                => $this->meses_contrato,
                'monto_total_contrato'          => $this->monto_total_contrato,
                'fecha_fin_contrato'            => $this->fecha_fin_contrato,
                'cantidad_sucursales_contrato'  => $this->cantidad_sucursales_contrato,
                'estado_contrato'               => $this->estado_contrato,
                'estado'                        => $this->estado,
            ]);
        }


        $this->view = "create";
        $this->table = true;
        $this->default();
        // show alert
        $this->dispatchBrowserEvent(
            'alert',
            ['type' => 'success', 'title' => 'Se actualizó la empresa correctamente', 'message' => 'Exito']
        );
    }
    public function delete($id)
    {

        $contrato = Contrato::find($id);
        $contrato->update([
            'estado' => false
        ]);
        // show alert
        $this->dispatchBrowserEvent(
            'alert',
            ['type' => 'warning', 'title' => 'Se eliminó el contrato correctamente', 'message' => 'Exito']
        );
    }
    public function showPago($id)
    {
        $this->showPago = false;
        $this->id_contrato = $id;
        $contrato = Contrato::find($id);


        $this->cuotas = DetallePago::where('id_pago', $contrato->id_pago)->where('estado', true)->get();

        // show alert
        $this->dispatchBrowserEvent(
            'open-modal-pago',
            []
        );
    }

    public function closeModal()
    {
        // show alert
        $this->dispatchBrowserEvent(
            'close-modal-pago',
            []
        );
    }

    public function cuotaChange($cuota, $id_detalle_pago)
    {
        $this->numero_cuota_detalle = $cuota;
        $this->showPago = true;

        # code...
        $this->showOperacion = false;
        $this->showTelefono = false;
        $this->showTransferencia = false;
        //
        $detalle_pago = DetallePago::find($id_detalle_pago);
        $this->id_detalle_pago = $id_detalle_pago;
        $this->id_tipo_pago = $detalle_pago->id_tipo_pago;
        $this->nombre_completo_detalle = $detalle_pago->nombre_completo_detalle;
        $this->monto_detalle = $detalle_pago->monto_detalle;
        $this->moneda_detalle = $detalle_pago->moneda_detalle;
        $this->tipo_cambio_detalle = $detalle_pago->tipo_cambio_detalle;
        $this->numero_telefono_detalle = $detalle_pago->numero_telefono_detalle;
        $this->numero_operacion_detalle = $detalle_pago->numero_operacion_detalle;
        $this->numero_transferencia_detalle = $detalle_pago->numero_transferencia_detalle;
        $this->fecha_fin_detalle = $detalle_pago->fecha_fin_detalle;
        $this->adjunto_detalle = $detalle_pago->adjunto_detalle;
        $this->observaciones_detalle = $detalle_pago->observaciones_detalle;
        $this->notificacion_detalle = $detalle_pago->notificacion_detalle;
        $this->fecha_notificacion_detalle = $detalle_pago->fecha_notificacion_detalle;
        $this->estado_detalle = $detalle_pago->estado_detalle;

        $this->resetValidation();
        $this->updatingIdtipopago($detalle_pago->id_tipo_pago);
        $this->updatingMonedadetalle($detalle_pago->moneda_detalle);
    }

    public function updatingMonedadetalle($moneda_detalle)
    {
        switch ($moneda_detalle) {
            case config('constants.MONEDA_SOLES'):

                $this->showTipoCambio = false;
                break;
            case config('constants.MONEDA_DOLARES'):

                $this->showTipoCambio = true;
                break;
            default:
                # code...
                $this->showTipoCambio = false;
                break;
        }
    }
    public function updatingIdtipopago($id_tipo_pago)
    {
        switch ($id_tipo_pago) {
            case config('constants.TIPO_PAGO_EFECTIVO'):
                # code...
                break;
            case config('constants.TIPO_PAGO_YAPE'):
            case config('constants.TIPO_PAGO_PLIN'):
                # code...
                $this->showOperacion = true;
                $this->showTelefono = true;
                $this->showTransferencia = false;
                break;
            case config('constants.TIPO_PAGO_TRANSFERENCIA'):
                # code...
                $this->showOperacion = true;
                $this->showTelefono = false;
                $this->showTransferencia = true;
                break;

            default:
                # code...
                $this->showOperacion = false;
                $this->showTelefono = false;
                $this->showTransferencia = false;
                break;
        }
    }
    public function updateDetalle()
    {
        $messages = [
            'id_tipo_pago.required' => 'Por favor, selecciona un tipo de pago',
            'monto_detalle.required' => 'Por favor, Ingresa el monto de pago',
        ];

        $rules = [


            'id_tipo_pago' => 'required',
            'monto_detalle' => 'required',

        ];
        $this->validate($rules, $messages);
        $detalle_pago = DetallePago::find($this->id_detalle_pago);

        //datos de adjunto
        $filename = time() . "." . $this->adjunto_detalle->getClientOriginalExtension();
        //$imagen = $this->logo_empresa->store('public/imagenes');
        $archivo =  $this->adjunto_detalle->storeAs('detallePagos/' . $this->id_empresa, $filename, 'real_public');

        $detalle_pago->update([
            'id_tipo_pago'                  => $this->id_tipo_pago,
            'nombre_completo_detalle'       => $this->nombre_completo_detalle,
            'monto_detalle'                 => $this->monto_detalle,
            'moneda_detalle'                => $this->moneda_detalle,
            'tipo_cambio_detalle'           => $this->tipo_cambio_detalle,
            'numero_telefono_detalle'       => $this->numero_telefono_detalle,
            'numero_operacion_detalle'      => $this->numero_operacion_detalle,
            'numero_transferencia_detalle'  => $this->numero_transferencia_detalle,
            'adjunto_detalle'               => $archivo,
            'fecha_fin_detalle'             => $this->fecha_fin_detalle,
            'observaciones_detalle'         => $this->observaciones_detalle,
            'estado_detalle'                => $this->estado_detalle
        ]);

        ContratoUtil::updateContrato($this->id_contrato, config('constants.ESTADO_CONTRATO_ACTIVO'));
        // show alert
        $this->dispatchBrowserEvent(
            'close-modal-pago',
            []
        );
        $this->dispatchBrowserEvent(
            'alert',
            ['type' => 'success', 'title' => 'Se registró correctamente el pago', 'message' => 'Exito']
        );
    }
}
