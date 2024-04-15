<?php

namespace App\Http\Livewire\Perfil;

use App\Models\Empresa;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $empresa = Empresa::find(auth()->user()->id_empresa);
        return view('livewire.perfil.index', compact('empresa'));
    }
}
