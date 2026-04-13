@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="text-center mb-5">
        <h2 class="fw-bold text-uppercase" style="letter-spacing: 2px;">Dino Market</h2>
        <p class="text-muted">Temukan produk terbaik dengan harga bersahabat</p>
        <hr class="mx-auto" style="width: 100px; border: 2px solid #198754; opacity: 1;">
    </div>

    <div class="row">
        @foreach($products as $p)
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
            <div class="card h-100 shadow-sm border-0" style="border-radius: 20px; transition: transform 0.3s;">
                
                {{-- 
                    🔥 LOGIKA FIX GAMBAR: 
                    1. Trim: Hapus spasi tak terlihat.
                    2. Jalur: Langsung tembak ke /products/ tanpa asset() agar lebih stabil di XAMPP.
                --}}
                @php
                    $fileName = trim($p->image);
                @endphp

                <div style="position: relative;">
                    <img src="/products/{{ $fileName }}" 
                         class="card-img-top" 
                         alt="{{ $p->nama_produk }}"
                         style="height: 220px; object-fit: cover; border-top-left-radius: 20px; border-top-right-radius: 20px;"
                         onerror="this.onerror=null;this.src='https://placehold.co/600x400?text=FOTO+TIDAK+DITEMUKAN';">
                    
                    {{-- Badge Kategori (Tugas 14: Relasi) --}}
                    <span class="badge bg-dark position-absolute top-0 start-0 m-3 opacity-75">
                        {{ $p->category->name ?? 'Umum' }}
                    </span>
                </div>

                <div class="card-body d-flex flex-column">
                    <h5 class="card-title fw-bold text-dark mb-1">{{ $p->nama_produk }}</h5>
                    
                    {{-- Deskripsi (Tugas 13) --}}
                    <p class="card-text text-muted small mb-3" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                        {{ $p->description }}
                    </p>

                    <div class="mt-auto">
                        <h5 class="text-success fw-bold mb-1">Rp {{ number_format($p->harga, 0, ',', '.') }}</h5>
                        <p class="text-secondary small mb-3">Tersedia: {{ $p->stok }} unit</p>

                        <form action="/cart/add/{{$p->id}}" method="POST">
                            @csrf
                            <div class="input-group input-group-sm mb-2">
                                <span class="input-group-text bg-light border-0">Qty</span>
                                <input type="number" name="quantity" value="1" min="1" class="form-control border-0 text-center bg-light">
                            </div>
                            <button type="submit" class="btn btn-success w-100 fw-bold mb-2 shadow-sm" style="border-radius: 10px;">
                                <i class="bi bi-cart-plus"></i> Beli Sekarang
                            </button>
                        </form>

                        <a href="/product/edit/{{$p->id}}" class="btn btn-outline-warning btn-sm w-100 fw-bold border-2" style="border-radius: 10px; color: #856404;">
                            Edit Detail
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- 🔥 TUGAS 14: Navigasi Pagination 🔥 --}}
    <div class="d-flex justify-content-center mt-5 mb-5">
        {{ $products->links('pagination::bootstrap-5') }}
    </div>
</div>

<style>
    .card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important;
    }
    .pagination .page-link {
        color: #198754;
        border-radius: 5px;
        margin: 0 3px;
    }
    .pagination .active .page-link {
        background-color: #198754;
        border-color: #198754;
    }
</style>
@endsection