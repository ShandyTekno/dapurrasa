@extends('layouts.admin')
@php $edit = $kategori->exists; @endphp
@section('title', $edit ? 'Edit Kategori' : 'Tambah Kategori')
@section('content')
<div class="mb-4">
    <a href="{{ route('admin.kategori.index') }}" class="text-decoration-none small text-muted">
        <i class="bi bi-arrow-left"></i> Kembali ke Daftar Kategori
    </a>
    <h2 class="fw-bold mb-1 mt-2">{{ $edit ? 'Edit' : 'Tambah' }} Kategori</h2>
    <p class="text-muted small">Silakan lengkapi informasi kategori menu berikut.</p>
</div>

<div class="card border-0 shadow-sm rounded-4 bg-white" style="max-width: 650px">
    <div class="card-body p-4">
        <form method="POST" action="{{ $edit ? route('admin.kategori.update', $kategori) : route('admin.kategori.store') }}">
            @csrf
            @if ($edit) @method('PUT') @endif

            <div class="mb-3">
                <label class="form-label fw-semibold text-dark small">Nama Kategori</label>
                <input type="text" name="nama_kategori" value="{{ old('nama_kategori', $kategori->nama_kategori) }}" class="form-control @error('nama_kategori') is-invalid @enderror" placeholder="Contoh: Nasi Kotak, Prasmanan, dll">
                @error('nama_kategori')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold text-dark small">Deskripsi Singkat</label>
                <textarea name="deskripsi" rows="3" class="form-control @error('deskripsi') is-invalid @enderror" placeholder="Penjelasan singkat mengenai kategori...">{{ old('deskripsi', $kategori->deskripsi) }}</textarea>
                @error('deskripsi')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="d-flex gap-2">
                <button class="btn btn-aksen px-4 shadow-sm">
                    <i class="bi bi-check-lg"></i> Simpan
                </button>
                <a href="{{ route('admin.kategori.index') }}" class="btn btn-outline-secondary px-4">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
