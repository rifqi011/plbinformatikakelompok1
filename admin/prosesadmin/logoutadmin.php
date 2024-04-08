<?php
session_start();
unset($_SESSION['admin']);
$_SESSION['sukses'] = "Terima Kasih Atas Kunjungan anda";
header('Location: ../../login.php');