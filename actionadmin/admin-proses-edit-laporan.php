<?php
// Memuat file autoload Composer untuk menggunakan PHPMailer
require '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Koneksi ke database
include '../connection/koneksi.php'; // Sesuaikan dengan file koneksi database Anda

// Fungsi untuk mengirim email

function sendEmail($email, $nama_pelapor, $jenis_laporan, $nama_laporan) {
    $mail = new PHPMailer(true);
    try {
        $mail->SMTPDebug = 2; // Mengaktifkan debug output
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'reportti24@gmail.com';
        $mail->Password = 'ribh qebh ywti coqy'; // Ganti dengan App Password Anda
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // $mail->SMPTDebug = true; 


        $mail->setFrom('reportti24@gmail.com', 'Admin Report System');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = 'Laporan kamu sudah ditinjau nih';
        $mail->Body = '<h1>Hai ' . htmlspecialchars($nama_pelapor) . ',</h1>
                       <p>Laporan tentang <strong>' . htmlspecialchars($jenis_laporan) . '</strong> yang telah kamu laporkan dengan keluhan <strong>' . htmlspecialchars($nama_laporan) . '</strong> telah diproses dan sekarang telah selesai.</p>
                       <p>Terima kasih telah menggunakan Report System Teknologi Informasi.</p>'
                       .'<p>Salam Hangat, ©Pams</p>';

        $mail->send();
        return true;
    } catch (Exception $e) {
        echo "Email gagal dikirim. Error: {$mail->ErrorInfo}. <br/>";
        return false;
    }
}

// Cek apakah form sudah disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_laporan = $_POST['id_laporan'] ?? null;
    $status = $_POST['status'] ?? null;

    if (!empty($id_laporan) && !empty($status)) {
        // Jika status laporan menjadi "DONE"
        if ($status === 'Done') {
            // Mengatur zona waktu ke WITA
            date_default_timezone_set('Asia/Makassar'); // WITA

            // Update status laporan dan tanggal_selesai
            $tanggal_selesai = date('Y-m-d H:i:s'); // Mengambil waktu saat ini dalam format Y-m-d H:i:s
            $query = "UPDATE laporan SET status = ?, tanggal_selesai = ? WHERE id_laporan = ?";
            $stmt = $koneksi->prepare($query);
            $stmt->bind_param("ssi", $status, $tanggal_selesai, $id_laporan);

            if ($stmt->execute()) {
                // Mengambil data pelapor dari database untuk mengirim email
                $query_pelapor = "SELECT tb_mahasiswa.nama, tb_mahasiswa.email, laporan.nama_laporan, laporan.jenis_laporan 
                                  FROM tb_mahasiswa
                                  JOIN laporan ON tb_mahasiswa.nim = laporan.nim
                                  WHERE laporan.id_laporan = ?";
                $stmt_pelapor = $koneksi->prepare($query_pelapor);
                $stmt_pelapor->bind_param("i", $id_laporan);
                $stmt_pelapor->execute();
                $result = $stmt_pelapor->get_result();
                $row = $result->fetch_assoc();

                if ($row) {
                    $email_pelapor = $row['email'];
                    $nama_pelapor = $row['nama'];
                    $nama_laporan = $row['nama_laporan'];
                    $jenis_laporan = $row['jenis_laporan'];

                    // Mengirim email
                    if (sendEmail($email_pelapor, $nama_pelapor, $jenis_laporan, $nama_laporan)) {
                        header('Location: ../page_admin/index.php');
                        exit;
                    }
                } else {
                    echo 'Data pelapor tidak ditemukan.';
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
                exit;
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
