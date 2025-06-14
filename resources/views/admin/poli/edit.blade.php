@extends('layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h1 class="h4 mb-0">Edit Poli</h1>
                </div>
                <div class="card-body">
                    <form action="{{ route('poli.update', $poli->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="nama_poli" class="form-label">Nama Poli</label>
                            <input type="text" id="nama_poli" name="nama_poli" value="{{ $poli->nama_poli }}" class="form-control @error('nama_poli') is-invalid @enderror" required>
                            @error('nama_poli')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <input type="text" id="keterangan" name="keterangan" value="{{ $poli->keterangan }}" class="form-control @error('keterangan') is-invalid @enderror" required>
                            @error('keterangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                       
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('poli.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-check-circle"></i> Perbarui
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
