<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Perhitungan Karbohidrat</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Optional Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

<?php
session_start();
include '../config/koneksi.php';

// Periksa apakah user telah login
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $age = $_POST['age'];
    $weight = $_POST['weight'];
    $baby_weight = $_POST['baby_weight'];
    $diabetes_history = $_POST['diabetes_history'];
    $carbo = $_POST['carbo'];
    $condition = $_POST['condition'];
    $user_id = $_SESSION['user_id'];
    $nama = $_SESSION['user_name'];

    // Sesuaikan kebutuhan karbohidrat berdasarkan kondisi ibu
    if ($condition == 'hamil') {
        $karbo_max = 345; // Kebutuhan karbo untuk ibu hamil
    } elseif ($condition == 'menyusui') {
        $karbo_max = 360; // Kebutuhan karbo untuk ibu menyusui
    } else {
        $karbo_max = 360; // Default
    }

    // Perhitungan karbohidrat dalam kemasan
    $karbo_persen = ($carbo / $karbo_max) * 100;

    // Pesan saran dan peringatan
    $saran = "Untuk menjaga kesehatan, disarankan agar konsumsi karbohidrat Anda tidak melebihi $karbo_max gram per hari.";
    $peringatan = "";

    // Tambahkan peringatan jika usia lebih dari 30 tahun
    if ($age > 30) {
        $peringatan = "Karena usia Anda lebih dari 30 tahun, Anda termasuk dalam kategori risiko tinggi untuk diabetes. Harap batasi konsumsi karbohidrat untuk menghindari risiko diabetes.";
    }

    // Insert data ke database
    $sql = "INSERT INTO karbohidrat_data (user_id, nama, umur, berat_badan, berat_bayi, riwayat_diabetes, karbo_dalam_kemasan, karbo_persen, saran, peringatan, kondisi) 
            VALUES (:user_id, :nama, :umur, :berat_badan, :berat_bayi, :riwayat_diabetes, :karbo_dalam_kemasan, :karbo_persen, :saran, :peringatan, :kondisi)";
    $stmt = $connect->prepare($sql);

    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':nama', $nama);
    $stmt->bindParam(':kondisi', $condition);
    $stmt->bindParam(':umur', $age);
    $stmt->bindParam(':berat_badan', $weight);
    $stmt->bindParam(':berat_bayi', $baby_weight);
    $stmt->bindParam(':riwayat_diabetes', $diabetes_history);
    $stmt->bindParam(':karbo_dalam_kemasan', $carbo);
    $stmt->bindParam(':karbo_persen', $karbo_persen);
    $stmt->bindParam(':saran', $saran);
    $stmt->bindParam(':peringatan', $peringatan);

    if ($stmt->execute()) {
    } else {
        $error = $stmt->errorInfo();
        echo "Error: " . $error[2];
    }

    // Output hasil
    echo "
    <div class='container mt-5'>
        <div class='card shadow'>
            <div class='card-header bg-info text-white'>
                <h3 class='card-title text-center'>Hasil Perhitungan Karbohidrat</h3>
            </div>
            <div class='card-body'>
                <p><strong>Nama:</strong> $nama</p>
                <p><strong>Kondisi:</strong> " . ucfirst($condition) . "</p>
                <p><strong>Usia:</strong> $age tahun</p>
                <p><strong>Berat Badan:</strong> $weight kg</p>";

    // Jika kondisi hamil, tampilkan riwayat diabetes
    if ($condition == 'hamil') {
        echo "<p><strong>Riwayat Diabetes:</strong> $diabetes_history</p>";
    }

    // Jika kondisi menyusui, tampilkan berat bayi
    if ($condition == 'menyusui') {
        echo "<p><strong>Berat Bayi Baru Lahir:</strong> $baby_weight kg</p>";
    }

    echo "
                <p><strong>Karbohidrat dalam Kemasan:</strong> $carbo gr</p>
                <hr>
                <p>Dari produk ini, Anda telah mengonsumsi <strong>$carbo</strong> gram karbohidrat, yang setara dengan <strong>" . number_format($karbo_persen, 2) . " %</strong> dari kebutuhan harian Anda sebagai <strong>" . ucfirst($condition) . "</strong>.</p>
                <div class='alert alert-warning'>
                    <strong>Peringatan!</strong> Kelebihan konsumsi karbohidrat dapat meningkatkan risiko diabetes. Untuk informasi lebih lanjut, konsultasikan dengan dokter Anda.
                </div>
                <p>$saran</p>";


    if (!empty($peringatan)) {
        echo "
        <div class='alert alert-danger'>
            <strong>Peringatan Khusus:</strong> $peringatan
        </div>";
    }

    echo "
            </div>
            <div class='card-footer text-center'>
                <a href='index.php' class='btn btn-primary'>Kembali</a>
            </div>
        </div>
    </div>
    ";
}
?>
