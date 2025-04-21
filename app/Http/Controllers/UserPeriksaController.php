<?php

namespace App\Http\Controllers;

use App\Models\DetailPeriksa;
use App\Models\Obat;
use App\Models\Periksa;
use App\Models\User;
use Illuminate\Http\Request;

class UserPeriksaController extends Controller
{
    public function index()
    {
        $users = User::all();
        $obat =Obat::all();
        return view('pasien.periksa.index', compact('users','obat'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'id_pasien' => 'required|exists:users,id',
            'id_dokter' => 'required|exists:users,id',
        ]);
         Periksa::create(
            [
                'tgl_periksa' =>now(),
                'id_pasien' =>$request->id_pasien,
                'id_dokter' =>$request->id_dokter,
            ]
         );
       
        return redirect()->back()->with('success', 'Data periksa berhasil ditambahkan.');
    }
}
