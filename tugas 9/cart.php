<?php
session_start();
$koneksi = mysqli_connect("localhost", "root", "jakarta48", "ecommerce_dino");

// Penjual (Ganti dengan nomor WhatsApp kamu, awali dengan 62)
$nomor_admin = "6281234567890"; 
?>

<!DOCTYPE html>
<html>
<head>
    <title>Checkout DinoMarket</title>
    <style>
        body { font-family: sans-serif; background: #f4f7f6; padding: 40px; }
        .cart-box { background: white; padding: 25px; border-radius: 10px; max-width: 600px; margin: auto; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        th, td { border-bottom: 1px solid #ddd; padding: 12px; text-align: left; }
        .btn-wa { background: #25D366; color: white; padding: 12px 20px; text-decoration: none; border-radius: 5px; display: inline-block; font-weight: bold; }
        .btn-wa:hover { background: #128C7E; }
    </style>
</head>
<body>

<div class="cart-box">
    <h2>🛒 Rincian Pesanan Dino</h2>
    <table>
        <tr><th>Produk</th><th>Qty</th><th>Subtotal</th></tr>
        <?php 
        $total_bayar = 0;
        $pesan_wa = "Halo Admin DinoMarket, saya mau konfirmasi pesanan:%0A"; // Pesan awal WA
        
        if(!empty($_SESSION['cart'])){
            foreach($_SESSION['cart'] as $id => $jumlah){
                $res = mysqli_query($koneksi, "SELECT * FROM products WHERE id=$id");
                $p = mysqli_fetch_assoc($res);
                $subtotal = $p['harga'] * $jumlah;
                $total_bayar += $subtotal;
                
                // Tambahkan rincian barang ke pesan WA
                $pesan_wa .= "- " . $p['nama_produk'] . " (x" . $jumlah . ")%0A";
        ?>
        <tr>
            <td><?php echo $p['nama_produk']; ?></td>
            <td><?php echo $jumlah; ?></td>
            <td>Rp <?php echo number_format($subtotal); ?></td>
        </tr>
        <?php 
            }
            $pesan_wa .= "%0A*Total Bayar: Rp " . number_format($total_bayar) . "*%0AMohon diproses ya!";
        } else {
            echo "<tr><td colspan='3' align='center'>Keranjang kosong</td></tr>";
        }
        ?>
        <tr>
            <td colspan="2" align="right"><strong>Total:</strong></td>
            <td><strong>Rp <?php echo number_format($total_bayar); ?></strong></td>
        </tr>
    </table>
<td>
    <a href="https://api.whatsapp.com/send?phone=<?php echo $row['telepon']; ?>&text=Halo%20<?php echo urlencode($row['nama_lengkap']); ?>,%20kami%20dari%20DinoMarket" 
       target="_blank" 
       style="background: #25D366; color: white; padding: 5px 10px; text-decoration: none; border-radius: 4px; font-size: 12px;">
       💬 Chat WA
    </a>

    <a href="tambah_user.php?hapus=<?php echo $row['id_user']; ?>" 
       class="btn-hapus" 
       onclick="return confirm('Hapus user ini?')">Hapus</a>
</td>
    <br>
    <a href="index.php" style="color: #666; text-decoration: none;">← Kembali Belanja</a>
    
    <?php if($total_bayar > 0): ?>
       <a href="https://api.whatsapp.com/send?phone=6281295245344&text=<?php echo $pesan_wa; ?>"
           target="_blank" class="btn-wa">
           📱 Kirim Status ke WhatsApp
        </a>
        <a href="checkout.php?total=<?php echo $total_bayar; ?>" 
   class="btn-wa" style="background: #007bff; margin-left: 10px;">
   ✅ Selesaikan Pesanan (Checkout)
</a>
    <?php endif; ?>
</div>

</body>
</html>