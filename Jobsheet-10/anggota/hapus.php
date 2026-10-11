<?php
session_start();

require_once __DIR__ . '/../includes/auth.php';
wajib_petugas();

if ($_SESSION['role'] !== 'admin') {
    $_SESSION['flash'] = [
        'type' => 'error',
        'pesan' => 'Akses ditolak. Hanya Admin yang berhak menghapus data anggota.'
    ];
    header('Location: list.php');
    exit;
}

require __DIR__ . '/../includes/koneksi.php';

// Sengaja hanya menerima post (bukan get) agar penghapusan tidak bisa
// dipicu tanpa sengaja lewat link/preview crawler.
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: list.php');
    exit;
}

$id = $_POST['id'] ?? null;
if ($id) {
    $stmt = $pdo->prepare("UPDATE anggota SET is_active = FALSE WHERE id = :id");
    $stmt->execute(['id' => $id]);

    $_SESSION['flash'] = [
        'type' => 'success',
        'pesan' => "Anggota berhasil dinonaktifkan."
    ];
}
header('Location: list.php');
exit;