<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Carbon\Carbon;

class BeritaController extends Controller
{
    public function index()
    {
        $beritas = Berita::where('published', true)
            ->orderBy('tanggal', 'desc')
            ->get();

        // Konversi manual kolom 'tanggal' menjadi objek Carbon
        foreach ($beritas as $b) {
            $b->tanggal = Carbon::parse($b->tanggal);
        }

        return view('user.berita.index', compact('beritas'));
    }

    public function show($id)
    {
        $berita = Berita::findOrFail($id);
        return view('user.berita.show', compact('berita'));
    }

}
