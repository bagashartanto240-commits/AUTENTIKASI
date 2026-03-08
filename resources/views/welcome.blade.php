<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
        body { font-family: 'DM Sans', sans-serif; }
        .main-title { font-family: 'Syne', sans-serif; }
        .text-gradient {
            background: linear-gradient(45deg, #0d6efd, #6610f2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .animate-float {
            animation: float 3s ease-in-out infinite;
        }
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }
        .navbar { backdrop-filter: blur(10px); background: rgba(255,255,255,0.8); }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg fixed-top border-bottom py-3">
        <div class="container">
            <a href="/" class="navbar-brand fw-bold fs-4">
                {{ config('app.name', 'App') }}<span class="text-primary">.</span>
            </a>
            
            <div class="ms-auto d-flex align-items-center gap-3">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn btn-outline-primary rounded-pill px-4">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-decoration-none fw-medium text-dark">Login</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-primary rounded-pill px-4">Register</a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    <main class="hero-section">
        <div class="container">
            <div class="row align-items-center min-vh-100 g-5">
                
                <div class="col-lg-6 order-2 order-lg-1">
                    <h1 class="display-3 fw-bold main-title mb-4">
                        Kelola <span class="text-gradient">Eksistensi</span> <br>Digital Anda.
                    </h1>
                    <p class="lead text-secondary mb-5">
                        Satu platform untuk semua kebutuhan identitas Anda. Pantau aktivitas, amankan data, dan kembangkan profil profesional dalam hitungan detik.
                    </p>

                    <div class="row g-4 mb-5">
                        <div class="col-sm-6">
                            <div class="p-3 border rounded shadow-sm bg-white">
                                <i class="bi bi-shield-lock text-primary fs-3"></i>
                                <h6 class="mt-2 fw-bold">Keamanan Ketat</h6>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="p-3 border rounded shadow-sm bg-white">
                                <i class="bi bi-cpu text-primary fs-3"></i>
                                <h6 class="mt-2 fw-bold">Sistem Pintar</h6>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 order-1 order-lg-2 text-center">
                    <div class="hero-visual position-relative">
                        <img src="{{ asset('img/1.jpg') }}" alt="Hero Image" 
                             class="img-fluid rounded-4 shadow-lg animate-float" 
                             style="max-height: 500px; width: 100%; object-fit: cover;">
                    </div>
                </div>

            </div>
        </div>
    </main>

    <footer class="py-5 border-top bg-light">
        <div class="container d-md-flex justify-content-between align-items-center text-center text-md-start">
            <p class="mb-0 text-secondary">&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
            <div class="footer-links mt-3 mt-md-0">
                <a href="#" class="text-decoration-none text-secondary me-4">Kebijakan Privasi</a>
                <a href="#" class="text-decoration-none text-secondary">Pusat Bantuan</a>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>