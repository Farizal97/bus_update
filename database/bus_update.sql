-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Jul 2019 pada 20.22
-- Versi server: 10.1.38-MariaDB
-- Versi PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bus_update`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_adm` int(11) NOT NULL,
  `nama_adm` varchar(100) NOT NULL,
  `user_adm` varchar(100) NOT NULL,
  `pass_adm` varchar(100) NOT NULL,
  `foto_adm` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_adm`, `nama_adm`, `user_adm`, `pass_adm`, `foto_adm`) VALUES
(1, 'Administrator', 'admin', '21232f297a57a5a743894a0e4a801fc3', '24062019210202r.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `booking`
--

CREATE TABLE `booking` (
  `kode_booking` varchar(8) NOT NULL,
  `id_bus` int(11) NOT NULL,
  `tgl` date NOT NULL,
  `durasi` int(11) NOT NULL,
  `tujuan` varchar(20) NOT NULL,
  `biaya_bus` int(11) NOT NULL,
  `biaya_drv` int(11) NOT NULL,
  `status` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `tgl_booking` date NOT NULL,
  `bukti_bayar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `booking`
--

INSERT INTO `booking` (`kode_booking`, `id_bus`, `tgl`, `durasi`, `tujuan`, `biaya_bus`, `biaya_drv`, `status`, `email`, `tgl_booking`, `bukti_bayar`) VALUES
('TRX00001', 2, '2019-07-20', 8, 'Dalam Kota', 500000, 150000, 'Sudah Dibayar', 'user@gmail.com', '2019-07-19', '1907201918530226062019231158IMG_20180403_194732.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `bus`
--

CREATE TABLE `bus` (
  `id_bus` int(11) NOT NULL,
  `nama_bus` varchar(50) NOT NULL,
  `id_merek` int(11) NOT NULL,
  `nopol` varchar(20) NOT NULL,
  `harga_8` int(11) NOT NULL,
  `harga_12` int(11) NOT NULL,
  `harga_16` int(11) NOT NULL,
  `harga_24` int(11) NOT NULL,
  `harga_luar` int(11) NOT NULL,
  `deskripsi` text NOT NULL,
  `seating` int(2) NOT NULL,
  `foto_1` text NOT NULL,
  `foto_2` text NOT NULL,
  `foto_3` text NOT NULL,
  `id_adm` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `bus`
--

INSERT INTO `bus` (`id_bus`, `nama_bus`, `id_merek`, `nopol`, `harga_8`, `harga_12`, `harga_16`, `harga_24`, `harga_luar`, `deskripsi`, `seating`, `foto_1`, `foto_2`, `foto_3`, `id_adm`) VALUES
(1, 'Subur Jaya', 16, 'B 7282 CAF', 1500000, 1800000, 2000000, 2500000, 400000, 'Bus Scania Subur Jaya, Fasilitas : Personal AC, Personal Headlight, Full Entertaintment, Smooking Area, Toilet, Bagasi Luas', 56, '22062019225314s.jpg', '22062019225329s.jpg', '22062019225437s.jpg', 1),
(2, 'Sinar Jaya', 15, 'B 1919 MF', 500000, 800000, 1000000, 1300000, 450000, 'Bus Mercedes Sinar Jaya, Fasilitas : Personal AC, Personal Headlight, Full Entertaintment, Smooking Area, Bagasi Luas', 56, '14072019223135y.png', '14072019223150y.png', '14072019223207y.png', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `cek_booking`
--

CREATE TABLE `cek_booking` (
  `id_cek` int(11) NOT NULL,
  `kode_booking` varchar(8) NOT NULL,
  `id_bus` int(11) NOT NULL,
  `tgl_booking` varchar(10) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `merek`
--

CREATE TABLE `merek` (
  `id_merek` int(11) NOT NULL,
  `nama_merek` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `merek`
--

INSERT INTO `merek` (`id_merek`, `nama_merek`) VALUES
(15, 'Mercedes'),
(16, 'Scania');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tblpages`
--

CREATE TABLE `tblpages` (
  `id_page` int(11) NOT NULL,
  `page_name` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `detail` longtext NOT NULL,
  `id_adm` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tblpages`
--

INSERT INTO `tblpages` (`id_page`, `page_name`, `type`, `detail`, `id_adm`) VALUES
(1, 'Rekening', 'rekening', '																																	123456789 Bank BRI a/n  Mita Trans Jogja', 1),
(4, 'Alamat', 'alamat', 'Jalan Wahid Hasyim 120 , Condong Catur, Sleman											', 1),
(2, 'Tentang Kami', 'aboutus', '																																	<span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">Kami adalah perusahaan yang bergerak di bidang penyewaan Bus.</span>																						', 1),
(3, 'FAQs', 'faqs', '											<div style=\"text-align: justify;\"><span style=\"font-size: 1em; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif;\">Q : Bagaimana cara menyewa bus di Mutiara Mita Trans Jogja?</span></div><div style=\"text-align: justify;\"><span style=\"font-size: 1em; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif;\">A : Pertama anda harus mendaftar terlebih dahulu sebagai member melalui menu yang telah disediakan.</span></div>											', 1),
(5, 'Telepon', 'telepon', '											0812345678', 1),
(6, 'Email', 'email', '											mitatransjogja@gmail.com											', 1),
(7, 'Biaya Driver', '150000', '250000', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(120) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `telp` char(11) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `nama_user`, `email`, `password`, `telp`, `alamat`) VALUES
(1, 'mitra', 'user@gmail.com', 'ee11cbb19052e40b07aac0ca060c23ee', '087887525', 'bekasi');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_adm`);

--
-- Indeks untuk tabel `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`kode_booking`);

--
-- Indeks untuk tabel `bus`
--
ALTER TABLE `bus`
  ADD PRIMARY KEY (`id_bus`);

--
-- Indeks untuk tabel `cek_booking`
--
ALTER TABLE `cek_booking`
  ADD PRIMARY KEY (`id_cek`);

--
-- Indeks untuk tabel `merek`
--
ALTER TABLE `merek`
  ADD PRIMARY KEY (`id_merek`);

--
-- Indeks untuk tabel `tblpages`
--
ALTER TABLE `tblpages`
  ADD PRIMARY KEY (`id_page`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id_adm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `bus`
--
ALTER TABLE `bus`
  MODIFY `id_bus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `cek_booking`
--
ALTER TABLE `cek_booking`
  MODIFY `id_cek` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `merek`
--
ALTER TABLE `merek`
  MODIFY `id_merek` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `tblpages`
--
ALTER TABLE `tblpages`
  MODIFY `id_page` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
