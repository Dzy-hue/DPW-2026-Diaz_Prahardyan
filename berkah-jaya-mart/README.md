# 🛒 Laporan Pengerjaan & Dokumentasi — BerkahJaya-Mart | Sistem Manajemen Toko Terpadu

## 👨‍💻 Identitas Mahasiswa

| Keterangan | Detail |
| --- | --- |
| **Nama** | Diaz Prahardyan |
| **Kelas** | TI-2F |
| **NIM** | 254107020119 |
| **Program Studi** | D4-Teknik Informatika, Politeknik Negeri Malang |

---

## 📝 Ringkasan Proyek

**BerkahJaya-Mart (BJ-Mart)** adalah aplikasi *dashboard* manajemen toko kelontong dan kasir minimarket harian berbasis *web* sisi-klien (*client-side*). Proyek ini dibangun sepenuhnya menggunakan **Vanilla HTML, CSS, dan JavaScript** tanpa memerlukan *server backend* atau basis data SQL. Aplikasi ini memanfaatkan arsitektur `localStorage` untuk menyimpan, mengubah, dan menjaga persistensi data secara *real-time* di dalam memori *browser*.

Terdapat dua entitas utama yang saling terhubung di dalam sistem: **Produk** (terbagi ke dalam tiga kategori) dan **Transaksi**.

---

## ✨ Fitur Utama

### 📊 1. Dashboard Interaktif (Real-time Metrics)

Halaman beranda secara otomatis menghitung dan merangkum data dari seluruh memori penyimpanan:

* **Total Produk:** Menghitung keseluruhan produk dari seluruh kategori.


* **Total Transaksi:** Menghitung jumlah keseluruhan riwayat penjualan.


* **Kategori:** Menampilkan jumlah kategori inventaris yang tersedia (3 kategori).


* **Stok Menipis:** Memberikan peringatan angka otomatis untuk produk yang sisa stoknya kurang dari atau sama dengan 5.



### 📦 2. Manajemen Inventaris (CRUD & Kategori)

Produk dikelompokkan dalam tiga kategori utama yaitu Kebutuhan Pokok, Makanan & Minuman, serta Kebutuhan Lainnya:

* **Tambah Produk:** Dilengkapi validasi formulir cerdas berupa garis tepi merah untuk *input* kosong yang otomatis hilang saat pengguna mulai mengetik.


* **Edit & Hapus:** Modifikasi data produk (*nama, harga, stok*) dan penghapusan baris yang perubahannya langsung tersimpan ke memori lokal.


* **Live Search & Indikator:** Pencarian produk instan saat mengetik yang dilengkapi teks penghitung dinamis *"Menampilkan X dari Y produk"*.


* **Loading State:** Efek animasi transisi pemuatan (*artificial delay*) selama 0,8 detik (800ms) untuk memberikan kesan visual aplikasi yang profesional.



### 💳 3. Layanan Kasir & Pemotongan Stok Cerdas (Smart POS)

Sistem *Point of Sale* sederhana yang terhubung langsung dengan data inventaris:

* *Dropdown* pilihan produk otomatis menampilkan sisa stok dan satuan terbaru dari seluruh kategori.


* Sistem proteksi yang menolak transaksi apabila "Jumlah Beli" melebihi ketersediaan stok.


* **Pemotongan Stok Otomatis:** Saat transaksi dikonfirmasi selesai, sistem secara otomatis melacak produk terkait di dalam memori dan mengurangi angka stoknya.



### 📜 4. Manajemen Riwayat Transaksi (State Management)

* **Status "Proses Pembayaran" (Oranye/Kuning):** Status bawaan transaksi baru yang masih bisa dibatalkan atau dikonfirmasi selesai.


* **Status "Selesai" (Hijau):** Transaksi yang telah dikonfirmasi dan stoknya telah dipotong secara permanen, di mana tombol aksi otomatis disembunyikan (diganti tanda `-`) untuk mencegah perubahan data.



### 🎨 5. Modern UI/UX & Responsif

