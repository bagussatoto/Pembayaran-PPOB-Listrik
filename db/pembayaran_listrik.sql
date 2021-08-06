-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2021 at 10:53 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pembayaran_listrik`
--

-- --------------------------------------------------------

--
-- Table structure for table `manager`
--

CREATE TABLE `manager` (
  `id_manager` varchar(15) NOT NULL,
  `nama_mgr` varchar(20) NOT NULL,
  `alamat_mgr` text NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `aksi` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `manager`
--

INSERT INTO `manager` (`id_manager`, `nama_mgr`, `alamat_mgr`, `no_telp`, `gender`, `username`, `password`, `aksi`) VALUES
('P20210527001', 'Dinda', 'Surabaya', '081234567890', 'P', 'manager', '123', 'manager'),
('P20210604001', 'manager', 'Surabaya', '081234567890', 'L', 'manager1', '123', 'manager');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` varchar(15) NOT NULL,
  `no_seri` varchar(12) NOT NULL,
  `nama_plgn` varchar(50) NOT NULL,
  `alamat_plgn` text NOT NULL,
  `batas_waktu` varchar(2) NOT NULL,
  `id_tarif` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` varchar(15) NOT NULL,
  `id_pelanggan` varchar(15) NOT NULL,
  `tgl_pembayaran` date NOT NULL,
  `waktu_pembayaran` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `bulan_pembayaran` varchar(2) NOT NULL,
  `tahun_pembayaran` year(4) NOT NULL,
  `jumlah_pembayaran` double NOT NULL,
  `biaya_admin` double NOT NULL,
  `total` double NOT NULL,
  `bayar` double NOT NULL,
  `kembali` double NOT NULL,
  `id_teller` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `penggunaan`
--

CREATE TABLE `penggunaan` (
  `id_penggunaan` varchar(20) NOT NULL,
  `id_pelanggan` varchar(15) NOT NULL,
  `bulan` varchar(2) NOT NULL,
  `tahun` year(4) NOT NULL,
  `meter_awal` int(11) NOT NULL,
  `meter_akhir` int(11) NOT NULL,
  `tgl_cek` date NOT NULL,
  `id_manager` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tagihan`
--

