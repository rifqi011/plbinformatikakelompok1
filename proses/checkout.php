<?php
session_start();
include '../koneksi.php';
$email =  $_SESSION['user'];

date_default_timezone_set('Asia/Jakarta');
$tanggal    = date('Y-m-d');
$jam        = date('H:i:s');

$sql = mysqli_query($connect,"SELECT * FROM pengunjung WHERE email = '$email'");
$row = mysqli_fetch_array($sql);
$idpengunjung = $row['id'];

echo $idpengunjung;