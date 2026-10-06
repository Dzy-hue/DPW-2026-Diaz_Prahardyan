# 📖 Jobsheet 8 — Koneksi PostgreSQL (SIMPUS-Mini)

## 🎯 Informasi Jobsheet

Sub-CPMK: Menghubungkan aplikasi PHP dengan basis data relasional PostgreSQL menggunakan ekstensi PDO (*PHP Data Objects*), mengimplementasikan *Prepared Statement* untuk keamanan data, dan melakukan operasi CRUD dasar (*Insert* & *Select*).

## 📚 SIMPUS-Mini (Sistem Perpustakaan Mini)

Proyek ini adalah aplikasi antarmuka berbasis web untuk mengelola data perpustakaan mini. Pada tahap ini, proyek mengalami transisi arsitektur basis data secara fundamental: beralih dari penyimpanan memori sementara (*Session*) menjadi sistem dengan **penyimpanan data permanen (Persisten)** menggunakan **PostgreSQL**. Data buku dan anggota kini direkam dengan aman ke dalam *database* dan dirender secara dinamis setiap kali halaman dimuat.

## 👨‍💻 Identitas Mahasiswa

| Keterangan | Detail |
| --- | --- |
| **Nama** | Diaz Prahardyan |
| **Kelas** | TI-2F |
| **NIM** | [254107020119] |
| **Program Studi** | D4-Teknik Informatika, Politeknik Negeri Malang |

## 🚀 Perkembangan Proyek (Jobsheet 8)

Repositori ini memperbarui proyek dengan integrasi *database* relasional yang aman dan dinamis:

1. **Skema Basis Data (DDL):**
Membuat berkas `sql/01_buku_anggota.sql` yang berisi rancangan tabel `buku` dan `anggota` beserta konstrain logika (seperti `PRIMARY KEY`, `NOT NULL`, `DEFAULT`, dan `UNIQUE`) untuk menjaga integritas data langsung dari level *database*.
2. **Koneksi PDO (*PHP Data Objects*):**
Menambahkan berkas `includes/koneksi.php` dengan blok `try-catch` sebagai jembatan komunikasi antara aplikasi PHP dan peladen PostgreSQL menggunakan *driver* `pgsql`.
3. **Migrasi `INSERT` (Prepared Statement):**
Logika penambahan data di `buku/proses_tambah.php` dan `anggota/proses_tambah.php` diganti dengan eksekusi kueri `INSERT ... RETURNING id`. Pemrosesan ini menggunakan parameter *Prepared Statement* (`:nama_parameter`) untuk menutup celah keamanan *SQL Injection*.
4. **Pembacaan Data Dinamis (`SELECT`):**
Daftar tabel pada `buku/list.php` dan `anggota/list.php` kini mengambil data secara *real-time* dari *database* menggunakan kueri `SELECT * FROM ... ORDER BY id DESC`, memastikan data terbaru selalu berada di baris teratas antarmuka (`fetchAll(PDO::FETCH_ASSOC)`).
5. **Statistik Akurat Beranda:**
Kartu informasi total buku dan anggota pada halaman Beranda (`index.php`) kini memanfaatkan eksekusi `SELECT COUNT(*)` yang dihitung langsung oleh mesin basis data untuk performa yang lebih optimal.
6. **Penyempurnaan Fitur Tambahan (Latihan Mandiri):**

* Penanganan galat (kode `23505`) untuk mencegah aplikasi *crash* saat pengguna memasukkan Nomor Anggota ganda (pelanggaran *UNIQUE constraint*).
* Penambahan kolom otomatis `tanggal_ditambahkan TIMESTAMP` langsung dari PostgreSQL.
* Implementasi fitur pencarian (*search filter*) berbasis *server-side* menggunakan klausa `WHERE judul ILIKE :keyword`.
* Pembuatan skrip `migrasi_json.php` untuk memindahkan sisa data lama dari *Jobsheet* sebelumnya.

## 🗄️ Persiapan Database (Wajib Dilakukan)

Sebelum aplikasi dapat berjalan normal, lingkungan peladen lokal harus dikonfigurasi melalui urutan berikut:

