<?php
// Koneksi ke database
include '../connection/koneksi.php';

// Cek apakah id_laporan dikirim melalui URL
if (isset($_GET['id_laporan'])) {
    $id_laporan = $_GET['id_laporan'];

    // Query untuk mendapatkan data laporan berdasarkan id_laporan
    $query = "SELECT * FROM laporan WHERE id_laporan = '$id_laporan'";
    $result = mysqli_query($koneksi, $query);

    // Cek apakah data ditemukan
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Load autoloader DOMPDF tanpa composer
        require_once '../vendor/autoload.php';  // Path ke vendor dari folder page_admin

        // Inisialisasi DOMPDF
        $dompdf = new Dompdf\Dompdf();

        // Cek apakah NIM atau NIDN ada, dan tampilkan sesuai dengan data yang ada
        $pelapor = !empty($row['nim']) ? $row['nim'] : (!empty($row['nidn']) ? $row['nidn'] : 'Tidak ada NIM atau NIDN');

        // Konten HTML untuk PDF
        $html = "
        <h1>Laporan Detail</h1>
        <table border='1' cellpadding='10' cellspacing='0'>
            <tr>
                <th>ID Laporan</th>
                <td>{$row['id_laporan']}</td>
            </tr>
            <tr>
                <th>Jenis Laporan</th>
                <td>{$row['jenis_laporan']}</td>
            </tr>
            <tr>
                <th>Pelapor</th>
                <td>{$pelapor}</td>
            </tr>
            <tr>
                <th>Nama Laporan</th>
                <td>{$row['nama_laporan']}</td>
            </tr>
            <tr>
                <th>Deskripsi</th>
                <td>{$row['deskripsi_laporan']}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>{$row['status']}</td>
            </tr>
        </table>
        ";


        // Load konten HTML ke DOMPDF
        $dompdf->loadHtml($html);

        // Atur ukuran kertas dan orientasi
        $dompdf->setPaper('A4', 'portrait');

        // Render HTML menjadi PDF
        $dompdf->render();

        // Output file PDF ke browser
        $dompdf->stream("laporan_{$id_laporan}.pdf", array("Attachment" => 0));
    } else {
        echo "Laporan tidak ditemukan.";
    }
} else {
    echo "ID laporan tidak ditemukan.";
}
?>