CREATE TABLE `tagihan` (
  `id_tagihan` int(11) NOT NULL,
  `id_pelanggan` varchar(15) NOT NULL,
  `bulan` varchar(2) NOT NULL,
  `tahun` year(4) NOT NULL,
  `jumlah_meter` int(11) NOT NULL,
  `tarif_perkwh` double NOT NULL,
  `jumlah_bayar` double NOT NULL,
  `status` varchar(15) NOT NULL,
  `id_manager` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tarif`
--

CREATE TABLE `tarif` (
  `id_tarif` int(11) NOT NULL,
  `no_tarif` varchar(20) NOT NULL,
  `golongan` varchar(10) NOT NULL,
  `daya` varchar(10) NOT NULL,
  `tarif_perkwh` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `teller`
--

CREATE TABLE `teller` (
  `id_teller` varchar(15) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `saldo` double NOT NULL,
  `biaya_admin` double NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `aksi` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teller`
--

INSERT INTO `teller` (`id_teller`, `nama`, `alamat`, `no_telp`, `saldo`, `biaya_admin`, `username`, `password`, `aksi`) VALUES
('A20210527001', 'Darisva', 'Jakarta', '081122334455', 0, 2000, 'teller1', '1234', 'teller');

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_pembayaran`
-- (See below for the actual view)
--
CREATE TABLE `v_pembayaran` (
`id_pembayaran` varchar(15)
,`id_pelanggan` varchar(15)
,`tgl_pembayaran` date
,`waktu_pembayaran` timestamp
,`bulan_pembayaran` varchar(2)
,`tahun_pembayaran` year(4)
,`jumlah_pembayaran` double
,`biaya_admin` double
,`total` double
,`bayar` double
,`kembali` double
,`id_teller` varchar(12)
,`nama_pelanggan` varchar(50)
,`nama_teller` varchar(50)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_penggunaan`
-- (See below for the actual view)
--
CREATE TABLE `v_penggunaan` (
`id_penggunaan` varchar(20)
,`id_pelanggan` varchar(15)
,`bulan` varchar(2)
,`tahun` year(4)
,`meter_awal` int(11)
,`meter_akhir` int(11)
,`tgl_cek` date
,`id_manager` varchar(15)
,`nama_pelanggan` varchar(50)
,`nama_manager` varchar(20)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_tagihan`
-- (See below for the actual view)
--
CREATE TABLE `v_tagihan` (
`id_tagihan` int(11)
,`id_pelanggan` varchar(15)
,`bulan` varchar(2)
,`tahun` year(4)
,`jumlah_meter` int(11)
,`tarif_perkwh` double
,`jumlah_bayar` double
,`status` varchar(15)
,`id_manager` varchar(15)
,`nama_pelanggan` varchar(50)
,`id_tarif` int(11)
,`nama_manager` varchar(20)
);

-- --------------------------------------------------------

--
-- Structure for view `v_pembayaran`
--
DROP TABLE IF EXISTS `v_pembayaran`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_pembayaran`  AS  select `pembayaran`.`id_pembayaran` AS `id_pembayaran`,`pembayaran`.`id_pelanggan` AS `id_pelanggan`,`pembayaran`.`tgl_pembayaran` AS `tgl_pembayaran`,`pembayaran`.`waktu_pembayaran` AS `waktu_pembayaran`,`pembayaran`.`bulan_pembayaran` AS `bulan_pembayaran`,`pembayaran`.`tahun_pembayaran` AS `tahun_pembayaran`,`pembayaran`.`jumlah_pembayaran` AS `jumlah_pembayaran`,`pembayaran`.`biaya_admin` AS `biaya_admin`,`pembayaran`.`total` AS `total`,`pembayaran`.`bayar` AS `bayar`,`pembayaran`.`kembali` AS `kembali`,`pembayaran`.`id_teller` AS `id_teller`,`pelanggan`.`nama_plgn` AS `nama_pelanggan`,`teller`.`nama` AS `nama_teller` from ((`pembayaran` join `pelanggan` on(`pelanggan`.`id_pelanggan` = `pembayaran`.`id_pelanggan`)) join `teller` on(`teller`.`id_teller` = `pembayaran`.`id_teller`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_penggunaan`
--
DROP TABLE IF EXISTS `v_penggunaan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_penggunaan`  AS  select `penggunaan`.`id_penggunaan` AS `id_penggunaan`,`penggunaan`.`id_pelanggan` AS `id_pelanggan`,`penggunaan`.`bulan` AS `bulan`,`penggunaan`.`tahun` AS `tahun`,`penggunaan`.`meter_awal` AS `meter_awal`,`penggunaan`.`meter_akhir` AS `meter_akhir`,`penggunaan`.`tgl_cek` AS `tgl_cek`,`penggunaan`.`id_manager` AS `id_manager`,`pelanggan`.`nama_plgn` AS `nama_pelanggan`,`manager`.`nama_mgr` AS `nama_manager` from ((`penggunaan` join `pelanggan` on(`penggunaan`.`id_pelanggan` = `pelanggan`.`id_pelanggan`)) join `manager` on(`penggunaan`.`id_manager` = `manager`.`id_manager`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_tagihan`
--
DROP TABLE IF EXISTS `v_tagihan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_tagihan`  AS  select `tagihan`.`id_tagihan` AS `id_tagihan`,`tagihan`.`id_pelanggan` AS `id_pelanggan`,`tagihan`.`bulan` AS `bulan`,`tagihan`.`tahun` AS `tahun`,`tagihan`.`jumlah_meter` AS `jumlah_meter`,`tagihan`.`tarif_perkwh` AS `tarif_perkwh`,`tagihan`.`jumlah_bayar` AS `jumlah_bayar`,`tagihan`.`status` AS `status`,`tagihan`.`id_manager` AS `id_manager`,`pelanggan`.`nama_plgn` AS `nama_pelanggan`,`pelanggan`.`id_tarif` AS `id_tarif`,`manager`.`nama_mgr` AS `nama_manager` from ((`tagihan` join `pelanggan` on(`pelanggan`.`id_pelanggan` = `tagihan`.`id_pelanggan`)) join `manager` on(`manager`.`id_manager` = `tagihan`.`id_manager`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `manager`
--
ALTER TABLE `manager`
  ADD PRIMARY KEY (`id_manager`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indexes for table `penggunaan`
--
ALTER TABLE `penggunaan`
  ADD PRIMARY KEY (`id_penggunaan`);

--
-- Indexes for table `tagihan`
--
ALTER TABLE `tagihan`
  ADD PRIMARY KEY (`id_tagihan`);

--
-- Indexes for table `tarif`
--
ALTER TABLE `tarif`
  ADD PRIMARY KEY (`id_tarif`);

--
-- Indexes for table `teller`
--
ALTER TABLE `teller`
  ADD PRIMARY KEY (`id_teller`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tagihan`
--
ALTER TABLE `tagihan`
  MODIFY `id_tagihan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tarif`
--
ALTER TABLE `tarif`
  MODIFY `id_tarif` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
