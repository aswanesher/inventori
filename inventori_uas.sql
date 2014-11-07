-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 04, 2014 at 07:46 
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `inventori_uas`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE IF NOT EXISTS `account` (
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `nama` varchar(70) NOT NULL,
  `level` varchar(5) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`username`, `password`, `nama`, `level`) VALUES
('21232f297a57a5a743894a0e4a801fc3', '21232f297a57a5a743894a0e4a801fc3', 'administrator', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE IF NOT EXISTS `barang` (
  `inc` int(9) NOT NULL AUTO_INCREMENT,
  `barang_id` varchar(14) NOT NULL,
  `barang_nama` varchar(90) NOT NULL,
  `barang_kategori` varchar(7) NOT NULL,
  PRIMARY KEY (`inc`),
  KEY `barang_id` (`barang_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=69 ;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`inc`, `barang_id`, `barang_nama`, `barang_kategori`) VALUES
(6, 'JIMS', 'JERUK_IMPERIAL_AUSTRALI', 'IMPORT'),
(7, 'PSYA', 'PER_SYANGLIE', 'IMPORT'),
(8, 'PIJO', 'PEAR_IJO', 'IMPORT'),
(9, 'AGCK', 'ANGGUR_CINA_KRAT', 'IMPORT'),
(10, 'FROSY100', 'FUJI_ROSI_100', 'IMPORT'),
(11, 'APT216', 'APEL_TOP_RED', 'IMPORT'),
(12, 'FRS125', 'FUJI_RED_STAR_125', 'IMPORT'),
(13, 'APGL', 'APEL_GALA', 'IMPORT'),
(14, 'FLS_100', 'FUJI_LOVE_STORI_100', 'IMPORT'),
(15, 'FLS_113', 'FUJI_LOVE_STORY_113', 'IMPORT'),
(16, 'PYA', 'PEAR_YALI', 'IMPORT'),
(17, 'FQQ88', 'FUJI_QINQUAN_88', 'IMPORT'),
(18, 'JSTG', 'JERUK_SANTANG', 'IMPORT'),
(19, 'FLS125', 'FUJI_LOVE_STORY_125', 'IMPORT'),
(20, 'APM175', 'APEL_MERAH_175', 'IMPORT'),
(21, 'AGS', 'APEL_GREENSMEET', 'IMPORT'),
(22, 'FUB113', 'FUJI_ABAG_113', 'IMPORT'),
(23, 'LGEMK', 'LENGKENG_EMAS_KUNING', 'IMPORT'),
(24, 'APMT216', 'APEL_MERAH_216', 'IMPORT'),
(25, 'FHL_138', 'FUJI_HALA_138', 'IMPORT'),
(26, 'JNV', 'JERUK_NEVEL', 'IMPORT'),
(27, 'AGRC', 'ANGGUR_CINA', 'IMPORT'),
(28, 'JHK', 'JERUK_HIKAM', 'IMPORT'),
(29, 'AGRA', 'ANGGUR_AMERIKA', 'IMPORT'),
(30, 'ASM', 'ASEM', 'IMPORT'),
(31, 'FHL_125', 'FUJI_HALA_125', 'IMPORT'),
(32, 'JMC', 'JERUK_MURCOT', 'IMPORT'),
(33, 'LGEM', 'LENGKENG_MERAH', 'IMPORT'),
(34, 'APM163', 'APEL_MERAH_163', 'IMPORT'),
(35, 'APMS150', 'APEL_MERAH_150', 'IMPORT'),
(36, 'FDJ_125', 'FUJI_JUNJY_125', 'IMPORT'),
(37, 'FHL', 'FUJI_HALA_113', 'IMPORT'),
(38, 'FSHD113', 'FUJI__SHANDONG_113', 'IMPORT'),
(39, 'STG', 'JERUK_SANTANG', 'IMPORT'),
(40, 'JST_M', 'JERUK_SANTANG_M', 'IMPORT'),
(41, 'STD', 'SANTANG_DAUN', 'IMPORT'),
(42, 'FQQ100', 'FUJI_QINQUAN_100', 'IMPORT'),
(43, 'PKM', 'JERUK_PONKAM', 'IMPORT'),
(44, 'FTY_113', 'FUJI_APLE_113', 'IMPORT'),
(45, 'FTY_125', 'FUJI_APLE_125', 'IMPORT'),
(46, 'FTY_100', 'FUJI_APLE_100', 'IMPORT'),
(47, 'FUB125', 'FUJI_BAG_125', 'IMPORT'),
(48, 'FGF', 'FUJI_GOOD_FARMER', 'IMPORT'),
(49, 'FGY100', 'FUJI_GY_100', 'IMPORT'),
(50, 'FTTY100', 'FUJI_TTY_100', 'IMPORT'),
(51, 'FDN100', 'FUJIDOING_100', 'IMPORT'),
(52, 'FGY113', 'FUJIGUANGYUAN_113', 'IMPORT'),
(53, 'STJ', 'SANTANG_JARING', 'IMPORT'),
(54, 'A', 'FUJI_BAG_113', 'IMPORT'),
(55, 'NVL', 'SUNKIST_NEVEL', 'IMPORT'),
(56, 'PSW', 'SWEET_PEAR', 'IMPORT'),
(57, 'FLS113', 'FUJI_LOVE_STORI_113', 'IMPORT'),
(58, 'FLS100', 'FUJI_LOVE_STORI_100', 'IMPORT'),
(59, 'FDN125', 'FUJIDOING_125', 'IMPORT'),
(60, 'FGF125', 'FUJI_GOOD_FARMER125', 'IMPORT'),
(61, 'FGF138', 'FUJI_GOOD_FARMER138', 'IMPORT'),
(62, 'AGRD', 'ANGGUR_DRAGON', 'IMPORT'),
(63, 'FGY125', 'FUJI_GY_125', 'IMPORT'),
(64, 'FLL100', 'FUJI_LILI100', 'IMPORT'),
(65, 'FLL113', 'FUJI_LIL113', 'IMPORT'),
(66, 'FSMRT100', 'FUJI_SMARTIE100', 'IMPORT');

-- --------------------------------------------------------

--
-- Table structure for table `beli`
--

CREATE TABLE IF NOT EXISTS `beli` (
  `inc` int(9) NOT NULL,
  `beli_id` varchar(9) NOT NULL,
  `no_fak` varchar(14) NOT NULL,
  `tgl_trans` varchar(10) NOT NULL,
  `supplier_nama` varchar(90) NOT NULL,
  `biaya_kirim` double(20,0) NOT NULL,
  `total` double(20,0) NOT NULL,
  PRIMARY KEY (`inc`),
  KEY `beli_id` (`beli_id`),
  KEY `supplier_id` (`supplier_nama`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `beli`
--

INSERT INTO `beli` (`inc`, `beli_id`, `no_fak`, `tgl_trans`, `supplier_nama`, `biaya_kirim`, `total`) VALUES
(1, 'BM-1', 'FAK-1', '11/04/2012', 'PT INDOPRIMA UTAMA MANDIRI', 100000, 4584000),
(2, 'BM-2', 'FAK-2', '11/04/2012', 'PT RAJASRI SEJAHTERA', 110000, 4670000),
(3, 'BM-3', 'FAK-3', '11/04/2012', 'SEGAR', 109000, 4680000),
(4, 'BM-4', 'FAK-4', '12/04/2012', 'UD DEWATA SURYA UTAMA', 100000, 2940000),
(5, 'BM-5', 'FAK-5', '15/04/2012', 'SEGAR', 100000, 630000),
(6, 'BM-6', 'FAK-6', '23/04/2012', 'SEGAR', 170000, 1941000),
(7, 'BM-7', 'FAK-7', '24/04/2012', 'UD PRIORITAS 1', 100000, 1503000);

-- --------------------------------------------------------

--
-- Table structure for table `beli_detail`
--

CREATE TABLE IF NOT EXISTS `beli_detail` (
  `beli_id` varchar(9) NOT NULL,
  `barang_id` varchar(14) NOT NULL,
  `barang_nama` varchar(90) NOT NULL,
  `kategori` varchar(5) NOT NULL,
  `qty` smallint(5) NOT NULL,
  `satuan` varchar(14) NOT NULL,
  `harga_satuan` double(20,0) NOT NULL,
  `harga_total` double(20,0) NOT NULL,
  KEY `beli_id` (`beli_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `beli_detail`
--

INSERT INTO `beli_detail` (`beli_id`, `barang_id`, `barang_nama`, `kategori`, `qty`, `satuan`, `harga_satuan`, `harga_total`) VALUES
('BM-1', 'AGRA', 'ANGGUR_AMERIKA', 'IMPOR', 14, 'box', 120000, 1680000),
('BM-1', 'APGL', 'APEL_GALA', 'IMPOR', 16, 'box', 119000, 1904000),
('BM-1', 'FDN113', 'FUJIDOING113', 'IMPOR', 10, 'box', 100000, 1000000),
('BM-2', 'FTY_100', 'FUJI_APLE_100', 'IMPOR', 20, 'box', 123000, 2460000),
('BM-2', 'FLS_100', 'FUJI_LOVE_STORI_100', 'IMPOR', 17, 'box', 130000, 2210000),
('BM-3', 'PKM', 'JERUK_PONKAM', 'IMPOR', 25, 'box', 100000, 2500000),
('BM-3', 'PSW', 'SWEET_PEAR', 'IMPOR', 20, 'box', 109000, 2180000),
('BM-4', 'NVL', 'SUNKIST_NEVEL', 'IMPOR', 19, 'box', 120000, 2280000),
('BM-4', 'AGS', 'APEL_GREENSMEET', 'IMPOR', 6, 'box', 110000, 660000),
('BM-5', 'AGRA', 'ANGGUR_AMERIKA', 'IMPOR', 7, 'box', 90000, 630000),
('BM-6', 'PSW', 'SWEET_PEAR', 'IMPOR', 9, 'box', 120000, 1080000),
('BM-6', 'APGL', 'APEL_GALA', 'IMPOR', 7, 'box', 123000, 861000),
('BM-7', 'aswer', 'Apel Fuji 123', 'IMPOR', 7, 'box', 90000, 630000),
('BM-7', 'FDN113', 'FUJIDOING113', 'IMPOR', 9, 'box', 97000, 873000);

-- --------------------------------------------------------

--
-- Table structure for table `jual`
--

CREATE TABLE IF NOT EXISTS `jual` (
  `inc` int(9) NOT NULL,
  `jual_id` varchar(14) NOT NULL,
  `no_nota` varchar(14) NOT NULL,
  `tgl_jual` varchar(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `pelanggan_nama` varchar(90) NOT NULL,
  `total` double(20,0) NOT NULL,
  `jml_bayar` double(20,0) NOT NULL,
  `tgl_jatuh_tempo` varchar(10) NOT NULL,
  PRIMARY KEY (`inc`),
  KEY `username` (`username`),
  KEY `jual_id` (`jual_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jual`
--

INSERT INTO `jual` (`inc`, `jual_id`, `no_nota`, `tgl_jual`, `username`, `pelanggan_nama`, `total`, `jml_bayar`, `tgl_jatuh_tempo`) VALUES
(1, 'JL-1', 'nota-1', '11/04/2012', '21232f297a57a5a743894a0e4a801fc3', 'Komang', 935000, 700000, '12/04/2012'),
(2, 'JL-2', 'nota-2', '11/04/2012', '21232f297a57a5a743894a0e4a801fc3', 'umum', 258000, 258000, ''),
(3, 'JL-3', 'nota-3', '11/04/2012', '21232f297a57a5a743894a0e4a801fc3', 'Fendi', 904000, 500000, '12/04/2012'),
(4, 'JL-4', 'nota-4', '07/04/2012', '21232f297a57a5a743894a0e4a801fc3', 'Andy', 568000, 370000, '09/04/2012'),
(6, 'JL-6', 'nota-6', '24/04/2012', '21232f297a57a5a743894a0e4a801fc3', 'umum', 270000, 200000, '25/04/2012');

-- --------------------------------------------------------

--
-- Table structure for table `jual_detail`
--

CREATE TABLE IF NOT EXISTS `jual_detail` (
  `jual_id` varchar(9) NOT NULL,
  `barang_id` varchar(14) NOT NULL,
  `barang_nama` varchar(90) NOT NULL,
  `kategori` varchar(5) NOT NULL,
  `qty` smallint(5) NOT NULL,
  `satuan` varchar(14) NOT NULL,
  `harga_satuan` double(20,0) NOT NULL,
  `harga_total` double(20,0) NOT NULL,
  KEY `jual_id` (`jual_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jual_detail`
--

INSERT INTO `jual_detail` (`jual_id`, `barang_id`, `barang_nama`, `kategori`, `qty`, `satuan`, `harga_satuan`, `harga_total`) VALUES
('JL-1', 'AGRA', 'ANGGUR_AMERIKA', 'IMPOR', 5, 'box', 135000, 675000),
('JL-1', 'APGL', 'APEL_GALA', 'IMPOR', 2, 'box', 130000, 260000),
('JL-2', 'FLS_100', 'FUJI_LOVE_STORI_100', 'IMPOR', 2, 'box', 129000, 258000),
('JL-3', 'APGL', 'APEL_GALA', 'IMPOR', 5, 'box', 130000, 650000),
('JL-3', 'PSW', 'SWEET_PEAR', 'IMPOR', 2, 'box', 127000, 254000),
('JL-4', 'PKM', 'JERUK_PONKAM', 'IMPOR', 2, 'box', 119000, 238000),
('JL-4', 'PSW', 'SWEET_PEAR', 'IMPOR', 3, 'box', 110000, 330000),
('JL-6', 'PSW', 'SWEET_PEAR', 'IMPOR', 3, 'box', 90000, 270000);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE IF NOT EXISTS `pelanggan` (
  `inc` int(9) NOT NULL,
  `pelanggan_id` varchar(9) NOT NULL,
  `pelanggan_nama` varchar(90) NOT NULL,
  `pelanggan_alamat` varchar(90) NOT NULL,
  `pelanggan_kota` varchar(50) NOT NULL,
  `pelanggan_email` varchar(90) NOT NULL,
  `pelanggan_kontak` varchar(20) NOT NULL,
  PRIMARY KEY (`inc`),
  KEY `pelanggan_id` (`pelanggan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`inc`, `pelanggan_id`, `pelanggan_nama`, `pelanggan_alamat`, `pelanggan_kota`, `pelanggan_email`, `pelanggan_kontak`) VALUES
(2, 'PLG-2', 'Komang', 'Jl.Setiabudi Penarungan', 'Singaraja', 'komkim@yahoo.com', '082345245'),
(3, 'PLG-3', 'Fendi', 'Jl.Gn Agung', 'Denpasar', 'fendi@yahoo.com', '085755476792'),
(4, 'PLG-4', 'Hendra', 'Jl. Laksamana', 'Singaraja', 'hendrasatriani90@yahoo.co.id', '08452455424'),
(5, 'PLG-5', 'Ayu', 'Jl.Gn Guntur', 'Denpasar', 'ayu@yahoo.co.id', '0879967700'),
(6, 'PLG-6', 'Andy', 'Jl. Gatot Subroto Barat', 'Denpasar', 'andy@yahoo.com', '08500700'),
(7, 'PLG-7', 'Ketut Atmaja', 'Jl. Pulau Batam', 'Singaraja', 'ktatmaja@yahoo.com', '08512345'),
(8, 'PLG-8', 'Kadek Leo', 'Jl. Sermakarma', 'Singaraja', 'leo_kade@yahoo.com', '085789000'),
(9, 'PLG-9', 'Gusti Bagus Jayantara', 'Jl. A.Yani', 'Singaraja', 'gusti_bgst@yahoo.com', '0854372889');

-- --------------------------------------------------------

--
-- Table structure for table `stok`
--

CREATE TABLE IF NOT EXISTS `stok` (
  `barang_id` varchar(14) NOT NULL,
  `barang_nama` varchar(90) NOT NULL,
  `kategori` varchar(5) NOT NULL,
  `qty` smallint(5) NOT NULL,
  `satuan` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stok`
--

INSERT INTO `stok` (`barang_id`, `barang_nama`, `kategori`, `qty`, `satuan`) VALUES
('AGRA', 'ANGGUR_AMERIKA', 'IMPOR', 16, 'box'),
('APGL', 'APEL_GALA', 'IMPOR', 16, 'box'),
('FDN113', 'FUJIDOING113', 'IMPOR', 19, 'box'),
('FTY_100', 'FUJI_APLE_100', 'IMPOR', 20, 'box'),
('FLS_100', 'FUJI_LOVE_STORI_100', 'IMPOR', 15, 'box'),
('PKM', 'JERUK_PONKAM', 'IMPOR', 23, 'box'),
('PSW', 'SWEET_PEAR', 'IMPOR', 21, 'box'),
('NVL', 'SUNKIST_NEVEL', 'IMPOR', 19, 'box'),
('AGS', 'APEL_GREENSMEET', 'IMPOR', 3, 'box'),
('aswer', 'Apel Fuji 123', 'IMPOR', 7, 'box');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE IF NOT EXISTS `supplier` (
  `inc` int(9) NOT NULL,
  `supplier_id` varchar(9) NOT NULL,
  `supplier_nama` varchar(90) NOT NULL,
  `supplier_alamat` varchar(90) NOT NULL,
  `supplier_kota` varchar(50) NOT NULL,
  `supplier_email` varchar(90) NOT NULL,
  `supplier_kontak` varchar(20) NOT NULL,
  PRIMARY KEY (`inc`),
  KEY `supplier_id` (`supplier_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`inc`, `supplier_id`, `supplier_nama`, `supplier_alamat`, `supplier_kota`, `supplier_email`, `supplier_kontak`) VALUES
(1, 'INDOPRIMA', 'PT INDOPRIMA UTAMA MANDIRI', 'Jl.Buluh Indah', 'Denpasar', 'ptindoprima@gmail.com', '08174577889'),
(2, 'DWT', 'UD DEWATA SURYA UTAMA', 'BATU MALANG', 'Malang', 'dewata_surya_utama@yahoo.com', '085123456'),
(3, 'USMAN', 'UD PRIORITAS 1 ', 'jakarta', 'Jakarta', 'prioritas_@yahoo.com', '087128393'),
(4, 'SGR', 'SEGAR', 'ANYARSARI', 'DENPASAR', 'segar_buah@gmail.com', '036122157'),
(5, 'RJS', 'PT RAJASRI SEJAHTERA', 'JL TANAH MERDEKA PSR REBO ', 'JAKARTA', 'rajasri@yahoo.com', '087987653');

-- --------------------------------------------------------

--
-- Table structure for table `temp_beli_detail`
--

CREATE TABLE IF NOT EXISTS `temp_beli_detail` (
  `beli_id` varchar(9) NOT NULL,
  `barang_id` varchar(14) NOT NULL,
  `barang_nama` varchar(90) NOT NULL,
  `kategori` varchar(5) NOT NULL,
  `qty` smallint(7) NOT NULL,
  `satuan` varchar(14) NOT NULL,
  `harga_satuan` double(20,0) NOT NULL,
  `harga_total` double(20,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `temp_beli_detail`
--


-- --------------------------------------------------------

--
-- Table structure for table `temp_jual_detail`
--

CREATE TABLE IF NOT EXISTS `temp_jual_detail` (
  `jual_id` varchar(9) NOT NULL,
  `barang_id` varchar(14) NOT NULL,
  `barang_nama` varchar(90) NOT NULL,
  `kategori` varchar(5) NOT NULL,
  `qty` smallint(7) NOT NULL,
  `satuan` varchar(14) NOT NULL,
  `harga_satuan` double(20,0) NOT NULL,
  `harga_total` double(20,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `temp_jual_detail`
--


--
-- Constraints for dumped tables
--

--
-- Constraints for table `beli_detail`
--
ALTER TABLE `beli_detail`
  ADD CONSTRAINT `beli_detail_ibfk_1` FOREIGN KEY (`beli_id`) REFERENCES `beli` (`beli_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `jual`
--
ALTER TABLE `jual`
  ADD CONSTRAINT `jual_ibfk_1` FOREIGN KEY (`username`) REFERENCES `account` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `jual_detail`
--
ALTER TABLE `jual_detail`
  ADD CONSTRAINT `jual_detail_ibfk_1` FOREIGN KEY (`jual_id`) REFERENCES `jual` (`jual_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
