<?php
$page_title = "Daftar Buku";
include __DIR__ . '/../includes/header.php';
require __DIR__ . '/../includes/koneksi.php';

$flash = $_SESSION['flash'] ?? null;
// var_dump($flash); //Debugging: Menampilkan isi flash sebelum di-unset
// die();

unset($_SESSION['flash']);

$perPage = 5;
$page = max(1, (int) ($_GET['page'] ?? 1));
$offset = ($page - 1) * $perPage;
$keyword = trim($_GET['q'] ?? '');

if ($keyword !== '') {
    $hitung = $pdo->prepare("SELECT COUNT(*) FROM buku WHERE judul ILIKE :kw");
    $hitung->execute(['kw' => '%' . $keyword . '%']);
    $totalRows = $hitung->fetchColumn();

    $stmt = $pdo->prepare("SELECT * FROM buku WHERE judul ILIKE :kw ORDER BY id DESC LIMIT :limit OFFSET :offset");
    $stmt->bindValue('kw', '%' . $keyword . '%');
} else {
    $totalRows = $pdo->query("SELECT COUNT(*) FROM buku")->fetchColumn();
    $stmt = $pdo->prepare("SELECT * FROM buku ORDER BY id DESC LIMIT :limit OFFSET :offset");
}
$stmt->bindValue('limit', $perPage, PDO::PARAM_INT);
$stmt->bindValue('offset', $offset, PDO::PARAM_INT);
$stmt->execute();

$daftarBuku = $stmt->fetchALL(PDO::FETCH_ASSOC);
$totalPages = max(1, (int) ceil($totalRows / $perPage));
?>
            <section>
                <h2>Daftar Buku</h2>

                <?php if ($flash): ?>
                    <p class="flash flash-<?php echo $flash['type']; ?>"><?php echo $flash['pesan']; ?></p>
                <?php endif; ?>

                <div class="search-box">
                    <form method="GET" action="list.php">
                        <label for="search-input">Cari Judul Buku</label>
                        <input type="text" id="search-input" name="q" placeholder="Ketik judul buku lalu tekan Enter..." value="<?php echo htmlspecialchars($keyword); ?>">

                        <button type="submit" class="btn-cari">🔎︎</button>

                        <?php if ($keyword !== ''): ?>
                            <a href="list.php" class="btn-batal">❌</a>
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
                            <td colspan="7" style="text-align: center;">Belum ada data buku. Silakan tambah lewat menu "Tambah Buku".</td>
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
                                    <a href="edit.php?id=<?php echo $buku['id']; ?>" class="btn-edit">Edit</a>

                                    <form class="form-hapus" method="post" action="hapus.php" style="display: inline-block;">
                                        <input type="hidden" name="id" value="<?php echo $buku['id']; ?>">
                                        <button type="submit" class="btn-hapus">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
                </div>

                <nav class="pagination" style="margin-top: 15px; display: flex; gap: 5px;">
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <a href="list.php?page=<?php echo $i; ?><?php echo $keyword !== '' ? '&q=' . urlencode($keyword) : ''; ?>"
                        style="padding: 5px 10px; border: 1px solid #ccc; text-decoration: none; color: #333; <?php echo $i === $page ? 'background-color: #007bff; color: white;' : ''; ?>">
                        <?php echo $i; ?>
                        </a>
                    <?php endfor; ?>
                </nav>
            </section>
<?php include __DIR__ . '/../includes/footer.php'; ?>