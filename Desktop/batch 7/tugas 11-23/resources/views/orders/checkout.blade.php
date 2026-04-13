@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h3 class="fw-bold mb-4">Penyelesaian Pesanan 🛒</h3>
    <form action="{{ route('checkout.process') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-8">
                <div class="card border-0 shadow-sm mb-4" style="border-radius: 15px;">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-3">Pilih Metode Pembayaran</h5>
                        <div class="form-check border p-3 rounded mb-2">
                            <input class="form-check-input" type="radio" name="payment_method" value="transfer" id="tf" required>
                            <label class="form-check-label d-flex align-items-center" for="tf">
                                <span class="me-2">🏦</span> Transfer Bank (Manual)
                            </label>
                        </div>
                        <div class="form-check border p-3 rounded mb-2">
                            <input class="form-check-input" type="radio" name="payment_method" value="e-wallet" id="ew">
                            <label class="form-check-label d-flex align-items-center" for="ew">
                                <span class="me-2">📱</span> E-Wallet (OVO/Gopay)
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card border-0 shadow-sm" style="border-radius: 15px;">
                    <div class="card-body">
                        <h5 class="fw-bold mb-3">Ringkasan Belanja</h5>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Total Harga</span>
                            <span>Rp{{ number_format($totalHarga, 0, ',', '.') }}</span>
                        </div>
                        <hr>
                        <button type="submit" class="btn btn-success w-100 py-2 fw-bold" style="border-radius: 10px;">
                            Bayar Sekarang
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection