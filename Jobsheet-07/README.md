# 📖 Jobsheet 7 — PHP Dasar & Form Handling (SIMPUS-Mini)

## 🎯 Informasi Jobsheet

Sub-CPMK: Mengimplementasikan dasar sintaks PHP, arsitektur modular (*server-side include*), pengolahan formulir (Method POST), validasi data di sisi peladen (*server-side validation*), serta manajemen status sementara menggunakan Session.

## 📚 SIMPUS-Mini (Sistem Perpustakaan Mini)

Proyek ini adalah aplikasi antarmuka berbasis web untuk mengelola data perpustakaan mini. Pada tahap ini, proyek mengalami transisi arsitektur secara besar-besaran: beralih dari manipulasi *client-side* statis (AJAX/Fetch API) menuju pemrosesan *server-side* murni menggunakan **PHP**. Data tidak lagi dibaca dari berkas JSON, melainkan dikelola sementara di dalam memori peladen melalui mekanisme **Sesi (Session)** sebelum kelak dipersiapkan menuju basis data permanen.

## 👨‍💻 Identitas Mahasiswa

| Keterangan | Detail |
| --- | --- |
| **Nama** | Diaz Prahardyan |
| **Kelas** | TI-2F |
| **NIM** | [254107020119] |
| **Program Studi** | D4-Teknik Informatika, Politeknik Negeri Malang |

## 🚀 Perkembangan Proyek (Jobsheet 7)

Repositori ini memperbarui proyek dengan arsitektur sistem *back-end* dasar yang dinamis:

1. **Konversi Ekstensi & Eksekusi Server:**
Seluruh halaman `.html` telah dikonversi menjadi `.php`, memungkinkan penyisipan logika *server-side* sebelum halaman dikirimkan ke peramban.
2. **Sistem Templat Modular (DRY Principle):**
Memisahkan elemen navigasi dan kaki halaman ke dalam `includes/header.php` dan `includes/footer.php`. Elemen ini dipanggil menggunakan `include`. Kalkulasi *path* relatif (`$base`) diterapkan agar rute pemanggilan CSS/JS selalu tepat tanpa memedulikan kedalaman subfolder.
3. **Pengolahan Formulir Berbasis POST:**
Formulir pada `buku/tambah.php` dan `anggota/tambah.php` kini memiliki atribut `method="post"` yang mengarah langsung ke berkas pemroses `proses_tambah.php`.
4. **Validasi Server-Side yang Tangguh:**
Logika validasi (seperti rentang tahun, angka stok, format regex ISBN, dan validasi karakter) dieksekusi di peladen. Hal ini memastikan integritas data tetap terjamin meskipun eksekusi JavaScript di peramban dimatikan secara paksa oleh pengguna.
5. **Manajemen Sesi (`$_SESSION`):**
Menggantikan peran Fetch JSON dengan menggunakan memori sesi peladen. Proses penambahan data akan disimpan ke dalam *array* `$_SESSION['buku']` atau `$_SESSION['anggota']` lalu dirender pada halaman `list.php` menggunakan perulangan `foreach`.
6. **Implementasi Flash Message:**
Sistem notifikasi berhasil/gagal diimplementasikan melalui `$_SESSION['flash']`. Pesan ini didesain agar hanya tampil satu kali (*render & destroy/unset*) setelah pengguna dialihkan (*redirect*) dari proses formulir.
7. **Penyempurnaan Visual & UI/UX:**
* Pembaruan kartu Ringkasan pada Beranda menggunakan CSS Grid (format presisi 2x2).
* Penambahan efek interaktif (*hover*) melayang pada kartu statistik dan tombol aksi.
* Restrukturisasi pembungkus formulir (`<div class="form-group">`) agar lebih profesional dan proporsional.
* Penambahan tombol "Reset Data" berbasis `session_destroy()`.



## 📁 Struktur Folder Terbaru

