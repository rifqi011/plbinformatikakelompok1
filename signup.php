<!-- Start Session & Include koneksi.php -->
<?php
@session_start();
include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Toko</title>
    <link rel="stylesheet" href="assets/css/login.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <!-- Header -->
    <header id="header">
        <div class="login__header flex">
            <a href="index.php"><i class="bx bx-left-arrow-alt"></i></a>
            <h1>Daftar</h1>
        </div>
    </header>
    <hr>

    <section class="login__content flex">
        <h1 class="headline">Selamat datang </h1>

        <!-- Form -->
        <form method="post" action="proses/usersignup.php" class="login__form flex">
            <div class="login__group">
                <label for="nama">Masukan Nama*</label>
                <input autocomplete="off" type="text" name="nama" id="nama" required autofocus>
            </div>
            <div class="login__group">
                <label for="kelas">Masukan Kelas</label>
                <input autocomplete="off" type="text" name="kelas" id="kelas">
            </div>
            <div class="login__group">
                <label for="email">Masukan Email*</label>
                <input autocomplete="off" type="email" name="email" id="email" required>
            </div>
            <div class="login__group">
                <label for="password">Masukan Password*</label>
                <input autocomplete="off" type="password" name="password" id="password" required>
            </div>
            <div class="login__group">
                <label for="password2">Konfirmasi Password*</label>
                <input autocomplete="off" type="password" name="password2" id="password2" required>
            </div>
            <div class="login__group">
                <label for="alamat">Masukan Alamat</label>
                <input autocomplete="off" type="password" name="alamat" id="alamat">
            </div>
            <button class="btn btn__login" type="submit" name="signup">Daftar</button>
            <p class="signup__link">Sudah punya akun?&nbsp;<a href="login.php">Masuk</a></p>
        </form>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Pop Up -->
    <?php
    // Kondisi Sukses
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