<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login - Thrifinity</title>
  <link rel="stylesheet" href="css/login.css" />
</head>
<body>
<?php
session_start();
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $password = $_POST['password'];

  $query = "SELECT * FROM users WHERE email = '$email'";
  $result = mysqli_query($conn, $query);

  if ($result && mysqli_num_rows($result) === 1) {
    $user = mysqli_fetch_assoc($result);

    if (password_verify($password, $user['password'])) {
      $_SESSION['nama'] = $user['nama'];
      $_SESSION['id'] = $user['id'];
      $_SESSION['role'] = $user['role'];

      if ($user['role'] === 'admin') {
        header("Location: ../admin/beranda_admin.php");
      } else {
        header("Location: beranda.php");
      }
      exit;
    } else {
      echo "<script>alert('Kata sandi salah!');</script>";
    }
  } else {
    echo "<script>alert('Email tidak ditemukan!');</script>";
  }
}
?>

<div class="form-container">
  <!-- ✅ Logo Thrifinity -->
  <div style="text-align: center; margin-bottom: 20px;">
    <img src="gambar/image 13.png" alt="Logo Thrifinity" style="width: 100px; height: auto;">
  </div>

  <h2>Welcome Thrifinity</h2>
  <form method="POST" action="login.php">
    <label for="email">Email</label>
    <input type="email" id="email" name="email" required />

    <label for="password">Kata Sandi</label>
    <input type="password" id="password" name="password" required />

    <button type="submit" class="btn-masuk">Masuk</button>
  </form>
  <p>Belum punya akun? <a href="daftar.php">Daftar di sini</a></p>
</div>
</body>
</html>
