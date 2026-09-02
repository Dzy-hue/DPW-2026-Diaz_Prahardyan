# 📖 Joobsheet 1 - HTML5 Semantic Skeleton

## 🎯 Informasi Jobsheet

Sub-CPMK: Menyusun struktur halaman web dengan HTML5 semantic.

## 📚 SIMPUS-Mini (Sistem Perpustakaan Mini)

Proyek ini adalah aplikasi antarmuka berbasis web statis untuk mengelola data perpustakaan mini. Proyek ini dikembangkan secara bertahap untuk mempelajari dan mengimplementasikan struktur dasar halaman web beserta desain antarmukanya.

## 👨‍💻 Identitas Mahasiswa

| Keterangan | Detail |
| :--- | :--- |
| **Nama** | Diaz Prahardyan |
| **Kelas** | TI-2F |
| **NIM** | [254107020119] |
| **Program Studi** | D4-Teknik Informatika, Politeknik Negeri Malang |

## 🚀 Perkembangan Proyek (Jobsheet 1)

Repositori ini menggunakan penerapan dari materi utama:

1. **HTML5 Semantic Skeleton:** 
   Penyusunan kerangka halaman secara terstruktur menggunakan tag semantik seperti `<header>`, `<nav>`, `<main>`, `<section>`, `<article>`, dan `<footer>`. Semua data yang ditampilkan pada tabel maupun form masih berupa data *dummy* statis.

## 📁 Struktur Folder 

```text
jobsheet-01/
├── index.html          # Halaman beranda utama dengan ringkasan statistik
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

## 📝 Jawaban Latihan Reflektif (Bab 6.5)

1. **Kenapa field "Alamat" dan "No. HP" tidak diberi `required`, sedangkan "Nama" dan "No. Anggota" diberi?**
   **Jawaban:** Karena "Nama" dan "No. Anggota" merupakan data utama yang wajib ada (esensial) untuk mengidentifikasi seorang anggota perpustakaan. Sementara itu, "Alamat" dan "No. HP" disetel sebagai data tambahan yang bersifat opsional (boleh dikosongkan).

2. **Apa yang akan terjadi (di browser) kalau kamu klik tombol "Simpan" tanpa mengisi field "Nama"?**
   **Jawaban:** Browser akan mencegah form terkirim (submit) dan memunculkan pop-up peringatan bawaan browser (seperti *"Please fill out this field"* atau *"Isi bidang ini"*) yang menunjuk ke kotak input "Nama", karena elemen tersebut memiliki atribut `required`.

3. **Form ini juga belum punya atribut `action` pada tag `<form>`-nya — apa dampaknya saat tombol "Simpan" ditekan?**
   **Jawaban:** Karena tidak ada instruksi ke mana data harus dikirim, menekan tombol simpan hanya akan memicu perilaku default browser, yaitu memuat ulang (*refresh*) halaman itu sendiri ke URL saat ini, tanpa memproses atau menyimpan data ke mana pun.

## 📌 Catatan

- Belum ada CSS/JS — fokus murni pada struktur semantic (`<header>`, `<nav>`, `<main>`, `<section>`, `<article>`, `<footer>`).
- Penamaan atribut `name` / `id` pada form sudah disiapkan, yang nantinya akan dipakai kembali di jobsheet berikutnya.
- Aplikasi belum bisa menyimpan data sungguhan — semua data di tabel masih berupa data dummy (contoh) yang ditulis manual di HTML, dan form belum diproses ke mana pun.

---
*Dokumentasi ini dirangkum dari instruksi Jobsheet Praktikum Desain & Pemrograman Web.*

