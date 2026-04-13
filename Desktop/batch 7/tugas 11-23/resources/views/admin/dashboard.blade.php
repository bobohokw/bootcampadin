@extends('layouts.app')

@section('content')
<div class="container pb-5">
    {{-- Header Selamat Datang --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm overflow-hidden" style="border-radius: 15px;">
                <div class="card-body p-4 bg-white border-start border-success border-5">
                    <div class="d-flex align-items-center">
                        <span style="font-size: 3rem;" class="me-3">🦖</span>
                        <div>
                            <h2 class="fw-bold mb-1">Halo, {{ Auth::user()->name }}!</h2>
                            <p class="text-muted mb-0">Selamat datang di Panel Kendali <strong>DinoMarket</strong>. Berikut adalah ringkasan toko Anda hari ini.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Baris 1: Statistik Dasar (Produk, Order, User) --}}
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm p-3 text-center" style="border-radius: 15px;">
                <div class="card-body">
                    <div class="rounded-circle bg-success bg-opacity-10 d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                        <span style="font-size: 1.5rem;">📦</span>
                    </div>
                    <h5 class="text-muted text-uppercase small fw-bold">Total Produk</h5>
                    <h2 class="display-6 fw-bold text-success">{{ $totalProduk }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm p-3 text-center" style="border-radius: 15px;">
                <div class="card-body">
                    <div class="rounded-circle bg-warning bg-opacity-10 d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                        <span style="font-size: 1.5rem;">🛍️</span>
                    </div>
                    <h5 class="text-muted text-uppercase small fw-bold">Total Order</h5>
                    <h2 class="display-6 fw-bold text-warning">{{ $totalOrder }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm p-3 text-center" style="border-radius: 15px;">
                <div class="card-body">
                    <div class="rounded-circle bg-primary bg-opacity-10 d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                        <span style="font-size: 1.5rem;">👥</span>
                    </div>
                    <h5 class="text-muted text-uppercase small fw-bold">Total User</h5>
                    <h2 class="display-6 fw-bold text-primary">{{ $totalUser }}</h2>
                </div>
            </div>
        </div>
    </div>

    {{-- Baris 2: Statistik Khusus Tugas 23 (Kategori & Klik) --}}
    <div class="row g-4">
        <div class="col-md-6">
            <div class="card h-100 border-0 shadow-sm p-3" style="border-radius: 15px; background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);">
                <div class="card-body d-flex align-items-center">
                    <div class="rounded-circle bg-info bg-opacity-10 d-inline-flex align-items-center justify-content-center me-4" style="width: 70px; height: 70px;">
                        <span style="font-size: 2rem;">🏷️</span>
                    </div>
                    <div>
                        <h5 class="text-muted text-uppercase small fw-bold mb-1">Jumlah Kategori</h5>
                        <h2 class="fw-bold text-info mb-0">{{ $totalKategori }} <small class="fs-6 fw-normal text-muted">Kategori</small></h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card h-100 border-0 shadow-sm p-3" style="border-radius: 15px; background: linear-gradient(135deg, #ffffff 0%, #fffdf5 100%);">
                <div class="card-body d-flex align-items-center border-start border-warning border-4">
                    <div class="rounded-circle bg-danger bg-opacity-10 d-inline-flex align-items-center justify-content-center me-4" style="width: 70px; height: 70px;">
                        <span style="font-size: 2rem;">🖱️</span>
                    </div>
                    <div>
                        <h5 class="text-muted text-uppercase small fw-bold mb-1">Jumlah Klik Produk</h5>
                        <h2 class="fw-bold text-danger mb-0">{{ number_format($totalKlik, 0, ',', '.') }} <small class="fs-6 fw-normal text-muted">Interaksi</small></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Tabel Produk Terpopuler --}}
    <div class="row mt-5">
        <div class="col-12">
            <div class="card border-0 shadow-sm" style="border-radius: 15px;">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="fw-bold mb-0"><i class="fas fa-fire me-2 text-danger"></i>Produk Paling Banyak Dilihat</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="ps-4">Produk</th>
                                    <th>Kategori</th>
                                    <th class="text-center">Total Klik</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($produkTerpopuler as $p)
                                <tr>
                                    <td class="ps-4 fw-bold text-dark">{{ $p->nama_produk }}</td>
                                    <td><span class="badge bg-light text-dark border">{{ $p->category->name ?? 'Tanpa Kategori' }}</span></td>
                                    <td class="text-center">
                                        <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill">
                                            {{ $p->clicks }} Klik
                                        </span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center py-4 text-muted">Belum ada data interaksi produk.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Aksi Cepat --}}
    <div class="mt-5">
        <h5 class="fw-bold mb-3">Aksi Cepat</h5>
        <div class="d-flex gap-2">
            <a href="{{ route('home') }}" class="btn btn-outline-dark px-4 py-2" style="border-radius: 10px;">
                <i class="fas fa-eye me-1"></i> Lihat Katalog
            </a>
            <a href="{{ route('products.create') }}" class="btn btn-success px-4 py-2" style="border-radius: 10px;">
                <i class="fas fa-plus me-1"></i> Tambah Produk Baru
            </a>
        </div>
    </div>
</div>
@endsection