<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// kode untuk mengarahkan pengguna ke beranda sesuai peran mereka
if (isset($_SESSION['user_id'])) {
    if ($_SESSION['role'] === 'petugas') {
        header('Location: ../dashboard_petugas.php');
    } else {
        header('Location: ../index.php');
    }
    exit;
}

$page_title = "Login SIMPUS-Mini";
include __DIR__ . '/../includes/header.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
?>
        <section>
            <header>
                <h2>Login SiMPUS-Mini</h2>
            </header>

            <article>
                <?php if ($flash): ?>
                    <p class="flash flash-<?php echo $flash['type']; ?>"><?php echo $flash['pesan']; ?></p>
                <?php endif; ?>

                <form method="POST" action="proses_login.php">
                    <p>
                        <label for="username">Username / No. Anggota</label>
                        <input type="text" id="username" name="username" required autocomplete="username">
                    </p>
                    <p>
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" required autocomplete="current-password">
                    </p>
                    <p>
                        <button type="submit" class="btn-simpan">Masuk ke SIMPUS-Mini</button>
                    </p>
                </form>
                <p>
                    <small>Belum punya akun? <a href="register.php">Daftar Akun Baru</a></small>
                </p>
            </article>
        </section>
<?php include __DIR__ . '/../includes/footer.php'; ?>