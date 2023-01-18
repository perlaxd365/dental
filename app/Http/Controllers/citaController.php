<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class citaController extends Controller
{
    //
    public function index()
    {
        return view('admin.cita.index');
    }
}
