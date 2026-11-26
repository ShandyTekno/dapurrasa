<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'DapurRasa') - PT EL Capcay</title>

    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <link href="{{ asset('css/dapurrasa.css') }}" rel="stylesheet">
</head>
<body>
@php
    $waNumber = config('dapurrasa.whatsapp');
    $wa = 'https://wa.me/' . $waNumber . '?text=' . urlencode('Halo DapurRasa, saya ingin bertanya tentang pemesanan catering.');
    $gmailUrl = 'https://mail.google.com/mail/?view=cm&fs=1&to=' . urlencode(config('dapurrasa.email')) . '&su=' . urlencode('Pertanyaan Pemesanan Catering - DapurRasa') . '&body=' . urlencode('Halo DapurRasa, saya ingin bertanya mengenai pemesanan menu catering.');
@endphp

<nav class="navbar navbar-expand-lg navbar-dark navbar-modern sticky-top">
    <div class="container">
        <a class="navbar-brand text-white d-flex align-items-center gap-2" href="{{ route('home') }}">
            <img src="{{ asset('images/logo.png') }}" alt="Logo DapurRasa" class="logo-img">
            <span class="d-flex flex-column" style="line-height:1.15">
                <span>Dapur<span style="color:var(--oranye)">Rasa</span></span>
                <small class="text-white-50" style="font-size:0.65rem;letter-spacing:1px;font-weight:700">PT EL CAPCAY</small>
            </span>
        </a>
        <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#nav" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="nav">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-1 my-2 my-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                        <i class="bi bi-house-door me-1 d-none d-lg-inline"></i>Beranda
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('menu.*') ? 'active' : '' }}" href="{{ route('menu.index') }}">
                        <i class="bi bi-grid me-1 d-none d-lg-inline"></i>Menu Catering
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('tentang') ? 'active' : '' }}" href="{{ route('tentang') }}">
                        <i class="bi bi-info-circle me-1 d-none d-lg-inline"></i>Tentang Kami
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('kontak') ? 'active' : '' }}" href="{{ route('kontak') }}">
                        <i class="bi bi-telephone me-1 d-none d-lg-inline"></i>Kontak
                    </a>
                </li>
                <li class="nav-item ms-lg-2 mt-2 mt-lg-0">
                    <a class="btn btn-aksen btn-sm px-3" href="{{ $wa }}" target="_blank" rel="noopener">
                        <i class="bi bi-whatsapp"></i> WhatsApp
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<main>
    @yield('content')
</main>

<a href="{{ $wa }}" target="_blank" rel="noopener" class="floating-wa" title="Hubungi kami via WhatsApp">
    <i class="bi bi-whatsapp"></i>
</a>

<footer class="footer">
    <div class="container">
        <div class="row g-4 mb-4">
            <div class="col-lg-5 col-md-6">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo DapurRasa" class="footer-logo">
                    <div>
                        <h5 class="text-white mb-0 fw-bold">Dapur<span style="color:var(--oranye)">Rasa</span></h5>
                        <small class="text-white-50" style="font-size:0.75rem;letter-spacing:0.8px;font-weight:600">PT EL CAPCAY</small>
                    </div>
                </div>
                <p class="small text-secondary mb-3" style="max-width:380px;">
                    DapurRasa adalah layanan catering & nasi kotak profesional dari <strong>PT EL Capcay</strong>. Menyajikan cita rasa nusantara lezat, higienis, dan terjangkau untuk setiap acara spesial Anda.
                </p>
                <div class="d-flex gap-2">
                    <a href="{{ $wa }}" target="_blank" rel="noopener" class="footer-social-btn" title="WhatsApp"><i class="bi bi-whatsapp"></i></a>
                    <button type="button" class="footer-social-btn border-0" data-bs-toggle="modal" data-bs-target="#emailWarningModal" title="Kirim Email via Gmail"><i class="bi bi-envelope"></i></button>
                    <a href="{{ config('dapurrasa.gmaps') }}" target="_blank" rel="noopener" class="footer-social-btn" title="Buka di Google Maps"><i class="bi bi-geo-alt"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <h6 class="text-white mb-3">Tautan Cepat</h6>
                <ul class="list-unstyled small d-flex flex-column gap-2 mb-0">
                    <li><a href="{{ route('home') }}"><i class="bi bi-chevron-right me-1 small"></i> Beranda</a></li>
                    <li><a href="{{ route('menu.index') }}"><i class="bi bi-chevron-right me-1 small"></i> Katalog Menu</a></li>
                    <li><a href="{{ route('tentang') }}"><i class="bi bi-chevron-right me-1 small"></i> Tentang Kami</a></li>
                    <li><a href="{{ route('kontak') }}"><i class="bi bi-chevron-right me-1 small"></i> Kontak & Pemesanan</a></li>
                    <li><a href="{{ route('login') }}"><i class="bi bi-shield-lock me-1 small"></i> Login Pengelola</a></li>
                </ul>
            </div>
            <div class="col-lg-4 col-md-12">
                <h6 class="text-white mb-3">Informasi Kontak</h6>
                <div class="d-flex flex-column gap-2 small text-secondary">
                    <div class="d-flex gap-2 align-items-start">
                        <i class="bi bi-geo-alt text-oranye fs-6"></i>
                        <div>
                            <span class="d-block">{{ config('dapurrasa.alamat') }}</span>
                            <a href="{{ config('dapurrasa.gmaps') }}" target="_blank" rel="noopener" class="btn btn-sm btn-outline-light mt-2 py-1 px-3 rounded-pill" style="font-size:0.78rem">
                                <i class="bi bi-map me-1"></i> Buka di Google Maps
                            </a>
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                        <i class="bi bi-whatsapp text-oranye fs-6"></i>
                        <span>+{{ config('dapurrasa.whatsapp') }}</span>
                    </div>
                    <div class="d-flex gap-2">
                        <i class="bi bi-envelope text-oranye fs-6"></i>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#emailWarningModal" class="text-secondary text-decoration-none">{{ config('dapurrasa.email') }}</a>
                    </div>
                </div>
            </div>
        </div>
        <hr class="border-secondary opacity-25">
        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center small text-secondary py-2">
            <p class="mb-2 mb-sm-0">&copy; {{ date('Y') }} <strong>PT EL Capcay</strong>. Hak cipta dilindungi undang-undang.</p>
            <p class="mb-0">Dibuat dengan cita rasa untuk Indonesia.</p>
        </div>
    </div>
