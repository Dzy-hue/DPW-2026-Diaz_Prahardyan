# 📖 Jobsheet 4 — UI/UX Design (SIMPUS-Mini)

## 🎯 Informasi Jobsheet

Sub-CPMK: Merancang UI/UX aplikasi (proyek).

## 📚 SIMPUS-Mini (Sistem Perpustakaan Mini)

Proyek ini adalah aplikasi antarmuka berbasis web statis untuk mengelola data perpustakaan mini. Proyek ini dikembangkan secara bertahap untuk mempelajari dan mengimplementasikan struktur dasar halaman web beserta desain antarmukanya.

## 👨‍💻 Identitas Mahasiswa

| Keterangan | Detail |
| :--- | :--- |
| **Nama** | Diaz Prahardyan |
| **Kelas** | TI-2F |
| **NIM** | [254107020119] |
| **Program Studi** | D4-Teknik Informatika, Politeknik Negeri Malang |

## 🚀 Perkembangan Proyek (Jobsheet 4)

Repositori ini menggabungkan penerapan dari 4 materi utama:

1. **HTML5 Semantic Skeleton:** 
   Penyusunan kerangka halaman secara terstruktur menggunakan tag semantik seperti `<header>`, `<nav>`, `<main>`, `<section>`, `<article>`, dan `<footer>`. Semua data yang ditampilkan pada tabel maupun form masih berupa data *dummy* statis.
2. **CSS3 Styling Dasar:** 
   Implementasi antarmuka visual yang dipusatkan pada file `style.css`. Tata letak memanfaatkan **Flexbox** untuk *navbar* yang responsif dan **CSS Grid** untuk menyusun susunan kartu statistik pada halaman beranda.
3. **Responsive Design**
   Repositori ini melanjutkan materi sebelumnya dengan fokus pada Responsive Web Design guna memastikan tampilan halaman web dapat menyesuaikan secara otomatis di berbagai ukuran perangkat tanpa memerlukan halaman terpisah. Pembaruan utama dari Jobsheet 2 meliputi penambahan tag meta viewport, penerapan menu hamburger murni CSS berbasis checkbox hack untuk layar kecil, penggunaan pembungkus tabel responsif agar dapat digeser secara horizontal, serta pengaturan media query pada file CSS untuk menyesuaikan jumlah kolom grid kartu statistik secara dinamis.
4. **Perancangan UI/UX**
   Repositori ini berfokus pada perancangan UI/UX Design sebelum membangun fitur kompleks, dengan catatan bahwa tidak ada perubahan kode HTML/CSS dari Jobsheet 3, melainkan penambahan dokumen docs/wireframe.md yang memuat rancangan wireframe teks serta user flow untuk fitur-fitur baru yang belum dikembangkan.

## 📁 Struktur Folder Terbaru

```text
jobsheet-04/
├── index.html          # sama persis dengan joobsheet-03
├── assets/             
│   └── css/
│       └── style.css   # Sama persis dengan jobsheet-03
├── buku/
│   ├── list.html       # Sama persis dengan jobsheet-03
│   └── tambah.html     # Sama persis dengan jobsheet-03
├── anggota/
│   ├── list.html       # Sama persis dengan jobsheet-03
│   └── tambah.html     # Sama persis dengan jobsheet-03
└── README.md           # Dokumentasi jobsheet ini
```

## 📌 Catatan Tambahan

- Dokumen docs/wireframe.md menjadi acuan struktur HTML baru yang mulai diimplementasikan pada Jobsheet 5 dan seterusnya (interaktivitas JS, lalu PHP/PostgreSQL untuk fitur Login & Peminjaman).
- Perancangan UI/UX dilakukan terlebih dahulu sebelum menulis kode agar pengembang memiliki cetak biru alur pengguna yang jelas dan terstruktur.

---
*Dokumentasi ini dirangkum dari instruksi Jobsheet Praktikum Desain & Pemrograman Web.*