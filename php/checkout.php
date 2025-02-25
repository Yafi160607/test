<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');  // Arahkan ke halaman login jika tidak login
    exit();
}


// Periksa apakah keranjang belanja kosong
if (empty($_SESSION['shopping_cart'])) {
    header('Location: shoppingCart.php'); // Kembali ke halaman keranjang jika kosong
    exit();
}

// Menghitung total harga dari keranjang belanja
$total = 0;
foreach ($_SESSION['shopping_cart'] as $item) {
    $subtotal = $item['quantity'] * $item['harga'];
    $total += $subtotal;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Checkout</title>
    <link rel="stylesheet" href="../css/checkout.css" />
</head>
<body>
    <div class="checkout-container">
        <span class="top">Checkout</span>
        <span class="bottom">Informasi Pengiriman</span>
        
        <div class="form-container">
        <form method="POST" action="prosescheckout.php">
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama" required placeholder="Enter your Name" value="<?php echo isset($_SESSION['user_name']) ? htmlspecialchars($_SESSION['user_name']) : ''; ?>">
            </div>
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <textarea id="alamat" name="alamat" required placeholder="Enter your Address"><?php echo isset($_SESSION['user_address']) ? htmlspecialchars($_SESSION['user_address']) : ''; ?></textarea>
            </div>
            <div class="form-group">
                <label for="phone">Nomor Telepon</label>
                <input type="text" name="phone" id="phone" required placeholder="Enter your Phone" value="<?php echo isset($_SESSION['user_phone']) ? htmlspecialchars($_SESSION['user_phone']) : ''; ?>">
            </div>
            <h3>Ringkasan Pesanan</h3>
            <table>
                <tr>
                    <th>Produk</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                </tr>
                <?php foreach ($_SESSION['shopping_cart'] as $item): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($item['nama']); ?></td>
                        <td><?php echo $item['quantity']; ?></td>
                        <td>Rp <?php echo number_format($item['quantity'] * $item['harga'], 0, ',', '.'); ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="2">Total</td>
                    <td>Rp <?php echo number_format($total, 0, ',', '.'); ?></td>
                </tr>
            </table>

            <!-- Pilihan Metode Pembayaran -->
            <h3>Metode Pembayaran</h3>
            <label>
                <input type="radio" name="payment_method" value="bank_transfer" checked />
                Transfer Bank
            </label>
            <br>
            <label>
                <input type="radio" name="payment_method" value="cash_on_delivery" />
                Bayar di Tempat (COD)
            </label>
            <br>

            <button type="submit">Proses Pembayaran</button>
        </form>
        </div>
    </div>
</body>
</html>
