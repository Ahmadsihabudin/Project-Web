@extends('layouts.app')

@section('title', 'Dashboard Admin - Ujian Online')

@section('sidebar')
<div class="position-sticky pt-3">
    <div class="text-center mb-4">
        <h4 class="text-white">
            <i class="bi bi-mortarboard me-2"></i>
            Ujian Online
        </h4>
    </div>

    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link active" href="#" data-page="dashboard">
                <i class="bi bi-speedometer2 me-2"></i>
                Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/exam/exam" data-page="exams">
                <i class="bi bi-file-text me-2"></i>
                Ujian
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/exam/questions" data-page="questions">
                <i class="bi bi-question-circle me-2"></i>
                Bank Soal
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/exam/participants" data-page="participants">
                <i class="bi bi-people me-2"></i>
                Peserta
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/exam/proctoring" data-page="proctoring">
                <i class="bi bi-camera-video me-2"></i>
                Pengawas
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/exam/reports" data-page="reports">
                <i class="bi bi-graph-up me-2"></i>
                Laporan
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/exam/settings" data-page="settings">
                <i class="bi bi-gear me-2"></i>
                Pengaturan
            </a>
        </li>
        <li class="nav-item mt-4">
            <a class="nav-link" href="/exam/candidate" data-page="candidate">
                <i class="bi bi-person-check me-2"></i>
                Tampilan Peserta
            </a>
        </li>
    </ul>
</div>
@endsection

@section('navbar')
<button class="btn btn-outline-secondary d-md-none" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar">
    <i class="bi bi-list"></i>
</button>
<h1 class="h2" id="pageTitle">Dashboard</h1>
<div class="btn-toolbar mb-2 mb-md-0">
    <div class="btn-group me-2">
        <button type="button" class="btn btn-sm btn-outline-secondary">
            <i class="bi bi-download me-1"></i>
            Ekspor
        </button>
    </div>
    <div class="dropdown">
        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
            <i class="bi bi-person-circle me-1"></i>
            <span id="userName">Admin</span>
        </button>
        <ul class="dropdown-menu">
            <li>
                <a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i>Profil</a>
            </li>
            <li>
                <a class="dropdown-item" href="#"><i class="bi bi-gear me-2"></i>Pengaturan</a>
            </li>
            <li>
                <hr class="dropdown-divider" />
            </li>
            <li>
                <a class="dropdown-item" href="#" onclick="logout()"><i class="bi bi-box-arrow-right me-2"></i>Keluar</a>
            </li>
        </ul>
    </div>
</div>
@endsection

@section('content')
<!-- Dashboard Page -->
<div id="dashboardPage" class="page-content">
    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stats-card">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Total Ujian</div>
                            <div class="h5 mb-0 font-weight-bold">24</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-file-text fa-2x text-white-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stats-card">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Peserta</div>
                            <div class="h5 mb-0 font-weight-bold">1,234</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-people fa-2x text-white-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stats-card">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Ujian Aktif</div>
                            <div class="h5 mb-0 font-weight-bold">8</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-play-circle fa-2x text-white-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stats-card">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Nilai Rata-rata</div>
                            <div class="h5 mb-0 font-weight-bold">78.5%</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-graph-up fa-2x text-white-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Exams Table -->
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">
                <i class="bi bi-clock-history me-2"></i>
                Ujian Terbaru
            </h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Nama Ujian</th>
                            <th>Peserta</th>
                            <th>Durasi</th>
                            <th>Status</th>
                            <th>Dibuat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-file-text me-2 text-primary"></i>
                                    <div>
                                        <div class="fw-bold">Ujian Akhir Matematika</div>
                                        <small class="text-muted">MATH-101</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-info">45/50</span>
                            </td>
                            <td>120 min</td>
                            <td><span class="badge bg-success">Aktif</span></td>
                            <td>2 jam yang lalu</td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary me-1" title="Pantau">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-secondary me-1" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-danger" title="Hentikan">
                                    <i class="bi bi-stop-circle"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-file-text me-2 text-primary"></i>
                                    <div>
                                        <div class="fw-bold">Kuis Fisika</div>
                                        <small class="text-muted">PHYS-201</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-warning">12/30</span>
                            </td>
                            <td>60 min</td>
                            <td><span class="badge bg-warning">Sedang Berlangsung</span></td>
                            <td>1 hari yang lalu</td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary me-1" title="Pantau">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-secondary me-1" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-danger" title="Hentikan">
                                    <i class="bi bi-stop-circle"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-file-text me-2 text-primary"></i>
                                    <div>
                                        <div class="fw-bold">Ujian Kimia</div>
                                        <small class="text-muted">CHEM-301</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-success">25/25</span>
                            </td>
                            <td>90 min</td>
                            <td><span class="badge bg-secondary">Selesai</span></td>
                            <td>3 hari yang lalu</td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary me-1" title="Lihat Hasil">
                                    <i class="bi bi-bar-chart"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-secondary me-1" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-success" title="Terbitkan Ulang">
                                    <i class="bi bi-arrow-clockwise"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // CSRF Token
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Logout function
    async function logout() {
        if (confirm('Apakah Anda yakin ingin logout?')) {
            try {
                const response = await fetch('/auth/logout', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({
                        user_type: 'admin',
                        user_id: 1
                    })
                });

                const result = await response.json();

                if (result.success) {
                    window.location.href = '/';
                } else {
                    alert('Logout gagal. Silakan coba lagi.');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat logout.');
            }
        }
    }

    // Initialize user info
    function initializeUserInfo() {
        const userName = document.getElementById('userName');
        if (userName) {
            userName.textContent = 'Admin Ujian Online';
        }
    }

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function() {
        initializeUserInfo();
    });
</script>
@endpush