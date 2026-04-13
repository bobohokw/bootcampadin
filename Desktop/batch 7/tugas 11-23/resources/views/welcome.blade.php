@extends('layouts.app')

@section('content')
<style>
    .card { transition: transform 0.2s; border-radius: 12px; overflow: hidden; border: 1px solid #eee; position: relative; }
    .card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.05); }
    .product-img { height: 200px; object-fit: cover; }
    .btn-wishlist { position: absolute; top: 10px; right: 10px; background: rgba(255,255,255,0.8); border-radius: 50%; width: 35px; height: 35px; display: flex; align-items: center; justify-content: center; border: none; color: #dc3545; transition: 0.3s; z-index: 10; }
    .btn-wishlist:hover { background: #dc3545; color: white; }
</style>

<div class="container mt-5">
    {{-- Hero Section --}}
    <div class="p-5 mb-5 bg-white border rounded-4 shadow-sm text-center">
        <h1 class="display-5 fw-bold text-dark mb-3">Selamat Datang di DinoMarket 🦖</h1>
        <p class="text-muted fs-5 mx-auto" style="max-width: 600px;">Temukan berbagai produk berkualitas dengan harga terbaik hanya di sini.</p>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold m-0">Produk Terbaru</h4>
        <div class="d-flex gap-2">
            <a href="{{ route('orders.index') }}" class="btn btn-outline-secondary btn-sm rounded-3">
                <i class="fas fa-history me-1"></i> Riwayat Pesanan
            </a>
        </div>
    </div>

    {{-- LOOPING PRODUK --}}
    <div class="row g-4">
        @forelse($products as $p)
        <div class="col-md-3">
            <div class="card h-100 shadow-sm border-0">
                {{-- ✅ Tombol Love (Wishlist) di Atas Gambar --}}
                <form action="{{ route('wishlist.add', $p->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-wishlist shadow-sm">
                        <i class="{{ \App\Models\Wishlist::where('user_id', auth()->id())->where('product_id', $p->id)->exists() ? 'fas' : 'far' }} fa-heart"></i>
                    </button>
                </form>

                <a href="{{ route('products.show', $p->id) }}">
                    <img src="{{ asset('storage/' . $p->image) }}" 
                         class="card-img-top product-img" 
                         alt="{{ $p->nama_produk }}">
                </a>
                
                <div class="card-body">
                    <h6 class="fw-bold text-dark mb-1">{{ $p->nama_produk }}</h6>
                    <p class="text-success fw-bold mb-1">Rp {{ number_format($p->harga, 0, ',', '.') }}</p>
                    <small class="text-muted d-block mb-3">
                        <i class="fas fa-tag me-1 small"></i> {{ $p->category->name ?? 'Uncategorized' }}
                    </small>
                    
                    <form action="{{ route('cart.add', $p->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success w-100 py-2 fw-medium rounded-3">
                            <i class="fas fa-cart-plus me-1"></i> Tambah ke Cart
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <div class="p-5 bg-light rounded-4">
                <span style="font-size: 3rem;">🦕</span>
                <p class="text-muted mt-3 italic">Wah, stok lagi kosong nih. Cek lagi nanti ya!</p>
            </div>
        </div>
        @endforelse
    </div>
</div>
@endsection