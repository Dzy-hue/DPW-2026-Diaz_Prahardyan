<?php
session_start();
require __DIR__ . '/../includes/koneksi.php';

// 1. Menangkap data dari $_POST
$id = $_POST['id'] ?? null;
$judul = trim($_POST['judul'] ?? '');
$pengarang = trim($_POST['pengarang'] ?? '');
$kategori = trim($_POST['kategori'] ?? '');
$tahun = $_POST['tahun'] ?? '';
$isbn = trim($_POST['isbn'] ?? '');
$stok = $_POST['stok'] ?? '';

if (!$id) {
    header('Location: list.php');
    exit;
}

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
if ($isbn !== '') {
    // ^[0-9-]+$ artinya dari awal (^) sampai akhir ($) hanya boleh ada angka 0-9 dan tanda hubung (-)
    if (!preg_match('/^[0-9-]+$/', $isbn)) {
        $errors[] = "Format ISBN tidak valid. Hanya gunakan angka dan tanda hubung (-).";
    }
}
if (!is_numeric($stok) || $stok < 0) {
    $errors[] = "Stok tidak boleh negatif.";
}

// 3. Jika Validasi Gagal: Kembalikan ke halaman Edit beserta ID-nya
if (!empty($errors)) {
    $_SESSION['flash'] = [
        'type' => 'error',
        'pesan' => implode(' ', $errors)
    ];
    // Rute redirect diubah mengarah ke edit.php?id=... agar kembali ke form spesifik
    header('Location: edit.php?id=' . urlencode($id));
    exit;
}

// 4. ATURAN EMAS: Klausa 'WHERE id = :id' wajib ada agar tidak merusak seluruh tabel
$stmt = $pdo->prepare(
    "UPDATE buku SET judul = :judul, pengarang = :pengarang, kategori = :kategori, 
     tahun = :tahun, isbn = :isbn, stok = :stok WHERE id = :id"
);
$stmt->execute([
        'judul' => $judul,
        'pengarang' => $pengarang,
        'kategori' => $kategori,
        'tahun' => (int) $tahun,
        'isbn' => ($isbn),
        'stok' => (int) $stok,
        'id' => $id
    ]);

// 5. Buat pesan sukses dan arahkan pengguna ke halaman list
$_SESSION['flash'] = [
    'type' => 'success',
    'pesan' => "Data buku berhasil diperbarui."
];
header('Location: list.php');
exit;