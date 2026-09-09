# 📖 Jobsheet 3 Bootstrap — CSS3 Styling Dasar (SIMPUS-Mini)

## 🎯 Informasi Jobsheet

Sub-CPMK: Membangun tampilan responsif menggunakan Framework CSS (Bootstrap).

## 📚 SIMPUS-Mini (Sistem Perpustakaan Mini)

Proyek ini adalah aplikasi antarmuka berbasis web statis untuk mengelola data perpustakaan mini. Versi ini adalah alternatif dari jobsheet-03 (CSS murni) — halaman dan fungsionalitasnya identik, tapi seluruh tata letak dibangun memakai Bootstrap 5 (dimuat via CDN) alih-alih menulis CSS dari nol.

## 👨‍💻 Identitas Mahasiswa

| Keterangan | Detail |
| :--- | :--- |
| **Nama** | Diaz Prahardyan |
| **Kelas** | TI-2F |
| **NIM** | [254107020119] |
| **Program Studi** | D4-Teknik Informatika, Politeknik Negeri Malang |

## 🚀 Perkembangan Proyek (Jobsheet 3 Bootstrap)

Repositori ini menggabungkan penerapan dari tiga materi utama:

1. **HTML5 Semantic Skeleton:** 
   Penyusunan kerangka halaman secara terstruktur menggunakan tag semantik seperti `<header>`, `<nav>`, `<main>`, `<section>`, `<article>`, dan `<footer>`. Semua data yang ditampilkan pada tabel maupun form masih berupa data *dummy* statis.
2. **CSS3 Styling Dasar:** 
   Implementasi antarmuka visual yang dipusatkan pada file `style.css`. Tata letak memanfaatkan **Flexbox** untuk *navbar* yang responsif dan **CSS Grid** untuk menyusun susunan kartu statistik pada halaman beranda.
3. **Responsive Design dengan Bootstrap**
   Repositori ini merupakan versi alternatif dari Jobsheet 3 (CSS murni) yang berfokus pada penerapan Responsive Web Design menggunakan framework Bootstrap 5. Pembaruan utamanya meliputi penggunaan Bootstrap CDN, penerapan komponen navbar responsif berbasis JavaScript, pemanfaatan sistem grid 12 kolom dan komponen card bawaan, penggunaan kelas utilitas (utility classes) untuk tabel dan formulir, serta penyusutan ukuran file CSS kustom yang kini hanya berfungsi untuk menimpa (override) warna brand.

## 📁 Struktur Folder Terbaru

```text
jobsheet-03-Bootstrap/
├── index.html          # Halaman beranda utama dengan ringkasan statistik
├── assets/
│   └── css/
│       └── style.css   # Stylesheet global pengatur layout, warna, & tipografi
├── buku/
│   ├── list.html       # Halaman berisi tabel daftar buku
│   └── tambah.html     # Halaman form input untuk data buku baru
├── anggota/
│   ├── list.html       # Halaman berisi tabel daftar anggota perpustakaan
│   └── tambah.html     # Halaman form registrasi anggota baru
└── README.md           # Dokumentasi jobsheet ini
```

## 🛠️ Cara Menjalankan

1. *Clone* atau unduh repositori ini ke komputer lokal.
2. Buka file `index.html` menggunakan *web browser* (Chrome, Firefox, Edge, dsb).
3. Uji dengan DevTools responsive mode pada 3 breakpoint (mobile ≤480px, tablet ~768px, desktop ≥1024px).

## 📌 Catatan Tambahan

- Penggunaan framework Bootstrap mempercepat proses pembuatan tata letak responsif karena pemanfaatan kelas utilitas siap pakai (utility classes).
- Warna brand SIMPUS-Mini (#1d5b8a) bukan bagian tema bawaan Bootstrap, sehingga tetap ditulis manual lewat atribut style dan sedikit CSS custom.
- Penggunaan bootstrap.bundle.min.js sudah mencakup skrip untuk Popper, sehingga komponen interaktif seperti menu dropdown, collapse, dan modal dapat berfungsi langsung tanpa konfigurasi tambahan.

---
*Dokumentasi ini dirangkum dari instruksi Jobsheet Praktikum Desain & Pemrograman Web.*