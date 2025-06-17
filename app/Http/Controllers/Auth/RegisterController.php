<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\GeneralHelper;
use App\Http\Controllers\Controller;
use App\Models\Pasien;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    use RegistersUsers;

    // Setelah registrasi, arahkan user ke dashboard sesuai role
    protected function redirectTo()
    {

        return '/dashboard';
    }

    // Hanya bisa diakses oleh tamu (belum login)
    public function __construct()
    {
        $this->middleware('guest');
    }

    // Validasi input form registrasi
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'alamat'   => ['required', 'string', 'max:255'],
            'no_hp'    => ['required', 'string', 'max:255'],
            'no_ktp'   => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    // Simpan user ke tabel `users` dan `pasiens`
    protected function create(array $data)
    {
        // Simpan ke tabel users
        User::create([
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
            'role'     => 'pasien',
        ]);

        // Simpan ke tabel pasien
        return Pasien::create([
            'nama'    => $data['name'],
            'email'   => $data['email'],
            'alamat'  => $data['alamat'],
            'no_hp'   => $data['no_hp'],
            'no_ktp'  => $data['no_ktp'],
            'no_rm'   => GeneralHelper::generateNoRM(),
        ]);
    }

    // Override method register jika ingin memproses manual (opsional)
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        Auth::login(User::where('email', $request->email)->first());

        return redirect($this->redirectPath());
    }
}
