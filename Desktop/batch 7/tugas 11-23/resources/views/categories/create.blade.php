@extends('layouts.app')

@section('content')
<div class="container py-5">
    {{-- Menggunakan max-width 500px agar form kategori terlihat pas di tengah (tidak terlalu lebar) --}}
    <div class="card shadow-sm border-0 mx-auto" style="max-width: 500px; border-radius: 15px;">
        <div class="card-body p-4">
            <h4 class="fw-bold mb-4 text-primary">
                <i class="fas fa-tags me-2"></i>Tambah Kategori 🦖
            </h4>

            {{-- ACTION disesuaikan dengan route Tugas 21: product-category.store --}}
            <form action="{{ route('product-category.store') }}" method="POST">
                @csrf
                
                <div class="mb-4">
                    <label class="form-label fw-bold small">Nama Kategori</label>
                    <input type="text" 
                           name="name" 
                           class="form-control @error('name') is-invalid @enderror" 
                           placeholder="Contoh: Elektronik, Pakaian, Hobby" 
                           value="{{ old('name') }}" 
                           required 
                           autofocus>
                    
                    {{-- Pesan Error jika nama kategori sudah ada atau kosong --}}
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary fw-bold py-2 shadow-sm">
                        <i class="fas fa-save me-1"></i> Simpan Kategori
                    </button>
                    <a href="{{ route('categories.index') }}" class="btn btn-light text-muted small">
                        Batal & Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection