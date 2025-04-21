@extends('layouts.app')
@section('content_header_title','Periksa')
@section('content_header_subtitle','')


@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="p-3 bg-primary text-white d-flex justify-content-between align-items-center">
            <h1 class="h4 mb-0">Daftar Pemeriksaan</h1>
            <a href="{{ route('periksa.create') }}" class="btn btn-success ">
                <i class="bi bi-plus-circle"></i> Tambah Pemeriksaan
            </a>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Tanggal Periksa</th>
                            <th>Pasien</th>
                            <th>Dokter</th>
                            <th>Obat</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($periksas as $index => $periksa)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ \Carbon\Carbon::parse($periksa->tgl_periksa)->format('d/m/Y') }}</td>
                            <td>{{ $periksa->pasien->name }}</td>
                            <td>{{ $periksa->dokter->name }}</td>
                            <td>
                                {{ $periksa->detailPeriksa->first()?->obat?->name_obat ?? 'Tidak ada' }}
                            </td>
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                   
                                    <a href="{{ route('periksa.edit', $periksa->id) }}" class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    <form action="{{ route('periksa.destroy', $periksa->id) }}" method="POST" class="d-inline">
                                        @csrf 
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus data pemeriksaan ini?')">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada data pemeriksaan</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

