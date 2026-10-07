<?php
$page_title = "Daftar Buku";
include __DIR__ . '/../includes/header.php';
require __DIR__ . '/../includes/koneksi.php';

$flash = $_SESSION['flash'] ?? null;
// var_dump($flash); //Debugging: Menampilkan isi flash sebelum di-unset
// die();

unset($_SESSION['flash']);

// Latihan Tambahan 3
// 1. Tangkap kata kunci dari url jika ada (misal: list.php?q=Laskar)
$keyword = $_GET['q'] ?? '';

if ($keyword !== '') {
    // 2. Jika ada pencarian, gunakan prepare() dan ILIKE
    $stmt = $pdo->prepare("SELECT * FROM buku WHERE judul ILIKE :keyword ORDER BY id DESC");
    $stmt->execute(['keyword' => "%$keyword%"]);
    $daftarBuku = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    // 3. Jika tidak ada pencarian, tampilkan semua buku
    $daftarBuku = $pdo->query("SELECT * FROM buku ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
    // var_dump($daftarBuku); // Debugging: Menampilkan isi daftar buku sebelum ditampilkan
    // die();
}

?>
            <section>
                <h2>Daftar Buku</h2>

                <?php if ($flash): ?>
                    <p class="flash flash-<?php echo $flash['type']; ?>"><?php echo $flash['pesan']; ?></p>
                <?php endif; ?>
                
                <div class="search-box">
                    <form method="GET" action="">
                        <label for="search-input">Cari Judul Buku</label>
                        <input type="text" id="search-input" name="q" placeholder="Ketik judul buku lalu tekan Enter..." value="<?php echo htmlspecialchars($keyword); ?>">
        
                        <?php if ($keyword !== ''): ?>
                            <a href="list.php" style="margin-left: 10px; color: #dc3545; text-decoration: none;">❌ Batal</a>
                        <?php endif; ?>
                    </form>
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
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($daftarBuku)): ?>
                        <tr>
                            <td colspan="7">Belum ada data buku. Silakan tambah lewat menu "Tambah Buku".</td>
                        </tr>
                        <?php else: ?>
                            <?php foreach ($daftarBuku as $buku): ?>
                             <tr>
                                <td><?php echo $buku['judul']; ?></td>
                                <td><?php echo $buku['pengarang']; ?></td>
                                <td><?php echo $buku['kategori']; ?></td>
                                <td><?php echo $buku['tahun']; ?></td>
                                <td><?php echo $buku['stok']; ?></td>
                                <td><?php echo date('d M Y, H:i', strtotime($buku['tanggal_ditambahkan'])); ?></td>
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
<?php include __DIR__ . '/../includes/footer.php'; ?>