<?php

namespace App\Http\Controllers;

use App\Models\JenisMakanan;
use Illuminate\Http\Request;

class JenisMakananController extends Controller
{
    public function index()
    {
        $jenisMakanans = JenisMakanan::latest()->get();
        return view('jenis-makanan.index', compact('jenisMakanans'));
    }

    public function create()
    {
        return view('jenis-makanan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
    'nama' => 'required|string|max:255',
]);

JenisMakanan::create($request->only('nama'));

        return redirect()->route('jenis-makanan.index')->with('success', 'Jenis makanan berhasil ditambahkan.');
    }

    public function edit(JenisMakanan $jenisMakanan)
    {
        return view('jenis-makanan.edit', compact('jenisMakanan'));
    }

    public function update(Request $request, JenisMakanan $jenisMakanan)
    {
       $request->validate([
    'nama' => 'required|string|max:255',
]);

$jenisMakanan->update($request->only('nama'));

        return redirect()->route('jenis-makanan.index')->with('success', 'Jenis makanan berhasil diperbarui.');
    }

    public function destroy(JenisMakanan $jenisMakanan)
    {
        $jenisMakanan->delete();

        return redirect()->route('jenis-makanan.index')->with('success', 'Jenis makanan berhasil dihapus.');
    }
}