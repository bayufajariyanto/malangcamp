-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Jun 2020 pada 06.32
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
(3, 'Tenda Bestway Kap 4-5 org', 'Tenda', 22000, 3),
(4, 'Tenda Consina Kap 3-4 org', 'Tenda', 25000, 3),
(5, 'Tenda Great Outdoor Kap 4-5 org', 'Tenda', 25000, 3),
(6, 'Tenda Dhaulagiri Kap 3-4 org Ultralight', 'Tenda', 30000, 3),
(7, 'Tenda Great Outdoor Kap 5-6 org', 'Tenda', 35000, 3),
(8, 'Tenda Great Outdoor Kap 8 org', 'Tenda', 35000, 3),
(9, 'Tas Carrier 70-80 L', 'Carrier', 12500, 1),
(10, 'Tas Carrier 60 L', 'Carrier', 10000, 3),
(12, 'Cover Bag', 'Other', 2500, 3),
(13, 'Sepatu Trekking', 'Sepatu', 15000, 3),
(14, 'Sandal Trekking', 'Sandal', 5000, 3),
(15, 'Hammock', 'Other', 5000, 3),
(16, 'Jacket', 'Jacket', 10000, 3),
(17, 'Flysheet', 'Other', 7500, 3),
(18, 'Sarung Tangan Polar', 'Other', 4000, 3),
(19, 'Kompor Lapang', 'Cooking Set', 5000, 3),
(20, 'Nesting', 'Cooking Set', 5000, 3),
(21, 'Sleeping Bag', 'Other', 5000, 3),
(22, 'Trekking Pole', 'Other', 6000, 3),
(23, 'Matras', 'Other', 2500, 3),
(24, 'Gaiter', 'Other', 4000, 3),
(25, 'Headlamp', 'Lighting', 4000, 3),
(26, 'Lampu Tenda', 'Lighting', 4000, 3),
(27, 'Jerigen Lipat 5L', 'Other', 3000, 3),
(28, 'Kompas', 'Other', 2500, 3),
(29, 'Pisau Lipat', 'Other', 2500, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `coba`
--

CREATE TABLE `coba` (
  `id` int(11) NOT NULL,
  `nama` varchar(256) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `coba`
--

INSERT INTO `coba` (`id`, `nama`, `jumlah`) VALUES
(1, 'inidata', 0),
(2, 'inidata', 0),
(4, 'Dalam', 0),
(5, 'Luar', 0),
(6, 'nama', 0);

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

--
-- Dumping data untuk tabel `keranjang`
--

INSERT INTO `keranjang` (`id`, `username`, `id_barang`, `jumlah`) VALUES
(17, 'ahmadzulfikar', 2, 2),
(18, 'ahmadzulfikar', 3, 1);

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
(3, 'Listrik', 1590025099, 'Lainnya', 53000);

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
(25, 'COO-202005010001', 'bayufajariyanto', 19, 1588316911, 1588320511, 1588406911, 1588844781, 1588316927, 1, 30000, 5000, 1, 1, 1),
(26, 'TEN-202005070001', 'bayufajariyanto', 6, 1588843800, 1588847340, 1589020140, 1588844012, 1588843808, 2, 0, 60000, 1, 1, 1),
(27, 'TEN-202005070001', 'bayufajariyanto', 5, 1588844527, 1588848067, 1589020867, 1588944669, 1588844539, 1, 0, 25000, 1, 1, 1),
(28, 'LIG-202005080001', 'bayufajariyanto', 26, 1588918354, 1588921954, 1589008354, 1589683626, 1588918407, 1, 32000, 4000, 1, 1, 1),
(29, 'TEN-202005080001', 'anandanurj', 2, 1588918435, 1588918435, 1589004835, 1588944743, 1588918435, 1, 0, 19000, 1, 1, 1),
(30, 'TEN-202005080001', 'bayufajariyanto', 4, 1588945701, 1588945701, 1589032101, 1589375716, 1588948946, 2, 200000, 50000, 1, 1, 1),
(31, 'CAR-202005170001', 'ahmadzulfikar', 9, 1589683664, 1589683664, 1590115664, 1589683673, 1589683664, 3, 0, 37500, 1, 1, 1),
(32, 'SAN-202005260001', 'dellyagus', 14, 1590441025, 1590441025, 1590613825, 1590736183, 1590441025, 2, 20000, 10000, 1, 1, 1),
(33, 'COO-202005260001', 'dellyagus', 19, 1590441087, 1590441027, 1590527427, 1590736177, 1590441087, 1, 15000, 5000, 1, 1, 1),
(35, 'OTH-202005290001', 'ahmadzulfikar', 22, 1590737399, 1590737399, 1590823799, 1590737555, 1590737546, 1, 0, 6000, 1, 1, 1),
(36, 'CAR-20200529150546', 'ahmadzulfikar', 9, 1590739546, 1590739546, 1590825946, 1590739568, 1590739546, 2, 0, 25000, 1, 1, 1),
(37, 'CAR-20200529150937', 'bayufajariyanto', 9, 1590739777, 1590739777, 1590912577, 1591275284, 1590739777, 2, 125000, 25000, 1, 1, 1),
(39, 'COO-20200529214741', 'ahmadzulfikar', 20, 1590763661, 1590763661, 1590850061, 1591275289, 1590763706, 1, 25000, 5000, 1, 1, 1),
(51, 'TEN-2006101714324', 'bayufajariyanto', 2, 1591784072, 1591784741, 1591956872, 1591812166, 1591784741, 2, 0, 76000, 1, 1, 1),
(57, 'CAR-2006191131504', 'bayufajariyanto', 9, 1592541110, 0, 1592627510, 0, 0, 2, 0, 25000, 0, 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `nama` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `role`
--

INSERT INTO `role` (`id`, `nama`) VALUES
(1, 'Admin'),
(2, 'Member');

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
(5, 'anandanurj', '$2y$10$NJC78efYLrEq5Y.tTASfFO3gMZq1o38lIiHis6qhsBw6d8uSkqh2m', 'Ananda Nur Juliansyah', '1731710100', 'KTM', 'Surabaya Jawa Timur', '085257256782', 1585830779, 2),
(6, 'dellyagus', '$2y$10$Wc0wJYhiGm9fJ0gPa5qbpeP7XEnjMKMmjdl2oSYzBU1IKnY/q9gWa', 'Delly Agus Prasetyo', '1731710174', 'KTP', 'Pujon, Jawa Timur', '085964112370', 1586486110, 2),
(7, 'ahmadzulfikar', '$2y$10$qMkD2rOo3zMGhCpJdTgm1uDnMFQc8prXJC5EtKH29chRloT3UupOu', 'Ahmad Zulfikar Rizaldi', '1731710171', 'KTM', 'Bojonegoro', '085790651005', 1589100996, 2);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `coba`
--
ALTER TABLE `coba`
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
-- AUTO_INCREMENT untuk tabel `coba`
--
ALTER TABLE `coba`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `pengeluaran`
--
ALTER TABLE `pengeluaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

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
