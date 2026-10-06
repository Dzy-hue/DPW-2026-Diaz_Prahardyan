<?php
$page_title = "Beranda";
include __DIR__ . '/includes/header.php';
require __DIR__ . '/includes/koneksi.php';

$totalBuku = count($_SESSION['buku'] ?? []);
$totalAnggota = count($_SESSION['anggota'] ?? []);
?>
        <section>
            <h2>Selamat Datang di Sistem Perpustakaan Mini</h2>
            <p>Aplikasi pengelolaan data koleksi buku dan keanggotaan perpustakaan terpadu.</p>
        </section>

        <section>
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
            <h2>Informasi Perpustakaan</h2>
            <div class="pr-responsive">
                <p style="text-align: justify; line-height: 1.6;">
                    Sehubungan dengan adanya pemeliharaan sistem pencatatan tahunan, layanan peminjaman dan pengembalian buku fisik akan ditutup sementara pada akhir pekan ini.
                </p>
                <p style="text-align: justify; line-height: 1.6;">
                    Bagi mahasiswa yang memiliki buku dengan tenggat waktu pengembalian pada tanggal tersebut, masa pinjam akan otomatis diperpanjang hingga hari Senin berikutnya tanpa dikenakan denda keterlambatan. Harap pastikan kartu anggota Anda dalam status aktif.
                </p>
            </div>
        </section>
<?php include __DIR__ . '/includes/footer.php'; ?>