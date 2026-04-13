@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-sm border-0" style="border-radius: 15px;">
                {{-- Header Edit Produk --}}
                <div class="card-header bg-primary text-white py-3" style="border-radius: 15px 15px 0 0;">
                    <h5 class="mb-0 fw-bold">
                        <i class="fas fa-edit me-2"></i>Edit Produk DinoMarket 🦖
                    </h5>
                </div>
                
                <div class="card-body p-4">
                    {{-- Form Method PUT untuk Update (Tugas 22) --}}
                    <form method="POST" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Nama Produk --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold small">Nama Produk</label>
                            <input type="text" name="nama_produk" value="{{ old('nama_produk', $product->nama_produk) }}" 
                                   class="form-control @error('nama_produk') is-invalid @enderror" required>
                            @error('nama_produk')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Kategori Produk --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold small">Kategori Produk</label>
                            <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                                @foreach($categories as $c)
                                    <option value="{{ $c->id }}" {{ $product->category_id == $c->id ? 'selected' : '' }}>
                                        {{ $c->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Deskripsi Produk --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold small">Deskripsi Produk</label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="3">{{ old('description', $product->description) }}</textarea>
                        </div>

                        {{-- Harga dan Stok --}}
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold small">Harga (Rp)</label>
                                <input type="number" name="harga" value="{{ old('harga', $product->harga) }}" 
                                       class="form-control @error('harga') is-invalid @enderror" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold small">Stok Barang</label>
                                <input type="number" name="stok" value="{{ old('stok', $product->stok) }}" 
                                       class="form-control @error('stok') is-invalid @enderror" required>
                            </div>
                        </div>

                        {{-- Foto Produk --}}
                        <div class="mb-4">
                            <label class="form-label fw-bold small">Ganti Foto (Kosongkan jika tidak diubah)</label>
                            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                            
                            {{-- Preview foto lama --}}
                            @if($product->image)
                                <div class="mt-2 p-2 border rounded bg-light text-center">
                                    <small class="text-muted d-block mb-1">Foto saat ini:</small>
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="Current Image" style="max-height: 100px;" class="rounded shadow-sm">
                                </div>
                            @endif
                        </div>

                        {{-- Tombol Simpan --}}
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary fw-bold py-2 shadow-sm">
                                <i class="fas fa-save me-1"></i> Perbarui Produk
                            </button>
                            <a href="{{ route('products.list') }}" class="btn btn-link text-muted text-decoration-none small">
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