</footer>

<div class="modal fade" id="emailWarningModal" tabindex="-1" aria-labelledby="emailWarningModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow-lg overflow-hidden">
            <div class="modal-header border-0 pb-0 pt-4 px-4">
                <div class="d-flex align-items-center gap-2">
                    <span class="d-inline-flex align-items-center justify-content-center rounded-circle" style="width:42px;height:42px;background:var(--oranye-soft);color:var(--oranye);font-size:1.25rem">
                        <i class="bi bi-exclamation-circle-fill"></i>
                    </span>
                    <h5 class="modal-title fw-bold text-dark mb-0" id="emailWarningModalLabel">Pemberitahuan Kirim Email</h5>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body px-4 py-3">
                <p class="text-secondary mb-2">
                    <strong>Mungkin pesan Anda lama terbaca karena Anda mengirim pesan lewat email.</strong>
                </p>
                <p class="small text-muted mb-0">
                    Jika membutuhkan respon cepat (<em>Fast Response</em>), kami sarankan menghubungi kami melalui <strong>WhatsApp</strong>. Namun Anda tetap dapat melanjutkan mengirim pesan langsung ke Gmail <strong>{{ config('dapurrasa.email') }}</strong>.
                </p>
            </div>
            <div class="modal-footer border-0 px-4 pb-4 pt-2 d-flex flex-column flex-sm-row gap-2">
                <a href="{{ $wa }}" target="_blank" rel="noopener" class="btn btn-hijau flex-fill d-inline-flex align-items-center justify-content-center gap-2">
                    <i class="bi bi-whatsapp"></i> Chat WhatsApp Saja
                </a>
                <a href="{{ $gmailUrl }}" target="_blank" rel="noopener" class="btn btn-aksen flex-fill d-inline-flex align-items-center justify-content-center gap-2" onclick="bootstrap.Modal.getInstance(document.getElementById('emailWarningModal'))?.hide()">
                    <i class="bi bi-envelope-arrow-up"></i> Lanjut ke Gmail
                </a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="imageMaxsizeModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content bg-transparent border-0 shadow-none">
            <div class="modal-header border-0 pb-0 justify-content-end">
                <button type="button" class="btn btn-dark btn-sm rounded-circle p-2 shadow-lg" data-bs-dismiss="modal" aria-label="Close" style="width:38px;height:38px;display:flex;align-items:center;justify-content:center">
                    <i class="bi bi-x-lg text-white"></i>
                </button>
            </div>
            <div class="modal-body text-center p-2">
                <img id="maxsizeModalImg" src="" alt="Foto Menu Maxsize" class="img-fluid rounded-4 shadow-lg border" style="max-height:82vh;object-fit:contain;background:#ffffff">
                <div class="mt-3">
                    <h5 id="maxsizeModalTitle" class="text-white fw-bold mb-1" style="text-shadow: 0 2px 4px rgba(0,0,0,0.8)"></h5>
                    <span class="badge bg-warning text-dark px-3 py-1 rounded-pill">Ukuran Penuh (Max Size)</span>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
function openMaxsizeModal(imgUrl, title) {
    const modalImg = document.getElementById('maxsizeModalImg');
    const modalTitle = document.getElementById('maxsizeModalTitle');
    if (modalImg) modalImg.src = imgUrl;
    if (modalTitle) modalTitle.textContent = title || '';
    const modalEl = document.getElementById('imageMaxsizeModal');
    if (modalEl) {
        const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
        modal.show();
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const revealEls = document.querySelectorAll('.reveal-up');
    if (!revealEls.length) return;

    if ('IntersectionObserver' in window) {
        const observer = new IntersectionObserver((entries, obs) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    obs.unobserve(entry.target);
                }
            });
        }, { threshold: 0.12 });
        revealEls.forEach(el => observer.observe(el));
    } else {
        revealEls.forEach(el => el.classList.add('is-visible'));
    }
});
</script>
@stack('scripts')
</body>
</html>
