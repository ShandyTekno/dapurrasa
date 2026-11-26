@extends('layouts.public')
@section('title', 'Menu Catering')
@section('content')

<div class="page-header">
    <div class="container text-center">
        <h1 class="display-5 fw-bold mb-2">Katalog Menu Catering</h1>
        <p class="lead mb-0 text-white-50">Pilih hidangan lezat dan paket katering terbaik untuk melengkapi acara spesial Anda.</p>
    </div>
</div>

<section class="section">
    <div class="container">

        <div class="filter-card">
            <form method="GET" action="{{ route('menu.index') }}" class="row g-3 align-items-center">

                <div class="col-lg-5 col-md-6">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-search"></i></span>
                        <input type="text" name="q" value="{{ request('q') }}" class="form-control border-start-0 ps-0" placeholder="Cari nama menu (misal: Rendang, Ayam)...">
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-filter"></i></span>
                        <select name="kategori" class="form-select border-start-0 ps-0">
                            <option value="">Semua Kategori</option>
                            @foreach ($kategoris as $k)
                                <option value="{{ $k->id }}" @selected(request('kategori') == $k->id)>{{ $k->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-lg-3 col-md-12 d-flex gap-2">
                    <button class="btn btn-aksen flex-fill shadow-sm">
                        <i class="bi bi-search"></i> Cari
                    </button>
                    <a href="{{ route('menu.index') }}" class="btn btn-outline-secondary px-3" title="Reset Filter">
                        <i class="bi bi-arrow-clockwise"></i> Reset
                    </a>
                </div>
            </form>

            <hr class="my-3 opacity-25">
            <div class="d-flex align-items-center gap-2">
                <small class="text-muted fw-bold text-nowrap"><i class="bi bi-tag me-1"></i>Kategori Cepat:</small>
                <div class="category-pills">
                    <a href="{{ route('menu.index') }}" class="cat-pill {{ !request('kategori') ? 'active' : '' }}">
                        Semua
                    </a>
                    @foreach ($kategoris as $k)
                        <a href="{{ route('menu.index', array_merge(request()->query(), ['kategori' => $k->id])) }}"
                           class="cat-pill {{ request('kategori') == $k->id ? 'active' : '' }}">
                            {{ $k->nama_kategori }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        @if(request('q') || request('kategori'))
            <div class="alert alert-light border d-flex align-items-center justify-content-between mb-4 py-2 px-3 rounded-3">
                <span class="small text-muted">
                    <i class="bi bi-info-circle me-1 text-hijau"></i>
                    Hasil pencarian:
                    @if(request('q')) untuk kata kunci <strong>"{{ request('q') }}"</strong> @endif
                    @if(request('kategori'))
                        pada kategori <strong>"{{ $kategoris->firstWhere('id', request('kategori'))->nama_kategori ?? '' }}"</strong>
                    @endif
                </span>
                <a href="{{ route('menu.index') }}" class="small text-danger text-decoration-none fw-semibold">
                    <i class="bi bi-x-circle me-1"></i>Hapus Filter
                </a>
            </div>
        @endif

        <div class="row g-4">
            @forelse ($menus as $menu)
                <div class="col-sm-6 col-lg-4">
                    @include('partials.menu-card', ['menu' => $menu])
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <div class="p-5 bg-white rounded-4 shadow-sm border mx-auto" style="max-width: 500px">
                        <i class="bi bi-search text-muted display-4 d-block mb-3"></i>
                        <h5 class="fw-bold text-dark">Menu Tidak Ditemukan</h5>
                        <p class="text-muted small mb-4">Coba gunakan kata kunci pencarian lain atau pilih kategori yang berbeda.</p>
                        <a href="{{ route('menu.index') }}" class="btn btn-outline-hijau btn-sm">Lihat Semua Menu</a>
                    </div>
                </div>
            @endforelse
        </div>

        <div class="mt-5 d-flex justify-content-center">
            {{ $menus->links() }}
        </div>
    </div>
</section>
@endsection
