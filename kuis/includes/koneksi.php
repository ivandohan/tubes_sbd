<?php
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $database = 'kelompok2';

    $koneksi = mysqli_connect($host, $user, $pass, $database);

    //prosedural
    //$koneksi = mysqli_connect($host , $user , $pass, $database);

    if ($koneksi->connect_error){
        die("Koneksi Gagal:".$koneksi->connect_error);
    }
?>
