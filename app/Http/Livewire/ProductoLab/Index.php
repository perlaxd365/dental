<?php

namespace App\Http\Livewire\ProductoLab;

use App\Models\ProductoLaboratorio;
use App\Models\TipoUsuario;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";
    public $search;
    public $show;
    public $table;
    public $view = "create";
    //DATOS DE PRODUCTO DE LAB
    public $id_producto_lab,$nombre_producto_lab, $estado_producto_lab;

    public function mount()
    {
        $this->show = 5;
        $this->table = true;
    }
    public function render()
    {
        $lista_productos_lab = ProductoLaboratorio::select('*')
        ->join('empresas','empresas.id_empresa','producto_laboratorios.id_empresa');

        //verificamos el permiso si es admin para listar
        $permiso = TipoUsuario::find(auth()->user()->id_tipo_usuario);
        if ($permiso->nombre_tipo_usuario != 'Administrador') {
            $lista_productos_lab->where('id_empresa', auth()->user()->id_empresa);
        } 
        $lista_productos_lab->where(function ($query) {
            return $query
            ->orwhere('nombre_comercial_empresa', 'LIKE', '%' . $this->search . '%')
            ->orwhere('nombre_producto_lab', 'LIKE', '%' . $this->search . '%');
        });
        $lista =  $lista_productos_lab->paginate($this->show);
        return view('livewire.producto-lab.index', compact('lista'));
    }

    
    public function agregar()
    {
        $messages = [
            'nombre_producto_lab.required' => 'Por favor ingresar nombre de producto de laboratorio',
        ];

        $rules = [

            'nombre_producto_lab' => 'required',

        ];
        $this->validate($rules, $messages);

        ProductoLaboratorio::create([
            'nombre_producto_lab' => $this->nombre_producto_lab,
            'estado_producto_lab' => true,
            'id_empresa' => auth()->user()->id_empresa,

        ]);
        // show alert
        $this->dispatchBrowserEvent(
            'alert',
            ['type' => 'success', 'title' => 'Se guardó producto de laboratorio correctamente', 'message' => 'Exito']
        );
        $this->default();
    }
    
    
    public function edit($id)
    {
        $this->view = "edit";
        $this->table = false;
        $producto_lab = ProductoLaboratorio::find($id);
        $this->id_producto_lab = $id;
        $this->nombre_producto_lab =  $producto_lab->nombre_producto_lab;
        $this->estado_producto_lab =  $producto_lab->estado_producto_lab;
       
    }

    
    public function update()
    {
        $user = ProductoLaboratorio::find($this->id_producto_lab);
        $user->update([
            'nombre_producto_lab' => $this->nombre_producto_lab,
            'estado_producto_lab' => $this->estado_producto_lab,


        ]);

        $this->default();
        // show alert
        $this->dispatchBrowserEvent(
            'alert',
            ['type' => 'success', 'title' => 'Se actualizó el producto de laboratorio correctamente', 'message' => 'Exito']
        );
    }


    public function delete($id)
    {
        $producto = ProductoLaboratorio::find($id);
        $producto->update([
            'estado_producto_lab' => false
        ]);
        // show alert
        $this->dispatchBrowserEvent(
            'alert',
            ['type' => 'warning', 'title' => 'Se dió de baja el producto ' . $producto->nombre_producto_lab, 'message' => 'Exito']
        );
    }
    public function default()
    {
        $this->nombre_producto_lab = '';
        $this->view= 'create';
        $this->table= true;
    }
}
