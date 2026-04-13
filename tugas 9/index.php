<?php
session_start();
$koneksi = mysqli_connect("localhost", "root", "jakarta48", "ecommerce_dino");

// HAPUS PRODUK (DELETE)
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM products WHERE id=$id");
    header("Location: index.php");
}

// TAMBAH PRODUK (CREATE)
if (isset($_POST['tambah'])) {
    $nama = $_POST['nama_produk'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $desc = $_POST['deskripsi'];
    $gambar = $_FILES['gambar']['name'];
    move_uploaded_file($_FILES['gambar']['tmp_name'], "img/".$gambar);

    mysqli_query($koneksi, "INSERT INTO products (nama_produk, harga, stok, deskripsi, gambar) 
                            VALUES ('$nama', '$harga', '$stok', '$desc', '$gambar')");
}

// MASUK KERANJANG (CART)
if (isset($_GET['beli'])) {
    $id = $_GET['beli'];
    $_SESSION['cart'][$id] = ($_SESSION['cart'][$id] ?? 0) + 1;
    echo "<script>alert('Berhasil ditambah ke keranjang!'); window.location='index.php';</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>DinoMarket - Admin & Shop</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <style>
        body { font-family: sans-serif; background: #f4f7f6; padding: 20px; }
        .flex-container { display: flex; gap: 20px; }
        .card { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        .form-side { width: 300px; }
        .table-side { flex: 1; }
        img { width: 50px; height: 50px; object-fit: cover; border-radius: 4px; }
    </style>
</head>
<body>
<nav style="background: #333; padding: 15px; margin-bottom: 25px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.2);">
    <a href="index.php" style="color: white; text-decoration: none; margin-right: 20px; font-weight: bold; border-bottom: 2px solid #28a745; padding-bottom: 5px;">📦 Manajemen Produk</a>
    <a href="tambah_user.php" style="color: white; text-decoration: none; font-weight: bold;">👤 Manajemen User</a>
</nav>

<div class="flex-container">
    <div class="card form-side">
        <h3>Tambah Produk Baru</h3>
        <form method="POST" enctype="multipart/form-data">
            <input type="text" name="nama_produk" placeholder="Nama Produk" required style="width:100%; margin-bottom:10px;">
            <input type="number" name="harga" placeholder="Harga" required style="width:100%; margin-bottom:10px;">
            <input type="number" name="stok" placeholder="Stok" required style="width:100%; margin-bottom:10px;">
            <textarea name="deskripsi" placeholder="Deskripsi" style="width:100%; margin-bottom:10px;"></textarea>
            <input type="file" name="gambar" required style="margin-bottom:15px;">
            <button type="submit" name="tambah" style="width:100%; padding:10px; background:#28a745; color:white; border:none; border-radius:4px; cursor:pointer;">Simpan Produk</button>
        </form>
    </div>

    <div class="card table-side">
        <div style="margin-bottom:20px; padding:10px; background:#e3f2fd; border-radius:5px;">
            🛒 Keranjang: <strong><?php echo isset($_SESSION['cart']) ? array_sum($_SESSION['cart']) : 0; ?></strong> item | 
            <a href="cart.php">Buka Keranjang Belanja</a>
        </div>

        <table id="tabelDino" class="display">
            <thead>
                <tr>
                    <th>Gambar</th>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $res = mysqli_query($koneksi, "SELECT * FROM products");
                while($row = mysqli_fetch_assoc($res)) {
                ?>
                <tr>
                    <td><img src="img/<?php echo $row['gambar']; ?>" onerror="this.src='https://via.placeholder.com/50'"></td>
                    <td><?php echo $row['nama_produk']; ?></td>
                    <td>Rp <?php echo number_format($row['harga']); ?></td>
                    <td>
                        <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a> | 
                        <a href="index.php?beli=<?php echo $row['id']; ?>" style="color:blue">Beli</a> | 
                        <a href="index.php?hapus=<?php echo $row['id']; ?>" style="color:red" onclick="return confirm('Hapus produk ini?')">Hapus</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#tabelDino').DataTable();
    });
</script>
</body>
</html>