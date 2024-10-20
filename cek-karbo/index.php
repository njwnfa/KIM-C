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
    <link href="../css/cek-karbo.css" rel="stylesheet" />
  </head>
<body>
<!-- Navigation-->
<?php
session_start();
include '../config/koneksi.php';

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;   
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
                    <li><a class="dropdown-item" href="../logout/logout.php">Logout</a></li>
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
<!-- Form untuk menghitung karbohidrat -->
<div class="container mt-5" style="background-color: #ffffff; border-radius: 10px; box-shadow: 0 0 20px rgba(0, 0, 0, 0.1); padding: 30px; padding-top: 80px; margin-top: 200px;">
    <h2 class="text-center">Cek Konsumsi Karbohidrat</h2>
    <form method="POST" action="cek_karbohidrat.php">
        <div class="mb-3">
            <label for="condition" class="form-label">Kondisi Ibu</label>
            <select class="form-control" id="condition" name="condition" required onchange="toggleFormFields()">
                <option value="">Pilih Kondisi</option>
                <option value="hamil">Hamil</option>
                <option value="menyusui">Menyusui</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="age" class="form-label">Usia</label>
            <input type="number" class="form-control" id="age" name="age" required>
        </div>
        <div class="mb-3" id="baby_weight_div" style="display: none;">
            <label for="baby_weight" class="form-label">Berat Bayi Baru Lahir (kg)</label>
            <input type="number" class="form-control" id="baby_weight" name="baby_weight">
        </div>
        <div class="mb-3" id="diabetes_history_div" style="display: none;">
            <label for="diabetes_history" class="form-label">Apakah Ada Riwayat Diabetes dalam Keluarga?</label>
            <select class="form-control" id="diabetes_history" name="diabetes_history">
                <option value="">Pilih</option>
                <option value="ya">Ya</option>
                <option value="tidak">Tidak</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="weight" class="form-label">Berat Badan (kg)</label>
            <input type="number" class="form-control" id="weight" name="weight" required>
        </div>
        <div class="mb-3">
            <label for="carbo" class="form-label">Karbohidrat dalam Kemasan (gr)</label>
            <input type="number" class="form-control" id="carbo" name="carbo" required>
        </div>
        <button type="submit" class="btn btn-primary">Hitung</button>
    </form>
</div>

<!-- Riwayat Perhitungan Karbohidrat -->
<div class="container mt-5">
    <h3 class="text-center">Riwayat Perhitungan Karbohidrat</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Kondisi</th>
                <th>Usia</th>
                <th>Berat Badan</th>
                <th>Berat Bayi</th>
                <th>Riwayat Diabetes</th>
                <th>Karbohidrat (gr)</th>
                <th>% Karbohidrat</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
        <?php
    if ($user_id !== null) {
        $stmt = $connect->prepare("SELECT * FROM karbohidrat_data WHERE user_id = :user_id ORDER BY id DESC");
        $stmt->bindParam(':user_id', $user_id);
        if ($stmt->execute()) {
            echo "Query executed successfully.<br>";
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo "Number of records found: " . count($results) . "<br>";

            if ($results) {
                $no = 1;
                foreach ($results as $row) {
                    echo "<tr>";
                    echo "<td>" . $no++ . "</td>";
                    echo "<td>" . $row['nama'] . "</td>";
                    echo "<td>" . $row['kondisi'] . "</td>";
                    echo "<td>" . $row['umur'] . "</td>";
                    echo "<td>" . $row['berat_badan'] . "</td>";
                    echo "<td>" . $row['berat_bayi'] . "</td>";
                    echo "<td>" . $row['riwayat_diabetes'] . "</td>";
                    echo "<td>" . $row['karbo_dalam_kemasan'] . "</td>";
                    echo "<td>" . $row['karbo_persen'] . "%</td>";
                    echo "<td>" . $row['tanggal'] . "</td>"; // Ubah dari 'waktu' ke 'tanggal'
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='10' class='text-center'>Belum ada riwayat perhitungan</td></tr>";
            }
        } else {
            echo "Error executing query.";
        }
    } else {
        echo "<tr><td colspan='8' class='text-center'>Anda belum login.</td></tr>";
    }
    ?>
        </tbody>
    </table>
</div>

<!-- Footer-->
<aside style="background-color: #f8f9fa;">
    <footer class="text-center py-5">
      <div class="container px-5">
        <div class="text-black-100 small">
          <div class="mb-2">&copy; Your Website 2024. All Rights Reserved.</div>
          <a class="text-black" href="#!">Privacy</a>
          <span class="mx-1">&middot;</span>
          <a class="text-black" href="#!">Terms</a>
          <span class="mx-1">&middot;</span>
          <a class="text-black" href="#!">FAQ</a>
        </div>
      </div>
    </footer>
    </aside>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<script>
function toggleFormFields() {
    var condition = document.getElementById('condition').value;
    var babyWeightDiv = document.getElementById('baby_weight_div');
    var diabetesHistoryDiv = document.getElementById('diabetes_history_div');

    if (condition === 'menyusui') {
        babyWeightDiv.style.display = 'block';
        diabetesHistoryDiv.style.display = 'none';
    } else if (condition === 'hamil') {
        babyWeightDiv.style.display = 'none';
        diabetesHistoryDiv.style.display = 'block';
    } else {
        babyWeightDiv.style.display = 'none';
        diabetesHistoryDiv.style.display = 'none';
    }
}
</script>