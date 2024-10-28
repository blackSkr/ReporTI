<div class="row">
          <div class="col-lg-12">
            <div class="users-table table-wrapper">
              <table class="posts-table">
                <thead>
                <h4 class="main-title">Semua Laporan</h4>
                  <tr class="users-table-info">
                    <th>
                      <label class="users-table__checkbox ms-20">
                        <input type="checkbox" class="check-all">Jenis Laporan
                      </label>
                    </th>
                    <!-- <th>Nama Laporan</th> -->
                    <th>Deskripsi Laporan</th>
                    <th>Dokumentasi </th>
                    <th>Pembuat </th>
                    <!-- <th>NIM / NIDN</th> -->
                    <th>Waktu Dibuat</th>
                    <!-- <th>Waktu Selesai</th> -->
                    <th>Status</th>
                    <th>Tindakan</th>
                  </tr>
                </thead>
                <tbody>

                  <?php
                  if (mysqli_num_rows($result) > 0) {
                      while ($row = mysqli_fetch_assoc($result)) {
                          echo "<tr>";
                          echo "<td>" . htmlspecialchars($row['jenis_laporan']) . "</td>";
                          // echo "<td>" . htmlspecialchars($row['nama_laporan']) . "</td>";
                          echo "<td>" . htmlspecialchars($row['deskripsi_laporan']) . "</td>";
                          
                          // Path gambar
                          $file_path = '../doc_laporan/' . htmlspecialchars($row['dokumentasi']);
                          
                          // Membungkus gambar dengan <a> untuk membuka di tab baru
                          echo "<td><a href='" . $file_path . "' target='_blank'><img src='" . $file_path . "' alt='Gambar Dokumentasi' style='width: 50px; height: 50px; cursor: pointer;'></a></td>";
                          
                          echo "<td>" . htmlspecialchars($row['tipe_pengguna']) . "</td>";
                          // echo "<td>" . (!empty($row['nim']) ? htmlspecialchars($row['nim']) : htmlspecialchars($row['nidn'])) . "</td>";
                          echo "<td>" . htmlspecialchars($row['tanggal_dibuat']) . "</td>";
                          // echo "<td>" . (!empty($row['tanggal_selesai']) ? htmlspecialchars($row['tanggal_selesai']) : "Belum selesai") . "</td>";
                          echo "<td><span class='badge-" . strtolower($row['status']) . "'>" . htmlspecialchars($row['status']) . "</span></td>";
                          echo "<td>
                                  <span class='p-relative'>
                                      <button class='dropdown-btn transparent-btn' type='button' title='More info'>
                                          <div class='sr-only'>More info</div>
                                          <i data-feather='more-horizontal' aria-hidden='true'></i>
                                      </button>
                                      <ul class='users-item-dropdown dropdown'>
                                          <li><a href='admin-edit-laporan.php?id_laporan=" . $row['id_laporan'] . "' onclick='return confirm(\"Apakah Anda yakin ingin edit laporan ini?\")'>Edit</a></li>
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
        <!-- Modal untuk menampilkan gambar -->
        <div id="imageModal" class="modal">
          <span class="close" onclick="closeModal()">&times;</span>
          <img class="modal-content" id="modalImage">
        </div>
