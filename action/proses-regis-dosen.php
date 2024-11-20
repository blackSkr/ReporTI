<?php
// Memasukkan file koneksi database
include '../connection/koneksi.php';

// Mengecek jika tombol registrasi ditekan
if (isset($_POST['registrasi'])) {
    // Mengambil data dari form
    $nidn = $_POST['nidn'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Hash password untuk keamanan
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Memeriksa apakah NIDN sudah ada
    $check_query = "SELECT * FROM tb_dosen WHERE nidn = ?";
    $check_stmt = mysqli_prepare($koneksi, $check_query);
    mysqli_stmt_bind_param($check_stmt, 's', $nidn);
    mysqli_stmt_execute($check_stmt);
    mysqli_stmt_store_result($check_stmt);

    // Jika NIDN sudah ada, tampilkan pesan error
    if (mysqli_stmt_num_rows($check_stmt) > 0) {
        echo "<script>
            alert('NIDN sudah terdaftar. Silakan gunakan NIDN lain.');
            window.location.href = '../registrasidosen.php'; // Atau halaman yang sesuai
        </script>";
        exit();
    }

    // Menyiapkan query untuk memasukkan data
    $query = "INSERT INTO tb_dosen (nidn, nama, email, password) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($koneksi, $query);

    // Mengikat parameter
    mysqli_stmt_bind_param($stmt, 'ssss', $nidn, $nama, $email, $hashed_password);

    // Menjalankan query
    if (mysqli_stmt_execute($stmt)) {
        // Jika berhasil, redirect ke halaman login dengan parameter notifikasi
        header("Location: ../index.php?message=registrasi_berhasil");
        exit();
    } else {
        // Jika gagal, menampilkan pesan kesalahan
        echo "Error: " . mysqli_error($koneksi);
    }

    // Menutup pernyataan dan koneksi
    mysqli_stmt_close($stmt);
    mysqli_stmt_close($check_stmt);
}

// Menutup koneksi database
mysqli_close($koneksi);
?>
