<?php
// Tangkap data dari form di dashboard.php
$nama = $_POST['nama'];
$umur = $_POST['umur'];
$berat_badan = $_POST['berat_badan'];
$jumlah_karbo = $_POST['jumlah_karbo'];
$status = $_POST['status'];

// Variabel untuk hasil perhitungan karbohidrat
$persentase_karbo = 0;
$kategori = "";

// Proses perhitungan berdasarkan status (hamil atau menyusui)
if ($status == "hamil") {
    $persentase_karbo = ($jumlah_karbo / 345) * 100;
    $riwayat_keluarga = $_POST['riwayat_keluarga'];

    // Tentukan kategori berdasarkan umur dan riwayat keluarga DM
    if ($umur < 25 && $riwayat_keluarga == "ya") {
        $kategori = "Risiko Tinggi";
    } elseif ($umur < 25 && $riwayat_keluarga == "tidak") {
        $kategori = "Risiko Rendah";
    } elseif ($umur >= 30 && $riwayat_keluarga == "ya") {
        $kategori = "Risiko Tinggi";
    } elseif ($umur >= 30 && $riwayat_keluarga == "tidak") {
        $kategori = "Risiko Tinggi";
    }
} elseif ($status == "menyusui") {
    $persentase_karbo = ($jumlah_karbo / 360) * 100;
    $berat_bayi = $_POST['berat_bayi'];

    // Tentukan kategori berdasarkan umur dan berat badan bayi baru lahir
    if ($umur >= 30 && $berat_bayi >= 4) {
        $kategori = "Risiko Tinggi";
    } elseif ($umur >= 30 && $berat_bayi < 4) {
        $kategori = "Risiko Tinggi";
    } elseif ($umur < 30 && $berat_bayi >= 4) {
        $kategori = "Risiko Tinggi";
    } elseif ($umur < 30 && $berat_bayi < 4) {
        $kategori = "Risiko Rendah";
    }
}

// Tampilkan hasil perhitungan dalam bubble
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Perhitungan Karbohidrat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .bubble {
            border-radius: 15px;
            background-color: #ffc0cb; /* Warna pink */
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Efek bayangan */
        }
        .bubble h3 {
            margin-bottom: 10px;
            font-size: 1.5rem;
        }
        .bubble p {
            margin: 0;
            font-size: 1rem;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Hasil Perhitungan Karbohidrat</h2>

        <!-- Bubble Identitas Pengguna -->
        <div class="bubble">
            <h3>Identitas Pengguna</h3>
            <p>Nama: <?= $nama ?><br>Umur: <?= $umur ?><br>Berat Badan: <?= $berat_badan ?> kg</p>
        </div>

        <!-- Bubble Hasil Perhitungan Karbohidrat -->
        <div class="bubble">
            <h3>Hasil Perhitungan Karbohidrat</h3>
            <p>Karbohidrat dalam kemasan: <?= round($persentase_karbo, 2) ?>%</p>
        </div>

        <!-- Bubble Kategori Risiko -->
        <div class="bubble">
            <h3>Kategori Risiko</h3>
            <p><?= $kategori ?></p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>