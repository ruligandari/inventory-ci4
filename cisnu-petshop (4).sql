-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Jun 2023 pada 13.10
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.2.0

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
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id_barang` varchar(255) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `id_supplier` varchar(255) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_barang`, `id_supplier`, `id_kategori`, `stok`, `harga`) VALUES
('BR-0001', 'Vital Rabit Citrafeed 25kg', 'SUP0001  ', 1, 16, 250000),
('BR-0002', 'Worcmectin 5ml (box)', 'SUP0001', 2, 3, 140000),
('BR-0003', 'Wishkas Junior 80gr (box)', 'SUP0001', 2, 0, 160000),
('BR-0004', 'Wishkas Adult Tuna dan Ocean Fish 80gr (box)', 'SUP0001', 2, -10, 165000),
('BR-0005', 'Wishkas Dry Junior  450gr', 'SUP0001', 2, 0, 29000),
('BR-0006', 'Wishkas Dry Adult 1,5kg', 'SUP0001', 2, 0, 69000),
('BR-0007', 'Me-o Creamy Treats 60gr', 'SUP0001', 2, 0, 21000),
('BR-0008', 'Trixtin Cat 10ml', 'SUP0001', 1, 0, 8000),
('BR-0009', 'Takari Petindo Koi 100gr', 'SUP0001  ', 2, 0, 3500),
('BR-0010', 'Serokan Seser Ikan 10cm', 'SUP0001', 3, 0, 3000),
('BR-0011', 'Pasir Gumpal Wangi Zeolit 25kg', 'SUP0001', 3, 0, 24000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_keluar`
--

CREATE TABLE `barang_keluar` (
  `id_barang_keluar` int(11) NOT NULL,
  `id_supplier` varchar(255) NOT NULL,
  `id_barang` varchar(255) NOT NULL,
  `tanggal_pesan` date NOT NULL,
  `harga` double NOT NULL,
  `jumlah` int(11) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `barang_keluar`
--

INSERT INTO `barang_keluar` (`id_barang_keluar`, `id_supplier`, `id_barang`, `tanggal_pesan`, `harga`, `jumlah`, `status`) VALUES
(1, 'SUP0001', 'BR-0001', '2023-02-15', 250000, 3, 'Terjual'),
(2, 'SUP0001', 'BR-0002', '2023-02-15', 140000, 2, 'Terjual'),
(3, 'SUP0001', 'BR-0003', '2023-02-16', 160000, 3, 'Terjual'),
(4, 'SUP0001', 'BR-0004', '2023-02-17', 165000, 3, 'Terjual'),
(5, 'SUP0001', 'BR-0005', '2023-02-18', 29000, 14, 'Terjual'),
(6, 'SUP0001', 'BR-0006', '2023-02-19', 69000, 9, 'Terjual'),
(7, 'SUP0001', 'BR-0007', '2023-02-20', 21000, 15, 'Terjual'),
(8, 'SUP0001', 'BR-0008', '2023-02-21', 8000, 10, 'Terjual'),
(9, 'SUP0001', 'BR-0009', '2023-02-22', 3500, 9, 'Terjual'),
(10, 'SUP0001', 'BR-0010', '2023-02-23', 3000, 7, 'Terjual'),
(11, 'SUP0001', 'BR-0011', '2023-02-24', 24000, 15, 'Terjual'),
(12, 'SUP0001', 'BR-0012', '2023-02-25', 1500, 9, 'Terjual'),
(13, 'SUP0001', 'BR-0001', '2023-03-15', 250000, 10, 'Terjual'),
(14, 'SUP0001', 'BR-0002', '2023-03-16', 140000, 4, 'Terjual'),
(15, 'SUP0001', 'BR-0003', '2023-03-17', 160000, 7, 'Terjual'),
(16, 'SUP0001', 'BR-0004', '2023-03-18', 165000, 9, 'Terjual'),
(17, 'SUP0001', 'BR-0005', '2023-03-19', 29000, 8, 'Terjual'),
(18, 'SUP0001', 'BR-0006', '2023-03-20', 69000, 6, 'Terjual'),
(19, 'SUP0001', 'BR-0007', '2023-03-21', 21000, 18, 'Terjual'),
(20, 'SUP0001', 'BR-0008', '2023-03-22', 8000, 9, 'Terjual'),
(21, 'SUP0001', 'BR-0009', '2023-03-23', 3500, 8, 'Terjual'),
(22, 'SUP0001', 'BR-0010', '2023-03-24', 3000, 10, 'Terjual'),
(23, 'SUP0001', 'BR-0011', '2023-03-25', 24000, 3, 'Terjual'),
(24, 'SUP0001', 'BR-0012', '2023-03-26', 1500, 6, 'Terjual'),
(25, 'SUP0001', 'BR-0001', '2023-04-15', 250000, 10, 'Terjual'),
(26, 'SUP0001', 'BR-0002', '2023-04-16', 140000, 4, 'Terjual'),
(27, 'SUP0001', 'BR-0003', '2023-04-17', 160000, 7, 'Terjual'),
(28, 'SUP0001', 'BR-0004', '2023-04-18', 165000, 9, 'Terjual'),
(29, 'SUP0001', 'BR-0005', '2023-04-19', 29000, 8, 'Terjual'),
(30, 'SUP0001', 'BR-0006', '2023-04-20', 69000, 6, 'Terjual'),
(31, 'SUP0001', 'BR-0007', '2023-04-21', 21000, 18, 'Terjual'),
(32, 'SUP0001', 'BR-0008', '2023-04-22', 8000, 9, 'Terjual'),
(33, 'SUP0001', 'BR-0009', '2023-04-23', 3500, 8, 'Terjual'),
(34, 'SUP0001', 'BR-0010', '2023-04-24', 3000, 10, 'Terjual'),
(35, 'SUP0001', 'BR-0011', '2023-04-25', 24000, 3, 'Terjual'),
(36, 'SUP0001', 'BR-0012', '2023-04-26', 1500, 6, 'Terjual'),
(85, 'SUP0001', 'BR-0001', '2023-05-01', 250000, 8, 'Terjual'),
(86, 'SUP0001', 'BR-0002', '2023-05-01', 140000, 4, 'Terjual'),
(87, 'SUP0001', 'BR-0002', '2023-05-01', 140000, 4, 'Terjual'),
(88, 'SUP0001', 'BR-0001', '2023-05-17', 250000, 8, 'Terjual'),
(89, 'SUP0001', 'BR-0001', '2023-05-28', 500000, 2, 'Terjual'),
(90, 'SUP0001', 'BR-0004', '2023-05-28', 1650000, 10, 'Terjual'),
(91, 'SUP0001', 'BR-0002', '2023-05-28', 280000, 2, 'Terjual'),
(92, 'SUP0001', 'BR-0001', '2023-05-28', 500000, 2, 'Terjual'),
(93, 'SUP0001', 'BR-0001', '2023-05-28', 750000, 3, 'Terjual'),
(94, 'SUP0001', 'BR-0001', '2023-05-28', 2000000, 8, 'Terjual'),
(95, 'SUP0001', 'BR-0002', '2023-05-30', 420000, 3, 'Terjual');

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_masuk`
--

CREATE TABLE `barang_masuk` (
  `id_barang_masuk` int(11) NOT NULL,
  `id_supplier` varchar(255) NOT NULL,
  `id_barang` varchar(255) NOT NULL,
  `tanggal_pesan` date NOT NULL,
  `harga` double NOT NULL,
  `jumlah` int(11) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `barang_masuk`
--

INSERT INTO `barang_masuk` (`id_barang_masuk`, `id_supplier`, `id_barang`, `tanggal_pesan`, `harga`, `jumlah`, `status`) VALUES
(7, 'SUP0001', 'BR-0001', '2023-05-28', 250000, 8, 'Masuk'),
(8, 'SUP0001', 'BR-0001', '2023-05-28', 250000, 8, 'Masuk'),
(9, 'SUP0001', 'BR-0001', '2023-05-28', 250000, 8, 'Masuk'),
(10, 'SUP0001', 'BR-0001', '2023-05-28', 250000, 8, 'Masuk'),
(11, 'SUP0001', 'BR-0002', '2023-05-28', 140000, 4, 'Masuk'),
(12, 'SUP0001', 'BR-0002', '2023-05-28', 140000, 4, 'Masuk'),
(13, 'SUP0001  ', 'BR-0001', '2023-05-30', 250000, 8, 'Masuk');

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_pesanan`
--

CREATE TABLE `barang_pesanan` (
  `id_barang_pesanan` int(11) UNSIGNED NOT NULL,
  `id_supplier` varchar(11) NOT NULL,
  `id_barang` varchar(255) NOT NULL,
  `tanggal_pesan` date NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `status` enum('Menunggu Konfirmasi','Dipesan','Dikirim','Diterima') NOT NULL DEFAULT 'Menunggu Konfirmasi'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `barang_pesanan`
--

INSERT INTO `barang_pesanan` (`id_barang_pesanan`, `id_supplier`, `id_barang`, `tanggal_pesan`, `jumlah`, `total`, `status`) VALUES
(8, 'SUP0001  ', 'BR-0001', '2023-05-28', 8, 2000000, 'Diterima'),
(10, 'SUP0001  ', 'BR-0001', '2023-05-28', 8, 2000000, 'Diterima'),
(11, 'SUP0001  ', 'BR-0001', '2023-05-28', 8, 2000000, 'Diterima'),
(12, 'SUP0001  ', 'BR-0003', '2023-05-28', 6, 960000, 'Diterima'),
(13, 'SUP0001  ', 'BR-0001', '2023-05-28', 8, 2000000, 'Diterima'),
(14, 'SUP0001  ', 'BR-0001', '2023-05-28', 8, 2000000, 'Diterima'),
(15, 'SUP0001  ', 'BR-0001', '2023-05-28', 8, 2000000, 'Diterima'),
(16, 'SUP0001  ', 'BR-0002', '2023-05-28', 4, 560000, 'Diterima'),
(17, 'SUP0001  ', 'BR-0002', '2023-05-28', 4, 560000, 'Diterima'),
(18, 'SUP0001  ', 'BR-0001', '2023-05-30', 8, 2000000, 'Diterima');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Vitamin/Obat-obatan'),
(2, 'Pakan'),
(3, 'Aksesoris');

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
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_barang` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_barang`, `qty`, `total`, `tanggal`) VALUES
(1, 'BR-0001', 10, 2500000, '2023-05-24'),
(2, 'BR-0001', 2, 500000, '2023-05-28'),
(3, 'BR-0004', 10, 1650000, '2023-05-28'),
(4, 'BR-0002', 2, 280000, '2023-05-28'),
(5, 'BR-0001', 2, 500000, '2023-05-28'),
(6, 'BR-0001', 3, 750000, '2023-05-28'),
(7, 'BR-0001', 8, 2000000, '2023-05-28'),
(8, 'BR-0002', 3, 420000, '2023-05-30');

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
(1, 'Pimpinan', 'pimpinan@gmail.com', '$2y$10$zEkY1yb9KfJGyigYisNDG.ZHI8jrgSxgexfY4r9bKPpNmuLDNzqvK', '1'),
(2, 'Pegawai', 'pegawai@gmail.com', '$2y$10$v.vQ1QXn.Ra2JmdMDyJF.uPcDZMaDGV1rMTbHKJnN7HbEjHRCbX1m', '2'),
(3, 'Supplier', 'supplier@gmail.com', '$2y$10$RNURa3AfkQ.74bY79G3c2.8vhZ6PDPQH1l3PhCTgCLgArnXYIaxUC', '3'),
(6, 'Pegawai 2', 'pegawai2@gmail.com', '$2y$10$U7RKcXZ178V0eiYodyOQtOeP7m4KNYCIIO.OasqLSyDdPq4J9OOo6', '2');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD PRIMARY KEY (`id_barang_keluar`);

--
-- Indeks untuk tabel `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD PRIMARY KEY (`id_barang_masuk`);

--
-- Indeks untuk tabel `barang_pesanan`
--
ALTER TABLE `barang_pesanan`
  ADD PRIMARY KEY (`id_barang_pesanan`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

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
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang_keluar`
--
ALTER TABLE `barang_keluar`
  MODIFY `id_barang_keluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT untuk tabel `barang_masuk`
--
ALTER TABLE `barang_masuk`
  MODIFY `id_barang_masuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `barang_pesanan`
--
ALTER TABLE `barang_pesanan`
  MODIFY `id_barang_pesanan` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
