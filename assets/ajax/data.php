<?php
include '../../koneksi.php';
$keyword = $_GET['keyword'];

// Periksa apakah keyword kosong
if (empty($keyword)) {
    // Jika kosong, tampilkan pesan "Cari Sesuatu"
    echo "<h1>Cari Sesuatu</h1>";
} else {
    // Jika tidak kosong, lakukan pencarian
    $query = "SELECT * FROM barang WHERE nama LIKE '%$keyword%' OR keterangan LIKE '%$keyword%'";
    $data = mysqli_query($connect, $query);

    // Periksa apakah ada hasil dari query
    if (mysqli_num_rows($data) > 0) {
        // Tampilkan hasil pencarian
        while ($row = mysqli_fetch_array($data)) {
?>
            <div class="product__content flex shadow">
                <div class="product__img flex">
                    <img src="assets/img/barang/<?php echo $row['foto']; ?>" alt="">
                </div>

                <div class="produk__data">
                    <h3 class="product__name-data"><?php echo $row['nama']; ?></h3>
                    <h3 class="product__stock-data">Stok: <?php echo $row['stok']; ?></h3>
                    <h3 class="product__price-data">Harga: Rp.<?php echo number_format($row['hargajual']); ?></h3>
                    <!-- Tambahkan atribut data-target untuk menentukan modal yang akan ditampilkan -->
                    <?php
                    if($row['stok'] > 0) {
                    ?>
                    <a href="search.php?id=<?php echo $row['id']; ?>"><button class="btn btn__add btn__add-search"><i class='bx bx-cart-add'></i></button></a>
                    <?php
                    } else {
                    ?>
                    <button class="btn btn__add btn__add-search"><i class='bx bx-cart-add'></i></button>
                    <?php
                    }
                    ?>
                </div>
            </div>
<?php
        }
    } else {
        // Tampilkan pesan jika tidak ada hasil yang sesuai dengan pencarian
        echo "<h1>Barang tidak ditemukan</h1>";
    }
}
?>
