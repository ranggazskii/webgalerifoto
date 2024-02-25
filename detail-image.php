<?php
    error_reporting(0);
    include 'db.php';
	$kontak = mysqli_query($conn, "SELECT admin_telp, admin_email, admin_address FROM tb_admin WHERE admin_id = 2");
	$a = mysqli_fetch_object($kontak);
	
	$produk = mysqli_query($conn, "SELECT * FROM tb_image WHERE image_id = '".$_GET['id']."' ");
	$p = mysqli_fetch_object($produk);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>WEB Galeri Foto</title>
<link rel="stylesheet" type="text/css" href="stylee.css">
</head>

<body>
    <!-- header -->
    <header>
        <div class="container">
        <h1><a href="index.php">WEB GALERI FOTO</a></h1>
        <ul>
            <li><a href="galeri.php">Galeri</a></li>
           <li><a href="registrasi.php">Registrasi</a></li>
           <li><a href="login.php">Login</a></li>
        </ul>
        </div>
    </header>
    
    <!-- search -->
    <div class="search">
        <div class="container">
            <form action="galeri.php">
                <input type="text" name="search" placeholder="Cari Foto" value="<?php echo $_GET['search'] ?>" />
                <input type="hidden" name="kat" value="<?php echo $_GET['kat'] ?>" />
                <input type="submit" name="cari" value="Cari Foto" />
            </form>
        </div>
    </div>
    
    <!-- product detail -->
    <div class="section">
        <div class="container">
             <h3>Detail Foto</h3>
            <div class="box">
                <div class="col-2">
                   <img src="foto/<?php echo $p->image ?>" width="100%" /> 
                </div>
                <div class="col-2">
                <?
include 'db.php'; // Gantilah ini dengan file koneksi database Anda

// Fungsi untuk memberikan like
function likePost($userId, $postId) {
    global $conn;

    $query = "INSERT INTO tb_likes (user_id, post_id) VALUES ($userId, $postId)";
    $result = mysqli_query($conn, $query);

    if ($result) {
        return true;
    } else {
        return false;
    }
}

// Fungsi untuk memberikan komentar
function addComment($userId, $postId, $commentText) {
    global $conn;

    $commentText = mysqli_real_escape_string($conn, $commentText);

    $query = "INSERT INTO tb_comments (user_id, post_id, comment_text) VALUES ($userId, $postId, '$commentText')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        return true;
    } else {
        return false;
    }
}

// Contoh penggunaan
$userId = 1; // ID pengguna yang memberikan like atau komentar
$postId = 123; // ID postingan atau gambar yang akan diberi like atau komentar

// Memberikan like
if (likePost($userId, $postId)) {
    echo "Like berhasil diberikan.";
} else {
    echo "Gagal memberikan like.";
}

// Memberikan komentar
$commentText = "Ini adalah komentar yang bagus!";
if (addComment($userId, $postId, $commentText)) {
    echo "Komentar berhasil ditambahkan.";
} else {
    echo "Gagal menambahkan komentar.";
}
?>

                <h3><?php echo $p->image_name ?><br />Kategori : <?php echo $p->category_name  ?></h3>
                   <h4>Nama User : <?php echo $p->admin_name ?><br />
                   Upload Pada Tanggal : <?php echo $p->date_created  ?></h4>
                   <p>Deskripsi :<br />
                        <?php echo $p->image_description ?>
                   </p>
                   
                </div>
            </div>
        </div>
    </div>
    
    <!-- footer -->
    <footer>
        <div class="container">
            <small>Copyright &copy; 2024 - Web Galeri Foto.</small>
        </div>
    </footer>
</body>
</html>