<?php
session_start();
session_unset();  // Hapus semua variabel sesi
session_destroy();  // Hancurkan sesi
header('Location: index.html');  // Arahkan kembali ke halaman utama
exit;
?>
