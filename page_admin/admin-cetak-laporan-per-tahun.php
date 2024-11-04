<?php
// Koneksi ke database
include '../connection/koneksi.php';

// Menggunakan Dompdf
require '../vendor/autoload.php';

use Dompdf\Dompdf;

// Mendapatkan input dari form
$tahun = $_GET['year'] ?? '';

// Validasi input
if (empty($tahun)) {
    die('Tahun harus dipilih.');
}

// Menghitung tanggal mulai dan akhir berdasarkan tahun
$tanggal_awal = "$tahun-01-01";
$tanggal_akhir = "$tahun-12-31";

// Query untuk mendapatkan data laporan berdasarkan tahun
$query = "SELECT * FROM laporan WHERE tanggal_dibuat BETWEEN ? AND ?";
$stmt = $koneksi->prepare($query);
$stmt->bind_param("ss", $tanggal_awal, $tanggal_akhir);
$stmt->execute();
$result = $stmt->get_result();

// Membuat konten HTML untuk PDF
$html = "<h1>Laporan Tahun: $tahun</h1>";
$html .= "<table border='1' cellpadding='5' cellspacing='0'>
            <thead>
                <tr>
                    <th>Nomor Laporan</th>
                    <th>Jenis Laporan</th>
                    <th>Deskripsi Laporan</th>
                    <th>Pembuat Laporan</th>
                    <th>Dokumentasi Laporan</th>
                    <th>Tanggal Dibuat</th>
                    <th>Tanggal Selesai</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>";

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Jika 'dokumentasi' berisi link, tambahkan elemen <a>
        $dokumentasiLink = "<a href='{$row['dokumentasi']}' target='_blank'>Lihat Dokumentasi</a>";
        
        $html .= "<tr>
                    <td>{$row['id_laporan']}</td>
                    <td>{$row['jenis_laporan']}</td>
                    <td>{$row['deskripsi_laporan']}</td>
                    <td>{$row['tipe_pengguna']}</td>
                    <td>$dokumentasiLink</td>
                    <td>{$row['tanggal_dibuat']}</td>
                    <td>{$row['tanggal_selesai']}</td>
                    <td>{$row['status']}</td>
                  </tr>";
    }
} else {
    $html .= "<tr><td colspan='8'>Tidak ada laporan ditemukan untuk tahun tersebut.</td></tr>";
}
$html .= "</tbody></table>";

// Inisialisasi Dompdf
$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
$dompdf->stream("laporan_tahun.pdf", ["Attachment" => true]);

// Tutup koneksi
$stmt->close();
$koneksi->close();
?>
