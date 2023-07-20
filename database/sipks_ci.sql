-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 14, 2023 at 02:05 PM
-- Server version: 5.7.24
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sipks_ci`
--

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nidn` varchar(20) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `no_telpon` int(20) DEFAULT NULL,
  `alamat` varchar(20) NOT NULL,
  `status_akun` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1: Aktif, 0: Tidak Aktif',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`id`, `nama`, `nidn`, `email`, `password`, `no_telpon`, `alamat`, `status_akun`, `created_at`, `updated_at`) VALUES
(1, 'Yusuf Yudhistira, M.Kom', '06131278', '06131278@gmail.com', '$2y$10$C6I0aTb0DCUsuSy.ARCfyuqEsCQqKbpkVW2.icJCLaiKnVcomMFge', 2147483647, 'Bumiayu', 1, '2023-07-09 01:39:46', '2023-07-14 06:49:24'),
(2, 'Mukrodin, M.Kom', '12345890', NULL, '$2y$10$FBHQHSdIZxywF52Sc6agzOusqjaG02hntIFvqtkPE4rgX86.Qw/RO', 2147483647, 'Paguyangan', 1, '2023-07-09 01:39:46', '2023-07-09 01:39:46'),
(3, 'Achmad Syauqi, M.Kom', '7678899', '7678899@peradaban.ac.id', '$2y$10$EjELA7lNteZy86E6fV9use9UHiNcjF75lvvoruqKynek4zA3c8PLy', 2147483647, 'Adisana', 1, '2023-07-09 01:39:46', '2023-07-13 09:15:14'),
(4, 'Fuaida Nabyla, M.Kom', '56786547', '56786547@test.com', '$2y$10$c.R2UTClzIjHK4qC9HCKl.O/.uXEDjUtbUZbr33PxTRfbFCXRn22e', 2147483647, 'Tonjong', 1, '2023-07-09 01:39:46', '2023-07-13 09:17:22'),
(5, 'Eko Sudrajat, M.Kom', '56567654', NULL, '$2y$10$qP4jQ/D.KmlR.KoAIqcmk.wUyJEHtJROS.VZdQSBQv8g9WgcVeeC6', 2147483647, 'Banyumas', 1, '2023-07-09 01:39:46', '2023-07-09 01:39:46'),
(6, 'Danar, M.Kom', '65438888', 'test@gmail.com', '$2y$10$dSs28mxlXYmumOpQf6i8Hu9yeX92c6jLdI4jykmVgvrRpXHrIwjx2', 2147483647, 'Cilacap', 1, '2023-07-09 01:39:47', '2023-07-12 00:06:45');

-- --------------------------------------------------------

--
-- Table structure for table `dosen_pembimbing`
--

