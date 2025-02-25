<?php
session_start();
include "koneksi.php";

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

// Mengambil data dari form
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$phone = $_POST['phone'];
$payment_method = $_POST['payment_method'];

// Simpan informasi pemesanan ke database
$query = "INSERT INTO orders (name, address, phone, payment_method, total, status) 
          VALUES ('$nama', '$alamat', '$phone', '$payment_method', '$total', 'pending')";
if (mysqli_query($koneksi, $query)) {
    $order_id = mysqli_insert_id($koneksi);

    // Simpan rincian produk yang dipesan ke dalam tabel `order_items`
    foreach ($_SESSION['shopping_cart'] as $item) {
        $product_id = $item['id'];
        $quantity = $item['quantity'];
        $subtotal = $item['quantity'] * $item['harga'];

        $query_item = "INSERT INTO order_items (order_id, product_id, quantity, subtotal) 
                       VALUES ('$order_id', '$product_id', '$quantity', '$subtotal')";
        mysqli_query($koneksi, $query_item);
    }

    // Kosongkan keranjang belanja setelah pemesanan
    unset($_SESSION['shopping_cart']);

    // Redirect ke halaman terima kasih
    header("Location: thank_you.php?order_id=$order_id");
    exit();
} else {
    echo "Terjadi kesalahan saat memproses pesanan. Silakan coba lagi.";
}
?>
