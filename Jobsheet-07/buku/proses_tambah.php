<?php
session_start();

// 1. Menangkap data dari $_POST
$judul = trim($_POST['judul'] ?? '');
$pengarang = trim($_POST['pengarang'] ?? '');
$tahun = $_POST['tahun'] ?? '';
$isbn = trim($_POST['isbn'] ?? '');
$stok = $_POST['stok'] ?? '';
$kategori = trim($_POST['kategori'] ?? '');

// 2. Validasi Server-Side
$errors = [];
if ($judul === '') {
    $errors[] = "Judul wajib diisi.";
}
if ($pengarang === '') {
    $errors[] = "Pengarang wajib diisi.";
}
if (!is_numeric($tahun) || $tahun < 1900 || $tahun > 2026) {
    $errors[] = "Tahun harus di antara 1900-2026.";
}
if (!is_numeric($stok) || $stok < 0) {
    $errors[] = "Stok tidak boleh negatif.";
}

// 3. Jika ada error, simpan pesan flash dan kembalikan ke form
if (!empty($errors)) {
    $_SESSION['flash'] = [
        'type' => 'error', 
        'pesan' => implode(' ', $errors)
    ];
    header('Location: tambah.php');
    exit;
}

// 4. Jika valid, inisialisasi keranjang $_SESSION jika belum ada
if (!isset($_SESSION['buku'])) {
    $_SESSION['buku'] = [];
}

// 5. Tambahkan data buku baru ke dalam keranjang
$_SESSION['buku'][] = [
    'judul' => $judul,
    'pengarang' => $pengarang,
    'tahun' => (int) $tahun,
    'isbn' => $isbn,
    'stok' => (int) $stok,
    'kategori' => $kategori,
];

// 6. Buat pesan sukses dan arahkan pengguna ke halaman Daftar Buku
$_SESSION['flash'] = [
    'type' => 'success', 
    'pesan' => 'Buku berhasil ditambahkan.'
];
header('Location: list.php');
exit;