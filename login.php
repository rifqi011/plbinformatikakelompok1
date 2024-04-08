<!-- Include Koneksi Database dan Mulai Sesi -->
<?php
@session_start();
include 'koneksi.php';

// Query Tabel setting dan Fetch Tabel
$toko = mysqli_query($connect, "SELECT * FROM setting");
$namatoko = mysqli_fetch_array($toko);

// Kondisi Jika Terdapat SESSION maka Tidak Bisa Masuk Halaman Ini
if (isset($_SESSION['user'])) {
    // Halaman yang Dituju
    header('Location: admin.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - <?php echo $namatoko['nama']; ?></title>
    <link rel="stylesheet" href="admin/admincss/login.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.min.css" rel="stylesheet">
</head>

<body>
    <section class="login__content flex">
        <h1 class="headline">Login Admin</h1>

        <!-- Form -->
        <form action="admin/prosesadmin/loginadmin.php" class="login__form flex shadow" method="post">
            <div class="login__group">
                <label for="user">Masukan User</label>
                <input autocomplete="off" type="text" name="user" id="user" required autofocus>
            </div>
            <div class="login__group">
                <label for="password">Masukan Password</label>
                <input autocomplete="off" type="password" name="password" id="password" required>
            </div>
            <button class="btn btn__login" type="submit" name="login">Log in</button>
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