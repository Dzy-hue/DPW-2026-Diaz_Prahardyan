<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head><title>Debug Session</title></head>
<body style="padding: 20px; font-family: monospace; background: #222; color: #0f0;">
    <h2>Isi $_SESSION Saat Ini:</h2>
    <pre><?php print_r($_SESSION); ?></pre>
    <br>
    <a href="index.php" style="color: #fff;">Kembali ke Beranda</a>
</body>
</html>