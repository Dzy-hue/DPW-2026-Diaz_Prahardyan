<?php
session_start();
// Menghapus semua data sesi
session_destroy();

// Mulai sesi baru HANYA untuk mengirim pesan flash sukses
session_start();
$_SESSION['flash'] = [
    'type' => 'success', 
    'pesan' => 'Semua data sesi berhasil dihapus (Reset).'
];

// Kembalikan ke beranda
header('Location: index.php');
exit;