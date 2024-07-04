<?php
include 'templates/header.php';
include 'db.php';

$id = $_GET['id'];

//  mengambil data header transaksi dari tabel transaksi_header berdasarkan ID yang diambil 
$sql = "SELECT * FROM transaksi_header WHERE id=$id";
$result = $conn->query($sql);
$header = $result->fetch_assoc();

// mengambil data detail transaksi dari tabel transaksi_detail berdasarkan ID 
$sql = "SELECT * FROM transaksi_detail WHERE transaksi_header_id=$id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cetak Struk</title>
  <style>
    body {
      font-family: Arial, sans-serif;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
    }

    table,
    th,
    td {
      border: 1px solid black;
      padding: 8px;
      text-align: left;
    }

    th {
      background-color: #f2f2f2;
    }

    button {
      padding: 10px;
      background-color: #4CAF50;
      color: white;
      border: none;
      cursor: pointer;
    }

    button:hover {
      background-color: #45a049;
    }
  </style>
</head>

<body>

  <h2>Struk Pembelian</h2>
  <p>Tanggal: <?php echo $header['tanggal_transaksi']; ?></p>
  <p>Total Harga: <?php echo $header['total_harga']; ?></p>

  <table>
    <tr>
      <th>Kode Barang</th>
      <th>Nama Barang</th>
      <th>Jumlah</th>
      <th>Harga</th>
      <th>Total</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()) { ?>
      <tr>
        <td><?php echo $row['kode_barang']; ?></td>
        <td><?php echo $row['nama_barang']; ?></td>
        <td><?php echo $row['jumlah_barang']; ?></td>
        <td><?php echo $row['harga_barang']; ?></td>
        <td><?php echo $row['total_harga']; ?></td>
      </tr>
    <?php } ?>
  </table>

  <button onclick="printStruk()">Cetak Struk</button>

  <script>
    function printStruk() {
      var printContents = document.body.innerHTML;
      var originalContents = document.body.innerHTML;

      document.body.innerHTML = printContents;

      window.print();

      document.body.innerHTML = originalContents;
    }
  </script>

</body>

</html>

<?php include 'templates/footer.php'; ?>