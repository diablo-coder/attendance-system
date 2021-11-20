-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 18, 2021 at 10:10 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `attendancesystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `idGuru` varchar(10) NOT NULL COMMENT 'guru yang berdaftar dan nombor unik',
  `nama` varchar(50) NOT NULL COMMENT 'nama bagi setiap guru',
  `alamat` varchar(50) NOT NULL DEFAULT 'Belum dinyatakan' COMMENT 'alamat rumah',
  `notelefon` varchar(15) DEFAULT NULL COMMENT 'nombor telefon guru',
  `user_type` varchar(10) NOT NULL,
  `idKelas` varchar(10) NOT NULL COMMENT 'kelas yang didaftar',
  `password` varchar(50) NOT NULL COMMENT 'kata laluan '
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`idGuru`, `nama`, `alamat`, `notelefon`, `user_type`, `idKelas`, `password`) VALUES
('GG002', 'Niesha', 'Mantin', '098756432', 'user', '2', '202cb962ac59075b964b07152d234b70'),
('GG003', 'Farizul Azwan', '80. Kampung Parit Baru, Mukim 8, Parit Raja, 86400', '+60137489073', 'user', '5', '202cb962ac59075b964b07152d234b70'),
('GG005', 'Haji Ahmad Ali', '80. Kampung Parit Baru, Mukim 8, Parit Raja, 86400', '+60137489073', 'user', '4', '202cb962ac59075b964b07152d234b70'),
('GG009', 'Syahid Hani', 'Kampung Parit Raja', '0147852369', 'user', '1', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Table structure for table `kehadiran`
--

CREATE TABLE `kehadiran` (
  `idKehadiran` int(10) NOT NULL COMMENT 'Nombor yang unik',
  `Status` varchar(10) NOT NULL COMMENT 'Pelajar hadir atau tidak hadir',
  `Sebab` varchar(100) NOT NULL,
  `Tarikh` date NOT NULL COMMENT 'Tarikh pelajar tidak hadir',
  `idPelajar` varchar(10) NOT NULL COMMENT 'Pelajar yang berdaftar',
  `idKelas` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kehadiran`
--

INSERT INTO `kehadiran` (`idKehadiran`, `Status`, `Sebab`, `Tarikh`, `idPelajar`, `idKelas`) VALUES
(480, 'Absent', 'Medical Certificate', '2021-11-01', 'AA21', '5'),
(486, 'Present', '', '2021-11-09', 'AA21', '5'),
(488, 'Absent', 'Representating School', '2021-11-22', 'AA21', '5'),
(489, 'Present', '', '2021-12-20', 'AA21', '5'),
(526, 'Present', 'Representating School', '2021-11-15', 'AA002', '1'),
(527, 'Present', 'Medical Certificate', '2021-11-15', 'AA003', '1'),
(528, 'Present', 'Medical Certificate', '2021-11-15', 'AA004', '1'),
(529, 'Present', '', '2021-11-15', 'AA005', '1'),
(530, 'Present', '', '2021-11-15', 'AA008', '1'),
(531, 'Present', '', '2021-11-15', 'AA916', '1'),
(532, 'Present', '', '2021-11-10', 'AA002', '1'),
(533, 'Present', '', '2021-11-10', 'AA003', '1'),
(534, 'Present', '', '2021-11-10', 'AA004', '1'),
(536, 'Present', '', '2021-11-10', 'AA008', '1'),
(537, 'Present', '', '2021-11-10', 'AA916', '1'),
(538, 'Absent', 'Medical Certificate', '2021-11-19', 'AA002', '1'),
(539, 'Absent', 'Medical Certificate', '2021-11-19', 'AA003', '1'),
(540, 'Present', '', '2021-11-19', 'AA004', '1'),
(541, 'Present', '', '2021-11-19', 'AA005', '1'),
(542, 'Present', '', '2021-11-19', 'AA008', '1'),
(543, 'Present', '', '2021-11-19', 'AA916', '1'),
(544, 'Present', '', '2021-11-16', 'AA002', '1'),
(545, 'Present', '', '2021-11-16', 'AA003', '1'),
(546, 'Absent', 'Medical Certificate', '2021-11-16', 'AA004', '1'),
(547, 'Absent', 'Medical Certificate', '2021-11-16', 'AA005', '1'),
(548, 'Present', '', '2021-11-16', 'AA008', '1'),
(549, 'Present', '', '2021-11-16', 'AA916', '1');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `idKelas` varchar(10) NOT NULL COMMENT 'kelas yang berdaftar',
  `namaKelas` varchar(10) NOT NULL COMMENT 'nama kelas'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`idKelas`, `namaKelas`) VALUES
