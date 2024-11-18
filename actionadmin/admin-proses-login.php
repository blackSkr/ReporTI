<?php
// Memulai session
session_start();

// Memasukkan file koneksi database
include '../connection/koneksi.php';

// Mengecek jika tombol login ditekan
if (isset($_POST['Login'])) {
    // Mengambil data dari form dan menyiapkan input
    $nomoradmin = trim($_POST['useradmin']);
    $password = trim($_POST['password']);

    // Query untuk mencari di tabel admin
    $query_admin = "SELECT * FROM tb_admin WHERE noadmin = ?";
    $stmt_admin = mysqli_prepare($koneksi, $query_admin);
    mysqli_stmt_bind_param($stmt_admin, 's', $nomoradmin);
    mysqli_stmt_execute($stmt_admin);
    $result_admin = mysqli_stmt_get_result($stmt_admin);
    
    // Mengecek apakah ada data di tabel admin
    if ($row_admin = mysqli_fetch_assoc($result_admin)) {
        // Memeriksa password untuk admin
        if (password_verify($password, $row_admin['password'])) {
            // Login berhasil, simpan data admin dalam session
            $_SESSION['noadmin'] = $row_admin['noadmin'];
            $_SESSION['namadmin'] = $row_admin['nama'];
            $_SESSION['tipe'] = 'admin';

            // Arahkan ke halaman admin
            header("Location: ../page_admin/index.php");
            exit();
        } else {
            // Password salah
            echo "<script>alert('Login gagal: Password salah!'); window.location.href='../page_admin/index.php';</script>";
        }
    } else {
        // Jika noadmin tidak ditemukan
        echo "<script>alert('Login gagal: Username tidak ditemukan!'); window.location.href='../page_admin/index.php';</script>";
    }

    // Menutup statement
    mysqli_stmt_close($stmt_admin);
}

// Menutup koneksi database
mysqli_close($koneksi);
?>
