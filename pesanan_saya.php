<?php
session_start();
include 'koneksi.php';

// Cek login
if (!isset($_SESSION['id'])) {
  echo "<script>alert('Silakan login terlebih dahulu.'); window.location='login.php';</script>";
  exit;
}

$user_id = $_SESSION['id'];
$query = "SELECT * FROM pesanan WHERE user_id = $user_id ORDER BY tanggal DESC";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pesanan Saya - Thrifinity</title>
  <link rel="stylesheet" href="css/pesanan_saya.css">
  
</head>
<body>

<!-- HEADER -->
<header class="header">
  <div class="logo">
    <img src="gambar/image 13.png" alt="Logo Thrifinity">
    <h2 class="judul">Thrifinity</h2>
  </div>
  <nav class="navbar">
    <a href="beranda.php">Home</a>
    <a href="produk.php">Produk</a>
    <div class="icons">
     
      <a href="profil.php"><span>👤</span></a>
    </div>
  </nav>
</header>

<main>
  <h2>Pesanan Saya</h2>

  <?php if (mysqli_num_rows($result) > 0): ?>
    <?php while ($row = mysqli_fetch_assoc($result)): ?>
      <?php
      ?>
      <div class="order-card">
        <div class="order-details">
          <h3><?= htmlspecialchars($row['nama_produk']) ?></h3>
          <p><strong>Jumlah:</strong> <?= $row['jumlah'] ?> item</p>
          <p><strong>Total Bayar:</strong> Rp. <?= number_format($row['total_bayar'], 0, ',', '.') ?></p>
          <p><strong>Alamat:</strong> <?= htmlspecialchars($row['alamat']) ?></p>
          <p><strong>Tanggal:</strong> <?= date('d M Y, H:i', strtotime($row['tanggal'])) ?></p>
        </div>
      </div>
    <?php endwhile; ?>
  <?php else: ?>
    <p style="text-align:center;">Belum ada pesanan.</p>
  <?php endif; ?>
</main>

</body>

</html>
