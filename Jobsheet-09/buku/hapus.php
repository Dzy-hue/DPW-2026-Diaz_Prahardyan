<?php
session_start();
require __DIR__ . '/../includes/koneksi.php';

// Sengaja hanya menerima post (bukan get) agar penghapusan tidak bisa
// dipicu tanpa sengaja lewat link/preview crawler.
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: list.php');
    exit;
}

$id = $_POST['id'] ?? null;
if ($id) {
    $stmt = $pdo->prepare("UPDATE buku SET is_active = FALSE WHERE id = :id");
    $stmt->execute(['id' => $id]);

    $_SESSION['flash'] = [
        'type' => 'success',
        'pesan' => "Buku berhasil dinonaktifkan."
    ];
}
header('Location: list.php');
exit;