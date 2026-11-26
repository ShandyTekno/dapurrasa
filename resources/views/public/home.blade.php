@extends('layouts.public')
@section('title', 'Beranda')
@section('content')

@php
    $waHome = 'https://wa.me/' . config('dapurrasa.whatsapp') . '?text=' . urlencode('Halo DapurRasa, saya ingin konsultasi menu catering untuk acara saya.');
@endphp

<section class="hero">
    <div class="container position-relative" style="z-index: 2;">
        <div class="row align-items-center g-5">
            <div class="col-lg-7">
                <div class="hero-badge">
                    <i class="bi bi-stars text-warning"></i>
                    <span>Catering &amp; Nasi Kotak Pilihan No. 1</span>
                </div>
                <h1 class="display-4">Hidangan Lezat untuk Setiap Momen Berharga</h1>
                <p class="lead">
                    DapurRasa dari <strong>PT EL Capcay</strong> menyajikan nasi kotak dan paket catering lezat dengan cita rasa otentik rumahan, bahan selalu segar, higienis, dan pengantaran tepat waktu.
                </p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="{{ route('menu.index') }}" class="btn btn-aksen btn-lg px-4 shadow">
                        <i class="bi bi-grid-fill"></i> Jelajahi Menu
                    </a>
                    <a href="{{ $waHome }}" target="_blank" rel="noopener" class="btn btn-outline-light btn-lg px-4" style="border-radius:12px;font-weight:600">
                        <i class="bi bi-whatsapp"></i> Tanya WhatsApp
                    </a>
                </div>
            </div>

            @if ($menus->isNotEmpty())
            <div class="col-lg-5">
                <div class="hero-showcase-wrap" id="heroFoodShowcase">
                    <div class="hero-showcase-glow"></div>
                    <div class="hero-showcase-card">
                        <div class="hero-showcase-stage">
                            @foreach ($menus as $idx => $item)
                                <a href="{{ route('menu.show', $item) }}" class="showcase-slide {{ $idx === 0 ? 'active' : '' }}" data-slide-index="{{ $idx }}">
                                    <img src="{{ $item->foto_url }}" alt="{{ $item->nama_menu }}">
                                    <div class="showcase-gradient"></div>
                                    <span class="showcase-top-badge">
                                        <i class="bi bi-fire text-oranye"></i> {{ $item->kategori->nama_kategori }}
                                    </span>
                                    <div class="showcase-caption">
                                        <div>
                                            <h5>{{ $item->nama_menu }}</h5>
                                            <small class="text-white-50">Klik untuk lihat detail menu &rarr;</small>
                                        </div>
                                        <span class="showcase-price-pill">{{ $item->harga_rupiah }}</span>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                        <div class="showcase-controls">
                            <span class="small text-white-50 d-inline-flex align-items-center gap-1">
                                <i class="bi bi-sparkles text-warning"></i> Sajian Pilihan
                            </span>
                            <div class="showcase-dots" id="heroShowcaseDots">
                                @foreach ($menus as $idx => $item)
                                    <button type="button" class="showcase-dot {{ $idx === 0 ? 'active' : '' }}" data-target="{{ $idx }}" aria-label="Menu {{ $idx + 1 }}"></button>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</section>

<div class="container trust-bar">
    <div class="row g-3">
        <div class="col-6 col-lg-3 reveal-up">
            <div class="trust-card">
                <div class="trust-icon"><i class="bi bi-clock-history"></i></div>
                <div>
                    <h6 class="fw-bold mb-1">Tepat Waktu</h6>
                    <small class="text-muted">Pengiriman selalu terjamin</small>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3 reveal-up" style="transition-delay: 80ms">
            <div class="trust-card">
                <div class="trust-icon"><i class="bi bi-shield-check"></i></div>
                <div>
                    <h6 class="fw-bold mb-1">100% Higienis</h6>
                    <small class="text-muted">Bahan segar &amp; bersertifikat</small>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3 reveal-up" style="transition-delay: 160ms">
            <div class="trust-card">
                <div class="trust-icon"><i class="bi bi-wallet2"></i></div>
                <div>
                    <h6 class="fw-bold mb-1">Harga Pas</h6>
                    <small class="text-muted">Pilihan paket hemat &amp; lengkap</small>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3 reveal-up" style="transition-delay: 240ms">
            <div class="trust-card">
                <div class="trust-icon"><i class="bi bi-heart-pulse"></i></div>
                <div>
                    <h6 class="fw-bold mb-1">Cita Rasa Mantap</h6>
                    <small class="text-muted">Racikan resep khas nusantara</small>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="text-center section-header reveal-up">
            <span class="section-tag">Pilihan Favorit</span>
            <h2 class="section-title">Menu Unggulan</h2>
            <p class="text-muted mx-auto" style="max-width:550px">
                Nikmati hidangan paling diminati oleh pelanggan setia DapurRasa untuk santap rapat kantor, hajatan, hingga katering keluarga.
            </p>
        </div>

        <div class="row g-4">
            @forelse ($menus as $menu)
                <div class="col-sm-6 col-lg-4 reveal-up" style="transition-delay: {{ ($loop->index % 3) * 90 }}ms">
                    @include('partials.menu-card', ['menu' => $menu])
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <i class="bi bi-inbox text-muted display-4 d-block mb-3"></i>
                    <p class="text-muted">Belum ada menu yang ditampilkan.</p>
                </div>
            @endforelse
        </div>

        <div class="text-center mt-5 reveal-up">
            <a href="{{ route('menu.index') }}" class="btn btn-outline-hijau btn-lg px-5 shadow-sm">
                <span>Lihat Semua Menu Catering</span>
                <i class="bi bi-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</section>

