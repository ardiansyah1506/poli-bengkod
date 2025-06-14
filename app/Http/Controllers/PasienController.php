<?php

namespace App\Http\Controllers;

use App\Helpers\GeneralHelper;
use App\Models\Pasien;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    public function index()
    {
        $pasiens = Pasien::all();
        return view('admin.pasien.index', compact('pasiens'));
    }

    public function create()
    {
        $generatedNoRM = GeneralHelper::generateNoRM();
        return view('admin.pasien.create', compact('generatedNoRM'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:100',
            'alamat' => 'required|max:255',
            'email' => 'nullable|email|max:100',
            'no_ktp' => 'required|max:20|unique:pasien,no_ktp',
            'no_hp' => 'required|max:15',
            'no_rm' => 'required|max:20|unique:pasien,no_rm',
        ]);

        Pasien::create($request->all());
            User::create([
                'email' => $request->email,
                'role' => 'pasien',
                'password' => Hash::make('password'), // Password default 'password'
            ]);
        return redirect()->route('pasien.index')->with('success', 'Pasien berhasil ditambahkan.');
    }

    public function edit(Pasien $pasien)
    {
        return view('admin.pasien.edit', compact('pasien'));
    }

    public function update(Request $request, Pasien $pasien)
    {
        $request->validate([
            'nama' => 'required|max:100',
            'alamat' => 'required|max:255',
            'email' => 'nullable|email|max:100',
            'no_ktp' => 'required|max:20|unique:pasien,no_ktp,' . $pasien->id,
            'no_hp' => 'required|max:15',
            'no_rm' => 'required|max:20|unique:pasien,no_rm,' . $pasien->id,
        ]);

        $pasien->update($request->all());

        return redirect()->route('pasien.index')->with('success', 'Pasien berhasil diperbarui.');
    }

    public function destroy(Pasien $pasien)
    {
        $pasien->delete();

        return redirect()->route('pasien.index')->with('success', 'Pasien berhasil dihapus.');
    }
}
