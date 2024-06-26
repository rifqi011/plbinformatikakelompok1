<!-- Include Koneksi Database dan Mulai Sesi -->
<?php
@session_start();
include 'koneksi.php';
$tanggal    = date('Y-m-d');

// Query Tabel setting dan Fetch Tabel
$toko = mysqli_query($connect, "SELECT * FROM setting");
$namatoko = mysqli_fetch_array($toko);

// Mengambil SESSION
$email = $_SESSION['user'];

// Mengambil Data Pengunjung dari Tabel Berdasarkan SESSION yang Aktif
$User = mysqli_query($connect, "SELECT * FROM pengunjung WHERE email = '$email'");
$pengunjung = mysqli_fetch_array($User);
$idpengunjung = $pengunjung['id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $namatoko['nama']; ?></title>
    <link rel="stylesheet" href="assets/css/swiper-bundle.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/desktop.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.min.css" rel="stylesheet">
</head>

<body id="body">
    <!-- Header Top -->
    <header id="header" class="container">
        <div class="nav__container flex">
            <div class="logo">
                <h1><?php echo $namatoko['nama']; ?></h1>
            </div>

            <!-- Navbar Bottom -->

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
                    <li class="nav__item">
                        <a href="#" class="nav__link flex" data-section="buy"><i class='bx bx-receipt'></i>Pembelian</a>
                    </li>
                </ul>
            </nav>

            <a href="client/profile.php" class="profile">
                <?php
                if (!$email) {
                ?>
                    <img src="assets/img/defaultfoto.png" alt="" class="profile__img">
                    <p>Tamu</p>
                <?php
                } else {
                ?>
                    <img src="assets/img/<?php echo $pengunjung['foto']; ?>" alt="" class="profile__img">
                <?php
                    echo $pengunjung['nama'];
                }
                ?>
            </a>
        </div>
    </header>
    <!-- Header end -->

    <!-- Main Page Mobile -->
    <main id="main">
        <!-- Home Section -->
        <section id="home" class="section container flex active-section">
            <!-- Home Banner -->
            <div class="home__banner swiper homeSwiper">
                <div class="swiper-wrapper home__wrapper">

                    <!-- query Data Banner -->
                    <?php
                    $banner = mysqli_query($connect, "SELECT * FROM banner");
                    while ($bnr = mysqli_fetch_array($banner)) {
                    ?>
                        <!-- Swiper -->
                        <div class="swiper-slide home__slide">
                            <img src="assets/img/banner/<?php echo $bnr['foto']; ?>.png" alt="">
                        </div>
                    <?php
                    }
                    ?>

                </div>
            </div>

            <!-- Card Section -->
            <div class="card__section">

                <!-- Pisahkan Kategori -->
                <?php
                $kategori = mysqli_query($connect, "SELECT kategori FROM barang GROUP BY kategori");
                while ($kat = mysqli_fetch_array($kategori)) {
                ?>

                    <h2 class="section__title"><?php echo $kat['kategori'] ?></h2>

                    <!-- Card Swiper -->
                    <div class="card__swiper swiper cardSwiper" id="card">
                        <div class="swiper-wrapper flex">

                            <!-- query Data Barang -->
                            <?php
                            $barang = mysqli_query($connect, "SELECT * FROM barang WHERE kategori = '$kat[kategori]' AND status = 1");
                            while ($brg = mysqli_fetch_array($barang)) {
                            ?>

                                <!-- Card Slide -->
                                <div class="swiper-slide card__slide flex shadow">
                                    <!-- Data Card -->
                                    <div class="card__slide__img">
                                        <img src="assets/img/barang/<?php echo $brg['foto']; ?>" alt="card">
                                    </div>
                                    <div class="card__slide__content flex">
                                        <h3 class="product__name"><?php echo $brg['nama']; ?></h3>
                                        <h3 class="product__price">Harga: Rp.<?php echo number_format($brg['hargajual']) . "/" . $brg['satuan']; ?></h3>
                                        <h3 class="product__stock">Stok: <?php echo ($brg['stok'] > 0) ? $brg['stok'] : "SOLD OUT"; ?></h3>
                                        <button class="btn btn__add" <? echo ($brg['stok'] > 0) ? 'data-target="modal-pesan-' . $brg['id'] . '"' : '' ?>"><i class='bx bx-cart-add'></i></button>
                                    </div>
                                </div>

                            <?php
                            }
                            ?>

                        </div>
                    </div>

                    <!-- Modal Keranjang -->
                    <!-- query Data Barang -->
                    <?php
                    $barang = mysqli_query($connect, "SELECT * FROM barang WHERE kategori = '$kat[kategori]'");
                    while ($brg = mysqli_fetch_array($barang)) {
                        // query terjual hari ini
                        $terjual = mysqli_query($connect, "SELECT SUM(k.jumlah) as jumlah, k.idbarang, k.idtransaksi, p.tanggal, b.id , p.id FROM keranjang k, penjualan p, barang b WHERE k.idtransaksi = p.id AND k.idbarang = b.id AND b.id = '$brg[id]' AND p.tanggal='$tanggal'");
                        $tjl = mysqli_fetch_array($terjual);
                    ?>

                        <form action="client/proses/keranjang.php" method="post" class="modal__pesan shadow" id="modal-pesan-<?php echo $brg['id']; ?>">
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
                                        <p>Harga: Rp.<?php echo number_format($brg['hargajual']) . "/" . $brg['satuan']; ?></p>
                                        <p>Stok: <?php echo $brg['stok']; ?></p>
                                        <p>Terjual hari ini: <?php echo $tjl['jumlah']; ?></p>
                                        <p><?php echo $brg['keterangan']; ?></p>
                                    </div>

                                    <!-- ID Barang -->
                                    <input type="hidden" name="idbarang" value="<?php echo $brg['id']; ?>">
                                    <input type="hidden" name="hargajual" value="<?php echo $brg['hargajual']; ?>">

                                    <!-- Tambahkan tombol tambah dan kurang barang -->
                                    <div class="kuantitas__modal flex">
                                        <div class="btn__kuantitas" onclick="kurangBarang(<?php echo $brg['id']; ?>)">-</div>
                                        <input name="jumlah" type="number" id="kuantitas-<?php echo $brg['id']; ?>" value="1" class="kuantitas__input" readonly>
                                        <input type="hidden" id="stok-<?php echo $brg['id']; ?>" data-stok="<?php echo $brg['stok']; ?>" />
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
            <form action="" method="post" class="search__bar">
                <input autocomplete="off" type="text" name="search" id="search-input" placeholder="Cari sesuatu..." autofocus>
            </form>

            <hr>

            <div id="product-search">
                <img src="assets/img/icon/cari.png" alt="" class="image-alt">
            </div>
        </section>

        <!-- section Keranjang -->
        <section id="cart" class="section container flex hidden">
            <h2 class="section__title">Keranjang</h2>

            <?php
            if (!empty($_SESSION['cart'])) {
                foreach ($_SESSION['cart'] as $cart => $val) {
                    $sql = mysqli_query($connect, "SELECT * FROM barang WHERE id = '$val[idbarang]'");
                    $row = mysqli_fetch_array($sql);
            ?>
                    <form action="client/proses/checkout.php" method="post">
                        <div class="product__content-cart flex shadow" id="cart-container-<?php echo $val['idcart']; ?>">
                            <div class="product__img flex">
                                <a href="client/proses/hapuskeranjang.php?id=<?php echo $val['idbarang']; ?>" class="btn btn__kuantitas"><i class="bx bx-trash"></i></a>
                                <img src="assets/img/barang/<?php echo $row['foto']; ?>" alt="">
                            </div>

                            <div class="produk__data flex">
                                <h3 class="product__name-data"><?php echo $row['nama']; ?></h3>
                                <h3 class="product__price-data" id="harga-<?php echo $val['idcart']; ?>">Rp.<?php echo number_format($val['hargajual']); ?></h3>
                                <div class="flex menu__cart">
                                    <div class="btn btn__kuantitas" onclick="cartKurangBarang(<?php echo $val['idbarang']; ?>)">-</div>
                                    <input type="text" name="id<?php echo $val['idbarang']; ?>" id="cart-kuantitas-<?php echo $val['idbarang']; ?>" class="kuantitas__input kuantitas__keranjang" data-harga="<?php echo $row['hargajual']; ?>" value="<?php echo $val['jumlah']; ?>" readonly>
                                    <div class="btn btn__kuantitas" onclick="cartTambahBarang(<?php echo $val['idbarang']; ?>)">+</div>
                                </div>
                            </div>
                        </div>
                    <?php
                }
            } else {
                    ?>
                    <img src="assets/img/icon/keranjang.png" alt="" class="image-alt">
                <?php
            }
                ?>

                <div class="checkout__container shadow">
                    <div class="checkout__input">
                        <label for="textarea">
                            <h3>Alamat Pengiriman</h3>
                        </label>
                        <textarea name="alamat" id="textarea" rows="2" required placeholder="Tulis disini..." autofocus><?php echo $pengunjung['alamat']; ?></textarea>
                    </div>
                    <div class="checkout__content">
                        <h3 id="harga-checkout" class="harga__checkout"></h3>
                        <?php
                        if (isset($_SESSION['user'])) {
                        ?>
                            <button class="btn btn__checkout" type="submit" name="beli">Beli Barang</button>
                        <?php
                        } else {
                        ?>
                            <a href="client/login.php" class="btn btn__checkout" type="submit" name="beli">Beli Barang</a>
                        <?php
                        }
                        ?>
                        <h3 id="total-barang"></h3>
                    </div>
                </div>
                    </form>
        </section>

        <!-- Transaction Section -->
        <section id="buy" class="section container flex hidden">
            <?php
            if (isset($_SESSION['user'])) {
            ?>
                <h2 class="section__title">Pembelian</h2>

                <?php
                $pembelian = mysqli_query($connect, "SELECT * FROM  penjualan WHERE idpengunjung = '$idpengunjung' ORDER by id DESC");

                while ($buy = mysqli_fetch_array($pembelian)) {

                    $penjualan = mysqli_query($connect, "SELECT COUNT(id) as jenis, SUM(jumlah) as jumlah, SUM(jumlah*harga) as totalharga FROM keranjang WHERE idtransaksi = '$buy[id]'");
                    $dataPenjualan = mysqli_fetch_array($penjualan);
                ?>
                    <div class="transaction__card flex shadow" onclick="popUp(<?php echo $buy['id'] ?>)">
                        <div class="transaction__content flex">
                            <div class="transaction__left">
                                <p class="deliverydate">Tanggal: <?php echo $buy['tanggal'] . " " . $buy['jam']; ?></p>
                                <p>No: <?php echo $buy['nomortransaksi']; ?></p>
                            </div>
                            <div class="transaction__right">
                                <p><?php echo $dataPenjualan['jenis']; ?> Menu</p>
                                <p><?php echo $dataPenjualan['jumlah']; ?> Item</p>
                            </div>
                        </div>

                        <hr>

                        <div class="transaction__content flex">
                            <p class="price">Rp.<?php echo number_format($dataPenjualan['totalharga']); ?></p>
                            <div class="status">
                                <?php
                                if ($buy['status'] == 0) {
                                ?>
                                    <p class="diproses flex"><i class='bx bx-bolt-circle'></i>Diproses</p>
                                <?php
                                } elseif ($buy['status'] == 1) {
                                ?>
                                    <p class="diproses flex"><i class='bx bx-bolt-circle'></i>Dikirim</p>
                                <?php
                                } elseif ($buy['status'] == 2) {
                                ?>
                                    <p class="berhasil flex"><i class='bx bx-check-circle'></i>Selesai</p>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                <?php
                }
            } else {
                ?>
                <h2 class="section__title">Pembelian</h2>
                <img src="assets/img/icon/masuk.png" alt="" class="image-alt">
            <?php
            }
            ?>

            <!-- Pop up -->
            <?php
            $pembelian = mysqli_query($connect, "SELECT * FROM  penjualan WHERE idpengunjung = '$idpengunjung' ORDER by id DESC");

            while ($buy = mysqli_fetch_array($pembelian)) {
            ?>


                <div class="popup" id="popup-<?php echo $buy['id']; ?>">
                    <div class="popup__header flex">
                        <h2 class="section__title">Data Pembelian</h2>
                        <i class="bx bx-x popup__close" id="popup-close-<?php echo $buy['id']; ?>"></i>
                    </div>
                    <hr class="hr-pop">

                    <div class="popup__body">
                        <p>Tanggal: <?php echo $buy['tanggal']; ?></p>
                        <p>No: <?php echo $buy['nomortransaksi']; ?></p>

                        <hr class="hr-pop">

                        <h3>Penerima: <?php echo $pengunjung['nama']; ?></h3>
                        <h3>Alamat: <?php echo $buy['alamat']; ?></h3>

                        <hr class="hr-pop">

                        <h2>Pesanan</h2>
                        <table width="100%" align="center" cellspacing=0>

                            <?php
                            $pesanan = mysqli_query($connect, "SELECT * FROM keranjang WHERE idtransaksi = '$buy[id]'");
                            while ($dataPesanan = mysqli_fetch_array($pesanan)) {
                                $barang = mysqli_query($connect, "SELECT * FROM barang WHERE id = '$dataPesanan[idbarang]'");
                                $brg = mysqli_fetch_array($barang);
                            ?>
                                <tr>
                                    <td><?php echo $dataPesanan['jumlah']; ?></td>
                                    <td><?php echo $brg['satuan']; ?></td>
                                    <td><?php echo $brg['nama']; ?></td>
                                    <td>@</td>
                                    <td align="right">Rp.<?php echo number_format($brg['hargajual']); ?></td>
                                    <td align="right">=</td>
                                    <td align="right">Rp.<?php echo number_format($brg['hargajual'] * $dataPesanan['jumlah']); ?></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </table>
                    </div>
                </div>
            <?php } ?>
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
    <script src="assets/js/script.js"></script>
</body>

</html>