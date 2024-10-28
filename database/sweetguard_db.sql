-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 28 Okt 2024 pada 09.01
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sweetguard_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `karbohidrat_data`
--

CREATE TABLE `karbohidrat_data` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `kondisi` varchar(30) NOT NULL,
  `umur` int(3) DEFAULT NULL,
  `berat_badan` decimal(5,2) DEFAULT NULL,
  `berat_bayi` decimal(5,2) DEFAULT NULL,
  `riwayat_diabetes` varchar(20) NOT NULL,
  `karbo_dalam_kemasan` decimal(5,2) DEFAULT NULL,
  `karbo_persen` decimal(5,2) DEFAULT NULL,
  `saran` text DEFAULT NULL,
  `peringatan` text DEFAULT NULL,
  `risiko` varchar(50) DEFAULT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `karbohidrat_data`
--

INSERT INTO `karbohidrat_data` (`id`, `user_id`, `nama`, `kondisi`, `umur`, `berat_badan`, `berat_bayi`, `riwayat_diabetes`, `karbo_dalam_kemasan`, `karbo_persen`, `saran`, `peringatan`, `risiko`, `tanggal`) VALUES
(38, 1, 'Alisa', 'hamil', 24, '55.00', '4.00', 'tidak', '5.00', '1.45', 'Untuk menjaga kesehatan, disarankan agar konsumsi karbohidrat Anda tidak melebihi 345 gram per hari.', 'Dengan usia di bawah 25 tahun dan tanpa riwayat keluarga diabetes melitus, Anda berada dalam kategori risiko rendah untuk diabetes. Namun, menjaga pola makan seimbang tetap penting.', 'Resiko Rendah', '2024-10-28 07:15:57'),
(39, 1, 'Alisa', 'hamil', 44, '55.00', '0.00', 'ya', '5.00', '1.45', 'Untuk menjaga kesehatan, disarankan agar konsumsi karbohidrat Anda tidak melebihi 345 gram per hari.', 'Karena usia Anda di atas 30 tahun dan memiliki riwayat keluarga diabetes melitus, Anda termasuk dalam kategori risiko tinggi untuk diabetes.', 'Resiko Tinggi', '2024-10-28 07:22:15'),
(40, 1, 'Alisa', 'menyusui', 24, '55.00', '4.00', 'tidak', '3.00', '0.83', 'Untuk menjaga kesehatan, disarankan agar konsumsi karbohidrat Anda tidak melebihi 360 gram per hari.', 'Karena Anda memiliki riwayat melahirkan bayi dengan berat badan 4kg atau lebih, Anda termasuk dalam kategori risiko tinggi untuk diabetes.', 'Resiko Tinggi', '2024-10-28 07:22:49'),
(41, 3, 'Yuuki', 'hamil', 33, '45.00', '0.00', 'ya', '6.00', '1.74', 'Untuk menjaga kesehatan, disarankan agar konsumsi karbohidrat Anda tidak melebihi 345 gram per hari.', 'Karena usia Anda di atas 30 tahun dan memiliki riwayat keluarga diabetes melitus, Anda termasuk dalam kategori risiko tinggi untuk diabetes.', 'Resiko Tinggi', '2024-10-28 07:41:56'),
(42, 3, 'Yuuki', 'hamil', 22, '55.00', '0.00', 'tidak', '3.00', '0.87', 'Untuk menjaga kesehatan, disarankan agar konsumsi karbohidrat Anda tidak melebihi 345 gram per hari.', 'Dengan usia di bawah 25 tahun dan tanpa riwayat keluarga diabetes melitus, Anda berada dalam kategori risiko rendah untuk diabetes. Namun, menjaga pola makan seimbang tetap penting.', 'Resiko Rendah', '2024-10-28 07:42:13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` enum('user','admin') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `level`) VALUES
(1, 'Alisa', 'zidanealfareshy@gmail.com', '$2y$10$VYuz3G5QpxoydHMWbdpqTufzve7JgQfjaids.Aiqi6k/KHtZQjGye', 'user'),
(3, 'Yuuki', 'najwazakiya4@gmail.com', '$2y$10$1KLrceGA9yMRI.eke6emSOkfW1P/ehzCnEYpbi6ykYTs80j0JLBMu', 'user'),
(4, 'Administrator', 'admin', '$2y$10$zd3rwttugfot9Ssh4vdwTOc5u0ZfTaC4DvyJjZLgqA5.Zx/OjoUkW', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `karbohidrat_data`
--
ALTER TABLE `karbohidrat_data`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `karbohidrat_data`
--
ALTER TABLE `karbohidrat_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
