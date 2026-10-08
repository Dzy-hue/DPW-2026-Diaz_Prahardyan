# 📖 Jobsheet 9 — CRUD Penuh (SIMPUS-Mini)

## 🎯 Informasi Jobsheet

Sub-CPMK: Membangun fitur CRUD (*Create, Read, Update, Delete*) secara utuh pada proyek, mengimplementasikan *Server-Side Pagination & Search*, serta menerapkan teknik *Soft Delete* untuk menjaga integritas data riwayat.

## 📚 SIMPUS-Mini (Sistem Perpustakaan Mini)

Proyek ini melengkapi siklus manajemen data pada aplikasi perpustakaan. Jika pada *jobsheet* sebelumnya aplikasi hanya mampu merekam dan menampilkan data, pada tahap ini proyek bertransisi menjadi sistem rekam jejak penuh. Pengguna kini dapat memodifikasi data yang sudah ada (*Update*) dan menonaktifkan data (*Delete*) dengan arsitektur keamanan tingkat peladen (pencegahan penghapusan tak disengaja via tautan GET).

## 👨‍💻 Identitas Mahasiswa

| Keterangan | Detail |
| --- | --- |
| **Nama** | Diaz Prahardyan |
| **Kelas** | TI-2F |
| **NIM** | [254107020119] |
| **Program Studi** | D4-Teknik Informatika, Politeknik Negeri Malang |

## 🚀 Perkembangan Proyek (Jobsheet 9)

Repositori ini memperbarui proyek dengan penyelesaian siklus CRUD dan optimasi skala besar:

1. **Edit & Update Data:**
   Penambahan berkas `edit.php` dan `proses_edit.php` pada entitas buku dan anggota. Formulir dirancang untuk menarik data lama secara otomatis, kemudian melakukan eksekusi `UPDATE` dengan klausa `WHERE id = :id` demi mencegah perubahan data massal.
2. **Penghapusan Aman (POST-only Delete):**
   Aksi hapus melalui `hapus.php` kini diamankan menggunakan `$_SERVER['REQUEST_METHOD'] !== 'POST'`. Tombol hapus diubah dari tautan/`<button>` biasa menjadi sebuah formulir `<form>` utuh untuk menghindari risiko eksekusi otomatis oleh *crawler* atau *link preview*.
3. **Intervensi JavaScript (`submit` Event):**
   Fungsi `initHapusConfirm` dan `initEditConfirm` pada `app.js` ditingkatkan. JavaScript kini mendengarkan kejadian `submit` (bukan `click`) dan memanfaatkan `e.preventDefault()` untuk mencegat serta membatalkan pengiriman data jika pengguna tidak jadi melakukan aksi.
4. **Pagination Sisi Peladen:**
   Implementasi klausa `LIMIT` dan `OFFSET` pada kueri PostgreSQL di `list.php` untuk memotong tampilan tabel maksimal 5 baris per halaman, lengkap dengan perulangan angka navigasi *pagination*.
5. **Pencarian Lanjutan (`ILIKE` & `OR`):**
   Fitur pencarian diintegrasikan dengan *pagination* menggunakan metode GET. Skrip diperbarui agar dapat mencari lintas kolom (misal: mencari berdasarkan judul *ataupun* nama pengarang) menggunakan logika `OR`.
6. **Latihan Tambahan (Soft Delete):**
   Mengganti operasi `DELETE` yang merusak secara permanen menjadi operasi `UPDATE is_active = FALSE`. Seluruh kueri penarikan data (*Read*) juga disesuaikan dengan filter `AND is_active = TRUE` agar data seolah terhapus di antarmuka namun tetap tersimpan aman di basis data.

## 🗄️ Persiapan Database (Wajib Dilakukan)

Sebelum menjalankan fitur *Soft Delete* di *jobsheet* ini, struktur tabel harus disesuaikan:

1. **Buka Terminal/Konsol PostgreSQL:** Pastikan peladen database menyala, lalu masuk ke dalam database `simpus_mini`.
2. **Tambah Kolom Penanda Aktif:** Eksekusi kedua baris kueri ini untuk menyuntikkan kolom `is_active`:
   ```sql
   ALTER TABLE buku ADD COLUMN is_active BOOLEAN DEFAULT TRUE;
   ALTER TABLE anggota ADD COLUMN is_active BOOLEAN DEFAULT TRUE;

```

3. Data lama yang sudah ada di dalam tabel akan otomatis mendapatkan nilai `TRUE` (aktif).

