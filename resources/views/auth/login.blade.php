<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Admin - DapurRasa</title>

    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <link href="{{ asset('css/dapurrasa.css') }}" rel="stylesheet">
</head>
<body style="background: radial-gradient(circle at top right, #ebf5f2 0%, #f8f6f1 55%, #f2ece0 100%); min-height: 100vh;">
<div class="container d-flex align-items-center justify-content-center py-5" style="min-height:100vh">
    <div class="card border-0 shadow-lg rounded-4 overflow-hidden" style="max-width:440px;width:100%">
        <div class="card-header bg-hijau text-white text-center py-4 border-0">
            <img src="{{ asset('images/logo.png') }}" alt="Logo DapurRasa" class="login-logo mb-2">
            <h3 class="fw-bold mb-0 text-white">Dapur<span style="color:var(--oranye)">Rasa</span></h3>
            <small class="text-white-50">Portal Masuk Pengelola Sistem &bull; PT EL Capcay</small>
        </div>
        <div class="card-body p-4 p-md-5 bg-white">
            <form method="POST" action="{{ route('login.store') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-semibold text-dark small">Alamat Email</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light text-muted border-end-0"><i class="bi bi-envelope"></i></span>
                        <input type="email" name="email" value="{{ old('email') }}" class="form-control border-start-0 ps-0 @error('email') is-invalid @enderror" placeholder="nama@dapurrasa.com" required autofocus>
                    </div>
                    @error('email')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold text-dark small">Kata Sandi</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light text-muted border-end-0"><i class="bi bi-lock"></i></span>
                        <input type="password" name="password" class="form-control border-start-0 ps-0 @error('password') is-invalid @enderror" placeholder="••••••••" required>
                    </div>
                    @error('password')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                </div>
                <div class="form-check mb-4">
                    <input class="form-check-input" type="checkbox" name="remember" id="r">
                    <label class="form-check-label small text-muted" for="r">Ingat sesi saya</label>
                </div>
                <button class="btn btn-aksen w-100 py-2 shadow-sm fw-bold">
                    <i class="bi bi-box-arrow-in-right me-1"></i> Masuk Sekarang
                </button>
            </form>
            <a href="{{ route('home') }}" class="d-flex align-items-center justify-content-center gap-1 text-center mt-4 small text-muted text-decoration-none">
                <i class="bi bi-arrow-left"></i> Kembali ke Beranda Website
            </a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
