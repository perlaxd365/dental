<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class contratoController extends Controller
{
    //
    public function index()
    {
        
        $carbon = new Carbon();
        return view('admin.contrato.index', compact('carbon'));
    }
}
