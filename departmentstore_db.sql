-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2016 at 07:38 AM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `departmentstore_db`
--
CREATE DATABASE IF NOT EXISTS `departmentstore_db` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `departmentstore_db`;

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

DROP TABLE IF EXISTS `barang`;
CREATE TABLE `barang` (
  `ID_BARANG` varchar(10) NOT NULL,
  `ID_KATEGORI` varchar(3) NOT NULL,
  `ID_BRAND` varchar(5) NOT NULL,
  `NAMA_BARANG` varchar(25) NOT NULL,
  `HARGA_JUAL` int(9) NOT NULL,
  `HARGA_BELI` int(9) NOT NULL,
  `SIZE` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`ID_BARANG`, `ID_KATEGORI`, `ID_BRAND`, `NAMA_BARANG`, `HARGA_JUAL`, `HARGA_BELI`, `SIZE`) VALUES
('BA11160001', 'K03', 'BR001', 'KAOS POLO KUNING', 250000, 100000, 'S'),
('BA11160002', 'K03', 'BR001', 'KAOS POLO KUNING', 250000, 100000, 'M'),
('BA11160003', 'K03', 'BR001', 'KAOS POLO KUNING', 250000, 100000, 'L'),
('BA11160004', 'K03', 'BR001', 'KAOS POLO KUNING', 250000, 100000, 'XL'),
('BA11160005', 'K04', 'BR001', 'KAOS POLO KUNING', 250000, 100000, 'S'),
('BA11160006', 'K04', 'BR001', 'KAOS POLO KUNING', 250000, 100000, 'M'),
('BA11160007', 'K04', 'BR001', 'KAOS POLO KUNING', 250000, 100000, 'L'),
('BA11160008', 'K04', 'BR001', 'KAOS POLO KUNING', 250000, 100000, 'XL');

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

DROP TABLE IF EXISTS `brand`;
CREATE TABLE `brand` (
  `ID_BRAND` varchar(5) NOT NULL,
  `NAMA_BRAND` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`ID_BRAND`, `NAMA_BRAND`) VALUES
('BR001', 'POLO'),
('BR002', 'ZARA'),
('BR003', 'GIORDANO'),
('BR004', 'HERMES'),
('BR005', 'RALPH LAUREN'),
('BR006', 'LEVI''S'),
('BR007', 'LACOSTE');

-- --------------------------------------------------------

--
-- Table structure for table `dbeli`
--

