<?php
session_start();
include "koneksi.php";

$id = $_GET['p']; 

$query = mysqli_query($koneksi, 
"SELECT a.*, b.nama AS nama_kategori 
     FROM produk a 
     JOIN kategori b ON a.kategori_id = b.id 
     WHERE a.id='$id'"
);
$data = mysqli_fetch_array($query);
$queryKategori = mysqli_query($koneksi, "SELECT * FROM kategori WHERE id!='$data[kategori_id]'");

if (isset($_POST['update'])) {
    // Ambil data dari form
    $produk = htmlspecialchars($_POST['produk']);
    $kategori_id = $_POST['kategori'];
    $harga = $_POST['harga'];
    $detail = htmlspecialchars($_POST['detail']);
    $ketersediaan_stok = $_POST['ketersediaan_stok'];
    $alertMessage = "";

    // Validasi data wajib
    if (empty($produk) || empty($kategori_id) || empty($harga)) {
        $alertMessage = '<div class="alert-warning">Nama produk, kategori, dan harga tidak boleh kosong.</div>';
    } else {
        // Upload foto jika ada
        if ($_FILES['foto']['name']) {
            $foto = $_FILES['foto']['name'];
            $tmp_name = $_FILES['foto']['tmp_name'];
            $path = "../imageinput/" . $foto;

            // Simpan file ke folder
            if (move_uploaded_file($tmp_name, $path)) {
                $fotoQuery = "foto='$foto',";
            } else {
                $alertMessage = '<div class="alert-danger">Gagal mengupload foto!</div>';
                exit;
            }
        } else {
            $fotoQuery = ""; // Gunakan foto lama jika tidak ada file baru
        }

        // Update data produk di database
        $updateQuery = "UPDATE produk SET 
            nama='$produk',
            kategori_id='$kategori_id',
            harga='$harga',
            detail='$detail',
            $fotoQuery
            ketersediaan_stok='$ketersediaan_stok'
            WHERE id='$id'";

        $update = mysqli_query($koneksi, $updateQuery);

        if ($update) {
            $successMessage = '<div class="alert-primary">Produk berhasil diperbarui!</div>';
            echo '<meta http-equiv="refresh" content="3; url=../php/produk.php"/>';
        } else {
            $alertMessage = '<div class="alert-warning">Error: ' . mysqli_error($koneksi) . '</div>';
        }
    }
}
 if(isset($_POST['deleteBtn'])){
    $queryDelete = mysqli_query($koneksi, "DELETE FROM produk WHERE id='$id'");

    if($queryDelete){
        $successMessage = '<div class="alert-primary">Produk berhasil dihapus</div>';
            echo '<meta http-equiv="refresh" content="3; url=../php/produk.php"/>';
    }
 }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk Detail</title>
    <link rel="stylesheet" href="../fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../css/produk-detail.css"> 
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
    <!-- Navbar End -->

    <div class="container">
    <h2>Detail Produk</h2>

    <div class="column-input">
        <form action="" method="post" enctype="multipart/form-data">
            <div>
                <label for="produk">Produk</label>
                <input type="text" name="produk" id="produk" class="form-control" value="<?php echo $data['nama']; ?>"> 
            </div>
            <div>
                <label for="kategori">Kategori</label>
                <select name="kategori" id="kategori" class="form-control">
                    <option value="<?php echo $data['kategori_id']?>"><?php echo $data['nama_kategori'];?></option>
                    <?php while ($dataKategori = mysqli_fetch_array($queryKategori)): ?>
                        <option value="<?php echo $dataKategori['id']; ?>"><?php echo $dataKategori['nama']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div>
                <label for="harga">Harga</label>
                <input type="number" class="form-control" value="<?php echo $data['harga']; ?>" name="harga">
            </div>
            <div>
                <label for="currentFoto">Foto Produk Sekarang</label>
                <img src="../imageinput/<?php echo $data['foto']?>" alt="" width="200px">
            </div>
            <div>
                <label for="foto">Foto</label>
                <input type="file" name="foto" id="foto" class="form-control">
            </div>
            <div>
                <label for="detail">Detail Produk</label>
                <textarea id="detail" name="detail" cols="30" rows="10" class="form-control"><?php echo $data['detail']; ?></textarea>
            </div>
            <div>
                <label for="ketersediaan_stok">Stok</label>
                <select name="ketersediaan_stok" id="ketersediaan_stok" class="form-control">
                <option value="<?php echo $data['ketersediaan_stok']; ?>">
                    <?php echo ucfirst($data['ketersediaan_stok']); ?>
                </option>
                <?php
                    if ($data['ketersediaan_stok'] == 'tersedia') {
                        echo '<option value="habis">Habis</option>';
                    } else {
                        echo '<option value="tersedia">Tersedia</option>';
                    }
                ?>
                </select>
            </div>
            <div>
                <button type="submit" name="update" class="btn-primary">Update</button>
                <button type="submit" class="btn-danger" name="deleteBtn">Delete</button>   
            </div>
        </form>
        <?php
            if (isset($alertMessage)) {
                echo $alertMessage;
            }
            if (isset($successMessage)) {
                echo $successMessage;
            }
        ?>
    </div>        
</div>
</body>
</html>