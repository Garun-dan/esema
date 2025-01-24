-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql112.ezyro.com
-- Generation Time: Aug 05, 2024 at 09:58 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ezyro_36866367_app_esema`
--

-- --------------------------------------------------------

--
-- Table structure for table `esema-tna`
--

CREATE TABLE `esema-tna` (
  `id_tna` varchar(35) NOT NULL,
  `judul_tna` text NOT NULL,
  `slug` text NOT NULL,
  `id_jabfung` char(11) NOT NULL,
  `id_jenjang` char(11) NOT NULL,
  `id_rumah` char(5) NOT NULL,
  `id_instrumen` text NOT NULL,
  `id_skala` char(8) NOT NULL,
  `tgl_mulai` datetime NOT NULL,
  `tgl_selesai` datetime NOT NULL,
  `min_respon` int(11) NOT NULL,
  `tgl_create` date NOT NULL,
  `keterangan` text NOT NULL,
  `status` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `esema-tna`
--

INSERT INTO `esema-tna` (`id_tna`, `judul_tna`, `slug`, `id_jabfung`, `id_jenjang`, `id_rumah`, `id_instrumen`, `id_skala`, `tgl_mulai`, `tgl_selesai`, `min_respon`, `tgl_create`, `keterangan`, `status`) VALUES
('1jf-1-jj-1-rj-1', 'TNA Jabatan Fungsional Perawat Terampil (Rumah Jabatan: Rumah Sakit) Tahun 2024', 'tna-jabatan-fungsional-perawat-terampil-rumah-jabatan-rumah-sakit-tahun-2024', 'jf-1', 'jj-1', 'rj-1', '[\"itr-1\",\"itr-10\",\"itr-2\",\"itr-3\",\"itr-4\",\"itr-5\",\"itr-6\",\"itr-7\",\"itr-8\",\"itr-9\"]', 'skala-1', '2024-07-22 08:00:00', '2024-07-31 12:00:00', 10, '2024-07-24', '<ol>\r\n<li class=\"MsoNormal\" style=\"text-align: justify; line-height: 1.5;\"><span style=\"font-family: arial, helvetica, sans-serif;\">Bacalah setiap pertanyaan dengan seksama. Setiap pertanyaan atau pernyataan didasarkan pada kegiatan yang relevan dengan jenjang jabatan fungsional anda.</span></li>\r\n<li class=\"MsoNormal\" style=\"text-align: justify; line-height: 1.5;\"><span style=\"font-family: arial, helvetica, sans-serif;\">Tiap-tiap butir instrumen akan mengandung tiga pertanyaan yang berbeda tingkatannya. Pertama, pertimbangkan tingkat kesulitan dari kegiatan yang dimaksud. Kedua, pertimbangkan tingkat kepentingan kegiatan tersebut dalam konteks pekerjaan anda. Ketiga, tinjau tingkat keseringan atau frekuensi anda melaksanakan kegiatan tersebut.</span></li>\r\n<li class=\"MsoNormal\" style=\"text-align: justify; line-height: 1.5;\"><span style=\"font-family: arial, helvetica, sans-serif;\">Model jawaban yang digunakan adalah skala Likert dengan lima pilihan. Pilihlah angka yang paling mendekati pandangan atau pengalaman anda terhadap pernyataan tersebut. </span></li>\r\n<li class=\"MsoNormal\" style=\"text-align: justify; line-height: 1.5;\"><span style=\"font-family: arial, helvetica, sans-serif;\">Saat memilih jawaban, pastikan Anda memilih skala yang paling sesuai dengan pengalaman dan aktivitas yang Anda lakukan secara rutin. Skala tersebut dapat merujuk pada rentang pengalaman atau tingkat aktivitas anda dalam konteks pekerjaan sehari-hari.</span></li>\r\n<li class=\"MsoNormal\" style=\"text-align: justify; line-height: 1.5;\"><span style=\"font-family: arial, helvetica, sans-serif;\">Diakhir sesi, anda dapat memberikan rating berupa tingkat kepuasan serta kritik dan saran untuk perkembangan aplikasi ini kedepannya</span></li>\r\n</ol>', 'Tutup'),
('2jf-1-jj-1-rj-2', 'TNA Jabatan Fungsional Perawat Terampil (Rumah Jabatan: Puskesmas) Tahun 2024', 'tna-jabatan-fungsional-perawat-terampil-rumah-jabatan-puskesmas-tahun-2024', 'jf-1', 'jj-1', 'rj-2', '[\"itr-1\",\"itr-2\",\"itr-3\",\"itr-4\",\"itr-5\",\"itr-7\",\"itr-8\"]', 'skala-1', '2024-07-29 08:00:00', '2024-08-04 12:00:00', 7, '2024-07-24', '<ol>\r\n<li class=\"MsoNormal\" style=\"text-align: justify; line-height: 1.5;\"><span style=\"font-family: arial, helvetica, sans-serif;\">Bacalah setiap pertanyaan dengan seksama. Setiap pertanyaan atau pernyataan didasarkan pada kegiatan yang relevan dengan jenjang jabatan fungsional anda.</span></li>\r\n<li class=\"MsoNormal\" style=\"text-align: justify; line-height: 1.5;\"><span style=\"font-family: arial, helvetica, sans-serif;\">Tiap-tiap butir instrumen akan mengandung tiga pertanyaan yang berbeda tingkatannya. Pertama, pertimbangkan tingkat kesulitan dari kegiatan yang dimaksud. Kedua, pertimbangkan tingkat kepentingan kegiatan tersebut dalam konteks pekerjaan anda. Ketiga, tinjau tingkat keseringan atau frekuensi anda melaksanakan kegiatan tersebut.</span></li>\r\n<li class=\"MsoNormal\" style=\"text-align: justify; line-height: 1.5;\"><span style=\"font-family: arial, helvetica, sans-serif;\">Model jawaban yang digunakan adalah skala Likert dengan lima pilihan. Pilihlah angka yang paling mendekati pandangan atau pengalaman anda terhadap pernyataan tersebut. </span></li>\r\n<li class=\"MsoNormal\" style=\"text-align: justify; line-height: 1.5;\"><span style=\"font-family: arial, helvetica, sans-serif;\">Saat memilih jawaban, pastikan Anda memilih skala yang paling sesuai dengan pengalaman dan aktivitas yang Anda lakukan secara rutin. Skala tersebut dapat merujuk pada rentang pengalaman atau tingkat aktivitas anda dalam konteks pekerjaan sehari-hari.</span></li>\r\n<li class=\"MsoNormal\" style=\"text-align: justify; line-height: 1.5;\"><span style=\"font-family: arial, helvetica, sans-serif;\">Diakhir sesi, anda dapat memberikan rating berupa tingkat kepuasan serta kritik dan saran untuk perkembangan aplikasi ini kedepannya</span></li>\r\n</ol>', 'Tutup'),
('3jf-1-jj-1-rj-3', 'TNA Jabatan Fungsional Perawat Terampil (Rumah Jabatan: Apotek) Tahun 2024', 'tna-jabatan-fungsional-perawat-terampil-rumah-jabatan-apotek-tahun-2024', 'jf-1', 'jj-1', 'rj-3', '[\"itr-10\",\"itr-3\",\"itr-4\",\"itr-5\",\"itr-6\"]', 'skala-1', '2024-08-01 08:00:00', '2024-08-05 23:59:00', 5, '2024-07-24', '<ol>\r\n<li class=\"MsoNormal\" style=\"text-align: justify; line-height: 1.5;\"><span style=\"font-family: arial, helvetica, sans-serif;\">Bacalah setiap pertanyaan dengan seksama. Setiap pertanyaan atau pernyataan didasarkan pada kegiatan yang relevan dengan jenjang jabatan fungsional anda.</span></li>\r\n<li class=\"MsoNormal\" style=\"text-align: justify; line-height: 1.5;\"><span style=\"font-family: arial, helvetica, sans-serif;\">Tiap-tiap butir instrumen akan mengandung tiga pertanyaan yang berbeda tingkatannya. Pertama, pertimbangkan tingkat kesulitan dari kegiatan yang dimaksud. Kedua, pertimbangkan tingkat kepentingan kegiatan tersebut dalam konteks pekerjaan anda. Ketiga, tinjau tingkat keseringan atau frekuensi anda melaksanakan kegiatan tersebut.</span></li>\r\n<li class=\"MsoNormal\" style=\"text-align: justify; line-height: 1.5;\"><span style=\"font-family: arial, helvetica, sans-serif;\">Model jawaban yang digunakan adalah skala Likert dengan lima pilihan. Pilihlah angka yang paling mendekati pandangan atau pengalaman anda terhadap pernyataan tersebut. </span></li>\r\n<li class=\"MsoNormal\" style=\"text-align: justify; line-height: 1.5;\"><span style=\"font-family: arial, helvetica, sans-serif;\">Saat memilih jawaban, pastikan Anda memilih skala yang paling sesuai dengan pengalaman dan aktivitas yang Anda lakukan secara rutin. Skala tersebut dapat merujuk pada rentang pengalaman atau tingkat aktivitas anda dalam konteks pekerjaan sehari-hari.</span></li>\r\n<li class=\"MsoNormal\" style=\"text-align: justify; line-height: 1.5;\"><span style=\"font-family: arial, helvetica, sans-serif;\">Diakhir sesi, anda dapat memberikan rating berupa tingkat kepuasan serta kritik dan saran untuk perkembangan aplikasi ini kedepannya</span></li>\r\n</ol>', 'Tutup');

-- --------------------------------------------------------

--
-- Table structure for table `esema_api_responden`
--

CREATE TABLE `esema_api_responden` (
  `id_api` char(6) NOT NULL,
  `api` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `esema_api_responden`
--

INSERT INTO `esema_api_responden` (`id_api`, `api`) VALUES
('eaus-1', 'https://30044496-4918-49d7-bae7-c62f655c92e3.mock.pstmn.io/user.json?key=06225fe0');

-- --------------------------------------------------------

--
-- Table structure for table `esema_evaluasi`
--

CREATE TABLE `esema_evaluasi` (
  `id` int(11) NOT NULL,
  `nik` char(16) NOT NULL,
  `id_tna` varchar(35) NOT NULL,
  `kepuasan` int(11) NOT NULL,
  `saran` text NOT NULL,
  `kritik` text NOT NULL,
  `tgl` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `esema_evaluasi`
--

INSERT INTO `esema_evaluasi` (`id`, `nik`, `id_tna`, `kepuasan`, `saran`, `kritik`, `tgl`) VALUES
(1, '41-325-2258', '1jf-1-jj-1-rj-1', 5, 'baik', 'tidak ada', '2024-07-27'),
(2, '18-131-4492', '1jf-1-jj-1-rj-1', 5, 'baik', 'tidak ada', '2024-07-27'),
(3, '48-545-0956', '1jf-1-jj-1-rj-1', 4, 'Cukup baik', 'bisa di perkaya lagi pertanyaannya', '2024-07-27'),
(4, '20-425-1532', '1jf-1-jj-1-rj-1', 4, 'lebih dikembangkan lagi', 'masih pelru pengembangan', '2024-07-27'),
(5, '33-636-5477', '1jf-1-jj-1-rj-1', 4, 'lebih ditingkatkan lagi', 'perlu pengembangan', '2024-07-27'),
(6, '35-543-4552', '1jf-1-jj-1-rj-1', 5, 'good', 'tidak ada', '2024-07-30'),
(7, '79-960-7061', '1jf-1-jj-1-rj-1', 5, 'Sudah baik', 'harus ditingkatkan lagi', '2024-07-30'),
(8, '40-513-7108', '1jf-1-jj-1-rj-1', 4, 'ok', 'ok', '2024-07-30'),
(9, '88-350-4321', '1jf-1-jj-1-rj-1', 5, 'ok', 'no', '2024-07-30'),
(10, '30-431-7998', '1jf-1-jj-1-rj-1', 5, 'sudah baik', 'harus ditingkatkan', '2024-07-30'),
(11, '79-121-5754', '2jf-1-jj-1-rj-2', 5, 'Penggunaan  bahasa yang sederhana dan jelas, hindari jargon teknis yang mungkin tidak dipahami oleh semua responden.', 'Susun pertanyaan dalam urutan yang logis, mulai dari pertanyaan umum ke yang lebih spesifik.', '2024-07-30'),
(12, '48-461-1901', '2jf-1-jj-1-rj-2', 5, 'Baik', 'bisa di perbanyak lagi', '2024-07-31'),
(13, '10-400-7079', '2jf-1-jj-1-rj-2', 3, 'beri pengingat untuk mengisi kuesioner secara berkala, misalnya melalui notifikasi', 'agak lambat diakses', '2024-08-01'),
(14, '81-387-0251', '2jf-1-jj-1-rj-2', 5, 'lakukan sosialisasi tentang tujuan dan manfaat pengisian kuesioner', 'aplikasi tidak menyediakan fitur pengingat', '2024-08-01'),
(15, '79-802-5664', '2jf-1-jj-1-rj-2', 4, 'sudah baik', 'lebih dikembangkan lagi', '2024-08-01'),
(16, '50-704-1960', '2jf-1-jj-1-rj-2', 4, 'udah bagus', 'perlu pengembangan lagi', '2024-08-01'),
(17, '46-856-4950', '2jf-1-jj-1-rj-2', 5, 'Pastikan semua pertanyaan ditulis dengan bahasa yang mudah dipahami dan tidak membingungkan', 'Pastikan ada cukup banyak pertanyaan yang menggali kebutuhan pelatihan yang belum terpenuhi.', '2024-08-02'),
(18, '89-050-4527', '3jf-1-jj-1-rj-3', 5, 'tidak ada', 'tidak ada', '2024-08-05'),
(19, '74-079-8079', '3jf-1-jj-1-rj-3', 5, 'baik', 'tidak ada', '2024-08-05'),
(20, '59-970-7964', '3jf-1-jj-1-rj-3', 4, 'perlu peningkatan lebih lanjut', 'masih banyak hal yang dikembangkan', '2024-08-05'),
(21, '29-369-6190', '3jf-1-jj-1-rj-3', 4, 'baik', 'tidak ada', '2024-08-05'),
(22, '81-319-2028', '3jf-1-jj-1-rj-3', 5, 'Sudah baik', 'belum ada', '2024-08-05');

-- --------------------------------------------------------

--
-- Table structure for table `esema_hak_akses`
--

CREATE TABLE `esema_hak_akses` (
  `id_akses` int(11) NOT NULL,
  `id_role` varchar(11) NOT NULL,
  `id_menu` varchar(11) NOT NULL,
  `id_submenu` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `esema_hak_akses`
--

INSERT INTO `esema_hak_akses` (`id_akses`, `id_role`, `id_menu`, `id_submenu`) VALUES
(1, 'role-1', 'menu-2', ''),
(3, 'role-1', 'menu-3', 'submenu-2'),
(4, 'role-1', 'menu-4', 'submenu-3'),
(5, 'role-1', 'menu-4', 'submenu-4'),
(6, 'role-1', 'menu-4', 'submenu-5'),
(7, 'role-1', 'menu-5', 'submenu-10'),
(8, 'role-1', 'menu-5', 'submenu-6'),
(9, 'role-1', 'menu-5', 'submenu-7'),
(10, 'role-1', 'menu-5', 'submenu-8'),
(11, 'role-1', 'menu-5', 'submenu-9'),
(12, 'role-2', 'menu-2', ''),
(14, 'role-2', 'menu-3', 'submenu-2'),
(15, 'role-2', 'menu-4', 'submenu-3'),
(16, 'role-2', 'menu-4', 'submenu-4'),
(17, 'role-2', 'menu-4', 'submenu-5'),
(18, 'role-2', 'menu-5', 'submenu-6'),
(19, 'role-3', 'menu-2', ''),
(20, 'role-3', 'menu-5', 'submenu-6'),
(21, 'role-4', 'menu-3', 'submenu-1'),
(22, 'role-4', 'menu-5', 'submenu-6');

-- --------------------------------------------------------

--
-- Table structure for table `esema_instrumen`
--

CREATE TABLE `esema_instrumen` (
  `id_instrumen` char(7) NOT NULL,
  `id_jenjang` char(11) NOT NULL,
  `instrumen` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `esema_instrumen`
--

INSERT INTO `esema_instrumen` (`id_instrumen`, `id_jenjang`, `instrumen`) VALUES
('itr-1', 'jj-1', 'Melakukan pengkajian keperawatan dasar pada individu'),
('itr-10', 'jj-1', 'Melakukan fasilitasi pasien eliminasi '),
('itr-11', 'jj-2', 'Melakukan pengkajian keperawatan dasar pada keluarga'),
('itr-12', 'jj-2', 'Melakukan pengkajian keperawatan dasar pada kelompok'),
('itr-13', 'jj-2', 'Melaksanakan imunisasi pada individu'),
('itr-14', 'jj-2', 'Melakukan restrain/fiksasi pada pasien'),
('itr-15', 'jj-2', 'Oksigenasi kompleks '),
('itr-16', 'jj-2', 'Memberikan nutrisi enteral'),
('itr-17', 'jj-2', 'Memberikan nutrisi parenteral'),
('itr-18', 'jj-2', 'Manajemen mual muntah'),
('itr-19', 'jj-2', 'Melakukan bladder training'),
('itr-2', 'jj-1', 'Mengajarkan perilaku hidup bersih dan sehat pada individu'),
('itr-20', 'jj-2', 'Melakukan bladder re-training'),
('itr-21', 'jj-3', 'Mengidentifikasi kebutuhan pendidikan kesehatan'),
('itr-22', 'jj-3', 'Melaksanakan pendidikan kesehatan pada kelompok'),
('itr-23', 'jj-3', 'Membentuk dan mempertahankan keberadaan kelompok masyarakat pemerhati masalah Kesehatan'),
('itr-24', 'jj-3', 'Melakukan isolasi pasien sesuai kondisinya'),
('itr-25', 'jj-3', 'Memasang alat bantu khusus lain sesuai dengan kondisi'),
('itr-26', 'jj-3', 'Mengatur posisi pasien sesuai dengan rencana tindakan pembedahan'),
('itr-27', 'jj-3', 'Mengatur posisi netral kepala, leher, tulang punggung, untuk meminimalisasi gangguan neurologis'),
('itr-28', 'jj-3', 'Memfasilitasi lingkungan dengan suhu yang sesuai dengan kebutuhan'),
('itr-29', 'jj-3', 'Melakukan isolasi pasien imunosupresi'),
('itr-3', 'jj-1', 'Membuat media untuk peningkatan perilaku hidup bersih dan sehat pada individu'),
('itr-30', 'jj-3', 'Memberikan pertolongan kesehatan dalam situasi gawat darurat/bencana'),
('itr-4', 'jj-1', 'Memfasilitasi penggunaan alat-alat pengamanan atau pelindung fisik pada pasien untuk mencegah risiko cidera pada individu'),
('itr-5', 'jj-1', 'Memantau perkembangan pasien sesuai dengan kondisinya (melakukan pemeriksaan fisik, mengamati keadaan pasien) pada individu'),
('itr-6', 'jj-1', 'Memfasilitasi penggunaan pelindung diri pada kelompok '),
('itr-7', 'jj-1', 'Memberikan oksigenasi sederhana'),
('itr-8', 'jj-1', 'Memberikan bantuan hidup dasar'),
('itr-9', 'jj-1', 'Melakukan pengukuran antropometri');

-- --------------------------------------------------------

--
-- Table structure for table `esema_jabfung`
--

CREATE TABLE `esema_jabfung` (
  `id_jabfung` char(11) NOT NULL,
  `nama_jabfung` varchar(64) NOT NULL,
  `slug_jabfung` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `esema_jabfung`
--

INSERT INTO `esema_jabfung` (`id_jabfung`, `nama_jabfung`, `slug_jabfung`) VALUES
('jf-1', 'Perawat', 'perawat');

-- --------------------------------------------------------

--
-- Table structure for table `esema_jenjang`
--

CREATE TABLE `esema_jenjang` (
  `id_jenjang` char(11) NOT NULL,
  `id_jabfung` char(11) NOT NULL,
  `nama_jenjang` varchar(16) NOT NULL,
  `slug_jenjang` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `esema_jenjang`
--

INSERT INTO `esema_jenjang` (`id_jenjang`, `id_jabfung`, `nama_jenjang`, `slug_jenjang`) VALUES
('jj-1', 'jf-1', 'Terampil', 'terampil'),
('jj-2', 'jf-1', 'Mahir', 'mahir'),
('jj-3', 'jf-1', 'Penyelia', 'penyelia');

-- --------------------------------------------------------

--
-- Table structure for table `esema_kuesioner`
--

CREATE TABLE `esema_kuesioner` (
  `id_hasil` int(11) NOT NULL,
  `nik` char(16) NOT NULL,
  `id_tna` varchar(35) NOT NULL,
  `id_soal` char(10) NOT NULL,
  `jwb_d` varchar(11) NOT NULL,
  `jwb_i` varchar(11) NOT NULL,
  `jwb_f` varchar(11) NOT NULL,
  `total` varchar(11) NOT NULL,
  `rekom` char(24) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `esema_kuesioner`
--

INSERT INTO `esema_kuesioner` (`id_hasil`, `nik`, `id_tna`, `id_soal`, `jwb_d`, `jwb_i`, `jwb_f`, `total`, `rekom`) VALUES
(1, '41-325-2258', '1jf-1-jj-1-rj-1', 'soal-1', '1', '5', '5', '3.666666666', 'Membutuhkan'),
(2, '41-325-2258', '1jf-1-jj-1-rj-1', 'soal-10', '4', '4', '3', '3.666666666', 'Membutuhkan'),
(3, '41-325-2258', '1jf-1-jj-1-rj-1', 'soal-2', '4', '4', '2', '3.333333333', 'Optional'),
(4, '41-325-2258', '1jf-1-jj-1-rj-1', 'soal-3', '1', '2', '2', '1.666666666', 'Optional'),
(5, '41-325-2258', '1jf-1-jj-1-rj-1', 'soal-4', '5', '4', '3', '4', 'Membutuhkan'),
(6, '41-325-2258', '1jf-1-jj-1-rj-1', 'soal-5', '3', '5', '3', '3.666666666', 'Membutuhkan'),
(7, '41-325-2258', '1jf-1-jj-1-rj-1', 'soal-6', '1', '5', '5', '3.666666666', 'Membutuhkan'),
(8, '41-325-2258', '1jf-1-jj-1-rj-1', 'soal-7', '1', '2', '1', '1.333333333', 'Kompeten'),
(9, '41-325-2258', '1jf-1-jj-1-rj-1', 'soal-8', '1', '5', '4', '3.333333333', 'Optional'),
(10, '41-325-2258', '1jf-1-jj-1-rj-1', 'soal-9', '1', '1', '1', '1', 'Kompeten'),
(11, '18-131-4492', '1jf-1-jj-1-rj-1', 'soal-1', '1', '5', '5', '3.666666666', 'Membutuhkan'),
(12, '18-131-4492', '1jf-1-jj-1-rj-1', 'soal-10', '4', '4', '2', '3.333333333', 'Optional'),
(13, '18-131-4492', '1jf-1-jj-1-rj-1', 'soal-2', '1', '3', '2', '2', 'Optional'),
(14, '18-131-4492', '1jf-1-jj-1-rj-1', 'soal-3', '1', '1', '1', '1', 'Kompeten'),
(15, '18-131-4492', '1jf-1-jj-1-rj-1', 'soal-4', '1', '2', '2', '1.666666666', 'Optional'),
(16, '18-131-4492', '1jf-1-jj-1-rj-1', 'soal-5', '4', '5', '3', '4', 'Membutuhkan'),
(17, '18-131-4492', '1jf-1-jj-1-rj-1', 'soal-6', '3', '4', '3', '3.333333333', 'Optional'),
(18, '18-131-4492', '1jf-1-jj-1-rj-1', 'soal-7', '1', '1', '1', '1', 'Kompeten'),
(19, '18-131-4492', '1jf-1-jj-1-rj-1', 'soal-8', '2', '5', '3', '3.333333333', 'Optional'),
(20, '18-131-4492', '1jf-1-jj-1-rj-1', 'soal-9', '1', '3', '2', '2', 'Optional'),
(21, '48-545-0956', '1jf-1-jj-1-rj-1', 'soal-1', '1', '4', '1', '2', 'Optional'),
(22, '48-545-0956', '1jf-1-jj-1-rj-1', 'soal-10', '4', '5', '3', '4', 'Membutuhkan'),
(23, '48-545-0956', '1jf-1-jj-1-rj-1', 'soal-2', '3', '5', '2', '3.333333333', 'Optional'),
(24, '48-545-0956', '1jf-1-jj-1-rj-1', 'soal-3', '1', '2', '1', '1.333333333', 'Kompeten'),
(25, '48-545-0956', '1jf-1-jj-1-rj-1', 'soal-4', '4', '1', '1', '2', 'Optional'),
(26, '48-545-0956', '1jf-1-jj-1-rj-1', 'soal-5', '5', '5', '5', '5', 'Sangat Membutuhkan'),
(27, '48-545-0956', '1jf-1-jj-1-rj-1', 'soal-6', '3', '3', '2', '2.666666666', 'Optional'),
(28, '48-545-0956', '1jf-1-jj-1-rj-1', 'soal-7', '1', '2', '1', '1.333333333', 'Kompeten'),
(29, '48-545-0956', '1jf-1-jj-1-rj-1', 'soal-8', '3', '5', '2', '3.333333333', 'Optional'),
(30, '48-545-0956', '1jf-1-jj-1-rj-1', 'soal-9', '1', '1', '1', '1', 'Kompeten'),
(31, '20-425-1532', '1jf-1-jj-1-rj-1', 'soal-1', '3', '5', '3', '3.666666666', 'Membutuhkan'),
(32, '20-425-1532', '1jf-1-jj-1-rj-1', 'soal-10', '3', '4', '4', '3.666666666', 'Membutuhkan'),
(33, '20-425-1532', '1jf-1-jj-1-rj-1', 'soal-2', '4', '4', '4', '4', 'Membutuhkan'),
(34, '20-425-1532', '1jf-1-jj-1-rj-1', 'soal-3', '4', '5', '5', '4.666666666', 'Sangat Membutuhkan'),
(35, '20-425-1532', '1jf-1-jj-1-rj-1', 'soal-4', '3', '4', '5', '4', 'Membutuhkan'),
(36, '20-425-1532', '1jf-1-jj-1-rj-1', 'soal-5', '4', '5', '5', '4.666666666', 'Sangat Membutuhkan'),
(37, '20-425-1532', '1jf-1-jj-1-rj-1', 'soal-6', '5', '5', '5', '5', 'Sangat Membutuhkan'),
(38, '20-425-1532', '1jf-1-jj-1-rj-1', 'soal-7', '5', '5', '5', '5', 'Sangat Membutuhkan'),
(39, '20-425-1532', '1jf-1-jj-1-rj-1', 'soal-8', '2', '5', '4', '3.666666666', 'Membutuhkan'),
(40, '20-425-1532', '1jf-1-jj-1-rj-1', 'soal-9', '3', '4', '4', '3.666666666', 'Membutuhkan'),
(41, '33-636-5477', '1jf-1-jj-1-rj-1', 'soal-1', '4', '5', '4', '4.333333333', 'Sangat Membutuhkan'),
(42, '33-636-5477', '1jf-1-jj-1-rj-1', 'soal-10', '4', '4', '3', '3.666666666', 'Membutuhkan'),
(43, '33-636-5477', '1jf-1-jj-1-rj-1', 'soal-2', '4', '5', '5', '4.666666666', 'Sangat Membutuhkan'),
(44, '33-636-5477', '1jf-1-jj-1-rj-1', 'soal-3', '4', '5', '5', '4.666666666', 'Sangat Membutuhkan'),
(45, '33-636-5477', '1jf-1-jj-1-rj-1', 'soal-4', '4', '5', '5', '4.666666666', 'Sangat Membutuhkan'),
(46, '33-636-5477', '1jf-1-jj-1-rj-1', 'soal-5', '5', '5', '5', '5', 'Sangat Membutuhkan'),
(47, '33-636-5477', '1jf-1-jj-1-rj-1', 'soal-6', '4', '5', '5', '4.666666666', 'Sangat Membutuhkan'),
(48, '33-636-5477', '1jf-1-jj-1-rj-1', 'soal-7', '4', '5', '5', '4.666666666', 'Sangat Membutuhkan'),
(49, '33-636-5477', '1jf-1-jj-1-rj-1', 'soal-8', '4', '5', '5', '4.666666666', 'Sangat Membutuhkan'),
(50, '33-636-5477', '1jf-1-jj-1-rj-1', 'soal-9', '4', '5', '5', '4.666666666', 'Sangat Membutuhkan'),
(51, '35-543-4552', '1jf-1-jj-1-rj-1', 'soal-1', '1', '5', '2', '2.666666666', 'Optional'),
(52, '35-543-4552', '1jf-1-jj-1-rj-1', 'soal-10', '3', '3', '3', '3', 'Optional'),
(53, '35-543-4552', '1jf-1-jj-1-rj-1', 'soal-2', '3', '3', '3', '3', 'Optional'),
(54, '35-543-4552', '1jf-1-jj-1-rj-1', 'soal-3', '3', '3', '3', '3', 'Optional'),
(55, '35-543-4552', '1jf-1-jj-1-rj-1', 'soal-4', '3', '3', '3', '3', 'Optional'),
(56, '35-543-4552', '1jf-1-jj-1-rj-1', 'soal-5', '3', '3', '3', '3', 'Optional'),
(57, '35-543-4552', '1jf-1-jj-1-rj-1', 'soal-6', '3', '3', '3', '3', 'Optional'),
(58, '35-543-4552', '1jf-1-jj-1-rj-1', 'soal-7', '3', '3', '2', '2.666666666', 'Optional'),
(59, '35-543-4552', '1jf-1-jj-1-rj-1', 'soal-8', '2', '3', '3', '2.666666666', 'Optional'),
(60, '35-543-4552', '1jf-1-jj-1-rj-1', 'soal-9', '1', '1', '1', '1', 'Kompeten'),
(61, '79-960-7061', '1jf-1-jj-1-rj-1', 'soal-1', '1', '1', '1', '1', 'Kompeten'),
(62, '79-960-7061', '1jf-1-jj-1-rj-1', 'soal-10', '1', '1', '1', '1', 'Kompeten'),
(63, '79-960-7061', '1jf-1-jj-1-rj-1', 'soal-2', '1', '1', '1', '1', 'Kompeten'),
(64, '79-960-7061', '1jf-1-jj-1-rj-1', 'soal-3', '1', '1', '1', '1', 'Kompeten'),
(65, '79-960-7061', '1jf-1-jj-1-rj-1', 'soal-4', '1', '1', '1', '1', 'Kompeten'),
(66, '79-960-7061', '1jf-1-jj-1-rj-1', 'soal-5', '5', '5', '1', '3.666666666', 'Membutuhkan'),
(67, '79-960-7061', '1jf-1-jj-1-rj-1', 'soal-6', '1', '1', '1', '1', 'Kompeten'),
(68, '79-960-7061', '1jf-1-jj-1-rj-1', 'soal-7', '1', '1', '1', '1', 'Kompeten'),
(69, '79-960-7061', '1jf-1-jj-1-rj-1', 'soal-8', '4', '5', '3', '4', 'Membutuhkan'),
(70, '79-960-7061', '1jf-1-jj-1-rj-1', 'soal-9', '1', '1', '1', '1', 'Kompeten'),
(71, '40-513-7108', '1jf-1-jj-1-rj-1', 'soal-1', '1', '1', '1', '1', 'Kompeten'),
(72, '40-513-7108', '1jf-1-jj-1-rj-1', 'soal-10', '1', '1', '1', '1', 'Kompeten'),
(73, '40-513-7108', '1jf-1-jj-1-rj-1', 'soal-2', '1', '1', '1', '1', 'Kompeten'),
(74, '40-513-7108', '1jf-1-jj-1-rj-1', 'soal-3', '1', '1', '1', '1', 'Kompeten'),
(75, '40-513-7108', '1jf-1-jj-1-rj-1', 'soal-4', '5', '5', '5', '5', 'Sangat Membutuhkan'),
(76, '40-513-7108', '1jf-1-jj-1-rj-1', 'soal-5', '4', '5', '3', '4', 'Membutuhkan'),
(77, '40-513-7108', '1jf-1-jj-1-rj-1', 'soal-6', '1', '1', '1', '1', 'Kompeten'),
(78, '40-513-7108', '1jf-1-jj-1-rj-1', 'soal-7', '1', '1', '1', '1', 'Kompeten'),
(79, '40-513-7108', '1jf-1-jj-1-rj-1', 'soal-8', '4', '4', '2', '3.333333333', 'Optional'),
(80, '40-513-7108', '1jf-1-jj-1-rj-1', 'soal-9', '1', '1', '1', '1', 'Kompeten'),
(81, '88-350-4321', '1jf-1-jj-1-rj-1', 'soal-1', '2', '5', '5', '4', 'Membutuhkan'),
(82, '88-350-4321', '1jf-1-jj-1-rj-1', 'soal-10', '4', '4', '1', '3', 'Optional'),
(83, '88-350-4321', '1jf-1-jj-1-rj-1', 'soal-2', '1', '2', '1', '1.333333333', 'Kompeten'),
(84, '88-350-4321', '1jf-1-jj-1-rj-1', 'soal-3', '1', '2', '1', '1.333333333', 'Kompeten'),
(85, '88-350-4321', '1jf-1-jj-1-rj-1', 'soal-4', '2', '2', '2', '2', 'Optional'),
(86, '88-350-4321', '1jf-1-jj-1-rj-1', 'soal-5', '3', '5', '5', '4.333333333', 'Sangat Membutuhkan'),
(87, '88-350-4321', '1jf-1-jj-1-rj-1', 'soal-6', '2', '5', '5', '4', 'Membutuhkan'),
(88, '88-350-4321', '1jf-1-jj-1-rj-1', 'soal-7', '1', '2', '3', '2', 'Optional'),
(89, '88-350-4321', '1jf-1-jj-1-rj-1', 'soal-8', '3', '5', '3', '3.666666666', 'Membutuhkan'),
(90, '88-350-4321', '1jf-1-jj-1-rj-1', 'soal-9', '1', '1', '1', '1', 'Kompeten'),
(91, '30-431-7998', '1jf-1-jj-1-rj-1', 'soal-1', '2', '4', '4', '3.333333333', 'Optional'),
(92, '30-431-7998', '1jf-1-jj-1-rj-1', 'soal-10', '3', '4', '3', '3.333333333', 'Optional'),
(93, '30-431-7998', '1jf-1-jj-1-rj-1', 'soal-2', '2', '2', '3', '2.333333333', 'Optional'),
(94, '30-431-7998', '1jf-1-jj-1-rj-1', 'soal-3', '1', '2', '2', '1.666666666', 'Optional'),
(95, '30-431-7998', '1jf-1-jj-1-rj-1', 'soal-4', '1', '1', '1', '1', 'Kompeten'),
(96, '30-431-7998', '1jf-1-jj-1-rj-1', 'soal-5', '5', '5', '1', '3.666666666', 'Membutuhkan'),
(97, '30-431-7998', '1jf-1-jj-1-rj-1', 'soal-6', '2', '4', '4', '3.333333333', 'Optional'),
(98, '30-431-7998', '1jf-1-jj-1-rj-1', 'soal-7', '1', '2', '1', '1.333333333', 'Kompeten'),
(99, '30-431-7998', '1jf-1-jj-1-rj-1', 'soal-8', '4', '4', '5', '4.333333333', 'Sangat Membutuhkan'),
(100, '30-431-7998', '1jf-1-jj-1-rj-1', 'soal-9', '1', '1', '1', '1', 'Kompeten'),
(101, '79-121-5754', '2jf-1-jj-1-rj-2', 'soal-11', '4', '4', '4', '4', 'Membutuhkan'),
(102, '79-121-5754', '2jf-1-jj-1-rj-2', 'soal-12', '4', '4', '4', '4', 'Membutuhkan'),
(103, '79-121-5754', '2jf-1-jj-1-rj-2', 'soal-13', '4', '4', '4', '4', 'Membutuhkan'),
(104, '79-121-5754', '2jf-1-jj-1-rj-2', 'soal-14', '4', '4', '4', '4', 'Membutuhkan'),
(105, '79-121-5754', '2jf-1-jj-1-rj-2', 'soal-15', '4', '4', '4', '4', 'Membutuhkan'),
(106, '79-121-5754', '2jf-1-jj-1-rj-2', 'soal-16', '4', '4', '4', '4', 'Membutuhkan'),
(107, '79-121-5754', '2jf-1-jj-1-rj-2', 'soal-17', '4', '4', '4', '4', 'Membutuhkan'),
(108, '48-461-1901', '2jf-1-jj-1-rj-2', 'soal-11', '1', '5', '2', '2.666666666', 'Optional'),
(109, '48-461-1901', '2jf-1-jj-1-rj-2', 'soal-12', '1', '2', '1', '1.333333333', 'Kompeten'),
(110, '48-461-1901', '2jf-1-jj-1-rj-2', 'soal-13', '1', '2', '1', '1.333333333', 'Kompeten'),
(111, '48-461-1901', '2jf-1-jj-1-rj-2', 'soal-14', '4', '5', '3', '4', 'Membutuhkan'),
(112, '48-461-1901', '2jf-1-jj-1-rj-2', 'soal-15', '3', '5', '3', '3.666666666', 'Membutuhkan'),
(113, '48-461-1901', '2jf-1-jj-1-rj-2', 'soal-16', '3', '5', '3', '3.666666666', 'Membutuhkan'),
(114, '48-461-1901', '2jf-1-jj-1-rj-2', 'soal-17', '2', '2', '1', '1.666666666', 'Optional'),
(115, '10-400-7079', '2jf-1-jj-1-rj-2', 'soal-11', '3', '4', '4', '3.666666666', 'Membutuhkan'),
(116, '10-400-7079', '2jf-1-jj-1-rj-2', 'soal-12', '4', '5', '3', '4', 'Membutuhkan'),
(117, '10-400-7079', '2jf-1-jj-1-rj-2', 'soal-13', '2', '4', '2', '2.666666666', 'Optional'),
(118, '10-400-7079', '2jf-1-jj-1-rj-2', 'soal-14', '3', '5', '4', '4', 'Membutuhkan'),
(119, '10-400-7079', '2jf-1-jj-1-rj-2', 'soal-15', '2', '5', '4', '3.666666666', 'Membutuhkan'),
(120, '10-400-7079', '2jf-1-jj-1-rj-2', 'soal-16', '2', '4', '3', '3', 'Optional'),
(121, '10-400-7079', '2jf-1-jj-1-rj-2', 'soal-17', '2', '4', '4', '3.333333333', 'Optional'),
(122, '81-387-0251', '2jf-1-jj-1-rj-2', 'soal-11', '3', '4', '2', '3', 'Optional'),
(123, '81-387-0251', '2jf-1-jj-1-rj-2', 'soal-12', '4', '5', '5', '4.666666666', 'Sangat Membutuhkan'),
(124, '81-387-0251', '2jf-1-jj-1-rj-2', 'soal-13', '3', '5', '4', '4', 'Membutuhkan'),
(125, '81-387-0251', '2jf-1-jj-1-rj-2', 'soal-14', '2', '4', '5', '3.666666666', 'Membutuhkan'),
(126, '81-387-0251', '2jf-1-jj-1-rj-2', 'soal-15', '3', '4', '3', '3.333333333', 'Optional'),
(127, '81-387-0251', '2jf-1-jj-1-rj-2', 'soal-16', '1', '4', '1', '2', 'Optional'),
(128, '81-387-0251', '2jf-1-jj-1-rj-2', 'soal-17', '2', '4', '4', '3.333333333', 'Optional'),
(129, '79-802-5664', '2jf-1-jj-1-rj-2', 'soal-11', '4', '5', '5', '4.666666666', 'Sangat Membutuhkan'),
(130, '79-802-5664', '2jf-1-jj-1-rj-2', 'soal-12', '2', '5', '5', '4', 'Membutuhkan'),
(131, '79-802-5664', '2jf-1-jj-1-rj-2', 'soal-13', '2', '5', '5', '4', 'Membutuhkan'),
(132, '79-802-5664', '2jf-1-jj-1-rj-2', 'soal-14', '3', '4', '3', '3.333333333', 'Optional'),
(133, '79-802-5664', '2jf-1-jj-1-rj-2', 'soal-15', '3', '5', '5', '4.333333333', 'Sangat Membutuhkan'),
(134, '79-802-5664', '2jf-1-jj-1-rj-2', 'soal-16', '3', '4', '3', '3.333333333', 'Optional'),
(135, '79-802-5664', '2jf-1-jj-1-rj-2', 'soal-17', '4', '5', '3', '4', 'Membutuhkan'),
(136, '50-704-1960', '2jf-1-jj-1-rj-2', 'soal-11', '4', '5', '5', '4.666666666', 'Sangat Membutuhkan'),
(137, '50-704-1960', '2jf-1-jj-1-rj-2', 'soal-12', '3', '5', '5', '4.333333333', 'Sangat Membutuhkan'),
(138, '50-704-1960', '2jf-1-jj-1-rj-2', 'soal-13', '4', '5', '4', '4.333333333', 'Sangat Membutuhkan'),
(139, '50-704-1960', '2jf-1-jj-1-rj-2', 'soal-14', '5', '5', '3', '4.333333333', 'Sangat Membutuhkan'),
(140, '50-704-1960', '2jf-1-jj-1-rj-2', 'soal-15', '3', '5', '5', '4.333333333', 'Sangat Membutuhkan'),
(141, '50-704-1960', '2jf-1-jj-1-rj-2', 'soal-16', '3', '5', '3', '3.666666666', 'Membutuhkan'),
(142, '50-704-1960', '2jf-1-jj-1-rj-2', 'soal-17', '3', '5', '3', '3.666666666', 'Membutuhkan'),
(143, '46-856-4950', '2jf-1-jj-1-rj-2', 'soal-11', '4', '4', '4', '4', 'Membutuhkan'),
(144, '46-856-4950', '2jf-1-jj-1-rj-2', 'soal-12', '4', '4', '4', '4', 'Membutuhkan'),
(145, '46-856-4950', '2jf-1-jj-1-rj-2', 'soal-13', '4', '4', '4', '4', 'Membutuhkan'),
(146, '46-856-4950', '2jf-1-jj-1-rj-2', 'soal-14', '4', '4', '4', '4', 'Membutuhkan'),
(147, '46-856-4950', '2jf-1-jj-1-rj-2', 'soal-15', '4', '4', '4', '4', 'Membutuhkan'),
(148, '46-856-4950', '2jf-1-jj-1-rj-2', 'soal-16', '4', '4', '4', '4', 'Membutuhkan'),
(149, '46-856-4950', '2jf-1-jj-1-rj-2', 'soal-17', '4', '4', '4', '4', 'Membutuhkan'),
(150, '89-050-4527', '3jf-1-jj-1-rj-3', 'soal-18', '4', '5', '3', '4', 'Membutuhkan'),
(151, '89-050-4527', '3jf-1-jj-1-rj-3', 'soal-19', '1', '2', '2', '1.666666666', 'Optional'),
(152, '89-050-4527', '3jf-1-jj-1-rj-3', 'soal-20', '4', '5', '3', '4', 'Membutuhkan'),
(153, '89-050-4527', '3jf-1-jj-1-rj-3', 'soal-21', '4', '5', '4', '4.333333333', 'Sangat Membutuhkan'),
(154, '89-050-4527', '3jf-1-jj-1-rj-3', 'soal-22', '2', '3', '3', '2.666666666', 'Optional'),
(155, '74-079-8079', '3jf-1-jj-1-rj-3', 'soal-18', '3', '3', '3', '3', 'Optional'),
(156, '74-079-8079', '3jf-1-jj-1-rj-3', 'soal-19', '3', '3', '3', '3', 'Optional'),
(157, '74-079-8079', '3jf-1-jj-1-rj-3', 'soal-20', '3', '3', '3', '3', 'Optional'),
(158, '74-079-8079', '3jf-1-jj-1-rj-3', 'soal-21', '3', '5', '5', '4.333333333', 'Sangat Membutuhkan'),
(159, '74-079-8079', '3jf-1-jj-1-rj-3', 'soal-22', '2', '5', '3', '3.333333333', 'Optional'),
(160, '59-970-7964', '3jf-1-jj-1-rj-3', 'soal-18', '3', '3', '3', '3', 'Optional'),
(161, '59-970-7964', '3jf-1-jj-1-rj-3', 'soal-19', '5', '3', '4', '4', 'Membutuhkan'),
(162, '59-970-7964', '3jf-1-jj-1-rj-3', 'soal-20', '3', '3', '4', '3.333333333', 'Optional'),
(163, '59-970-7964', '3jf-1-jj-1-rj-3', 'soal-21', '3', '4', '4', '3.666666666', 'Membutuhkan'),
(164, '59-970-7964', '3jf-1-jj-1-rj-3', 'soal-22', '1', '2', '3', '2', 'Optional'),
(165, '29-369-6190', '3jf-1-jj-1-rj-3', 'soal-18', '5', '5', '2', '4', 'Membutuhkan'),
(166, '29-369-6190', '3jf-1-jj-1-rj-3', 'soal-19', '2', '3', '4', '3', 'Optional'),
(167, '29-369-6190', '3jf-1-jj-1-rj-3', 'soal-20', '3', '5', '3', '3.666666666', 'Membutuhkan'),
(168, '29-369-6190', '3jf-1-jj-1-rj-3', 'soal-21', '5', '4', '4', '4.333333333', 'Sangat Membutuhkan'),
(169, '29-369-6190', '3jf-1-jj-1-rj-3', 'soal-22', '4', '5', '5', '4.666666666', 'Sangat Membutuhkan'),
(170, '81-319-2028', '3jf-1-jj-1-rj-3', 'soal-18', '3', '3', '3', '3', 'Optional'),
(171, '81-319-2028', '3jf-1-jj-1-rj-3', 'soal-19', '1', '1', '1', '1', 'Kompeten'),
(172, '81-319-2028', '3jf-1-jj-1-rj-3', 'soal-20', '4', '4', '3', '3.666666666', 'Membutuhkan'),
(173, '81-319-2028', '3jf-1-jj-1-rj-3', 'soal-21', '4', '5', '3', '4', 'Membutuhkan'),
(174, '81-319-2028', '3jf-1-jj-1-rj-3', 'soal-22', '4', '5', '5', '4.666666666', 'Sangat Membutuhkan');

-- --------------------------------------------------------

--
-- Table structure for table `esema_maintenance`
--

CREATE TABLE `esema_maintenance` (
  `id_maintenance` varchar(11) NOT NULL,
  `nama_website` longtext NOT NULL,
  `slogan_website` longtext NOT NULL,
  `instansi` longtext NOT NULL,
  `logo` varchar(128) NOT NULL,
  `favicon` varchar(128) NOT NULL,
  `api_otp` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `esema_maintenance`
--

INSERT INTO `esema_maintenance` (`id_maintenance`, `nama_website`, `slogan_website`, `instansi`, `logo`, `favicon`, `api_otp`) VALUES
('mainten-1', 'esema', 'Elektronik Assessment Management', 'Direktorat Peningkatan Mutu Tenaga Kesehatan', 'esema.svg', 'fav-esema.svg', 'aknQzS2#y8Yx-#9+U68F');

-- --------------------------------------------------------

--
-- Table structure for table `esema_menu`
--

CREATE TABLE `esema_menu` (
  `id_menu` varchar(11) NOT NULL,
  `nama_menu` longtext NOT NULL,
  `slug_menu` longtext NOT NULL,
  `icon_menu` varchar(128) NOT NULL,
  `posisi_menu` varchar(11) NOT NULL,
  `is_active` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `esema_menu`
--

INSERT INTO `esema_menu` (`id_menu`, `nama_menu`, `slug_menu`, `icon_menu`, `posisi_menu`, `is_active`) VALUES
('menu-1', 'Home', 'home', 'house-fill', 'home', 'Aktif'),
('menu-2', 'Dashboard', 'dashboard', 'grid-1x2-fill', 'admin', 'Aktif'),
('menu-3', 'TNA', 'tna', 'folder-fill', 'admin', 'Aktif'),
('menu-4', 'Master Data', 'master-data', 'database-fill', 'admin', 'Aktif'),
('menu-5', 'Settings', 'settings', 'gear-wide-connected', 'admin', 'Aktif'),
('menu-6', 'Pedoman', 'pedoman', 'bookmarks-fill', 'home', 'Aktif'),
('menu-7', 'About Us', 'about-us', 'person-lines-fill', 'home', 'Aktif'),
('menu-8', 'Sambutan', 'sambutan', 'person-rolodex', 'home', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `esema_pangkat`
--

CREATE TABLE `esema_pangkat` (
  `id_pangkat` int(11) NOT NULL,
  `pangkat` longtext NOT NULL,
  `golongan` varchar(16) NOT NULL,
  `slug_pangkat` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `esema_pangkat`
--

INSERT INTO `esema_pangkat` (`id_pangkat`, `pangkat`, `golongan`, `slug_pangkat`) VALUES
(1, 'Pengatur Muda', 'II/a', 'pengatur-muda'),
(2, 'Pengatur Muda Tk.I', 'II/b', 'pengatur-muda-tki'),
(3, 'Pengatur', 'II/c', 'pengatur'),
(4, 'Pengatur Tk.I', 'II/d', 'pengatur-tki'),
(5, 'Penata Muda', 'III/a', 'penata-muda'),
(6, 'Penata Muda Tk.I', 'III/b', 'penata-muda-tki'),
(7, 'Penata', 'III/c', 'penata'),
(8, 'Penata Tk.I', 'III/d', 'penata-tki'),
(9, 'Pembina', 'IV/a', 'pembina'),
(10, 'Pembina Tk.I', 'IV/b', 'pembina-tki'),
(11, 'Pembina Utama Muda', 'IV/c', 'pembina-utama-muda'),
(12, 'Pembina Utama Madya', 'IV/d', 'pembina-utama-madya'),
(13, 'Pembina Utama', 'IV/e', 'pembina-utama');

-- --------------------------------------------------------

--
-- Table structure for table `esema_rekom`
--

CREATE TABLE `esema_rekom` (
  `id` int(11) NOT NULL,
  `nik` char(16) NOT NULL,
  `id_tna` varchar(35) NOT NULL,
  `id_jabfung` char(11) NOT NULL,
  `id_jenjang` char(11) NOT NULL,
  `id_rumah` char(5) NOT NULL,
  `nilai` varchar(11) NOT NULL,
  `rekom` varchar(64) NOT NULL,
  `tgl_validasi` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `esema_rekom`
--

INSERT INTO `esema_rekom` (`id`, `nik`, `id_tna`, `id_jabfung`, `id_jenjang`, `id_rumah`, `nilai`, `rekom`, `tgl_validasi`) VALUES
(1, '41-325-2258', '1jf-1-jj-1-rj-1', 'jf-1', 'jj-1', 'rj-1', '', 'Peningkatan Kompetensi', '2024-07-27'),
(2, '18-131-4492', '1jf-1-jj-1-rj-1', 'jf-1', 'jj-1', 'rj-1', '', 'Peningkatan Kompetensi', '2024-07-27'),
(3, '48-545-0956', '1jf-1-jj-1-rj-1', 'jf-1', 'jj-1', 'rj-1', '', 'Peningkatan Kompetensi', '2024-07-27'),
(4, '20-425-1532', '1jf-1-jj-1-rj-1', 'jf-1', 'jj-1', 'rj-1', '', 'Peningkatan Kompetensi', '2024-07-27'),
(5, '33-636-5477', '1jf-1-jj-1-rj-1', 'jf-1', 'jj-1', 'rj-1', '', 'Peningkatan Kompetensi', '2024-07-27'),
(6, '35-543-4552', '1jf-1-jj-1-rj-1', 'jf-1', 'jj-1', 'rj-1', '', 'Peningkatan Kompetensi', '2024-07-30'),
(7, '79-960-7061', '1jf-1-jj-1-rj-1', 'jf-1', 'jj-1', 'rj-1', '', 'Kompeten', '2024-07-30'),
(8, '40-513-7108', '1jf-1-jj-1-rj-1', 'jf-1', 'jj-1', 'rj-1', '', 'Kompeten', '2024-07-30'),
(9, '88-350-4321', '1jf-1-jj-1-rj-1', 'jf-1', 'jj-1', 'rj-1', '', 'Peningkatan Kompetensi', '2024-07-30'),
(10, '30-431-7998', '1jf-1-jj-1-rj-1', 'jf-1', 'jj-1', 'rj-1', '', 'Peningkatan Kompetensi', '2024-07-30'),
(11, '79-121-5754', '2jf-1-jj-1-rj-2', 'jf-1', 'jj-1', 'rj-2', '', 'Peningkatan Kompetensi', '2024-07-30'),
(12, '48-461-1901', '2jf-1-jj-1-rj-2', 'jf-1', 'jj-1', 'rj-2', '', 'Peningkatan Kompetensi', '2024-07-31'),
(13, '10-400-7079', '2jf-1-jj-1-rj-2', 'jf-1', 'jj-1', 'rj-2', '', 'Peningkatan Kompetensi', '2024-08-01'),
(14, '81-387-0251', '2jf-1-jj-1-rj-2', 'jf-1', 'jj-1', 'rj-2', '', 'Peningkatan Kompetensi', '2024-08-01'),
(15, '79-802-5664', '2jf-1-jj-1-rj-2', 'jf-1', 'jj-1', 'rj-2', '', 'Peningkatan Kompetensi', '2024-08-01'),
(16, '50-704-1960', '2jf-1-jj-1-rj-2', 'jf-1', 'jj-1', 'rj-2', '', 'Peningkatan Kompetensi', '2024-08-01'),
(17, '46-856-4950', '2jf-1-jj-1-rj-2', 'jf-1', 'jj-1', 'rj-2', '', 'Peningkatan Kompetensi', '2024-08-02'),
(18, '89-050-4527', '3jf-1-jj-1-rj-3', 'jf-1', 'jj-1', 'rj-3', '', 'Peningkatan Kompetensi', '2024-08-05'),
(19, '74-079-8079', '3jf-1-jj-1-rj-3', 'jf-1', 'jj-1', 'rj-3', '', 'Peningkatan Kompetensi', '2024-08-05'),
(20, '59-970-7964', '3jf-1-jj-1-rj-3', 'jf-1', 'jj-1', 'rj-3', '', 'Peningkatan Kompetensi', '2024-08-05'),
(21, '29-369-6190', '3jf-1-jj-1-rj-3', 'jf-1', 'jj-1', 'rj-3', '', 'Peningkatan Kompetensi', '2024-08-05'),
(22, '81-319-2028', '3jf-1-jj-1-rj-3', 'jf-1', 'jj-1', 'rj-3', '', 'Peningkatan Kompetensi', '2024-08-05');

-- --------------------------------------------------------

--
-- Table structure for table `esema_role_akses`
--

CREATE TABLE `esema_role_akses` (
  `id_role` varchar(11) NOT NULL,
  `nama_role` longtext NOT NULL,
  `slug` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `esema_role_akses`
--

INSERT INTO `esema_role_akses` (`id_role`, `nama_role`, `slug`) VALUES
('role-1', 'Super Admin', 'super-admin'),
('role-2', 'Admin', 'admin'),
('role-3', 'Tim Ahli', 'tim-ahli'),
('role-4', 'Responden', 'responden');

-- --------------------------------------------------------

--
-- Table structure for table `esema_rumah_jabatan`
--

CREATE TABLE `esema_rumah_jabatan` (
  `id_rumah` char(5) NOT NULL,
  `nama_rumah` varchar(64) NOT NULL,
  `slug_rumah` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `esema_rumah_jabatan`
--

INSERT INTO `esema_rumah_jabatan` (`id_rumah`, `nama_rumah`, `slug_rumah`) VALUES
('rj-1', 'Rumah Sakit', 'rumah-sakit'),
('rj-2', 'Puskesmas', 'puskesmas'),
('rj-3', 'Apotek', 'apotek');

-- --------------------------------------------------------

--
-- Table structure for table `esema_skala`
--

CREATE TABLE `esema_skala` (
  `id_skala` char(8) NOT NULL,
  `nama_skala` varchar(64) NOT NULL,
  `range_skala` int(11) NOT NULL,
  `skala_d` text NOT NULL,
  `skala_i` text NOT NULL,
  `skala_f` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `esema_skala`
--

INSERT INTO `esema_skala` (`id_skala`, `nama_skala`, `range_skala`, `skala_d`, `skala_i`, `skala_f`) VALUES
('skala-1', 'Skala Likert 5', 5, '[\"Sangat Mudah\",\"Mudah\",\"Sedang\",\"Sulit\",\"Sangat Sulit\"]', '[\"Sangat Tidak Penting\",\"Tidak Penting\",\"Cukup Penting\",\"Penting\",\"Sangat Penting\"]', '[\"Sangat Jarang\",\"Jarang\",\"Cukup Sering\",\"Sering\",\"Sangat Sering\"]');

-- --------------------------------------------------------

--
-- Table structure for table `esema_soal`
--

CREATE TABLE `esema_soal` (
  `id_soal` char(10) NOT NULL,
  `id_tna` varchar(35) NOT NULL,
  `id_instrumen` char(7) NOT NULL,
  `soal_d` text NOT NULL,
  `soal_i` text NOT NULL,
  `soal_f` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `esema_soal`
--

INSERT INTO `esema_soal` (`id_soal`, `id_tna`, `id_instrumen`, `soal_d`, `soal_i`, `soal_f`) VALUES
('soal-1', '1jf-1-jj-1-rj-1', 'itr-1', 'Seberapa Sulit bagi Anda dalam melakukan pengkajian keperawatan dasar pada individu?', 'Seberapa Penting bagi Anda dalam melakukan pengkajian keperawatan dasar pada individu?', 'Seberapa Sering bagi Anda dalam melakukan pengkajian dasar keperawatan?'),
('soal-10', '1jf-1-jj-1-rj-1', 'itr-9', 'Seberapa Sulit bagi Anda dalam melakukan pengukuran antropometri?', 'Seberapa Penting bagi Anda dalam melakukan pengukuran antropometri?', 'Seberapa Sering bagi Anda dalam melakukan pengukuran antropometri?'),
('soal-11', '2jf-1-jj-1-rj-2', 'itr-1', 'Menurut pengalaman saya, melakukan pengkajian dasar keperawatan pada individu... (Tingkatan Sulit)', 'Menurut pengalaman saya pada keperawatan, melakukan pengkajian dasar individu... (Tingkatan Penting)', 'Menurut pengalaman saya, melakukan pengkajian dasar keperawatan pada individu ... (Tingkatan Sering)'),
('soal-12', '2jf-1-jj-1-rj-2', 'itr-2', 'Menurut pengalaman saya, mengajarkan perilaku sehat dan bersih hidup individu... (Tingkatan Sulit)', 'Menurut pengalaman saya, mengajarkan hdup sehat pada individu... (Tingkatan Penting)', 'Menurut pengalaman saya, mengajarkan sehat pada dan individu... (Tingkatan Sering)'),
('soal-13', '2jf-1-jj-1-rj-2', 'itr-3', 'Menurut pengalaman saya, membuat media peningkatan perilaku hidup sehat dan bersih pada individu... (Tingkatan Sulit)', 'Menurut pengalaman saya, peningkatan perilaku hidup bersih pada individu... (Tingkatan Penting)', 'Menurut pengalaman saya, media untuk peningkatan perilaku hidup bersih dan sehat... (Tingkatan Sering)'),
('soal-14', '2jf-1-jj-1-rj-2', 'itr-4', 'Menurut pengalaman saya, memfasilitasi alat-alat pelindung risiko penggunaan cidera fisik atau pengamanan pasien... (Tingkatan Sulit)', 'Menurut pengalaman saya, penggunaan  alat-alat pelindung... (Tingkatan Penting)', 'Menurut pengalaman saya, memfasilitasi alat-alat untuk pada cidera individu... (Tingkatan Sering)'),
('soal-15', '2jf-1-jj-1-rj-2', 'itr-5', 'Menurut pengalaman saya, memantau perkembangan pasien... (Tingkatan Sulit)', 'Menurut pengalaman saya, mengamati pasien sesuai hasil pemeriksaan pasien... (Tingkatan Penting)', 'Menurut pengalaman saya, mengamati pasien sesuai perkembangan kondisi pemeriksaan... (Tingkatan Sering)'),
('soal-16', '2jf-1-jj-1-rj-2', 'itr-7', 'Menurut pengalaman saya, memberikan oksigenasi sederhana... (Tingkatan Sulit)', 'Menurut pengalaman saya, oksigenasi sederhana... (Tingkatan Penting)', 'Menurut pengalaman saya, memberikan oksigenasi sederhana... (Tingkatan Sering)'),
('soal-17', '2jf-1-jj-1-rj-2', 'itr-8', 'Menurut pengalaman saya, memberikan bantuan hidup dasar... (Tingkatan Sulit)', 'Menurut pengalaman saya, bantuan hidup dasar... (Tingkatan Penting)', 'Menurut pengalaman saya, memberikan bantuan hidup dasar... (Tingkatan Sering)'),
('soal-18', '3jf-1-jj-1-rj-3', 'itr-10', 'Seberapa Sulit bagi Anda dalam fasilitasi eliminasi pasien?', 'Seberapa Penting bagi Anda dalam fasilitasi eliminasi pasien?', 'Seberapa Sering bagi Anda dalam melakukan fasilitasi eliminasi pasien?'),
('soal-19', '3jf-1-jj-1-rj-3', 'itr-3', 'Seberapa Sulit bagi Anda dalam membuat media peningkatan perilaku hidup sehat pada individu?', 'Seberapa Penting bagi Anda dalam membuat media hidup bersih dan sehat?', 'Seberapa Sering bagi Anda dalam membuat media peningkatan perilaku hidup bersih dan sehat pada individu?'),
('soal-2', '1jf-1-jj-1-rj-1', 'itr-10', 'Seberapa Sulit bagi Anda dalam melakukan fasilitasi pasien eliminasi?', 'Seberapa Penting bagi Anda dalam melakukan fasilitasi pasien eliminasi?', 'Seberapa Sering bagi Anda dalam melakukan fasilitasi  pasien eliminasi?'),
('soal-20', '3jf-1-jj-1-rj-3', 'itr-4', 'Seberapa Sulit bagi Anda dalam memfasilitasi alat-alat untuk mencegah cidera pada individu?', 'Seberapa Penting bagi Anda dalam penggunaan alat-alat pengamanan pelindung fisik pasien untuk mencegah  risiko pada individu?', 'Seberapa Sering bagi Anda dalam memfasilitasi pelindung fisik pada pasien?'),
('soal-21', '3jf-1-jj-1-rj-3', 'itr-5', 'Seberapa Sulit bagi Anda dalam memantau dan mengamati keadaan kondisi individu?', 'Seberapa Penting bagi Anda dalam mengamati perkembangan fisik pasien berdasarkan pemeriksaan?', 'Seberapa Sering bagi Anda dalam memantau keadaan pasien?'),
('soal-22', '3jf-1-jj-1-rj-3', 'itr-6', 'Seberapa Sulit bagi Anda dalam memfasilitasi pelindung diri pada penggunaan kelompok?', 'Seberapa Penting bagi Anda dalam memfasilitasi penggunaan pelindung diri pada kelompok?', 'Seberapa Sering bagi Anda dalam penggunaan pelindung diri pada kelompok?'),
('soal-3', '1jf-1-jj-1-rj-1', 'itr-2', 'Seberapa Sulit bagi Anda dalam mengajarkan perilaku hidup sehat dan bersih pada individu?', 'Seberapa Penting bagi Anda dalam mengajarkan perilaku hidup sehat dan bersih?', 'Seberapa Sering bagi Anda dalam mengajarkan perilaku hidup sehat pada individu?'),
('soal-4', '1jf-1-jj-1-rj-1', 'itr-3', 'Seberapa Sulit bagi Anda dalam membuat media untuk peningkatan perilaku hidup bersih dan sehat pada individu?', 'Seberapa Penting bagi Anda dalam membuat media untuk peningkatan perilaku hidup bersih dan sehat?', 'Seberapa Sering bagi Anda dalam membuat media untuk peningkatan perilaku hidup bersih dan sehat?'),
('soal-5', '1jf-1-jj-1-rj-1', 'itr-4', 'Seberapa Sulit bagi Anda dalam memfasilitasi penggunaan alat-alat pengamanan atau pelindung fisik pada pasien untuk mencegah risiko cidera pada individu?', 'Seberapa Penting bagi Anda dalam memfasilitasi penggunaan alat-alat pengamanan atau pelindung fisik pada pasien?', 'Seberapa Sering bagi Anda dalam memfasilitasi penggunaan alat-alat pengamanan atau pelindung fisik puntuk mencegah risiko cidera pada individu?'),
('soal-6', '1jf-1-jj-1-rj-1', 'itr-5', 'Seberapa Sulit bagi Anda dalam memantau perkembangan pasien sesuai dengan kondisinya (melakukan pemeriksaan fisik, mengamati keadaan pasien) pada individu?', 'Seberapa Penting bagi Anda dalam melakukan pemeriksaan fisik dan mengamati keadaan pasien?', 'Seberapa Sering bagi Anda dalam memantau perkembangandan mengamati keadaan pasien?'),
('soal-7', '1jf-1-jj-1-rj-1', 'itr-6', 'Seberapa Sulit bagi Anda dalam memfasilitasi penggunaan pelindung diri pada kelompok?', 'Seberapa Penting bagi Anda dalam memfasilitasi penggunaan pelindung diri?', 'Seberapa Sering bagi Anda dalam penggunaan pelindung diri pada kelompok?'),
('soal-8', '1jf-1-jj-1-rj-1', 'itr-7', 'Seberapa Sulit bagi Anda dalam memberikan oksigenasi sederhana?', 'Seberapa Penting bagi Anda dalam memberikan oksigenasi sederhana?', 'Seberapa Sering bagi Anda dalam memberikan oksigenasi sederhana?'),
('soal-9', '1jf-1-jj-1-rj-1', 'itr-8', 'Seberapa Sulit bagi Anda dalam memberikan bantuan hidup dasar?', 'Seberapa Penting bagi Anda dalam memberikan bantuan hidup dasar?', 'Seberapa Sering bagi Anda dalam memberikan bantuan hidup dasar?');

-- --------------------------------------------------------

--
-- Table structure for table `esema_submenu`
--

CREATE TABLE `esema_submenu` (
  `id_submenu` varchar(11) NOT NULL,
  `id_menu` varchar(11) NOT NULL,
  `nama_submenu` longtext NOT NULL,
  `slug_submenu` longtext NOT NULL,
  `is_active` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `esema_submenu`
--

INSERT INTO `esema_submenu` (`id_submenu`, `id_menu`, `nama_submenu`, `slug_submenu`, `is_active`) VALUES
('submenu-1', 'menu-3', 'Kuesioner', 'kuesioner', 'Aktif'),
('submenu-10', 'menu-5', 'Homepage', 'homepage', 'Aktif'),
('submenu-2', 'menu-3', 'Data TNA', 'data-tna', 'Aktif'),
('submenu-3', 'menu-4', 'Data User', 'data-user', 'Aktif'),
('submenu-4', 'menu-4', 'Data Jabfung', 'data-jabfung', 'Aktif'),
('submenu-5', 'menu-4', 'Data Skala', 'data-skala', 'Aktif'),
('submenu-6', 'menu-5', 'Profile', 'profile', 'Aktif'),
('submenu-7', 'menu-5', 'Hak Akses', 'hak-akses', 'Aktif'),
('submenu-8', 'menu-5', 'Menu', 'menu', 'Aktif'),
('submenu-9', 'menu-5', 'Maintenance', 'maintenance', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `esema_users`
--

CREATE TABLE `esema_users` (
  `id_user` char(16) NOT NULL,
  `nama` varchar(64) NOT NULL,
  `nik` char(16) NOT NULL,
  `nip` varchar(64) NOT NULL,
  `gender` varchar(16) NOT NULL,
  `tmpt_lahir` longtext NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` longtext NOT NULL,
  `no_hp` varchar(16) NOT NULL,
  `avatar` varchar(128) NOT NULL,
  `id_pangkat` int(11) NOT NULL,
  `id_jabfung` char(11) NOT NULL,
  `id_jenjang` char(11) NOT NULL,
  `id_rumah` char(5) NOT NULL,
  `id_role` varchar(11) NOT NULL,
  `tmpt_kerja` longtext NOT NULL,
  `alamat_kerja` longtext NOT NULL,
  `pdd_terakhir` longtext NOT NULL,
  `jurusan` longtext NOT NULL,
  `status_asn` varchar(11) NOT NULL,
  `is_active` varchar(16) NOT NULL,
  `otp` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `esema_users`
