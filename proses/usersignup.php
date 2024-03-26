<?php
@session_start();

include '../koneksi.php';

// if (isset($_POST['signup'])) {
//     $nama       = $_POST['nama'];
//     $kelas      = $_POST['kelas'];
//     $email      = $_POST['nama'];
//     $password   = $_POST['password'];

//     $sql = "INSERT INTO pengunjung SET 
//         nama        = '$nama',
//         kelas       = '$kelas',
//         email       = '$email',
//         password    = '$password'";

//     $query = mysqli_query($connect, $sql);
// }

function signup($data)
{
    @session_start();

    global $connect;

    $nama        = $data['nama'];
    $kelas       = $data['kelas'];
    $email       = $data['email'];
    $password    = mysqli_real_escape_string($connect, $data['password']);
    $password2   = mysqli_real_escape_string($connect, $data['password2']);

    // Cek Username
    $result = mysqli_query($connect, "SELECT nama FROM pengunjung WHERE nama = '$nama'");

    if (mysqli_fetch_assoc($result)) {
        header('Location: ../signup.php');
        $_SESSION['gagal'] = "Username Sudah terdaftar";
        return false;
    }

    // Konfirmasi Password
    if ($password != $password2) {
        header('Location: ../signup.php');
        $_SESSION['gagal'] = "Konfirmasi Password Tidak Sesuai";
        return false;
    }

    // Enkripsi Password 
    $password = password_hash($password, PASSWORD_DEFAULT);

    // Insert Data
    mysqli_query($connect, "INSERT INTO pengunjung SET 
        nama        = '$nama',
        kelas       = '$kelas',
        email       = '$email',
        foto        = 'defaultfoto.png',
        password    = '$password'");

    return mysqli_affected_rows($connect);
}

if (isset($_POST['signup'])) {
    if (signup($_POST) > 0) {
        header('Location: ../login.php');
        $_SESSION['sukses'] = "Pendaftaran berhasil";
    } else {
        echo mysqli_error($connect);
    }
}
