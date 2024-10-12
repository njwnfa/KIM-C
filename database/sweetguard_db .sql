-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 12 Okt 2024 pada 19.25
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
  `karbo_dalam_kemasan` decimal(5,2) DEFAULT NULL,
  `karbo_persen` decimal(5,2) DEFAULT NULL,
  `saran` text DEFAULT NULL,
  `peringatan` text DEFAULT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `karbohidrat_data`
--

INSERT INTO `karbohidrat_data` (`id`, `user_id`, `nama`, `kondisi`, `umur`, `berat_badan`, `berat_bayi`, `karbo_dalam_kemasan`, `karbo_persen`, `saran`, `peringatan`, `tanggal`) VALUES
(17, 1, 'Mohammad Jindan Dubbay Al Faresh', 'hamil', 45, '45.00', '5.00', '5.00', '1.45', 'Untuk menjaga kesehatan, disarankan agar konsumsi karbohidrat Anda tidak melebihi 345 gram per hari.', 'Karena usia Anda lebih dari 30 tahun, Anda termasuk dalam kategori risiko tinggi untuk diabetes. Harap batasi konsumsi karbohidrat untuk menghindari risiko diabetes.', '2024-10-12 17:16:31'),
(18, 1, 'Mohammad Jindan Dubbay Al Faresh', 'hamil', 43, '45.00', '2.00', '3.00', '0.87', 'Untuk menjaga kesehatan, disarankan agar konsumsi karbohidrat Anda tidak melebihi 345 gram per hari.', 'Karena usia Anda lebih dari 30 tahun, Anda termasuk dalam kategori risiko tinggi untuk diabetes. Harap batasi konsumsi karbohidrat untuk menghindari risiko diabetes.', '2024-10-12 17:16:57'),
(19, 1, 'Mohammad Jindan Dubbay Al Faresh', 'menyusui', 23, '45.00', '3.00', '3.00', '0.83', 'Untuk menjaga kesehatan, disarankan agar konsumsi karbohidrat Anda tidak melebihi 360 gram per hari.', '', '2024-10-12 17:17:40'),
(20, 1, 'Mohammad Jindan Dubbay Al Faresh', 'menyusui', 23, '45.00', '3.00', '3.00', '0.83', 'Untuk menjaga kesehatan, disarankan agar konsumsi karbohidrat Anda tidak melebihi 360 gram per hari.', '', '2024-10-12 17:17:57'),
(21, 1, 'Mohammad Jindan Dubbay Al Faresh', 'menyusui', 23, '45.00', '3.00', '3.00', '0.83', 'Untuk menjaga kesehatan, disarankan agar konsumsi karbohidrat Anda tidak melebihi 360 gram per hari.', '', '2024-10-12 17:18:10'),
(22, 1, 'Mohammad Jindan Dubbay Al Faresh', 'menyusui', 23, '45.00', '3.00', '3.00', '0.83', 'Untuk menjaga kesehatan, disarankan agar konsumsi karbohidrat Anda tidak melebihi 360 gram per hari.', '', '2024-10-12 17:18:19'),
(23, 1, 'Mohammad Jindan Dubbay Al Faresh', 'menyusui', 23, '45.00', '3.00', '3.00', '0.83', 'Untuk menjaga kesehatan, disarankan agar konsumsi karbohidrat Anda tidak melebihi 360 gram per hari.', '', '2024-10-12 17:18:27'),
(24, 1, 'Mohammad Jindan Dubbay Al Faresh', 'hamil', 46, '45.00', '2.00', '2.00', '0.58', 'Untuk menjaga kesehatan, disarankan agar konsumsi karbohidrat Anda tidak melebihi 345 gram per hari.', 'Karena usia Anda lebih dari 30 tahun, Anda termasuk dalam kategori risiko tinggi untuk diabetes. Harap batasi konsumsi karbohidrat untuk menghindari risiko diabetes.', '2024-10-12 17:20:46'),
(25, 1, 'Mohammad Jindan Dubbay Al Faresh', 'hamil', 46, '45.00', '2.00', '2.00', '0.58', 'Untuk menjaga kesehatan, disarankan agar konsumsi karbohidrat Anda tidak melebihi 345 gram per hari.', 'Karena usia Anda lebih dari 30 tahun, Anda termasuk dalam kategori risiko tinggi untuk diabetes. Harap batasi konsumsi karbohidrat untuk menghindari risiko diabetes.', '2024-10-12 17:20:55'),
(26, 1, 'Mohammad Jindan Dubbay Al Faresh', 'hamil', 46, '45.00', '2.00', '2.00', '0.58', 'Untuk menjaga kesehatan, disarankan agar konsumsi karbohidrat Anda tidak melebihi 345 gram per hari.', 'Karena usia Anda lebih dari 30 tahun, Anda termasuk dalam kategori risiko tinggi untuk diabetes. Harap batasi konsumsi karbohidrat untuk menghindari risiko diabetes.', '2024-10-12 17:21:27');

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
(1, 'Mohammad Jindan Dubbay Al Faresh', 'zidanealfareshy@gmail.com', '$2y$10$VYuz3G5QpxoydHMWbdpqTufzve7JgQfjaids.Aiqi6k/KHtZQjGye', 'user'),
(3, 'Yuuki', 'najwazakiya4@gmail.com', '$2y$10$1KLrceGA9yMRI.eke6emSOkfW1P/ehzCnEYpbi6ykYTs80j0JLBMu', 'user');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
