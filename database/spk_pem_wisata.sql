-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Sep 2023 pada 02.55
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spk_pem_kayu`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `alternatif`
--

CREATE TABLE `alternatif` (
  `id_alternatif` int(5) NOT NULL,
  `nama_alternatif` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `rating` int(1) NOT NULL,
  `kategori` enum('Budaya','Buatan','Alam') NOT NULL,
  `biaya_alt` int(11) NOT NULL,
  `fasilitas_alt` text NOT NULL,
  `jarak_alt` decimal(10,2) NOT NULL,
  `jumlah_peng_alt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `alternatif`
--

INSERT INTO `alternatif` (`id_alternatif`, `nama_alternatif`, `alamat`, `gambar`, `latitude`, `longitude`, `rating`, `kategori`, `biaya_alt`, `fasilitas_alt`, `jarak_alt`, `jumlah_peng_alt`) VALUES
(2, 'Kampung adat Boti', '-', '-', '-9.56522781556891', '124.23324709489728', 1, 'Budaya', 0, '', '0.00', 0),
(3, 'Gunung Mutis', '-', '-', '-9.565125658547931', '124.18302099829398', 2, '', 0, '', '0.00', 0),
(4, 'Fatumnasi', '-', '-', '-9.712473063953183', ' 124.22802736659872', 1, 'Alam', 0, '', '0.00', 0),
(5, 'Fatunausus', '-', '-', '-9.802771229973178', ' 124.30737749543702', 1, 'Alam', 0, '', '0.00', 0),
(6, 'Air Terjun Oehala', '-', '-', '-9.62871123927298', ' 124.63119345208362', 1, 'Alam', 0, '', '0.00', 0),
(7, 'Fatukopa', '-', '-', '-9.979412177412835', ' 124.5182035605519', 1, 'Alam', 0, '', '0.00', 0),
(8, 'Kolbano', '-', '-', '-10.154238976191714', ' 124.31347258714773', 1, 'Alam', 0, '', '0.00', 0),
(9, 'Oetune', '-', '-', '-9.833087380993256', ' 124.41281113776452', 1, 'Alam', 0, '', '0.00', 0),
(10, 'Benteng Nonef', '-', '-', '-9.847900321615707', ' 124.26583459729325', 1, 'Buatan', 0, '', '0.00', 0),
(11, 'Taman Bu\'at', '-', '-', '-9.90892879933305', ' 124.53599478383306', 1, 'Budaya', 0, '', '0.00', 0),
(17, 'Halo Dek', 'sASAAS', 'Screenshot (2).png', '9.84790032', '124.41281113776452', 1, 'Budaya', 22999, 'DASDAS, dassa, eqwq dan eqwqwe', '0.31', 2291),
(18, 'dasdas', 'SSAsA', 'images_1.png', '9.84790032', '124.41281113776452', 2, 'Alam', 1000, 'SasA, aSSasA dan SasA', '23.00', 232);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kecocokan_alt_kriteria`
--

CREATE TABLE `kecocokan_alt_kriteria` (
  `id_alt_kriteria` int(11) NOT NULL,
  `f_id_alternatif` int(5) NOT NULL,
  `f_id_kriteria` char(2) NOT NULL,
  `f_id_sub_kriteria` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kecocokan_alt_kriteria`
--

INSERT INTO `kecocokan_alt_kriteria` (`id_alt_kriteria`, `f_id_alternatif`, `f_id_kriteria`, `f_id_sub_kriteria`) VALUES
(1, 3, 'C1', 1),
(2, 3, 'C2', 8),
(3, 3, 'C3', 13),
(4, 3, 'C4', 18),
(6, 4, 'C1', 1),
(7, 4, 'C2', 7),
(8, 4, 'C3', 13),
(9, 4, 'C4', 16),
(11, 5, 'C1', 1),
(12, 5, 'C2', 9),
(13, 5, 'C3', 13),
(14, 5, 'C4', 19),
(16, 6, 'C1', 1),
(17, 6, 'C2', 8),
(18, 6, 'C3', 12),
(19, 6, 'C4', 18),
(21, 7, 'C1', 1),
(22, 7, 'C2', 10),
(23, 7, 'C3', 14),
(24, 7, 'C4', 19),
(26, 8, 'C1', 1),
(27, 8, 'C2', 7),
(28, 8, 'C3', 15),
(29, 8, 'C4', 17),
(31, 9, 'C1', 1),
(32, 9, 'C2', 8),
(33, 9, 'C3', 15),
(34, 9, 'C4', 19),
(36, 10, 'C1', 1),
(37, 10, 'C2', 9),
(38, 10, 'C3', 13),
(39, 10, 'C4', 20),
(41, 11, 'C1', 2),
(42, 11, 'C2', 8),
(43, 11, 'C3', 12),
(44, 11, 'C4', 17),
(46, 2, 'C1', 1),
(47, 2, 'C2', 8),
(48, 2, 'C3', 13),
(49, 2, 'C4', 20),
(72, 17, 'C1', 4),
(73, 17, 'C2', 7),
(74, 17, 'C3', 14),
(75, 17, 'C4', 19),
(76, 18, 'C1', 4),
(77, 18, 'C2', 8),
(78, 18, 'C3', 14),
(79, 18, 'C4', 19);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` char(2) NOT NULL,
  `nama_kriteria` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `nama_kriteria`) VALUES
('C1', 'Biaya masuk'),
('C2', 'Fasilitas'),
('C3', 'Jarak dari pusat kota'),
('C4', 'Jumlah pengunjung');

-- --------------------------------------------------------

--
-- Struktur dari tabel `login_user`
--

CREATE TABLE `login_user` (
  `id_login` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `login_user`
--

INSERT INTO `login_user` (`id_login`, `username`, `password`, `level`) VALUES
(1, 'admin', '$2y$10$o9rw1S2HbWQolaKF3XKDdeu2B4fsebEq35Ca0KTwmytsi3tud1HCC', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sub_kriteria`
--

