<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tanaman;

class TanamanController extends Controller
{
    public function index()
    {
        $tanamans = Tanaman::latest()->get();
        return view('admin.tanaman.index', compact('tanamans'));
    }

    public function show($id)
    {
        $tanaman = Tanaman::findOrFail($id);
        return response()->json($tanaman);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['nama', 'deskripsi']);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('tanaman', 'public');
        }

        Tanaman::create($data);
        return redirect()->route('admin.tanaman.index')->with('success', 'Tanaman berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $tanaman = Tanaman::findOrFail($id);
        return response()->json($tanaman);
    }

    public function update(Request $request, $id)
    {
        $tanaman = Tanaman::findOrFail($id);

        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['nama', 'deskripsi']);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('tanaman', 'public');
        }

        $tanaman->update($data);
        return redirect()->route('admin.tanaman.index')->with('success', 'Tanaman berhasil diupdate.');
    }

    public function destroy($id)
    {
        $tanaman = Tanaman::findOrFail($id);
        $tanaman->delete();
        return back()->with('success', 'Tanaman berhasil dihapus.');
    }
}
