@extends('layouts.admin')
@section('title', 'Menu')
@section('content')
<div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3 mb-4">
    <div>
        <h2 class="fw-bold mb-1">Daftar Menu Catering</h2>
        <p class="text-muted small mb-0">Kelola katalog produk, harga per porsi, kategori, dan foto makanan.</p>
    </div>
    <a href="{{ route('admin.menu.create') }}" class="btn btn-aksen shadow-sm">
        <i class="bi bi-plus-lg"></i> Tambah Menu Baru
    </a>
</div>

<div class="table-card">
    <div class="table-card-header">
        <div class="table-card-title">
            <span class="table-card-icon"><i class="bi bi-card-checklist"></i></span>
            <div>
                <h6 class="fw-bold mb-0 text-dark">Semua Hidangan</h6>
                <small class="text-muted">Cari instan atau klik judul kolom untuk mengurutkan</small>
            </div>
        </div>
        <div class="table-search-box">
            <i class="bi bi-search search-icon"></i>
            <input type="text" id="menuTableSearch" class="form-control form-control-sm" placeholder="Cari nama menu atau kategori...">
            <button type="button" id="menuTableClear" class="table-search-clear" title="Hapus pencarian">
                <i class="bi bi-x-circle-fill"></i>
            </button>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table modern-table align-middle" id="menuTable">
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
                        Harga per Porsi <i class="bi bi-arrow-down-up sort-icon"></i>
                    </th>
                    <th class="text-end" style="width: 210px">Aksi</th>
                </tr>
            </thead>
            <tbody>
            @forelse ($menus as $m)
                <tr data-row data-search="{{ $m->nama_menu }} {{ $m->kategori->nama_kategori }} {{ $m->harga }} {{ $m->deskripsi }}">
                    <td data-label="Foto">
                        <div class="thumb-zoom-wrap" onclick="openMaxsizeModal('{{ $m->foto_url }}', '{{ addslashes($m->nama_menu) }}')" title="Klik untuk lihat ukuran maksimal">
                            <img src="{{ $m->foto_url }}" class="thumb border" alt="{{ $m->nama_menu }}">
                            <span class="thumb-zoom-overlay"><i class="bi bi-zoom-in"></i></span>
                        </div>
                    </td>
                    <td data-label="Nama Menu" data-sort-value="{{ $m->nama_menu }}">
                        <div class="fw-bold text-dark">{{ $m->nama_menu }}</div>
                        <small class="text-muted d-none d-md-inline">{{ \Illuminate\Support\Str::limit($m->deskripsi, 52) }}</small>
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
                        <div class="d-inline-flex gap-1 flex-wrap justify-content-end">
                            <a href="{{ route('menu.show', $m) }}" target="_blank" class="btn-action btn-action-view" title="Lihat di Website">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('admin.menu.edit', $m) }}" class="btn-action btn-action-edit">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                            <form action="{{ route('admin.menu.destroy', $m) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus menu {{ addslashes($m->nama_menu) }}?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn-action btn-action-delete">
                                    <i class="bi bi-trash3"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="empty-cell text-center text-muted py-5">
                        <i class="bi bi-inbox display-6 d-block mb-2 opacity-50"></i>
                        Belum ada menu catering yang terdaftar.
                    </td>
                </tr>
            @endforelse
                <tr id="menuTableNoMatch" style="display: none;">
                    <td colspan="5" class="empty-cell text-center text-muted py-4">
                        <i class="bi bi-search me-1"></i> Tidak ada menu yang cocok dengan pencarian Anda.
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="table-card-footer">
        <span id="menuTableCount" class="fw-medium"></span>
        <div>{{ $menus->links() }}</div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    initInteractiveTable({
        tableId: 'menuTable',
        searchId: 'menuTableSearch',
        clearId: 'menuTableClear',
        countId: 'menuTableCount',
        noMatchId: 'menuTableNoMatch'
    });
});
</script>
@endpush