CREATE TABLE `dosen_pembimbing` (
  `id_dospem` bigint(20) UNSIGNED NOT NULL,
  `dosen_id` bigint(20) UNSIGNED NOT NULL,
  `mahasiswa_id` bigint(20) UNSIGNED NOT NULL,
  `jenis_pembimbing` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dosen_pembimbing`
--

INSERT INTO `dosen_pembimbing` (`id_dospem`, `dosen_id`, `mahasiswa_id`, `jenis_pembimbing`) VALUES
(6, 2, 3, 'KKN'),
(10, 1, 1, 'PKL'),
(13, 1, 2, 'SKRIPSI');

-- --------------------------------------------------------

--
-- Table structure for table `fakultas`
--

CREATE TABLE `fakultas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fakultas`
--

INSERT INTO `fakultas` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'Fakultas Teknik', '2023-07-09 01:39:47', '2023-07-09 01:39:47'),
(2, 'Fakultas Ekonomi', '2023-07-09 01:39:47', '2023-07-09 01:39:47'),
(3, 'Fakultas Hukum', '2023-07-09 01:39:47', '2023-07-09 01:39:47'),
(4, 'Fakultas Pertanian', '2023-07-09 01:39:47', '2023-07-09 01:39:47'),
(5, 'Fakultas Ilmu Komputer', '2023-07-09 01:39:47', '2023-07-09 01:39:47');

-- --------------------------------------------------------

--
-- Table structure for table `instansi`
--

CREATE TABLE `instansi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_perusahaan` varchar(255) NOT NULL,
  `alamat` text,
  `pembimbing_lapangan` varchar(255) DEFAULT NULL,
  `no_pembimbing_lapangan` varchar(20) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `instansi`
--

INSERT INTO `instansi` (`id`, `nama_perusahaan`, `alamat`, `pembimbing_lapangan`, `no_pembimbing_lapangan`, `created_at`, `updated_at`) VALUES
(1, 'Instansi Nama', 'Alamat Instansi\r\n', 'Pembimbing Nama', '1234567890', '2023-07-09 03:03:02', '2023-07-09 06:19:09'),
(2, 'Instansi Nama 2', 'Alamat Instansi', 'Pembimbing Nama', '123123123', '2023-07-12 17:19:44', '2023-07-13 04:11:41'),
(3, 'Instansi Nama 3', 'Alamat Instansi', 'Pembimbing Nama', '12312312', '2023-07-12 17:20:05', '2023-07-12 17:20:05');

-- --------------------------------------------------------

--
-- Table structure for table `kkn`
--

CREATE TABLE `kkn` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_kelompok` varchar(45) NOT NULL,
  `tgl_mulai` varchar(40) NOT NULL,
  `tgl_selesai` varchar(40) NOT NULL,
  `tahun_akademik` varchar(20) NOT NULL,
  `dosen_id` bigint(20) UNSIGNED NOT NULL,
  `prodi_id` bigint(20) UNSIGNED NOT NULL,
  `kkn_tempat` text NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nim` varchar(20) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `jenis_kelamin` enum('L','P') DEFAULT NULL,
  `no_telpon` varchar(20) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `alamat` text,
  `angkatan` int(4) NOT NULL,
  `status_akun` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1: Aktif, 0: Tidak Aktif',
  `status_pkl` varchar(20) DEFAULT NULL,
  `prodi_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `nim`, `nama`, `email`, `password`, `jenis_kelamin`, `no_telpon`, `tgl_lahir`, `alamat`, `angkatan`, `status_akun`, `status_pkl`, `prodi_id`, `created_at`, `updated_at`) VALUES