* Antarmuka modern dengan gradasi warna (*bg-gradient*), efek *hover*, dan *card shadow* yang elegan.


* Responsif 100% untuk layar Desktop, Tablet, dan *Mobile* yang dilengkapi tombol menu navigasi *Hamburger*.



---

## 📂 Struktur Direktori

Sistem ini disusun dengan arsitektur folder yang rapi untuk memisahkan logika, tampilan, dan data:

```text
berkah-jaya-mart/
│
├── assets/
│   ├── css/ 
│   │   └── style.css              # File gaya utama (Tema, Layout, Responsivitas)
│   └── js/
│       ├── app.js                 # Navigasi mobile & Kalkulasi Metrik Dashboard
│       ├── produk.js              # Logika CRUD, Tabel, Live Search, dan Validasi Produk
│       └── transaksi.js           # Logika Kasir, Riwayat Penjualan, & Update Stok
│
├── data/                          # File JSON statis (di-load saat LocalStorage kosong)
│   ├── kebutuhan-lainnya.json     # Data awal 4 produk kebutuhan lainnya
│   ├── kebutuhan-pokok.json       # Data awal 4 produk kebutuhan pokok
│   ├── makanan-minuman.json       # Data awal 4 produk makanan & minuman
│   └── transaksi.json             # Data awal 3 riwayat penjualan
│
├── kebutuhan-lainnya/             # Folder kategori 1
│   ├── list.html                  # Tabel daftar produk kebutuhan lainnya
│   └── tambah.html                # Form tambah produk kebutuhan lainnya
│
├── kebutuhan-pokok/               # Folder kategori 2
│   ├── list.html                  # Tabel daftar produk kebutuhan pokok
│   └── tambah.html                # Form tambah produk kebutuhan pokok
│
├── makanan-minuman/               # Folder kategori 3
│   ├── list.html                  # Tabel daftar produk makanan & minuman
│   └── tambah.html                # Form tambah produk makanan & minuman
│
├── transaksi/                     # Layanan POS & Riwayat
│   ├── list.html                  # Tabel riwayat penjualan
│   └── tambah.html                # Form kasir / pembelian produk
│
├── index.html                     # Halaman Beranda / Dashboard
└── README.md                      # Dokumentasi Proyek

```

---

## 🗄️ Sumber Data & Penyimpanan

Data awal dipisahkan dari HTML dalam format JSON di folder `data/`, lalu dibaca menggunakan `fetch()` dan disalin ke `localStorage` agar perubahan bersifat persisten:

| Sumber Berkas JSON | Kunci `localStorage` | Struktur Atribut Data |
| --- | --- | --- |
| `data/kebutuhan-pokok.json`<br> | `../data/kebutuhan-pokok.json`<br> | `id`, `nama`, `harga`, `stok`, `satuan`<br> |
| `data/makanan-minuman.json`<br> | `../data/makanan-minuman.json`<br> | `id`, `nama`, `harga`, `stok`, `satuan`<br> |
| `data/kebutuhan-lainnya.json`<br> | `../data/kebutuhan-lainnya.json`<br> | `id`, `nama`, `harga`, `stok`, `satuan`<br> |
| `data/transaksi.json`<br> | `../data/transaksi.json`<br> | `id_nota`, `tanggal`, `pembeli`, `nama_produk`, `jumlah`, `total_bayar`, `status`<br> |

---

## ⚡ Penjelasan Lengkap & Singkat JavaScript (`assets/js/`)

Logika aplikasi dipecah menjadi tiga berkas JavaScript modular sesuai tanggung jawab halaman masing-masing:

### 1. `assets/js/app.js` — Navigasi Global & Metrik Beranda

* **Toggle Menu Mobile:** Memasang *event listener* klik pada tombol `#nav-toggle-btn` untuk membuka atau menutup menu navigasi melalui penambahan kelas `.nav-open` pada `#main-nav`.


