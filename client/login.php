<!-- Start SESSION dan Include koneksi -->
<?php
@session_start();
include '../koneksi.php';

// Kondisi Jika Terdapat SESSION maka Tidak Bisa Masuk Halaman Ini
if (isset($_SESSION['user'])) {
    // Halaman yang Dituju
    header('Location: index.php');
}

$toko = mysqli_query($connect, "SELECT * FROM setting");
$namatoko = mysqli_fetch_array($toko);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - <?php echo $namatoko['nama']; ?></title>
    <link rel="stylesheet" href="../assets/css/login.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <!-- Header -->
    <header id="header">
        <div class="login__header flex">
            <a href="../index.php"><i class="bx bx-left-arrow-alt"></i></a>
            <h1>Masuk</h1>
        </div>
    </header>
    <hr>

    <section class="login__content flex">
        <h1 class="headline">Selamat datang</h1>

        <!-- <?php //if (isset($error)) : ?>
            <p>Salah</p>
        <?php //endif; ?> -->

        <!-- Form -->
        <form action="proses/userlogin.php" class="login__form flex" method="post">
            <div class="login__group">
                <label for="email">Masukan Email</label>
                <input autocomplete="off" type="email" name="email" id="email" required autofocus>
            </div>
            <div class="login__group">
                <label for="password">Masukan Password</label>
                <input autocomplete="off" type="password" name="password" id="password" required>
            </div>
            <button class="btn btn__login" type="submit" name="login">Log in</button>
            <p class="signup__link">Belum punya akun?&nbsp;<a href="signup.php">Daftar</a></p>
        </form>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <?php
    // Kondisi Jika Sukses
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

    // Kondisi Jika Gagal
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