--

INSERT INTO `esema_users` (`id_user`, `nama`, `nik`, `nip`, `gender`, `tmpt_lahir`, `tgl_lahir`, `alamat`, `no_hp`, `avatar`, `id_pangkat`, `id_jabfung`, `id_jenjang`, `id_rumah`, `id_role`, `tmpt_kerja`, `alamat_kerja`, `pdd_terakhir`, `jurusan`, `status_asn`, `is_active`, `otp`) VALUES
('usr-16', 'Saudra Height', '10-400-7079', '7435554278', 'Wanita', 'Makasar', '1992-10-20', 'Jl. Sudirman', '6289503044143', 'usr-16_saudra-height.jpg', 5, 'jf-1', 'jj-1', 'rj-2', 'role-4', 'Puskemas ABC', 'Jl. Hayam Wuruk', 'S1', 'Keperawatan', 'ASN', 'Aktif', 9672),
('usr-1', 'John Smith', '1234567890976543', '-', 'Pria', 'Jakarta', '1987-01-01', '', '6282297566728', 'pria.png', 0, '', '', '', 'role-1', '', '', '', '', '', 'Aktif', 6078),
('usr-3', 'Terry Escolme', '18-131-4492', '2223208797', 'Wanita', 'Estrada', '1984-03-01', '037 North Plaza', '6282297566728', 'usr-3_terry-escolme.png', 5, 'jf-1', 'jj-1', 'rj-1', 'role-4', 'RS ABC', 'Inverse well-modulated solution', 'S1', 'Kedokteran', 'ASN', 'Aktif', 4730),
('usr-5', 'Seana Egiloff', '20-425-1532', '4749173517', 'Wanita', 'Gobernador Costa', '1989-12-01', '8271 Hermina Road', '6282297566728', 'usr-5_seana-egiloff.jpg', 5, 'jf-1', 'jj-1', 'rj-1', 'role-4', 'RS ABC', 'Jl. ABC', 'S1', 'Kedokteran', 'Non ASN', 'Aktif', 4763),
('usr-22', 'Nanette Broscombe', '29-369-6190', '9064141444', 'Wanita', 'Lhoksumawe', '1990-08-29', 'Jl. Manggopoh', '6282297566728', 'wanita.png', 5, 'jf-1', 'jj-1', 'rj-3', 'role-4', 'Apotek Nusantara Jaya', 'Jl. Smaraloka Nusantara', 'S1', 'Keperawatan', 'ASN', 'Aktif', 5213),
('usr-11', 'Brockie Knowlson', '30-431-7998', '-', 'Wanita', 'Nueva Italia', '1990-12-30', '53089 Badeau Point', '6282297566728', 'usr-11_brockie-knowlson.jpg', 5, 'jf-1', 'jj-1', 'rj-1', 'role-4', 'Rumah Sakit DEF', 'Jl. DEF', 'S1', 'Penyakit Dalam', 'Non ASN', 'Aktif', 4569),
('usr-6', 'DESINTA PANESE', '33-636-5477', '5295703355', 'Pria', 'manado', '1999-04-12', 'Jl. Rudal IV No. 3 B, Joglo, Kembangan', '0812-4392-0070', 'usr-6_desinta-panese.png', 5, 'jf-1', 'jj-1', 'rj-1', 'role-4', 'Rumah Sakit ABC', 'Jl. ABC', 'S1', 'keperawatan', 'ASN', 'Aktif', 165),
('usr-7', 'Brita Danielou', '35-543-4552', '3645930531', 'Wanita', 'Maragogi', '1993-07-13', '24 Acker Park', '6282297566728', 'usr-7_brita-danielou.jpg', 5, 'jf-1', 'jj-1', 'rj-1', 'role-4', 'RS Z', 'Jl Z', 'D3', 'keperawatan', 'ASN', 'Aktif', 5942),
('usr-9', 'Rosette Windmill', '40-513-7108', '-', 'Wanita', 'Hepu', '1993-01-19', 'Bogor', '6282297566728', 'usr-9_rosette-windmill.jpg', 5, 'jf-1', 'jj-1', 'rj-1', 'role-4', 'RS Z', 'Jl. Z', 'S1', 'Keperawatan', 'Non ASN', 'Aktif', 4617),
('usr-2', 'Rossy Aimable', '41-325-2258', '9544719121', 'Wanita', 'Gränna', '1983-11-10', '31 Loomis Avenue', '6282283871665', 'usr-2_rossy-aimable.png', 5, 'jf-1', 'jj-1', 'rj-1', 'role-4', 'RS ABC', 'Re-contextualized composite throughput', 'S1', 'Kebidanan', 'ASN', 'Aktif', 8157),
('usr-13', 'Fallon Newstead', '46-856-4950', '5412237835', 'Pria', 'jakarta', '2001-05-24', 'jl.kavling hankam blok S2 no.13E , RT02/RW08, JOGLO , JAKARTA BARAT', '089525592977', 'pria.png', 5, 'jf-1', 'jj-1', 'rj-2', 'role-4', 'jakarta', 'jl.kavling hankam blok S2 no.13E , RT02/RW08, JOGLO , JAKARTA BARAT', 'S1', 'sistem informasi', 'ASN', 'Aktif', 9874),
('usr-15', 'Kermy Muat', '48-461-1901', '8053823653', 'Wanita', 'Papua', '1990-02-10', 'Sorong', '6282297566728', 'usr-15_kermy-muat.png', 5, 'jf-1', 'jj-1', 'rj-2', 'role-4', 'Puskemas ABC', 'Jl. ABC', 'D3', 'Kebidanan', 'ASN', 'Aktif', 3420),
('usr-4', 'Jerald Volcker', '48-545-0956', '-', 'Pria', 'Yinjiacheng', '1991-03-05', '70 Old Shore Drive', '6282297566728', 'usr-4_jerald-volcker.jpg', 5, 'jf-1', 'jj-1', 'rj-1', 'role-4', 'Rumah Sakit Cipta', 'Jl. Mekar Raya', 'S1', 'Penyakit Dalam', 'Non ASN', 'Aktif', 947),
('usr-18', 'Winni Rowter', '50-704-1960', '8971898429', 'Wanita', 'manado', '1998-12-12', 'jl. tonsea minahasa', '6281243920070', 'usr-18_winni-rowter.png', 5, 'jf-1', 'jj-1', 'rj-2', 'role-4', 'Puskesmas Tuminting', 'Tuminting III link 1', 'S1', 'keperawatan', 'ASN', 'Aktif', 8562),
('usr-21', 'Louis Surgey', '59-970-7964', '1243567533357', 'Pria', 'Bichura', '1993-06-04', 'Jl. Pakan Akad', '6282297566728', 'usr-21_louis-surgey.jpg', 5, 'jf-1', 'jj-1', 'rj-3', 'role-4', 'Apotek Prima Nusantara', 'Jl. Kusuma Negara', 'S1', 'Keperawatan', 'ASN', 'Aktif', 9310),
('usr-20', 'Beatrice Rumsey', '74-079-8079', '8016926568', 'Wanita', 'Bezerros', '1994-01-15', 'Jl. Mustika Ratu', '6282297566728', 'usr-20_beatrice-rumsey.png', 5, 'jf-1', 'jj-1', 'rj-3', 'role-4', 'Apotek Nusantara Jaya', 'Jl. Supriyadi', 'S1', 'Keperawatan', 'ASN', 'Aktif', 238),
('usr-14', 'Lyn Barrass', '79-121-5754', ' 8349914033', 'Wanita', 'jakarta', '2001-06-03', 'jl.kavling hankam blok S2 no.13E , RT02/RW08, JOGLO , JAKARTA BARAT', '089525592977', 'wanita.png', 5, 'jf-1', 'jj-1', 'rj-2', 'role-4', 'jakarta', 'jl.h.saaba jakarta barat', 'S1', 'sistem informasi', 'ASN', 'Aktif', 7391),
('usr-12', 'Tonia Pragnall', '79-802-5664', '5472080037', 'Wanita', 'Jakarta', '1994-07-30', 'Kebagusan 4 no 1', '6281243920070', 'pria.png', 5, 'jf-1', 'jj-1', 'rj-2', 'role-4', 'Puskesmas Malalayang', 'Jl. Prof kandow. Malalayang timur', 'S1', 'Keperawatam', 'ASN', 'Aktif', 6147),
('usr-8', 'Jard Wills', '79-960-7061', '8629978651', 'Pria', 'Khorosheve', '1984-01-18', 'Bogor', '6282297566728', 'usr-8_jard-wills.jpg', 5, 'jf-1', 'jj-1', 'rj-1', 'role-4', 'RS Z', 'Jl. Z', 'S1', 'Keperawatan', 'ASN', 'Aktif', 7605),
('usr-23', 'Brandon Brandone', '81-319-2028', '-', 'Pria', 'Dugcal', '1994-12-15', 'Jl. Melati', '6282297566728', 'pria.png', 5, 'jf-1', 'jj-1', 'rj-3', 'role-4', 'Apotek Nusantara Jaya', 'Jl. Kusuma Bakti', 'S1', 'Keperawatan', 'Non ASN', 'Aktif', 2891),
('usr-17', 'Fredrick Leopard', '81-387-0251', '5255591718', 'Pria', 'Pontianak', '1990-10-05', 'Jl. Kusuma Bakti', '6289503044143', 'usr-17_fredrick-leopard.png', 5, 'jf-1', 'jj-1', 'rj-2', 'role-4', 'Puskemas Z', 'Jl. Raya Zakaria', 'S1', 'Keperawatan', 'ASN', 'Aktif', 8024),
('usr-10', 'Amery Dahlborg', '88-350-4321', '-', 'Pria', 'Banocboc', '1983-02-26', '9521 Dovetail Lane', '6282297566728', 'usr-10_amery-dahlborg.jpg', 5, 'jf-1', 'jj-1', 'rj-1', 'role-4', 'RS Z', 'Jl. Z', 'S1', 'Keperawatan', 'Non ASN', 'Aktif', 3876),
('usr-19', 'Portie Trimming', '89-050-4527', '8842708798', 'Pria', 'Sandata', '1993-07-04', 'Jl. Merauke', '6282297566728', 'usr-19_portie-trimming.png', 5, 'jf-1', 'jj-1', 'rj-3', 'role-4', 'Apotek Prima Nusantara', 'Jl. Kenanga Indah', 'S1', 'Keperawatan', 'ASN', 'Aktif', 4207);