* **`fetchAtauLokal(keyPath)`:** Fungsi pembantu asinkron yang mengecek ketersediaan data di `localStorage` terlebih dahulu; apabila kosong, fungsi akan mengambil data dari file JSON (menggunakan penyesuaian *path* `.replace("../", "./")` khusus untuk halaman `index.html`) lalu menyimpannya ke `localStorage`.


* **`muatMetrikDashboard()`:** Mengambil seluruh array produk dari 3 kategori serta data transaksi secara asinkron, menggabungkannya dengan *spread operator* (`[...dataPokok, ...dataMakanan, ...dataLainnya]`), menghitung jumlah total produk, total transaksi, total kategori (3), serta menyaring produk dengan `stok <= 5`, lalu menampilkannya ke kartu metrik di beranda.



### 2. `assets/js/produk.js` — Manajemen Inventaris (CRUD) & Validasi

* **Penentuan Kunci Memori (`storageKey`):** Mendeteksi kategori halaman secara otomatis melalui atribut `data-json` pada `#tbody-produk` (saat di `list.html`) atau memeriksa URL `window.location.pathname` (saat di `tambah.html`).


* **`initValidasiForm(formElem)`:** Memasang *listener* `input` pada semua elemen `input` dan `select` untuk menghapus warna merah saat pengguna mulai mengetik, serta mengembalikan fungsi pengeksekusi `validasiKosong(fieldIds)` yang memberi garis tepi merah (`#ef4444`) dan latar merah muda (`#fee2e2`) pada kolom wajib yang kosong.


* **Pemuatan Data & *Loading State*:** Menampilkan `#loading-indicator`, menurunkan opasitas tabel menjadi `0.3`, dan menerapkan `setTimeout` selama `800` milidetik sebelum mengambil data dari `localStorage` atau `fetch()` JSON agar transisi pemuatan terlihat halus.


* **`renderTabel(data)`:** Membangun baris `<tr>` secara dinamis, memformat harga menjadi format Rupiah (`toLocaleString('id-ID')`), menyisipkan tombol Edit dan Hapus dengan atribut `data-index`, serta memperbarui teks `#info-tampil` (*"Menampilkan X dari Y produk"*).


* **Live Search (`keyup`):** Menyaring daftar produk secara instan berdasarkan kata kunci yang diketik pada `#search-input` menggunakan metode `.filter()` dan `.includes()`, lalu merender ulang tabel.


* **Event Delegation (Edit & Hapus):** Memasang satu *listener* klik pada `#tbody-produk`; tombol `.btn-hapus` menghapus produk dengan `.splice(index, 1)` setelah konfirmasi `confirm()`, sedangkan `.btn-edit` membuka dialog `prompt()` untuk memperbarui nama, harga, dan stok langsung ke `localStorage`.


* **Simpan Produk Baru (`submit`):** Mencegah *reload* halaman (`e.preventDefault()`), memeriksa validasi kolom `['nama', 'harga', 'stok']`, menghasilkan ID unik acak (`PRD-XXX`), menambahkan data ke array dengan `.push()`, dan menyimpannya ke `localStorage`.



### 3. `assets/js/transaksi.js` — Kasir (POS), Riwayat & Sinkronisasi Stok

* **`getProdukData(keyPath)` & Dropdown Kasir:** Mengambil data terbaru dari ketiga kategori produk (memprioritaskan `localStorage`), menggabungkannya, dan mengisi elemen `<select id="pilih-produk">` dengan teks nama beserta sisa stok, sembari menyimpan nilai `stok` dan `harga` di dalam atribut `dataset` (`option.dataset.stok` dan `option.dataset.harga`).


* **Proses Pembelian (`#form-kasir`):** Memvalidasi apakah produk sudah dipilih dan memastikan `jumlahBeli <= stokTersedia`; jika valid, sistem menghitung `totalBayar`, membuat ID Nota otomatis berbasis tanggal hari ini (`TRX-YYYYMMDD-XX`), membentuk objek transaksi berstatus `"Proses Pembayaran"`, dan memasukkannya ke urutan paling atas riwayat menggunakan `.unshift()`.


