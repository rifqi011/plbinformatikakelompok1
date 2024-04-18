<?php
@session_start();

include '../../koneksi.php';

if (isset($_POST['simpan'])) {
    $namabarang       = $_POST['nama'];
    $kategori         = $_POST['kategori'];
    $hargabeli        = $_POST['hargabeli'];
    $hargajual        = $_POST['hargajual'];
    $suplier          = $_POST['suplier'];
    $satuan           = $_POST['satuan'];
    $foto             = $_POST['foto'];
    $keterangan       = $_POST['keterangan'];

    $sql = "INSERT INTO barang SET 
        nama           = '$namabarang',
        kategori       = '$kategori',
        hargabeli      = '$hargabeli',
        hargajual      = '$hargajual',
        suplier        = '$suplier',
        foto           = '$foto',
        keterangan     = '$keterangan'";

    $query = mysqli_query($connect, $sql);
}
    if ($query) {
        header('Location: ../../admin.php');
        $_SESSION['sukses'] = "Barang berhasil ditambahkan";
    }

