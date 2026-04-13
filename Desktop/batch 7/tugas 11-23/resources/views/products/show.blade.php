@extends('layouts.app')

@section('content')
<div class="container py-5" style="margin-top: 20px;">
    
    {{-- Breadcrumb: Navigasi penunjuk halaman --}}
    <nav aria-label="breadcrumb" class="mb-5">
        <ol class="breadcrumb bg-white p-3 rounded-pill shadow-sm">
            <li class="breadcrumb-item">
                <a href="{{ route('home') }}" class="text-success text-decoration-none fw-bold">DinoMarket</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('product.index') }}" class="text-muted text-decoration-none">Katalog</a>
            </li>
            <li class="breadcrumb-item active text-dark fw-bold" aria-current="page">
                {{-- Fallback jika nama kolom berbeda di DB --}}
                {{ $product->nama_produk ?? ($product->name ?? 'Detail Produk') }}
            </li>
        </ol>
    </nav>

    <div class="row g-5 align-items-center">
        {{-- Sisi Kiri: Area Gambar Produk --}}
        <div class="col-md-6 col-lg-5">
            <div class="card shadow border-0 rounded-4 overflow-hidden bg-white">
                <div class="card-body p-4 text-center">
                    @php
                        // 1. Ambil path dari database (cek kolom image, gambar, atau foto)
                        $raw_path = $product->image ?? ($product->gambar ?? $product->foto);
                        
                        // 2. Perbaikan Spasi: Mengubah spasi menjadi %20 agar URL valid
                        $clean_path = str_replace(' ', '%20', $raw_path);
                    @endphp

                    @if($raw_path)
                        <img src="{{ asset('storage/' . $clean_path) }}" 
                             class="img-fluid rounded-3" 
                             alt="Gambar Produk DinoMarket" 
                             style="max-height: 450px; width: 100%; object-fit: contain;">
                    @else
                        <img src="https://via.placeholder.com/500x500.png?text=DinoMarket+No+Image" 
                             class="img-fluid rounded-3" 
                             alt="No Image">
                    @endif
                </div>
            </div>
        </div>

        {{-- Sisi Kanan: Detail Produk & Form Belanja --}}
        <div class="col-md-6 col-lg-7">
            <div class="p-4 border rounded-4 shadow bg-white h-100">
                <h1 class="display-6 fw-bold mb-2 text-dark">
                    {{ $product->nama_produk ?? ($product->name ?? 'Nama Produk') }}
                </h1>
                
                {{-- Harga Produk dengan pengecekan kolom --}}
                @php
                    $product_price = $product->harga ?? ($product->price ?? 0);
                @endphp
                <h2 class="text-success fw-bold mb-3">
                    Rp {{ number_format($product_price, 0, ',', '.') }}
                </h2>

                {{-- Informasi Stok --}}
                @php
                    $product_stock = $product->stok ?? ($product->stock ?? 0);
                @endphp
                <div class="mb-4">
                    <span class="badge {{ $product_stock > 0 ? 'bg-light text-success' : 'bg-light text-danger' }} border px-3 py-2 rounded-pill shadow-sm">
                        <i class="fas fa-box-open me-1"></i> Stok: {{ $product_stock }} unit
                    </span>
                </div>

                <hr class="my-4 text-muted">

                {{-- Deskripsi Produk --}}
                <div class="mb-5">
                    <h5 class="fw-bold text-dark mb-3"><i class="fas fa-info-circle me-1"></i> Deskripsi Produk</h5>
                    <div class="text-secondary lh-lg" style="font-size: 1rem; text-align: justify;">
                        @php
                            $product_desc = $product->description ?? ($product->deskripsi ?? 'Belum ada deskripsi.');
                        @endphp
                        {!! nl2br(e($product_desc)) !!}
                    </div>
                </div>

                {{-- Form Tambah ke Keranjang --}}
                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                    @csrf
                    
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <label for="quantity" class="form-label mb-0 fw-bold text-muted">Jumlah:</label>
                        <div class="input-group shadow-sm" style="max-width: 140px;">
                            <input type="number" 
                                   name="quantity" 
                                   id="quantity" 
                                   class="form-control text-center rounded-pill border-secondary" 
                                   value="1" 
                                   min="1" 
                                   max="{{ $product_stock }}" 
                                   required 
                                   {{ $product_stock <= 0 ? 'disabled' : '' }}>
                        </div>
                    </div>

                    <div class="d-grid gap-3 d-md-flex mt-4">
                        {{-- Tombol Keranjang --}}
                        <button type="submit" 
                                class="btn btn-success btn-lg px-5 py-3 rounded-pill fw-bold shadow flex-grow-1" 
                                style="background-color: #28a745; border-color: #28a745;"
                                {{ $product_stock <= 0 ? 'disabled' : '' }}>
                            <i class="fas fa-cart-plus me-2"></i> 
                            {{ $product_stock > 0 ? '+ Keranjang' : 'Stok Habis' }}
                        </button>
                        
                        {{-- Tombol Kembali --}}
                        <a href="{{ route('product.index') }}" 
                           class="btn btn-outline-secondary btn-lg px-4 py-3 rounded-pill">
                            <i class="fas fa-arrow-left me-1"></i> Kembali
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection