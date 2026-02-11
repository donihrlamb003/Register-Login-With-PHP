
<?php
include("koneksi.php");
session_start();

$msg = '';

if (isset($_POST['registrasi'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $tipe_user = $_POST['tipe_user'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    if ($password != $cpassword) {
        $msg = "Password Dan Konfirmasi Password Tidak Sama!";
    } 
    else if (empty($tipe_user)) {
          $msg = "Silakan Pilih Tipe User (Admin/User)!";
    }
    else {
        
        

        $sql_cek = "SELECT email FROM users WHERE email = ?";
        $stmt_cek = mysqli_prepare($koneksi, $sql_cek);
        mysqli_stmt_bind_param($stmt_cek, "s", $email);
        mysqli_stmt_execute($stmt_cek);
        mysqli_stmt_store_result($stmt_cek);

        if (mysqli_stmt_num_rows($stmt_cek) > 0) {
            $msg = "Email Sudah Digunakan!";
            mysqli_stmt_close($stmt_cek);
        } else {
            
            mysqli_stmt_close($stmt_cek); 
            
            
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            
            
            $sql_insert = "INSERT INTO users (nama, email, tipe_user, password) VALUES (?, ?, ?, ?)";
            $stmt_insert = mysqli_prepare($koneksi, $sql_insert);
            
            mysqli_stmt_bind_param($stmt_insert, "ssss", $nama, $email, $tipe_user, $hashed_password);

            if (mysqli_stmt_execute($stmt_insert)) {
                $msg = "Registrasi Berhasil!.";
            } else {
                $msg = "Gagal Menyimpan Data.";
            }
            
            mysqli_stmt_close($stmt_insert);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Halaman Admin</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg2">

    <div class="card-container">
        <div class="card">
            <h1>Selamat Datang,  <?php echo htmlspecialchars($_SESSION['nama']); ?>!</h1>
            <p>Ini adalah konten khusus untuk admin.</p>
        </div>
        
        <div class="logout-link">
            <a href="login.php">Logout</a>
        </div>
    </div>

</body>
</html>
