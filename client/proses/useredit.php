<?php
@session_start();

include '../koneksi.php';

// if (isset($_POST['simpan'])) {
//     $nama       = $_POST['nama'];
//     $kelas      = $_POST['kelas'];
//     // $email      = $_POST['nama'];
//     // $password   = $_POST['password'];

//     $sql = "UPDATE pengunjung SET 
//         nama        = '$nama',
//         kelas       = '$kelas'";
//         /* email       = '$email',
//         password    = '$password'"; */

//     $query = mysqli_query($connect, $sql);
// }
// if($query) {
//     $_SESSION['sukses'] = "Data Berhasil di Ubah";
//     header('Location: ../profile.php');

// }

function simpan($data)
{
    @session_start();

    global $connect;

    $nama        = $data['nama'];
    $kelas       = $data['kelas'];
    $email       = $_POST['email'];
    $alamat      = $_POST['alamat'];

    // Insert Data
    mysqli_query($connect, "UPDATE pengunjung SET 
        nama        = '$nama',
        kelas       = '$kelas',
        foto        = 'defaultfoto.png' ,
        alamat      = '$alamat' 
        WHERE email = '$email'");

    return mysqli_affected_rows($connect);
}

if (isset($_POST['simpan'])) {
    if (simpan($_POST)) {
        header('Location: ../profile.php');
        $_SESSION['sukses'] = "Data Berhasil di Ubah";
    } else {
        header('Location: ../edit.php');
        $_SESSION['gagal'] = "Data Gagal di Ubah";
    }
}
