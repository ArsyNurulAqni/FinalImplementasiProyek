<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['id'])) {
  echo "<script>alert('Silakan login terlebih dahulu.'); window.location='login.php';</script>";
  exit;
}

$id = $_SESSION['id'];
$query = "SELECT * FROM users WHERE id = $id";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Profil - Thrifinity</title>
  <link rel="stylesheet" href="css/profil.css" />
 
</head>
<body>

<header class="header">
  <div class="logo">
    <img src="gambar/image 13.png" alt="Logo Thrifinity" />
    <h2 class="judul">Thrifinity</h2>
  </div>

  <!-- Menu Toggle hanya muncul di HP -->
  <div class="menu-toggle" onclick="toggleMenu()">
    <span></span>
    <span></span>
    <span></span>
  </div>

  <nav class="navbar" id="navbar">
    <a href="beranda.php">Home</a>
    <a href="produk.php">Produk</a>
    <div class="icons">
      <a href="profil.php"><span>👤</span></a>
    </div>
  </nav>
</header>



  <!-- PROFIL -->
  <main class="profil-container">
    <div class="user-icon">👤</div>
    <br>
    <h3 style="text-align: center; margin-top: -10px;"><?php echo htmlspecialchars($user['nama']); ?></h3>

    <div class="menu-box">
      <div class="menu-item" onclick="window.location.href='data_pribadi.php'">
        <span>👤</span>
        <p>Data Pribadi</p>
        <span class="arrow">></span>
      </div>

      <div class="menu-item" onclick="window.location.href='pesanan_saya.php'">
        <span>📦</span>
        <p>Pesanan Saya</p>
        <span class="arrow">></span>
      </div>

      <div class="menu-item" onclick="window.location.href='ubah_pass.php'">
        <span>🔒</span>
        <p>Kata Sandi & Keamanan</p>
        <span class="arrow">></span>
      </div>

      <div class="menu-item" onclick="showConfirmBox()">
        <span>🗑️</span>
        <p class="hapus-akun">Hapus Akun</p>
        <span class="arrow">></span>
      </div>

      <div class="menu-item" onclick="window.location.href='logout.php'">
        <span>↩️</span>
        <p class="hapus-akun">Keluar</p>
        <span class="arrow">></span>
      </div>
    </div>
  </main>

  <!-- KONFIRMASI HAPUS -->
  <div class="confirm-box" id="confirmBox">
    <div class="confirm-content">
      <p>Apakah yakin ingin menghapus akun?</p>
      <div class="confirm-buttons">
        <a href="hapus_akun.php" class="btn-yes">Yes</a>
        <button class="btn-cancell" onclick="hideConfirmBox()">Cancel</button>
      </div>
    </div>
  </div>

  <!-- SCRIPT -->
  <script>
    function toggleMenu() {
      const navbar = document.getElementById("navbar");
      navbar.classList.toggle("show");
    }

    function showConfirmBox() {
      document.getElementById("confirmBox").style.display = "flex";
    }

    function hideConfirmBox() {
      document.getElementById("confirmBox").style.display = "none";
    }
  </script>

</body>
</html>
