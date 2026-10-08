<?php
require __DIR__ . '/includes/koneksi.php';

$jsonString = file_get_contents(__DIR__ . '/data/anggota.json');
$dataAnggota = json_decode($jsonString, true);

$stmt = $pdo->prepare(
    "INSERT INTO anggota (no_anggota, nama, alamat, no_hp) 
     VALUES (:no_anggota, :nama, :alamat, :no_hp)"
);

$sukses = 0;

foreach ($dataAnggota as $anggota) {
    try {
        $stmt->execute([
            'no_anggota' => $anggota['no_anggota'],
            'nama'       => $anggota['nama'],
            'alamat'     => $anggota['alamat'],
            'no_hp'      => $anggota['no_hp']
        ]);
        $sukses++;
    } catch (PDOException $e) {
        echo "Gagal memigrasi anggota {$anggota['nama']}: " . $e->getMessage() . "<br>";
    }
}

echo "Migrasi selesai! $sukses baris data anggota berhasil dipindahkan ke PostgreSQL.";