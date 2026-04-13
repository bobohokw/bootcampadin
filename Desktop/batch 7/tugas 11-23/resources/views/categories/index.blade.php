@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold"><i class="fas fa-tags me-2 text-primary"></i>List Kategori Produk</h3>
        <a href="{{ route('categories.create') }}" class="btn btn-primary shadow-sm fw-bold">
            <i class="fas fa-plus me-1"></i> Tambah Kategori
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm" style="border-radius: 15px; overflow: hidden;">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-dark">
                    <tr>
                        <th class="ps-4 py-3">ID</th>
                        <th class="py-3">Nama Kategori</th>
                        <th class="py-3">Jumlah Produk</th>
                        <th class="py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                    <tr>
                        <td class="ps-4 align-middle text-muted">#{{ $category->id }}</td>
                        <td class="align-middle fw-bold text-dark">{{ $category->name }}</td>
                        <td class="align-middle">
                            <span class="badge bg-info text-dark px-3 rounded-pill">
                                {{ $category->products_count ?? 0 }} Produk
                            </span>
                        </td>
                        <td class="text-center align-middle">
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-warning text-white px-3" style="border-radius: 8px;">
                                    <i class="fas fa-edit me-1"></i> Edit
                                </a>
                                
                                <form action="{{ route('categories.delete', $category->id) }}" method="POST" class="d-inline">
                                    @csrf 
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger px-3" style="border-radius: 8px;" onclick="return confirm('Yakin ingin menghapus kategori ini?')">
                                        <i class="fas fa-trash me-1"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-5 text-muted">
                            <i class="fas fa-folder-open fa-3x d-block mb-3 text-light"></i>
                            Belum ada kategori yang tersedia.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    /* Styling tambahan agar tabel terlihat lebih profesional */
    .table thead th {
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border: none;
    }
    .table tbody tr {
        transition: 0.2s;
    }
    .table tbody tr:hover {
        background-color: rgba(0,0,0,0.02);
    }
</style>
@endsection