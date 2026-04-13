<?php
// --- Bagian 1: Tugas Dasar PHP (Koneksi & Deklarasi) ---
$host = "localhost";
$user = "root";
$pass = "";
$db   = "ecommerce_dino";

$koneksi = mysqli_connect($host, $user, $pass, $db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Deklarasi Variabel sesuai kolom di database kemarin
    $nama  = $_POST['nama_produk'];
    $harga = $_POST['harga'];
    $stok  = $_POST['stok'];
    $desc  = $_POST['deskripsi'];

    // --- Bagian 3: Tugas Validasi (Cek apakah ada yang kosong) ---
    if (empty($nama) || empty($harga) || empty($stok) || empty($desc)) {
        echo "<script>alert('Waduh! Semua data (Nama, Harga, Stok, Deskripsi) harus diisi.');</script>";
    } else {
        // --- Proses Simpan ke Database ---
        $query = "INSERT INTO products (nama_produk, harga, stok, deskripsi) 
                  VALUES ('$nama', '$harga', '$stok', '$desc')";
        
        if (mysqli_query($koneksi, $query)) {
            echo "<h3>🦕 Produk Dino Berhasil Disimpan!</h3>";
            echo "Produk: " . $nama . " (Stok: " . $stok . ")<br>";
            echo "Harga: Rp " . number_format($harga) . "<br>";
        } else {
            echo "Gagal simpan: " . mysqli_error($koneksi);
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>DinoMarket - Tambah Produk</title>
    <style>
        body { font-family: sans-serif; padding: 20px; background-color: #f0fdf4; }
        .form-box { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); width: fit-content; }
        input, textarea { width: 100%; margin: 5px 0; }
        button { background-color: #16a34a; color: white; border: none; padding: 10px 20px; cursor: pointer; border-radius: 4px; }
    </style>
</head>
<body>
    <div class="form-box">
        <h2>🦖 Tambah Produk DinoMarket</h2>
        <p>Gunakan form ini untuk menambah koleksi DinoPhone, Raptor, atau Drone baru.</p>
        
        <form method="POST" action="">
            <table>
                <tr>
                    <td>Nama Produk</td>
                    <td>: <input type="text" name="nama_produk" placeholder="Contoh: DinoPhone 17 Pro"></td>
                </tr>
                <tr>
                    <td>Harga (Rp)</td>
                    <td>: <input type="number" name="harga" placeholder="15000000"></td>
                </tr>
                <tr>
                    <td>Jumlah Stok</td>
                    <td>: <input type="number" name="stok" placeholder="10"></td>
                </tr>
                <tr>
                    <td>Deskripsi</td>
                    <td>: <textarea name="deskripsi" placeholder="Penjelasan singkat produk..."></textarea></td>
                </tr>
                <tr>
                    <td></td>
                    <td><button type="submit">Simpan ke Database</button></td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>