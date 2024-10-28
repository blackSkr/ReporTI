
<?php
include '../connection/koneksi.php';
session_start(); // Pastikan session dimulai

// Cek apakah pengguna sudah login
if (!isset($_SESSION['noadmin'])) {
    // Jika belum login, arahkan ke halaman login
    header("Location: ../index.php");
    exit();
}

$id_laporan = $_GET['id_laporan']; // Ambil id_laporan dari URL atau form sebelumnya
$query = "SELECT * FROM laporan WHERE id_laporan = '$id_laporan'";
$result = mysqli_query($koneksi, $query);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
} else {
    echo "Data laporan tidak ditemukan!";
    exit;
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
                    <a class="active" href="../page_admin"><span class="icon home" aria-hidden="true"></span>Dashboard</a>
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
          <li><a href="##">
              <i data-feather="user" aria-hidden="true"></i>
              <span>Profile</span>
            </a></li>
          <li><a href="##">
              <i data-feather="settings" aria-hidden="true"></i>
              <span>Account settings</span>
            </a></li>
          <li><a class="danger" href="../actiondosen/dosen-proses-logout.php">
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
      <h2 class="main-title">Edit Status Laporan</h2>
        <form class="sign-up-form form" action="../actionadmin/admin-proses-edit-laporan.php" method="POST">
            
            <input type="hidden" name="id_laporan" value="<?php echo htmlspecialchars($row['id_laporan']); ?>">

            <label class="form-label-wrapper">
                <p class="form-label">Jenis Laporan</p>
                <input class="form-input" type="text" name="jenis_laporan" value="<?php echo htmlspecialchars($row['jenis_laporan']); ?>" readonly>
            </label>

            <label class="form-label-wrapper">
                <p class="form-label">Nama Laporan</p>
                <input class="form-input" type="text" name="nama_laporan" value="<?php echo htmlspecialchars($row['nama_laporan']); ?>" readonly>
            </label>

            <label class="form-label-wrapper">
                <p class="form-label">Deskripsi Laporan</p>
                <input class="form-input" type="text" name="deskripsi_laporan" value="<?php echo htmlspecialchars($row['deskripsi_laporan']); ?>" readonly>
            </label>

            <label class="form-label-wrapper">
                <p class="form-label">Dokumentasi</p>
                <?php
                  $file_path = '../doc_laporan/' . htmlspecialchars($row['dokumentasi']);

                $dokumentasi = htmlspecialchars($row['dokumentasi']); 
                $file_extension = pathinfo($dokumentasi, PATHINFO_EXTENSION);

                if (in_array($file_extension, ['jpg', 'jpeg', 'png', 'gif'])) {
                    // Jika file adalah gambar, tampilkan preview
                    // echo '<img src="../doc_laporan/' . $dokumentasi . '" alt="Preview Dokumentasi" style="width: 100px; height: 100px;">';
                    echo "<td><a href='" . $file_path . "' target='_blank'><img src='" . $file_path . "' alt='Gambar Dokumentasi' style='width: 150px; height: 150px; cursor: pointer;'></a></td>";

                }

                ?>
                <!-- Tampilkan link untuk melihat dokumen secara penuh -->
                 
                <!-- <td><a href='" . $file_path . "' target='_blank'><img src='" . $file_path . "' alt='Gambar Dokumentasi' style='width: 50px; height: 50px; cursor: pointer;'></a></td>"; -->

                <!-- <a href="../doc_laporan/<?php echo $dokumentasi; ?>" target="_blank">Lihat Dokumentasi</a> -->
            </label>


            <label class="form-label-wrapper">
                <p class="form-label">NIM / NIDN</p>
                <input class="form-input" type="text" value="<?php echo htmlspecialchars($row['nim'] ?: $row['nidn']); ?>" readonly>
            </label>
            <label class="form-label-wrapper">
                <p class="form-label">Waktu Dibuat</p>
                <input class="form-input" type="text" value="<?php echo isset($row['tanggal_dibuat']) ? htmlspecialchars($row['tanggal_dibuat']) : 'Belum ada data'; ?>" readonly>
            </label>
            <label class="form-label-wrapper">
                <p class="form-label">Waktu Selesai</p>
                <input class="form-input" type="text" value="<?php echo isset($row['tanggal_selesai']) ? htmlspecialchars($row['tanggal_selesai']) : 'Belum ada '; ?>" readonly>
            </label>



            <label class="form-label-wrapper">
                <p class="form-label" > Status Laporan</p>
                <select class="form-input" name="status" required readonly >
                    <option ><?php echo isset($row['status']) ? htmlspecialchars($row['status']) : 'Belum ada '; ?></option>
                </select>
            </label>

            <!-- <button class="form-btn primary-default-btn transparent-btn" type="submit">Simpan Perubahan</button> -->
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

<!-- Chart library -->
<script src="../plugins/chart.min.js"></script>
<!-- Icons library -->
<script src="../plugins/feather.min.js"></script>
<!-- Custom scripts -->
<script src="../js/script.js"></script>
</body>

</html>