DROP TABLE IF EXISTS `dbeli`;
CREATE TABLE `dbeli` (
  `ID_HBELI` varchar(10) NOT NULL,
  `ID_BARANG` varchar(10) NOT NULL,
  `NAMA_BARANG` varchar(25) NOT NULL,
  `QTYPESAN` int(3) NOT NULL,
  `QTYDATANG` int(3) NOT NULL,
  `SUBTOTAL` int(10) NOT NULL,
  `HARGA_BELI` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dgudang`
--

DROP TABLE IF EXISTS `dgudang`;
CREATE TABLE `dgudang` (
  `ID_GUDANG` varchar(5) NOT NULL,
  `ID_BARANG` varchar(10) NOT NULL,
  `STOK` int(3) NOT NULL,
  `NO_RAK` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `djual`
--

DROP TABLE IF EXISTS `djual`;
CREATE TABLE `djual` (
  `ID_BARANG` varchar(10) NOT NULL,
  `KD_TRANSAKSI_HJUAL` varchar(10) NOT NULL,
  `HARGA` int(10) NOT NULL,
  `QTY` int(3) NOT NULL,
  `DISKON` int(5) NOT NULL,
  `SUBTOTAL` int(3) NOT NULL,
  `SUBTOTAL_NETTO` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dtransgudang`
--

DROP TABLE IF EXISTS `dtransgudang`;
CREATE TABLE `dtransgudang` (
  `ID_TRANS_GUDANG` varchar(10) NOT NULL,
  `ID_BARANG` varchar(10) NOT NULL,
  `QTY` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gudang`
--

DROP TABLE IF EXISTS `gudang`;
CREATE TABLE `gudang` (
  `ID_GUDANG` varchar(5) NOT NULL,
  `NAMA_GUDANG` varchar(25) NOT NULL,
  `ALAMAT_GUDANG` varchar(50) NOT NULL,
  `TELP_GUDANG` varchar(12) NOT NULL,
  `NAMACP_GUDANG` varchar(25) DEFAULT NULL,
  `TELPCP_GUDANG` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gudang`
--

INSERT INTO `gudang` (`ID_GUDANG`, `NAMA_GUDANG`, `ALAMAT_GUDANG`, `TELP_GUDANG`, `NAMACP_GUDANG`, `TELPCP_GUDANG`) VALUES
('GU001', 'GUDANG NON TENGGILIS', 'TENGGILIS 123', '08189438834', 'RIO ADIANTO', '02147483647'),
('GU002', 'GUDANG NON MENUR', 'RAYA MENUR 123', '0891398343', 'WAHYU FEBRYANTO', '0899343432'),
('GU003', 'GUDANG GALAXY MALL 1', 'DHARMAHUSADA INDAH 1', '38943432', 'RIO ADIANTO', '02147483647'),
('GU004', 'GUDANG GALAXY MALL 2', 'DHARMAHUSADA INDAH 1', '381943834', 'STEVEN CHRISTIAN', '02147483647');

-- --------------------------------------------------------

--
-- Table structure for table `h_beli`
--

DROP TABLE IF EXISTS `h_beli`;
CREATE TABLE `h_beli` (
  `ID_HBELI` varchar(10) NOT NULL,
  `ID_SUPPLIER` varchar(5) NOT NULL,
  `ID_GUDANG` varchar(5) NOT NULL,
  `TANGGAL` datetime NOT NULL,
  `STATUS_LUNAS` varchar(1) NOT NULL,
  `TOTAL` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `h_jual`
--

DROP TABLE IF EXISTS `h_jual`;
CREATE TABLE `h_jual` (
  `KD_TRANSAKSI_HJUAL` varchar(10) NOT NULL,
  `ID_MEMBER` varchar(5) NOT NULL,
  `ID_GUDANG` varchar(5) NOT NULL,
  `TGL_TRANS` datetime NOT NULL,
  `TOTAL_HARGA` int(9) NOT NULL,
  `JENIS_PEMBAYARAN` varchar(10) NOT NULL,
  `ID_PROMO` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

DROP TABLE IF EXISTS `kategori`;
CREATE TABLE `kategori` (
  `ID_KATEGORI` varchar(3) NOT NULL,
  `NAMA_KATEGORI` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`ID_KATEGORI`, `NAMA_KATEGORI`) VALUES
('K01', 'BAJU ANAK COWOK'),
('K02', 'BAJU ANAK CEWEK'),
('K03', 'KAOS ANAK COWOK'),
('K04', 'KAOS ANAK CEWEK'),
('K05', 'CELANA DALAM ANAK COWOK'),
('K06', 'CELANA DALAM ANAK CEWEK'),
('K07', 'KAOS DALAM ANAK COWOK'),
('K08', 'KAOS DALAM ANAK CEWEK'),
('K09', 'CELANA PENDEK ANAK COWOK'),
('K10', 'CELANA PENDEK ANAK CEWEK'),
('K11', 'CELANA PANJANG ANAK COWOK'),
('K12', 'CELANA PANJANG ANAK CEWEK');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

DROP TABLE IF EXISTS `member`;
CREATE TABLE `member` (
  `ID_MEMBER` varchar(5) NOT NULL,
  `NAMA` varchar(25) NOT NULL,
  `ALAMAT` varchar(50) NOT NULL,
  `TELP` varchar(12) NOT NULL,
  `POIN` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `promo`
--

DROP TABLE IF EXISTS `promo`;
CREATE TABLE `promo` (
  `ID_PROMO` varchar(10) NOT NULL,
  `NAMA_PROMO` varchar(25) NOT NULL,
  `DISKON` int(3) NOT NULL,
  `TGL_MULAI` datetime NOT NULL,
  `TGL_AKHIR` datetime NOT NULL,
  `KETERANGAN` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

DROP TABLE IF EXISTS `supplier`;
CREATE TABLE `supplier` (
  `ID_SUPPLIER` varchar(5) NOT NULL,
  `NAMA_SUPPLIER` varchar(25) NOT NULL,
  `NAMACP` varchar(25) DEFAULT NULL,
  `TELPCP` varchar(12) NOT NULL,
  `ALAMAT_SUP` varchar(50) NOT NULL,
  `TELP_SUP` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transfer_gudang`
--

DROP TABLE IF EXISTS `transfer_gudang`;
CREATE TABLE `transfer_gudang` (
  `ID_TRANS_GUDANG` varchar(10) NOT NULL,
  `ID_GUDANG` varchar(5) NOT NULL,
  `GUD_ID_GUDANG` varchar(5) NOT NULL,
  `TGL` datetime NOT NULL,
  `KETERANGAN` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`ID_BARANG`),
  ADD KEY `FK_BARANG_BRAND` (`ID_BRAND`),
  ADD KEY `FK_BARANG_KAT` (`ID_KATEGORI`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`ID_BRAND`);

--
-- Indexes for table `dbeli`
--
ALTER TABLE `dbeli`
  ADD PRIMARY KEY (`ID_HBELI`,`ID_BARANG`),
  ADD KEY `FK_DBELI2` (`ID_BARANG`);

--
-- Indexes for table `dgudang`
--
ALTER TABLE `dgudang`
  ADD PRIMARY KEY (`ID_GUDANG`,`ID_BARANG`),
  ADD KEY `FK_DGUDANG2` (`ID_BARANG`);

--
-- Indexes for table `djual`
--
ALTER TABLE `djual`
  ADD PRIMARY KEY (`ID_BARANG`,`KD_TRANSAKSI_HJUAL`),
  ADD KEY `FK_DJUAL2` (`KD_TRANSAKSI_HJUAL`);

--
-- Indexes for table `dtransgudang`
--
ALTER TABLE `dtransgudang`
  ADD PRIMARY KEY (`ID_TRANS_GUDANG`,`ID_BARANG`),
  ADD KEY `FK_DTRANSGUDANG2` (`ID_BARANG`);

--
-- Indexes for table `gudang`
--
ALTER TABLE `gudang`
  ADD PRIMARY KEY (`ID_GUDANG`);

--
-- Indexes for table `h_beli`
--
ALTER TABLE `h_beli`
  ADD PRIMARY KEY (`ID_HBELI`),
  ADD KEY `FK_GUDANG_HBELI` (`ID_GUDANG`),
  ADD KEY `FK_SUP_HBELI` (`ID_SUPPLIER`);

--
-- Indexes for table `h_jual`
--
ALTER TABLE `h_jual`
  ADD PRIMARY KEY (`KD_TRANSAKSI_HJUAL`),
  ADD KEY `FK_GUDANG_HJUAL` (`ID_GUDANG`),
  ADD KEY `FK_MEMBER_HJUAL` (`ID_MEMBER`),
  ADD KEY `FK_PROMO_HJUAL` (`ID_PROMO`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`ID_KATEGORI`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`ID_MEMBER`);

--
-- Indexes for table `promo`
--
ALTER TABLE `promo`
  ADD PRIMARY KEY (`ID_PROMO`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`ID_SUPPLIER`);

--
-- Indexes for table `transfer_gudang`
--
ALTER TABLE `transfer_gudang`
  ADD PRIMARY KEY (`ID_TRANS_GUDANG`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `FK_BARANG_BRAND` FOREIGN KEY (`ID_BRAND`) REFERENCES `brand` (`ID_BRAND`),
  ADD CONSTRAINT `FK_BARANG_KAT` FOREIGN KEY (`ID_KATEGORI`) REFERENCES `kategori` (`ID_KATEGORI`);

--
-- Constraints for table `dbeli`
--
ALTER TABLE `dbeli`
  ADD CONSTRAINT `FK_DBELI` FOREIGN KEY (`ID_HBELI`) REFERENCES `h_beli` (`ID_HBELI`),
  ADD CONSTRAINT `FK_DBELI2` FOREIGN KEY (`ID_BARANG`) REFERENCES `barang` (`ID_BARANG`);

--
-- Constraints for table `dgudang`
--
ALTER TABLE `dgudang`
  ADD CONSTRAINT `FK_DGUDANG` FOREIGN KEY (`ID_GUDANG`) REFERENCES `gudang` (`ID_GUDANG`),
  ADD CONSTRAINT `FK_DGUDANG2` FOREIGN KEY (`ID_BARANG`) REFERENCES `barang` (`ID_BARANG`);

--
-- Constraints for table `djual`
--
ALTER TABLE `djual`
  ADD CONSTRAINT `FK_DJUAL` FOREIGN KEY (`ID_BARANG`) REFERENCES `barang` (`ID_BARANG`),
  ADD CONSTRAINT `FK_DJUAL2` FOREIGN KEY (`KD_TRANSAKSI_HJUAL`) REFERENCES `h_jual` (`KD_TRANSAKSI_HJUAL`);

--
-- Constraints for table `dtransgudang`
--
ALTER TABLE `dtransgudang`
  ADD CONSTRAINT `FK_DTRANSGUDANG` FOREIGN KEY (`ID_TRANS_GUDANG`) REFERENCES `transfer_gudang` (`ID_TRANS_GUDANG`),
  ADD CONSTRAINT `FK_DTRANSGUDANG2` FOREIGN KEY (`ID_BARANG`) REFERENCES `barang` (`ID_BARANG`);

--
-- Constraints for table `h_beli`
--
ALTER TABLE `h_beli`
  ADD CONSTRAINT `FK_GUDANG_HBELI` FOREIGN KEY (`ID_GUDANG`) REFERENCES `gudang` (`ID_GUDANG`),
  ADD CONSTRAINT `FK_SUP_HBELI` FOREIGN KEY (`ID_SUPPLIER`) REFERENCES `supplier` (`ID_SUPPLIER`);

--
-- Constraints for table `h_jual`
--
ALTER TABLE `h_jual`
  ADD CONSTRAINT `FK_GUDANG_HJUAL` FOREIGN KEY (`ID_GUDANG`) REFERENCES `gudang` (`ID_GUDANG`),
  ADD CONSTRAINT `FK_MEMBER_HJUAL` FOREIGN KEY (`ID_MEMBER`) REFERENCES `member` (`ID_MEMBER`),
  ADD CONSTRAINT `FK_PROMO_HJUAL` FOREIGN KEY (`ID_PROMO`) REFERENCES `promo` (`ID_PROMO`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
