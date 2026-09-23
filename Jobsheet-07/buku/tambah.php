<?php
$page_title = "Tambah Buku";
include _DIR_ . '/../includes/header.php';
?>
            <section>
                <h2>Tambah Buku Perpustakaan</h2>
                <form id="form-tambah" method="post" action="proses_tambah.php">
                      <p>
                        <label for="judul">Judul</label><br>
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
                            <option value="fiksi">Fiksi</option>
                            <option value="non-fiksi">Non-Fiksi</option>
                            <option value="referensi">Referensi</option>
                        </select>
                      </p>
                      <p>
                        <button type="submit">Simpan</button>  
                      </p>
                </form>
            </section>
<?php include _DIR_ . '/../includes/footer.php'; ?>