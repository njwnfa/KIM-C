-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Okt 2024 pada 21.43
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
-- Struktur dari tabel `carbohydrate_data`
--

CREATE TABLE `carbohydrate_data` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `umur` int(11) DEFAULT NULL,
  `berat_badan` float DEFAULT NULL,
  `jumlah_karbo` float DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `riwayat_keluarga` varchar(10) DEFAULT NULL,
  `berat_bayi` float DEFAULT NULL,
  `kategori` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `carbohydrate_data`
--

INSERT INTO `carbohydrate_data` (`id`, `nama`, `umur`, `berat_badan`, `jumlah_karbo`, `status`, `riwayat_keluarga`, `berat_bayi`, `kategori`) VALUES
(1, 'nana', 30, 45, 6, 'hamil', NULL, NULL, NULL),
(2, 'nana', 30, 45, 6, 'hamil', 'ya', 0, NULL),
(3, 'nana', 30, 45, 6, 'hamil', 'ya', 0, NULL),
(4, 'nana', 30, 45, 6, 'hamil', 'ya', 0, NULL),
(5, 'nana', 30, 45, 6, 'hamil', 'ya', 0, NULL),
(6, 'nana', 30, 45, 6, 'hamil', 'ya', 0, NULL),
(7, 'nana', 30, 45, 6, 'hamil', NULL, 0, NULL),
(8, 'nana', 30, 45, 6, 'hamil', NULL, 0, NULL),
(9, 'nana', 30, 45, 6, 'hamil', NULL, 0, NULL),
(10, 'nana', 30, 45, 6, 'hamil', NULL, 0, NULL),
(11, 'nana', 30, 45, 6, 'hamil', NULL, 0, NULL);

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
(1, 'Mohammad Jindan Dubbay Al Faresh', 'zidanealfareshy@gmail.com', '$2y$10$VYuz3G5QpxoydHMWbdpqTufzve7JgQfjaids.Aiqi6k/KHtZQjGye', 'user');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `carbohydrate_data`
--
ALTER TABLE `carbohydrate_data`
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
-- AUTO_INCREMENT untuk tabel `carbohydrate_data`
--
ALTER TABLE `carbohydrate_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
