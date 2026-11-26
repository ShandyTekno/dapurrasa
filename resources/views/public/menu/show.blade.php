@extends('layouts.public')
@section('title', $menu->nama_menu)
@section('content')

@php
    $waTextDetail = urlencode("Halo DapurRasa, saya ingin memesan menu *" . $menu->nama_menu . "* (" . $menu->harga_rupiah . "). Apakah tersedia untuk jadwal acara saya?");
    $waUrl = "https://wa.me/" . config('dapurrasa.whatsapp') . "?text=" . $waTextDetail;
@endphp

<div class="bg-white border-bottom py-3">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 small">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none text-muted">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('menu.index') }}" class="text-decoration-none text-muted">Katalog Menu</a></li>
                <li class="breadcrumb-item active text-hijau fw-semibold" aria-current="page">{{ $menu->nama_menu }}</li>
            </ol>
        </nav>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="row g-5 align-items-center">

            <div class="col-lg-6">
                <div class="detail-img-wrapper position-relative" style="cursor: zoom-in" onclick="openMaxsizeModal('{{ $menu->foto_url }}', '{{ addslashes($menu->nama_menu) }}')" title="Klik untuk lihat foto ukuran maksimal (Full Resolution)">
                    <img src="{{ $menu->foto_url }}" alt="{{ $menu->nama_menu }}" class="detail-img">
                    <span class="badge bg-dark bg-opacity-75 text-white position-absolute bottom-0 end-0 m-3 px-3 py-2 rounded-pill shadow-sm" style="backdrop-filter: blur(4px)">
                        <i class="bi bi-arrows-fullscreen me-1"></i> Klik untuk Ukuran Maksimal
                    </span>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="p-lg-2">
                    <span class="badge bg-hijau-soft text-hijau px-3 py-2 rounded-pill fw-semibold mb-3">
                        <i class="bi bi-tag-fill me-1"></i>{{ $menu->kategori->nama_kategori }}
                    </span>
                    <h1 class="section-title mb-2">{{ $menu->nama_menu }}</h1>

                    <div class="d-inline-block bg-white p-3 rounded-4 shadow-sm border my-3">
                        <span class="text-muted small d-block mb-1">Harga per Porsi</span>
                        <p class="harga fs-2 mb-0">{{ $menu->harga_rupiah }}</p>
                    </div>

                    <div class="my-4">
                        <h6 class="fw-bold text-dark mb-2">Deskripsi Hidangan:</h6>
                        <p class="text-secondary leading-relaxed">{{ $menu->deskripsi }}</p>
                    </div>

                    <div class="row g-2 mb-4">
                        <div class="col-6">
                            <div class="d-flex align-items-center gap-2 small text-muted">
                                <i class="bi bi-check-circle-fill text-success fs-5"></i>
                                <span>Bahan 100% Segar & Halal</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex align-items-center gap-2 small text-muted">
                                <i class="bi bi-check-circle-fill text-success fs-5"></i>
                                <span>Kemasan Bersih & Rapi</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex align-items-center gap-2 small text-muted">
                                <i class="bi bi-check-circle-fill text-success fs-5"></i>
                                <span>Sendok & Tisu Lengkap</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex align-items-center gap-2 small text-muted">
                                <i class="bi bi-check-circle-fill text-success fs-5"></i>
                                <span>Antar Tepat Waktu</span>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-wrap gap-3 pt-2">
                        <a href="{{ $waUrl }}" target="_blank" rel="noopener" class="btn btn-aksen btn-lg px-4 shadow">
                            <i class="bi bi-whatsapp"></i> Pesan via WhatsApp
                        </a>
                        <a href="{{ route('menu.index') }}" class="btn btn-outline-hijau btn-lg px-4">
                            <i class="bi bi-arrow-left"></i> Kembali ke Katalog
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
