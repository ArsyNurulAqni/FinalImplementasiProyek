<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Data Pribadi - Thrifinity</title>
  <link rel="stylesheet" href="css/profil.css" />
  <link rel="stylesheet" href="css/data_pribadi.css" />
</head>
<body>
<?php
session_start();
include 'koneksi.php';

// Cek apakah user sudah login
if (!isset($_SESSION['id'])) {
  echo "<script>alert('Anda harus login terlebih dahulu!'); window.location='login.php';</script>";
  exit;
}

$id = $_SESSION['id'];
$query = "SELECT * FROM users WHERE id = $id";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);
?>

<div class="data-container">
  <h2>Data Pribadi</h2>

  <div class="data-item">
    <span class="label">Nama:</span> <span><?= htmlspecialchars($data['nama']) ?></span>
  </div>
  <div class="data-item">
    <span class="label">Email:</span> <span><?= htmlspecialchars($data['email']) ?></span>
  </div>
  <div class="data-item">
    <span class="label">Nomor HP:</span> <span><?= htmlspecialchars($data['nohp']) ?></span>
  </div>

  <a href="profil.php" class="btn-kembali">Kembali</a>
</div>
</body>
</html>
