@extends('layouts.app')

@section('content')

{{-- 
   CATATAN: Jika navbarmu masih double, hapus baris @include di bawah ini.
   Sebab layouts.app biasanya sudah otomatis memanggil navbar.
--}}
{{-- @include('components.navbar') --}}

<div class="container py-5">
    <div class="d-flex align-items-center mb-4">
        <span style="font-size: 2rem;" class="me-3">🛒</span>
        <h2 class="fw-bold mb-0">Keranjang Belanja</h2>
    </div>

    {{-- Notifikasi Sukses/Hapus --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-4 border-0 shadow-sm mb-4" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead class="bg-light text-uppercase small fw-bold">
                        <tr>
                            <th class="ps-4 py-3">Produk</th>
                            <th class="py-3">Harga</th>
                            <th class="py-3 text-center">Jumlah (Qty)</th>
                            <th class="py-3">Subtotal</th>
                            <th class="py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $total = 0; @endphp

                        @forelse($carts as $c)
                        <tr>
                            <td class="ps-4">
                                <div class="d-flex align-items-center">
                                    {{-- Cek apakah produk punya gambar --}}
                                    @if($c->product->image)
                                        <img src="{{ asset('storage/' . $c->product->image) }}" width="60" height="60" style="object-fit: cover;" class="rounded-3 shadow-sm me-3">
                                    @else
                                        <div class="bg-light rounded-3 me-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                            <small class="text-muted">No Image</small>
                                        </div>
                                    @endif
                                    <div>
                                        <h6 class="fw-bold mb-0">{{ $c->product->nama_produk }}</h6>
                                        <small class="text-muted">{{ $c->product->category->name ?? 'Dino Product' }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>Rp {{ number_format($c->product->harga, 0, ',', '.') }}</td>
                            <td class="text-center">
                                <span class="badge bg-light text-dark border px-3 py-2 rounded-pill">
                                    {{ $c->qty }}
                                </span>
                            </td>
                            <td>
                                <span class="fw-bold text-success">
                                    Rp {{ number_format($c->product->harga * $c->qty, 0, ',', '.') }}
                                </span>
                            </td>
                            <td class="text-center">
                                {{-- Tombol Hapus --}}
                                <form action="{{ route('cart.delete', $c->id) }}" method="POST" onsubmit="return confirm('Hapus barang ini dari keranjang?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger btn-sm rounded-pill px-3">
                                        <i class="fas fa-trash-alt me-1"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @php $total += $c->product->harga * $c->qty @endphp

                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <div class="py-4">
                                    <span style="font-size: 3rem;">🦕</span>
                                    <h5 class="text-muted mt-3">Wah, keranjang DinoMarket kamu masih kosong!</h5>
                                    <a href="{{ route('home') }}" class="btn btn-success rounded-pill mt-2 px-4">Mulai Belanja</a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        {{-- Ringkasan Total & Checkout --}}
        @if($carts->count() > 0)
        <div class="card-footer bg-white p-4 border-top">
            <div class="row align-items-center">
                <div class="col-md-6 mb-3 mb-md-0 text-center text-md-start">
                    <h5 class="text-muted mb-1">Total Pembayaran:</h5>
                    <h3 class="fw-bold text-success mb-0">Rp {{ number_format($total, 0, ',', '.') }}</h3>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    {{-- ✅ FORM CHECKOUT (Sudah disinkronkan dengan rute web.php) --}}
                    <form action="{{ route('checkout') }}" method="POST">
                        @csrf
                        <a href="{{ route('home') }}" class="btn btn-link text-decoration-none text-muted me-3">Tambah Barang Lagi</a>
                        <button type="submit" class="btn btn-success btn-lg px-5 rounded-pill shadow">
                            Checkout Sekarang <i class="fas fa-arrow-right ms-2"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

{{-- 
    Hapus @include ini jika footer kamu juga sudah ada di layouts.app 
--}}
{{-- @include('components.footer') --}}

@endsection