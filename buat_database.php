<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kasir_db";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
  echo "Database created successfully<br>";
} else {
  echo "Error creating database: " . $conn->error . "<br>";
}

// Select database
$conn->select_db($dbname);

// Create tables
$sql = "CREATE TABLE IF NOT EXISTS barang (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kode_barang VARCHAR(50) NOT NULL,
    nama_barang VARCHAR(100) NOT NULL,
    jumlah_barang INT NOT NULL,
    deskripsi TEXT,
    harga_barang DECIMAL(10,2) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
  echo "Table 'barang' created successfully<br>";
} else {
  echo "Error creating table: " . $conn->error . "<br>";
}

$sql = "CREATE TABLE IF NOT EXISTS transaksi_header (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tanggal_transaksi TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    total_harga DECIMAL(10,2) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
  echo "Table 'transaksi_header' created successfully<br>";
} else {
  echo "Error creating table: " . $conn->error . "<br>";
}

$sql = "CREATE TABLE IF NOT EXISTS transaksi_detail (
    id INT AUTO_INCREMENT PRIMARY KEY,
    transaksi_header_id INT NOT NULL,
    kode_barang VARCHAR(50) NOT NULL,
    nama_barang VARCHAR(100) NOT NULL,
    jumlah_barang INT NOT NULL,
    harga_barang DECIMAL(10,2) NOT NULL,
    total_harga DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (transaksi_header_id) REFERENCES transaksi_header(id)
)";

if ($conn->query($sql) === TRUE) {
  echo "Table 'transaksi_detail' created successfully<br>";
} else {
  echo "Error creating table: " . $conn->error . "<br>";
}

$conn->close();
?>