(1, '42139005', 'Asih Tri Indriyani', '42139005@peradaban.ac.id', '$2y$10$SduCffr74qTYQDPLDB/6CuK6tKLZgznWNAaUdnEpp/nyjTcvAzdNu', 'P', '085436788098', '2000-10-01', 'Bumiayu', 2019, 1, 'layak', 2, NULL, '2023-07-14 06:13:35'),
(2, '123456', 'Mahasiswa 1', 'mahasiswa1@gmail.com', '$2y$10$OcWbEkOHG9wYnfBFrX5bpeh/jxzBUdJzWJkuleGv2F4IVANjxrGZC', 'P', '085436788098', '2000-10-01', 'Bumiayu', 2019, 1, 'layak', 1, NULL, '2023-07-14 08:48:52'),
(3, '123', 'Mahasiswa 2', 'mahasiswa2@gmail.com', '$2y$10$fNNNf14SdjJPpUdkGkaIDOft5pije1dBk3li8YK8WJ5pU2n1KXQ1q', 'P', '085436788098', '2002-07-05', 'Bumiayu', 2019, 1, 'layak', 2, NULL, '2023-07-14 06:13:28'),
(4, '42319003', 'Nina Melani', '123212312@gmail.com', '$2y$10$oBv.MP97M/gqCStcipOIMug0yhI3cG/netijjmtn0WZkKUOKBPneC', 'P', '085436788098', '2002-09-10', 'Bumiayu', 2019, 1, 'layak', 2, NULL, '2023-07-14 06:13:44'),
(6, '42319006', 'Shodik Abdul ghofar', NULL, '$2y$10$CT.zqj.n55YHpLmoHseau.84kRGOqS2gNTF9V1sjedt1/8Vy8851S', 'P', '085436788098', '2000-10-01', 'Bumiayu', 2019, 1, 'layak', 3, NULL, NULL),
(7, '42319008', 'M. Wildan ihsani', NULL, '$2y$10$WJh9dm0m3AfvZt89KmBRkuzY0P0FyBm.t4VHA.mjac.0dvvE8gYZq', 'P', '085436788098', '2000-10-01', 'Bumiayu', 2019, 1, 'layak', 1, NULL, NULL),
(8, '42319010', 'Deskal Dwi Rayananda', NULL, '$2y$10$YjZ6jwOy0ssjbXr.u6y/xeEiJv5/5sAGlbr4hzTzuSlSI2Y5f2qWG', 'P', '085436788098', '2000-10-01', 'Bumiayu', 2019, 1, 'layak', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2022-12-28-115301', 'App\\Database\\Migrations\\CreateUsersTable', 'default', 'App', 1688884771, 1),
(2, '2022-12-28-115302', 'App\\Database\\Migrations\\CreateFakultasTable', 'default', 'App', 1688884771, 1),
(3, '2022-12-28-115303', 'App\\Database\\Migrations\\CreateProdiTable', 'default', 'App', 1688884771, 1),
(4, '2023-05-31-065836', 'App\\Database\\Migrations\\CreateJurnalBimbinganTable', 'default', 'App', 1688884771, 1),
(5, '2023-06-02-063505', 'App\\Database\\Migrations\\CreateJadwalSidangPklTable', 'default', 'App', 1688884771, 1),
(6, '2023-06-05-101402', 'App\\Database\\Migrations\\CreateUjianPklTable', 'default', 'App', 1688884771, 1),
(7, '2023-06-10-033935', 'App\\Database\\Migrations\\CreateBerkasTable', 'default', 'App', 1688884771, 1),
(8, '2023-06-14-034303', 'App\\Database\\Migrations\\CreateJurnalPelaksanaanKknTable', 'default', 'App', 1688884771, 1),
(9, '2023-06-14-034711', 'App\\Database\\Migrations\\CreateJurnalMonitoringTable', 'default', 'App', 1688884771, 1),
(10, '2023-06-18-142308', 'App\\Database\\Migrations\\CreateJudulLaporanPklTable', 'default', 'App', 1688884771, 1),
(11, '2023-07-08-140747', 'App\\Database\\Migrations\\CreateDosenTable', 'default', 'App', 1688884771, 1),
(12, '2023-07-08-141247', 'App\\Database\\Migrations\\CreateMahasiswaTable', 'default', 'App', 1688884772, 1),
(13, '2023-07-08-191117', 'App\\Database\\Migrations\\CreatePembimbingTable', 'default', 'App', 1688884772, 1),
(14, '2023-07-08-195001', 'App\\Database\\Migrations\\CreateInstansiTable', 'default', 'App', 1688884772, 1),
(15, '2023-07-08-200041', 'App\\Database\\Migrations\\CreatePKLTable', 'default', 'App', 1688884772, 1),
(16, '2023-07-08-205036', 'App\\Database\\Migrations\\CreatePKLAnggotaTable', 'default', 'App', 1688884772, 1),
(17, '2023-07-09-045130', 'App\\Database\\Migrations\\CreatePKLJurnalBimbinganTable', 'default', 'App', 1688884772, 1),
(18, '2023-07-09-045147', 'App\\Database\\Migrations\\CreatePKLJurnalPelaksanaanTable', 'default', 'App', 1688884772, 1),
(19, '2023-07-09-063729', 'App\\Database\\Migrations\\CreateTempatSidangTable', 'default', 'App', 1688884772, 1),
(20, '2023-07-09-065426', 'App\\Database\\Migrations\\CreatePKLUjianTable', 'default', 'App', 1688885853, 2),
(21, '2023-07-09-075313', 'App\\Database\\Migrations\\CreatePKLJudulLaporanTable', 'default', 'App', 1688889291, 3),
(22, '2023-07-09-105607', 'App\\Database\\Migrations\\CreateDosenPembimbingTable', 'default', 'App', 1688900339, 4),
(23, '2023-07-09-112348', 'App\\Database\\Migrations\\CreatePKLJadwalSidangTable', 'default', 'App', 1688902300, 5);

-- --------------------------------------------------------

--
-- Table structure for table `pkl`
--

CREATE TABLE `pkl` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_kelompok` varchar(45) NOT NULL,
  `tgl_mulai` varchar(40) NOT NULL,
  `tgl_selesai` varchar(40) NOT NULL,
  `tahun_akademik` varchar(20) NOT NULL,
  `dosen_id` bigint(20) UNSIGNED NOT NULL,
  `prodi_id` bigint(20) UNSIGNED NOT NULL,
  `instansi_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pkl`
--

INSERT INTO `pkl` (`id`, `nama_kelompok`, `tgl_mulai`, `tgl_selesai`, `tahun_akademik`, `dosen_id`, `prodi_id`, `instansi_id`, `created_at`, `updated_at`) VALUES
(2, 'Nama Kelompok', '2002-03-25', '2014-08-26', '2023/2024', 1, 2, 2, '2023-07-11 22:09:43', '2023-07-14 08:23:38'),
(3, 'Kelompok 2', '2023-07-13', '2023-07-31', '2024/2024', 5, 1, 3, '2023-07-13 00:51:16', '2023-07-13 00:51:16');

-- --------------------------------------------------------

--
-- Table structure for table `pkl_anggota`
--

CREATE TABLE `pkl_anggota` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mahasiswa_id` bigint(20) UNSIGNED NOT NULL,
  `pkl_id` bigint(20) UNSIGNED NOT NULL,
  `is_ketua` tinyint(1) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pkl_anggota`
--

INSERT INTO `pkl_anggota` (`id`, `mahasiswa_id`, `pkl_id`, `is_ketua`, `created_at`, `updated_at`) VALUES
(4, 1, 2, 1, '2023-07-13 15:17:19', NULL),
(6, 3, 2, 0, NULL, NULL),
(7, 2, 3, 0, '2023-07-14 18:14:01', '2023-07-14 18:14:01'),
(8, 8, 3, 1, '2023-07-14 18:14:03', '2023-07-14 18:14:03'),
(9, 7, 3, 0, '2023-07-14 18:14:05', '2023-07-14 18:14:05');

-- --------------------------------------------------------

--
-- Table structure for table `pkl_jadwal_sidang`
--

CREATE TABLE `pkl_jadwal_sidang` (
  `id_pkl_jadwal_sidang` bigint(20) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` text,
  `dospeng_id` bigint(20) UNSIGNED NOT NULL,
  `tempat_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Pending',
  `mahasiswa_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pkl_jadwal_sidang`
--

INSERT INTO `pkl_jadwal_sidang` (`id_pkl_jadwal_sidang`, `tanggal`, `keterangan`, `dospeng_id`, `tempat_id`, `status`, `mahasiswa_id`) VALUES
(6, '2023-07-13', 'Keterangannya', 4, 1, '1', 1),
(7, '0000-00-00', 'test', 1, 1, '1', 2);

-- --------------------------------------------------------

--
-- Table structure for table `pkl_judul_laporan`
--

CREATE TABLE `pkl_judul_laporan` (
  `id_judul_laporan` bigint(20) UNSIGNED NOT NULL,
  `judul_laporan` varchar(255) NOT NULL,
  `mahasiswa_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pkl_judul_laporan`
--

INSERT INTO `pkl_judul_laporan` (`id_judul_laporan`, `judul_laporan`, `mahasiswa_id`) VALUES
(1, 'wwww', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pkl_jurnal_bimbingan`
--

CREATE TABLE `pkl_jurnal_bimbingan` (
  `id_jurnal_bimbingan` bigint(20) UNSIGNED NOT NULL,
  `mahasiswa_id` bigint(20) UNSIGNED NOT NULL,
  `jam` varchar(10) NOT NULL,
  `tanggal` varchar(20) NOT NULL,
  `catatan` text NOT NULL,
  `pkl_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pkl_jurnal_bimbingan`
--

INSERT INTO `pkl_jurnal_bimbingan` (`id_jurnal_bimbingan`, `mahasiswa_id`, `jam`, `tanggal`, `catatan`, `pkl_id`, `status`) VALUES
(6, 3, '06:25', '2002-08-22', 'Excepturi do adipisi', 2, 'Approved'),
(7, 1, '19:58', '2023-07-14', 'test', 2, 'Approved'),
(8, 1, '10:54', '2007-07-27', 'Sunt et saepe porro', 2, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `pkl_jurnal_pelaksanaan`
--

CREATE TABLE `pkl_jurnal_pelaksanaan` (
  `id_jurnal_pelaksanaan` bigint(20) UNSIGNED NOT NULL,
  `mahasiswa_id` bigint(20) UNSIGNED NOT NULL,
  `jam` varchar(10) NOT NULL,
  `hari` varchar(20) NOT NULL,
  `keterangan` text NOT NULL,
  `pkl_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pkl_jurnal_pelaksanaan`
--

INSERT INTO `pkl_jurnal_pelaksanaan` (`id_jurnal_pelaksanaan`, `mahasiswa_id`, `jam`, `hari`, `keterangan`, `pkl_id`, `status`) VALUES
(23, 3, '16:58', '1997-06-25', 'Ipsum neque ea reic', 2, 'Pending'),
(24, 3, '07:07', '1973-06-27', 'Quas irure nisi non ', 2, 'Pending'),
(25, 1, '19:57', '2023-07-14', 'test', 2, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `pkl_ujian`
--

CREATE TABLE `pkl_ujian` (
  `id_pkl_ujian` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(120) NOT NULL,
  `lampiran_pembayaran` varchar(120) NOT NULL,
  `lampiran_krs` varchar(120) NOT NULL,
  `lampiran_laporan` varchar(120) NOT NULL,
  `lampiran_keterangan` varchar(120) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'Pending',
  `mahasiswa_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pkl_ujian`
--

INSERT INTO `pkl_ujian` (`id_pkl_ujian`, `nama`, `lampiran_pembayaran`, `lampiran_krs`, `lampiran_laporan`, `lampiran_keterangan`, `status`, `mahasiswa_id`) VALUES
(5, 'Asih Tri Indriyani', 'asih_tri_indriyani_lampiran_lampiran_pembayaran.pdf', 'asih_tri_indriyani_lampiran_krs.pdf', 'asih_tri_indriyani_lampiran_lampiran_laporan.pdf', 'asih_tri_indriyani_lampiran_lampiran_keterangan.pdf', 'Approved', 1),
(6, 'Mahasiswa 1', 'mahasiswa_1_lampiran_pembayaran.pdf', 'mahasiswa_1_lampiran_krs.pdf', 'mahasiswa_1_lampiran_laporan.pdf', 'mahasiswa_1_lampiran_keterangan.pdf', 'Approved', 2);

-- --------------------------------------------------------

--
-- Table structure for table `prodi`
--

CREATE TABLE `prodi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_prodi` varchar(100) NOT NULL,
  `fakultas_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `prodi`
--

INSERT INTO `prodi` (`id`, `nama_prodi`, `fakultas_id`, `created_at`, `updated_at`) VALUES
(1, 'Teknik Informatika', 1, '2023-07-09 01:39:47', '2023-07-09 01:39:47'),
(2, 'Sistem Informasi', 1, '2023-07-09 01:39:47', '2023-07-09 01:39:47'),
(3, 'Farmasi', 2, '2023-07-09 01:39:47', '2023-07-09 01:39:47'),
(4, 'Agribisnis', 2, '2023-07-09 01:39:47', '2023-07-09 01:39:47'),
(5, 'Teknik Elektro', 3, '2023-07-09 01:39:47', '2023-07-09 01:39:47');

-- --------------------------------------------------------

--
-- Table structure for table `tempat_sidang`
--

CREATE TABLE `tempat_sidang` (
  `id_tempat` bigint(20) UNSIGNED NOT NULL,
  `nama_tempat` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tempat_sidang`
--

INSERT INTO `tempat_sidang` (`id_tempat`, `nama_tempat`) VALUES
(1, 'Ruang Sidang');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `nama` varchar(120) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  `level` tinyint(1) NOT NULL,
  `status_akun` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1: Aktif, 0: Tidak Aktif',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `nama`, `email`, `password`, `level`, `status_akun`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Admin', 'operator@example.com', '$2y$10$j9hz1u4ZlsoYXTyEbe1Bo.bSsaatix1g/naoTliVfWAK/exxuzU2S', 1, 1, NULL, NULL),
(2, 'operator', 'Operator', 'operator@example.com', '$2y$10$7guibOYiPY4jgahUc9GmTuVPjuuE78Wg6j9BlmX.y6TP9.CyH2o9S', 2, 1, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nidn` (`nidn`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `dosen_pembimbing`
--
ALTER TABLE `dosen_pembimbing`
  ADD PRIMARY KEY (`id_dospem`),
  ADD KEY `dosen_pembimbing_dosen_id_foreign` (`dosen_id`),
  ADD KEY `dosen_pembimbing_mahasiswa_id_foreign` (`mahasiswa_id`);

--
-- Indexes for table `fakultas`
--
ALTER TABLE `fakultas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `instansi`
--
ALTER TABLE `instansi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kkn`
--
ALTER TABLE `kkn`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pkl_dosen_id_foreign` (`dosen_id`),
  ADD KEY `pkl_prodi_id_foreign` (`prodi_id`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nim` (`nim`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `mahasiswa_prodi_id_foreign` (`prodi_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pkl`
--
ALTER TABLE `pkl`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pkl_instansi_id_foreign` (`instansi_id`),
  ADD KEY `pkl_dosen_id_foreign` (`dosen_id`),
  ADD KEY `pkl_prodi_id_foreign` (`prodi_id`);

--
-- Indexes for table `pkl_anggota`
--
ALTER TABLE `pkl_anggota`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pkl_anggota_mahasiswa_id_foreign` (`mahasiswa_id`),
  ADD KEY `pkl_anggota_pkl_id_foreign` (`pkl_id`);

--
-- Indexes for table `pkl_jadwal_sidang`
--
ALTER TABLE `pkl_jadwal_sidang`
  ADD PRIMARY KEY (`id_pkl_jadwal_sidang`),
  ADD KEY `pkl_jadwal_sidang_dospeng_id_foreign` (`dospeng_id`),
  ADD KEY `pkl_jadwal_sidang_mahasiswa_id_foreign` (`mahasiswa_id`),
  ADD KEY `pkl_jadwal_sidang_tempat_id_foreign` (`tempat_id`);

--
-- Indexes for table `pkl_judul_laporan`
--
ALTER TABLE `pkl_judul_laporan`
  ADD PRIMARY KEY (`id_judul_laporan`),
  ADD KEY `pkl_judul_laporan_mahasiswa_id_foreign` (`mahasiswa_id`);

--
-- Indexes for table `pkl_jurnal_bimbingan`
--
ALTER TABLE `pkl_jurnal_bimbingan`
  ADD PRIMARY KEY (`id_jurnal_bimbingan`),
  ADD KEY `pkl_jurnal_bimbingan_mahasiswa_id_foreign` (`mahasiswa_id`),
  ADD KEY `pkl_jurnal_bimbingan_pkl_id_foreign` (`pkl_id`);

--
-- Indexes for table `pkl_jurnal_pelaksanaan`
--
ALTER TABLE `pkl_jurnal_pelaksanaan`
  ADD PRIMARY KEY (`id_jurnal_pelaksanaan`),
  ADD KEY `pkl_jurnal_pelaksanaan_mahasiswa_id_foreign` (`mahasiswa_id`),
  ADD KEY `pkl_jurnal_pelaksanaan_pkl_id_foreign` (`pkl_id`);

--
-- Indexes for table `pkl_ujian`
--
ALTER TABLE `pkl_ujian`
  ADD PRIMARY KEY (`id_pkl_ujian`),
  ADD KEY `pkl_ujian_mahasiswa_id_foreign` (`mahasiswa_id`);

--
-- Indexes for table `prodi`
--
ALTER TABLE `prodi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prodi_fakultas_id_foreign` (`fakultas_id`);

--
-- Indexes for table `tempat_sidang`
--
ALTER TABLE `tempat_sidang`
  ADD PRIMARY KEY (`id_tempat`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dosen`
--
ALTER TABLE `dosen`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `dosen_pembimbing`
--
ALTER TABLE `dosen_pembimbing`
  MODIFY `id_dospem` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `fakultas`
--
ALTER TABLE `fakultas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `instansi`
--
ALTER TABLE `instansi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kkn`
--
ALTER TABLE `kkn`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `pkl`
--
ALTER TABLE `pkl`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pkl_anggota`
--
ALTER TABLE `pkl_anggota`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pkl_jadwal_sidang`
--
ALTER TABLE `pkl_jadwal_sidang`
  MODIFY `id_pkl_jadwal_sidang` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pkl_judul_laporan`
--
ALTER TABLE `pkl_judul_laporan`
  MODIFY `id_judul_laporan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pkl_jurnal_bimbingan`
--
ALTER TABLE `pkl_jurnal_bimbingan`
  MODIFY `id_jurnal_bimbingan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pkl_jurnal_pelaksanaan`
--
ALTER TABLE `pkl_jurnal_pelaksanaan`
  MODIFY `id_jurnal_pelaksanaan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `pkl_ujian`
--
ALTER TABLE `pkl_ujian`
  MODIFY `id_pkl_ujian` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `prodi`
--
ALTER TABLE `prodi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tempat_sidang`
--
ALTER TABLE `tempat_sidang`
  MODIFY `id_tempat` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dosen_pembimbing`
--
ALTER TABLE `dosen_pembimbing`
  ADD CONSTRAINT `dosen_pembimbing_dosen_id_foreign` FOREIGN KEY (`dosen_id`) REFERENCES `dosen` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dosen_pembimbing_mahasiswa_id_foreign` FOREIGN KEY (`mahasiswa_id`) REFERENCES `mahasiswa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kkn`
--
ALTER TABLE `kkn`
  ADD CONSTRAINT `kkn_ibfk_1` FOREIGN KEY (`dosen_id`) REFERENCES `dosen` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kkn_ibfk_3` FOREIGN KEY (`prodi_id`) REFERENCES `prodi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD CONSTRAINT `mahasiswa_prodi_id_foreign` FOREIGN KEY (`prodi_id`) REFERENCES `prodi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pkl`
--
ALTER TABLE `pkl`
  ADD CONSTRAINT `pkl_dosen_id_foreign` FOREIGN KEY (`dosen_id`) REFERENCES `dosen` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pkl_instansi_id_foreign` FOREIGN KEY (`instansi_id`) REFERENCES `instansi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pkl_prodi_id_foreign` FOREIGN KEY (`prodi_id`) REFERENCES `prodi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pkl_anggota`
--
ALTER TABLE `pkl_anggota`
  ADD CONSTRAINT `pkl_anggota_mahasiswa_id_foreign` FOREIGN KEY (`mahasiswa_id`) REFERENCES `mahasiswa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pkl_anggota_pkl_id_foreign` FOREIGN KEY (`pkl_id`) REFERENCES `pkl` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pkl_jadwal_sidang`
--
ALTER TABLE `pkl_jadwal_sidang`
  ADD CONSTRAINT `pkl_jadwal_sidang_dospeng_id_foreign` FOREIGN KEY (`dospeng_id`) REFERENCES `dosen` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pkl_jadwal_sidang_mahasiswa_id_foreign` FOREIGN KEY (`mahasiswa_id`) REFERENCES `mahasiswa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pkl_jadwal_sidang_tempat_id_foreign` FOREIGN KEY (`tempat_id`) REFERENCES `tempat_sidang` (`id_tempat`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pkl_judul_laporan`
--
ALTER TABLE `pkl_judul_laporan`
  ADD CONSTRAINT `pkl_judul_laporan_mahasiswa_id_foreign` FOREIGN KEY (`mahasiswa_id`) REFERENCES `mahasiswa` (`id`);

--
-- Constraints for table `pkl_jurnal_bimbingan`
--
ALTER TABLE `pkl_jurnal_bimbingan`
  ADD CONSTRAINT `pkl_jurnal_bimbingan_mahasiswa_id_foreign` FOREIGN KEY (`mahasiswa_id`) REFERENCES `mahasiswa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pkl_jurnal_bimbingan_pkl_id_foreign` FOREIGN KEY (`pkl_id`) REFERENCES `pkl` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pkl_jurnal_pelaksanaan`
--
ALTER TABLE `pkl_jurnal_pelaksanaan`
  ADD CONSTRAINT `pkl_jurnal_pelaksanaan_mahasiswa_id_foreign` FOREIGN KEY (`mahasiswa_id`) REFERENCES `mahasiswa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pkl_jurnal_pelaksanaan_pkl_id_foreign` FOREIGN KEY (`pkl_id`) REFERENCES `pkl` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pkl_ujian`
--
ALTER TABLE `pkl_ujian`
  ADD CONSTRAINT `pkl_ujian_mahasiswa_id_foreign` FOREIGN KEY (`mahasiswa_id`) REFERENCES `mahasiswa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `prodi`
--
ALTER TABLE `prodi`
  ADD CONSTRAINT `prodi_fakultas_id_foreign` FOREIGN KEY (`fakultas_id`) REFERENCES `fakultas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
