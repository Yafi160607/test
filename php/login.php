<?php
session_start();
include "koneksi.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>

<?php 
if (isset($_POST['email'], $_POST['username'], $_POST['nama'], $_POST['password'])) {
    // Sanitasi input untuk mencegah SQL Injection
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $password = md5($_POST['password']);

    // Query ke database untuk mendapatkan data pengguna
    $query = mysqli_query($koneksi, "SELECT * FROM user WHERE email='$email' AND username='$username' AND nama='$nama' AND password='$password'");

    if (mysqli_num_rows($query) > 0) {
        $data = mysqli_fetch_array($query);
        
        // Menyimpan data pengguna dalam session
        $_SESSION['user'] = $data;  // Menyimpan data lengkap pengguna
        $_SESSION['user_id'] = $data['id'];  // Menyimpan ID pengguna untuk validasi lebih lanjut

        // Cek role dari data hasil query
        if ($data['role'] === 'admin') {
            echo '<script>alert("Selamat datang, '.$data['nama'].' (Admin)"); location.href="../php/Admin.php";</script>';
        } else if ($data['role'] === 'user') {
            echo '<script>alert("Selamat datang, '.$data['nama'].' (User)"); location.href="../php/dashboard.php";</script>';
        } else {
            echo '<script>alert("Role tidak dikenal."); location.href="login.php";</script>';
        }
    } else {
        echo '<script>alert("Email/Nama/Username/Password tidak sesuai.");</script>';
    }
}
?>

<div class="header">
    <img src="../image/cilembu (unrevision).png" alt="LOGO">
</div>
<div class="container">
    <div class="title">
        <span>Login To Your</span>
        <span>Account</span>
    </div>
    <div class="form-container">
        <a href="register.php" class="register">Register</a>
        <form method="POST" action="login.php">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required placeholder="Enter your email">
            </div>
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama" required placeholder="Enter your name">
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" required placeholder="Enter your username">
            </div>
            <div class="form-group password-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required placeholder="Enter your password">
                <i class="fas fa-eye-slash password-icon" id="togglePassword"></i>
            </div>
            <a href="#" class="forgot-password">Lupa Password</a>
            <div class="remember-me">
                <input type="checkbox" id="remember">
                <label for="remember">Remember me</label>
            </div>
            <button class="btn btn-login" type="submit">Login</button>
        </form>
    </div>
</div>

<script src="../js/login.js"></script>
</body>
</html>
