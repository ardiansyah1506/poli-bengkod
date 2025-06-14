@extends('layouts.app')
@section('content')
    <div class="card shadow-sm">
        <div class="bg-primary p-3 text-white d-flex justify-content-between">
            <h1 class="h4 mb-0">Daftar Pasien</h1>
            <a href="{{ route('pasien.create') }}" class="btn btn-success">
                <i class="bi bi-plus-circle"></i> Tambah Pasien
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Email</th>
                            <th>No. KTP</th>
                            <th>No. HP</th>
                            <th>No. RM</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pasiens as $pasien)
                        <tr>
                            <td>{{ $pasien->nama }}</td>
                            <td>{{ $pasien->alamat }}</td>
                            <td>{{ $pasien->email }}</td>
                            <td>{{ $pasien->no_ktp }}</td>
                            <td>{{ $pasien->no_hp }}</td>
                            <td>{{ $pasien->no_rm }}</td>
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('pasien.edit', $pasien->id) }}" class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    <form action="{{ route('pasien.destroy', $pasien->id) }}" method="POST" class="d-inline">
                                        @csrf 
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus pasien ini?')">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @if($pasiens->isEmpty())
                            <tr>
                                <td colspan="7" class="text-center">Belum ada data pasien.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
