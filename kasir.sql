-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 07, 2024 at 05:32 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kasir`
--

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `pelanggan_id` int(11) NOT NULL,
  `toko_id` int(11) NOT NULL,
  `nama_pelanggan` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `no_hp` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`pelanggan_id`, `toko_id`, `nama_pelanggan`, `alamat`, `no_hp`, `created_at`) VALUES
(6, 9, 'deni', 'banjar', '08878987125', '2024-02-20 04:11:47'),
(7, 9, 'jenal', 'warpeyeum', '098767766', '2024-03-06 07:44:48'),
(15, 9, 'andre', 'dobo', '09887656476', '2024-03-06 00:58:50'),
(16, 9, 'dida', 'banjar', '09876556776', '2024-03-06 00:59:05'),
(18, 9, 'agung', 'cimaragas', '09878786565', '2024-03-07 04:27:26');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `pembelian_id` int(11) NOT NULL,
  `toko_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `no_faktur` varchar(50) NOT NULL,
  `tanggal_pembelian` date NOT NULL,
  `suplier_id` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `bayar` int(11) NOT NULL,
  `sisa` int(11) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `stock` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`pembelian_id`, `toko_id`, `user_id`, `no_faktur`, `tanggal_pembelian`, `suplier_id`, `total`, `bayar`, `sisa`, `keterangan`, `created_at`, `stock`) VALUES
(10, 9, 1, '19-20240221', '0454-04-05', 10, 30000, 80000, 50000, 'di bayar', '2024-03-07 02:13:48', 10),
(11, 9, 1, '20-20240221', '0012-12-12', 10, 26000, 30000, 4000, 'bayar', '2024-03-07 02:13:48', 0),
(12, 9, 1, '21-20240221', '2024-02-21', 10, 25000, 30000, 5000, 'bayar', '2024-03-07 02:13:48', 10),
(13, 9, 1, '22-20240222', '2024-02-22', 10, 25000, 30000, 5000, 'lunas', '2024-03-07 02:13:48', 10),
(16, 9, 1, '25-20240222', '2024-02-22', 10, 30000, 40000, 10000, 'bayar', '2024-03-07 02:13:49', 50),
(17, 9, 1, '26-20240222', '2024-02-22', 10, 25000, 30000, 5000, 'lunas', '2024-03-07 02:13:49', 10),
(19, 9, 4, '28-20240222', '2024-02-22', 10, 18000, 20000, 2000, 'terbayar', '2024-03-07 02:13:49', 7),
(20, 9, 4, '29-20240222', '2024-02-22', 10, 30000, 50000, 20000, 'kontan', '2024-03-07 02:13:49', 9),
(27, 0, 0, 'F1709778477567', '2024-03-07', 10, 12000, 100000, 12000, 'ok', '2024-03-07 02:28:14', 232),
(29, 0, 0, 'F1709780108471', '2024-03-07', 10, 12000, 100000, 1000, 'yes', '2024-03-07 02:58:12', 1),
(30, 0, 0, 'F1709781247787', '2024-03-07', 9, 25000, 30000, 5000, 'alhamdulilah', '2024-03-07 03:15:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pembelian_detail`
--

CREATE TABLE `pembelian_detail` (
  `beli_detail_id` int(11) NOT NULL,
  `pembelian_id` int(11) NOT NULL,
  `produk_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembelian_detail`
--

INSERT INTO `pembelian_detail` (`beli_detail_id`, `pembelian_id`, `produk_id`, `qty`, `harga_beli`, `created_at`) VALUES
(10, 9, 1, 1, 7000, '2024-02-22 01:22:34'),
(18, 1794503, 31, 9, 3000, '2024-02-22 04:43:14'),
(19, 8747187, 30, 1, 30000, '2024-02-22 04:44:02'),
(20, 3921032, 32, 1, 30000, '2024-02-22 04:44:57'),
(21, 6239294, 31, 1, 40000, '2024-02-22 07:49:36'),
(22, 8825336, 32, 1, 30000, '2024-02-22 08:00:16'),
(23, 75705, 32, 1, 30000, '2024-02-22 08:01:44');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `penjualan_id` int(11) NOT NULL,
  `toko_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tanggal_penjualan` date NOT NULL,
  `pelanggan_id` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `bayar` int(11) NOT NULL,
  `sisa` int(11) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`penjualan_id`, `toko_id`, `user_id`, `tanggal_penjualan`, `pelanggan_id`, `total`, `bayar`, `sisa`, `keterangan`, `created_at`) VALUES
(62, 9, 4, '2024-03-04', 6, 25000, 30000, 5000, 'ok', '2024-03-03 22:29:12'),
(63, 9, 4, '2024-03-04', 6, 25000, 30000, 5000, 'lunas', '2024-03-03 22:43:46'),
(64, 9, 4, '2024-03-04', 6, 30000, 40000, 10000, 'kontan', '2024-03-04 00:29:54'),
(65, 9, 4, '2024-03-06', 15, 80000, 100000, 20000, 'terbayar', '2024-03-05 20:51:30'),
(66, 9, 4, '2024-03-06', 0, 10000, 100000, 90000, 'terbayar', '2024-03-06 02:48:13'),
(67, 9, 4, '2024-03-06', 16, 50000, 55000, 5000, 'di bayar', '2024-03-06 02:49:30'),
(68, 9, 4, '2024-03-07', 15, 55000, 60000, 5000, 'dibayar', '2024-03-06 22:21:54');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan_detail`
--

CREATE TABLE `penjualan_detail` (
  `penjualan_detail_id` int(11) NOT NULL,
  `penjualan_id` int(11) NOT NULL,
  `produk_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `harga_beli` int(11) DEFAULT NULL,
  `harga_jual` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penjualan_detail`
--

INSERT INTO `penjualan_detail` (`penjualan_detail_id`, `penjualan_id`, `produk_id`, `qty`, `harga_beli`, `harga_jual`, `created_at`) VALUES
(2, 59, 35, 1, NULL, 2000, '2024-03-03 21:01:24'),
(3, 60, 36, 1, NULL, 5000, '2024-03-03 21:07:00'),
(4, 61, 35, 1, NULL, 2000, '2024-03-03 21:10:51'),
(5, 62, 39, 2, NULL, 50000, '2024-03-03 22:29:12'),
(6, 63, 39, 5, NULL, 125000, '2024-03-03 22:43:46'),
(7, 64, 40, 2, NULL, 60000, '2024-03-04 00:29:54'),
(8, 65, 50, 2, NULL, 10000, '2024-03-05 20:51:30'),
(9, 65, 43, 2, NULL, 100000, '2024-03-05 20:51:30'),
(10, 65, 39, 5, NULL, 125000, '2024-03-05 20:51:30'),
(11, 66, 38, 5, NULL, 50000, '2024-03-06 02:48:13'),
(12, 67, 43, 5, NULL, 250000, '2024-03-06 02:49:30'),
(13, 68, 43, 5, NULL, 250000, '2024-03-06 22:21:54'),
(14, 68, 50, 1, NULL, 5000, '2024-03-06 22:21:54');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `produk_id` int(11) NOT NULL,
  `toko_id` int(11) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `satuan` varchar(50) NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `stock` int(11) NOT NULL,
  `suplier_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`produk_id`, `toko_id`, `nama_produk`, `kategori_id`, `satuan`, `harga_beli`, `harga_jual`, `created_at`, `stock`, `suplier_id`) VALUES
