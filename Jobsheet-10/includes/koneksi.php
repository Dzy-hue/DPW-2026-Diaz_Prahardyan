<?php
$host = $_SERVER['PGHOST'] ?? $_ENV['PGHOST'] ?? getenv('PGHOST') ?: 'localhost';
$port = $_SERVER['PGPORT'] ?? $_ENV['PGPORT'] ?? getenv('PGPORT') ?: '5434';
$db   = $_SERVER['PGDATABASE'] ?? $_ENV['PGDATABASE'] ?? getenv('PGDATABASE') ?: 'simpus_mini';
$user = $_SERVER['PGUSER'] ?? $_ENV['PGUSER'] ?? getenv('PGUSER') ?: 'postgres';
$pass = $_SERVER['PGPASSWORD'] ?? $_ENV['PGPASSWORD'] ?? getenv('PGPASSWORD') ?: 'postgres';

try {
    $dsn = "pgsql:host=$host;port=$port;dbname=$db";
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Koneksi ke database gagal: " . $e->getMessage());
}
?>