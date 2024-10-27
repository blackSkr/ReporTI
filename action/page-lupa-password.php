<?php
include '../connection/koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lupa Password | Report Teknologi Informasi</title>
  <!-- Favicon -->
  <!-- <link rel="shortcut icon" href="./img/svg/logo.svg" type="image/x-icon"> -->
  <link rel="shortcut icon" href="../img/Logo_Polnes_2015-sekarang.png" type="image/x-icon">

  <!-- Custom styles -->
  <link rel="stylesheet" href="../css/style.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- SweetAlert CSS -->
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css"> -->
  <!-- SweetAlert JS -->
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script> -->


</head>

<body>
  <div class="layer"></div>
  <main class="page-center">
    <article class="sign-up">
      <h1 class="sign-up__title">Halo !</h1>
      <p class="sign-up__subtitle">Cari Akun kamu </p>
      <form class="sign-up-form form" action="proses-cari-akun.php" method="POST">
        <label class="form-label-wrapper">
            <p class="form-label">NIM / NIDN</p>
            <input class="form-input" type="text" name="username" placeholder="Masukkan NIM / NIDN" required autocomplete="none">
        </label>
        <br>
        <button class="form-btn primary-default-btn transparent-btn" type="submit" name="submit">Cari</button>
        </form>

    </article>
  </main>
  <!-- Chart library -->
  <script src="../plugins/chart.min.js"></script>
  <!-- Icons library -->
  <script src="../plugins/feather.min.js"></script>
  <!-- Custom scripts -->
  <script src="../js/script.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



</body>

</html>
