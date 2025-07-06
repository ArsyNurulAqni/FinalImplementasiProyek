<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Beranda - Thrifinity</title>
  <link rel="stylesheet" href="css/beranda.css" />
</head>
<body>

  <!-- HEADER -->
  <header class="header">
    <div class="logo">
      <img src="gambar/image 13.png" alt="Logo Thrifinity" />
      <h2 class="judul">Thrifinity</h2>
    </div>
    <nav class="navbar">
      <a href="beranda.php" class="active">Home</a>
      <a href="produk.php">Produk</a>
      <div class="icons">
      
        <a href="profil.php"><span>👤</span></a>
      </div>
    </nav>
  </header>

  <!-- HERO SECTION -->
  <section class="hero">
    <div class="hero-text">
      <p>Halo, selamat datang</p>
      <h1>Temukan<br><strong>Baju Threndy Anda</strong></h1>
      <p>Nikmati baju Thrifinity kami dan rasakan threndynya</p>
      <a href="produk.php" class="btn-hero">Pesan Sekarang</a>
    </div>
    <div class="hero-image">
      <img src="gambar/Screenshot 2025-06-15 090028.png" alt="Baju Threndy" />
    </div>
  </section>

  <section class="flash-sale">
    <h2 style="text-align: center;">PRODUK</h2>
    <div class="product-grid">
      <?php
      $query = "SELECT * FROM produk";
      $result = mysqli_query($conn, $query);
      while ($row = mysqli_fetch_assoc($result)) {
        $gambar = 'gambar/' . htmlspecialchars($row['gambar']);
        // Cek jika file gambar tidak ada
        if (!file_exists($gambar) || empty($row['gambar'])) {
          $gambar = 'gambar/default.png'; // fallback jika gambar tidak ada
        }

        echo '
        <div class="product-card">
          <img src="../gambar/' . htmlspecialchars($row['gambar']) . '" alt="' . htmlspecialchars($row['nama']) . '" />
          <h3 class="product-name">' . htmlspecialchars($row['nama']) . '</h3>
          <p>Rp. ' . number_format($row['harga'], 0, ',', '.') . '</p>
          <a href="pesan.php?id=' . $row['id'] . '" class="btn-pesan">Pesan</a>
         

        </div>';
      }
      ?>
    </div>
  </section>

</body>
</html>
