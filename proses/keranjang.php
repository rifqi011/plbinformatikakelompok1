<?php

@session_start();

include('../koneksi.php');

date_default_timezone_set('Asia/Jakarta');
$tanggal    = date('Y-m-d');
$jam        = date('H:i:s');

// cek apakah tombol daftar sudah diklik atau blum?
if (isset($_POST['tambahkeranjang'])) {
    $jumlah     = $_POST['jumlah'];
    $idbarang   = $_POST['idbarang'];

    // Periksa apakah idbarang sudah ada dalam tabel keranjang
    $cek_barang = mysqli_query($connect, "SELECT * FROM keranjang WHERE idbarang = '$idbarang'");
    if (mysqli_num_rows($cek_barang) > 0) {
        // Jika sudah ada, update jumlah barang
        $row = mysqli_fetch_assoc($cek_barang);
        $jumlah_baru = $row['jumlah'] + $jumlah;
        $update_query = "UPDATE keranjang SET jumlah = '$jumlah_baru' WHERE idbarang = '$idbarang'";
        $query = mysqli_query($connect, $update_query);

        if ($query) {
            // Redirect ke bagian keranjang jika berhasil mengupdate jumlah barang
            header('Location: ../index.php');
            $_SESSION['sukses'] = "Pesan Terkirim !";
        } else {
            echo "Gagal mengupdate jumlah barang di keranjang.";
        }
    } else {
        // Jika belum ada, tambahkan barang baru ke keranjang
        $sql        = "INSERT INTO keranjang SET 
            jumlah      = '$jumlah',
            idbarang    = '$idbarang',
            jam         = '$jam',
            tanggal     = '$tanggal'";

        $query = mysqli_query($connect, $sql);

        // Jika query berhasil dieksekusi
        if ($query) {
            // Langsung redirect ke bagian keranjang
            header('Location: ../index.php');
            $_SESSION['sukses'] = "Berhasil menambahkan barang ke keranjang.";
        } else {
            $_SESSION['gagal'] = "Gagal menambahkan barang ke keranjang.";
        }
    }
} else {
    die("Akses dilarang...");
}