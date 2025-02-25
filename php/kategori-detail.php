<?php
session_start();
include "koneksi.php";

$id = $_GET['p']; // Perbaiki tanda kutip yang hilang dan tambahkan tanda titik koma

$query = mysqli_query($koneksi, "SELECT * FROM kategori WHERE id='$id'"); // Tambahkan tanda kurung tutup dan titik koma
$data = mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kategori</title>
    <link rel="stylesheet" href="../fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../css/kategori-detail.css"> 
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
        <h2>Detail Kategori</h2>

        <div class="column-input">
            <form action="" method="post">
                <div>
                    <label for="kategori">Kategori</label>
                    <input type="text" name="kategori" id="kategori" class="form-control" value="<?php echo $data['nama']; ?>"> 
                </div>

                <div class="button-edit">
                    <button type="submit" class="btn-primary" name="editBtn">Edit</button>  
                    <button type="submit" class="btn-danger" name="deleteBtn">Delete</button>    
                </div>
            </form>

            <?php
                if (isset($_POST['editBtn'])) {
                    $kategori = htmlspecialchars($_POST['kategori']);

                    if ($data['nama'] == $kategori) {
                        echo '<meta http-equiv="refresh" content="0; url=../php/kategori.php"/>';
                    } else {
                        $query = mysqli_query($koneksi, "SELECT * FROM kategori WHERE nama='$kategori'");
                        $jumlahData = mysqli_num_rows($query);
                        
                        if ($jumlahData > 0) {
                            ?>
                            <div class="alert-warning" role="alert">
                                Kategori Sudah Ada
                            </div>
                            <?php
                        }
                        else { 
                            $querySimpan = mysqli_query($koneksi, "UPDATE kategori SET  nama='$kategori' WHERE id='$id'");
                            if($querySimpan){
                                ?>
                                <div class="alert-primary" role="alert">
                                    Kategori Berhasil Diupdate
                                </div>
                                <?php 
                            }
                            else {
                                echo mysqli_error($koneksi);
                            }
                        }

                    }
                }
                if(isset($_POST['deleteBtn'])){
                    $queryCheck = mysqli_query($koneksi, "SELECT * FROM produk WHERE kategori_id = '$id'");
                    $dataCount = mysqli_num_rows($queryCheck);
                    
                    if($dataCount > 0 ){
                        ?>
                            <div class="alert-warning" role="alert">
                                Kategori tidak bisa dihapus karena sudah digunakan
                            </div>
                       <?php
                       die();
                    }

                    $queryDelete = mysqli_query($koneksi, "DELETE FROM kategori WHERE  id='$id'");

                    if($queryDelete){
                        ?>
                       <div class="alert-primary" role="alert">
                            Kategori Berhasil Dihapus
                       </div>
                       <?php 
                            }
                            else {
                                echo mysqli_error($koneksi);
                            }
                    }
                
            ?>
        </div>
    </div>
</body>
</html>
