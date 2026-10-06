<?php
$page_title = "Edit Buku";
include __DIR__ . '/../includes/header.php';
require __DIR__ . '/../includes/koneksi.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

$id = $_GET['id'] ?? null;

if (!$id) {
    header('Location: list.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM buku WHERE id = :id");
$stmt->execute(['id' => $id]);
$buku = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$buku) {
    header('Location: list.php');
    exit;
}
?>

        <section>
            <h2>Edit Buku</h2>

            <?php if ($flash): ?>
                <p class="flash flash-<?php echo $flash['type']; ?>"><?php echo $flash['pesan']; ?></p>
            <?php endif; ?>

            <form id="form-tambah" method="post" action="proses_edit.php">
                <input type="hidden" name="id" value="<?php echo $buku['id']; ?>">
                <p>
                    <label for="judul">Judul Buku</label><br>
                    <input type="text" id="judul" name="judul" value="<?php echo $buku['judul']; ?>" required>
                </p>
                <p>
                    <label for="pengarang">Pengarang</label><br>
                    <input type="text" id="pengarang" name="pengarang" value="<?php echo $buku['pengarang']; ?>" required>
                </p>
                <p>
                    <label for="kategori">Kategori</label><br>
                    <select id="kategori" name="kategori" required>
                        <option value="">-- Pilih Kategori --</option>
                        <?php 
                        $kategori_options = [
                            'Novel' => 'Novel',
                            'Sastra' => 'Sastra',
                            'fiksi' => 'Fiksi', 
                            'non-fiksi' => 'Non-Fiksi', 
                            'referensi' => 'Referensi'
                        ];
                        foreach ($kategori_options as $val => $label): 
                        ?>
                            <option value="<?php echo $val; ?>" <?php echo $buku['kategori'] === $val ? 'selected' : ''; ?>>
                                <?php echo $label; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </p>
                <p>
                    <label for="tahun">Tahun Terbit</label><br>
                    <input type="number" id="tahun" name="tahun" min="1900" max="2026" value="<?php echo $buku['tahun']; ?>" required>
                </p>
                <p>
                    <label for="isbn">ISBN (Opsional)</label><br>
                    <input type="text" id="isbn" name="isbn" value="<?php echo $buku['isbn'] ?? ''; ?>">
                </p>
                <p>
                    <label for="stok">Stok</label><br>
                    <input type="number" id="stok" name="stok" min="0" value="<?php echo $buku['stok']; ?>" required>
                </p>
                <p style="margin-top: 15px;">
                    <button type="submit" class="btn-primary" style="padding: 8px 16px; background-color: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer;">Simpan Perubahan</button>
                    <a href="list.php" class="btn-secondary" style="margin-left: 10px; text-decoration: none; color: #dc3545; border: 1px solid #dc3545; padding: 7px 15px; border-radius: 4px;">Batal</a>
                </p>
            </form>
        </section>
        <?php include __DIR__ . '/../includes/footer.php'; ?>