@extends('layouts.app')

@section('content')
<div class="container py-5 text-center">
    <div class="card shadow-sm border-0 p-5" style="border-radius: 20px;">
        <h2 class="fw-bold">Selesaikan Pembayaran 🦖</h2>
        <p class="text-muted">No. Pesanan: <strong>{{ $order->order_number }}</strong></p>
        <h3 class="text-success fw-bold mb-4">Rp{{ number_format($order->total_price, 0, ',', '.') }}</h3>
        
        <button id="pay-button" class="btn btn-primary btn-lg px-5">Pilih Metode Pembayaran</button>
    </div>
</div>

{{-- Script Midtrans Snap --}}
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="YOUR_CLIENT_KEY_DISINI"></script>
<script type="text/javascript">
    var payButton = document.getElementById('pay-button');
    payButton.addEventListener('click', function () {
        window.snap.pay('{{ $snapToken }}', {
            onSuccess: function(result){ alert("Pembayaran Berhasil!"); window.location.href = '/orders'; },
            onPending: function(result){ alert("Menunggu Pembayaran..."); },
            onError: function(result){ alert("Pembayaran Gagal!"); }
        });
    });
</script>
@endsection