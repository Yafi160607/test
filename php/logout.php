<?php
session_start();

// Menghancurkan semua session yang aktif
session_unset();  // Menghapus semua variabel sesi
session_destroy();  // Menghancurkan sesi

// Mengarahkan pengguna kembali ke halaman login setelah logout
header('Location: login.php');
exit();
?>
