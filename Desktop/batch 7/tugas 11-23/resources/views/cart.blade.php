<!DOCTYPE html>
<html>

<head>

<title>Cart</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

<h2>Keranjang Belanja</h2>

<table class="table">

<tr>

<th>Produk</th>
<th>Harga</th>
<th></th>

</tr>

@foreach($cart as $id=>$item)

<tr>

<td>{{ $item['nama'] }}</td>

<td>Rp {{ number_format($item['harga']) }}</td>

<td>

<form action="/cart/delete/{{$id}}" method="POST">

@csrf
@method('DELETE')

<button class="btn btn-danger btn-sm">

Hapus

</button>

</form>

</td>

</tr>

@endforeach

</table>

</div>

</body>

</html>