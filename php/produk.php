<?php
session_start();
include "koneksi.php";

// Ambil semua produk
$query = mysqli_query($koneksi, 
    "SELECT a.*, b.nama AS nama_kategori 
     FROM produk a 
     JOIN kategori b ON a.kategori_id = b.id"
);

$jumlahProduk = mysqli_num_rows($query);

// Ambil semua kategori
$queryKategori = mysqli_query($koneksi, "SELECT * FROM kategori");

// Inisialisasi pesan alert
$alertMessage = "";

if (isset($_POST['save'])) {
    // Sanitasi input
    $nama = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['nama']));
    $kategori = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['kategori']));
    $harga = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['harga']));
    $stok = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['ketersediaan_stok']));
    $detail = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['detail'] ?? ""));

    $target_dir = "../imageinput/"; 
    $nama_file = basename($_FILES['foto']['name']);
    $imageFileType = strtolower(pathinfo($nama_file, PATHINFO_EXTENSION));
    $image_size = $_FILES['foto']['size'];
    $random_name = generateRandomString(20);
    $target_file = $target_dir . $random_name . "." . $imageFileType; 

    // Validasi input wajib
    if (empty($nama) || empty($kategori) || empty($harga)) {
        $alertMessage = "Nama, kategori, dan harga tidak boleh kosong.";
    } else {
        // Validasi kategori
        $queryKategoriValidasi = mysqli_query($koneksi, "SELECT id FROM kategori WHERE id = '$kategori'");
        if (mysqli_num_rows($queryKategoriValidasi) == 0) {
            $alertMessage = "Kategori tidak valid. Pilih kategori dari daftar yang tersedia.";
        } else {
            // Validasi file upload
            $foto = "";
            if (!empty($nama_file)) {
                if ($image_size > 5000000) { 
                    $alertMessage = "File tidak boleh lebih dari 5MB.";
                } elseif (!in_array($imageFileType, ['jpg', 'png', 'jpeg'])) {
                    $alertMessage = "File harus bertipe JPG, PNG, atau JPEG.";
                } else {
                    // Buat direktori jika belum ada
                    if (!file_exists($target_dir)) {
                        mkdir($target_dir, 0777, true);
                    }

                    // Pindahkan file ke folder tujuan
                    if (move_uploaded_file($_FILES['foto']['tmp_name'], $target_file)) {
                        $foto = $random_name . "." . $imageFileType;
                    } else {
                        $alertMessage = "Terjadi kesalahan saat mengunggah file.";
                    }
                }
            }

            // Simpan data produk ke database jika tidak ada masalah
            if (!$alertMessage) {
                $queryInsertProduk = mysqli_query($koneksi, 
                    "INSERT INTO produk (nama, kategori_id, harga, ketersediaan_stok, detail, foto) 
                     VALUES ('$nama', '$kategori', '$harga', '$stok', '$detail', '$foto')"
                );

                if ($queryInsertProduk) {
                    $alertMessage = "Produk berhasil ditambahkan!";
                } else {
                    $alertMessage = "Terjadi kesalahan saat menambahkan produk.";
                }
            }
        }
    }
}

// Fungsi untuk menghasilkan string acak
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk</title>
    <link rel="stylesheet" href="../fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../css/produk.css">
</head>
<body>
    <!-- Navbar Header -->
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
    <!-- Navbar end -->
    <div class="breadcrumb">
        <a href="../php/Admin.php"><i class="fas fa-home"></i> Home</a>
        <a href="../php/produk.php"> / Produk</a>
    </div>
    <!-- header end -->

    <!-- Tambah Produk -->
    <div class="form-produk">
        <h2>Tambah Produk</h2>

        <form action="" method="POST" enctype="multipart/form-data">
            <div>
                <label for="nama">Nama</label>
                <input type="text" id="nama" name="nama" class="form-control">
            </div>
            <div>
                <label for="kategori">Kategori</label>
                <select name="kategori" id="kategori" class="form-control">
                    <option value="">Pilih Satu</option>
                    <?php while ($data = mysqli_fetch_array($queryKategori)): ?>
                        <option value="<?php echo $data['id']; ?>"><?php echo $data['nama']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div>
                <label for="harga">Harga</label>
                <input type="number" class="form-control" name="harga">
            </div>
            <div>
                <label for="foto">Foto</label>
                <input type="file" name="foto" id="foto" class="form-control">
            </div>
            <div>
                <label for="detail">Detail Produk</label>
                <textarea id="detail" name="detail" cols="30" rows="10" class="form-control"></textarea>
            </div>
            <div>
                <label for="ketersediaan_stok">Stok</label>
                <select name="ketersediaan_stok" id="ketersediaan_stok" class="form-control">
                    <option value="tersedia">Tersedia</option>
                    <option value="habis">Habis</option>
                </select>
            </div>
            <div>
                <button type="submit" name="save" class="btn-primary">Save</button>
            </div>
        </form>

        <?php if (!isset($alertMessage)): ?>
            <div id="alertBox" class="alert-warning">
                <?php echo $alertMessage; ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- List Table Produk -->
    <div class="list-produk">
        <h2>List Produk</h2>
        <div class="table-produk">
            <table class="table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                   if ($jumlahProduk == 0) {
                    echo "<tr><td colspan='6'>Data Produk tidak tersedia</td></tr>";
                } else {
                    $jumlah = 1;
                    while ($data = mysqli_fetch_array($query)) {
                        echo "<tr>";
                        echo "<td>" . $jumlah . "</td>";
                        echo "<td>" . htmlspecialchars($data['nama']) . "</td>";
                        echo "<td>" . htmlspecialchars($data['nama_kategori']) . "</td>";
                        echo "<td>" . htmlspecialchars($data['harga']) . "</td>";
                        echo "<td>" . htmlspecialchars($data['ketersediaan_stok']) . "</td>";
                        echo "<td>";
                        echo "<a href='produk-detail.php?p=" . urlencode($data['id']) . "' class='btn-info'><i class='fas fa-search'></i></a>";
                        echo "</td>";
                        echo "</tr>";
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
