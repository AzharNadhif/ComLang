-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 03, 2025 at 04:08 PM
-- Server version: 8.0.30
-- PHP Version: 8.2.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `comots`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `role` varchar(50) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `role`) VALUES
(1, 'admin12', '$2y$12$uitMFKRO94P4.oKFEUASc.UE/XEU9tjiZ0T1VAt3dtFLS7At3ePtm', 'admin'),
(3, 'suheri', '$2y$12$tu5.z1k5Jvg7IiVGv3yHfuYTbWUAE786PB8xmD4WN2aDcTaaHTda2', 'admin'),
(4, 'admin', '$2y$12$uzP8GPGI7K.ag7ApFckFRO6IRRXQkg1gBezHMBJ7.WqwhOAEoO1qS', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dashboards`
--

CREATE TABLE `dashboards` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `item_pesanans`
--

CREATE TABLE `item_pesanans` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int NOT NULL,
  `kategori` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `kategori`) VALUES
(1, 'Jersey'),
(2, 'Outer'),
(3, 'T-shirt');

-- --------------------------------------------------------

--
-- Table structure for table `kategoris`
--

CREATE TABLE `kategoris` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id_keranjang` bigint UNSIGNED NOT NULL,
  `id_user` bigint UNSIGNED NOT NULL,
  `id_produk` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `keranjang`
--

INSERT INTO `keranjang` (`id_keranjang`, `id_user`, `id_produk`, `created_at`, `updated_at`) VALUES
(23, 8, 2, '2025-05-01 01:17:54', '2025-05-01 01:17:54'),
(32, 5, 2, '2025-05-02 08:45:19', '2025-05-02 08:45:19');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_04_15_120213_create_admins_table', 1),
(5, '2025_04_15_120229_create_produks_table', 1),
(6, '2025_04_15_120232_create_pesanans_table', 1),
(7, '2025_04_15_120233_create_pembayarans_table', 1),
(8, '2025_04_15_120233_create_statuses_table', 1),
(9, '2025_04_15_122956_create_dashboards_table', 1),
(10, '2025_04_17_142350_create_kategoris_table', 2),
(11, '2025_04_21_173223_create_item_pesanans_table', 2),
(12, '2025_04_28_035512_add_id_produk_to_pesanan_table', 2),
(13, '2025_04_28_040148_add_nama_penerima_whatsapp_kodepos_to_pesanan_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int NOT NULL,
  `id_pesanan` int DEFAULT NULL,
  `jumlah_bayar` decimal(10,2) NOT NULL,
  `bukti_bayar` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_pesanan`, `jumlah_bayar`, `bukti_bayar`) VALUES
(1, 1, '150000.00', 'bukti_transfer_1.jpg'),
(2, 2, '300000.00', 'bukti_transfer_2.jpg'),
(3, 3, '750000.00', 'bukti-bayar/eBhn4VopcGhAqk1CZsUHTQNTrIxpmHYaWtjW9THp.jpg'),
(4, 4, '750000.00', 'bukti-bayar/eJbrYInGG4iknHnwDc2fcljKoijLfdcv4H64qlRW.png'),
(5, 5, '300000.00', 'bukti-bayar/EnT2VKh0L2dX2gpzv43JlAH82p2ZN9fyUyUKJ9ha.jpg'),
(6, 5, '300000.00', 'bukti-bayar/TDbtcNRm1M2qvKqTAZvlcFkDZA1tkjS8lOWMWO50.jpg'),
(7, 5, '300000.00', 'bukti-bayar/pXBY9XhEZwWK0RZNG2KN9qQzlMbt5SsMCTIO9E4D.jpg'),
(8, 5, '300000.00', 'bukti-bayar/jokA4iCLeEszKDgLu3V9vLDQfRO43iC1FBFgwMW3.jpg'),
(9, 6, '1237964.00', 'bukti-bayar/lugpGSE0JIiUVGgihPK8QdyJMuCPEiIGApBreyqh.jpg'),
(10, 7, '300000.00', 'bukti-bayar/hkF9yrJOUhIvcM16dcVF5f6BxBsR4AaneTOfkn9S.png'),
(11, 8, '300000.00', 'images/bukti-bayar/KnyxuAUJxXhI7vhJKKLZvILyPD4ZOtgxanuuo4h5.jpg'),
(12, 9, '900000.00', 'images/bukti-bayar/lQcAMJHZtfn16dLmUUdxxmg5PUkjOh5JkKbWto46.png'),
(13, 10, '450000.00', 'images/bukti-bayar/XEfoIdycAK2KZcXNat3nSL7bL75KYjGM7QoFwwY1.png'),
(14, 11, '900000.00', 'images/bukti-bayar/IOC1gHPfjorHSaNJXNAc3da4dAILjYSMy8SIqRUr.png'),
(15, 18, '1050000.00', 'bukti_pembayaran/yFuLnGaISOVsHbPULJBCyM7oaQli0MHcLdCpEPur.jpg'),
(16, 19, '1050000.00', 'bukti_pembayaran/yFuLnGaISOVsHbPULJBCyM7oaQli0MHcLdCpEPur.jpg'),
(17, 20, '1200000.00', 'bukti_pembayaran/4II6ieRyPwoPlzSjqct55pOZcyKKHYiV4Toe7CZ1.jpg'),
(18, 21, '900000.00', 'images/bukti-bayar/bdEFL01dTcSbWXTwYKUwsKtiUShwkdlYGNqUo3ga.jpg'),
(19, 22, '1200000.00', 'bukti_pembayaran/h0pVzkjVO9fqrSRUQiDrQFqkyXE6GUuKtK0khy1W.png'),
(20, 23, '470000.00', 'bukti_pembayaran/bnD9DG6PZMCbybjXLxKbkHKaf0eGkxpYTTLlfjM6.png'),
(21, 24, '300000.00', 'images/bukti-bayar/4dItRdsRJhaWKOHOHq1zRfKlX4VSaKfJDkPWsPmP.png'),
(22, 25, '750000.00', 'images/bukti-bayar/f4b9xtwdWFZaBllCEMKzzyGHlGS75dWOzEQzIIGR.jpg'),
(23, 28, '1537964.00', 'bukti_pembayaran/KbeZ4zbjEmu8CNEpO2V1LexVn8hQQQ92Zm8KJnA2.png'),
(24, 29, '320000.00', 'bukti_pembayaran/5N6FhKDHBGxbP6Xd6NinMxaXkmakRobrztPB4ipx.jpg'),
(25, 30, '300000.00', 'images/bukti-bayar/9kfLjBOOs9BFpnQgNGGSY9P1dqkHB2AIG5BM4nP7.png'),
(26, 31, '300000.00', 'images/bukti_bayar/bukti_transfer_31.jpg'),
(27, 32, '300000.00', 'images/bukti_bayar/bukti_transfer_32.jpg'),
(28, 34, '750000.00', 'images/bukti_bayar/bukti_transfer_1746093444.png'),
(29, 35, '900000.00', 'images/bukti_bayar/bukti_transfer_35.jpg'),
(30, 36, '300000.00', 'images/bukti_bayar/bukti_transfer_1746264994.jpg'),
(31, 37, '20000.00', 'images/bukti_bayar/bukti_transfer_37.jpg'),
(32, 38, '300000.00', 'images/bukti_bayar/bukti_transfer_1746265116.jpg'),
(33, 39, '250000.00', 'images/bukti_bayar/bukti_transfer_39.jpeg'),
(34, 40, '550000.00', 'images/bukti_bayar/bukti_transfer_1746286064.png');

-- --------------------------------------------------------

--
-- Table structure for table `pembayarans`
--

CREATE TABLE `pembayarans` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id_pesanan` int NOT NULL,
  `id_user` int DEFAULT NULL,
  `id_produk` bigint UNSIGNED DEFAULT NULL,
  `id_status` int DEFAULT NULL,
  `total` decimal(10,2) NOT NULL,
  `tanggal_pesanan` date NOT NULL,
  `alamat` text COLLATE utf8mb4_general_ci NOT NULL,
  `nama_penerima` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `whatsapp` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kode_pos` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id_pesanan`, `id_user`, `id_produk`, `id_status`, `total`, `tanggal_pesanan`, `alamat`, `nama_penerima`, `whatsapp`, `kode_pos`) VALUES
(1, 1, NULL, 2, '150000.00', '2024-03-01', 'Jl. Merdeka No. 1', NULL, NULL, NULL),
(2, 2, NULL, 2, '300000.00', '2024-03-02', 'Jl. Kemerdekaan No. 5', NULL, NULL, NULL),
(3, NULL, NULL, 2, '750000.00', '2025-04-25', 'adsadasd', NULL, NULL, NULL),
(4, NULL, NULL, 1, '750000.00', '2025-04-26', 'jalan banteng', NULL, NULL, NULL),
(5, 8, NULL, 1, '300000.00', '2025-04-26', 'ujung', NULL, NULL, NULL),
(6, 5, 3, 2, '1237964.00', '2025-04-28', 'bogor barad', 'awokwoko bebe', '09999', '16640'),
(7, 5, 6, 1, '300000.00', '2025-04-28', 'tanjung priok', 'uyuy hu hu', '1234', '0987'),
(8, 8, 6, 1, '300000.00', '2025-04-28', 'ember', 'huhuahd', '666', '333'),
(9, 8, 7, 1, '900000.00', '2025-04-28', 'feree', 'adasda', '454353', '76767'),
(10, 5, 4, 1, '450000.00', '2025-04-29', 'warung belakang', 'akil gantenk slebew', '5555', '16640'),
(11, 5, 7, 3, '900000.00', '2025-04-30', 'jauh dah pokoknya', 'Kiwww', '098222', '14470'),
(12, 5, 3, 1, '1237964.00', '2025-04-30', 'okeee', 'awo', '0896', '12222'),
(13, 5, 4, 1, '450000.00', '2025-04-30', 'okeee', 'awo', '0896', '12222'),
(14, 5, 7, 1, '900000.00', '2025-04-30', 'okeee', 'awo', '0896', '12222'),
(15, 5, 2, 1, '300000.00', '2025-04-30', 'venus bumi saturnus', 'cukuruk', '87860', '123213'),
(16, 5, 3, 1, '1237964.00', '2025-04-30', 'venus bumi saturnus', 'cukuruk', '87860', '123213'),
(17, 5, 6, 1, '300000.00', '2025-04-30', 'venus bumi saturnus', 'cukuruk', '87860', '123213'),
(18, 5, 2, 1, '300000.00', '2025-05-01', 'bogor', 'prabowo', '999', '111'),
(19, 5, 1, 1, '750000.00', '2025-05-01', 'bogor', 'prabowo', '999', '111'),
(20, 5, NULL, 3, '1200000.00', '2025-05-01', 'rere', 'ada', '5555', '1440'),
(21, 5, 7, 1, '900000.00', '2025-05-01', 'kull', 'ada', 'erere', '1440'),
(22, 5, NULL, 1, '1200000.00', '2025-05-01', 'freee', 'bubub', '0987', '1223'),
(23, 5, NULL, 1, '470000.00', '2025-05-01', 'lololo', 'adat', 'adar', '4444'),
(24, 5, 2, 1, '300000.00', '2025-05-01', 'trtrt', 'dede', 'dsdasd', '2313'),
(25, 8, 1, 1, '750000.00', '2025-05-01', 'yuyu', 'rorrr', '4343', '3434'),
(26, 8, NULL, 1, '300000.00', '2025-05-01', 'reee', 'tooo', '43434', '12'),
(27, 5, NULL, 1, '1537964.00', '2025-05-01', 'frqqq', 'ada', 'rere', '3232'),
(28, 5, NULL, 1, '1537964.00', '2025-05-01', 'frqqq', 'ada', 'rere', '3232'),
(29, 5, NULL, 2, '320000.00', '2025-05-01', 'Perumahan Bukit Permata Asri Blok C-18, Leuwiliang, Bogor', 'Bapak Asep', '089654902861', '16640'),
(30, 5, 6, 3, '300000.00', '2025-05-01', 'Jl. Kumbang no.7, Kota Bogor', 'Gedung Zeta', '082187886544', '16450'),
(31, 5, 2, 1, '300000.00', '2025-05-01', 'udindindun', 'koes', '989898', '11111'),
(32, 11, 2, 1, '300000.00', '2025-05-01', 'Jl. Paus Biru nomor 154 Bogor Barat', 'Daus Mini', '089765431234', '15541'),
(33, 11, NULL, 1, '320000.00', '2025-05-01', 'Jl. Telaga Saat nomor 1900 Jawa Barat', 'Daus Sedang', '098765431234', '90901'),
(34, 11, NULL, 1, '750000.00', '2025-05-01', 'yukkk', 'lolok', '91324', '09990'),
(35, 12, 7, 1, '900000.00', '2025-05-02', 'Jl. Persib Juara Lagi nomor 4, Bandung, Kota Bandung', 'yuhuu', '082187453211', '16633'),
(36, 9, NULL, 1, '300000.00', '2025-05-03', 'Jl. Gatot Subroto', 'wwak', '08765432121', '16640'),
(37, 9, 8, 1, '20000.00', '2025-05-03', 'yuhuuu', 'Gedung GG', 'dsdasd', '5555'),
(38, 9, NULL, 1, '300000.00', '2025-05-03', 'adad', 'CB HW2', 'dsdasd', '0987'),
(39, 9, 1, 1, '250000.00', '2025-05-03', 'Jalan Manuk Dadali nomor 7', 'wiwik andika', '089787655678', '17760'),
(40, 9, NULL, 3, '550000.00', '2025-05-03', 'jaakdadaidaida agar', 'loloo', '089923293923', '9999');

-- --------------------------------------------------------

--
-- Table structure for table `pesanans`
--

CREATE TABLE `pesanans` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pesanan_detail`
--

CREATE TABLE `pesanan_detail` (
  `id` bigint UNSIGNED NOT NULL,
  `id_pesanan` bigint UNSIGNED NOT NULL,
  `id_produk` bigint UNSIGNED NOT NULL,
  `jumlah` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pesanan_detail`
--

INSERT INTO `pesanan_detail` (`id`, `id_pesanan`, `id_produk`, `jumlah`) VALUES
(1, 20, 1, 1),
(2, 20, 4, 1),
(3, 22, 7, 1),
(4, 22, 6, 1),
(5, 23, 4, 1),
(6, 23, 8, 1),
(7, 28, 2, 1),
(8, 28, 3, 1),
(9, 29, 8, 1),
(10, 29, 6, 1),
(11, 33, 6, 1),
(12, 33, 8, 1),
(13, 34, 6, 1),
(14, 34, 4, 1),
(15, 36, 2, 1),
(16, 38, 6, 1),
(17, 40, 2, 1),
(18, 40, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int NOT NULL,
  `nama_produk` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_general_ci,
  `harga` decimal(10,2) NOT NULL,
  `id_kategori` int DEFAULT NULL,
  `stok` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `gambar`, `deskripsi`, `harga`, `id_kategori`, `stok`) VALUES
(1, 'Jersey England 2004', 'england.jpg', 'The England national team jersey for 2004 was a classic design, notable for being reversible with a training shirt on the inside of the replica version. The match-issue versions, worn by the players, were not reversible. The home jersey was white with the classic England design, while the away jersey was red.', '250000.00', 1, 50),
(2, 'Kaos Vintage', 'kaos-vintage-1745369913.jpg', 'kacawwww', '300000.00', 3, 30),
(3, 'Jersey Persib', 'persib.jpg', 'sdadasd', '1237964.00', 1, 21),
(4, 'Jersey Persija', 'persija-1744905067.jpg', 'Jersey kemenangan', '450000.00', 1, 32),
(6, 'Hoodie Stussy', 'hoodie-stussy-1745369945.jpg', 'mantepp', '300000.00', 2, 5),
(7, 'Jersey Timnas', 'jersey-timnas-1745260853.jpg', 'DAMN INDONESIA', '900000.00', 1, 10),
(8, 'Sinkansen', 'sinkansen-1745353171.jpg', 'Baju Kemenangan', '20000.00', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `produks`
--

CREATE TABLE `produks` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('2eOR7mjQKXOOjif0AGSnWv2ln0GZbaxlv8QvVUP3', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiOUJ6aDZDTGFlQzdXcWpWTk1hd2FWNE04eWREV240ZU9LVXkzV2xmYiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MTU6ImFkbWluX2xvZ2dlZF9pbiI7YjoxO3M6ODoiYWRtaW5faWQiO2k6NDt9', 1746288315),
('42YNs7IQCeVW9yQXDCTQ2353WdsFeRtmAxqMtuPS', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjY6Il90b2tlbiI7czo0MDoidGpaazdMVUhkRGszcVNQZmp2aTJBbFk0bEJ0ZXZZQ2ZWUUFHQXV0aiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6MTQ6InVzZXJfbG9nZ2VkX2luIjtiOjE7czo3OiJ1c2VyX2lkIjtpOjk7fQ==', 1746286675),
('aqrhlnO8sqU1c1mSBDe46bpl9rr1PW3frV4P4pZN', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoidDZwdTRHS1ZPZ2dhVmdralJuaG9ybmJ0WFF5QXdpYjBuMVJNS29mNCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9hY2NvdW50cyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MTU6ImFkbWluX2xvZ2dlZF9pbiI7YjoxO3M6ODoiYWRtaW5faWQiO2k6NDt9', 1746288419),
('n2W8UAhkkOpo7JSTbu00GkhyeO0LCmpTfXzxlS0u', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiTkM1eWtJaHNFUnRPQzZpMndNdG1wOFJGQkVOTVNuMm5md09uenF6dCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9wZXNhbmFuIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czoxNToiYWRtaW5fbG9nZ2VkX2luIjtiOjE7czo4OiJhZG1pbl9pZCI7aTo0O30=', 1746277500),
('NS8RazojjvEfFJ1m80Dx9HqJH1F3nTkybrlBYVxT', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoib1RJc3RpSm13YXZRZEdTSFJDckQyQTZ6ODBGalBoSEdhNlVHSW5DdyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1746288302);

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id_status` int NOT NULL,
  `nama_status` varchar(50) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id_status`, `nama_status`) VALUES
(1, 'Belum Dibayar'),
(2, 'Diproses'),
(3, 'Selesai');

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

CREATE TABLE `statuses` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `notelp` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `notelp`, `email`, `password`) VALUES
(1, 'Adkil', '8534414', 'adkil23@gmail.com', '$2y$12$uzP8GPGI7K.ag7ApFckFRO6IRRXQkg1gBezHMBJ7.WqwhOAEoO1qSa'),
(2, 'Siti', '3241152', 'sitifarfar@gmail.com', '$2y$12$uzP8GPGI7K.ag7ApFckFRO6IRRXQkg1gBezHMBJ7.WqwhOAEoO1qSasasa\r\n'),
(3, 'ajiz', '98889', 'akil@gmail.com', '$2y$12$83kNE9Q7aETnMXvWWzKq2OnLBOFNlgTeZEQwyBHGhc3G.8RCo7iAy'),
(4, 'adsada', '398001', 'mm@gmail.com', '$2y$12$wovk20QLvr/ZARt5rmiZw.RuG7wi.9wbcJ2hpBom/Nndlv2NXWm.K'),
(5, 'lorem ipsum69', '98711', 'killyy@gmail.com', '$2y$12$ZN33gCAvXHPZtsQ1r8eeIew90Jw1ZJJ2l/8jNEtdzQkRI2ho7r3lq'),
(6, 'asdadads', '3123131', 'nn@gmail.com', '$2y$12$A4pTLgBURi5qstKK8IZshOkVqt8t6VmwLgqZRCYNtg4AqXwLXGdxy'),
(7, 'asdadsad', '12312313', 'jj@gmail.com', '$2y$12$05OCTByYQbvP54KWsELRQeMCGifmUCqLXeRYsTQnKsWsQQFPOMEKm'),
(8, 'akil jelek', '123123123', 'lika@gmail.com', '$2y$12$.CyI15ntrB3SEAema9I/0uM6WlA/LgsXXBvSrb4FFjci3wir5CuOm'),
(9, 'wawake', '8888', 'wawak@gmail.com', '$2y$12$LvfzCP5KrvpWDks/JBJLOOtDOPIlVuzxlYMRww/Igav0i7AQXEoz2'),
(10, 'User Baru', '89654902861', 'userbaru@gmail.com', '$2y$12$cUqPO8QWguisHgB8ORixde94ec42o9/idapXqSM/avZEQDf5okLuC'),
(11, 'daus besar', '0896549044311', 'kocak@gmail.com', '$2y$12$ohd5xRAKIbM3bpEALcotKu.zVNy2/Q77cRudH6tg88pGkOuQx/vuu'),
(12, 'coba pas jadi', '089765432211', 'cobain@gmail.com', '$2y$12$SYKi0SXAbPoUTaT5G47tW.zf4IOGDoiY6ivYD/U5VmXuDOdz4WhYS');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `dashboards`
--
ALTER TABLE `dashboards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `item_pesanans`
--
ALTER TABLE `item_pesanans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `kategoris`
--
ALTER TABLE `kategoris`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id_keranjang`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `id_pesanan` (`id_pesanan`);

--
-- Indexes for table `pembayarans`
--
ALTER TABLE `pembayarans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id_pesanan`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_status` (`id_status`);

--
-- Indexes for table `pesanans`
--
ALTER TABLE `pesanans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pesanan_detail`
--
ALTER TABLE `pesanan_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `produks`
--
ALTER TABLE `produks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id_status`);

--
-- Indexes for table `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dashboards`
--
ALTER TABLE `dashboards`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `item_pesanans`
--
ALTER TABLE `item_pesanans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kategoris`
--
ALTER TABLE `kategoris`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id_keranjang` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `pembayarans`
--
ALTER TABLE `pembayarans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id_pesanan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `pesanans`
--
ALTER TABLE `pesanans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pesanan_detail`
--
ALTER TABLE `pesanan_detail`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `produks`
--
ALTER TABLE `produks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id_status` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `statuses`
--
ALTER TABLE `statuses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan` (`id_pesanan`);

--
-- Constraints for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `pesanan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `pesanan_ibfk_2` FOREIGN KEY (`id_status`) REFERENCES `status` (`id_status`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
