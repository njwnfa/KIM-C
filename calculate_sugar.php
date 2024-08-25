<?php
session_start();

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user'])) {
    header('Location: index.html');
    exit;
}

// Ambil data dari form
$name = $_POST['name'];
$age = $_POST['age'];
$gender = $_POST['gender'];
$pregnant = $_POST['pregnant'];
$weight = $_POST['weight'];

// Logika perhitungan konsumsi gula
// Contoh sederhana: Misalnya, 10 gram gula per 10 kg berat badan, ditambah tambahan jika hamil
$sugar_intake = ($weight / 10) * 10;

if ($pregnant == 'yes') {
    $sugar_intake += 10; // Tambahkan 10 gram gula jika hamil (contoh logika)
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Perhitungan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Hasil Perhitungan Konsumsi Gula Harian</h1>
        <p>Nama: <?php echo htmlspecialchars($name); ?></p>
        <p>Umur: <?php echo htmlspecialchars($age); ?></p>
        <p>Kelamin: <?php echo htmlspecialchars($gender); ?></p>
        <p>Hamil: <?php echo htmlspecialchars($pregnant == 'yes' ? 'Ya' : 'Tidak'); ?></p>
        <p>Berat Badan: <?php echo htmlspecialchars($weight); ?> kg</p>
        <p>Konsumsi Gula yang Disarankan: <?php echo $sugar_intake; ?> gram per hari</p>
        <a href="dashboard.php" class="btn btn-primary">Kembali ke Dashboard</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
