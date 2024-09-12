<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard - Perhitungan Karbohidrat</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script>
    function toggleExtraFields(select) {
      document.getElementById('hamil-fields').style.display = select.value === 'hamil' ? 'block' : 'none';
      document.getElementById('menyusui-fields').style.display = select.value === 'menyusui' ? 'block' : 'none';
    }
  </script>
  <style>
    .bubble {
      border-radius: 15px;
      background-color: #ffc0cb; /* Warna pink */
      padding: 20px;
      margin-bottom: 20px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .bubble h3 {
      margin-bottom: 10px;
      font-size: 1.5rem;
    }
    .bubble p {
      margin: 0;
      font-size: 1rem;
    }
    .btn-container {
      margin-top: 10px;
    }
  </style>
</head>
<body>
  <div class="container mt-5">
    <h2 class="mb-4">Perhitungan Karbohidrat Harian</h2>

    <!-- Form Input -->
    <form action="calculate_carbs.php" method="POST" class="needs-validation" novalidate>
      <!-- Nama -->
      <div class="mb-3">
        <label for="nama" class="form-label">Nama</label>
        <input type="text" class="form-control" id="nama" name="nama" required>
        <div class="invalid-feedback">Nama diperlukan.</div>
      </div>

      <!-- Umur -->
      <div class="mb-3">
        <label for="umur" class="form-label">Umur</label>
        <input type="number" class="form-control" id="umur" name="umur" required>
        <div class="invalid-feedback">Umur diperlukan.</div>
      </div>

      <!-- Berat Badan -->
      <div class="mb-3">
        <label for="berat_badan" class="form-label">Berat Badan (kg)</label>
        <input type="number" class="form-control" id="berat_badan" name="berat_badan" required>
        <div class="invalid-feedback">Berat badan diperlukan.</div>
      </div>

      <!-- Jumlah Karbohidrat -->
      <div class="mb-3">
        <label for="jumlah_karbo" class="form-label">Jumlah Karbohidrat dalam Kemasan (gram)</label>
        <input type="number" class="form-control" id="jumlah_karbo" name="jumlah_karbo" required>
        <div class="invalid-feedback">Jumlah karbohidrat diperlukan.</div>
      </div>

      <!-- Pilihan Status -->
      <div class="mb-3">
        <label for="status" class="form-label">Status</label>
        <select class="form-select" id="status" name="status" onchange="toggleExtraFields(this)" required>
          <option value="" disabled selected>Pilih Status</option>
          <option value="hamil">Ibu Hamil</option>
          <option value="menyusui">Ibu Menyusui</option>
        </select>
        <div class="invalid-feedback">Pilih status Anda.</div>
      </div>

      <!-- Input Tambahan untuk Ibu Hamil -->
      <div id="hamil-fields" style="display: none;">
        <div class="mb-3">
          <label for="riwayat_keluarga" class="form-label">Riwayat keluarga dengan DM?</label>
          <select class="form-select" id="riwayat_keluarga" name="riwayat_keluarga">
            <option value="" disabled selected>Pilih Riwayat Keluarga</option>
            <option value="ya">Ya</option>
            <option value="tidak">Tidak</option>
          </select>
        </div>
      </div>

      <!-- Input Tambahan untuk Ibu Menyusui -->
      <div id="menyusui-fields" style="display: none;">
        <div class="mb-3">
          <label for="berat_bayi" class="form-label">Berat Badan Bayi Baru Lahir (kg)</label>
          <input type="number" class="form-control" id="berat_bayi" name="berat_bayi">
        </div>
      </div>

      <!-- Submit Button -->
      <button type="submit" class="btn btn-primary">Hitung Karbohidrat</button>
    </form>

    <hr class="my-4">

    <?php
    // Menampilkan data karbohidrat yang tersimpan
    include 'db.php'; // Pastikan ini mengarah ke file db.php yang benar

    try {
        $stmt = $pdo->query('SELECT * FROM carbohydrate_data');
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($data) > 0) {
            echo '<h3>Data Karbohidrat Tersimpan</h3>';
            foreach ($data as $row) {
                $karbo_persen = $row['status'] === 'hamil' ? $row['jumlah_karbo'] / 345 * 100 : $row['jumlah_karbo'] / 360 * 100;
                $status = $row['status'];
                $category = '';

                // Tentukan kategori berdasarkan data
                if ($status === 'hamil') {
                    if ($row['umur'] < 25) {
                        $category = ($row['riwayat_keluarga'] === 'ya') ? 'Resiko Tinggi' : 'Resiko Rendah';
                    } else {
                        $category = 'Resiko Tinggi';
                    }
                } else {
                    if ($row['umur'] >= 30) {
                        $category = ($row['berat_bayi'] >= 4) ? 'Resiko Tinggi' : 'Resiko Rendah';
                    } else {
                        $category = ($row['berat_bayi'] >= 4) ? 'Resiko Tinggi' : 'Resiko Rendah';
                    }
                }

                echo '<div class="bubble">';
                echo '<h3>Identitas Pengguna</h3>';
                echo '<p>Nama: ' . htmlspecialchars($row['nama']) . '</p>';
                echo '<p>Umur: ' . htmlspecialchars($row['umur']) . ' tahun</p>';
                echo '<p>Berat Badan: ' . htmlspecialchars($row['berat_badan']) . ' kg</p>';
                echo '<h3>Hasil Perhitungan Karbohidrat</h3>';
                echo '<p>Jumlah Karbohidrat dalam Kemasan: ' . htmlspecialchars($row['jumlah_karbo']) . ' gram</p>';
                echo '<p>Persentase Karbohidrat: ' . number_format($karbo_persen, 2) . '%</p>';
                echo '<h3>Kategori Risiko</h3>';
                echo '<p>' . $category . '</p>';
                echo '<div class="btn-container">';
                echo '<a href="update_carbs.php?id=' . htmlspecialchars($row['id']) . '" class="btn btn-warning">Update</a> ';
                echo '<a href="delete_carbs.php?id=' . htmlspecialchars($row['id']) . '" class="btn btn-danger">Delete</a>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo '<p>Belum ada data karbohidrat yang tersimpan.</p>';
        }
    } catch (PDOException $e) {
        echo '<p>Terjadi kesalahan: ' . $e->getMessage() . '</p>';
    }
    ?>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

  <!-- Form Validation Script -->
  <script>
    (function () {
      'use strict';
      var forms = document.querySelectorAll('.needs-validation');
      Array.prototype.slice.call(forms).forEach(function (form) {
        form.addEventListener('submit', function (event) {
          if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
          }
          form.classList.add('was-validated');
        }, false);
      });
    })();
  </script>
</body>
</html>



