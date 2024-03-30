<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class recetaController extends Controller
{
    //
    public function index()
    {
        return view('admin.receta.index');
    }
}
