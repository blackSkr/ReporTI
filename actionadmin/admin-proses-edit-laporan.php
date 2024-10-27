<?php
// Memuat file autoload Composer untuk menggunakan PHPMailer
require '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Koneksi ke database
include '../connection/koneksi.php'; // Sesuaikan dengan file koneksi database Anda

// Cek apakah form sudah disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_laporan = $_POST['id_laporan'];
    $status = $_POST['status'];

    if (!empty($id_laporan) && !empty($status)) {
        // Jika status laporan menjadi "DONE"
        if ($status === 'Done') {
            // Update status laporan dan tanggal_selesai
            $tanggal_selesai = date('Y-m-d H:i:s');
            $query = "UPDATE laporan SET status = ?, tanggal_selesai = ? WHERE id_laporan = ?";
            $stmt = $koneksi->prepare($query);
            $stmt->bind_param("ssi", $status, $tanggal_selesai, $id_laporan);

            if ($stmt->execute()) {
                // Mengambil data pelapor dari database untuk mengirim email
                $query_pelapor = "SELECT tb_mahasiswa.nama, tb_mahasiswa.email, laporan.nama_laporan, laporan.jenis_laporan 
                                    FROM tb_mahasiswa
                                    JOIN laporan ON tb_mahasiswa.nim = laporan.nim
                                    WHERE laporan.id_laporan = ?
                                    ";
                $stmt_pelapor = $koneksi->prepare($query_pelapor);
                $stmt_pelapor->bind_param("i", $id_laporan);
                $stmt_pelapor->execute();
                $result = $stmt_pelapor->get_result();
                $row = $result->fetch_assoc();
                $email_pelapor = $row['email'];
                $nama_pelapor = $row['nama'];
                $nama_laporan = $row['nama_laporan'];
                $jenis_laporan = $row['jenis_laporan'];

                // Mengirim email menggunakan PHPMailer
                $mail = new PHPMailer(true);
                try {
                    // Pengaturan SMTP server
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com'; // Untuk Gmail // Ganti dengan SMTP server yang valid
                    $mail->SMTPAuth = true;
                    $mail->Username = 'reportti24@gmail.com'; // Ganti dengan email SMTP Anda
                    $mail->Password = 'vhav aqun lnka qssx'; // Ganti dengan password SMTP Anda
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port = 587;

                    // Pengaturan penerima dan pengirim
                    $mail->setFrom('reportti24@gmail.com', 'Admin Report System');
                    $mail->addAddress($email_pelapor); // Email pelapor

                    // Konten email
                    $mail->isHTML(true);
                    $mail->Subject = 'Laporan Anda Selesai';
                    $mail->Body    = '<h1>Hai ' . $nama_pelapor . ',</h1>
                                      <p>Laporan tentang <strong>' . $jenis_laporan . '</strong> yang telah kamu laporkan dengan keluhan <strong>' . $nama_laporan . '</strong> telah diproses dan sekarang telah selesai.</p>
                                      <p>Jangan sungkan untuk melaporkan keluhan lain ke pihak jurusan ya!</p>
                                      <p>Laporan kamu menjadi feedback bagi kita untuk kenyamanan bersama </p>
                                      <p>Terima kasih telah menggunakan Report System Teknologi Informasi.</p>
                                      <p>Salam,<br>Kelompok 1 TI 3E</p>';

                    // Mengirim email
                    $mail->send();
                    header('Location: ../page_admin/index.php');
                    // echo 'Status laporan diperbarui dan email terkirim ke pelapor.';
                } catch (Exception $e) {
                    // Jika email gagal dikirim
                    echo "Email gagal dikirim. Error: {$mail->ErrorInfo}. <br/>Namun, status laporan tetap diperbarui.";
                    header("Location: ../page_admin/index.php");
                }
            } else {
                echo 'Terjadi kesalahan saat memperbarui status laporan.';
            }
        } else {
            // Jika status bukan "DONE", hanya update status
            $query = "UPDATE laporan SET status = ? WHERE id_laporan = ?";
            $stmt = $koneksi->prepare($query);
            $stmt->bind_param("si", $status, $id_laporan);
            if ($stmt->execute()) {
                header('Location: ../page_admin/index.php');
            } else {
                echo 'Terjadi kesalahan saat memperbarui status laporan.';
            }
        }

        $stmt->close();
    } else {
        echo 'Harap lengkapi data.';
    }
}

$koneksi->close();
?>
