<?php
$host = "localhost"; 
$user = "root";
$pass = ""; 
$db   = "db_report";


$koneksi = mysqli_connect($host, $user, $pass, $db);


if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
} else {
    // echo "Koneksi berhasil!";
}
?>