1. **Aktifkan Ekstensi PDO:** Pastikan ekstensi `pdo_pgsql` aktif di `php.ini`. Verifikasi melalui terminal dengan perintah `php -m | findstr pgsql`. Restart peladen (Apache/Laragon) jika baru saja diaktifkan.
2. **Buat Database:** Buka terminal/DBeaver dan buat wadah *database* baru dengan perintah: `createdb -U postgres simpus_mini`.
3. **Migrasi Skema:** Eksekusi cetak biru tabel dengan perintah: `psql -U postgres -d simpus_mini -f sql/01_buku_anggota.sql`.
4. **Konfigurasi Kredensial:** Sesuaikan variabel parameter `$user` dan `$pass` di dalam berkas `includes/koneksi.php` agar cocok dengan otentikasi lokal PostgreSQL Anda.

## 📁 Struktur Folder Terbaru

```text
Jobsheet-08/
├── index.php             # Menampilkan agregasi dinamis COUNT(*) dari PostgreSQL
├── migrasi_json.php      # Skrip utilitas migrasi data JSON ke database (latihan mandiri)
├── README.md             # Laporan dokumentasi jobsheet 8
├── anggota/
│   ├── list.php          # Render tabel dinamis via PDO fetchAll
│   ├── tambah.php
│   └── proses_tambah.php # Eksekusi INSERT & penanganan galat UNIQUE constraint
├── assets/
│   ├── css/style.css
│   └── js/app.js
├── buku/
│   ├── list.php          # Render tabel dinamis via PDO fetchAll & fitur pencarian ILIKE
│   ├── tambah.php
│   └── proses_tambah.php # Eksekusi INSERT Prepared Statement untuk buku
├── data/                 
│   └── buku.json         # Arsip data statis (sumber migrasi ke database)
├── docs/
│   └── wireframe.md      # Desain antarmuka aplikasi
├── includes/
│   ├── header.php
│   ├── footer.php
│   └── koneksi.php       # Pengaturan DSN, PDO, dan kredensial database
└── sql/
    └── 01_buku_anggota.sql # Cetak biru tabel relasional (DDL)

```

## ⚙️ Cara Menjalankan

**PENTING:** Pastikan peladen PostgreSQL sudah menyala (*running*) di latar belakang sebelum mengeksekusi aplikasi.

Jalankan aplikasi dengan salah satu opsi berikut:

**Opsi 1 — PHP Built-in Server (Terminal/CLI):**
Buka terminal di dalam root folder proyek ini, lalu jalankan perintah:

```bash
php -S localhost:8000

```

Buka peramban dan akses alamat `http://localhost:8000/index.php`.

**Opsi 2 — Laragon / XAMPP / Web Server Lainnya:**
Letakkan proyek di dalam folder *document root*. Akses langsung menggunakan *Virtual Host* (contoh: `[http://jobsheet08.test/](http://jobsheet08.test/)`) atau melalui rute *localhost* tradisional yang sesuai dengan penempatan direktori Anda.

## ✅ Hasil Pengujian Fitur

* [x] Data tabel buku dan anggota sukses bertahan secara persisten meskipun jendela peramban web ditutup atau peladen PHP dimatikan sementara.
* [x] Agregasi kartu statistik di halaman beranda berhasil tersinkronisasi dan menampilkan jumlah akurat langsung dari basis data.
* [x] Fitur penambahan data beroperasi sempurna menggunakan parameter *Prepared Statement*, memastikan input pengguna tidak dieksekusi sebagai instruksi SQL mentah.
* [x] Pesan *error flash message* berhasil menangkap dan menampilkan peringatan yang ramah pengguna apabila terdapat duplikasi Nomor Anggota.
* [x] Fitur pencarian buku (*server-side search*) berhasil menyaring hasil dari basis data menggunakan operator `ILIKE` via *method* GET.

## 📌 Catatan Tambahan

* Kolom `id` (*Primary Key*) telah berhasil ditarik secara latar belakang dalam kueri `SELECT *`. Identitas unik ini dipersiapkan secara khusus untuk mekanisme parameter tautan *Edit* dan *Hapus* (*Update* & *Delete*) yang akan direalisasikan pada jobsheet berikutnya.
* Penggunaan `die()` pada `catch` di berkas `koneksi.php` dirancang sebagai langkah mitigasi *fatal error* agar aplikasi tidak merender komponen antarmuka yang rusak apabila koneksi *database* terputus.

---