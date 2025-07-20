<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class KalkulatorController extends Controller
{
    public function index()
    {
        return view('user.kalkulator.index');
    }
}

