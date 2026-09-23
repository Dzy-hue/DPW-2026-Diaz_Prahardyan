<?php
session_start();

// 1. Menangkap data dari $_POST
$no_anggota = trim($_POST['nama'] ?? '');
$nama = trim($_POST['no_anggota'] ?? '');
$alamat = $_POST['alamat'] ?? '';
$no_hp = trim($_POST['no_hp'] ?? '');

// 2. Validasi Server-Side
$errors = [];
if ($nama === '') {
    $errors[] = "Nama wajib diisi.";
}
if ($no_anggota === '') {
    $errors[] = "Nomor Anggota wajib diisi.";
}
if ($alamat === '') {
    $errors[] = "Alamat wahib diisi.";
}
if ($no_hp === '') {
    $errors[] = "Nomor HP wajib diisi.";
} elseif (!is_numeric($no_hp)) {
    $errors[] = "Nomor HP harus berupa angka.";
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
if (!isset($_SESSION['anggota'])) {
    $_SESSION['anggota'] = [];
}

// 5. Tambahkan data anggota baru ke dalam keranjang
$_SESSION['anggota'][] = [
    'nama' => $nama,
    'no_anggota' => $no_anggota,
    'alamat' => $alamat,
    'no_hp' => $no_hp,
];

// 6. Buat pesan sukses dan arahkan pengguna ke halaman Daftar Buku
$_SESSION['flash'] = [
    'type' => 'success', 
    'pesan' => 'Buku berhasil ditambahkan.'
];
header('Location: list.php');
exit;