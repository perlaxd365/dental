<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class productolabController extends Controller
{
    //
    public function index()
    {
        
        $carbon = new Carbon();
        return view('admin.productolab.index', compact('carbon'));
    }
}
