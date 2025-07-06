<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Daftar - Thrifinity</title>
  <link rel="stylesheet" href="css/login.css" />
</head>
<body>
  <?php
  include 'koneksi.php';

  // Buat tabel users jika belum ada
  $tabel = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    nohp VARCHAR(20),
    password VARCHAR(255)
  )";

  mysqli_query($conn, $tabel);

  // Proses form pendaftaran
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $nohp = mysqli_real_escape_string($conn, $_POST['nohp']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    if ($nama && $email && $nohp && $password) {
      $query = "INSERT INTO users (nama, email, nohp, password) 
                VALUES ('$nama', '$email', '$nohp', '$password')";
      if (mysqli_query($conn, $query)) {
        echo "<script>alert('Pendaftaran berhasil! Silakan login.'); window.location='login.php';</script>";
        exit;
      } else {
        echo "<script>alert('Gagal mendaftar: " . mysqli_error($conn) . "');</script>";
      }
    } else {
      echo "<script>alert('Harap isi semua field!');</script>";
    }
  }
  ?>

  <div class="form-container">
    <h2>Daftar Akun Thrifinity</h2>
    <form method="POST" action="daftar.php">
      <label for="nama">Nama Lengkap</label>
      <input type="text" id="nama" name="nama" required />

      <label for="email">Email</label>
      <input type="email" id="email" name="email" required />

      <label for="nohp">Nomor HP</label>
      <input type="tel" id="nohp" name="nohp" required />

      <label for="password">Kata Sandi</label>
      <input type="password" id="password" name="password" required />

      <button type="submit" class="btn-masuk">Daftar</button>
    </form>
    <p>Sudah punya akun? <a href="login.php">Login di sini</a></p>
  </div>
</body>
</html>
