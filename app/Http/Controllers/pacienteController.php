<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class pacienteController extends Controller
{
    //
    public function index()
    {
        
        $carbon = new Carbon();
        return view('admin.paciente.index', compact('carbon'));
    }
}
