<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class userController extends Controller
{
    //
    public function index()
    {
        
        $carbon = new Carbon();
        $carbon->setLocale('es');
        return view('admin.user.index', compact('carbon'));
    }
}
