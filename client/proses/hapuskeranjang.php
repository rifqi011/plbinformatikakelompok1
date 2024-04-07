<?php
session_start();
include '../../koneksi.php';

$id = $_GET['id'];

unset($_SESSION['cart'][$id]);

header('Location: ../../index.php');
$_SESSION['sukses'] = "Barang berhasil dihapus dari keranjang";