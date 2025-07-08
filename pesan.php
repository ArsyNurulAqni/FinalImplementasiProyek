<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['id'])) {
  echo "<script>alert('Silakan login terlebih dahulu.'); window.location='login.php';</script>";
  exit;
}

if (!isset($_GET['id'])) {
  echo "<script>alert('Produk tidak ditemukan.'); window.location='produk.php';</script>";
  exit;
}

$id_produk = intval($_GET['id']);
$query = mysqli_query($conn, "SELECT * FROM produk WHERE id = $id_produk");
$produk = mysqli_fetch_assoc($query);

if (!$produk) {
  echo "<script>alert('Produk tidak ditemukan di database.'); window.location='produk.php';</script>";
  exit;
}

$user_id = $_SESSION['id'];
$nama_produk = $produk['nama'];
$harga_satuan = $produk['harga'];
$gambar_produk = $produk['gambar'];
$jumlah = 1;
$total = $harga_satuan * $jumlah;
$pajak = $total * 0.10;
$total_bayar = $total + $pajak;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
  $query = "INSERT INTO pesanan (user_id, alamat, nama_produk, harga, jumlah, total, pajak, total_bayar)
            VALUES ('$user_id', '$alamat', '$nama_produk', '$harga_satuan', '$jumlah', '$total', '$pajak', '$total_bayar')";
  if (mysqli_query($conn, $query)) {
    $_SESSION['pesanan_id'] = mysqli_insert_id($conn);
    header("Location: pembayaran.php");
    exit;
  } else {
    echo "<script>alert('Gagal menyimpan pesanan');</script>";
  }
}
?>

<!-- HTML PESANAN -->
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Pesan - Thrifinity</title>
  <link rel="stylesheet" href="css/pesan.css" />
</head>
<body>
<header class="header">
  <div class="logo">
    <img src="gambar/image 13.png" alt="Logo Thrifinity">
    <h2 class="judul">Thrifinity</h2>
  </div>
  <nav class="navbar">
    <a href="beranda.php">Home</a>
    <a href="produk.php" class="active">Produk</a>
    <div class="icons">
     
      <a href="profil.php"><span>👤</span></a>
    </div>
  </nav>
</header>

<main class="pesan-container">
  <div class="card">
    <div class="card-header">
      <a href="produk.php" class="btn-pesan">← Kembali</a>
    </div>

    <form method="POST">
      <div class="alamat">
        <h3>Alamat Anda</h3>
        <textarea name="alamat" required placeholder="Masukkan alamat lengkap..."></textarea>
      </div>

      <div class="produk">
        <img src="gambar/<?= htmlspecialchars($gambar_produk) ?>" alt="<?= htmlspecialchars($nama_produk) ?>">
        <div class="produk-info">
          <strong><?= htmlspecialchars($nama_produk) ?></strong>
          <p>Rp. <?= number_format($harga_satuan, 0, ',', '.') ?></p>
        </div>
        <div class="qty"><?= $jumlah ?>x</div>
      </div>

      <div class="rincian">
        <h3>Rincian Pembayaran</h3>
        <div class="row"><span>Total Pesanan</span><span>Rp. <?= number_format($total, 0, ',', '.') ?></span></div>
        <div class="row"><span>Pajak (10%)</span><span>Rp. <?= number_format($pajak, 0, ',', '.') ?></span></div>
        <div class="row"><strong>Total Bayar</strong><strong>Rp. <?= number_format($total_bayar, 0, ',', '.') ?></strong></div>
      </div>

      <div class="btn-bayar">
        <button type="submit">Bayar</button>
      </div>
    </form>
  </div>
</main>
</body>

</html>
