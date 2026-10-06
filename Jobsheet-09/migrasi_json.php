<?php
require __DIR__ . '/includes/koneksi.php';

// 1. Baca isi file JSON
$jsonString = file_get_contents(__DIR__ . '/data/buku.json');
$dataBuku = json_decode($jsonString, true);

// 2. Siapkan kerangka query sekali saja
$stmt = $pdo->prepare(
    "INSERT INTO buku (judul, pengarang, tahun, isbn, stok, kategori) 
     VALUES (:judul, :pengarang, :tahun, :isbn, :stok, :kategori)"
);

$sukses = 0;

// 3. Eksekusi query berulang kali dengan data yang berbeda
foreach ($dataBuku as $buku) {
    try {
        $stmt->execute([
            'judul' => $buku['judul'],
            'pengarang' => $buku['pengarang'],
            'kategori' => $buku['kategori'] ?? null,
            'tahun' => (int) $buku['tahun'],
            'isbn' => $buku['isbn'] ?? null,
            'stok' => (int) ($buku['stok'] ?? 0)
        ]);
        $sukses++;
    } catch (PDOException $e) {
        echo "Gagal memigrasi buku {$buku['judul']}: " . $e->getMessage() . "<br>";
    }
}

echo "Migrasi selesai! $sukses baris berhasil dipindahkan ke PostgreSQL.";