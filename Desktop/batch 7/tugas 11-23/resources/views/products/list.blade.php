@extends('layouts.app')

@section('content')
<style>
    .table-container { 
        background: white; 
        border-radius: 15px; 
        padding: 20px; 
        box-shadow: 0 4px 6px rgba(0,0,0,0.05); 
    }
    .object-fit-cover {
        object-fit: cover;
    }
</style>

<div class="container py-5">
    <div class="table-container">
        {{-- Header dan Tombol Tambah --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold text-dark mb-0">Daftar Produk DinoMarket 🦖</h3>
                <p class="text-muted small">Kelola data inventaris barang jualanmu di sini.</p>
            </div>
            {{-- Tombol Pintu Masuk Tugas 21 --}}
            <a href="{{ route('products.create') }}" class="btn btn-success rounded-pill px-4 shadow-sm fw-bold">
                <i class="fas fa-plus-circle me-2"></i>Tambah Produk
            </a>
        </div>

        {{-- Pesan Sukses --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Tabel Produk --}}
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr class="text-secondary small text-uppercase">
                        <th class="ps-3">ID</th>
                        <th>Gambar</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Stok</th>
                        <th>Harga</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                    <tr>
                        <td class="ps-3 text-muted small">{{ $product->id }}</td>
                        <td>
                            @if($product->image)
                                <img src="{{ asset('storage/'.$product->image) }}" width="60" height="60" class="rounded shadow-sm object-fit-cover">
                            @else
                                <div class="bg-light rounded text-center d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                    <i class="fas fa-image text-muted"></i>
                                </div>
                            @endif
                        </td>
                        <td>
                            <div class="fw-bold text-dark">{{ $product->nama_produk }}</div>
                            <div class="text-muted" style="font-size: 0.75rem;">{{ Str::limit($product->description, 40) }}</div>
                        </td>
                        <td>
                            <span class="badge bg-info text-dark bg-opacity-10">{{ $product->category->name ?? 'Tanpa Kategori' }}</span>
                        </td>
                        <td>
                            @if($product->stok <= 5)
                                <span class="text-danger fw-bold"><i class="fas fa-exclamation-triangle me-1"></i>{{ $product->stok }}</span>
                            @else
                                <span class="text-dark">{{ $product->stok }}</span>
                            @endif
                        </td>
                        <td class="fw-bold text-primary">Rp {{ number_format($product->harga, 0, ',', '.') }}</td>
                        <td class="text-center">
                            <div class="btn-group shadow-sm">
                                {{-- Tombol Edit (Tugas 22) --}}
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-outline-warning" title="Edit Data">
                                    <i class="fas fa-edit"></i>
                                </a>
                                
                                {{-- Form Hapus (Tugas 22) --}}
                                <form action="{{ route('products.delete', $product->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" 
                                            onclick="return confirm('Apakah kamu yakin ingin menghapus produk Dino ini?')" 
                                            title="Hapus Data">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted">
                            <i class="fas fa-box-open fa-3x mb-3 d-block"></i>
                            Belum ada produk. Klik tombol <strong>Tambah Produk</strong> untuk memulai.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection