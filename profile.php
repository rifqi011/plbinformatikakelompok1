<?php
include 'koneksi.php';
$User = mysqli_query($connect, "SELECT * FROM pengunjung");
$dataUser = mysqli_fetch_array($User);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Toko</title>
    <link rel="stylesheet" href="assets/css/profile.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <header id="header">
        <div class="profile__header flex">
            <a href="/inforp5"><i class="bx bx-left-arrow-alt"></i></a>
            <h1>Profil Saya</h1>
        </div>
    </header>
    <hr>

    <div class="profile__content">
        <img src="assets/img/<?php echo $dataUser['foto']; ?>" alt="" class="profile__img">
        <div class="profile__data">
            <h2 class="nama"><?php echo $dataUser['nama']; ?></h2>
            <p class="email"><?php echo $dataUser['email']; ?></p>
        </div>
    </div>
    <hr>

    <ul class="profile__list">
        <li class="profile__item">
            <a class="profile__link" href=""><i class="bx bx-pencil"></i>Edit akun</a>
        </li>
        <li class="profile__item">
            <a class="profile__link" href=""><i class="bx bx-log-out"></i>Log out</a>
        </li>
    </ul>

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
</body>

</html>