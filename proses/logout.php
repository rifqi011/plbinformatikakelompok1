<?php
session_start();
unset($_SESSION['user']);
$_SESSION['sukses'] = "Terima Kasih Atas Kunjungan anda";
header('Location: ../index.php');