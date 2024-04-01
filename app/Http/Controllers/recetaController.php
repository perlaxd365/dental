<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class recetaController extends Controller
{
    //
    public function index()
    {
        $carbon = new Carbon();
        return view('admin.receta.index', compact('carbon'));
    }
}
