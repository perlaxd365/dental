<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class Index extends Component
{
    public $numero = 0;
    public function mount()
    {
        $this->numero = 1;
    }
    public function render()
    {
        $numero = $this->numero;
        return view('livewire.admin.index', compact('numero'));
    }
}
