<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../includes/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: register.php');
    exit;
}

$nama = trim($_POST['nama'] ?? '');
$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

$errors = [];
if ($nama === '') {
    $errors[] = "Nama wajib diisi.";
}
if ($username === '') {
    $errors[] = "Username wajib diisi.";
}
if (strlen($password) < 6) {
    $errors[] = "Password minimal 6 karakter.";
}

if (!empty($errors)) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => implode(' ', $errors)];
    header('Location: register.php');
    exit;
}

try {
    $cek = $pdo->prepare("SELECT id FROM users WHERE username = :username");
    $cek ->execute(['username' => $username]);

    if ($cek->fetch()) {
        $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Username sudah digunakan.'];
        header('Location: register.php');
        exit;
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare(
        "INSERT INTO users (nama, username, password, role) VALUES (:nama, :username, :password, 'anggota')"
    );

    $stmt->execute([
        'nama' => $nama,
        'username' => $username,
        'password' =>$hashed_password
    ]);

    $_SESSION['flash'] = [
        'type' => 'success',
        'pesan' => 'Registrasi berhasil! Silakan login menggunakan akun Anda.'
    ];
    header('Location: login.php');
    exit;
} catch (PDOException $e) {
    $_SESSION['flash'] = [
        'type' => 'error',
        'pesan' => 'Terjadi kesalahan sistem: ' . $e->getMessage()
    ];
    header('Location: register.php');
    exit;
}