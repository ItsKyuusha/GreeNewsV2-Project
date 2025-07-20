<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Tanaman;

class TanamanController extends Controller
{
    public function index()
    {
        $tanamans = Tanaman::orderBy('nama')->get();
        return view('user.tanaman.index', compact('tanamans'));
    }

    public function show($id)
    {
        $tanaman = Tanaman::findOrFail($id);
        return view('user.tanaman.show', compact('tanaman'));
    }

}

