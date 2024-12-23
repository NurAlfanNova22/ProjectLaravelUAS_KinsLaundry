<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Kins Laundry')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-light shadow-sm w-100">
        <div class="container-fluid px-4">
            <a class="navbar-brand fw-bold text-primary" href="#">Kins Laundry</a>
            <div class="d-flex align-items-center">
                @if(auth()->check())
                    <span class="me-3">Hi, {{ auth()->user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-link text-danger">Logout</button>
                    </form>
                @else
                    <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a>
                @endif
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 sidebar">
                <div class="py-4 text-center">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="img-fluid" style="max-width: 100px; height: auto;">
                    <h4>Kins Laundry</h4>
                    <p class="small text-muted">Your laundry partner</p>
                </div>
                <ul class="nav flex-column px-3">
                    @if(auth()->check())
                        @if(auth()->user()->role === 'admin')
                            <!-- Menu untuk Admin -->
                            <li class="nav-item mb-2">
                                <a class="nav-link {{ Request::is('admin') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                                    <i class="bi bi-speedometer2 me-2"></i> Dashboard Admin
                                </a>
                            </li>
                            <li class="nav-item mb-2">
                                <a class="nav-link {{ Request::is('admin/pesanan') ? 'active' : '' }}" href="{{ route('admin.pesanan') }}">
                                    <i class="bi bi-clipboard-data me-2"></i> Manajemen Pesanan
                                </a>
                            </li>
                            <li class="nav-item mb-2">
                                <a class="nav-link {{ Request::is('admin/laporan') ? 'active bg-primary text-white' : 'text-dark' }}" href="{{ route('admin.laporan') }}">
                                    <i class="bi bi-bar-chart me-2"></i> Laporan Keuangan
                                </a>
                            </li>
                        @else
                            <!-- Menu untuk User -->
                            <li class="nav-item mb-2">
                                <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                                    <i class="bi bi-speedometer2 me-2"></i> Status Cucian
                                </a>
                            </li>
                        @endif
                    @else
                        <!-- Informasi untuk Pengguna Belum Login -->
                        <div class="text-center mt-4">
                            <p class="text-muted">Silakan <a data-bs-toggle="modal" href="#" data-bs-target="#loginModal" class="text-primary">login</a> terlebih dahulu untuk mengakses menu ini.</p>
                        </div>
                    @endif
                </ul>
            </div>

            <!-- Main Content -->
            <main class="col-md-10 bg-white">
                @if(auth()->check())
                    @yield('content')
                @else
                    <div class="text-center mt-5">
                        <h3 class="text-muted">Silakan login terlebih dahulu untuk mengakses fitur ini.</h3>
                        <p class="text-muted">Klik tombol di pojok kanan atas untuk login.</p>
                    </div>
                @endif
            </main>
        </div>
    </div>

    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">Login</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form Login -->
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" id="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Login</button>
                    </form>
                    <!-- Tombol Register -->
                    <div class="text-center mt-3">
                        <p>Belum punya akun? 
                            <a href="#" data-bs-toggle="modal" data-bs-target="#registerModal" data-bs-dismiss="modal">Daftar di sini</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="registerModalLabel">Register</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <!-- Form Register -->
                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" name="name" class="form-control" id="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" id="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" required>
                        </div>
                        <button type="submit" class="btn btn-success w-100">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