-- --------------------------------------------------------

--
-- Table structure for table `set_home`
--

CREATE TABLE `set_home` (
  `id_sethome` int(11) NOT NULL,
  `id_menu` varchar(11) NOT NULL,
  `h1` longtext NOT NULL,
  `h3` longtext NOT NULL,
  `p` longtext NOT NULL,
  `media` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `set_home`
--

INSERT INTO `set_home` (`id_sethome`, `id_menu`, `h1`, `h3`, `p`, `media`) VALUES
(1, 'menu-1', 'TRAINING NEEDS ASSESSMENT', 'Direktorat Peningkatan Mutu Tenaga Kesehatan', 'Berikut sambutan dari Direktur Peningkatan Mutu Tenaga Kesehatan', 'background.png'),
(2, 'menu-6', 'PEDOMAN', 'TRAINING NEEDS ASSESSMENT', '', '[\"f823c9dc-46c3-4f8b-b0b4-614876c678be.pdf\",\"PERMENPAN_NOMOR_25_TAHUN_2014.pdf\",\"PMK_No__4_TH_2022_ttg_Petunjuk_Teknis_Jabatan_Fungsional_Perawat-signed.pdf\"]'),
(3, 'menu-7', 'About', 'TRAINING NEEDS ASSESSMENT', '<p style=\"text-align: justify;\"><strong>Apa Itu Training Needs Assessment (TNA)?</strong></p>\r\n<p style=\"text-align: justify;\">Training Needs Assessment (TNA) adalah proses sistematis untuk mengidentifikasi kebutuhan pelatihan di suatu organisasi atau dalam konteks tertentu. Tujuan utamanya adalah untuk menilai keterampilan, pengetahuan, dan kompetensi yang diperlukan oleh individu atau kelompok dalam mencapai tujuan mereka.</p>\r\n<p style=\"text-align: justify;\"><strong>Tujuan TNA</strong>:</p>\r\n<ol>\r\n<li style=\"text-align: justify;\"><strong>Identifikasi Kebutuhan:</strong> TNA membantu organisasi dalam mengidentifikasi kebutuhan pelatihan yang spesifik. Ini melibatkan pengumpulan data tentang kinerja karyawan, perubahan dalam tuntutan pekerjaan, atau perubahan teknologi.</li>\r\n<li style=\"text-align: justify;\"><strong style=\"font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Oxygen, Ubuntu, Cantarell, \'Open Sans\', \'Helvetica Neue\', sans-serif;\">Merencanakan Pelatihan yang Efektif:</strong><span style=\"font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Oxygen, Ubuntu, Cantarell, \'Open Sans\', \'Helvetica Neue\', sans-serif;\"> Dengan memahami kebutuhan yang ada, organisasi dapat merancang program pelatihan yang tepat sasaran untuk meningkatkan keterampilan dan pengetahuan karyawan. Ini memastikan bahwa waktu dan sumber daya yang diinvestasikan dalam pelatihan memiliki dampak yang maksimal.</span></li>\r\n<li style=\"text-align: justify;\"><span style=\"font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Oxygen, Ubuntu, Cantarell, \'Open Sans\', \'Helvetica Neue\', sans-serif;\"><strong>Meningkatkan Produktivitas:</strong> Dengan memberikan pelatihan yang sesuai dengan kebutuhan, organisasi dapat meningkatkan produktivitas karyawan. Karyawan yang memiliki keterampilan dan pengetahuan yang diperlukan untuk melakukan pekerjaan mereka dengan baik akan menjadi aset yang lebih berharga bagi organisasi.</span></li>\r\n</ol>\r\n<p style=\"text-align: justify;\"><span style=\"font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Oxygen, Ubuntu, Cantarell, \'Open Sans\', \'Helvetica Neue\', sans-serif;\"><strong>Langkah-langkah dalam TNA:</strong></span></p>\r\n<ol>\r\n<li style=\"text-align: justify;\"><span style=\"font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Oxygen, Ubuntu, Cantarell, \'Open Sans\', \'Helvetica Neue\', sans-serif;\"><strong>Identifikasi Tujuan Organisasi:</strong> Langkah pertama dalam TNA adalah memahami tujuan organisasi dan bagaimana keterampilan karyawan dapat mendukung pencapaian tujuan tersebut.</span></li>\r\n<li style=\"text-align: justify;\"><span style=\"font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Oxygen, Ubuntu, Cantarell, \'Open Sans\', \'Helvetica Neue\', sans-serif;\"><strong>Pengumpulan Data:</strong> Data dikumpulkan melalui berbagai metode, termasuk wawancara dengan karyawan, survei, observasi langsung, dan tinjauan dokumentasi.</span></li>\r\n<li style=\"text-align: justify;\"><span style=\"font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Oxygen, Ubuntu, Cantarell, \'Open Sans\', \'Helvetica Neue\', sans-serif;\"><strong>Analisis Data:</strong> Data yang terkumpul kemudian dianalisis untuk mengidentifikasi kesenjangan antara keterampilan yang dimiliki saat ini oleh karyawan dan keterampilan yang dibutuhkan untuk mencapai tujuan organisasi.&nbsp;</span></li>\r\n<li style=\"text-align: justify;\"><span style=\"font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Oxygen, Ubuntu, Cantarell, \'Open Sans\', \'Helvetica Neue\', sans-serif;\"><strong>Menentukan Prioritas:</strong> Setelah mengidentifikasi kesenjangan, langkah berikutnya adalah menentukan prioritas kebutuhan pelatihan berdasarkan urgensi dan dampaknya terhadap tujuan organisasi.&nbsp;</span></li>\r\n<li style=\"text-align: justify;\"><span style=\"font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Oxygen, Ubuntu, Cantarell, \'Open Sans\', \'Helvetica Neue\', sans-serif;\"><strong>Merancang Program Pelatihan:</strong> Berdasarkan hasil analisis, program pelatihan yang dirancang sesuai dengan kebutuhan karyawan dan organisasi.</span></li>\r\n<li style=\"text-align: justify;\"><span style=\"font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Oxygen, Ubuntu, Cantarell, \'Open Sans\', \'Helvetica Neue\', sans-serif;\"><strong>Evaluasi dan Pemantauan:</strong> Setelah program pelatihan dilaksanakan, evaluasi dilakukan untuk menilai efektivitasnya. Pemantauan terus-menerus juga penting untuk memastikan bahwa keterampilan yang diperoleh dipertahankan dan diperbaharui sesuai dengan perubahan kebutuhan.</span></li>\r\n</ol>\r\n<p style=\"text-align: justify;\"><span style=\"font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Oxygen, Ubuntu, Cantarell, \'Open Sans\', \'Helvetica Neue\', sans-serif;\"><strong>Kesimpulan:</strong> Training Needs Assessment (TNA) adalah alat yang penting bagi organisasi untuk memastikan bahwa karyawan memiliki keterampilan dan pengetahuan yang diperlukan untuk mencapai tujuan organisasi. Dengan melakukan TNA secara teratur, organisasi dapat memastikan bahwa investasi dalam pelatihan memberikan hasil yang optimal.</span></p>', '[\"tna.png\"]'),
(4, 'menu-8', 'SAMBUTAN', 'Direktur Peningkatan Mutu Tenaga Kesehatan', '<p style=\"text-align: justify;\">Selamat datang di website ESEMA!</p>\r\n<p style=\"text-align: justify;\">Saya senang sekali bisa menyambut Anda di platform ini yang menjadi wadah bagi informasi, inovasi, dan kolaborasi dalam upaya meningkatkan mutu layanan kesehatan kami.</p>\r\n<p style=\"text-align: justify;\">Sebagai Direktur Peningkatan Mutu Tenaga Kesehatan, visi kami adalah menciptakan lingkungan di mana setiap tenaga kesehatan memiliki akses kepada pelatihan dan pengembangan yang dibutuhkan untuk memberikan pelayanan terbaik kepada masyarakat. Kami percaya bahwa investasi dalam pengembangan profesional tenaga kesehatan adalah kunci untuk mencapai tujuan kami dalam memberikan pelayanan yang aman, berkualitas, dan berdaya guna. Dalam upaya mencapai tujuan tersebut, kami secara teratur melakukan Training Needs Assessment atau penilaian kebutuhan pelatihan.</p>\r\n<p style=\"text-align: justify;\">Proses ini memungkinkan kami untuk mengidentifikasi kebutuhan pelatihan yang spesifik dan merancang program pelatihan yang tepat sasaran untuk meningkatkan kompetensi dan keterampilan tenaga kesehatan kami. Kami mengundang Anda semua untuk bergabung dalam perjalanan kami untuk meningkatkan mutu pelayanan kesehatan.</p>\r\n<p style=\"text-align: justify;\">Mari berkolaborasi, berbagi pengetahuan, dan menginspirasi satu sama lain untuk mencapai prestasi yang luar biasa dalam dunia kesehatan. Terima kasih atas kunjungan Anda di website kami. Kami berharap Anda dapat menemukan informasi yang bermanfaat dan menginspirasi di sini. Jangan ragu untuk menghubungi kami jika Anda memiliki pertanyaan atau ingin berkontribusi dalam upaya kami untuk meningkatkan mutu layanan kesehatan. Salam sehat</p>', '[\"dirut.png\"]');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `esema-tna`
--
ALTER TABLE `esema-tna`
  ADD PRIMARY KEY (`id_tna`),
  ADD KEY `id_jabfung` (`id_jabfung`),
  ADD KEY `id_jenjang` (`id_jenjang`),
  ADD KEY `id_rumah` (`id_rumah`),
  ADD KEY `id_skala` (`id_skala`);

--
-- Indexes for table `esema_api_responden`
--
ALTER TABLE `esema_api_responden`
  ADD PRIMARY KEY (`id_api`);

--
-- Indexes for table `esema_evaluasi`
--
ALTER TABLE `esema_evaluasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nik` (`nik`),
  ADD KEY `id_tna` (`id_tna`);

--
-- Indexes for table `esema_hak_akses`
--
ALTER TABLE `esema_hak_akses`
  ADD PRIMARY KEY (`id_akses`),
  ADD KEY `id_role` (`id_role`),
  ADD KEY `id_menu` (`id_menu`),
  ADD KEY `id_submenu` (`id_submenu`);

--
-- Indexes for table `esema_instrumen`
--
ALTER TABLE `esema_instrumen`
  ADD PRIMARY KEY (`id_instrumen`),
  ADD KEY `id_jenjang` (`id_jenjang`);

--
-- Indexes for table `esema_jabfung`
--
ALTER TABLE `esema_jabfung`
  ADD PRIMARY KEY (`id_jabfung`);

--
-- Indexes for table `esema_jenjang`
--
ALTER TABLE `esema_jenjang`
  ADD PRIMARY KEY (`id_jenjang`),
  ADD KEY `id_jabfung` (`id_jabfung`);

--
-- Indexes for table `esema_kuesioner`
--
ALTER TABLE `esema_kuesioner`
  ADD PRIMARY KEY (`id_hasil`),
  ADD KEY `nik` (`nik`),
  ADD KEY `id_tna` (`id_tna`),
  ADD KEY `id_soal` (`id_soal`);

--
-- Indexes for table `esema_maintenance`
--
ALTER TABLE `esema_maintenance`
  ADD PRIMARY KEY (`id_maintenance`);

--
-- Indexes for table `esema_menu`
--
ALTER TABLE `esema_menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `esema_pangkat`
--
ALTER TABLE `esema_pangkat`
  ADD PRIMARY KEY (`id_pangkat`);

--
-- Indexes for table `esema_rekom`
--
ALTER TABLE `esema_rekom`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nik` (`nik`),
  ADD KEY `id_tna` (`id_tna`),
  ADD KEY `id_jabfung` (`id_jabfung`),
  ADD KEY `id_jenjang` (`id_jenjang`),
  ADD KEY `id_rumah` (`id_rumah`);

--
-- Indexes for table `esema_role_akses`
--
ALTER TABLE `esema_role_akses`
  ADD PRIMARY KEY (`id_role`);

--
-- Indexes for table `esema_rumah_jabatan`
--
ALTER TABLE `esema_rumah_jabatan`
  ADD PRIMARY KEY (`id_rumah`);

--
-- Indexes for table `esema_skala`
--
ALTER TABLE `esema_skala`
  ADD PRIMARY KEY (`id_skala`);

--
-- Indexes for table `esema_soal`
--
ALTER TABLE `esema_soal`
  ADD PRIMARY KEY (`id_soal`),
  ADD KEY `id_tna` (`id_tna`),
  ADD KEY `id_instrumen` (`id_instrumen`);

--
-- Indexes for table `esema_submenu`
--
ALTER TABLE `esema_submenu`
  ADD PRIMARY KEY (`id_submenu`),
  ADD KEY `id_menu` (`id_menu`);

--
-- Indexes for table `esema_users`
--
ALTER TABLE `esema_users`
  ADD PRIMARY KEY (`nik`),
  ADD KEY `id_pangkat` (`id_pangkat`),
  ADD KEY `id_jabfung` (`id_jabfung`),
  ADD KEY `id_jenjang` (`id_jenjang`),
  ADD KEY `id_rumah` (`id_rumah`),
  ADD KEY `id_role` (`id_role`);

--
-- Indexes for table `set_home`
--
ALTER TABLE `set_home`
  ADD PRIMARY KEY (`id_sethome`),
  ADD KEY `id_menu` (`id_menu`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `esema_evaluasi`
--
ALTER TABLE `esema_evaluasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `esema_hak_akses`
--
ALTER TABLE `esema_hak_akses`
  MODIFY `id_akses` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `esema_kuesioner`
--
ALTER TABLE `esema_kuesioner`
  MODIFY `id_hasil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=175;

--
-- AUTO_INCREMENT for table `esema_pangkat`
--
ALTER TABLE `esema_pangkat`
  MODIFY `id_pangkat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `esema_rekom`
--
ALTER TABLE `esema_rekom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `set_home`
--
ALTER TABLE `set_home`
  MODIFY `id_sethome` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `esema-tna`
--
ALTER TABLE `esema-tna`
  ADD CONSTRAINT `esema-tna_jabfung` FOREIGN KEY (`id_jabfung`) REFERENCES `esema_jabfung` (`id_jabfung`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `esema-tna_jenjang` FOREIGN KEY (`id_jenjang`) REFERENCES `esema_jenjang` (`id_jenjang`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `esema-tna_rumah` FOREIGN KEY (`id_rumah`) REFERENCES `esema_rumah_jabatan` (`id_rumah`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `esema-tna_skala` FOREIGN KEY (`id_skala`) REFERENCES `esema_skala` (`id_skala`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `esema_evaluasi`
--
ALTER TABLE `esema_evaluasi`
  ADD CONSTRAINT `esema_evaluasi_nik` FOREIGN KEY (`nik`) REFERENCES `esema_users` (`nik`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `esema_evaluasi_tna` FOREIGN KEY (`id_tna`) REFERENCES `esema-tna` (`id_tna`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `esema_hak_akses`
--
ALTER TABLE `esema_hak_akses`
  ADD CONSTRAINT `esema_hak_akses_menu` FOREIGN KEY (`id_menu`) REFERENCES `esema_menu` (`id_menu`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `esema_hak_akses_role` FOREIGN KEY (`id_role`) REFERENCES `esema_role_akses` (`id_role`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `esema_instrumen`
--
ALTER TABLE `esema_instrumen`
  ADD CONSTRAINT `esema_instrumen_jenjang` FOREIGN KEY (`id_jenjang`) REFERENCES `esema_jenjang` (`id_jenjang`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `esema_jenjang`
--
ALTER TABLE `esema_jenjang`
  ADD CONSTRAINT `esema_jenjang_jabfung` FOREIGN KEY (`id_jabfung`) REFERENCES `esema_jabfung` (`id_jabfung`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `esema_kuesioner`
--
ALTER TABLE `esema_kuesioner`
  ADD CONSTRAINT `esema_kuesioner_nik` FOREIGN KEY (`nik`) REFERENCES `esema_users` (`nik`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `esema_kuesioner_soal` FOREIGN KEY (`id_soal`) REFERENCES `esema_soal` (`id_soal`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `esema_kuesioner_tna` FOREIGN KEY (`id_tna`) REFERENCES `esema-tna` (`id_tna`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `esema_rekom`
--
ALTER TABLE `esema_rekom`
  ADD CONSTRAINT `esema_rekom_jabfung` FOREIGN KEY (`id_jabfung`) REFERENCES `esema_jabfung` (`id_jabfung`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `esema_rekom_jenjang` FOREIGN KEY (`id_jenjang`) REFERENCES `esema_jenjang` (`id_jenjang`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `esema_rekom_nik` FOREIGN KEY (`nik`) REFERENCES `esema_users` (`nik`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `esema_rekom_rumah` FOREIGN KEY (`id_rumah`) REFERENCES `esema_rumah_jabatan` (`id_rumah`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `esema_rekom_tna` FOREIGN KEY (`id_tna`) REFERENCES `esema-tna` (`id_tna`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `esema_soal`
--
ALTER TABLE `esema_soal`
  ADD CONSTRAINT `esema_soal_instrumen` FOREIGN KEY (`id_instrumen`) REFERENCES `esema_instrumen` (`id_instrumen`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `esema_soal_tna` FOREIGN KEY (`id_tna`) REFERENCES `esema-tna` (`id_tna`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `esema_submenu`
--
ALTER TABLE `esema_submenu`
  ADD CONSTRAINT `esema_submenu_ibfk_1` FOREIGN KEY (`id_menu`) REFERENCES `esema_menu` (`id_menu`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `set_home`
--
ALTER TABLE `set_home`
  ADD CONSTRAINT `set_home_ibfk_1` FOREIGN KEY (`id_menu`) REFERENCES `esema_menu` (`id_menu`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
