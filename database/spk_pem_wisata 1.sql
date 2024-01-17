-- phpMyAdmin SQL Dump
-- version 5.3.0-dev+20220525.c1e393abce
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 04, 2023 at 02:00 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.5

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
-- Table structure for table `alternatif`
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
-- Dumping data for table `alternatif`
--

INSERT INTO `alternatif` (`id_alternatif`, `nama_alternatif`, `alamat`, `gambar`, `latitude`, `longitude`, `rating`, `kategori`, `biaya_alt`, `fasilitas_alt`, `jarak_alt`, `jumlah_peng_alt`) VALUES
(2, 'Kampung adat Boti', 'Kec. Ki&#039;e, Kabupaten Timor Tengah Selatan, Nusa Tenggara Tim.', 'boti.jpg', '-9.56522781556891', '124.23324709489728', 1, 'Budaya', 0, 'Kamar Mandi, Tempat Parkir, Tempat Sampah dan Lopo', '42.00', 10),
(3, 'Gunung Mutis', 'Bonleu, Kec.Tobu, Kab.Timor Tengah Selatan NTT', 'mutis.jpg', '-9.565125658547931', '124.18302099829398', 1, 'Alam', 0, 'Tempat Parkir, Tempat Sampah dan Lopo', '39.00', 60),
(4, 'Fatumnasi', 'Kecamatan Fatumnasi Kabupaten Timor Tengah Selatan', 'fatumnasi.jpg', '-9.712473063953183', ' 124.22802736659872', 1, 'Alam', 1000, 'Gazebo, Tempat Parkir, Kamar Mandi, Area Food Court, Tempat Sampah dan Lopo', '0.00', 100),
(5, 'Fatunausus', 'Fatukoto, Kec. Mollo Utara, Kabupaten Timor Tengah Selatan, Nusa Tenggara Tim.', 'fatunausus.jpg', '-9.802771229973178', ' 124.30737749543702', 1, 'Alam', 0, 'Kamar Mandi dan Tempat Parkir', '35.00', 40),
(6, 'Air Terjun Oehala', 'Kec. Batu Putih, Kab. Timor Tengah Selatan', 'air terjun oehala.jpg', '-9.62871123927298', ' 124.63119345208362', 1, 'Alam', 1000, 'Kamar Mandi, Tempat Parkir, Lopo, Area Food Court dan Tempat Sampah', '13.00', 70),
(7, 'Fatukopa', 'Kec. Fatukopa, Kab Timor Tengah Selatan', 'fatukopa.jpg', '-9.979412177412835', ' 124.5182035605519', 1, 'Alam', 0, 'dan dan Tempat Parkir', '55.00', 40),
(8, 'Kolbano', 'Kec. Kolbano, Kab. Timor Tengah Selatan', 'kolbano1.jpg', '-10.154238976191714', ' 124.31347258714773', 1, 'Alam', 1000, 'Lopo, Area Food Court, Gazebo, Tempat Sampah, Kamar Mandi dan Tempat Parkir', '124.00', 100),
(9, 'Oetune', 'Oebelo, Kec. Amanuban Sel, Kab. Timor Tengah Selatan', 'oetune.jpg', '-9.833087380993256', ' 124.41281113776452', 1, 'Alam', 10000, 'Lopo, Area Food Court, Tempat Sampah, Kamar Mandi dan Tempat Parkir', '87.00', 50),
(10, 'Benteng None', 'Tetaf, Kec. Amanuban Bar., Kabupaten Timor Tengah Selatan, Nusa Tenggara Tim.', 'benteng nonef.jpg', '-9.847900321615707', ' 124.26583459729325', 1, 'Budaya', 0, 'Kamar Mandi dan Tempat Parkir', '22.00', 10),
(19, 'Bolapalelo', 'Bolapalelo,Oelbubuk, Kec. Mollo Tengah, Kabupaten Timor Tengah Selatan, Nusa Tenggara Tim.', 'bolapalelofix.jpg', '-9.772479906000017', '124.2790707312772', 1, 'Alam', 10000, 'Kamar Mandi, Tempat Parkir, Lopo, Area Food Court dan Tempat Sampah', '12.00', 60),
(20, 'Agro kayu', 'Kec. Mollo Tengah, Kabupaten Timor Tengah Selatan, Nusa Tenggara Tim.', 'agro kayu.jpg', '-9.770692212866773', '124.2588228176871', 1, 'Buatan', 0, 'Kamar Mandi, Tempat Parkir dan Gazebo', '14.00', 20),
(21, 'Air Terjun Noinbila', 'Klani/Noinbila, Kec. Mollo Sel., Kabupaten Timor Tengah Selatan, Nusa Tenggara Tim.', 'air terjun noinbila.jpg', '-9.800174558934453', '124.3211373760034', 1, 'Alam', 5000, 'Lopo dan Tempat Sampah', '12.00', 90),
(22, 'Danau Supul', 'Supul, Kec. Kuatnana, Kabupaten Timor Tengah Selatan, Nusa Tenggara Tim.', 'danau supul.jpg', '-9.841022828073456', '124.44881864245546', 1, 'Alam', 0, 'Gazebo, Area Food Court, Tempat Parkir, Tempat Sampah dan Kamar Mandi', '25.00', 25),
(23, 'Pantai Oetuke', 'Oetuke, Kec. Kolbano, Kabupaten Timor Tengah Selatan, Nusa Tenggara Tim.', 'oetuke.jpg', '-10.005545312706227', '124.55586739659469', 1, 'Alam', 10000, 'Kamar Mandi, Tempat Parkir, Gazebo, Area Food Court dan ', '126.00', 70),
(24, 'Fatu Kolen', 'Tunua, kec. Tobu, Kab. Timor Tengah Selatan', 'FATU KOLEN.jpg', '-9.674676856245803', '124.24808129605778', 1, 'Alam', 0, 'dan dan -', '29.00', 5),
(25, 'Oe Nali', 'Mnelalete, Kec. Amanuban Bar., Kabupaten Timor Tengah Selatan, Nusa Tenggara Tim.', 'oenali.jpg', '-9.87701078436642', '124.32340702482053', 1, 'Alam', 0, 'Kamar Mandi, Tempat Parkir, Tempat Sampah dan Area Food Court', '7.00', 50),
(26, 'Pantai Nunkolo', 'Kec. Nunkolo, Kabupaten Timor Tengah Selatan, Nusa Tenggara Tim.', 'nunkolo.jpg', '-9.872125507312058', '124.70509184304478', 1, 'Alam', 0, 'dan dan -', '148.00', 5),
(27, 'Fatu Ulan', 'Kec. Ki&#039;e, Kab. Timor Tengah Selatan', 'fatuulan.jpg', '-9.907787336975924', '124.62471137430538', 1, 'Alam', 0, 'dan dan -', '55.00', 50),
(28, 'Sonaf Ajaobaki', 'Ajaobaki, Kec. Mollo Utara', 'sonaf ajaobaki.jpg', '-9.718493142493653', '124.26792892143065', 1, 'Budaya', 0, 'Kamar Mandi, Lopo, Tempat Sampah dan Tempat Parkir', '25.00', 30),
(29, 'Sonaf Niki-Niki', '5FJF+G57, Niki Niki, Kec. Amanuban Tengah, Kabupaten Timor Tengah Selatan, Nusa Tenggara Tim.', 'Soaf-Niki-niki.jpg', '-9.818597119875994', '124.47295288546347', 1, 'Budaya', 0, 'Kamar Mandi dan Tempat Parkir', '28.00', 20),
(30, 'Benteng Seki Tafuli', 'Fotilo, Amanatun Utara', 'tafuli.jpg', '-9.732208389091301', '124.69629447623338', 1, 'Budaya', 0, 'dan dan -', '138.00', 5),
(31, 'Situs Tunbes', 'Pilli, Kec. Kie, Kab. TTS', 'situs tunbes.jpg', '-9.77853166927774', '124.48982244358325', 0, 'Budaya', 0, 'Tempat parkir dan Kamar Mandi', '53.00', 10),
(33, 'Sumur Tua', 'Kec. Kota Soe, Kabupaten Timor Tengah Selatan, Nusa Tenggara Tim.', 'sumur tua.jpg', '-9.865883870651508', '124.27872997076423', 0, 'Budaya', 0, 'dan kamar mandi', '0.00', 5),
(34, 'taman Beatriks', 'Kec. Kota Soe, Kabupaten Timor Tengah Selatan, Nusa Tenggara Tim.', 'taman betriks.jpg', '-9.865149346683376', '124.27791916405414', 0, 'Buatan', 0, 'dan dan -', '0.00', 5),
(35, 'Taman Rekreasi Buat', 'Noinbila, Kec. Mollo Sel., Kabupaten Timor Tengah Selatan, Nusa Tenggara Tim.', 'taman bu\'at_3.jpeg', '-9.827251417937882', '124.26024340873239', 1, 'Buatan', 10, 'kamar Mandi, Penginapan, Taman Bermain anak, Tempat Parkir, Lopo dan Gazebo dan area Food Court', '6.00', 100);

