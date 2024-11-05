
<?php
session_start(); // Pastikan session dimulai

// Cek apakah pengguna sudah login
if (!isset($_SESSION['nidn'])) {
    // Jika belum login, arahkan ke halaman login
    header("Location: ../index.php");
    exit();
}
include '../connection/koneksi.php';
$nidn = $_SESSION['nidn'];

// Query untuk mengambil data laporan
$sql = "SELECT * FROM laporan WHERE nidn  = '$nidn'";
$result = mysqli_query($koneksi, $sql);

// Hitung jumlah laporan
$queryJumlahLaporan = "SELECT COUNT(*) AS total FROM laporan WHERE nidn = '$nidn' AND status = 'pending'";
$resultJumlahLaporan = mysqli_query($koneksi, $queryJumlahLaporan);
$dataJumlahLaporan = mysqli_fetch_assoc($resultJumlahLaporan);
$totalLaporan = $dataJumlahLaporan['total'];

// Hitung jumlah laporan yang dipenuhi
$queryJumlahLaporanDipenuhi = "SELECT COUNT(*) AS total FROM laporan WHERE status = 'done' AND  nidn = '$nidn'";
$resultJumlahLaporanDipenuhi = mysqli_query($koneksi, $queryJumlahLaporanDipenuhi);
$dataJumlahLaporanDipenuhi = mysqli_fetch_assoc($resultJumlahLaporanDipenuhi);
$totalLaporanDipenuhi = $dataJumlahLaporanDipenuhi['total'];

// total semua laporan
$totalsemualaporan = $totalLaporan + $totalLaporanDipenuhi;
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Report Page Teknologi Informasi</title>
  <!-- Favicon -->
  <!-- <link rel="shortcut icon" href="../img/svg/logo.svg" type="image/x-icon"> -->
  <link rel="shortcut icon" href="./img/Logo_Polnes_2015-sekarang.png" type="image/x-icon">

  <!-- Custom styles -->
  <link rel="stylesheet" href="../css/style.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
  <div class="layer"></div>
<!-- ! Body -->
<a class="skip-link sr-only" href="#skip-target">Skip to content</a>
<div class="page-flex">
  <!-- ! Sidebar -->
  <aside class="sidebar">
    <div class="sidebar-start">
        <div class="sidebar-head">
            <a href="" class="logo-wrapper" title="Home">
                <span class="sr-only">Home</span>
                <span class="icon logo" aria-hidden="true"></span>
                <div class="logo-text">
                    <!-- <span class="logo-title">Dashboard</span> -->
                    <span class="logo-subtitle">Dosen</span>
                </div>

            </a>
            <button class="sidebar-toggle transparent-btn" title="Menu" type="button">
                <span class="sr-only">Toggle menu</span>
                <span class="icon menu-toggle" aria-hidden="true"></span>
            </button>
        </div>
        <div class="sidebar-body">
            <ul class="sidebar-body-menu">
                <li>
                    <a class="active" href=""><span class="icon home" aria-hidden="true"></span>Dashboard</a>
                </li>
                <li>
                    <a class="show-cat-btn" href="##">
                        <span class="icon document" aria-hidden="true"></span>Laporan
                        <span class="category__btn transparent-btn" title="Open list">
                            <span class="sr-only">Open list</span>
                            <span class="icon arrow-down" aria-hidden="true"></span>
                        </span>
                    </a>
                    <ul class="cat-sub-menu">
                        <li>
                            <a href="./dosen_buat_laporan.php">Buat Laporan</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <div class="sidebar-footer">
        <a href="##" class="sidebar-user"> 
            <div class="sidebar-user-info">
    <!-- <span class="sidebar-user__title">Nafisa Sh.</span> -->
            <!-- <span class="sidebar-user__subtitle">Support manager</span> -->
            <span id="realtime-clock" class="sidebar-user__clock" style="color: #ffffff"></span> <!-- Elemen untuk jam -->
        </div>
        </a>
    </div>
</aside>

  <?php
  include'dosen_navbar.php';
  ?>
    <!-- ! Main -->
