<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../includes/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: login.php');
    exit;
}

$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

if ($username === '' || $password === '') {
    $_SESSION['flash'] = [
        'type' => 'error',
        'pesan' => 'Username dan password wajib diisi.'
    ];
    header('Location: login.php');
    exit;
}

if (isset($_SESSION['lockout_time']) && time() < $_SESSION['lockout_time']) {
    $sisa = $_SESSION['lockout_time'] - time();
    $_SESSION['flash'] = [
        'type' => 'error',
        'pesan' => "Terlalu banyak percobaan. Silakan tunggu $sisa detik."
    ];
    header('Location: login.php');
    exit;
}

try {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        unset($_SESSION['login_attempts']); 
        unset($_SESSION['lockout_time']);
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['nama']    = $user['nama'];
        $_SESSION['role']    = $user['role']; 

        if (isset($_POST['remember']) && $_POST['remember'] === '1') {
            // Membuat cookie bernama 'simpus_token' yang bertahan 30 hari (86400 detik * 30)
            setcookie('simpus_token', $user['username'], time() + (86400 * 30), "/"); 
        }
        
        // Percabangan otomatis berdasarkan peran (Sesuai Wireframe)
        if ($user['role'] === 'petugas' || $user['role'] === 'admin') {
            // Petugas diarahkan ke Dasbor Admin 
            header('Location: ../dashboard_petugas.php'); 
        } else {
            // Anggota diarahkan ke Dasbor Tamu (Beranda)
            header('Location: ../index.php');
        }
        exit;
    } else {
        $_SESSION['login_attempts'] = ($_SESSION['login_attempts'] ?? 0) + 1;
        
        // Jika sudah gagal 5 kali, kunci selama 60 detik (1 menit)
        if ($_SESSION['login_attempts'] >= 5) {
            $_SESSION['lockout_time'] = time() + 60;
        }

        $_SESSION['flash'] = [
            'type' => 'error',
            'pesan' => 'Username atau password salah.'
        ];
        header('Location: login.php');
        exit;
    }

} catch (PDOException $e) {
    $_SESSION['flash'] = [
        'type' => 'error',
        'pesan' => 'Terjadi kesalahan sistem: ' . $e->getMessage()
    ];
    header('Location: login.php');
    exit;
}