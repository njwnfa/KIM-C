<?php
include '../config/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Ambil user berdasarkan email
    $stmt = $connect->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verifikasi password
    if ($user && password_verify($password, $user['password'])) {
        session_start();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['level'] = $user['level'];

        if ($user['level'] == 'admin') {
            header("Location: admin_dashboard.php");
        } else {
            header("Location: ../index.php");
        }
    } else {
        echo "<script>alert('Invalid email or password');window.location.href='../index.php';</script>";
    }
}
?>
