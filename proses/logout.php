<?php
session_start();
unset($_SESSION['user']);
$_SESSION['sukses'] = "Anda Berhasil Keluar";
header('Location: ../index.php');