-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 23 Jun 2020 pada 14.49
-- Versi server: 10.1.31-MariaDB
-- Versi PHP: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rent`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id` int(11) NOT NULL,
  `nama` varchar(256) NOT NULL,
  `kategori` varchar(256) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id`, `nama`, `kategori`, `harga`, `stok`) VALUES
(2, 'Tenda Double Layer Kap 3-4 org', 'Tenda', 19000, 3),
(3, 'Tenda Bestway Kap 4-5 org', 'Tenda', 22000, 5),
(4, 'Tenda Consina Kap 3-4 org', 'Tenda', 25000, 3),
(5, 'Tenda Great Outdoor Kap 4-5 org', 'Tenda', 25000, 3),
(6, 'Tenda Dhaulagiri Kap 3-4 org Ultralight', 'Tenda', 30000, 3),
(7, 'Tenda Great Outdoor Kap 5-6 org', 'Tenda', 35000, 3),
(8, 'Tenda Great Outdoor Kap 8 org', 'Tenda', 35000, 2),
(9, 'Tas Carrier 70-80 L', 'Carrier', 12500, 3),
(10, 'Tas Carrier 60 L', 'Carrier', 10000, 3),
(12, 'Cover Bag', 'Other', 2500, 3),
(13, 'Sepatu Trekking', 'Sepatu', 15000, 3),
(14, 'Sandal Trekking', 'Sandal', 5000, 0),
(15, 'Hammock', 'Other', 5000, 3),
(16, 'Jacket', 'Jacket', 10000, 2),
(17, 'Flysheet', 'Other', 7500, 3),
(18, 'Sarung Tangan Polar', 'Other', 4000, 3),
(19, 'Kompor Lapang', 'Cooking Set', 5000, 3),
(20, 'Nesting', 'Cooking Set', 5000, 3),
(21, 'Sleeping Bag', 'Other', 5000, 3),
(22, 'Trekking Pole', 'Other', 6000, 3),
(23, 'Matras', 'Other', 2500, 3),
(24, 'Gaiter', 'Other', 4000, 3),
(25, 'Headlamp', 'Lighting', 4000, 1),
(26, 'Lampu Tenda', 'Lighting', 4000, 3),
(27, 'Jerigen Lipat 5L', 'Other', 3000, 3),
(28, 'Kompas', 'Other', 2500, 3),
(29, 'Pisau Lipat', 'Other', 2500, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `nama` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id`, `nama`) VALUES
(1, 'Carrier'),
(2, 'Cooking Set'),
(3, 'Jacket'),
(4, 'Lighting'),
(5, 'Other'),
(6, 'Sandal'),
(7, 'Sepatu'),
(8, 'Tenda');

-- --------------------------------------------------------

--
-- Struktur dari tabel `keranjang`
--

