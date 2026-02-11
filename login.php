<?php
include("koneksi.php");
session_start();

$msg = '';

if (isset($_POST['login'])) {
 $email = $_POST['email'];
$password = $_POST['password'];

 $sql = "SELECT * FROM users WHERE email = ?";
 $stmt = mysqli_prepare($koneksi, $sql);

 mysqli_stmt_bind_param($stmt, "s", $email);

 mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

 if (mysqli_num_rows($result) > 0) {
 $data = mysqli_fetch_assoc($result);

if (password_verify($password, $data['password'])) {
$_SESSION['nama'] = $data['nama'];
$_SESSION['tipe_user'] = $data['tipe_user'];

if ($data['tipe_user'] == 'Admin') {
header("Location: admin.php");
exit();
} else {
header("Location: user.php");
 exit();
}
} else {
  $msg = "Password Salah!";
} } else {
 $msg = "Email Tidak Ditemukan!";
}
 
 mysqli_stmt_close($stmt);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <div class="bungkus">
    <form action="#" method="post">
      <h1>Login</h1>

      <p class="msg"><?php echo $msg; ?></p>

      <div class="input-box">
        <input type="text" name="email" id="email" placeholder="Masukkan Email" required>
        <i class='bx bxs-envelope'></i>
      </div>

      <div class="input-box">
        <input type="password" name="password" id="password" placeholder="Masukkan Password" required>
        <i class='bx bxs-lock-alt'></i>
      </div>

      <button type="submit" name="login" class="registrasi">Login</button>


      <div class="lgnlink">
        <p>Belum Mempunyai Akun? 
          <a href="registrasi.php">Registrasi Sekarang!</a>
        </p>
      </div>
    </form>
  </div>

</body>
</html>
