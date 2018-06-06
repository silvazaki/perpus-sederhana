-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2018 at 12:17 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 5.6.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crud`
--

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `kode_buku` varchar(5) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `pengarang` varchar(50) NOT NULL,
  `penerbit` varchar(50) NOT NULL,
  `id_kategori` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`kode_buku`, `judul`, `pengarang`, `penerbit`, `id_kategori`) VALUES
('A1', 'Laskar Pelangi', 'Andrea Hirata', 'Surya Callipso', '1617357401'),
('A2', 'Tenggelamnya Kapal Van Der Wijck', 'Emha', 'Sony Corp', '1617357401'),
('A3', 'Si Kancil', 'W.R. Supratman', 'UIN Press', '1617357401');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` char(10) NOT NULL,
  `kategori` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `kategori`) VALUES
('1617357401', 'Fiksi'),
('4483687019', 'Non Fiksi');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `nim` char(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jk` varchar(30) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `kota` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`nim`, `nama`, `jk`, `alamat`, `kota`, `email`) VALUES
('1', 'silva', 'laki-laki', 'jl.klayatan', 'malang', 'silva@yahoo.com'),
('2', 'ahmad', 'perempuan', 'jl. baiduri bulan', 'malang', 'zzz');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_transaksi` int(11) NOT NULL,
  `nim` char(10) NOT NULL,
  `kode_buku` varchar(5) NOT NULL,
  `tanggal_pinjam` varchar(25) NOT NULL,
  `tanggal_kembali` varchar(30) NOT NULL,
  `status` varchar(20) NOT NULL,
  `operator` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id_transaksi`, `nim`, `kode_buku`, `tanggal_pinjam`, `tanggal_kembali`, `status`, `operator`) VALUES
(1, '1', 'A1', '11-12-17', '11-12-17', 'sudah kembali', 'admin'),
(2, '2', 'A2', '11-12-17', '11-12-17', 'sudah kembali', 'ken');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `password`, `nama`) VALUES
('admin', 'admin', 'silva'),
('ken', '123', 'kenarok');

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_buku`
-- (See below for the actual view)
--
CREATE TABLE `v_buku` (
`kode_buku` varchar(5)
,`judul` varchar(100)
,`pengarang` varchar(50)
,`penerbit` varchar(50)
,`id_kategori` char(10)
,`kategori` varchar(30)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_peminjaman`
-- (See below for the actual view)
--
CREATE TABLE `v_peminjaman` (
`id_transaksi` int(11)
,`nim` char(10)
,`nama` varchar(100)
,`kode_buku` varchar(5)
,`judul` varchar(100)
,`tanggal_pinjam` varchar(25)
,`tanggal_kembali` varchar(30)
,`status` varchar(20)
,`operator` varchar(50)
,`petugas` varchar(100)
);

-- --------------------------------------------------------

--
-- Structure for view `v_buku`
--
DROP TABLE IF EXISTS `v_buku`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_buku`  AS  select `a`.`kode_buku` AS `kode_buku`,`a`.`judul` AS `judul`,`a`.`pengarang` AS `pengarang`,`a`.`penerbit` AS `penerbit`,`a`.`id_kategori` AS `id_kategori`,`b`.`kategori` AS `kategori` from (`buku` `a` join `kategori` `b`) where (`a`.`id_kategori` = `b`.`id_kategori`) order by `a`.`kode_buku` ;

-- --------------------------------------------------------

--
-- Structure for view `v_peminjaman`
--
DROP TABLE IF EXISTS `v_peminjaman`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_peminjaman`  AS  select `a`.`id_transaksi` AS `id_transaksi`,`a`.`nim` AS `nim`,`b`.`nama` AS `nama`,`a`.`kode_buku` AS `kode_buku`,`c`.`judul` AS `judul`,`a`.`tanggal_pinjam` AS `tanggal_pinjam`,`a`.`tanggal_kembali` AS `tanggal_kembali`,`a`.`status` AS `status`,`a`.`operator` AS `operator`,`d`.`nama` AS `petugas` from (((`peminjaman` `a` join `mahasiswa` `b`) join `buku` `c`) join `user` `d`) where ((`a`.`nim` = `b`.`nim`) and (`a`.`kode_buku` = `c`.`kode_buku`) and (`a`.`operator` = `d`.`id_user`)) order by `a`.`id_transaksi` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`kode_buku`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`nim`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `nim` (`nim`),
  ADD KEY `kode_buku` (`kode_buku`),
  ADD KEY `operator` (`operator`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `buku_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`kode_buku`) REFERENCES `buku` (`kode_buku`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `peminjaman_ibfk_2` FOREIGN KEY (`nim`) REFERENCES `mahasiswa` (`nim`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `peminjaman_ibfk_3` FOREIGN KEY (`operator`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
