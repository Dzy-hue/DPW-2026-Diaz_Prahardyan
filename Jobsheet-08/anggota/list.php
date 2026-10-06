<?php
$page_title = "Daftar Anggota";
include __DIR__ . '/../includes/header.php';
require __DIR__ . '/includes/koneksi.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
$daftarAnggota = $_SESSION['anggota'] ?? [];
?>
            <section>
                <h2>Daftar Anggota</h2>

                <?php if ($flash): ?>
                    <p class="flash flash-<?php echo $flash['type']; ?>"><?php echo $flash['pesan']; ?></p>
                <?php endif; ?>

                <div class="search-box">
                    <label for="search-input">Cari Nama Anggota</label>
                    <input type="text" id="search-input" placeholder="Ketik nama anggota...">
                </div>
          
                <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>No. Anggota</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>No. HP</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($daftarAnggota)): ?>
                        <tr>
                            <td colspan="5">Belum ada data anggota. Silakan tambah lewat menu "Tambah Anggota".</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($daftarAnggota as $anggota): ?>
                        <tr>
                            <td><?php echo $anggota['no_anggota']; ?></td>
                            <td><?php echo $anggota['nama']; ?></td>
                            <td><?php echo $anggota['alamat']; ?></td>
                            <td><?php echo $anggota['no_hp']; ?></td>
                            <td>
                                <button type="button" class="button-edit">Edit</button>
                                <button type="button" class="btn-detail">Detail</button>
                                <button type="button" class="btn-hapus">Hapus</button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    </tbody>
                </table>
                </div>
            </section>

            <div style="text-align: center; margin-top: 20px;">
                <a href="reset.php" style="background-color: #dc3545; color: white; padding: 10px 20px; border-radius: 6px; text-decoration: none; font-weight: bold; display: inline-block;">
                    ⚠️ Reset Semua Data
                </a>
            </div>
<?php include __DIR__ . '/../includes/footer.php'; ?>