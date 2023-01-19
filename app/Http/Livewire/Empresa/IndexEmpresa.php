<?php

namespace App\Http\Livewire\Empresa;

use App\Models\Empresa;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class IndexEmpresa extends Component
{
    public
        $id_empresa,
        $nombre_comercial_empresa,
        $razon_social_empresa,
        $ruc_empresa,
        $logo_empresa,
        $key_empresa,
        $direccion_empresa,
        $tipo_soap_empresa,
        $envio_soap_empresa,
        $estado;
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = "bootstrap";
    public $search;
    public $view = "create";
    public $show;
    public $table;

    public function mount()
    {
        $this->show = 5;
        $this->table = true;
    }
    public function render()
    {
        $lista_empresas = Empresa::select('*')
            ->where(function ($query) {
                return $query
                    ->orwhere('nombre_comercial_empresa', 'LIKE', '%' . $this->search . '%')
                    ->orwhere('razon_social_empresa', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('ruc_empresa', 'LIKE', '%' . $this->search . '%');
            })->paginate($this->show);
        return view('livewire.empresa.index-empresa', compact('lista_empresas'));
    }
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function agregar()
    {

        $messages = [
            'nombre_comercial_empresa.required' => 'Introduce nombre comercial de la empresa',
            'razon_social_empresa.required' => 'Por favor introducir razón social',
            'ruc_empresa.required' => 'Por favor ingresar el ruc de la empresa',
            'logo_empresa.required' => 'Por añadir el logo a la empresa',
            'tipo_soap_empresa.required' => 'Por favor seleccionar tipo de soap',
            'envio_soap_empresa.required' => 'Por favor seleccionar envío de soap',
            'direccion_empresa.required' => 'Por favor añadir la dirección de la empresa',
        ];

        $rules = [


            'direccion_empresa' => 'required',
            'tipo_soap_empresa' => 'required',
            'envio_soap_empresa' => 'required',
            'nombre_comercial_empresa' => 'required',
            'ruc_empresa' => 'required',
            'razon_social_empresa' => 'required',
            'logo_empresa' => 'image|max:2048', // 1MB Max

        ];
        $this->validate($rules, $messages);

        $filename = time() . "." . $this->logo_empresa->getClientOriginalExtension();
        //$imagen = $this->logo_empresa->store('public/imagenes');
        $imagen =  $this->logo_empresa->storeAs('images', $filename, 'real_public');


        Empresa::create([
            'nombre_comercial_empresa' => $this->nombre_comercial_empresa,
            'razon_social_empresa' => $this->razon_social_empresa,
            'ruc_empresa'   => $this->ruc_empresa,
            'logo_empresa' => $imagen,
            'direccion_empresa' => $this->direccion_empresa,
            'key_empresa' => $this->key_empresa,
            'tipo_soap_empresa' => $this->tipo_soap_empresa,
            'envio_soap_empresa' => $this->envio_soap_empresa,
            'estado' => true,
        ]);

        // show alert
        $this->dispatchBrowserEvent(
            'alert',
            ['type' => 'success', 'title' => 'Se guardó empresa correctamente', 'message' => 'Exito']
        );
        $this->default();
    }

    public function default()
    {
        //Limpiar
        $this->view = "create";
        $this->table = true;
        $this->nombre_comercial_empresa = "";
        $this->razon_social_empresa = "";
        $this->ruc_empresa = "";
        $this->logo_empresa = "";
        $this->key_empresa = "";
        $this->direccion_empresa = "";
        $this->tipo_soap_empresa = "";
        $this->envio_soap_empresa = "";
    }

    public function edit($id)
    {
        $this->table = false;
        $this->id_empresa = $id;
        $empresa = Empresa::find($id);

        $this->view = "edit";
        $this->nombre_comercial_empresa = $empresa->nombre_comercial_empresa;
        $this->razon_social_empresa = $empresa->razon_social_empresa;
        $this->ruc_empresa = $empresa->ruc_empresa;
        $this->key_empresa = $empresa->key_empresa;
        $this->direccion_empresa = $empresa->direccion_empresa;
        $this->tipo_soap_empresa = $empresa->tipo_soap_empresa;
        $this->envio_soap_empresa = $empresa->envio_soap_empresa;
        $this->estado = $empresa->estado;
    }

    public function update()
    {

        $empresa = Empresa::find($this->id_empresa);
        $empresa->update([
            'nombre_comercial_empresa' => $this->nombre_comercial_empresa,
            'razon_social_empresa' => $this->razon_social_empresa,
            'ruc_empresa' => $this->ruc_empresa,
            'key_empresa' => $this->key_empresa,
            'direccion_empresa' => $this->direccion_empresa,
            'tipo_soap_empresa' => $this->tipo_soap_empresa,
            'envio_soap_empresa' => $this->envio_soap_empresa,
            'estado' => $this->estado
        ]);
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

        $empresa = Empresa::find($id);
        $empresa->update([
            'estado' => false
        ]);
        // show alert
        $this->dispatchBrowserEvent(
            'alert',
            ['type' => 'warning', 'title' => 'Se dió de baja a la empresa ' . $empresa->nombre_comercial_empresa, 'message' => 'Exito']
        );
    }
}
