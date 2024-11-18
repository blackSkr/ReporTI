
<div class="row">
    <div class="col-lg-12">
        <div class="users-table table-wrapper">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Jenis Laporan</th>
                        <th>Deskripsi Laporan</th>
                        <th>Dokumentasi</th>
                        <th>Pembuat</th>
                        <th>Waktu Dibuat</th>
                        <th>Status</th>
                        <th>Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (mysqli_num_rows($result) > 0): ?>
                        <?php while ($row = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td><?= htmlspecialchars($row['jenis_laporan']) ?></td>
                                <td><?= htmlspecialchars($row['deskripsi_laporan']) ?></td>
                                <td>
                                    <a href="../doc_laporan/<?= htmlspecialchars($row['dokumentasi']) ?>" target="_blank">
                                        <img src="../doc_laporan/<?= htmlspecialchars($row['dokumentasi']) ?>" alt="Dokumentasi" style="width: 50px; height: 50px;">
                                    </a>
                                </td>
                                <td><?= htmlspecialchars($row['tipe_pengguna']) ?></td>
                                <td><?= htmlspecialchars($row['tanggal_dibuat']) ?></td>
                                <td><span class="badge bg-info"><?= htmlspecialchars($row['status']) ?></span></td>
                                <td>
                                    <a href="admin-edit-laporan.php?id_laporan=<?= $row['id_laporan'] ?>" class="btn btn-primary btn-sm">Edit</a>
                                    <a href="admin-detail-laporan.php?id_laporan=<?= $row['id_laporan'] ?>" class="btn btn-secondary btn-sm">Detail</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada laporan yang ditemukan.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
