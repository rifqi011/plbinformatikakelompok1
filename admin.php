<!-- Include Koneksi Database dan Mulai Sesi -->
<?php
@session_start();
include 'koneksi.php';

// Query Tabel setting dan Fetch Tabel
$toko = mysqli_query($connect, "SELECT * FROM setting");
$namatoko = mysqli_fetch_array($toko);

// Session harus login sebelum mengakses admin
// $user = $_SESSION['admin'];
$user = "Rifqi";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - <?php echo $namatoko['nama']; ?></title>
    <link rel="stylesheet" href="admin/admincss/style.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <?php
    /* if (isset($user)) {
        ?>
            <!-- <a href="admin/prosesadmin/logoutadmin.php">Log out</a> -->
        <?php
        } else {
            // header("Location: login.php");
        } */
    ?>

    <header id="header" class="container">
        <div class="nav__container flex">
            <div class="logo">
                <h1><?php echo $namatoko['nama']; ?></h1>
            </div>

            <!-- Navbar Bottom -->

            <nav id="navbar">
                <ul class="nav__list flex">
                    <li class="nav__item">
                        <a href="#" class="nav__link flex active-link" data-section="dashboard"><i class='bx bxs-home-alt-2'></i>Dashboard</a>
                    </li>
                    <li class="nav__item">
                        <a href="#" class="nav__link flex" data-section="produk"><i class='bx bx-category'></i>Produk</a>
                    </li>
                    <li class="nav__item">
                        <a href="#" class="nav__link flex" data-section="penjualan"><i class='bx bx-pie-chart-alt-2'></i>Penjualan</a>
                    </li>
                    <li class="nav__item">
                        <a href="#" class="nav__link flex" data-section="pelanggan"><i class='bx bx-group'></i>Pelanggan</a>
                    </li>
                </ul>
            </nav>

            <a href="" class="profile">
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

    <!-- Main -->
    <main id="main">
        <!-- Dashboard -->
        <section id="dashboard" class="dashboard section container flex active-section">
            <h1>Dashboard</h1>
        </section>

        <!-- Produk -->
        <section id="produk" class="produk section container flex hidden">
            <h1>Produk</h1>

            <!-- Search bar -->
            <form action="" method="post" class="search__bar">
                <input autocomplete="off" type="text" name="search" id="search-input" placeholder="Cari seuatu..." autofocus>
            </form>

            <hr>

            <div id="product-search">
                <!-- Product Card -->
                <?php
                $barang = mysqli_query($connect, "SELECT * FROM barang ORDER by status DESC");
                while ($brg = mysqli_fetch_array($barang)) {
                ?>
                    <div class="product__card">
                        <div class="product__content flex shadow">
                            <div class="product__img flex">
                                <img src="assets/img/barang/<?php echo $brg['foto']; ?>" alt="">
                            </div>

                            <div class="product__data flex">
                                <h1><?php echo $brg['nama']; ?></h1>
                                <p>Stok: <?php echo $brg['stok']; ?></p>
                                <p>Suplier: <?php echo $brg['suplier']; ?></p>
                            </div>

                            <div class="product__btn flex">
                                <a class="btn btn__edit" href=""><i class="bx bx-edit-alt"></i></a>
                                <?php
                                if ($brg['status'] == 1) {
                                ?>
                                    <a class="btn btn__minus" href="admin/prosesadmin/statusbarang.php?id=<?= $brg['id'];?>&status=0"><i class="bx bx-minus"></i></a>
                                <?php
                                } else {
                                ?>
                                    <a class="btn btn__minus" href="admin/prosesadmin/statusbarang.php?id=<?= $brg['id'];?>&status=1"><i class="bx bx-plus"></i></a>
                                <?php
                                }
                                ?>
                                <div class="btn btn__info"><i class='bx bx-dots-vertical-rounded' onclick="productPopUp(<?php echo $brg['id']; ?>)"></i></div>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
            <br>
            <br>
            <br>

            <!-- Pop up -->
            <?php
            $barang = mysqli_query($connect, "SELECT * FROM barang");
            while ($brg = mysqli_fetch_array($barang)) {
            ?>
                <div id="product-popup-<?php echo $brg['id']; ?>" class="popup">
                    <div class="popup__header flex">
                        <h2 class="section__title"><?php echo $brg['nama']; ?></h2>
                        <i class="bx bx-x popup__close" id="popup-close-<?php echo $brg['id']; ?>"></i>
                    </div>

                    <hr class="hr-pop">

                    <div class="popup__body">
                        <h3>Nama: <?php echo $brg['nama']; ?></h3><br>
                        <h3>kategori: <?php echo $brg['kategori']; ?></h3><br>
                        <h3>hargabeli: <?php echo $brg['hargabeli']; ?></h3><br>
                        <h3>hargajual: <?php echo $brg['hargajual']; ?></h3><br>
                        <h3>stok: <?php echo $brg['stok']; ?></h3><br>
                        <h3>suplier: <?php echo $brg['suplier']; ?></h3><br>
                        <h3>keterangan: <?php echo $brg['keterangan']; ?></h3><br>
                    </div>
                </div>
            <?php
            }
            ?>

            <!-- Add button -->
            <button class="btn btn__add" onclick="barangAdd(1)"><i class='bx bx-plus'></i></button>

            <!-- Modal Add -->
            <form action="admin/prosesadmin/tambahbarang.php" method="post" id="add-popup-1" class="popup">
                <div class="popup__header flex">
                    <h2 class="section__title">Tambah Barang</h2>
                    <i class="bx bx-x popup__close" id="add-close-1"></i>
                </div>

                <hr class="hr-pop">

                <div class="popup__body">
                    <div class="add__input">
                        <label for="nama">Masukan Nama</label>
                        <input autocomplete="off" type="text" name="nama" id="nama" class="input-add">
                    </div>

                    <div class="add__input">
                        <label for="nama">Masukan Kategori</label>
                        <select name="kategori" id="kategori">
                            <?php
                            $sql = mysqli_query($connect, "SELECT * FROM kategori");
                            while ($data = mysqli_fetch_array($sql)) { ?>
                                <option value="<?= $data['kategori'] ?>"><?= $data['kategori'] ?></option>
                            <?php }
                            ?>

                        </select>
                    </div>

                    <div class="add__input">
                        <label for="hargabeli">Masukan Harga Beli</label>
                        <input autocomplete="off" type="text" name="hargabeli" id="hargabeli" class="input-add">
                    </div>

                    <div class="add__input">
                        <label for="hargajual">Masukan Harga Jual</label>
                        <input autocomplete="off" type="text" name="hargajual" id="hargajual" class="input-add">
                    </div>

                    <div class="add__input">
                        <label for="suplier">Masukan Suplier</label>
                        <input autocomplete="off" type="text" name="suplier" id="suplier" class="input-add">
                    </div>

                    <div class="add__input">
                        <label for="satuan">Masukan Satuan</label>
                        <input autocomplete="off" type="text" name="satuan" id="satuan" class="input-add">
                    </div>
                    <div class="add__input">
                        <label for="foto">Masukan Foto</label>
                        <input type="file" name="foto" id="foto">
                    </div>
                    <div class="add__input">
                        <label for="keterangan">Masukan Keterangan</label>
                        <input autocomplete="off" type="text" name="keterangan" id="keterangan" class="input-add">
                    </div>
                </div>
                <button name="simpan" type="submit" class="btn btn__simpan">Simpan</button>
            </form>
        </section>

        <!-- Penjualan -->
        <section id="penjualan" class="penjualan section container flex hidden">
            <h1>Penjualan</h1>
        </section>

        <!-- Pelanggan -->
        <section id="pelanggan" class="pelanggan section container flex hidden">
            <h1>Pelanggan</h1>
        </section>
    </main>

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
    <script src="admin/adminjs/script.js"></script>
</body>

</html>