-- --------------------------------------------------------

--
-- Table structure for table `kecocokan_alt_kriteria`
--

CREATE TABLE `kecocokan_alt_kriteria` (
  `id_alt_kriteria` int(11) NOT NULL,
  `f_id_alternatif` int(5) NOT NULL,
  `f_id_kriteria` char(2) NOT NULL,
  `f_id_sub_kriteria` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kecocokan_alt_kriteria`
--

INSERT INTO `kecocokan_alt_kriteria` (`id_alt_kriteria`, `f_id_alternatif`, `f_id_kriteria`, `f_id_sub_kriteria`) VALUES
(1, 3, 'C1', 4),
(2, 3, 'C2', 8),
(3, 3, 'C3', 14),
(4, 3, 'C4', 19),
(6, 4, 'C1', 4),
(7, 4, 'C2', 7),
(8, 4, 'C3', 13),
(9, 4, 'C4', 16),
(11, 5, 'C1', 4),
(12, 5, 'C2', 9),
(13, 5, 'C3', 14),
(14, 5, 'C4', 19),
(16, 6, 'C1', 4),
(17, 6, 'C2', 6),
(18, 6, 'C3', 14),
(19, 6, 'C4', 19),
(21, 7, 'C1', 4),
(22, 7, 'C2', 10),
(23, 7, 'C3', 14),
(24, 7, 'C4', 19),
(26, 8, 'C1', 4),
(27, 8, 'C2', 7),
(28, 8, 'C3', 15),
(29, 8, 'C4', 17),
(31, 9, 'C1', 4),
(32, 9, 'C2', 6),
(33, 9, 'C3', 14),
(34, 9, 'C4', 19),
(36, 10, 'C1', 4),
(37, 10, 'C2', 9),
(38, 10, 'C3', 14),
(39, 10, 'C4', 19),
(46, 2, 'C1', 4),
(47, 2, 'C2', 7),
(48, 2, 'C3', 14),
(49, 2, 'C4', 19),
(80, 19, 'C1', 4),
(81, 19, 'C2', 6),
(82, 19, 'C3', 14),
(83, 19, 'C4', 19),
(84, 20, 'C1', 4),
(85, 20, 'C2', 8),
(86, 20, 'C3', 14),
(87, 20, 'C4', 19),
(88, 21, 'C1', 4),
(89, 21, 'C2', 9),
(90, 21, 'C3', 14),
(91, 21, 'C4', 19),
(92, 22, 'C1', 4),
(93, 22, 'C2', 6),
(94, 22, 'C3', 14),
(95, 22, 'C4', 19),
(96, 23, 'C1', 4),
(97, 23, 'C2', 6),
(98, 23, 'C3', 14),
(99, 23, 'C4', 19),
(100, 24, 'C1', 4),
(101, 24, 'C2', 10),
(102, 24, 'C3', 14),
(103, 24, 'C4', 19),
(104, 25, 'C1', 4),
(105, 25, 'C2', 7),
(106, 25, 'C3', 14),
(107, 25, 'C4', 19),
(108, 26, 'C1', 4),
(109, 26, 'C2', 10),
(110, 26, 'C3', 14),
(111, 26, 'C4', 19),
(112, 27, 'C1', 4),
(113, 27, 'C2', 10),
(114, 27, 'C3', 14),
(115, 27, 'C4', 19),
(116, 28, 'C1', 4),
(117, 28, 'C2', 7),
(118, 28, 'C3', 14),
(119, 28, 'C4', 19),
(120, 29, 'C1', 4),
(121, 29, 'C2', 9),
(122, 29, 'C3', 14),
(123, 29, 'C4', 19),
(124, 30, 'C1', 4),
(125, 30, 'C2', 10),
(126, 30, 'C3', 14),
(127, 30, 'C4', 19),
(128, 31, 'C1', 4),
(129, 31, 'C2', 9),
(130, 31, 'C3', 14),
(131, 31, 'C4', 19),
(134, 33, 'C1', 4),
(135, 33, 'C2', 10),
(136, 33, 'C3', 14),
(137, 33, 'C4', 19),
(138, 34, 'C1', 4),
(139, 34, 'C2', 10),
(140, 34, 'C3', 14),
(141, 34, 'C4', 19),
(142, 35, 'C1', 4);

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` char(2) NOT NULL,
  `nama_kriteria` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `nama_kriteria`) VALUES
