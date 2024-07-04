<?php
include 'templates/header.php';
include 'db.php';
session_start();

if (!empty($_SESSION['cart'])) {
  // Bagian ini memeriksa apakah keranjang belanja tidak kosong. Jika tidak kosong, 
  // Inisialisasi variabel $total_harga dengan nilai 0.
  $total_harga = 0;
  foreach ($_SESSION['cart'] as $item) {
    $total_harga += $item['total_harga'];
  }

  //  menyimpan total harga transaksi ke dalam tabel transaksi_header.
  $sql = "INSERT INTO transaksi_header (total_harga) VALUES ($total_harga)";
  if ($conn->query($sql) === TRUE) {
    $transaksi_header_id = $conn->insert_id;

    foreach ($_SESSION['cart'] as $item) {
      $kode_barang = $item['kode_barang'];
      $nama_barang = $item['nama_barang'];
      $jumlah_barang = $item['jumlah_barang'];
      $harga_barang = $item['harga_barang'];
      $total_harga_item = $item['total_harga'];

      $sql = "INSERT INTO transaksi_detail (transaksi_header_id, kode_barang, nama_barang, jumlah_barang, harga_barang, total_harga) VALUES ($transaksi_header_id, '$kode_barang', '$nama_barang', $jumlah_barang, $harga_barang, $total_harga_item)";
      if (!$conn->query($sql)) {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
    }

    echo "Transaction completed successfully";
    $_SESSION['cart'] = [];
    echo "<a href='print.php?id=$transaksi_header_id'>Cetak Struk</a>";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
} else {
  echo "Keranjang kosong.";
}

include 'templates/footer.php';
?>