<?php
$koneksi = mysqli_connect("localhost", "root", "jakarta48", "ecommerce_dino");

// --- Fitur DELETE USER ---
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM users WHERE id_user=$id");
    header("Location: tambah_user.php");
}

// --- Fitur CREATE USER ---
if (isset($_POST['daftar'])) {
    $nama = $_POST['nama_lengkap'];
    $email = $_POST['email'];
    $telp = $_POST['telepon'];
    $alamat = $_POST['alamat'];

    mysqli_query($koneksi, "INSERT INTO users (nama_lengkap, email, telepon, alamat) 
                            VALUES ('$nama', '$email', '$telp', '$alamat')");
    echo "<script>alert('User berhasil ditambahkan!'); window.location='tambah_user.php';</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>DinoMarket - Manajemen User</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #f4f7f6; padding: 20px; }
        nav { background: #333; padding: 15px; margin-bottom: 25px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.2); }
        nav a { color: white; text-decoration: none; margin-right: 20px; font-weight: bold; }
        nav a:hover { color: #28a745; }
        .flex-container { display: flex; gap: 20px; }
        .card { background: white; padding: 20px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .form-side { width: 320px; height: fit-content; }
        .table-side { flex: 1; }
        input, textarea { width: 100%; padding: 10px; margin-bottom: 12px; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box; }
        button { width: 100%; padding: 12px; background: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer; font-weight: bold; }
        button:hover { background: #0056b3; }
        .btn-hapus { color: #dc3545; text-decoration: none; font-weight: bold; }
    </style>
</head>
<body>

<nav>
    <a href="index.php">📦 Manajemen Produk</a>
    <a href="tambah_user.php" style="border-bottom: 2px solid #28a745; padding-bottom: 5px;">👤 Manajemen User</a>
</nav>

<div class="flex-container">
    <div class="card form-side">
        <h3>👤 Registrasi User</h3>
        <form method="POST">
            <input type="text" name="nama_lengkap" placeholder="Nama Lengkap" required>
            <input type="email" name="email" placeholder="Email (contoh@dino.com)" required>
            <input type="number" name="telepon" placeholder="Nomor Telepon" required>
            <textarea name="alamat" rows="4" placeholder="Alamat Lengkap"></textarea>
            <button type="submit" name="daftar">Simpan User</button>
        </form>
    </div>

    <div class="card table-side">
        <h3>📋 Daftar Pelanggan Terdaftar</h3>
        <table id="tabelUser" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Telepon</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $res = mysqli_query($koneksi, "SELECT * FROM users");
                while($row = mysqli_fetch_assoc($res)) {
                ?>
                <tr>
                    <td><strong><?php echo $row['nama_lengkap']; ?></strong></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['telepon']; ?></td>
                    <td><?php echo $row['alamat']; ?></td>
                    <td>
                        <a href="tambah_user.php?hapus=<?php echo $row['id_user']; ?>" class="btn-hapus" onclick="return confirm('Hapus user ini?')">Hapus</a>
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
        $('#tabelUser').DataTable({
            "language": { "url": "//cdn.datatables.net/plug-ins/1.13.4/i18n/id.json" }
        });
    });
</script>

</body>
</html>