(35, 9, 'panta', 8, '      botol', 0, 6000, '2024-03-06 00:46:22', 15, 10),
(38, 9, 'kecap', 12, '    pcs', 0, 10000, '2024-03-06 08:48:13', 6, 9),
(39, 9, 'jarum super', 8, 'bungkus', 0, 25000, '2024-03-06 02:51:31', 23, 12),
(40, 9, 'magnum', 8, ' bungkus', 0, 30000, '2024-03-04 07:20:35', 18, 12),
(41, 9, 'la', 8, 'pcs', 0, 12000, '2024-03-04 07:21:59', 10, 12),
(42, 9, 'sampoerna mild', 8, 'bungkus', 0, 32000, '2024-03-04 15:27:07', 10, 12),
(43, 9, 'mie instan', 12, 'bungkus', 0, 50000, '2024-03-07 04:21:54', 0, 9),
(44, 9, 'gudang garam', 8, 'bungkus', 0, 24000, '2024-03-06 00:45:48', 15, 9),
(45, 9, 'sprit', 14, 'botol', 0, 5000, '2024-03-06 00:45:48', 20, 10),
(46, 9, 'marjan', 14, 'kardus', 0, 100000, '2024-03-06 00:45:48', 25, 10),
(47, 9, '76 mangga', 8, 'bungkus', 0, 14000, '2024-03-06 00:45:48', 15, 12),
(48, 9, 'kinderjoy', 12, 'pcs', 0, 15000, '2024-03-06 00:45:48', 5, 9),
(50, 9, 'nipis madu', 14, 'botol', 0, 5000, '2024-03-07 04:21:54', 17, 10),
(51, 9, 'pop mie', 12, 'kardus', 0, 50000, '2024-03-06 01:32:56', 20, 9),
(52, 9, 'la bold', 8, 'bungkus', 0, 25000, '2024-03-06 01:32:44', 15, 12),
(53, 9, 'susu', 8, '  box', 0, 19000, '2024-03-06 08:50:31', 9, 10),
(54, 9, 'sprit', 14, 'botol', 0, 5000, '2024-03-06 03:13:06', 5, 10);