CREATE TABLE `keranjang` (
  `id` int(11) NOT NULL,
  `username` varchar(256) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengeluaran`
--

CREATE TABLE `pengeluaran` (
  `id` int(11) NOT NULL,
  `nama` varchar(256) NOT NULL,
  `tanggal` bigint(20) NOT NULL,
  `kategori` varchar(256) NOT NULL,
  `nominal` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengeluaran`
--

INSERT INTO `pengeluaran` (`id`, `nama`, `tanggal`, `kategori`, `nominal`) VALUES
(1, 'Aditya Eka Pradana', 1589805061, 'Gaji', 500000),
(2, 'Cuci Sepatu', 1589808535, 'Perawatan', 20000),
(3, 'Listrik', 1590025099, 'Lainnya', 53000),
(4, 'Listrik', 1592574922, 'Lainnya', 53000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesanan`
--

CREATE TABLE `pesanan` (
  `id` int(11) NOT NULL,
  `kode_transaksi` varchar(256) NOT NULL,
  `username` varchar(256) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `tanggal_order` bigint(20) NOT NULL,
  `tanggal_sewa` bigint(20) NOT NULL,
  `batas_kembali` bigint(20) NOT NULL,
  `tanggal_kembali` bigint(20) NOT NULL,
  `tanggal_bayar` bigint(20) NOT NULL,
  `jumlah_barang` int(11) NOT NULL,
  `denda` bigint(20) NOT NULL,
  `total` bigint(20) NOT NULL,
  `status` int(11) NOT NULL,
  `konfirmasi` int(11) NOT NULL,
  `selesai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pesanan`
--

INSERT INTO `pesanan` (`id`, `kode_transaksi`, `username`, `id_barang`, `tanggal_order`, `tanggal_sewa`, `batas_kembali`, `tanggal_kembali`, `tanggal_bayar`, `jumlah_barang`, `denda`, `total`, `status`, `konfirmasi`, `selesai`) VALUES
(23, 'AHM-2006231037467', 'ahmadzulfikarrizaldi', 12, 1592883466, 1592883667, 1593056266, 0, 1592883667, 2, 0, 10000, 1, 1, 0),
(24, 'AHM-2006231037467', 'ahmadzulfikarrizaldi', 6, 1592883466, 1592883667, 1593056266, 0, 1592883667, 1, 0, 60000, 1, 1, 0),
(25, 'AHM-2006231037467', 'ahmadzulfikarrizaldi', 26, 1592883466, 1592883667, 1593056266, 0, 1592883667, 1, 0, 8000, 1, 1, 0),
(28, 'BAY-2006231902424', 'bayufajariyanto', 16, 1592913762, 1592913849, 1593086562, 1592913860, 1592913849, 2, 0, 40000, 1, 1, 1),
(29, 'BAY-2006231902424', 'bayufajariyanto', 8, 1592913762, 1592913849, 1593086562, 1592913860, 1592913849, 1, 0, 70000, 1, 1, 1),
(30, 'BAY-2006231937414', 'bayufajariyanto', 13, 1592915861, 1592916430, 1593088661, 1592916443, 1592916430, 1, 0, 30000, 1, 1, 1),
(31, 'BAY-2006231937414', 'bayufajariyanto', 25, 1592915861, 1592916430, 1593088661, 1592916443, 1592916430, 2, 0, 16000, 1, 1, 1),
(32, 'BAY-2006231937414', 'bayufajariyanto', 14, 1592915861, 1592916430, 1593088661, 1592916443, 1592916430, 1, 0, 10000, 1, 1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `nama` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `role`
--

INSERT INTO `role` (`id`, `nama`) VALUES
(1, 'Admin'),
(2, 'Member\r\n');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `no_kitas` varchar(128) NOT NULL,
  `jenis_kitas` varchar(128) NOT NULL,
  `alamat` varchar(256) NOT NULL,
  `telp` varchar(128) NOT NULL,
  `date_created` bigint(20) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `nama`, `no_kitas`, `jenis_kitas`, `alamat`, `telp`, `date_created`, `role_id`) VALUES
(1, 'admin', '1234', 'Admin', '', '', '', '', 1585144105, 1),
(4, 'bayufajariyanto', '$2y$10$UrJvWuSHG.ZhRWNvOLw4jOh/Y08Wt5/mEl.OEwvpFi2ZByWjpLC0G', 'Bayu Fajariyanto', '1731710033', 'KTM', 'Pasuruan Jawa Timur', '083851350939', 1585816190, 2),
(5, 'anandanurjuliansyah', '$2y$10$NJC78efYLrEq5Y.tTASfFO3gMZq1o38lIiHis6qhsBw6d8uSkqh2m', 'Ananda Nur Juliansyah', '1731710100', 'KTM', 'Surabaya Jawa Timur', '085257256782', 1585830779, 2),
(6, 'dellyagus', '$2y$10$Wc0wJYhiGm9fJ0gPa5qbpeP7XEnjMKMmjdl2oSYzBU1IKnY/q9gWa', 'Delly Agus Prasetyo', '1731710174', 'KTP', 'Pujon, Jawa Timur', '085964112370', 1586486110, 2),
(7, 'ahmadzulfikarrizaldi', '$2y$10$qMkD2rOo3zMGhCpJdTgm1uDnMFQc8prXJC5EtKH29chRloT3UupOu', 'Ahmad Zulfikar Rizaldi', '1731710171', 'KTM', 'Bojonegoro', '085790651005', 1589100996, 2);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `pengeluaran`
--
ALTER TABLE `pengeluaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT untuk tabel `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