('C1', 'Biaya masuk'),
('C2', 'Fasilitas'),
('C3', 'Jarak dari pusat kota'),
('C4', 'Jumlah pengunjung');

-- --------------------------------------------------------

--
-- Table structure for table `login_user`
--

CREATE TABLE `login_user` (
  `id_login` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login_user`
--

INSERT INTO `login_user` (`id_login`, `username`, `password`, `level`) VALUES
(1, 'admin', '$2y$10$o9rw1S2HbWQolaKF3XKDdeu2B4fsebEq35Ca0KTwmytsi3tud1HCC', 0);

-- --------------------------------------------------------

--
-- Table structure for table `sub_kriteria`
--

CREATE TABLE `sub_kriteria` (
  `id_sub_kriteria` int(5) NOT NULL,
  `nama_sub_kriteria` varchar(25) NOT NULL,
  `spesifikasi` text NOT NULL,
  `bobot_sub_kriteria` int(5) NOT NULL,
  `f_id_kriteria` char(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sub_kriteria`
--

INSERT INTO `sub_kriteria` (`id_sub_kriteria`, `nama_sub_kriteria`, `spesifikasi`, `bobot_sub_kriteria`, `f_id_kriteria`) VALUES
(1, 'Sangat murah', 'Rp. 0 - 3.000', 5, 'C1'),
(2, 'Murah', 'Rp. &gt;3.000 - 6.000', 4, 'C1'),
(3, 'Sedang', 'Rp. &gt;6.000 - 9.000', 3, 'C1'),
(4, 'Mahal', 'Rp. &gt;9.000 - 12.000', 2, 'C1'),
(5, 'Sangat mahal', '&gt; Rp.12.000 - 15.000', 1, 'C1'),
(6, 'Sangat lengkap', 'Jika memenuhi 5 item dari fasilitas berikut ini: Kamar mandi, tempat parkir, area food court, tempat sampah, gazebo.', 5, 'C2'),
(7, 'Lengkap', 'Jika memenuhi 4 item dari fasilitas berikut ini: Kamar mandi, tempat parkir, area food court, tempat sampah, gazebo.', 4, 'C2'),
(8, 'Cukup lengkap', 'Jika memenuhi 3 item dari fasilitas berikut ini: Kamar mandi, tempat parkir, area food court, tempat sampah, gazebo. ', 3, 'C2'),
(9, 'Kurang lengkap', 'Jika memenuhi 2 item dari fasilitas berikut ini: Kamar mandi, tempat parkir, area food court, tempat sampah, gazebo.', 2, 'C2'),
(10, 'Tidak lengkap', 'Jika memenuhi 1 item dari fasilitas berikut ini: Kamar mandi, tempat parkir, area food court, tempat sampah, gazebo.', 1, 'C2'),
(11, 'Sangat dekat', '0 - 30 Km', 5, 'C3'),
(12, 'Dekat', '&gt; 30 - 60 Km', 4, 'C3'),
(13, 'Sedang', '&gt; 60 - 90 Km', 3, 'C3'),
(14, 'Jauh', '&gt; 90 - 120 Km', 2, 'C3'),
(15, 'Sangat jauh', '&gt; 120 - 150 Km', 1, 'C3'),
(16, 'Sangat banyak', '>100 Orang', 5, 'C4'),
(17, 'Banyak', '76-100 Orang', 4, 'C4'),
(18, 'Sedang', '51-75 Orang', 3, 'C4'),
(19, 'Sedikit', '26-50 Orang', 2, 'C4'),
(20, 'Sangat sedikit', '5-25 Orang', 1, 'C4');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alternatif`
--
ALTER TABLE `alternatif`
  ADD PRIMARY KEY (`id_alternatif`);

--
-- Indexes for table `kecocokan_alt_kriteria`
--
ALTER TABLE `kecocokan_alt_kriteria`
  ADD PRIMARY KEY (`id_alt_kriteria`),
  ADD KEY `f_id_alternatif` (`f_id_alternatif`),
  ADD KEY `f_id_kriteria` (`f_id_kriteria`),
  ADD KEY `f_id_sub_kriteria` (`f_id_sub_kriteria`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `login_user`
--
ALTER TABLE `login_user`
  ADD PRIMARY KEY (`id_login`);

--
-- Indexes for table `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  ADD PRIMARY KEY (`id_sub_kriteria`),
  ADD KEY `f_id_kriteria` (`f_id_kriteria`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alternatif`
--
ALTER TABLE `alternatif`
  MODIFY `id_alternatif` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `kecocokan_alt_kriteria`
--
ALTER TABLE `kecocokan_alt_kriteria`
  MODIFY `id_alt_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;

--
-- AUTO_INCREMENT for table `login_user`
--
ALTER TABLE `login_user`
  MODIFY `id_login` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  MODIFY `id_sub_kriteria` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kecocokan_alt_kriteria`
--
ALTER TABLE `kecocokan_alt_kriteria`
  ADD CONSTRAINT `kecocokan_alt_kriteria_ibfk_1` FOREIGN KEY (`f_id_sub_kriteria`) REFERENCES `sub_kriteria` (`id_sub_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kecocokan_alt_kriteria_ibfk_2` FOREIGN KEY (`f_id_kriteria`) REFERENCES `kriteria` (`id_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kecocokan_alt_kriteria_ibfk_3` FOREIGN KEY (`f_id_alternatif`) REFERENCES `alternatif` (`id_alternatif`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  ADD CONSTRAINT `sub_kriteria_ibfk_1` FOREIGN KEY (`f_id_kriteria`) REFERENCES `kriteria` (`id_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;



