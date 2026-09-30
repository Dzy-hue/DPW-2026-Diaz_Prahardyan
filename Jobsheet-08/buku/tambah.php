<?php
$page_title = "Tambah Buku";
include __DIR__ . '/../includes/header.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
?>
            <section>
                <h2>Tambah Buku Baru</h2>

                <?php if ($flash): ?>
                    <p class="flash flash-<?php echo $flash['type']; ?>"><?php echo $flash['pesan']; ?></p>
                <?php endif; ?>         

                <form id="form-tambah" method="post" action="proses_tambah.php">
                      <p>
                        <label for="judul">Judul Buku</label><br>
                        <input type="text" id="judul" name="judul" required>
                      </p>
                      <p>
                        <label for="pengarang">Pengarang</label><br>
                        <input type="text" id="pengarang" name="pengarang" required>
                      </p>
                      <p>
                        <label for="tahun">Tahun Terbit</label><br>
                        <input type="number" id="tahun" name="tahun" min="1900" max="2026" required>
                      </p>
                      <p>
                        <label for="isbn">ISBN</label><br>
                        <input type="text" id="isbn" name="isbn" placeholder="Contoh: 978-602-8519-93-9" required>
                      </p>
                      <p>
                        <label for="stok">Stok</label><br>
                        <input type="number" id="stok" name="stok" min="0" required>
                      </p>
                      <p>
                        <label for="kategori">Kategori</label><br>
                        <select id="kategori" name="kategori">
                            <option value="">-- Pilih Kategori --</option>
                            <option value="Novel">Novel</option>
                            <option value="Sastra">Sastra</option>
                            <option value="fiksi">Fiksi</option>
                            <option value="non-fiksi">Non-Fiksi</option>
                            <option value="referensi">Referensi</option>
                        </select>
                      </p>
                      <p>
                        <button type="submit" class="btn-simpan">Simpan Data</button>  
                      </p>
                </form>
            </section>
<?php include __DIR__ . '/../includes/footer.php'; ?>