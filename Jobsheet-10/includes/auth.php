<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 1. Cek apakah pengguna sudah login (Punya tiket masuk?)
if (!isset($_SESSION['user_id'])) {
    $_SESSION['flash'] = [
        'type' => 'error',
        'pesan' => 'Akses ditolak. Anda harus login terlebih dahulu.'
    ];
    header('Location: /auth/login.php'); 
    exit;
}

// 2. Fungsi tambahan untuk memblokir anggota biasa masuk ke area Petugas
function wajib_petugas() {
    if (!isset($_SESSION['role']) || ($_SESSION['role'] !== 'petugas' && $_SESSION['role'] !== 'admin')) {
        $_SESSION['flash'] = [
            'type' => 'error',
            'pesan' => 'Otorisasi gagal. Halaman ini hanya untuk Petugas dan Admin.'
        ];
        header('Location: /index.php');
        exit;
    }
}