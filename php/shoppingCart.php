<?php
session_start();
include "koneksi.php";

// Cek apakah ada aksi yang diterima
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    $id = $_GET['id'];

    // Validasi ID produk untuk mencegah SQL injection
    if (!is_numeric($id)) {
        echo json_encode(['success' => false, 'message' => 'Invalid product ID']);
        exit;
    }

    // Cek apakah produk ada di keranjang
    if (isset($_SESSION['shopping_cart'][$id])) {
        
        // Aksi update jumlah produk
        if ($action == 'update') {
            $quantity = $_GET['quantity'];

            // Validasi quantity agar tidak negatif atau 0
            if (!is_numeric($quantity) || $quantity <= 0) {
                echo json_encode(['success' => false, 'message' => 'Invalid quantity']);
                exit;
            }

            // Perbarui jumlah barang di sesi jika quantity lebih dari 0
            if ($quantity > 0) {
                $_SESSION['shopping_cart'][$id]['quantity'] = $quantity;
            } else {
                // Hapus item jika quantity <= 0
                unset($_SESSION['shopping_cart'][$id]);
            }
        }
        
        // Aksi hapus produk dari keranjang
        if ($action == 'remove') {
            // Hapus produk dari keranjang
            unset($_SESSION['shopping_cart'][$id]);
        }

        // Hitung total dan subtotal terbaru
        $total = 0;
        $new_subtotal = 0; // Variabel subtotal untuk item yang diubah
        foreach ($_SESSION['shopping_cart'] as $item) {
            $subtotal = $item['quantity'] * $item['harga'];
            $total += $subtotal;

            // Menghitung subtotal item yang diupdate
            if ($item['id'] == $id) {
                $new_subtotal = $subtotal;
            }
        }

        // Kirimkan respons JSON untuk update
        echo json_encode([ 
            'success' => true, 
            'new_total' => number_format($total, 0, ',', '.'), // Format total dalam rupiah
            'new_subtotal' => number_format($new_subtotal, 0, ',', '.'), // Format subtotal
            'new_quantity' => isset($_SESSION['shopping_cart'][$id]['quantity']) ? $_SESSION['shopping_cart'][$id]['quantity'] : 0 // Menghindari error jika item sudah dihapus
        ]);
        exit();
    } else {
        // Jika item tidak ada di keranjang
        echo json_encode(['success' => false, 'message' => 'Item not found in the cart.']);
        exit();
    }
}

// Mengambil data keranjang dari sesi
$shoppingCart = isset($_SESSION['shopping_cart']) ? $_SESSION['shopping_cart'] : [];
$cartItems = [];

// Ambil item dari database berdasarkan ID di keranjang
if (!empty($shoppingCart)) {
    $ids = implode(',', array_keys($shoppingCart));
    $query = "SELECT id, nama, harga, foto FROM produk WHERE id IN ($ids)";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $row['quantity'] = (int)$shoppingCart[$row['id']]['quantity'];
            $cartItems[] = $row;
        }
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>


<!-- HTML Bagian Keranjang Belanja -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="../fontawesome/css/all.min.css" />
    <link rel="stylesheet" href="../css/shoppingCart.css" />
