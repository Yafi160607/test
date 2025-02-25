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
    <link rel="stylesheet" href="../css/register.css">
</head>
<body>
<?php 
        if (isset($_POST['email']) && isset($_POST['username']) && isset($_POST['password'])) {
            $email = $_POST['email'];
            $nama = $_POST['nama'];
            $username = $_POST['username'];
            $password = md5($_POST['password']);
            
            // Set role default sebagai 'user'
            $role = 'user';

            // Query untuk memasukkan data ke database
            $query = mysqli_query($koneksi, "INSERT INTO user(email, nama, username, password, role) VALUES ('$email', '$nama', '$username', '$password', '$role')");
            
            if ($query) {
                echo '<script>alert("Selamat, Registrasi Anda Berhasil, Silahkan Login."); location.href="login.php";</script>';
            } else {
                echo '<script>alert("Pendaftaran gagal, silahkan coba lagi.");</script>';
            }
        }
        ?>
    <div class="header">
        <i class="fas fa-bars"></i>
        <span>Login</span>
    </div>
    <div class="container">
        <div class="title">
            <span>Register</span>
            <span>Account</span>
        </div>
        <div class="form-container">
    <a href="login.php" class="login">Login</a>
    <form method="POST" action="register.php">
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" placeholder="">
    </div>
    <div class="form-group">
        <label for="nama">Nama</label>
        <input type="text" name="nama" id="nama" placeholder="">
    </div>
    <div class="form-group">
        <label for="username">Username</label> 
        <input type="text" name="username" id="username" placeholder=""> 
    </div>
    <div class="form-group password-group">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" placeholder="">
        <i class="fas fa-eye-slash password-icon" id="togglePassword"></i>
    </div>
    <button class="btn btn-regist" type="submit">Regist</button>
</form>
</div>
    </div>

    <script src="login.js"></script>
</body>
</html>
