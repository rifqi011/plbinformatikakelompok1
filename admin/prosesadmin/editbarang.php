<?php
@session_start();

include '../../koneksi.php';

if (isset($_POST['simpan'])) {
    $id               = $_POST['id'];
    $namabarang       = $_POST['nama'];
    $kategori         = $_POST['kategori'];
    $hargabeli        = $_POST['hargabeli'];
    $hargajual        = $_POST['hargajual'];
    $suplier          = $_POST['suplier'];
    $keterangan       = $_POST['keterangan'];

    $sql = "UPDATE barang SET 
        nama           = '$namabarang',
        kategori       = '$kategori',
        hargabeli      = '$hargabeli',
        hargajual      = '$hargajual',
        suplier        = '$suplier',
        keterangan     = '$keterangan' WHERE id = '$id'";

    $query = mysqli_query($connect, $sql);
}
    if ($query) {
        header('Location: ../../admin.php');
        $_SESSION['sukses'] = "Barang berhasil diubah";
    } else {
        $_SESSION['gagal'] = "Gagal mengubah barang";
        header('Location: ../../admin.php');
    }

