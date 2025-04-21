@extends('layouts.app')

@section('content_header_title','Pasien')
@section('content_header_subtitle','Riwayat Periksa')
@section('content')
    <div class="card shadow-sm">
        <div class="p-3 bg-light text-white d-flex justify-content-between align-items-center">
            <h1 class="h4 mb-0">Riwayat Periksa</h1>
            
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
                            <th>ID Periksa</th>
                            <th>Tanggal Periksa</th>
                            <th>Pasien</th>
                            <th>Dokter</th>
                            <th>Obat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($periksas as $index => $periksa)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ 'P' . str_pad($index + 1, 4, '0', STR_PAD_LEFT) }}</td>
                            <td>{{ \Carbon\Carbon::parse($periksa->tgl_periksa)->format('d/m/Y') }}</td>
                            <td>{{ $periksa->pasien->name }}</td>
                            <td>{{ $periksa->dokter->name }}</td>
                            <td>
                                {{ $periksa->detailPeriksa->first()?->obat?->name_obat ?? 'Tidak ada' }}
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
@endsection
