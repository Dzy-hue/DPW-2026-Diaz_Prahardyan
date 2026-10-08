<?php
session_start();
require __DIR__ . '/../includes/koneksi.php';

// 1. Menangkap data dari $_POST
$id = $_POST['id'] ?? null;
$nama = trim($_POST['nama'] ?? '');
$noAnggota = trim($_POST['no_anggota'] ?? '');
$alamat = $_POST['alamat'] ?? '';
$noHp = trim($_POST['no_hp'] ?? '');

if (!$id) {
    header('Location: list.php');
    exit;
}

// 2. Validasi Server-Side
$errors = [];
if ($nama === '') {
    $errors[] = "Nama wajib diisi.";
}
if ($noAnggota === '') {
    $errors[] = "Nomor Anggota wajib diisi.";
} elseif (!preg_match('/^[a-zA-Z0-9]+$/', $noAnggota)) {
    $errors[] = "Nomor Anggota hanya boleh berisi huruf dan angka (tanpa spasi).";
}
if ($alamat === '') {
    $errors[] = "Alamat wajib diisi.";
}
if ($noHp === '') {
    $errors[] = "Nomor HP wajib diisi.";
} elseif (!is_numeric($noHp)) {
    $errors[] = "Nomor HP harus berupa angka.";
} elseif (strlen($noHp) < 10 || strlen($noHp) > 14) {
    $errors[] = "Nomor HP harus berjumlah antara 10 hingga 14 digit.";
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
    "UPDATE anggota SET nama = :nama, no_anggota = :no_anggota,
     alamat = :alamat, no_hp = :no_hp WHERE id = :id"
);
$stmt->execute([
        'nama' => $nama,
        'no_anggota' => $noAnggota,
        'alamat' => $alamat,
        'no_hp' => $noHp,
        'id' => $id
    ]);

// 5. Buat pesan sukses dan arahkan pengguna ke halaman list
$_SESSION['flash'] = [
    'type' => 'success',
    'pesan' => "Data anggota berhasil diperbarui."
];
header('Location: list.php');
exit;