@extends('layouts.app')
@section('content')
<div class="card shadow-sm">
    
     <div class="bg-primary p-3 text-white d-flex justify-content-between ">
            <h1 class="h4 mb-0">Daftar Poli</h1>
            <a href="{{ route('daftar-poli.create') }}" class="btn btn-success ">
                <i class="bi bi-plus-circle"></i> Periksa
            </a>
        </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Poli</th>
                        <th>Dokter</th>
                        <th>Hari</th>
                        <th>Mulai</th>
                        <th>Selesai</th>
                        <th>Antrian</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($daftarPolis as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->jadwal->dokter->poli->nama_poli ?? '-' }}</td>
                        <td>{{ $item->jadwal->dokter->nama ?? '-' }}</td>
                        <td>{{ $item->jadwal->nama_hari }}</td>
                        <td>{{ $item->jadwal->jam_mulai }}</td>
                        <td>{{ $item->jadwal->jam_selesai }}</td>
                        <td>{{ $item->antrian }}</td>
                        <td>
                            <span class="badge {{ $item->status_periksa == 'Selesai' ? 'bg-success' : 'bg-warning text-dark' }}">
                                {{ $item->status_periksa }}
                            </span>
                        </td>
                        <td class="text-center">
                            @if ($item->status_periksa === 'Menunggu')
                                <a href="{{ route('daftar-poli.edit', $item->id) }}" class="btn btn-sm btn-primary">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>
                            @else
                                <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#detailModal{{ $item->id }}">
                                    <i class="bi bi-eye"></i> Lihat
                                </button>

                                {{-- Modal Detail Periksa --}}
                                <div class="modal fade" id="detailModal{{ $item->id }}" tabindex="-1" 
                                    aria-labelledby="modalLabel{{ $item->id }}" aria-hidden="true">
                                   <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                       <div class="modal-content">
                                           <!-- Modal Header -->
                                           <div class="modal-header bg-primary">
                                               <h4 class="modal-title text-white">
                                                   <i class="fas fa-file-medical mr-2"></i>
                                                   Detail Pemeriksaan
                                               </h4>
                                               <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                   <span aria-hidden="true">&times;</span>
                                               </button>
                                           </div>
                               
                                           <!-- Modal Body -->
                                           <div class="modal-body">
                                               <!-- Detail Pemeriksaan -->
                                               <div class="card card-outline card-success mb-3">
                                                   <div class="card-header">
                                                       <h3 class="card-title">
                                                           <i class="fas fa-stethoscope mr-2"></i>
                                                           Detail Pemeriksaan
                                                       </h3>
                                                   </div>
                                                   <div class="card-body">
                                                       <div class="row mb-3">
                                                           <div class="col-md-4">
                                                               <strong>Tanggal Periksa:</strong>
                                                           </div>
                                                           <div class="col-md-8">
                                                               <span class="badge badge-info">
                                                                   <i class="fas fa-calendar mr-1"></i>
                                                                   {{ \Carbon\Carbon::parse($item->periksa->tgl_periksa)->format('d M Y H:i') }}
                                                               </span>
                                                           </div>
                                                       </div>
                               
                                                       <div class="row mb-3">
                                                           <div class="col-md-4">
                                                               <strong>Biaya Pemeriksaan:</strong>
                                                           </div>
                                                           <div class="col-md-8">
                                                               <span class="badge badge-success badge-lg">
                                                                   <i class="fas fa-money-bill mr-1"></i>
                                                                   Rp {{ number_format($item->periksa->biaya_periksa, 0, ',', '.') }}
                                                               </span>
                                                           </div>
                                                       </div>
                               
                                                       <div class="row">
                                                           <div class="col-12">
                                                               <strong>Catatan Pemeriksaan:</strong>
                                                               <div class="callout callout-info mt-2">
                                                                   <p class="mb-0">
                                                                       {{ $item->periksa->catatan ?: 'Tidak ada catatan khusus' }}
                                                                   </p>
                                                               </div>
                                                           </div>
                                                       </div>
                                                   </div>
                                               </div>
                               
                                               <!-- Obat yang Diberikan -->
                                               <div class="card card-outline card-warning">
                                                   <div class="card-header">
                                                       <h3 class="card-title">
                                                           <i class="fas fa-pills mr-2"></i>
                                                           Obat yang Diberikan
                                                       </h3>
                                                   </div>
                                                   <div class="card-body">
                                                       @if($item->periksa->detailPeriksa && $item->periksa->detailPeriksa->count() > 0)
                                                           <div class="table-responsive">
                                                               <table class="table table-sm table-striped">
                                                                   <thead class="thead-light">
                                                                       <tr>
                                                                           <th width="5%">#</th>
                                                                           <th width="40%">Nama Obat</th>
                                                                           <th width="25%">Kemasan</th>
                                                                           <th width="30%">Harga</th>
                                                                       </tr>
                                                                   </thead>
                                                                   <tbody>
                                                                       @foreach ($item->periksa->detailPeriksa as $index => $detail)
                                                                           <tr>
                                                                               <td>{{ $index + 1 }}</td>
                                                                               <td>
                                                                                   <strong>{{ $detail->obat->nama_obat ?? 'Obat tidak ditemukan' }}</strong>
                                                                               </td>
                                                                               <td>
                                                                                   <span class="badge badge-secondary">
                                                                                       {{ $detail->obat->kemasan ?? '-' }}
                                                                                   </span>
                                                                               </td>
                                                                               <td>
                                                                                   <span class="text-success font-weight-bold">
                                                                                       Rp {{ number_format($detail->obat->harga ?? 0, 0, ',', '.') }}
                                                                                   </span>
                                                                               </td>
                                                                           </tr>
                                                                       @endforeach
                                                                   </tbody>
                                                               </table>
                                                           </div>
                               
                                                           <!-- Total Biaya Obat -->
                                                           <div class="row mt-3">
                                                               <div class="col-12">
                                                                   <div class="callout callout-success">
                                                                       <h5>
                                                                           <i class="fas fa-calculator mr-2"></i>
                                                                           Total Biaya Obat: 
                                                                           <span class="float-right">
                                                                               Rp {{ number_format($item->periksa->detailPeriksa->sum(function($detail) { 
                                                                                   return $detail->obat->harga ?? 0; 
                                                                               }), 0, ',', '.') }}
                                                                           </span>
                                                                       </h5>
                                                                   </div>
                                                               </div>
                                                           </div>
                                                       @else
                                                           <div class="alert alert-info">
                                                               <i class="fas fa-info-circle mr-2"></i>
                                                               Tidak ada obat yang diberikan untuk pemeriksaan ini.
                                                           </div>
                                                       @endif
                                                   </div>
                                               </div>
                               
                                               <!-- Ringkasan Total -->
                                               <div class="card card-outline card-primary">
                                                   <div class="card-header">
                                                       <h3 class="card-title">
                                                           <i class="fas fa-receipt mr-2"></i>
                                                           Ringkasan Biaya
                                                       </h3>
                                                   </div>
                                                   <div class="card-body">
                                                       <div class="row">
                                                           <div class="col-md-6">
                                                               <p class="mb-1">Biaya Pemeriksaan:</p>
                                                               <p class="mb-1">Biaya Obat:</p>
                                                               <hr>
                                                               <h5>Total Keseluruhan:</h5>
                                                           </div>
                                                           <div class="col-md-6 text-right">
                                                               <p class="mb-1">Rp 150.000</p>
                                                               <p class="mb-1">
                                                                   Rp {{ number_format($item->periksa->detailPeriksa->sum(function($detail) { 
                                                                       return $detail->obat->harga ?? 0; 
                                                                   }), 0, ',', '.') }}
                                                               </p>
                                                               <hr>
                                                               <h5 class="text-primary">
                                                                   Rp {{ number_format(
                                                                       150000 + 
                                                                       $item->periksa->detailPeriksa->sum(function($detail) { 
                                                                           return $detail->obat->harga ?? 0; 
                                                                       }), 0, ',', '.'
                                                                   ) }}
                                                               </h5>
                                                           </div>
                                                       </div>
                                                   </div>
                                               </div>
                                           </div>
                               
                                        
                                       </div>
                                   </div>
                               </div>
                               
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection


@push('scripts')
<script>
function printDetail(id) {
    // Implementasi print functionality
    window.print();
}

function downloadPDF(id) {
    // Implementasi download PDF functionality
    window.location.href = `/pemeriksaan/${id}/pdf`;
}
</script>
@endpush
