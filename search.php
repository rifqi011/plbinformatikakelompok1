<?php
@session_start();
include 'koneksi.php';
$id = $_GET['id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="assets/css/search.css">
</head>

<body>
    <?php
    $barang = mysqli_query($connect, "SELECT * FROM barang WHERE id = '$id'");
    $brg = mysqli_fetch_array($barang);
    ?>
    <div id="header">
        <div class="search__header flex">
            <a href="index.php"><i class="bx bx-left-arrow-alt"></i></a>
            <h1><?php echo $brg['nama']; ?></h1>
        </div>
    </div>

    <hr>
    <form action="proses/keranjang.php" method="post">
        <div class="search__body">
            <img src="assets/img/barang/<?php echo $brg['foto']; ?>" class="search__img" alt="">
    
            <h1><?php echo $brg['nama']; ?></h1>
    
            <hr>
    
            <div class="search__data">
                <p>Harga: Rp.<?php echo number_format($brg['hargajual']); ?></p>
                <p>Stok: <?php echo $brg['stok']; ?></p>
                <p><?php echo $brg['keterangan']; ?></p>
            </div>
    
            <hr>
    
            <div class="kuantitas flex">
                <div class="btn__kuantitas" onclick="kurangBarang(<?php echo $brg['id']; ?>)">-</div>
                <input name="jumlah" type="number" id="kuantitas-<?php echo $brg['id']; ?>" value="1" class="kuantitas__input" readonly>
                <input type="hidden" id="stok-<?php echo $brg['id']; ?>" data-stok="<?php echo $brg['stok']; ?>" />
                <input type="hidden" name="idbarang" value="<?php echo $brg['id']; ?>">
                <input type="hidden" name="hargajual" value="<?php echo $brg['hargajual']; ?>">
                <div class="btn__kuantitas" onclick="tambahBarang(<?php echo $brg['id']; ?>)">+</div>
            </div>
    
            <hr>
    
            <!-- Tambahkan tombol untuk menambah barang ke keranjang -->
            <button class="btn btn__checkout" data-section="cart" type="submit" name="tambahkeranjang" onclick="tambahKeKeranjang(<?php echo $brg['id']; ?>)" id="add-to-cart">Tambah ke Keranjang</button>
        </div>
    </form>

    <script>
        function tambahBarang(idbarang) {
            const kuantitasInput = document.getElementById(`kuantitas-${idbarang}`);
            const currentKuantitas = parseInt(kuantitasInput.value);
            const stok = parseInt(
                document.getElementById(`stok-${idbarang}`).getAttribute("data-stok")
            );

            if (currentKuantitas < stok) {
                kuantitasInput.value = currentKuantitas + 1;
            }
        }

        function kurangBarang(idbarang) {
            const kuantitasInput = document.getElementById(`kuantitas-${idbarang}`);
            const currentKuantitas = parseInt(kuantitasInput.value);
            if (currentKuantitas > 1) {
                kuantitasInput.value = currentKuantitas - 1;
            }
        }
    </script>
</body>

</html>