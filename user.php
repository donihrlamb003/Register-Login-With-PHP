<?php
session_start();

if (!isset($_SESSION['tipe_user']) || $_SESSION['tipe_user'] != 'User') {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Halaman User</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg2">

    <div class="card-container">
        <div class="card">
            <h1>Selamat Datang,  <?php echo htmlspecialchars($_SESSION['nama']); ?>!</h1>
            <p>Ini adalah konten khusus untuk user.</p>
        </div>
        
        <div class="logout-link">
            <a href="login.php">Logout</a>
        </div>
    </div>

</body>
</html>
