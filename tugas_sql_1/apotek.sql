-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 13 Des 2023 pada 08.52
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apotek`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_perusahaan`
--

CREATE TABLE `detail_perusahaan` (
  `id` int(11) NOT NULL,
  `email` varchar(32) NOT NULL,
  `facebook` varchar(32) NOT NULL,
  `instagram` varchar(32) NOT NULL,
  `alamat` text NOT NULL,
  `id_perusahaan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `detail_perusahaan`
--

INSERT INTO `detail_perusahaan` (`id`, `email`, `facebook`, `instagram`, `alamat`, `id_perusahaan`) VALUES
(1, 'sanofi@gmail.com', 'sanofi.indonesia', 'sanofi group', 'Jakarta Barat', 1),
(2, 'kalbe@gmail.com', 'kalbe.indonesia', 'kalbe group', 'Jakarta selatan', 2),
(3, 'combiphar@gmail.com', 'combiphar.indonesia', 'combiphar group', 'Bekasi', 3),
(4, 'konimex@gmail.com', 'konimex.indonesia', 'konimex group', 'Tangerang', 4),
(5, 'contrexyn@gmail.com', 'xontrexyn.indonesia', 'xontrexyn', 'Tangerang ', 5),
(6, 'graciahusada@gmail.com', 'gracia.indonesia', 'gracia group', 'Banten', 6),
(7, 'scan@gmail.com', 'scan.indonesia', 'scan group', 'Brebes', 7);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id` int(11) NOT NULL,
  `id_obat` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`id`, `id_obat`, `id_transaksi`, `harga`) VALUES
(1, 1, 1, 5000),
(2, 2, 2, 10000),
(3, 3, 3, 15000),
(4, 4, 4, 20000),
(5, 8, 5, 10000),
(6, 9, 6, 20000),
(7, 10, 7, 10000),
(8, 12, 9, 30000),
(9, 13, 10, 12000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `obat`
--

CREATE TABLE `obat` (
  `id` int(11) NOT NULL,
  `nama_obat` varchar(32) NOT NULL,
  `harga` int(11) NOT NULL,
  `tanggal_exp` date NOT NULL,
  `id_perusahaan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `obat`
--

INSERT INTO `obat` (`id`, `nama_obat`, `harga`, `tanggal_exp`, `id_perusahaan`) VALUES
(1, 'bisolvon', 5000, '2023-12-03', 1),
(2, 'woods', 11000, '2023-12-05', 2),
(3, 'combi', 15000, '2023-12-06', 3),
(4, 'konidin', 5000, '2023-12-08', 4),
(8, 'Proomag', 10000, '2021-12-15', 5),
(9, 'Kontreksin', 15000, '2020-12-23', 6),
(10, 'Hufagrif', 20000, '2020-12-24', 6),
(11, 'Oskadon', 24000, '2020-12-13', 7),
(12, 'Ketozonazol', 21000, '2019-12-28', 8),
(13, 'Salep 88', 40000, '2022-12-06', 8);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembeli`
--

CREATE TABLE `pembeli` (
  `id` int(11) NOT NULL,
  `nama` varchar(32) NOT NULL,
  `alamat` text NOT NULL,
  `no_tlp` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pembeli`
--

INSERT INTO `pembeli` (`id`, `nama`, `alamat`, `no_tlp`) VALUES
(1, 'pa riski fadil', 'DS. Bulakamba', '086543456789'),
(2, 'agus lukman hakim', 'DS. Dukh Tengah', '082345432176'),
(3, 'Pa Pandu Herbagus', 'DS. Daerah kidul', '084657865466'),
(4, 'Pa Saepul anwar', 'DS. Luwung gede', '085674325676'),
(5, 'Pa Karsidin', 'Ds. Kersana, Kec. Kersana, Kab. Brebes', '0853345757787'),
(6, 'Pa Timbul', 'Ds. Bulakelor, Kec. Ketanggungan, Kab. Brebes', '087656765323'),
(7, 'Pa Aslah', 'Ds. Lemah abang, Kec. Tanjung, Kab. Brebes', '089865674354'),
(8, 'Pa Joko', 'Ds. Bulakelor, Kec. Kersana, Kab. Brebes', '085467612343'),
(9, 'Pa Yasin', 'Ds. Jagapura, Kec. Ketanggungan, Kab. Brebes', '086545674312'),
(10, 'Pa Sony', 'Ds. Karang malang, Kec. Ketanggungan, Kab. Brebes', '089745321265');

-- --------------------------------------------------------

--
-- Struktur dari tabel `perusahaan`
--

CREATE TABLE `perusahaan` (
  `id` int(11) NOT NULL,
  `nama_perusahaan` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `perusahaan`
--

INSERT INTO `perusahaan` (`id`, `nama_perusahaan`) VALUES
(1, 'sanofi'),
(2, 'kalbe Farma'),
(3, 'combiphar'),
(4, 'PT. Konimex'),
(5, 'CONTREXYN'),
(6, 'PT. GRATIA HUSADA FARMA'),
(7, 'TEMPO SCAN GROUP'),
(8, 'K24KLIK');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `tanggal_beli` date NOT NULL,
  `jumlah` int(11) NOT NULL,
  `id_pembeli` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id`, `tanggal_beli`, `jumlah`, `id_pembeli`) VALUES
(1, '2023-12-01', 3, 1),
(2, '2023-12-02', 8, 2),
(3, '2023-12-03', 10, 3),
(4, '2023-12-03', 12, 4),
(5, '2023-12-06', 3, 5),
(6, '2023-12-07', 1, 6),
(7, '2023-12-08', 7, 7),
(8, '2023-12-09', 9, 8),
(9, '2023-12-10', 1, 9),
(10, '2023-12-12', 3, 10);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `detail_perusahaan`
--
ALTER TABLE `detail_perusahaan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_detail_perusahaan` (`id_perusahaan`);

--
-- Indeks untuk tabel `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_transaksi` (`id_transaksi`),
  ADD KEY `fk_obat` (`id_obat`);

--
-- Indeks untuk tabel `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_perusahaan` (`id_perusahaan`);

--
-- Indeks untuk tabel `pembeli`
--
ALTER TABLE `pembeli`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `perusahaan`
--
ALTER TABLE `perusahaan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pembeli` (`id_pembeli`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `detail_perusahaan`
--
ALTER TABLE `detail_perusahaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `obat`
--
ALTER TABLE `obat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `pembeli`
--
ALTER TABLE `pembeli`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `perusahaan`
--
ALTER TABLE `perusahaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `detail_perusahaan`
--
ALTER TABLE `detail_perusahaan`
  ADD CONSTRAINT `fk_detail_perusahaan` FOREIGN KEY (`id_perusahaan`) REFERENCES `perusahaan` (`id`);

--
-- Ketidakleluasaan untuk tabel `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD CONSTRAINT `fk_obat` FOREIGN KEY (`id_obat`) REFERENCES `obat` (`id`),
  ADD CONSTRAINT `fk_transaksi` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id`);

--
-- Ketidakleluasaan untuk tabel `obat`
--
ALTER TABLE `obat`
  ADD CONSTRAINT `fk_perusahaan` FOREIGN KEY (`id_perusahaan`) REFERENCES `perusahaan` (`id`);

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `fk_pembeli` FOREIGN KEY (`id_pembeli`) REFERENCES `pembeli` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
