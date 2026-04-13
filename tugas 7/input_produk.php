<?php
// --- TUGAS 1: DASAR PHP (Koneksi & Variabel) ---
$koneksi = mysqli_connect("localhost", "root", "", "ecommerce_dino");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Deklarasi Variabel dari Form
    $nama  = $_POST['nama_produk'];
    $harga = $_POST['harga'];
    $stok  = $_POST['stok'];
    $desc  = $_POST['deskripsi'];

    // --- TUGAS 3: VALIDASI (Cek data kosong) ---
    if (empty($nama) || empty($harga) || empty($stok) || empty($desc)) {
        echo "<script>alert('Waduh! Semua data harus diisi.');</script>";
    } else {
        // Proses Simpan ke Database
        $query = "INSERT INTO products (nama_produk, harga, stok, deskripsi) VALUES ('$nama', '$harga', '$stok', '$desc')";
        if (mysqli_query($koneksi, $query)) {
            echo "<h3 style='color:green;'>🦕 Berhasil! Produk $nama sudah masuk database.</h3>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>DinoMarket - Input</title></head>
<body style="font-family:sans-serif; background:#f0fdf4; padding:20px;">
    <h2>🦖 Tambah Produk DinoMarket</h2>
    <form method="POST" action="">
        <table border="0">
            <tr><td>Nama Produk</td><td>: <input type="text" name="nama_produk"></td></tr>
            <tr><td>Harga (Rp)</td><td>: <input type="number" name="harga"></td></tr>
            <tr><td>Stok</td><td>: <input type="number" name="stok"></td></tr>
            <tr><td>Deskripsi</td><td>: <textarea name="deskripsi"></textarea></td></tr>
            <tr><td></td><td><button type="submit">Simpan Produk</button></td></tr>
        </table>
    </form>
</body>
</html>