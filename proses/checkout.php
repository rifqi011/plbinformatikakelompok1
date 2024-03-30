<?php
session_start();
include '../koneksi.php';
$email =  $_SESSION['user'];

date_default_timezone_set('Asia/Jakarta');
$tanggal    = date('Y-m-d');
$jam        = date('H:i:s');

$sql = mysqli_query($connect, "SELECT * FROM pengunjung WHERE email = '$email'");
$row = mysqli_fetch_array($sql);
$idpengunjung = $row['id'];

if (isset($_POST['beli'])) {
    $query = mysqli_query($connect, "INSERT INTO penjualan SET
        idpengunjung = '$idpengunjung',
        nomortransaksi  = '',
        jam          = '$jam',
        tanggal      = '$tanggal',
        alamat       = ''
    ");
    $idtransaksi = mysqli_insert_id($connect);
}



foreach ($_SESSION['cart'] as $cart => $val) {
    $jumlah = 'id' . $val['idbarang'];
    $jml = $_POST[$jumlah];

    
    $sql = "INSERT INTO keranjang SET 
    idtransaksi = $idtransaksi,
    idbarang = $val[idbarang],
    jumlah = $jml,
    harga =  $val[hargajual]
    ";

    $query = mysqli_query($connect, $sql);
}

unset($_SESSION['cart']);
header('Location: ../index.php');
$_SESSION['sukses'] = "Pembelian berhasil. silahkan pantau di menu pembelian";
