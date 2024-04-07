<?php
// Pastikan file koneksi.php sudah di-include di sini
/* include('../koneksi.php');

// Periksa apakah data yang diperlukan telah diterima
if (isset($_POST['id'])) {
    // Ambil data dari $_POST
    $id = $_POST['id'];
    $jumlahBaru = $_POST['jumlahBaru'];

    // Update nilai jumlah di database
    $update_query = "UPDATE keranjang SET jumlah = $jumlahBaru+1 WHERE id = '$id'";
    $result = mysqli_query($connect, $update_query);

    // Periksa apakah query berhasil dieksekusi
    if ($result) {
        header('Location: ../index.php#cart');
    } else {
        echo "Gagal mengubah jumlah barang.";
    }
} else {
    echo "Data yang diperlukan tidak lengkap.";
} */
?>