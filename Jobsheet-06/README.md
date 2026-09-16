# 📖 Jobsheet 6 — Asynchronous JavaScript (AJAX & Fetch API) (SIMPUS-Mini)

## 🎯 Informasi Jobsheet

Sub-CPMK: Menerapkan pemanggilan data asinkron berbasis JSON menggunakan Fetch API, penanganan Promise/async-await, serta manipulasi DOM dan Event Delegation tingkat lanjut.

## 📚 SIMPUS-Mini (Sistem Perpustakaan Mini)

Proyek ini adalah aplikasi antarmuka berbasis web untuk mengelola data perpustakaan mini. Pada tahap ini, proyek beralih dari manipulasi DOM statis ke **interaktivitas asinkron (AJAX & Fetch API)** untuk memuat serta merender data buku dan anggota secara dinamis dari berkas JSON tanpa perlu memuat ulang (*reload*) seluruh halaman peramban.

## 👨‍💻 Identitas Mahasiswa

| Keterangan | Detail |
| :--- | :--- |
| **Nama** | Diaz Prahardyan |
| **Kelas** | TI-1D |
| **NIM** | [254107020119] |
| **Program Studi** | D4-Teknik Informatika, Politeknik Negeri Malang |

## 🚀 Perkembangan Proyek (Jobsheet 6)

Repositori ini memperbarui proyek dengan arsitektur data dinamis dan penanganan *event* tingkat lanjut:

1. **Pemisahan Sumber Data JSON:**
   Data tabel buku dan anggota tidak lagi ditulis secara statis di dalam HTML, melainkan dipisahkan ke dalam berkas `data/buku.json` (10 data) dan `data/anggota.json` (empat data). Hal ini meniru alur komunikasi API di dunia nyata.
2. **Pemuatan Data Asinkron & Loading State:**
   Elemen `<tbody>` dikosongkan sejak awal. JavaScript mengambil data menggunakan `fetch()` dan `async/await`, dilengkapi blok penanganan galat terstruktur (`try/catch/finally`) serta indikator pemuatan (*loading indicator*) yang aktif selama proses transfer data.
3. **Fungsi Generik Render Tabel (Prinsip DRY):**
   Menghindari duplikasi kode antara `buku.js` dan `anggota.js` dengan menyatukan logika perenderan ke dalam satu fungsi serbaguna `muatTabelData(url, daftarKunci)` di dalam `app.js`. Fungsi ini mampu merender tabel apa pun secara dinamis berdasarkan parameter berkas dan kunci data.
4. **Event Delegation pada Tombol Hapus:**
   Mengubah pemasangan *event listener* dari elemen spesifik menjadi delegasi di tingkat `document` (`e.target.closest(".btn-hapus")`). Pendekatan ini memanfaatkan prinsip *event bubbling*, sehingga tombol hapus pada baris dinamis tetap dapat merespons klik meskipun elemen baru dibuat setelah *fetch* selesai.
5. **Sinkronisasi Counter Data Real-Time:**
   Fungsi `updateCounter()` disinkronkan agar otomatis menghitung ulang baris data yang tampil, baik saat data selesai dirender pertama kali, saat baris dihapus, maupun saat disaring melalui kotak pencarian (*search filter*).
6. **Penyempurnaan Fitur Tambahan (Latihan Mandiri):**
   - Penambahan tombol **Muat Ulang Data** dengan gaya visual selaras tema hijau perpustakaan.
   - Penambahan kolom **Kategori** pada data buku, struktur `<th>`, dan pemetaan kunci properti di tabel.
   - Pengujian visual ketahanan antarmuka dengan simulasi keterlambatan jaringan (*network delay*).

## 📁 Struktur Folder Terbaru

```text
jobsheet-06/
├── index.html          # Pembaruan navigasi dan pemanggilan skrip
├── assets/
│   ├── css/
│   │   └── style.css   # Penambahan gaya tombol muat ulang & indikator loading
│   └── js/
│       ├── app.js      # Pusat logika: Event Delegation, updateCounter, dan muatTabelData
│       ├── buku.js     # Pemanggilan muatTabelData untuk buku & event listener reload
│       └── anggota.js  # Pemanggilan muatTabelData untuk anggota
├── data/
│   ├── buku.json       # Berkas sumber 10 data buku (termasuk properti kategori)
│   └── anggota.json    # Berkas sumber 4 data anggota
├── buku/
│   ├── list.html       # Penambahan indikator loading, tombol reload, dan kolom kategori
│   └── tambah.html     # Formulir tambah buku
├── anggota/
│   ├── list.html       # Penambahan indikator loading & penyiapan wadah tabel dinamis
│   └── tambah.html     # Formulir tambah anggota
├── docs/
│   └── wireframe.md    # Desain antarmuka aplikasi
├── README.md           # Dokumentasi laporan jobsheet ini (Bab 1 s.d. Bab 8)
```

⚙️ Cara Menjalankan
PENTING (Batasan Keamanan CORS): Berkas tidak dapat dijalankan dengan klik ganda langsung dari File Explorer (file:///). Kebijakan keamanan peramban memblokir permintaan fetch() ke berkas lokal.

Jalankan aplikasi melalui server lokal dengan salah satu opsi berikut:

1. VS Code Live Server: Klik kanan pada berkas index.html atau buku/list.html, lalu pilih Open with Live Server.

2. PHP Built-in Server: Buka terminal di dalam folder proyek ini, lalu jalankan:

Bash
php -S localhost:8000
Buka peramban dan akses alamat http://localhost:8000/index.html.

✅ Hasil Pengujian Fitur
[x] Pemuatan data otomatis saat halaman selesai dimuat (DOMContentLoaded).

[x] Teks loading muncul selama proses pengambilan data berlangsung dan hilang setelah selesai.

[x] Data buku (10 data) dan anggota (empat data) berhasil dirender ke tabel.

[x] Fitur pencarian menyaring data secara instan dan memperbarui teks counter.

[x] Tombol hapus memunculkan dialog konfirmasi dan menghapus baris dari DOM secara dinamis.

[x] Tombol “Muat Ulang Data” berhasil memuat kembali baris yang sempat terhapus.

[x] Penanganan galat 404 menampilkan baris peringatan merah jika berkas JSON tidak ditemukan.

📌 Catatan Tambahan
- Penanganan galat (error handling) telah diuji menggunakan status HTTP 404 (simulasi salah ketik URL berkas JSON), yang menghasilkan baris peringatan merah terbentang rapi (colspan) di dalam tabel.

- Validasi data formulir dan penghapusan baris pada tahap ini masih beroperasi di sisi peramban (front-end). Sinkronisasi manipulasi data langsung ke basis data permanen akan dipelajari pada jobsheet berikutnya.

---
*Dokumentasi ini dirangkum dari instruksi Jobsheet Praktikum Desain & Pemrograman Web.*