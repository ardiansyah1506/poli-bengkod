@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header bg-primary text-white">
        <h4>Riwayat Pemeriksaan Pasien</h4>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped align-middle">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pasien</th>
                    <th>Keluhan</th>
                    <th>NIK</th>
                    <th>No HP</th>
                    <th>No RM</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1; @endphp
                @foreach($pasiens as $pasien)
                    @foreach($pasien->daftarPoli as $dp)
                        @if($dp->periksa)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $pasien->nama }}</td>
                                <td>{{ $dp->keluhan }}</td>
                                <td>{{ $pasien->no_ktp }}</td>
                                <td>{{ $pasien->no_hp }}</td>
                                <td>{{ $pasien->no_rm }}</td>
                                <td>
                                    <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#modalRiwayat{{ $pasien->id }}">
                                        <i class="fas fa-eye"></i> Detail Riwayat Periksa
                                    </button>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Modal diletakkan DI LUAR table --}}
@foreach($pasiens as $pasien)
    @if($pasien->daftarPoli->whereNotNull('periksa')->count())
        <div class="modal fade" id="modalRiwayat{{ $pasien->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $pasien->id }}" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="modalLabel{{ $pasien->id }}">Riwayat {{ $pasien->nama }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead class="thead-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal Periksa</th>
                                        <th>Nama Pasien</th>
                                        <th>Nama Dokter</th>
                                        <th>Keluhan</th>
                                        <th>Catatan</th>
                                        <th>Obat</th>
                                        <th>Biaya Periksa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pasien->daftarPoli as $i => $dp)
                                        @if($dp->periksa)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $dp->periksa->tgl_periksa }}</td>
                                                <td>{{ $pasien->nama }}</td>
                                                <td>{{ $dp->jadwal->dokter->nama ?? '-' }}</td>
                                                <td>{{ $dp->keluhan }}</td>
                                                <td>{{ $dp->periksa->catatan }}</td>
                                                <td>
                                                    <ul class="pl-3 mb-0">
                                                        @foreach($dp->periksa->detailPeriksa as $detail)
                                                            <li>{{ $detail->obat->nama_obat ?? '-' }}</li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>Rp {{ number_format($dp->periksa->biaya_periksa, 0, ',', '.') }}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endforeach

  
@endsection
