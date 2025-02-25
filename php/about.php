<?php
include "koneksi.php";
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>About Us</title>
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Anton&display=swap"
    />
    <link rel="stylesheet" href="../fontawesome/css/all.min.css" />
    <link rel="stylesheet" href="../css/aboutstyle.css" />
  </head>
  <body>
    <div class="main_wrapper">
      <div class="sidebar">
        <div class="logo"></div>
        <ul class="menu">
          <li>
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
          <li class="active">
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

      <!-- Container Part -->
      <div class="main_container">
        <div class="header_wrapper">
          <div class="header_title">
            <h2>Cafe Informations</h2>
          </div>
          <div class="user_info">
            <img src="../image/cilembu (unrevision).png" alt="logo" />
          </div>
        </div>

        <div class="body-container">
          <div class="head">
            <h5>About Us</h5>
          </div>

          <div class="container">
            <div class="cafe-name">
              <span style="color: #b45b59"> CILEMBU </span> <br />
              <span style="color: #b2abab"> HILLS </span> <br />
              <span style="color: #ebdaba"> CAFE </span> <br />
            </div>

            <div class="information">
              <div class="head-desc">
                <h6>About Cafe</h6>
              </div>
              <div class="desc">
                <p>
                  Cafe yang didirakan oleh murid 11 RPL 2 Bernama Dede, Dela,
                  Nadine, Silvia, Vany, dan Yafi. Restoran ini didirikan karena
                  atas tugas dari mapel PKWU.
                </p>
              </div>
              <div class="foot">
                <p>Thanks</p>
              </div>

              <div class="bout-cafe">
                <div class="color-pallete">
                  <span style="background-color: #b2abab"></span>
                  <span style="background-color: #b45b59"></span>
                  <span style="background-color: #f4b23a"></span>
                  <span style="background-color: #b2abab"></span>
                </div>

                <div class="social-media">
                  <a href="#"> @WIKICILEMBUHILLSCAFEE</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

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
  </body>
</html>
