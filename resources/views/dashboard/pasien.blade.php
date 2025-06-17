<div class="container-fluid">
    <div class="alert alert-info">
        Selamat datang, <strong>{{ $pasien->nama }}</strong>! Berikut ringkasan kunjungan Anda.
    </div>

    <div class="row">
        <div class="col-md-6 col-12">
            <div class="info-box bg-info">
                <span class="info-box-icon">
                    <i class="fas fa-hospital-user"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Kunjungan</span>
                    <span class="info-box-number">{{ $totalKunjungan }}</span>
                    <div class="progress">
                        <div class="progress-bar" style="width: 70%"></div>
                    </div>
                    <span class="progress-description">Semua kunjungan</span>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-12">
            <div class="info-box bg-success">
                <span class="info-box-icon">
                    <i class="fas fa-stethoscope"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">Sudah Diperiksa</span>
                    <span class="info-box-number">{{ $totalPemeriksaan }}</span>
                    <div class="progress">
                        <div class="progress-bar" style="width: 50%"></div>
                    </div>
                    <span class="progress-description">Pemeriksaan selesai</span>
                </div>
            </div>
        </div>
    </div>
</div>
