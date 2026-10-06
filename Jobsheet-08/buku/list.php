<?php
$page_title = "Daftar Buku";
include __DIR__ . '/../includes/header.php';
require __DIR__ . '/includes/koneksi.php';

$flash = $_SESSION['flash'] ?? null;
// var_dump($flash); //Debugging: Menampilkan isi flash sebelum di-unset
// die();

unset($_SESSION['flash']);
$daftarBuku = $pdo->query("SELECT * FROM buku ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
// var_dump($daftarBuku); // Debugging: Menampilkan isi daftar buku sebelum ditampilkan
// die();

?>
            <section>
                <h2>Daftar Buku</h2>

                <?php if ($flash): ?>
                    <p class="flash flash-<?php echo $flash['type']; ?>"><?php echo $flash['pesan']; ?></p>
                <?php endif; ?>

                <div class="search-box">
                    <label for="search-input">Cari Judul Buku</label>
                    <input type="text" id="search-input" placeholder="Ketik judul buku...">
                </div>
            
                <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Pengarang</th>
                            <th>Kategori</th>
                            <th>Tahun</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($daftarBuku)): ?>
                        <tr>
                            <td colspan="5">Belum ada data buku. Silakan tambah lewat menu "Tambah Buku".</td>
                        </tr>
                        <?php else: ?>
                            <?php foreach ($daftarBuku as $buku): ?>
                             <tr>
                                <td><?php echo $buku['judul']; ?></td>
                                <td><?php echo $buku['pengarang']; ?></td>
                                <td><?php echo $buku['kategori']; ?></td>
                                <td><?php echo $buku['tahun']; ?></td>
                                <td><?php echo $buku['stok']; ?></td>
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