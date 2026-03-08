<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MechaDev Hub - Dashboard</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <nav class="col-md-3 col-lg-2 d-md-block sidebar collapse text-white p-4 shadow-lg">
            <div class="position-sticky">
                <div class="d-flex align-items-center mb-5 px-2">
                    <i class="bi bi-cpu-fill text-primary fs-3 me-2"></i>
                    <h5 class="mb-0 fw-bold">MechaDev <span class="text-primary">Hub</span></h5>
                </div>
                
                <div class="text-center mb-5 pb-4 border-bottom border-secondary">
                    @php
                        $userPhoto = 'avatars/' . Auth::user()->username . '.jpg';
                        $userPhotoPng = 'avatars/' . Auth::user()->username . '.png';
                    @endphp

                    <div class="mb-3">
                        @if(file_exists(public_path($userPhoto)))
                            <img src="{{ asset($userPhoto) }}" class="rounded-circle border border-2 border-primary p-1" style="width: 70px; height: 70px; object-fit: cover;">
                        @elseif(file_exists(public_path($userPhotoPng)))
                            <img src="{{ asset($userPhotoPng) }}" class="rounded-circle border border-2 border-primary p-1" style="width: 70px; height: 70px; object-fit: cover;">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=0D6EFD&color=fff" class="rounded-circle" style="width: 70px; height: 70px;">
                        @endif
                    </div>
                    <p class="small fw-bold mb-0 text-truncate px-2">{{ Auth::user()->name }}</p>
                    <span class="badge bg-secondary x-small opacity-75">Mechatronics Eng.</span>
                </div>

                <ul class="nav flex-column">
                    <li class="nav-item"><a class="nav-link active" href="#"><i class="bi bi-speedometer2 me-2"></i> Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="#"><i class="bi bi-person-gear me-2"></i> Profil</a></li>
                    <li class="nav-item"><a class="nav-link" href="#"><i class="bi bi-box-seam me-2"></i> Inventory</a></li>
                    <li class="nav-item mt-5">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-link nav-link text-danger w-100 text-start border-0">
                                <i class="bi bi-power me-2"></i> Keluar
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </nav>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-5 py-5">
            <div class="d-flex justify-content-between align-items-center mb-5">
                <h2 class="fw-bold text-dark">Ringkasan Sistem</h2>
                <span class="badge bg-white text-dark shadow-sm p-2 px-3 rounded-pill border">
                    <i class="bi bi-clock me-1 text-primary"></i> {{ date('l, d M Y') }}
                </span>
            </div>

            <div class="card border-0 shadow-sm rounded-4 mb-5 overflow-hidden bg-glass">
                <div class="card-body p-0">
                    <div class="row g-0">
                        <div class="col-md-4 bg-light p-5 text-center border-end d-flex flex-column align-items-center justify-content-center">
                            <div class="avatar-container mb-4">
                                @if(file_exists(public_path($userPhoto)))
                                    <img src="{{ asset($userPhoto) }}" class="rounded-circle avatar-circle">
                                @elseif(file_exists(public_path($userPhotoPng)))
                                    <img src="{{ asset($userPhotoPng) }}" class="rounded-circle avatar-circle">
                                @else
                                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center avatar-circle shadow-sm">
                                        <span class="fs-1 fw-bold">{{ substr(Auth::user()->name, 0, 1) }}</span>
                                    </div>
                                @endif
                            </div>
                            <h4 class="fw-bold mb-1 text-dark">{{ Auth::user()->name }}</h4>
                            <span class="badge bg-primary-subtle text-primary px-4 rounded-pill border border-primary-subtle py-2">Mahasiswa Aktif</span>
                        </div>
                        
                        <div class="col-md-8 p-5">
                            <h5 class="mb-4 border-bottom pb-2 fw-bold text-muted">Informasi Mahasiswa</h5>
                            
                            <div class="row mb-4">
                                <div class="col-sm-4 info-label">Nama Lengkap</div>
                                <div class="col-sm-8 info-value">{{ Auth::user()->name }}</div>
                            </div>
                            <div class="row mb-4">
    <div class="col-sm-4 info-label">NIM</div>
    <div class="col-sm-8 info-value font-monospace text-primary">
        {{ Auth::user()->nim }} </div>
</div>

<div class="row mb-4">
    <div class="col-sm-4 info-label">Alamat Email</div>
    <div class="col-sm-8 info-value">{{ Auth::user()->email }}</div>
</div>

                            <div class="row mb-4">
                                <div class="col-sm-4 info-label">Tempat Lahir</div>
                                <div class="col-sm-8 info-value">{{ Auth::user()->tempat_lahir ?? '-' }}</div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-sm-4 info-label">Tanggal Lahir</div>
                                <div class="col-sm-8 info-value">
                                    {{ Auth::user()->tanggal_lahir ? date('d F Y', strtotime(Auth::user()->tanggal_lahir)) : '-' }}
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-4 info-label">ID Perangkat</div>
                                <div class="col-sm-8 info-value text-muted small">#{{ str_pad(Auth::user()->id, 5, '0', STR_PAD_LEFT) }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card stat-card bg-primary text-white shadow h-100">
                        <div class="card-body p-4">
                            <i class="bi bi-layers fs-1 opacity-25 mb-3 d-block"></i>
                            <h6 class="text-uppercase small fw-bold opacity-75">Total Proyek</h6>
                            <h2 class="fw-bold mb-0">12 Unit</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card stat-card bg-white shadow-sm h-100 border-start border-success border-5">
                        <div class="card-body p-4">
                            <i class="bi bi-shield-check text-success fs-1 mb-3 d-block"></i>
                            <h6 class="text-muted small fw-bold">KEAMANAN DATA</h6>
                            <h2 class="fw-bold text-success mb-0">OPTIMAL</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card stat-card bg-white shadow-sm h-100 border-start border-warning border-5">
                        <div class="card-body p-4">
                            <i class="bi bi-lightning-charge text-warning fs-1 mb-3 d-block"></i>
                            <h6 class="text-muted small fw-bold">RESPON SISTEM</h6>
                            <h2 class="fw-bold mb-0 text-dark">89 ms</h2>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>