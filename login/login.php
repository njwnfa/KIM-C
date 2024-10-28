<?php
include '../config/koneksi.php';
session_start();
$_SESSION['show_alert'] = true;

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
        $_SESSION['show_alert'] = 'login_success'; // Alert berhasil login

        if ($user['level'] == 'admin') {
            header("Location: ../admin/dashboard/dashboard.php");
        } else {
            header("Location: ../index.php");
        }
    } else {
        $_SESSION['show_alert'] = 'login_failed'; // Alert gagal login
        header("Location: ../index.php");
        exit;
    }
}

?>