```text
jobsheet-07/
├── index.php           # Beranda dinamis (terdapat ringkasan dari session)
├── reset.php           # Berkas pemroses pembersihan sesi (latihan mandiri)
├── debug_session.php   # Berkas pemantau struktur array data (latihan mandiri)
├── includes/
│   ├── header.php      # Kerangka atas HTML, kalkulasi path relatif otomatis, dan navigasi
│   └── footer.php      # Kerangka bawah HTML dan copyright
├── assets/
│   ├── css/
│   │   └── style.css   # Penyesuaian CSS Grid 2x2, perbaikan form form-group, flash & efek hover
│   └── js/
│       └── app.js      # Tetap ada untuk interaktivitas dasar UI (hamburger menu, dll.)
├── buku/
│   ├── list.php        # Menampilkan data tabel dari $_SESSION['buku']
│   ├── tambah.php      # Formulir UI penambahan data buku
│   └── proses_tambah.php # Penanganan validasi POST & sesi buku
├── anggota/
│   ├── list.php        # Menampilkan data tabel dari $_SESSION['anggota']
│   ├── tambah.php      # Formulir UI penambahan data anggota
│   └── proses_tambah.php # Penanganan validasi POST & sesi anggota
├── docs/
│   └── wireframe.md    # Desain antarmuka aplikasi
└── README.md           # Laporan dokumentasi jobsheet 7

```

*(Catatan: Berkas AJAX statis seperti `buku.js`, `anggota.js`, serta folder `data/` telah **dihapus** karena proses rendering kini ditangani penuh oleh PHP).*

## ⚙️ Cara Menjalankan

**PENTING:** Karena menggunakan PHP, berkas tidak dapat lagi dibuka secara langsung melalui klik ganda (file:///). Anda harus menggunakan peladen web lokal (Local Web Server).

Jalankan aplikasi dengan salah satu opsi berikut:

**Opsi 1 — PHP Built-in Server (Terminal/CLI):**
Buka terminal di dalam root folder proyek ini, lalu jalankan perintah:

```bash
php -S localhost:8000

```

Buka peramban dan akses alamat `http://localhost:8000/index.php`.

**Opsi 2 — Laragon / XAMPP:**
Letakkan proyek di dalam folder `www` (Laragon) atau `htdocs` (XAMPP). Akses secara langsung menggunakan Virtual Host (contoh: `[http://jobsheet07.test/](http://jobsheet07.test/)`) atau melalui rute localhost tradisional.

## ✅ Hasil Pengujian Fitur

* [x] Elemen antarmuka dari `header.php` dan `footer.php` berhasil dirender sempurna di segala kedalaman direktori tanpa *error routing* (berkat `$base`).
* [x] Data dari form POST berhasil ditangkap, divalidasi, dan dimasukkan ke dalam keranjang `$_SESSION`.
* [x] *Flash Message* (hijau untuk sukses, merah untuk error) sukses tampil di halaman tujuan, dan menghilang secara otomatis saat di-refresh (fungsi `unset`).
* [x] Validasi server-side terbukti anti-tembus saat diuji coba melalui pengiriman form kosong dengan kondisi JavaScript peramban dinonaktifkan.
* [x] Tampilan Beranda telah sejajar sempurna menjadi Grid 2x2 di desktop dengan efek *hover* yang responsif.
* [x] Fungsi tombol **Reset Data** sukses mengeksekusi `session_destroy()` dan membersihkan seluruh riwayat input dari peramban.

## 📌 Catatan Tambahan

* Mekanisme penyimpanan melalui `$_SESSION` hanyalah perantara logis yang sifatnya **sementara**. Data yang direkam akan terhapus (*wipe out*) saat peramban ditutup sepenuhnya atau masa pakai sesi telah usai.
* Sistem arsitektur pemrosesan formulir (*Form-Processing-Redirect*) yang ditanamkan pada tahap ini adalah simulasi langsung terhadap penerapan arsitektur *back-end* standar industri.
* Sinkronisasi manipulasi data menuju basis data yang permanen (PostgreSQL) akan mulai direalisasikan pada jobsheet berikutnya.