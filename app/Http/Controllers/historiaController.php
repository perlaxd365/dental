<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class historiaController extends Controller
{
    //
    public function index()
    {
        $carbon = new Carbon();
        return view('admin.historia.index', compact('carbon'));
    }
}
