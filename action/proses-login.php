<?php
// Memulai session
session_start();

// Memasukkan file koneksi database
include '../connection/koneksi.php';

// Mengecek jika tombol login ditekan
if (isset($_POST['Login'])) {
    // Mengambil data dari form dan menyiapkan input
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Query untuk mencari di tabel mahasiswa
    $query_mahasiswa = "SELECT * FROM tb_mahasiswa WHERE nim = ?";
    $stmt_mahasiswa = mysqli_prepare($koneksi, $query_mahasiswa);
    mysqli_stmt_bind_param($stmt_mahasiswa, 's', $username);
    mysqli_stmt_execute($stmt_mahasiswa);
    $result_mahasiswa = mysqli_stmt_get_result($stmt_mahasiswa);

    // Query untuk mencari di tabel dosen
    $query_dosen = "SELECT * FROM tb_dosen WHERE nidn = ?";
    $stmt_dosen = mysqli_prepare($koneksi, $query_dosen);
    mysqli_stmt_bind_param($stmt_dosen, 's', $username);
    mysqli_stmt_execute($stmt_dosen);
    $result_dosen = mysqli_stmt_get_result($stmt_dosen);

    // Mengecek apakah ada data di tabel mahasiswa
    if ($row_mahasiswa = mysqli_fetch_assoc($result_mahasiswa)) {
        // Memeriksa password untuk mahasiswa
        if (password_verify($password, $row_mahasiswa['password'])) {
            // Login berhasil, simpan data mahasiswa dalam session
            $_SESSION['nim'] = $row_mahasiswa['nim'];
            $_SESSION['user_mhs'] = $row_mahasiswa['nama'];
            $_SESSION['user_type'] = 'mahasiswa';

            // Arahkan ke halaman mahasiswa
            header("Location: ../page_mahasiswa/index.php");
            exit();
        } else {
            // Password salah
            echo "<script>alert('Login gagal: Password salah!'); window.location.href='../index.php';</script>";
        }
    } 
    // Mengecek apakah ada data di tabel dosen
    else if ($row_dosen = mysqli_fetch_assoc($result_dosen)) {
        // Memeriksa password untuk dosen
        if (password_verify($password, $row_dosen['password'])) {
            // Debugging: Tambahkan pesan untuk memastikan ini dieksekusi
            echo "Login sebagai dosen berhasil!";
            
            // Login berhasil, simpan data dosen dalam session
            $_SESSION['nidn'] = $row_dosen['nidn'];
            $_SESSION['user_dosen'] = $row_dosen['nama'];
            $_SESSION['user_type'] = 'dosen';

            // Arahkan ke halaman dosen
            header("Location: ../page_dosen/index.php");
            exit();
        } else {
            // Password salah
            echo "<script>alert('Login gagal: Password salah!'); window.location.href='../index.php';</script>";
        }
    } else {
        // Jika NIM atau NIDN tidak ditemukan
        echo "<script>alert('Login gagal: Username tidak ditemukan!'); window.location.href='../index.php';</script>";
    }

    // Menutup statement
    mysqli_stmt_close($stmt_mahasiswa);
    mysqli_stmt_close($stmt_dosen);
}

// Menutup koneksi database
mysqli_close($koneksi);
?>
