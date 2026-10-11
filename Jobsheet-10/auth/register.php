<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['user_id'])) {
    header('Location: ../index.php');
    exit;
}

$page_title = "Pendaftaran Akun Baru";
include __DIR__ . '/../includes/header.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
?>
        <section>
            <h2 class="judul-form">Pendaftaran Akun Baru</h2>
                
            <article>
                <?php if ($flash): ?>
                        <p class="flash flash-<?php echo $flash['type']; ?>"><?php echo $flash['pesan']; ?></p>
                <?php endif; ?>

                <form action="proses_register.php" method="POST">
                    <p>
                        <label for="nama">Nama Lengkap</label>
                        <input type="text" id="nama" name="nama" required autocomplete="name">
                    </p>

                    <p>
                        <label for="username">Username / No. Anggota</label>
                        <input type="text" id="username" name="username" required autocomplete="username">
                    </p>

                    <p>
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" minlength="6" required autocomplete="new-password">
                    </p>

                    <p>
                        <button type="submit" class="btn-simpan">Simpan Pendaftaran</button>
                    </p>
                </form>
                    
                    <p>
                        <small>Sudah punya akun? <a href="login.php">Kembali ke Login</a></small>
                    </p>
            </article>
        </section>

<?php include __DIR__ . '/../includes/footer.php'; ?>