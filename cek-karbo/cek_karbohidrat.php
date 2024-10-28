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
    $record_id = isset($_POST['record_id']) ? $_POST['record_id'] : null;
    $age = filter_var($_POST['age'], FILTER_VALIDATE_INT);
    $weight = filter_var($_POST['weight'], FILTER_VALIDATE_FLOAT);
    $baby_weight = filter_var($_POST['baby_weight'], FILTER_VALIDATE_FLOAT);
    $diabetes_history = $_POST['diabetes_history'];
    $carbo = filter_var($_POST['carbo'], FILTER_VALIDATE_FLOAT);
    $condition = $_POST['condition'];
    $user_id = $_SESSION['user_id'];
    $nama = $_SESSION['user_name'];

    if (!$age || !$weight || !$carbo) {
        echo "Harap isi semua data yang diperlukan dengan benar.";
        exit;
    }
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

    // Pesan saran
    $saran = "Untuk menjaga kesehatan, disarankan agar konsumsi karbohidrat Anda tidak melebihi $karbo_max gram per hari.";

    // Tentukan risiko dan peringatan
    $risiko = "";
    $peringatan = "";

    if ($condition == 'hamil') {
        if ($age < 25 && $diabetes_history == 'ya') {
            $risiko = "Resiko Tinggi";
            $peringatan = "Karena usia Anda di bawah 25 tahun dan memiliki riwayat keluarga diabetes melitus, Anda termasuk dalam kategori risiko tinggi untuk diabetes. Untuk mencegah risiko ini, harap batasi konsumsi karbohidrat Anda.";
        } elseif ($age < 25 && $diabetes_history == 'tidak') {
            $risiko = "Resiko Rendah";
            $peringatan = "Dengan usia di bawah 25 tahun dan tanpa riwayat keluarga diabetes melitus, Anda berada dalam kategori risiko rendah untuk diabetes. Namun, menjaga pola makan seimbang tetap penting.";
        } elseif ($age >= 30 && $diabetes_history == 'ya') {
            $risiko = "Resiko Tinggi";
            $peringatan = "Karena usia Anda di atas 30 tahun dan memiliki riwayat keluarga diabetes melitus, Anda termasuk dalam kategori risiko tinggi untuk diabetes.";
        } elseif ($age >= 30 && $diabetes_history == 'tidak') {
            $risiko = "Resiko Tinggi";
            $peringatan = "Karena usia Anda di atas 30 tahun, Anda termasuk dalam kategori risiko tinggi untuk diabetes.";
        }
    } elseif ($condition == 'menyusui') {
        if ($age >= 30 && $baby_weight >= 4) {
            $risiko = "Resiko Tinggi";
            $peringatan = "Karena usia Anda di atas 30 tahun dan melahirkan bayi dengan berat badan 4kg atau lebih, Anda termasuk dalam kategori risiko tinggi untuk diabetes.";
        } elseif ($age >= 30 && $baby_weight < 4) {
            $risiko = "Resiko Tinggi";
            $peringatan = "Karena usia Anda di atas 30 tahun, Anda termasuk dalam kategori risiko tinggi untuk diabetes.";
        } elseif ($age < 30 && $baby_weight >= 4) {
            $risiko = "Resiko Tinggi";
            $peringatan = "Karena Anda memiliki riwayat melahirkan bayi dengan berat badan 4kg atau lebih, Anda termasuk dalam kategori risiko tinggi untuk diabetes.";
        } elseif ($age < 30 && $baby_weight < 4) {
            $risiko = "Resiko Rendah";
            $peringatan = "Dengan usia di bawah 30 tahun dan tanpa riwayat melahirkan bayi dengan berat 4kg atau lebih, Anda berada dalam kategori risiko rendah untuk diabetes.";
        }
    }

    try {
        if ($record_id) {
            // Update data berdasarkan record_id
            $sql = "UPDATE karbohidrat_data 
                    SET nama = :nama, umur = :umur, berat_badan = :berat_badan, berat_bayi = :berat_bayi, riwayat_diabetes = :riwayat_diabetes, 
                        karbo_dalam_kemasan = :karbo_dalam_kemasan, karbo_persen = :karbo_persen, saran = :saran, peringatan = :peringatan, kondisi = :kondisi, risiko = :risiko
                    WHERE id = :record_id AND user_id = :user_id";
            $stmt = $connect->prepare($sql);
            $stmt->bindParam(':record_id', $record_id, PDO::PARAM_INT);
        } else {
            // Insert data baru
            $sql = "INSERT INTO karbohidrat_data (user_id, nama, umur, berat_badan, berat_bayi, riwayat_diabetes, karbo_dalam_kemasan, karbo_persen, saran, peringatan, kondisi, risiko) 
                    VALUES (:user_id, :nama, :umur, :berat_badan, :berat_bayi, :riwayat_diabetes, :karbo_dalam_kemasan, :karbo_persen, :saran, :peringatan, :kondisi, :risiko)";
            $stmt = $connect->prepare($sql);
        }

        // Bind parameter untuk insert dan update
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':nama', $nama, PDO::PARAM_STR);
        $stmt->bindParam(':umur', $age, PDO::PARAM_INT);
        $stmt->bindParam(':berat_badan', $weight, PDO::PARAM_STR);
        $stmt->bindParam(':berat_bayi', $baby_weight, PDO::PARAM_STR);
        $stmt->bindParam(':riwayat_diabetes', $diabetes_history, PDO::PARAM_STR);
        $stmt->bindParam(':karbo_dalam_kemasan', $carbo, PDO::PARAM_STR);
        $stmt->bindParam(':karbo_persen', $karbo_persen, PDO::PARAM_STR);
        $stmt->bindParam(':saran', $saran, PDO::PARAM_STR);
        $stmt->bindParam(':peringatan', $peringatan, PDO::PARAM_STR);
        $stmt->bindParam(':kondisi', $condition, PDO::PARAM_STR);
        $stmt->bindParam(':risiko', $risiko, PDO::PARAM_STR);

        $stmt->execute();
        echo "";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
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
</body>
</html>
