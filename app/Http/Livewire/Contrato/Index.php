<?php

namespace App\Http\Livewire\Contrato;

use App\Models\Contrato;
use App\Models\Empresa;
use App\Models\TipoUsuario;
use Carbon\Carbon;
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
    //datos de tabla
    public
        $id_empresa,
        $id_contrato,
        $id_pago,
        $fecha_inicio_contrato,
        $fecha_fin_contrato,
        $pdf_contrato_ruta_contrato,
        $pdf_temporal,
        $cantidad_sucursales_contrato,
        $promocion_contrato,
        $estado_contrato,
        $estado;
    public
        $carbon;
    public
        $permiso;



    public function mount()
    {
        $this->carbon = new Carbon();
        $this->table = true;
        $this->empresas = Empresa::where('estado', true)->get();
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
        return view('livewire.contrato.index', compact('lista'));
    }
    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function agregar()
    {

        $messages = [
            'id_empresa.required' => 'Por favor, selecciona una empresa',
            'fecha_inicio_contrato.required' => 'Por favor selecciona la fecha de inicio de contrato',
            'fecha_fin_contrato.required' => 'Por favor selecciona la fecha fin de contrato',
            'pdf_contrato_ruta_contrato.required' => 'Por favor ingresar documento de contrato',
            'cantidad_sucursales_contrato.required' => 'Por favor ingresar la cantidad de sucursales',
            'promocion_contrato.required' => 'Por favor seleccionar la promoción',
            'estado_contrato.required' => 'Por favor ingresar el estado de contrato',
        ];

        $rules = [


            'id_empresa' => 'required',
            'fecha_inicio_contrato' => 'required',
            'fecha_fin_contrato' => 'required',
            'cantidad_sucursales_contrato' => 'required',
            'promocion_contrato' => 'required',
            'estado_contrato' => 'required',
            'pdf_contrato_ruta_contrato' => 'required|mimes:pdf,docs|max:2048', // 1MB Max

        ];
        $this->validate($rules, $messages);

        $filename = time() . "." . $this->pdf_contrato_ruta_contrato->getClientOriginalExtension();
        //$imagen = $this->logo_empresa->store('public/imagenes');
        $imagen =  $this->pdf_contrato_ruta_contrato->storeAs('contratos/' . $this->id_empresa, $filename, 'real_public');



        Contrato::create([
            'id_empresa'                    => $this->id_empresa,
            'fecha_inicio_contrato'         => $this->fecha_inicio_contrato,
            'fecha_fin_contrato'            => $this->fecha_fin_contrato,
            'cantidad_sucursales_contrato'  => $this->cantidad_sucursales_contrato,
            'estado_contrato'               => $this->estado_contrato,
            'promocion_contrato'            => $this->promocion_contrato,
            'pdf_contrato_ruta_contrato'    => $imagen,
            'estado'                        => true,
        ]);

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
        $this->fecha_inicio_contrato = "";
        $this->fecha_fin_contrato = "";
        $this->pdf_contrato_ruta_contrato = "";
        $this->promocion_contrato = "";
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
        $this->fecha_inicio_contrato        = $contrato->fecha_inicio_contrato;
        $this->fecha_fin_contrato           = $contrato->fecha_fin_contrato;
        $this->cantidad_sucursales_contrato = $contrato->cantidad_sucursales_contrato;
        $this->pdf_temporal                 = $contrato->pdf_contrato_ruta_contrato;
        $this->promocion_contrato           = $contrato->promocion_contrato;
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
            'fecha_inicio_contrato.required' => 'Por favor selecciona la fecha de inicio de contrato',
            'fecha_fin_contrato.required' => 'Por favor selecciona la fecha fin de contrato',
            'cantidad_sucursales_contrato.required' => 'Por favor ingresar la cantidad de sucursales',
            'promocion_contrato.required' => 'Por favor seleccionar la promoción',
            'estado_contrato.required' => 'Por favor ingresar el estado de contrato',
        ];

        $rules = [


            'id_empresa' => 'required',
            'fecha_inicio_contrato' => 'required',
            'fecha_fin_contrato' => 'required',
            'cantidad_sucursales_contrato' => 'required',
            'promocion_contrato' => 'required',
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
                'fecha_inicio_contrato'         => $this->fecha_inicio_contrato,
                'fecha_fin_contrato'            => $this->fecha_fin_contrato,
                'cantidad_sucursales_contrato'  => $this->cantidad_sucursales_contrato,
                'promocion_contrato'            => $this->promocion_contrato,
                'estado_contrato'               => $this->estado_contrato,
                'pdf_contrato_ruta_contrato'    => $imagen,
                'estado'                        => $this->estado,
            ]);
        } else {
            $contrato->update([

                'id_empresa'                    => $this->id_empresa,
                'fecha_inicio_contrato'         => $this->fecha_inicio_contrato,
                'fecha_fin_contrato'            => $this->fecha_fin_contrato,
                'cantidad_sucursales_contrato'  => $this->cantidad_sucursales_contrato,
                'promocion_contrato'            => $this->promocion_contrato,
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
    public function eliminar($id)
    {

        $contrato = Contrato::find($id);
        $contrato->update([
            'estado' => false
        ]);
        // show alert
        $this->dispatchBrowserEvent(
            'alert',
            ['type' => 'warning', 'title' => 'Se eliminó el contrato correctamente' , 'message' => 'Exito']
        );
    }
}