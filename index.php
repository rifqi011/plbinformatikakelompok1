<!-- Include Koneksi Database -->
<?php
@session_start();
include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko</title>
    <link rel="stylesheet" href="assets/css/swiper-bundle.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.min.css" rel="stylesheet">
</head>

<body>
    <!-- Header -->
    <header id="header" class="container">
        <div class="nav__container flex">
            <div class="logo">
                <h1>Lorem, ipsum.</h1>
            </div>

            <nav id="navbar">
                <ul class="nav__list flex">
                    <li class="nav__item">
                        <a href="#" class="nav__link flex active-link" data-section="home"><i class='bx bxs-home-alt-2'></i>Beranda</a>
                    </li>
                    <li class="nav__item">
                        <a href="#" class="nav__link flex search-link" data-section="search"><i class='bx bx-search-alt-2'></i>Cari</a>
                    </li>
                    <li class="nav__item">
                        <a href="#" class="nav__link flex" data-section="cart"><i class='bx bx-cart'></i>Keranjang</a>
                    </li>
                </ul>
            </nav>gith
            <?php
            $User = mysqli_query($connect, "SELECT * FROM pengunjung");
            $dataUser = mysqli_fetch_array($User);
            ?>

            <a href="profile.php"><img src="assets/img/<?php echo $dataUser['foto']; ?>" alt="" class="profile__img"></a>
        </div>
    </header>
    <!-- Header end -->

    <!-- Main Page Mobile -->
    <main id="mobile">
        <!-- Home Section -->
        <section id="home" class="section container flex active-section">
            <!-- Home Banner -->
            <div class="home__banner swiper homeSwiper">
                <div class="swiper-wrapper home__wrapper">
                    <!-- Ambil Data Banner -->
                    <?php
                    $banner = mysqli_query($connect, "SELECT * FROM banner");
                    while ($bnr = mysqli_fetch_array($banner)) {
                    ?>
                        <div class="swiper-slide home__slide">
                            <a href="">
                                <!-- Banner IMG -->
                                <img src="assets/img/banner/<?php echo $bnr['foto']; ?>.png" alt="">
                            </a>
                        </div>
                    <?php
                    }
                    ?>
                    <!-- Ambil Data Banner end -->
                </div>
            </div>

            <!-- Card Slide -->
            <div class="card__section">
                <!-- Pisahkan Kategori -->
                <?php
                $kategori = mysqli_query($connect, "SELECT kategori FROM barang GROUP BY kategori");
                while ($kat = mysqli_fetch_array($kategori)) {
                ?>
                    <h2 class="section__title"><?php echo $kat['kategori'] ?></h2>

                    <div class="card__swiper swiper cardSwiper" id="card">
                        <div class="swiper-wrapper flex">
                            <!-- Ambil Data Barang -->
                            <?php
                            $barang = mysqli_query($connect, "SELECT * FROM barang WHERE kategori = '$kat[kategori]'");
                            while ($brg = mysqli_fetch_array($barang)) {
                            ?>
                                <!-- Card Slide -->
                                <div class="swiper-slide card__slide flex shadow">
                                    <div class="card__slide__img">
                                        <img src="assets/img/barang/<?php echo $brg['foto']; ?>" alt="card">
                                    </div>
                                    <div class="card__slide__content flex">
                                        <h3 class="product__name"><?php echo $brg['nama']; ?></h3>
                                        <h3 class="product__price">Harga: Rp.<?php echo number_format($brg['hargajual']); ?></h3>
                                        <h3 class="product__stock">Stok: <?php echo $brg['stok']; ?></h3>
                                        <button class="btn btn__add" data-target="modal-pesan-<?php echo $brg['id']; ?>"><i class='bx bx-cart-add'></i></button>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                            <!-- Ambil Data Barang end -->
                        </div>
                    </div>

                    <!-- Modal Keranjang -->
                    <?php
                    $barang = mysqli_query($connect, "SELECT * FROM barang WHERE kategori = '$kat[kategori]'");
                    while ($brg = mysqli_fetch_array($barang)) {
                    ?>
                        <form action="proses/keranjang.php" method="post" class="modal__pesan shadow" id="modal-pesan-<?php echo $brg['id']; ?>">
                            <!-- Modal Content -->
                            <div class="modal__content">
                                <div class="modal__header">
                                    <h2><?php echo $brg['nama']; ?></h2>
                                    <div class="modal-close" data-target="modal-pesan-<?php echo $brg['id']; ?>">
                                        <i class="bx bx-x"></i>
                                    </div>
                                </div>
                                <hr>

                                <div class="modal__body flex">
                                    <img src="assets/img/barang/<?php echo $brg['foto']; ?>" alt="<?php echo $brg['nama']; ?>">

                                    <div class="modal__data">
                                        <h1><?php echo $brg['nama']; ?></h1>
                                        <p>Harga: Rp.<?php echo number_format($brg['hargajual']); ?></p>
                                        <p>Stok: <?php echo $brg['stok']; ?></p>
                                        <p><?php echo $brg['keterangan']; ?></p>
                                    </div>

                                    <!-- ID Barang -->
                                    <input type="hidden" name="idbarang" value="<?php echo $brg['id']; ?>">

                                    <!-- Tambahkan tombol tambah dan kurang barang -->
                                    <div class="kuantitas__modal flex">
                                        <div class="btn__kuantitas" onclick="kurangBarang(<?php echo $brg['id']; ?>)">-</div>
                                        <input name="jumlah" type="number" id="kuantitas-<?php echo $brg['id']; ?>" value="1" class="kuantitas__input" readonly>
                                        <div class="btn__kuantitas" onclick="tambahBarang(<?php echo $brg['id']; ?>)">+</div>
                                    </div>

                                    <hr>

                                    <!-- Tambahkan tombol untuk menambah barang ke keranjang -->
                                    <button class="btn btn__checkout" data-section="cart" type="submit" name="tambahkeranjang" onclick="tambahKeKeranjang(<?php echo $brg['id']; ?>)" id="add-to-cart">Tambah ke Keranjang</button>
                                </div>
                            </div>
                        </form>
                    <?php
                    }
                    ?>
                    <!-- Modal Keranjang end -->
                <?php
                }
                ?>
                <!-- Pisahkan Kategori end -->
            </div>
        </section>

        <!-- section pencarian -->
        <section id="search" class="section container flex hidden">
            <div class="search__bar">
                <input autocomplete="off" type="text" name="search" id="search-input" placeholder="Cari seuatu...">
            </div>

            <hr>

            <div class="product__content flex shadow">
                <div class="product__img flex">
                    <img src="assets/img/barang/aqua.png" alt="">
                </div>

                <div class="produk__data">
                    <h3 class="product__name-data">Aqua 600ml</h3>
                    <h3 class="product__stock-data">Stok: 12</h3>
                    <h3 class="product__price-data">Harga: Rp.2.000</h3>
                    <button class="btn btn__add" id="add-search" data-target="modal-pesan-<?php echo $brg['id']; ?>"><i class='bx bx-cart-add'></i></button>
                </div>
            </div>
        </section>
        <!-- section pencarian -->

        <section id="cart" class="section container flex hidden">
            <h2 class="section__title">Keranjang</h2>

            <?php
            $totalHarga = 0; // Inisialisasi total harga
            $jumlahBarang = 0; // Inisialisasi jumlah barang

            $keranjang = mysqli_query($connect, "SELECT k.id AS idcart, k.idbarang ,k.jumlah , b.id , b.nama , b.foto ,b.hargajual FROM keranjang k , barang b  WHERE k.idbarang = b.id ORDER by k.id DESC");
            if (mysqli_num_rows($keranjang) > 0) {

                while ($cart = mysqli_fetch_array($keranjang)) {

            ?>
                    <form class="product__content-cart flex shadow" id="cart-container-<?php echo $cart['idcart']; ?>">
                        <div class="checkbox__container flex">
                            <input type="checkbox" id="<?php echo $cart['idcart']; ?>" name="<?php echo $cart['idcart']; ?>" checked id="checkbox-cart" class="checkbox__cart" value="1">
                        </div>
                        <label for="<?php echo $cart['idcart']; ?>">
                            <div class="product__img flex">
                                <img src="assets/img/barang/<?php echo $cart['foto']; ?>" alt="">
                            </div>
                        </label>

                        <div class="produk__data flex">
                            <label for="<?php echo $cart['idcart']; ?>">
                                <h3 class="product__name-data"><?php echo $cart['nama']; ?></h3>
                                <h3 class="product__price-data" id="harga-<?php echo $cart['idcart']; ?>">Rp.<?php echo $cart['hargajual']; ?></h3>
                            </label>
                            <div class="kuantitas flex kuantitas__cart">
                                <div name="edit" type="submit" class="btn btn__kuantitas" data-target="edit-jumlah-<?php echo $cart['idcart']; ?>" onclick="kurangBarang(<?php echo $cart['idcart']; ?>)">-</div>
                                <input type="text" name="id<?php echo $cart['id']; ?>" id="kuantitas-<?php echo $cart['idcart']; ?>" class="kuantitas__input" value="<?php echo $cart['jumlah']; ?>" readonly>
                                <div name="edit" type="submit" class="btn btn__kuantitas" data-target="edit-jumlah-<?php echo $cart['idcart']; ?>" onclick="tambahBarang(<?php echo $cart['idcart']; ?>)">+</div>
                            </div>
                        </div>
                    </form>
            <?php
                }
            }
            ?>

            <form class="checkout__container shadow">
                <div class="checkout__content">
                    <h3 class="harga__checkout"></h3>
                    <button class="btn btn__checkout">Beli Barang</button>
                    <h3 id="total-barang"></h3>
                </div>
            </form>
        </section>
    </main>

    <!-- <section style="height: 200vh;"></section> -->

    <script src="assets/js/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?php
    if (isset($_SESSION['sukses'])) {
    ?>
        <script>
            Swal.fire({
                position: "bottom-end",
                icon: "success",
                title: "<?php echo $_SESSION['sukses']; ?>",
                showConfirmButton: false,
                timer: 3000,

            });
        </script>
    <?php
        unset($_SESSION['sukses']); // Hapus sesi sukses setelah ditampilkan
    }

    if (isset($_SESSION['gagal'])) {
    ?>
        <script>
            Swal.fire({
                position: "bottom-end",
                icon: "error",
                title: "<?php echo $_SESSION['sukses']; ?>",
                showConfirmButton: false,
                timer: 3000,

            });
        </script>
    <?php
        unset($_SESSION['gagal']);
    }
    ?>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            // Ketika tombol untuk mengonfirmasi perubahan jumlah ditekan
            $('.btn__kuantitas').click(function() {
                // Ambil nilai jumlah baru dari input
                var id = $(this).data('target').split('-')[2]; // Ambil id barang dari data-target
                var jumlahBaru = $('#kuantitas-' + id).val();

                // Kirim data ke server menggunakan Ajax
                $.ajax({
                    url: 'proses/updatejumlah.php?id=' + id, // URL ke skrip PHP untuk mengubah jumlah di database
                    type: 'POST',
                    data: {
                        id: id, // ID barang
                        jumlahBaru: jumlahBaru // Jumlah baru
                    },
                    success: function(response) {
                        // Tampilkan pesan sukses atau kesalahan
                        alert(response);
                    }
                });
            });
        });
    </script> -->
    <script src="assets/js/script.js"></script>
</body>

</html>