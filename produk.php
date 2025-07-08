<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Produk - Thrifinity</title>
  <link rel="stylesheet" href="css/produk.css" />
  <style>
    .menu-toggle {
      display: none;
      flex-direction: column;
      cursor: pointer;
    }
    .menu-toggle span {
      height: 3px;
      width: 25px;
      background: #fff;
      margin: 4px 0;
      transition: 0.4s;
    }
    @media (max-width: 768px) {
      .navbar {
        display: none;
        flex-direction: column;
        width: 100%;
        background-color: #e5c9c9;
      }
      .navbar.show {
        display: flex;
      }
      .menu-toggle {
        display: flex;
      }
    }
  </style>
  <script>
    function toggleMenu() {
      const navbar = document.querySelector('.navbar');
      navbar.classList.toggle('show');
    }
  </script>
</head>
<body>

<header class="header">
  <div class="logo">
    <img src="gambar/image 13.png" alt="Logo Thrifinity">
    <h2>Thrifinity</h2>
  </div>
  <div class="menu-toggle" onclick="toggleMenu()">
    <span></span>
    <span></span>
    <span></span>
  </div>
  <nav class="navbar">
    <a href="beranda.php">Home</a>
    <a href="produk.php" class="active">Produk</a>
    <div class="icons"><a href="profil.php"><span>👤</span></a></div>
  </nav>
</header>

<section class="flash-sale">
  <h2>PRODUK</h2>
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
        <img src="' . $gambar . '" alt="' . htmlspecialchars($row['nama']) . '">
        <h3 class="product-name">' . htmlspecialchars($row['nama']) . '</h3>
        <p>Rp. ' . number_format($row['harga'], 0, ',', '.') . '</p>
        <a href="pesan.php?id=' . $row['id'] . '" class="btn-pesan">Pesan</a>
      </div>';
    }
    ?>
  </div>
</section>

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

</body>
</html>