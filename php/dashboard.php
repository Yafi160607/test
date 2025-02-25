<?php
session_start();
include "koneksi.php";

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

// Arahkan ke halaman admin jika pengguna adalah admin
if ($_SESSION['user']['role'] === 'admin') {
    header("Location: Admin.php"); // Ubah ini sesuai dengan nama halaman admin
    exit();
}

// Jika bukan admin, pengguna diarahkan ke halaman dashboard user
$username = $_SESSION['user']['username'];

$queryFood = mysqli_query($koneksi, "SELECT id, nama, harga, foto, detail FROM produk WHERE kategori_id = 24 LIMIT 2");
$queryDrink = mysqli_query($koneksi, "SELECT id, nama, harga, foto, detail FROM produk WHERE kategori_id = 23 LIMIT 1");

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Anton&display=swap"
    />
    <link rel="stylesheet" href="../fontawesome/css/all.min.css" />
    <link rel="stylesheet" href="../css/dashboard.css" />
  </head>
  <body>
    <div class="main_wrapper">
      <div class="sidebar">
        <div class="logo"></div>
        <ul class="menu">
          <li class="active">
            <a href="../php/dashboard.php">
              <i class="fas fa-tachometer-alt"></i>
              <span> Dashboard </span>
            </a>
          </li>

          <li class="dropdown">
            <a href="#" onclick="toggleDropdown()">
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
              <span> Contact </span>
            </a>
          </li>
          <li>
            <a href="../php/about.php">
              <i class="fas fa-info-circle"></i>
              <span> About </span>
            </a>
          </li>
          <li class="Logout">
          <a href="logout.php" onclick="return confirmLogout()">
          <i class="fas fa-sign-out-alt"></i>
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

      <!-- Container Part  (Header Part)-->
      <div class="main_container">
        <div class="header_wrapper">
          <div class="header_title">
             <h2> <?php
              if (isset($_SESSION['user']['nama'])) {
                  echo $_SESSION['user']['nama'] . "'s Dashboard";
              } else {
                  echo "Guest's Dashboard"; 
              }
              ?></h2>
          </div>
          <div class="user_info">
            <img
              src="../image/cilembu (unrevision).png"
              alt="logo"
            />
          </div>
        </div>

        <!-- Body Container (ISI web)-->
        <div class="body-container">

       <div class="carousel slide" data-bs-ride="carousel">
    <!-- Carousel Indicators (Add this section) -->
       <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    
        <div class="carousel-inner">
      <div class="carousel-item">
        <img src="../image/cr-ds1.svg" alt="Featured Product 1">
        <div class="carousel-caption">
          <h5>Pink Soda</h5>
          <p>Quench your thirst with the sweet and bubbly charm of Pink Soda! A delightful mix of soda, creamy condensed milk, and a splash of syrup creates a refreshing drink that’s as fun to look at as it is to sip. Perfect for adding a little sparkle to your day! </p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="../image/cr-ds2.svg" alt="Featured Product 2">
        <div class="carousel-caption">
          <h5>Matcha Latte</h5>
          <p>Experience the perfect balance of creamy milk and rich, earthy matcha in every sip of our Matcha Latte. This refreshing drink is not only delicious but also packed with antioxidants, offering a healthy twist to your daily treat.</p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="../image/cr-ds3.svg" alt="Featured Product 3">
        <div class="carousel-caption">
          <h5>baguette</h5>
          <p>Say hello to Bagguattes—our delightful fusion of bagels and baguettes! Perfectly crispy on the outside, soft and chewy on the inside, these unique creations come with a variety of sweet and savory toppings.</p>
        </div>
      </div>
    </div>

    <!-- Carousel Navigation Buttons -->
     <div class="carousel-button">
    <button class="carousel-control-prev" type="button" data-bs-slide="prev" title="Preview">
      <i class="fa fa-angle-left" aria-hidden="true">
        <span style="visibility: hidden">Previous</span>
      </i>
    </button>

    <button class="carousel-control-next" type="button" data-bs-slide="next" title="Next">
      <i class="fa fa-angle-right" aria-hidden="true">
        <span style="visibility: hidden">Next</span>
      </i>
    </button>
    </div>
  </div>

  <!-- Latest Product -->

<section class="latest-products">
  <div class="container">
    <h2 class="text-center">Rekomendasi Products</h2>
    <div class="row">
      <?php
      // Looping untuk produk makanan
      while ($dataFood = mysqli_fetch_assoc($queryFood)) { ?>
        <div class="col">
          <div class="card">
            <img src="../imageinput/<?php echo htmlspecialchars($dataFood['foto']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($dataFood['nama']); ?>" />
            <div class="card-body">
              <h5 class="card-title"><?php echo htmlspecialchars($dataFood['nama']); ?></h5>
              <p class="card-text"><?php echo htmlspecialchars($dataFood['detail']); ?></p>
              <p class="price">Rp <?php echo number_format($dataFood['harga'], 0, ',', '.'); ?></p>
              <a href="addCart.php?p=<?php echo $dataFood['id']; ?>" class="btn">Buy Now</a>
            </div>
          </div>
        </div>
      <?php } ?>

      <?php
      // Looping untuk produk minuman
      while ($dataDrink = mysqli_fetch_assoc($queryDrink)) { ?>
        <div class="col">
          <div class="card">
            <img src="../imageinput/<?php echo htmlspecialchars($dataDrink['foto']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($dataDrink['nama']); ?>" />
            <div class="card-body">
              <h5 class="card-title"><?php echo htmlspecialchars($dataDrink['nama']); ?></h5>
              <p class="card-text"><?php echo htmlspecialchars($dataDrink['detail']); ?></p>
              <p class="price">Rp <?php echo number_format($dataDrink['harga'], 0, ',', '.'); ?></p>
              <a href="addCart.php?p=<?php echo $dataDrink['id']; ?>" class="btn">Buy Now</a>
            </div>
          </div>
        </div>
      <?php } ?>
      
    </div>
  </div>
</section>



      </div>
      </div>
    </div>
    </div>


    <!-- JAVA SCRIPT -->
    <script>
      document.addEventListener("DOMContentLoaded", function () {
        const sidebar = document.querySelector(".sidebar");
        const dropdown = document.querySelector(".dropdown");
        const dropdownContent = document.getElementById("dropdown");

        // Event listener untuk toggle sidebar dan dropdown saat tombol Menu ditekan
        dropdown.addEventListener("click", function (e) {
          e.stopPropagation(); // Mencegah event ini menyebar ke elemen lain
          const isDropdownVisible = dropdownContent.style.display === "block";

          // Toggle dropdown dan sidebar terbuka
          if (isDropdownVisible) {
            dropdownContent.style.display = "none";
            sidebar.classList.remove("expanded");
          } else {
            dropdownContent.style.display = "block";
            sidebar.classList.add("expanded");
          }
        });

        // Menutup sidebar saat salah satu item di dropdown diklik
        sidebar.querySelectorAll(".dropdown-content a").forEach((item) => {
          item.addEventListener("click", function () {
            dropdownContent.style.display = "none";
            sidebar.classList.remove("expanded");
          });
        });

        // Event listener untuk menutup sidebar jika klik di luar sidebar dan dropdown
        document.addEventListener("click", function (e) {
          // Cek apakah yang diklik bukan sidebar atau dropdown
          if (!sidebar.contains(e.target) && !dropdown.contains(e.target)) {
            dropdownContent.style.display = "none"; // Menutup dropdown
            sidebar.classList.remove("expanded"); // Menutup sidebar
          }
        });
      });
    </script>
    <script src="../js/dashboard.js"></script>
  </body>
</html>
