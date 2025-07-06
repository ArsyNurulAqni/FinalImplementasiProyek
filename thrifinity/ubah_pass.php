<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Ubah Kata Sandi</title>
  <link rel="stylesheet" href="css/profil.css" />
</head>
<body>
<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['id'])) {
  echo "<script>alert('Silakan login terlebih dahulu.'); window.location='login.php';</script>";
  exit;
}

$id = $_SESSION['id'];

// Tangani submit form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $old = $_POST['old'];
  $new = $_POST['new'];
  $confirm = $_POST['confirm'];

  $query = "SELECT password FROM users WHERE id = $id";
  $result = mysqli_query($conn, $query);
  $user = mysqli_fetch_assoc($result);

  if (!password_verify($old, $user['password'])) {
    echo "<script>alert('Kata sandi lama salah!');</script>";
  } elseif ($new !== $confirm) {
    echo "<script>alert('Konfirmasi kata sandi tidak cocok!');</script>";
  } else {
    $newHashed = password_hash($new, PASSWORD_DEFAULT);
    $update = "UPDATE users SET password = '$newHashed' WHERE id = $id";
    if (mysqli_query($conn, $update)) {
      echo "<script>alert('Kata sandi berhasil diubah!'); window.location='profil.php';</script>";
    } else {
      echo "<script>alert('Gagal mengubah kata sandi.');</script>";
    }
  }
}
?>

<header class="header">
  <div class="logo">
    <img src="gambar/image 13.png" alt="Logo Thrifinity" />
    <h2 class="judul">Thrifinity</h2>
  </div>
  <nav class="navbar">
    <a href="beranda.php">Home</a>
    <a href="produk.php">Produk</a>
    <div class="icons">
      <span>🔍</span>
      <a href="profil.php"><span>👤</span></a>
    </div>
  </nav>
</header>

<main class="profil-container">
  <div class="password-box">
    <h2>Ubah Kata Sandi</h2>
    <form method="POST">
      <div class="form-group">
        <label for="old">Kata Sandi Lama</label>
        <input type="password" id="old" name="old" required>
      </div>

      <div class="form-group">
        <label for="new">Kata Sandi Baru</label>
        <input type="password" id="new" name="new" required>
      </div>

      <div class="form-group">
        <label for="confirm">Konfirmasi Kata Sandi Baru</label>
        <input type="password" id="confirm" name="confirm" required>
      </div>

      <button type="submit" class="btn-yes">Simpan</button>
      <button type="button" class="btn-cancel" onclick="window.location.href='profil.php'">Kembali</button>
    </form>
  </div>
</main>
</body>
</html>
