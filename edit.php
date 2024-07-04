<?php
include 'templates/header.php';
include 'db.php';

// Mengambil mengambil ID barang 
$id = $_GET['id'];


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $kode_barang = $_POST['kode_barang'];
  $nama_barang = $_POST['nama_barang'];
  $jumlah_barang = $_POST['jumlah_barang'];
  $deskripsi = $_POST['deskripsi'];
  $harga_barang = $_POST['harga_barang'];

  $sql = "UPDATE barang SET kode_barang='$kode_barang', nama_barang='$nama_barang', jumlah_barang=$jumlah_barang, deskripsi='$deskripsi', harga_barang=$harga_barang WHERE id=$id";

  if ($conn->query($sql) === TRUE) {
    echo "Barang berhasil diupdate";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

//  mengambil data barang berdasarkan ID barang yang diambil dari URL
$sql = "SELECT * FROM barang WHERE id=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<form method="post" action="">
  <label for="kode_barang">Kode Barang:</label>
  <input type="text" id="kode_barang" name="kode_barang" value="<?php echo $row['kode_barang']; ?>" required><br>
  <label for="nama_barang">Nama Barang:</label>
  <input type="text" id="nama_barang" name="nama_barang" value="<?php echo $row['nama_barang']; ?>" required><br>
  <label for="jumlah_barang">Jumlah Barang:</label>
  <input type="number" id="jumlah_barang" name="jumlah_barang" value="<?php echo $row['jumlah_barang']; ?>"
    required><br>
  <label for="deskripsi">Deskripsi:</label>
  <textarea id="deskripsi" name="deskripsi"><?php echo $row['deskripsi']; ?></textarea><br>
  <label for="harga_barang">Harga Barang:</label>
  <input type="number" id="harga_barang" name="harga_barang" value="<?php echo $row['harga_barang']; ?>" required><br>
  <input type="submit" value="Update">
</form>

<?php include 'templates/footer.php'; ?>