<main class="page">
  <br>
  <br>
  <div class="container">
  <article class="sign-up">
    <form class="sign-up-form form" action="./action/proses-regis-mhs.php" method="POST">
      <label class="form-label-wrapper">
        <p class="form-label">NIDN </p>
        <input class="form-input" type="text" name="nidn" placeholder= "<?php echo htmlspecialchars($_SESSION['nidn']); ?> " readonly required  autocomplete="none">
      </label>
      <label class="form-label-wrapper">
        <p class="form-label">Nama </p>
        <!-- <p class="form-input"><?php echo htmlspecialchars($_SESSION['user_mhs']); ?></p> -->
        <input class="form-input" type="text" name="nama" placeholder="<?php echo htmlspecialchars($_SESSION['user_dosen']); ?> " readonly required  autocomplete="none">
      </label>
      <label class="form-label-wrapper">
        <p class="form-label">Email </p>
        <input class="form-input" type="email" name="email" placeholder="<?php echo isset($_SESSION['email_dosen']) ? htmlspecialchars($_SESSION['email_dosen']) : ''; ?>" readonly required  autocomplete="none">
      </label>
      <label class="form-label-wrapper">
        <p class="form-label">Total Laporan Kamu   </p>
        <input class="form-input" type="email" name="email" placeholder="<?php echo $totalsemualaporan?>" readonly required  autocomplete="none">
      </label>
      <!-- <label class="form-label-wrapper"> -->
        <!-- <p class="form-label">Password</p> -->
        <!-- <p class="form-label" style="color: blue;"><a href="index.php">Reset Password Disini</a></p> -->
        <!-- <input class="form-input" type="password" name="password" placeholder="<?php echo isset($_SESSION['password']) ? htmlspecialchars($_SESSION['password']) : ''; ?>" readonly Password" required autocomplete="none"> -->
      <!-- </label> -->
      <!-- <label for="Registrasi">
        <p class="form-label"><a href="index.php">Login Disini</a></p>
      </label> -->
      <!-- <a class="link-info forget-link" href="##">Forgot your password?</a> -->
      <!-- <label class="form-checkbox-wrapper">
        <input class="form-checkbox" type="checkbox" required>
        <span class="form-checkbox-label">Remember me next time</span>
      </label> -->
      <br>
      <!-- <button class="form-btn primary-default-btn transparent-btn" name="registrasi" >Registrasi</button> -->
    </form>
  </article>
  </div>
</main>
    <!-- ! Footer -->
    <footer class="footer">
  <div class="container footer--flex">
    <div class="footer-start">
      <p>2024 © Kelompok 1</p>
    </div>
    <!-- <ul class="footer-end">
      <li><a href="##">About</a></li>
      <li><a href="##">Support</a></li>
      <li><a href="##">Puchase</a></li>
    </ul> -->
  </div>
</footer>
  </div>
</div>
<!-- script jam -->
<script>
    function updateClock() {
        var now = new Date(); // Ambil waktu saat ini
        var hours = now.getHours(); // Ambil jam
        var minutes = now.getMinutes(); // Ambil menit
        var seconds = now.getSeconds(); // Ambil detik

        // Tambahkan angka nol di depan jika kurang dari 10
        hours = hours < 10 ? '0' + hours : hours;
        minutes = minutes < 10 ? '0' + minutes : minutes;
        seconds = seconds < 10 ? '0' + seconds : seconds;

        // Gabungkan menjadi format HH:MM:SS
        var timeString = hours + ':' + minutes + ':' + seconds;

        // Tampilkan waktu di elemen dengan id 'realtime-clock'
        document.getElementById('realtime-clock').textContent = timeString;
    }

    // Perbarui jam setiap 1 detik
    setInterval(updateClock, 1000);

    // Panggil fungsi saat halaman dimuat pertama kali
    updateClock();
</script>
<!-- script jam -->

<!-- Chart library -->
<script src="../plugins/chart.min.js"></script>
<!-- Icons library -->
<script src="../plugins/feather.min.js"></script>
<!-- Custom scripts -->
<script src="../js/script.js"></script>
</body>

</html>