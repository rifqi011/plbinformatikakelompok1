<?php
include '../koneksi.php';
$keyword = $_GET['keyword'];

// Lakukan pencarian
$query = "SELECT * FROM barang WHERE nama LIKE '%$keyword%' OR keterangan LIKE '%$keyword%'";
$data = mysqli_query($connect, $query);

// Periksa apakah ada hasil dari query
if (mysqli_num_rows($data) > 0) {
    // Tampilkan hasil pencarian
    while ($row = mysqli_fetch_array($data)) {
?>
        <div class="product__card">
            <div class="product__content flex shadow">
                <div class="product__img flex">
                    <img src="assets/img/barang/<?php echo $row['foto']; ?>" alt="">
                </div>

                <div class="product__data flex">
                    <h1><?php echo $row['nama']; ?></h1>
                    <p>Stok: <?php echo $row['stok']; ?></p>
                    <p>Suplier: Toko A</p>
                </div>

                <div class="product__btn flex">
                    <a class="btn btn__edit" href=""><i class="bx bx-edit-alt"></i></a>
                    <a class="btn btn__minus" href=""><i class="bx bx-minus"></i></a>
                    <div class="btn btn__info"><i class='bx bx-dots-vertical-rounded' onclick="productPopUp(<?php echo $row['id']; ?>)"></i></div>
                </div>
            </div>
        </div>
<?php
    }
} else {
    // Tampilkan pesan jika tidak ada hasil yang sesuai dengan pencarian
    echo "<h1>Barang tidak ditemukan</h1>";
}
?>