<?php
// db.php

$host = 'localhost';
$dbname = 'sweetguard_db'; 
$username = 'root';
$password = ''; 

try {
    $connect = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Koneksi ke database gagal: " . $e->getMessage());
}
?>
