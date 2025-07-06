<?php include '../koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Beranda Admin - Thrifinity</title>
  <link rel="stylesheet" href="../css/beranda.css" />
  <style>
    .btn-hapus {
      display: inline-block;
      padding: 8px 14px;
      margin-top: 8px;
      background-color: #e53935;
      color: #fff;
      text-decoration: none;
      border-radius: 8px;
      font-size: 14px;
      transition: background-color 0.3s;
    }
    .btn-hapus:hover {
      background-color: #c62828;
    }
    .btn-container {
      display: flex;
      justify-content: center;
      gap: 10px;
      margin-top: 10px;
    }
  </style>
</head>
<body>

  <!-- HEADER -->
  <header class="header">
    <div class="logo">
      <img src="../gambar/image 13.png" alt="Logo Thrifinity" />
      <h2 class="judul">Admin - Thrifinity</h2>
    </div>
    <nav class="navbar">
      <a href="admin_beranda.php" class="active">Beranda Admin</a>
      <a href="../login.php">Keluar</a>
    </nav>
  </header>

  <!-- TAMBAH PRODUK -->
  <section style="text-align:center; margin: 20px;">
    <a href="tambah_produk.php" class="btn-hero">+ Tambah Produk</a>
  </section>

  <!-- DAFTAR PRODUK -->
  <section class="produk-lain">
    <h2 style="text-align:center;">Daftar Produk</h2>
    <div class="product-grid">
      <?php
        $query = "SELECT * FROM produk";
        $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($result)) {
          echo '
            <div class="product-card shadow">
              <img src="../gambar/' . htmlspecialchars($row['gambar']) . '" alt="' . htmlspecialchars($row['nama']) . '" />
              <p>' . htmlspecialchars($row['nama']) . '</p>
              <p>Rp. ' . number_format($row['harga'], 0, ',', '.') . '</p>
              <div class="btn-container">
                <a href="edit_produk.php?id=' . $row['id'] . '" class="btn-pesan">Ubah</a>
                <a href="?hapus=' . $row['id'] . '" class="btn-hapus" onclick="return confirm(\'Yakin ingin menghapus produk ini?\')">Hapus</a>
              </div>
            </div>
          ';
        }

        // PROSES HAPUS PRODUK
        if (isset($_GET['hapus'])) {
          $id = (int)$_GET['hapus'];
          $cek = mysqli_query($conn, "SELECT * FROM produk WHERE id = $id");

          if (mysqli_num_rows($cek) > 0) {
            $data = mysqli_fetch_assoc($cek);
            if (!empty($data['gambar']) && file_exists("../gambar/" . $data['gambar'])) {
              unlink("../gambar/" . $data['gambar']);
            }
            mysqli_query($conn, "DELETE FROM produk WHERE id = $id");
            echo "<script>alert('Produk berhasil dihapus!'); window.location='beranda_admin.php';</script>";
          } else {
            echo "<script>alert('ID produk tidak ditemukan.'); window.location='beranda_admin.php';</script>";
          }
        }
      ?>
    </div>
  </section>

</body>
</html>
