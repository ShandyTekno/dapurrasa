@extends('layouts.public')
@section('title', 'Tentang Kami')
@section('content')

<div class="page-header">
    <div class="container text-center">
        <h1 class="display-5 fw-bold mb-2">Tentang DapurRasa</h1>
        <p class="lead mb-0 text-white-50">Mengenal lebih dekat dedikasi dan cita rasa terbaik persembahan PT EL Capcay.</p>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="row g-5 align-items-center mb-5">
            <div class="col-lg-6">
                <span class="section-tag">Profil Perusahaan</span>
                <h2 class="section-title mb-3">PT EL Capcay</h2>
                <p class="text-secondary mb-3 leading-relaxed">
                    <strong>PT EL Capcay</strong> adalah entitas profesional yang bergerak di industri kuliner dan tata boga katering. Berawal dari kepedulian kami akan kebutuhan konsumsi harian yang lezat, higienis, dan terjangkau, kami hadir menjadi mitra terpercaya bagi ribuan pelanggan individu, komunitas, serta korporat.
                </p>
                <h4 class="text-hijau fw-bold mt-4 mb-2">Brand DapurRasa</h4>
                <p class="text-secondary leading-relaxed">
                    <strong>DapurRasa</strong> adalah brand unggulan milik PT EL Capcay yang berfokus pada penyediaan variasi nasi kotak (rice box) dan paket catering prasmanan berstandar tinggi. Dari menu sarapan kantor hingga perhelatan resepsi akbar, kami siap memberikan rasa yang memuaskan dan berkesan di setiap suapan.
                </p>
            </div>
            <div class="col-lg-6">
                <div class="p-4 p-md-5 bg-white rounded-4 shadow-sm border">
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="trust-icon"><i class="bi bi-compass"></i></div>
                        <div>
                            <h4 class="fw-bold mb-0 text-dark">Visi Kami</h4>
                            <small class="text-muted">Arah & Tujuan Utama</small>
                        </div>
                    </div>
                    <p class="text-secondary mb-4 pb-3 border-bottom">
                        Menjadi pilihan nomor satu layanan catering dan nasi kotak yang terpercaya, konsisten dalam rasa lezat, dan terdepan dalam pelayanan prima di Indonesia.
                    </p>

                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="trust-icon"><i class="bi bi-bullseye"></i></div>
                        <div>
                            <h4 class="fw-bold mb-0 text-dark">Misi Kami</h4>
                            <small class="text-muted">Langkah Nyata Pelayanan</small>
                        </div>
                    </div>
                    <ul class="list-unstyled d-flex flex-column gap-2 text-secondary small mb-0">
                        <li class="d-flex gap-2 align-items-start">
                            <i class="bi bi-check2-circle text-success fs-6 mt-1"></i>
                            <span>Mengolah bahan pangan segar pilihan secara higienis dan bersertifikat halal.</span>
                        </li>
                        <li class="d-flex gap-2 align-items-start">
                            <i class="bi bi-check2-circle text-success fs-6 mt-1"></i>
                            <span>Menyediakan keanekaragaman varian menu tradisional dan modern yang fleksibel.</span>
                        </li>
                        <li class="d-flex gap-2 align-items-start">
                            <i class="bi bi-check2-circle text-success fs-6 mt-1"></i>
                            <span>Menetapkan standar harga yang ramah anggaran dengan porsi yang memuaskan.</span>
                        </li>
                        <li class="d-flex gap-2 align-items-start">
                            <i class="bi bi-check2-circle text-success fs-6 mt-1"></i>
                            <span>Menjunjung tinggi ketepatan waktu pengantaran dan keramahan pelayanan pelanggan.</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
