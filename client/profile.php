<!-- Start Session & Include koneksi.php -->
<?php
session_start();
include '../koneksi.php';

// GET SESSION
$sesion = $_SESSION['user'];

// Query Tabel pengunjung dan Fetch Tabel
$User = mysqli_query($connect, "SELECT * FROM pengunjung WHERE email = '$sesion'");
$dataUser = mysqli_fetch_array($User);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Toko</title>
    <link rel="stylesheet" href="../assets/css/profile.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <!-- Header -->
    <header id="header">
        <div class="profile__header flex">
            <a href="../index.php"><i class="bx bx-left-arrow-alt"></i></a>
            <h1>Profil Saya</h1>
        </div>
    </header>

    <hr>

    <main id="main">
        <?php
        // Kondisi Jika Terdapat SESSION
        if (isset($_SESSION['user'])) {
        ?>
            <div class="profile__content">
                <img src="../assets/img/<?php echo $dataUser['foto']; ?>" alt="" class="profile__img">

                <div class="profile__data">
                    <h2 class="nama"><?php echo $dataUser['nama']; ?></h2>
                    <p class="email"><?php echo $dataUser['email']; ?></p>
                </div>
            </div>

            <hr>

            <ul class="profile__list">
                <li class="profile__item">
                    <a class="profile__link" href="edit.php"><i class="bx bx-pencil"></i>Edit akun</a>
                </li>

                <li class="profile__item">
                    <a class="profile__link" href="proses/logout.php"><i class="bx bx-log-out"></i>Keluar</a>
                </li>
            </ul>
        <?php
        } else {
            // Kondisi Jika Tidak Ada SESSION
        ?>
            <h1 style="text-align: center;">Silahkan masuk terlebih dahulu</h1>

            <li class="profile__item login__button">
                <a class="profile__link flex profile__btn" href="login.php"><i class="bx bx-pencil"></i>Masuk</a>
            </li>
        <?php
        }
        ?>
    </main>

    <!-- Footer -->
    <footer id="footer">
        <h2 style="display: flex; justify-content: center;">Developed by&nbsp;
            <a id="kelompok-link" style="color: var(--dark-green-color);" href="#">Kelompok 1</a>
        </h2>
    </footer>

    <script>
        // Deteksi apakah pengguna mengakses dari perangkat mobile atau desktop
        function isMobileDevice() {
            return (typeof window.orientation !== "undefined") || (navigator.userAgent.indexOf('IEMobile') !== -1);
        }

        // Tentukan URL berdasarkan jenis perangkat yang digunakan
        var kelompokLink = document.getElementById('kelompok-link');
        if (isMobileDevice()) {
            kelompokLink.href = 'kelompokmobile.php';
        } else {
            kelompokLink.href = 'kelompokdesktop.php';
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Pop Up -->
    <?php
    // Kondisi Jika SESSION Sukses
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

    // Kondisi Gagal
    if (isset($_SESSION['gagal'])) {
    ?>
        <script>
            Swal.fire({
                position: "bottom-end",
                icon: "error",
                title: "<?php echo $_SESSION['gagal']; ?>",
                showConfirmButton: false,
                timer: 3000,

            });
        </script>
    <?php
        unset($_SESSION['gagal']); // Hapus sesi sukses setelah ditampilkan
    }
    ?>
</body>

</html>