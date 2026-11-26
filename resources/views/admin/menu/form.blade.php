@extends('layouts.admin')
@php $edit = $menu->exists; @endphp
@section('title', $edit ? 'Edit Menu' : 'Tambah Menu')
@section('content')
<div class="mb-4">
    <a href="{{ route('admin.menu.index') }}" class="text-decoration-none small text-muted">
        <i class="bi bi-arrow-left"></i> Kembali ke Daftar Menu
    </a>
    <h2 class="fw-bold mb-1 mt-2">{{ $edit ? 'Edit' : 'Tambah' }} Menu Catering</h2>
    <p class="text-muted small">Lengkapi formulir hidangan makanan atau paket catering di bawah ini.</p>
</div>

<div class="card border-0 shadow-sm rounded-4 bg-white" style="max-width: 800px">
    <div class="card-body p-4 p-md-5">
        <form method="POST" enctype="multipart/form-data" action="{{ $edit ? route('admin.menu.update', $menu) : route('admin.menu.store') }}">
            @csrf
            @if ($edit) @method('PUT') @endif

            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold text-dark small">Nama Menu</label>
                    <input type="text" name="nama_menu" value="{{ old('nama_menu', $menu->nama_menu) }}" class="form-control @error('nama_menu') is-invalid @enderror" placeholder="Contoh: Nasi Liwet Komplit">
                    @error('nama_menu')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-3">
                    <label class="form-label fw-semibold text-dark small">Kategori</label>
                    <select name="kategori_id" class="form-select @error('kategori_id') is-invalid @enderror">
                        <option value="">-- Pilih --</option>
                        @foreach ($kategoris as $k)
                            <option value="{{ $k->id }}" @selected(old('kategori_id', $menu->kategori_id) == $k->id)>{{ $k->nama_kategori }}</option>
                        @endforeach
                    </select>
                    @error('kategori_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-3">
                    <label class="form-label fw-semibold text-dark small">Harga per Porsi (Rp)</label>
                    <input type="number" min="0" name="harga" value="{{ old('harga', $menu->harga) }}" class="form-control @error('harga') is-invalid @enderror" placeholder="25000">
                    @error('harga')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-12">
                    <label class="form-label fw-semibold text-dark small">Deskripsi Menu &amp; Isi Lauk</label>
                    <textarea name="deskripsi" rows="3" class="form-control @error('deskripsi') is-invalid @enderror" placeholder="Jelaskan komposisi lauk, sayur, sambal, dan pelengkap...">{{ old('deskripsi', $menu->deskripsi) }}</textarea>
                    @error('deskripsi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-12">
                    <label class="form-label fw-semibold text-dark small d-flex justify-content-between align-items-center">
                        <span>Foto Makanan (Format JPG/PNG/WEBP)</span>
                        <span class="badge bg-hijau-soft text-hijau">Maksimal 10 MB</span>
                    </label>
                    <input type="file" name="foto" id="fotoInput" accept="image/jpeg,image/png,image/webp" class="form-control @error('foto') is-invalid @enderror">
                    <div id="fileSizeWarning" class="alert alert-danger py-2 px-3 small mt-2 d-none">
                        <i class="bi bi-exclamation-triangle-fill me-1"></i> Ukuran foto melebihi 10 MB. Harap pilih foto dengan ukuran di bawah 10 MB.
                    </div>
                    @error('foto')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror

                    <div id="livePreviewContainer" class="mt-3 p-3 bg-light rounded-4 d-none align-items-center gap-3 border">
                        <img id="livePreviewImg" src="" class="preview-foto border shadow-sm" alt="Preview foto baru" style="cursor: zoom-in" onclick="openMaxsizeModal(this.src, 'Preview Foto Terpilih')" title="Klik untuk lihat ukuran maksimal">
                        <div>
                            <span class="badge bg-success mb-1"><i class="bi bi-check2-circle me-1"></i>Foto Baru Siap Diunggah</span>
                            <small id="fileInfoText" class="text-dark d-block fw-semibold"></small>
                            <small class="text-muted">Foto ini akan otomatis disimpan saat Anda menekan tombol <strong>Simpan Menu</strong>.</small>
                        </div>
                    </div>

                    @if ($edit)
                        <div id="currentFotoContainer" class="mt-3 p-3 bg-light rounded-4 d-inline-flex align-items-center gap-3 border">
                            <img src="{{ $menu->foto_url }}" class="preview-foto border shadow-sm" alt="Foto saat ini" style="cursor: zoom-in" onclick="openMaxsizeModal('{{ $menu->foto_url }}', '{{ addslashes($menu->nama_menu) }}')" title="Klik untuk lihat ukuran maksimal">
                            <div>
                                <small class="text-muted d-block fw-semibold">Foto Saat Ini di Sistem</small>
                                <small class="text-secondary">Pilih file baru di atas jika ingin mengganti foto ini (klik foto untuk perbesar).</small>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <hr class="my-4 opacity-25">

            <div class="d-flex gap-2">
                <button class="btn btn-aksen px-4 shadow-sm">
                    <i class="bi bi-check-lg"></i> Simpan Menu
                </button>
                <a href="{{ route('admin.menu.index') }}" class="btn btn-outline-secondary px-4">Batal</a>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const fotoInput = document.getElementById('fotoInput');
    const livePreviewContainer = document.getElementById('livePreviewContainer');
    const livePreviewImg = document.getElementById('livePreviewImg');
    const fileInfoText = document.getElementById('fileInfoText');
    const fileSizeWarning = document.getElementById('fileSizeWarning');
    const currentFotoContainer = document.getElementById('currentFotoContainer');
    const maxSizeBytes = 10 * 1024 * 1024;

    if (fotoInput) {
        fotoInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const fileSizeMB = (file.size / (1024 * 1024)).toFixed(2);
                if (file.size > maxSizeBytes) {
                    fileSizeWarning.classList.remove('d-none');
                    livePreviewContainer.classList.add('d-none');
                    livePreviewContainer.classList.remove('d-flex');
                    this.value = '';
                    return;
                } else {
                    fileSizeWarning.classList.add('d-none');
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    livePreviewImg.src = e.target.result;
                    livePreviewContainer.classList.remove('d-none');
                    livePreviewContainer.classList.add('d-flex');
                    fileInfoText.textContent = `${file.name} (${fileSizeMB} MB)`;
                    if (currentFotoContainer) {
                        currentFotoContainer.style.opacity = '0.4';
                    }
                };
                reader.readAsDataURL(file);
            } else {
                livePreviewContainer.classList.add('d-none');
                livePreviewContainer.classList.remove('d-flex');
                if (currentFotoContainer) {
                    currentFotoContainer.style.opacity = '1';
                }
            }
        });
    }
});
</script>
@endsection
