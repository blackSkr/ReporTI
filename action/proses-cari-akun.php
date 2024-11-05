<?php
include '../connection/koneksi.php'; // Koneksi ke database

if (isset($_POST['submit'])) {
    $username = $_POST['username']; // NIM atau NIDN
    $email = $_POST['email']; // Email

    // Query untuk mencari di tabel mahasiswa dan dosen berdasarkan NIM/NIDN dan email
    $queryMahasiswa = "SELECT * FROM tb_mahasiswa WHERE nim = ? AND email = ?";
    $queryDosen = "SELECT * FROM tb_dosen WHERE nidn = ? AND email = ?";

    // Siapkan statement untuk tabel mahasiswa
    $stmtMahasiswa = mysqli_prepare($koneksi, $queryMahasiswa);
    mysqli_stmt_bind_param($stmtMahasiswa, "ss", $username, $email);
    mysqli_stmt_execute($stmtMahasiswa);
    $resultMahasiswa = mysqli_stmt_get_result($stmtMahasiswa);

    // Siapkan statement untuk tabel dosen
    $stmtDosen = mysqli_prepare($koneksi, $queryDosen);
    mysqli_stmt_bind_param($stmtDosen, "ss", $username, $email);
    mysqli_stmt_execute($stmtDosen);
    $resultDosen = mysqli_stmt_get_result($stmtDosen);

    if (mysqli_num_rows($resultMahasiswa) > 0) {
        // Jika ditemukan di tb_mahasiswa
        $row = mysqli_fetch_assoc($resultMahasiswa);
        $nim = $row['nim'];

        // Redirect ke halaman reset password dengan NIM
        header("Location: page-reset-password.php?nim=" . $nim);
        exit();
    } elseif (mysqli_num_rows($resultDosen) > 0) {
        // Jika ditemukan di tb_dosen
        $row = mysqli_fetch_assoc($resultDosen);
        $nidn = $row['nidn'];

        // Redirect ke halaman reset password dengan NIDN
        header("Location: page-reset-password.php?nidn=" . $nidn);
        exit();
    } else {
        // Jika tidak ditemukan
        header("Location: ./page-lupa-password.php?message=cari-password-gagal");
        // echo "<script>
        //         alert('Akun tidak ditemukan. Pastikan NIM/NIDN dan email yang dimasukkan benar.');
        //         window.location.href = '../index.php'; // Redirect ke halaman login
        //       </script>";
    }

    // Tutup statement setelah digunakan
    mysqli_stmt_close($stmtMahasiswa);
    mysqli_stmt_close($stmtDosen);
}

// Tutup koneksi
mysqli_close($koneksi);
?>
