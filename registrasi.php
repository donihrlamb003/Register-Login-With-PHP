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
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registrasi</title>
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <div class="bungkus">
    <form action="#" method="post">
      <h1>Registrasi</h1>

      <p class="msg"><p class="msg"><?php echo $msg; ?></p></p>

      <div class="input-box">
        <input type="text" name="nama" id="nama" placeholder="Masukkan Nama" required>
        <i class='bx bxs-user'></i>
      </div>

      <div class="input-box">
        <input type="text" name="email" id="email" placeholder="Masukkan Email" required>
        <i class='bx bxs-envelope'></i>
      </div>

      <div class="input-box">
        <select name="tipe_user" id="tipe_user" required>
          <option value="">Pilih Role</option>
          <option value="Admin">Admin</option>
          <option value="User">User</option>
        </select>
      </div>

      <div class="input-box">
        <input type="password" name="password" id="password" placeholder="Masukkan Password" required>
        <i class='bx bxs-lock-open-alt'></i>
      </div>

      <div class="input-box">
        <input type="password" name="cpassword" id="cpassword" placeholder="Konfirmasi Password" required>
        <i class='bx bxs-lock-alt'></i>
      </div>
      
      <button type="submit" name="registrasi" class="registrasi">Registrasi</button>


      <div class="lgnlink">
        <p>Sudah Mempunyai Akun? 
          <a href="login.php">Login Sekarang!</a>
        </p>
      </div>
    </form>
  </div>

</body>
</html>
