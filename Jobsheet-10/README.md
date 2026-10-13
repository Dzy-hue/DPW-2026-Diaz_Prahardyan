# 📖 Jobsheet 10 — Autentikasi & Manajemen Sesi

## 🎯 Informasi Jobsheet

Sub-CPMK: Menerapkan autentikasi & manajemen sesi pengguna pada proyek, mengimplementasikan kontrol akses berbasis peran (Aktor Tamu vs Petugas), serta mengamankan kata sandi menggunakan enkripsi *hash*.

## 📚 SIMPUS-Mini (Sistem Perpustakaan Mini)

Proyek ini mewujudkan sistem keamanan arsitektur web yang telah dirancang sejak awal (pada tahap *wireframe*). Aplikasi kini secara tegas memisahkan hak akses antara pengunjung umum (Tamu) yang hanya diizinkan melihat katalog buku, dan pengguna terautentikasi (Petugas/Admin) yang memiliki hak penuh atas operasi manajerial (CRUD). Manajemen sesi diimplementasikan untuk mempertahankan status masuk (*login*) pengguna saat berpindah antarhalaman.

## 👨‍💻 Identitas Mahasiswa

| Keterangan | Detail |
| --- | --- |
| **Nama** | Diaz Prahardyan |
| **Kelas** | TI-2F |
| **NIM** | [254107020119] |
| **Program Studi** | D4-Teknik Informatika, Politeknik Negeri Malang |

## 🚀 Perkembangan Proyek (Jobsheet 10)

Repositori ini memperbarui proyek dengan sistem otentikasi penuh dan perlindungan rute:

1. **Sistem Akun & Registrasi:**
Penambahan entitas tabel `users` untuk menyimpan profil petugas (nama, *username*, *password*, *role*). Proses registrasi divalidasi dari duplikasi *username*, dan kata sandi diamankan ke dalam basis data menggunakan fungsi `password_hash()`.
2. **Login & Logout (Manajemen Sesi):**
Mekanisme otentikasi menggunakan `password_verify()` untuk mencocokkan kata sandi. Setelah berhasil, identitas pengguna dicatat ke dalam `$_SESSION`. Proses *logout* membersihkan riwayat tersebut menggunakan `session_destroy()`.
3. **Guard Clause (Perlindungan Halaman):**
Implementasi berkas `includes/auth.php` yang bertugas sebagai "penjaga gerbang". Berkas ini wajib dipanggil paling pertama pada halaman-halaman yang membutuhkan akses petugas (seperti form tambah/edit). Jika variabel `$_SESSION['user_id']` tidak ditemukan, sistem akan langsung melempar (*redirect*) pengguna kembali ke halaman *login*.
4. **Pembagian Hak Akses (Routing):**
Aplikasi dibagi menjadi rute publik (`index.php` dan `buku/list.php`) yang tetap bisa diakses pengunjung umum, dan rute privat (seluruh halaman aksi CRUD pada entitas `buku` dan `anggota`) yang terkunci di balik otentikasi.
5. **Navigasi Dinamis:**
Pembaruan pada `includes/header.php` di mana pemanggilan `session_start()` diubah menggunakan pengecekan `session_status() === PHP_SESSION_NONE`. Tampilan *navbar* akan berubah secara otomatis: menampilkan menu Dasbor Petugas dan tombol Logout untuk pengguna sah, atau tautan Login untuk pengunjung biasa.

## 🗄️ Persiapan Database (Wajib Dilakukan)

Sebelum menjalankan fitur *login*, tabel penyimpanan akun pengguna harus dibuat di dalam basis data `simpus_mini`:

1. **Buka Terminal/Tab Query PostgreSQL (Lokal atau Railway):**
2. **Eksekusi Skema Users:** Masukkan skrip pembentuk tabel dari berkas `02_users.sql` dengan mengeksekusi perintah berikut (atau *copy-paste* langsung isi berkasnya ke antarmuka klien *database*):
```sql
psql -d simpus_mini -f sql/02_users.sql

```

## 📁 Struktur Folder Terbaru

Berdasarkan direktori kerja terkini, struktur proyek telah diperluas untuk mengakomodasi modul otentikasi:

