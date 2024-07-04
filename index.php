<?php
include 'templates/header.php';
include 'db.php';

// Fungsi untuk mencari barang berdasarkan kode atau nama barang
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['search'])) {
  // Menggunakan metode GET untuk mengambil value dari param search
  $search = $_GET['search'];
  // menyeleksi berdasarkan kode barang atau nama barang untuk mencocokkan string
  $sql = "SELECT * FROM barang WHERE kode_barang LIKE '%$search%' OR nama_barang LIKE '%$search%'";
  // Hasil query disimpan di var result
  $result = $conn->query($sql);
} else {
  // Tampilkan semua barang jika tidak ada pencarian
  $sql = "SELECT * FROM barang";
  $result = $conn->query($sql);
}
?>

<main>
  <h2>Home</h2>

  <!-- Form pencarian barang -->
  <form method="GET" action="" style="margin-bottom: 20px;">
    <label for="search">Cari Barang:</label>
    <input type="text" id="search" name="search" required>
    <input type="submit" value="Cari">
  </form>

  <h2>Daftar Barang</h2>

  <?php if ($result->num_rows > 0) { ?>
    <table>
      <thead>
        <tr>
          <th>Kode Barang</th>
          <th>Nama Barang</th>
          <th>Jumlah</th>
          <th>Deskripsi</th>
          <th>Harga</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = $result->fetch_assoc()) { ?>
          <tr>
            <td><?php echo $row['kode_barang']; ?></td>
            <td><?php echo $row['nama_barang']; ?></td>
            <td><?php echo $row['jumlah_barang']; ?></td>
            <td><?php echo $row['deskripsi']; ?></td>
            <td><?php echo $row['harga_barang']; ?></td>
            <td>
              <a class="btn-edit" href="edit.php?id=<?php echo $row['id']; ?>">Edit</a>
              <a class="btn-hapus" href="delete.php?id=<?php echo $row['id']; ?>">Hapus</a>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  <?php } else {
    echo "<p>Barang tidak ditemukan.</p>";
  } ?>
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
  input[type=submit] {
    padding: 8px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
  }

  table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
  }

  th,
  td {
    border: 1px solid #ccc;
    padding: 10px;
    text-align: left;
  }

  th {
    background-color: #f2f2f2;
  }

  td a {
    text-decoration: none;
    padding: 5px 10px;
    background-color: #4CAF50;
    color: white;
    border-radius: 4px;
  }

  td a:hover {
    background-color: #45a049;
  }

  .btn-edit {
    background-color: #2c78ad;
  }

  .btn-hapus {
    background-color: red;
  }
</style>