-- --------------------------------------------------------

--
-- Table structure for table `produk_kategori`
--

CREATE TABLE `produk_kategori` (
  `kategori_id` int(11) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk_kategori`
--

INSERT INTO `produk_kategori` (`kategori_id`, `nama_kategori`, `created_at`) VALUES
(8, 'roko', '2024-03-04 04:21:26'),
(12, 'makanan', '2024-03-04 07:08:18'),
(14, 'minuman', '2024-03-04 07:08:06');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `id` int(11) NOT NULL,
  `produk_id` int(11) NOT NULL,
  `jumlah_masuk` int(11) NOT NULL,
  `tanggal_masuk` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`id`, `produk_id`, `jumlah_masuk`, `tanggal_masuk`) VALUES
(1, 37, 10, '0000-00-00'),
(2, 37, 10, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `suplier`
--

CREATE TABLE `suplier` (
  `suplier_id` int(11) NOT NULL,
  `toko_id` int(11) NOT NULL,
  `nama_suplier` varchar(50) NOT NULL,
  `tlp_hp` varchar(50) NOT NULL,
  `alamat_suplier` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `suplier`
--

INSERT INTO `suplier` (`suplier_id`, `toko_id`, `nama_suplier`, `tlp_hp`, `alamat_suplier`, `created_at`) VALUES
(9, 9, 'apuh', '098789865', 'balokang', '2024-02-21 00:50:44'),
(10, 9, 'adam', '09090898', 'banjar', '2024-02-28 02:46:08'),
(12, 9, 'zaki', '0988675645', 'banjar', '2024-03-04 15:24:52');

-- --------------------------------------------------------

--
-- Table structure for table `toko`
--

CREATE TABLE `toko` (
  `toko_id` int(11) NOT NULL,
  `nama_toko` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `tlp_hp` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `toko`
--

INSERT INTO `toko` (`toko_id`, `nama_toko`, `alamat`, `tlp_hp`, `created_at`) VALUES
(9, 'apuh', 'balokang', '085228776789', '2024-02-20 04:10:37');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `toko_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `role` varchar(50) NOT NULL,
  `craeted_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `toko_id`, `username`, `password`, `email`, `nama_lengkap`, `alamat`, `role`, `craeted_at`) VALUES
(4, 3, 'kasir', '$2y$10$kSzZIgxisd3wQueccnui5uR7SfEeF02w2bkhFAa62U8KG/ILiW6yG', 'jenal@gmai.com', 'jenal', 'warpey', 'kasir', '2024-02-20 01:30:14'),
(8, 9, 'admin1', '$2y$10$r2yURKYDOQPAmbVycUcUyOMGhMDwn4.yjyfM1hyCsPByyemE.dOHy', 'deniap@gmail.com', 'deni', 'banjar', 'admin', '2024-02-22 01:39:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`pelanggan_id`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`pembelian_id`);

--
-- Indexes for table `pembelian_detail`
--
ALTER TABLE `pembelian_detail`
  ADD PRIMARY KEY (`beli_detail_id`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`penjualan_id`);

--
-- Indexes for table `penjualan_detail`
--
ALTER TABLE `penjualan_detail`
  ADD PRIMARY KEY (`penjualan_detail_id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`produk_id`);

--
-- Indexes for table `produk_kategori`
--
ALTER TABLE `produk_kategori`
  ADD PRIMARY KEY (`kategori_id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suplier`
--
ALTER TABLE `suplier`
  ADD PRIMARY KEY (`suplier_id`);

--
-- Indexes for table `toko`
--
ALTER TABLE `toko`
  ADD PRIMARY KEY (`toko_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `pelanggan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `pembelian_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `pembelian_detail`
--
ALTER TABLE `pembelian_detail`
  MODIFY `beli_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `penjualan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `penjualan_detail`
--
ALTER TABLE `penjualan_detail`
  MODIFY `penjualan_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `produk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `produk_kategori`
--
ALTER TABLE `produk_kategori`
  MODIFY `kategori_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `suplier`
--
ALTER TABLE `suplier`
  MODIFY `suplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `toko`
--
ALTER TABLE `toko`
  MODIFY `toko_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
