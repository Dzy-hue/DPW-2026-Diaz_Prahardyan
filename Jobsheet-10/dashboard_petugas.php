<?php
session_start();

require_once __DIR__ . '/includes/auth.php';
wajib_petugas();

$page_title = "Dashboard Petugas";
include __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/koneksi.php';

$totalBuku = $pdo->query("SELECT COUNT(*) FROM buku WHERE is_active = TRUE")->fetchColumn();
$totalAnggota = $pdo->query("SELECT COUNT(*) FROM anggota WHERE is_active = TRUE")->fetchColumn();
?>
    <article>
        <section>
            <h2>Dashboard Admin Perpustakaan</h2>
            <p class="flash flash-success">
                Selamat datang kembali, <strong><?php echo htmlspecialchars($_SESSION['nama']); ?></strong>! Anda masuk sebagai Petugas/Admin.
            </p>
            
            <p>Ini adalah pusat kendali utama. Dari sini Anda memiliki hak akses penuh (kecuali fitur hapus dan edit anggota) untuk mengelola data buku, data anggota, serta memproses transaksi peminjaman dan pengembalian.</p>
            
            <h2>Ringkasan</h2>
                <div class="stats-grid">
                    <article class="stat-card">
                        <h3>Total Buku</h3>
                        <p><?php echo $totalBuku; ?></p>
                    </article>
                    <article class="stat-card">
                        <h3>Total Anggota</h3>
                        <p><?php echo $totalAnggota; ?></p>
                    </article>
                    <article class="stat-card">
                        <h3>Sedang Dipinjam</h3>
                        <p>14</p>
                    </article>
                    <article class="stat-card">
                        <h3>Buku Terlambat</h3>
                        <p>56</p>
                    </article>
                </div>
        </section>
            
        <section>
            <h3>Menu Pintasan Petugas</h3>
                <div class="shortcut-buttons">
                    <!-- Tautan sementara diarahkan ke index/tambah.php yang sudah ada -->
                    <a href="buku/tambah.php" class="btn-outline">Tambah Data Buku</a>
                    <a href="anggota/tambah.php" class="btn-outline">Tambah Data Anggota</a>
                </div>
        </section>
    </article>
<?php include __DIR__ . '/includes/footer.php'; ?>