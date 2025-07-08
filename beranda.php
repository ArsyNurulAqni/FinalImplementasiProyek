<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Beranda - Thrifinity</title>
  <link rel="stylesheet" href="css/berandaa.css" />
</head>
<body>

  <!-- HEADER -->
  <header class="header">
    <div class="logo">
      <img src="gambar/image 13.png" alt="Logo Thrifinity" />
      <h2>Thrifinity</h2>
    </div>
    
    <div class="menu-toggle" onclick="toggleMenu()">
      <span></span>
      <span></span>
      <span></span>
    </div>

    <nav class="navbar" id="navMenu">
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

  <!-- FLASH SALE -->
  <section class="flash-sale">
    <h2 style="text-align: center;">PRODUK</h2>
    <div class="product-grid">
      <?php
      $query = "SELECT * FROM produk";
      $result = mysqli_query($conn, $query);
      while ($row = mysqli_fetch_assoc($result)) {
        $gambar = 'gambar/' . htmlspecialchars($row['gambar']);
        if (!file_exists($gambar) || empty($row['gambar'])) {
          $gambar = 'gambar/default.png';
        }

        echo '
        <div class="product-card">
          <img src="' . $gambar . '" alt="' . htmlspecialchars($row['nama']) . '" />
          <h3 class="product-name">' . htmlspecialchars($row['nama']) . '</h3>
          <p>Rp. ' . number_format($row['harga'], 0, ',', '.') . '</p>
          <a href="pesan.php?id=' . $row['id'] . '" class="btn-pesan">Pesan</a>
        </div>';
      }
      ?>
    </div>
  </section>

  <!-- FOOTER -->
  <footer class="footer">
    <div class="footer-container">
      <div class="footer-section">
        <h3>THRIFINITY</h3>
        <p>Didirikan tahun 2025, Thrifinity menghadirkan fashion keren & percaya diri.</p>
      </div>
      <div class="footer-section">
        <h4>SOCIAL MEDIA</h4>
        <p>Gaya kekinian tanpa mahal.</p>
        <div class="social-icons">
          <a href="#"><img src="gambar/OIP (2) copy 2.jpg" alt="FB"></a>
          <a href="#"><img src="gambar/image.png" alt="IG"></a>
          <a href="#"><img src="gambar/OIP (7).jpg" alt="WA"></a>
          <a href="#"><img src="gambar/OIP (6).jpg" alt="TikTok"></a>
        </div>
      </div>
      <div class="footer-section">
        <h4>CUSTOMER SERVICE</h4>
        <p>082-192-665-449</p>
        <p>Senin - Minggu: 09.00 - 21.00</p>
      </div>
    </div>
  </footer>

  <!-- SCRIPT TO TOGGLE MENU -->
  <script>
    function toggleMenu() {
      const nav = document.getElementById("navMenu");
      nav.classList.toggle("show");
    }
  </script>
</body>
</html>
