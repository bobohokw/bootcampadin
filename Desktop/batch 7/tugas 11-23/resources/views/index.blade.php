@extends('layouts.app')

@section('content')
{{-- JUMBOTRON - Sekarang bersih tanpa Search Bar agar tidak double dengan Navbar --}}
<div class="bg-white py-5 shadow-sm text-center mb-5 border-bottom">
    <div class="container">
        <h1 class="display-4 fw-bold text-dark">🦖 DINO MARKET</h1>
        <p class="lead text-muted small mb-0">Temukan produk terbaik dengan harga bersahabat</p>
    </div>
</div>

<div class="container mb-5">
    {{-- Alert Notifikasi --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-4 border-0 shadow-sm mb-4" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row g-4">
        @forelse($products as $product)
        <div class="col-md-3 col-sm-6">
            <div class="card h-100 border-0 shadow-sm position-relative card-product" style="border-radius: 15px; overflow: visible;">
                
                {{-- FLOATING ACTIONS (Hati + Angka Keranjang di Pojok) --}}
                <div class="position-absolute d-flex flex-column gap-2" style="top: -10px; right: -10px; z-index: 10;">
                    {{-- Tombol Wishlist --}}
                    <button class="btn btn-white shadow-sm rounded-circle d-flex align-items-center justify-content-center" style="width: 38px; height: 38px; background: white; border: 1px solid #eee;">
                        <i class="fa-regular fa-heart text-danger"></i>
                    </button>

                    {{-- Angka Keranjang Per Produk (Hanya Muncul Jika Sudah Login & Ada Isinya) --}}
                    @auth
                        @php
                            $item = \App\Models\Cart::where('user_id', auth()->id())->where('product_id', $product->id)->first();
                        @endphp
                        @if($item)
                            <div class="btn btn-success shadow-sm rounded-circle position-relative d-flex align-items-center justify-content-center" style="width: 38px; height: 38px; padding: 0; cursor: default; border: 2px solid white;">
                                <i class="fas fa-shopping-basket" style="font-size: 0.8rem;"></i>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger shadow-sm" style="font-size: 0.7rem; min-width: 20px;">
                                    {{ $item->qty }}
                                </span>
                            </div>
                        @endif
                    @endauth
                </div>

                {{-- Bagian Gambar Produk --}}
                <div style="height: 200px; overflow: hidden; border-radius: 15px 15px 0 0;" class="bg-light">
                    @php
                        $img = $product->image ? (filter_var($product->image, FILTER_VALIDATE_URL) ? $product->image : asset('storage/products/'.basename($product->image))) : 'https://placehold.co/400x400?text=No+Image';
                    @endphp
                    <img src="{{ $img }}" class="w-100 h-100 object-fit-cover" alt="{{ $product->nama_produk }}">
                </div>
                
                {{-- Bagian Informasi Produk --}}
                <div class="card-body d-flex flex-column">
                    <h6 class="fw-bold mb-1 text-truncate">{{ $product->nama_produk }}</h6>
                    <h5 class="text-success fw-bold mb-3">Rp {{ number_format($product->harga, 0, ',', '.') }}</h5>
                    <p class="text-muted small mb-3"><i class="fas fa-box-open me-1"></i> Stok: {{ $product->stok }}</p>

                    <div class="mt-auto">
                        {{-- Form Tambah ke Keranjang --}}
                        <form action="{{ route('cart.add', $product->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="btn btn-success w-100 fw-bold py-2 shadow-sm mb-2" style="border-radius: 8px;">
                                <i class="fas fa-cart-plus me-1"></i> + Keranjang
                            </button>
                        </form>
                        
                        {{-- Tombol Detail --}}
                        <a href="{{ route('products.show', $product->id) }}" class="btn btn-outline-secondary w-100 btn-sm py-2" style="border-radius: 8px;">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @empty
            {{-- Tampilan Jika Produk Tidak Ditemukan --}}
            <div class="col-12 text-center py-5">
                <h5 class="text-muted">Wah, produk "{{ request('search') }}" tidak ditemukan... 🦖</h5>
                <a href="{{ route('home') }}" class="btn btn-success mt-2">Lihat Semua Produk</a>
            </div>
        @endforelse
    </div>

    {{-- Navigasi Halaman (Pagination) --}}
    <div class="mt-5 d-flex justify-content-center">
        {{ $products->appends(['search' => request('search')])->links() }}
    </div>
</div>

<style>
    .card-product:hover { 
        transform: translateY(-5px); 
        transition: 0.3s; 
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
    .object-fit-cover { object-fit: cover; }
    .btn-white:hover { background: #f8f9fa !important; }
</style>
@endsection