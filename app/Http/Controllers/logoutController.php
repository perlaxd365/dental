<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session as FacadesSession;

class logoutController extends Controller
{
    public function index()
    {
        FacadesSession::flush();

        Auth::logout();

        return redirect('login');
    }
}
