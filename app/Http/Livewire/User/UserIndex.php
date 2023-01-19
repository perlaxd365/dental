<?php

namespace App\Http\Livewire\User;

use App\Models\Empresa;
use App\Models\TipoUsuario;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class UserIndex extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";
    public $search;
    public $view = "create";
    public $show;
    public $table;
    public $empresas = [];
    public $id_user, $id_empresa, $name, $dni, $email, $password, $estado;
    public $tipos_usuario, $id_tipo_usuario;
    public function mount()
    {
        $this->show = 5;
        $this->table = true;

        $permiso = TipoUsuario::find(auth()->user()->id_tipo_usuario);

        //verificamos si es admin para listar empresas y tipos de usuarios
        if ($permiso->nombre_tipo_usuario == 'Administrador') {
            $this->empresas = Empresa::where('estado', true)->get();
            $this->tipos_usuario = TipoUsuario::where('estado', true)->get();
        } else {
            $this->empresas = Empresa::where('estado', true)->where('id_empresa', auth()->user()->id_empresa)->get();
            $this->tipos_usuario = TipoUsuario::where('estado', true)->where('nombre_tipo_usuario', '<>', 'Administrador')->get();
        }
    }
    public function render()
    {
        $lista_usuarios = User::select(
            DB::raw(
                'users.id,
                users.estado as user_estado,
                empresas.razon_social_empresa,
                empresas.logo_empresa,
                empresas.estado as empresa_estado,
                users.name,
                users.email,
                users.dni,
                users.updated_at'
            )
        )->join('empresas', 'users.id_empresa', 'empresas.id_empresa');

        //verificamos el permiso si es admin para listar
        $permiso = TipoUsuario::find(auth()->user()->id_tipo_usuario);
        if ($permiso->nombre_tipo_usuario != 'Administrador') {
            $lista_usuarios->where('users.id_empresa', auth()->user()->id_empresa);
        } 
        $lista_usuarios->where(function ($query) {
            return $query
                ->orwhere('name', 'LIKE', '%' . $this->search . '%')
                ->orwhere('dni', 'LIKE', '%' . $this->search . '%')
                ->orWhere('email', 'LIKE', '%' . $this->search . '%');
        });
        $lista =  $lista_usuarios->paginate($this->show);
        return view('livewire.user.user-index', compact('lista'));
    }
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function agregar()
    {
        $messages = [
            'name.required' => 'Introduce nombres completos',
            'id_empresa.required' => 'Por favor seleccionar una empresa',
            'id_tipo_usuario.required' => 'Por favor seleccionar el tipo de usuario',
            'dni.required' => 'Por favor ingresar el dni del usuario',
            'email.required' => 'Por favor ingresar el email del usuario',
            'password.required' => 'Por favor ingresar la contraseña del usuario',
        ];

        $rules = [


            'id_tipo_usuario' => 'required',
            'id_empresa' => 'required',
            'name' => 'required',
            'dni' => 'required|unique:users,dni',
            'email' => 'required|email|unique:users,email',
            'password' => 'required', // 1MB Max

        ];
        $this->validate($rules, $messages);
        $permiso = TipoUsuario::find($this->id_tipo_usuario);
        User::create([
            'id_tipo_usuario' => $this->id_tipo_usuario,
            'id_empresa' => $this->id_empresa,
            'name' => $this->name,
            'dni'   => $this->dni,
            'email' => $this->email,
            'estado' => true,
            'password' => bcrypt($this->password),

        ])->assignRole($permiso->nombre_tipo_usuario);
        // show alert
        $this->dispatchBrowserEvent(
            'alert',
            ['type' => 'success', 'title' => 'Se guardó usuario correctamente', 'message' => 'Exito']
        );
        $this->default();
    }
    public function default()
    {
        $this->dispatchBrowserEvent(
            'clear',
            []
        );
        $this->id_tipo_usuario = "";
        $this->name = "";
        $this->dni = "";
        $this->email = "";
        $this->password = "";
        $this->view = "create";
        $this->table = true;
    }

    public function edit($id)
    {
        $this->view = "edit";
        $this->table = false;
        $user = User::find($id);
        $this->id_user = $id;
        $this->id_tipo_usuario =  $user->id_tipo_usuario;
        $this->name = $user->name;
        $this->dni = $user->dni;
        $this->email = $user->email;
        $this->estado = $user->estado;
        $this->dispatchBrowserEvent(
            'datos',
            ['id_empresa' => $user->id_empresa]
        );
    }

    public function update()
    {
        $permiso = TipoUsuario::find($this->id_tipo_usuario);
        $user = User::find($this->id_user);
        $user->update([
            'id_tipo_usuario' => $this->id_tipo_usuario,
            'id_empresa' => $this->id_empresa,
            'name' => $this->name,
            'dni' => $this->dni,
            'email' => $this->email,
            'estado' => $this->estado


        ]);
        $user->roles()->detach();
        $user->assignRole($permiso->nombre_tipo_usuario);


        if ($this->password != '') {
            # code...
            $user->update([
                'password' => bcrypt($this->password),
            ]);
        }
        $this->default();
        // show alert
        $this->dispatchBrowserEvent(
            'alert',
            ['type' => 'success', 'title' => 'Se actualizó la empresa correctamente', 'message' => 'Exito']
        );
    }

    public function delete($id)
    {


        $usuario = User::find($id);
        $usuario->update([
            'estado' => false
        ]);
        // show alert
        $this->dispatchBrowserEvent(
            'alert',
            ['type' => 'warning', 'title' => 'Se dió de baja a el usuario ' . $usuario->name, 'message' => 'Exito']
        );
    }
}
