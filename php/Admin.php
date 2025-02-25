<?php
session_start();
include "koneksi.php";

// Pastikan pengguna sudah login dan role-nya adalah admin
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    // Redirect ke halaman login atau halaman lain jika bukan admin
    header("Location: login.php");
    exit();
}

// Jika admin, ambil username dari session
$username = $_SESSION['user']['username'];

// Query untuk mendapatkan data kategori dan produk
$queryKategori = mysqli_query($koneksi, "SELECT * FROM kategori");
$jumlahKategori = mysqli_num_rows($queryKategori);

$queryProduk = mysqli_query($koneksi, "SELECT * FROM produk");
$jumlahProduk = mysqli_num_rows($queryProduk);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../css/Admin.css">
</head>
<body>
    <!-- Navbar start -->
    <div class="navbar">
        <ul class="nav-list">
            <li><a href="Admin.php">Home</a></li>
            <li><a href="kategori.php">Kategori</a></li>
            <li><a href="produk.php">Produk</a></li>
            <li class="Logout">
          <a href="logout.php" onclick="return confirmLogout()">
          <span>Logout</span></a>
          <script>
            function confirmLogout() {
            return confirm("Apakah Anda yakin ingin logout?");
           }
          </script>
            </a>
          </li>
        </ul>
    </div>
      <!-- End Navbar -->
       
    <div class="breadcrumb">
        <a href="../php/Admin.php"><i class="fas fa-home"></i> Home</a>
    </div>

    <div class="container">
        <h2>Halo <?php echo $username; ?></h2>
    </div>

    <div class="card_container">
        <div class="card_wrapper">
            <div class="kategori_card">
                <div class="card_header">
                    <div class="action">
                        <span class="kategori_value"><b>Kategori</b></span>
                        <p class="detail"><?php echo $jumlahKategori; ?> Kategori</p>
                        <span class="judul"><a href="../php/kategori.php">See for detail</a></span>
                    </div>
                    <i class="fas fa-list"></i>
                </div>
            </div>
            <div class="produk_card">
                <div class="card_head">
                    <div class="process">
                        <span class="produk_value"><b>Product</b></span>
                        <p class="detail"><?php echo $jumlahProduk; ?> Product</p>
                        <span class="judul"><a href="../php/produk.php">See for detail</a></span>
                    </div>
                    <i class="fas fa-box"></i>
                </div>
            </div>
        </div>
    </div>
</body>
</html> 
