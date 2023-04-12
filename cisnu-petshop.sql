-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 12 Apr 2023 pada 07.32
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cisnu-petshop`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_pesanan`
--

CREATE TABLE `barang_pesanan` (
  `id_barang_pesanan` int(11) UNSIGNED NOT NULL,
  `id_supplier` varchar(11) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `tanggal_pesan` date NOT NULL,
  `jumlah` int(11) NOT NULL,
  `status` enum('Dipesan','Dikirim','Diterima') NOT NULL DEFAULT 'Dipesan'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `barang_pesanan`
--

INSERT INTO `barang_pesanan` (`id_barang_pesanan`, `id_supplier`, `nama_barang`, `tanggal_pesan`, `jumlah`, `status`) VALUES
(1, 'SUP0001', 'Bolt 100 Kg', '2023-03-22', 2, 'Dikirim'),
(2, 'SUP0002', 'Bolt 50 Kg', '2023-03-22', 3, 'Dikirim'),
(3, 'SUP0001  ', 'Ikan Hias Mas', '0000-00-00', 10, 'Dikirim'),
(4, 'SUP0001  ', 'Ikan Koi', '2023-03-23', 12, 'Dikirim'),
(5, 'SUP0002', 'Ikan Sapu-SApu', '2023-03-23', 8, 'Dikirim'),
(6, 'SUP0001  ', 'Wiskas 250gram', '2023-03-23', 12, 'Dikirim'),
(7, 'SUP0001  ', 'Aquaruin Ukuran 200x20x30', '2023-03-23', 5, 'Dikirim'),
(8, 'SUP0001  ', 'Batu Malang 10kg', '2023-03-23', 9, 'Dikirim');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2023-03-21-044537', 'App\\Database\\Migrations\\UsersTable', 'default', 'App', 1679374246, 1),
(2, '2023-03-22-064923', 'App\\Database\\Migrations\\SupplierTable', 'default', 'App', 1679472051, 2),
(3, '2023-03-22-144852', 'App\\Database\\Migrations\\BarangPesanan', 'default', 'App', 1679496785, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_hp` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `nama`, `email`, `password`, `alamat`, `no_hp`) VALUES
('SUP0001  ', 'Supplier 1', 'supplier1@gmail.com', '$2y$10$ILW7oldua0SMsoQvv5WmJePWwj28MBhA59aD2cxE95MwrP2WY1nzu', 'Jl. Siliwangi No. 1 Kuningan', '087678876654'),
('SUP0002', 'Supplier', 'supplier@gmail.com', '$2y$10$yUAwyy/Ub9tQT.nlGN6i9.m.irg1yA0wWEv2OW7mEmB3BkmVM8DmS', 'Jl. Siliwangi No. 5 Kuningan', '+6285321587049');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `password`, `role`) VALUES
(1, 'Pimpinan', 'pimpinan@gmail.com', '$2y$10$W.k3R/Ou/PxuPzDid9wmiO9Dg2gNIk3eA1nZL8CVd4bEyKYSLWKiC', '1'),
(2, 'Pegawai', 'pegawai@gmail.com', '$2y$10$v.vQ1QXn.Ra2JmdMDyJF.uPcDZMaDGV1rMTbHKJnN7HbEjHRCbX1m', '2'),
(3, 'Supplier', 'supplier@gmail.com', '$2y$10$RNURa3AfkQ.74bY79G3c2.8vhZ6PDPQH1l3PhCTgCLgArnXYIaxUC', '3'),
(6, 'Pegawai 2', 'pegawai2@gmail.com', '$2y$10$U7RKcXZ178V0eiYodyOQtOeP7m4KNYCIIO.OasqLSyDdPq4J9OOo6', '2');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang_pesanan`
--
ALTER TABLE `barang_pesanan`
  ADD PRIMARY KEY (`id_barang_pesanan`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang_pesanan`
--
ALTER TABLE `barang_pesanan`
  MODIFY `id_barang_pesanan` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
