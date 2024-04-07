<!-- Include Koneksi Database dan Mulai Sesi -->
<?php
include 'koneksi.php';

// Query Tabel setting dan Fetch Tabel
$toko = mysqli_query($connect, "SELECT * FROM setting");
$namatoko = mysqli_fetch_array($toko);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - <?php echo $namatoko['nama']; ?></title>
    <link rel="stylesheet" href="admin/admincss/style.css">
</head>
<body>
    <h1>tes</h1>
</body>
</html>