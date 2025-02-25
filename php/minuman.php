<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include "koneksi.php";

// Query untuk mengambil data menu dari tabel produk
$queryDrink = mysqli_query($koneksi, "SELECT id, nama, harga, foto, detail FROM produk WHERE kategori_id = 23 ");

if (!$queryDrink) {
    die('Query gagal: ' . mysqli_error($koneksi));
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Drink Menu</title>
    <link rel="stylesheet" href="../fontawesome/css/all.min.css" />
    <link rel="stylesheet" href="../css/menu.css" />
</head>
<body>
<script src="../js/dashboard.js"></script>
    <div class="sidebar">
        <div class="logo"></div>
        <ul class="menu">
            <li>
                <a href="../php/dashboard.php">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="dropdown" class="active">
                <a href="#">
    <i class="fas fa-utensils"></i>
    <span> Menu </span>
  </a>
  <ul id="dropdown" class="dropdown-content">
    <li>
      <a href="../php/menu.php"><span>Food</span> </a>
    </li>
    <li>
      <a href="../php/minuman.php"><span>Drink</span></a>
    </li>
  </ul>
</li>
            <li>
                <a href="../php/contact.php">
                    <i class="fas fa-phone-alt"></i>
                    <span>Contact</span>
                </a>
            </li>
            <li>
                <a href="../php/about.php">
                    <i class="fas fa-info-circle"></i>
                    <span>About</span>
                </a>
            </li>
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
                <h2>Menu Information</h2>
            </div>
            <a href="../php/shoppingCart.php">
            <i class="fas fa-shopping-cart"></i>
            </a>
        </div>

        <div class="menu-container">
            <?php
            // Perulangan untuk menampilkan setiap data menu
            while ($data = mysqli_fetch_assoc($queryDrink)) { ?>
                <div class="menu-item">
                    <img src="../imageinput/<?php echo htmlspecialchars($data['foto']); ?>" alt="<?php echo htmlspecialchars($data['nama']); ?>" />
                    <h3><?php echo htmlspecialchars($data['nama']); ?></h3>
                    <p><?php echo htmlspecialchars($data['detail']); ?></p>
                    <div class="price-button-container">
                        <p class="price">Rp <?php echo number_format($data['harga'], 0, ',', '.'); ?></p>
                        <a href="addCart.php?p=<?php echo $data['id']; ?>">
                            <button class="add-to-cart">Add to Cart</button>
                        </a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <script src="../js/sidebar.js"></script>
</body>
</html>
