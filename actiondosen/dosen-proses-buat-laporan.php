<?php
include '../connection/koneksi.php';

session_start();
if (!isset($_SESSION['nidn'])) {
    header("Location: ../index.php");
    exit();
}

// Koneksi ke database

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $jenis_laporan = $_POST['jenis_laporan'];
    $nama_laporan = $_POST['nama_laporan'];
    $deskripsi_laporan = $_POST['deskripsi_laporan'];
    $nidn = $_SESSION['nidn']; // Ambil id mahasiswa dari session
    $tipe_pengguna = 'Dosen'; // Set tipe pengguna sebagai 'mahasiswa'

    // Upload file dokumentasi (foto/video)
    if (isset($_FILES['dokumentasi']) && $_FILES['dokumentasi']['error'] == UPLOAD_ERR_OK) {
        $dokumentasi = $_FILES['dokumentasi']['name'];
        $target_dir = "../doc_laporan/";
        $target_file = $target_dir . basename($dokumentasi);
        $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowed_types = ['jpg', 'jpeg', 'png', 'mp4']; // Tipe file yang diperbolehkan

        // Validasi tipe file
        if (in_array($file_type, $allowed_types)) {
            // Pindahkan file ke folder uploads
            if (move_uploaded_file($_FILES['dokumentasi']['tmp_name'], $target_file)) {
                // Query untuk memasukkan data laporan
                $sql = "INSERT INTO laporan (jenis_laporan, nama_laporan, deskripsi_laporan, dokumentasi, nidn, tipe_pengguna, status) 
                        VALUES ('$jenis_laporan', '$nama_laporan', '$deskripsi_laporan', '$dokumentasi', '$nidn', '$tipe_pengguna', 'pending')";

                if (mysqli_query($koneksi, $sql)) {
                    // Redirect ke halaman laporan mahasiswa dengan pesan sukses
                    echo "<script>
                        alert('Laporan berhasil dibuat');
                        window.location.href = '../page_dosen/dosen_buat_laporan.php';
                    </script>";
                } else {
                    echo "Error: " . mysqli_error($koneksi);
                }
            } else {
                echo "Error: Gagal mengupload file.";
            }
        } else {
            echo "Error: Tipe file tidak diperbolehkan.";
        }
    } else {
        echo "Error: Harap upload file dokumentasi.";
    }
}
?>