* **Pemuatan & Render Riwayat (`renderRiwayat`):** Menampilkan efek *loading* 800ms, memperbarui penghitung *"Menampilkan X dari Y transaksi"*, serta membedakan tampilan berdasarkan status: `"Proses Pembayaran"` diberi teks berwarna `orange` beserta tombol **Selesai** dan **Batal**, sedangkan status `"Selesai"` diberi warna `green` dan kolom aksinya diganti tanda strip (`-`).


* **Pencarian Riwayat (`keyup`):** Menyaring riwayat transaksi secara *real-time* berdasarkan kecocokan `id_nota` maupun nama `pembeli`.


* **Aksi Batal & Konfirmasi Selesai (Potong Stok Otomatis):**
* **Tombol Batal (`.btn-hapus`):** Menolak pembatalan dengan `alert` jika status sudah `"Selesai"`, dan menghapus transaksi dengan `.splice()` jika masih `"Proses Pembayaran"`.


* **Tombol Selesai (`.btn-selesai`):** Mengubah status transaksi menjadi `"Selesai"`, lalu melakukan perulangan (`for...of`) pada ketiga kunci `localStorage` kategori produk untuk mencari nama produk yang cocok (`findIndex`), mengurangi stoknya (`stok -= jumlah`), mencegah stok bernilai negatif, dan menyimpan pembaruan stok serta transaksi kembali ke `localStorage`.





---

## 🎨 Penjelasan Lengkap & Singkat CSS (`assets/css/style.css`)

Seluruh tampilan diatur menggunakan satu berkas stylesheet terpusat (`style.css`) yang dibagi ke dalam 8 bagian terstruktur:

| Bagian CSS | Selektor Utama | Penjelasan Singkat & Fungsi |
| :--- | :--- | :--- |
| **1. Variabel & Reset** | `:root`, `*`, `body` | Menyimpan variabel warna modern (`--primary-color`, `--danger-color`), latar gradasi, serta mereset margin, padding, dan memaksakan aturan `box-sizing: border-box`. |
| **2. Navbar Global** | `header`, `.logo`, `nav ul` | Menata kepala halaman dengan Flexbox, memberi efek transparansi menu saat di-hover, dan menyembunyikan tombol hamburger pada layar desktop. |
| **3. Layout & Grid** | `.dashboard-metrics`, `.card-kategori` | Membatasi lebar konten maksimal 1200px, menyusun kartu metrik dan kartu pintasan menggunakan CSS Grid beserta efek bayangan melayang. |
| **4. Tabel & Pencarian** | `.search-box`, `.table-responsive`, `td` | Menata cincin fokus biru pada kotak pencarian, membungkus tabel agar aman digeser horizontal (`overflow-x: auto`), dan memberi efek sorot saat baris disentuh. |
| **5. Formulir & Input** | `.form-standar`, `input`, `select` | Mengatur kontainer form maksimal 600px, menata desain input agar bersih, dan mewarnai tanda bintang kolom wajib isi (`.wajib`) dengan warna merah. |
| **6. Tombol Aksi** | `.btn-tambah`, `.btn-simpan` | Menyeragamkan tampilan tombol dengan sudut membulat, bayangan halus, dan animasi melayang (`transform: translateY(-2px)`) saat kursor mendekat. |
| **7. Media Queries** | `@media (max-width: 900px)` | Mode Responsif: Mengubah menu navigasi horizontal menjadi dropdown vertikal, memunculkan hamburger, dan menyesuaikan grid metrik untuk layar smartphone. |
| **8. Footer** | `footer` | Menempatkan hak cipta secara terpusat di dasar halaman dengan warna teks sekunder yang tidak mencolok. |

---

## 🚀 Panduan Instalasi & Penggunaan

