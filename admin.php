<?php
include './connection/koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login | Admin Report Teknologi Informasi</title>
  <!-- Favicon -->
  <!-- <link rel="shortcut icon" href="./img/svg/logo.svg" type="image/x-icon"> -->
  <!-- Custom styles -->
  <link rel="stylesheet" href="./css/style.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="shortcut icon" href="./img/Logo_Polnes_2015-sekarang.png" type="image/x-icon">

  <!-- SweetAlert CSS -->
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css"> -->
  <!-- SweetAlert JS -->
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script> -->


</head>

<body>
  <div class="layer"></div>
  <main class="page-center">
    <article class="sign-up">
      <h1 class="sign-up__title">Halo Admin !</h1>
      <p class="sign-up__subtitle">Silahkan Login Menggunakan </p>


      <!-- form untuk login dengan nomor admin dan password -->
      <form class="sign-up-form form" action="./actionadmin/admin-proses-login.php" method="POST">
        <label class="form-label-wrapper">
          <p class="form-label">Nomor Admin</p>
          <input class="form-input" type="text" name="useradmin" placeholder="Masukkan Nomor Admin" required autocomplete="none">
        </label>
        <label class="form-label-wrapper">
          <p class="form-label">Password</p>
          <input class="form-input" type="password" name="password" placeholder="Masukkan Password" required autocomplete="none">
        </label>
        <!-- <label for="Registrasi">
          <p class="form-label"><a href="registrasimhs.php">Registrasi Disini</a></p>
        </label> -->
        <br>
        <button class="form-btn primary-default-btn transparent-btn" name="Login">Login</button>
      </form>
      <!-- form untuk login dengan nomor admin dan password -->



    </article>
  </main>
  <!-- Chart library -->
  <script src="./plugins/chart.min.js"></script>
  <!-- Icons library -->
  <script src="plugins/feather.min.js"></script>
  <!-- Custom scripts -->
  <script src="js/script.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
  // Cek jika ada parameter query string
  const urlParams = new URLSearchParams(window.location.search);
  if (urlParams.has('message')) {
    const message = urlParams.get('message');
    if (message === 'registrasi_berhasil') {
      Swal.fire({
        icon: 'success',
        title: 'Registrasi Berhasil!',
        text: 'Silahkan login menggunakan NIM dan Password Anda.',
        confirmButtonText: 'OK'
      });
    }
  }
</script>


</body>

</html>
