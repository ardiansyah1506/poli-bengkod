@extends('layouts.app')
@section('content')
<div class="card">
    <div class="card-header bg-primary text-white">
        <h4>Daftar Pemeriksaan</h4>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Pasien</th>
                    <th>Keluhan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($periksas as $periksa)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $periksa->pasien->nama ?? '-' }}</td>
                    <td>{{ $periksa->keluhan ?? '-' }}</td>
                        <td class="text-center">
                            <a href="{{ route('periksa.edit', $periksa->id) }}" class="btn btn-sm {{ $periksa->periksa ? 'btn-warning' : 'btn-primary' }}">
                                <i class="bi {{ $periksa->periksa ? 'bi-pencil' : 'bi-plus-circle' }}"></i>
                                {{ $periksa->periksa ? 'Edit' : 'Periksa' }}
                            </a>
                        </td>
                </tr>
                @endforeach
                @if($periksas->isEmpty())
                <tr>
                    <td colspan="4" class="text-center">Belum ada data periksa.</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
