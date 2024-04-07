<?php
@session_start();

include '../../koneksi.php';

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
        header('Location: ../../../profile.php');
        $_SESSION['sukses'] = "Data Berhasil di Ubah";
    } else {
        header('Location: ../../../edit.php');
        $_SESSION['gagal'] = "Data Gagal di Ubah";
    }
}