('1', 'UTHM'),
('2', 'UTM'),
('3', 'UITM'),
('4', 'UPNM'),
('5', 'UIA');

-- --------------------------------------------------------

--
-- Table structure for table `multi_login`
--

CREATE TABLE `multi_login` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `user_type` varchar(10) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `multi_login`
--

INSERT INTO `multi_login` (`id`, `username`, `email`, `user_type`, `password`) VALUES
(15, 'halim123', 'xyz@gmail.com', 'admin', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Table structure for table `pelajar`
--

CREATE TABLE `pelajar` (
  `idPelajar` varchar(10) NOT NULL COMMENT 'pelajar yang berdaftar',
  `nama` varchar(50) NOT NULL COMMENT 'nama bagi setiap pelajar',
  `alamat` varchar(50) NOT NULL DEFAULT 'Belum dinyatakan' COMMENT 'alamat rumah pelajar',
  `notelefon` varchar(15) NOT NULL COMMENT 'nombor telefon pelajar',
  `idKelas` varchar(10) NOT NULL COMMENT 'kelas yang berdaftar'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelajar`
--

INSERT INTO `pelajar` (`idPelajar`, `nama`, `alamat`, `notelefon`, `idKelas`) VALUES
('AA002', 'Jihan Kulim', 'Pontian Johor', '0123456789', '1'),
('AA003', 'Loki Jaya', 'Kulim Kedah', '0123456789', '1'),
('AA004', 'Munir Lauk', 'Belum dinyatakan', '0123456789', '1'),
('AA005', 'Hujan Ayus', 'Belum dinyatakan', '0132654789', '1'),
('AA006', 'Juki Laus', 'Australia, Utara Sime Darby', '0123456789', '2'),
('AA007', 'Laila Majnun', 'Tampok, Senggarang, Johor', '0123456789', '2'),
('AA008', 'Masni Akasia', 'Melaka, Darul Aman', '0123456789', '1'),
('AA009', 'James Bond', 'Australia Melaka', '0123456789', '3'),
('AA010', 'Luis Vilton', 'Belum dinyatakan', '0132654789', '2'),
('AA21', 'Azhari Zaidie', 'Batu Pahat Malaysia', '0123456789', '5'),
('AA916', 'Amir Aniq', 'No99,Jalan Longkang ,Taman Loji,55555,Melbourne,Au', '991', '1'),
('AA923', 'Niesha', 'mantin', '012395825', '4');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`idGuru`),
  ADD KEY `idKelas` (`idKelas`);

--
-- Indexes for table `kehadiran`
--
ALTER TABLE `kehadiran`
  ADD PRIMARY KEY (`idKehadiran`),
  ADD KEY `idPelajar` (`idPelajar`),
  ADD KEY `kehadiran_ibfk_1` (`idKelas`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`idKelas`);

--
-- Indexes for table `multi_login`
--
ALTER TABLE `multi_login`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `pelajar`
--
ALTER TABLE `pelajar`
  ADD PRIMARY KEY (`idPelajar`),
  ADD KEY `idKelas` (`idKelas`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kehadiran`
--
ALTER TABLE `kehadiran`
  MODIFY `idKehadiran` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Nombor yang unik', AUTO_INCREMENT=550;

--
-- AUTO_INCREMENT for table `multi_login`
--
ALTER TABLE `multi_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `guru`
--
ALTER TABLE `guru`
  ADD CONSTRAINT `kelas_ibfk_1` FOREIGN KEY (`idKelas`) REFERENCES `kelas` (`idKelas`);

--
-- Constraints for table `kehadiran`
--
ALTER TABLE `kehadiran`
  ADD CONSTRAINT `kehadiran_ibfk_1` FOREIGN KEY (`idKelas`) REFERENCES `kelas` (`idKelas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kehadiran_ibfk_2` FOREIGN KEY (`idPelajar`) REFERENCES `pelajar` (`idPelajar`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pelajar`
--
ALTER TABLE `pelajar`
  ADD CONSTRAINT `pelajar_ibfk_1` FOREIGN KEY (`idKelas`) REFERENCES `kelas` (`idKelas`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
