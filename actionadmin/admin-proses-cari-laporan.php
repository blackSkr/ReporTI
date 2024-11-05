<?php
// Koneksi ke database
include '../connection/koneksi.php';

if (isset($_GET['cari-laporan'])) {
    $keyword = $_GET['cari-laporan'];

    // Gunakan prepared statements untuk menghindari SQL injection
    $stmt = $koneksi->prepare("SELECT * FROM laporan WHERE id_laporan LIKE ? OR jenis_laporan LIKE ? OR nama_laporan LIKE ? OR nim LIKE ? OR nidn LIKE ? OR tanggal_dibuat LIKE ?");
    $searchTerm = "%{$keyword}%";
    $stmt->bind_param("ssssss", $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();

    // Tampilkan hasil pencarian dalam format HTML
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='result-item'>" . htmlspecialchars($row['nama_laporan']) . "</div>";
        }
    } else {
        echo "<div class='result-item'>Tidak ada hasil yang ditemukan</div>";
    }

    $stmt->close();
}
?>
