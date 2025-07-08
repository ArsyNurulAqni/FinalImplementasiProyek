<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Produk</title>
  <link rel="stylesheet" href="../css/edit_produk.css">
</head>
<body>
  <?php include '../koneksi.php'; ?>

  <?php
  $id = $_GET['id'];
  $result = mysqli_query($conn, "SELECT * FROM produk WHERE id = $id");
  $produk = mysqli_fetch_assoc($result);
  ?>

  <div class="form-container">
    <h2>Ubah Produk</h2>
    <form method="POST" enctype="multipart/form-data">
      <label>Nama Produk</label>
      <input type="text" name="nama" value="<?= $produk['nama'] ?>" required>

      <label>Harga</label>
      <input type="number" name="harga" value="<?= $produk['harga'] ?>" required>

      <label>Ganti Gambar (Opsional)</label>
      <input type="file" name="gambar" accept="image/*">

      <button type="submit">Simpan Perubahan</button>
    </form>
    <br>
    <a href="beranda_admin.php">← Kembali ke Beranda Admin</a>
  </div>

  <?php
  if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nama = htmlspecialchars($_POST['nama']);
    $harga = (int)$_POST['harga'];
    
    if (!empty($_FILES['gambar']['name'])) {
      $gambar = $_FILES['gambar']['name'];
      $tmp = $_FILES['gambar']['tmp_name'];
      move_uploaded_file($tmp, "../gambar/" . $gambar);
      $query = "UPDATE produk SET nama='$nama', harga=$harga, gambar='$gambar' WHERE id=$id";
    } else {
      $query = "UPDATE produk SET nama='$nama', harga=$harga WHERE id=$id";
    }

    if (mysqli_query($conn, $query)) {
      echo "<script>alert('Produk berhasil diubah!'); window.location='beranda_admin.php';</script>";
    } else {
      echo "<script>alert('Gagal mengubah produk!');</script>";
    }
  }
  ?>
</body>
</html>
