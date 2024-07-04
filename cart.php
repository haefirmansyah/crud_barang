<?php
session_start();

if (isset($_GET['action']) && $_GET['action'] == 'remove') {
  $index = $_GET['index'];
  unset($_SESSION['cart'][$index]);
  $_SESSION['cart'] = array_values($_SESSION['cart']);
}

header('Location: transaction.php');
exit;
?>