<?php
include './connection/koneksi.php';
?>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registrasi | Report Teknologi Informasi</title>
  <!-- Favicon -->
  <!-- <link rel="shortcut icon" href="./img/svg/logo.svg" type="image/x-icon"> -->
  <link rel="shortcut icon" href="./img/Logo_Polnes_2015-sekarang.png" type="image/x-icon">

  <!-- Custom styles -->
  <link rel="stylesheet" href="./css/style.min.css">
    <!-- SweetAlert CSS -->
<!-- SweetAlert JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



</head>

<body>
  <div class="layer"></div>
<main class="page-center">
  <article class="sign-up">
    <h1 class="sign-up__title">Selamat Datang !</h1>
    <p class="sign-up__subtitle">Silahkan Registrasi Menggunakan </p>
    <form class="sign-up-form form" action="./action/proses-regis-admin.php" method="POST">
      <label class="form-label-wrapper">
        <p class="form-label">NIP </p>
        <input class="form-input" type="text" name="nip" placeholder="Masukkan NIP" required  autocomplete="none">
      </label>
      <label class="form-label-wrapper">
        <p class="form-label">Nama </p>
        <input class="form-input" type="text" name="nama" placeholder="Masukkan nama" required  autocomplete="none">
      </label>
      <label class="form-label-wrapper">
        <p class="form-label">Email </p>
        <input class="form-input" type="email" name="email" placeholder="Masukkan Email" required  autocomplete="none">
      </label>
      <label class="form-label-wrapper">
        <p class="form-label">Password</p>
        <input class="form-input" type="password" name="password" placeholder="Masukkan Password" required autocomplete="none">
      </label>
      <label for="Registrasi">
        <p class="form-label"><a href="./page_admin/index.php">Login Disini</a></p>
      </label>
      <!-- <a class="link-info forget-link" href="##">Forgot your password?</a> -->
      <!-- <label class="form-checkbox-wrapper">
        <input class="form-checkbox" type="checkbox" required>
        <span class="form-checkbox-label">Remember me next time</span>
      </label> -->
      <br>
      <button class="form-btn primary-default-btn transparent-btn" name="registrasi" >Registrasi</button>
    </form>
  </article>
</main>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Chart library -->
<script src="./plugins/chart.min.js"></script>
<!-- Icons library -->
<script src="plugins/feather.min.js"></script>
<!-- Custom scripts -->
<script src="js/script.js"></script>
</body>

</html>