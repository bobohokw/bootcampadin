@extends('layouts.app')

@section('content')

{{-- ✅ NAVBAR (WAJIB TUGAS) --}}
@include('components.navbar')

<div class="container mt-5">

    {{-- Pesan Sukses (Misal setelah tambah ke cart) --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">Produk Terbaru DinoMarket 🦖</h3>
        {{-- Link ke Riwayat Pesanan untuk Fitur Tracking (Tugas 24) --}}
        <a href="{{ route('orders.index') }}" class="btn btn-outline-dark">
            <i class="fas fa-history"></i> Riwayat Pesanan
        </a>
    </div>

    <div class="row">
        @forelse($products as $p)
        <div class="col-md-3 mb-4">
            <div class="card h-100 shadow-sm border-0">
                {{-- Link ke Detail Produk (Tugas 23: Hitung Klik) --}}
                <a href="{{ route('products.show', $p->id) }}">
                    <img src="{{ asset('storage/' . $p->image) }}" 
                         class="card-img-top" 
                         alt="{{ $p->nama_produk }}"
                         style="height: 200px; object-fit: cover;">
                </a>

                <div class="card-body">
                    <h5 class="fw-bold">
                        <a href="{{ route('products.show', $p->id) }}" class="text-decoration-none text-dark">
                            {{ $p->nama_produk }}
                        </a>
                    </h5>
                    
                    <p class="text-primary fw-bold">Rp {{ number_format($p->harga, 0, ',', '.') }}</p>
                    
                    <small class="text-muted d-block mb-3">
                        Kategori: {{ $p->category->name ?? 'Uncategorized' }}
                    </small>

                    {{-- 🔥 FIX CART (WAJIB POST) --}}
                    <form action="{{ route('cart.add', $p->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success w-100 py-2">
                            <i class="fas fa-cart-plus"></i> Tambah ke Cart
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <p class="text-muted">Maaf, saat ini belum ada produk yang tersedia. 🦖</p>
        </div>
        @endforelse
    </div>

</div>

{{-- ✅ FOOTER (WAJIB TUGAS) --}}
@include('components.footer')

<style>
    .card { transition: transform 0.2s; }
    .card:hover { transform: translateY(-5px); }
</style>

@endsection