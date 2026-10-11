<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$sudahLogin = isset($_SESSION['user_id']);
$namaPengguna = $sudahLogin ? $_SESSION['nama'] : '';
$role = $sudahLogin ? $_SESSION['role'] : '';

// Prefix relatif ke root proyek ini (bukan root domain) — supaya
// /assets, /index.php, dst tetap benar walau proyek diakses lewat
// subfolder (mis. dp2026.test/kode-praktikum/jobsheet-10/), bukan cuma
// lewat vhost yang document root-nya langsung folder ini.
$__jobsheetRoot = dirname(__DIR__);
$__scriptDir = dirname($_SERVER['SCRIPT_FILENAME']);
$__rel = ltrim(str_replace('\\', '/', substr($__scriptDir, strlen($__jobsheetRoot))), '/');
$base = $__rel === '' ? '' : str_repeat('../', substr_count($__rel, '/') + 1);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIMPUS-Mini<?php echo isset($page_title) ? ' | ' . $page_title : ''; ?></title>
    <link rel="stylesheet" href="<?php echo $base; ?>assets/css/style.css">
</head>
<body>
    <header>
        <h1><a href="<?php echo $base; ?>index.php" style="color: #fff; text-decoration: none;">SIMPUS-Mini</a></h1>
        <button type="button" id="nav-toggle-btn" class="nav-toggle-label" aria-label="Menu">&#9776;</button>
        <nav>
            <ul>
                <!-- Percabangan Khusus Role Petugas -->
                <?php if ($sudahLogin && ($role === 'petugas' || $role === 'admin')): ?>
                    <li><a href="<?php echo $base; ?>dashboard_petugas.php">Beranda</a></li>
                    <li><a href="<?php echo $base; ?>buku/list.php">Daftar Buku</a></li>
                    <li><a href="<?php echo $base; ?>anggota/list.php">Daftar Anggota</a></li>
                <?php endif; ?>

                <!-- Percabangan Khusus Role Anggota -->
                <?php if ($sudahLogin && $role === 'anggota'): ?>
                    <li><a href="<?php echo $base; ?>index.php">Beranda</a></li>
                    <li><a href="<?php echo $base; ?>buku/list.php">Daftar Buku</a></li>
                <?php endif; ?>
            </ul>
        </nav>

        <div class="auth-status">
            <?php if ($sudahLogin): ?>
                <span class="nav-greeting">Halo, <?php echo htmlspecialchars($namaPengguna); ?></span>
                <a href="<?php echo $base; ?>auth/logout.php" class="nav-logout">Logout</a>
            <?php else: ?>
                <a href="<?php echo $base; ?>auth/login.php" class="btn-simpan nav-btn-login">Login</a>
            <?php endif; ?>
        </div>
    </header>

    <main>