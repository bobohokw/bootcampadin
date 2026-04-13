<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Dino Market</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
background:#f4f6fb;
font-family:Arial;
}

.navbar{
background:white;
box-shadow:0 3px 10px rgba(0,0,0,0.08);
}

.logo{
font-weight:bold;
font-size:24px;
}

.product-card{
border:none;
border-radius:12px;
transition:0.2s;
}

.product-card:hover{
transform:translateY(-6px);
box-shadow:0 12px 20px rgba(0,0,0,0.15);
}

.product-img{
height:200px;
object-fit:cover;
border-radius:12px 12px 0 0;
}

.price{
color:#16a34a;
font-weight:bold;
font-size:18px;
}

</style>

</head>

<body>

<nav class="navbar mb-4">

<div class="container d-flex justify-content-between">

<div class="logo">
🦖 Dino Market
</div>

<form class="w-50">

<input type="text" name="search" value="{{ $search ?? '' }}" class="form-control" placeholder="Cari produk...">

</form>

<a href="/cart" class="btn btn-dark">
Keranjang
</a>

</div>

</nav>


<div class="container">

<button class="btn btn-success mb-4" data-bs-toggle="modal" data-bs-target="#tambahProduk">

Tambah Produk

</button>

<div class="row g-4">

@foreach($products as $p)

<div class="col-md-3">

<div class="card product-card">

<img src="{{ $p->image }}" class="product-img card-img-top">

<div class="card-body">

<a href="/product/{{$p->id}}" style="text-decoration:none;color:black">

<h6>{{$p->nama_produk}}</h6>

</a>

<p class="price">
Rp {{ number_format($p->harga,0,',','.') }}
</p>

<p class="text-muted">
Stok : {{$p->stok}}
</p>

<form action="/product/delete/{{$p->id}}" method="POST">

@csrf
@method('DELETE')

<button class="btn btn-danger btn-sm">

Hapus

</button>

</form>

</div>

</div>

</div>

@endforeach

</div>

</div>


<div class="modal fade" id="tambahProduk">

<div class="modal-dialog">

<form action="/product/store" method="POST" enctype="multipart/form-data" class="modal-content p-3">

@csrf

<h5 class="mb-3">Tambah Produk</h5>

<input type="text" name="nama_produk" placeholder="Nama Produk" class="form-control mb-2">

<input type="number" name="harga" placeholder="Harga" class="form-control mb-2">

<input type="number" name="stok" placeholder="Stok" class="form-control mb-2">

<textarea name="deskripsi" placeholder="Deskripsi" class="form-control mb-2"></textarea>

<input type="file" name="image" class="form-control mb-3">

<button class="btn btn-success">

Tambah Produk

</button>

</form>

</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>