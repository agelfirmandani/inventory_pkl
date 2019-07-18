-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 18, 2019 at 01:01 PM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

DROP TABLE IF EXISTS `tb_admin`;
CREATE TABLE IF NOT EXISTS `tb_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` enum('admin') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`id`, `username`, `password`, `level`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `tb_barang`
--

DROP TABLE IF EXISTS `tb_barang`;
CREATE TABLE IF NOT EXISTS `tb_barang` (
  `ID_BRG` int(11) NOT NULL AUTO_INCREMENT,
  `ID_BRAND` int(11) DEFAULT NULL,
  `ID_SATUAN` int(11) DEFAULT NULL,
  `ID_CATEGORY` int(11) DEFAULT NULL,
  `ID_JNS_BRG` int(11) DEFAULT NULL,
  `NOMOR_BRG` int(11) DEFAULT NULL,
  `NAMA_BRG` varchar(100) DEFAULT NULL,
  `HARGA_BELI` float DEFAULT NULL,
  `HARGA_JUAL` float DEFAULT NULL,
  `STOK` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_BRG`),
  KEY `Relasi 1` (`ID_BRAND`),
  KEY `Relasi 3` (`ID_CATEGORY`),
  KEY `Relasi 4` (`ID_JNS_BRG`),
  KEY `Relasi 5` (`ID_SATUAN`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_barang`
--

INSERT INTO `tb_barang` (`ID_BRG`, `ID_BRAND`, `ID_SATUAN`, `ID_CATEGORY`, `ID_JNS_BRG`, `NOMOR_BRG`, `NAMA_BRG`, `HARGA_BELI`, `HARGA_JUAL`, `STOK`) VALUES
(1, 102, 1011, 10101, 101011, 0, 'Mie Sedap Goreng', 2000, 2500, 2000),
(2, 101, 1010, 10102, 101011, 0, 'C', 1000, 2000, 19);

-- --------------------------------------------------------

--
-- Table structure for table `tb_brand`
--

DROP TABLE IF EXISTS `tb_brand`;
CREATE TABLE IF NOT EXISTS `tb_brand` (
  `ID_BRAND` int(11) NOT NULL AUTO_INCREMENT,
  `NAMA_BRAND` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ID_BRAND`)
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_brand`
--

INSERT INTO `tb_brand` (`ID_BRAND`, `NAMA_BRAND`) VALUES
(101, 'Bimoli'),
(102, 'Indofood'),
(103, 'So nice'),
(104, 'Oreo'),
(105, 'Better'),
(106, 'So Joy'),
(107, 'Tango'),
(108, 'Nestle'),
(109, 'Qtela'),
(110, 'Piatos'),
(111, 'Leo'),
(112, 'Lays');

-- --------------------------------------------------------

--
-- Table structure for table `tb_cabang`
--

DROP TABLE IF EXISTS `tb_cabang`;
CREATE TABLE IF NOT EXISTS `tb_cabang` (
  `CB_ID` int(11) NOT NULL AUTO_INCREMENT,
  `CB_NAMA` varchar(100) DEFAULT NULL,
  `CB_ALAMAT` text,
  `CB_TELP` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`CB_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_cabang`
--

INSERT INTO `tb_cabang` (`CB_ID`, `CB_NAMA`, `CB_ALAMAT`, `CB_TELP`) VALUES
(2, 'PT. Indofood CBP Sukses Makmur, Tbk', 'Jalan Raya Klampok, Cangkring Malang, Beji, Wage, Cangkringmalang, Kec. Beji, Pasuruan, Jawa Timur 67154', '(0343) 656177'),
(3, 'Indofood Sukses Makmur Tbk. PT', 'Jl. Gatot Subroto No.58, Jelakombo, Kec. Jombang, Kabupaten Jombang, Jawa Timur 61412', '(0321) 853261'),
(4, 'PT. Gudang Garam Tbk.', 'Jl. Letjend Sutoyo No.55, Bungur, Medaeng, Kec. Waru, Kabupaten Sidoarjo, Jawa Timur 61256', '(031) 2985100'),
(5, 'GUDANG GARAM', 'Mlalen, Sidomulyo, Kedungadem, Kabupaten Bojonegoro, Jawa Timur 62195', '(0341)567456'),
(6, 'PT. Perusahaan Rokok Tjap Gudang Garam Tbk.', 'Jl. Ahmad Yani, Karanglo, Tikusan, Kapas, Kabupaten Bojonegoro, Jawa Timur 62181', '(0341) 786546'),
(7, 'PT Gudang Garam Tbk', 'Jalan Raya Tuban - Semarang Km 4, Sugihwaras, Jenu, Jabung, Sugihwaras, Jenu, Kabupaten Tuban, Jawa Timur 62352', '(0356) 334369');

-- --------------------------------------------------------

--
-- Table structure for table `tb_category`
--

DROP TABLE IF EXISTS `tb_category`;
CREATE TABLE IF NOT EXISTS `tb_category` (
  `ID_CATEGORY` int(11) NOT NULL AUTO_INCREMENT,
  `NAMA_CATEGORY` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ID_CATEGORY`)
) ENGINE=InnoDB AUTO_INCREMENT=10118 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_category`
--

INSERT INTO `tb_category` (`ID_CATEGORY`, `NAMA_CATEGORY`) VALUES
(10101, 'Bahan Makanan'),
(10102, 'Makanan Ringan'),
(10103, 'Beras'),
(10104, 'Minyak Goreng'),
(10105, 'Tepung'),
(10106, 'Susu'),
(10107, 'Soda'),
(10108, 'Juice'),
(10109, 'Air Mineral'),
(10110, 'Biscuit'),
(10111, 'Wafer'),
(10112, 'Roti Tawar'),
(10113, 'Sabun Mandi'),
(10114, 'Shampo'),
(10115, 'Pasta Gigi'),
(10116, 'Sabun Cuci Piring'),
(10117, 'Pemutih Pakaian');

-- --------------------------------------------------------

--
-- Table structure for table `tb_faktur`
--

DROP TABLE IF EXISTS `tb_faktur`;
CREATE TABLE IF NOT EXISTS `tb_faktur` (
  `ID_FAKTUR` int(11) NOT NULL AUTO_INCREMENT,
  `CB_ID` int(11) DEFAULT NULL,
  `ID_SJ` int(11) DEFAULT NULL,
  `NOMOR_FAKTUR` int(11) DEFAULT NULL,
  `TGL_FAKTUR` date DEFAULT NULL,
  `JATUH_TEMPO_FAKTOR` date DEFAULT NULL,
  `SUBTOTAL_FAKTUR` float DEFAULT NULL,
  `POTONGAN_FAKTUR` float DEFAULT NULL,
  `UANGMUKA_FAKTUR` float DEFAULT NULL,
  `TOTAL_FAKTUR` float DEFAULT NULL,
  `TUJUAN_TRANSFER_FAKTUR` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ID_FAKTUR`),
  KEY `Relasi 6` (`CB_ID`),
  KEY `Relasi 7` (`ID_SJ`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_gudang`
--

DROP TABLE IF EXISTS `tb_gudang`;
CREATE TABLE IF NOT EXISTS `tb_gudang` (
  `ID_GDG` int(11) NOT NULL AUTO_INCREMENT,
  `CB_ID` int(11) DEFAULT NULL,
  `ID_JNS_GDG` int(11) DEFAULT NULL,
  `NAMA_GDG` varchar(100) DEFAULT NULL,
  `ALAMAT_GDG` text,
  `KOTA_GDG` varchar(100) DEFAULT NULL,
  `TELP_GDG` varchar(15) DEFAULT NULL,
  `FAX_GDG` varchar(100) DEFAULT NULL,
  `EMAIL_GDG` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ID_GDG`),
  KEY `Relasi 8` (`CB_ID`),
  KEY `Relasi 9` (`ID_JNS_GDG`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_gudang`
--

INSERT INTO `tb_gudang` (`ID_GDG`, `CB_ID`, `ID_JNS_GDG`, `NAMA_GDG`, `ALAMAT_GDG`, `KOTA_GDG`, `TELP_GDG`, `FAX_GDG`, `EMAIL_GDG`) VALUES
(1, 1, 1, 'ABRI', 'Malang', 'Malang', '20809819', '982828', 'tes@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `tb_harga`
--

DROP TABLE IF EXISTS `tb_harga`;
CREATE TABLE IF NOT EXISTS `tb_harga` (
  `ID_HARGA` int(11) NOT NULL AUTO_INCREMENT,
  `ID_BRG` int(11) DEFAULT NULL,
  `CB_ID` int(11) DEFAULT NULL,
  `HARGAJUAL` float DEFAULT NULL,
  `HARGABELI` float DEFAULT NULL,
  PRIMARY KEY (`ID_HARGA`),
  KEY `Relasi 10` (`CB_ID`),
  KEY `Relasi 11` (`ID_BRG`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_jns_brg`
--

DROP TABLE IF EXISTS `tb_jns_brg`;
CREATE TABLE IF NOT EXISTS `tb_jns_brg` (
  `ID_JNS_BRG` int(11) NOT NULL AUTO_INCREMENT,
  `NAMA_JNS_BRG` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ID_JNS_BRG`)
) ENGINE=InnoDB AUTO_INCREMENT=101013 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_jns_brg`
--

INSERT INTO `tb_jns_brg` (`ID_JNS_BRG`, `NAMA_JNS_BRG`) VALUES
(101011, 'Ringan'),
(101012, 'Berat');

-- --------------------------------------------------------

--
-- Table structure for table `tb_jns_gdg`
--

DROP TABLE IF EXISTS `tb_jns_gdg`;
CREATE TABLE IF NOT EXISTS `tb_jns_gdg` (
  `ID_JNS_GDG` int(11) NOT NULL AUTO_INCREMENT,
  `NAMA_JNS_GDG` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ID_JNS_GDG`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_jns_gdg`
--

INSERT INTO `tb_jns_gdg` (`ID_JNS_GDG`, `NAMA_JNS_GDG`) VALUES
(1, 'Al'),
(5, 'Gudang Bahan Baku'),
(6, 'Gudang Barang Setengah Jadi'),
(7, 'Gudang Bahan Hasil Produksi'),
(8, 'Gudang Pusat Konsolidasi dan Transit'),
(9, 'Gudang Pusat Transhipment'),
(10, 'Gudang Cross Docking'),
(11, 'Gudang Pusat Sortir'),
(12, 'Gudang Fulfillment'),
(13, 'Gudang Proses Reverse Logistics'),
(14, 'Gudang Kepentingan Publik');

-- --------------------------------------------------------

--
-- Table structure for table `tb_order`
--

DROP TABLE IF EXISTS `tb_order`;
CREATE TABLE IF NOT EXISTS `tb_order` (
  `ID_ORDER` int(11) NOT NULL AUTO_INCREMENT,
  `CB_ID` int(11) DEFAULT NULL,
  `NOMOR_ORDER` varchar(15) DEFAULT NULL,
  `TGL_ORDER` date DEFAULT NULL,
  `TYPE_ORDER` varchar(100) DEFAULT NULL,
  `NAMA_DIKIRIM_ORDER` varchar(100) DEFAULT NULL,
  `ALAMAT_ORDER` text,
  `HP_FAX_ORDER` varchar(15) DEFAULT NULL,
  `SUBTOTAL_ORDER` float DEFAULT NULL,
  `PPN_ORDER` float DEFAULT NULL,
  `TOTAL_ORDER` float DEFAULT NULL,
  `TGL_KIRIM_ORDER` date DEFAULT NULL,
  `TUNAI_ORDER` varchar(100) DEFAULT NULL,
  `DP_ORDER` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ID_ORDER`),
  KEY `Relasi 12` (`CB_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_penawaran`
--

DROP TABLE IF EXISTS `tb_penawaran`;
CREATE TABLE IF NOT EXISTS `tb_penawaran` (
  `ID_PENAWARAN` int(11) NOT NULL AUTO_INCREMENT,
  `ID_PERM_PEMBELIAN` int(11) DEFAULT NULL,
  `CB_ID` int(11) DEFAULT NULL,
  `NOMOR_PENAWARAN` int(11) DEFAULT NULL,
  `JENIS_PENAWARAN` varchar(100) DEFAULT NULL,
  `TGL_PENAWARAN` date DEFAULT NULL,
  PRIMARY KEY (`ID_PENAWARAN`),
  KEY `Relasi 13` (`CB_ID`),
  KEY `Relasi 14` (`ID_PERM_PEMBELIAN`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_penerimaan_barang`
--

DROP TABLE IF EXISTS `tb_penerimaan_barang`;
CREATE TABLE IF NOT EXISTS `tb_penerimaan_barang` (
  `ID_PENERIMAAN_BRG` int(11) NOT NULL AUTO_INCREMENT,
  `ID_ORDER` int(11) DEFAULT NULL,
  `ID_GDG` int(11) DEFAULT NULL,
  `CB_ID` int(11) DEFAULT NULL,
  `NOMOR_PENERIMAAN_BRG` int(11) DEFAULT NULL,
  `TGL_PENERIMAAN_BRG` date DEFAULT NULL,
  `JENIS_PENERIMAAN_BRG` varchar(100) DEFAULT NULL,
  `SJ_PENERIMAAN` varchar(100) DEFAULT NULL,
  `TGL_TERIMA` date DEFAULT NULL,
  `SUBTOTAL_PENERIMAAN_BRG` float DEFAULT NULL,
  `PPN_PENERIMAAN_BRG` float DEFAULT NULL,
  `TOTAL_PENERIMAAN_BRG` float DEFAULT NULL,
  `CATATAN` text,
  PRIMARY KEY (`ID_PENERIMAAN_BRG`),
  KEY `Relasi 15` (`CB_ID`),
  KEY `Relasi 16` (`ID_GDG`),
  KEY `Relasi 17` (`ID_ORDER`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_permintaan_pembelian`
--

DROP TABLE IF EXISTS `tb_permintaan_pembelian`;
CREATE TABLE IF NOT EXISTS `tb_permintaan_pembelian` (
  `ID_PERM_PEMBELIAN` int(11) NOT NULL AUTO_INCREMENT,
  `CB_ID` int(11) DEFAULT NULL,
  `PP_NOMOR` varchar(15) DEFAULT NULL,
  `PP_TGL` date DEFAULT NULL,
  `PP_TGL_BUTUH` date DEFAULT NULL,
  `PP_JENIS` varchar(100) DEFAULT NULL,
  `ID_GDG` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_PERM_PEMBELIAN`),
  KEY `Relasi 18` (`CB_ID`),
  KEY `Relasi 19` (`ID_GDG`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_permintaan_pembeliandet`
--

DROP TABLE IF EXISTS `tb_permintaan_pembeliandet`;
CREATE TABLE IF NOT EXISTS `tb_permintaan_pembeliandet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pp` int(11) NOT NULL,
  `id_brg_det` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_retur_pembelian`
--

DROP TABLE IF EXISTS `tb_retur_pembelian`;
CREATE TABLE IF NOT EXISTS `tb_retur_pembelian` (
  `ID_RETUR_PEMBELIAN` int(11) NOT NULL AUTO_INCREMENT,
  `ID_PENERIMAAN_BRG` int(11) DEFAULT NULL,
  `CB_ID` int(11) DEFAULT NULL,
  `NOMOR_RETUR_PEMBELIAN` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_RETUR_PEMBELIAN`),
  KEY `Relasi 20` (`CB_ID`),
  KEY `Relasi 21` (`ID_PENERIMAAN_BRG`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_retur_penjualan`
--

DROP TABLE IF EXISTS `tb_retur_penjualan`;
CREATE TABLE IF NOT EXISTS `tb_retur_penjualan` (
  `ID_RETUR_PENJUALAN` int(11) NOT NULL AUTO_INCREMENT,
  `CB_ID` int(11) DEFAULT NULL,
  `ID_SJ` int(11) DEFAULT NULL,
  `NOMOR_RETUR_PENJUALAN` int(11) DEFAULT NULL,
  `STATUS_PENGEMBALIAN_BARANG` varchar(100) DEFAULT NULL,
  `TGL_RETUR_PENJUALAN` date DEFAULT NULL,
  `AKSI_BAYAR_PENJUALAN` varchar(100) DEFAULT NULL,
  `ALASAN_RETUR_PENJUALAN` text,
  PRIMARY KEY (`ID_RETUR_PENJUALAN`),
  KEY `Relasi 22` (`CB_ID`),
  KEY `Relasi 23` (`ID_SJ`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_satuan`
--

DROP TABLE IF EXISTS `tb_satuan`;
CREATE TABLE IF NOT EXISTS `tb_satuan` (
  `ID_SATUAN` int(11) NOT NULL AUTO_INCREMENT,
  `NAMA_SATUAN` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ID_SATUAN`)
) ENGINE=InnoDB AUTO_INCREMENT=1027 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_satuan`
--

INSERT INTO `tb_satuan` (`ID_SATUAN`, `NAMA_SATUAN`) VALUES
(1010, 'Liter'),
(1011, 'DUS'),
(1012, 'Biji'),
(1013, 'Sachet'),
(1014, 'Box'),
(1015, 'Unit'),
(1016, 'Lusin'),
(1017, 'Kodi'),
(1018, 'Botol'),
(1019, 'Dus'),
(1020, 'Koli'),
(1021, 'Karung'),
(1022, 'Sak'),
(1023, 'Bal'),
(1024, 'Kaleng'),
(1025, 'Slop'),
(1026, 'Bungkus');

-- --------------------------------------------------------

--
-- Table structure for table `tb_stok`
--

DROP TABLE IF EXISTS `tb_stok`;
CREATE TABLE IF NOT EXISTS `tb_stok` (
  `ID_STOK` int(11) NOT NULL AUTO_INCREMENT,
  `NO_SERI` varchar(15) DEFAULT NULL,
  `ID_GDG` int(11) DEFAULT NULL,
  `ID_BRG` int(11) DEFAULT NULL,
  `JUMLAH` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_STOK`),
  KEY `Relasi 24` (`ID_BRG`),
  KEY `Relasi 25` (`ID_GDG`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_stok`
--

INSERT INTO `tb_stok` (`ID_STOK`, `NO_SERI`, `ID_GDG`, `ID_BRG`, `JUMLAH`) VALUES
(4, 'ST524052019002', 1, 1, 12);

-- --------------------------------------------------------

--
-- Table structure for table `tb_surat_jalan`
--

DROP TABLE IF EXISTS `tb_surat_jalan`;
CREATE TABLE IF NOT EXISTS `tb_surat_jalan` (
  `ID_SJ` int(11) NOT NULL AUTO_INCREMENT,
  `CB_ID` int(11) DEFAULT NULL,
  `ID_ORDER` int(11) DEFAULT NULL,
  `NOMOR_SJ` int(11) DEFAULT NULL,
  `JENIS_SJ` varchar(100) DEFAULT NULL,
  `TGL_SJ` date DEFAULT NULL,
  `TGL_KIRIM_SJ` date DEFAULT NULL,
  `EKSPEDISI_SJ` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ID_SJ`),
  KEY `Relasi 26` (`CB_ID`),
  KEY `Relasi 27` (`ID_ORDER`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
