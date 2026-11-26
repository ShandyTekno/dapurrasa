@extends('layouts.public')
@section('title', 'Kontak')
@section('content')

@php
    $waNumber = config('dapurrasa.whatsapp');
    $waChat = 'https://wa.me/' . $waNumber . '?text=' . urlencode('Halo DapurRasa, saya ingin menanyakan informasi pemesanan catering.');
    $gmapsUrl = config('dapurrasa.gmaps');
@endphp

<div class="page-header">
    <div class="container text-center">
        <h1 class="display-5 fw-bold mb-2">Hubungi Kami</h1>
        <p class="lead mb-0 text-white-50">Kami siap membantu kebutuhan konsumsi dan pesanan catering acara Anda dengan senang hati.</p>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="row g-4 justify-content-center">

            <div class="col-md-4">
                <div class="fitur text-center">
                    <div class="ikon mx-auto">
                        <i class="bi bi-geo-alt-fill"></i>
                    </div>
                    <h5 class="fw-bold mb-2">Alamat Dapur</h5>
                    <p class="text-secondary small mb-3">{{ config('dapurrasa.alamat') }}</p>
                    <a class="btn btn-outline-hijau btn-sm px-4" target="_blank" rel="noopener" href="{{ $gmapsUrl }}">
                        <i class="bi bi-map me-1"></i> Buka di Google Maps
                    </a>
                </div>
            </div>

            <div class="col-md-4">
                <div class="fitur text-center border-success" style="border-width: 1.5px">
                    <div class="ikon mx-auto" style="background:#eafaf1;color:#25d366">
                        <i class="bi bi-whatsapp"></i>
                    </div>
                    <h5 class="fw-bold mb-2">WhatsApp Fast Response</h5>
                    <p class="text-secondary small mb-3">+{{ $waNumber }}</p>
                    <a class="btn btn-aksen btn-sm px-4" target="_blank" rel="noopener" href="{{ $waChat }}">
                        <i class="bi bi-chat-dots me-1"></i> Chat Sekarang
                    </a>
                </div>
            </div>

            <div class="col-md-4">
                <div class="fitur text-center">
                    <div class="ikon mx-auto">
                        <i class="bi bi-envelope-paper-fill"></i>
                    </div>
                    <h5 class="fw-bold mb-2">Email Resmi</h5>
                    <p class="text-secondary small mb-3">{{ config('dapurrasa.email') }}</p>
                    <button type="button" class="btn btn-outline-hijau btn-sm px-4" data-bs-toggle="modal" data-bs-target="#emailWarningModal">
                        <i class="bi bi-send me-1"></i> Kirim Pesan
                    </button>
                </div>
            </div>
        </div>

        <div class="mt-5 p-4 p-md-5 bg-white rounded-4 shadow-sm border text-center">
            <h4 class="fw-bold text-dark mb-2">Ingin Konsultasi Menu &amp; Tes Rasa?</h4>
            <p class="text-muted mx-auto mb-4" style="max-width: 580px">
                Untuk pemesanan jumlah besar (acara kantor, pernikahan, syukuran, atau gathering), Anda dapat menjadwalkan konsultasi khusus bersama koki dan manajer kami.
            </p>
            <a href="{{ $waChat }}" target="_blank" rel="noopener" class="btn btn-aksen btn-lg px-4 shadow">
                <i class="bi bi-whatsapp me-2"></i> Hubungi Konsultan Catering Kami
            </a>
        </div>
    </div>
</section>
@endsection
