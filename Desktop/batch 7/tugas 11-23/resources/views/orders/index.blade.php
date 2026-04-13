@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Riwayat Pesanan DinoMarket 🦖</h2>
        <a href="{{ route('product.index') }}" class="btn btn-outline-primary btn-sm">Lanjut Belanja</a>
    </div>

    {{-- Alert Success untuk Konfirmasi Terima Barang --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($orders->isEmpty())
        <div class="text-center py-5 shadow-sm bg-white rounded">
            <p class="text-muted">Kamu belum pernah memesan apapun. Yuk, belanja sekarang!</p>
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-hover align-middle shadow-sm bg-white rounded">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Produk</th>
                        <th>No. Order</th>
                        <th>Total Harga</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th class="text-center">Aksi / Tracking</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $o)
                    <tr>
                        <td>{{ $o->id }}</td>
                        <td>
                            {{-- Menampilkan nama produk dari relasi product_id --}}
                            <span class="fw-bold text-primary">{{ $o->product->name ?? 'Produk Dino' }}</span>
                            <br><small class="text-muted">{{ $o->quantity }} item</small>
                        </td>
                        <td><strong>{{ $o->order_number }}</strong></td>
                        <td>Rp {{ number_format($o->total_price, 0, ',', '.') }}</td>
                        <td>
                            <span class="badge {{ $o->status == 'selesai' ? 'bg-success' : ($o->status == 'pending' ? 'bg-warning' : ($o->status == 'lunas' ? 'bg-primary' : 'bg-info')) }}">
                                {{ strtoupper($o->status) }}
                            </span>
                        </td>
                        <td>{{ $o->created_at->format('d M Y, H:i') }}</td>
                        <td>
                            {{-- Fitur Tracking & Aksi (Tugas 24) --}}
                            <div class="d-flex flex-column align-items-center">
                                @if($o->status == 'pending')
                                    {{-- Tombol bayar ulang jika token masih ada --}}
                                    <button class="btn btn-sm btn-warning" onclick="window.location.reload()">Bayar Sekarang</button>
                                @elseif($o->status == 'lunas')
                                    <span class="text-primary small fw-bold">Dibayar (Menunggu Kirim)</span>
                                @elseif($o->status == 'dikirim')
                                    <div class="mb-2">
                                        <small class="text-muted d-block">Resi: <strong>{{ $o->resi_number ?? 'PROSES-DINO' }}</strong></small>
                                    </div>
                                    <form action="{{ route('orders.complete', $o->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Sudah menerima pesanan ini?')">
                                            Konfirmasi Terima
                                        </button>
                                    </form>
                                @elseif($o->status == 'selesai')
                                    <span class="text-success small fw-bold">Pesanan Selesai ✅</span>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

<style>
    .table thead th { border: none; padding: 15px; }
    .badge { padding: 8px 12px; border-radius: 8px; font-weight: 500; }
    .table-responsive { overflow-x: auto; }
</style>
@endsection