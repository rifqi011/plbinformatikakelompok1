<?php
@session_start();

include '../../koneksi.php';
global $connect;

// Cek tombol sudah ditekan atau belum
if (isset($_POST['login'])) {
    $email      = $_POST['email'];
    $password   = $_POST['password'];

    $result = mysqli_query($connect, "SELECT * FROM pengunjung WHERE email = '$email'");

    // Cek email
    if (mysqli_num_rows($result) === 1) {
        // Cek password
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            header("Location: ../../index.php");
            $_SESSION['user'] = $email;
            $_SESSION['sukses'] = "Selamat Datang ".$row['nama'];
            exit;
        }
        else {
            header("Location: ../login.php");
            $_SESSION['gagal'] = "Password salah";
        }
    }
    else {
        header("Location: ../login.php");
        $_SESSION['gagal'] = "Email tidak terdaftar";
    }
}
