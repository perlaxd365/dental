<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class indexController extends Controller
{
    public function index()
    {
        $carbon = new Carbon();
        return view('admin.index.index', compact('carbon'));
    }
}
