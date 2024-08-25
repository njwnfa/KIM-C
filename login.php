<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query untuk mengambil data pengguna berdasarkan email
    $sql = "SELECT * FROM users WHERE email = :email";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['email' => $email]);
    
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($user && password_verify($password, $user['password'])) {
        // Password benar, set sesi pengguna
        $_SESSION['user'] = $user['email'];
        header('Location: dashboard.php');  // Arahkan ke dashboard.php
        exit;
    } else {
        echo "Login gagal! Cek kembali email dan password Anda.";
    }
}
?>
