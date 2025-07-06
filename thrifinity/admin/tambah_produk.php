<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Produk</title>
  <link rel="stylesheet" href="../css/tambah_produk.css">
</head>
<body>
  <?php include '../koneksi.php'; ?>

  <div class="form-container">
    <h2>Tambah Produk Baru</h2>
    <form method="POST" enctype="multipart/form-data">
      <label>Nama Produk</label>
      <input type="text" name="nama" required>

      <label>Harga</label>
      <input type="number" name="harga" required>

      <label>Gambar</label>
      <input type="file" name="gambar" accept="image/*" required>

      <button type="submit">Simpan</button>
    </form>
    <br>
    <a href="admin/beranda_admin.php">← Kembali ke Beranda Admin</a>
  </div>

  <?php
  if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nama = htmlspecialchars($_POST['nama']);
    $harga = (int)$_POST['harga'];
    $gambar = $_FILES['gambar']['name'];
    $tmp = $_FILES['gambar']['tmp_name'];

    move_uploaded_file($tmp, "../gambar/" . $gambar);

    $query = "INSERT INTO produk (nama, harga, gambar) VALUES ('$nama', $harga, '$gambar')";
    if (mysqli_query($conn, $query)) {
      echo "<script>alert('Produk berhasil ditambahkan!'); window.location='beranda_admin.php';</script>";
    } else {
      echo "<script>alert('Gagal menambahkan produk!');</script>";
    }
  }
  ?>
</body>
</html>