Karena aplikasi ini menggunakan fungsi `fetch()` dari JavaScript untuk membaca file `.json` lokal sebagai data awal, aplikasi **tidak bisa** dibuka langsung dengan klik ganda (*double-click*) pada file HTML (akan terkena blokir kebijakan keamanan *CORS* dari *browser*).

### Cara Menjalankan dengan Benar:

1. Unduh atau *clone* kode sumber proyek ini.


2. Buka folder `berkah-jaya-mart` menggunakan editor **Visual Studio Code (VS Code)**.


3. Pastikan Anda sudah memasang ekstensi **Live Server** (oleh Ritwick Dey) di VS Code.


4. Buka file `index.html`, klik kanan pada editor, dan pilih **"Open with Live Server"**.


5. *Browser* akan terbuka otomatis secara lokal (biasanya di `[http://127.0.0.1:5500](http://127.0.0.1:5500)`) dan aplikasi siap digunakan.



### 🔄 Cara Mereset Data ke Kondisi Awal:

Jika Anda ingin menghapus semua hasil uji coba (tambahan produk/transaksi) dan mengembalikan aplikasi ke kondisi data JSON awal:

1. Buka *Developer Tools* di *browser* (Tekan `F12` atau `Ctrl + Shift + I`).


2. Masuk ke tab **Application** (Chrome/Edge) atau **Storage** (Firefox), buka bagian **Local Storage**, klik kanan pada URL lokal Anda, lalu pilih **Clear** (atau ketik `localStorage.clear()` pada tab **Console**).


3. Lakukan *Hard Refresh* pada halaman web (`Ctrl + F5`), maka data akan dimuat ulang dari berkas JSON di folder `data/`.



---

## 🧪 Skenario Pengujian (Testing)

| Skenario Uji | Langkah Pengujian | Hasil yang Diharapkan |
| :--- | :--- | :--- |
| **Validasi Form Kosong** | Buka halaman Tambah Produk, biarkan form kosong, lalu klik **Simpan Produk**. | Muncul alert peringatan dan kolom wajib berubah menjadi bergaris tepi merah; warna merah hilang otomatis saat diketik. |
| **Tambah & Persistensi** | Isi form Tambah Produk dengan lengkap lalu simpan, buka halaman Daftar Produk, dan tekan refresh. | Produk baru muncul di tabel dengan ID PRD-XXX dan tetap ada meskipun halaman dimuat ulang. |
| **Edit & Hapus Produk** | Klik tombol **Edit** atau **Hapus** pada salah satu baris produk. | Dialog prompt memperbarui data tabel dan memori lokal seketika; tombol Hapus menghilangkan baris secara permanen setelah dikonfirmasi. |
| **Live Search & Counter** | Ketik kata kunci pada kotak pencarian di halaman Daftar Produk atau Riwayat Penjualan. | Tabel menyaring baris secara instan dan teks penghitung "Menampilkan X dari Y produk/transaksi" otomatis menyesuaikan. |
| **Proteksi Stok Kasir** | Buka form Tambah Pembelian, pilih produk, lalu isi Jumlah Beli melebihi angka sisa stok. | Sistem menolak proses penyimpanan dan memunculkan notifikasi peringatan "STOK TIDAK MENCUKUPI!". |
| **Sinkronisasi Potong Stok** | Buat pesanan dengan status Proses Pembayaran, buka Riwayat Penjualan, klik tombol hijau **Selesai**. | Status berubah hijau (Selesai), tombol aksi hilang, dan sisa stok produk tersebut di halaman inventaris langsung berkurang otomatis. |
| **Pembatalan Transaksi** | Klik tombol **Batal** pada transaksi yang masih berstatus Proses Pembayaran. | Transaksi berhasil dihapus sepenuhnya dari layar dan memori lokal tanpa mempengaruhi jumlah stok asli. |
| **Metrik Dashboard** | Tambah produk/transaksi baru, kembali ke Beranda, lalu kecilkan layar browser menjadi versi mobile. | Angka keempat kartu metrik ikut berubah, dan navigasi berubah bentuk menjadi tombol Hamburger Menu. |