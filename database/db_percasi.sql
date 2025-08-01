-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 01, 2025 at 01:54 PM
-- Server version: 8.0.30
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_percasi`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int UNSIGNED NOT NULL,
  `nama_admin` varchar(30) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `passwd` varchar(50) NOT NULL,
  `foto` text NOT NULL,
  `tipe_admin` tinyint UNSIGNED NOT NULL DEFAULT '1',
  `aktif` tinyint UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama_admin`, `user_name`, `passwd`, `foto`, `tipe_admin`, `aktif`) VALUES
(1, '-', '-', '-', '', 1, 1),
(2, 'Retno Utami', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin.jpg', 3, 1),
(3, 'Mr. Henry Hendratno', 'Sekjen', '06569c459cc078a07f1e10382d21b394', '3.jpg', 1, 1),
(9, 'Mr. Dapps', 'Daffa', '7b1e852330575c92c8d918377b30726a', '9.jpg', 2, 1),
(16, 'Ulfa Lutfia', 'Ulfah Keren', '998acc8b04f75fddb931a2621a73192a', 'AUlfah.', 2, 1),
(17, 'Fatia Selsept', 'Fatia Cakep', 'ba00819f263287af1ff0100c5a323355', 'AFatia.', 2, 0),
(18, 'Mr Nanang', 'Big Boss', 'ba00819f263287af1ff0100c5a323355', 'ABig Boss.', 2, 1),
(19, 'Mr Chessi', 'Mr Chessi', 'ba00819f263287af1ff0100c5a323355', 'AMas Chessi.', 2, 0),
(20, 'admins', 'admins', '2aefc34200a294a3cc7db81b43a81873', 'Aadmins.png', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `akomodasiev`
--

CREATE TABLE `akomodasiev` (
  `id_akomodasi_ev` int NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `biaya` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `akomodasiev`
--

INSERT INTO `akomodasiev` (`id_akomodasi_ev`, `keterangan`, `biaya`) VALUES
(1, 'Tidak', 0),
(2, 'Ya', 2450000);

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE `berita` (
  `id_berita` varchar(12) NOT NULL,
  `tgl_post` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_admin` int UNSIGNED NOT NULL DEFAULT '1',
  `judul` varchar(250) DEFAULT NULL,
  `ringkasan` text,
  `detail` text,
  `foto` text NOT NULL,
  `aktif` tinyint UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `berita`
--

INSERT INTO `berita` (`id_berita`, `tgl_post`, `id_admin`, `judul`, `ringkasan`, `detail`, `foto`, `aktif`) VALUES
('BR2024100002', '2024-10-30 14:47:34', 17, ' PERUBAHAN TARIF AKOMODASI', 'Diberitahukan bahwa ada perubahan tarif biaya akomodasi Kejurnas Catur Junior VI/2024, yang semula Rp 400.000 per orang per hari menjadi Rp 350.000 per orang per hari. \r\nAkomodasi selama Kejurnas Rp 2,450,000,-', '', 'BR2024100002.jpeg', 1),
('BR2024110001', '2024-11-04 05:19:23', 2, 'RAKERNAS', 'Mohon Pengprov PERCASI mengirimkan dulu nama nama Peserta Rakernas PERCASI Ke-44/2024 melalui wa paling lambat hari ini 5 Nov 2024 s.d jam 24.00 WIB', '', 'BR2024110001.jpeg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id_ev` varchar(12) NOT NULL,
  `nama_ev` varchar(30) NOT NULL,
  `poster` text NOT NULL,
  `tgl_mulai_ev` date NOT NULL,
  `tgl_selesai_ev` date NOT NULL,
  `tgl_bts_daftar` date NOT NULL,
  `id_admin` int NOT NULL,
  `status_ev` tinyint UNSIGNED NOT NULL DEFAULT '0',
  `iuran_wjb` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id_ev`, `nama_ev`, `poster`, `tgl_mulai_ev`, `tgl_selesai_ev`, `tgl_bts_daftar`, `id_admin`, `status_ev`, `iuran_wjb`) VALUES
('EV2024070006', 'KEJURNAS CATUR JUNIOR VI/2024', '', '2024-11-08', '2024-11-15', '2024-11-05', 2, 0, 1500000);

-- --------------------------------------------------------

--
-- Table structure for table `gelarev`
--

CREATE TABLE `gelarev` (
  `id_gelar_ev` varchar(14) NOT NULL,
  `id_ev` varchar(12) DEFAULT NULL,
  `gelar` varchar(100) DEFAULT NULL,
  `biaya_reg` int UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gelarev`
--

INSERT INTO `gelarev` (`id_gelar_ev`, `id_ev`, `gelar`, `biaya_reg`) VALUES
('EV202407000601', 'EV2024070006', 'Non gelar ', 300000),
('EV202407000602', 'EV2024070006', 'Wild Card JAPFA', 0),
('EV202407000603', 'EV2024070006', 'Wild Card BPK Penabur', 0),
('EV202407000604', 'EV2024070006', 'PNP (Pelatih Nasional Pratama)', 1250000),
('EV202407000605', 'EV2024070006', 'PNM (Pelatih Nasional Madya)', 1750000),
('EV202407000606', 'EV2024070006', 'Wild Card PB', 0),
('EV202407000608', 'EV2024070006', 'Team', 0),
('EV202407000609', 'EV2024070006', 'Wild Card Jateng', 0),
('EV202407000611', 'EV2024070006', 'Juara bertahan', 0),
('EV202407000612', 'EV2024070006', 'GM/WGM/IM/WIM', 0),
('EV202407000613', 'EV2024070006', 'FM/WFM', 100000),
('EV202407000614', 'EV2024070006', 'MN/MNW/MP/MPW/CM/WCM', 200000);

-- --------------------------------------------------------

--
-- Table structure for table `instansi`
--

CREATE TABLE `instansi` (
  `id` tinyint UNSIGNED NOT NULL DEFAULT '1',
  `nama_instansi` varchar(50) DEFAULT NULL,
  `alamat` varchar(250) DEFAULT NULL,
  `telepon` varchar(20) DEFAULT NULL,
  `telepon_wa` varchar(20) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `instansi`
--

INSERT INTO `instansi` (`id`, `nama_instansi`, `alamat`, `telepon`, `telepon_wa`, `email`) VALUES
(1, 'EVENT PB PERCASI', 'Jl. Radio Dalam Raya  Kebayoran Baru Jakarta Selatan', '08122722434', '08122722443', 'bundabschess@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `iuranev`
--

CREATE TABLE `iuranev` (
  `id_iuran_ev` varchar(12) NOT NULL,
  `id_ev` varchar(12) NOT NULL,
  `id_prov` int NOT NULL,
  `jml_wajib` bigint NOT NULL,
  `byr_wajib` bigint NOT NULL,
  `jml_registrasi` bigint NOT NULL,
  `byr_registrasi` bigint NOT NULL,
  `jml_akomodasi` bigint NOT NULL,
  `byr_akomodasi` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `iuranev`
--

INSERT INTO `iuranev` (`id_iuran_ev`, `id_ev`, `id_prov`, `jml_wajib`, `byr_wajib`, `jml_registrasi`, `byr_registrasi`, `jml_akomodasi`, `byr_akomodasi`) VALUES
('EI2024070036', 'EV2024070006', 18, 1750000, 0, 400000, 0, 0, 0),
('EI2024070037', 'EV2024070006', 19, 1750000, 0, 0, 0, 0, 0),
('EI2024070038', 'EV2024070006', 20, 1750000, 0, 0, 0, 0, 0),
('EI2024070039', 'EV2024070006', 21, 1750000, 0, 0, 0, 0, 0),
('EI2024100001', 'EV2024070006', 22, 1500000, 0, 0, 0, 0, 0),
('EI2024100002', 'EV2024070006', 23, 1500000, 1500000, 300000, 300000, 0, 0),
('EI2024100003', 'EV2024070006', 24, 1500000, 1500000, 9400000, 9400000, 0, 0),
('EI2024100004', 'EV2024070006', 25, 1500000, 0, 0, 0, 0, 0),
('EI2024100005', 'EV2024070006', 26, 1500000, 1500000, 2750000, 2750000, 0, 0),
('EI2024100006', 'EV2024070006', 27, 1500000, 1500000, 900000, 900000, 0, 0),
('EI2024100007', 'EV2024070006', 28, 1500000, 0, 4800000, 4800000, 12250000, 12250000),
('EI2024100008', 'EV2024070006', 29, 1500000, 1500000, 5850000, 900000, 17150000, 16000000),
('EI2024100009', 'EV2024070006', 30, 1500000, 0, 0, 0, 0, 0),
('EI2024100010', 'EV2024070006', 31, 1500000, 1500000, 4800000, 0, 0, 0),
('EI2024100011', 'EV2024070006', 32, 1500000, 0, 21150000, 21150000, 4900000, 4900000),
('EI2024100012', 'EV2024070006', 33, 1500000, 0, 25050000, 24700000, 110250000, 110250000),
('EI2024100013', 'EV2024070006', 34, 1500000, 1500000, 17400000, 17400000, 63700000, 63700000),
('EI2024100014', 'EV2024070006', 35, 1500000, 1500000, 4850000, 5150000, 4900000, 4900000),
('EI2024100015', 'EV2024070006', 36, 1500000, 1500000, 6400000, 6400000, 39200000, 41650000),
('EI2024100016', 'EV2024070006', 37, 1500000, 1500000, 33350000, 33650000, 0, 0),
('EI2024100017', 'EV2024070006', 38, 1500000, 1500000, 8300000, 8300000, 17150000, 18900000),
('EI2024100018', 'EV2024070006', 39, 1500000, 1500000, 6700000, 6700000, 31850000, 31850000),
('EI2024100019', 'EV2024070006', 40, 1500000, 1500000, 15750000, 15750000, 83300000, 83300000),
('EI2024100020', 'EV2024070006', 41, 1500000, 1500000, 1200000, 1200000, 9800000, 9800000),
('EI2024100021', 'EV2024070006', 42, 1500000, 1500000, 0, 6000000, 0, 0),
('EI2024100022', 'EV2024070006', 43, 1500000, 1500000, 600000, 0, 7350000, 0),
('EI2024100023', 'EV2024070006', 44, 1500000, 0, 2400000, 2400000, 0, 0),
('EI2024100024', 'EV2024070006', 45, 1500000, 1500000, 0, 0, 0, 0),
('EI2024100025', 'EV2024070006', 46, 1500000, 1500000, 0, 0, 0, 0),
('EI2024100026', 'EV2024070006', 47, 1500000, 1500000, 200000, 200000, 0, 0),
('EI2024100027', 'EV2024070006', 48, 1500000, 0, 900000, 900000, 9800000, 9800000),
('EI2024100028', 'EV2024070006', 49, 1500000, 1500000, 600000, 600000, 2450000, 2450000),
('EI2024100029', 'EV2024070006', 50, 1500000, 1500000, 900000, 900000, 9800000, 9100000),
('EI2024100030', 'EV2024070006', 51, 1500000, 1500000, 2400000, 2400000, 24500000, 24500000),
('EI2024100031', 'EV2024070006', 52, 1500000, 0, 0, 0, 0, 0),
('EI2024100032', 'EV2024070006', 53, 1500000, 1500000, 600000, 600000, 7350000, 7350000),
('EI2024100033', 'EV2024070006', 54, 1500000, 0, 0, 0, 0, 0),
('EI2024100034', 'EV2024070006', 55, 1500000, 0, 0, 0, 0, 0),
('EI2024100035', 'EV2024070006', 56, 1500000, 0, 0, 0, 0, 0),
('EI2024100036', 'EV2024070006', 57, 1500000, 0, 0, 0, 0, 0),
('EI2024100037', 'EV2024070006', 58, 1500000, 0, 0, 0, 0, 0),
('EI2024100038', 'EV2024070006', 59, 1500000, 1500000, 6400000, 6400000, 12250000, 12250000),
('EI2024100039', 'EV2024070006', 60, 1500000, 0, 1500000, 1500000, 19600000, 19600000),
('EI2024100040', 'EV2024070006', 61, 1500000, 0, 2100000, 2100000, 24500000, 24500000),
('EI2024100041', 'EV2024070006', 62, 1500000, 0, 0, 0, 0, 0),
('EI2024100042', 'EV2024070006', 63, 1500000, 0, 0, 0, 0, 0),
('EI2024100043', 'EV2024070006', 64, 1500000, 0, 0, 0, 0, 0),
('EI2024100045', 'EV2024070006', 65, 1500000, 0, 200000, 0, 5600000, 2800000);

-- --------------------------------------------------------

--
-- Table structure for table `iuranev_byr`
--

CREATE TABLE `iuranev_byr` (
  `id_byr` varchar(14) NOT NULL,
  `id_ev` varchar(12) NOT NULL,
  `id_iuran_ev` varchar(12) DEFAULT NULL,
  `id_prov` int NOT NULL,
  `id_operator` int DEFAULT NULL,
  `id_admin` int NOT NULL,
  `tgl_bayar` date NOT NULL,
  `jml_bayar` bigint DEFAULT '0',
  `jenis_byr` tinyint UNSIGNED NOT NULL DEFAULT '0',
  `cara_byr` tinyint UNSIGNED DEFAULT '0',
  `nama_pembayar` varchar(30) DEFAULT NULL,
  `note_pembayar` text,
  `dari_bank` varchar(15) DEFAULT NULL,
  `dari_rek` varchar(20) DEFAULT NULL,
  `nama_penerima` varchar(30) DEFAULT NULL,
  `note_penerima` text,
  `ke_bank` varchar(15) DEFAULT NULL,
  `ke_rek` varchar(20) DEFAULT NULL,
  `bukti` text,
  `tgl_verifikasi` varchar(10) DEFAULT NULL,
  `status_verifikasi` tinyint UNSIGNED DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `iuranev_byr`
--

INSERT INTO `iuranev_byr` (`id_byr`, `id_ev`, `id_iuran_ev`, `id_prov`, `id_operator`, `id_admin`, `tgl_bayar`, `jml_bayar`, `jenis_byr`, `cara_byr`, `nama_pembayar`, `note_pembayar`, `dari_bank`, `dari_rek`, `nama_penerima`, `note_penerima`, `ke_bank`, `ke_rek`, `bukti`, `tgl_verifikasi`, `status_verifikasi`) VALUES
('BE2024100007', 'EV2024070006', 'EI2024100029', 50, 17, 16, '2024-10-30', 900000, 2, 1, 'Miftahurrahman', 'Biaya registrasi 3 orang atlet', 'Miftahurrahman,', 'Mandiri 161001218247', 'Henry Hendratno', '', 'Henry Hendratno', 'Mandiri 155000205072', 'BE2024100007.jpeg', '2024-11-03', 1),
('BE2024100008', 'EV2024070006', 'EI2024100029', 50, 17, 16, '2024-10-30', 5600000, 3, 1, 'Miftahurrahman', 'DP Akomodasi untuk 4 orang', 'Miftahurrahman,', 'Mandiri 161001218247', 'Henry Hendratno', '', 'Henry Hendratno', 'Mandiri 155000205072', 'BE2024100008.jpeg', '2024-11-03', 1),
('BE2024100009', 'EV2024070006', 'EI2024100020', 41, 24, 16, '2024-10-31', 5000000, 3, 1, 'HAMDANI', '', 'Mandiri', '1460017882254', 'HENDRY HENDRATNO', '', 'Mandiri', '1550002050 725 ', 'BE2024100009.jpg', '2024-11-10', 1),
('BE2024100010', 'EV2024070006', 'EI2024100023', 44, 23, 16, '2024-10-19', 300000, 2, 1, 'Syaiful Akbarius Zai', 'PERCASI MKS an CAKRAWALA NUR F', 'MANDIRI', '*********7819', 'Henry Hendratno', '', 'BCA', '7640195481', 'BE2024100010.jpeg', '2024-11-03', 1),
('BE2024100011', 'EV2024070006', 'EI2024100023', 44, 23, 16, '2024-10-19', 300000, 2, 1, 'Syaiful Akbarius Zai', 'PERCASI MKS an Alifakih Arrasyaa', 'MANDIRI', '*********7819', 'Henry Hendratno', '', 'BCA', '7640195481', 'BE2024100011.jpeg', '2024-11-03', 1),
('BE2024100012', 'EV2024070006', 'EI2024100023', 44, 23, 0, '2024-10-31', 300000, 2, 1, 'Komang Agus Krisna G', '', 'MANDIRI', '*********3422', 'Henry Hendratno', '', 'BCA', '7640195481', 'BE2024100012.jpeg', '', 0),
('BE2024110001', 'EV2024070006', 'EI2024100013', 34, 14, 0, '2024-10-30', 5000000, 3, 1, 'Pengurus provinsi Percasi Jaba', '', 'transfer ', '03370100224303', 'Henry Hendratno', '', 'bca', '7640195481', 'BE2024110001.jpeg', '', 0),
('BE2024110002', 'EV2024070006', 'EI2024100023', 44, 23, 16, '2024-10-18', 300000, 2, 1, 'Syaiful Akbarius Zai', 'PERCASI MAKASSAR an Andi Daffa', 'MANDIRI', '*********7819', 'Henry Hendratno', '', 'BCA', '7640195481', 'BE2024110002.jpeg', '2024-11-03', 1),
('BE2024110003', 'EV2024070006', 'EI2024100014', 35, 1, 16, '2024-11-02', 2450000, 3, 1, '-', '', 'BCA', '3270201406', 'Henry Hendratno', 'Vanessa koolin Surakarta', 'BCA', '7640195481', NULL, '2024-11-10', 1),
('BE2024110006', 'EV2024070006', 'EI2024100019', 40, 1, 0, '2024-10-31', 30000000, 3, 1, '-', '', 'BCA', '-', 'Henry Hendratno', 'DP  akomodasi peserta Kalteng', 'BCA', '7640195481', NULL, '', 0),
('BE2024110007', 'EV2024070006', 'EI2024100040', 61, 1, 0, '2024-11-01', 2450000, 3, 1, '-', '', 'BCA', '***********00', 'Henry Hendratno', 'pendamping leonathan edgar venue', 'BCA', '7640195481', NULL, '', 0),
('BE2024110008', 'EV2024070006', 'EI2024100028', 49, 32, 9, '2024-10-31', 1500000, 1, 1, '-', 'Iuran wajib PERCASI SULUT', 'BCA', '-', 'Henry Hendratno', '', 'BCA', '7640195481', 'BE2024110008.jpeg', '2024-11-03', 1),
('BE2024110009', 'EV2024070006', 'EI2024100017', 38, 1, 16, '2024-11-02', 2800000, 3, 1, '-', '', 'BCA', '-', 'Henry Hendratno', 'Akomodasi Brian Surjana', 'BCA', '7640195481', NULL, '2024-11-03', 1),
('BE2024110010', 'EV2024070006', 'EI2024100028', 49, 32, 9, '2024-10-31', 600000, 2, 1, 'PERCASI SULUT', 'Registrasi peserta 2 orang', 'BCA', '-', 'Henry Hendratno', '', 'BCA', '7640195481', 'BE2024110010.jpeg', '2024-11-03', 1),
('BE2024110011', 'EV2024070006', 'EI2024100028', 49, 32, 9, '2024-10-31', 2450000, 3, 1, 'PERCASI SULUT', 'Akomodasi 1 orang', 'BCA', '-', 'Henry Hendratno', '', 'BCA', '7640195481', 'BE2024110011.jpeg', '2024-11-03', 1),
('BE2024110012', 'EV2024070006', 'EI2024100017', 38, 1, 16, '2024-10-25', 5600000, 3, 1, 'BALI', '', 'BCA', '-', 'Henry Hendratno', 'Akomodasi Sentanu dan Bapak Yuli', 'BCA', '7640195481', NULL, '2024-11-03', 1),
('BE2024110013', 'EV2024070006', 'EI2024100017', 38, 1, 16, '2024-10-25', 5600000, 3, 1, 'BALI', '', 'BCA', '-', 'Henry Hendratno', 'Akomodasi Hanasta Airin', 'BCA', '7640195481', NULL, '2024-11-03', 1),
('BE2024110014', 'EV2024070006', 'EI2024100007', 28, 1, 16, '2024-10-30', 5000000, 3, 1, 'SUMSEL', '', 'BCA', '-', 'Henry Hendratno', 'Akomodasi (DP Kamar) SUMSEL', 'BCA', '7640195481', NULL, '2024-11-03', 1),
('BE2024110015', 'EV2024070006', 'EI2024100012', 33, 1, 0, '2024-10-24', 10000000, 3, 1, 'DKI JAKARTA', '', 'BCA', '-', 'Henry Hendratno', 'Akomodasi Kamar Tim Jakarta', 'BCA', '7640195481', NULL, '', 0),
('BE2024110020', 'EV2024070006', 'EI2024100023', 44, 1, 16, '2024-11-02', 900000, 2, 1, 'Syaiful Akbarius Zai', '', 'MANDIRI', '-', 'Henry Hendratno', 'Registrasi Novan, Banapati, dan Al Fayed', 'BCA', '7640195481', 'BE2024110020.jpeg', '2024-11-03', 1),
('BE2024110021', 'EV2024070006', 'EI2024100027', 48, 1, 16, '2024-11-02', 300000, 2, 1, 'BELLATRIKA ARISNAWAN', 'kjrns abraham melkior gorontalo', 'MANDIRI', '********7632', 'HENRY HENDRATNO', '', 'BCA', '7640195481', 'BE2024110021.jpeg', '2024-11-08', 1),
('BE2024110022', 'EV2024070006', 'EI2024100018', 39, 29, 16, '2024-11-03', 14700000, 3, 1, 'ACHMAD SYARIF', 'DP AKOMODASI UNTUK 12 ORANG', 'BNI', '420370199', 'HENRY HENDRATNO', '', 'BCA', '7640 1954 81 ', 'BE2024110022.jpeg', '2024-11-03', 1),
('BE2024110023', 'EV2024070006', 'EI2024100018', 39, 29, 16, '2024-11-03', 3600000, 2, 1, 'ACHMAD SYARIF', 'UANG PENDAFTARAN 12 ORANG ATLET', 'BNI', '420370199', 'HENRY HENDRATNO', '', 'BCA', '7640 1954 81 ', 'BE2024110023.jpeg', '2024-11-03', 1),
('BE2024110024', 'EV2024070006', 'EI2024100027', 48, 1, 16, '2024-11-02', 300000, 2, 1, 'LUKMAN ANANTA LAKSONO', '', 'SINARMAS', '******7571', 'HENRY HENDRATNO', 'Johanna GTLO', 'BCA', '7640195481', 'BE2024110024.jpeg', '2024-11-08', 1),
('BE2024110025', 'EV2024070006', 'EI2024100018', 39, 29, 16, '2024-11-03', 1250000, 2, 1, 'ACHMAD SYARIF', 'UANG PENDAFTARAN PENATARAN PELATIH ATAS NAMA MUSTAFA ABD', 'BNI', '420370199', 'HENRY HENDRATNO', '', 'BCA', '7640 1954 81 ', 'BE2024110025.jpeg', '2024-11-03', 1),
('BE2024110026', 'EV2024070006', 'EI2024100018', 39, 29, 16, '2024-11-03', 1500000, 1, 1, 'ACHMAD SYARIF', 'UANG IURAN WAJIB PERCASI KALSEL 2024', 'BNI', '420370199', 'HENRY HENDRATNO', '', 'BCA', '7640 1954 81 ', 'BE2024110026.jpeg', '2024-11-03', 1),
('BE2024110027', 'EV2024070006', 'EI2024100005', 26, 31, 16, '2024-11-04', 1200000, 2, 1, 'Akbar Tahir Pohan', 'pembayaran 4 orang peserta kejurnas dari pengprov percasi jambi', 'BRI', '563401017469532', 'Hendry Hendratno', '', 'BCA', '7640195481', 'BE2024110027.png', '2024-11-05', 1),
('BE2024110028', 'EV2024070006', 'EI2024100014', 35, 16, 16, '2024-11-04', 3000000, 2, 1, 'ALI SHODIKIN ', '', 'MANDIRI', '*********2412', 'HENRY HENDRATNO', 'Pndftrn Kejurnas 10 atlet Jtg', 'MANDIRI', '1550002050725', 'BE2024110028.jpeg', '2024-11-07', 1),
('BE2024110029', 'EV2024070006', 'EI2024100014', 35, 16, 16, '2024-11-04', 1850000, 2, 1, 'ALI SHODIKIN ', '', 'MANDIRI', '*********2412', 'HENRY HENDRATNO', 'pendaftaran 2 atlet dan 1 PNP', 'MANDIRI', '1550002050725', 'BE2024110029.jpeg', '2024-11-07', 1),
('BE2024110031', 'EV2024070006', 'EI2024100006', 27, 35, 16, '2024-11-05', 900000, 2, 1, 'RIO IRNAWAN', 'PEMBAYARAN 3 ATLET SUMBAR + IURAN WAJIB PERCASI', 'RIO IRNAWAN', '8565061263', 'HENRY HENDRATNO', '', 'TRANSFER BANK', '7640195481', 'BE2024110031.jpeg', '2024-11-08', 1),
('BE2024110032', 'EV2024070006', 'EI2024100006', 27, 35, 16, '2024-11-05', 1500000, 1, 1, 'RIO IRNAWAN', 'PEMBAYARAN IURAN WAJIB PERCASI + PENDAFTARAN 3 ATLET SUMBAR', 'TRANSFER BANK', '8565061263', 'HENRY HENDRATNO', '', 'TRANSFER BANK', '7640195481', 'BE2024110032.jpeg', '2024-11-08', 1),
('BE2024110033', 'EV2024070006', 'EI2024100015', 36, 15, 0, '2024-05-11', 1500000, 1, 1, 'Jumariyanto', '', 'BPD DIY', '003221004637', 'Henry Hendratno', '', 'BCA', '7640195481', 'BE2024110033.jpeg', '', 0),
('BE2024110034', 'EV2024070006', 'EI2024100015', 36, 15, 0, '2024-05-11', 6600000, 2, 1, 'Jumariyanto', '', 'BPD DIY', '003221004637', 'Henry Hendratno', '', 'BCA', '7640195481', 'BE2024110034.jpeg', '', 0),
('BE2024110035', 'EV2024070006', 'EI2024100015', 36, 15, 1, '2024-05-11', 44100000, 0, 1, 'Jumariyanto', '', 'BPD DIY', '003221004637', 'Henry Hendratno', '', 'BCA', '7640195481', 'BE2024110035.jpeg', '', 0),
('BE2024110042', 'EV2024070006', 'EI2024100026', 47, 27, 16, '2024-11-05', 1500000, 1, 1, 'Habibi Sotar Hutur', 'Iuran wajib Sulawesi Tengah', 'BCA', '7920607700', 'Hendry Hendratno', '', 'BCA', '7640195481', 'BE2024110042.jpeg', '2024-11-05', 1),
('BE2024110043', 'EV2024070006', 'EI2024100026', 47, 27, 16, '2024-11-05', 200000, 2, 1, 'Habibi Sotar Hutur', '', 'BCA', '7920607700', 'Hendry Hendratno', '', 'BCA', '7640195481', 'BE2024110043.jpeg', '2024-11-08', 1),
('BE2024110044', 'EV2024070006', 'EI2024100005', 26, 31, 0, '2024-11-05', 1500000, 1, 1, 'Anwar Harminto', 'pembayaran iuran wajib dari pengprov percasi jambi', 'BSI', '1009979987', 'Hendry Hendratno', '', 'BCA', '7640195481', 'BE2024110044.png', '', 0),
('BE2024110045', 'EV2024070006', 'EI2024100005', 26, 31, 0, '2024-11-05', 300000, 1, 1, 'Akbar Tahir Pohan', 'pembayaran penambahan 1 orang peserta kejurnas junior dri pengprov percasi jambi', 'BRI', '563401017469532', 'Hendry Hendratno', '', 'BCA', '7640195481', 'BE2024110045.png', '', 0),
('BE2024110046', 'EV2024070006', 'EI2024100005', 26, 31, 0, '2024-11-05', 1250000, 1, 1, 'Akbar Tahir Pohan', 'pembayaran pelatihan pelatih 1 orang dari pengprov percasi jambi', 'BRI', '563401017469532', 'Hendry Hendratno', '', 'BCA', '7640195481', 'BE2024110046.png', '', 0),
('BE2024110047', 'EV2024070006', 'EI2024100017', 38, 1, 16, '2024-11-05', 1500000, 1, 1, '-', '', 'BCA', '-', 'Henry Hendratno', 'BALI Iuran Wajib ', 'BCA', '7640195481', 'BE2024110047.jpeg', '2024-11-05', 1),
('BE2024110048', 'EV2024070006', 'EI2024100017', 38, 1, 16, '2024-11-05', 4800000, 2, 1, '-', '', 'BCA', '-', 'Henry Hendratno', 'Registrasi 16 orang pa & pi', 'BCA', '7640195481', 'BE2024110048.jpeg', '2024-11-05', 1),
('BE2024110049', 'EV2024070006', 'EI2024100017', 38, 1, 16, '2024-11-05', 1750000, 2, 1, '-', '', 'BCA', '-', 'Henry Hendratno', 'Registrasi Upgrading PNM', 'BCA', '7640195481', 'BE2024110049.jpeg', '2024-11-05', 1),
('BE2024110050', 'EV2024070006', 'EI2024100017', 38, 1, 9, '2024-11-05', 2450000, 3, 1, '-', '', 'BCA', '-', 'Henry Hendratno', 'Akomodasi a.n. Paskalis', 'BCA', '7640195481', 'BE2024110050.jpeg', '2024-11-06', 1),
('BE2024110051', 'EV2024070006', 'EI2024100017', 38, 1, 16, '2024-11-05', 1750000, 2, 1, '-', '', 'BCA', '-', 'Henry Hendratno', 'Registrasi UpgradingPNM Putu Arya K.', 'BCA', '7640195481', 'BE2024110051.jpeg', '2024-11-05', 1),
('BE2024110052', 'EV2024070006', 'EI2024100017', 38, 1, 9, '2024-11-05', 2450000, 3, 1, '-', '', 'BCA', '-', 'Henry Hendratno', 'Akomodasi AA Istri Oka ', 'BCA', '7640195481', 'BE2024110052.jpeg', '2024-11-06', 1),
('BE2024110053', 'EV2024070006', 'EI2024100030', 51, 1, 16, '2024-11-05', 10000000, 3, 1, '-', '', 'BCA', '-', 'Henry Hendratno', 'DP Akomodasi 8 orang', 'BCA', '7640195481', 'BE2024110053.jpeg', '2024-11-05', 1),
('BE2024110054', 'EV2024070006', 'EI2024100030', 51, 1, 16, '2024-11-05', 1800000, 2, 1, '-', '', 'BCA', '-', 'Henry Hendratno', 'Registrasi 6 orang', 'BCA', '7640195481', 'BE2024110054.jpeg', '2024-11-05', 1),
('BE2024110055', 'EV2024070006', 'EI2024100007', 28, 1, 16, '2024-11-05', 4800000, 2, 1, '-', '', 'BCA', '-', 'Henry Hendratno', 'Registrasi 16 orang', 'BCA', '7640195481', 'BE2024110055.jpeg', '2024-11-05', 1),
('BE2024110056', 'EV2024070006', 'EI2024100040', 61, 1, 16, '2024-11-05', 2100000, 2, 1, '-', '', 'BCA', '-', 'Henry Hendratno', 'Registrasi 7 orang', 'BCA', '7640195481', 'BE2024110056.jpeg', '2024-11-05', 1),
('BE2024110057', 'EV2024070006', 'EI2024100040', 61, 1, 16, '2024-11-05', 24500000, 3, 1, '-', '', 'BCA', '-', 'Henry Hendratno', 'Akomodasi 10 orang (7 peserta, 3 pendamping)', 'BCA', '7640195481', 'BE2024110057.jpeg', '2024-11-05', 1),
('BE2024110058', 'EV2024070006', 'EI2024100007', 28, 1, 16, '2024-11-08', 7250000, 3, 1, '-', '', 'BCA', '-', 'Henry Hendratno', 'Pelunasan Akomodasi SUMSEL (5 orang)', 'BCA', '7640195481', 'BE2024110058.jpeg', '2024-11-08', 1),
('BE2024110059', 'EV2024070006', 'EI2024100027', 48, 1, 16, '2024-10-13', 300000, 2, 1, '-', '', 'BCA', '-', 'Henry Hendratno', 'Registrasi Edric Maramis', 'BCA', '7640195481', 'BE2024110059.jpeg', '2024-11-08', 1),
('BE2024110060', 'EV2024070006', 'EI2024100027', 48, 1, 16, '2024-11-04', 1000000, 3, 1, '-', '', 'BCA', '-', 'Henry Hendratno', 'DP Akomodasi 1jt', 'BCA', '7640195481', 'BE2024110060.jpeg', '2024-11-08', 1),
('BE2024110061', 'EV2024070006', 'EI2024100016', 37, 1, 16, '2024-11-01', 1500000, 1, 1, 'farhan', '', 'mandiri', '-', 'Henry Hendratno', 'Iuran Wajib', 'BCA', '7640195481', 'BE2024110061.jpeg', '2024-11-10', 1),
('BE2024110062', 'EV2024070006', 'EI2024100016', 37, 1, 16, '2024-11-01', 15250000, 2, 1, 'farhan', '', 'mandiri', '-', 'Henry Hendratno', 'Registrasi', 'BCA', '7640195481', 'BE2024110062.jpeg', '2024-11-10', 1),
('BE2024110063', 'EV2024070006', 'EI2024100016', 37, 1, 16, '2024-11-01', 18400000, 2, 1, 'farhan', '', 'mandiri', '-', 'Henry Hendratno', 'Registrasi peserta 57', 'BCA', '7640195481', 'BE2024110063.jpeg', '2024-11-10', 1),
('BE2024110064', 'EV2024070006', 'EI2024100020', 41, 1, 16, '2024-11-09', 500000, 1, 1, '-', '', 'mandiri', '-', 'Henry Hendratno', 'Iuran wajib 500', 'BCA', '7640195481', 'BE2024110064.jpeg', '2024-11-10', 1),
('BE2024110065', 'EV2024070006', 'EI2024100020', 41, 1, 16, '2024-11-09', 1000000, 1, 1, '-', '', 'mandiri', '-', 'Henry Hendratno', 'Iuran wajib 1jt', 'BCA', '7640195481', 'BE2024110065.jpeg', '2024-11-10', 1),
('BE2024110067', 'EV2024070006', 'EI2024100020', 41, 1, 16, '2024-11-10', 1200000, 2, 1, '-', '', 'mandiri', '-', 'Henry Hendratno', 'Regis 1,2jt', 'BCA', '7640195481', 'BE2024110067.jpeg', '2024-11-10', 1),
('BE2024110068', 'EV2024070006', 'EI2024100015', 36, 1, 2, '2024-11-05', 1500000, 1, 1, 'JUMARIYANTO', '', 'BPD DIY', '-', 'Henry Hendratno', 'IURAN WAJIB', 'BCA', '7640195481', 'BE2024110068.jpeg', '2025-07-31', 1),
('BE2024110069', 'EV2024070006', 'EI2024100015', 36, 1, 9, '2024-11-05', 6400000, 2, 1, 'JUMARIYANTO', '', 'BPD DIY', '-', 'Henry Hendratno', 'IURAN REGISTRASI', 'BCA', '7640195481', 'BE2024110069.jpeg', '2024-11-10', 1),
('BE2024110070', 'EV2024070006', 'EI2024100015', 36, 1, 9, '2024-11-05', 41650000, 3, 1, 'JUMARIYANTO', '', 'BPD DIY', '-', 'Henry Hendratno', 'IURAN AKOMODASI', 'BCA', '7640195481', 'BE2024110070.jpeg', '2024-11-10', 1),
('BE2024110071', 'EV2024070006', 'EI2024100020', 41, 1, 0, '2024-11-10', 4800000, 3, 1, '-', '', 'mandiri', '-', 'Henry Hendratno', 'kekurangan akomodasi', 'BCA', '7640195481', 'BE2024110071.jpeg', '', 0),
('BE2024110072', 'EV2024070006', 'EI2024100012', 33, 1, 9, '2024-10-24', 10000000, 3, 1, '-', 'DP AKOMODASI 1 DKI ', 'BCA', '-', 'Henry Hendratno', 'IURAN RAGISTRASI DKI', 'BCA', '7640195481', 'BE2024110072.jpeg', '2024-11-10', 1),
('BE2024110073', 'EV2024070006', 'EI2024100012', 33, 1, 0, '2024-11-09', 10000000, 3, 1, '-', 'DP AKOMODASI 2 DKI', 'BCA', '-', 'RETNO UTAMI', 'DP AKOMODASI 2 DKI', 'BCA', '197494342', 'BE2024110073.jpeg', '', 0),
('BE2024110074', 'EV2024070006', 'EI2024100012', 33, 1, 0, '2024-11-10', 10000000, 3, 1, '-', '', 'BCA', '-', 'RETNO UTAMI', 'DP KEJURNAS 3 DKI ', 'BCA', '0460678552', 'BE2024110074.jpeg', '', 0),
('BE2024110075', 'EV2024070006', 'EI2024100012', 33, 1, 0, '2024-11-10', 10000000, 3, 1, '-', '', 'BCA', '-', 'RETNO UTAMI', 'DP 4 KEJURNAS DKI', 'BCA', '0460678552', 'BE2024110075.jpeg', '', 0),
('BE2024110076', 'EV2024070006', 'EI2024100012', 33, 1, 0, '2024-11-10', 10000000, 3, 1, '-', '', 'BCA', '-', 'RETNO UTAMI', 'DP 5 KEJURNAS DKI', 'BCA', '0460678552', 'BE2024110076.jpeg', '', 0),
('BE2024110077', 'EV2024070006', 'EI2024100014', 35, 1, 16, '2024-11-06', 1500000, 1, 1, 'Ali Shodikin', '', 'mandiri', '-', 'Henry Hendratno', 'Iuran Wajib', 'BCA', '7640195481', 'BE2024110077.jpeg', '2024-11-10', 1),
('BE2024110078', 'EV2024070006', 'EI2024100014', 35, 1, 16, '2024-11-05', 300000, 2, 1, 'Ali Shodikin', '', 'mandiri', '-', 'Henry Hendratno', 'Registrasi 1', 'BCA', '7640195481', 'BE2024110078.jpeg', '2024-11-10', 1),
('BE2024110079', 'EV2024070006', 'EI2024100032', 53, 1, 16, '2024-11-10', 1500000, 1, 1, '-', '', 'BCA', '-', 'Henry Hendratno', 'Iuran wajib', 'BCA', '7640195481', 'BE2024110079.jpeg', '2024-11-10', 1),
('BE2024110080', 'EV2024070006', 'EI2024100032', 53, 1, 16, '2024-11-01', 600000, 2, 1, '-', '', 'BCA', '-', 'Henry Hendratno', 'Regis 2 orang', 'BCA', '7640195481', 'BE2024110080.jpeg', '2024-11-10', 1),
('BE2024110081', 'EV2024070006', 'EI2024100032', 53, 1, 16, '2024-11-01', 7350000, 3, 1, '-', '', 'BCA', '-', 'Henry Hendratno', 'Akomodasi 3 orang', 'BCA', '7640195481', 'BE2024110081.jpeg', '2024-11-10', 1),
('BE2024110082', 'EV2024070006', 'EI2024100019', 40, 1, 16, '2024-11-10', 1500000, 1, 1, '-', '', 'BCA', '-', 'Henry Hendratno', 'Iuran wajib', 'BCA', '7640195481', 'BE2024110082.jpeg', '2024-11-10', 1),
('BE2024110083', 'EV2024070006', 'EI2024100019', 40, 1, 16, '2024-11-10', 15750000, 2, 1, '-', '', 'BCA', '-', 'Henry Hendratno', 'Registrasi ', 'BCA', '7640195481', 'BE2024110083.jpeg', '2024-11-10', 1),
('BE2024110084', 'EV2024070006', 'EI2024100019', 40, 1, 0, '2024-11-10', 53300000, 3, 1, '-', '', 'BCA', '-', 'Henry Hendratno', 'akomodasi', 'BCA', '7640195481', 'BE2024110084.jpeg', '', 0),
('BE2024110085', 'EV2024070006', 'EI2024100019', 40, 1, 16, '2024-11-10', 550000, 3, 2, '-', '', '-', '-', 'Henry Hendratno', 'akomodasi cash', 'BCA', '7640195481', 'BE2024110085.jpeg', '2024-11-10', 1),
('BE2024110086', 'EV2024070006', 'EI2024100019', 40, 1, 16, '2024-11-10', 82750000, 3, 1, '-', '', 'BCA', '-', 'Henry Hendratno', 'akomodasi tf', 'BCA', '7640195481', 'BE2024110086.jpeg', '2024-11-10', 1),
('BE2024110087', 'EV2024070006', 'EI2024100029', 50, 1, 16, '2024-11-07', 1500000, 1, 1, '-', '', 'MANDIRI', '-', 'Henry Hendratno', 'iuran wajib', 'BCA', '7640195481', 'BE2024110087.jpeg', '2024-11-10', 1),
('BE2024110088', 'EV2024070006', 'EI2024100029', 50, 1, 16, '2024-11-10', 3500000, 3, 2, 'NTB', '', '-', '-', 'Henry Hendratno', 'Akomodasi 3,5jt', 'BCA', '7640195481', 'BE2024110088.jpeg', '2024-11-10', 1),
('BE2024110089', 'EV2024070006', 'EI2024100012', 33, 1, 16, '2024-11-10', 40000000, 3, 2, 'DKI JKT', '', '-', '-', 'Retno Utami', 'akomodasi 40 jt', '-', '-', 'BE2024110089.jpeg', '2024-11-10', 1),
('BE2024110090', 'EV2024070006', 'EI2024100011', 32, 1, 0, '2024-11-09', 1500000, 1, 1, '-', '', 'BCA', '-', 'Henry Hendratno', 'Iuran wajib', 'BCA', '7640195481', 'BE2024110090.jpeg', '', 0),
('BE2024110091', 'EV2024070006', 'EI2024100011', 32, 1, 16, '2024-11-06', 10000000, 2, 1, '-', '', 'BCA', '-', 'Henry Hendratno', 'DP Regis 10jt', 'BCA', '7640195481', 'BE2024110091.jpeg', '2024-11-11', 1),
('BE2024110092', 'EV2024070006', 'EI2024100011', 32, 1, 0, '2024-11-01', 1500000, 2, 1, '-', '', 'BCA', '-', 'Henry Hendratno', 'PNP 1 orang', 'BCA', '7640195481', 'BE2024110092.jpeg', '', 0),
('BE2024110093', 'EV2024070006', 'EI2024100011', 32, 1, 16, '2024-11-01', 1250000, 2, 1, '-', '', 'BCA', '-', 'Henry Hendratno', 'PNP', 'BCA', '7640195481', 'BE2024110093.jpeg', '2024-11-11', 1),
('BE2024110094', 'EV2024070006', 'EI2024100024', 45, 1, 16, '2024-11-09', 1500000, 1, 1, '-', '', 'BRI', '-', 'Henry Hendratno', 'Iuran Wajib', 'BCA', '7640195481', 'BE2024110094.jpeg', '2024-11-11', 1),
('BE2024110095', 'EV2024070006', 'EI2024100008', 29, 1, 16, '2024-11-09', 1500000, 1, 1, 'MIrwan', '', 'BRI', '-', 'Henry Hendratno', 'Iuran wajib', 'BCA', '7640195481', 'BE2024110095.jpeg', '2024-11-11', 1),
('BE2024110096', 'EV2024070006', 'EI2024100010', 31, 1, 16, '2024-11-09', 1500000, 1, 1, '-', '', 'MANDIRI', '-', 'Henry Hendratno', 'Iuran Wajib', 'BCA', '7640195481', 'BE2024110096.jpeg', '2024-11-11', 1),
('BE2024110097', 'EV2024070006', 'EI2024100010', 31, 1, 0, '2024-11-09', 1500000, 1, 1, '-', '', 'MANDIRI', '-', 'Henry Hendratno', 'Iuran Wajib', 'BCA', '7640195481', 'BE2024110097.jpeg', '', 0),
('BE2024110098', 'EV2024070006', 'EI2024100011', 32, 1, 16, '2024-11-11', 9900000, 2, 1, '-', '', 'BCA', '-', 'Henry Hendratno', 'Registrasi 9,9jt', 'BCA', '7640195481', 'BE2024110098.jpeg', '2024-11-11', 1),
('BE2024110099', 'EV2024070006', 'EI2024100011', 32, 1, 16, '2024-11-11', 4900000, 3, 1, '-', '', 'BCA', '-', 'Henry Hendratno', 'Akomodasi 4,9jt', 'BCA', '7640195481', 'BE2024110099.jpeg', '2024-11-11', 1),
('BE2024110100', 'EV2024070006', 'EI2024100004', 25, 1, 0, '2024-11-06', 1500000, 1, 1, 'Syayekti', '', 'BNI', '-', 'Henry Hendratno', 'Iuran wajib ', 'BCA', '7640195481', 'BE2024110100.jpeg', '', 0),
('BE2024110101', 'EV2024070006', 'EI2024100004', 25, 1, 0, '2024-11-06', 6900000, 2, 1, 'Syayekti', '', 'BNI', '-', 'Henry Hendratno', 'Registrasi 23 orang', 'BCA', '7640195481', 'BE2024110101.jpeg', '', 0),
('BE2024110102', 'EV2024070006', 'EI2024100004', 25, 1, 0, '2024-11-06', 2500000, 2, 1, 'Syayekti', '', 'BNI', '-', 'Henry Hendratno', 'Registrasi 2 PNP', 'BCA', '7640195481', 'BE2024110102.jpeg', '', 0),
('BE2024110103', 'EV2024070006', 'EI2024100039', 60, 1, 9, '2024-11-06', 10000000, 3, 1, '-', '', 'BCA', '-', 'Henry Hendratno', 'DP AKOM BINAAN JAPFA 7 ORANG', 'BCA', '7640195481', 'BE2024110103.jpeg', '2024-11-11', 1),
('BE2024110104', 'EV2024070006', 'EI2024100005', 26, 1, 9, '2024-11-05', 1500000, 1, 1, 'ANWAR HARMINTO', '', 'BSI', 'XXX9987', 'Henry Hendratno', 'IURAN PENGROV PERCASI JAMBI', 'BCA', '7640195481', 'BE2024110104.jpeg', '2024-11-11', 1),
('BE2024110105', 'EV2024070006', 'EI2024100005', 26, 1, 9, '2024-11-05', 1250000, 2, 1, 'AKBAR TAHIR POHAN', '', 'BRI', 'XXX532', 'Henry Hendratno', 'TAMBAHAN 1 ORG PELATIHAN PELATIH JAMBI', 'BCA', '7640195481', 'BE2024110105.jpeg', '2024-11-11', 1),
('BE2024110106', 'EV2024070006', 'EI2024100005', 26, 1, 2, '2024-11-05', 300000, 2, 1, 'AKBAR TAHIR POHAN', '', 'BRI', 'XXX532', 'Henry Hendratno', 'TAMBAHAN 1 PESERTA JAMBI', 'BCA', '7640195481', 'BE2024110106.jpeg', '2024-11-11', 1),
('BE2024110107', 'EV2024070006', 'EI2024100002', 23, 1, 9, '2024-11-11', 1500000, 1, 1, 'HAKRIN JEFRI TUA MAR', '', 'MANDIRI', 'xx2931', 'Henry Hendratno', 'IURAN PERCASI SUMUT', 'MANDIRI', '1550002050725', 'BE2024110107.jpeg', '2024-11-11', 1),
('BE2024110108', 'EV2024070006', 'EI2024100027', 48, 1, 16, '2024-11-11', 8800000, 3, 1, '-', '', 'BCA', '-', 'Henry Hendratno', 'Akomodasi', 'BCA', '7640195481', 'BE2024110108.jpeg', '2024-11-11', 1),
('BE2024110109', 'EV2024070006', 'EI2024100039', 60, 1, 9, '2024-11-05', 5000000, 3, 1, 'Merry Damayanti', '', 'BCA', '-', 'Henry Hendratno', 'DP akom pecatur binaan japfa\r\n', 'BCA', '7640195481', 'BE2024110109.jpeg', '2024-11-11', 1),
('BE2024110110', 'EV2024070006', 'EI2024100003', 24, 1, 16, '2024-11-06', 1500000, 1, 1, '-', '', 'BNI', '-', 'Henry Hendratno', 'Iuran wajib', 'BCA', '7640195481', 'BE2024110110.jpeg', '2024-11-11', 1),
('BE2024110111', 'EV2024070006', 'EI2024100003', 24, 1, 16, '2024-11-06', 6900000, 2, 1, '-', '', 'BNI', '-', 'Henry Hendratno', 'Regis 23 orang non gelar', 'BCA', '7640195481', 'BE2024110111.jpeg', '2024-11-11', 1),
('BE2024110112', 'EV2024070006', 'EI2024100003', 24, 1, 16, '2024-11-06', 2500000, 2, 1, '-', '', 'BNI', '-', 'Henry Hendratno', 'Regis PNP 2', 'BCA', '7640195481', 'BE2024110112.jpeg', '2024-11-11', 1),
('BE2024110113', 'EV2024070006', 'EI2024100030', 51, 1, 16, '2024-11-09', 1500000, 1, 1, '-', '', 'BCA', '-', 'Henry Hendratno', 'Iuran wajib', 'BCA', '7640195481', 'BE2024110113.jpeg', '2024-11-11', 1),
('BE2024110114', 'EV2024070006', 'EI2024100025', 46, 1, 16, '2024-11-09', 1500000, 1, 1, '-', '', 'BCA', '-', 'Henry Hendratno', 'iuran wajib', 'BCA', '7640195481', 'BE2024110114.jpeg', '2024-11-12', 1),
('BE2024110115', 'EV2024070006', 'EI2024100030', 51, 1, 16, '2024-11-07', 600000, 2, 1, '-', '', 'BCA', '-', 'Henry Hendratno', 'registrasi 2 orang', 'BCA', '7640195481', 'BE2024110115.jpeg', '2024-11-12', 1),
('BE2024110116', 'EV2024070006', 'EI2024100030', 51, 1, 16, '2024-11-08', 14500000, 3, 1, '-', '', 'BCA', '-', 'Henry Hendratno', 'pelunasan akomodasi', 'BCA', '7640195481', 'BE2024110116.jpeg', '2024-11-12', 1),
('BE2024110117', 'EV2024070006', 'EI2024100013', 34, 1, 0, '2024-11-12', 10000000, 2, 1, '-', '', 'BRI', '-', 'Henry Hendratno', 'DP Regis 10jt', 'BCA', '7640195481', 'BE2024110117.jpeg', '', 0),
('BE2024110118', 'EV2024070006', 'EI2024100023', 44, 1, 16, '2024-11-05', 300000, 2, 1, '-', '', 'BRI', '-', 'Henry Hendratno', 'registrasi klara', 'BCA', '7640195481', 'BE2024110118.jpeg', '2024-11-12', 1),
('BE2024110119', 'EV2024070006', 'EI2024100023', 44, 1, 16, '2024-10-30', 300000, 2, 1, '-', '', 'MANDIRI', '-', 'Henry Hendratno', 'registrasi satya', 'BCA', '7640195481', 'BE2024110119.jpeg', '2024-11-12', 1),
('BE2024110120', 'EV2024070006', 'EI2024100002', 23, 1, 16, '2024-11-04', 300000, 2, 1, '-', '', 'MANDIRI', '-', 'Henry Hendratno', 'registrasi', 'BCA', '7640195481', 'BE2024110120.jpeg', '2024-11-12', 1),
('BE2024110122', 'EV2024070006', 'EI2024100038', 59, 1, 9, '2024-11-13', 300000, 2, 1, 'YAN MAURITIS MANSAWAN', '', 'MANDIRI', '-', 'Henry Hendratno', '', 'MANDIRI', '1550002050725', 'BE2024110122.jpeg', '2024-11-13', 1),
('BE2024110123', 'EV2024070006', 'EI2024100038', 59, 1, 9, '2024-11-13', 5500000, 2, 1, 'YAN MAURITIS MANSAWAN', '', 'MANDIRI', '-', 'Henry Hendratno', '', 'MANDIRI', '1550002050725', 'BE2024110123.jpeg', '2024-11-13', 1),
('BE2024110124', 'EV2024070006', 'EI2024100038', 59, 1, 9, '2024-11-13', 600000, 2, 1, 'YAN MAURITIS MANSAWAN', '', 'MANDIRI', '-', 'Henry Hendratno', '', 'MANDIRI', '1550002050725', 'BE2024110124.jpeg', '2024-11-13', 1),
('BE2024110125', 'EV2024070006', 'EI2024100038', 59, 1, 9, '2024-11-13', 1500000, 1, 1, 'YAN MAURITIS MANSAWAN', '', 'MANDIRI', '-', 'Henry Hendratno', '', 'MANDIRI', '1550002050725', 'BE2024110125.jpeg', '2024-11-13', 1),
('BE2024110126', 'EV2024070006', 'EI2024100038', 59, 1, 9, '2024-11-13', 7100000, 3, 1, 'YAN MAURITIS MANSAWAN', '', 'MANDIRI', '-', 'Henry Hendratno', '', 'MANDIRI', '1550002050725', 'BE2024110126.jpeg', '2024-11-13', 1),
('BE2024110127', 'EV2024070006', 'EI2024100020', 41, 1, 0, '2024-11-13', 4200000, 3, 2, 'HAMDANI', '', 'TUNAI', '-', 'RETNO UTAMI', 'TAMBAHAN AKOMODASI', 'TUNAI', '-', 'BE2024110127.jpeg', '', 0),
('BE2024110128', 'EV2024070006', 'EI2024100014', 35, 1, 9, '2024-11-13', 2450000, 3, 1, '-', '', 'BCA', '-', 'Henry Hendratno', 'akomodasi ortu vanessa koolin', 'BCA', '7640195481', 'BE2024110128.jpeg', '2024-11-13', 1),
('BE2024110129', 'EV2024070006', 'EI2024100013', 34, 1, 0, '2024-11-13', 13000000, 3, 1, 'R. AGGI RANGGA', '', 'BRI', '-', 'Henry Hendratno', 'pendaftaran & akomodasi JABAR', 'BCA', '7640195481', 'BE2024110129.jpeg', '', 0),
('BE2024110130', 'EV2024070006', 'EI2024100008', 29, 1, 9, '2024-11-07', 11000000, 3, 1, 'TRIAJIE WIBOWO', '', 'MANDIRI', '-', 'Henry Hendratno', '', 'MANDIRI', '1550002050725', 'BE2024110130.jpeg', '2024-11-13', 1),
('BE2024110131', 'EV2024070006', 'EI2024100013', 34, 1, 0, '2024-11-13', 5700000, 3, 1, 'R. AGGI RANGGA', '', 'BRI', '-', 'Henry Hendratno', 'akomodasi pendaftaran JABAR', 'BCA', '7640195481', 'BE2024110131.jpeg', '', 0),
('BE2024110132', 'EV2024070006', 'EI2024100013', 34, 1, 0, '2024-11-13', 16000000, 3, 1, '-', '', 'BRI', '-', 'Henry Hendratno', '', 'BCA', '7640195481', 'BE2024110132.jpeg', '', 0),
('BE2024110133', 'EV2024070006', 'EI2024100013', 34, 1, 9, '2024-11-12', 1500000, 1, 1, 'R. AGGI RANGGA', '', 'BRI', '-', 'Henry Hendratno', '', 'BCA', '7640195481', 'BE2024110133.jpeg', '2024-11-13', 1),
('BE2024110134', 'EV2024070006', 'EI2024100013', 34, 1, 9, '2024-11-06', 10000000, 2, 1, '-', '', 'BRI', '-', 'Henry Hendratno', '', 'BCA', '7640195481', 'BE2024110134.jpeg', '2024-11-13', 1),
('BE2024110135', 'EV2024070006', 'EI2024100013', 34, 1, 9, '2024-11-13', 13000000, 3, 1, 'R. AGGI RANGGA', '', 'BRI', '-', 'Henry Hendratno', '', 'BCA', '7640195481', 'BE2024110135.jpeg', '2024-11-13', 1),
('BE2024110136', 'EV2024070006', 'EI2024100013', 34, 1, 9, '2024-11-13', 16200000, 3, 1, '-', '', 'BRI', '-', 'Henry Hendratno', '', 'BCA', '7640195481', 'BE2024110136.jpeg', '2024-11-13', 1),
('BE2024110137', 'EV2024070006', 'EI2024100013', 34, 1, 9, '2024-11-10', 10000000, 3, 1, '-', '', 'BRI', '-', 'Henry Hendratno', '', 'BCA', '7640195481', 'BE2024110137.jpeg', '2024-11-13', 1),
('BE2024110138', 'EV2024070006', 'EI2024100013', 34, 1, 9, '2024-11-12', 7500000, 3, 1, 'R. AGGI RANGGA', '', 'BRI', '-', 'Henry Hendratno', '', 'BCA', '7640195481', 'BE2024110138.jpeg', '2024-11-13', 1),
('BE2024110139', 'EV2024070006', 'EI2024100013', 34, 1, 9, '2024-11-13', 17000000, 3, 1, 'R. AGGI RANGGA', '', 'BRI', '0', 'Henry Hendratno', '', 'BCA', '7640195481', 'BE2024110139.jpeg', '2024-11-14', 1),
('BE2024110140', 'EV2024070006', 'EI2024100013', 34, 1, 9, '2024-10-30', 5000000, 2, 1, '-', '', 'BRI', '-', 'Henry Hendratno', '', 'BCA', '7640195481', 'BE2024110140.jpeg', '2024-11-13', 1),
('BE2024110141', 'EV2024070006', 'EI2024100013', 34, 1, 9, '2024-11-04', 2000000, 2, 1, '-', '', 'BCA', '-', 'Henry Hendratno', '', 'BCA', '7640195481', 'BE2024110141.jpeg', '2024-11-13', 1),
('BE2024110142', 'EV2024070006', 'EI2024100013', 34, 1, 9, '2024-11-05', 400000, 2, 1, '-', '', 'BCA', '-', 'Henry Hendratno', '', 'BCA', '7640195481', 'BE2024110142.jpeg', '2024-11-13', 1),
('BE2024110143', 'EV2024070006', 'EI2024100039', 60, 1, 9, '2024-11-12', 4600000, 3, 1, 'Merry Damayanti', 'pelunasan japfa', 'BCA', '-', 'Henry Hendratno', 'pelunasan japfa', 'BCA', '7640195481', 'BE2024110143.jpeg', '2024-11-13', 1),
('BE2024110144', 'EV2024070006', 'EI2024100039', 60, 1, 9, '2024-11-12', 1500000, 2, 1, 'Merry Damayanti', '', 'BCA', '-', 'Henry Hendratno', '', 'BCA', '7640195481', 'BE2024110144.jpeg', '2024-11-13', 1),
('BE2024110145', 'EV2024070006', 'EI2024100020', 41, 1, 9, '2024-11-13', 4800000, 3, 1, 'HAMDANI', '', 'MANDIRI', '-', 'Henry Hendratno', 'PEMBAYARAN AKOMODASI ', 'MANDIRI', '1550002050725', 'BE2024110145.jpg', '2024-11-14', 1),
('BE2024110146', 'EV2024070006', 'EI2024100008', 29, 1, 9, '2024-11-14', 900000, 2, 1, 'MIRWAN', '', 'BRI', '-', 'Henry Hendratno', '', 'BCA', '7640195481', 'BE2024110146.jpeg', '2024-11-14', 1),
('BE2024110147', 'EV2024070006', 'EI2024100012', 33, 1, 9, '2024-11-01', 2450000, 3, 1, '-', '', 'BCA', '-', 'Henry Hendratno', 'PENDAMPING LEONATHAN EDGAR VENUE', 'BCA', '7640195481', 'BE2024110147.jpeg', '2024-11-14', 1),
('BE2024110148', 'EV2024070006', 'EI2024100008', 29, 1, 9, '2024-11-14', 5000000, 3, 1, '-', '', 'BNI', '-', 'Henry Hendratno', '', 'BCA', '7640195481', 'BE2024110148.jpeg', '2024-11-14', 1),
('BE2024110149', 'EV2024070006', 'EI2024100022', 43, 1, 16, '2024-11-13', 1500000, 1, 1, 'Kaltara', '', '-', '-', 'Henry Hendratno', 'Kaltara (bukti tf ngga muncul)', 'BCA', '7640195481', 'BE2024110149.jpeg', '2024-11-14', 1),
('BE2024110150', 'EV2024070006', 'EI2024100038', 59, 1, 2, '2024-11-14', 4200000, 3, 1, 'Yan Mauritz', '', 'Mandiri', '0', 'HH', 'Pelunasan dan up nominal karena 2 orang hanya menginap 2 hari saja.', 'Mandiri', '0', 'BE2024110150.jpeg', '2024-11-17', 1),
('BE2024110151', 'EV2024070006', 'EI2024100038', 59, 1, 2, '2024-11-17', 950000, 3, 1, 'not', '', 'not', '0', 'not', 'not', 'not', '0', 'BE2024110151.jpeg', '2024-11-17', 1),
('BE2024110152', 'EV2024070006', 'EI2024100018', 39, 1, 0, '2024-11-14', 19000000, 3, 2, '-', '', '-', '-', 'Retno Utami', 'pembayaran cash 1 penataran Pelatih dan pelunasan akomodasi', '-', '-', 'BE2024110152.jpeg', '', 0),
('BE2024110153', 'EV2024070006', 'EI2024100018', 39, 1, 2, '2024-11-15', 1850000, 2, 2, 'tunai', '', 'tunai', '0', 'utami', '1850000', 'tunai', '0', 'BE2024110153.jpeg', '2024-11-17', 1),
('BE2024110154', 'EV2024070006', 'EI2024100018', 39, 1, 2, '2024-11-14', 17150000, 3, 2, 'Kalsel', '', '-', '-', 'Retno Utami', 'gabungan 17 150 000 + 1 850 000', '-', '-', 'BE2024110154.jpeg', '2024-11-17', 1),
('BE2024110155', 'EV2024070006', 'EI2024100012', 33, 1, 2, '2024-11-19', 57800000, 3, 1, 'Utami/Bapak Pandapotan', '', 'BCA', 'BCA', 'HH', 'transfer ke utami, diteruskan ke Sekjen', 'Henry Hendratno', '0', 'BE2024110155.jpeg', '2024-11-21', 1),
('BE2024110156', 'EV2024070006', 'EI2024100012', 33, 1, 2, '2024-11-14', 3850000, 2, 1, 'Syaiful', '', 'BCA', 'BCA', '0', 'sisa pembayaran Akomodasi DKI', 'Henry Hendratno', '0', 'BE2024110156.jpeg', '2024-11-21', 1),
('BE2024110157', 'EV2024070006', 'EI2024100012', 33, 1, 2, '2024-11-14', 20850000, 2, 1, 'Syaiful', '', 'BCA', '0', '0', '', 'Henry Hendratno', '0', 'BE2024110157.jpeg', '2024-11-21', 1),
('BE2024110158', 'EV2024070006', 'EI2024100021', 42, 1, 16, '2024-11-09', 1500000, 1, 1, '-', '', 'Gopay', '-', 'Henry Hendratno', 'iuran wajib kaltim', 'BCA', '7640195481', 'BE2024110158.jpeg', '2024-11-25', 1),
('BE2024110159', 'EV2024070006', 'EI2024100021', 42, 1, 16, '2024-11-05', 6000000, 2, 1, '-', '', 'Permata Bank', '-', 'Henry Hendratno', 'registrasi 20 orang', 'BCA', '7640195481', 'BE2024110159.jpeg', '2024-11-25', 1);

-- --------------------------------------------------------

--
-- Table structure for table `iurantahunan`
--

CREATE TABLE `iurantahunan` (
  `id` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `id_prov` int NOT NULL,
  `jumlah` int NOT NULL,
  `bukti` text COLLATE utf8mb4_general_ci NOT NULL,
  `tahun` int NOT NULL,
  `tanggal_bayar` date DEFAULT NULL,
  `nama_pembayar` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `nama_penerima` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `catatan` text COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `iurantahunan`
--

INSERT INTO `iurantahunan` (`id`, `id_prov`, `jumlah`, `bukti`, `tahun`, `tanggal_bayar`, `nama_pembayar`, `nama_penerima`, `catatan`) VALUES
('BI2025070006', 22, 2000000, 'BI2025070006.png', 2025, '2025-07-31', 'Imam', 'Retno', '');

-- --------------------------------------------------------

--
-- Table structure for table `juaraev`
--

CREATE TABLE `juaraev` (
  `idjuara` varchar(12) NOT NULL,
  `id_ev` varchar(12) NOT NULL,
  `id_pst_ev` varchar(12) NOT NULL,
  `peringkat` tinyint UNSIGNED NOT NULL DEFAULT '1',
  `keterangan` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kaskeluarev`
--

CREATE TABLE `kaskeluarev` (
  `id_kaskeluar` varchar(12) NOT NULL,
  `id_ev` varchar(12) NOT NULL,
  `tgl_keluar` date NOT NULL,
  `no_bukti` varchar(15) NOT NULL,
  `bukti` text NOT NULL,
  `jumlah` int NOT NULL,
  `keterangan` text NOT NULL,
  `id_admin` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kategoriev`
--

CREATE TABLE `kategoriev` (
  `id_ktg_ev` varchar(14) NOT NULL,
  `id_ev` varchar(12) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `jml_peserta` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategoriev`
--

INSERT INTO `kategoriev` (`id_ktg_ev`, `id_ev`, `kategori`, `jml_peserta`) VALUES
('EV202407000601', 'EV2024070006', 'Junior Putra A (U-19) ', 29),
('EV202407000602', 'EV2024070006', 'Junior Putra B (U-17)', 38),
('EV202407000603', 'EV2024070006', 'Junior Putra C (U-15)', 59),
('EV202407000604', 'EV2024070006', 'Junior Putra D (U-13)', 67),
('EV202407000605', 'EV2024070006', 'Junior Putra E (U-11)', 53),
('EV202407000606', 'EV2024070006', 'Junior Putra F (U-09) ', 49),
('EV202407000607', 'EV2024070006', 'Junior Putra G (U-07) ', 31),
('EV202407000608', 'EV2024070006', 'Junior Putri A (U-19) ', 13),
('EV202407000609', 'EV2024070006', 'Junior Putri B (U-17)', 21),
('EV202407000610', 'EV2024070006', 'Junior Putri C (U-15)', 37),
('EV202407000611', 'EV2024070006', 'Junior Putri D (U-13) ', 27),
('EV202407000612', 'EV2024070006', 'Junior Putri E (U-11) ', 32),
('EV202407000613', 'EV2024070006', 'Junior Putri F (U-09) ', 32),
('EV202407000614', 'EV2024070006', 'Junior Putri G (U-07) ', 24),
('EV202407000615', 'EV2024070006', 'PNP (Pelatih Nasional Pratama)', 34),
('EV202407000618', 'EV2024070006', 'Upgrading PNM (Pelatih Nasional Madya)', 6),
('EV202407000622', 'EV2024070006', 'Pendamping', 44),
('EV202407000623', 'EV2024070006', 'Manager', 11),
('EV202407000624', 'EV2024070006', 'Official ', 30),
('EV202407000625', 'EV2024070006', 'RAKERNAS', 12);

-- --------------------------------------------------------

--
-- Table structure for table `operator`
--

CREATE TABLE `operator` (
  `id_operator` int UNSIGNED NOT NULL,
  `nama_operator` varchar(40) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `passwd` varchar(50) NOT NULL,
  `foto` text NOT NULL,
  `aktif` tinyint UNSIGNED NOT NULL DEFAULT '1',
  `telepon` varchar(20) NOT NULL,
  `email` varchar(40) NOT NULL,
  `id_prov` int UNSIGNED NOT NULL,
  `iuran` enum('belum','sudah') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `operator`
--

INSERT INTO `operator` (`id_operator`, `nama_operator`, `user_name`, `passwd`, `foto`, `aktif`, `telepon`, `email`, `id_prov`, `iuran`) VALUES
(1, 'PB Percasi', '-', '-', '', 0, '-', '-', 1, 'belum'),
(3, 'Hermans', 'herman', '827ccb0eea8a706c4c34a16891f84e7b', '', 1, '019191919', 'hermans@gmail.vom', 2, 'belum'),
(4, 'Susanti wati', 'susanti', '827ccb0eea8a706c4c34a16891f84e7b', '', 1, '082828282828', 'susanti@gmail.com', 1, 'belum'),
(6, 'Dian', 'Dian', '827ccb0eea8a706c4c34a16891f84e7b', '', 1, '00000', 'dian@gmail.com', 18, 'belum'),
(7, 'Osaka', 'Osaka ', '827ccb0eea8a706c4c34a16891f84e7b', '', 1, '1111111', 'Osaka@gmail.vom', 19, 'belum'),
(8, 'Rio', 'Rio', '827ccb0eea8a706c4c34a16891f84e7b', '', 1, '23098', 'Rio@gmail.com', 21, 'belum'),
(12, 'Mr. Farhan Zaky', 'Farhan', '827ccb0eea8a706c4c34a16891f84e7b', 'Farhan.', 0, '085336650444', 'farhanzaky22@gmail.com', 37, 'belum'),
(13, 'Mr Syaiful Hidayat', 'Syaiful H', '827ccb0eea8a706c4c34a16891f84e7b', 'Syaiful H.jpg', 0, '082122887670', 'percasijakarta@yahoo.com', 33, 'belum'),
(14, ' Kak Agi ganteng', 'Aggie', 'adcaec3805aa912c0d0b14a81bedb6ff', 'Aggie.', 0, '082119101550', 'percasijabar@gmail.com', 34, 'belum'),
(15, 'Mr Jumariyanto', 'Jumaryanto', '827ccb0eea8a706c4c34a16891f84e7b', 'Jumaryanto.', 0, '085228637000', 'jumariyanto777@gmail.com', 36, 'belum'),
(16, 'Mr Ali Sadikin jtg', 'Ali Sadikin', '827ccb0eea8a706c4c34a16891f84e7b', 'Ali Sadiki.', 0, '083134183721', 'Bundabschess@gmail.com', 35, 'belum'),
(17, 'Miftahurrahman', 'Miftah', '827ccb0eea8a706c4c34a16891f84e7b', 'Miftah.', 0, '082359263690', 'miftahurrahman1968@gmail.com', 50, 'belum'),
(18, 'Mommy Fatonah', 'Fatt BPK', '827ccb0eea8a706c4c34a16891f84e7b', 'Fatt BPK.', 0, '08161647430', 'Bundabschess@gmail.com', 61, 'belum'),
(19, 'Ms Widhiya', 'Widhiya', '827ccb0eea8a706c4c34a16891f84e7b', 'Ekanata Bali.', 1, '081805399748', 'Widhiya.cms.percasibali@gmail.com', 38, 'belum'),
(20, 'Pak Nurdin ok...', 'Nurdin Sumsel', '827ccb0eea8a706c4c34a16891f84e7b', 'Nurdin Sumsel.', 0, '081803700477', 'Bundabschess@gmail.com', 28, 'belum'),
(21, 'Kak Sekar', 'Sekar Cantik', '827ccb0eea8a706c4c34a16891f84e7b', 'Sekar Cantik.', 0, '08112882434', 'Bundabschess@gmail.com', 60, 'belum'),
(23, 'Daffa Sulsel', 'Daffa Sulsel', '081aedb495aa82b590d7edb3c8181858', 'Makasar admin.', 0, '000', 'Bundabschess@gmail.com', 44, 'belum'),
(24, 'Mr Hamdani', 'Hamdani', 'adcaec3805aa912c0d0b14a81bedb6ff', 'Hamdani.', 0, '085753596383', 'hamdaniwn@gmail.com', 41, 'belum'),
(26, 'Daffa JAPFA', 'Daffa JAPFA', 'c5b27bc83a3a413b4024a5474080fcb4', 'Daffa JAPFA.', 0, '111', 'Bundabschess@gmail.com', 60, 'belum'),
(27, 'Mr Habibi', 'Pak Dokter', '827ccb0eea8a706c4c34a16891f84e7b', 'Pak Dokter.', 0, '0811450105', 'percasisulteng2024@gmail.com', 47, 'belum'),
(28, 'Mr Agus ', 'Pak Agus Cakep', '827ccb0eea8a706c4c34a16891f84e7b', 'Pak Agus Cakep.', 0, '085390443398', 'Percasikalteng@gmail.com', 40, 'belum'),
(29, 'Syarif Achmad', 'Pak Syarif Kalsel', '827ccb0eea8a706c4c34a16891f84e7b', 'Pak Syarif Kalsel.', 0, '081349719667', 'percasi_kalsel2017@yahoo.com', 39, 'belum'),
(30, 'Mr Dudi Darmadi', 'Pak Dudi Cakep', '827ccb0eea8a706c4c34a16891f84e7b', 'Pak Dudi Cakep.', 0, '081510514135', 'Bundabschess@gmail.com', 32, 'belum'),
(31, 'Mr Boy', 'Bang Boy Keren', 'b3e3a6bcfabb08a59f2058174c17bbfa', 'Bang Boy Keren.', 0, '081366078858', 'Bundabschess@gmail.com', 26, 'belum'),
(32, 'Ulfah Sulut', 'Ulfah Sulut', '5f4dcc3b5aa765d61d8327deb882cf99', 'Ulfah Sulut.png', 1, '000', 'Bundabschess@gmail.com', 49, 'sudah'),
(33, 'Mr Yan', 'Kak Yan Mansawan', '827ccb0eea8a706c4c34a16891f84e7b', 'Kak Yan Mansawan.', 0, '081314030187', 'Bundabschess@gmail.com', 59, 'belum'),
(34, 'Mr Safrin', 'Bapak Safrin', '827ccb0eea8a706c4c34a16891f84e7b', 'Bapak Safrin.', 0, '081340133800', 'Bundabschess@gmail.com', 48, 'belum'),
(35, 'Mr Rio Ernawan', 'Rio Magic', '827ccb0eea8a706c4c34a16891f84e7b', 'Rio Magic.', 0, '085263742574', 'rioirnawan2@gmail.com', 27, 'belum'),
(36, 'Mr Mirwan', 'Nirvana Silver', '827ccb0eea8a706c4c34a16891f84e7b', 'Nirvana Silver.', 0, '087896482145', 'nirwanasilver@gmail.com', 29, 'belum'),
(37, 'Miss Ginanjar Melina', 'Melina Riau', '827ccb0eea8a706c4c34a16891f84e7b', 'Melina Riau.', 0, '085324888277', 'ginanjar0803@gmail.com', 24, 'belum');

-- --------------------------------------------------------

--
-- Table structure for table `penerimaanev`
--

CREATE TABLE `penerimaanev` (
  `id_penerimaan` varchar(12) NOT NULL,
  `id_ev` varchar(12) NOT NULL,
  `tgl_terima` date NOT NULL,
  `no_bukti` varchar(15) NOT NULL,
  `bukti` text NOT NULL,
  `jumlah` int NOT NULL,
  `keterangan` text NOT NULL,
  `id_admin` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penerimaanev`
--

INSERT INTO `penerimaanev` (`id_penerimaan`, `id_ev`, `tgl_terima`, `no_bukti`, `bukti`, `jumlah`, `keterangan`, `id_admin`) VALUES
('PL2024110003', 'EV2024070006', '2024-10-30', '30/10/2024 10:2', 'PL2024110003.jpeg', 1250000, 'DKI Jakarta Penataran PNP Rudy Hartono', 16),
('PL2024110006', 'EV2024070006', '2024-11-11', '11/11/24 15:53', 'PL2024110006.jpeg', 1400000, 'GORONTALO Akomodasi tambahan 4 hari', 16),
('PL2024110007', 'EV2024070006', '2024-11-13', '13/11/24', 'PL2024110007.jpeg', 4200000, 'Tambahan Akomodasi Kalbar (Cash Bu Utami)', 16);

-- --------------------------------------------------------

--
-- Table structure for table `pesertaev`
--

CREATE TABLE `pesertaev` (
  `id_pst_ev` varchar(14) NOT NULL,
  `id_nasional` varchar(100) DEFAULT NULL,
  `id_ktg_ev` varchar(14) DEFAULT NULL,
  `id_gelar_ev` varchar(14) DEFAULT NULL,
  `id_akomodasi_ev` int NOT NULL DEFAULT '1',
  `id_ev` varchar(12) DEFAULT NULL,
  `id_prov` int UNSIGNED NOT NULL DEFAULT '0',
  `nama_pst` varchar(40) DEFAULT NULL,
  `jk_pst` varchar(1) DEFAULT 'L',
  `tgl_lahir` date DEFAULT NULL,
  `umur` int DEFAULT '0',
  `nik` varchar(16) DEFAULT NULL,
  `telepon` varchar(20) DEFAULT NULL,
  `juara` int NOT NULL DEFAULT '0',
  `id_operator` int UNSIGNED NOT NULL DEFAULT '1',
  `id_admin` int UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pesertaev`
--

INSERT INTO `pesertaev` (`id_pst_ev`, `id_nasional`, `id_ktg_ev`, `id_gelar_ev`, `id_akomodasi_ev`, `id_ev`, `id_prov`, `nama_pst`, `jk_pst`, `tgl_lahir`, `umur`, `nik`, `telepon`, `juara`, `id_operator`, `id_admin`) VALUES
('EP2024100013', '', 'EV202407000603', 'EV202407000611', 2, 'EV2024070006', 65, 'rita', 'W', '2008-06-11', 16, '000000', '0000', 0, 9, 1),
('EP2024100014', '', 'EV202407000609', 'EV202407000601', 2, 'EV2024070006', 34, 'ADINDA CANTIKA CHELSEA ', 'W', '2009-02-03', 15, '0', '0', 0, 14, 1),
('EP2024100015', '', 'EV202407000604', 'EV202407000601', 2, 'EV2024070006', 34, 'KHALID JUNDI AKBAR', 'P', '2011-07-17', 13, '0', '0', 0, 14, 1),
('EP2024100016', '', 'EV202407000606', 'EV202407000601', 2, 'EV2024070006', 34, 'JESSEN MICHAEL AIJI PRANATA', 'P', '2015-04-18', 9, '0', '0', 0, 14, 1),
('EP2024100017', '', 'EV202407000611', 'EV202407000601', 2, 'EV2024070006', 34, 'NUR ALYA IHDA SABILA ARIWIBOWO', 'P', '2012-11-18', 11, '0', '0', 0, 14, 1),
('EP2024100018', '0', 'EV202407000614', 'EV202407000603', 1, 'EV2024070006', 34, 'RATU KALEYA RAMAZAN ', 'W', '2017-06-08', 7, '0', '0', 0, 14, 1),
('EP2024100019', '', 'EV202407000607', 'EV202407000601', 1, 'EV2024070006', 34, 'Clayton Trevor Pratama', 'P', '2017-02-14', 7, '0', '0', 0, 14, 1),
('EP2024100020', '', 'EV202407000604', 'EV202407000601', 1, 'EV2024070006', 34, 'Favian Rafa Surasio', 'P', '2012-08-28', 12, '0', '0', 0, 14, 1),
('EP2024100021', '', 'EV202407000606', 'EV202407000613', 1, 'EV2024070006', 34, 'Davin Otniel', 'P', '2015-09-19', 9, '0', '0', 0, 14, 1),
('EP2024100022', '', 'EV202407000606', 'EV202407000601', 1, 'EV2024070006', 34, 'Rafael Firhot Panjaitan ', 'P', '2016-02-26', 8, '0', '0', 0, 14, 1),
('EP2024100023', '', 'EV202407000604', 'EV202407000601', 1, 'EV2024070006', 34, 'Miftahudzaky Salam ', 'P', '2012-04-20', 12, '0', '0', 0, 14, 1),
('EP2024100024', '', 'EV202407000606', 'EV202407000601', 2, 'EV2024070006', 34, 'DAVIN BELMIRO AZFAR', 'P', '2013-07-17', 11, '0', '0', 0, 14, 1),
('EP2024100025', '', 'EV202407000613', 'EV202407000601', 2, 'EV2024070006', 34, 'AZKAYRA RANIA DARMAWAN', 'W', '2016-12-04', 7, '0', '0', 0, 14, 1),
('EP2024100026', '', 'EV202407000605', 'EV202407000601', 1, 'EV2024070006', 34, 'Dafin Azka Aldric', 'P', '2013-04-22', 11, '0', '0', 0, 14, 1),
('EP2024100027', '', 'EV202407000612', 'EV202407000601', 1, 'EV2024070006', 34, 'Kevita Shakila Adiviansyah ', 'W', '2014-10-22', 10, '0', '0', 0, 14, 1),
('EP2024100028', '', 'EV202407000607', 'EV202407000601', 2, 'EV2024070006', 34, 'CRIST TANGGUH PRIO UTOMO', 'P', '2017-04-28', 7, '0', '0', 0, 14, 1),
('EP2024100029', '0', 'EV202407000611', 'EV202407000601', 2, 'EV2024070006', 34, 'Chellynn Brighlynn Handiyono', 'W', '2012-06-27', 12, '0', '0', 0, 14, 1),
('EP2024100030', '0', 'EV202407000614', 'EV202407000601', 2, 'EV2024070006', 34, 'Chlairynn Brightlynn Handiyono', 'W', '2017-09-17', 7, '0', '0', 0, 14, 1),
('EP2024100031', '', 'EV202407000601', 'EV202407000601', 2, 'EV2024070006', 34, 'DAVID CHRISTIAN', 'P', '2005-12-27', 18, '0', '0', 0, 14, 1),
('EP2024100032', '', 'EV202407000608', 'EV202407000601', 2, 'EV2024070006', 34, 'CLEARESTA ANJALIA SAKINAH', 'W', '2007-05-08', 17, '0', '0', 0, 14, 1),
('EP2024100033', '0', 'EV202407000612', 'EV202407000611', 1, 'EV2024070006', 34, 'INTAN BERLIYAN ', 'W', '2014-03-28', 10, '0', '0', 0, 14, 1),
('EP2024100034', '', 'EV202407000602', 'EV202407000613', 2, 'EV2024070006', 34, 'SAMANTHA EDITHSO', 'W', '2008-02-17', 16, '0', '0', 0, 14, 1),
('EP2024100035', '-', 'EV202407000610', 'EV202407000614', 2, 'EV2024070006', 34, 'AURA CAHYATI ALIFAN ', 'W', '2009-04-23', 15, '0', '0', 0, 14, 1),
('EP2024100036', '', 'EV202407000603', 'EV202407000601', 2, 'EV2024070006', 50, 'M.Alpha Ivan Nafis', 'P', '2009-11-15', 14, '3426', '087837167328', 0, 17, 1),
('EP2024100037', '', 'EV202407000604', 'EV202407000611', 1, 'EV2024070006', 50, 'Keenan Aldrich Kristianto', 'P', '2012-12-21', 11, '3172063112121006', '081315809670', 0, 17, 1),
('EP2024100038', '', 'EV202407000610', 'EV202407000613', 1, 'EV2024070006', 65, 'Bambang', 'P', '2010-06-09', 14, '111', '1111', 0, 9, 1),
('EP2024100039', '', 'EV202407000613', 'EV202407000601', 1, 'EV2024070006', 34, 'Shofiatuniswa', 'W', '2015-11-05', 8, '0', '0', 0, 14, 1),
('EP2024100041', '', 'EV202407000604', 'EV202407000601', 1, 'EV2024070006', 50, 'Kenzie Liangyi Soegiarto', 'P', '2011-07-29', 13, '0112472399', '081916765737', 0, 17, 1),
('EP2024100042', '', 'EV202407000604', 'EV202407000601', 2, 'EV2024070006', 50, 'Leon Sky Sutrisno Tjiang', 'P', '2012-12-25', 11, '5201732512120001', '08123756416', 0, 17, 1),
('EP2024100046', '', 'EV202407000623', 'EV202407000608', 2, 'EV2024070006', 50, 'Miftahurrahman', 'P', '1968-12-31', 55, '5203073112680169', '082359263690', 0, 17, 1),
('EP2024100047', '', 'EV202407000622', 'EV202407000608', 2, 'EV2024070006', 50, 'Hadi Sutrisno', 'P', '1976-10-24', 48, '5271032410260001', '08123756416', 0, 17, 1),
('EP2024100054', '-', 'EV202407000612', 'EV202407000601', 1, 'EV2024070006', 41, 'SHAKILA FAHRIHAN HUSNI', 'W', '2013-08-17', 11, '6171', '085753596383', 0, 24, 1),
('EP2024100055', '0', 'EV202407000605', 'EV202407000601', 1, 'EV2024070006', 41, 'VINCENT RICARDO EDVIN', 'P', '2013-09-22', 11, '6171', '085753596383', 0, 24, 1),
('EP2024100056', '', 'EV202407000606', 'EV202407000611', 2, 'EV2024070006', 41, 'JUSTIN TAN', 'P', '2016-01-28', 8, '6171', '085753596383', 0, 24, 1),
('EP2024100057', '0', 'EV202407000607', 'EV202407000601', 2, 'EV2024070006', 41, 'EDRICK RICARDO EDVIN', 'P', '2017-01-22', 7, '6171', '085753596383', 0, 24, 1),
('EP2024100058', '', 'EV202407000614', 'EV202407000601', 1, 'EV2024070006', 41, 'GLADYS KASAN HIDAYAT', 'W', '2017-09-02', 7, '6171', '085753596383', 0, 24, 1),
('EP2024100059', '', 'EV202407000623', 'EV202407000608', 1, 'EV2024070006', 41, 'DERRY YULIANTO, S.Hut', 'P', '1976-07-27', 48, '6171', '085753596383', 0, 24, 1),
('EP2024100060', '', 'EV202407000624', 'EV202407000608', 1, 'EV2024070006', 41, 'HAMDANI FA. PNP', 'P', '1974-06-09', 50, '6171', '085753596383', 0, 24, 1),
('EP2024100061', '0', 'EV202407000622', 'EV202407000608', 2, 'EV2024070006', 41, 'EDI HARDIANTEK', 'P', '1974-01-01', 50, '6171', '085753596383', 0, 24, 1),
('EP2024100062', '', 'EV202407000622', 'EV202407000608', 2, 'EV2024070006', 41, 'JONNY, S.KOM', 'P', '1976-01-01', 48, '6171', '085753596383', 0, 24, 1),
('EP2024100063', '-', 'EV202407000622', 'EV202407000608', 1, 'EV2024070006', 41, 'YULITA SRI HANDAYANI', 'W', '1980-01-01', 44, '6171', '085753596383', 0, 24, 1),
('EP2024100064', '', 'EV202407000622', 'EV202407000608', 1, 'EV2024070006', 41, 'SOFIAN KASAN HIDAYAT', 'P', '1988-01-01', 36, '6171', '085753596383', 0, 24, 1),
('EP2024100065', '', 'EV202407000622', 'EV202407000608', 1, 'EV2024070006', 41, 'CECILIA SRI HANDAYANI', 'W', '1991-01-01', 33, '6171', '085753596383', 0, 24, 1),
('EP2024100067', '-', 'EV202407000603', 'EV202407000601', 2, 'EV2024070006', 60, 'Taufik Defasya Eda', 'P', '2009-12-02', 15, '00', '00', 0, 26, 1),
('EP2024100074', '', 'EV202407000613', 'EV202407000601', 1, 'EV2024070006', 44, 'Cakrawala Nur Fatwa', 'W', '2015-02-05', 9, '00', '00', 0, 23, 1),
('EP2024100075', '', 'EV202407000605', 'EV202407000601', 1, 'EV2024070006', 44, 'Andi Daffa Alfarabi ', 'P', '2013-05-19', 11, '00', '00', 0, 23, 1),
('EP2024100076', '', 'EV202407000611', 'EV202407000601', 1, 'EV2024070006', 44, 'Alifakih Arrasyaa Hadikusuma', 'P', '2012-02-10', 12, '00', '00', 0, 23, 1),
('EP2024100077', '', 'EV202407000602', 'EV202407000601', 1, 'EV2024070006', 44, 'Andi Muhammad Syahrul Novandra', 'P', '2007-11-18', 16, '00', '00', 0, 23, 1),
('EP2024100078', '-', 'EV202407000603', 'EV202407000601', 1, 'EV2024070006', 44, 'Al Fayed Maxwell G', 'P', '2008-11-15', 15, '00', '00', 0, 23, 1),
('EP2024110001', '21392', 'EV202407000610', 'EV202407000601', 2, 'EV2024070006', 60, ' Velin Trienjel Putri ', 'W', '2009-02-11', 15, '0801085102090003', '083802509937', 0, 26, 1),
('EP2024110002', '-', 'EV202407000603', 'EV202407000601', 2, 'EV2024070006', 60, 'DARRELL FAWWAZ SATRIA ANANTIO', 'P', '2009-04-09', 15, '3315120904090004', '08155778111', 0, 26, 1),
('EP2024110003', '-', 'EV202407000604', 'EV202407000601', 2, 'EV2024070006', 60, 'RAHIS BITNANSYAH', 'P', '2012-04-09', 12, '3504100904120001', '081216673036', 0, 26, 1),
('EP2024110004', '-', 'EV202407000605', 'EV202407000601', 2, 'EV2024070006', 60, 'Nicolas Ray Chiupratama', 'P', '2013-07-27', 11, '7315116707130001', '081332332716', 0, 26, 1),
('EP2024110006', '0', 'EV202407000601', 'EV202407000601', 1, 'EV2024070006', 39, 'MUHAMMAD AL FARISI', 'P', '2006-03-20', 18, '6301032003060004', '081349719667', 0, 29, 1),
('EP2024110007', '1642', 'EV202407000602', 'EV202407000601', 2, 'EV2024070006', 39, 'MUHAMMAD FAKHRI AINI', 'P', '2008-08-20', 16, '6371022008080004', '08875338478', 0, 29, 1),
('EP2024110008', '1844', 'EV202407000603', 'EV202407000601', 2, 'EV2024070006', 39, 'AHMAD RIFA\'I', 'P', '2010-12-29', 13, '6372042912100002', '081349719667', 0, 29, 1),
('EP2024110009', '0', 'EV202407000601', 'EV202407000614', 1, 'EV2024070006', 37, 'MP. KARUNIA BAGUS TRI LAKSA, ', 'P', '2006-10-30', 18, '0', '0', 0, 12, 1),
('EP2024110010', '0', 'EV202407000601', 'EV202407000601', 1, 'EV2024070006', 37, 'RAMANDA TIKNO KUSUMA', 'P', '2006-02-02', 18, '0', '0', 0, 12, 1),
('EP2024110011', '0', 'EV202407000601', 'EV202407000601', 1, 'EV2024070006', 37, 'JANUAR ADITYA PRADANA', 'P', '2005-01-26', 19, '0', '0', 0, 12, 1),
('EP2024110012', '0', 'EV202407000602', 'EV202407000601', 1, 'EV2024070006', 37, 'ZAGAR RASYAAD SYAHDHI YAULAHAQ', 'P', '2007-05-25', 17, '0', '0', 0, 12, 1),
('EP2024110013', '0', 'EV202407000602', 'EV202407000601', 1, 'EV2024070006', 37, 'RADIF YUSUF RAHMADANI', 'P', '2008-09-26', 16, '0', '0', 0, 12, 1),
('EP2024110014', '0', 'EV202407000602', 'EV202407000601', 1, 'EV2024070006', 37, 'SOFYAN AHMAD ZAINI', 'P', '2008-06-18', 16, '0', '0', 0, 12, 1),
('EP2024110015', '0', 'EV202407000601', 'EV202407000601', 1, 'EV2024070006', 37, 'A.F. ROBITH DZAMIIRROWDAK AL F', 'P', '2009-08-02', 15, '0', '0', 0, 12, 1),
('EP2024110016', '0', 'EV202407000603', 'EV202407000601', 1, 'EV2024070006', 37, 'ANDRA WIJAYA', 'P', '2009-12-14', 14, '0', '0', 0, 12, 1),
('EP2024110017', '0', 'EV202407000603', 'EV202407000601', 1, 'EV2024070006', 37, 'ARTHUR DZIKRU SAIFUNNAWAS', 'P', '2010-08-22', 14, '0', '0', 0, 12, 1),
('EP2024110018', '0', 'EV202407000603', 'EV202407000601', 1, 'EV2024070006', 37, 'SYAUKI AL AYYUBI IRIAWAN', 'P', '2010-03-13', 14, '0', '0', 0, 12, 1),
('EP2024110019', '0', 'EV202407000603', 'EV202407000614', 1, 'EV2024070006', 37, 'MP. RAHMAT HANAFI', 'P', '2010-01-26', 14, '0', '0', 0, 12, 1),
('EP2024110020', '0', 'EV202407000603', 'EV202407000614', 1, 'EV2024070006', 37, ' MP. ARJUNA SATRIA PAMUNGKAS', 'P', '2009-07-04', 15, '0', '0', 0, 12, 1),
('EP2024110021', '0', 'EV202407000603', 'EV202407000601', 1, 'EV2024070006', 37, 'NAZURA ZHAFRAN SUNURIHA', 'P', '2010-02-21', 14, '0', '0', 0, 12, 1),
('EP2024110022', '0', 'EV202407000604', 'EV202407000614', 1, 'EV2024070006', 37, ' MP. AS. SYAHSYAH SYAKISH THIR', 'P', '2011-01-22', 13, '0', '0', 0, 12, 1),
('EP2024110023', '0', 'EV202407000604', 'EV202407000601', 1, 'EV2024070006', 37, 'NARAYA MULYA WICAKSANA', 'P', '2012-03-30', 12, '0', '0', 0, 12, 1),
('EP2024110024', '0', 'EV202407000604', 'EV202407000601', 1, 'EV2024070006', 37, 'BATUTAH RATRI ABABIL', 'P', '2011-04-30', 13, '0', '0', 0, 12, 1),
('EP2024110025', '0', 'EV202407000604', 'EV202407000601', 1, 'EV2024070006', 37, 'FITSAL ASWA MUZAFKAR', 'P', '2012-03-29', 12, '0', '0', 0, 12, 1),
('EP2024110027', '0', 'EV202407000604', 'EV202407000601', 1, 'EV2024070006', 37, 'WILDAN BAGUS RAHMANDA', 'P', '2012-11-10', 11, '0', '0', 0, 12, 1),
('EP2024110028', '0', 'EV202407000604', 'EV202407000601', 1, 'EV2024070006', 37, 'ABDULLOH ARIF PUTRA PRATAMA', 'P', '2011-04-23', 13, '0', '0', 0, 12, 1),
('EP2024110029', '0', 'EV202407000605', 'EV202407000601', 1, 'EV2024070006', 37, 'DAVIAN ARPEGGIO ABDILLAH', 'P', '2013-08-14', 11, '0', '0', 0, 12, 1),
('EP2024110030', '0', 'EV202407000605', 'EV202407000601', 1, 'EV2024070006', 37, 'ALFAN ROSYID ABDULLOH MU\'THY', 'P', '2013-07-08', 11, '0', '0', 0, 12, 1),
('EP2024110031', '0', 'EV202407000605', 'EV202407000601', 1, 'EV2024070006', 37, 'MUHAMMAD DZAKIYUL AHNAFI ALMAF', 'P', '2014-11-27', 9, '0', '0', 0, 12, 1),
('EP2024110032', '0', 'EV202407000605', 'EV202407000601', 1, 'EV2024070006', 37, 'ADYATMA ALKATIRI PUTRA SETIAWA', 'P', '2013-09-14', 11, '0', '0', 0, 12, 1),
('EP2024110033', '0', 'EV202407000605', 'EV202407000601', 1, 'EV2024070006', 37, 'MUHAMMAD ZHAFRAN ATHALLAH IRAW', 'P', '2014-06-06', 10, '0', '0', 0, 12, 1),
('EP2024110034', '0', 'EV202407000605', 'EV202407000601', 1, 'EV2024070006', 37, 'KILLIAN YANG', 'P', '2013-08-19', 11, '0', '0', 0, 12, 1),
('EP2024110035', '0', 'EV202407000606', 'EV202407000601', 1, 'EV2024070006', 37, 'DANTE OHANA CHONDRO', 'P', '2015-10-08', 9, '0', '0', 0, 12, 1),
('EP2024110036', '0', 'EV202407000606', 'EV202407000601', 1, 'EV2024070006', 37, 'MUHAMMAD ILYAS', 'P', '2015-07-25', 9, '0', '0', 0, 12, 1),
('EP2024110037', '0', 'EV202407000606', 'EV202407000601', 1, 'EV2024070006', 37, 'ABID MUHAMMAD IZYAN', 'P', '2015-01-06', 9, '0', '0', 0, 12, 1),
('EP2024110038', '0', 'EV202407000606', 'EV202407000601', 1, 'EV2024070006', 37, 'ATHAYA TAQIY HAMIZAN', 'P', '2015-07-23', 9, '0', '0', 0, 12, 1),
('EP2024110039', '0', 'EV202407000606', 'EV202407000601', 1, 'EV2024070006', 37, 'ZULFANI FIRDAUS', 'P', '2016-04-07', 8, '0', '0', 0, 12, 1),
('EP2024110040', '0', 'EV202407000601', 'EV202407000601', 1, 'EV2024070006', 37, 'LUIGI KAUTSARRAZKY', 'P', '2016-02-18', 8, '0', '0', 0, 12, 1),
('EP2024110041', '0', 'EV202407000607', 'EV202407000601', 1, 'EV2024070006', 37, 'ARZANKA EINER TANJUNG', 'P', '2017-01-23', 7, '0', '0', 0, 12, 1),
('EP2024110042', '0', 'EV202407000607', 'EV202407000601', 1, 'EV2024070006', 37, 'ABDUL RAHMAT DANI', 'P', '2017-02-08', 7, '0', '0', 0, 12, 1),
('EP2024110043', '0', 'EV202407000607', 'EV202407000601', 1, 'EV2024070006', 37, 'DWI RACHA ARSYAD SAGUFTA', 'P', '2017-05-25', 7, '0', '0', 0, 12, 1),
('EP2024110044', '0', 'EV202407000608', 'EV202407000601', 1, 'EV2024070006', 37, 'NISRIINA ALMAAS TSABITA', 'W', '2005-08-09', 19, '0', '0', 0, 12, 1),
('EP2024110045', '0', 'EV202407000608', 'EV202407000601', 1, 'EV2024070006', 37, 'INDAH NURUL LAILI', 'W', '2005-01-20', 19, '0', '0', 0, 12, 1),
('EP2024110046', '0', 'EV202407000608', 'EV202407000611', 1, 'EV2024070006', 37, 'WMN. ALLODYERA KAYLAVI CELLO N', 'W', '2007-05-28', 17, '0', '0', 0, 12, 1),
('EP2024110048', '0', 'EV202407000609', 'EV202407000614', 1, 'EV2024070006', 37, 'MN. SALWA NADIA MAHARANI', 'W', '2007-01-10', 17, '0', '0', 0, 12, 1),
('EP2024110049', '0', 'EV202407000609', 'EV202407000601', 1, 'EV2024070006', 37, 'AUBREY QUEENA PUTRI SANTIKO', 'W', '2008-01-29', 16, '0', '0', 0, 12, 1),
('EP2024110050', '0', 'EV202407000610', 'EV202407000601', 1, 'EV2024070006', 37, 'NAJWA BILQIS BILBINA MUKTI', 'W', '2009-07-04', 15, '0', '0', 0, 12, 1),
('EP2024110051', '0', 'EV202407000610', 'EV202407000601', 1, 'EV2024070006', 37, 'VANIA FRADELLA MAYRA SHAFA', 'W', '2009-05-27', 15, '0', '0', 0, 12, 1),
('EP2024110052', '0', 'EV202407000610', 'EV202407000601', 1, 'EV2024070006', 37, 'FREYA GRISELDA FAIHA', 'W', '2010-02-08', 14, '0', '0', 0, 12, 1),
('EP2024110053', '0', 'EV202407000610', 'EV202407000601', 1, 'EV2024070006', 37, 'TITAH GAYATRI', 'W', '2009-05-13', 15, '0', '0', 0, 12, 1),
('EP2024110054', '0', 'EV202407000610', 'EV202407000601', 1, 'EV2024070006', 37, 'CIAYI KHANESTI PUTRI ARIMBI', 'W', '2009-10-01', 15, '0', '0', 0, 12, 1),
('EP2024110055', '0', 'EV202407000610', 'EV202407000601', 1, 'EV2024070006', 37, 'ALVIRA YOSHI ROSANINDYA ANDRIA', 'W', '2009-07-08', 15, '0', '0', 0, 12, 1),
('EP2024110056', '0', 'EV202407000611', 'EV202407000601', 1, 'EV2024070006', 37, 'CLARETTA NATHANIA HANDOKO', 'W', '2011-09-26', 13, '0', '0', 0, 12, 1),
('EP2024110057', '0', 'EV202407000611', 'EV202407000601', 1, 'EV2024070006', 37, 'ABIGAIL FINLADY MELLY QUEEN TA', 'W', '2012-02-24', 12, '0', '0', 0, 12, 1),
('EP2024110061', '0', 'EV202407000612', 'EV202407000601', 1, 'EV2024070006', 37, 'NAZIRA ASY QISYA', 'W', '2013-01-10', 11, '0', '0', 0, 12, 1),
('EP2024110062', '0', 'EV202407000612', 'EV202407000601', 1, 'EV2024070006', 37, 'APSARA PUTRI PERTIWI', 'W', '2013-05-24', 11, '0', '0', 0, 12, 1),
('EP2024110063', '0', 'EV202407000612', 'EV202407000601', 1, 'EV2024070006', 37, 'NURAQEELA CALLISTA NAURA', 'W', '2013-04-25', 11, '0', '0', 0, 12, 1),
('EP2024110064', '0', 'EV202407000612', 'EV202407000601', 1, 'EV2024070006', 37, 'WAVINA KAMITA PUTRI', 'W', '2014-03-12', 10, '0', '0', 0, 12, 1),
('EP2024110065', '0', 'EV202407000612', 'EV202407000601', 1, 'EV2024070006', 37, 'DAFINA WIDYA ACHA ANGGRAENI', 'W', '2013-05-23', 11, '0', '0', 0, 12, 1),
('EP2024110066', '0', 'EV202407000613', 'EV202407000611', 1, 'EV2024070006', 37, 'WMP. VERONICA JEFANY SHERYL KI', 'W', '2015-06-11', 9, '0', '0', 0, 12, 1),
('EP2024110067', '0', 'EV202407000613', 'EV202407000601', 1, 'EV2024070006', 37, 'ASTI SEKARING IDEA', 'W', '2015-04-13', 9, '0', '0', 0, 12, 1),
('EP2024110068', '0', 'EV202407000613', 'EV202407000601', 1, 'EV2024070006', 37, 'AZZAHRA KAMILA JOY', 'W', '2015-04-13', 9, '0', '0', 0, 12, 1),
('EP2024110069', '0', 'EV202407000613', 'EV202407000601', 1, 'EV2024070006', 37, '\'AINAYYA FATHIYYATURAHMA', 'W', '2016-10-10', 8, '0', '0', 0, 12, 1),
('EP2024110070', '0', 'EV202407000613', 'EV202407000601', 1, 'EV2024070006', 37, 'ALYSSA ARDENA PUTRI SANTIKO', 'W', '2015-07-27', 9, '0', '0', 0, 12, 1),
('EP2024110071', '0', 'EV202407000613', 'EV202407000601', 1, 'EV2024070006', 37, 'NAYLA AQILA AZHARI', 'W', '2015-09-13', 9, '0', '0', 0, 12, 1),
('EP2024110072', '0', 'EV202407000614', 'EV202407000601', 1, 'EV2024070006', 37, 'MAHAESWARI ANANDYA TITIH SAKTI', 'W', '2017-08-09', 7, '0', '0', 0, 12, 1),
('EP2024110073', '0', 'EV202407000614', 'EV202407000601', 1, 'EV2024070006', 37, 'NARESWARI RATU MULYASARI', 'W', '2017-07-26', 7, '0', '0', 0, 12, 1),
('EP2024110074', '0', 'EV202407000614', 'EV202407000601', 1, 'EV2024070006', 37, 'NADHIFA AZALIA NUR MARITZA', 'W', '2017-03-18', 7, '0', '0', 0, 12, 1),
('EP2024110075', '0', 'EV202407000614', 'EV202407000601', 1, 'EV2024070006', 37, 'DAMARIS ZAHRA RAMADHANI', 'W', '2017-05-27', 7, '0', '0', 0, 12, 1),
('EP2024110076', '0', 'EV202407000614', 'EV202407000601', 1, 'EV2024070006', 37, 'ASSYIFA RAMADHANIA PUTRI SANTI', 'W', '2017-05-23', 7, '0', '0', 0, 12, 1),
('EP2024110077', '0', 'EV202407000614', 'EV202407000601', 1, 'EV2024070006', 37, 'NURIA KAISA HANNANI', 'P', '2019-07-28', 5, '0', '0', 0, 12, 1),
('EP2024110078', '0', 'EV202407000623', 'EV202407000608', 1, 'EV2024070006', 37, 'Drs. FARHAN ZAKI, M.Pd.', 'P', '1963-12-22', 60, '0', '0', 0, 12, 1),
('EP2024110079', '0', 'EV202407000624', 'EV202407000608', 1, 'EV2024070006', 37, 'JUNAIDI HARAHAP, A.Md.Par. WNP', 'P', '1969-10-31', 55, '0', '0', 0, 12, 1),
('EP2024110080', '0', 'EV202407000623', 'EV202407000608', 1, 'EV2024070006', 37, 'Dr.H ACHMAD FAUZI WONGSOJUDO. ', 'P', '1975-01-01', 49, '0', '0', 0, 12, 1),
('EP2024110081', '0', 'EV202407000618', 'EV202407000605', 1, 'EV2024070006', 37, 'IQRA MOESA PUTRA', 'P', '1977-09-01', 47, '0', '0', 0, 12, 1),
('EP2024110082', '0', 'EV202407000615', 'EV202407000604', 1, 'EV2024070006', 37, 'EKA SISILIA', 'W', '2004-03-04', 20, '0', '0', 0, 12, 1),
('EP2024110083', '0', 'EV202407000615', 'EV202407000604', 1, 'EV2024070006', 37, 'MUHAMMAD SUPRIYADI', 'P', '1995-05-14', 29, '0', '0', 0, 12, 1),
('EP2024110084', '0', 'EV202407000615', 'EV202407000604', 1, 'EV2024070006', 37, 'DANIEL WIJAYA', 'P', '2006-03-19', 18, '0', '0', 0, 12, 1),
('EP2024110085', '0', 'EV202407000615', 'EV202407000604', 1, 'EV2024070006', 37, 'AMELIA AMANDA', 'W', '2003-05-15', 21, '0', '0', 0, 12, 1),
('EP2024110086', '0', 'EV202407000618', 'EV202407000605', 1, 'EV2024070006', 37, 'CALVIN KRESNA AFANDY', 'P', '1998-04-16', 26, '0', '0', 0, 12, 1),
('EP2024110087', '0', 'EV202407000615', 'EV202407000604', 1, 'EV2024070006', 37, 'FARHAN YUNUS AMINUDIN', 'P', '1999-11-05', 24, '0', '0', 0, 12, 1),
('EP2024110088', '0', 'EV202407000615', 'EV202407000604', 1, 'EV2024070006', 37, 'MOCHAMAD ALFI FATHONI', 'P', '1992-02-27', 32, '0', '0', 0, 12, 1),
('EP2024110089', '0', 'EV202407000615', 'EV202407000604', 1, 'EV2024070006', 37, 'FIRMAN CAHYADI', 'P', '1996-04-24', 28, '0', '0', 0, 12, 1),
('EP2024110090', '0', 'EV202407000615', 'EV202407000604', 1, 'EV2024070006', 37, 'EKO UTOMO', 'P', '1972-10-27', 52, '0', '0', 0, 12, 1),
('EP2024110091', '0', 'EV202407000618', 'EV202407000605', 1, 'EV2024070006', 37, 'ABABIL', 'P', '1978-04-11', 46, '0', '0', 0, 12, 1),
('EP2024110092', '1712', 'EV202407000613', 'EV202407000609', 1, 'EV2024070006', 35, 'AFIFAH FATHIYYATU RAHMAH', 'W', '2016-02-03', 8, '00', '081337319787', 0, 16, 1),
('EP2024110093', '1833', 'EV202407000603', 'EV202407000609', 1, 'EV2024070006', 35, 'SEBASTIAN ALEXANDER EKA CAHYAN', 'P', '2009-09-26', 15, '00', '00', 0, 16, 1),
('EP2024110094', '0000', 'EV202407000604', 'EV202407000609', 1, 'EV2024070006', 35, 'ABIMANYU SETYAWAN RIYANTO', 'P', '2011-04-17', 13, '00', '00', 0, 16, 1),
('EP2024110095', '1785', 'EV202407000610', 'EV202407000609', 1, 'EV2024070006', 35, 'SALSABILA DWI AULIANY', 'W', '2010-10-16', 14, '00', '00', 0, 16, 1),
('EP2024110096', '1898', 'EV202407000609', 'EV202407000609', 1, 'EV2024070006', 35, 'ARMENIA ZENDY PURWANTO', 'W', '2007-04-23', 17, '00', '00', 0, 16, 1),
('EP2024110097', '1823', 'EV202407000611', 'EV202407000609', 1, 'EV2024070006', 35, 'ISNA KHOIRUN NISA', 'W', '2011-03-23', 13, '00', '00', 0, 16, 1),
('EP2024110098', '0000', 'EV202407000612', 'EV202407000609', 1, 'EV2024070006', 35, 'CLARETTA MAGNOLIA QUEENA', 'W', '2014-06-03', 10, '00', '00', 0, 16, 1),
('EP2024110099', '1857', 'EV202407000602', 'EV202407000609', 1, 'EV2024070006', 35, 'M. ILHAM RIZKY MAULANA', 'P', '2008-03-24', 16, '00', '00', 0, 16, 1),
('EP2024110100', '1707', 'EV202407000604', 'EV202407000603', 1, 'EV2024070006', 35, 'RAMA DANISWARA SETYA NUGRAHA', 'P', '2011-01-08', 13, '00', '00', 0, 16, 1),
('EP2024110101', '0000', 'EV202407000614', 'EV202407000601', 1, 'EV2024070006', 35, 'RUMAISHA AL-HUSNA FAKHRUROJI', 'W', '2017-02-06', 7, '00', '085600450719', 0, 16, 1),
('EP2024110102', '1728', 'EV202407000603', 'EV202407000601', 1, 'EV2024070006', 35, 'MUHAMAD KHAIRUL SIDDIQ', 'P', '2009-01-16', 15, '00', '00', 0, 16, 1),
('EP2024110103', '1710', 'EV202407000603', 'EV202407000606', 1, 'EV2024070006', 35, 'HIKAM ATHOILLAH', 'P', '2010-07-06', 14, '00', '00', 0, 16, 1),
('EP2024110104', '0000', 'EV202407000607', 'EV202407000601', 1, 'EV2024070006', 35, 'ABIDILLAH', 'P', '2018-03-23', 6, '00', '00', 0, 16, 1),
('EP2024110105', '1749', 'EV202407000610', 'EV202407000601', 1, 'EV2024070006', 35, 'HYANG AYU PRAMANA SUKSMA', 'W', '2010-04-06', 14, '00', '00', 0, 16, 1),
('EP2024110106', '0000', 'EV202407000612', 'EV202407000601', 1, 'EV2024070006', 35, 'GITA SIRRUL KHURIYAH', 'W', '2014-03-22', 10, '00', '00', 0, 16, 1),
('EP2024110107', '0000', 'EV202407000614', 'EV202407000601', 2, 'EV2024070006', 35, 'VANESSA KOOLIN SANTOSO', 'W', '2017-05-16', 7, '00', '00', 0, 16, 1),
('EP2024110108', '0000', 'EV202407000605', 'EV202407000601', 1, 'EV2024070006', 35, 'MUHAMAD RAIF OKTIANDO', 'P', '2014-10-07', 10, '00', '0', 0, 16, 1),
('EP2024110109', '00', 'EV202407000606', 'EV202407000601', 1, 'EV2024070006', 38, 'Kadek Prabha Wiguna', 'P', '2015-12-29', 8, '5108072912150002', '087762980086', 0, 19, 1),
('EP2024110110', '00', 'EV202407000612', 'EV202407000601', 1, 'EV2024070006', 38, 'Putu Paramitha Parameswari', 'W', '2014-06-13', 10, '5108075306140003', '087762980086', 0, 19, 1),
('EP2024110111', '00', 'EV202407000618', 'EV202407000605', 1, 'EV2024070006', 38, 'Putu Arya Kusumayasa', 'P', '1989-06-06', 35, '5108070606890004', '087762980086', 0, 19, 1),
('EP2024110112', '13195', 'EV202407000618', 'EV202407000605', 2, 'EV2024070006', 38, 'I Ketut Sana Widiantara', 'P', '1973-07-21', 51, '5103052107730008', '087712990828', 0, 19, 1),
('EP2024110114', '00000', 'EV202407000615', 'EV202407000604', 1, 'EV2024070006', 32, '	Ligor P Tampubolon', 'P', '1968-05-04', 56, '3172060405680010', '081210310600', 0, 30, 1),
('EP2024110115', '0', 'EV202407000610', 'EV202407000602', 1, 'EV2024070006', 36, 'Shifania Aulia Cahyono', 'W', '2010-03-09', 14, '3323074903100001', '081990005757', 0, 15, 1),
('EP2024110116', '0', 'EV202407000613', 'EV202407000601', 1, 'EV2024070006', 36, 'Runa Yulistira', 'W', '2016-07-14', 8, '3306085407160002', '085647777774', 0, 15, 1),
('EP2024110117', '0', 'EV202407000606', 'EV202407000602', 1, 'EV2024070006', 36, 'Banyu Wiguno Wening', 'P', '2015-10-21', 9, '3471082110150001', '082273747577', 0, 15, 1),
('EP2024110118', '0', 'EV202407000614', 'EV202407000601', 2, 'EV2024070006', 36, 'Pangestika Nirmala Wening', 'W', '2018-10-10', 6, '3471085010180001', '082273747577', 0, 15, 1),
('EP2024110119', '0', 'EV202407000604', 'EV202407000601', 2, 'EV2024070006', 36, 'Alamsyah Noor Hakim', 'P', '2011-09-07', 13, '3404060709110001', '087839646703', 0, 15, 1),
('EP2024110120', '0', 'EV202407000603', 'EV202407000602', 1, 'EV2024070006', 36, 'Muhammad Ali Alfaruq', 'P', '2010-06-26', 14, '3471132606100002', '089674235290', 0, 15, 1),
('EP2024110121', '00000', 'EV202407000607', 'EV202407000601', 1, 'EV2024070006', 32, 'Muhammad Hadziq Arianto', 'P', '2017-05-03', 7, '3173080305170000', '081287361545', 0, 30, 1),
('EP2024110122', '0', 'EV202407000605', 'EV202407000611', 2, 'EV2024070006', 36, 'Miko Vincnsius Firrery Zega', 'P', '2015-04-18', 9, '3404061804150001', '082324965713', 0, 15, 1),
('EP2024110123', '00000', 'EV202407000614', 'EV202407000601', 1, 'EV2024070006', 32, 'Sinan Aghayu', 'W', '2017-11-29', 6, '3603206911170000', '081286340000', 0, 30, 1),
('EP2024110124', '0', 'EV202407000610', 'EV202407000601', 2, 'EV2024070006', 36, 'Jessica Angelia', 'W', '2010-03-31', 14, '3471027103100002', '081804077747', 0, 15, 1),
('EP2024110125', '0', 'EV202407000605', 'EV202407000601', 2, 'EV2024070006', 36, 'Muhammad Gavin Mahardika', 'P', '2014-02-25', 10, '3471092502140002', '085868586858', 0, 15, 1),
('EP2024110126', '0', 'EV202407000607', 'EV202407000601', 1, 'EV2024070006', 36, 'Nathanael Juven Arkananta', 'P', '2017-07-19', 7, '3402161907170001', '087838311576', 0, 15, 1),
('EP2024110127', '0', 'EV202407000613', 'EV202407000601', 2, 'EV2024070006', 36, 'Ahza Naya Kinanti', 'W', '2015-04-26', 9, '3404076604150001', '087838234519', 0, 15, 1),
('EP2024110128', '0', 'EV202407000603', 'EV202407000601', 1, 'EV2024070006', 36, 'Genta Adyatma Jatmika', 'P', '2010-12-31', 14, '3471083112100003', '082131568844', 0, 15, 1),
('EP2024110129', '-', 'EV202407000604', 'EV202407000601', 1, 'EV2024070006', 49, 'Brilian Omega Robot', 'P', '2011-10-05', 13, '710701181011000', '085823761260', 0, 32, 1),
('EP2024110130', '00000', 'EV202407000605', 'EV202407000601', 1, 'EV2024070006', 32, 'Panji Prasetyo Adhi', 'P', '2013-07-25', 11, '2171032507130000', '081519802010', 0, 30, 1),
('EP2024110131', '0', 'EV202407000604', 'EV202407000601', 1, 'EV2024070006', 36, 'Bagus Putra Prasetya', 'P', '2011-04-14', 13, '3404121404110002', '081931708465', 0, 15, 1),
('EP2024110132', '0', 'EV202407000615', 'EV202407000604', 2, 'EV2024070006', 36, 'Isdi Raharja', 'P', '1970-08-12', 54, '3402011208700004', '08973961313', 0, 15, 1),
('EP2024110133', '0', 'EV202407000611', 'EV202407000601', 2, 'EV2024070006', 36, 'Chavi Alisha Egbert Dawn', 'W', '2012-08-23', 12, '3404066308120003', '0895616961666', 0, 15, 1),
('EP2024110134', '00000', 'EV202407000606', 'EV202407000601', 1, 'EV2024070006', 32, 'Roja Fajar Muhammad', 'P', '2014-11-06', 9, ' 360429430687000', '081519802010', 0, 30, 1),
('EP2024110135', '00000', 'EV202407000606', 'EV202407000601', 1, 'EV2024070006', 32, 'Jordan Ferdinand Tan', 'P', '2015-10-09', 9, '3603190910150000', '081519802010', 0, 30, 1),
('EP2024110136', '21478', 'EV202407000606', 'EV202407000601', 1, 'EV2024070006', 32, 'Edson Maxy Wiryanto', 'P', '2015-03-05', 9, '3171010503151000', '081288005510', 0, 30, 1),
('EP2024110137', '0', 'EV202407000622', 'EV202407000608', 2, 'EV2024070006', 36, 'Isrori Teguh Apriyanto, S.Pd', 'P', '1986-04-13', 38, '3403101304860001', '087838234519', 0, 15, 1),
('EP2024110138', '00000', 'EV202407000613', 'EV202407000601', 1, 'EV2024070006', 32, 'Ayasofya Medina', 'W', '2015-07-15', 9, '3603205307150000', '081519802010', 0, 30, 1),
('EP2024110139', '0', 'EV202407000604', 'EV202407000601', 2, 'EV2024070006', 36, 'Pasha Virendra Arifaisal', 'P', '2011-01-29', 13, '3515182901110001', '089699180207', 0, 15, 1),
('EP2024110140', '00000', 'EV202407000605', 'EV202407000601', 1, 'EV2024070006', 32, 'Khafif Dwi Yusron', 'P', '2014-04-27', 10, '3603202704140000', '081519802010', 0, 30, 1),
('EP2024110141', '00000', 'EV202407000612', 'EV202407000601', 1, 'EV2024070006', 32, 'Aqilla Syaira Hardian', 'W', '2013-03-07', 11, '36710847031300', '081519802010', 0, 30, 1),
('EP2024110142', '00000', 'EV202407000612', 'EV202407000601', 1, 'EV2024070006', 32, 'Cut, Laudya Athifa', 'W', '2014-04-19', 10, '3173085904141000', '081519802010', 0, 30, 1),
('EP2024110143', '0', 'EV202407000602', 'EV202407000601', 2, 'EV2024070006', 36, 'Steven Lionell Alfandy', 'P', '2008-05-01', 16, '3404080105080001', '081327104835', 0, 15, 1),
('EP2024110144', '00000', 'EV202407000604', 'EV202407000601', 1, 'EV2024070006', 32, 'Difki  Etanade Putra				', 'P', '2011-12-05', 12, '3671080512110000', '081519802010', 0, 30, 1),
('EP2024110145', '00000', 'EV202407000611', 'EV202407000601', 1, 'EV2024070006', 32, 'Alisha Batrisyia Aimy Mustofa	', 'W', '2011-06-27', 13, '3276110803090000', '081519802010', 0, 30, 1),
('EP2024110146', '00000', 'EV202407000611', 'EV202407000601', 1, 'EV2024070006', 32, 'Kaira Djati Supardja				', 'W', '2012-04-23', 12, '3174056304121000', '081519802010', 0, 30, 1),
('EP2024110147', '00000', 'EV202407000604', 'EV202407000601', 1, 'EV2024070006', 32, 'Putri Ulya Wulansari				', 'W', '2012-05-27', 12, '3603126705120004', '081519802010', 0, 30, 1),
('EP2024110148', '00000', 'EV202407000604', 'EV202407000601', 1, 'EV2024070006', 32, 'Puput Ulya Wulansari				', 'P', '2012-05-27', 12, '3603126705120003', '081519802010', 0, 30, 1),
('EP2024110151', '0', 'EV202407000605', 'EV202407000602', 1, 'EV2024070006', 36, 'Kenny Horasino Bach', 'P', '2013-08-13', 11, '3404071308130002', '081227115099', 0, 15, 1),
('EP2024110154', '0', 'EV202407000603', 'EV202407000601', 2, 'EV2024070006', 36, 'Raja Ferdinand Abraham', 'P', '2009-11-16', 14, '3404071611090001', '081227115099', 0, 15, 1),
('EP2024110155', '00000', 'EV202407000622', 'EV202407000608', 2, 'EV2024070006', 32, 'Idal Ikhlas', 'P', '1980-02-02', 44, '2171030310760001', '081372827422', 0, 30, 1),
('EP2024110156', '00000', 'EV202407000603', 'EV202407000601', 1, 'EV2024070006', 32, 'Aqual Fattan Syawalandita', 'P', '2010-09-03', 14, '3603203009100000', '081519802010', 0, 30, 1),
('EP2024110159', '0', 'EV202407000615', 'EV202407000604', 2, 'EV2024070006', 36, 'Drs. Bambang Sutrisno', 'P', '1959-09-23', 65, '3403012309590001', '081215521728', 0, 15, 1),
('EP2024110160', '0', 'EV202407000623', 'EV202407000608', 2, 'EV2024070006', 36, 'Rety Astuti, PNP', 'P', '1974-10-28', 50, '3404106810740004', '085728851185', 0, 15, 1),
('EP2024110162', '00000', 'EV202407000610', 'EV202407000601', 1, 'EV2024070006', 32, 'Aisyah Nurlaila Soedarto', 'W', '2010-05-08', 14, '3174104508101000', '081519802010', 0, 30, 1),
('EP2024110163', '0', 'EV202407000608', 'EV202407000611', 2, 'EV2024070006', 36, 'Shafira Devi Herfesa', 'W', '2008-12-13', 15, '3404075312080002', '0882006540404', 0, 15, 1),
('EP2024110164', '00000', 'EV202407000601', 'EV202407000613', 1, 'EV2024070006', 32, 'Reynard  Kristopher', 'P', '2007-06-30', 17, '3603283006070006', '082114574750', 0, 30, 1),
('EP2024110165', '00000', 'EV202407000602', 'EV202407000601', 1, 'EV2024070006', 32, 'Muhammad Hanif Abhinaya Musto', 'P', '2009-03-08', 15, '3276110803090000', '081519802010', 0, 30, 1),
('EP2024110166', '00000', 'EV202407000602', 'EV202407000601', 1, 'EV2024070006', 32, 'Immanuel Christian Patogi Sim', 'P', '2007-11-24', 16, '3674061503120050', '081519802010', 0, 30, 1),
('EP2024110167', '00000', 'EV202407000601', 'EV202407000601', 1, 'EV2024070006', 32, 'Farrel  Octo Adinata', 'P', '2005-10-24', 19, '3201112410050000', '081519802010', 0, 30, 1),
('EP2024110168', '1757', 'EV202407000610', 'EV202407000601', 1, 'EV2024070006', 35, 'WEFRESH HIDAYAHSARI ', 'W', '2009-02-06', 15, '00', '00', 0, 16, 1),
('EP2024110169', '00000', 'EV202407000607', 'EV202407000601', 1, 'EV2024070006', 32, 'Zakwan Tsaqib El-Yaffa', 'P', '2017-04-10', 7, '3674065004170000', '081519802010', 0, 30, 1),
('EP2024110170', '00000', 'EV202407000606', 'EV202407000601', 1, 'EV2024070006', 32, 'Sharbel Advenio Ecclesia Purwa', 'P', '2015-12-01', 8, '3173020112150000', '081519802010', 0, 30, 1),
('EP2024110171', '00000', 'EV202407000613', 'EV202407000601', 1, 'EV2024070006', 32, 'Magnificat Siauw', 'P', '2015-08-27', 9, '3673016708150000', '081519802010', 0, 30, 1),
('EP2024110172', '00000', 'EV202407000603', 'EV202407000601', 1, 'EV2024070006', 32, 'Adelino Ilham', 'P', '2010-03-09', 14, '3173060903101010', '081519802010', 0, 30, 1),
('EP2024110173', '00000', 'EV202407000602', 'EV202407000601', 1, 'EV2024070006', 32, 'Antonius, Felizio Prinadi', 'P', '2008-10-12', 16, '3674012105120010', '081519802010', 0, 30, 1),
('EP2024110174', '00000', 'EV202407000602', 'EV202407000601', 1, 'EV2024070006', 32, 'Kiki  Tayeb', 'P', '2008-03-03', 16, '7172060303090000', '081519802010', 0, 30, 1),
('EP2024110177', '00000', 'EV202407000603', 'EV202407000601', 1, 'EV2024070006', 32, 'Veyron Fraser Saerang', 'P', '2010-09-24', 14, '3674012409100002', '088291285301', 0, 30, 1),
('EP2024110178', '00000', 'EV202407000613', 'EV202407000601', 1, 'EV2024070006', 32, 'Aisyah  Ayudia Inara', 'W', '2015-07-19', 9, '3671105907150000', '081519802010', 0, 30, 1),
('EP2024110179', '00000', 'EV202407000612', 'EV202407000601', 1, 'EV2024070006', 32, 'Mahira, Shidqiya', 'W', '2014-03-14', 10, '3604295403140000', '081519802010', 0, 30, 1),
('EP2024110180', '00000', 'EV202407000611', 'EV202407000601', 1, 'EV2024070006', 32, 'Alysha Putri Abdullah				', 'W', '2011-06-14', 13, '3671135406110002', '081519802010', 0, 30, 1),
('EP2024110181', '00000', 'EV202407000611', 'EV202407000601', 1, 'EV2024070006', 32, 'Nazla Haura Sakhi				', 'W', '2012-01-31', 12, '3671067101120000', '081519802010', 0, 30, 1),
('EP2024110182', '00000', 'EV202407000610', 'EV202407000601', 1, 'EV2024070006', 32, 'Amirah Afifah Nur Andini', 'W', '2010-03-02', 14, '3175104203101000', '081282755728', 0, 30, 1),
('EP2024110183', '00000', 'EV202407000614', 'EV202407000601', 1, 'EV2024070006', 32, 'Cleandra Beatrix Lian Tupan', 'W', '2018-04-04', 6, '3674014404180000', '081519802010', 0, 30, 1),
('EP2024110184', '00000', 'EV202407000601', 'EV202407000601', 1, 'EV2024070006', 32, 'I Made Razqa Dhana Airavata', 'P', '2016-03-08', 8, '3673030803160000', '081519802010', 0, 30, 1),
('EP2024110185', '00000', 'EV202407000605', 'EV202407000601', 1, 'EV2024070006', 32, 'I Kadek Dhanvant Keene Anggasw', 'P', '2013-07-14', 11, '3175061406131010', '081519802010', 0, 30, 1),
('EP2024110186', '00000', 'EV202407000605', 'EV202407000601', 1, 'EV2024070006', 32, 'Faiz Ahmad Hajriyanto', 'P', '2014-10-25', 10, '3674052510141000', '081519802010', 0, 30, 1),
('EP2024110187', '0', 'EV202407000601', 'EV202407000613', 2, 'EV2024070006', 33, 'Satria Duta Cahaya', 'P', '2008-07-07', 16, '0', '0', 0, 13, 1),
('EP2024110188', '0', 'EV202407000602', 'EV202407000614', 2, 'EV2024070006', 33, 'Claudio Lasama,MN', 'P', '2008-12-14', 15, '0', '0', 0, 13, 1),
('EP2024110189', '0', 'EV202407000601', 'EV202407000601', 2, 'EV2024070006', 33, 'Alessandro Moreno Lawadinata', 'P', '2005-09-09', 19, '0', '0', 0, 13, 1),
('EP2024110190', '0', 'EV202407000601', 'EV202407000601', 2, 'EV2024070006', 33, 'Ronen Martin Tua Sidabutar', 'P', '2008-12-05', 15, '0', '0', 0, 13, 1),
('EP2024110191', '0', 'EV202407000601', 'EV202407000601', 1, 'EV2024070006', 33, 'Zidan Shafiq Prasetyo', 'P', '2006-11-25', 17, '0', '0', 0, 13, 1),
('EP2024110192', '0', 'EV202407000601', 'EV202407000601', 1, 'EV2024070006', 33, 'Arian Djuned Pusponegoro', 'P', '2005-11-07', 18, '0', '0', 0, 13, 1),
('EP2024110193', '0', 'EV202407000602', 'EV202407000611', 2, 'EV2024070006', 33, 'Uriel N.O. Sidabutar', 'P', '0009-02-13', 2015, '0', '0', 0, 13, 1),
('EP2024110194', '0', 'EV202407000602', 'EV202407000601', 1, 'EV2024070006', 33, 'Christopher Vincentius K.', 'P', '2007-12-05', 16, '0', '0', 0, 13, 1),
('EP2024110195', '0', 'EV202407000602', 'EV202407000601', 1, 'EV2024070006', 33, 'Theodorus Nathaniel Walukow', 'P', '2008-12-21', 15, '0', '0', 0, 13, 1),
('EP2024110196', '0', 'EV202407000602', 'EV202407000601', 1, 'EV2024070006', 33, 'Daffa Mahardika Haidar', 'P', '2007-12-15', 16, '0', '0', 0, 13, 1),
('EP2024110197', '0', 'EV202407000603', 'EV202407000602', 1, 'EV2024070006', 33, 'Steven Tan, MP', 'P', '2010-10-03', 14, '0', '0', 0, 13, 1),
('EP2024110198', '0', 'EV202407000603', 'EV202407000601', 1, 'EV2024070006', 33, 'Justin Christian Santoso', 'P', '2009-02-07', 15, '0', '0', 0, 13, 1),
('EP2024110199', '0', 'EV202407000603', 'EV202407000601', 2, 'EV2024070006', 33, 'Garrent Manuel', 'P', '2010-04-14', 14, '0', '0', 0, 13, 1),
('EP2024110200', '0', 'EV202407000603', 'EV202407000601', 1, 'EV2024070006', 33, 'Raditra Siddiq Zulhilmi', 'P', '2010-09-13', 14, '0', '0', 0, 13, 1),
('EP2024110201', '0', 'EV202407000603', 'EV202407000601', 2, 'EV2024070006', 33, 'Fatah Abyasa Prataya', 'P', '2013-11-27', 10, '0', '0', 0, 13, 1),
('EP2024110202', '0', 'EV202407000610', 'EV202407000601', 1, 'EV2024070006', 33, 'Miracle Carang Gesang BPW', 'P', '2009-04-12', 15, '0', '0', 0, 13, 1),
('EP2024110203', '0', 'EV202407000604', 'EV202407000601', 2, 'EV2024070006', 33, 'Imanuelo Martogi', 'P', '2011-12-30', 12, '0', '0', 0, 13, 1),
('EP2024110204', '0', 'EV202407000604', 'EV202407000601', 1, 'EV2024070006', 33, 'Alessandro Alfaridzi Amir', 'P', '2011-11-20', 12, '0', '0', 0, 13, 1),
('EP2024110205', '0', 'EV202407000604', 'EV202407000601', 1, 'EV2024070006', 33, 'Bineka Surya Jonatan', 'P', '2011-01-14', 13, '0', '0', 0, 13, 1),
('EP2024110206', '0', 'EV202407000604', 'EV202407000601', 1, 'EV2024070006', 33, 'Theodore Daniel Kurniawan', 'P', '2012-01-27', 12, '0', '0', 0, 13, 1),
('EP2024110207', '0', 'EV202407000604', 'EV202407000601', 2, 'EV2024070006', 33, 'DOminicus Winston Lin', 'P', '2012-02-03', 12, '0', '0', 0, 13, 1),
('EP2024110208', '0', 'EV202407000604', 'EV202407000601', 1, 'EV2024070006', 33, 'Rio Valentino', 'P', '2012-06-05', 12, '0', '0', 0, 13, 1),
('EP2024110209', '0', 'EV202407000605', 'EV202407000611', 2, 'EV2024070006', 33, 'Georgio Gabe Butarbutar', 'P', '2014-11-19', 9, '0', '0', 0, 13, 1),
('EP2024110210', '0', 'EV202407000605', 'EV202407000601', 1, 'EV2024070006', 33, 'Safin Aldebaran Amir', 'P', '2013-05-16', 11, '0', '0', 0, 13, 1),
('EP2024110211', '0', 'EV202407000605', 'EV202407000601', 1, 'EV2024070006', 33, 'Yehezkiel Fabian Mikha', 'P', '2014-02-05', 10, '0', '0', 0, 13, 1),
('EP2024110212', '0', 'EV202407000605', 'EV202407000601', 1, 'EV2024070006', 33, 'Alfian Rizqie Mutha', 'P', '2013-09-09', 11, '0', '0', 0, 13, 1),
('EP2024110213', '0', 'EV202407000605', 'EV202407000601', 2, 'EV2024070006', 33, 'Sebastian Tiono', 'P', '2014-09-25', 10, '0', '0', 0, 13, 1),
('EP2024110214', '0', 'EV202407000606', 'EV202407000601', 1, 'EV2024070006', 33, 'M. Saud Al Farabi', 'P', '2015-03-23', 9, '0', '0', 0, 13, 1),
('EP2024110215', '0', 'EV202407000606', 'EV202407000601', 2, 'EV2024070006', 33, 'Alexander Philip Kurniawan', 'P', '2015-06-14', 9, '0', '0', 0, 13, 1),
('EP2024110216', '0', 'EV202407000606', 'EV202407000601', 1, 'EV2024070006', 33, 'Tedisyah Arya Muhammad', 'P', '2015-02-22', 9, '0', '0', 0, 13, 1),
('EP2024110217', '0', 'EV202407000606', 'EV202407000601', 1, 'EV2024070006', 33, 'Kyle Darrel Gunawan', 'P', '2015-05-26', 9, '0', '0', 0, 13, 1),
('EP2024110218', '0', 'EV202407000606', 'EV202407000601', 2, 'EV2024070006', 33, 'Shine Muller Salim', 'P', '2015-04-25', 9, '0', '0', 0, 13, 1),
('EP2024110219', '0', 'EV202407000606', 'EV202407000601', 1, 'EV2024070006', 33, 'Maximilian Nolan Klaver', 'P', '2016-01-02', 8, '0', '0', 0, 13, 1),
('EP2024110220', '0', 'EV202407000606', 'EV202407000601', 2, 'EV2024070006', 33, 'Derrel Isaac Jeremiah', 'P', '2016-01-04', 8, '0', '0', 0, 13, 1),
('EP2024110221', '0', 'EV202407000607', 'EV202407000601', 2, 'EV2024070006', 33, 'Zach Alexander Tjong', 'P', '2017-04-17', 7, '0', '0', 0, 13, 1),
('EP2024110222', '0', 'EV202407000607', 'EV202407000601', 1, 'EV2024070006', 33, 'Fitzpatrick Yeremia R.Sibarani', 'P', '2017-11-13', 6, '0', '0', 0, 13, 1),
('EP2024110223', '0', 'EV202407000607', 'EV202407000601', 1, 'EV2024070006', 33, 'Kaiden Kamsari', 'P', '2017-02-02', 7, '0', '0', 0, 13, 1),
('EP2024110224', '0', 'EV202407000607', 'EV202407000601', 1, 'EV2024070006', 33, 'Parama Hansa Abhipraya', 'P', '2018-02-15', 6, '0', '0', 0, 13, 1),
('EP2024110225', '0', 'EV202407000607', 'EV202407000601', 1, 'EV2024070006', 33, 'Kanawa Argi Abhinaya', 'P', '2019-01-31', 5, '0', '0', 0, 13, 1),
('EP2024110226', '0', 'EV202407000607', 'EV202407000601', 1, 'EV2024070006', 33, 'Ranu Senna Widyanata', 'P', '2017-12-08', 6, '0', '0', 0, 13, 1),
('EP2024110227', '0', 'EV202407000608', 'EV202407000614', 2, 'EV2024070006', 33, 'Aulia Rochmah, MPW', 'W', '2006-06-08', 18, '0', '0', 0, 13, 1),
('EP2024110228', '0', 'EV202407000608', 'EV202407000601', 1, 'EV2024070006', 33, 'Abigail Kolina Ricilia', 'W', '2007-06-07', 17, '0', '0', 0, 13, 1),
('EP2024110229', '0', 'EV202407000609', 'EV202407000601', 2, 'EV2024070006', 33, 'Zarquel Mawaddah', 'W', '2008-02-23', 16, '0', '0', 0, 13, 1),
('EP2024110230', '0', 'EV202407000609', 'EV202407000601', 1, 'EV2024070006', 33, 'Dhintan Caysa', 'W', '2007-07-07', 17, '0', '0', 0, 13, 1),
('EP2024110231', '0', 'EV202407000610', 'EV202407000601', 2, 'EV2024070006', 33, 'Clementia Adeline', 'W', '2009-04-08', 15, '0', '0', 0, 13, 1),
('EP2024110232', '0', 'EV202407000610', 'EV202407000601', 2, 'EV2024070006', 33, 'Fatonah Almugniasari', 'W', '2010-04-28', 14, '0', '0', 0, 13, 1),
('EP2024110233', '0', 'EV202407000610', 'EV202407000601', 1, 'EV2024070006', 33, 'Nyimas Bunga Annisa M.S.', 'W', '2009-06-25', 15, '0', '0', 0, 13, 1),
('EP2024110234', '0', 'EV202407000611', 'EV202407000601', 2, 'EV2024070006', 33, 'Danesh Syauqina Putri', 'W', '2012-01-31', 12, '0', '0', 0, 13, 1),
('EP2024110235', '0', 'EV202407000611', 'EV202407000601', 2, 'EV2024070006', 33, 'Maryam Azzahra', 'W', '2011-06-22', 13, '0', '0', 0, 13, 1),
('EP2024110236', '0', 'EV202407000611', 'EV202407000601', 2, 'EV2024070006', 33, 'Jovita Alexa Gunawan', 'W', '2012-04-14', 12, '0', '0', 0, 13, 1),
('EP2024110237', '0', 'EV202407000611', 'EV202407000601', 1, 'EV2024070006', 33, 'Hikaru Rabani Lestari', 'W', '2011-05-27', 13, '0', '0', 0, 13, 1),
('EP2024110238', '0', 'EV202407000612', 'EV202407000601', 2, 'EV2024070006', 33, 'Stacey Alexandra Oey', 'W', '2014-02-21', 10, '0', '0', 0, 13, 1),
('EP2024110239', '0', 'EV202407000612', 'EV202407000601', 1, 'EV2024070006', 33, 'Aisyah Akmaliyah', 'W', '2014-09-02', 10, '0', '0', 0, 13, 1),
('EP2024110240', '0', 'EV202407000612', 'EV202407000601', 1, 'EV2024070006', 33, 'Claudia Nova Emmanuelle A.', 'W', '2014-11-10', 9, '0', '0', 0, 13, 1),
('EP2024110241', '0', 'EV202407000612', 'EV202407000601', 1, 'EV2024070006', 33, 'Giselle Philia Pranata', 'W', '2014-04-20', 10, '0', '0', 0, 13, 1),
('EP2024110242', '0', 'EV202407000612', 'EV202407000601', 1, 'EV2024070006', 33, 'Evelyn Lawrence Iskandar', 'W', '2014-11-14', 9, '0', '0', 0, 13, 1),
('EP2024110243', '0', 'EV202407000613', 'EV202407000602', 1, 'EV2024070006', 33, 'Hillary Rooca Theng', 'W', '2015-05-06', 9, '0', '0', 0, 13, 1),
('EP2024110244', '0', 'EV202407000613', 'EV202407000603', 1, 'EV2024070006', 33, 'Deandra Mahardika Zhafira', 'W', '2016-05-17', 8, '0', '0', 0, 13, 1),
('EP2024110245', '0', 'EV202407000613', 'EV202407000601', 1, 'EV2024070006', 33, 'Siti Sufiyah', 'W', '2015-12-28', 8, '0', '0', 0, 13, 1),
('EP2024110246', '0', 'EV202407000613', 'EV202407000601', 1, 'EV2024070006', 33, 'Laura Felicita Cavaste', 'W', '2015-07-15', 9, '0', '0', 0, 13, 1),
('EP2024110247', '0', 'EV202407000613', 'EV202407000601', 1, 'EV2024070006', 33, 'Victoria Lareyna Tumbelaka', 'W', '2015-04-30', 9, '0', '0', 0, 13, 1),
('EP2024110248', '0', 'EV202407000614', 'EV202407000601', 2, 'EV2024070006', 33, 'Maria Eucharist', 'W', '2017-05-16', 7, '0', '0', 0, 13, 1),
('EP2024110249', '0', 'EV202407000614', 'EV202407000601', 2, 'EV2024070006', 33, 'Joy Felicia Riyanto', 'W', '2017-09-06', 7, '0', '0', 0, 13, 1),
('EP2024110250', '0', 'EV202407000614', 'EV202407000601', 1, 'EV2024070006', 33, 'Leana Fidelia Cavaste', 'W', '2017-12-07', 6, '0', '0', 0, 13, 1),
('EP2024110251', '0', 'EV202407000622', 'EV202407000608', 2, 'EV2024070006', 33, 'Orangtua Stacey Alexandra Oey', 'P', '2000-11-11', 23, '0', '0', 0, 13, 1),
('EP2024110252', '0', 'EV202407000622', 'EV202407000608', 2, 'EV2024070006', 33, 'Orangtua Georgio Gabe Butar', 'W', '2000-11-11', 23, '0', '0', 0, 13, 1),
('EP2024110253', '0', 'EV202407000622', 'EV202407000608', 2, 'EV2024070006', 33, 'Orangtua Hillary Rooca Theng', 'W', '2000-11-11', 23, '0', '0', 0, 13, 1),
('EP2024110254', '0', 'EV202407000622', 'EV202407000608', 2, 'EV2024070006', 33, 'Orangtua Alexander Philip K', 'W', '2000-11-11', 23, '0', '0', 0, 13, 1),
('EP2024110255', '0', 'EV202407000622', 'EV202407000608', 2, 'EV2024070006', 33, 'Orangtua Dominicus Winston Lin', 'P', '2000-11-11', 23, '0', '0', 0, 13, 1),
('EP2024110256', '0', 'EV202407000622', 'EV202407000608', 2, 'EV2024070006', 33, 'Orangtua Maria Eucharist', 'W', '2000-11-11', 23, '0', '0', 0, 13, 1),
('EP2024110257', '0', 'EV202407000622', 'EV202407000608', 2, 'EV2024070006', 33, 'Hendry Kornelius', 'P', '2000-11-11', 23, '0', '0', 0, 13, 1),
('EP2024110258', '0', 'EV202407000622', 'EV202407000608', 2, 'EV2024070006', 33, 'Orangtua Joy Felicia Riyanto', 'W', '2000-11-11', 23, '0', '0', 0, 13, 1),
('EP2024110259', '0', 'EV202407000623', 'EV202407000608', 2, 'EV2024070006', 33, 'H. Hendry Jamal\'s', 'P', '2000-11-11', 23, '0', '0', 0, 13, 1),
('EP2024110261', '0', 'EV202407000624', 'EV202407000608', 2, 'EV2024070006', 33, 'Syarif Mahmud', 'P', '2000-11-11', 23, '0', '0', 0, 13, 1),
('EP2024110262', '0', 'EV202407000624', 'EV202407000608', 2, 'EV2024070006', 33, 'Aris Tiles', 'P', '2000-11-11', 23, '0', '0', 0, 13, 1),
('EP2024110263', '0', 'EV202407000624', 'EV202407000608', 2, 'EV2024070006', 33, 'Syaiful Hidayat', 'P', '2000-11-11', 23, '0', '0', 0, 13, 1),
('EP2024110264', '0', 'EV202407000624', 'EV202407000608', 2, 'EV2024070006', 33, 'Christine Marline', 'W', '2000-11-11', 23, '0', '0', 0, 13, 1),
('EP2024110265', '0', 'EV202407000624', 'EV202407000608', 2, 'EV2024070006', 33, 'Ferdinan Hutabarat', 'P', '2000-11-11', 23, '0', '0', 0, 13, 1),
('EP2024110266', '0', 'EV202407000623', 'EV202407000608', 2, 'EV2024070006', 33, 'Agus Rubianto', 'P', '2000-11-11', 23, '0', '0', 0, 13, 1),
('EP2024110269', '0', 'EV202407000615', 'EV202407000604', 1, 'EV2024070006', 33, 'Rudy Hartono', 'P', '1968-12-23', 55, '0', '0', 0, 13, 1),
('EP2024110270', '00', 'EV202407000614', 'EV202407000601', 2, 'EV2024070006', 38, 'Ni Kadek Airin Wahyuni', 'W', '2017-05-20', 7, '5171026005170002', '082250003636', 0, 19, 1),
('EP2024110271', '00', 'EV202407000605', 'EV202407000601', 2, 'EV2024070006', 38, 'I Gede Hanasta Wayama', 'P', '2013-10-30', 11, '5171023010130001', '082250003636', 0, 19, 1),
('EP2024110272', '21671', 'EV202407000610', 'EV202407000601', 2, 'EV2024070006', 38, 'I Kadek Winayaka Sentanu', 'P', '2010-10-14', 14, '5104031409100001', '082250003636', 0, 19, 1),
('EP2024110273', '00', 'EV202407000601', 'EV202407000601', 2, 'EV2024070006', 38, 'Brian Surjaya', 'P', '2006-02-05', 18, '5171030502060001', '082250003636', 0, 19, 1),
('EP2024110274', '00000', 'EV202407000607', 'EV202407000601', 1, 'EV2024070006', 32, 'Kylian Rafa', 'P', '2019-03-25', 5, '3671062503190000', '081280038983', 0, 30, 1),
('EP2024110275', '21173', 'EV202407000604', 'EV202407000614', 2, 'EV2024070006', 40, 'RAFA FIRJATULLAH', 'P', '2011-06-29', 13, '6212012906110001', '085216911019', 0, 28, 1),
('EP2024110276', '0', 'EV202407000613', 'EV202407000601', 2, 'EV2024070006', 40, 'YOURAEL ANYESTU JUSLAOPE', 'W', '2016-05-17', 8, '6212011304150001', '081255556738', 0, 28, 1),
('EP2024110277', '21383', 'EV202407000610', 'EV202407000601', 2, 'EV2024070006', 40, 'FEBBY GRACIA', 'W', '2010-02-10', 14, '6271035002100002', '085961536207', 0, 28, 1),
('EP2024110278', '0', 'EV202407000601', 'EV202407000601', 1, 'EV2024070006', 40, 'PUTRA PANGERAN JEREMIA', 'P', '2005-12-28', 18, '6208012812050002', '082111189071', 0, 28, 1),
('EP2024110279', '0', 'EV202407000602', 'EV202407000601', 1, 'EV2024070006', 40, 'REVAELLIANO AKAR', 'P', '2008-04-16', 16, '6209031604080003', '021855141967', 0, 28, 1),
('EP2024110280', '21781', 'EV202407000602', 'EV202407000601', 2, 'EV2024070006', 40, 'HARRY BONA JAYA SIRAIT', 'P', '2008-05-21', 16, '6205052105080001', '082250377123', 0, 28, 1),
('EP2024110281', '0', 'EV202407000610', 'EV202407000601', 2, 'EV2024070006', 40, 'DHIYANI NUR HAVISAH', 'W', '2010-02-10', 14, '132075654', '082250377123', 0, 28, 1),
('EP2024110282', '0', 'EV202407000602', 'EV202407000601', 2, 'EV2024070006', 40, 'BAYU RAMADHAN ', 'P', '2007-10-08', 17, '6205050810070003', '082250377123', 0, 28, 1),
('EP2024110283', '0', 'EV202407000603', 'EV202407000601', 1, 'EV2024070006', 40, 'HANDY', 'P', '2009-11-27', 14, '7671/0093050625', '082252486511', 0, 28, 1),
('EP2024110284', '0', 'EV202407000605', 'EV202407000601', 2, 'EV2024070006', 40, 'ARROYAN', 'P', '2013-09-29', 11, '6209032909130001', '082255146154', 0, 28, 1),
('EP2024110285', '0', 'EV202407000603', 'EV202407000601', 2, 'EV2024070006', 40, 'DIRGHA RAMADHAN', 'P', '2010-08-16', 14, '16.868/010797703', '081383414655', 0, 28, 1),
('EP2024110286', '0', 'EV202407000602', 'EV202407000601', 2, 'EV2024070006', 40, 'BERTINIUS FERNANDO EFRAND', 'P', '2007-10-18', 17, '6203011810070003', '081269630445', 0, 28, 1),
('EP2024110287', '0', 'EV202407000602', 'EV202407000601', 2, 'EV2024070006', 40, 'DESIANES ENJELIA', 'W', '2008-03-30', 16, '3464/0082371801', '081383414655', 0, 28, 1);
INSERT INTO `pesertaev` (`id_pst_ev`, `id_nasional`, `id_ktg_ev`, `id_gelar_ev`, `id_akomodasi_ev`, `id_ev`, `id_prov`, `nama_pst`, `jk_pst`, `tgl_lahir`, `umur`, `nik`, `telepon`, `juara`, `id_operator`, `id_admin`) VALUES
('EP2024110288', '0', 'EV202407000606', 'EV202407000601', 2, 'EV2024070006', 40, 'MUHAMMAD FAIQ S. AL HANAN', 'P', '2015-01-10', 9, '627101100115000', '081383414655', 0, 28, 1),
('EP2024110289', '0', 'EV202407000622', 'EV202407000608', 1, 'EV2024070006', 40, 'A. RACHMAN USOP', 'P', '1965-04-15', 59, '6271011504650009', '081383414655', 0, 28, 1),
('EP2024110290', '0', 'EV202407000624', 'EV202407000608', 2, 'EV2024070006', 40, 'ALORI LENA', 'W', '1972-01-21', 52, '6205056101720002', '082250377123', 0, 28, 1),
('EP2024110291', '0', 'EV202407000624', 'EV202407000608', 2, 'EV2024070006', 40, 'IR. PAHALA BUDIAWAN, MM', 'P', '1963-11-07', 60, '6212010711630002', '082124106461', 0, 28, 1),
('EP2024110292', '0', 'EV202407000624', 'EV202407000608', 2, 'EV2024070006', 40, 'ZAINAL ARIFIN', 'P', '1967-09-12', 57, '6371011209670001', '08125050232', 0, 28, 1),
('EP2024110293', '0', 'EV202407000624', 'EV202407000608', 2, 'EV2024070006', 40, 'YULIANA, SE', 'W', '1988-07-10', 36, '6212015007880003', '085705079300', 0, 28, 1),
('EP2024110294', '0', 'EV202407000624', 'EV202407000608', 2, 'EV2024070006', 40, 'BEBY SUKMAJAYA', 'P', '1997-07-07', 27, '6212011707970001', '081549114588', 0, 28, 1),
('EP2024110295', '20631', 'EV202407000602', 'EV202407000601', 1, 'EV2024070006', 28, 'Adly Juandra ', 'P', '2008-06-02', 16, '1771040206080002', '081803700477', 0, 20, 1),
('EP2024110296', '21569', 'EV202407000605', 'EV202407000601', 1, 'EV2024070006', 28, 'Arkharayyan Hajabbar Asa ', 'P', '2013-11-18', 10, '1671061811130004', '081803700477', 0, 20, 1),
('EP2024110297', '21753', 'EV202407000603', 'EV202407000601', 1, 'EV2024070006', 28, 'Arya Prima ', 'P', '2009-05-25', 15, '1603072505090002', '081803700477', 0, 20, 1),
('EP2024110298', '21568', 'EV202407000605', 'EV202407000601', 2, 'EV2024070006', 28, 'Brady Emerson Tampubolon ', 'P', '2013-05-30', 11, '1671063005130001', '081803700477', 0, 20, 1),
('EP2024110299', '21689', 'EV202407000604', 'EV202407000601', 2, 'EV2024070006', 28, 'Bram Valentino Tampubolon ', 'P', '2011-02-14', 13, '1671041402110001', '081803700477', 0, 20, 1),
('EP2024110300', '21727', 'EV202407000611', 'EV202407000601', 1, 'EV2024070006', 28, 'Faizah Rahmillah ', 'W', '2011-11-28', 12, '1671066811110002', '081803700477', 0, 20, 1),
('EP2024110301', '21540', 'EV202407000613', 'EV202407000601', 1, 'EV2024070006', 28, 'Khaira Aleena Kapriaga ', 'W', '2015-08-07', 9, '1606014708150003', '081803700477', 0, 20, 1),
('EP2024110302', '21472', 'EV202407000607', 'EV202407000601', 1, 'EV2024070006', 28, 'Muhammad Ameer Kapriaga ', 'P', '2017-07-10', 7, '1606011007170005', '081803700477', 0, 20, 1),
('EP2024110303', '22013', 'EV202407000623', 'EV202407000608', 1, 'EV2024070006', 28, 'Prima Nursinggih ', 'P', '1974-08-27', 50, '1671061811130002', '081803700477', 0, 20, 1),
('EP2024110304', '21035', 'EV202407000610', 'EV202407000602', 1, 'EV2024070006', 28, 'Quinsha Adinda Syahirah ', 'W', '2009-10-24', 15, '1671061811130008', '081803700477', 0, 20, 1),
('EP2024110305', '0', 'EV202407000602', 'EV202407000601', 1, 'EV2024070006', 28, 'Anindya Falih Sandwika ', 'P', '2008-02-03', 16, '1671060302080011', '081803700477', 0, 20, 1),
('EP2024110306', '21481', 'EV202407000606', 'EV202407000601', 2, 'EV2024070006', 28, 'Gregory Winston Chia ', 'P', '2015-11-09', 8, '3172060911150005', '081803700477', 0, 20, 1),
('EP2024110307', '0', 'EV202407000606', 'EV202407000601', 1, 'EV2024070006', 28, 'Pulunggono Banyu Segoro ', 'P', '2016-11-05', 8, '3216060511160008', '081803700477', 0, 20, 1),
('EP2024110308', '0', 'EV202407000610', 'EV202407000601', 1, 'EV2024070006', 28, 'Azura Rahma Syaila ', 'W', '2009-01-09', 15, '1671154901090002', '081803700477', 0, 20, 1),
('EP2024110309', '0', 'EV202407000612', 'EV202407000601', 2, 'EV2024070006', 28, 'Renata Eirlys Chiara ', 'W', '2013-09-09', 11, '3172064909131080', '081803700477', 0, 20, 1),
('EP2024110310', '0', 'EV202407000613', 'EV202407000601', 1, 'EV2024070006', 28, 'Nurani Istiqomah ', 'W', '2016-02-20', 8, '1603076002160002', '081803700477', 0, 20, 1),
('EP2024110311', '0', 'EV202407000609', 'EV202407000601', 1, 'EV2024070006', 28, 'Jesica Wulandari ', 'W', '2008-07-15', 16, '1603054706090002', '081803700477', 0, 20, 1),
('EP2024110312', '0', 'EV202407000605', 'EV202407000601', 1, 'EV2024070006', 28, 'Taqi fawa Al Batani ', 'P', '2013-09-20', 11, '1612012009120002', '081803700477', 0, 20, 1),
('EP2024110313', '0', 'EV202407000622', 'EV202407000608', 2, 'EV2024070006', 28, 'Jovita Sutiono ', 'W', '1985-03-08', 39, '3172064803850003', '081803700477', 0, 20, 1),
('EP2024110314', '12036', 'EV202407000624', 'EV202407000608', 1, 'EV2024070006', 28, 'Nurdin Abubakar ', 'P', '1978-01-02', 46, '3205040201780001', '081803700477', 0, 20, 1),
('EP2024110315', '0', 'EV202407000609', 'EV202407000601', 2, 'EV2024070006', 39, 'XANDRA FREDLINA RHAMADANI', 'W', '2007-09-08', 17, '6310024809070003', '081349719667', 0, 29, 1),
('EP2024110316', '0', 'EV202407000622', 'EV202407000608', 1, 'EV2024070006', 28, 'Listen Prima ', 'W', '1985-02-07', 39, '1671064702850016', '081803700477', 0, 20, 1),
('EP2024110317', '0', 'EV202407000613', 'EV202407000601', 2, 'EV2024070006', 39, 'MUHAMMAD AZKA ATHAFARIZ HIZAM', 'P', '2016-08-16', 8, '630761808160001', '081349719667', 0, 29, 1),
('EP2024110318', '00000', 'EV202407000607', 'EV202407000601', 1, 'EV2024070006', 32, 'Frederic Amadeus Tan', 'P', '2017-11-05', 6, '3603170511170001', '081519802010', 0, 30, 1),
('EP2024110319', '00000', 'EV202407000607', 'EV202407000601', 1, 'EV2024070006', 32, 'Keanu Gibran', 'P', '2018-01-23', 6, '3603172301180002', '081519802010', 0, 30, 1),
('EP2024110320', '0', 'EV202407000605', 'EV202407000601', 2, 'EV2024070006', 39, 'MUHAMMAD DOMINICO ZAUHIDIE', 'P', '2014-06-05', 10, '633050506140006', '081349719667', 0, 29, 1),
('EP2024110321', '00', 'EV202407000603', 'EV202407000601', 1, 'EV2024070006', 44, ' Andi Banapati Maulana Calla', 'P', '2009-04-18', 15, '0', '0', 0, 1, 1),
('EP2024110322', '0', 'EV202407000607', 'EV202407000601', 2, 'EV2024070006', 39, 'ADAM SALMAN ALFARIZI', 'P', '2017-03-01', 7, '6372020103170002', '081349719667', 0, 29, 1),
('EP2024110323', '1642', 'EV202407000605', 'EV202407000601', 2, 'EV2024070006', 39, 'FARREL ARISTA BARAYISTOETIE', 'P', '2013-04-27', 11, '6371052704130006', '081349719667', 0, 29, 1),
('EP2024110324', '00000', 'EV202407000605', 'EV202407000601', 1, 'EV2024070006', 32, 'Nadiv Asadel', 'P', '2014-03-07', 10, '3671120703140001', '081519802010', 0, 30, 1),
('EP2024110325', '0', 'EV202407000612', 'EV202407000601', 2, 'EV2024070006', 39, 'MARY GLORY VICTORIA LAIHAD', 'W', '2013-03-03', 11, '6371034303130001', '081349719667', 0, 29, 1),
('EP2024110326', '00000', 'EV202407000612', 'EV202407000601', 1, 'EV2024070006', 32, 'Wafik Nur Azizah', 'P', '2014-01-18', 10, '3604345801140002', '081519802010', 0, 30, 1),
('EP2024110327', '0', 'EV202407000602', 'EV202407000601', 2, 'EV2024070006', 39, 'MUHAMMAD AL FATIH ANGKASA', 'P', '2008-01-30', 16, '6371043001080002', '081349719667', 0, 29, 1),
('EP2024110328', '0', 'EV202407000604', 'EV202407000601', 1, 'EV2024070006', 39, 'LINDA TASYA AMALINA', 'W', '2012-06-20', 12, '6371026006120004', '081349719667', 0, 29, 1),
('EP2024110329', '00000', 'EV202407000604', 'EV202407000601', 1, 'EV2024070006', 32, 'Braveheart  Honoris Christian ', 'P', '2012-07-25', 12, '7109250620120001', '081519802010', 0, 30, 1),
('EP2024110330', '0', 'EV202407000604', 'EV202407000601', 2, 'EV2024070006', 39, 'MUHAMMAD ANDY AL GHIFARI', 'P', '2011-05-02', 13, '6308050502110002', '081349719667', 0, 29, 1),
('EP2024110331', '00000', 'EV202407000605', 'EV202407000601', 1, 'EV2024070006', 32, 'Nathan  Timotius				', 'P', '2012-01-20', 12, '3172012001121000', '081519802010', 0, 30, 1),
('EP2024110332', '00000', 'EV202407000611', 'EV202407000601', 1, 'EV2024070006', 32, 'Mirza Tarangga Satria				', 'P', '2012-08-12', 12, '3674072308120001', '081519802010', 0, 30, 1),
('EP2024110333', '0', 'EV202407000615', 'EV202407000604', 1, 'EV2024070006', 39, 'MUSTAFA ABD', 'P', '1972-09-27', 52, '6301032709720006', '081522524067', 0, 29, 1),
('EP2024110334', '7134134', 'EV202407000604', 'EV202407000601', 2, 'EV2024070006', 49, 'I Made Pande Revan', 'P', '2010-11-05', 13, '5102060511100001', '088223555689', 0, 1, 1),
('EP2024110335', '00000', 'EV202407000604', 'EV202407000601', 1, 'EV2024070006', 32, 'Maximillian Ekhi Rachmat Putra', 'P', '2012-04-16', 12, '3175081604121006', '081519802010', 0, 30, 1),
('EP2024110336', '00', 'EV202407000606', 'EV202407000601', 2, 'EV2024070006', 48, 'Edric Edbert Maramis', 'P', '2015-12-20', 8, '7571022012150002', '085399920045', 0, 1, 1),
('EP2024110337', '0', 'EV202407000624', 'EV202407000608', 2, 'EV2024070006', 39, 'NORMA ANGGARA, M.Si', 'P', '1991-06-03', 33, '6372020306910003', '081349719667', 0, 29, 1),
('EP2024110338', '0', 'EV202407000622', 'EV202407000608', 1, 'EV2024070006', 39, 'ENDANG PRATIWI,M.Pd', 'W', '1991-09-11', 33, '1209135109910001', '081349719667', 0, 29, 1),
('EP2024110339', '0', 'EV202407000624', 'EV202407000608', 2, 'EV2024070006', 40, 'YUPENTUS', 'P', '1985-01-20', 39, '6212012001850001', '081253093351', 0, 28, 1),
('EP2024110340', '0', 'EV202407000624', 'EV202407000608', 2, 'EV2024070006', 40, 'KASNO, S.Pd., M.Pd', 'P', '1966-06-21', 58, '6212012106660001', '082252167474', 0, 28, 1),
('EP2024110341', '00000', 'EV202407000602', 'EV202407000601', 1, 'EV2024070006', 32, 'Maximiliano  Marrhuimawan', 'P', '2008-08-17', 16, '3671091708080003', '08121033150', 0, 30, 1),
('EP2024110342', '0', 'EV202407000624', 'EV202407000608', 2, 'EV2024070006', 40, 'TRIYATMINI, S.Sos., S.Pd., M.P', 'W', '1975-02-06', 49, '6212014602750003', '082153178826', 0, 28, 1),
('EP2024110343', '0', 'EV202407000624', 'EV202407000608', 2, 'EV2024070006', 39, 'NOR AINAH,S.Pd.I', 'W', '1977-03-13', 47, '6371025303770012', '081349719667', 0, 29, 1),
('EP2024110344', '0', 'EV202407000618', 'EV202407000605', 2, 'EV2024070006', 40, 'NOOR LATIFAH, A.Md.Keb', 'W', '1991-01-10', 33, '6302065001910007', '082251661214', 0, 28, 1),
('EP2024110345', '0', 'EV202407000615', 'EV202407000604', 2, 'EV2024070006', 40, 'THOMAS RIANTO', 'P', '1989-03-18', 35, '6205051803890001', '085652214969', 0, 28, 1),
('EP2024110346', '0', 'EV202407000602', 'EV202407000601', 2, 'EV2024070006', 53, 'Reinhard Christian', 'P', '2007-03-22', 17, '8271032203070001', '082187088585', 0, 1, 1),
('EP2024110347', '0', 'EV202407000604', 'EV202407000601', 2, 'EV2024070006', 53, 'Mikhael Lisakolan Tjan', 'P', '2011-04-22', 13, '0111243113', '081326161625', 0, 1, 1),
('EP2024110348', '0', 'EV202407000615', 'EV202407000604', 2, 'EV2024070006', 40, 'ROPITAL', 'P', '1989-04-10', 35, '6205051004890005', '082255408577', 0, 28, 1),
('EP2024110349', '0', 'EV202407000624', 'EV202407000608', 2, 'EV2024070006', 40, 'SERA INDRIANI', 'W', '1999-04-06', 25, '6205064604990002', '085750237574', 0, 28, 1),
('EP2024110350', '0', 'EV202407000615', 'EV202407000604', 2, 'EV2024070006', 40, 'ANISA NUR SHALEHA', 'W', '2006-06-02', 18, '6205054206050007', '081521781176', 0, 28, 1),
('EP2024110351', '00', 'EV202407000612', 'EV202407000601', 2, 'EV2024070006', 48, 'Johanna Danielle Laksono', 'W', '2014-09-17', 10, '3578135709140002', '085240422323', 0, 1, 1),
('EP2024110352', '0', 'EV202407000615', 'EV202407000604', 2, 'EV2024070006', 40, 'DAHLIA ANGGRAINI', 'W', '2004-11-08', 19, '6205054170500090', '085787046526', 0, 28, 1),
('EP2024110353', '0', 'EV202407000613', 'EV202407000601', 2, 'EV2024070006', 39, 'BUNGA FEBRIANA PUTRI', 'W', '2016-02-12', 8, '631106522160001', '081349719667', 0, 29, 1),
('EP2024110354', '00000', 'EV202407000607', 'EV202407000601', 1, 'EV2024070006', 32, 'Ethan Phedy Peng', 'P', '2017-01-22', 7, '3674032201170003', '081519802010', 0, 30, 1),
('EP2024110355', '00000', 'EV202407000606', 'EV202407000601', 1, 'EV2024070006', 32, 'Karlsen Sitanggang', 'P', '2015-01-08', 9, '3175070801151015', '081519802010', 0, 30, 1),
('EP2024110356', '00000', 'EV202407000603', 'EV202407000601', 1, 'EV2024070006', 32, 'Devdan Yusouf Maulana Betta', 'P', '2010-04-03', 14, '3276010304100001', '081519802010', 0, 30, 1),
('EP2024110357', '00000', 'EV202407000603', 'EV202407000601', 1, 'EV2024070006', 32, 'Adya  Raka Bakil Prakoso', 'P', '2009-06-27', 15, '3671132706090004', '081519802010', 0, 30, 1),
('EP2024110358', '00000', 'EV202407000610', 'EV202407000601', 1, 'EV2024070006', 32, 'Lidya Salsabila Hafidzah', 'P', '2009-06-16', 15, '3603195606090003', '081519802010', 0, 30, 1),
('EP2024110359', '00000', 'EV202407000603', 'EV202407000601', 1, 'EV2024070006', 32, 'Lorenzo  Alexzander Pelupessy', 'P', '2009-01-15', 15, '3174061501090002', '081519802010', 0, 30, 1),
('EP2024110360', '00000', 'EV202407000602', 'EV202407000601', 1, 'EV2024070006', 32, 'Steven Daniel				', 'P', '2008-07-07', 16, '3671010707080005', '081519802010', 0, 30, 1),
('EP2024110361', '00000', 'EV202407000603', 'EV202407000601', 1, 'EV2024070006', 32, 'Mikael Maria Adrian				', 'P', '2010-10-21', 14, '3174042110101010', '081519802010', 0, 30, 1),
('EP2024110362', '00000', 'EV202407000603', 'EV202407000601', 1, 'EV2024070006', 32, 'Rizky Fajar Reyhan Nurtomo				', 'P', '2010-12-03', 14, '367103056090003', '081519802010', 0, 30, 1),
('EP2024110363', '00000', 'EV202407000604', 'EV202407000601', 1, 'EV2024070006', 32, 'Keefe Nathan The				', 'P', '2012-04-23', 12, '3173081005190013', '081519802010', 0, 30, 1),
('EP2024110364', '00000', 'EV202407000604', 'EV202407000601', 1, 'EV2024070006', 32, 'Rio Jonathan				', 'P', '2011-06-30', 13, '3671013006110002', '081519802010', 0, 30, 1),
('EP2024110365', '00000', 'EV202407000604', 'EV202407000601', 1, 'EV2024070006', 32, 'Labiq Rishell Arianto				', 'P', '2012-04-12', 12, '3173081604121000', '081519802010', 0, 30, 1),
('EP2024110366', '00000', 'EV202407000601', 'EV202407000601', 1, 'EV2024070006', 32, 'Rayhan Satria Nugraha				', 'P', '2013-08-03', 11, 'Rayhan Satria Nu', '081519802010', 0, 30, 1),
('EP2024110367', '1724', 'EV202407000605', 'EV202407000601', 1, 'EV2024070006', 35, 'ADHYASTHA GHAZI KURNIAWAN', 'P', '2014-05-03', 10, '00', '00', 0, 16, 1),
('EP2024110368', '-', 'EV202407000601', 'EV202407000601', 1, 'EV2024070006', 26, 'Muhammad Bintang Saputra', 'P', '2005-04-23', 19, '1571072304050061', '082182160025', 0, 31, 1),
('EP2024110369', '0', 'EV202407000615', 'EV202407000604', 1, 'EV2024070006', 40, 'AMRULLAH HASIBUAN', 'P', '1989-08-18', 35, '6271031808890013', '082252486511', 0, 28, 1),
('EP2024110370', '-', 'EV202407000608', 'EV202407000601', 1, 'EV2024070006', 26, 'Jesi Aulia', 'W', '2005-08-29', 19, '1506046908050002', '083819901653', 0, 31, 1),
('EP2024110371', '00000', 'EV202407000604', 'EV202407000601', 2, 'EV2024070006', 32, '	Muhammad Wildan 		', 'P', '2012-03-11', 12, '2171031103120001', '081372827422', 0, 30, 1),
('EP2024110372', '-', 'EV202407000609', 'EV202407000601', 1, 'EV2024070006', 26, 'Aprilia Tri Puji Lestari', 'W', '2007-04-27', 17, '1505036704070001', '081367098074', 0, 31, 1),
('EP2024110373', '00000', 'EV202407000611', 'EV202407000602', 1, 'EV2024070006', 32, 'Beby Benita Sabana', 'W', '2010-02-26', 14, '3671036602100001', '081519802010', 0, 30, 1),
('EP2024110374', '-', 'EV202407000603', 'EV202407000601', 1, 'EV2024070006', 26, 'Khairul Amri', 'P', '2010-09-29', 14, '1505022911100003', '083836354334', 0, 31, 1),
('EP2024110375', '00000', 'EV202407000609', 'EV202407000602', 1, 'EV2024070006', 32, 'Putri Hajarisma Azzahra', 'W', '2007-12-20', 16, '3671066012070001', '081519802010', 0, 30, 1),
('EP2024110377', '-', 'EV202407000609', 'EV202407000603', 1, 'EV2024070006', 61, '* ALISA YULIA PUTRI', 'W', '2008-07-23', 16, '3201166307080005', '081295170304', 0, 18, 1),
('EP2024110379', '0', 'EV202407000605', 'EV202407000601', 2, 'EV2024070006', 40, 'PAUL TIMOTHY', 'P', '2013-04-12', 11, '6271031304130001', '0', 0, 28, 1),
('EP2024110381', '0', 'EV202407000606', 'EV202407000601', 2, 'EV2024070006', 40, 'MIKHAEL RASHDIEN', 'P', '2016-09-02', 8, '627103020916000', '0', 0, 28, 1),
('EP2024110382', '-', 'EV202407000609', 'EV202407000603', 1, 'EV2024070006', 61, 'FRIDA NADINE FELLICIA', 'W', '2008-04-03', 16, '3275024304080011', '088291236297', 0, 18, 1),
('EP2024110383', '0', 'EV202407000603', 'EV202407000601', 2, 'EV2024070006', 40, 'RAKHA FADILLAH ABISEKA', 'P', '2009-05-27', 15, '6271032705090005', '0', 0, 28, 1),
('EP2024110386', '21785', 'EV202407000603', 'EV202407000601', 1, 'EV2024070006', 40, 'RAZAN SATU AMBUN JULIAT', 'P', '2009-07-01', 15, '6212010107090002', '082256804872', 0, 28, 1),
('EP2024110388', '0', 'EV202407000602', 'EV202407000601', 2, 'EV2024070006', 40, 'THOSINE TATEAN SYALOM', 'P', '2007-11-26', 16, '6203012611070000', '087842041107', 0, 28, 1),
('EP2024110391', '0', 'EV202407000613', 'EV202407000601', 2, 'EV2024070006', 40, 'LOVELYQUEEN CHRISTIALINN', 'P', '2015-06-05', 9, '6271034506150002', '0', 0, 28, 1),
('EP2024110392', '0', 'EV202407000624', 'EV202407000608', 2, 'EV2024070006', 40, 'ILIS, S.Pd., WNM', 'W', '1964-05-01', 60, '6204064105640002', '085250899920', 0, 28, 1),
('EP2024110393', '0', 'EV202407000624', 'EV202407000608', 2, 'EV2024070006', 36, 'Raka Nugraha, S.IP', 'P', '1995-02-08', 29, '3471142808950001', '082229891546', 0, 15, 1),
('EP2024110394', '0', 'EV202407000625', 'EV202407000608', 1, 'EV2024070006', 40, 'RAKHMAT AGUSTIONO, WN', 'P', '1972-05-15', 52, '6271011505720006', '085390443398', 0, 28, 1),
('EP2024110395', '00000', 'EV202407000609', 'EV202407000601', 1, 'EV2024070006', 32, 'Mutia Candra Wardani', 'W', '2008-04-28', 16, '3174106804081001', '081519802010', 0, 30, 1),
('EP2024110396', '0', 'EV202407000609', 'EV202407000601', 2, 'EV2024070006', 40, 'JESSICA OCTARY  FORTUNA', 'P', '2008-10-05', 16, '6271034510080006', '0', 0, 28, 1),
('EP2024110397', '0', 'EV202407000622', 'EV202407000608', 2, 'EV2024070006', 40, 'SARTONO', 'P', '1981-10-07', 43, '6209030710810001', '082255146154', 0, 28, 1),
('EP2024110398', '0', 'EV202407000625', 'EV202407000608', 1, 'EV2024070006', 36, 'Jumariyanto, ST', 'P', '1972-07-04', 52, '3401070704720002', '085228637000', 0, 15, 1),
('EP2024110399', '0', 'EV202407000625', 'EV202407000608', 1, 'EV2024070006', 36, 'Iwan Prihastomo', 'P', '1953-02-11', 71, '3404082111530001', '081959832489', 0, 15, 1),
('EP2024110400', '0', 'EV202407000615', 'EV202407000604', 1, 'EV2024070006', 33, 'Achmad Deni Jaelani', 'P', '1969-07-26', 55, '0', '0', 0, 13, 1),
('EP2024110401', '0', 'EV202407000615', 'EV202407000604', 1, 'EV2024070006', 33, 'Tahjudin Nur', 'P', '1975-11-29', 48, '0', '0', 0, 13, 1),
('EP2024110402', '0', 'EV202407000615', 'EV202407000604', 1, 'EV2024070006', 40, 'TITUS SUTIANTO', 'P', '2003-08-09', 21, '6271030908030006', '089682230901', 0, 28, 1),
('EP2024110403', '0', 'EV202407000622', 'EV202407000608', 2, 'EV2024070006', 40, 'APRIANDY', 'P', '1988-04-20', 36, '6271032004880006', '0', 0, 28, 1),
('EP2024110404', '0', 'EV202407000622', 'EV202407000608', 1, 'EV2024070006', 40, 'MIRA RUSANI', 'W', '1976-11-21', 47, '6209036111760002', '0', 0, 28, 1),
('EP2024110405', '0', 'EV202407000624', 'EV202407000608', 1, 'EV2024070006', 40, 'HARTONI, S.Pd., WN., PNP', 'P', '1971-02-20', 53, '6271032002710001', '081347353132', 0, 28, 1),
('EP2024110406', '0', 'EV202407000603', 'EV202407000601', 2, 'EV2024070006', 34, 'ADITHYA FIRMANSYAH ', 'P', '2009-08-11', 15, '0', '0', 0, 14, 1),
('EP2024110407', '0', 'EV202407000612', 'EV202407000601', 2, 'EV2024070006', 34, 'Lychelle Gwen Ferdinan ', 'W', '2015-10-03', 9, '0', '0', 0, 14, 1),
('EP2024110408', '0', 'EV202407000607', 'EV202407000601', 1, 'EV2024070006', 34, 'Vicenzo Finn Winarto', 'P', '2017-09-10', 7, '0', '0', 0, 14, 1),
('EP2024110409', '0', 'EV202407000609', 'EV202407000601', 1, 'EV2024070006', 34, 'Alisa Yulia Putri ', 'W', '2008-07-23', 18, '0', '0', 0, 14, 1),
('EP2024110410', '0', 'EV202407000610', 'EV202407000601', 1, 'EV2024070006', 34, 'Kirani Ardwanariswari ', 'W', '2009-09-14', 16, '0', '0', 0, 14, 1),
('EP2024110411', '0', 'EV202407000613', 'EV202407000601', 1, 'EV2024070006', 34, 'Khansa Safia Hasna ', 'W', '2015-12-22', 8, '0', '0', 0, 14, 1),
('EP2024110412', '0', 'EV202407000602', 'EV202407000603', 1, 'EV2024070006', 34, 'Handaru Juan Izzlinardhi', 'P', '2007-01-15', 17, '0', '0', 0, 14, 1),
('EP2024110413', '0', 'EV202407000602', 'EV202407000601', 1, 'EV2024070006', 34, 'Zaeik Nuh Hansmuda ', 'P', '2007-10-19', 17, '0', '0', 0, 14, 1),
('EP2024110414', '0', 'EV202407000603', 'EV202407000601', 1, 'EV2024070006', 34, 'Thoriq Fauzan Robbani ', 'P', '2009-10-23', 15, '0', '0', 0, 14, 1),
('EP2024110415', '0', 'EV202407000604', 'EV202407000601', 1, 'EV2024070006', 34, 'M. Fatih Winarta ', 'P', '2011-02-26', 13, '0', '0', 0, 14, 1),
('EP2024110416', '0', 'EV202407000604', 'EV202407000601', 1, 'EV2024070006', 34, 'Alfariza Yaumar ', 'P', '2011-01-03', 13, '0', '0', 0, 14, 1),
('EP2024110417', '0', 'EV202407000605', 'EV202407000601', 1, 'EV2024070006', 34, 'Tristan Haidar ', 'P', '2013-04-23', 11, '0', '0', 0, 14, 1),
('EP2024110418', '0', 'EV202407000606', 'EV202407000601', 1, 'EV2024070006', 34, 'M. Iqhsan Alghifari ', 'P', '2015-11-03', 9, '0', '0', 0, 14, 1),
('EP2024110419', '0', 'EV202407000608', 'EV202407000601', 1, 'EV2024070006', 34, 'Syifa Nisrina Khairunnisa ', 'W', '2006-09-23', 18, '0', '0', 0, 14, 1),
('EP2024110420', '0', 'EV202407000610', 'EV202407000601', 1, 'EV2024070006', 34, 'Arini Angelina Lovely', 'W', '2010-10-02', 14, '0', '0', 0, 14, 1),
('EP2024110421', '0', 'EV202407000613', 'EV202407000601', 1, 'EV2024070006', 34, 'Aira Fajriani', 'W', '2015-06-17', 9, '0', '0', 0, 14, 1),
('EP2024110422', '0', 'EV202407000603', 'EV202407000601', 1, 'EV2024070006', 34, 'Andreas Tio Parulian Tampubolo', 'P', '2009-06-10', 15, '0', '0', 0, 14, 1),
('EP2024110423', '0', 'EV202407000609', 'EV202407000601', 1, 'EV2024070006', 34, 'Irene Rumiris Ramona Sinurat ', 'W', '2008-08-22', 16, '0', '0', 0, 14, 1),
('EP2024110424', '0', 'EV202407000612', 'EV202407000601', 2, 'EV2024070006', 34, 'Shaina Aylakiva Megaranto', 'W', '2013-04-23', 11, '0', '0', 0, 14, 1),
('EP2024110425', '0', 'EV202407000614', 'EV202407000601', 2, 'EV2024070006', 34, 'Nebia Aqueenara Megaranto', 'W', '2017-10-21', 7, '0', '0', 0, 14, 1),
('EP2024110426', '0', 'EV202407000601', 'EV202407000601', 1, 'EV2024070006', 34, 'Assaini Hafidz Raja ', 'P', '2006-06-12', 18, '0', '0', 0, 14, 1),
('EP2024110427', '0', 'EV202407000602', 'EV202407000601', 1, 'EV2024070006', 34, 'Jeremy Ruben Kandau ', 'P', '2008-06-11', 16, '0', '0', 0, 14, 1),
('EP2024110428', '0', 'EV202407000608', 'EV202407000613', 1, 'EV2024070006', 34, 'Lintang Kalis Mala ', 'W', '2006-04-19', 18, '0', '0', 0, 14, 1),
('EP2024110429', '0', 'EV202407000602', 'EV202407000601', 1, 'EV2024070006', 34, 'Agha Faiz Ramdhani Syafi', 'P', '2008-09-05', 16, '0', '0', 0, 14, 1),
('EP2024110430', '0', 'EV202407000610', 'EV202407000601', 1, 'EV2024070006', 34, 'Laras Wibowo ', 'W', '2008-06-01', 15, '0', '0', 0, 14, 1),
('EP2024110431', '0', 'EV202407000603', 'EV202407000613', 1, 'EV2024070006', 34, 'Alden Raees Syafli ', 'P', '2009-11-13', 14, '0', '0', 0, 14, 1),
('EP2024110432', '0', 'EV202407000606', 'EV202407000613', 1, 'EV2024070006', 34, 'Frans Kosta Murti Sitanggang ', 'P', '2015-05-24', 9, '0', '0', 0, 14, 1),
('EP2024110433', '0', 'EV202407000606', 'EV202407000601', 1, 'EV2024070006', 34, 'Ramot Martua Manalu', 'P', '2015-06-12', 9, '0', '0', 0, 14, 1),
('EP2024110434', '0', 'EV202407000607', 'EV202407000613', 1, 'EV2024070006', 34, 'Neyma Martua Manalu ', 'P', '2017-11-07', 6, '0', '0', 0, 14, 1),
('EP2024110435', '0', 'EV202407000614', 'EV202407000601', 1, 'EV2024070006', 34, 'Ahsan Alfatih Nurul Ala ', 'W', '2017-05-26', 7, '0', '0', 0, 14, 1),
('EP2024110436', '0', 'EV202407000614', 'EV202407000613', 1, 'EV2024070006', 34, 'Evelyn Tria Lienora ', 'W', '2017-06-13', 7, '0', '0', 0, 14, 1),
('EP2024110437', '0000', 'EV202407000605', 'EV202407000601', 1, 'EV2024070006', 35, 'ARRAFI BAGUS SAPUTRA', 'P', '2014-10-18', 10, '00', '00', 0, 16, 1),
('EP2024110438', '0000', 'EV202407000607', 'EV202407000601', 1, 'EV2024070006', 35, 'RAFANDRA ARKHAN AL GHIFARI', 'P', '2017-12-15', 6, '00', '00', 0, 16, 1),
('EP2024110439', '0000', 'EV202407000615', 'EV202407000604', 1, 'EV2024070006', 35, 'EPHESIANS PRISMARANATHA ', 'P', '2004-09-07', 20, '00', '00', 0, 16, 1),
('EP2024110440', '00000', 'EV202407000602', 'EV202407000601', 1, 'EV2024070006', 32, 'Amrafel  Hardman Tendean', 'P', '2007-08-15', 17, '7171081508070003', '081519802010', 0, 30, 1),
('EP2024110441', '00000', 'EV202407000605', 'EV202407000601', 1, 'EV2024070006', 32, 'M Hasan Noorsaid				', 'P', '2013-05-27', 11, '7271062705130001', '081519802010', 0, 30, 1),
('EP2024110442', '00000', 'EV202407000611', 'EV202407000601', 1, 'EV2024070006', 32, 'Audra Devi Abdullah				', 'W', '2012-07-14', 12, '3671135407120005', '081519802010', 0, 30, 1),
('EP2024110443', '00000', 'EV202407000603', 'EV202407000601', 1, 'EV2024070006', 32, 'Firman Amali alghifari				', 'P', '2010-08-07', 14, '3673010708100004', '081519802010', 0, 30, 1),
('EP2024110444', '00', 'EV202407000612', 'EV202407000601', 1, 'EV2024070006', 23, 'Alma Fatiha Ghassani', 'W', '2014-08-20', 10, '1207266008140008', '00', 0, 1, 1),
('EP2024110445', '00000', 'EV202407000605', 'EV202407000601', 1, 'EV2024070006', 32, 'Iqbal Akhmad Alfakhri				', 'P', '2013-05-27', 11, '3674031710150006', '081519802010', 0, 30, 1),
('EP2024110446', '0', 'EV202407000623', 'EV202407000605', 1, 'EV2024070006', 59, 'Yan Maurits Mansawan', 'P', '1987-04-24', 37, '2171112404879012', '081314030187', 0, 33, 1),
('EP2024110447', '0', 'EV202407000615', 'EV202407000604', 2, 'EV2024070006', 59, 'Sepriadi Bumbungan', 'P', '1989-09-09', 35, '7371120909890002', '085340945565', 0, 33, 1),
('EP2024110448', '0', 'EV202407000615', 'EV202407000604', 1, 'EV2024070006', 59, 'Yusriadi', 'P', '1975-02-22', 49, '1207262202750002', '085261999510', 0, 33, 1),
('EP2024110449', '0', 'EV202407000615', 'EV202407000604', 1, 'EV2024070006', 33, 'Fitrizal Yudaputra', 'P', '1966-02-06', 58, '0', '0', 0, 13, 1),
('EP2024110450', '21158', 'EV202407000603', 'EV202407000601', 1, 'EV2024070006', 38, 'Made Dipa Nugraha Paramartha P', 'P', '2008-12-25', 15, '5103062512080001', '081338140631', 0, 19, 1),
('EP2024110451', '00', 'EV202407000603', 'EV202407000601', 1, 'EV2024070006', 38, 'Alexander Michael Lee', 'P', '2010-02-02', 14, '3173060202090006', '087712990828', 0, 19, 1),
('EP2024110452', '21688', 'EV202407000604', 'EV202407000601', 1, 'EV2024070006', 38, 'I Putu Radika', 'P', '2011-03-02', 13, '5103050203110001', '087712990828', 0, 19, 1),
('EP2024110453', '0', 'EV202407000615', 'EV202407000604', 2, 'EV2024070006', 59, 'Prayoga Romin Saputra', 'P', '1999-03-06', 25, '9109010603990002', '081240568985', 0, 33, 1),
('EP2024110454', '00', 'EV202407000604', 'EV202407000601', 1, 'EV2024070006', 38, 'Elnathan Valentino', 'P', '2012-02-14', 12, '5103051402120004', '087712990828', 0, 19, 1),
('EP2024110455', '00', 'EV202407000604', 'EV202407000601', 1, 'EV2024070006', 38, 'AA Ngurah Ramachandra', 'P', '2011-09-30', 13, '3174073009111002', '081338140631', 0, 19, 1),
('EP2024110456', '00', 'EV202407000605', 'EV202407000601', 1, 'EV2024070006', 38, 'Kadek Lingga Baskara', 'P', '2013-07-23', 11, '5101032307130002', '087712990828', 0, 19, 1),
('EP2024110457', '00', 'EV202407000607', 'EV202407000601', 1, 'EV2024070006', 38, 'Gregorius Agung Michael Rande', 'P', '2017-09-20', 7, '5103052009170001', '087712990828', 0, 19, 1),
('EP2024110458', '21384', 'EV202407000611', 'EV202407000601', 1, 'EV2024070006', 38, 'Nym Yurisaka Kirana Paramartha', 'W', '2011-03-05', 13, '5103064503110001', '081338140631', 0, 19, 1),
('EP2024110459', '00', 'EV202407000611', 'EV202407000601', 1, 'EV2024070006', 38, 'Divine Charmaine Lim', 'W', '2011-08-08', 13, '5171034808110003', '081338140631', 0, 19, 1),
('EP2024110460', '00', 'EV202407000608', 'EV202407000601', 2, 'EV2024070006', 38, 'AA Istri Oka Pradnyani', 'W', '2006-06-12', 18, '5105035206060002', '081236318236', 0, 19, 1),
('EP2024110461', '0', 'EV202407000615', 'EV202407000604', 1, 'EV2024070006', 33, 'Ir. Sri Cahyo Utomo', 'P', '1971-02-12', 53, '0', '0', 0, 13, 1),
('EP2024110462', '00', 'EV202407000625', 'EV202407000608', 1, 'EV2024070006', 38, 'Paskalis Budy Hartono', 'P', '1970-01-12', 54, '5171021201700001', '08113866318', 0, 19, 1),
('EP2024110463', '00', 'EV202407000624', 'EV202407000608', 2, 'EV2024070006', 38, 'Paskalis Budy Hartono', 'P', '1970-01-12', 54, '5171021201700001', '08113866318', 0, 19, 1),
('EP2024110464', '19804', 'EV202407000601', 'EV202407000611', 1, 'EV2024070006', 38, 'Fabian Glen Mariano', 'P', '2007-05-17', 17, 'E4882884', '08113866318', 0, 19, 1),
('EP2024110465', '0', 'EV202407000625', 'EV202407000608', 1, 'EV2024070006', 40, 'BRILLIAN RAKHMAT DANOVAN, WNP', 'P', '2002-11-10', 21, '6271011011020004', '082151880301', 0, 28, 1),
('EP2024110466', '1761', 'EV202407000604', 'EV202407000601', 1, 'EV2024070006', 35, 'MUHAMAD ARFA', 'P', '2012-06-13', 12, '00', '00', 0, 16, 1),
('EP2024110467', '00', 'EV202407000625', 'EV202407000608', 1, 'EV2024070006', 35, 'DRS. TIBERTIUS MARIO MANAPODE ', 'P', '1960-08-11', 64, '00', '00', 0, 16, 1),
('EP2024110468', '0000', 'EV202407000624', 'EV202407000608', 1, 'EV2024070006', 35, 'ISTI WIDODO, PNP WD', 'P', '1967-07-03', 57, '00', '00', 0, 16, 1),
('EP2024110469', '0000', 'EV202407000623', 'EV202407000608', 1, 'EV2024070006', 35, 'MUHAMMAD BINTANG ADI PRAJAMUKT', 'P', '1988-06-02', 36, '00', '00', 0, 16, 1),
('EP2024110470', '0000', 'EV202407000624', 'EV202407000608', 1, 'EV2024070006', 35, 'ALI SADIKIN, NA MN PN', 'P', '1969-05-12', 55, '00', '00', 0, 16, 1),
('EP2024110471', '0000', 'EV202407000625', 'EV202407000608', 1, 'EV2024070006', 35, 'MOH. AMIRUDIN', 'P', '1970-06-21', 54, '00', '00', 0, 16, 1),
('EP2024110472', '-', 'EV202407000603', 'EV202407000601', 2, 'EV2024070006', 61, 'FILBER HOJAYA', 'P', '2010-05-27', 14, '3173072705101002', '087875555507', 0, 18, 1),
('EP2024110473', '-', 'EV202407000611', 'EV202407000601', 2, 'EV2024070006', 61, 'ELENA GANI OKTAVIANI', 'W', '2011-10-01', 13, '3275064110110008', '082113835896', 0, 18, 1),
('EP2024110474', '-', 'EV202407000604', 'EV202407000601', 2, 'EV2024070006', 61, 'AMADEUS DHARMAPUTRA KUSUMO', 'P', '2011-03-14', 13, '3673011403110010', '085777767814', 0, 18, 1),
('EP2024110475', '0', 'EV202407000625', 'EV202407000608', 1, 'EV2024070006', 39, 'ACHMAD SYARIF,SE', 'P', '1983-04-22', 41, '6371042204830010', '081349719667', 0, 29, 1),
('EP2024110476', '0', 'EV202407000625', 'EV202407000608', 1, 'EV2024070006', 39, 'M. SYAIFANI ZULFA,S.Ag', 'P', '1973-12-08', 50, '6372060812730003', '081349719667', 0, 29, 1),
('EP2024110477', '-', 'EV202407000604', 'EV202407000603', 1, 'EV2024070006', 61, '* RAMA DANISWARA SETYA NUGRAHA', 'P', '2011-01-08', 13, '3517090801110003', '082116013272', 0, 18, 1),
('EP2024110478', '0', 'EV202407000625', 'EV202407000608', 1, 'EV2024070006', 40, 'H. ILHAM BUSRA HB, WN, PN', 'P', '1985-02-12', 39, '6271011001150007', '0', 0, 28, 1),
('EP2024110480', '-', 'EV202407000612', 'EV202407000601', 2, 'EV2024070006', 61, 'BELVANYA RIADI HARTONO', 'W', '2013-02-12', 11, '3172065202131001', '085210038037', 0, 18, 1),
('EP2024110481', '-', 'EV202407000610', 'EV202407000601', 2, 'EV2024070006', 61, 'ANGELA SOLAGRACIA MUNTE', 'W', '2010-06-30', 14, '3175087006101003', '0811849186', 0, 18, 1),
('EP2024110482', '-', 'EV202407000613', 'EV202407000601', 2, 'EV2024070006', 61, 'VALENCIA IRENA SUWANDI', 'W', '2015-04-12', 9, '3175025204151002', '08568359000', 0, 18, 1),
('EP2024110483', '-', 'EV202407000606', 'EV202407000601', 2, 'EV2024070006', 61, 'YESAYA ADEODATUS PUTRA', 'P', '2015-06-25', 9, '3216082506150001', '081806043155', 0, 18, 1),
('EP2024110484', '-', 'EV202407000607', 'EV202407000601', 1, 'EV2024070006', 29, 'Wafi Dzakwan Adillah', 'P', '2017-08-11', 7, '1906011108170004', '087896482145', 0, 36, 1),
('EP2024110485', '-', 'EV202407000604', 'EV202407000601', 1, 'EV2024070006', 29, 'Fadil Abil A\'dillah', 'P', '2012-03-25', 12, '1906012503120001', '087896482145', 0, 36, 1),
('EP2024110486', '-', 'EV202407000604', 'EV202407000601', 1, 'EV2024070006', 29, 'Hadiyan Qodri', 'P', '2011-05-01', 13, '1906010105110002', '087896482145', 0, 36, 1),
('EP2024110487', '0', 'EV202407000606', 'EV202407000601', 1, 'EV2024070006', 27, 'FENDOU ARAHAN MUHAMMAD', 'P', '2016-09-04', 8, '137602409160001', '085263742574', 0, 35, 1),
('EP2024110488', '0', 'EV202407000603', 'EV202407000601', 1, 'EV2024070006', 27, 'ZAFA FAVIAN RASYA', 'P', '2010-04-25', 14, '3275032504100007', '085263742574', 0, 35, 1),
('EP2024110489', '0', 'EV202407000604', 'EV202407000601', 1, 'EV2024070006', 27, 'MUHAMMAD DAFA ADLAN ', 'P', '2011-02-11', 13, '130713110210002', '085263742574', 0, 35, 1),
('EP2024110490', '-', 'EV202407000622', 'EV202407000608', 2, 'EV2024070006', 61, 'BENYAMIN JOHANNIS', 'P', '1972-10-08', 52, '3674020810720002', '087730207337', 0, 18, 1),
('EP2024110491', '-', 'EV202407000622', 'EV202407000608', 2, 'EV2024070006', 61, 'RIKA PEBRINA BR TARIGAN', 'W', '1997-11-30', 26, '1206037011970001', '081536209510', 0, 18, 1),
('EP2024110492', '-', 'EV202407000603', 'EV202407000601', 1, 'EV2024070006', 26, 'Kevin March Marlyn Ignatius', 'P', '2009-03-14', 15, '1571071403090021', '082378734529', 0, 31, 1),
('EP2024110493', '-', 'EV202407000615', 'EV202407000604', 1, 'EV2024070006', 26, 'Heri', 'P', '1970-08-15', 54, '1506021508700003', '082280508221', 0, 31, 1),
('EP2024110494', '-', 'EV202407000622', 'EV202407000608', 2, 'EV2024070006', 60, 'Hanny Candra Aprilia', 'W', '1981-04-24', 43, '7315116404810001', '081332332716', 0, 21, 1),
('EP2024110495', '21380', 'EV202407000610', 'EV202407000614', 1, 'EV2024070006', 47, 'ZILLA ALTOFUN NISA', 'W', '2010-08-08', 14, '3512094808100002', '081245446881', 0, 27, 1),
('EP2024110496', '0', 'EV202407000602', 'EV202407000601', 2, 'EV2024070006', 59, 'CLHEMENS EVAN JAN M KOTOROK', 'P', '2008-11-18', 15, '9109011811080003', '081314030187', 0, 33, 1),
('EP2024110497', '0', 'EV202407000604', 'EV202407000601', 2, 'EV2024070006', 59, 'JORDAN IMANUEL EVERT KURNY', 'P', '2011-10-26', 13, '9109012610110002', '081314030187', 0, 33, 1),
('EP2024110498', '0', 'EV202407000604', 'EV202407000601', 2, 'EV2024070006', 59, 'ADELARD JIBRIL', 'P', '2011-11-14', 12, '9109011411110006', '081314030187', 0, 33, 1),
('EP2024110499', '20754', 'EV202407000609', 'EV202407000601', 1, 'EV2024070006', 40, 'SYIFA RAKHMATUZAHRA', 'W', '2008-05-14', 16, '6271015405080002', '085954635488', 0, 28, 1),
('EP2024110500', '0', 'EV202407000622', 'EV202407000608', 1, 'EV2024070006', 40, 'SARTINI', 'W', '1978-08-31', 46, '6271017108780002', '081253993503', 0, 28, 1),
('EP2024110501', '-', 'EV202407000610', 'EV202407000601', 2, 'EV2024070006', 29, 'Falisha Lana Wijaya', 'W', '2010-02-04', 14, '0102999394', '087896482145', 0, 36, 1),
('EP2024110502', '-', 'EV202407000610', 'EV202407000601', 2, 'EV2024070006', 29, 'Jessica Hendarta', 'P', '2010-01-11', 14, '1902016101100003', '087896482145', 0, 36, 1),
('EP2024110503', '0', 'EV202407000601', 'EV202407000601', 1, 'EV2024070006', 24, 'Wahyu Hidayat Nasution', 'P', '2005-03-08', 19, '0', '0', 0, 37, 1),
('EP2024110504', '0', 'EV202407000602', 'EV202407000601', 1, 'EV2024070006', 24, 'Richie Hermawan', 'P', '2007-03-22', 17, '0', '0', 0, 37, 1),
('EP2024110505', '-', 'EV202407000603', 'EV202407000601', 2, 'EV2024070006', 29, 'Ridho Nudin', 'P', '2009-04-23', 15, '1902012304090005', '087896482145', 0, 36, 1),
('EP2024110506', '0', 'EV202407000602', 'EV202407000601', 1, 'EV2024070006', 24, 'Rayhan Lando Harsa', 'P', '2008-08-08', 16, '0', '0', 0, 37, 1),
('EP2024110507', '0', 'EV202407000603', 'EV202407000601', 1, 'EV2024070006', 24, 'Randi Wijaya', 'P', '2009-01-24', 15, '0', '0', 0, 37, 1),
('EP2024110508', '0', 'EV202407000603', 'EV202407000601', 1, 'EV2024070006', 24, 'Kenan Lowellim Bendiclano', 'P', '2009-03-11', 15, '0', '0', 0, 37, 1),
('EP2024110509', '0', 'EV202407000603', 'EV202407000601', 1, 'EV2024070006', 24, 'M. Muzava', 'P', '2009-09-22', 15, '0', '0', 0, 37, 1),
('EP2024110510', '0', 'EV202407000603', 'EV202407000601', 1, 'EV2024070006', 24, 'M. Muzavi', 'P', '2009-09-22', 15, '0', '0', 0, 37, 1),
('EP2024110511', '-', 'EV202407000622', 'EV202407000608', 2, 'EV2024070006', 61, 'SUFIAN', 'P', '1975-04-24', 49, '3175032404750008', '081915343354', 0, 18, 1),
('EP2024110512', '0', 'EV202407000604', 'EV202407000601', 1, 'EV2024070006', 24, 'Rayyan Arya Sutha ', 'P', '2012-06-10', 12, '0', '0', 0, 37, 1),
('EP2024110513', '0', 'EV202407000604', 'EV202407000601', 1, 'EV2024070006', 24, 'El Noia Lingga', 'P', '2011-02-25', 13, '0', '0', 0, 37, 1),
('EP2024110514', '0', 'EV202407000604', 'EV202407000601', 1, 'EV2024070006', 24, 'Jed Lintang Brahmaputra', 'P', '2012-03-26', 12, '0', '0', 0, 37, 1),
('EP2024110515', '0', 'EV202407000604', 'EV202407000601', 1, 'EV2024070006', 24, 'Agus Rahmat Ramadhan', 'P', '2011-08-05', 13, '0', '0', 0, 37, 1),
('EP2024110516', '0', 'EV202407000604', 'EV202407000601', 1, 'EV2024070006', 24, 'Samuel Alexander Joseph', 'P', '2011-11-06', 12, '0', '0', 0, 37, 1),
('EP2024110517', '0', 'EV202407000605', 'EV202407000601', 1, 'EV2024070006', 24, 'Darius Kurniawan ', 'P', '2013-02-11', 11, '0', '0', 0, 37, 1),
('EP2024110518', '0', 'EV202407000605', 'EV202407000601', 1, 'EV2024070006', 24, 'M Ikhsan Alfarisy Mustafa', 'P', '2013-07-23', 11, '0', '0', 0, 37, 1),
('EP2024110519', '0', 'EV202407000606', 'EV202407000601', 1, 'EV2024070006', 24, 'Swisstend Lim', 'P', '2015-04-30', 9, '0', '0', 0, 37, 1),
('EP2024110520', '0', 'EV202407000606', 'EV202407000601', 1, 'EV2024070006', 24, 'Nathanael Joseph Tinambunan', 'P', '2015-12-01', 8, '0', '0', 0, 37, 1),
('EP2024110521', '0', 'EV202407000607', 'EV202407000601', 1, 'EV2024070006', 24, 'Nicholas Sean Tinambunan', 'P', '2017-01-27', 7, '0', '0', 0, 37, 1),
('EP2024110522', '0', 'EV202407000609', 'EV202407000601', 1, 'EV2024070006', 24, 'Aisyah Putri', 'W', '2007-04-06', 17, '0', '0', 0, 37, 1),
('EP2024110523', '0', 'EV202407000611', 'EV202407000601', 1, 'EV2024070006', 24, 'Wilda Nurhanifah', 'W', '2011-10-18', 13, '0', '0', 0, 37, 1),
('EP2024110524', '-', 'EV202407000604', 'EV202407000601', 2, 'EV2024070006', 29, 'Akhdan Dica Alfakhruzy', 'P', '2011-06-03', 13, '0112294218', '087896482145', 0, 36, 1),
('EP2024110525', '0', 'EV202407000612', 'EV202407000601', 1, 'EV2024070006', 24, 'Syaqilah Ammira Putri', 'W', '2014-07-29', 10, '0', '0', 0, 37, 1),
('EP2024110526', '0', 'EV202407000613', 'EV202407000601', 1, 'EV2024070006', 24, 'Rania Pramesthi', 'W', '2016-08-03', 8, '0', '0', 0, 37, 1),
('EP2024110527', '0', 'EV202407000614', 'EV202407000601', 1, 'EV2024070006', 24, 'Navisah Putri Aura', 'W', '2017-05-12', 7, '0', '0', 0, 37, 1),
('EP2024110528', '-', 'EV202407000615', 'EV202407000604', 2, 'EV2024070006', 29, 'Raden Mas Didi Prima', 'P', '1999-12-03', 24, '1902010312990004', '087896482145', 0, 36, 1),
('EP2024110529', '0', 'EV202407000613', 'EV202407000601', 1, 'EV2024070006', 24, 'Shakila Alyssa Santyarso ', 'W', '2015-08-27', 9, '0', '0', 0, 37, 1),
('EP2024110530', '-', 'EV202407000615', 'EV202407000604', 2, 'EV2024070006', 29, 'Triani Wibowo', 'P', '1988-03-26', 36, '3275012803880009', '087896482145', 0, 36, 1),
('EP2024110531', '0', 'EV202407000625', 'EV202407000608', 1, 'EV2024070006', 24, 'Drajat Tri Hartadi', 'P', '1964-02-13', 60, '0', '0', 0, 37, 1),
('EP2024110532', '0', 'EV202407000625', 'EV202407000608', 1, 'EV2024070006', 24, 'Kordias Pasaribu', 'P', '1976-05-01', 48, '0', '0', 0, 37, 1),
('EP2024110533', '+', 'EV202407000615', 'EV202407000604', 2, 'EV2024070006', 29, 'Feriyanda', 'P', '1986-02-04', 38, '190201040286', '087896482145', 0, 36, 1),
('EP2024110534', '0', 'EV202407000624', 'EV202407000608', 1, 'EV2024070006', 24, 'Erwinsyah', 'P', '1977-10-25', 47, '0', '0', 0, 37, 1),
('EP2024110535', '0', 'EV202407000624', 'EV202407000608', 1, 'EV2024070006', 24, 'Ginanjar Melina', 'W', '2000-03-08', 24, '0', '0', 0, 37, 1),
('EP2024110536', '0', 'EV202407000623', 'EV202407000608', 1, 'EV2024070006', 24, 'Drajat Tri Hartadi', 'P', '1964-02-13', 60, '0', '0', 0, 37, 1),
('EP2024110537', '0', 'EV202407000615', 'EV202407000604', 1, 'EV2024070006', 24, 'Syofyan', 'P', '1966-05-16', 58, '0', '0', 0, 37, 1),
('EP2024110538', '0', 'EV202407000612', 'EV202407000603', 1, 'EV2024070006', 34, 'Al Shamika Maygi Sakhiya', 'W', '2014-09-26', 10, '0', '0', 0, 14, 1),
('EP2024110539', '0', 'EV202407000615', 'EV202407000604', 1, 'EV2024070006', 24, 'Budi Andrian Saputra', 'P', '1979-06-19', 45, '0', '0', 0, 37, 1),
('EP2024110540', '0', 'EV202407000601', 'EV202407000603', 1, 'EV2024070006', 34, 'M. Ariel Daviansyah', 'P', '2005-12-09', 18, '0', '0', 0, 14, 1),
('EP2024110541', '0', 'EV202407000604', 'EV202407000601', 1, 'EV2024070006', 34, 'Pipin Irfan Silaen ', 'P', '2011-11-21', 12, '0', '0', 0, 14, 1),
('EP2024110542', '0', 'EV202407000605', 'EV202407000601', 1, 'EV2024070006', 34, 'Rafli Pratama', 'P', '2014-01-28', 10, '0', '0', 0, 14, 1),
('EP2024110543', '0', 'EV202407000606', 'EV202407000601', 1, 'EV2024070006', 34, 'Azkiya Ananda Frasyah', 'P', '2016-04-04', 8, '0', '0', 0, 14, 1),
('EP2024110544', '0', 'EV202407000603', 'EV202407000601', 1, 'EV2024070006', 34, 'Ruby Ahmad Frasyah', 'P', '2009-03-29', 15, '0', '0', 0, 14, 1),
('EP2024110545', '0', 'EV202407000606', 'EV202407000601', 1, 'EV2024070006', 34, 'Kasyafa Alvarendra', 'P', '2017-09-22', 7, '0', '0', 0, 14, 1),
('EP2024110546', '0', 'EV202407000601', 'EV202407000601', 2, 'EV2024070006', 34, 'Stevanky', 'P', '2006-01-13', 18, '0', '0', 0, 14, 1),
('EP2024110547', '0', 'EV202407000609', 'EV202407000601', 1, 'EV2024070006', 34, 'Faza Risqi Aznafisah', 'W', '2007-11-14', 16, '0', '0', 0, 14, 1),
('EP2024110548', '0', 'EV202407000610', 'EV202407000601', 1, 'EV2024070006', 34, 'Emily Christy', 'W', '2010-08-05', 14, '0', '0', 0, 14, 1),
('EP2024110549', '0', 'EV202407000604', 'EV202407000601', 1, 'EV2024070006', 34, 'Andra Alfarizy', 'P', '2011-11-20', 12, '0', '0', 0, 14, 1),
('EP2024110550', '0', 'EV202407000605', 'EV202407000601', 1, 'EV2024070006', 34, 'Sayyid Musyaffa Yusuf ', 'P', '2013-02-07', 11, '0', '0', 0, 14, 1),
('EP2024110551', '0', 'EV202407000612', 'EV202407000601', 1, 'EV2024070006', 34, 'Violetta Gabriella Sukatendel ', 'W', '2014-05-27', 10, '0', '0', 0, 14, 1),
('EP2024110552', '0', 'EV202407000612', 'EV202407000601', 1, 'EV2024070006', 34, 'Raisa Shidqia Solihah', 'W', '2014-01-08', 10, '0', '0', 0, 14, 1),
('EP2024110553', '0', 'EV202407000605', 'EV202407000606', 1, 'EV2024070006', 34, 'Daniel Wayn Ferdinan ', 'P', '2014-02-02', 10, '0', '0', 0, 14, 1),
('EP2024110554', '0', 'EV202407000605', 'EV202407000606', 1, 'EV2024070006', 34, 'Calvin Mannuel Irwanto', 'P', '2013-01-16', 11, '0', '0', 0, 14, 1),
('EP2024110555', '0', 'EV202407000605', 'EV202407000606', 2, 'EV2024070006', 34, 'Hamid Almaisan Muhammad ', 'P', '2013-09-24', 11, '0', '0', 0, 14, 1),
('EP2024110556', '0', 'EV202407000606', 'EV202407000606', 2, 'EV2024070006', 34, 'Raja Kamal Ramazan ', 'P', '2015-07-12', 9, '0', '0', 0, 14, 1),
('EP2024110557', '0', 'EV202407000606', 'EV202407000606', 1, 'EV2024070006', 34, 'Mar Ville Wongso ', 'P', '2015-09-09', 9, '0', '0', 0, 14, 1),
('EP2024110558', '0', 'EV202407000605', 'EV202407000606', 1, 'EV2024070006', 34, 'M. Alfayyad Aqhar', 'P', '2013-04-27', 11, '0', '0', 0, 14, 1),
('EP2024110559', '0', 'EV202407000605', 'EV202407000606', 1, 'EV2024070006', 34, 'Kieven Abeldio Dharmapraja ', 'P', '2014-02-08', 10, '0', '0', 0, 14, 1),
('EP2024110560', '0', 'EV202407000606', 'EV202407000606', 1, 'EV2024070006', 34, 'Gibran Hanif Reynanda ', 'P', '2015-12-07', 8, '0', '0', 0, 14, 1),
('EP2024110561', '0', 'EV202407000607', 'EV202407000606', 1, 'EV2024070006', 34, 'Fahran Khairrazky Rheandra', 'P', '2018-10-19', 6, '0', '0', 0, 14, 1),
('EP2024110562', '0', 'EV202407000605', 'EV202407000606', 1, 'EV2024070006', 34, 'Zain Ibadurahman Arhafi ', 'P', '2014-05-24', 10, '0', '0', 0, 14, 1),
('EP2024110563', '0', 'EV202407000606', 'EV202407000606', 1, 'EV2024070006', 34, 'Nathanael Aldrich Gavin ', 'P', '2015-08-05', 9, '0', '0', 0, 14, 1),
('EP2024110564', '0', 'EV202407000601', 'EV202407000601', 1, 'EV2024070006', 39, 'MUHAMMAD IKHSAN MUBARAQ', 'P', '2005-09-16', 19, '6310021609050005', '081349719667', 0, 29, 1),
('EP2024110565', '0', 'EV202407000615', 'EV202407000604', 1, 'EV2024070006', 39, 'MURSIDAH', 'W', '1996-09-21', 28, '6310026109960002', '081349719667', 0, 29, 1),
('EP2024110566', '0', 'EV202407000610', 'EV202407000601', 1, 'EV2024070006', 33, 'Jessica Aileen Suharja', 'W', '2009-04-20', 15, '0', '0', 0, 13, 1),
('EP2024110567', '0', 'EV202407000606', 'EV202407000601', 1, 'EV2024070006', 33, 'Brillianto Soerahman', 'P', '2015-01-12', 9, '0', '0', 0, 13, 1),
('EP2024110568', '0', 'EV202407000611', 'EV202407000601', 1, 'EV2024070006', 33, 'Audrey Soerahman', 'W', '2011-02-04', 13, '0', '0', 0, 13, 1),
('EP2024110569', '0', 'EV202407000601', 'EV202407000601', 1, 'EV2024070006', 33, 'Adwa Nusantoro', 'P', '2013-03-01', 11, '111', '0', 0, 1, 1),
('EP2024110570', '-', 'EV202407000601', 'EV202407000609', 1, 'EV2024070006', 35, 'Ni Putu Nayaka Nityavairina Sarasvaty', 'W', '2016-05-14', 8, '3374075405160003', '081212000787', 0, 1, 1),
('EP2024110571', '0', 'EV202407000606', 'EV202407000601', 2, 'EV2024070006', 48, 'Abraham Melkior', 'P', '2015-06-10', 9, '0', '0', 0, 1, 1),
('EP2024110572', '0', 'EV202407000601', 'EV202407000608', 2, 'EV2024070006', 48, 'Dewa', 'P', '2002-07-12', 22, '0', '0', 0, 1, 1),
('EP2024110573', '-', 'EV202407000622', 'EV202407000608', 2, 'EV2024070006', 53, 'Parent ', 'P', '1960-06-11', 64, '-', '0', 0, 1, 1),
('EP2024110574', '0', 'EV202407000622', 'EV202407000608', 2, 'EV2024070006', 60, 'Parent', 'P', '1960-01-01', 64, '0', '0', 0, 1, 1),
('EP2024110575', '1', 'EV202407000622', 'EV202407000608', 2, 'EV2024070006', 60, 'parent.', 'P', '1950-01-01', 74, '1', '1', 0, 1, 1),
('EP2024110576', '-', 'EV202407000609', 'EV202407000601', 2, 'EV2024070006', 43, 'Shalom', 'P', '2007-06-12', 17, '-', '0', 0, 1, 1),
('EP2024110577', '-', 'EV202407000610', 'EV202407000601', 2, 'EV2024070006', 43, 'Sisilia Niken', 'W', '2010-06-13', 14, '-', '0', 0, 1, 1),
('EP2024110578', '-', 'EV202407000622', 'EV202407000608', 2, 'EV2024070006', 43, 'Oma Sisilia', 'P', '1970-06-17', 54, '-', '0', 0, 1, 1),
('EP2024110579', '-', 'EV202407000603', 'EV202407000603', 1, 'EV2024070006', 33, 'MORADO SIMANJUNTAK', 'P', '2009-09-27', 15, '3275052709090002', '085215970632', 0, 13, 1),
('EP2024110585', '0', 'EV202407000604', 'EV202407000603', 1, 'EV2024070006', 33, 'Almagro Hasian Gultom', 'P', '2012-04-06', 12, '0', '0', 0, 13, 1),
('EP2024110586', 'o', 'EV202407000606', 'EV202407000601', 2, 'EV2024070006', 33, 'Leonathan Edgar Hansen', 'P', '2015-08-24', 9, '0', '0', 0, 13, 1),
('EP2024110588', '0', 'EV202407000608', 'EV202407000603', 1, 'EV2024070006', 35, 'Cherista Joane Nungki', 'W', '2006-07-03', 18, '0', '0', 0, 16, 1),
('EP2024110589', '0', 'EV202407000611', 'EV202407000603', 1, 'EV2024070006', 35, 'Yukiko Charita Putri', 'W', '2012-10-17', 12, '0', '0', 0, 16, 1),
('EP2024110590', '-', 'EV202407000606', 'EV202407000601', 1, 'EV2024070006', 31, 'Muhammad Azam Febrian', 'P', '2015-04-11', 9, '-', '0', 0, 1, 1),
('EP2024110591', '-', 'EV202407000606', 'EV202407000601', 1, 'EV2024070006', 31, 'Rheina Putri Mustain', 'W', '2015-01-19', 9, '-', '0', 0, 1, 1),
('EP2024110592', '0', 'EV202407000605', 'EV202407000601', 1, 'EV2024070006', 31, 'Michael  Hogus Purnama Wibowo', 'P', '2014-10-13', 10, '0', '0', 0, 1, 1),
('EP2024110593', '0', 'EV202407000612', 'EV202407000601', 1, 'EV2024070006', 31, 'Alifatuz Zahra', 'W', '2014-03-20', 10, '0', '0', 0, 1, 1),
('EP2024110594', '-', 'EV202407000604', 'EV202407000601', 1, 'EV2024070006', 31, 'Deno Alantara', 'P', '2011-12-17', 12, '0', '0', 0, 1, 1),
('EP2024110595', '0', 'EV202407000611', 'EV202407000601', 1, 'EV2024070006', 31, 'Azzura Kichi Kahla', 'W', '2012-08-08', 12, '0', '0', 0, 1, 1),
('EP2024110596', '-', 'EV202407000604', 'EV202407000601', 1, 'EV2024070006', 31, 'Muhammad Faiz Shahputra', 'P', '2011-06-18', 13, '-', '0', 0, 1, 1),
('EP2024110597', '0', 'EV202407000610', 'EV202407000601', 1, 'EV2024070006', 31, 'Felicia Effendy', 'P', '2010-03-15', 14, '0', '0', 0, 1, 1),
('EP2024110598', '0', 'EV202407000603', 'EV202407000601', 1, 'EV2024070006', 31, 'Denis Faris Al Farizi', 'P', '2009-04-04', 15, '0', '0', 0, 1, 1),
('EP2024110599', '0', 'EV202407000609', 'EV202407000601', 1, 'EV2024070006', 31, 'Zaskya Salsabila Sahira', 'W', '2008-05-21', 16, '0', '0', 0, 1, 1),
('EP2024110600', '0', 'EV202407000602', 'EV202407000601', 1, 'EV2024070006', 31, 'Allfanza Eka Wijaya', 'P', '2008-07-04', 16, '0', '0', 0, 1, 1),
('EP2024110601', '0', 'EV202407000608', 'EV202407000601', 1, 'EV2024070006', 31, 'Puspita Rini ', 'W', '2005-11-21', 18, '0', '0', 0, 1, 1),
('EP2024110602', '0', 'EV202407000606', 'EV202407000601', 1, 'EV2024070006', 31, 'Muhammad Rhafi Mustain', 'P', '2016-09-30', 8, '0', '0', 0, 1, 1),
('EP2024110603', '0', 'EV202407000607', 'EV202407000601', 1, 'EV2024070006', 31, 'Nalabrata Adhisa Guarlaksniti', 'P', '2017-03-16', 7, '0', '0', 0, 1, 1),
('EP2024110604', '0', 'EV202407000603', 'EV202407000601', 1, 'EV2024070006', 31, 'Yasin Ahmad', 'P', '2010-09-30', 14, '0', '0', 0, 1, 1),
('EP2024110605', '0', 'EV202407000601', 'EV202407000601', 1, 'EV2024070006', 31, 'Kaizen Tatakun', 'P', '2014-04-06', 10, '0', '0', 0, 1, 1),
('EP2024110606', '-', 'EV202407000613', 'EV202407000601', 1, 'EV2024070006', 44, 'Klara', 'W', '2016-07-19', 8, '0', '0', 0, 1, 1),
('EP2024110607', '0', 'EV202407000603', 'EV202407000601', 1, 'EV2024070006', 44, 'Satya', 'P', '2009-10-05', 15, '0', '0', 0, 1, 1),
('EP2024110608', '0', 'EV202407000607', 'EV202407000601', 2, 'EV2024070006', 51, 'Joel Baltimore Hanson', 'P', '2018-04-04', 6, '0', '0', 0, 1, 1),
('EP2024110609', '0', 'EV202407000605', 'EV202407000601', 2, 'EV2024070006', 51, 'Wealthy R.T. Silalahi', 'P', '2013-01-31', 11, '0', '0', 0, 1, 1),
('EP2024110610', '0', 'EV202407000605', 'EV202407000601', 2, 'EV2024070006', 51, 'Gamaliel A.M. Adoe', 'P', '2013-03-18', 11, '0', '0', 0, 1, 1),
('EP2024110611', '0', 'EV202407000605', 'EV202407000601', 2, 'EV2024070006', 51, 'Edirck Richardo Makatita', 'P', '2013-06-19', 11, '0', '0', 0, 1, 1);
INSERT INTO `pesertaev` (`id_pst_ev`, `id_nasional`, `id_ktg_ev`, `id_gelar_ev`, `id_akomodasi_ev`, `id_ev`, `id_prov`, `nama_pst`, `jk_pst`, `tgl_lahir`, `umur`, `nik`, `telepon`, `juara`, `id_operator`, `id_admin`) VALUES
('EP2024110612', '0', 'EV202407000604', 'EV202407000601', 2, 'EV2024070006', 51, 'Louie Nangoi', 'P', '2012-05-22', 12, '0', '0', 0, 1, 1),
('EP2024110613', '0', 'EV202407000604', 'EV202407000601', 2, 'EV2024070006', 51, 'Reynardo Danylo Yapiter', 'P', '2012-02-27', 12, '0', '0', 0, 1, 1),
('EP2024110614', '0', 'EV202407000604', 'EV202407000601', 2, 'EV2024070006', 51, 'Kenzo Ryu Santoso', 'P', '2012-07-30', 12, '0', '0', 0, 1, 1),
('EP2024110615', '0', 'EV202407000603', 'EV202407000601', 2, 'EV2024070006', 51, 'Dirham F. Ena Aulu', 'P', '2009-09-30', 15, '0', '0', 0, 1, 1),
('EP2024110616', '0', 'EV202407000624', 'EV202407000608', 1, 'EV2024070006', 51, 'Sonny V.K. Sabuna', 'P', '1993-07-13', 31, '0', '0', 0, 1, 1),
('EP2024110617', '0', 'EV202407000624', 'EV202407000608', 2, 'EV2024070006', 51, 'Jusuf A. Adoe', 'P', '1994-06-21', 30, '0', '0', 0, 1, 1),
('EP2024110618', '0', 'EV202407000624', 'EV202407000608', 2, 'EV2024070006', 51, 'Antonius', 'P', '1971-01-04', 53, '0', '0', 0, 1, 1),
('EP2024110619', '0', 'EV202407000606', 'EV202407000603', 1, 'EV2024070006', 33, 'Neo Batong', 'P', '2013-01-04', 11, '0', '0', 0, 13, 1),
('EP2024110620', '0', 'EV202407000611', 'EV202407000603', 1, 'EV2024070006', 37, 'Kenya Kusuma Dewi', 'W', '2013-10-26', 11, '0', '0', 0, 12, 1),
('EP2024110621', '0', 'EV202407000622', 'EV202407000608', 1, 'EV2024070006', 33, 'German S.', 'P', '1971-10-13', 53, '0', '0', 0, 1, 1),
('EP2024110622', '-', 'EV202407000622', 'EV202407000608', 2, 'EV2024070006', 33, 'Mama Claudio', 'W', '1969-07-23', 55, '0', '0', 0, 1, 1),
('EP2024110623', '-', 'EV202407000622', 'EV202407000608', 2, 'EV2024070006', 33, 'Orangtua Stacey (2)', 'P', '1966-11-28', 57, '0', '0', 0, 1, 1),
('EP2024110624', '-', 'EV202407000622', 'EV202407000608', 2, 'EV2024070006', 33, 'Parents Morado', 'P', '1990-08-24', 34, '0', '0', 0, 1, 1),
('EP2024110625', '-', 'EV202407000622', 'EV202407000608', 2, 'EV2024070006', 33, 'Parents Sebastian Tiono', 'P', '1989-10-27', 35, '0', '0', 0, 1, 1),
('EP2024110626', '-', 'EV202407000622', 'EV202407000608', 2, 'EV2024070006', 34, 'Kris Tangguh', 'P', '1970-10-15', 54, '0', '0', 0, 1, 1),
('EP2024110627', '-', 'EV202407000622', 'EV202407000608', 2, 'EV2024070006', 34, 'Pendamping Khalid', 'P', '1981-03-27', 43, '0', '0', 0, 1, 1),
('EP2024110628', '-', 'EV202407000622', 'EV202407000608', 2, 'EV2024070006', 34, 'Pendamping Ratu (Ibu)', 'P', '1979-07-16', 45, '0', '0', 0, 1, 1),
('EP2024110629', '-', 'EV202407000622', 'EV202407000608', 2, 'EV2024070006', 34, 'Pendamping Raja (Bapak)', 'P', '1991-10-13', 33, '0', '0', 0, 1, 1),
('EP2024110630', '-', 'EV202407000622', 'EV202407000608', 2, 'EV2024070006', 34, 'Pendamping Lychelle', 'P', '1999-03-16', 25, '0', '0', 0, 1, 1),
('EP2024110631', '-', 'EV202407000622', 'EV202407000608', 2, 'EV2024070006', 34, 'Anggi', 'P', '1972-11-29', 51, '0', '0', 0, 1, 1),
('EP2024110632', '-', 'EV202407000614', 'EV202407000609', 1, 'EV2024070006', 35, 'Aisyela', 'P', '1986-11-25', 37, '0', '0', 0, 1, 1),
('EP2024110633', '-', 'EV202407000614', 'EV202407000606', 1, 'EV2024070006', 35, 'Sisilia', 'W', '1992-07-13', 37, '0', '0', 0, 1, 1),
('EP2024110634', '-', 'EV202407000622', 'EV202407000608', 2, 'EV2024070006', 35, 'ORTU Vanessa Koolin', 'W', '1993-12-31', 30, '-', '00', 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `provinsi`
--

CREATE TABLE `provinsi` (
  `id_prov` int UNSIGNED NOT NULL,
  `provinsi` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `provinsi`
--

INSERT INTO `provinsi` (`id_prov`, `provinsi`) VALUES
(22, 'Aceh '),
(23, 'Sumatera Utara'),
(24, 'Riau'),
(25, 'Kepulauan Riau'),
(26, 'Jambi'),
(27, 'Sumatera Barat'),
(28, 'Sumatera Selatan'),
(29, 'Kepulauan Bangka Belitung'),
(30, 'Bengkulu'),
(31, 'Lampung'),
(32, 'Banten'),
(33, 'DK Jakarta'),
(34, 'Jawa Barat'),
(35, 'Jawa Tengah'),
(36, 'DI Yogyakarta'),
(37, 'Jawa Timur'),
(38, 'Bali'),
(39, 'Kalimantan Selatan'),
(40, 'Kalimantan Tengah'),
(41, 'Kalimantan Barat'),
(42, 'Kalimantan Timur'),
(43, 'Kalimantan Utara'),
(44, 'Sulawesi Selatan'),
(45, 'Sulawesi Tenggara'),
(46, 'Sulawesi Barat'),
(47, 'Sulawesi Tengah'),
(48, 'Gorontalo'),
(49, 'Sulawesi Utara'),
(50, 'Nusa Tenggara Barat'),
(51, 'Nusa Tenggara Timur'),
(52, 'Maluku'),
(53, 'Maluku Utara'),
(54, 'Papua '),
(55, 'Papua Barat'),
(56, 'Papua Selatan'),
(57, 'Papua Pegunungan '),
(58, 'Papua Barat Daya'),
(59, 'Papua Tengah'),
(60, 'JAPFA'),
(61, 'BPK Penabur ');

-- --------------------------------------------------------

--
-- Table structure for table `tentang`
--

CREATE TABLE `tentang` (
  `id_ttg` int UNSIGNED NOT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `deskripsi` text,
  `foto` text NOT NULL,
  `aktif` tinyint UNSIGNED DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tentang`
--

INSERT INTO `tentang` (`id_ttg`, `judul`, `deskripsi`, `foto`, `aktif`) VALUES
(1, 'Tentang Kami', '<p>Setelah Proklamasi Kemerdekaan Indonesia pada 1945, kegiatan catur mulai bermunculan kembali, terutama di pulau Jawa seperti di Solo, Yogyakarta dan Magelang. Atas prakarsa beberapa tokoh catur masa itu, didirikanlah “Persatoean Tjatoer Seloeroeh Indonesia” (Persatuan Catur Seluruh Indonesia) disingkat PERTJASI (Percasi) pada 1948.</p><p>Berhubung situasi saat itu belum pasti karena masih dalam masa peralihan kemerdekaan, barulah 17 Agustus 1950 resmi ditetapkan sebagai tanggal berdirinya Percasi. Percasi pun mulai memiliki Anggaran Dasar dan Anggaran Rumah Tangga, serta berkedudukan di Yogyakarta.</p><p>Ketua Umum Percasi yang pertama adalah Dr. Suwito Mangkusuwondo (almarhum). Setelah beberapa tahun berdiri, Percasi kemudian menggelar Kejuaraan Nasional (Kejurnas) Catur yang pertama pada 1953 di Solo</p><p>Singkat cerita, Percasi mulai turut berpartisipasi di percaturan Internasional hingga pada 1960 diterima sebagai anggota Federation Internationale Des Echecs atau Federasi Catur Internasional (FIDE). Sejak saat itu, Percasi terus berkembang sebagai organisasi induk cabang olahraga catur yang solid dan memiliki kepengurusan yang jelas serta relatif tanpa masalah.</p><p>Saat ini, Percasi berada di 34 provinsi dan hampir di seluruh kabupaten dan kota di Indonesia. Kini, Percasi dipimpin oleh Grandmaster Utut Adianto yang terpilih lagi secara aklamasi sebagai Ketua Umum PB PERCASI 2022-2026.</p><p> </p>', 'ttg_1.jpg', 1),
(2, 'Admin Team   ', '<p>They say you never get a second chance to make a first impression.</p><p>And since your website’s About Us page often acts as an introduction, it’s safe to say that it’s important to make it unique and engaging.</p><p>A successful About Us page is not only packed full of interesting and useful information about you, <a href=\\\"https://designschool.canva.com/tutorials/branding/creating-your-canva-brand-kit/\\\">your brand</a>, and your team, but it should also encapsulate what your brand is as a whole, both stylistically and in terms of personality</p>', 'Admin Team.jpeg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `timelineev`
--

CREATE TABLE `timelineev` (
  `id_timeline` varchar(14) NOT NULL,
  `id_ev` varchar(12) NOT NULL,
  `tanggal` date NOT NULL,
  `kegiatan` varchar(50) NOT NULL,
  `catatan` text NOT NULL,
  `publik` tinyint UNSIGNED NOT NULL DEFAULT '0',
  `id_admin` int UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `timelineev`
--

INSERT INTO `timelineev` (`id_timeline`, `id_ev`, `tanggal`, `kegiatan`, `catatan`, `publik`, `id_admin`) VALUES
('IT202407000001', 'EV2024070006', '2024-11-08', 'Tehnical Meeting all Operator/Pengda', 'Kepada Ketua/Sekretaris Pengprov PERCASI untuk mengirimkan perwakilan Kontingen Max 2 peserta', 0, 3);

-- --------------------------------------------------------

--
-- Table structure for table `urut`
--

CREATE TABLE `urut` (
  `idurut` varchar(15) NOT NULL,
  `nomor` int NOT NULL,
  `tanggal` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `urut`
--

INSERT INTO `urut` (`idurut`, `nomor`, `tanggal`) VALUES
('EIDBYREV', 159, '202411'),
('EIDEVENT', 1, '202410'),
('EIDGELAR', 6, '202411'),
('EIDIURAN', 87, '202410'),
('EIDKASKEL', 1, '202410'),
('EIDKTG', 8, '202411'),
('EIDPEN', 7, '202411'),
('EIDPST', 634, '202411'),
('EIDTIME', 1, '202407'),
('IDBERITA', 1, '202411'),
('IDBYRKJ', 5, '202404'),
('IDIURANKJ', 4, '202404'),
('IDJUARA', 4, '202406'),
('IDKASOUT', 1, '202404'),
('IDKEJURNAS', 2, '202404'),
('IDKJGLR', 6, '202404'),
('IDKJKTG', 10, '202404'),
('IDPENKJ', 9, '202404'),
('IDPSTKJ', 5, '202404'),
('IDTIME', 2, '202404'),
('IUTH', 6, '202507');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `akomodasiev`
--
ALTER TABLE `akomodasiev`
  ADD PRIMARY KEY (`id_akomodasi_ev`);

--
-- Indexes for table `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id_berita`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id_ev`);

--
-- Indexes for table `gelarev`
--
ALTER TABLE `gelarev`
  ADD PRIMARY KEY (`id_gelar_ev`);

--
-- Indexes for table `instansi`
--
ALTER TABLE `instansi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `iuranev`
--
ALTER TABLE `iuranev`
  ADD PRIMARY KEY (`id_iuran_ev`);

--
-- Indexes for table `iuranev_byr`
--
ALTER TABLE `iuranev_byr`
  ADD PRIMARY KEY (`id_byr`);

--
-- Indexes for table `iurantahunan`
--
ALTER TABLE `iurantahunan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `juaraev`
--
ALTER TABLE `juaraev`
  ADD PRIMARY KEY (`idjuara`);

--
-- Indexes for table `kaskeluarev`
--
ALTER TABLE `kaskeluarev`
  ADD PRIMARY KEY (`id_kaskeluar`);

--
-- Indexes for table `kategoriev`
--
ALTER TABLE `kategoriev`
  ADD PRIMARY KEY (`id_ktg_ev`);

--
-- Indexes for table `operator`
--
ALTER TABLE `operator`
  ADD PRIMARY KEY (`id_operator`);

--
-- Indexes for table `penerimaanev`
--
ALTER TABLE `penerimaanev`
  ADD PRIMARY KEY (`id_penerimaan`);

--
-- Indexes for table `pesertaev`
--
ALTER TABLE `pesertaev`
  ADD PRIMARY KEY (`id_pst_ev`);

--
-- Indexes for table `provinsi`
--
ALTER TABLE `provinsi`
  ADD PRIMARY KEY (`id_prov`);

--
-- Indexes for table `tentang`
--
ALTER TABLE `tentang`
  ADD PRIMARY KEY (`id_ttg`);

--
-- Indexes for table `timelineev`
--
ALTER TABLE `timelineev`
  ADD PRIMARY KEY (`id_timeline`);

--
-- Indexes for table `urut`
--
ALTER TABLE `urut`
  ADD PRIMARY KEY (`idurut`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `akomodasiev`
--
ALTER TABLE `akomodasiev`
  MODIFY `id_akomodasi_ev` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `operator`
--
ALTER TABLE `operator`
  MODIFY `id_operator` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `provinsi`
--
ALTER TABLE `provinsi`
  MODIFY `id_prov` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `tentang`
--
ALTER TABLE `tentang`
  MODIFY `id_ttg` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
