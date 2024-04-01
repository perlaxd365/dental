<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class laboratorioController extends Controller
{
    //
    public function index()
    {
        
        $carbon = new Carbon();
        return view('admin.laboratorio.index', compact('carbon'));
    }
}
