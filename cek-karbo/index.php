<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Cek Karbohidrat</title>
    <link rel="icon" type="image/x-icon" href="../assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Google fonts-->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,wght@0,600;1,600&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,300;0,500;0,600;0,700;1,300;1,500;1,600;1,700&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,400;1,400&amp;display=swap" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="../css/styles.css" rel="stylesheet" />
  </head>
<body>
<!-- Navigation-->
<?php
session_start();
?>

<nav class="navbar navbar-expand-lg navbar-light fixed-top shadow-sm" id="mainNav" style="background-color: #ffc670;">
    <div class="container px-5">
        <img src="../assets/img/737.jpg" alt="" style="width: 35px; margin-right: 10px" />
        <a class="navbar-brand fw-bold" href="#page-top">KIM-C</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <i class="bi-list"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ms-auto me-4 my-3 my-lg-0">
                <li class="nav-item"><a class="nav-link me-lg" href="../index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link me-lg" href="../index.php #features">Features</a></li>
                <li class="nav-item"><a class="nav-link me-lg" href="../index.php #about_us">About Us</a></li>
                
                <!-- Tambahkan Menu Cek Karbohidrat jika user login -->
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li class="nav-item"><a class="nav-link me-lg" href="#">Cek Karbohidrat</a></li>
                <?php endif; ?>
            </ul>

            <!-- Ganti button login menjadi profile jika user login -->
            <?php if (isset($_SESSION['user_id'])): ?>
            <div class="dropdown">
                <button class="btn dropdown-toggle" type="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="../assets/img/profile.png" alt="Profile" style="width: 35px; height: 35px; border-radius: 50%;" />
                </button>
                <ul class="dropdown-menu" aria-labelledby="profileDropdown">
                    <li><a class="dropdown-item" href="#">Hello, <?php echo $_SESSION['user_name']; ?></a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="logout.php">Logout</a></li> <!-- Tambahkan Logout -->
                </ul>
            </div>
            <?php else: ?>
            <button class="btn btn-primary rounded-pill px-3 mb-2 mb-lg-0" data-bs-toggle="modal" data-bs-target="#loginModal">
                <span class="d-flex align-items-center">
                    <i class="bi-chat-text-fill me-2"></i>
                    <span class="small">Login</span>
                </span>
            </button>
            <?php endif; ?>
        </div>
    </div>
</nav>
</body>
</html>