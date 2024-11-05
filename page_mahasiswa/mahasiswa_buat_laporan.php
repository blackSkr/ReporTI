
<?php
session_start(); // Pastikan session dimulai

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user_mhs'])) {
    // Jika belum login, arahkan ke halaman login
    header("Location: ../index.php");
    exit();
}
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
            <a href="/" class="logo-wrapper" title="Home">
                <span class="sr-only">Home</span>
                <span class="icon logo" aria-hidden="true"></span>
                <div class="logo-text">
                    <!-- <span class="logo-title">Dashboard</span> -->
                    <span class="logo-subtitle">Mahasiswa</span>
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
                    <a class="active" href="../page_mahasiswa"><span class="icon home" aria-hidden="true"></span>Dashboard</a>
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
                            <a href="./mahasiswa_buat_laporan.php">Buat Laporan</a>
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
      include'mahasiswa_navbar.php';
      ?>
    <!-- ! Main -->
    <main class="main users chart-page" id="skip-target">
        
      <div class="container">
        <h2 class="main-title">Form Laporan</h2>
        <form class="sign-up-form form" action="../actionmhs/mhs-proses-buat-laporan.php" method="POST" enctype="multipart/form-data">
          <label class="form-label-wrapper">
            <p class="form-label">Jenis Laporan</p>
            <select class="form-input" name="jenis_laporan" required>
                <option value="" disabled selected>Pilih Jenis Laporan</option>
                <option value="Kinerja Dosen">Kinerja Dosen</option>
                <option value="Pelaksanaan Mata Kuliah">Pelaksanaan Mata Kuliah</option>
                <option value="kesalahan Teknis">Kesalahan Teknis</option>
                <option value="Kerusakan Fasilitas">Kerusakan Fasilitas</option>
                <option value="Kekurangan Fasilitas">Kekurangan Fasilitas</option>
            </select>
          </label>

          <label class="form-label-wrapper">
            <p class="form-label">Nama Laporan</p>
            <input class="form-input" type="text" name="nama_laporan" placeholder="Masukkan Nama Laporan" required>
          </label>

          <label class="form-label-wrapper">
            <p class="form-label">Deskripsi Laporan</p>
            <input class="form-input" type="text" name="deskripsi_laporan" placeholder="Masukkan Deskripsi Laporan" required>
          </label>

          <label class="form-label-wrapper">
            <p class="form-label">Foto / Video</p>
            <input class="form-input" type="file" name="dokumentasi" accept=".jpg,.jpeg,.png,.mp4">
          </label>

          <button class="form-btn primary-default-btn transparent-btn" type="submit">Buat Laporan</button>
        </form>

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
 <!-- script sukses -->
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- Pastikan SweetAlert sudah dimuat -->
<script>
  // Cek jika ada parameter query string
  const urlParamslogin = new URLSearchParams(window.location.search);
  if (urlParamslogin.has('message')) {
    const message = urlParamslogin.get('message'); // Menggunakan urlParamslogin
    if (message === 'berhasil') {
      Swal.fire({
        icon: 'success',
        title: 'Berhasil Submit !',
        confirmButtonText: 'OK'
      }).then(() => {
        // Menghapus parameter query string dan reload halaman
        window.location.search = ''; // Menghapus parameter query
      });
    }
  }
</script>

<script>
  // Cek jika ada parameter query string
  const urlParams = new URLSearchParams(window.location.search);
  if (urlParams.has('message')) {
    const message = urlParams.get('message');
    if (message === 'tahunkosong') {
      Swal.fire({
        icon: 'error',
        title: 'Gagal Submit Laporan!',
        // text: 'Silahkan login menggunakan NIM dan Password Anda.',
        confirmButtonText: 'OK'
      });
    }
  }
</script>
<!-- Chart library -->
<script src="../plugins/chart.min.js"></script>
<!-- Icons library -->
<script src="../plugins/feather.min.js"></script>
<!-- Custom scripts -->
<script src="../js/script.js"></script>
</body>

</html>