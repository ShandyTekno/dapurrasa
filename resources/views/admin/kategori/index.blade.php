@extends('layouts.admin')
@section('title', 'Kategori')
@section('content')
<div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3 mb-4">
    <div>
        <h2 class="fw-bold mb-1">Kategori Menu</h2>
        <p class="text-muted small mb-0">Kelola pengelompokan menu katering dan nasi kotak DapurRasa.</p>
    </div>
    <a href="{{ route('admin.kategori.create') }}" class="btn btn-aksen shadow-sm">
        <i class="bi bi-plus-lg"></i> Tambah Kategori
    </a>
</div>

<div class="table-card">
    <div class="table-card-header">
        <div class="table-card-title">
            <span class="table-card-icon"><i class="bi bi-tags-fill"></i></span>
            <div>
                <h6 class="fw-bold mb-0 text-dark">Daftar Kategori</h6>
                <small class="text-muted">Cari kategori atau klik header kolom untuk mengurutkan</small>
            </div>
        </div>
        <div class="table-search-box">
            <i class="bi bi-search search-icon"></i>
            <input type="text" id="kategoriTableSearch" class="form-control form-control-sm" placeholder="Cari nama atau deskripsi kategori...">
            <button type="button" id="kategoriTableClear" class="table-search-clear" title="Hapus pencarian">
                <i class="bi bi-x-circle-fill"></i>
            </button>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table modern-table align-middle" id="kategoriTable">
            <thead>
                <tr>
                    <th class="sortable-th" data-sort-type="number" style="width: 75px">
                        # <i class="bi bi-arrow-down-up sort-icon"></i>
                    </th>
                    <th class="sortable-th" data-sort-type="text">
                        Nama Kategori <i class="bi bi-arrow-down-up sort-icon"></i>
                    </th>
                    <th>Deskripsi</th>
                    <th class="sortable-th" data-sort-type="number" style="width: 155px">
                        Jumlah Menu <i class="bi bi-arrow-down-up sort-icon"></i>
                    </th>
                    <th class="text-end" style="width: 190px">Aksi</th>
                </tr>
            </thead>
            <tbody>
            @forelse ($kategoris as $k)
                <tr data-row data-search="{{ $k->nama_kategori }} {{ $k->deskripsi }}">
                    <td data-label="No" data-sort-value="{{ $kategoris->firstItem() + $loop->index }}">
                        <span class="badge bg-light text-secondary border rounded-pill px-2 py-1 fw-semibold">
                            {{ $kategoris->firstItem() + $loop->index }}
                        </span>
                    </td>
                    <td data-label="Nama Kategori" data-sort-value="{{ $k->nama_kategori }}">
                        <div class="fw-bold text-dark">{{ $k->nama_kategori }}</div>
                    </td>
                    <td data-label="Deskripsi">
                        <span class="text-secondary small">{{ \Illuminate\Support\Str::limit($k->deskripsi, 70) ?: '-' }}</span>
                    </td>
                    <td data-label="Jumlah Menu" data-sort-value="{{ $k->menus_count }}">
                        <span class="badge bg-hijau-soft text-hijau rounded-pill px-3 py-2 fw-semibold">
                            <i class="bi bi-collection me-1"></i>{{ $k->menus_count }} menu
                        </span>
                    </td>
                    <td data-label="Aksi" class="text-end">
                        <div class="d-inline-flex gap-1 flex-wrap justify-content-end">
                            <a href="{{ route('admin.kategori.edit', $k) }}" class="btn-action btn-action-edit">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                            <form action="{{ route('admin.kategori.destroy', $k) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus kategori {{ addslashes($k->nama_kategori) }}?')">
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
                        <i class="bi bi-tags display-6 d-block mb-2 opacity-50"></i>
                        Belum ada kategori yang ditambahkan.
                    </td>
                </tr>
            @endforelse
                <tr id="kategoriTableNoMatch" style="display: none;">
                    <td colspan="5" class="empty-cell text-center text-muted py-4">
                        <i class="bi bi-search me-1"></i> Tidak ada kategori yang cocok dengan pencarian Anda.
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="table-card-footer">
        <span id="kategoriTableCount" class="fw-medium"></span>
        <div>{{ $kategoris->links() }}</div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    initInteractiveTable({
        tableId: 'kategoriTable',
        searchId: 'kategoriTableSearch',
        clearId: 'kategoriTableClear',
        countId: 'kategoriTableCount',
        noMatchId: 'kategoriTableNoMatch'
    });
});
</script>
@endpush
