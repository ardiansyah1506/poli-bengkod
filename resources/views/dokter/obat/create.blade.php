@extends('layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h1 class="h4 mb-0">Tambah Obat</h1>
                </div>
                <div class="card-body">
                    <form action="{{ route('obat.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name_obat" class="form-label">Nama Obat</label>
                            <input type="text" id="name_obat" name="name_obat" class="form-control @error('name_obat') is-invalid @enderror" required>
                            @error('name_obat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="kemasan" class="form-label">Kemasan</label>
                            <input type="text" id="kemasan" name="kemasan" class="form-control @error('kemasan') is-invalid @enderror" required>
                            @error('kemasan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="harga" class="form-label">Harga</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" id="harga" name="harga" class="form-control @error('harga') is-invalid @enderror" required>
                                @error('harga')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('obat.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
