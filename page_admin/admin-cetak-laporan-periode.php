<?php
require '../vendor/autoload.php';
use Dompdf\Dompdf;

session_start(); // Pastikan session dimulai

// Cek apakah pengguna sudah login
if (!isset($_SESSION['noadmin'])) {
    header("Location: ../admin.php");
    exit();
}

// Koneksi ke database
include '../connection/koneksi.php';

$start_date = $_GET['start_date'];
$end_date = $_GET['end_date'];

// Ambil data laporan berdasarkan periode
$sql = "SELECT * FROM laporan WHERE status = 'done' AND tanggal_dibuat BETWEEN ? AND ?";
$stmt = $koneksi->prepare($sql);
$stmt->bind_param("ss", $start_date, $end_date);
$stmt->execute();
$result = $stmt->get_result();

$html = '<h1>Laporan Periode: ' . $start_date . ' sampai ' . $end_date . '</h1>';
$html .= '<table border="1" cellpadding="10" cellspacing="0">';
$html .= '<tr><th>ID Laporan</th><th>Nama Laporan</th><th>Tanggal Dibuat</th><th>Tanggal Selesai</th></tr>';

while ($row = $result->fetch_assoc()) {
    $html .= '<tr>';
    $html .= '<td>' . $row['id_laporan'] . '</td>';
    $html .= '<td>' . $row['nama_laporan'] . '</td>';
    $html .= '<td>' . $row['tanggal_dibuat'] . '</td>';
    $html .= '<td>' . $row['tanggal_selesai'] . '</td>';
    $html .= '</tr>';
}

$html .= '</table>';

$stmt->close();
$koneksi->close();

// Inisialisasi DOMPDF
$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
$dompdf->stream('Laporan_Period_' . $start_date . '_to_' . $end_date . '.pdf', array('Attachment' => 1));
?>
