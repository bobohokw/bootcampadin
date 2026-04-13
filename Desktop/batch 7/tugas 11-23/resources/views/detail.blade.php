<!DOCTYPE html>
<html>

<head>

<title>Detail Produk</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

<div class="row">

<div class="col-md-6">

<img src="{{ $product->image }}" class="img-fluid">

</div>

<div class="col-md-6">

<h2>{{ $product->nama_produk }}</h2>

<h4>Rp {{ number_format($product->harga) }}</h4>

<p>{{ $product->deskripsi }}</p>

<form action="/cart/add/{{$product->id}}" method="POST">

@csrf

<button class="btn btn-success">

Tambah ke Keranjang

</button>

</form>

</div>

</div>

</div>

</body>

</html>