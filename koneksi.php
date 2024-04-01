<?php
//Halaman Koneksi Untuk Menghubungkan ke Database 

    $host = 'localhost:3434';
    $user = 'root';
    $pass = 'kebersamaan'; //password
    $db = 'informatika'; //database 
    $connect = mysqli_connect("$host", "$user", "$pass", "$db");