```text
Jobsheet-10/
├── anggota/
│   ├── edit.php
│   ├── hapus.php
│   ├── list.php
│   ├── proses_edit.php
│   ├── proses_tambah.php
│   └── tambah.php
├── assets/
│   ├── css/
│   └── js/
├── auth/                       # (BARU) Modul Pendaftaran & Masuk
│   ├── login.php
│   ├── logout.php
│   ├── proses_login.php
│   ├── proses_register.php
│   └── register.php
├── buku/
│   ├── edit.php
│   ├── hapus.php
│   ├── list.php
│   ├── proses_edit.php
│   ├── proses_tambah.php
│   └── tambah.php
├── data/
│   ├── anggota.json
│   └── buku.json
├── docs/
│   └── wireframe.md
├── includes/
│   ├── auth.php                # (BARU) Skrip Penjaga Gerbang (Guard)
│   ├── footer.php
│   ├── header.php              # + Logika Navbar Dinamis
│   └── koneksi.php
├── sql/
│   ├── 01_buku_anggota.sql
│   └── 02_users.sql            # (BARU) Skema Tabel Akun
├── tugas tambahan (images)/
│   ├── README.md
│   ├── Screenshot 2026-10-08 185027.png
│   ├── Screenshot 2026-10-08 185035.png
│   ├── Screenshot 2026-10-08 185102.png
│   ├── Screenshot 2026-10-08 185116.png
│   ├── Screenshot 2026-10-08 185905.png
│   └── Screenshot 2026-10-08 185938.png
├── composer.json
├── dashboard_petugas.php       # (BARU) Dasbor Khusus Petugas
├── index.php
├── migrasi_json.php
├── migrasi_json2.php
└── README.md

```

## ⚙️ Cara Menjalankan

**Opsi 1 — PHP Built-in Server:**
Buka terminal di dalam root folder proyek ini, lalu jalankan perintah:

```bash
php -S localhost:8000

```

Untuk menguji keamanan: cobalah mengakses `http://localhost:8000/buku/tambah.php` secara langsung melalui URL. Sistem harus menolak dan memindahkan Anda ke form *login*.

**Opsi 2 — Laragon / XAMPP:**
Letakkan proyek di dalam folder penampungan (*document root*). Aplikasi mendukung konfigurasi *Virtual Host* langsung (misal: `[http://jobsheet10.test/](http://jobsheet10.test/)`) atau bersarang di bawah folder tugas (misal: `[http://dp2026.test/kode-praktikum/jobsheet-10/](http://dp2026.test/kode-praktikum/jobsheet-10/)`). Pengalihan URL (*redirect*) pada modul `auth.php` dan pemuatan aset pada `header.php` telah dirancang bersifat relatif dinamis sehingga aman dijalankan pada berbagai hierarki direktori.

## ✅ Hasil Pengujian Fitur

* [x] Tabel `users` berhasil didirikan pada PostgreSQL dan siap menampung profil petugas.
* [x] Formulir Registrasi sukses mencatat akun baru dan mengacak kata sandi menggunakan fungsi `password_hash()` bawaan PHP.
* [x] Mekanisme *Login* berhasil memvalidasi kredensial pengguna, memulai *session*, dan membuka gerbang akses ke halaman-halaman manajerial.
* [x] Fungsi perlindungan pada `includes/auth.php` bekerja dengan presisi; mampu mencegat peretas atau tamu yang mencoba memaksa masuk ke form CRUD dengan merespons status *HTTP 302 Redirect*, bahkan sebelum koneksi *database* diinisiasi.
* [x] Tampilan antarmuka (*Navbar*) berhasil mendeteksi identitas pengguna aktif dan menyesuaikan tautan menu secara *real-time*.

## 📌 Catatan Tambahan

* Pada tahap ini, otorisasi spesifik berbasis **peran (*Role-Based Access Control*)** — misalnya, membedakan batasan bahwa hanya akun berlabel `admin` yang diizinkan untuk menghapus data anggota secara permanen, sementara akun `petugas` hanya dapat menambah/mengubah data — belum diimplementasikan penuh di dalam kontroler. Hal tersebut direkomendasikan sebagai latihan pendalaman kompetensi mandiri.

---