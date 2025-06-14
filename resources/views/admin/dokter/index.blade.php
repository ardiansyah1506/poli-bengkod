@extends('layouts.app')
@section('content')
    <div class="card shadow-sm">
        <div class="bg-primary p-3 text-white d-flex justify-content-between">
            <h1 class="h4 mb-0">Daftar Dokter</h1>
            <a href="{{ route('dokter.create') }}" class="btn btn-success">
                <i class="bi bi-plus-circle"></i> Tambah Dokter
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
                            <th>No. HP</th>
                            <th>Poli</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dokters as $dokter)
                            <tr>
                                <td>{{ $dokter->nama }}</td>
                                <td>{{ $dokter->alamat }}</td>
                                <td>{{ $dokter->email }}</td>
                                <td>{{ $dokter->no_hp }}</td>
                                <td>{{ $dokter->poli->nama_poli ?? '-' }}</td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a href="{{ route('dokter.edit', $dokter->id) }}" class="btn btn-sm btn-warning">
                                            <i class="bi bi-pencil"></i> Edit
                                        </a>
                                        <form action="{{ route('dokter.destroy', $dokter->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus dokter ini?')">
                                                <i class="bi bi-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
