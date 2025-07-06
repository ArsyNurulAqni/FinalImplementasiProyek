<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['pesanan_id'])) {
  echo "<script>alert('Tidak ada pesanan yang diproses.'); window.location='produk.php';</script>";
  exit;
}

$pesanan_id = $_SESSION['pesanan_id'];
$query = mysqli_query($conn, "SELECT * FROM pesanan WHERE id = $pesanan_id");
$pesanan = mysqli_fetch_assoc($query);

if (!$pesanan) {
  echo "<script>alert('Pesanan tidak ditemukan.'); window.location='produk.php';</script>";
  exit;
}
$nama = htmlspecialchars($pesanan['nama_produk']);
$jumlah = $pesanan['jumlah'];
$total = number_format($pesanan['total'], 0, ',', '.');
$pajak = number_format($pesanan['pajak'], 0, ',', '.');
$total_bayar = number_format($pesanan['total_bayar'], 0, ',', '.');
$alamat = htmlspecialchars($pesanan['alamat']);

$pesan_wa = urlencode("Halo Admin, saya sudah melakukan pembayaran. Berikut rincian pesanan saya:\n\n"
  . "📦 Produk: $nama\n"
  . "🧮 Jumlah: $jumlah pcs\n"
  . "💰 Total: Rp $total\n"
  . "🧾 Pajak: Rp $pajak\n"
  . "💳 Total Bayar: Rp $total_bayar\n"
  . "📍 Alamat: $alamat\n\n"
  . "Mohon konfirmasi. Terima kasih 🙏");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pembayaran - Thrifinity</title>
  <link rel="stylesheet" href="css/pesan.css">
  <style>
    .btn-lihat {
      display: inline-block;
      padding: 10px 20px;
      margin-top: 20px;
      background-color: hotpink;
      color: white;
      border: none;
      border-radius: 6px;
      text-decoration: none;
      text-align: center;
    }
    .btn-lihat:hover {
      background-color: deeppink;
    }
  </style>
</head>
<body>
<main class="pesan-container">
  <div class="card">
    <h2>Instruksi Pembayaran</h2>
    <p>Silakan transfer ke rekening berikut:</p>
    <ul>
      <li><strong>Bank:</strong> BRI</li>
      <li><strong>No. Rekening:</strong> 490001051428532</li>
      <li><strong>Atas Nama:</strong> Thrifinity Store</li>
      <li><strong>Total:</strong> Rp <?= number_format($pesanan['total_bayar'], 0, ',', '.') ?></li>
    </ul>
    <a class="btn-lihat" href="https://wa.me/6282192665449?text=<?= $pesan_wa ?>" target="_blank">
  Kirim via WhatsApp
</a><br>

<a class="btn-lihat" href="pesanan_saya.php">Lihat Pesanan Saya</a>

</main>
</body>
</html>
