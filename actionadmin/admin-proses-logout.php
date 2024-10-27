<?php
session_start(); // Memulai session
session_unset(); // Menghapus semua session
session_destroy(); // Menghancurkan session
header("Location: ../admin.php"); // Arahkan ke halaman login
exit();
?>
