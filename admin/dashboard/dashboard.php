<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['level'] != 'admin') {
    header("Location: ../login.php");
    exit;
}

include '../../config/koneksi.php';

// Query untuk mendapatkan data statistik, misal jumlah user, surat, dll.
$queryUsers = $connect->query("SELECT COUNT(*) AS total_users FROM users")->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
        }
        .sidebar {
            min-height: 100vh;
            background-color: #343a40;
            padding: 20px;
            color: #fff;
        }
        .sidebar a {
            color: #fff;
            text-decoration: none;
            margin: 10px 0;
            display: block;
        }
        .sidebar a:hover {
            background-color: #495057;
            border-radius: 5px;
            padding: 10px;
        }
        .main-content {
            padding: 20px;
        }
        .card-custom {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        .navbar-custom {
            background-color: #343a40;
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
                        <a class="nav-link" href="#">Dashboard</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="#">Manage Users</a>
                    </li> -->
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="#">Manage Surat</a>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link" href="#">Settings</a>
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

            <!-- Dashboard Stats -->
            <div class="row">
                <div class="col-md-6 col-lg-4 mb-3">
                    <div class="card card-custom text-white bg-primary">
                        <div class="card-body">
                            <h5 class="card-title">Total Users</h5>
                            <p class="card-text"><?php echo $queryUsers['total_users']; ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-3">
                    <div class="card card-custom text-white bg-success">
                        <div class="card-body">
                            <h5 class="card-title">Kategori Rendah</h5>
                            <p class="card-text">7</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-3">
                    <div class="card card-custom text-white bg-warning">
                        <div class="card-body">
                            <h5 class="card-title">Kategori Tinggi</h5>
                            <p class="card-text">12</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- More Content Here -->
        </main>
    </div>
</div>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
