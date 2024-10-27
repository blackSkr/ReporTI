<?php
// Memasukkan file koneksi database
include '../connection/koneksi.php';

// Mengecek jika ada ID laporan yang dikirim
if (isset($_GET['id_laporan'])) {
    // Mengambil ID laporan dari URL
    $id_laporan = $_GET['id_laporan'];

    // Menyiapkan query untuk menghapus data
    $query = "DELETE FROM laporan WHERE id_laporan = ?";
    $stmt = mysqli_prepare($koneksi, $query);

    // Mengikat parameter
    mysqli_stmt_bind_param($stmt, 'i', $id_laporan);

    // Menjalankan query
    if (mysqli_stmt_execute($stmt)) {
        // Jika berhasil, redirect ke halaman laporan dengan parameter notifikasi
        header("Location: ../page_mahasiswa/index.php?message=hapus_berhasil");
        exit();
    } else {
        // Jika gagal, menampilkan pesan kesalahan
        echo "Error: " . mysqli_error($koneksi);
    }

    // Menutup pernyataan
    mysqli_stmt_close($stmt);
} else {
    // Jika tidak ada ID laporan, redirect atau tampilkan pesan kesalahan
    header("Location: ../page_mahasiswa/index.php?message=id_tidak_ditemukan");
    exit();
}

// Menutup koneksi database
mysqli_close($koneksi);
?>
