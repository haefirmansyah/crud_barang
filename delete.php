<?php
include 'db.php';

// mendapatkan id barang dengan parameter GET
$id = $_GET['id'];

// menghapus data barang dari tabel barang berdasarkan ID yang diambil dari URL
$sql = "DELETE FROM barang WHERE id=$id";

// Jika berhasil pesan akan ditampilkan dan data yang dipilih akan hilang
if ($conn->query($sql) === TRUE) {
  echo "Barang berhasil dihapus";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

header("Location: index.php");
exit;
?>