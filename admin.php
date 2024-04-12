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

            <!-- Product Card -->
            <div class="product__card">
                <div class="product__content flex shadow">
                    <div class="product__img flex">
                        <img src="assets/img/barang/aqua.png" alt="">
                    </div>

                    <div class="product__data flex">
                        <h1>Aqua</h1>
                        <div class="product__btn">
                            <a class="btn btn__edit" href=""><i class="bx bx-edit-alt"></i></a>
                            <a class="btn btn__minus" href=""><i class="bx bx-minus"></i></a>
                            <div class="btn btn__info"><i class='bx bx-dots-vertical-rounded' onclick="productPopUp(1)"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Pop up -->
            <div id="product-popup-1" class="popup">
                <div class="popup__header flex">
                    <h2 class="section__title">Aqua</h2>
                    <i class="bx bx-x popup__close" id="popup-close-1"></i>
                </div>

                <hr class="hr-pop">

                <div class="popup__body">
                    <p>Lorem, ipsum dolor.</p>
                    <p>Lorem, ipsum dolor.</p>
                    <p>Lorem, ipsum dolor.</p>
                </div>
            </div>

            <!-- Add button -->
            <button class="btn btn__add"><i class='bx bx-plus'></i></button>
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