## 📁 Struktur Folder Terbaru

```text
Jobsheet-09/
├── anggota/
│   ├── list.php             # + Pagination, pencarian ganda, dan filter Soft Delete
│   ├── edit.php             # (BARU) Form edit data anggota
│   ├── hapus.php            # (BARU) Proses Soft Delete via POST
│   ├── proses_edit.php      # (BARU) Eksekusi UPDATE data anggota
│   ├── proses_tambah.php
│   └── tambah.php
├── assets/
│   ├── css/
│   │   └── style.css        # + Styling form pencarian, pagination, dan tautan edit
│   └── js/
│       └── app.js           # + Modifikasi event listener ke 'submit' & preventDefault
├── buku/
│   ├── edit.php             # (BARU) Form edit data buku
│   ├── hapus.php            # (BARU) Proses Soft Delete via POST
│   ├── list.php             # + Pagination, pencarian ganda, dan filter Soft Delete
│   ├── proses_edit.php      # (BARU) Eksekusi UPDATE data buku
│   ├── proses_tambah.php
│   └── tambah.php
├── data/                    
│   ├── anggota.json
│   └── buku.json            
├── docs/
│   └── wireframe.md         
├── includes/
│   ├── footer.php
│   ├── header.php
│   └── koneksi.php          
├── sql/
│   └── 01_buku_anggota.sql  
├── tugas tambahan (images)/ # Arsip dokumentasi tangkapan layar fitur tambahan
│   ├── README.md
│   └── Screenshot...
├── index.php                
├── migrasi_json.php         
├── migrasi_json2.php        
└── README.md                # Laporan dokumentasi jobsheet 9

```

## ⚙️ Cara Menjalankan

**PENTING:** Pastikan peladen PostgreSQL sudah menyala (*running*) di latar belakang sebelum mengeksekusi aplikasi.

Jalankan aplikasi dengan salah satu opsi berikut:

**Opsi 1 — PHP Built-in Server (Terminal/CLI):**
Buka terminal di dalam root folder proyek ini, lalu jalankan perintah:

```bash
php -S localhost:8000

```

Buka peramban dan akses alamat `http://localhost:8000/index.php`. Lakukan siklus uji coba penuh: tambah → tampil → ubah (Edit) → tampil berubah → hapus → hilang dari tabel.

**Opsi 2 — Laragon / XAMPP / Web Server Lainnya:**
Letakkan proyek di dalam folder *document root*. Akses langsung menggunakan *Virtual Host* (contoh: `http://jobsheet09.test/`) atau melalui rute *localhost* tradisional yang sesuai dengan penempatan direktori Anda.

## ✅ Hasil Pengujian Fitur

* [x] Operasi *Update* berhasil mengubah data secara spesifik tanpa merusak baris data lain berkat pengamanan klausa `WHERE`.
* [x] Formulir *Edit* dan *Hapus* berhasil dicegat oleh JavaScript untuk memunculkan kotak konfirmasi dialog sebelum data benar-benar dikirimkan ke peladen.
* [x] Akses langsung ke `hapus.php` menggunakan URL (metode GET) otomatis ditolak dan dikembalikan ke halaman *list*, melindungi data dari penghapusan massal.
* [x] Navigasi *Pagination* berhasil memecah tampilan tabel menjadi 5 baris per halaman.
* [x] Fitur pencarian ganda (`OR`) terintegrasi sempurna dengan logika *pagination*, memungkinkan pencarian lintas kolom (Judul/Pengarang).
* [x] *Soft Delete* beroperasi sempurna: data yang dihapus hilang dari tampilan aplikasi web, namun dapat dibuktikan masih eksis (dengan nilai `is_active = f`) di dalam basis data PostgreSQL.

## 📌 Catatan Tambahan

* Kolom pencarian di halaman ini kini beroperasi secara *Server-Side*. Kata kunci yang dimasukkan ke URL (`?q=...`) akan diproses langsung oleh PostgreSQL menggunakan filter `ILIKE`.
* **Kerentanan Disengaja:** Nilai masukan dari URL (`$_GET['q']`) saat ini belum disanitasi (*escape*) ketika dicetak kembali ke atribut `value` pada form pencarian. Hal ini sengaja dibiarkan terbuka sebagai bahan evaluasi celah keamanan *Cross-Site Scripting* (XSS) yang akan ditambal secara komprehensif pada Jobsheet 11.

---