# 📖 Jobsheet 2 — CSS3 Styling Dasar (SIMPUS-Mini)

## 🎯 Informasi Jobsheet

Sub-CPMK: Mengimplementasikan styling dasar dengan CSS3.

## 📚 SIMPUS-Mini (Sistem Perpustakaan Mini)

Proyek ini adalah aplikasi antarmuka berbasis web statis untuk mengelola data perpustakaan mini. Proyek ini dikembangkan secara bertahap untuk mempelajari dan mengimplementasikan struktur dasar halaman web beserta desain antarmukanya.

## 👨‍💻 Identitas Mahasiswa

| Keterangan | Detail |
| :--- | :--- |
| **Nama** | Diaz Prahardyan |
| **Kelas** | TI-2F |
| **NIM** | [254107020119] |
| **Program Studi** | D4-Teknik Informatika, Politeknik Negeri Malang |

## 🚀 Perkembangan Proyek (Jobsheet 2)

Repositori ini menggabungkan penerapan dari dua materi utama:

1. **HTML5 Semantic Skeleton:** 
   Penyusunan kerangka halaman secara terstruktur menggunakan tag semantik seperti `<header>`, `<nav>`, `<main>`, `<section>`, `<article>`, dan `<footer>`. Semua data yang ditampilkan pada tabel maupun form masih berupa data *dummy* statis.
2. **CSS3 Styling Dasar:** 
   Implementasi antarmuka visual yang dipusatkan pada file `style.css`. Tata letak memanfaatkan **Flexbox** untuk *navbar* yang responsif dan **CSS Grid** untuk menyusun susunan kartu statistik pada halaman beranda.

## 📁 Struktur Folder Terbaru

```text
jobsheet-02/
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
3. Navigasi antar halaman (*Beranda, Daftar Buku, dll*) sudah terhubung sepenuhnya menggunakan tautan relatif.

## 📌 Catatan Tambahan

- Proyek ini masih murni menggunakan HTML dan CSS statis. Belum ada interaktivitas dengan JavaScript maupun integrasi ke *backend* atau *database*.
- Navigasi antar halaman dalam sub-folder menggunakan format tautan relatif (`../` untuk naik satu level) agar saling terhubung.
- Penggunaan *class* CSS dirancang bersifat generik (memanfaatkan *tag* semantik) agar gaya tampilan dapat digunakan kembali (*reusable*) di berbagai halaman tanpa harus menulis ulang kode.

---
*Dokumentasi ini dirangkum dari instruksi Jobsheet Praktikum Desain & Pemrograman Web.*