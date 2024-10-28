<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['level'] != 'admin') {
    header("Location: ../login.php");
    exit;
}

include '../../config/koneksi.php';

// Query untuk mendapatkan seluruh riwayat data perhitungan
$queryHistory = $connect->query("SELECT * FROM karbohidrat_data ORDER BY tanggal DESC")->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History Data Perhitungan</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f1f3f4;
            color: #333;
        }
        .sidebar {
            min-height: 100vh;
            background-color: #343a40;
            padding: 20px;
            color: #fff;
            border-radius: 10px;
        }
        .sidebar a {
            color: #aaa;
            text-decoration: none;
            margin: 10px 0;
            display: block;
            font-size: 1.1rem;
        }
        .sidebar a:hover {
            color: #fff;
            background-color: #495057;
            border-radius: 8px;
            padding: 10px;
            transition: background-color 0.2s;
        }
        .main-content {
            padding: 40px;
        }
        .card-custom {
            background: #fff;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .card-custom:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 20px rgba(0, 0, 0, 0.15);
        }
        .card-custom h5 {
            font-size: 1.2rem;
            color: #555;
        }
        .card-custom p {
            font-size: 1.4rem;
            font-weight: bold;
        }
        .chart-container {
            background: #fff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
            max-width: 400px; /* Set max width for the container */
            margin: auto; /* Center the chart */
        }
        /* Aturan khusus untuk pencetakan */
    @media print {
        body {
            background-color: #fff;
        }
        .sidebar, .btn-primary, .h2, .border-bottom {
            display: none; /* Sembunyikan elemen yang tidak ingin dicetak */
        }
        .main-content {
            padding: 0;
        }
        .table-bordered {
            width: 100%;
        }
        .chart-container {
            max-width: 100%; /* Sesuaikan ukuran chart untuk tampilan cetak */
            box-shadow: none;
        }
    }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav class="col-md-3 col-lg-2 d-md-block bg-dark sidebar">
            <div class="position-sticky">
                <h4 class="text-center mt-3">Admin Dashboard</h4>
                <hr>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="../dashboard/dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">History</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../../logout/logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Welcome, <?php echo $_SESSION['user_name']; ?></h1>
            </div>

            <h1 class="text-center">Riwayat Data Perhitungan</h1>
    
            <!-- Tabel Riwayat Perhitungan -->
            <div class="table-responsive mt-4">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Kondisi</th>
                            <th>Umur</th>
                            <th>Berat Badan</th>
                            <th>Berat Bayi</th>
                            <th>Karbohidrat (%)</th>
                            <th>Risiko</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($queryHistory as $row): ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['nama']; ?></td>
                                <td><?php echo $row['kondisi']; ?></td>
                                <td><?php echo $row['umur']; ?></td>
                                <td><?php echo $row['berat_badan']; ?></td>
                                <td><?php echo $row['berat_bayi']; ?></td>
                                <td><?php echo $row['karbo_persen']; ?>%</td>
                                <td><?php echo $row['risiko']; ?></td>
                                <td><?php echo $row['tanggal']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Pie Chart untuk Risiko -->
            <div class="chart-container mt-4" style="max-width: 600px; margin: auto;">
                <h5 class="text-center">Distribusi Risiko</h5>
                <canvas id="riskHistoryChart"></canvas>
            </div>

            <!-- Tombol Cetak -->
            <div class="text-center mt-4">
                <button onclick="window.print()" class="btn btn-primary">Cetak Data</button>
            </div>

                </main>
            </div>
    </div>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Data untuk Pie Chart
    const riskCounts = {
        highRisk: <?php echo $connect->query("SELECT COUNT(*) AS count FROM karbohidrat_data WHERE risiko = 'Resiko Tinggi'")->fetch(PDO::FETCH_ASSOC)['count']; ?>,
        lowRisk: <?php echo $connect->query("SELECT COUNT(*) AS count FROM karbohidrat_data WHERE risiko = 'Resiko Rendah'")->fetch(PDO::FETCH_ASSOC)['count']; ?>
    };

    // Menginisialisasi Pie Chart
    const ctx = document.getElementById('riskHistoryChart').getContext('2d');
    new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Risiko Tinggi', 'Risiko Rendah'],
            datasets: [{
                data: [riskCounts.highRisk, riskCounts.lowRisk],
                backgroundColor: ['#FF8C00', '#28A745'],
                hoverBackgroundColor: ['#FF4500', '#32CD32'],
                borderColor: '#f1f3f4',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'bottom',
                    labels: {
                        color: '#555',
                        font: { size: 14 }
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            let total = context.dataset.data.reduce((acc, value) => acc + value, 0);
                            let percentage = ((context.raw / total) * 100).toFixed(1);
                            return `${context.label}: ${context.raw} (${percentage}%)`;
                        }
                    }
                }
            }
        }
    });
</script>

</body>
</html>