</head>
<body>
    <div class="sidebar">
        <div class="logo"></div>
        <ul class="menu">
            <li><a href="../php/dashboard.php"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>
            <li class="dropdown"><a href="#"><i class="fas fa-utensils"></i><span> Menu </span></a>
                <ul class="dropdown-content">
                    <li><a href="../php/menu.php">Food</a></li>
                    <li><a href="../php/minuman.php">Drink</a></li>
                </ul>
            </li>
            <li><a href="../php/contact.php"><i class="fas fa-phone-alt"></i><span>Contact</span></a></li>
            <li><a href="../php/about.php"><i class="fas fa-info-circle"></i><span>About</span></a></li>
            <li class="Logout">
                <a href="logout.php" onclick="return confirmLogout()">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
                <script>
                    function confirmLogout() {
                        return confirm("Apakah Anda yakin ingin logout?");
                    }
                </script>
            </li>
        </ul>
    </div>
    <div class="main_container">
        <div class="header_wrapper">
            <div class="header_title">
                <h2>Your Cart</h2>
            </div>
            <a href="../php/shoppingCart.php">
                <i class="fas fa-shopping-cart"></i>
            </a>
        </div>

        <div class="cart-container">
        <?php 
        $total = 0; // Inisialisasi variabel total sebelum loop
        if (!empty($cartItems)) : 
            foreach ($cartItems as $item) : 
                $subtotal = (int)$item['harga'] * (int)$item['quantity'];
                $total += $subtotal;
        ?>
        <div class="cart-item" id="cart-item-<?php echo $item['id']; ?>">
            <img src="../imageinput/<?php echo $item['foto']; ?>" alt="<?php echo htmlspecialchars($item['nama']); ?>">
            <div class="item-details">
                <p class="item-name"><?php echo htmlspecialchars($item['nama']); ?></p>
                <p class="item-price">Rp <?php echo number_format($item['harga'], 0, ',', '.'); ?></p>

                <div class="quantity-control">
                    <button class="quantity-button" onclick="updateQuantity(<?php echo $item['id']; ?>, 'decrease')">-</button>
                    <span id="quantity-<?php echo $item['id']; ?>" class="quantity-value"><?php echo $item['quantity']; ?></span>
                    <button class="quantity-button" onclick="updateQuantity(<?php echo $item['id']; ?>, 'increase')">+</button>
                </div>

                <div class="subtotal" id="subtotal-<?php echo $item['id']; ?>">
                    <p>Subtotal: Rp <?php echo number_format($subtotal, 0, ',', '.'); ?></p>
                </div>
            </div>

            <div>
                <button class="remove-from-cart" onclick="removeItem(<?php echo $item['id']; ?>)">Hapus</button>
            </div>
        </div>
        <?php endforeach; ?>

        <div class="cart-summary">
            <p class="total-amount">Total: Rp <span id="total-amount"><?php echo number_format($total, 0, ',', '.'); ?></span></p>
            <a href="checkout.php" class="continue-shopping">Checkout</a>
        </div>
    <?php else: ?>
        <div class="empty-message">
            <p>Keranjang belanja Anda kosong.</p>
        </div>
    <?php endif; ?>
</div>

<script>
// Fungsi untuk memperbarui jumlah item
function updateQuantity(id, action) {
    let quantity = parseInt(document.getElementById('quantity-' + id).innerText);
    if (action === 'increase') {
        quantity++;
    } else if (action === 'decrease' && quantity > 1) {
        quantity--;
    }
    
    fetch(`shoppingCart.php?action=update&id=${id}&quantity=${quantity}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Perbarui tampilan jumlah dan subtotal
                document.getElementById('quantity-' + id).innerText = data.new_quantity;
                document.getElementById('subtotal-' + id).innerText = 'Subtotal: Rp ' + new Intl.NumberFormat().format(data.new_subtotal);
                document.getElementById('total-amount').innerText = 'Rp ' + new Intl.NumberFormat().format(data.new_total);
            } else {
                alert('Gagal memperbarui keranjang');
            }
        })
        .catch(error => console.error('Error:', error));
}

// Fungsi untuk menghapus item dari keranjang
function removeItem(id) {
    const confirmRemove = confirm("Are you sure you want to remove this item from the cart?");
    if (!confirmRemove) return;

    fetch(`shoppingCart.php?action=remove&id=${id}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Hapus item dari tampilan
                const cartItem = document.getElementById('cart-item-' + id);
                cartItem.remove();
                // Perbarui total
                document.getElementById('total-amount').innerText = 'Rp ' + new Intl.NumberFormat().format(data.new_total);
            } else {
                alert('Failed to remove item');
            }
        })
        .catch(error => console.error('Error:', error));
}
</script>
</body>
</html>
