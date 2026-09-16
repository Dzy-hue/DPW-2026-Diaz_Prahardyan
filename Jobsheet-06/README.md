# 📖 Jobsheet 5 — JavaScript DOM & Event (SIMPUS-Mini)

## 🎯 Informasi Jobsheet

Sub-CPMK: Menerapkan manipulasi DOM & event JavaScript.

## 📚 SIMPUS-Mini (Sistem Perpustakaan Mini)

Proyek ini adalah aplikasi antarmuka berbasis web statis untuk mengelola data perpustakaan mini. Pada tahap ini, proyek mulai dilengkapi dengan **interaktivitas JavaScript** untuk mengubah halaman web statis menjadi aplikasi yang lebih responsif dan "hidup" saat berinteraksi dengan pengguna.

## 👨‍💻 Identitas Mahasiswa

| Keterangan | Detail |
| :--- | :--- |
| **Nama** | Diaz Prahardyan |
| **Kelas** | TI-1D |
| **NIM** | [254107020119] |
| **Program Studi** | D4-Teknik Informatika, Politeknik Negeri Malang |

## 🚀 Perkembangan Proyek (Jobsheet 5)

Repositori ini memperbarui proyek dengan 4 fitur utama berbasis JavaScript:

1. **Menu Hamburger Dinamis (JS):** 
   Menggantikan metode *checkbox hack* murni CSS dari jobsheet sebelumnya dengan tombol asli yang dikendalikan oleh JavaScript (`classList.toggle`), memberikan struktur kode yang lebih rapi dan semantik.
2. **Filter Tabel Real-Time:** 
   Pencarian data yang langsung menyaring baris pada tabel Daftar Buku dan Daftar Anggota di setiap ketikan keyboard (menggunakan event `keyup`), tanpa memerlukan *reload* halaman. Pencarian difokuskan secara spesifik pada kolom judul/nama.
3. **Konfirmasi Hapus Data:** 
   Tombol "Hapus" pada tabel kini dilengkapi dengan fitur peringatan menggunakan kotak dialog bawaan `confirm()`. Jika disetujui, baris data akan dihilangkan dari tampilan menggunakan manipulasi DOM (`remove()`).
4. **Validasi Form Client-Side:** 
   Formulir "Tambah Buku" dan "Tambah Anggota" kini mencegat pengiriman data kosong atau format yang salah (misalnya rentang tahun atau stok negatif). Pesan *error* disisipkan secara dinamis langsung di bawah kolom input menggunakan fungsi `insertAdjacentElement`, memberikan *feedback* visual yang instan tanpa perlu menyegarkan halaman.

## 📁 Struktur Folder Terbaru

```text
jobsheet-05/
├── index.html          # Pembaruan pemanggilan file JS di footer
├── assets/             
│   ├── css/
│   │   └── style.css   # Penambahan class penunjang error & animasi JS
│   └── js/
│       └── app.js      # BARU — Pusat kendali logika DOM & Event
├── buku/
│   ├── list.html       # Penambahan search-box & class btn-hapus
│   └── tambah.html     # Penambahan novalidate & ID form
├── anggota/
│   ├── list.html       # Penambahan search-box & class btn-hapus
│   └── tambah.html     # Penambahan novalidate & ID form
├── docs/
│   └── wireframe.md    # Sama persis dengan jobsheet-04
└── README.md           # Dokumentasi jobsheet ini
```

## 📌 Catatan Tambahan
- Validasi pada jobsheet ini murni bersifat client-side (berjalan di browser) untuk melatih manipulasi DOM dan UX, sehingga masih bisa dilewati jika pengguna menonaktifkan JavaScript. Lapisan keamanan mutlak di sisi server (server-side) akan dibangun pada Jobsheet 7.

- Fungsi hapus baris masih bersifat front-end (hanya dihilangkan dari tampilan layar sementara). Penghapusan data secara permanen pada basis data akan diimplementasikan mulai Jobsheet 9.

---
*Dokumentasi ini dirangkum dari instruksi Jobsheet Praktikum Desain & Pemrograman Web.*