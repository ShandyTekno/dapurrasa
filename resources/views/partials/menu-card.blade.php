@php
    $waText = urlencode("Halo DapurRasa, saya tertarik untuk memesan: *" . $menu->nama_menu . "* seharga " . $menu->harga_rupiah . ". Mohon info cara pemesanannya.");
    $waCardLink = "https://wa.me/" . config('dapurrasa.whatsapp') . "?text=" . $waText;
@endphp
<div class="card card-menu h-100">
    <div class="card-menu-img-wrapper">
        <img src="{{ $menu->foto_url }}" class="card-img-top" alt="{{ $menu->nama_menu }}" loading="lazy" style="cursor: zoom-in" onclick="openMaxsizeModal('{{ $menu->foto_url }}', '{{ addslashes($menu->nama_menu) }}')" title="Klik untuk lihat foto ukuran maksimal">
        <span class="card-menu-badge">
            <i class="bi bi-tag-fill me-1"></i>{{ $menu->kategori->nama_kategori }}
        </span>
        <button type="button" class="card-menu-zoom-btn" onclick="openMaxsizeModal('{{ $menu->foto_url }}', '{{ addslashes($menu->nama_menu) }}')" title="Lihat Foto Ukuran Maksimal">
            <i class="bi bi-arrows-fullscreen"></i>
        </button>
        <a href="{{ $waCardLink }}" target="_blank" rel="noopener" class="card-menu-wa-quick" title="Pesan menu ini langsung via WhatsApp">
            <i class="bi bi-whatsapp"></i>
        </a>
    </div>
    <div class="card-body">
        <h5 class="card-title">{{ $menu->nama_menu }}</h5>
        <p class="card-deskripsi">{{ $menu->deskripsi }}</p>
        <div class="card-menu-footer">
            <div>
                <small class="text-muted d-block" style="font-size:0.75rem">Mulai dari</small>
                <p class="harga">{{ $menu->harga_rupiah }}</p>
            </div>
            <a href="{{ route('menu.show', $menu) }}" class="btn btn-outline-hijau btn-card-detail">
                <span>Detail</span>
                <i class="bi bi-arrow-right arrow-icon"></i>
            </a>
        </div>
    </div>
</div>
