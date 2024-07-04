<?php
include 'templates/header.php';
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Mengambil data dari form 
  $kode_barang = $_POST['kode_barang'];
  $nama_barang = $_POST['nama_barang'];
  $jumlah_barang = $_POST['jumlah_barang'];
  $deskripsi = $_POST['deskripsi'];
  $harga_barang = $_POST['harga_barang'];

  // Menambahkan data yang diambil dari form ke dalam database
  $sql = "INSERT INTO barang (kode_barang, nama_barang, jumlah_barang, deskripsi, harga_barang)
            VALUES ('$kode_barang', '$nama_barang', $jumlah_barang, '$deskripsi', $harga_barang)";

  if ($conn->query($sql) === TRUE) {
    echo "Barang berhasil ditambahkan";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}
?>
<!-- Form Add Barang -->
<form method="post" action="">
  <label for="kode_barang">Kode Barang:</label>
  <input type="text" id="kode_barang" name="kode_barang" required><br>
  <label for="nama_barang">Nama Barang:</label>
  <input type="text" id="nama_barang" name="nama_barang" required><br>
  <label for="jumlah_barang">Jumlah Barang:</label>
  <input type="number" id="jumlah_barang" name="jumlah_barang" required><br>
  <label for="deskripsi">Deskripsi:</label>
  <textarea id="deskripsi" name="deskripsi"></textarea><br>
  <label for="harga_barang">Harga Barang:</label>
  <input type="number" id="harga_barang" name="harga_barang" required><br>
  <input type="submit" value="Tambah">
</form>

<?php include 'templates/footer.php'; ?>

<style>
  h2 {
    margin-top: 20px;
  }

  form {
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    background-color: #f9f9f9;
    margin-bottom: 40px;
  }

  label {
    display: block;
    margin-bottom: 10px;
    font-weight: bold;
  }

  input[type=text],
  input[type=number],
  textarea {
    width: calc(100% - 20px);
    padding: 8px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    font-size: 16px;
  }

  input[type=submit] {
    margin-top: 10px;
    background-color: black;
    color: white;
    padding: 8px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 14px;
  }

  input[type=submit]:hover {
    background-color: green;
    color: white;
  }
</style>