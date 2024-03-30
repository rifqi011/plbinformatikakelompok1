<?php
@session_start();
include 'koneksi.php'; 
$email = $_SESSION['user'];

$sql = mysqli_query($connect, "SELECT * FROM pengunjung WHERE email = '$email'");
$data = mysqli_fetch_array($sql);

if(!isset($_SESSION['user'])) {
    header('Location: index.php');
}
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
    <header id="header">
        <div class="login__header flex">
            <a href="/plbinformatikakelompok1"><i class="bx bx-left-arrow-alt"></i></a>
            <h1>Edit Akun</h1>
        </div>
    </header>
    <hr>

    <section class="login__content flex">
        <form method="post" action="proses/useredit.php" class="login__form flex">
            <div class="login__group">
                <label for="nama">Masukan Nama</label>
                <input autocomplete="off" type="text" name="nama" id="nama" value="<?php echo $data['nama']?>">
            </div>
            <div class="login__group">
                <label for="kelas">Masukan Kelas</label>
                <input autocomplete="off" type="text" name="kelas" id="kelas" value="<?php echo $data['kelas']?>">
            </div>
            <input type="hidden" name="email" value="<?php echo $email; ?>">
            <button class="btn btn__login" type="submit" name="simpan">Simpan</button>
        </form>
    </section>

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
                title: "<?php echo $_SESSION['gagal']; ?>",
                showConfirmButton: false,
                timer: 3000,

            });
        </script>
    <?php
        unset($_SESSION['gagal']);
    }
    ?>
</body>

</html>