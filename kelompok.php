<!-- Start SESSION dan Include koneksi -->
<?php
@session_start();
include '../koneksi.php';

// Query Tabel setting dan Fetch Tabel
$toko = mysqli_query($connect, "SELECT * FROM setting");
$namatoko = mysqli_fetch_array($toko);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Developer - <?php echo $namatoko['nama']; ?></title>
    <link rel="stylesheet" href="../assets/css/login.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <section id="home" class="section container">
        <h1 class="headline"></h1>
    </section>
</body>

</html>