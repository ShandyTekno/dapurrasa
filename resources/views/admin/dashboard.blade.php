@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')
<div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3 mb-4">
    <div>
        <h2 class="fw-bold mb-1">Dashboard</h2>
        <p class="text-muted small mb-0">Ringkasan status data menu katering DapurRasa secara real-time.</p>
    </div>
    <a href="{{ route('admin.menu.create') }}" class="btn btn-aksen shadow-sm">
        <i class="bi bi-plus-lg"></i> Tambah Menu Baru
    </a>
</div>

<div class="row g-4 mb-4">
    <div class="col-sm-6">
        <a href="{{ route('admin.kategori.index') }}" class="stat-card">
            <div class="d-flex align-items-center justify-content-between position-relative" style="z-index:2">
                <div class="d-flex align-items-center gap-3">
                    <div class="trust-icon" style="background:var(--hijau-soft);color:var(--hijau)">
                        <i class="bi bi-tags-fill"></i>
                    </div>
                    <div>
                        <span class="text-muted small fw-semibold d-block">Total Kategori</span>
                        <span class="display-6 fw-bold text-hijau">{{ $totalKategori }}</span>
                    </div>
                </div>
                <span class="badge bg-hijau-soft text-hijau rounded-pill px-3 py-2 small fw-semibold">
                    Kelola <i class="bi bi-arrow-right stat-arrow ms-1"></i>
                </span>
            </div>
        </a>
    </div>
    <div class="col-sm-6">
        <a href="{{ route('admin.menu.index') }}" class="stat-card stat-amber">
            <div class="d-flex align-items-center justify-content-between position-relative" style="z-index:2">
                <div class="d-flex align-items-center gap-3">
                    <div class="trust-icon" style="background:var(--oranye-soft);color:var(--oranye)">
                        <i class="bi bi-card-checklist"></i>
                    </div>
                    <div>
                        <span class="text-muted small fw-semibold d-block">Total Menu Hidangan</span>
                        <span class="display-6 fw-bold text-oranye">{{ $totalMenu }}</span>
                    </div>
                </div>
                <span class="badge rounded-pill px-3 py-2 small fw-semibold" style="background:var(--oranye-soft);color:var(--oranye-hover)">
                    Kelola <i class="bi bi-arrow-right stat-arrow ms-1"></i>
                </span>
            </div>
        </a>
    </div>
</div>

<div class="table-card">
    <div class="table-card-header">
        <div class="table-card-title">
            <span class="table-card-icon"><i class="bi bi-clock-history"></i></span>
            <div>
                <h6 class="fw-bold mb-0 text-dark">Menu Terbaru</h6>
                <small class="text-muted">Klik header kolom untuk mengurutkan atau klik foto untuk perbesar</small>
            </div>
        </div>
        <div class="d-flex flex-wrap align-items-center gap-2 ms-auto">
            <div class="table-search-box">
                <i class="bi bi-search search-icon"></i>
                <input type="text" id="dashboardMenuSearch" class="form-control form-control-sm" placeholder="Cari menu terbaru...">
                <button type="button" id="dashboardMenuClear" class="table-search-clear" title="Hapus pencarian">
                    <i class="bi bi-x-circle-fill"></i>
                </button>
            </div>
            <a href="{{ route('admin.menu.index') }}" class="btn btn-sm btn-outline-hijau rounded-pill px-3">
                Semua Menu <i class="bi bi-arrow-right ms-1"></i>
            </a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table modern-table align-middle" id="dashboardMenuTable">
            <thead>
                <tr>
                    <th style="width: 85px">Foto</th>
                    <th class="sortable-th" data-sort-type="text">
                        Nama Menu <i class="bi bi-arrow-down-up sort-icon"></i>
                    </th>
                    <th class="sortable-th" data-sort-type="text">
                        Kategori <i class="bi bi-arrow-down-up sort-icon"></i>
                    </th>
                    <th class="sortable-th" data-sort-type="number">
                        Harga <i class="bi bi-arrow-down-up sort-icon"></i>
                    </th>
                    <th class="text-end" style="width: 170px">Aksi</th>
                </tr>
            </thead>
            <tbody>
            @forelse ($menuTerbaru as $m)
                <tr data-row data-search="{{ $m->nama_menu }} {{ $m->kategori->nama_kategori }} {{ $m->harga }}">
                    <td data-label="Foto">
                        <div class="thumb-zoom-wrap" onclick="openMaxsizeModal('{{ $m->foto_url }}', '{{ addslashes($m->nama_menu) }}')" title="Klik untuk lihat ukuran maksimal">
                            <img src="{{ $m->foto_url }}" class="thumb border" alt="{{ $m->nama_menu }}">
                            <span class="thumb-zoom-overlay"><i class="bi bi-zoom-in"></i></span>
                        </div>
                    </td>
                    <td data-label="Nama Menu" data-sort-value="{{ $m->nama_menu }}">
                        <div class="fw-bold text-dark">{{ $m->nama_menu }}</div>
                        <small class="text-muted d-none d-md-inline">{{ \Illuminate\Support\Str::limit($m->deskripsi, 48) }}</small>
                    </td>
                    <td data-label="Kategori" data-sort-value="{{ $m->kategori->nama_kategori }}">
                        <span class="badge bg-hijau-soft text-hijau rounded-pill px-3 py-2 fw-semibold">
                            <i class="bi bi-tag-fill me-1 small"></i>{{ $m->kategori->nama_kategori }}
                        </span>
                    </td>
                    <td data-label="Harga" data-sort-value="{{ $m->harga }}">
                        <span class="fw-bold text-hijau fs-6">{{ $m->harga_rupiah }}</span>
                    </td>
                    <td data-label="Aksi" class="text-end">
                        <div class="d-inline-flex gap-1">
                            <a href="{{ route('menu.show', $m) }}" target="_blank" class="btn-action btn-action-view" title="Lihat di Website">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('admin.menu.edit', $m) }}" class="btn-action btn-action-edit">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="empty-cell text-center text-muted py-5">
                        <i class="bi bi-inbox display-6 d-block mb-2 opacity-50"></i>
                        Belum ada menu yang terdaftar.
                    </td>
                </tr>
            @endforelse
                <tr id="dashboardMenuNoMatch" style="display: none;">
                    <td colspan="5" class="empty-cell text-center text-muted py-4">
                        <i class="bi bi-search me-1"></i> Tidak ada menu yang cocok dengan pencarian Anda.
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="table-card-footer">
        <span id="dashboardMenuCount" class="fw-medium"></span>
        <span><i class="bi bi-info-circle me-1 text-hijau"></i>Tips: Klik foto untuk preview ukuran penuh</span>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    initInteractiveTable({
        tableId: 'dashboardMenuTable',
        searchId: 'dashboardMenuSearch',
        clearId: 'dashboardMenuClear',
        countId: 'dashboardMenuCount',
        noMatchId: 'dashboardMenuNoMatch'
    });
});
</script>
@endpush
