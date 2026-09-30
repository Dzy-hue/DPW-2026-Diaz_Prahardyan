<?php
$page_title = "Tambah Anggota";
include _DIR_ . '/../includes/header.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
?>
            <section>
                <h2>Tambah Anggota Baru</h2>

                <?php if ($flash): ?>
                    <p class="flash flash-<?php echo $flash['type']; ?>"><?php echo $flash['pesan']; ?></p>
                <?php endif; ?>

                <form id="form-tambah" method="post" action="proses_tambah.php">
                      <p>
                        <label for="nama">Nama</label><br>
                        <input type="text" id="nama" name="nama" required>
                      </p>
                      <p>
                        <label for="no_anggota">No. Anggota</label><br>
                        <input type="text" id="no_anggota" name="no_anggota" required>
                      </p>
                      <p>
                        <label for="alamat">Alamat</label><br>
                        <input type="text" id="alamat" name="alamat" required>
                      </p>
                      <p>
                        <label for="no_hp">No. HP</label><br>
                        <input type="text" id="no_hp" name="no_hp" required>
                      </p>
                      <p>
                        <button type="submit">Simpan Data</button>  
                      </p>
                </form>
            </section>
<?php include _DIR_ . '/../includes/footer.php'; ?>