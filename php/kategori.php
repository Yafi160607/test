<?php
session_start();
include "koneksi.php";

$queryKategori = mysqli_query($koneksi, "SELECT * FROM kategori");
$jumlahKategori = mysqli_num_rows($queryKategori);

if(isset($_POST['simpan_kategori'])){
    $kategori = htmlspecialchars(trim($_POST['kategori'])); 

    // Memeriksa jika input kategori kosong
    if(empty($kategori)){
        $alertMessage = "Kategori tidak boleh kosong.";  // Peringatan jika input kosong
    } else {
        $queryExist = mysqli_query($koneksi, "SELECT nama FROM kategori WHERE TRIM(LOWER(nama)) = TRIM(LOWER('$kategori'))");
        $jumlahDataKategoriBaru = mysqli_num_rows($queryExist);

        if($jumlahDataKategoriBaru > 0){
            // Menampilkan pesan error jika kategori sudah ada
            $alertMessage = "Data Kategori sudah tersedia"; 
        } else {
            // Menyimpan kategori baru ke database jika belum ada
            $queryInsert = mysqli_query($koneksi, "INSERT INTO kategori (nama) VALUES ('$kategori')");
            if($queryInsert){
                $alertMessage = "Kategori berhasil ditambahkan!";
            } else {
                $alertMessage = "Terjadi kesalahan saat menambahkan kategori.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori</title>
    <link rel="stylesheet" href="../fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../css/kategori.css"> 
</head>
<body>
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
    <div class="breadcrumb">
        <a href="../php/Admin.php"><i class="fas fa-home"></i> Home</a>
        <a href="../php/kategori.php"> / Kategori</a>
    </div>
    <!-- Tambah Katgeori -->
    <div class="form-kategori">
        <h2>Tambah Kategori</h2>

        <form action="" method="post">
            <div class="form-group">
                <label for="kategori">Kategori</label>
                <input type="text" id="kategori" name="kategori" placeholder="Input Your Category" class="form-control">
            </div>
            <div>
                <button type="submit" name="simpan_kategori" class="simpan_kategori">Save</button>
            </div>
        </form>

        <?php if(isset($alertMessage)): ?>
            <div id="alertBox" class="alert-warning">
                <?php echo $alertMessage; ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- List Table Kategori -->
    <div class="list-kategori">
        <h2>List Kategori</h2>
        <div class="table-kategori">
            <table class="table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    if ($jumlahKategori == 0) {
                ?>
                    <tr>
                        <td colspan="3">Data Kategori tidak tersedia</td>
                    </tr>
                <?php 
                    } else {
                        $jumlah = 1; 
                        while ($data = mysqli_fetch_array($queryKategori)) {
                ?>
                    <tr>
                        <td><?php echo $jumlah; ?></td>
                        <td><?php echo $data['nama']; ?></td>
                        <td>
                            <a href="kategori-detail.php?p=<?php echo $data['id']; ?>" class="btn-info"><i class="fas fa-search"></i></a>
                        </td>
                    </tr>
                <?php   
                    $jumlah++; 
                    }
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
