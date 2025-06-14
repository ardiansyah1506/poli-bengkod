<?php

namespace App\Http\Controllers;

use App\Models\Poli;
use Illuminate\Http\Request;

class PoliController extends Controller
{
    public function index()
    {
        $poli = Poli::all();
        return view('admin.poli.index', compact('poli'));
    }

    public function create()
    {
        return view('admin.poli.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_poli' => 'required|max:50',
            'keterangan' => 'required|max:50',
        ]);

        Poli::create($request->all());

        return redirect()->route('poli.index')->with('success', 'Obat berhasil ditambahkan.');
    }

    public function edit(Poli $poli)
    {
        return view('admin.poli.edit', compact('poli'));
    }

    public function update(Request $request, Poli $poli)
    {
        $request->validate([
            'nama_poli' => 'required|max:50',
            'keterangan' => 'required|max:50',
        ]);

        $poli->update($request->all());

        return redirect()->route('poli.index')->with('success', 'Obat berhasil diperbarui.');
    }

    public function destroy(Poli $poli)
    {
        $poli->delete();

        return redirect()->route('poli.index')->with('success', 'Obat berhasil dihapus.');
    }
}
