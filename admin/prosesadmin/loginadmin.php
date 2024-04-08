<?php
@session_start();

include '../../koneksi.php';
global $connect;

if(isset($_POST['login'])) {
    $user      = $_POST['user'];
    $password  = $_POST['password'];

    $result = mysqli_query($connect, "SELECT * FROM adminuser WHERE user = '$user'");

    if (mysqli_num_rows($result) === 1) {
        // Cek password
        $row = mysqli_fetch_assoc($result);
        if ($password == $row['password']) {
            header("Location: ../../admin.php");
            $_SESSION['user'] = $user;
            $_SESSION['sukses'] = "Selamat Datang";
            exit;
        }
        else {
            header("Location: ../../login.php");
            $_SESSION['gagal'] = "Password salah";
        }
    }
    else {
        header("Location: ../../login.php");
        $_SESSION['gagal'] = "Email tidak terdaftar";
    }
}
?>