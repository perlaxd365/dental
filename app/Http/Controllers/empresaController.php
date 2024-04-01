<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class empresaController extends Controller
{
    //
    public function index()
    {
        $carbon = new Carbon();
        return view('admin.empresa.index', compact('carbon'));
    }
}
