<?php
include 'templates/header.php';
include 'db.php';
session_start();

if (!isset($_SESSION['cart'])) {
  $_SESSION['cart'] = [];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $kode_barang = $_POST['kode_barang'];
  $jumlah_barang = $_POST['jumlah_barang'];

  // Query untuk mengambil informasi barang dari database
  $sql = "SELECT * FROM barang WHERE kode_barang='$kode_barang'";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();

  if ($row) {
    $stok_barang = $row['jumlah_barang'];

    // Validasi jumlah barang tidak boleh melebihi stok yang tersedia
    if ($jumlah_barang <= $stok_barang) {
      $item = [
        'kode_barang' => $row['kode_barang'],
        'nama_barang' => $row['nama_barang'],
        'harga_barang' => $row['harga_barang'],
        'jumlah_barang' => $jumlah_barang,
        'total_harga' => $row['harga_barang'] * $jumlah_barang
      ];
      $_SESSION['cart'][] = $item;
    } else {
      echo "<p class='error'>Jumlah barang melebihi stok yang tersedia. Stok tersedia: $stok_barang</p>";
    }
  } else {
    echo "<p class='error'>Barang tidak ditemukan dengan kode: $kode_barang</p>";
  }
}
?>

<main>
  <h2>Tambah Barang ke Keranjang</h2>

  <form method="post" action="">
    <label for="kode_barang">Kode Barang:</label>
    <input type="text" id="kode_barang" name="kode_barang" required><br><br>

    <label for="jumlah_barang">Jumlah Barang:</label>
    <input type="number" id="jumlah_barang" name="jumlah_barang" required><br><br>

    <input type="submit" value="Tambah ke Keranjang">
  </form>

  <!--  menampilkan form untuk menambahkan barang ke keranjang belanja. 
    mengisi kode_barang dan jumlah_barang, kemudian mengirim form untuk menambahkan barang ke keranjang. -->
  <h2>Keranjang Belanja</h2>
  <?php
  if (!empty($_SESSION['cart'])) {
    echo "<table>";
    echo "<tr><th>Kode Barang</th><th>Nama Barang</th><th>Jumlah</th><th>Harga</th><th>Total</th><th>Aksi</th></tr>";
    foreach ($_SESSION['cart'] as $index => $item) {
      echo "<tr>";
      echo "<td>" . $item['kode_barang'] . "</td>";
      echo "<td>" . $item['nama_barang'] . "</td>";
      echo "<td>" . $item['jumlah_barang'] . "</td>";
      echo "<td>Rp " . number_format($item['harga_barang'], 0, ',', '.') . "</td>";
      echo "<td>Rp " . number_format($item['total_harga'], 0, ',', '.') . "</td>";
      echo "<td><a href='cart.php?action=remove&index=$index'>Hapus</a></td>";
      echo "</tr>";
    }
    echo "</table>";
    echo "<a class='button' href='checkout.php'>Checkout</a>";
  } else {
    echo "<p>Keranjang kosong.</p>";
  }
  ?>
</main>

<?php include 'templates/footer.php'; ?>

<style>
  main {
    max-width: 800px;
    margin: 20px auto;
    padding: 20px;
    background-color: #f9f9f9;
    border: 1px solid #ccc;
    border-radius: 5px;
  }

  h2 {
    margin-top: 0;
    font-size: 24px;
    border-bottom: 1px solid #ccc;
    padding-bottom: 10px;
  }

  form {
    margin-bottom: 20px;
  }

  label {
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
  }

  input[type=text],
  input[type=number] {
    width: calc(100% - 16px);
    padding: 8px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
    box-sizing: border-box;
  }

  input[type=submit],
  .button {
    background-color: #4CAF50;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
    text-decoration: none;
    display: inline-block;
    margin-top: 10px;
  }

  input[type=submit]:hover,
  .button:hover {
    background-color: #45a049;
  }

  table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
  }

  table,
  th,
  td {
    border: 1px solid #ccc;
  }

  th,
  td {
    padding: 10px;
    text-align: center;
  }

  th {
    background-color: #f2f2f2;
  }

  .error {
    color: red;
    font-weight: bold;
  }
</style>