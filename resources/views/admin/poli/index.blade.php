@extends('layouts.app')
@section('content')
    <div class="card shadow-sm">
        <div class="bg-primary p-3 text-white d-flex justify-content-between ">
            <h1 class="h4 mb-0">Daftar Poli</h1>
            <a href="{{ route('poli.create') }}" class="btn btn-success ">
                <i class="bi bi-plus-circle"></i> Tambah Poli
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Nama</th>
                            <th>Keterangan</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($poli as $p)
                        <tr>
                            <td>{{ $p->nama_poli }}</td>
                            <td>{{ $p->keterangan }}</td>
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('poli.edit', $p->id) }}" class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    <form action="{{ route('poli.destroy', $p->id) }}" method="POST" class="d-inline">
                                        @csrf 
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus Poli ini?')">
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
