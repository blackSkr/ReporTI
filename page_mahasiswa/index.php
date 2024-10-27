
<?php
session_start(); // Pastikan session dimulai

// Cek apakah pengguna sudah login
if (!isset($_SESSION['nim'])) {
    // Jika belum login, arahkan ke halaman login
    header("Location: ../index.php");
    exit();
}
include '../connection/koneksi.php';
$nim = $_SESSION['nim'];

// Query untuk mengambil data laporan
$sql = "SELECT * FROM laporan WHERE nim  = '$nim'";
$result = mysqli_query($koneksi, $sql);

// Hitung jumlah laporan
$queryJumlahLaporan = "SELECT COUNT(*) AS total FROM laporan WHERE nim = '$nim' AND status = 'pending'";
$resultJumlahLaporan = mysqli_query($koneksi, $queryJumlahLaporan);
$dataJumlahLaporan = mysqli_fetch_assoc($resultJumlahLaporan);
$totalLaporan = $dataJumlahLaporan['total'];

// Hitung jumlah laporan yang dipenuhi
$queryJumlahLaporanDipenuhi = "SELECT COUNT(*) AS total FROM laporan WHERE status = 'done' AND  nim = '$nim'";
$resultJumlahLaporanDipenuhi = mysqli_query($koneksi, $queryJumlahLaporanDipenuhi);
$dataJumlahLaporanDipenuhi = mysqli_fetch_assoc($resultJumlahLaporanDipenuhi);
$totalLaporanDipenuhi = $dataJumlahLaporanDipenuhi['total'];
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
  <div class="main-wrapper">
    <!-- ! Main nav -->
    <nav class="main-nav--bg">
  <div class="container main-nav">
    <div class="main-nav-start">
      <div class="search-wrapper">
        <!-- <i data-feather="search" aria-hidden="true"></i> -->
        <!-- <input type="text" placeholder="Enter keywords ..." required> -->
      </div>
    </div>
    <div class="main-nav-end">
      <button class="sidebar-toggle transparent-btn" title="Menu" type="button">
        <span class="sr-only">Toggle menu</span>
        <span class="icon menu-toggle--gray" aria-hidden="true"></span>
      </button>
      <div class="lang-switcher-wrapper">

      </div>
      <button class="theme-switcher gray-circle-btn" type="button" title="Switch theme">
        <span class="sr-only">Switch theme</span>
        <i class="sun-icon" data-feather="sun" aria-hidden="true"></i>
        <i class="moon-icon" data-feather="moon" aria-hidden="true"></i>
      </button>

      <div class="nav-user-wrapper">
        <button href="##" class="nav-user-btn dropdown-btn" title="My profile" type="button">
          <span class="sr-only">My profile</span>
          <span class="nav-user-img">
            <picture><source srcset="../img/avatar/avatar-illustrated-02.webp" type="image/webp"><img src="./img/avatar/avatar-illustrated-02.png" alt="User name"></picture>
          </span>
        </button>
        <ul class="users-item-dropdown nav-user-dropdown dropdown">
          <li><a class="danger" href="../action/proses-logout.php">
              <i data-feather="log-out" aria-hidden="true"></i>
              <span>Log out</span>
            </a></li>
        </ul>
      </div>
    </div>
  </div>
</nav>
    <!-- ! Main -->
    <main class="main users chart-page" id="skip-target">
      <div class="container">
        <h2 class="main-title">Selamat Datang  <?php echo htmlspecialchars($_SESSION['user_mhs']); ?>!</h2>
        <!-- hitung data -->
        <div class="row stat-cards">
          <div class="col-md-6 col-xl-3">
            <article class="stat-cards-item">
        <!-- hitung data -->
              <div class="stat-cards-icon primary">
                <i data-feather="bar-chart-2" aria-hidden="true"></i>
              </div>
              <div class="stat-cards-info">
                <p class="stat-cards-info__num"><?php echo $totalLaporan; ?></p>
                <p class="stat-cards-info__title">laporan</p>
                <!-- <p class="stat-cards-info__progress">
                  <span class="stat-cards-info__profit success">
                    <i data-feather="trending-up" aria-hidden="true"></i>4.07%
                  </span>
                  Last month
                </p> -->
              </div>
            </article>
          </div>
          <div class="col-md-6 col-xl-3">
            <article class="stat-cards-item">
              <div class="stat-cards-icon success">
                <i data-feather="feather" aria-hidden="true"></i>
              </div>
              <div class="stat-cards-info">
                <p class="stat-cards-info__num"><?php echo $totalLaporanDipenuhi; ?></p>
                <p class="stat-cards-info__title">Laporan di penuhi</p>
                <!-- <p class="stat-cards-info__progress">
                  <span class="stat-cards-info__profit warning">
                    <i data-feather="trending-up" aria-hidden="true"></i>0.00%
                  </span>
                  Last month
                </p> -->
              </div>
            </article>
          </div>
        <!-- hitung data -->
        </div>
        <!-- Tampil data -->
        <div class="row">
          <div class="col-lg-12">
            <div class="users-table table-wrapper">
              <table class="posts-table">
                <thead>
                  <tr class="users-table-info">
                    <th>
                      <label class="users-table__checkbox ms-20">
                        <input type="checkbox" class="check-all">Jenis Laporan
                      </label>
                    </th>
                    <th>Nama Laporan</th>
                    <th>Waktu </th>
                    <th>Status</th>
                    <th>Tindakan</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                // Cek jika ada data laporan
                if (mysqli_num_rows($result) > 0) {
                    // Tampilkan data laporan
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['jenis_laporan']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['nama_laporan']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['tanggal_dibuat']) . "</td>"; // Ganti dengan kolom waktu yang sesuai
                        echo "<td><span class='badge-" . strtolower($row['status']) . "'>" . htmlspecialchars($row['status']) . "</span></td>";
                        echo "<td>
                                <span class='p-relative'>
                                    <button class='dropdown-btn transparent-btn' type='button' title='More info'>
                                        <div class='sr-only'>More info</div>
                                        <i data-feather='more-horizontal' aria-hidden='true'></i>
                                    </button>
                                    <ul class='users-item-dropdown dropdown'>
                                        <li><a href='../actionmhs/mhs-proses-hapus-laporan.php?id_laporan=" . $row['id_laporan'] . "' onclick='return confirm(\"Apakah Anda yakin ingin menghapus laporan ini?\")'>Hapus</a></li>
                                    </ul>
                                </span>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Tidak ada laporan yang ditemukan.</td></tr>";
                }
                ?>

                  </tbody>
              </table>
            </div>
          </div>
        </div>
        <!-- Tampil data -->

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