<div class="culinary-marquee" aria-hidden="true">
    <div class="marquee-track">
        @for ($repeat = 0; $repeat < 2; $repeat++)
            @foreach ($menus as $m)
                <span class="marquee-item">
                    <span class="marquee-dot"></span>
                    <span>{{ $m->nama_menu }}</span>
                    <small class="text-white-50">({{ $m->harga_rupiah }})</small>
                </span>
            @endforeach
            <span class="marquee-item"><span class="marquee-dot"></span> 100% Bahan Segar &amp; Halal</span>
            <span class="marquee-item"><span class="marquee-dot"></span> Antar Tepat Waktu</span>
            <span class="marquee-item"><span class="marquee-dot"></span> PT EL Capcay Catering</span>
        @endfor
    </div>
</div>

<section class="section bg-krem">
    <div class="container">
        <div class="text-center section-header reveal-up">
            <span class="section-tag">Kenapa Memilih Kami?</span>
            <h2 class="section-title">Keunggulan DapurRasa</h2>
            <p class="text-muted mx-auto" style="max-width:550px">
                Dedikasi kami untuk memberikan pengalaman kuliner katering terbaik di setiap hidangan yang kami sajikan.
            </p>
        </div>

        <div class="row g-4">
            @foreach ([
                ['bi bi-award', 'Bahan Berkualitas Tinggi', 'Kami hanya menggunakan bahan baku pilihan segar setiap hari dari pemasok terpercaya yang diolah higienis.'],
                ['bi bi-journals', 'Menu Beragam & Fleksibel', 'Puluhan varian menu katering dari nasi kotak, prasmanan, hingga snack box sesuai kebutuhan acara Anda.'],
                ['bi bi-tags', 'Harga Terjangkau & Transparan', 'Pilihan harga bersahabat tanpa biaya tersembunyi dengan porsi kenyang dan mantap.'],
                ['bi bi-truck', 'Pelayanan & Pengiriman Prima', 'Didukung oleh tim dapur berpengalaman dan armada pengantaran yang siap sedia tepat waktu.']
            ] as $idx => [$icon, $judul, $deskripsi])
                <div class="col-sm-6 col-lg-3 reveal-up" style="transition-delay: {{ $idx * 80 }}ms">
                    <div class="fitur">
                        <div class="ikon">
                            <i class="{{ $icon }}"></i>
                        </div>
                        <h5 class="fw-bold mb-2">{{ $judul }}</h5>
                        <p class="text-muted mb-0 small" style="line-height:1.6">{{ $deskripsi }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<section class="py-5" style="background: linear-gradient(135deg, var(--hijau) 0%, var(--hijau-gelap) 100%); color:#fff">
    <div class="container text-center py-4 reveal-up">
        <h3 class="fw-bold mb-3">Punya Kebutuhan Catering Khusus untuk Acara Anda?</h3>
        <p class="text-light opacity-75 mb-4 mx-auto" style="max-width:620px">
            Diskusikan anggaran, porsi, dan preferensi menu bersama tim konsultan DapurRasa via WhatsApp sekarang juga.
        </p>
        <a href="{{ $waHome }}" target="_blank" rel="noopener" class="btn btn-aksen btn-lg px-4 shadow">
            <i class="bi bi-whatsapp me-1"></i> Konsultasi Gratis Sekarang
        </a>
    </div>
</section>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const showcase = document.getElementById('heroFoodShowcase');
    if (!showcase) return;

    const slides = showcase.querySelectorAll('.showcase-slide');
    const dots = showcase.querySelectorAll('.showcase-dot');
    if (slides.length <= 1) return;

    let current = 0;
    let timer = null;

    function goToSlide(index) {
        slides[current].classList.remove('active');
        if (dots[current]) dots[current].classList.remove('active');
        current = (index + slides.length) % slides.length;
        slides[current].classList.add('active');
        if (dots[current]) dots[current].classList.add('active');
    }

    function startAuto() {
        stopAuto();
        timer = setInterval(() => goToSlide(current + 1), 3500);
    }

    function stopAuto() {
        if (timer) clearInterval(timer);
    }

    dots.forEach((dot, idx) => {
        dot.addEventListener('click', () => {
            goToSlide(idx);
            startAuto();
        });
    });

    showcase.addEventListener('mouseenter', stopAuto);
    showcase.addEventListener('mouseleave', startAuto);

    startAuto();
});
</script>
@endpush
