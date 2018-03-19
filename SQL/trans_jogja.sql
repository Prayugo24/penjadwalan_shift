-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 08, 2018 at 05:29 PM
-- Server version: 5.5.32
-- PHP Version: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `trans_jogja`
--
CREATE DATABASE IF NOT EXISTS `trans_jogja` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `trans_jogja`;

-- --------------------------------------------------------

--
-- Table structure for table `super_user`
--

CREATE TABLE IF NOT EXISTS `super_user` (
  `nama` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `blokir` enum('Y','N') NOT NULL,
  `super_id` varchar(50) NOT NULL,
  `level` varchar(50) NOT NULL,
  PRIMARY KEY (`super_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `super_user`
--

INSERT INTO `super_user` (`nama`, `username`, `password`, `blokir`, `super_id`, `level`) VALUES
('sann', 'admin', 'admin', 'N', 'SU_001', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `tb_bulan`
--

CREATE TABLE IF NOT EXISTS `tb_bulan` (
  `kd_bulan` varchar(50) NOT NULL,
  `bulan` varchar(50) NOT NULL,
  PRIMARY KEY (`kd_bulan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_bulan`
--

INSERT INTO `tb_bulan` (`kd_bulan`, `bulan`) VALUES
('Bln_01', 'Januari'),
('Bln_02', 'Februari'),
('Bln_03', 'Maret'),
('Bln_04', 'April'),
('Bln_05', 'Mei'),
('Bln_06', 'Juni'),
('Bln_07', 'Juli'),
('Bln_08', 'Agustus'),
('Bln_09', 'September'),
('Bln_10', 'Oktober'),
('Bln_11', 'November'),
('Bln_12', 'Desember');

-- --------------------------------------------------------

--
-- Table structure for table `tb_hari`
--

CREATE TABLE IF NOT EXISTS `tb_hari` (
  `kd_hari` varchar(10) NOT NULL,
  `hari` varchar(10) NOT NULL,
  PRIMARY KEY (`kd_hari`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_hari`
--

INSERT INTO `tb_hari` (`kd_hari`, `hari`) VALUES
('H01', 'Senin'),
('H02', 'Selasa'),
('H03', 'Rabu'),
('H04', 'Kamis'),
('H05', 'Jumat'),
('H06', 'Sabtu'),
('H07', 'Minggu');

-- --------------------------------------------------------

--
-- Table structure for table `tb_karyawan`
--

CREATE TABLE IF NOT EXISTS `tb_karyawan` (
  `kd_kar` varchar(50) NOT NULL,
  `nam_kar` varchar(70) NOT NULL,
  `jns_kel` varchar(10) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`kd_kar`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_karyawan`
--

INSERT INTO `tb_karyawan` (`kd_kar`, `nam_kar`, `jns_kel`, `no_hp`, `status`) VALUES
('KD_KAR-0001', 'suhaibfaa', 'Laki-Laki', '0988', 'Actif'),
('KD_KAR-0002', 'sasuke', 'Laki-Laki', '085', 'Aktif'),
('KD_KAR-0003', 'aa', 'Laki-Laki', '111', 'Active'),
('KD_KAR-0004', 'sukim', 'Laki-Laki', '05', 'Actif'),
('KD_KAR-0005', 'santi', 'Laki-Laki', '09877', 'Actif'),
('KD_KAR-0006', 'aaa', 'Laki-Laki', '8888', 'Actif'),
('KD_KAR-0007', 'asasas', 'Laki-Laki', '4656456', 'Actif'),
('KD_KAR-0008', 'f4', 'Laki-Laki', '65', 'Actif');

-- --------------------------------------------------------

--
-- Table structure for table `tb_tahun`
--

CREATE TABLE IF NOT EXISTS `tb_tahun` (
  `kd_tahun` varchar(50) NOT NULL,
  `tahun` int(11) NOT NULL,
  PRIMARY KEY (`kd_tahun`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_tahun`
--

INSERT INTO `tb_tahun` (`kd_tahun`, `tahun`) VALUES
('Kd_Th_01', 2017),
('Kd_Th_02', 2018);

-- --------------------------------------------------------

--
-- Table structure for table `tb_tanggal`
--

CREATE TABLE IF NOT EXISTS `tb_tanggal` (
  `kd_tgl` varchar(50) NOT NULL,
  `tgl` int(2) NOT NULL,
  PRIMARY KEY (`kd_tgl`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_tanggal`
--

INSERT INTO `tb_tanggal` (`kd_tgl`, `tgl`) VALUES
('kd-Tl-01', 12),
('kd-Tl-02', 13),
('kd-Tl-03', 26),
('kd-Tl-04', 27),
('kd-Tl-05', 28),
('kd-Tl-06', 29);

-- --------------------------------------------------------

--
-- Table structure for table `tb_waktu`
--

CREATE TABLE IF NOT EXISTS `tb_waktu` (
  `kd_waktu` varchar(10) NOT NULL,
  `tb_waktu` varchar(10) NOT NULL,
  PRIMARY KEY (`kd_waktu`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_waktu`
--

INSERT INTO `tb_waktu` (`kd_waktu`, `tb_waktu`) VALUES
('W01', 'Pagi'),
('W02', 'Siang'),
('W03', 'Lembur'),
('W04', 'Libur');

-- --------------------------------------------------------

--
-- Table structure for table `tb_waktuu`
--

CREATE TABLE IF NOT EXISTS `tb_waktuu` (
  `kd_waktu` varchar(50) NOT NULL,
  `tanggal` int(11) NOT NULL,
  `bulan` varchar(50) NOT NULL,
  `tahun` int(11) NOT NULL,
  `kd_jdwl` varchar(50) NOT NULL,
  PRIMARY KEY (`kd_waktu`),
  KEY `kd_jdwl` (`kd_jdwl`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_waktuu`
--

INSERT INTO `tb_waktuu` (`kd_waktu`, `tanggal`, `bulan`, `tahun`, `kd_jdwl`) VALUES
('WT-01', 1, 'januari', 2018, 'kdj_02'),
('WT-02', 2, 'januari', 2018, 'kdj_08'),
('WT-03', 29, 'Desember', 2017, 'kdj_01'),
('WT-04', 8, 'januari', 2018, 'kdj_01');

-- --------------------------------------------------------

--
-- Table structure for table `tv_jadwal`
--

CREATE TABLE IF NOT EXISTS `tv_jadwal` (
  `kd_jdwl` varchar(11) NOT NULL,
  `kd_kar` varchar(50) NOT NULL,
  `jadwal` varchar(50) NOT NULL,
  `kd_waktu` varchar(50) NOT NULL,
  PRIMARY KEY (`kd_jdwl`),
  KEY `kd_waktu` (`jadwal`),
  KEY `kd_karyawan` (`kd_kar`),
  KEY `kd_waktu_2` (`kd_waktu`),
  KEY `kd_waktu_3` (`kd_waktu`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tv_jadwal`
--

INSERT INTO `tv_jadwal` (`kd_jdwl`, `kd_kar`, `jadwal`, `kd_waktu`) VALUES
('kdj_01', 'KD_KAR-0001', 'pagi', 'WT-03'),
('kdj_02', 'KD_KAR-0003', 'Siang', 'WT-01'),
('kdj_08', 'KD_KAR-0001', 'Lembur', 'WT-02'),
('kdj_10', 'KD_KAR-0003', 'Lembur', 'WT-02');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tv_jadwal`
--
ALTER TABLE `tv_jadwal`
  ADD CONSTRAINT `tv_jadwal_ibfk_5` FOREIGN KEY (`kd_kar`) REFERENCES `tb_karyawan` (`kd_kar`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tv_jadwal_ibfk_6` FOREIGN KEY (`kd_waktu`) REFERENCES `tb_waktuu` (`kd_waktu`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
