<?php
$koneksi = mysqli_connect("localhost", "root", "jakarta48", "ecommerce_dino");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Laporan Penjualan DinoMarket</title>
    <style>
        body { font-family: sans-serif; padding: 30px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background: #f4f4f4; }
        .btn-print { background: #333; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; }
        /* Style agar tombol tidak ikut ter-print */
        @print { .no-print { display: none; } }
    </style>
</head>
<body>

    <h2 align="center">🦖 LAPORAN PENJUALAN DINOMARKET</h2>
    <p align="center">Laporan rekapitulasi transaksi masuk.</p>

    <div align="center" class="no-print">
        <button onclick="window.print()" class="btn-print">🖨️ Cetak Laporan (PDF/Printer)</button>
        <a href="index.php" class="btn-print" style="background: #666;">Kembali ke Admin</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Tanggal</th>
                <th>Nama Pelanggan</th>
                <th>Total Bayar</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $res = mysqli_query($koneksi, "SELECT pesanan.*, users.nama_lengkap 
                                           FROM pesanan 
                                           JOIN users ON pesanan.id_user = users.id_user");
            while($row = mysqli_fetch_assoc($res)) {
            ?>
            <tr>
                <td><?php echo $row['id_pesanan']; ?></td>
                <td><?php echo $row['tanggal_pesanan']; ?></td>
                <td><?php echo $row['nama_lengkap']; ?></td>
                <td>Rp <?php echo number_format($row['total_bayar']); ?></td>
                <td><?php echo $row['status_kirim']; ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

</body>
</html>