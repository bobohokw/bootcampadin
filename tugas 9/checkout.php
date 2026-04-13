<?php
session_start();
$koneksi = mysqli_connect("localhost", "root", "jakarta48", "ecommerce_dino");

if (empty($_SESSION['cart'])) {
    echo "<script>alert('Keranjang kosong!'); window.location='home.php';</script>";
    exit;
}

// Simulasi ambil ID User (Idealnya dari login, tapi kita ambil user terakhir saja untuk tugas ini)
$ambil_user = mysqli_query($koneksi, "SELECT id_user FROM users ORDER BY id_user DESC LIMIT 1");
$user = mysqli_fetch_assoc($ambil_user);
$id_user = $user['id_user'] ?? 0;

$total = $_GET['total'];
$tgl = date("Y-m-d H:i:s");

// Simpan ke tabel pesanan
mysqli_query($koneksi, "INSERT INTO pesanan (id_user, tanggal_pesanan, total_bayar) VALUES ('$id_user', '$tgl', '$total')");

// Kosongkan keranjang setelah checkout
unset($_SESSION['cart']);

echo "<script>alert('Checkout Berhasil!'); window.location='laporan.php';</script>";
?>