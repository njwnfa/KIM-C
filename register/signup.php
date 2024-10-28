<?php
session_start(); 
include '../config/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $name = $_POST['name'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);  // Enkripsi password
    $level = 'user';  // Set level untuk user

    // Cek apakah email sudah digunakan
    $stmt = $connect->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $_SESSION['show_alert'] = 'email_exists'; // Alert jika email sudah digunakan
        header("Location: ../index.php");
        exit;
    } else {
        // Simpan user baru
        $stmt = $connect->prepare("INSERT INTO users (name, email, password, level) VALUES (:name, :email, :password, :level)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':level', $level);
        if ($stmt->execute()) {
            $_SESSION['show_alert'] = 'registration_success'; // Alert sukses registrasi
            header("Location: ../index.php");
        } else {
            $_SESSION['show_alert'] = 'registration_failed'; // Alert gagal registrasi
            header("Location: ../index.php");
        }
        exit;
    }
}
?>
