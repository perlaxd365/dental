<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class saldoController extends Controller
{
    
    //
    public function index()
    {
        $carbon = new Carbon();
        return view('admin.saldo.index', compact('carbon'));
    }
}
