<?php
session_start();
include "koneksi.php";

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Landing Page</title>
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Anton&display=swap"
    />
    <link rel="stylesheet" href="../fontawesome/css/all.min.css" />
    <link rel="stylesheet" href="../css/lanpage.css" />
  </head>
  <body>
    <header>
      <nav class="navbar">
        <div class="logo">
          <img src="../image/cilembu (unrevision).png" alt="LOGO" />
        </div>
      </nav>
    </header>

    <div class="main-wrapper">
      <main>
        <section class="best-seller">
          <h1>Cinnamon Roll</h1>
          <p>
            Cinnamon Roll kami dibuat dengan bahan berkualitas, dipenuhi isian
            gula dan kayu manis yang harum, lalu dipanggang hingga lembut
            sempurna. Ditambah glasir manis di atasnya, roti ini cocok untuk
            menemani sarapan atau cemilan sore Anda. Setiap gigitan penuh
            kenikmatan yang menggoda!
          </p>
        </section>
        <div class="image-container">
          <img src="../image/kukus putih.jpeg" alt="cinnamon rol" />
        </div>
      </main>

      <content class="top-produk">
        <div class="carousel">
          <input type="radio" name="slides" id="slide1" checked />
          <input type="radio" name="slides" id="slide2" />

          <div class="carousel-track">
            <div class="carousel-slide">
              <label for="slide1"
                ><img
                  src="../image/landing1.png"
                  alt="Product 1"
              /></label>
            </div>
            <div class="carousel-slide">
              <label for="slide2"
                ><img
                  src="../image/landing2.png"
                  alt="Product 2"
              /></label>
            </div>
          </div>

          <div class="carousel-controls">
            <label for="slide1" class="carousel-button">❮</label>
            <label for="slide2" class="carousel-button">❯</label>
          </div>
        </div>
      </content>
    </div>

    <!-- Footer & Social Section -->
    <footer class="last-container">
      <div class="left-part">
        <!-- Mengubah div="left-part" menjadi class="left-part" -->
        <div class="name-cafe">
          <h3 style="color: #b45b59">CILEMBU</h3>
          <br />
          <h3 style="color: #b2abab">
            HILLS
            <span style="color: #ebdaba">CAFE</span>
          </h3>
          <br />
        </div>

        <!-- LEFT PART-->
        <div class="footer-content">
          <div class="social-media">
            <div class="head-social-media">
              <h5>!Find Us On!</h5>
            </div>

            <div class="social-media-icon">
              <ul>
                <li>
                  <a href="https://www.instagram.com/cilembuhillscafe?igsh=MW9tcXFqc2k2aXVsbQ==" style="color: pink">
                    <i class="fa-brands fa-instagram"></i>
                  </a>
                </li>
                <li>
                  <a href="#" style="color: white">
                    <i class="fa-brands fa-square-x-twitter"></i>
                  </a>
                </li>
                <li>
                  <a href="https://www.tiktok.com/@cilembuhillscafe?_t=8rLYEdA0d53&_r=1" style="color: white">
                    <i class="fa-brands fa-tiktok"></i>
                  </a>
                </li>
                <li>
                  <a href="#" style="color: #4267b2">
                    <i class="fa-brands fa-square-facebook"></i>
                  </a>
                </li>
              </ul>
            </div>

            <div class="our-contact">
              <h3>CONTACT US</h3>

              <ul>
                <li>
                  <i class="fa-solid fa-phone">
                    <span> +62 851-9832-0041 </span>
                  </i>
                </li>
                <li>
                  <i class="fa-regular fa-envelope">
                    <span> cilembuhillscafe@gmail.com </span>
                  </i>
                </li>
              </ul>
            </div>
          </div>

          <div class="main-footer">
            <div class="about-us-footer">
              <h5>ABOUT US</h5>
              <ul class="about-us-sub-footer">
                <li>
                  <a href="../html/contact.html"><span> Contact Us </span></a>
                </li>
                <li>
                  <a href="#"><span> Our Products </span></a>
                </li>
              </ul>
            </div>

            <div class="about-us-footer">
              <h5>COMPANY</h5>
              <ul class="about-us-sub-footer">
                <li>
                  <a href="../html/about.html"><span> About Us </span></a>
                </li>
                <li>
                  <a href="../html/about.html"><span> Team </span></a>
                  <!-- Menutup tag span dengan benar -->
                </li>
                <li>
                  <a href="../php/menu.php"><span> Where To Buy </span></a>
                </li>
              </ul>
            </div>

            <div class="about-us-footer">
              <h5>SERVICE</h5>
              <ul class="about-us-sub-footer">
                <li>
                  <a href="../php/minuman.php"><span> Order </span></a>
                </li>
                <li>
                  <a href="../php/menu.php"><span> Delivery </span></a>
                </li>
              </ul>
            </div>
          </div>

          <div class="footer-button">
            <a href="../php/register.php" class="contact-button">
              <span>Sign Up</span> <i class="fa-solid fa-angle-right"></i>
            </a>
          </div>
        </div>
      </div>
    </footer>
  </body>
</html>
