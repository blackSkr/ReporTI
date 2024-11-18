

<?php
session_start(); // Pastikan session dimulai

// Cek apakah pengguna sudah login
if (!isset($_SESSION['noadmin'])) {
    // Jika belum login, arahkan ke halaman login
    header("Location: ../admin.php");
    exit();
}
include '../connection/koneksi.php';
$noadmin = $_SESSION['noadmin'];

// Query untuk mengambil data laporan
$sql = "SELECT * FROM laporan WHERE status = 'done'";
$result = mysqli_query($koneksi, $sql);

//query hitung data pending
$querypending = "SELECT COUNT(*) AS totalpending FROM laporan WHERE status = 'pending'";
$resultpending = mysqli_query($koneksi, $querypending); 
$rowpending = mysqli_fetch_assoc($resultpending);
$totalpending = $rowpending['totalpending'];

// Query untuk menghitung onprogress
$queryonprogress = "SELECT COUNT(*) AS totalprogress FROM laporan WHERE status = 'on progress'";
$resultonprogress = mysqli_query($koneksi, $queryonprogress);
$rowonprogress = mysqli_fetch_assoc($resultonprogress);
$totalprogress = $rowonprogress['totalprogress'];

// Query untuk menghitung laporan hari ini
$query_hari_ini = "SELECT COUNT(*) AS total_hari_ini FROM laporan WHERE DATE(tanggal_dibuat) = CURDATE()";
$result_hari_ini = mysqli_query($koneksi, $query_hari_ini);
$row_hari_ini = mysqli_fetch_assoc($result_hari_ini);
$total_hari_ini = $row_hari_ini['total_hari_ini'];

// Query untuk menghitung laporan History
$queryhistory = "SELECT COUNT(*) AS history FROM laporan WHERE status = 'done'";
$resulthistory = mysqli_query($koneksi, $queryhistory);
$rowhistory = mysqli_fetch_assoc($resulthistory);
$totalhistory = $rowhistory['history'];

