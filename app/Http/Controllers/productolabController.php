<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class productolabController extends Controller
{
    //
    public function index()
    {
        return view('admin.productolab.index');
    }
}
