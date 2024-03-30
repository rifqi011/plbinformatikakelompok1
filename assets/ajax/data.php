<?php
include '../../koneksi.php';
$keyword = $_GET['keyword'];
if ($keyword) {
    $query = "SELECT * FROM barang WHERE nama LIKE '%$keyword%' OR keterangan LIKE '%$keyword%'";
    $data = mysqli_query($connect, $query);
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
                <button class="btn btn__add btn__add-search" id="add-search" data-target="modal-pesan-<?php echo $brg['id']; ?>"><i class='bx bx-cart-add'></i></button>
            </div>
        </div>
<?php
    }
} else {
    echo "<h1>Cari Sesuatu</h1>";
}
?>