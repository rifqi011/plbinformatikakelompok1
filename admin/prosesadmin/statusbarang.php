<?php
@session_start();

include '../../koneksi.php';

$id = $_GET['id'];
$status = $_GET['status'];

$sql = "UPDATE barang SET status = '$status' WHERE id = '$id'";

$query = mysqli_query($connect, $sql);

if ($query) {
    header('Location: ../../admin.php');
    $_SESSION['sukses'] = "Barang berhasil diubah";
}
