# 📖 SIMPUS-mini: UI/UX Design & System Blueprint

Sub-CPMK: Merancang UI/UX aplikasi (proyek).

Selamat datang di repositori dokumentasi **SIMPUS-mini**. Dokumen ini dikhususkan untuk memetakan rancangan alur pengguna (*User Flow*) dan tata letak antarmuka (*Wireframe*) sebelum memasuki tahap penulisan kode interaktif (JavaScript/PHP).

Rancangan visual dalam dokumen ini mengadopsi sistem desain yang sudah berjalan, yaitu menggunakan css murni dengan tema warna **Hijau Gelap (Dark Green)** untuk *header* dan tata letak berbasis **Kartu Putih (White Cards)**.

---

## 📑 Daftar Isi
1. [Definisi Aktor](#1-definisi-aktor)
2. [User Flow (Alur Pengguna)](#2-user-flow-alur-pengguna)
   - [A. Registrasi Pengguna Baru](#a-registrasi-pengguna-baru)
   - [B. Login & Otorisasi](#b-login--otorisasi)
   - [C. Peminjaman Buku (Petugas)](#c-peminjaman-buku-petugas)
   - [D. Pengembalian Buku (Petugas)](#d-pengembalian-buku-petugas)
3. [Wireframe (Sketsa Halaman)](#3-wireframe-sketsa-halaman)
   - [A. Form Registrasi Akun Baru](#a-form-registrasi-akun-baru)
   - [B. Halaman Login](#b-halaman-login)
   - [C. Dashboard Tamu](#c-dashboard-tamu)
   - [D. Dashboard Petugas](#d-dashboard-petugas)
   - [E. Form Peminjaman](#e-form-peminjaman)
   - [F. Pengembalian & Riwayat](#f-pengembalian--riwayat)

---

## 1. Definisi Aktor
Sistem ini memisahkan hak akses ke dalam dua peran utama:
*   **Tamu / Anggota:** Pengguna biasa yang hanya dapat melihat katalog buku dan dasbor pribadi setelah *login*.
*   **Petugas (Admin):** Pengelola perpustakaan yang memiliki akses penuh untuk mengelola data master (buku/anggota) serta melakukan transaksi peminjaman dan pengembalian.

---

## 2. User Flow (Alur Pengguna)

### A. Registrasi Pengguna Baru
Alur bagi pengunjung yang belum memiliki akun untuk mendaftar ke dalam sistem perpustakaan. Hak akses (role) diatur otomatis oleh peladen (*backend*) demi keamanan.

`[Buka Halaman Login]` -> `[Klik "Daftar Akun Baru"]` -> `[Isi Form Registrasi (Nama, Username, Password)]` -> `[Klik "Simpan"]` -> `[Sistem Simpan Data dengan Role Default]` -> `[Tampil Pesan Sukses & Kembali ke Login]`

### B. Login & Otorisasi
Sistem validasi terpadu. Pengguna cukup memasukkan kredensial, dan sistem akan mengarahkan navigasi secara otomatis berdasarkan peran (*role*) yang terdeteksi di database.

`[Buka Halaman Login]` -> `[Input Username & Password]` -> `[Sistem Validasi Kredensial & Cek Role]` -> `[Percabangan Otomatis: Masuk Dashboard Tamu ATAU Dashboard Petugas]`

### C. Peminjaman Buku (Petugas)
*Aturan Bisnis Khusus:* Buku hanya dapat dipilih jika stok lebih dari 0.

`[Dashboard Petugas]` -> `[Menu "Peminjaman Baru"]` -> `[Pilih Anggota]` -> `[Pilih Buku (Stok > 0)]` -> `[Klik "Simpan"]` -> `[Sistem Kurangi Stok Buku (1)]` -> `[Kembali ke Dashboard]`

### D. Pengembalian Buku (Petugas)
*Aturan Bisnis Khusus:* Sistem mencari transaksi yang sudah ada untuk diselesaikan.

`[Dashboard Petugas]` -> `[Menu "Pengembalian"]` -> `[Cari Transaksi Aktif (Anggota/Buku)]` -> `[Klik "Kembalikan"]` -> `[Sistem Tambah Stok Buku (1)]` -> `[Kembali ke Dashboard]`

---

## 3. Wireframe (Sketsa Halaman)

*Catatan: Semua rancangan di bawah ini akan ditempatkan di dalam wadah `<main class="container">` dengan kartu `<section class="card shadow-sm">` agar konsisten dengan desain sebelumnya.*

### A. Form Registrasi Akun Baru
Halaman pendaftaran pengguna baru. Opsi pemilihan hak akses ditiadakan agar sistem yang menentukan tingkat otorisasi secara aman.

```text
========================================================================
| SIMPUS-mini                                        Beranda | Login   |
========================================================================
|                                                                      |
|         +--------------------------------------------------+         |
|         | Pendaftaran Akun Baru                            |         |
|         | ------------------------------------------------ |         |
|         |                                                  |         |
|         | Nama Lengkap                                     |         |
|         | [______________________________________________] |         |
|         |                                                  |         |
|         | Username / No. Anggota                           |         |
|         | [______________________________________________] |         |
|         |                                                  |         |
|         | Password                                         |         |
|         | [______________________________________________] |         |
|         |                                                  |         |
|         |               [ Simpan Pendaftaran ]             |         |
|         |                                                  |         |
|         | Sudah punya akun? [ Kembali ke Login ]           |         |
|         +--------------------------------------------------+         |
|                                                                      |
========================================================================

```

### B. Halaman Login

Gerbang utama sistem. Form diposisikan di tengah (*center-aligned*) dan dirancang cerdas hanya meminta kredensial inti.

```text
========================================================================
| SIMPUS-mini                                        Beranda | Login   |
========================================================================
|                                                                      |
|         +--------------------------------------------------+         |
|         | Login Sistem Perpustakaan                        |         |
|         | ------------------------------------------------ |         |
|         |                                                  |         |
|         | Username / No. Anggota                           |         |
|         | [______________________________________________] |         |
|         |                                                  |         |
|         | Password                                         |         |
|         | [______________________________________________] |         |
|         |                                                  |         |
|         |                [ Masuk ke Sistem ]               |         |
|         |                                                  |         |
|         | Belum punya akun? [ Daftar Akun Baru ]           |         |
|         +--------------------------------------------------+         |
|                                                                      |
========================================================================

```

### C. Dashboard Tamu

Tampilan untuk anggota yang sudah berhasil masuk. Fokus pada ringkasan katalog.

```text
========================================================================
| SIMPUS-mini                Beranda | Daftar Buku | [Nama Anggota] 🚪 |
========================================================================
|                                                                      |
|  +----------------------------------------------------------------+  |
|  | Selamat Datang di Perpustakaan!                                |  |
|  | Jelajahi ratusan koleksi buku terbaru kami hari ini.           |  |
|  +----------------------------------------------------------------+  |
|                                                                      |
|  +----------------------------------------------------------------+  |
|  | Ringkasan Katalog                                              |  |
|  |  +--------------+ +--------------+ +------------+ +---------+  |  |
|  |  |  Total Buku  | | Total Angg.  | |  Dipinjam  | |  Telat  |  |  |
|  |  |     108      | |      30      | |     14     | |   56    |  |  |
|  |  +--------------+ +--------------+ +------------+ +---------+  |  |
|  +----------------------------------------------------------------+  |
========================================================================

```

### D. Dashboard Petugas

Pusat kendali admin dengan tambahan tombol *shortcut* untuk mempermudah operasional harian.

```text
========================================================================
| SIMPUS-mini    Beranda  Dftr.bk  Tbh.bk  Dftr.ag  Tbh.ag | [Admin] 🚪|
========================================================================
|                                                                      |
|  +----------------------------------------------------------------+  |
|  | Selamat Datang di Sistem Perpustakaan mini                     |  |
|  | Aplikasi untuk mengelola koleksi buku dan anggota perpustakaan.|  |
|  +----------------------------------------------------------------+  |
|                                                                      |
|  +----------------------------------------------------------------+  |
|  | Dashboard Petugas                                              |  |
|  |                                                                |  |
|  |  +--------------+ +--------------+ +------------+ +---------+  |  |
|  |  |  Total Buku  | |  Total Angg. | |  Dipinjam  | |  Telat  |  |  |
|  |  |     108      | |      30      | |     14     | |   56    |  |  |
|  |  +--------------+ +--------------+ +------------+ +---------+  |  |
|  +----------------------------------------------------------------+  |
|                                                                      |
|  +----------------------------------------------------------------+  |
|  |                Menu Utama Admin & Daftar Riwayat               |  |
|  |                                                                |  |
|  |   [ + Buat Peminjaman Baru ]          [ - Katalog Peminjaman]  |  |
|  | [ + Terima Pengembalian Buku ]       [ - Katalog Pengembalian] |  |
|  +----------------------------------------------------------------+  |
========================================================================

```

### E. Form Peminjaman

Menggunakan tata letak formulir vertikal standar (label di atas input).

```text
========================================================================
| SIMPUS-mini    Beranda  Dftr.bk  Tbh.bk  Dftr.ag  Tbh.ag | [Admin] 🚪|
========================================================================
|                                                                      |
|  +----------------------------------------------------------------+  |
|  | Form Peminjaman Buku                                           |  |
|  |                                                                |  |
|  | Pilih Anggota (Peminjam)                                       |  |
|  | [ v Pilih dari daftar anggota yang aktif...                  ] |  |
|  |                                                                |  |
|  | Pilih Buku (Hanya tampil jika Stok > 0)                        |  |
|  | [ v Pilih buku dari katalog...                               ] |  |
|  |                                                                |  |
|  | Tanggal Pinjam                                                 |  |
|  | [ DD / MM / YYYY                                             ] |  |
|  |                                                                |  |
|  | [ Simpan Transaksi ]                                           |  |
|  +----------------------------------------------------------------+  |
========================================================================

```

### F. Pengembalian & Riwayat Aktif

Antarmuka berbasis tabel (*data table*) untuk melacak buku yang sedang berada di tangan anggota. Dilengkapi dengan fitur pemantauan batas waktu dan tombol penyelesaian transaksi yang jelas.

```text
=================================================================================
| SIMPUS-mini             Beranda  Dftr.bk  Tbh.bk  Dftr.ag  Tbh.ag | [Admin] 🚪|
=================================================================================
|                                                                               |
|  +-------------------------------------------------------------------------+  |
|  | Transaksi Peminjaman Aktif (Belum Dikembalikan)                         |  |
|  |                                                                         |  |
|  | +---------------------------------------------------------------------+ |  |
|  | | No | Peminjam     | Judul Buku   | Tgl Pnjm | Bts Kmbli| Aksi       | |  |
|  | |----+--------------+--------------+----------+----------+------------| |  |
|  | | 1  | Sarah Geiza  | Filosofi T...| 08/09/26 | 15/09/26 |[Kembalikan]| |  |
|  | | 2  | Radian Rafie | 5 cm         | 09/09/26 | 16/09/26 |[Kembalikan]| |  |
|  | +---------------------------------------------------------------------+ |  |
|  +-------------------------------------------------------------------------+  |
=================================================================================

```

## Konsistensi dengan Desain yang Sudah Berjalan

* Warna aksen, tipografi navbar, dan gaya tabel/kartu mengikuti `assets/css/style.css` yang sudah dibangun sejak Jobsheet 2-3.
* Navbar akan ditambah menu **Peminjaman** dan indikator status login (nama petugas / tombol Logout) mulai implementasi di Jobsheet 10.
* Edge case yang perlu ditangani saat implementasi: buku stok habis tidak boleh dipilih di form peminjaman; anggota dengan tunggakan terlambat divalidasi di Jobsheet 12 (tugas mandiri).