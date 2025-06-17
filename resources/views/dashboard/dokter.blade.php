<div class="container-fluid">
    <!-- Welcome Message -->
    <div class="row">
        <div class="col-12">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <h4 class="card-title">
                        <i class="fas fa-user-md mr-2"></i>
                        Selamat Datang, Dr. {{ $dokter->nama }}
                    </h4>
                    <p class="card-text text-muted">
                        Selamat bekerja! Berikut adalah ringkasan aktivitas Anda hari ini.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row">
        <!-- Jadwal Praktek -->
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="info-box bg-info">
                <span class="info-box-icon">
                    <i class="fas fa-calendar-alt"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">Jadwal Praktek</span>
                    <span class="info-box-number">{{ $jumlahJadwal }}</span>
                    <div class="progress">
                        <div class="progress-bar" style="width: 70%"></div>
                    </div>
                    <span class="progress-description">
                        Jadwal aktif bulan ini
                    </span>
                </div>
            </div>
        </div>

        <!-- Jumlah Pasien -->
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="info-box bg-success">
                <span class="info-box-icon">
                    <i class="fas fa-users"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Pasien</span>
                    <span class="info-box-number">{{ $jumlahPasien }}</span>
                    <div class="progress">
                        <div class="progress-bar" style="width: 85%"></div>
                    </div>
                    <span class="progress-description">
                        Pasien terdaftar
                    </span>
                </div>
            </div>
        </div>

        <!-- Jumlah Pemeriksaan -->
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="info-box bg-warning">
                <span class="info-box-icon">
                    <i class="fas fa-stethoscope"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Pemeriksaan</span>
                    <span class="info-box-number">{{ $jumlahPemeriksaan }}</span>
                    <div class="progress">
                        <div class="progress-bar" style="width: 60%"></div>
                    </div>
                    <span class="progress-description">
                        Pemeriksaan selesai
                    </span>
                </div>
            </div>
        </div>
    </div>

</div>