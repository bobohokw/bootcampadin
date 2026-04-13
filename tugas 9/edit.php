<?php
$koneksi = mysqli_connect("localhost", "root", "jakarta48", "ecommerce_dino");
$id = $_GET['id'];
$res = mysqli_query($koneksi, "SELECT * FROM products WHERE id=$id");
$row = mysqli_fetch_assoc($res);

if (isset($_POST['update'])) {
    $nama = $_POST['nama_produk'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    
    mysqli_query($koneksi, "UPDATE products SET nama_produk='$nama', harga='$harga', stok='$stok' WHERE id=$id");
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Produk</title>
    <style>
        body { font-family: sans-serif; padding: 50px; background: #f4f7f6; }
        .edit-box { background: white; padding: 20px; border-radius: 8px; width: 300px; margin: auto; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        input { width: 100%; padding: 8px; margin-bottom: 10px; box-sizing: border-box; }
    </style>
</head>
<body>
    <div class="edit-box">
        <h3>Update Data Produk</h3>
        <form method="POST">
            <label>Nama Produk:</label>
            <input type="text" name="nama_produk" value="<?php echo $row['nama_produk']; ?>">
            <label>Harga:</label>
            <input type="number" name="harga" value="<?php echo $row['harga']; ?>">
            <label>Stok:</label>
            <input type="number" name="stok" value="<?php echo $row['stok']; ?>">
            <button type="submit" name="update" style="width:100%; padding:10px; background:#007bff; color:white; border:none; cursor:pointer;">Simpan Perubahan</button>
            <p align="center"><a href="index.php">Batal</a></p>
        </form>
    </div>
</body>
</html>