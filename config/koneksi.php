<?php
// db.php

$host = 'localhost'; // Nama host, umumnya localhost
$dbname = 'sweetguard_db'; // Nama database
$username = 'root'; // Nama pengguna MySQL
$password = ''; // Kata sandi MySQL

try {
    // Buat koneksi ke database menggunakan PDO
    $connect = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    // Set PDO error mode ke exception
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Jika koneksi gagal, tampilkan pesan error
    die("Koneksi ke database gagal: " . $e->getMessage());
}
?>
