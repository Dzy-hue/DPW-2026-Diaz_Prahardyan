<?php
session_start();
require __DIR__ . '/../includes/koneksi.php';

// 1. Menangkap data dari $_POST
$nama = trim($_POST['nama'] ?? '');
$noAnggota = trim($_POST['no_anggota'] ?? '');
$alamat = $_POST['alamat'] ?? '';
$noHp = trim($_POST['no_hp'] ?? '');

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
// if (!isset($_SESSION['anggota'])) {
//     $_SESSION['anggota'] = [];
// }

// 5. Tambahkan data anggota baru ke dalam keranjang
// $_SESSION['anggota'][] = [
//     'nama' => $nama,
//     'no_anggota' => $no_anggota,
//     'alamat' => $alamat,
//     'no_hp' => $no_hp,
// ];

$stmt = $pdo->prepare(
    "INSERT INTO anggota (nama, no_anggota, alamat, no_hp) 
     VALUES (:nama, :no_anggota, :alamat, :no_hp)
     RETURNING id"
);
$stmt->execute([
    ':nama' => $nama,
    ':no_anggota' => $noAnggota,
    ':alamat' => $alamat,
    ':no_hp' => $noHp
]);

// 6. Buat pesan sukses dan arahkan pengguna ke halaman Daftar Buku
$_SESSION['flash'] = [
    'type' => 'success', 
    'pesan' => 'Anggota berhasil ditambahkan.'
];
header('Location: list.php');
exit;