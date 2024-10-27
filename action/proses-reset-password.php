<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../connection/koneksi.php';

// Ambil NIM atau NIDN dari URL
$nim = isset($_GET['nim']) ? $_GET['nim'] : '';
$nidn = isset($_GET['nidn']) ? $_GET['nidn'] : '';

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $passwordBaru = $_POST['passwordbaru'];

    // Hash password baru
    $hashedPassword = password_hash($passwordBaru, PASSWORD_DEFAULT);

    // Update password di tabel mahasiswa atau dosen
    $queryMahasiswa = "UPDATE tb_mahasiswa SET password = ? WHERE nim = ?";
    $queryDosen = "UPDATE tb_dosen SET password = ? WHERE nidn = ?";

    // Cek apakah username adalah NIM atau NIDN
    if (!empty($nim) && $username === $nim) {
        // Update untuk mahasiswa
        $stmt = mysqli_prepare($koneksi, $queryMahasiswa);
        mysqli_stmt_bind_param($stmt, "ss", $hashedPassword, $username);
    } elseif (!empty($nidn) && $username === $nidn) {
        // Update untuk dosen
        $stmt = mysqli_prepare($koneksi, $queryDosen);
        mysqli_stmt_bind_param($stmt, "ss", $hashedPassword, $username);
    } else {
        // Username tidak cocok, kirim pesan error
        echo "<script>
                alert('NIM atau NIDN tidak valid!');
              </script>";
        exit; // Keluar dari skrip
    }

    // Eksekusi statement
    if (mysqli_stmt_execute($stmt)) {
        echo "<script>
                alert('Password berhasil direset! Silakan login dengan password baru.');
                window.location.href = '../index.php'; // Redirect ke halaman login
              </script>";
    } else {
        echo "<script>
                alert('Gagal! Terjadi kesalahan saat mereset password.');
              </script>";
    }

    // Tutup statement
    mysqli_stmt_close($stmt);
}

// Tutup koneksi
mysqli_close($koneksi);
?>
