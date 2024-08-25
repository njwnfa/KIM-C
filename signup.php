<?php
// signup.php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password

    // Query untuk memasukkan data pengguna baru
    $sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
    
    $stmt = $pdo->prepare($sql);
    
    try {
        $stmt->execute(['email' => $email, 'password' => $password]);
        echo "Pendaftaran berhasil untuk " . htmlspecialchars($email);
    } catch (PDOException $e) {
        // Jika terjadi error (misalnya email sudah digunakan), tampilkan pesan error
        if ($e->getCode() == 23000) { // 23000 adalah kode error SQLSTATE untuk duplicate entry
            echo "Email sudah digunakan.";
        } else {
            echo "Terjadi kesalahan: " . $e->getMessage();
        }
    }
}
?>
