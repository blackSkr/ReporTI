

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

// Query untuk mengambil data tanggal_dibuat dan tanggal_selesai dari tb_laporan
$query = "SELECT tanggal_dibuat, tanggal_selesai FROM laporan ORDER BY tanggal_dibuat DESC";
$result = mysqli_query($koneksi, $query);

// Array untuk menampung tahun dan semester
$semesters = [];

// Loop untuk memproses hasil query
while ($row = mysqli_fetch_assoc($result)) {
    // Cek apakah tanggal_dibuat dan tanggal_selesai tidak null
    $start_date = isset($row['tanggal_dibuat']) ? new DateTime($row['tanggal_dibuat']) : null;
    $end_date = isset($row['tanggal_selesai']) ? new DateTime($row['tanggal_selesai']) : null;

    if ($start_date && $end_date) {
        // Proses semester jika kedua tanggal tersedia
        for ($year = $start_date->format('Y'); $year <= $end_date->format('Y'); $year++) {
            // Semester 1: Januari - Juni
            $semester_1 = [
                'semester' => "Semester 1 $year",
                'value' => "Semester 1 $year"
            ];
            // Semester 2: Juli - Desember
            $semester_2 = [
                'semester' => "Semester 2 $year",
                'value' => "Semester 2 $year"
            ];

            // Menambahkan semester ke dalam array
            if (!in_array($semester_1, $semesters)) {
                $semesters[] = $semester_1;
            }
            if (!in_array($semester_2, $semesters)) {
                $semesters[] = $semester_2;
            }
        }
    }
}



// Query untuk mendapatkan tahun yang unik dari kolom tanggal_dibuat
$query = "SELECT DISTINCT YEAR(tanggal_dibuat) AS tahun FROM laporan ORDER BY tahun DESC";
$result = $koneksi->query($query);

// Array untuk menyimpan tahun
$years = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $years[] = $row['tahun'];
    }
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
  <link rel="shortcut icon" href="../img/Logo_Polnes_2015-sekarang.png" type="image/x-icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Flatpickr CSS -->
  <link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">

  <!-- Flatpickr JS -->
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

  <!-- Custom styles -->
  <link rel="stylesheet" href="../css/style.min.css">
  <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
  

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
                    <a class="active" href="./admin-laporan-cetak.php"><span class="icon document" aria-hidden="true"></span>Cetak Laporan</a>
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
    <?php
  include'admin-navbar.php';
  ?>
    <!-- ! Main -->
    <div class="container-flex ">
        <div class="container mt-5">
            <h2 class="text-center mb-4 main-title" >Pilih Opsi Cetak Laporan</h2>
            <div class="row">
                <div class="container mt-4">
                  <form action="admin-cetak-laporan-periode.php" method="GET">
                      <h5 class="mb-3 main-title">Laporan Berdasarkan Periode</h5>

                      <div class="row mb-3">
                          <div class="col">
                              <label for="start-date" class="form-label">Tanggal Awal</label>
                              <input type="date" class="form-control" id="start-date" name="start_date" required>
                          </div>
                          <div class="col">
                              <label for="end-date" class="form-label">Tanggal Akhir</label>
                              <input type="date" class="form-control" id="end-date" name="end_date" required>
                          </div>
                      </div>
                      <button type="submit" class="btn btn-primary">Cetak Laporan</button>
                  </form>
                  <br>
              </div>
                              <!-- Form Cetak Laporan Per Semester -->
                <!-- <div class="col-md-4" style="">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Laporan Per Semester</h5>
                            <form action="admin-cetak-laporan-semester.php" method="POST">
                            <div class="mb-3">
                              <label for="semester" class="form-label">Pilih Semester</label>
                              <select class="form-select" id="semester" name="semester">
                                  <option selected disabled>Pilih Semester</option>
                                  <?php
                                  // Loop untuk menampilkan opsi semester dari array $semesters
                                  foreach ($semesters as $sem) {
                                      echo "<option value='" . $sem['value'] . "'>" . $sem['semester'] . "</option>";
                                  }
                                  ?>
                              </select>
                          </div>
                                <button type="submit" class="btn btn-primary w-100">Cetak Laporan</button>
                            </form>
                        </div>
                    </div>
                </div> -->
                <!-- form per semester -->
                <div class="col-md-6 mb-3">
                  <form action="admin-cetak-laporan-per-tahun.php" method="GET">
                      <h5 class="mb-3 main-title" >Laporan Berdasarkan Tahun</h5>
                      <div class="mb-3">
                          <label for="year" class="form-label">Pilih Tahun</label>
                          <select class="form-select" id="year" name="year" required>
                              <option selected disabled>Pilih Tahun</option>
                              <?php
                              // Menampilkan tahun yang diambil dari database
                              foreach ($years as $year) {
                                  echo "<option value='$year'>$year</option>";
                              }
                              ?>
                          </select>
                      </div>

                      <button type="submit" class="btn btn-primary">Cetak Laporan</button>
                  </form>
                </div>
              </div>
            </div>
        </div>
        
    </div>
    <!-- ! Main -->

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
<!-- JavaScript to open calendar on click -->
<script>
    document.getElementById('start-date').addEventListener('click', function () {
        this.showPicker(); // Membuka kalender saat diklik
    });

    document.getElementById('end-date').addEventListener('click', function () {
        this.showPicker(); // Membuka kalender saat diklik
    });
</script>
<script>
    // Menampilkan input tanggal berdasarkan pilihan
    document.getElementById('option').addEventListener('change', function () {
        const selectedValue = this.value;
        const periodInputs = document.getElementById('periodInputs');

        if (selectedValue === 'by_period') {
            periodInputs.style.display = 'block';
        } else {
            periodInputs.style.display = 'none';
        }
    });
</script>
<!-- style form -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<!-- style form -->
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
<!-- flatpcik bulan -->
<script>
    flatpickr("#bulan", {
        plugins: [new monthSelectPlugin()],
        dateFormat: "Y-m", // Format for month picker
    });

    flatpickr("#start-date", {
        dateFormat: "Y-m-d",
    });

    flatpickr("#end-date", {
        dateFormat: "Y-m-d",
    });
</script>
<!-- script tahun kosong -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
<script>
  // Cek jika ada parameter query string
  const urlParams = new URLSearchParams(window.location.search);
  if (urlParams.has('message')) {
    const message = urlParams.get('message');
    if (message === 'tahunkosong') {
      Swal.fire({
        icon: 'error',
        title: 'Silahkan Pilih Tahunnya Ya!',
        // text: 'Silahkan login menggunakan NIM dan Password Anda.',
        confirmButtonText: 'OK'
      }).then(() => {
        window.location.search = '';
        // location.reload();  
      });
    }
  }
</script>
<!-- flatpcik bulan -->
<!-- script jam -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<!-- Chart library -->
<script src="../plugins/chart.min.js"></script>
<!-- Icons library -->
<script src="../plugins/feather.min.js"></script>
<!-- Custom scripts -->
<script src="../js/script.js"></script>
</body>

</html>