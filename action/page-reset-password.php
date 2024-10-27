<?php
// Aktifkan error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../connection/koneksi.php';

// Ambil NIM atau NIDN dari URL
$nim = isset($_GET['nim']) ? $_GET['nim'] : '';
$nidn = isset($_GET['nidn']) ? $_GET['nidn'] : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password | Report Teknologi Informasi</title>
    <link rel="shortcut icon" href="../img/Logo_Polnes_2015-sekarang.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/style.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="layer"></div>
    <main class="page-center">
        <article class="sign-up">
            <h1 class="sign-up__title">Halo !</h1>
            <p class="sign-up__subtitle">Reset Password Kamu </p>
            <form class="sign-up-form form" action="proses-reset-password.php?nim=<?php echo urlencode($nim); ?>&nidn=<?php echo urlencode($nidn); ?>" method="POST">
                <label class="form-label-wrapper">
                    <p class="form-label">NIM / NIDN</p>
                    <input class="form-input" type="text" name="username" value="<?php echo !empty($nim) ? $nim : $nidn; ?>" required readonly>
                </label>
                <label class="form-label-wrapper">
                    <p class="form-label">Password Baru</p>
                    <input class="form-input" type="password" name="passwordbaru" placeholder="Masukkan Password Baru" required>
                </label>
                <button class="form-btn primary-default-btn transparent-btn" type="submit" name="submit">Reset</button>
            </form>

        </article>
    </main>
</body>
</html>
