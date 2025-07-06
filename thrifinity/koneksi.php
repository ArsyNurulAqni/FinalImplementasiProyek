<?php
$host = "localhost";
$user = "root";
$pass = "";

// 1. Koneksi ke MySQL tanpa database dulu
$conn = mysqli_connect($host, $user, $pass);
if (!$conn) {
  die("Koneksi gagal: " . mysqli_connect_error());
}

// 2. Buat database jika belum ada
$sql_db = "CREATE DATABASE IF NOT EXISTS thrifinity_db";
if (!mysqli_query($conn, $sql_db)) {
  die("Gagal membuat database: " . mysqli_error($conn));
}

// 3. Pilih database yang sudah dibuat
mysqli_select_db($conn, "thrifinity_db");


// 4. Buat tabel produk jika belum ada
$sql_produk = "CREATE TABLE IF NOT EXISTS produk (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(100),
  harga INT,
  gambar VARCHAR(100)
)";
if (!mysqli_query($conn, $sql_produk)) {
  die("Gagal membuat tabel produk: " . mysqli_error($conn));
}

// 5. Isi data awal produk jika kosong
$cek_produk = mysqli_query($conn, "SELECT COUNT(*) as jumlah FROM produk");
$row_produk = mysqli_fetch_assoc($cek_produk);
if ($row_produk['jumlah'] == 0) {
  mysqli_query($conn, "
    INSERT INTO produk (nama, harga, gambar) VALUES
    ('Produk 1', 35000, 'Screenshot 2025-06-15 084621.png'),
    ('Produk 2', 35000, 'Screenshot 2025-06-15 084621.png'),
    ('Produk 3', 35000, 'Screenshot 2025-06-15 084621.png'),
    ('Produk 4', 35000, 'Screenshot 2025-06-15 084621.png'),
    ('Produk 5', 35000, 'Screenshot 2025-06-15 095557.png'),
    ('Produk 6', 35000, 'Screenshot 2025-06-15 095557.png'),
    ('Produk 7', 35000, 'Screenshot 2025-06-15 095557.png'),
    ('Produk 8', 35000, 'Screenshot 2025-06-15 095557.png')
  ");
}


// 6. Buat tabel users jika belum ada
$sql_users = "CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  nohp VARCHAR(20),
  role ENUM('admin','user') NOT NULL DEFAULT 'user'
)";
if (!mysqli_query($conn, $sql_users)) {
  die("Gagal membuat tabel users: " . mysqli_error($conn));
}

// 7. Tambah admin default jika belum ada
$check_admin = mysqli_query($conn, "SELECT * FROM users WHERE email = 'admin@gmail.com'");
if (mysqli_num_rows($check_admin) == 0) {
  $hashed = password_hash("admin123", PASSWORD_DEFAULT);
  mysqli_query($conn, "INSERT INTO users (nama, email, password, role) VALUES ('Admin', 'admin@gmail.com', '$hashed', 'admin')");
}
?>
