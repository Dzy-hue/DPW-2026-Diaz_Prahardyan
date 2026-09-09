# 📖 Jobsheet 3 — Responsive Design (SIMPUS-Mini)

## 🎯 Informasi Jobsheet

Sub-CPMK: Membangun tampilan responsif dengan css murni.

## 📚 SIMPUS-Mini (Sistem Perpustakaan Mini)

Proyek ini adalah aplikasi antarmuka berbasis web statis untuk mengelola data perpustakaan mini. Proyek ini dikembangkan secara bertahap untuk mempelajari dan mengimplementasikan struktur dasar halaman web beserta desain antarmukanya.

## 👨‍💻 Identitas Mahasiswa

| Keterangan | Detail |
| :--- | :--- |
| **Nama** | Diaz Prahardyan |
| **Kelas** | TI-2F |
| **NIM** | [254107020119] |
| **Program Studi** | D4-Teknik Informatika, Politeknik Negeri Malang |

## 🚀 Perkembangan Proyek (Jobsheet 3)

Repositori ini menggabungkan penerapan dari tiga materi utama:

1. **HTML5 Semantic Skeleton:** 
   Penyusunan kerangka halaman secara terstruktur menggunakan tag semantik seperti `<header>`, `<nav>`, `<main>`, `<section>`, `<article>`, dan `<footer>`. Semua data yang ditampilkan pada tabel maupun form masih berupa data *dummy* statis.
2. **CSS3 Styling Dasar:** 
   Implementasi antarmuka visual yang dipusatkan pada file `style.css`. Tata letak memanfaatkan **Flexbox** untuk *navbar* yang responsif dan **CSS Grid** untuk menyusun susunan kartu statistik pada halaman beranda.
3. **Responsive Design**
   Repositori ini melanjutkan materi sebelumnya dengan fokus pada Responsive Web Design guna memastikan tampilan halaman web dapat menyesuaikan secara otomatis di berbagai ukuran perangkat tanpa memerlukan halaman terpisah. Pembaruan utama dari Jobsheet 2 meliputi penambahan tag meta viewport, penerapan menu hamburger murni CSS berbasis checkbox hack untuk layar kecil, penggunaan pembungkus tabel responsif agar dapat digeser secara horizontal, serta pengaturan media query pada file CSS untuk menyesuaikan jumlah kolom grid kartu statistik secara dinamis.

## 📁 Struktur Folder Terbaru

```text
jobsheet-03/
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
- Hamburger di jobsheet ini masih murni CSS (checkbox hack). Di Jobsheet 5 akan diganti dengan toggle berbasis JavaScript.
- Penulisan aturan @media query ditempatkan pada bagian paling bawah file style.css agar aturan gaya spesifik layar kecil dapat menimpa (override) gaya default desktop dengan benar tanpa merusak struktur kueri utama.
- Pengujian tata letak responsif sangat disarankan menggunakan fitur Device Emulation pada Developer Tools browser (seperti Chrome DevTools) untuk memastikan tidak ada elemen yang meluber atau terpotong (overflow) pada rentang layar di bawah 480px.

---
*Dokumentasi ini dirangkum dari instruksi Jobsheet Praktikum Desain & Pemrograman Web.*