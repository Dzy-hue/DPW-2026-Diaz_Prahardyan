<?php
$page_title = "Beranda";
include __DIR__ . '/includes/header.php';
?>
        <section>
            <h2>Selamat Datang di Sistem Perpustakaan Mini</h2>
            <p>Kelola data koleksi buku dan keanggotaan perpustakaan dengan mudah.</p>
        </section>

        <section>
            <h2>Ringkasan</h2>
                <article>
                    <h3>Total Buku</h3>
                    <p>108</p>
                </article>
                <article>
                    <h3>Total Anggota</h3>
                    <p>30</p>
                </article>
                <article>
                    <h3>Sedang Dipinjam</h3>
                    <p>14</p>
                </article>
                <article>
                    <h3>Buku Terlambat</h3>
                    <p>56</p>
                </article>
        </section>

        <section>
            <h2>Informasi Perpustakaan</h2>
                <div class="pr-responsive">
                    <pre>
Sehubungan dengan adanya pemeliharaan sistem pencatatan tahunan, layanan peminjaman dan pengembalian buku fisik akan ditutup sementara pada akhir pekan ini. 
Bagi mahasiswa yang memiliki buku dengan tenggat waktu pengembalian pada tanggal tersebut, masa pinjam akan otomatis diperpanjang hingga hari Senin berikutnya 
tanpa dikenakan denda keterlambatan. Harap pastikan kartu anggota Anda dalam status aktif.
                    </pre>
                </div>
        </section>
<?php include __DIR__ . '/includes/footer.php'; ?>