<?php
require '../vendor/autoload.php'; // Pastikan jalur ini sesuai dengan lokasi vendor DOMPDF Anda
use Dompdf\Dompdf;

session_start(); // Pastikan session dimulai

// Cek apakah pengguna sudah login
if (!isset($_SESSION['noadmin'])) {
    header("Location: ../admin.php");
    exit();
}

// Koneksi ke database
include '../connection/koneksi.php';

$semester = $_POST['semester'];

// Ambil tahun saat ini
$tahun = date("Y");

// Tentukan rentang tanggal berdasarkan semester yang dipilih
if ($semester == '1') {
    // Semester 1: Januari hingga Juni
    $tanggal_awal = $tahun . '-01-01';
    $tanggal_akhir = $tahun . '-06-30';
} elseif ($semester == '2') {
    // Semester 2: Juli hingga Desember
    $tanggal_awal = $tahun . '-07-01';
    $tanggal_akhir = $tahun . '-12-31';
} else {
    echo "Semester tidak valid.";
    exit();
}

// Ambil data laporan berdasarkan rentang tanggal
$sql = "SELECT * FROM laporan WHERE status = 'done' AND tanggal_dibuat BETWEEN ? AND ?";
$stmt = $koneksi->prepare($sql);
$stmt->bind_param("ss", $tanggal_awal, $tanggal_akhir);
$stmt->execute();
$result = $stmt->get_result();

$html = '<h1>Laporan Semester: ' . ($semester == '1' ? '1' : '2') . ' Tahun ' . $tahun . '</h1>';
$html .= '<table border="1" cellpadding="10" cellspacing="0">';
$html .= '<tr><th>ID Laporan</th><th>Nama Laporan</th><th>Tanggal Dibuat</th><th>Tanggal Selesai</th></tr>';

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $html .= '<tr>';
        $html .= '<td>' . $row['id_laporan'] . '</td>';
        $html .= '<td>' . $row['nama_laporan'] . '</td>';
        $html .= '<td>' . $row['tanggal_dibuat'] . '</td>';
        $html .= '<td>' . $row['tanggal_selesai'] . '</td>';
        $html .= '</tr>';
    }
} else {
    $html .= '<tr><td colspan="4">Tidak ada laporan yang ditemukan untuk semester ini.</td></tr>';
}

$html .= '</table>';

$stmt->close();
$koneksi->close();

// Inisialisasi DOMPDF
$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape'); // Ukuran kertas A4, orientasi landscape
$dompdf->render();
$dompdf->stream('Laporan_Semester_' . ($semester == '1' ? '1' : '2') . '_' . $tahun . '.pdf', array('Attachment' => 1));
?>
