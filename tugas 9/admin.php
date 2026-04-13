<?php
$koneksi = mysqli_connect("localhost", "root", "", "ecommerce_dino");

if(isset($_POST['tambah'])){
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];
    
    // Logika Upload Gambar
    $filename = $_FILES['gambar']['name'];
    $tmp_name = $_FILES['gambar']['tmp_name'];
    
    // Pindahkan file ke folder img/
    move_uploaded_file($tmp_name, 'img/'.$filename);
    
    $query = "INSERT INTO products (nama_produk, harga, gambar, deskripsi) VALUES ('$nama', '$harga', '$filename', '$deskripsi')";
    mysqli_query($koneksi, $query);
    header("Location: home.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dino</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-5 bg-light">
    <div class="container bg-white p-4 rounded-4 shadow-sm" style="max-width: 500px;">
        <h4 class="fw-bold mb-4">Input Produk Baru</h4>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label>Nama Produk</label>
                <input type="text" name="nama" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Harga (Angka saja)</label>
                <input type="number" name="harga" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Pilih Gambar</label>
                <input type="file" name="gambar" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="3"></textarea>
            </div>
            <button type="submit" name="tambah" class="btn btn-primary w-100">SIMPAN & PUBLIKASIKAN</button>
            <a href="home.php" class="btn btn-link w-100 mt-2 text-muted">Kembali ke Toko</a>
        </form>
    </div>
</body>
</html>