// Query untuk menghitung laporan bulan ini
$query_bulan_ini = "SELECT COUNT(*) AS total_bulan_ini FROM laporan WHERE MONTH(tanggal_dibuat) = MONTH(CURDATE()) AND YEAR(tanggal_dibuat) = YEAR(CURDATE())";
$result_bulan_ini = mysqli_query($koneksi, $query_bulan_ini);
$row_bulan_ini = mysqli_fetch_assoc($result_bulan_ini);
$total_bulan_ini = $row_bulan_ini['total_bulan_ini'];
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
  <link rel="shortcut icon" href="../img/Logo_Polnes_2015-sekarang.png" type="image/x-icon">

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
                    <span class="logo-subtitle">Administrator</span>
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
                    <a class="active" href="./index.php"><span class="icon home" aria-hidden="true"></span>Dashboard</a>
                </li>
                <li>
                    <a class="show-cat-btn" href="./index.php">
                        <span class="icon document" aria-hidden="true"></span>Laporan
                        <span class="category__btn transparent-btn" title="Open list">
                            <span class="sr-only">Open list</span>
                            <span class="icon arrow-down" aria-hidden="true"></span>
                        </span>
                    </a>
                    <ul class="cat-sub-menu">
                        <li>
                            <a href="./admin-laporan-semua.php">Semua Laporan</a>
                            <a href="./admin-laporan-hari-ini.php">Laporan Hari ini</a>
                            <a href="./admin-laporan-pending.php">Laporan Pending</a>
                            <a href="./admin-laporan-progress.php">Laporan On Progress</a>
                            <a href="./admin-laporan-matkul.php">Laporan Mata Kuliah</a>
                            <a href="./admin-laporan-teknis.php">Laporan Kesalahan Teknis</a>
                            <a href="./admin-laporan-kerusakan-fasilitas.php">Laporan Kerusakan Fasilitas</a>
                            <a href="./admin-laporan-kekurangan-fasilitas.php">Laporan Kekurangan Fasilitas</a>
                            <a href="./admin-laporan-history.php">History Laporan</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a  href="./admin-laporan-cetak.php"><span class="icon document" aria-hidden="true"></span>Cetak Laporan</a>
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
  include'admin-navbar.php';
  ?>
  
    <!-- ! Main -->
    <main class="main users chart-page" id="skip-target">
      <div class="container">
        <h2 class="main-title">Halo <?php echo htmlspecialchars($_SESSION['namadmin']); ?> !</h2>
        <div class="row stat-cards">
          <div class="col-md-6 col-xl-3">
            <article class="stat-cards-item">
              <div class="stat-cards-icon primary">
                <i data-feather="bar-chart-2" aria-hidden="true"></i>
              </div>
              <div class="stat-cards-info">
                <p class="stat-cards-info__num"><?php echo $totalhistory; ?></p>
                <p class="stat-cards-info__title">History Laporan</p>
              </div>
            </article>
          </div>
          <div class="col-md-6 col-xl-3">
            <article class="stat-cards-item">
              <div class="stat-cards-icon primary">
                <i data-feather="bar-chart-2" aria-hidden="true"></i>
              </div>
              <div class="stat-cards-info">
                <p class="stat-cards-info__num"><?php echo $totalpending;?></p>
                <p class="stat-cards-info__title">Laporan Pending</p>
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
              <div class="stat-cards-icon primary">
                <i data-feather="bar-chart-2" aria-hidden="true"></i>
              </div>
              <div class="stat-cards-info">
                <p class="stat-cards-info__num"><?php echo $totalprogress;?></p>
                <p class="stat-cards-info__title">Laporan On Progress</p>
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
              <div class="stat-cards-icon primary">
                <i data-feather="bar-chart-2" aria-hidden="true"></i>
              </div>
              <div class="stat-cards-info">
                <p class="stat-cards-info__num"><?php echo $total_bulan_ini; ?></p>
                <p class="stat-cards-info__title">Laporan Bulan Ini</p>
                <!-- <p class="stat-cards-info__progress">
                  <span class="stat-cards-info__profit success">
                    <i data-feather="trending-up" aria-hidden="true"></i>4.07%
                  </span>
                  Last month
                </p> -->
              </div>
            </article>
          </div>
      </div>
        <!-- Tampil data -->
        <div class="row">
          <div class="col-lg-12">
            <div class="users-table table-wrapper">
              <table class="posts-table">
                <thead>
                <h4 class="main-title">Laporan Hari Ini</h4>
                  <tr class="users-table-info">
                    <th>
                      <label class="users-table__checkbox ms-20">
                        <input type="checkbox" class="check-all">Jenis Laporan
                      </label>
                    </th>
                    <th>Nama Laporan</th>
                    <!-- <th>Deskripsi Laporan</th> -->
                    <th>Dokumentasi </th>
                    <th>Pembuat </th>
                    <!-- <th>NIM / NIDN</th> -->
                    <!-- <th>Waktu Dibuat</th> -->
                    <th>Waktu Selesai</th>
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
                        // echo "<td>" . htmlspecialchars($row['deskripsi_laporan']) . "</td>";
                        $file_path = 'doc_laporan/' . htmlspecialchars($row['dokumentasi']);
                        // echo '<td><img src="doc_laporan/' . htmlspecialchars($row['dokumentasi']) . '" alt="Dokumentasi Laporan" style="width: 50px; height: 50px;"></td>';
                        // echo "<td>" . htmlspecialchars($row['dokumentasi']) . "</td>";
                        echo "<td><img src='../doc_laporan/" . htmlspecialchars($row['dokumentasi']) . "' alt='Gambar ' style='width: 50px; height: 50px;'></td>";

                        echo "<td>" . htmlspecialchars($row['tipe_pengguna']) . "</td>";
                        // Cek apakah NIM tersedia, jika tidak tampilkan NIDN
                        // echo "<td>" . (!empty($row['nim']) ? htmlspecialchars($row['nim']) : htmlspecialchars($row['nidn'])) . "</td>";
                        // echo "<td>" . htmlspecialchars($row['tanggal_dibuat']) . "</td>"; // Ganti dengan kolom waktu yang sesuai
                        // Cek apakah kolom tanggal_selesai NULL atau tidak, jika NULL tampilkan default "Belum selesai"
                        echo "<td>" . (!empty($row['tanggal_selesai']) ? htmlspecialchars($row['tanggal_selesai']) : "Belum selesai") . "</td>";

                        // echo "<td>" . htmlspecialchars($row['tanggal_selesai']) . "</td>"; // Ganti dengan kolom waktu yang sesuai
                        echo "<td><span class='badge-" . strtolower($row['status']) . "'>" . htmlspecialchars($row['status']) . "</span></td>";
                        echo "<td>
                                <span class='p-relative'>
                                    <button class='dropdown-btn transparent-btn' type='button' title='More info'>
                                        <div class='sr-only'>More info</div>
                                        <i data-feather='more-horizontal' aria-hidden='true'></i>
                                    </button>
                                    <ul class='users-item-dropdown dropdown'>
                                        <li><a href='admin-edit-laporan.php?id_laporan=" . $row['id_laporan'] . "' onclick='return confirm(\"Apakah Anda yakin ingin edit laporan ini?\")'>Edit</a></li>
                                        <li><a href='admin-cetak-pdf-laporan.php?id_laporan=" . $row['id_laporan'] . "' onclick='return confirm(\"Apakah Anda yakin ingin cetak laporan ini?\")'>Cetak</a></li>
                                        <li><a href='admin-detail-laporan.php?id_laporan=" . $row['id_laporan'] . "' onclick='return confirm(\"Cek detail laporan ini?\")'>Detail</a></li>
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