CREATE TABLE `sub_kriteria` (
  `id_sub_kriteria` int(5) NOT NULL,
  `nama_sub_kriteria` varchar(25) NOT NULL,
  `spesifikasi` text NOT NULL,
  `bobot_sub_kriteria` int(5) NOT NULL,
  `f_id_kriteria` char(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `sub_kriteria`
--

INSERT INTO `sub_kriteria` (`id_sub_kriteria`, `nama_sub_kriteria`, `spesifikasi`, `bobot_sub_kriteria`, `f_id_kriteria`) VALUES
(1, 'Sangat murah', 'Rp. 0 - 10.000', 5, 'C1'),
(2, 'Murah', 'Rp. >10.000 - 25.000', 4, 'C1'),
(3, 'Sedang', 'Rp. >25.000 - 50.000', 3, 'C1'),
(4, 'Mahal', 'Rp. >50.000 - 100.000', 2, 'C1'),
(5, 'Sangat mahal', '> Rp.100.000', 1, 'C1'),
(6, 'Sangat lengkap', 'Jika memenuhi 5 item dari fasilitas berikut ini: Kamar mandi, tempat parkir, area food court, tempat sampah, gazebo.', 5, 'C2'),
(7, 'Lengkap', 'Jika memenuhi 4 item dari fasilitas berikut ini: Kamar mandi, tempat parkir, area food court, tempat sampah, gazebo.', 4, 'C2'),
(8, 'Cukup lengkap', 'Jika memenuhi 3 item dari fasilitas berikut ini: Kamar mandi, tempat parkir, area food court, tempat sampah, gazebo. ', 3, 'C2'),
(9, 'Kurang lengkap', 'Jika memenuhi 2 item dari fasilitas berikut ini: Kamar mandi, tempat parkir, area food court, tempat sampah, gazebo.', 2, 'C2'),
(10, 'Tidak lengkap', 'Jika memenuhi 1 item dari fasilitas berikut ini: Kamar mandi, tempat parkir, area food court, tempat sampah, gazebo.', 1, 'C2'),
(11, 'Sangat dekat', '0 - 5 Km', 5, 'C3'),
(12, 'Dekat', '> 5 - 20 Km', 4, 'C3'),
(13, 'Sedang', '> 20 - 50 Km', 3, 'C3'),
(14, 'Jauh', '> 50 - 75 Km', 2, 'C3'),
(15, 'Sangat jauh', '> 75 - 134 Km', 1, 'C3'),
(16, 'Sangat banyak', '>100 Orang', 5, 'C4'),
(17, 'Banyak', '76-100 Orang', 4, 'C4'),
(18, 'Sedang', '51-75 Orang', 3, 'C4'),
(19, 'Sedikit', '26-50 Orang', 2, 'C4'),
(20, 'Sangat sedikit', '5-25 Orang', 1, 'C4');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `alternatif`
--
ALTER TABLE `alternatif`
  ADD PRIMARY KEY (`id_alternatif`);

--
-- Indeks untuk tabel `kecocokan_alt_kriteria`
--
ALTER TABLE `kecocokan_alt_kriteria`
  ADD PRIMARY KEY (`id_alt_kriteria`),
  ADD KEY `f_id_alternatif` (`f_id_alternatif`),
  ADD KEY `f_id_kriteria` (`f_id_kriteria`),
  ADD KEY `f_id_sub_kriteria` (`f_id_sub_kriteria`);

--
-- Indeks untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indeks untuk tabel `login_user`
--
ALTER TABLE `login_user`
  ADD PRIMARY KEY (`id_login`);

--
-- Indeks untuk tabel `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  ADD PRIMARY KEY (`id_sub_kriteria`),
  ADD KEY `f_id_kriteria` (`f_id_kriteria`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `alternatif`
--
ALTER TABLE `alternatif`
  MODIFY `id_alternatif` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `kecocokan_alt_kriteria`
--
ALTER TABLE `kecocokan_alt_kriteria`
  MODIFY `id_alt_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT untuk tabel `login_user`
--
ALTER TABLE `login_user`
  MODIFY `id_login` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  MODIFY `id_sub_kriteria` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `kecocokan_alt_kriteria`
--
ALTER TABLE `kecocokan_alt_kriteria`
  ADD CONSTRAINT `kecocokan_alt_kriteria_ibfk_1` FOREIGN KEY (`f_id_sub_kriteria`) REFERENCES `sub_kriteria` (`id_sub_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kecocokan_alt_kriteria_ibfk_2` FOREIGN KEY (`f_id_kriteria`) REFERENCES `kriteria` (`id_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kecocokan_alt_kriteria_ibfk_3` FOREIGN KEY (`f_id_alternatif`) REFERENCES `alternatif` (`id_alternatif`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  ADD CONSTRAINT `sub_kriteria_ibfk_1` FOREIGN KEY (`f_id_kriteria`) REFERENCES `kriteria` (`id_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
