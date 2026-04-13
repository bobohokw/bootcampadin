@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-sm border-0" style="border-radius: 15px;">
                {{-- Header dengan tema DinoMarket --}}
                <div class="card-header bg-success text-white py-3" style="border-radius: 15px 15px 0 0;">
                    <h5 class="mb-0 fw-bold">
                        <i class="fas fa-plus-circle me-2"></i>Tambah Produk DinoMarket 🦖
                    </h5>
                </div>
                
                <div class="card-body p-4">
                    {{-- Form action disesuaikan ke route product.store (Tugas 21) --}}
                    <form method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data">
                        @csrf

                        {{-- Nama Produk --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold small">Nama Produk</label>
                            <input type="text" name="nama_produk" placeholder="Contoh: Keyboard Mechanical" 
                                   class="form-control @error('nama_produk') is-invalid @enderror" value="{{ old('nama_produk') }}" required>
                            @error('nama_produk')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Kategori Produk --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold small">Kategori Produk</label>
                            <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                                <option value="" selected disabled>Pilih Kategori...</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Deskripsi Produk (Disamakan dengan Controller: description) --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold small">Deskripsi Produk</label>
                            <textarea name="description" placeholder="Jelaskan detail produk di sini..." 
                                      class="form-control @error('description') is-invalid @enderror" rows="3">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Harga dan Stok --}}
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold small">Harga (Rp)</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" name="harga" placeholder="0" 
                                           class="form-control @error('harga') is-invalid @enderror" value="{{ old('harga') }}" required>
                                </div>
                                @error('harga')
                                    <div class="small text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold small">Stok Barang</label>
                                <input type="number" name="stok" placeholder="0" 
                                       class="form-control @error('stok') is-invalid @enderror" value="{{ old('stok') }}" required>
                                @error('stok')
                                    <div class="small text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Upload Foto --}}
                        <div class="mb-4">
                            <label class="form-label fw-bold small">Foto Produk</label>
                            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" required>
                            <div class="form-text mt-1 text-muted" style="font-size: 0.8rem;">
                                Format: JPG, PNG, JPEG (Maks. 2MB).
                            </div>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Tombol Aksi --}}
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success fw-bold py-2 shadow-sm">
                                <i class="fas fa-save me-1"></i> Simpan Produk
                            </button>
                            <a href="{{ route('products.list') }}" class="btn btn-link text-muted text-decoration-none small mt-1">
                                Batal & Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection