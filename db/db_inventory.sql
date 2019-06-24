-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2019 at 02:11 PM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

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

CREATE TABLE `tb_admin` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` enum('admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`id`, `username`, `password`, `level`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `tb_barang`
--

CREATE TABLE `tb_barang` (
  `ID_BRG` int(11) NOT NULL,
  `ID_BRAND` int(11) DEFAULT NULL,
  `ID_SATUAN` int(11) DEFAULT NULL,
  `ID_CATEGORY` int(11) DEFAULT NULL,
  `ID_JNS_BRG` int(11) DEFAULT NULL,
  `NOMOR_BRG` int(11) DEFAULT NULL,
  `NAMA_BRG` varchar(100) DEFAULT NULL,
  `HARGA_BELI` float DEFAULT NULL,
  `HARGA_JUAL` float DEFAULT NULL,
  `STOK` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_brand`
--

CREATE TABLE `tb_brand` (
  `ID_BRAND` int(11) NOT NULL,
  `NAMA_BRAND` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_brand`
--

INSERT INTO `tb_brand` (`ID_BRAND`, `NAMA_BRAND`) VALUES
(101, 'Bimoli'),
(102, 'Indofood');

-- --------------------------------------------------------

--
-- Table structure for table `tb_cabang`
--

CREATE TABLE `tb_cabang` (
  `CB_ID` int(11) NOT NULL,
  `CB_NAMA` varchar(100) DEFAULT NULL,
  `CB_ALAMAT` text,
  `CB_TELP` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_cabang`
--

INSERT INTO `tb_cabang` (`CB_ID`, `CB_NAMA`, `CB_ALAMAT`, `CB_TELP`) VALUES
(1, 'A', 'M', 8288282);

-- --------------------------------------------------------

--
-- Table structure for table `tb_category`
--

CREATE TABLE `tb_category` (
  `ID_CATEGORY` int(11) NOT NULL,
  `NAMA_CATEGORY` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_category`
--

INSERT INTO `tb_category` (`ID_CATEGORY`, `NAMA_CATEGORY`) VALUES
(10101, 'Bahan Makanan'),
(10102, 'Makanan Ringan');

-- --------------------------------------------------------

--
-- Table structure for table `tb_faktur`
--

CREATE TABLE `tb_faktur` (
  `ID_FAKTUR` int(11) NOT NULL,
  `CB_ID` int(11) DEFAULT NULL,
  `ID_SJ` int(11) DEFAULT NULL,
  `NOMOR_FAKTUR` int(11) DEFAULT NULL,
  `TGL_FAKTUR` date DEFAULT NULL,
  `JATUH_TEMPO_FAKTOR` date DEFAULT NULL,
  `SUBTOTAL_FAKTUR` float DEFAULT NULL,
  `POTONGAN_FAKTUR` float DEFAULT NULL,
  `UANGMUKA_FAKTUR` float DEFAULT NULL,
  `TOTAL_FAKTUR` float DEFAULT NULL,
  `TUJUAN_TRANSFER_FAKTUR` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_gudang`
--

CREATE TABLE `tb_gudang` (
  `ID_GDG` int(11) NOT NULL,
  `CB_ID` int(11) DEFAULT NULL,
  `ID_JNS_GDG` int(11) DEFAULT NULL,
  `NAMA_GDG` varchar(100) DEFAULT NULL,
  `ALAMAT_GDG` text,
  `KOTA_GDG` varchar(100) DEFAULT NULL,
  `TELP_GDG` int(11) DEFAULT NULL,
  `FAX_GDG` varchar(100) DEFAULT NULL,
  `EMAIL_GDG` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_gudang`
--

INSERT INTO `tb_gudang` (`ID_GDG`, `CB_ID`, `ID_JNS_GDG`, `NAMA_GDG`, `ALAMAT_GDG`, `KOTA_GDG`, `TELP_GDG`, `FAX_GDG`, `EMAIL_GDG`) VALUES
(1, 1, 1, 'ABRI', 'Malang', 'Malang', 20809819, '982828', 'tes@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `tb_harga`
--

CREATE TABLE `tb_harga` (
  `ID_HARGA` int(11) NOT NULL,
  `ID_BRG` int(11) DEFAULT NULL,
  `CB_ID` int(11) DEFAULT NULL,
  `HARGAJUAL` float DEFAULT NULL,
  `HARGABELI` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_jns_brg`
--

CREATE TABLE `tb_jns_brg` (
  `ID_JNS_BRG` int(11) NOT NULL,
  `NAMA_JNS_BRG` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `tb_jns_gdg` (
  `ID_JNS_GDG` int(11) NOT NULL,
  `NAMA_JNS_GDG` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_jns_gdg`
--

INSERT INTO `tb_jns_gdg` (`ID_JNS_GDG`, `NAMA_JNS_GDG`) VALUES
(1, 'Al');

-- --------------------------------------------------------

--
-- Table structure for table `tb_order`
--

CREATE TABLE `tb_order` (
  `ID_ORDER` int(11) NOT NULL,
  `CB_ID` int(11) DEFAULT NULL,
  `NOMOR_ORDER` int(11) DEFAULT NULL,
  `TGL_ORDER` date DEFAULT NULL,
  `TYPE_ORDER` varchar(100) DEFAULT NULL,
  `NAMA_DIKIRIM_ORDER` varchar(100) DEFAULT NULL,
  `ALAMAT_ORDER` text,
  `HP_FAX_ORDER` int(11) DEFAULT NULL,
  `SUBTOTAL_ORDER` float DEFAULT NULL,
  `PPN_ORDER` float DEFAULT NULL,
  `TOTAL_ORDER` float DEFAULT NULL,
  `TGL_KIRIM_ORDER` date DEFAULT NULL,
  `TUNAI_ORDER` varchar(100) DEFAULT NULL,
  `DP_ORDER` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_penawaran`
--

CREATE TABLE `tb_penawaran` (
  `ID_PENAWARAN` int(11) NOT NULL,
  `ID_PERM_PEMBELIAN` int(11) DEFAULT NULL,
  `CB_ID` int(11) DEFAULT NULL,
  `NOMOR_PENAWARAN` int(11) DEFAULT NULL,
  `JENIS_PENAWARAN` varchar(100) DEFAULT NULL,
  `TGL_PENAWARAN` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_penerimaan_barang`
--

CREATE TABLE `tb_penerimaan_barang` (
  `ID_PENERIMAAN_BRG` int(11) NOT NULL,
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
  `CATATAN` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_permintaan_pembelian`
--

CREATE TABLE `tb_permintaan_pembelian` (
  `ID_PERM_PEMBELIAN` int(11) NOT NULL,
  `CB_ID` int(11) DEFAULT NULL,
  `PP_NOMOR` varchar(15) DEFAULT NULL,
  `PP_TGL` date DEFAULT NULL,
  `PP_TGL_BUTUH` date DEFAULT NULL,
  `PP_JENIS` varchar(100) DEFAULT NULL,
  `ID_GDG` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_permintaan_pembelian`
--

INSERT INTO `tb_permintaan_pembelian` (`ID_PERM_PEMBELIAN`, `CB_ID`, `PP_NOMOR`, `PP_TGL`, `PP_TGL_BUTUH`, `PP_JENIS`, `ID_GDG`) VALUES
(6, 1, '231', '2019-05-01', '2019-05-02', 'Barang', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_retur_pembelian`
--

CREATE TABLE `tb_retur_pembelian` (
  `ID_RETUR_PEMBELIAN` int(11) NOT NULL,
  `ID_PENERIMAAN_BRG` int(11) DEFAULT NULL,
  `CB_ID` int(11) DEFAULT NULL,
  `NOMOR_RETUR_PEMBELIAN` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_retur_penjualan`
--

CREATE TABLE `tb_retur_penjualan` (
  `ID_RETUR_PENJUALAN` int(11) NOT NULL,
  `CB_ID` int(11) DEFAULT NULL,
  `ID_SJ` int(11) DEFAULT NULL,
  `NOMOR_RETUR_PENJUALAN` int(11) DEFAULT NULL,
  `STATUS_PENGEMBALIAN_BARANG` varchar(100) DEFAULT NULL,
  `TGL_RETUR_PENJUALAN` date DEFAULT NULL,
  `AKSI_BAYAR_PENJUALAN` varchar(100) DEFAULT NULL,
  `ALASAN_RETUR_PENJUALAN` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_satuan`
--

CREATE TABLE `tb_satuan` (
  `ID_SATUAN` int(11) NOT NULL,
  `NAMA_SATUAN` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_satuan`
--

INSERT INTO `tb_satuan` (`ID_SATUAN`, `NAMA_SATUAN`) VALUES
(1010, 'Liter'),
(1011, 'DUS');

-- --------------------------------------------------------

--
-- Table structure for table `tb_stok`
--

CREATE TABLE `tb_stok` (
  `ID_STOK` int(11) NOT NULL,
  `ID_GDG` int(11) DEFAULT NULL,
  `ID_BRG` int(11) DEFAULT NULL,
  `NO_SERI` int(11) DEFAULT NULL,
  `JUMLAH` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_surat_jalan`
--

CREATE TABLE `tb_surat_jalan` (
  `ID_SJ` int(11) NOT NULL,
  `CB_ID` int(11) DEFAULT NULL,
  `ID_ORDER` int(11) DEFAULT NULL,
  `NOMOR_SJ` int(11) DEFAULT NULL,
  `JENIS_SJ` varchar(100) DEFAULT NULL,
  `TGL_SJ` date DEFAULT NULL,
  `TGL_KIRIM_SJ` date DEFAULT NULL,
  `EKSPEDISI_SJ` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_barang`
--
ALTER TABLE `tb_barang`
  ADD PRIMARY KEY (`ID_BRG`),
  ADD KEY `Relasi 1` (`ID_BRAND`),
  ADD KEY `Relasi 3` (`ID_CATEGORY`),
  ADD KEY `Relasi 4` (`ID_JNS_BRG`),
  ADD KEY `Relasi 5` (`ID_SATUAN`);

--
-- Indexes for table `tb_brand`
--
ALTER TABLE `tb_brand`
  ADD PRIMARY KEY (`ID_BRAND`);

--
-- Indexes for table `tb_cabang`
--
ALTER TABLE `tb_cabang`
  ADD PRIMARY KEY (`CB_ID`);

--
-- Indexes for table `tb_category`
--
ALTER TABLE `tb_category`
  ADD PRIMARY KEY (`ID_CATEGORY`);

--
-- Indexes for table `tb_faktur`
--
ALTER TABLE `tb_faktur`
  ADD PRIMARY KEY (`ID_FAKTUR`),
  ADD KEY `Relasi 6` (`CB_ID`),
  ADD KEY `Relasi 7` (`ID_SJ`);

--
-- Indexes for table `tb_gudang`
--
ALTER TABLE `tb_gudang`
  ADD PRIMARY KEY (`ID_GDG`),
  ADD KEY `Relasi 8` (`CB_ID`),
  ADD KEY `Relasi 9` (`ID_JNS_GDG`);

--
-- Indexes for table `tb_harga`
--
ALTER TABLE `tb_harga`
  ADD PRIMARY KEY (`ID_HARGA`),
  ADD KEY `Relasi 10` (`CB_ID`),
  ADD KEY `Relasi 11` (`ID_BRG`);

--
-- Indexes for table `tb_jns_brg`
--
ALTER TABLE `tb_jns_brg`
  ADD PRIMARY KEY (`ID_JNS_BRG`);

--
-- Indexes for table `tb_jns_gdg`
--
ALTER TABLE `tb_jns_gdg`
  ADD PRIMARY KEY (`ID_JNS_GDG`);

--
-- Indexes for table `tb_order`
--
ALTER TABLE `tb_order`
  ADD PRIMARY KEY (`ID_ORDER`),
  ADD KEY `Relasi 12` (`CB_ID`);

--
-- Indexes for table `tb_penawaran`
--
ALTER TABLE `tb_penawaran`
  ADD PRIMARY KEY (`ID_PENAWARAN`),
  ADD KEY `Relasi 13` (`CB_ID`),
  ADD KEY `Relasi 14` (`ID_PERM_PEMBELIAN`);

--
-- Indexes for table `tb_penerimaan_barang`
--
ALTER TABLE `tb_penerimaan_barang`
  ADD PRIMARY KEY (`ID_PENERIMAAN_BRG`),
  ADD KEY `Relasi 15` (`CB_ID`),
  ADD KEY `Relasi 16` (`ID_GDG`),
  ADD KEY `Relasi 17` (`ID_ORDER`);

--
-- Indexes for table `tb_permintaan_pembelian`
--
ALTER TABLE `tb_permintaan_pembelian`
  ADD PRIMARY KEY (`ID_PERM_PEMBELIAN`),
  ADD KEY `Relasi 18` (`CB_ID`),
  ADD KEY `Relasi 19` (`ID_GDG`);

--
-- Indexes for table `tb_retur_pembelian`
--
ALTER TABLE `tb_retur_pembelian`
  ADD PRIMARY KEY (`ID_RETUR_PEMBELIAN`),
  ADD KEY `Relasi 20` (`CB_ID`),
  ADD KEY `Relasi 21` (`ID_PENERIMAAN_BRG`);

--
-- Indexes for table `tb_retur_penjualan`
--
ALTER TABLE `tb_retur_penjualan`
  ADD PRIMARY KEY (`ID_RETUR_PENJUALAN`),
  ADD KEY `Relasi 22` (`CB_ID`),
  ADD KEY `Relasi 23` (`ID_SJ`);

--
-- Indexes for table `tb_satuan`
--
ALTER TABLE `tb_satuan`
  ADD PRIMARY KEY (`ID_SATUAN`);

--
-- Indexes for table `tb_stok`
--
ALTER TABLE `tb_stok`
  ADD PRIMARY KEY (`ID_STOK`),
  ADD KEY `Relasi 24` (`ID_BRG`),
  ADD KEY `Relasi 25` (`ID_GDG`);

--
-- Indexes for table `tb_surat_jalan`
--
ALTER TABLE `tb_surat_jalan`
  ADD PRIMARY KEY (`ID_SJ`),
  ADD KEY `Relasi 26` (`CB_ID`),
  ADD KEY `Relasi 27` (`ID_ORDER`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_barang`
--
ALTER TABLE `tb_barang`
  MODIFY `ID_BRG` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_brand`
--
ALTER TABLE `tb_brand`
  MODIFY `ID_BRAND` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `tb_cabang`
--
ALTER TABLE `tb_cabang`
  MODIFY `CB_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_category`
--
ALTER TABLE `tb_category`
  MODIFY `ID_CATEGORY` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10103;

--
-- AUTO_INCREMENT for table `tb_faktur`
--
ALTER TABLE `tb_faktur`
  MODIFY `ID_FAKTUR` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_gudang`
--
ALTER TABLE `tb_gudang`
  MODIFY `ID_GDG` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_harga`
--
ALTER TABLE `tb_harga`
  MODIFY `ID_HARGA` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_jns_brg`
--
ALTER TABLE `tb_jns_brg`
  MODIFY `ID_JNS_BRG` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101013;

--
-- AUTO_INCREMENT for table `tb_jns_gdg`
--
ALTER TABLE `tb_jns_gdg`
  MODIFY `ID_JNS_GDG` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_order`
--
ALTER TABLE `tb_order`
  MODIFY `ID_ORDER` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_penawaran`
--
ALTER TABLE `tb_penawaran`
  MODIFY `ID_PENAWARAN` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_penerimaan_barang`
--
ALTER TABLE `tb_penerimaan_barang`
  MODIFY `ID_PENERIMAAN_BRG` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_permintaan_pembelian`
--
ALTER TABLE `tb_permintaan_pembelian`
  MODIFY `ID_PERM_PEMBELIAN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_retur_pembelian`
--
ALTER TABLE `tb_retur_pembelian`
  MODIFY `ID_RETUR_PEMBELIAN` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_retur_penjualan`
--
ALTER TABLE `tb_retur_penjualan`
  MODIFY `ID_RETUR_PENJUALAN` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_satuan`
--
ALTER TABLE `tb_satuan`
  MODIFY `ID_SATUAN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1012;

--
-- AUTO_INCREMENT for table `tb_stok`
--
ALTER TABLE `tb_stok`
  MODIFY `ID_STOK` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_surat_jalan`
--
ALTER TABLE `tb_surat_jalan`
  MODIFY `ID_SJ` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

