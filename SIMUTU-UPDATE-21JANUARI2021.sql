-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 21, 2022 at 01:00 AM
-- Server version: 10.1.39-MariaDB
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simutu`
--

-- --------------------------------------------------------

--
-- Table structure for table `access`
--

CREATE TABLE `access` (
  `accessid` int(11) NOT NULL,
  `roleid` int(11) NOT NULL,
  `menuid` int(11) NOT NULL,
  `ijin` double NOT NULL,
  `createdDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `access`
--

INSERT INTO `access` (`accessid`, `roleid`, `menuid`, `ijin`, `createdDate`) VALUES
(1, 3, 1, 1, '0000-00-00 00:00:00'),
(2, 3, 2, 0, '2021-10-02 07:42:19'),
(3, 3, 3, 1, '2021-10-02 08:36:52'),
(4, 1, 4, 1, '2021-10-02 08:37:06');

-- --------------------------------------------------------

--
-- Table structure for table `audit`
--

CREATE TABLE `audit` (
  `id` int(11) NOT NULL,
  `idPenetapan` int(10) NOT NULL,
  `auditor` int(10) NOT NULL,
  `userid` int(10) NOT NULL,
  `createdDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `audit`
--

INSERT INTO `audit` (`id`, `idPenetapan`, `auditor`, `userid`, `createdDate`) VALUES
(1, 9, 87, 1, '2022-01-21 05:04:07'),
(2, 9, 86, 1, '2022-01-21 05:04:07');

-- --------------------------------------------------------

--
-- Table structure for table `audit_old`
--

CREATE TABLE `audit_old` (
  `auditid` int(11) NOT NULL,
  `idPenetapan` int(10) NOT NULL,
  `auditor` int(11) NOT NULL,
  `tahun` varchar(50) NOT NULL,
  `berlaku` date NOT NULL,
  `expired` date NOT NULL,
  `userid` int(11) NOT NULL,
  `createdDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bentukpt`
--

CREATE TABLE `bentukpt` (
  `bentukptid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `bentuk` varchar(200) NOT NULL,
  `createdDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bentukpt`
--

INSERT INTO `bentukpt` (`bentukptid`, `userid`, `bentuk`, `createdDate`) VALUES
(6, 1, 'Perguruan Negeri', '2021-11-12 02:14:31');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `depid` int(11) NOT NULL,
  `institusiid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `depCode` varchar(250) NOT NULL,
  `depName` varchar(200) NOT NULL,
  `depAddress` text NOT NULL,
  `depTanggalBerdiri` date NOT NULL,
  `createdDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dokumen`
--

CREATE TABLE `dokumen` (
  `id` int(11) NOT NULL,
  `dokumenid` varchar(20) NOT NULL,
  `userid` int(11) NOT NULL,
  `namaDokumen` varchar(225) NOT NULL,
  `jenis` varchar(350) NOT NULL,
  `keterangan` text NOT NULL,
  `auditor` int(11) NOT NULL,
  `catatan` text NOT NULL,
  `penilaian` int(1) NOT NULL,
  `namefile` varchar(100) NOT NULL,
  `linkfile` varchar(200) NOT NULL,
  `createdDate` datetime NOT NULL,
  `berlaku` date NOT NULL,
  `expDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dokumen`
--

INSERT INTO `dokumen` (`id`, `dokumenid`, `userid`, `namaDokumen`, `jenis`, `keterangan`, `auditor`, `catatan`, `penilaian`, `namefile`, `linkfile`, `createdDate`, `berlaku`, `expDate`) VALUES
(113, 'Exp549', 1, 'dsfd', 'Buku Informasi  Politeknik Negeri Medan ', 'Contoh standar', 0, '-', 0, '660b83a99379ebd37347ed27b5df6194.pdf', 'https://simutu.hexcod.com/api/dokumen/660b83a99379ebd37347ed27b5df6194.pdf', '2022-01-19 00:00:00', '0000-00-00', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `enrollment`
--

CREATE TABLE `enrollment` (
  `enrollmentid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `roleid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `enrollment`
--

INSERT INTO `enrollment` (`enrollmentid`, `userid`, `roleid`) VALUES
(1, 1, 2),
(2, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `indikator`
--

CREATE TABLE `indikator` (
  `indikatorId` int(11) NOT NULL,
  `kodePernyataan` varchar(100) NOT NULL,
  `kodeIndikator` varchar(100) NOT NULL,
  `namaIndikator` text NOT NULL,
  `userid` int(11) NOT NULL,
  `createdDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `indikator`
--

INSERT INTO `indikator` (`indikatorId`, `kodePernyataan`, `kodeIndikator`, `namaIndikator`, `userid`, `createdDate`) VALUES
(1, '1', 'a', 'Tersedianya Buku Informasi  Politeknik Negeri Medan yang berisi profil lulusan', 1, '0000-00-00 00:00:00'),
(2, '1', 'b', 'Tersosialisasinya profil lulusan untuk semua  program studi', 1, '0000-00-00 00:00:00'),
(3, '1', 'c', 'Terlaksananya peninjauan ulang Buku Informasi Politeknik Negeri Medan', 1, '0000-00-00 00:00:00'),
(4, '29', 'd', 'Tersedianya POB praktik kerja lapangan', 1, '0000-00-00 00:00:00'),
(5, '29', 'e', 'Tersedianya POB Penelitan Terapan untuk Mahasiswa Program Magister Terapan', 1, '0000-00-00 00:00:00'),
(6, '29', 'f', 'Tersedianya POB untuk Proyek di Desa/KKNT', 1, '0000-00-00 00:00:00'),
(7, '29', 'g', 'Tersedianya POB untuk Mengajar di Sekolah/Satuan Pendidikan', 1, '0000-00-00 00:00:00'),
(8, '29', 'h', 'Tersedianya POB untuk Pertukaran Mahasiswa', 1, '0000-00-00 00:00:00'),
(9, '29', 'i', 'Tersedianya POB untuk Kegiatan Wirausaha', 1, '0000-00-00 00:00:00'),
(10, '29', 'j', 'Tersedianya POB untuk Studi/Proyek Independen', 1, '0000-00-00 00:00:00'),
(11, '29', 'k', 'Tersedianya POB untuk Proyek Kemanusiaan', 1, '0000-00-00 00:00:00'),
(12, '29', 'l', 'Ada bukti telah dilakukan peninjauan ulang 1 kali per tahun', 1, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `indikatordokumen`
--

CREATE TABLE `indikatordokumen` (
  `indikatorDokumenId` int(11) NOT NULL,
  `kodeIndikator` varchar(100) NOT NULL,
  `namaIndikatorDokumen` text NOT NULL,
  `userid` int(11) NOT NULL,
  `createdDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `indikatordokumen`
--

INSERT INTO `indikatordokumen` (`indikatorDokumenId`, `kodeIndikator`, `namaIndikatorDokumen`, `userid`, `createdDate`) VALUES
(1, 'a', 'Buku Informasi  Politeknik Negeri Medan ', 1, '2022-01-16 16:19:23'),
(2, 'b', 'Laporan kegiatan sosialisasi', 1, '2022-01-16 16:19:28'),
(3, 'c', 'Laporan kegiatan peninjauan ulang dan verifikasi ', 1, '2022-01-16 16:19:32'),
(4, 'a', 'Buku pedoman penyusunan capaian pembelajaran lulusan sesuai dengan jenjang kualifikasi KKNI untuk setiap jenjang pendidikan Poiteknik Negeri Medan', 1, '2022-01-16 16:19:36'),
(5, 'b', 'Laporan kegiatan peninjauan ulang dan verifikasi', 1, '0000-00-00 00:00:00'),
(6, 'a', 'Laporan sosialisasi Buku Buku Pedoman Penyusunan Capaian Pembelajaran Lulusan', 1, '0000-00-00 00:00:00'),
(7, 'a', 'Pedoman menyusun rumusan capaian pembelajaran', 1, '0000-00-00 00:00:00'),
(8, 'a', 'Tabel 8.a LKPS dan Tabel 5.a LKPT Capaian Pembelajaran', 1, '0000-00-00 00:00:00'),
(9, 'a', 'Laporan terkait Sertifikat kompetensi/ profesi/industri dalam bentuk hardcopy dan softcopy', 1, '0000-00-00 00:00:00'),
(10, 'a', 'Tabel 8.b.1) LKPS', 1, '0000-00-00 00:00:00'),
(11, 'a', 'Tabel 5.b.1) LKPT Prestasi Akademik Mahasiswa', 1, '0000-00-00 00:00:00'),
(12, 'a', 'Laporan Prestasi mahasiswa program studi  untuk Program Diploma 3 di bidang non akademik dalam 3 tahun terakhir. Tabel 8.b.2) LKPS  Ã¢â€°Â¥ 0,1%', 1, '0000-00-00 00:00:00'),
(13, 'b', 'Laporan Prestasi mahasiswa program studi  untuk Program Diploma 4 di bidang non akademik dalam 3 tahun terakhir. Tabel 8.b.2) LKPS  Ã¢â€°Â¥ 0,2%', 1, '0000-00-00 00:00:00'),
(14, 'a', 'Tabel 5.b.2) LKPT Prestasi Non-akademik Mahasiswa Politeknik Negeri Medan', 1, '0000-00-00 00:00:00'),
(15, 'a', 'Tabel 8.c LKPS dan Tabel 5.c.1) LKPT Lama Studi Mahasiswa (untuk lembaga)', 1, '0000-00-00 00:00:00'),
(16, 'a', 'Tabel 8.c LKPS dan Tabel 5.c.1) LKPT Lama Studi Mahasiswa (untuk lembaga/institusi)', 1, '0000-00-00 00:00:00'),
(17, 'a', 'Laporan Lama Studi Mahasiswa tersaji dalam Tabel 8.c LKPS (untuk tingkat program studi) dan Tabel 5.c.1) LKPT (untuk tingkat lembaga/institusi) ', 1, '0000-00-00 00:00:00'),
(18, 'a', 'Laporan kelulusan tepat waktu yang tersaji dalam Tabel 8.c LKPS ', 1, '0000-00-00 00:00:00'),
(19, 'a', 'Laporan kelulusan tepat waktu yang tersaji dalam Tabel 5.c 2) LKPT', 1, '0000-00-00 00:00:00'),
(20, 'a', 'Laporan keberhasilan studi mahasiswa pada setiap program studi yang tersaji  dalam Tabel 8.c LKPS dan Tabel 5.c.2) LKPT', 1, '0000-00-00 00:00:00'),
(21, 'a', 'Tabel Data Lulusan TS-4 s.d. TS-2', 1, '0000-00-00 00:00:00'),
(22, 'b', 'Kuesioner mencakup seluruh pertanyaan inti tracer study DIKTI', 1, '0000-00-00 00:00:00'),
(23, 'c', 'Laporan kegiatan sosialisasi hasil tracer study', 1, '0000-00-00 00:00:00'),
(24, 'a', 'Tabel 8.d.1) LKPS dan Tabel 5.d.1) LKPT Waktu Tunggu Lulusan', 1, '0000-00-00 00:00:00'),
(25, 'a', 'Laporan persentase kesesuaian bidang kerja lulusan saat pertama mendapatkan pekerjaan mulai dari  TS-4 s.d. TS-2 yang tersaji dalam Tabel 8.d.2) LKPS', 1, '0000-00-00 00:00:00'),
(26, 'a', 'Laporan persentase kesesuaian bidang kerja lulusan saat pertama mendapatkan pekerjaan mulai dari  TS-4 s.d. TS-2 yang tersaji dalam Tabel 8.d.2 LKPS', 1, '0000-00-00 00:00:00'),
(27, 'a', 'Laporan persentase kesesuaian bidang kerja lulusan saat pertama mendapatkan pekerjaan mulai dari  TS-4 s.d. TS-2 yang tersaji dalam Tabel 5.d.2) LKPT ', 1, '0000-00-00 00:00:00'),
(28, 'a', 'Laporan terkait persentase tingkat dan ukuran tempat kerja lulusan yang tersaji pada Tabel 8.e.1 LKPS', 1, '0000-00-00 00:00:00'),
(29, 'a', 'Angket kepuasan pengguna lulusan', 1, '0000-00-00 00:00:00'),
(30, 'b', 'Hasil analisis dan evaluasi angket tingkat kepuasan pengguna lulusan', 1, '0000-00-00 00:00:00'),
(31, 'a', 'Laporan produk/jasa karya mahasiswa, yang dihasilkan secara mandiri atau bersama Dosen Tetap Program Studi, yang diadopsi oleh industri/ masyarakat dalam 3 tahun', 1, '0000-00-00 00:00:00'),
(32, 'a', 'Laporan persentase tingkat dan tempat kerja lulusan  Ã¢â€°Â¥ 5% dalam 3 tahun terakhir yang tersaji dalam Tabel 5.e.2 LKPT Tempat Kerja Lulusan', 1, '0000-00-00 00:00:00'),
(33, 'a', 'Pedoman rumusan  kompetensi lulusan', 1, '0000-00-00 00:00:00'),
(34, 'a', 'Laporan evaluasi kompetensi lulusan', 1, '0000-00-00 00:00:00'),
(35, 'a', 'Pedoman pelaksanaan pengalaman kerja mahasiswa', 1, '0000-00-00 00:00:00'),
(36, 'b', 'POB pelatihan kerja', 1, '0000-00-00 00:00:00'),
(37, 'c', 'POB kerja praktik', 1, '0000-00-00 00:00:00'),
(38, 'd', 'POB praktik kerja lapangan', 1, '0000-00-00 00:00:00'),
(39, 'e', 'POB Penelitan Terapan untuk Mahasiswa Program Magister Terapan', 1, '0000-00-00 00:00:00'),
(40, 'f', 'POB Proyek di Desa/KKNT', 1, '0000-00-00 00:00:00'),
(41, 'g', 'POB untuk Mengajar di Sekolah', 1, '0000-00-00 00:00:00'),
(42, 'h', 'POB untuk Pertukaran Mahasiswa', 1, '0000-00-00 00:00:00'),
(43, 'i', 'POB untuk Kegiatan Wirausaha', 1, '0000-00-00 00:00:00'),
(44, 'j', 'POB untuk Studi/Proyek Independen', 1, '0000-00-00 00:00:00'),
(45, 'k', 'POB untuk Proyek Kemanusiaan', 1, '0000-00-00 00:00:00'),
(46, 'b', 'Laporan kegiatan peninjauan ulang dan verifikasi.', 1, '0000-00-00 00:00:00'),
(47, 'a', 'Pedoman pelaksanaan peningkatan kemampuan lulusan melalui kegiatan ekstrakurikuler', 1, '0000-00-00 00:00:00'),
(48, 'a', 'POB  monitoring untuk kemampuan lulusan', 1, '0000-00-00 00:00:00'),
(49, 'b', 'Laporan hasil monitoring dan evaluasi kemampuan lulusan, kemampuan tambahan dan kegiatan ekstrakurikuler', 1, '0000-00-00 00:00:00'),
(50, 'a', 'Surat Edaran Wakil Direktur I ', 1, '0000-00-00 00:00:00'),
(51, 'a', 'POB Pelaksanaan Uji Kompetensi', 1, '0000-00-00 00:00:00'),
(52, 'a', 'Daftar Asesor kompetensi sesuai Peraturan Perundangan yang berlaku', 1, '0000-00-00 00:00:00'),
(53, 'a', 'Laporan hasil evaluasi uji kompetensi', 1, '0000-00-00 00:00:00'),
(54, 'a', 'Surat Keputusan Direktur ', 1, '0000-00-00 00:00:00'),
(55, 'a', 'Surat Edaran Wakil Direktur I terkait nilai kelulusan mahasiswa Program Diploma 3 dalam uji kemampuan bahasa Inggris  (TOEIC) adalah  Ã¢â€°Â¥ 400', 1, '0000-00-00 00:00:00'),
(56, 'b', 'Laporan hasil Uji Kemampuan Bahasa Inggris (TOEIC)', 1, '0000-00-00 00:00:00'),
(57, 'c', 'Surat Edaran Wakil Direktur I terkait nilai kelulusan mahasiswa Program Diploma 3 dalam uji kemampuan bahasa Inggris  (TOEIC) adalah  Ã¢â€°Â¥ 430', 1, '0000-00-00 00:00:00'),
(58, 'b', 'Laporan hasil Uji Kemampuan Bahasa Inggris (TOEIC).', 1, '0000-00-00 00:00:00'),
(59, 'a', 'Rekapitulasi data CDC terkait jumlah lulusan yang mendapatkan pekerjaan layak', 1, '0000-00-00 00:00:00'),
(60, 'a', 'Laporan terkait ketercapaian target lulusan yang berwirausaha untuk Diploma 3 dan Diploma 4', 1, '0000-00-00 00:00:00'),
(61, 'a', 'Laporan hasil Tracer study terkait lulusan  dalam kriteria kelanjutan studi kurang dari 6 bulan setelah tanggal terbit ijazah', 1, '0000-00-00 00:00:00'),
(62, 'a', 'Tingkat dan ukuran tempat kerja lulusan. Tabel 8.e.1 LKPS', 1, '0000-00-00 00:00:00'),
(63, 'a', 'Tabel 5.e.2 LKPT Tempat Kerja Lulusan', 1, '0000-00-00 00:00:00'),
(64, 'a', 'Laporan pelaksanaan tracer study, dokumentasi kegiatan, hasil analisis dan evaluasi,  serta sosialisasi', 1, '0000-00-00 00:00:00'),
(65, 'a', 'Data Jumlah produk/jasa karya mahasiswa yang diadopsi oleh industri/masyarakat dalam 3 tahun terakhir', 1, '0000-00-00 00:00:00'),
(66, 'a', 'Laporan pelaksanaan uji kompetensi', 1, '0000-00-00 00:00:00'),
(67, 'b', 'POB pelaksanaan uji kompetensi bahasa Inggris (TOEIC)', 1, '0000-00-00 00:00:00'),
(68, 'c', 'Jadwal pelaksanaan uji kompetensi, tempat uji kompetensi dan soal uji kompetensi', 1, '0000-00-00 00:00:00'),
(69, 'd', 'Dokumentasi sertifikat uji kompetensi Bahasa Inggris', 1, '0000-00-00 00:00:00'),
(70, 'a', 'Laporan hasil evaluasi pelaksanaan uji kompetensi Bahasa Inggris ', 1, '0000-00-00 00:00:00'),
(71, 'a', 'Laporan Pelaksanaan BINTALFISDIS', 1, '0000-00-00 00:00:00'),
(72, 'a', 'Lingkup AMI', 1, '0000-00-00 00:00:00'),
(73, 'b', 'Jadwal pelaksanaan AMI', 1, '0000-00-00 00:00:00'),
(74, 'c', 'SK Auditor AMI', 1, '0000-00-00 00:00:00'),
(75, 'd', 'Laporan Audit ', 1, '0000-00-00 00:00:00'),
(76, 'e', 'Jadwal pelaksanaan RTM dan dokumentasi', 1, '0000-00-00 00:00:00'),
(77, 'f', 'Hasil RTM (Peningkatan efektivitas SPMI dan prosesnya)', 1, '0000-00-00 00:00:00'),
(78, 'g', 'CQI/Kaizen', 1, '0000-00-00 00:00:00'),
(79, 'a', 'Kebijakan pengembangan kurikulum  Politeknik Negeri Medan', 1, '0000-00-00 00:00:00'),
(80, 'a', 'Pedoman Penyusunan dan Pengembangan kurikulum dan peninjauan ulang', 1, '0000-00-00 00:00:00'),
(81, 'a', 'Kurikulum, Profil lulusan, Penetapan kemampuan  lulusan, Capaian Pembelajaran Lulusan, Pembentukan mata kuliah: Mata kuliah dalam struktur kurikulum, Rumusan CPMK, Rencana Pembelajaran Semester, Penilaian pembelajaran, Bentuk, metode pembelajaran,   Surat Tugas Tim, Barchart,  Kuesioner Alumni dan Stakeholder, Berita acara,  Validasi kurikulum.', 1, '0000-00-00 00:00:00'),
(82, 'a', 'Laporan evaluasi dan pemutakhiran kurikulum yang melibatkan pemangku kepentingan, pakar bidang ilmu program studim industrim asosiasi dan pengguna', 1, '0000-00-00 00:00:00'),
(83, 'a', 'Laporan kesesuaian capaian pembelajaran dengan profil lulusan dan jenjang KKNI/ SKKNI serta dimutakhirkan secara berkala setiap 4 sampai dengan 5 tahun sesuai perkembangan ilmu penegtahuan dan teknologi serta kebutuhan pengguna', 1, '0000-00-00 00:00:00'),
(84, 'a', 'Laporan hasil ketepatan struktur kurikulum dalam pembentukan capaian pembelajaran ', 1, '0000-00-00 00:00:00'),
(85, 'b', 'Laporan hasil pemutakhiran kurikulum secara berkala setiap  4 sampai dengan 5 tahun', 1, '0000-00-00 00:00:00'),
(86, 'a', 'Pedoman perumusan tingkat kedalaman dan keluasan materi pembelajaran', 1, '0000-00-00 00:00:00'),
(87, 'a', 'Struktur bahan kajian dan matakuliah yang menunjukkan persentase antara bidang pengetahuan dan keterampilan (40% dan 60%)', 1, '0000-00-00 00:00:00'),
(88, 'b', 'Laporan peninjauan ulang dan verifikasi struktur bahan kajian dan matakuliah', 1, '0000-00-00 00:00:00'),
(89, 'a', 'Pedoman Pelaksanaan kurikulum yang mencakup: 1) pemantauan dan peninjauan kurikulum; 2) umpan balik dari stakeholder; 3) isu-isu strategis', 1, '0000-00-00 00:00:00'),
(90, 'b', 'Laporan peninjauan ulang dan verifikasi', 1, '0000-00-00 00:00:00'),
(91, 'b', 'Laporan peninjauan ulang dan verifikasi.', 1, '0000-00-00 00:00:00'),
(92, 'a', 'Laporan hasil capaian Pembelajaran lulusan ', 1, '0000-00-00 00:00:00'),
(93, 'a', 'Pelaksanaan monitoring dan evaluasi di tingkat jurusan yang dilaksanakan oleh GKMI-J', 1, '0000-00-00 00:00:00'),
(94, 'b', 'Laporan hasil pelaksanaan evaluasi oleh GKMI-J', 1, '0000-00-00 00:00:00'),
(95, 'c', 'Pelaksanaan Rapat Tinjauan Manajemen (RTM) di tingkat jurusan', 1, '0000-00-00 00:00:00'),
(96, 'd', 'Pengendalian dan tndaklanjut hasil RTM', 1, '0000-00-00 00:00:00'),
(97, 'c', 'SK Auditor AMI.', 1, '0000-00-00 00:00:00'),
(98, 'e', 'Jadwal pelaksanaan RTM dan dokumentasi.', 1, '0000-00-00 00:00:00'),
(99, 'f', 'Hasil RTM (Peningkatan efektivitas SPMI dan prosesnya).', 1, '0000-00-00 00:00:00'),
(100, 'g', 'CQI/Kaizen.', 1, '0000-00-00 00:00:00'),
(101, 'a', 'Pedoman tertulis perumusan karakteristik pembelajaran sesuai SN Dikti', 1, '0000-00-00 00:00:00'),
(102, 'b', 'Peninjauan karakterisitk proses pembelajaran', 1, '0000-00-00 00:00:00'),
(103, 'a', 'Ceklist aspek penunjang karakteristik proses pembelajaran', 1, '0000-00-00 00:00:00'),
(104, 'a', 'Rencana Pembelajaran Semester (RPS)', 1, '0000-00-00 00:00:00'),
(105, 'b', 'Rekapitulasi RPS untuk semua matakuliah pada setiap program studi', 1, '0000-00-00 00:00:00'),
(106, 'a', 'Laporan kegiatan monitoring dan evaluasi karekterisitik proses pembelajaran', 1, '0000-00-00 00:00:00'),
(107, 'a', 'Kebijakan Penyusunan Rencana Pembelajaran Semester', 1, '0000-00-00 00:00:00'),
(108, 'b', 'Panduan Baku Penyusunan RPS ', 1, '0000-00-00 00:00:00'),
(109, 'c', 'Laporan kegiatan Peninjauan ulang RPS ', 1, '0000-00-00 00:00:00'),
(110, 'a', 'Laporan kegiatan pelaksanaan penyusunan RPS', 1, '0000-00-00 00:00:00'),
(111, 'b', 'Laporan hasil peninjauan ulang RPS untuk semua mata kuliah yang akan digunakan pada tahun akademik berikutnya ', 1, '0000-00-00 00:00:00'),
(112, 'a', 'Rekapitulasi kesesuain jumlah RPS dengan sebaran matakuliah setiap semester', 1, '0000-00-00 00:00:00'),
(113, 'b', 'Laporan kegiatan peninjauan RPS', 1, '0000-00-00 00:00:00'),
(114, 'a', 'Pedoman penerapan sistem penugasan dosen ', 1, '0000-00-00 00:00:00'),
(115, 'b', 'Laporan hasil evaluasi penerapan sistem penugasan dosen ', 1, '0000-00-00 00:00:00'),
(116, 'a', 'Pedoman yang komprehensif dan rinci tentang penetapan strategi, metode dan media pembelajaran, serta penilaian pembelajaran', 1, '0000-00-00 00:00:00'),
(117, 'b', 'Peninjauan ulang pedoman komprehensif dan rinci tentang penetapan strategi, metode dan media pembelajaran, serta penilaian pembelajaran', 1, '0000-00-00 00:00:00'),
(118, 'a', 'Penetapan, sosialisasi dan dokumentasi   pedoman yang komprehensif dan rinci tentang penetapan strategi, metode dan media pembelajaran, serta penilaian pembelajaran', 1, '0000-00-00 00:00:00'),
(119, 'a', 'Pelaksanaan proses pembelajaran (Jadwal Perkuliahan, Daftar hadir mahasiswa, dosen, kontrak materi kuliah yang menggambarkan sumber belajar, RPS, Modul/Bahan Ajar)', 1, '0000-00-00 00:00:00'),
(120, 'b', 'Laporan hasil monitoring pelaksanaan proses pembelajaran ', 1, '0000-00-00 00:00:00'),
(121, 'a', 'Laporan hasil pengabdian kepada masyarakat yang dilaksanakan oleh Dosen tetap program studi dengan melibatkan mahasiswa program studi', 1, '0000-00-00 00:00:00'),
(122, 'b', 'Laporan evaluasi pelaksanaan pengabdian masyarakat yang dilaksanakan oleh Dosen tetap program studi dengan melibatkan mahasiswa program studi', 1, '0000-00-00 00:00:00'),
(123, 'a', 'Laporan hasil penelitian yang dilaksanakan oleh Dosen tetap program studi dengan melibatkan mahasiswa program studi', 1, '0000-00-00 00:00:00'),
(124, 'b', 'Laporan evaluasi pelaksanaan penelitian yang dilaksanakan oleh Dosen tetap program studi dengan melibatkan mahasiswa program studi', 1, '0000-00-00 00:00:00'),
(125, 'a', 'Tabel 5.a. LKPS', 1, '0000-00-00 00:00:00'),
(126, 'a', 'Kebijakan dan pedoman yang komprehensif dan rinci untuk mengintegrasikan kegiatan peneltiian dan pengabdian kepada masyarakat ke dalam pembelajaran', 1, '0000-00-00 00:00:00'),
(127, 'b', 'Kegiatan evaluasi, pengendalian dan peningkatan kualitas kegiatan penelitian dan pengabdian kepada masyarakat dalam pembelajaran', 1, '0000-00-00 00:00:00'),
(128, 'c', 'SPMI melakukan monitoring dan evaluasi integrasi penelitian dan PkM terhadap pembelajaran yang ditindaklanjuti secara berkelanjutan', 1, '0000-00-00 00:00:00'),
(129, 'a', 'Pelaksanaan proses pembelajaran ', 1, '0000-00-00 00:00:00'),
(130, 'a', 'Dokumen pelaksanaan proses pembelajaran', 1, '0000-00-00 00:00:00'),
(131, 'b', 'RPS', 1, '0000-00-00 00:00:00'),
(132, 'c', 'Laporan hasil evaluasi pemilihan/ penggunaan metode pembelajaran oleh dosen pada setiap mata kuliah', 1, '0000-00-00 00:00:00'),
(133, 'a', 'Laporan hasil penelitian', 1, '0000-00-00 00:00:00'),
(134, 'b', 'Laporan evaluasi pelaksanaan bentuk pembelajran penelitian dan perancangan atau pengembangan', 1, '0000-00-00 00:00:00'),
(135, 'a', 'Laporan hasil pengebdian', 1, '0000-00-00 00:00:00'),
(136, 'b', 'Laporan hasil evaluasi proses pembelajaran yang terkait dengan PkM', 1, '0000-00-00 00:00:00'),
(137, 'a', 'Dokumen pelaksanaan proses pembelajaran dan monitoring pembelajaran', 1, '0000-00-00 00:00:00'),
(138, 'a', 'Kebijakan suasana akademik yang mencakup: otonomi keilmuan, kebebasan akademik, dan kebebasan mimbar akademik', 1, '0000-00-00 00:00:00'),
(139, 'b', 'Dokumentasi dan laporan kegiatan membangun suasana akademik ', 1, '0000-00-00 00:00:00'),
(140, 'a', 'Analisis dan perencanaan strategis pengembangan suasana akademik dan implementasinya secara efektif dan efisien ', 1, '0000-00-00 00:00:00'),
(141, 'a', 'Kebijakan tentang masa dan beban penyelenggaraan program pendidikan/Buku Peraturan Akademik Politeknik Negeri Medan', 1, '0000-00-00 00:00:00'),
(142, 'a', 'Laporan kegiatan sosialisasi kebijakan masa dan penyelenggaraan program pendidika', 1, '0000-00-00 00:00:00'),
(143, 'a', 'Kebijakan dan pedoman terkait pelaksanaan pemenuhan masa dan beban belajar ', 1, '0000-00-00 00:00:00'),
(144, 'b', 'Laporan hasil evaluasi terkait fasilitasi pelaksanaan pemenuhan masa dan beban belajar', 1, '0000-00-00 00:00:00'),
(145, 'a', 'Aplikasi SIAKAD, SIPADI', 1, '0000-00-00 00:00:00'),
(146, 'a', 'Pedoman penggunaan aplikasi', 1, '0000-00-00 00:00:00'),
(147, 'a', 'Lingkup AMI.', 1, '0000-00-00 00:00:00'),
(148, 'b', 'Jadwal pelaksanaan AMI.', 1, '0000-00-00 00:00:00'),
(149, 'c', 'Surat Keputusan Auditor AMI.', 1, '0000-00-00 00:00:00'),
(150, 'd', 'Laporan Audit.', 1, '0000-00-00 00:00:00'),
(151, 'e', 'Jadwal pelaksanaan Rapat Tinjauan Manajemen dan dokumentasi', 1, '0000-00-00 00:00:00'),
(152, 'f', 'Hasil Rapat Tinjauan Manajemen (Peningkatan efektivitas SPMI dan prosesnya).', 1, '0000-00-00 00:00:00'),
(153, 'g', 'CQI atau Kaizen', 1, '0000-00-00 00:00:00'),
(154, 'a', ' Pedoman  penilaian pembelajaran yang mencakup prinsip penilaian, teknik dan instrumen penilaian, mekanisme dan prosedur penilaian, pelaporan penilaian dan kelulusan mahasiswa ', 1, '0000-00-00 00:00:00'),
(155, 'b', 'Laporan kegaiatan Peninjauan pedoman penilaian pembelajaran', 1, '0000-00-00 00:00:00'),
(156, 'a', 'Laporan kegiatan sosialisasi pedoman penilaian pembelajaran ', 1, '0000-00-00 00:00:00'),
(157, 'a', 'Formulir penilaian pembelajaran', 1, '0000-00-00 00:00:00'),
(158, 'a', 'Formulir penilaian proses dan hasil belajar mahasiswa', 1, '0000-00-00 00:00:00'),
(159, 'a', 'Kontrak Materi Perkuliahan', 1, '0000-00-00 00:00:00'),
(160, 'a', 'Laporan kegiatan rapat evaluasi tingkat jurusan ', 1, '0000-00-00 00:00:00'),
(161, 'b', 'Laporan evaluasi akhir setiap program studi', 1, '0000-00-00 00:00:00'),
(162, 'c', 'Pelaporan niliai pada Web resmi Jurusan/Institusi', 1, '0000-00-00 00:00:00'),
(163, 'a', 'Buku Peraturan Akademik Politeknik Negeri Medan', 1, '0000-00-00 00:00:00'),
(164, 'a', 'Marksheet dan Laporan Akhir Evaluasi Program Studi', 1, '0000-00-00 00:00:00'),
(165, 'a', 'Ijazah, sertifikat kompetensi, gelar dan surat keterangan pendamping ijazah', 1, '0000-00-00 00:00:00'),
(166, 'a', 'Laporan jumlah mata kuliah yang dikembangkan berdasarkan hasil/integrasi kegiatan penelitian dan pengabdian kepada masyarakat dalam pembelajaran oleh dosen tetap program studi', 1, '0000-00-00 00:00:00'),
(167, 'a', 'Laporan kegiatan ilmiah yang terjadwal di setiap program studi/jurusan', 1, '0000-00-00 00:00:00'),
(168, 'a', 'Instrumen pengukuran tingkat kepuasan mahasiswa ', 1, '0000-00-00 00:00:00'),
(169, 'b', 'Tabel 5.c LKPS', 1, '0000-00-00 00:00:00'),
(170, 'c', 'Evaluasi dan tindak lanjut hasil pengukuran', 1, '0000-00-00 00:00:00'),
(171, 'a', 'Lingkup Audit Mutu Internal', 1, '0000-00-00 00:00:00'),
(172, 'b', 'Jadwal pelaksanaan Audit Mutu Internal', 1, '0000-00-00 00:00:00'),
(173, 'c', 'SK Auditor Audit Mutu Internal', 1, '0000-00-00 00:00:00'),
(174, 'd', 'Laporan Audit;', 1, '0000-00-00 00:00:00'),
(175, 'e', 'Jadwal pelaksanaan RTM dan dokumentasi;', 1, '0000-00-00 00:00:00'),
(176, 'f', 'Hasil Rapat Tinjauan Manajemen (Peningkatan efektivitas SPMI dan prosesnya)', 1, '0000-00-00 00:00:00'),
(177, 'g', 'CQI atau Kaizen.', 1, '0000-00-00 00:00:00'),
(178, 'a', 'Tabel kualifikasi akademik dan kompetensi pendidik', 1, '0000-00-00 00:00:00'),
(179, 'a', 'Kebijakan kualifikasi akademik dosen', 1, '0000-00-00 00:00:00'),
(180, 'a', 'Pedoman perhitungan beban kerja dosen', 1, '0000-00-00 00:00:00'),
(181, 'a', 'Laporan kinerja dosen', 1, '0000-00-00 00:00:00'),
(182, 'a', 'Surat Keterangan penempatan tugas dosen sesuai PD Dikti', 1, '0000-00-00 00:00:00'),
(183, 'a', 'Laporan kecukupan jumlah DTPS dalam Tabel 3.a.1 LKPS', 1, '0000-00-00 00:00:00'),
(184, 'a', 'Tabel 3.a.1 LKPT Kecukupan Dosen Perguruan Tinggi', 1, '0000-00-00 00:00:00'),
(185, 'a', 'Tabel 3.a.2) LKPT Jabatan Fungsional Dosen Lektor Kepala Ã¢â€°Â¥ 25% terhadap jumlah dosen tetap', 1, '0000-00-00 00:00:00'),
(186, 'a', 'Tabel 3.a.1. LKPS Kualifikasi akademik ', 1, '0000-00-00 00:00:00'),
(187, 'a', 'Tabel 3.a.1 LKPS Kualifikasi akademik ', 1, '0000-00-00 00:00:00'),
(188, 'a', 'Tabel 3.a.1 LKPS Jabatan Akademik DTPS ', 1, '0000-00-00 00:00:00'),
(189, 'a', 'Sertifikasi kompetensi/ profesi/industri DTPS yang tersaji pada Tabel 3.a.1 LKPS', 1, '0000-00-00 00:00:00'),
(190, 'a', 'Sertifikasi kompetensi/ profesi/industri yang tersaji pada Tabel 3.a.3) LKPT Sertifikasi Dosen', 1, '0000-00-00 00:00:00'),
(191, 'a', 'Rasio jumlah mahasiswa program studi terhadap jumlah DTPS yang tersaji pada Tabel 2.a LKPS dan Tabel 3.a.1 LKPS, untuk kelompok Sains Teknologi 10 Ã¢â€°Â¤ RMD  Ã¢â€°Â¤ 20', 1, '0000-00-00 00:00:00'),
(192, 'b', 'Rasio jumlah mahasiswa program studi terhadap jumlah DTPS yang tersaji pada Tabel 2.a LKPS dan Tabel 3.a.1 LKPS, untuk kelompok Sosial Humaniora 15 Ã¢â€°Â¤ RMD Ã¢â€°Â¤ 25', 1, '0000-00-00 00:00:00'),
(193, 'a', 'Rasio jumlah mahasiswa program studi terhadap jumlah DTPS yang tersaji pada Tabel 2.a LKPS dan Tabel 3.a.1 LKPS, untuk kelompok Sains Teknologi 15 Ã¢â€°Â¤ RMD  Ã¢â€°Â¤ 25', 1, '0000-00-00 00:00:00'),
(194, 'b', 'Rasio jumlah mahasiswa program studi terhadap jumlah DTPS yang tersaji pada Tabel 2.a LKPS dan Tabel 3.a.1 LKPS, untuk kelompok Sosial Humaniora 25 Ã¢â€°Â¤ RMD Ã¢â€°Â¤ 35', 1, '0000-00-00 00:00:00'),
(195, 'a', 'Tabel 3.b LKPT Beban Kerja Dosen', 1, '0000-00-00 00:00:00'),
(196, 'a', 'Tabel 3.a.2 LKPS Penugasan DTPS sebagai pembimbing utama', 1, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `institusi`
--

CREATE TABLE `institusi` (
  `institusiid` int(11) NOT NULL,
  `institusiCode` varchar(40) NOT NULL,
  `userid` int(11) NOT NULL,
  `istitusiName` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `address1` varchar(250) NOT NULL,
  `address2` varchar(250) NOT NULL,
  `negara` varchar(200) NOT NULL,
  `provinsi` varchar(200) NOT NULL,
  `city` varchar(200) NOT NULL,
  `pimpinan` varchar(150) NOT NULL,
  `nomorSKPT` varchar(150) NOT NULL,
  `tanggalSKPT` date NOT NULL,
  `logo` varchar(50) NOT NULL,
  `fax` varchar(200) NOT NULL,
  `postal` varchar(200) NOT NULL,
  `tanggalBerdiri` date NOT NULL,
  `bentukPerguruanTinggi` varchar(100) NOT NULL,
  `jenisPengelolaan` varchar(100) NOT NULL,
  `website` varchar(100) NOT NULL,
  `peringkat` varchar(25) NOT NULL,
  `nomorSKBanPT` varchar(100) NOT NULL,
  `createdDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `institusi`
--

INSERT INTO `institusi` (`institusiid`, `institusiCode`, `userid`, `istitusiName`, `email`, `phone`, `address1`, `address2`, `negara`, `provinsi`, `city`, `pimpinan`, `nomorSKPT`, `tanggalSKPT`, `logo`, `fax`, `postal`, `tanggalBerdiri`, `bentukPerguruanTinggi`, `jenisPengelolaan`, `website`, `peringkat`, `nomorSKBanPT`, `createdDate`) VALUES
(1, 'POLMED', 1, 'POLITEKNIK NEGERI MEDAN', 'polmed@polmed.ac.id', '082386283363', 'Jl. Almamater No.1', 'Padang Bulan Medan Baru,', 'Indonesia', 'Sumatera Utara', 'Medan', 'Abdul Rahman,SE.,Ak.,M.Si', '-', '2021-09-29', 'logo.png', 'fax', 'postal', '2021-09-29', '6', 'Pengelolaan A', 'polmed.com', '-', '-', '2021-08-14 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `institusidokumen`
--

CREATE TABLE `institusidokumen` (
  `dokumeninstitusiid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `institusiid` int(11) NOT NULL,
  `namaDokumen` text NOT NULL,
  `keterangan` text NOT NULL,
  `dataInstitusi` text NOT NULL,
  `createdDate` datetime NOT NULL,
  `berlaku` date NOT NULL,
  `expDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `istitusicomplete`
--

CREATE TABLE `istitusicomplete` (
  `institusicompleteid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `dataName` varchar(200) NOT NULL,
  `storage` varchar(200) NOT NULL,
  `createdDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `idJabatan` int(11) NOT NULL,
  `namaJabatan` varchar(50) NOT NULL,
  `userid` int(11) NOT NULL,
  `createdDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`idJabatan`, `namaJabatan`, `userid`, `createdDate`) VALUES
(4, 'Asisten', 1, '2021-11-13 08:14:01');

-- --------------------------------------------------------

--
-- Table structure for table `jadwalpelaksanaan`
--

CREATE TABLE `jadwalpelaksanaan` (
  `idJadwalPelaksanaan` int(11) NOT NULL,
  `idUnit` int(11) NOT NULL,
  `idtahun` int(11) NOT NULL,
  `idperiode` int(11) NOT NULL,
  `tglTugas` date NOT NULL,
  `tglBerakhir` date NOT NULL,
  `status` double NOT NULL,
  `userid` int(11) NOT NULL,
  `createdDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jenisps`
--

CREATE TABLE `jenisps` (
  `jenisid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `jenis` text NOT NULL,
  `createdDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jenjang`
--

CREATE TABLE `jenjang` (
  `idJenjang` int(11) NOT NULL,
  `namaJenjang` varchar(200) NOT NULL,
  `userid` int(11) NOT NULL,
  `createdDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenjang`
--

INSERT INTO `jenjang` (`idJenjang`, `namaJenjang`, `userid`, `createdDate`) VALUES
(6, 'Diploma 4 (D4)', 1, '2021-11-24 09:37:04'),
(7, 'Diploma 3 (D3)', 1, '2021-11-24 09:37:17'),
(9, 'Magister Terapan', 1, '2021-12-01 09:22:06');

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE `jurusan` (
  `jurusanid` int(11) NOT NULL,
  `jurusanKode` varchar(50) NOT NULL,
  `jurusanName` varchar(100) NOT NULL,
  `tglBerdiri` date NOT NULL,
  `noskJurusan` varchar(50) NOT NULL,
  `userid` int(11) NOT NULL,
  `createdDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`jurusanid`, `jurusanKode`, `jurusanName`, `tglBerdiri`, `noskJurusan`, `userid`, `createdDate`) VALUES
(114, '20', 'Teknik Elektro', '2021-11-17', '-', 1, '2021-11-17 15:12:55'),
(115, '21', 'Teknik Mesin', '2021-11-17', '-', 1, '2021-11-17 15:13:36'),
(116, '22', 'Teknik Sipil', '2021-11-17', '-', 1, '2021-11-17 15:13:49'),
(117, '56', 'Teknik Komputer dan Informatika', '2021-11-17', '-', 1, '2021-11-17 15:14:19'),
(118, '60', 'Akuntansi', '2021-11-17', '-', 1, '2021-11-17 15:14:36'),
(119, '63', 'Administrasi Niaga', '2021-11-17', '-', 1, '2021-11-17 15:14:54');

-- --------------------------------------------------------

--
-- Table structure for table `keys`
--

CREATE TABLE `keys` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `key` varchar(40) NOT NULL,
  `level` int(2) NOT NULL,
  `ignoreLimits` tinyint(1) NOT NULL DEFAULT '0',
  `isPrivateKey` tinyint(1) NOT NULL DEFAULT '0',
  `ipAddress` text,
  `createdDate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `keys`
--

INSERT INTO `keys` (`id`, `user_id`, `key`, `level`, `ignoreLimits`, `isPrivateKey`, `ipAddress`, `createdDate`) VALUES
(1, 1, 'abraham123', 1, 0, 0, NULL, 1),
(2, 3, 'rahasia', 1, 0, 0, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `lampirandokumen`
--

CREATE TABLE `lampirandokumen` (
  `idLampiranDokumen` int(11) NOT NULL,
  `lampiranid` varchar(50) NOT NULL,
  `userid` int(11) NOT NULL,
  `namaLampiran` varchar(200) NOT NULL,
  `keterangan` text NOT NULL,
  `namafile` varchar(250) NOT NULL,
  `linkfile` varchar(250) NOT NULL,
  `createdDate` datetime NOT NULL,
  `berlaku` date NOT NULL,
  `expDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `limits`
--

CREATE TABLE `limits` (
  `id` int(11) NOT NULL,
  `uri` varchar(255) NOT NULL,
  `count` int(10) NOT NULL,
  `hourStarted` int(11) NOT NULL,
  `apiKey` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `logid` int(11) NOT NULL,
  `activity` varchar(200) NOT NULL,
  `activityDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `loginstatus`
--

CREATE TABLE `loginstatus` (
  `loginid` int(11) NOT NULL,
  `statusLogin` varchar(200) NOT NULL,
  `loginDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lokasi`
--

CREATE TABLE `lokasi` (
  `idLokasi` int(11) NOT NULL,
  `namaNegara` varchar(200) NOT NULL,
  `namaProvinsi` varchar(200) NOT NULL,
  `namaKota` varchar(200) NOT NULL,
  `userid` int(11) NOT NULL,
  `createdDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lokasi`
--

INSERT INTO `lokasi` (`idLokasi`, `namaNegara`, `namaProvinsi`, `namaKota`, `userid`, `createdDate`) VALUES
(1, 'Indonesia', 'Sumatera Utara', 'Medan', 1, '2021-09-12 14:50:13'),
(2, 'Indonesia', 'Sumatera Utara', 'Siantar', 1, '2021-09-12 14:50:13');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id` int(11) NOT NULL,
  `nrp` char(30) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `email` varchar(250) DEFAULT NULL,
  `jurusan` varchar(64) NOT NULL,
  `createdDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pelaksanaan`
--

CREATE TABLE `pelaksanaan` (
  `idPelaksanaan` int(11) NOT NULL,
  `idprogramstudi` int(11) NOT NULL,
  `idTC` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `hasilAudit` varchar(220) NOT NULL,
  `berlaku` date NOT NULL,
  `expired` date NOT NULL,
  `catatanAuditor` text NOT NULL,
  `createdDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pelaksanaanaudit`
--

CREATE TABLE `pelaksanaanaudit` (
  `idPelaksanaanAudit` int(11) NOT NULL,
  `idprogramstudi` int(11) NOT NULL,
  `idTC` int(11) NOT NULL,
  `auditid` int(11) NOT NULL,
  `catatan` text NOT NULL,
  `lengkap` tinyint(1) NOT NULL,
  `lulus` tinyint(1) NOT NULL,
  `createdDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `penanggungjawab`
--

CREATE TABLE `penanggungjawab` (
  `idPenanggungJawab` int(11) NOT NULL,
  `namaPenanggungJawab` varchar(200) NOT NULL,
  `userid` int(11) NOT NULL,
  `createdDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `penetapandepartemen`
--

CREATE TABLE `penetapandepartemen` (
  `idPenetapanDepartemen` int(11) NOT NULL,
  `jenisPenetapanDepartemen` varchar(200) NOT NULL,
  `userid` int(11) NOT NULL,
  `createdDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penetapandepartemen`
--

INSERT INTO `penetapandepartemen` (`idPenetapanDepartemen`, `jenisPenetapanDepartemen`, `userid`, `createdDate`) VALUES
(6, 'Visi Misi Jurusan', 1, '2021-12-04 09:34:42');

-- --------------------------------------------------------

--
-- Table structure for table `penetapandetailspmi`
--

CREATE TABLE `penetapandetailspmi` (
  `penetapanDetailId` int(10) NOT NULL,
  `penetapanId` int(10) NOT NULL,
  `indikatorDokumen` int(10) NOT NULL,
  `catatan` text NOT NULL,
  `linkProdi` text NOT NULL,
  `penilaian` int(10) DEFAULT NULL,
  `status` char(250) NOT NULL,
  `keterangan` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penetapandetailspmi`
--

INSERT INTO `penetapandetailspmi` (`penetapanDetailId`, `penetapanId`, `indikatorDokumen`, `catatan`, `linkProdi`, `penilaian`, `status`, `keterangan`) VALUES
(1, 8, 8, '', '', NULL, '', ''),
(2, 8, 7, '', '', NULL, '', ''),
(3, 8, 6, '', '', NULL, '', ''),
(4, 8, 5, '', '', NULL, '', ''),
(5, 8, 4, '', '', NULL, '', ''),
(6, 9, 174, 'D', 'https://', 15, '', 'd'),
(7, 9, 173, 'C', 'c', 15, '', 'c'),
(8, 9, 172, 'B', 'b', 14, '', 'b'),
(9, 9, 1, 'A', 'a', 15, '', 'a');

-- --------------------------------------------------------

--
-- Table structure for table `penetapaninstitusi`
--

CREATE TABLE `penetapaninstitusi` (
  `idPenetapanInstitusi` int(11) NOT NULL,
  `jenisPenetapan` varchar(200) NOT NULL,
  `userid` int(11) NOT NULL,
  `createdDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penetapaninstitusi`
--

INSERT INTO `penetapaninstitusi` (`idPenetapanInstitusi`, `jenisPenetapan`, `userid`, `createdDate`) VALUES
(7, 'History', 1, '2021-11-22 12:06:30');

-- --------------------------------------------------------

--
-- Table structure for table `penetapanstandarspmi`
--

CREATE TABLE `penetapanstandarspmi` (
  `penetapanid` int(11) NOT NULL,
  `idprogramstudi` int(11) NOT NULL,
  `periode` int(11) NOT NULL,
  `idAuditor` int(10) DEFAULT NULL COMMENT 'id auditor yang melalkukan penilaian',
  `userid` int(11) NOT NULL,
  `createdDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penetapanstandarspmi`
--

INSERT INTO `penetapanstandarspmi` (`penetapanid`, `idprogramstudi`, `periode`, `idAuditor`, `userid`, `createdDate`) VALUES
(4, 10053, 20, NULL, 1, '2022-01-20 11:03:22'),
(5, 10053, 20, NULL, 1, '2022-01-20 11:11:24'),
(6, 10053, 20, NULL, 1, '2022-01-20 11:18:33'),
(7, 10053, 20, NULL, 1, '2022-01-20 11:18:49'),
(8, 10051, 20, NULL, 1, '2022-01-20 11:24:45'),
(9, 10051, 21, 1, 1, '2022-01-20 11:26:22');

-- --------------------------------------------------------

--
-- Table structure for table `pengelolanpt`
--

CREATE TABLE `pengelolanpt` (
  `pengelolaanptid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `jenisPengelola` varchar(200) NOT NULL,
  `createdDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengelolanpt`
--

INSERT INTO `pengelolanpt` (`pengelolaanptid`, `userid`, `jenisPengelola`, `createdDate`) VALUES
(7, 1, 'Negara', '2021-11-22 12:02:47');

-- --------------------------------------------------------

--
-- Table structure for table `penilaian`
--

CREATE TABLE `penilaian` (
  `idPenilaian` int(11) NOT NULL,
  `namaPenilaian` varchar(200) NOT NULL,
  `warna` varchar(100) NOT NULL,
  `bobot` double NOT NULL,
  `userid` int(11) NOT NULL,
  `createdDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penilaian`
--

INSERT INTO `penilaian` (`idPenilaian`, `namaPenilaian`, `warna`, `bobot`, `userid`, `createdDate`) VALUES
(14, 'Cukup', 'green', 6, 1, '2022-01-16 20:53:29'),
(15, 'Memuaskan', 'hijau', 10, 87, '2022-01-01 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `peringkatakreditasi`
--

CREATE TABLE `peringkatakreditasi` (
  `rankid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `rank` varchar(30) NOT NULL,
  `createdDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `peringkatakreditasi`
--

INSERT INTO `peringkatakreditasi` (`rankid`, `userid`, `rank`, `createdDate`) VALUES
(6, 1, 'Akreditasi A', '2021-11-21 19:39:20'),
(7, 1, 'Akreditasi B', '2021-11-21 19:53:11');

-- --------------------------------------------------------

--
-- Table structure for table `periode`
--

CREATE TABLE `periode` (
  `idPeriode` int(11) NOT NULL,
  `tahunPeriode` varchar(50) NOT NULL,
  `namaPeriode` varchar(220) NOT NULL,
  `mulaiPelaksanaan` date NOT NULL,
  `akhirPelaksanaan` date NOT NULL,
  `mulaiPenilaian` date NOT NULL,
  `akhirPenilaian` date NOT NULL,
  `status` double NOT NULL,
  `userid` int(11) NOT NULL,
  `createdDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `periode`
--

INSERT INTO `periode` (`idPeriode`, `tahunPeriode`, `namaPeriode`, `mulaiPelaksanaan`, `akhirPelaksanaan`, `mulaiPenilaian`, `akhirPenilaian`, `status`, `userid`, `createdDate`) VALUES
(20, '2022', 'A', '2022-01-16', '2022-01-18', '2022-01-21', '2022-01-28', 1, 1, '2022-01-13 16:21:18'),
(21, '2021', 'Semester B TA 2021 2022', '2022-02-01', '2022-02-11', '2022-02-14', '2022-02-25', 0, 1, '2022-01-13 16:18:15');

-- --------------------------------------------------------

--
-- Table structure for table `pernyataan`
--

CREATE TABLE `pernyataan` (
  `pernyataanId` int(11) NOT NULL,
  `kodeSubStandar` varchar(100) NOT NULL,
  `kodePernyataan` varchar(100) NOT NULL,
  `namaPernyataan` text NOT NULL,
  `userid` int(11) NOT NULL,
  `createdDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pernyataan`
--

INSERT INTO `pernyataan` (`pernyataanId`, `kodeSubStandar`, `kodePernyataan`, `namaPernyataan`, `userid`, `createdDate`) VALUES
(1, 'STD-01.01/SPMI', '1', 'Direktur  menetapkan profil lulusan program studi yang didokumentasikan dan disosialisasikan dalam bentuk Buku Informasi  Politeknik Negeri Medan maupun di website dan  dilakukan peninjauan ulang minimal 1 kali per tahun', 1, '0000-00-00 00:00:00'),
(2, 'STD-01.01/SPMI', '2', 'Ketua Pusat pengembangan Pendidikan dan Aktivitas Instruksional (P3AI) harus berkoordinasi dengan Wakil Direktur  I untuk menyusun dan mengembangkan pedoman penyusunan rumusan capaian pembelajaran lulusan untuk setiap jenjang program pendidikan sesuai dengan  jenjang  kualifikasi pada KKNI, dan dilakukan peninjauan berkala minimal satu  kali dalam tiga tahun.', 1, '0000-00-00 00:00:00'),
(3, 'STD-01.01/SPMI', '3', 'Ketua Pusat Pengembangan Pendidikan dan Aktivitas Instruksional (P3AI) harus mensosialisasikan Buku Pedoman Penyusunan Capaian Pembalajaran Lulusan minimal satu kali sebelum waktu penyusunan dan pengembangan kurikulum program studi.', 1, '0000-00-00 00:00:00'),
(4, 'STD-01.01/SPMI', '4', 'Ketua Jurusan/Kepala Program Studi wajib menyusun rumusan sikap, pengetahuan, keterampilan umum dan khusus, dan pengalaman kerja mahasiswa sebagai bagian dari capaian pembelajaran lulusan sesuai dengan jenjang kualifikasi pada KKNI dan  dilakukan peninjauan berkala minimal satu kali dalam 4  tahun.', 1, '0000-00-00 00:00:00'),
(5, 'STD-01.01/SPMI', '5', 'Ketua Jurusan/KPS harus berkoordinasi dengan Kepala Bagian Administrasi Akademik dan Kemahasiswaan untuk memastikan rata-rata IPK mahasiswa program studi  Ã¢â€°Â¥ 3.25 setiap akhir tahun akademik\n', 1, '0000-00-00 00:00:00'),
(6, 'STD-01.01/SPMI', '6', 'Wakil Direktur I harus memastikan persentase jumlah lulusan yang memiliki sertifikat kompetensi/ profesi/industri dalam 3 tahun terakhir  Ã¢â€°Â¥ 30%. ', 1, '0000-00-00 00:00:00'),
(7, 'STD-01.01/SPMI', '7', 'Ketua Jurusan/Kepala Program Studi berkoordinasi dengan Wakil DIrektur I dan III harus memastikan jumlah prestasi akademik mahasiswa di tingkat provinsi/wilayah, nasional, dan/atau  internasional  terhadap jumlah  mahasiswa  dalam  3 tahun  terakhir untuk Program Diploma 3  Ã‚Â³ 0,05%, untuk Program Diploma 4  Ã¢â€°Â¥ 0,1%, dan untuk Program Magister Terapan  Ã¢â€°Â¥ 0,5%,\n', 1, '0000-00-00 00:00:00'),
(8, 'STD-01.01/SPMI', '8', 'Wakil DIrektur I dan III harus memastikan jumlah prestasi akademik mahasiswa di tingkat provinsi/wilayah, nasional, dan/atau  internasional  terhadap jumlah  mahasiswa  dalam  3 tahun    Ã¢â€°Â¥ 0,05%,\n', 1, '0000-00-00 00:00:00'),
(9, 'STD-01.01/SPMI', '9', 'Ketua Jurusan/Kepala Program Studi berkoordinasi dengan Wakil Direktur III harus memastikan jumlah prestasi non akademik mahasiswa di tingkat provinsi/wilayah, nasional, dan/atau  internasional  terhadap jumlah  mahasiswa  dalam  3 tahun  terakhir ', 1, '0000-00-00 00:00:00'),
(10, 'STD-01.01/SPMI', '10', 'Wakil Direktur III harus memastikan jumlah prestasi non akademik mahasiswa di tingkat provinsi/wilayah, nasional, dan/atau  internasional  terhadap jumlah  mahasiswa  dalam  3 tahun  terakhir Ã¢â€°Â¥ 0,1%', 1, '0000-00-00 00:00:00'),
(11, 'STD-01.01/SPMI', '11', 'Ketua Jurusan/Kepala Program Studi berkoordinasi dengan Kepala Bagian Administrasi Akademik dan Kemahasiswaan harus memastikan lama studi mahasiswa untuk Program Diploma 3 adalah antara 3 tahun sampai dengan 3,5 tahun\n', 1, '0000-00-00 00:00:00'),
(12, 'STD-01.01/SPMI', '12', 'Ketua Jurusan/Kepala Program Studi berkoordinasi dengan Kepala Bagian Administrasi Akademik dan Kemahasiswaan harus memastikan lama studi mahasiswa untuk Program Diploma 4 adalah antara 3,5 tahun sampai dengan 4,5 tahun', 1, '0000-00-00 00:00:00'),
(13, 'STD-01.01/SPMI', '13', 'Ketua Jurusan/Kepala Program Studi berkoordinasi dengan Kepala Bagian Administrasi Akademik dan Kemahasiswaan harus memastikan lama studi mahasiswa untuk Program Magister Terapan adalah antara 1,5 tahun sampai dengan 2,5 tahun\n', 1, '0000-00-00 00:00:00'),
(14, 'STD-01.01/SPMI', '14', 'Ketua Jurusan/Kepala Program Studi Diploma 3 dan Diploma 4 harus berkoordinasi dengan Kepala Bagian Administrasi Akademik dan Kemahasiswaan memastikan  persentase lulusan tepat waktu pada program studi Ã¢â€°Â¥ 70%', 1, '0000-00-00 00:00:00'),
(15, 'STD-01.01/SPMI', '15', 'Ketua Jurusan/Kepala Program Studi Magister Terapan harus berkoordinasi dengan Kepala Bagian Administrasi Akademik dan Kemahasiswaan memastikan  persentase lulusan tepat waktu pada program studi Ã¢â€°Â¥ 50%\n', 1, '0000-00-00 00:00:00'),
(16, 'STD-01.01/SPMI', '16', 'Kepala Bagian Administrasi Akademik dan Kemahasiswaan berkoordinasi dengan Wakil Direktur I memastikan  persentase lulusan tepat waktu untuk setiap program pendidikan  Ã¢â€°Â¥ 50%\n', 1, '0000-00-00 00:00:00'),
(17, 'STD-01.01/SPMI', '17', 'Ketua Jurusan/Kepala Program Studi  harus berkoordinasi dengan Wakil Direktur I memastikan Keberhasilan studi untuk setiap program Ã¢â€°Â¥ 85% \n', 1, '0000-00-00 00:00:00'),
(18, 'STD-01.01/SPMI', '18', 'Ketua Jurusan/Kepala Program Studi berkoordinasi dengan CDC untuk melaksanakan tracer study secara reguler setiap tahun  yang hasilnya disosialisasikan serta digunakan untuk pengembangan kurikulum dan\npembelajaran\n\n\n', 1, '0000-00-00 00:00:00'),
(19, 'STD-01.01/SPMI', '19', 'Ketua Jurusan/Kepala Program Studi harus berkoordinasi dengan  Center Development Carrier (CDC) memastikan lama waktu tunggu lulusan program utama  untuk mendapatkan pekerjaan Ã¢â€°Â¤ 3 bulan dalam 3 tahun terakhir', 1, '0000-00-00 00:00:00'),
(20, 'STD-01.01/SPMI', '20', 'Ketua Jurusan/Kepala Program Studi Diploma 3 harus berkoordinasi dengan  Center Development Carrier (CDC) memastikan persentase kesesuaian bidang kerja lulusan saat mendapatkan pekerjaan pertama Ã¢â€°Â¥ 80% dalam 3 tahun terakhir', 1, '0000-00-00 00:00:00'),
(21, 'STD-01.01/SPMI', '21', 'Ketua Jurusan/Kepala Program Studi Diploma 4 dan Magister Terapan harus berkoordinasi dengan  Center Development Carrier (CDC) memastikan persentase kesesuaian bidang kerja lulusan saat mendapatkan pekerjaan pertama Ã¢â€°Â¥ 60% dalam 3 tahun terakhir', 1, '0000-00-00 00:00:00'),
(22, 'STD-01.01/SPMI', '22', 'Center Development Carrier (CDC) harus memastikan persentase kesesuaian bidang kerja lulusan Politeknik Negeri Medan saat mendapatkan pekerjaan pertama Ã¢â€°Â¥ 80% dalam 3 tahun terakhir', 1, '0000-00-00 00:00:00'),
(23, 'STD-01.01/SPMI', '23', 'Ketua Jurusan/Kepala Program Studi Diploma 3 dan Diploma 4 harus berkoordinasi dengan Center Development Carrier  untuk memastikan Tingkat dan ukuran tempat kerja lulusan Ã¢â€°Â¥ 5% ', 1, '0000-00-00 00:00:00'),
(24, 'STD-01.01/SPMI', '24', 'CDC harus mengukur tingkat kepuasan pengguna lulusan yang dinilai dari aspek: etika, keahlian pada bidang ilmu (kompetensi utama), kemampuan berbahasa asing, penggunaan teknologi informasi, kemampuan berkomunikasi, kerja sama tim, dan pengembangan diri  untuk pengguna lulusan dalam 3 tahun sekali', 1, '0000-00-00 00:00:00'),
(25, 'STD-01.01/SPMI', '25', 'Ketua Jurusan/Kepala Program Studi Diploma 3 harus memastikan produk/jasa karya mahasiswa, yang dihasilkan secara mandiri atau bersama Dosen Tetap Program Studi, yang diadopsi oleh industri/ masyarakat dalam 3 tahun terakhir Ã¢â€°Â¥ 1', 1, '0000-00-00 00:00:00'),
(26, 'STD-01.01/SPMI', '26', 'Center Development Carrier (CDC) harus memastikan persentase tingkat dan tempat kerja lulusan  Ã¢â€°Â¥ 5% dalam 3 tahun terakhir', 1, '0000-00-00 00:00:00'),
(27, 'STD-01.01/SPMI', '27', 'Ketua Jurusan/Kepala Program Studi harus merumuskan pedoman kompetensi lulusan  dan dilakukan peninjauan minimal 1 kali per tahun ', 1, '0000-00-00 00:00:00'),
(28, 'STD-01.01/SPMI', '28', 'Ketua Jurusan/Kepala program Studi harus melakukan evaluasi kompetensi lulusan setiap satu tahun sekali', 1, '0000-00-00 00:00:00'),
(29, 'STD-01.01/SPMI', '29', 'Wakil Direktur I, II, dan III menetapkan pedoman pelaksanaan pengalaman kerja mahasiswa yang berbentuk pelatihan kerja, kerja praktik, praktik kerja lapangan atau bentuk kegiatan lain yang sejenis dan dilakukan peninjauan ulang minimal satu kali pada akhir tahun akademik.', 1, '0000-00-00 00:00:00'),
(30, 'STD-01.01/SPMI', '30', 'Wakil Direktur III harus menetapkan pedoman pelaksanaan peningkatan kemampuan lulusan melalui kegiatan ekstra kurikuler/ tambahan yang dilaksanakan minimal satu kali per tahun', 1, '0000-00-00 00:00:00'),
(31, 'STD-01.01/SPMI', '31', 'Wakil Direktur III harus melakukan kegiatan monitoring peningkatan kemampuan lulusan melalui kegiatan ekstrakurikuler minimal satu kali setiap akhir tahun akademik', 1, '0000-00-00 00:00:00'),
(32, 'STD-01.01/SPMI', '32', 'Wakil Direktur I menunjuk LSP P1 Politeknik Negeri Medan untuk menyelenggarakan pelaksanaan uji kompetensi bagi mahasiswa setiap tahunnya', 1, '0000-00-00 00:00:00'),
(33, 'STD-01.01/SPMI', '33', 'LSP harus menyediakan pedoman pelaksanaan uji kompetensi dan dilakukan peninjauan ulang minimal satu kali dalam dua tahun', 1, '0000-00-00 00:00:00'),
(34, 'STD-01.01/SPMI', '34', 'LSP harus memastikan ketersediaan asesor kompetensi sesuai Peraturan Perundangan yang berlaku', 1, '0000-00-00 00:00:00'),
(35, 'STD-01.01/SPMI', '35', 'LSP harus memenuhi target ketercapaian kepemilikan sertifikat kompetensi mahasiswa untuk Program Diploma 3 dan 4 setiap tahunnya ', 1, '0000-00-00 00:00:00'),
(36, 'STD-01.01/SPMI', '36', 'LSP harus mengevaluasi pelaksanaan uji kompetensi setiap akhir tahun akademik', 1, '0000-00-00 00:00:00'),
(37, 'STD-01.01/SPMI', '37', 'Direktur harus menetapkan kebijakan terkait kewajiban mahasiswa akhir untuk mengikuti uji kemampuan Bahasa Inggris  (TOEIC)', 1, '0000-00-00 00:00:00'),
(38, 'STD-01.01/SPMI', '38', 'UPT Bahasa berkoordinasi dengan Wakil Direktur I untuk menetapkan nilai kelulusan mahasiswa Program Diploma 3 dan Program Diploma 4 dalam uji kemampuan bahasa Inggris  (TOEIC)', 1, '0000-00-00 00:00:00'),
(39, 'STD-01.01/SPMI', '39', 'CDC (Center Development Career) harus memastikan melalui Tracer study, persentase jumlah lulusan yang mendapatkan pekerjaan yang layak dengan masa tunggu kurang dari 6 bulan setelah tanggal terbit ijazah', 1, '0000-00-00 00:00:00'),
(40, 'STD-01.01/SPMI', '40', 'Wakil Direktur III harus memastikan ketercapaian target lulusan yang berwirausaha untuk Diploma 3 dan Diploma 4 pada setiap akhir tahun akademik', 1, '0000-00-00 00:00:00'),
(41, 'STD-01.01/SPMI', '41', 'CDC harus memastikan persentase jumlah lulusan dalam kriteria kelanjutan studi kurang dari 6 bulan setelah tanggal terbit ijazah Ã¢â€°Â¥ 0,3%', 1, '0000-00-00 00:00:00'),
(42, 'STD-01.01/SPMI', '42', 'Ketua Jurusan/Kepala Program Studi berkoordinasi dengan CDC harus mengukur jumlah lulusan yang bekerja di badan usaha tingkat internasional/ multi nasional/ badan usaha tingkat nasional atau berwirausaha yang berizin/ badan usaha tingkat wilayah/lokal atau berwirausaha tidak berizin minimal 5% setiap tahun', 1, '0000-00-00 00:00:00'),
(43, 'STD-01.01/SPMI', '43', 'CDC harus mengukur jumlah lulusan yang bekerja di badan usaha tingkat internasional/ multi nasional/ badan usaha tingkat nasional atau berwirausaha yang berizin/ badan usaha tingkat wilayah/lokal atau berwirausaha tidak berizin minimal 5% setiap tahun', 1, '0000-00-00 00:00:00'),
(44, 'STD-01.01/SPMI', '44', 'CDC  harus melaksanakan tracer study yang mencakup 5 aspek pada setiap akhir tahun akademik, mensosialisasikan hasil pelaksanaan tracer study dan mengevaluasi pelaksanaannya pada setiap awal tahun akademik berikutnya', 1, '0000-00-00 00:00:00'),
(45, 'STD-01.01/SPMI', '45', 'Ketua Jurusan/Kepala Program Studi harus memastikan ada Produk/jasa karya mahasiswa, yang dihasilkan secara mandiri atau bersama DTPS, yang diadopsi oleh industri/masyarakat dalam 3 tahun terakhir\n', 1, '0000-00-00 00:00:00'),
(46, 'STD-01.01/SPMI', '46', 'UPT Bahasa harus memastikan persentase jumlah mahasiswa yang lulus uji kemampuan Bahasa Inggris (TOEIC) bagi setiap jenjang pendidikan adalah sebesar 35% dari jumlah peserta uji kompetensi bahasa inggris', 1, '0000-00-00 00:00:00'),
(47, 'STD-01.01/SPMI', '47', 'UPT Bahasa mengevaluasi pelaksanaan uji kompetensi setiap akhir tahun akademik', 1, '0000-00-00 00:00:00'),
(48, 'STD-01.01/SPMI', '48', 'Direktur Politeknik Negeri Medan mewajibkan mahasiswa baru mengikuti  Pembinaan Mental Fisik dan Disipin pada setiap tahun akademik', 1, '0000-00-00 00:00:00'),
(49, 'STD-01.01/SPMI', '49', 'Direktur melakukan kegiatan pemantauan/evaluasi mutu lulusan secara rutin minimal 1 kali per tahun dengan melibatkan SPMI, AMI, dan GKMIJ. ', 1, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `programstudi`
--

CREATE TABLE `programstudi` (
  `idprogramstudi` int(11) NOT NULL,
  `programStudiCode` varchar(50) NOT NULL,
  `jurusanKode` varchar(11) NOT NULL,
  `namaProgramStudi` varchar(50) NOT NULL,
  `tglBerdiri` date NOT NULL,
  `numberSK` varchar(100) NOT NULL,
  `jenjang` int(50) NOT NULL,
  `peringkatAkreditasi` varchar(20) NOT NULL,
  `noSKBANPT` varchar(50) NOT NULL,
  `tglexp` date NOT NULL,
  `userid` int(11) NOT NULL,
  `createdDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `programstudi`
--

INSERT INTO `programstudi` (`idprogramstudi`, `programStudiCode`, `jurusanKode`, `namaProgramStudi`, `tglBerdiri`, `numberSK`, `jenjang`, `peringkatAkreditasi`, `noSKBANPT`, `tglexp`, `userid`, `createdDate`) VALUES
(10037, '21401', '21', 'Teknik Mesin', '2021-11-17', '35/DIKTI/Kep/1990', 7, 'Akreditasi B', '2317/SK/BAN-PT/Akred/Dipl-III/X/2016', '2021-11-17', 1, '2021-11-17 20:39:46'),
(10038, '21406', '21', 'Teknik Konversi Energi ', '2021-11-17', '35/DIKTI/Kep/1990', 7, 'Akreditasi B', '294/SK/BAN-PT/Ak-PPJ/Dipl-III/I/2021', '2021-11-17', 1, '2021-11-17 20:40:56'),
(10039, '22401', '22', 'Teknik Sipil', '0000-00-00', '35/DIKTI/Kep/1990', 7, 'Akreditasi B', '35/DIKTI/Kep/1990', '0000-00-00', 1, '2021-11-17 20:42:28'),
(10040, '22301', '22', 'Teknik Perancangan Jalan dan Jembatan', '0000-00-00', '4308/D/T/2008', 6, 'Akreditasi B', '3328/SK/BAN-PT/Akred/ST/iX/2019', '0000-00-00', 1, '2021-11-17 20:44:11'),
(10041, '22302', '22', 'Manajemen Rekayasa Konstruksi Gedung', '0000-00-00', '4308/D/T/2008', 6, 'Akreditasi B', ' 2195/SK/BAN-PT/Ak-PPJ/ST/IV/2020', '2021-11-17', 1, '2021-11-17 20:47:12'),
(10042, '20403', '20', 'Teknik Listrik', '2021-11-17', '35/DIKTI/Kep/1990', 7, 'Akreditasi A', '1069/SK/BAN-PT/Akred/Dpl-III/IV/2019', '2022-03-23', 1, '2021-11-17 20:53:38'),
(10043, '20401', '20', 'Teknik Elektronika', '2021-11-17', '35/DIKTI/Kep/1990', 7, 'Akreditasi B', '5264/SK/BAN-PT/Akred/Dipl-III/XII/2017 2', '2021-11-17', 1, '2021-11-17 20:55:21'),
(10044, '20402', '20', 'Teknik Telekomunikasi', '2021-11-18', '35/DIKTI/Kep/1990', 7, 'Akreditasi B', '779/SK/BAN-PT/Akred/Dipl-III/III/2018', '2022-03-23', 1, '2021-11-18 09:37:25'),
(10045, '57401', '56', 'Manajemen Informatika', '2009-08-31', '3353/D/T/K-N/2009', 7, 'Akreditasi B', '2328/SK/BAN-PT/Ak-PPJ/Dipl-III/IV/2021', '2021-09-01', 1, '2021-11-18 10:08:15'),
(10046, '56407', '56', 'Teknik Komputer', '2009-08-31', '3353/D/T/K-N/2009', 7, 'Akreditasi B', '75/SK/BAN-PT/Akred/Dipl-III/I/2018', '2021-09-01', 1, '2021-11-18 10:27:40'),
(10047, '61406', '60', 'Perbankan dan Keuangan', '2021-11-18', '35/DIKTI/Kep/1990', 7, 'Akreditasi A', '140/SK/BAN-PT/Ak-PPJ/Dipl-III/I/2021', '2022-03-23', 1, '2021-11-18 10:49:26'),
(10048, '62401', '60', 'Akuntansi', '2021-11-18', '35/DIKTI/Kep/1990', 7, 'Akreditasi B', '7434/SK/BAN-PT/Ak-PPJ/Dipl-III/XI/2020', '2022-03-23', 1, '2021-11-18 11:09:44'),
(10049, '60304', '60', 'Keuangan dan Perbankan Syariah', '2013-09-27', '441/E/O/2013', 6, 'Akreditasi B', '85/SK/BAN-PT/Akred/Dipl-IV/2018', '2021-09-27', 1, '2021-11-18 11:11:58'),
(10050, '62303', '60', 'Akuntansi Keuangan Publik', '2013-07-02', '260/E/O/2013', 6, 'Akreditasi B', '4717/SK/BAN-PT/Akred/Dipl-IV/XII/2017', '2021-07-02', 1, '2021-11-18 11:19:20'),
(10051, '63411', '63', 'Administrasi Bisnis', '2001-02-12', '45/DIKTI/Kep/2001', 7, 'Akreditasi B', '2641/SK/BAN-PT/Ak-PPJ/Dipl-III/V/2021', '2022-03-23', 1, '2021-11-18 11:22:37'),
(10052, '93301', '63', 'Usaha Jasa Konvensi, Perjalanan, Insentif dan Pame', '2009-08-10', '2155/D/T/2007', 6, 'Akreditasi A', '6714/SK/BAN-PT/Akred/ST/X/2020', '2021-08-11', 1, '2021-11-18 11:43:44'),
(10053, '63311', '63', 'Manajemen Bisnis', '2014-06-10', '788/PL5/AK/2018', 6, 'Akreditasi B', '1206/SK/BAN-PT/Akred/Dipl-IV/IV/2017', '2022-06-10', 1, '2021-11-18 11:49:16');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `roleid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `roleName` varchar(200) NOT NULL,
  `dashboard` double NOT NULL,
  `profileInstitusi` double NOT NULL,
  `dosen` double NOT NULL,
  `publikasi` double NOT NULL,
  `hakcipta` double NOT NULL,
  `setting` double NOT NULL,
  `standarSpmi` double NOT NULL,
  `laporan` double NOT NULL,
  `departemen` double NOT NULL,
  `unit` double NOT NULL,
  `hapusUnit` double NOT NULL,
  `editUnit` double NOT NULL,
  `pemeriksaan` double NOT NULL,
  `pelaksanaan` double NOT NULL,
  `masterdata` double NOT NULL,
  `createdDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`roleid`, `userid`, `roleName`, `dashboard`, `profileInstitusi`, `dosen`, `publikasi`, `hakcipta`, `setting`, `standarSpmi`, `laporan`, `departemen`, `unit`, `hapusUnit`, `editUnit`, `pemeriksaan`, `pelaksanaan`, `masterdata`, `createdDate`) VALUES
(1, 1, 'Superuser Edited', 1, 1, 1, 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, '2021-10-14 10:44:44'),
(2, 1, 'SPMI', 1, 0, 0, 0, 1, 1, 1, 1, 0, 0, 0, 0, 1, 0, 0, '2022-01-19 20:00:28'),
(3, 1, 'Auditor', 1, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0, 0, '2021-12-31 07:18:26'),
(4, 1, 'AMI', 1, 0, 0, 0, 0, 0, 1, 1, 0, 1, 0, 0, 1, 0, 0, '2021-12-31 07:08:17'),
(5, 1, 'Direktur', 1, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, '2021-11-14 18:15:55'),
(6, 1, 'Departemen', 1, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, '2021-12-31 07:18:33'),
(7, 1, 'Unit', 1, 0, 0, 0, 0, 0, 0, 1, 0, 1, 0, 0, 1, 0, 0, '2021-12-31 09:59:20'),
(8, 1, 'Wakil Direktur', 1, 0, 0, 0, 0, 1, 1, 1, 0, 1, 0, 0, 0, 0, 0, '2021-12-31 07:00:30'),
(9, 1, 'KPS', 1, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 1, 0, '2021-11-14 17:59:25'),
(10, 1, 'Admin Prodi', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-10-06 17:28:28'),
(11, 1, 'tidak dipakai', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-10-06 17:28:41');

-- --------------------------------------------------------

--
-- Table structure for table `ruanglingkup`
--

CREATE TABLE `ruanglingkup` (
  `lingkupid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `lingkup` varchar(200) NOT NULL,
  `createdDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ruanglingkup`
--

INSERT INTO `ruanglingkup` (`lingkupid`, `userid`, `lingkup`, `createdDate`) VALUES
(1, 1, 'Daerah', '2021-09-12 14:26:34'),
(2, 1, 'Provinsi', '2021-09-12 14:26:49'),
(3, 1, 'Internasional', '2021-09-12 14:26:49');

-- --------------------------------------------------------

--
-- Table structure for table `sidemenu`
--

CREATE TABLE `sidemenu` (
  `menuid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `menuSide` varchar(200) NOT NULL,
  `svgIcon` text NOT NULL,
  `createdDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sidemenu`
--

INSERT INTO `sidemenu` (`menuid`, `userid`, `menuSide`, `svgIcon`, `createdDate`) VALUES
(1, 1, 'Menu Setting', '-', '2021-08-29 00:00:00'),
(2, 1, 'Menu SPMI', '-', '2021-08-29 00:00:00'),
(3, 1, 'Menu Dosen', '-', '2021-08-29 00:00:00'),
(4, 1, 'Tambah Dosen', '-', '2021-08-29 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `standar`
--

CREATE TABLE `standar` (
  `standarid` int(11) NOT NULL,
  `kodestandar` varchar(50) NOT NULL,
  `namastandar` varchar(250) NOT NULL,
  `namasubstandar` varchar(250) NOT NULL,
  `kodesubstandar` varchar(50) NOT NULL,
  `namapernyataan` text NOT NULL,
  `kodepernyataan` varchar(50) NOT NULL,
  `namaindikator` text NOT NULL,
  `kodeindikator` varchar(50) NOT NULL,
  `catatanindikator` text NOT NULL,
  `namadokumen` text NOT NULL,
  `userid` int(11) NOT NULL,
  `createdDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `standar`
--

INSERT INTO `standar` (`standarid`, `kodestandar`, `namastandar`, `namasubstandar`, `kodesubstandar`, `namapernyataan`, `kodepernyataan`, `namaindikator`, `kodeindikator`, `catatanindikator`, `namadokumen`, `userid`, `createdDate`) VALUES
(528, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', '0', '0', '0', '0', '0', '0', '0', '0', 1, '2022-01-05 14:18:35'),
(533, 'STD-02/SPMI', ' STANDAR PENELITIAN', '0', '0', '0', '0', '0', '0', '0', '0', 1, '2022-01-05 14:18:24'),
(534, 'STD-03/SPMI', 'STANDAR PENGABDIAN', '0', '0', '0', '0', '0', '0', '0', '0', 1, '2022-01-05 14:19:15'),
(536, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', '0', '0', '0', '0', '0', '0', 1, '2022-01-05 14:21:30'),
(547, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Direktur  menetapkan profil lulusan program studi yang didokumentasikan dan disosialisasikan dalam bentuk Buku Informasi  Politeknik Negeri Medan maupun di website dan  dilakukan peninjauan ulang minimal 1 kali per tahun', '1', '0', '0', '0', '0', 1, '2022-01-12 10:14:56'),
(548, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Direktur  menetapkan profil lulusan program studi yang didokumentasikan dan disosialisasikan dalam bentuk Buku Informasi  Politeknik Negeri Medan maupun di website dan  dilakukan peninjauan ulang minimal 1 kali per tahun', '1', 'Tersedianya Buku Informasi  Politeknik Negeri Medan yang berisi profil lulusan', 'a', '-', '0', 1, '2022-01-12 13:12:25'),
(549, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Direktur  menetapkan profil lulusan program studi yang didokumentasikan dan disosialisasikan dalam bentuk Buku Informasi  Politeknik Negeri Medan maupun di website dan  dilakukan peninjauan ulang minimal 1 kali per tahun', '1', 'Tersedianya Buku Informasi  Politeknik Negeri Medan yang berisi profil lulusan', 'a', 'Dokumen', 'Buku Informasi  Politeknik Negeri Medan ', 1, '2022-01-12 13:12:41'),
(550, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Direktur  menetapkan profil lulusan program studi yang didokumentasikan dan disosialisasikan dalam bentuk Buku Informasi  Politeknik Negeri Medan maupun di website dan  dilakukan peninjauan ulang minimal 1 kali per tahun', '1', 'Tersosialisasinya profil lulusan untuk semua  program studi', 'b', '-', '0', 1, '2022-01-12 13:13:05'),
(551, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Direktur  menetapkan profil lulusan program studi yang didokumentasikan dan disosialisasikan dalam bentuk Buku Informasi  Politeknik Negeri Medan maupun di website dan  dilakukan peninjauan ulang minimal 1 kali per tahun', '1', 'Tersosialisasinya profil lulusan untuk semua  program studi', 'b', 'Dokumen', 'Laporan kegiatan sosialisasi', 1, '2022-01-12 13:16:49'),
(552, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Direktur  menetapkan profil lulusan program studi yang didokumentasikan dan disosialisasikan dalam bentuk Buku Informasi  Politeknik Negeri Medan maupun di website dan  dilakukan peninjauan ulang minimal 1 kali per tahun', '1', 'Terlaksananya peninjauan ulang Buku Informasi Politeknik Negeri Medan', 'c', '-', '0', 1, '2022-01-12 13:17:11'),
(553, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Direktur  menetapkan profil lulusan program studi yang didokumentasikan dan disosialisasikan dalam bentuk Buku Informasi  Politeknik Negeri Medan maupun di website dan  dilakukan peninjauan ulang minimal 1 kali per tahun', '1', 'Terlaksananya peninjauan ulang Buku Informasi Politeknik Negeri Medan', 'c', 'Dokumen', 'Laporan kegiatan peninjauan ulang dan verifikasi ', 1, '2022-01-12 13:17:44'),
(554, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Ketua Pusat pengembangan Pendidikan dan Aktivitas Instruksional (P3AI) harus berkoordinasi dengan Wakil Direktur  I untuk menyusun dan mengembangkan pedoman penyusunan rumusan capaian pembelajaran lulusan untuk setiap jenjang program pendidikan sesuai dengan  jenjang  kualifikasi pada KKNI, dan dilakukan peninjauan berkala minimal satu  kali dalam tiga tahun.', '2', '0', '0', '0', '0', 1, '2022-01-12 13:24:28'),
(555, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Ketua Pusat pengembangan Pendidikan dan Aktivitas Instruksional (P3AI) harus berkoordinasi dengan Wakil Direktur  I untuk menyusun dan mengembangkan pedoman penyusunan rumusan capaian pembelajaran lulusan untuk setiap jenjang program pendidikan sesuai dengan  jenjang  kualifikasi pada KKNI, dan dilakukan peninjauan berkala minimal satu  kali dalam tiga tahun.', '2', 'Tersedianya buku pedoman penyusunan capaian pembelajaran lulusan sesuai dengan jenjang kualifikasi KKNI untuk setiap jenjang pendidikan di Poiteknik Negeri Medan', 'a', '-', '0', 1, '2022-01-12 13:31:28'),
(556, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Ketua Pusat pengembangan Pendidikan dan Aktivitas Instruksional (P3AI) harus berkoordinasi dengan Wakil Direktur  I untuk menyusun dan mengembangkan pedoman penyusunan rumusan capaian pembelajaran lulusan untuk setiap jenjang program pendidikan sesuai dengan  jenjang  kualifikasi pada KKNI, dan dilakukan peninjauan berkala minimal satu  kali dalam tiga tahun.', '2', 'Tersedianya buku pedoman penyusunan capaian pembelajaran lulusan sesuai dengan jenjang kualifikasi KKNI untuk setiap jenjang pendidikan di Poiteknik Negeri Medan', 'a', 'Dokumen', 'Buku pedoman penyusunan capaian pembelajaran lulusan sesuai dengan jenjang kualifikasi KKNI untuk setiap jenjang pendidikan Poiteknik Negeri Medan', 1, '2022-01-12 13:31:46'),
(557, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Ketua Pusat pengembangan Pendidikan dan Aktivitas Instruksional (P3AI) harus berkoordinasi dengan Wakil Direktur  I untuk menyusun dan mengembangkan pedoman penyusunan rumusan capaian pembelajaran lulusan untuk setiap jenjang program pendidikan sesuai dengan  jenjang  kualifikasi pada KKNI, dan dilakukan peninjauan berkala minimal satu  kali dalam tiga tahun.', '2', 'Terlaksananya peninjauan ulang buku pedoman penyusunan capaian pembelajaran lulusan', 'b', '-', '0', 1, '2022-01-12 13:32:04'),
(558, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Ketua Pusat pengembangan Pendidikan dan Aktivitas Instruksional (P3AI) harus berkoordinasi dengan Wakil Direktur  I untuk menyusun dan mengembangkan pedoman penyusunan rumusan capaian pembelajaran lulusan untuk setiap jenjang program pendidikan sesuai dengan  jenjang  kualifikasi pada KKNI, dan dilakukan peninjauan berkala minimal satu  kali dalam tiga tahun.', '2', 'Terlaksananya peninjauan ulang buku pedoman penyusunan capaian pembelajaran lulusan', 'b', 'Dokumen', 'Laporan kegiatan peninjauan ulang dan verifikasi', 1, '2022-01-12 13:32:18'),
(559, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Ketua Pusat Pengembangan Pendidikan dan Aktivitas Instruksional (P3AI) harus mensosialisasikan Buku Pedoman Penyusunan Capaian Pembalajaran Lulusan minimal satu kali sebelum waktu penyusunan dan pengembangan kurikulum program studi.', '3', '0', '0', '0', '0', 1, '2022-01-12 13:32:42'),
(560, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Ketua Pusat Pengembangan Pendidikan dan Aktivitas Instruksional (P3AI) harus mensosialisasikan Buku Pedoman Penyusunan Capaian Pembalajaran Lulusan minimal satu kali sebelum waktu penyusunan dan pengembangan kurikulum program studi.', '3', 'Tersosialisasinya Buku Pedoman Penyusunan Capaian Pembelajaran Lulusan mengacu pada deskripsi capaian pembelajaran lulusan pada KKNI dan jenjang KKNI', 'a', '-', '0', 1, '2022-01-12 13:33:19'),
(561, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Ketua Pusat Pengembangan Pendidikan dan Aktivitas Instruksional (P3AI) harus mensosialisasikan Buku Pedoman Penyusunan Capaian Pembalajaran Lulusan minimal satu kali sebelum waktu penyusunan dan pengembangan kurikulum program studi.', '3', 'Tersosialisasinya Buku Pedoman Penyusunan Capaian Pembelajaran Lulusan mengacu pada deskripsi capaian pembelajaran lulusan pada KKNI dan jenjang KKNI', 'a', 'Dokumen', 'Laporan sosialisasi Buku Buku Pedoman Penyusunan Capaian Pembelajaran Lulusan', 1, '2022-01-12 13:33:35'),
(562, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Ketua Jurusan/Kepala Program Studi wajib menyusun rumusan sikap, pengetahuan, keterampilan umum dan khusus, dan pengalaman kerja mahasiswa sebagai bagian dari capaian pembelajaran lulusan sesuai dengan jenjang kualifikasi pada KKNI dan  dilakukan peninjauan berkala minimal satu kali dalam 4  tahun.', '4', '0', '0', '0', '0', 1, '2022-01-12 13:34:05'),
(563, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Ketua Jurusan/Kepala Program Studi wajib menyusun rumusan sikap, pengetahuan, keterampilan umum dan khusus, dan pengalaman kerja mahasiswa sebagai bagian dari capaian pembelajaran lulusan sesuai dengan jenjang kualifikasi pada KKNI dan  dilakukan peninjauan berkala minimal satu kali dalam 4  tahun.', '4', 'Tersedianya rumusan capaian pembelajaran lulusan program studi sesuai dengan jenjang KKNI', 'a', '-', '0', 1, '2022-01-12 13:34:24'),
(564, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Ketua Jurusan/Kepala Program Studi wajib menyusun rumusan sikap, pengetahuan, keterampilan umum dan khusus, dan pengalaman kerja mahasiswa sebagai bagian dari capaian pembelajaran lulusan sesuai dengan jenjang kualifikasi pada KKNI dan  dilakukan peninjauan berkala minimal satu kali dalam 4  tahun.', '4', 'Tersedianya rumusan capaian pembelajaran lulusan program studi sesuai dengan jenjang KKNI', 'a', 'Dokumen', 'Pedoman menyusun rumusan capaian pembelajaran', 1, '2022-01-12 13:34:38'),
(565, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Ketua Jurusan/Kepala Program Studi wajib menyusun rumusan sikap, pengetahuan, keterampilan umum dan khusus, dan pengalaman kerja mahasiswa sebagai bagian dari capaian pembelajaran lulusan sesuai dengan jenjang kualifikasi pada KKNI dan  dilakukan peninjauan berkala minimal satu kali dalam 4  tahun.', '4', 'Ada bukti telah dilakukan peninjauan secara berkala minimal  1 kali dalam 4  tahun', 'b', '-', '0', 1, '2022-01-12 13:34:57'),
(566, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Ketua Jurusan/Kepala Program Studi wajib menyusun rumusan sikap, pengetahuan, keterampilan umum dan khusus, dan pengalaman kerja mahasiswa sebagai bagian dari capaian pembelajaran lulusan sesuai dengan jenjang kualifikasi pada KKNI dan  dilakukan peninjauan berkala minimal satu kali dalam 4  tahun.', '4', 'Ada bukti telah dilakukan peninjauan secara berkala minimal  1 kali dalam 4  tahun', 'b', 'Dokumen', 'Laporan kegiatan peninjauan ulang dan verifikasi', 1, '2022-01-12 13:35:31'),
(567, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Ketua Jurusan/KPS harus berkoordinasi dengan Kepala Bagian Administrasi Akademik dan Kemahasiswaan untuk memastikan rata-rata IPK mahasiswa program studi  â‰¥ 3.25 setiap akhir tahun akademik\n', '5', '0', '0', '0', '0', 1, '2022-01-12 13:36:15'),
(568, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Ketua Jurusan/KPS harus berkoordinasi dengan Kepala Bagian Administrasi Akademik dan Kemahasiswaan untuk memastikan rata-rata IPK mahasiswa program studi  â‰¥ 3.25 setiap akhir tahun akademik\n', '5', 'Tersedianya bukti ketercapaian IPK rata-rata mahasiswa untuk setiap program studi pada setiap tahunnya (Tabel 8.a LKPS) dan Tabel 5.a LKPT Capaian Pembelajaran', 'a', '-', '0', 1, '2022-01-12 13:36:41'),
(569, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Ketua Jurusan/KPS harus berkoordinasi dengan Kepala Bagian Administrasi Akademik dan Kemahasiswaan untuk memastikan rata-rata IPK mahasiswa program studi  â‰¥ 3.25 setiap akhir tahun akademik\n', '5', 'Tersedianya bukti ketercapaian IPK rata-rata mahasiswa untuk setiap program studi pada setiap tahunnya (Tabel 8.a LKPS) dan Tabel 5.a LKPT Capaian Pembelajaran', 'a', 'Dokumen', 'Tabel 8.a LKPS dan Tabel 5.a LKPT Capaian Pembelajaran', 1, '2022-01-12 13:37:06'),
(570, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Wakil Direktur I harus memastikan persentase jumlah lulusan yang memiliki sertifikat kompetensi/ profesi/industri dalam 3 tahun terakhir  â‰¥ 30%. ', '6', '0', '0', '0', '0', 1, '2022-01-12 13:37:37'),
(571, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Wakil Direktur I harus memastikan persentase jumlah lulusan yang memiliki sertifikat kompetensi/ profesi/industri dalam 3 tahun terakhir  â‰¥ 30%. ', '6', 'Persentase ketercapaian kepemilikan  sertifikat kompetensi/profesi/industri mahasiswa mengalami peningkatan setiap tahunnya, minimal 87%.', 'a', '-', '0', 1, '2022-01-12 13:38:16'),
(572, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Wakil Direktur I harus memastikan persentase jumlah lulusan yang memiliki sertifikat kompetensi/ profesi/industri dalam 3 tahun terakhir  â‰¥ 30%. ', '6', 'Persentase ketercapaian kepemilikan  sertifikat kompetensi/profesi/industri mahasiswa mengalami peningkatan setiap tahunnya, minimal 87%.', 'a', 'Dokumen', 'Laporan terkait Sertifikat kompetensi/ profesi/industri dalam bentuk hardcopy dan softcopy', 1, '2022-01-12 13:38:34'),
(573, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Ketua Jurusan/Kepala Program Studi berkoordinasi dengan Wakil DIrektur I dan III harus memastikan jumlah prestasi akademik mahasiswa di tingkat provinsi/wilayah, nasional, dan/atau  internasional  terhadap jumlah  mahasiswa  dalam  3 tahun  terakhir untuk Program Diploma 3  Â³ 0,05%, untuk Program Diploma 4  â‰¥ 0,1%, dan untuk Program Magister Terapan  â‰¥ 0,5%,\n', '7', '0', '0', '0', '0', 1, '2022-01-12 13:39:06'),
(574, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Ketua Jurusan/Kepala Program Studi berkoordinasi dengan Wakil DIrektur I dan III harus memastikan jumlah prestasi akademik mahasiswa di tingkat provinsi/wilayah, nasional, dan/atau  internasional  terhadap jumlah  mahasiswa  dalam  3 tahun  terakhir untuk Program Diploma 3  Â³ 0,05%, untuk Program Diploma 4  â‰¥ 0,1%, dan untuk Program Magister Terapan  â‰¥ 0,5%,\n', '7', 'Tersedianya laporan jumlah prestasi akademik mahasiswa Program Diploma 3 dalam Tabel 8.b.1) LKPS dalam 3 tahun terakhir   â‰¥ 0,05%', 'a', '-', '0', 1, '2022-01-12 13:39:25'),
(575, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Ketua Jurusan/Kepala Program Studi berkoordinasi dengan Wakil DIrektur I dan III harus memastikan jumlah prestasi akademik mahasiswa di tingkat provinsi/wilayah, nasional, dan/atau  internasional  terhadap jumlah  mahasiswa  dalam  3 tahun  terakhir untuk Program Diploma 3  Â³ 0,05%, untuk Program Diploma 4  â‰¥ 0,1%, dan untuk Program Magister Terapan  â‰¥ 0,5%,\n', '7', 'Tersedianya laporan jumlah prestasi akademik mahasiswa Program Diploma 3 dalam Tabel 8.b.1) LKPS dalam 3 tahun terakhir   â‰¥ 0,05%', 'a', 'Dokumen', 'Tabel 8.b.1) LKPS', 1, '2022-01-12 13:39:41'),
(576, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Ketua Jurusan/Kepala Program Studi berkoordinasi dengan Wakil DIrektur I dan III harus memastikan jumlah prestasi akademik mahasiswa di tingkat provinsi/wilayah, nasional, dan/atau  internasional  terhadap jumlah  mahasiswa  dalam  3 tahun  terakhir untuk Program Diploma 3  Â³ 0,05%, untuk Program Diploma 4  â‰¥ 0,1%, dan untuk Program Magister Terapan  â‰¥ 0,5%,\n', '7', 'Tersedianya laporan jumlah prestasi akademik mahasiswa Program Diploma 4 dalam Tabel 8.b.1) LKPS dalam 3 tahun terakhir   â‰¥ 0,1%', 'b', '-', '0', 1, '2022-01-12 13:40:08'),
(577, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Ketua Jurusan/Kepala Program Studi berkoordinasi dengan Wakil DIrektur I dan III harus memastikan jumlah prestasi akademik mahasiswa di tingkat provinsi/wilayah, nasional, dan/atau  internasional  terhadap jumlah  mahasiswa  dalam  3 tahun  terakhir untuk Program Diploma 3  Â³ 0,05%, untuk Program Diploma 4  â‰¥ 0,1%, dan untuk Program Magister Terapan  â‰¥ 0,5%,\n', '7', 'Tersedianya laporan jumlah prestasi akademik mahasiswa Program Diploma 4 dalam Tabel 8.b.1) LKPS dalam 3 tahun terakhir   â‰¥ 0,1%', 'b', 'Dokumen', 'Tabel 8.b.1) LKPS', 1, '2022-01-12 13:40:33'),
(578, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Ketua Jurusan/Kepala Program Studi berkoordinasi dengan Wakil DIrektur I dan III harus memastikan jumlah prestasi akademik mahasiswa di tingkat provinsi/wilayah, nasional, dan/atau  internasional  terhadap jumlah  mahasiswa  dalam  3 tahun  terakhir untuk Program Diploma 3  Â³ 0,05%, untuk Program Diploma 4  â‰¥ 0,1%, dan untuk Program Magister Terapan  â‰¥ 0,5%,\n', '7', 'Tersedianya laporan jumlah prestasi akademik mahasiswa Program Magister Terapan dalam Tabel 8.b.1) LKPS dalam 3 tahun terakhir   â‰¥ 0,5%', 'c', '-', '0', 1, '2022-01-12 13:41:21'),
(579, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Ketua Jurusan/Kepala Program Studi berkoordinasi dengan Wakil DIrektur I dan III harus memastikan jumlah prestasi akademik mahasiswa di tingkat provinsi/wilayah, nasional, dan/atau  internasional  terhadap jumlah  mahasiswa  dalam  3 tahun  terakhir untuk Program Diploma 3  Â³ 0,05%, untuk Program Diploma 4  â‰¥ 0,1%, dan untuk Program Magister Terapan  â‰¥ 0,5%,\n', '7', 'Tersedianya laporan jumlah prestasi akademik mahasiswa Program Magister Terapan dalam Tabel 8.b.1) LKPS dalam 3 tahun terakhir   â‰¥ 0,5%', 'c', 'Dokumen', 'Tabel 8.b.1) LKPS', 1, '2022-01-12 13:41:41'),
(580, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Wakil DIrektur I dan III harus memastikan jumlah prestasi akademik mahasiswa di tingkat provinsi/wilayah, nasional, dan/atau  internasional  terhadap jumlah  mahasiswa  dalam  3 tahun    â‰¥ 0,05%,\n', '8', '0', '0', '0', '0', 1, '2022-01-12 13:42:24'),
(581, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Wakil DIrektur I dan III harus memastikan jumlah prestasi akademik mahasiswa di tingkat provinsi/wilayah, nasional, dan/atau  internasional  terhadap jumlah  mahasiswa  dalam  3 tahun    â‰¥ 0,05%,\n', '8', 'Tersedianya laporan jumlah prestasi akademik mahasiswa  dalam Tabel 5.b.1) LKPT Prestasi Akademik Mahasiswa dalam 3 tahun terakhir   â‰¥ 0,05%', 'a', '-', '0', 1, '2022-01-12 13:43:03'),
(582, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Wakil DIrektur I dan III harus memastikan jumlah prestasi akademik mahasiswa di tingkat provinsi/wilayah, nasional, dan/atau  internasional  terhadap jumlah  mahasiswa  dalam  3 tahun    â‰¥ 0,05%,\n', '8', 'Tersedianya laporan jumlah prestasi akademik mahasiswa  dalam Tabel 5.b.1) LKPT Prestasi Akademik Mahasiswa dalam 3 tahun terakhir   â‰¥ 0,05%', 'a', 'Dokumen', 'Tabel 5.b.1) LKPT Prestasi Akademik Mahasiswa', 1, '2022-01-12 13:43:31'),
(583, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Ketua Jurusan/Kepala Program Studi berkoordinasi dengan Wakil Direktur III harus memastikan jumlah prestasi non akademik mahasiswa di tingkat provinsi/wilayah, nasional, dan/atau  internasional  terhadap jumlah  mahasiswa  dalam  3 tahun  terakhir ', '9', '0', '0', '0', '0', 1, '2022-01-12 13:44:07'),
(584, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Ketua Jurusan/Kepala Program Studi berkoordinasi dengan Wakil Direktur III harus memastikan jumlah prestasi non akademik mahasiswa di tingkat provinsi/wilayah, nasional, dan/atau  internasional  terhadap jumlah  mahasiswa  dalam  3 tahun  terakhir ', '9', 'Tersedianya laporan Prestasi mahasiswa program studi  untuk Program Diploma 3 di bidang non akademik\ndalam 3 tahun terakhir.  Tabel 8.b.2) LKPS  â‰¥ 0,1%', 'a', '-', '0', 1, '2022-01-12 13:44:32'),
(585, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Ketua Jurusan/Kepala Program Studi berkoordinasi dengan Wakil Direktur III harus memastikan jumlah prestasi non akademik mahasiswa di tingkat provinsi/wilayah, nasional, dan/atau  internasional  terhadap jumlah  mahasiswa  dalam  3 tahun  terakhir ', '9', 'Tersedianya laporan Prestasi mahasiswa program studi  untuk Program Diploma 3 di bidang non akademik\ndalam 3 tahun terakhir.  Tabel 8.b.2) LKPS  â‰¥ 0,1%', 'a', 'Dokumen', 'Laporan Prestasi mahasiswa program studi  untuk Program Diploma 3 di bidang non akademik dalam 3 tahun terakhir. Tabel 8.b.2) LKPS  â‰¥ 0,1%', 1, '2022-01-12 13:45:05'),
(586, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Ketua Jurusan/Kepala Program Studi berkoordinasi dengan Wakil Direktur III harus memastikan jumlah prestasi non akademik mahasiswa di tingkat provinsi/wilayah, nasional, dan/atau  internasional  terhadap jumlah  mahasiswa  dalam  3 tahun  terakhir ', '9', 'Tersedianya laporan Prestasi mahasiswa program studi  untuk Program Diploma 4 di bidang non akademik\ndalam 3 tahun terakhir.\nTabel 8.b.2) LKPS  â‰¥ 0,2%', 'b', '-', '0', 1, '2022-01-12 13:45:30'),
(587, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Ketua Jurusan/Kepala Program Studi berkoordinasi dengan Wakil Direktur III harus memastikan jumlah prestasi non akademik mahasiswa di tingkat provinsi/wilayah, nasional, dan/atau  internasional  terhadap jumlah  mahasiswa  dalam  3 tahun  terakhir ', '9', 'Tersedianya laporan Prestasi mahasiswa program studi  untuk Program Diploma 4 di bidang non akademik\ndalam 3 tahun terakhir.\nTabel 8.b.2) LKPS  â‰¥ 0,2%', 'b', 'Dokumen', 'Laporan Prestasi mahasiswa program studi  untuk Program Diploma 4 di bidang non akademik dalam 3 tahun terakhir. Tabel 8.b.2) LKPS  â‰¥ 0,2%', 1, '2022-01-12 13:46:01'),
(588, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Wakil Direktur III harus memastikan jumlah prestasi non akademik mahasiswa di tingkat provinsi/wilayah, nasional, dan/atau  internasional  terhadap jumlah  mahasiswa  dalam  3 tahun  terakhir â‰¥ 0,1%', '10', '0', '0', '0', '0', 1, '2022-01-12 13:46:39'),
(589, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Wakil Direktur III harus memastikan jumlah prestasi non akademik mahasiswa di tingkat provinsi/wilayah, nasional, dan/atau  internasional  terhadap jumlah  mahasiswa  dalam  3 tahun  terakhir â‰¥ 0,1%', '10', 'Tabel 5.b.2) LKPT Prestasi Non-akademik Mahasiswa Politeknik Negeri Medan\n', 'a', '-', '0', 1, '2022-01-12 13:46:59'),
(590, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Wakil Direktur III harus memastikan jumlah prestasi non akademik mahasiswa di tingkat provinsi/wilayah, nasional, dan/atau  internasional  terhadap jumlah  mahasiswa  dalam  3 tahun  terakhir â‰¥ 0,1%', '10', 'Tabel 5.b.2) LKPT Prestasi Non-akademik Mahasiswa Politeknik Negeri Medan\n', 'a', 'Dokumen', 'Tabel 5.b.2) LKPT Prestasi Non-akademik Mahasiswa Politeknik Negeri Medan', 1, '2022-01-12 13:47:11'),
(591, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Ketua Jurusan/Kepala Program Studi berkoordinasi dengan Kepala Bagian Administrasi Akademik dan Kemahasiswaan harus memastikan lama studi mahasiswa untuk Program Diploma 3 adalah antara 3 tahun sampai dengan 3,5 tahun\n', '11', '0', '0', '0', '0', 1, '2022-01-12 13:48:37'),
(592, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Ketua Jurusan/Kepala Program Studi berkoordinasi dengan Kepala Bagian Administrasi Akademik dan Kemahasiswaan harus memastikan lama studi mahasiswa untuk Program Diploma 3 adalah antara 3 tahun sampai dengan 3,5 tahun\n', '11', 'Tersedianya bukti yang menunjukkan lama studi mahasiswa di program studi setiap tahunnya (Tabel 8.c. LKPS)', 'a', '-', '0', 1, '2022-01-12 13:48:59'),
(593, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Ketua Jurusan/Kepala Program Studi berkoordinasi dengan Kepala Bagian Administrasi Akademik dan Kemahasiswaan harus memastikan lama studi mahasiswa untuk Program Diploma 3 adalah antara 3 tahun sampai dengan 3,5 tahun\n', '11', 'Tersedianya bukti yang menunjukkan lama studi mahasiswa di program studi setiap tahunnya (Tabel 8.c. LKPS)', 'a', 'Dokumen', 'Tabel 8.c LKPS dan Tabel 5.c.1) LKPT Lama Studi Mahasiswa (untuk lembaga)', 1, '2022-01-12 13:53:39'),
(594, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Ketua Jurusan/Kepala Program Studi berkoordinasi dengan Kepala Bagian Administrasi Akademik dan Kemahasiswaan harus memastikan lama studi mahasiswa untuk Program Diploma 4 adalah antara 3,5 tahun sampai dengan 4,5 tahun', '12', '0', '0', '0', '0', 1, '2022-01-12 14:01:59'),
(595, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Ketua Jurusan/Kepala Program Studi berkoordinasi dengan Kepala Bagian Administrasi Akademik dan Kemahasiswaan harus memastikan lama studi mahasiswa untuk Program Diploma 4 adalah antara 3,5 tahun sampai dengan 4,5 tahun', '12', 'Tersedianya bukti yang menunjukkan lama studi mahasiswa di program studi setiap tahunnya (Tabel 8.c. LKPS)', 'a', '-', '0', 1, '2022-01-12 14:02:21'),
(596, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Ketua Jurusan/Kepala Program Studi berkoordinasi dengan Kepala Bagian Administrasi Akademik dan Kemahasiswaan harus memastikan lama studi mahasiswa untuk Program Diploma 3 adalah antara 3 tahun sampai dengan 3,5 tahun\n', '11', 'Tersedianya bukti yang menunjukkan lama studi mahasiswa di program studi setiap tahunnya (Tabel 8.c. LKPS)', 'a', 'Dokumen', 'Tabel 8.c LKPS dan Tabel 5.c.1) LKPT Lama Studi Mahasiswa (untuk lembaga/institusi)', 1, '2022-01-12 14:06:27'),
(597, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Ketua Jurusan/Kepala Program Studi berkoordinasi dengan Kepala Bagian Administrasi Akademik dan Kemahasiswaan harus memastikan lama studi mahasiswa untuk Program Magister Terapan adalah antara 1,5 tahun sampai dengan 2,5 tahun\n', '13', '0', '0', '0', '0', 1, '2022-01-12 14:09:43'),
(598, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Ketua Jurusan/Kepala Program Studi berkoordinasi dengan Kepala Bagian Administrasi Akademik dan Kemahasiswaan harus memastikan lama studi mahasiswa untuk Program Magister Terapan adalah antara 1,5 tahun sampai dengan 2,5 tahun\n', '13', 'Tersedianya bukti yang menunjukkan lama studi mahasiswa di program studi setiap tahunnya (Tabel 8.c. LKPS)\n', 'a', '-', '0', 1, '2022-01-12 14:10:11'),
(599, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Ketua Jurusan/Kepala Program Studi berkoordinasi dengan Kepala Bagian Administrasi Akademik dan Kemahasiswaan harus memastikan lama studi mahasiswa untuk Program Magister Terapan adalah antara 1,5 tahun sampai dengan 2,5 tahun\n', '13', 'Tersedianya bukti yang menunjukkan lama studi mahasiswa di program studi setiap tahunnya (Tabel 8.c. LKPS)\n', 'a', 'Dokumen', 'Laporan Lama Studi Mahasiswa tersaji dalam Tabel 8.c LKPS (untuk tingkat program studi) dan Tabel 5.c.1) LKPT (untuk tingkat lembaga/institusi) ', 1, '2022-01-12 14:10:32'),
(600, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Ketua Jurusan/Kepala Program Studi Diploma 3 dan Diploma 4 harus berkoordinasi dengan Kepala Bagian Administrasi Akademik dan Kemahasiswaan memastikan  persentase lulusan tepat waktu pada program studi â‰¥ 70%', '14', '0', '0', '0', '0', 1, '2022-01-12 14:19:42'),
(601, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Ketua Jurusan/Kepala Program Studi Diploma 3 dan Diploma 4 harus berkoordinasi dengan Kepala Bagian Administrasi Akademik dan Kemahasiswaan memastikan  persentase lulusan tepat waktu pada program studi â‰¥ 70%', '14', 'Tersedianya Tabel 8.c LKPS untuk Kelulusan tepat waktu Program Diploma 3 dan Diploma 4  â‰¥ 70%\n\n', 'a', '-', '0', 1, '2022-01-12 14:20:12'),
(602, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Ketua Jurusan/Kepala Program Studi Diploma 3 dan Diploma 4 harus berkoordinasi dengan Kepala Bagian Administrasi Akademik dan Kemahasiswaan memastikan  persentase lulusan tepat waktu pada program studi â‰¥ 70%', '14', 'Tersedianya Tabel 8.c LKPS untuk Kelulusan tepat waktu Program Diploma 3 dan Diploma 4  â‰¥ 70%\n\n', 'a', '-', '0', 1, '2022-01-12 14:20:12'),
(603, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Ketua Jurusan/Kepala Program Studi Diploma 3 dan Diploma 4 harus berkoordinasi dengan Kepala Bagian Administrasi Akademik dan Kemahasiswaan memastikan  persentase lulusan tepat waktu pada program studi â‰¥ 70%', '14', 'Tersedianya Tabel 8.c LKPS untuk Kelulusan tepat waktu Program Diploma 3 dan Diploma 4  â‰¥ 70%\n\n', 'a', '-', '0', 1, '2022-01-12 14:20:12'),
(604, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Ketua Jurusan/Kepala Program Studi Diploma 3 dan Diploma 4 harus berkoordinasi dengan Kepala Bagian Administrasi Akademik dan Kemahasiswaan memastikan  persentase lulusan tepat waktu pada program studi â‰¥ 70%', '14', 'Tersedianya Tabel 8.c LKPS untuk Kelulusan tepat waktu Program Diploma 3 dan Diploma 4  â‰¥ 70%\n\n', 'a', 'Dokumen', 'Laporan kelulusan tepat waktu yang tersaji dalam Tabel 8.c LKPS ', 1, '2022-01-12 14:21:03'),
(605, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Ketua Jurusan/Kepala Program Studi Magister Terapan harus berkoordinasi dengan Kepala Bagian Administrasi Akademik dan Kemahasiswaan memastikan  persentase lulusan tepat waktu pada program studi â‰¥ 50%\n', '15', '0', '0', '0', '0', 1, '2022-01-12 14:44:36'),
(606, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Ketua Jurusan/Kepala Program Studi Magister Terapan harus berkoordinasi dengan Kepala Bagian Administrasi Akademik dan Kemahasiswaan memastikan  persentase lulusan tepat waktu pada program studi â‰¥ 50%\n', '15', 'Tersedianya Tabel 8.c LKPS untuk Kelulusan tepat waktu Program Magister Terapan  â‰¥ 50%\n', 'a', '-', '0', 1, '2022-01-12 14:44:59'),
(607, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Ketua Jurusan/Kepala Program Studi Magister Terapan harus berkoordinasi dengan Kepala Bagian Administrasi Akademik dan Kemahasiswaan memastikan  persentase lulusan tepat waktu pada program studi â‰¥ 50%\n', '15', 'Tersedianya Tabel 8.c LKPS untuk Kelulusan tepat waktu Program Magister Terapan  â‰¥ 50%\n', 'a', 'Dokumen', 'Laporan kelulusan tepat waktu yang tersaji dalam Tabel 8.c LKPS ', 1, '2022-01-12 14:45:15'),
(608, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Kepala Bagian Administrasi Akademik dan Kemahasiswaan berkoordinasi dengan Wakil Direktur I memastikan  persentase lulusan tepat waktu untuk setiap program pendidikan  â‰¥ 50%\n', '16', '0', '0', '0', '0', 1, '2022-01-12 14:45:45'),
(609, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Kepala Bagian Administrasi Akademik dan Kemahasiswaan berkoordinasi dengan Wakil Direktur I memastikan  persentase lulusan tepat waktu untuk setiap program pendidikan  â‰¥ 50%\n', '16', 'Tersedianya Tabel 5.c 2) LKPT untuk Persentase Kelulusan tepat waktu untuk setiap program pendidikan   â‰¥ 50%\n', 'a', '-', '0', 1, '2022-01-12 14:46:16'),
(610, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Kepala Bagian Administrasi Akademik dan Kemahasiswaan berkoordinasi dengan Wakil Direktur I memastikan  persentase lulusan tepat waktu untuk setiap program pendidikan  â‰¥ 50%\n', '16', 'Tersedianya Tabel 5.c 2) LKPT untuk Persentase Kelulusan tepat waktu untuk setiap program pendidikan   â‰¥ 50%\n', 'a', 'Dokumen', 'Laporan kelulusan tepat waktu yang tersaji dalam Tabel 5.c 2) LKPT', 1, '2022-01-12 14:46:42'),
(611, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Ketua Jurusan/Kepala Program Studi  harus berkoordinasi dengan Wakil Direktur I memastikan Keberhasilan studi untuk setiap program â‰¥ 85% \n', '17', '0', '0', '0', '0', 1, '2022-01-12 14:47:26'),
(612, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Ketua Jurusan/Kepala Program Studi  harus berkoordinasi dengan Wakil Direktur I memastikan Keberhasilan studi untuk setiap program â‰¥ 85% \n', '17', 'Tersedianya  bukti sahih yang menunjukkan  keberhasilan studi mahasiswa pada setiap program studi yang tersaji  dalam Tabel 8.c LKPS (di tingkat program studi) dan Tabel 5.c.2) LKPT (di tingkat lembaga/ keseluruhan)\n', 'a', '-', '0', 1, '2022-01-12 14:47:49'),
(613, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Ketua Jurusan/Kepala Program Studi  harus berkoordinasi dengan Wakil Direktur I memastikan Keberhasilan studi untuk setiap program â‰¥ 85% \n', '17', 'Tersedianya  bukti sahih yang menunjukkan  keberhasilan studi mahasiswa pada setiap program studi yang tersaji  dalam Tabel 8.c LKPS (di tingkat program studi) dan Tabel 5.c.2) LKPT (di tingkat lembaga/ keseluruhan)\n', 'a', 'Dokumen', 'Laporan keberhasilan studi mahasiswa pada setiap program studi yang tersaji  dalam Tabel 8.c LKPS dan Tabel 5.c.2) LKPT', 1, '2022-01-12 14:48:11'),
(614, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Ketua Jurusan/Kepala Program Studi berkoordinasi dengan CDC untuk melaksanakan tracer study secara reguler setiap tahun  yang hasilnya disosialisasikan serta digunakan untuk pengembangan kurikulum dan\npembelajaran\n\n\n', '18', '0', '0', '0', '0', 1, '2022-01-12 14:48:48'),
(615, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Ketua Jurusan/Kepala Program Studi berkoordinasi dengan CDC untuk melaksanakan tracer study secara reguler setiap tahun  yang hasilnya disosialisasikan serta digunakan untuk pengembangan kurikulum dan\npembelajaran\n\n\n', '18', 'Terlaksananya tracer study yang ditargetkan pada seluruh populasi\n(lulusan TS-4 s.d. TS-2)\n', 'a', '-', '0', 1, '2022-01-12 14:49:16'),
(616, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Ketua Jurusan/Kepala Program Studi berkoordinasi dengan CDC untuk melaksanakan tracer study secara reguler setiap tahun  yang hasilnya disosialisasikan serta digunakan untuk pengembangan kurikulum dan\npembelajaran\n\n\n', '18', 'Terlaksananya tracer study yang ditargetkan pada seluruh populasi\n(lulusan TS-4 s.d. TS-2)\n', 'a', 'Dokumen', 'Tabel Data Lulusan TS-4 s.d. TS-2', 1, '2022-01-12 14:49:39'),
(617, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Ketua Jurusan/Kepala Program Studi berkoordinasi dengan CDC untuk melaksanakan tracer study secara reguler setiap tahun  yang hasilnya disosialisasikan serta digunakan untuk pengembangan kurikulum dan\npembelajaran\n\n\n', '18', 'Tersedianya kuesioner mencakup seluruh pertanyaan inti tracer study DIKTI\n', 'b', '-', '0', 1, '2022-01-12 14:50:33'),
(618, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Ketua Jurusan/Kepala Program Studi berkoordinasi dengan CDC untuk melaksanakan tracer study secara reguler setiap tahun  yang hasilnya disosialisasikan serta digunakan untuk pengembangan kurikulum dan\npembelajaran\n\n\n', '18', 'Tersedianya kuesioner mencakup seluruh pertanyaan inti tracer study DIKTI\n', 'b', 'Dokumen', 'Kuesioner mencakup seluruh pertanyaan inti tracer study DIKTI', 1, '2022-01-12 14:50:58'),
(619, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Ketua Jurusan/Kepala Program Studi berkoordinasi dengan CDC untuk melaksanakan tracer study secara reguler setiap tahun  yang hasilnya disosialisasikan serta digunakan untuk pengembangan kurikulum dan\npembelajaran\n\n\n', '18', 'Tersedianya Laporan kegiatan sosialisasi hasil tracer study', 'c', '-', '0', 1, '2022-01-12 14:51:22'),
(620, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Ketua Jurusan/Kepala Program Studi berkoordinasi dengan CDC untuk melaksanakan tracer study secara reguler setiap tahun  yang hasilnya disosialisasikan serta digunakan untuk pengembangan kurikulum dan\npembelajaran\n\n\n', '18', 'Tersedianya Laporan kegiatan sosialisasi hasil tracer study', 'c', 'Dokumen', 'Laporan kegiatan sosialisasi hasil tracer study', 1, '2022-01-12 14:51:38'),
(621, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Ketua Jurusan/Kepala Program Studi harus berkoordinasi dengan  Center Development Carrier (CDC) memastikan lama waktu tunggu lulusan program utama  untuk mendapatkan pekerjaan â‰¤ 3 bulan dalam 3 tahun terakhir', '19', '0', '0', '0', '0', 1, '2022-01-12 15:01:47'),
(622, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Ketua Jurusan/Kepala Program Studi harus berkoordinasi dengan  Center Development Carrier (CDC) memastikan lama waktu tunggu lulusan program utama  untuk mendapatkan pekerjaan â‰¤ 3 bulan dalam 3 tahun terakhir', '19', 'Tersedianya laporan sahih terkait Masa tunggu lulusan kurang dari 3 bulan setelah tanggal terbit ijazah (Tabel 8.d.1) LKPS) dan Tabel 5.d.1) LKPT Waktu Tunggu Lulusan ', 'a', '-', '0', 1, '2022-01-12 15:21:05'),
(623, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Ketua Jurusan/Kepala Program Studi harus berkoordinasi dengan  Center Development Carrier (CDC) memastikan lama waktu tunggu lulusan program utama  untuk mendapatkan pekerjaan â‰¤ 3 bulan dalam 3 tahun terakhir', '19', 'Tersedianya laporan sahih terkait Masa tunggu lulusan kurang dari 3 bulan setelah tanggal terbit ijazah (Tabel 8.d.1) LKPS) dan Tabel 5.d.1) LKPT Waktu Tunggu Lulusan ', 'a', 'Dokumen', 'Tabel 8.d.1) LKPS dan Tabel 5.d.1) LKPT Waktu Tunggu Lulusan', 1, '2022-01-12 15:21:24'),
(624, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Ketua Jurusan/Kepala Program Studi Diploma 3 harus berkoordinasi dengan  Center Development Carrier (CDC) memastikan persentase kesesuaian bidang kerja lulusan saat mendapatkan pekerjaan pertama â‰¥ 80% dalam 3 tahun terakhir', '20', '0', '0', '0', '0', 1, '2022-01-12 16:07:40'),
(625, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Ketua Jurusan/Kepala Program Studi Diploma 3 harus berkoordinasi dengan  Center Development Carrier (CDC) memastikan persentase kesesuaian bidang kerja lulusan saat mendapatkan pekerjaan pertama â‰¥ 80% dalam 3 tahun terakhir', '20', 'Tersedianya laporan persentase kesesuaian bidang kerja lulusan saat pertama mendapatkan pekerjaan mulai dari  TS-4 s.d. TS-2 yang tersaji dalam Tabel 8.d.2) LKPS', 'a', '-', '0', 1, '2022-01-12 16:08:06'),
(626, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Ketua Jurusan/Kepala Program Studi Diploma 3 harus berkoordinasi dengan  Center Development Carrier (CDC) memastikan persentase kesesuaian bidang kerja lulusan saat mendapatkan pekerjaan pertama â‰¥ 80% dalam 3 tahun terakhir', '20', 'Tersedianya laporan persentase kesesuaian bidang kerja lulusan saat pertama mendapatkan pekerjaan mulai dari  TS-4 s.d. TS-2 yang tersaji dalam Tabel 8.d.2) LKPS', 'a', 'Dokumen', 'Laporan persentase kesesuaian bidang kerja lulusan saat pertama mendapatkan pekerjaan mulai dari  TS-4 s.d. TS-2 yang tersaji dalam Tabel 8.d.2) LKPS', 1, '2022-01-12 16:08:21'),
(627, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Ketua Jurusan/Kepala Program Studi Diploma 4 dan Magister Terapan harus berkoordinasi dengan  Center Development Carrier (CDC) memastikan persentase kesesuaian bidang kerja lulusan saat mendapatkan pekerjaan pertama â‰¥ 60% dalam 3 tahun terakhir', '21', '0', '0', '0', '0', 1, '2022-01-12 16:08:47'),
(628, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Ketua Jurusan/Kepala Program Studi Diploma 4 dan Magister Terapan harus berkoordinasi dengan  Center Development Carrier (CDC) memastikan persentase kesesuaian bidang kerja lulusan saat mendapatkan pekerjaan pertama â‰¥ 60% dalam 3 tahun terakhir', '21', 'Tersedianya laporan persentase kesesuaian bidang kerja lulusan saat pertama mendapatkan pekerjaan mulai dari  TS-4 s.d. TS-2 yang tersaji dalam Tabel 8.d.2) LKPS', 'a', '-', '0', 1, '2022-01-12 16:09:06'),
(629, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Ketua Jurusan/Kepala Program Studi Diploma 3 harus berkoordinasi dengan  Center Development Carrier (CDC) memastikan persentase kesesuaian bidang kerja lulusan saat mendapatkan pekerjaan pertama â‰¥ 80% dalam 3 tahun terakhir', '20', 'Tersedianya laporan persentase kesesuaian bidang kerja lulusan saat pertama mendapatkan pekerjaan mulai dari  TS-4 s.d. TS-2 yang tersaji dalam Tabel 8.d.2) LKPS', 'a', 'Dokumen', 'Laporan persentase kesesuaian bidang kerja lulusan saat pertama mendapatkan pekerjaan mulai dari  TS-4 s.d. TS-2 yang tersaji dalam Tabel 8.d.2 LKPS', 1, '2022-01-12 16:09:39'),
(630, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Center Development Carrier (CDC) harus memastikan persentase kesesuaian bidang kerja lulusan Politeknik Negeri Medan saat mendapatkan pekerjaan pertama â‰¥ 80% dalam 3 tahun terakhir', '22', '0', '0', '0', '0', 1, '2022-01-12 16:10:01'),
(631, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Center Development Carrier (CDC) harus memastikan persentase kesesuaian bidang kerja lulusan Politeknik Negeri Medan saat mendapatkan pekerjaan pertama â‰¥ 80% dalam 3 tahun terakhir', '22', 'Tersedianya laporan persentase kesesuaian bidang kerja lulusan saat pertama mendapatkan pekerjaan mulai dari  TS-4 s.d. TS-2 yang tersaji dalam Tabel 5.d.2) LKPT ', 'a', '-', '0', 1, '2022-01-12 16:10:22'),
(632, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Center Development Carrier (CDC) harus memastikan persentase kesesuaian bidang kerja lulusan Politeknik Negeri Medan saat mendapatkan pekerjaan pertama â‰¥ 80% dalam 3 tahun terakhir', '22', 'Tersedianya laporan persentase kesesuaian bidang kerja lulusan saat pertama mendapatkan pekerjaan mulai dari  TS-4 s.d. TS-2 yang tersaji dalam Tabel 5.d.2) LKPT ', 'a', 'Dokumen', 'Laporan persentase kesesuaian bidang kerja lulusan saat pertama mendapatkan pekerjaan mulai dari  TS-4 s.d. TS-2 yang tersaji dalam Tabel 5.d.2) LKPT ', 1, '2022-01-12 16:10:42'),
(633, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Ketua Jurusan/Kepala Program Studi Diploma 3 dan Diploma 4 harus berkoordinasi dengan Center Development Carrier  untuk memastikan Tingkat dan ukuran tempat kerja lulusan â‰¥ 5% ', '23', '0', '0', '0', '0', 1, '2022-01-12 16:11:11'),
(634, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Ketua Jurusan/Kepala Program Studi Diploma 3 dan Diploma 4 harus berkoordinasi dengan Center Development Carrier  untuk memastikan Tingkat dan ukuran tempat kerja lulusan â‰¥ 5% ', '23', 'Tersedianya laporan terkait persentase tingkat dan ukuran tempat kerja lulusan yang tersaji pada Tabel 8.e.1 LKPS', 'a', '-', '0', 1, '2022-01-12 16:13:35'),
(635, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Ketua Jurusan/Kepala Program Studi Diploma 3 dan Diploma 4 harus berkoordinasi dengan Center Development Carrier  untuk memastikan Tingkat dan ukuran tempat kerja lulusan â‰¥ 5% ', '23', 'Tersedianya laporan terkait persentase tingkat dan ukuran tempat kerja lulusan yang tersaji pada Tabel 8.e.1 LKPS', 'a', 'Dokumen', 'Laporan terkait persentase tingkat dan ukuran tempat kerja lulusan yang tersaji pada Tabel 8.e.1 LKPS', 1, '2022-01-12 16:14:25'),
(636, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'CDC harus mengukur tingkat kepuasan pengguna lulusan yang dinilai dari aspek: etika, keahlian pada bidang ilmu (kompetensi utama), kemampuan berbahasa asing, penggunaan teknologi informasi, kemampuan berkomunikasi, kerja sama tim, dan pengembangan diri  untuk pengguna lulusan dalam 3 tahun sekali', '24', '0', '0', '0', '0', 1, '2022-01-12 16:15:42'),
(637, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'CDC harus mengukur tingkat kepuasan pengguna lulusan yang dinilai dari aspek: etika, keahlian pada bidang ilmu (kompetensi utama), kemampuan berbahasa asing, penggunaan teknologi informasi, kemampuan berkomunikasi, kerja sama tim, dan pengembangan diri  untuk pengguna lulusan dalam 3 tahun sekali', '24', 'Tersedianya  angket untuk mengukur tingkat kepuasan pengguna lulusan ', 'a', '-', '0', 1, '2022-01-12 16:16:06'),
(638, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'CDC harus mengukur tingkat kepuasan pengguna lulusan yang dinilai dari aspek: etika, keahlian pada bidang ilmu (kompetensi utama), kemampuan berbahasa asing, penggunaan teknologi informasi, kemampuan berkomunikasi, kerja sama tim, dan pengembangan diri  untuk pengguna lulusan dalam 3 tahun sekali', '24', 'Tersedianya  angket untuk mengukur tingkat kepuasan pengguna lulusan ', 'a', 'Dokumen', 'Angket kepuasan pengguna lulusan', 1, '2022-01-12 16:16:26'),
(639, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'CDC harus mengukur tingkat kepuasan pengguna lulusan yang dinilai dari aspek: etika, keahlian pada bidang ilmu (kompetensi utama), kemampuan berbahasa asing, penggunaan teknologi informasi, kemampuan berkomunikasi, kerja sama tim, dan pengembangan diri  untuk pengguna lulusan dalam 3 tahun sekali', '24', 'Tersedianya hasil analisis dan evaluasi angket tingkat kepuasan pengguna lulusan', 'b', '-', '0', 1, '2022-01-12 16:16:53'),
(640, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'CDC harus mengukur tingkat kepuasan pengguna lulusan yang dinilai dari aspek: etika, keahlian pada bidang ilmu (kompetensi utama), kemampuan berbahasa asing, penggunaan teknologi informasi, kemampuan berkomunikasi, kerja sama tim, dan pengembangan diri  untuk pengguna lulusan dalam 3 tahun sekali', '24', 'Tersedianya hasil analisis dan evaluasi angket tingkat kepuasan pengguna lulusan', 'b', 'Dokumen', 'Hasil analisis dan evaluasi angket tingkat kepuasan pengguna lulusan', 1, '2022-01-12 16:17:37'),
(641, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Ketua Jurusan/Kepala Program Studi Diploma 3 harus memastikan produk/jasa karya mahasiswa, yang dihasilkan secara mandiri atau bersama Dosen Tetap Program Studi, yang diadopsi oleh industri/ masyarakat dalam 3 tahun terakhir â‰¥ 1', '25', '0', '0', '0', '0', 1, '2022-01-12 16:18:09'),
(642, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Ketua Jurusan/Kepala Program Studi Diploma 3 harus memastikan produk/jasa karya mahasiswa, yang dihasilkan secara mandiri atau bersama Dosen Tetap Program Studi, yang diadopsi oleh industri/ masyarakat dalam 3 tahun terakhir â‰¥ 1', '25', 'Tersedianya bukti sahih terkait  produk/jasa karya mahasiswa, yang dihasilkan secara mandiri atau bersama Dosen Tetap Program Studi, yang diadopsi oleh industri/ masyarakat dalam 3 tahun', 'a', '-', '0', 1, '2022-01-12 16:18:30'),
(643, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Ketua Jurusan/Kepala Program Studi Diploma 3 harus memastikan produk/jasa karya mahasiswa, yang dihasilkan secara mandiri atau bersama Dosen Tetap Program Studi, yang diadopsi oleh industri/ masyarakat dalam 3 tahun terakhir â‰¥ 1', '25', 'Tersedianya bukti sahih terkait  produk/jasa karya mahasiswa, yang dihasilkan secara mandiri atau bersama Dosen Tetap Program Studi, yang diadopsi oleh industri/ masyarakat dalam 3 tahun', 'a', 'Dokumen', 'Laporan produk/jasa karya mahasiswa, yang dihasilkan secara mandiri atau bersama Dosen Tetap Program Studi, yang diadopsi oleh industri/ masyarakat dalam 3 tahun', 1, '2022-01-12 16:18:49'),
(644, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Center Development Carrier (CDC) harus memastikan persentase tingkat dan tempat kerja lulusan  â‰¥ 5% dalam 3 tahun terakhir', '26', '0', '0', '0', '0', 1, '2022-01-13 09:18:05'),
(645, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Center Development Carrier (CDC) harus memastikan persentase tingkat dan tempat kerja lulusan  â‰¥ 5% dalam 3 tahun terakhir', '26', 'Tersedianya laporan terkait persentase tingkat dan tempat kerja lulusan  â‰¥ 5% dalam 3 tahun terakhir yang tersaji dalam Tabel 5.e.2) LKPT Tempat Kerja Lulusan', 'a', '-', '0', 1, '2022-01-13 09:18:32');
INSERT INTO `standar` (`standarid`, `kodestandar`, `namastandar`, `namasubstandar`, `kodesubstandar`, `namapernyataan`, `kodepernyataan`, `namaindikator`, `kodeindikator`, `catatanindikator`, `namadokumen`, `userid`, `createdDate`) VALUES
(646, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Center Development Carrier (CDC) harus memastikan persentase tingkat dan tempat kerja lulusan  â‰¥ 5% dalam 3 tahun terakhir', '26', 'Tersedianya laporan terkait persentase tingkat dan tempat kerja lulusan  â‰¥ 5% dalam 3 tahun terakhir yang tersaji dalam Tabel 5.e.2) LKPT Tempat Kerja Lulusan', 'a', 'Dokumen', 'Laporan persentase tingkat dan tempat kerja lulusan  â‰¥ 5% dalam 3 tahun terakhir yang tersaji dalam Tabel 5.e.2 LKPT Tempat Kerja Lulusan', 1, '2022-01-13 09:19:05'),
(647, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Ketua Jurusan/Kepala Program Studi harus merumuskan pedoman kompetensi lulusan  dan dilakukan peninjauan minimal 1 kali per tahun ', '27', '0', '0', '0', '0', 1, '2022-01-13 09:24:09'),
(648, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Ketua Jurusan/Kepala Program Studi harus merumuskan pedoman kompetensi lulusan  dan dilakukan peninjauan minimal 1 kali per tahun ', '27', 'Tersedianya pedoman rumusan kompetensi luluan', 'a', '-', '0', 1, '2022-01-13 09:24:38'),
(649, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Ketua Jurusan/Kepala Program Studi harus merumuskan pedoman kompetensi lulusan  dan dilakukan peninjauan minimal 1 kali per tahun ', '27', 'Tersedianya pedoman rumusan kompetensi luluan', 'a', 'Dokumen', 'Pedoman rumusan  kompetensi lulusan', 1, '2022-01-13 09:25:19'),
(650, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Ketua Jurusan/Kepala Program Studi harus merumuskan pedoman kompetensi lulusan  dan dilakukan peninjauan minimal 1 kali per tahun ', '27', 'Ada bukti telah dilakukan peninjauan ulang 1 kali per tahun', 'b', '-', '0', 1, '2022-01-13 09:26:49'),
(651, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Ketua Jurusan/Kepala Program Studi harus merumuskan pedoman kompetensi lulusan  dan dilakukan peninjauan minimal 1 kali per tahun ', '27', 'Ada bukti telah dilakukan peninjauan ulang 1 kali per tahun', 'b', 'Dokumen', 'Laporan kegiatan peninjauan ulang dan verifikasi', 1, '2022-01-13 09:27:19'),
(652, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Ketua Jurusan/Kepala program Studi harus melakukan evaluasi kompetensi lulusan setiap satu tahun sekali', '28', '0', '0', '0', '0', 1, '2022-01-13 09:27:49'),
(653, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Ketua Jurusan/Kepala program Studi harus melakukan evaluasi kompetensi lulusan setiap satu tahun sekali', '28', 'Ada bukti pelaksanaan evaluasi kompetensi lulusan', 'a', '-', '0', 1, '2022-01-13 09:30:33'),
(654, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Ketua Jurusan/Kepala program Studi harus melakukan evaluasi kompetensi lulusan setiap satu tahun sekali', '28', 'Ada bukti pelaksanaan evaluasi kompetensi lulusan', 'a', 'Dokumen', 'Laporan evaluasi kompetensi lulusan', 1, '2022-01-13 09:30:50'),
(655, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Wakil Direktur I, II, dan III menetapkan pedoman pelaksanaan pengalaman kerja mahasiswa yang berbentuk pelatihan kerja, kerja praktik, praktik kerja lapangan atau bentuk kegiatan lain yang sejenis dan dilakukan peninjauan ulang minimal satu kali pada akhir tahun akademik.', '29', '0', '0', '0', '0', 1, '2022-01-13 09:32:21'),
(656, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Wakil Direktur I, II, dan III menetapkan pedoman pelaksanaan pengalaman kerja mahasiswa yang berbentuk pelatihan kerja, kerja praktik, praktik kerja lapangan atau bentuk kegiatan lain yang sejenis dan dilakukan peninjauan ulang minimal satu kali pada akhir tahun akademik.', '29', 'Tersedianya pedoman pengalaman kerja mahasiswa ', 'a', '-', '0', 1, '2022-01-13 09:32:53'),
(657, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Wakil Direktur I, II, dan III menetapkan pedoman pelaksanaan pengalaman kerja mahasiswa yang berbentuk pelatihan kerja, kerja praktik, praktik kerja lapangan atau bentuk kegiatan lain yang sejenis dan dilakukan peninjauan ulang minimal satu kali pada akhir tahun akademik.', '29', 'Tersedianya pedoman pengalaman kerja mahasiswa ', 'a', 'Dokumen', 'Pedoman pelaksanaan pengalaman kerja mahasiswa', 1, '2022-01-13 09:33:26'),
(658, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Wakil Direktur I, II, dan III menetapkan pedoman pelaksanaan pengalaman kerja mahasiswa yang berbentuk pelatihan kerja, kerja praktik, praktik kerja lapangan atau bentuk kegiatan lain yang sejenis dan dilakukan peninjauan ulang minimal satu kali pada akhir tahun akademik.', '29', 'Tersedia POB untuk pelatihan kerja untuk program pendidikan Diploma 3 dan Diploma 4', 'b', '-', '0', 1, '2022-01-13 09:34:08'),
(659, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Wakil Direktur I, II, dan III menetapkan pedoman pelaksanaan pengalaman kerja mahasiswa yang berbentuk pelatihan kerja, kerja praktik, praktik kerja lapangan atau bentuk kegiatan lain yang sejenis dan dilakukan peninjauan ulang minimal satu kali pada akhir tahun akademik.', '29', 'Tersedia POB untuk pelatihan kerja untuk program pendidikan Diploma 3 dan Diploma 4', 'b', 'Dokumen', 'POB pelatihan kerja', 1, '2022-01-13 09:34:24'),
(660, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Wakil Direktur I, II, dan III menetapkan pedoman pelaksanaan pengalaman kerja mahasiswa yang berbentuk pelatihan kerja, kerja praktik, praktik kerja lapangan atau bentuk kegiatan lain yang sejenis dan dilakukan peninjauan ulang minimal satu kali pada akhir tahun akademik.', '29', 'Tersedianya POB kerja praktik', 'c', '-', '0', 1, '2022-01-13 09:34:51'),
(661, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Wakil Direktur I, II, dan III menetapkan pedoman pelaksanaan pengalaman kerja mahasiswa yang berbentuk pelatihan kerja, kerja praktik, praktik kerja lapangan atau bentuk kegiatan lain yang sejenis dan dilakukan peninjauan ulang minimal satu kali pada akhir tahun akademik.', '29', 'Tersedianya POB kerja praktik', 'c', 'Dokumen', 'POB kerja praktik', 1, '2022-01-13 09:35:12'),
(662, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Wakil Direktur I, II, dan III menetapkan pedoman pelaksanaan pengalaman kerja mahasiswa yang berbentuk pelatihan kerja, kerja praktik, praktik kerja lapangan atau bentuk kegiatan lain yang sejenis dan dilakukan peninjauan ulang minimal satu kali pada akhir tahun akademik.', '29', 'Tersedianya POB praktik kerja lapangan', 'd', '-', '0', 1, '2022-01-13 09:35:41'),
(663, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Wakil Direktur I, II, dan III menetapkan pedoman pelaksanaan pengalaman kerja mahasiswa yang berbentuk pelatihan kerja, kerja praktik, praktik kerja lapangan atau bentuk kegiatan lain yang sejenis dan dilakukan peninjauan ulang minimal satu kali pada akhir tahun akademik.', '29', 'Tersedianya POB praktik kerja lapangan', 'd', 'Dokumen', 'POB praktik kerja lapangan', 1, '2022-01-13 09:36:27'),
(664, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Wakil Direktur I, II, dan III menetapkan pedoman pelaksanaan pengalaman kerja mahasiswa yang berbentuk pelatihan kerja, kerja praktik, praktik kerja lapangan atau bentuk kegiatan lain yang sejenis dan dilakukan peninjauan ulang minimal satu kali pada akhir tahun akademik.', '29', 'Tersedianya POB Penelitan Terapan untuk Mahasiswa Program Magister Terapan', 'e', '-', '0', 1, '2022-01-13 09:36:55'),
(665, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Wakil Direktur I, II, dan III menetapkan pedoman pelaksanaan pengalaman kerja mahasiswa yang berbentuk pelatihan kerja, kerja praktik, praktik kerja lapangan atau bentuk kegiatan lain yang sejenis dan dilakukan peninjauan ulang minimal satu kali pada akhir tahun akademik.', '29', 'Tersedianya POB Penelitan Terapan untuk Mahasiswa Program Magister Terapan', 'e', 'Dokumen', 'POB Penelitan Terapan untuk Mahasiswa Program Magister Terapan', 1, '2022-01-13 09:37:15'),
(666, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Wakil Direktur I, II, dan III menetapkan pedoman pelaksanaan pengalaman kerja mahasiswa yang berbentuk pelatihan kerja, kerja praktik, praktik kerja lapangan atau bentuk kegiatan lain yang sejenis dan dilakukan peninjauan ulang minimal satu kali pada akhir tahun akademik.', '29', 'Tersedianya POB untuk Proyek di Desa/KKNT', 'f', '-', '0', 1, '2022-01-13 09:37:57'),
(667, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Wakil Direktur I, II, dan III menetapkan pedoman pelaksanaan pengalaman kerja mahasiswa yang berbentuk pelatihan kerja, kerja praktik, praktik kerja lapangan atau bentuk kegiatan lain yang sejenis dan dilakukan peninjauan ulang minimal satu kali pada akhir tahun akademik.', '29', 'Tersedianya POB untuk Proyek di Desa/KKNT', 'f', 'Dokumen', 'POB Proyek di Desa/KKNT', 1, '2022-01-13 09:38:13'),
(668, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Wakil Direktur I, II, dan III menetapkan pedoman pelaksanaan pengalaman kerja mahasiswa yang berbentuk pelatihan kerja, kerja praktik, praktik kerja lapangan atau bentuk kegiatan lain yang sejenis dan dilakukan peninjauan ulang minimal satu kali pada akhir tahun akademik.', '29', 'Tersedianya POB untuk Mengajar di Sekolah/Satuan Pendidikan', 'g', '-', '0', 1, '2022-01-13 09:39:22'),
(669, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Wakil Direktur I, II, dan III menetapkan pedoman pelaksanaan pengalaman kerja mahasiswa yang berbentuk pelatihan kerja, kerja praktik, praktik kerja lapangan atau bentuk kegiatan lain yang sejenis dan dilakukan peninjauan ulang minimal satu kali pada akhir tahun akademik.', '29', 'Tersedianya POB untuk Mengajar di Sekolah/Satuan Pendidikan', 'g', 'Dokumen', 'POB untuk Mengajar di Sekolah', 1, '2022-01-13 09:39:42'),
(670, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Wakil Direktur I, II, dan III menetapkan pedoman pelaksanaan pengalaman kerja mahasiswa yang berbentuk pelatihan kerja, kerja praktik, praktik kerja lapangan atau bentuk kegiatan lain yang sejenis dan dilakukan peninjauan ulang minimal satu kali pada akhir tahun akademik.', '29', 'Tersedianya POB untuk Pertukaran Mahasiswa', 'h', '-', '0', 1, '2022-01-13 09:40:13'),
(671, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Wakil Direktur I, II, dan III menetapkan pedoman pelaksanaan pengalaman kerja mahasiswa yang berbentuk pelatihan kerja, kerja praktik, praktik kerja lapangan atau bentuk kegiatan lain yang sejenis dan dilakukan peninjauan ulang minimal satu kali pada akhir tahun akademik.', '29', 'Tersedianya POB untuk Pertukaran Mahasiswa', 'h', 'Dokumen', 'POB untuk Pertukaran Mahasiswa', 1, '2022-01-13 09:40:29'),
(672, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Wakil Direktur I, II, dan III menetapkan pedoman pelaksanaan pengalaman kerja mahasiswa yang berbentuk pelatihan kerja, kerja praktik, praktik kerja lapangan atau bentuk kegiatan lain yang sejenis dan dilakukan peninjauan ulang minimal satu kali pada akhir tahun akademik.', '29', 'Tersedianya POB untuk Kegiatan Wirausaha', 'i', '-', '0', 1, '2022-01-13 09:41:09'),
(673, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Wakil Direktur I, II, dan III menetapkan pedoman pelaksanaan pengalaman kerja mahasiswa yang berbentuk pelatihan kerja, kerja praktik, praktik kerja lapangan atau bentuk kegiatan lain yang sejenis dan dilakukan peninjauan ulang minimal satu kali pada akhir tahun akademik.', '29', 'Tersedianya POB untuk Kegiatan Wirausaha', 'i', 'Dokumen', 'POB untuk Kegiatan Wirausaha', 1, '2022-01-13 09:41:23'),
(674, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Wakil Direktur I, II, dan III menetapkan pedoman pelaksanaan pengalaman kerja mahasiswa yang berbentuk pelatihan kerja, kerja praktik, praktik kerja lapangan atau bentuk kegiatan lain yang sejenis dan dilakukan peninjauan ulang minimal satu kali pada akhir tahun akademik.', '29', 'Tersedianya POB untuk Studi/Proyek Independen', 'j', '-', '0', 1, '2022-01-13 09:41:46'),
(675, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Wakil Direktur I, II, dan III menetapkan pedoman pelaksanaan pengalaman kerja mahasiswa yang berbentuk pelatihan kerja, kerja praktik, praktik kerja lapangan atau bentuk kegiatan lain yang sejenis dan dilakukan peninjauan ulang minimal satu kali pada akhir tahun akademik.', '29', 'Tersedianya POB untuk Studi/Proyek Independen', 'j', 'Dokumen', 'POB untuk Studi/Proyek Independen', 1, '2022-01-13 09:42:02'),
(676, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Wakil Direktur I, II, dan III menetapkan pedoman pelaksanaan pengalaman kerja mahasiswa yang berbentuk pelatihan kerja, kerja praktik, praktik kerja lapangan atau bentuk kegiatan lain yang sejenis dan dilakukan peninjauan ulang minimal satu kali pada akhir tahun akademik.', '29', 'Tersedianya POB untuk Proyek Kemanusiaan', 'k', '-', '0', 1, '2022-01-13 09:42:36'),
(677, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Wakil Direktur I, II, dan III menetapkan pedoman pelaksanaan pengalaman kerja mahasiswa yang berbentuk pelatihan kerja, kerja praktik, praktik kerja lapangan atau bentuk kegiatan lain yang sejenis dan dilakukan peninjauan ulang minimal satu kali pada akhir tahun akademik.', '29', 'Tersedianya POB untuk Proyek Kemanusiaan', 'k', 'Dokumen', 'POB untuk Proyek Kemanusiaan', 1, '2022-01-13 09:42:52'),
(678, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Wakil Direktur I, II, dan III menetapkan pedoman pelaksanaan pengalaman kerja mahasiswa yang berbentuk pelatihan kerja, kerja praktik, praktik kerja lapangan atau bentuk kegiatan lain yang sejenis dan dilakukan peninjauan ulang minimal satu kali pada akhir tahun akademik.', '29', 'Ada bukti telah dilakukan peninjauan ulang 1 kali per tahun', 'l', '-', '0', 1, '2022-01-13 09:43:19'),
(679, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Ketua Jurusan/Kepala Program Studi harus merumuskan pedoman kompetensi lulusan  dan dilakukan peninjauan minimal 1 kali per tahun ', '27', 'Ada bukti telah dilakukan peninjauan ulang 1 kali per tahun', 'b', 'Dokumen', 'Laporan kegiatan peninjauan ulang dan verifikasi.', 1, '2022-01-13 09:43:58'),
(680, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Wakil Direktur III harus menetapkan pedoman pelaksanaan peningkatan kemampuan lulusan melalui kegiatan ekstra kurikuler/ tambahan yang dilaksanakan minimal satu kali per tahun', '30', '0', '0', '0', '0', 1, '2022-01-13 09:44:43'),
(681, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Wakil Direktur III harus menetapkan pedoman pelaksanaan peningkatan kemampuan lulusan melalui kegiatan ekstra kurikuler/ tambahan yang dilaksanakan minimal satu kali per tahun', '30', 'Tersedianya pedoman pelaksanaan peningkatan kemampuan lulusan melalui kegiatan ekstrakurikuler', 'a', '-', '0', 1, '2022-01-13 09:45:18'),
(682, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Wakil Direktur III harus menetapkan pedoman pelaksanaan peningkatan kemampuan lulusan melalui kegiatan ekstra kurikuler/ tambahan yang dilaksanakan minimal satu kali per tahun', '30', 'Tersedianya pedoman pelaksanaan peningkatan kemampuan lulusan melalui kegiatan ekstrakurikuler', 'a', 'Dokumen', 'Pedoman pelaksanaan peningkatan kemampuan lulusan melalui kegiatan ekstrakurikuler', 1, '2022-01-13 09:49:01'),
(683, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Wakil Direktur III harus melakukan kegiatan monitoring peningkatan kemampuan lulusan melalui kegiatan ekstrakurikuler minimal satu kali setiap akhir tahun akademik', '31', '0', '0', '0', '0', 1, '2022-01-13 09:49:30'),
(684, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Wakil Direktur III harus melakukan kegiatan monitoring peningkatan kemampuan lulusan melalui kegiatan ekstrakurikuler minimal satu kali setiap akhir tahun akademik', '31', 'Terlaksananya kegiatan monitoring peningkatan kemampuan lulusan melalui kegiatan ekstrakurikuler ', 'a', '-', '0', 1, '2022-01-13 09:49:53'),
(685, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Wakil Direktur III harus melakukan kegiatan monitoring peningkatan kemampuan lulusan melalui kegiatan ekstrakurikuler minimal satu kali setiap akhir tahun akademik', '31', 'Terlaksananya kegiatan monitoring peningkatan kemampuan lulusan melalui kegiatan ekstrakurikuler ', 'a', 'Dokumen', 'POB  monitoring untuk kemampuan lulusan', 1, '2022-01-13 09:50:08'),
(686, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Wakil Direktur III harus melakukan kegiatan monitoring peningkatan kemampuan lulusan melalui kegiatan ekstrakurikuler minimal satu kali setiap akhir tahun akademik', '31', 'Tersedianya laporan hasil kegiatan monitoring peningkatan kemampuan lulusan melalui kegiatan ekstrakurikuler ', 'b', '-', '0', 1, '2022-01-13 09:50:28'),
(687, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Wakil Direktur III harus melakukan kegiatan monitoring peningkatan kemampuan lulusan melalui kegiatan ekstrakurikuler minimal satu kali setiap akhir tahun akademik', '31', 'Tersedianya laporan hasil kegiatan monitoring peningkatan kemampuan lulusan melalui kegiatan ekstrakurikuler ', 'b', 'Dokumen', 'Laporan hasil monitoring dan evaluasi kemampuan lulusan, kemampuan tambahan dan kegiatan ekstrakurikuler', 1, '2022-01-13 09:50:46'),
(688, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Wakil Direktur I menunjuk LSP P1 Politeknik Negeri Medan untuk menyelenggarakan pelaksanaan uji kompetensi bagi mahasiswa setiap tahunnya', '32', '0', '0', '0', '0', 1, '2022-01-13 09:51:28'),
(689, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Wakil Direktur I menunjuk LSP P1 Politeknik Negeri Medan untuk menyelenggarakan pelaksanaan uji kompetensi bagi mahasiswa setiap tahunnya', '32', 'Surat Edaran Wakil Direktur I terkait uji kompetensi bidang keahlian', 'a', '-', '0', 1, '2022-01-13 09:51:53'),
(690, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Wakil Direktur I menunjuk LSP P1 Politeknik Negeri Medan untuk menyelenggarakan pelaksanaan uji kompetensi bagi mahasiswa setiap tahunnya', '32', 'Surat Edaran Wakil Direktur I terkait uji kompetensi bidang keahlian', 'a', 'Dokumen', 'Surat Edaran Wakil Direktur I ', 1, '2022-01-13 09:52:13'),
(691, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'LSP harus menyediakan pedoman pelaksanaan uji kompetensi dan dilakukan peninjauan ulang minimal satu kali dalam dua tahun', '33', '0', '0', '0', '0', 1, '2022-01-13 09:52:45'),
(692, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'LSP harus menyediakan pedoman pelaksanaan uji kompetensi dan dilakukan peninjauan ulang minimal satu kali dalam dua tahun', '33', 'Tersedianya POB Pelaksanaan Uji Kompetensi', 'a', '-', '0', 1, '2022-01-13 09:53:03'),
(693, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'LSP harus menyediakan pedoman pelaksanaan uji kompetensi dan dilakukan peninjauan ulang minimal satu kali dalam dua tahun', '33', 'Tersedianya POB Pelaksanaan Uji Kompetensi', 'a', 'Dokumen', 'POB Pelaksanaan Uji Kompetensi', 1, '2022-01-13 09:53:21'),
(694, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'LSP harus memastikan ketersediaan asesor kompetensi sesuai Peraturan Perundangan yang berlaku', '34', '0', '0', '0', '0', 1, '2022-01-13 09:53:46'),
(695, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'LSP harus memastikan ketersediaan asesor kompetensi sesuai Peraturan Perundangan yang berlaku', '34', 'Tersedianya asesor kompetensi sesuai Peraturan Perundangan yang berlaku', 'a', '-', '0', 1, '2022-01-13 09:54:03'),
(696, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'LSP harus memastikan ketersediaan asesor kompetensi sesuai Peraturan Perundangan yang berlaku', '34', 'Tersedianya asesor kompetensi sesuai Peraturan Perundangan yang berlaku', 'a', 'Dokumen', 'Daftar Asesor kompetensi sesuai Peraturan Perundangan yang berlaku', 1, '2022-01-13 09:54:20'),
(697, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'LSP harus memenuhi target ketercapaian kepemilikan sertifikat kompetensi mahasiswa untuk Program Diploma 3 dan 4 setiap tahunnya ', '35', '0', '0', '0', '0', 1, '2022-01-13 10:07:14'),
(698, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'LSP harus memenuhi target ketercapaian kepemilikan sertifikat kompetensi mahasiswa untuk Program Diploma 3 dan 4 setiap tahunnya ', '35', 'Persentase lulusan yang memiliki sertifikat kompetensi/industri', 'a', '-', '0', 1, '2022-01-13 10:07:58'),
(699, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'LSP harus memenuhi target ketercapaian kepemilikan sertifikat kompetensi mahasiswa untuk Program Diploma 3 dan 4 setiap tahunnya ', '35', 'Persentase lulusan yang memiliki sertifikat kompetensi/industri', 'a', 'Dokumen', 'POB pelaksanaan Uji Kompetensi', 1, '2022-01-13 10:08:27'),
(700, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'LSP harus mengevaluasi pelaksanaan uji kompetensi setiap akhir tahun akademik', '36', '0', '0', '0', '0', 1, '2022-01-13 10:09:07'),
(701, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'LSP harus mengevaluasi pelaksanaan uji kompetensi setiap akhir tahun akademik', '36', 'Laporan hasil evaluasi pelaksanaan uji kompetensi', 'a', '-', '0', 1, '2022-01-13 10:09:29'),
(702, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'LSP harus mengevaluasi pelaksanaan uji kompetensi setiap akhir tahun akademik', '36', 'Laporan hasil evaluasi pelaksanaan uji kompetensi', 'a', 'Dokumen', 'Laporan hasil evaluasi uji kompetensi', 1, '2022-01-13 10:09:53'),
(703, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Direktur harus menetapkan kebijakan terkait kewajiban mahasiswa akhir untuk mengikuti uji kemampuan Bahasa Inggris  (TOEIC)', '37', '0', '0', '0', '0', 1, '2022-01-13 10:10:20'),
(704, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Direktur harus menetapkan kebijakan terkait kewajiban mahasiswa akhir untuk mengikuti uji kemampuan Bahasa Inggris  (TOEIC)', '37', 'Surat Keputusan Direktur terkait pemenuhan kompetensi bahasa Inggris mahasiswa', 'a', '-', '0', 1, '2022-01-13 10:10:40'),
(705, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Direktur harus menetapkan kebijakan terkait kewajiban mahasiswa akhir untuk mengikuti uji kemampuan Bahasa Inggris  (TOEIC)', '37', 'Surat Keputusan Direktur terkait pemenuhan kompetensi bahasa Inggris mahasiswa', 'a', 'Dokumen', 'Surat Keputusan Direktur ', 1, '2022-01-13 10:11:08'),
(706, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'UPT Bahasa berkoordinasi dengan Wakil Direktur I untuk menetapkan nilai kelulusan mahasiswa Program Diploma 3 dan Program Diploma 4 dalam uji kemampuan bahasa Inggris  (TOEIC)', '38', '0', '0', '0', '0', 1, '2022-01-13 10:12:20'),
(707, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'UPT Bahasa berkoordinasi dengan Wakil Direktur I untuk menetapkan nilai kelulusan mahasiswa Program Diploma 3 dan Program Diploma 4 dalam uji kemampuan bahasa Inggris  (TOEIC)', '38', 'Surat Edaran Wakil Direktur I terkait nilai kelulusan mahasiswa Program Diploma 3 dalam uji kemampuan bahasa Inggris  (TOEIC) adalah  â‰¥ 400', 'a', '-', '0', 1, '2022-01-13 10:12:59'),
(708, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'UPT Bahasa berkoordinasi dengan Wakil Direktur I untuk menetapkan nilai kelulusan mahasiswa Program Diploma 3 dan Program Diploma 4 dalam uji kemampuan bahasa Inggris  (TOEIC)', '38', 'Surat Edaran Wakil Direktur I terkait nilai kelulusan mahasiswa Program Diploma 3 dalam uji kemampuan bahasa Inggris  (TOEIC) adalah  â‰¥ 400', 'a', 'Dokumen', 'Surat Edaran Wakil Direktur I terkait nilai kelulusan mahasiswa Program Diploma 3 dalam uji kemampuan bahasa Inggris  (TOEIC) adalah  â‰¥ 400', 1, '2022-01-13 10:13:17'),
(709, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'UPT Bahasa berkoordinasi dengan Wakil Direktur I untuk menetapkan nilai kelulusan mahasiswa Program Diploma 3 dan Program Diploma 4 dalam uji kemampuan bahasa Inggris  (TOEIC)', '38', 'Laporan hasil Uji Kemampuan Bahasa Inggris (TOEIC)', 'b', '-', '0', 1, '2022-01-13 10:15:28'),
(710, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'UPT Bahasa berkoordinasi dengan Wakil Direktur I untuk menetapkan nilai kelulusan mahasiswa Program Diploma 3 dan Program Diploma 4 dalam uji kemampuan bahasa Inggris  (TOEIC)', '38', 'Laporan hasil Uji Kemampuan Bahasa Inggris (TOEIC)', 'b', 'Dokumen', 'Laporan hasil Uji Kemampuan Bahasa Inggris (TOEIC)', 1, '2022-01-13 10:15:51'),
(711, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'UPT Bahasa berkoordinasi dengan Wakil Direktur I untuk menetapkan nilai kelulusan mahasiswa Program Diploma 3 dan Program Diploma 4 dalam uji kemampuan bahasa Inggris  (TOEIC)', '38', 'Surat Edaran Wakil Direktur I terkait nilai kelulusan mahasiswa Program Diploma 3 dalam uji kemampuan bahasa Inggris  (TOEIC) adalah  â‰¥ 430', 'c', '-', '0', 1, '2022-01-13 10:16:21'),
(712, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'UPT Bahasa berkoordinasi dengan Wakil Direktur I untuk menetapkan nilai kelulusan mahasiswa Program Diploma 3 dan Program Diploma 4 dalam uji kemampuan bahasa Inggris  (TOEIC)', '38', 'Surat Edaran Wakil Direktur I terkait nilai kelulusan mahasiswa Program Diploma 3 dalam uji kemampuan bahasa Inggris  (TOEIC) adalah  â‰¥ 430', 'c', 'Dokumen', 'Surat Edaran Wakil Direktur I terkait nilai kelulusan mahasiswa Program Diploma 3 dalam uji kemampuan bahasa Inggris  (TOEIC) adalah  â‰¥ 430', 1, '2022-01-13 10:16:45'),
(713, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'UPT Bahasa berkoordinasi dengan Wakil Direktur I untuk menetapkan nilai kelulusan mahasiswa Program Diploma 3 dan Program Diploma 4 dalam uji kemampuan bahasa Inggris  (TOEIC)', '38', 'Laporan hasil Uji Kemampuan Bahasa Inggris (TOEIC)', 'd', '-', '0', 1, '2022-01-13 10:17:11'),
(714, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'UPT Bahasa berkoordinasi dengan Wakil Direktur I untuk menetapkan nilai kelulusan mahasiswa Program Diploma 3 dan Program Diploma 4 dalam uji kemampuan bahasa Inggris  (TOEIC)', '38', 'Laporan hasil Uji Kemampuan Bahasa Inggris (TOEIC)', 'b', 'Dokumen', 'Laporan hasil Uji Kemampuan Bahasa Inggris (TOEIC).', 1, '2022-01-13 10:17:46'),
(715, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'CDC (Center Development Career) harus memastikan melalui Tracer study, persentase jumlah lulusan yang mendapatkan pekerjaan yang layak dengan masa tunggu kurang dari 6 bulan setelah tanggal terbit ijazah', '39', '0', '0', '0', '0', 1, '2022-01-13 10:18:15'),
(716, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'CDC (Center Development Career) harus memastikan melalui Tracer study, persentase jumlah lulusan yang mendapatkan pekerjaan yang layak dengan masa tunggu kurang dari 6 bulan setelah tanggal terbit ijazah', '39', 'Masa tunggu kurang dari 6 bulan setelah tanggal terbit ijazah', 'a', '-', '0', 1, '2022-01-13 10:18:40'),
(717, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'CDC (Center Development Career) harus memastikan melalui Tracer study, persentase jumlah lulusan yang mendapatkan pekerjaan yang layak dengan masa tunggu kurang dari 6 bulan setelah tanggal terbit ijazah', '39', 'Masa tunggu kurang dari 6 bulan setelah tanggal terbit ijazah', 'a', 'Dokumen', 'Rekapitulasi data CDC terkait jumlah lulusan yang mendapatkan pekerjaan layak', 1, '2022-01-13 10:18:56'),
(718, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Wakil Direktur III harus memastikan ketercapaian target lulusan yang berwirausaha untuk Diploma 3 dan Diploma 4 pada setiap akhir tahun akademik', '40', '0', '0', '0', '0', 1, '2022-01-13 10:19:23'),
(719, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Wakil Direktur III harus memastikan ketercapaian target lulusan yang berwirausaha untuk Diploma 3 dan Diploma 4 pada setiap akhir tahun akademik', '40', 'Tersedianya laporan ketercapaian target lulusan yang berwirausaha untuk Diploma 3 dan Diploma 4', 'a', '-', '0', 1, '2022-01-13 10:19:43'),
(720, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Wakil Direktur III harus memastikan ketercapaian target lulusan yang berwirausaha untuk Diploma 3 dan Diploma 4 pada setiap akhir tahun akademik', '40', 'Tersedianya laporan ketercapaian target lulusan yang berwirausaha untuk Diploma 3 dan Diploma 4', 'a', 'Dokumen', 'Laporan terkait ketercapaian target lulusan yang berwirausaha untuk Diploma 3 dan Diploma 4', 1, '2022-01-13 10:20:01'),
(721, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'CDC harus memastikan persentase jumlah lulusan dalam kriteria kelanjutan studi kurang dari 6 bulan setelah tanggal terbit ijazah â‰¥ 0,3%', '41', '0', '0', '0', '0', 1, '2022-01-13 10:20:44'),
(722, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'CDC harus memastikan persentase jumlah lulusan dalam kriteria kelanjutan studi kurang dari 6 bulan setelah tanggal terbit ijazah â‰¥ 0,3%', '41', 'Laporan hasil Tracer study terkait lulusan  dalam kriteria kelanjutan studi kurang dari 6 bulan setelah tanggal terbit ijazah', 'a', '-', '0', 1, '2022-01-13 10:21:38'),
(723, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'CDC harus memastikan persentase jumlah lulusan dalam kriteria kelanjutan studi kurang dari 6 bulan setelah tanggal terbit ijazah â‰¥ 0,3%', '41', 'Laporan hasil Tracer study terkait lulusan  dalam kriteria kelanjutan studi kurang dari 6 bulan setelah tanggal terbit ijazah', 'a', 'Dokumen', 'Laporan hasil Tracer study terkait lulusan  dalam kriteria kelanjutan studi kurang dari 6 bulan setelah tanggal terbit ijazah', 1, '2022-01-13 10:21:52'),
(724, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Ketua Jurusan/Kepala Program Studi berkoordinasi dengan CDC harus mengukur jumlah lulusan yang bekerja di badan usaha tingkat internasional/ multi nasional/ badan usaha tingkat nasional atau berwirausaha yang berizin/ badan usaha tingkat wilayah/lokal atau berwirausaha tidak berizin minimal 5% setiap tahun', '42', '0', '0', '0', '0', 1, '2022-01-13 10:34:18'),
(725, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Ketua Jurusan/Kepala Program Studi berkoordinasi dengan CDC harus mengukur jumlah lulusan yang bekerja di badan usaha tingkat internasional/ multi nasional/ badan usaha tingkat nasional atau berwirausaha yang berizin/ badan usaha tingkat wilayah/lokal atau berwirausaha tidak berizin minimal 5% setiap tahun', '42', 'Tingkat dan ukuranntempat kerja lulusan. Tabel 8.e.1 LKPS', 'a', '-', '0', 1, '2022-01-13 10:34:48'),
(726, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Ketua Jurusan/Kepala Program Studi berkoordinasi dengan CDC harus mengukur jumlah lulusan yang bekerja di badan usaha tingkat internasional/ multi nasional/ badan usaha tingkat nasional atau berwirausaha yang berizin/ badan usaha tingkat wilayah/lokal atau berwirausaha tidak berizin minimal 5% setiap tahun', '42', 'Tingkat dan ukuranntempat kerja lulusan. Tabel 8.e.1 LKPS', 'a', 'Dokumen', 'Tingkat dan ukuran tempat kerja lulusan. Tabel 8.e.1 LKPS', 1, '2022-01-13 10:35:10'),
(727, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'CDC harus mengukur jumlah lulusan yang bekerja di badan usaha tingkat internasional/ multi nasional/ badan usaha tingkat nasional atau berwirausaha yang berizin/ badan usaha tingkat wilayah/lokal atau berwirausaha tidak berizin minimal 5% setiap tahun', '43', '0', '0', '0', '0', 1, '2022-01-13 10:35:34'),
(728, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'CDC harus mengukur jumlah lulusan yang bekerja di badan usaha tingkat internasional/ multi nasional/ badan usaha tingkat nasional atau berwirausaha yang berizin/ badan usaha tingkat wilayah/lokal atau berwirausaha tidak berizin minimal 5% setiap tahun', '43', 'Tabel 5.e.2 LKPT Tempat Kerja Lulusan\n', 'a', '-', '0', 1, '2022-01-13 10:35:56'),
(729, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'CDC harus mengukur jumlah lulusan yang bekerja di badan usaha tingkat internasional/ multi nasional/ badan usaha tingkat nasional atau berwirausaha yang berizin/ badan usaha tingkat wilayah/lokal atau berwirausaha tidak berizin minimal 5% setiap tahun', '43', 'Tabel 5.e.2 LKPT Tempat Kerja Lulusan\n', 'a', 'Dokumen', 'Tabel 5.e.2 LKPT Tempat Kerja Lulusan', 1, '2022-01-13 10:36:29'),
(730, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'CDC  harus melaksanakan tracer study yang mencakup 5 aspek pada setiap akhir tahun akademik, mensosialisasikan hasil pelaksanaan tracer study dan mengevaluasi pelaksanaannya pada setiap awal tahun akademik berikutnya', '44', '0', '0', '0', '0', 1, '2022-01-13 10:38:46'),
(731, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'CDC  harus melaksanakan tracer study yang mencakup 5 aspek pada setiap akhir tahun akademik, mensosialisasikan hasil pelaksanaan tracer study dan mengevaluasi pelaksanaannya pada setiap awal tahun akademik berikutnya', '44', 'Tersedianya bukti  Tracer study yang mencakup 5 aspek sebagai berikut:\n 1) pelaksanaan tracer study terkoordinasi di tingkat PT; \n2) kegiatan tracer study dilakukan secara reguler setiap tahun dan terdokumentasi;\n3) isi kuesioner mencakup seluruh pertanyaan inti tracer study DIKTI;\n4) ditargetkan pada seluruh populasi (lulusan TS-4 s.d. TS-2), 5) hasilnya\ndisosialisasikan dan digunakan untuk pengembangan kurikulum dan\npembelajaran.', 'a', '-', '0', 1, '2022-01-13 10:39:45'),
(732, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'CDC  harus melaksanakan tracer study yang mencakup 5 aspek pada setiap akhir tahun akademik, mensosialisasikan hasil pelaksanaan tracer study dan mengevaluasi pelaksanaannya pada setiap awal tahun akademik berikutnya', '44', 'Tersedianya bukti  Tracer study yang mencakup 5 aspek sebagai berikut:\n 1) pelaksanaan tracer study terkoordinasi di tingkat PT; \n2) kegiatan tracer study dilakukan secara reguler setiap tahun dan terdokumentasi;\n3) isi kuesioner mencakup seluruh pertanyaan inti tracer study DIKTI;\n4) ditargetkan pada seluruh populasi (lulusan TS-4 s.d. TS-2), 5) hasilnya\ndisosialisasikan dan digunakan untuk pengembangan kurikulum dan\npembelajaran.', 'a', 'Dokumen', 'Laporan pelaksanaan tracer study, dokumentasi kegiatan, hasil analisis dan evaluasi,  serta sosialisasi', 1, '2022-01-13 10:40:11'),
(733, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Ketua Jurusan/Kepala Program Studi harus memastikan ada Produk/jasa karya mahasiswa, yang dihasilkan secara mandiri atau bersama DTPS, yang diadopsi oleh industri/masyarakat dalam 3 tahun terakhir\n', '45', '0', '0', '0', '0', 1, '2022-01-13 10:45:05'),
(734, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Ketua Jurusan/Kepala Program Studi harus memastikan ada Produk/jasa karya mahasiswa, yang dihasilkan secara mandiri atau bersama DTPS, yang diadopsi oleh industri/masyarakat dalam 3 tahun terakhir\n', '45', 'Tersedianya bukti sahih terkait  Produk/jasa karya mahasiswa, yang\ndihasilkan secara mandiri atau bersama DTPS, yang diadopsi oleh industri/masyarakat dalam 3 tahun terakhir.\n', 'a', '-', '0', 1, '2022-01-13 10:46:05'),
(735, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Ketua Jurusan/Kepala Program Studi harus memastikan ada Produk/jasa karya mahasiswa, yang dihasilkan secara mandiri atau bersama DTPS, yang diadopsi oleh industri/masyarakat dalam 3 tahun terakhir\n', '45', 'Tersedianya bukti sahih terkait  Produk/jasa karya mahasiswa, yang\ndihasilkan secara mandiri atau bersama DTPS, yang diadopsi oleh industri/masyarakat dalam 3 tahun terakhir.\n', 'a', 'Dokumen', 'Data Jumlah produk/jasa karya mahasiswa yang diadopsi oleh industri/masyarakat dalam 3 tahun terakhir', 1, '2022-01-13 10:46:25'),
(736, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'UPT Bahasa harus memastikan persentase jumlah mahasiswa yang lulus uji kemampuan Bahasa Inggris (TOEIC) bagi setiap jenjang pendidikan adalah sebesar 35% dari jumlah peserta uji kompetensi bahasa inggris', '46', '0', '0', '0', '0', 1, '2022-01-13 10:46:46'),
(737, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'UPT Bahasa harus memastikan persentase jumlah mahasiswa yang lulus uji kemampuan Bahasa Inggris (TOEIC) bagi setiap jenjang pendidikan adalah sebesar 35% dari jumlah peserta uji kompetensi bahasa inggris', '46', 'Persentase kenaikan kelulusan uji kompetensi Bahasa Inggris', 'a', '-', '0', 1, '2022-01-13 10:47:06'),
(738, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'UPT Bahasa harus memastikan persentase jumlah mahasiswa yang lulus uji kemampuan Bahasa Inggris (TOEIC) bagi setiap jenjang pendidikan adalah sebesar 35% dari jumlah peserta uji kompetensi bahasa inggris', '46', 'Persentase kenaikan kelulusan uji kompetensi Bahasa Inggris', 'a', 'Dokumen', 'Laporan pelaksanaan uji kompetensi', 1, '2022-01-13 10:47:23'),
(739, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'UPT Bahasa harus memastikan persentase jumlah mahasiswa yang lulus uji kemampuan Bahasa Inggris (TOEIC) bagi setiap jenjang pendidikan adalah sebesar 35% dari jumlah peserta uji kompetensi bahasa inggris', '46', 'Tersedianya POB pelaksanaan uji kompetensi bahasa Inggris (TOEIC)', 'b', '-', '0', 1, '2022-01-13 10:47:51'),
(740, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'UPT Bahasa harus memastikan persentase jumlah mahasiswa yang lulus uji kemampuan Bahasa Inggris (TOEIC) bagi setiap jenjang pendidikan adalah sebesar 35% dari jumlah peserta uji kompetensi bahasa inggris', '46', 'Tersedianya POB pelaksanaan uji kompetensi bahasa Inggris (TOEIC)', 'b', 'Dokumen', 'POB pelaksanaan uji kompetensi bahasa Inggris (TOEIC)', 1, '2022-01-13 10:48:03'),
(741, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'UPT Bahasa harus memastikan persentase jumlah mahasiswa yang lulus uji kemampuan Bahasa Inggris (TOEIC) bagi setiap jenjang pendidikan adalah sebesar 35% dari jumlah peserta uji kompetensi bahasa inggris', '46', 'Tersedianya jadwal pelaksanaan uji kompetensi, tempat uji kompetensi dan soal uji kompetensi', 'c', '-', '0', 1, '2022-01-13 10:48:22'),
(742, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'UPT Bahasa harus memastikan persentase jumlah mahasiswa yang lulus uji kemampuan Bahasa Inggris (TOEIC) bagi setiap jenjang pendidikan adalah sebesar 35% dari jumlah peserta uji kompetensi bahasa inggris', '46', 'Tersedianya jadwal pelaksanaan uji kompetensi, tempat uji kompetensi dan soal uji kompetensi', 'c', 'Dokumen', 'Jadwal pelaksanaan uji kompetensi, tempat uji kompetensi dan soal uji kompetensi', 1, '2022-01-13 10:49:29'),
(743, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'UPT Bahasa harus memastikan persentase jumlah mahasiswa yang lulus uji kemampuan Bahasa Inggris (TOEIC) bagi setiap jenjang pendidikan adalah sebesar 35% dari jumlah peserta uji kompetensi bahasa inggris', '46', 'Tersedianya dokumentasi sertifikat uji kompetensi Bahasa Inggris', 'd', '-', '0', 1, '2022-01-13 10:51:38'),
(744, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'UPT Bahasa harus memastikan persentase jumlah mahasiswa yang lulus uji kemampuan Bahasa Inggris (TOEIC) bagi setiap jenjang pendidikan adalah sebesar 35% dari jumlah peserta uji kompetensi bahasa inggris', '46', 'Tersedianya dokumentasi sertifikat uji kompetensi Bahasa Inggris', 'd', '-', '0', 1, '2022-01-13 10:51:38'),
(745, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'UPT Bahasa harus memastikan persentase jumlah mahasiswa yang lulus uji kemampuan Bahasa Inggris (TOEIC) bagi setiap jenjang pendidikan adalah sebesar 35% dari jumlah peserta uji kompetensi bahasa inggris', '46', 'Tersedianya dokumentasi sertifikat uji kompetensi Bahasa Inggris', 'd', 'Dokumen', 'Dokumentasi sertifikat uji kompetensi Bahasa Inggris', 1, '2022-01-13 10:52:44'),
(746, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'UPT Bahasa mengevaluasi pelaksanaan uji kompetensi setiap akhir tahun akademik', '47', '0', '0', '0', '0', 1, '2022-01-13 10:53:43'),
(747, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'UPT Bahasa mengevaluasi pelaksanaan uji kompetensi setiap akhir tahun akademik', '47', 'Tersedianya laporan hasil evaluasi pelaksanaan uji kompetensi Bahasa Inggris ', 'a', '-', '0', 1, '2022-01-13 10:54:02'),
(748, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'UPT Bahasa mengevaluasi pelaksanaan uji kompetensi setiap akhir tahun akademik', '47', 'Tersedianya laporan hasil evaluasi pelaksanaan uji kompetensi Bahasa Inggris ', 'a', 'Dokumen', 'Laporan hasil evaluasi pelaksanaan uji kompetensi Bahasa Inggris ', 1, '2022-01-13 10:55:26'),
(749, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Direktur Politeknik Negeri Medan mewajibkan mahasiswa baru mengikuti  Pembinaan Mental Fisik dan Disipin pada setiap tahun akademik', '48', '0', '0', '0', '0', 1, '2022-01-13 10:55:59'),
(750, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Direktur Politeknik Negeri Medan mewajibkan mahasiswa baru mengikuti  Pembinaan Mental Fisik dan Disipin pada setiap tahun akademik', '48', 'Terlaksananya pembinaan Mental Fisik dan Disipin pada setiap tahun akademik', 'a', '-', '0', 1, '2022-01-13 10:56:27'),
(751, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Direktur Politeknik Negeri Medan mewajibkan mahasiswa baru mengikuti  Pembinaan Mental Fisik dan Disipin pada setiap tahun akademik', '48', 'Terlaksananya pembinaan Mental Fisik dan Disipin pada setiap tahun akademik', 'a', 'Dokumen', 'Laporan Pelaksanaan BINTALFISDIS', 1, '2022-01-13 10:56:55'),
(752, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Direktur melakukan kegiatan pemantauan/evaluasi mutu lulusan secara rutin minimal 1 kali per tahun dengan melibatkan SPMI, AMI, dan GKMIJ. ', '49', '0', '0', '0', '0', 1, '2022-01-13 11:00:33'),
(753, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Direktur melakukan kegiatan pemantauan/evaluasi mutu lulusan secara rutin minimal 1 kali per tahun dengan melibatkan SPMI, AMI, dan GKMIJ. ', '49', 'Tersedianya  lingkup Audit Mutu Internal (AMI)\n', 'a', '-', '0', 1, '2022-01-13 11:01:04'),
(754, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Direktur melakukan kegiatan pemantauan/evaluasi mutu lulusan secara rutin minimal 1 kali per tahun dengan melibatkan SPMI, AMI, dan GKMIJ. ', '49', 'Tersedianya  lingkup Audit Mutu Internal (AMI)\n', 'a', 'Dokumen', 'Lingkup AMI', 1, '2022-01-13 11:01:22'),
(755, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Direktur melakukan kegiatan pemantauan/evaluasi mutu lulusan secara rutin minimal 1 kali per tahun dengan melibatkan SPMI, AMI, dan GKMIJ. ', '49', 'Tersedianya jadwal pelaksanaan AMI\n', 'b', '-', '0', 1, '2022-01-13 11:08:34'),
(756, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Direktur melakukan kegiatan pemantauan/evaluasi mutu lulusan secara rutin minimal 1 kali per tahun dengan melibatkan SPMI, AMI, dan GKMIJ. ', '49', 'Tersedianya jadwal pelaksanaan AMI\n', 'b', 'Dokumen', 'Jadwal pelaksanaan AMI', 1, '2022-01-13 11:08:54'),
(757, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Direktur melakukan kegiatan pemantauan/evaluasi mutu lulusan secara rutin minimal 1 kali per tahun dengan melibatkan SPMI, AMI, dan GKMIJ. ', '49', 'Tersedianya penugasan (SK) Auditor AMI', 'c', '-', '0', 1, '2022-01-13 11:09:22'),
(758, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Direktur melakukan kegiatan pemantauan/evaluasi mutu lulusan secara rutin minimal 1 kali per tahun dengan melibatkan SPMI, AMI, dan GKMIJ. ', '49', 'Tersedianya penugasan (SK) Auditor AMI', 'c', 'Dokumen', 'SK Auditor AMI', 1, '2022-01-13 11:10:44'),
(759, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Direktur melakukan kegiatan pemantauan/evaluasi mutu lulusan secara rutin minimal 1 kali per tahun dengan melibatkan SPMI, AMI, dan GKMIJ. ', '49', 'Tersedianya bukti sahih pelaksanaan AMI (Audit dokumen dan Audit Lapangan)', 'd', '-', '0', 1, '2022-01-13 11:12:20'),
(760, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Direktur melakukan kegiatan pemantauan/evaluasi mutu lulusan secara rutin minimal 1 kali per tahun dengan melibatkan SPMI, AMI, dan GKMIJ. ', '49', 'Tersedianya bukti sahih pelaksanaan AMI (Audit dokumen dan Audit Lapangan)', 'd', 'Dokumen', 'Laporan Audit ', 1, '2022-01-13 11:12:40'),
(761, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Direktur melakukan kegiatan pemantauan/evaluasi mutu lulusan secara rutin minimal 1 kali per tahun dengan melibatkan SPMI, AMI, dan GKMIJ. ', '49', 'Terlaksananya Rapat Tinjauan Manajemen (RTM)', 'e', '-', '0', 1, '2022-01-13 11:12:59'),
(762, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Direktur melakukan kegiatan pemantauan/evaluasi mutu lulusan secara rutin minimal 1 kali per tahun dengan melibatkan SPMI, AMI, dan GKMIJ. ', '49', 'Terlaksananya Rapat Tinjauan Manajemen (RTM)', 'e', 'Dokumen', 'Jadwal pelaksanaan RTM dan dokumentasi', 1, '2022-01-13 11:13:17'),
(763, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Direktur melakukan kegiatan pemantauan/evaluasi mutu lulusan secara rutin minimal 1 kali per tahun dengan melibatkan SPMI, AMI, dan GKMIJ. ', '49', 'Tersedianya Hasil RTM (peningkatan efektivitas SPMI dan prosesnya)', 'f', '-', '0', 1, '2022-01-13 11:13:57'),
(764, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Direktur melakukan kegiatan pemantauan/evaluasi mutu lulusan secara rutin minimal 1 kali per tahun dengan melibatkan SPMI, AMI, dan GKMIJ. ', '49', 'Tersedianya Hasil RTM (peningkatan efektivitas SPMI dan prosesnya)', 'f', 'Dokumen', 'Hasil RTM (Peningkatan efektivitas SPMI dan prosesnya)', 1, '2022-01-13 11:14:14'),
(765, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Direktur melakukan kegiatan pemantauan/evaluasi mutu lulusan secara rutin minimal 1 kali per tahun dengan melibatkan SPMI, AMI, dan GKMIJ. ', '49', 'Terlaksananya perbaikan mutu secara berkelanjutan (Continuous Quality Improvement/CQI)', 'g', '-', '0', 1, '2022-01-13 11:14:40'),
(766, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Direktur melakukan kegiatan pemantauan/evaluasi mutu lulusan secara rutin minimal 1 kali per tahun dengan melibatkan SPMI, AMI, dan GKMIJ. ', '49', 'Terlaksananya perbaikan mutu secara berkelanjutan (Continuous Quality Improvement/CQI)', 'g', 'Dokumen', 'CQI/Kaizen', 1, '2022-01-13 11:14:58');
INSERT INTO `standar` (`standarid`, `kodestandar`, `namastandar`, `namasubstandar`, `kodesubstandar`, `namapernyataan`, `kodepernyataan`, `namaindikator`, `kodeindikator`, `catatanindikator`, `namadokumen`, `userid`, `createdDate`) VALUES
(767, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR ISI PEMBELAJARAN', 'STD-01.02/SPMI', '0', '0', '0', '0', '0', '0', 1, '2022-01-13 12:04:01'),
(768, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR ISI PEMBELAJARAN', 'STD-01.02/SPMI', 'Direktur  harus menetapkan kebijakan Pengembangan Kurikulum  yang mempertimbangkan penyediaan sumber daya manusia terampil, perkembangan industri, pengembangan kemampuan lulusan untuk berwirausaha dan penerapan metode pembelajaran dual system di industri dan di perguruan tinggi dan melakukan peninjauan ulang minimal satu kali dalam empat tahun', '1', '0', '0', '0', '0', 1, '2022-01-13 13:31:35'),
(769, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR ISI PEMBELAJARAN', 'STD-01.02/SPMI', 'Direktur  harus menetapkan kebijakan Pengembangan Kurikulum  yang mempertimbangkan penyediaan sumber daya manusia terampil, perkembangan industri, pengembangan kemampuan lulusan untuk berwirausaha dan penerapan metode pembelajaran dual system di industri dan di perguruan tinggi dan melakukan peninjauan ulang minimal satu kali dalam empat tahun', '1', 'Tersedianya Kebijakan Pengembangan Kurikulum   yang mempertimbangkan penyediaan sumber daya manusia terampil, perkembangan industri, pengembangan kemampuan lulusan untuk berwirausaha dan penerapan metode pembelajaran dual system di industri dan di perguruan tinggi', 'a', '-', '0', 1, '2022-01-13 13:31:54'),
(770, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR ISI PEMBELAJARAN', 'STD-01.02/SPMI', 'Direktur  harus menetapkan kebijakan Pengembangan Kurikulum  yang mempertimbangkan penyediaan sumber daya manusia terampil, perkembangan industri, pengembangan kemampuan lulusan untuk berwirausaha dan penerapan metode pembelajaran dual system di industri dan di perguruan tinggi dan melakukan peninjauan ulang minimal satu kali dalam empat tahun', '1', 'Tersedianya Kebijakan Pengembangan Kurikulum   yang mempertimbangkan penyediaan sumber daya manusia terampil, perkembangan industri, pengembangan kemampuan lulusan untuk berwirausaha dan penerapan metode pembelajaran dual system di industri dan di perguruan tinggi', 'a', 'Dokumen', 'Kebijakan pengembangan kurikulum  Politeknik Negeri Medan', 1, '2022-01-13 13:32:11'),
(771, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR ISI PEMBELAJARAN', 'STD-01.02/SPMI', 'Wakil Direktur I harus menetapkan Pedoman  Pengembangan Kurikulum yang mengacu pada SN DIikti dan dilakukan peninjauan ulang minimal satu kali dalam 4 tahun', '2', '0', '0', '0', '0', 1, '2022-01-13 13:32:57'),
(772, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR ISI PEMBELAJARAN', 'STD-01.02/SPMI', 'Wakil Direktur I harus menetapkan Pedoman  Pengembangan Kurikulum yang mengacu pada SN DIikti dan dilakukan peninjauan ulang minimal satu kali dalam 4 tahun', '2', 'Tersedianya pedoman  Penyusunan dan Pengembangan Kurikulum yang mengacu pada SN Dikti ', 'a', '-', '0', 1, '2022-01-13 13:33:35'),
(773, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR ISI PEMBELAJARAN', 'STD-01.02/SPMI', 'Wakil Direktur I harus menetapkan Pedoman  Pengembangan Kurikulum yang mengacu pada SN DIikti dan dilakukan peninjauan ulang minimal satu kali dalam 4 tahun', '2', 'Tersedianya pedoman  Penyusunan dan Pengembangan Kurikulum yang mengacu pada SN Dikti ', 'a', 'Dokumen', 'Pedoman Penyusunan dan Pengembangan kurikulum dan peninjauan ulang', 1, '2022-01-13 13:33:58'),
(774, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR ISI PEMBELAJARAN', 'STD-01.02/SPMI', 'Wakil Direktur I harus menetapkan Pedoman  Penyusunan dan Pengembangan Kurikulum yang mengacu pada SN DIikti dan dilakukan peninjauan ulang minimal 4 tahun sekali.', '3', '0', '0', '0', '0', 1, '2022-01-13 13:35:01'),
(776, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR ISI PEMBELAJARAN', 'STD-01.02/SPMI', 'Wakil Direktur I harus menetapkan Pedoman  Penyusunan dan Pengembangan Kurikulum yang mengacu pada SN DIikti dan dilakukan peninjauan ulang minimal 4 tahun sekali.', '3', 'Dokumen kurikulum \n1) Profil lulusan\n2) Penetapan kemampuan lulusan \n3) Pedoman Perumusan Capaian Pembelajaran Lulusan (CPL) \n4) Pembentukan mata kuliah: pemilihan bahan kajian, mata kuliah dan bobot sks\n5) Mata kuliah dan struktur kurikulum\n6) Capaian Pembelajaran Mata Kuliah (CPMK)\n7) Rencana Capaian Pembelajaran\n8) Penilaian: prinsip, teknik,instrumen, mekanisme, prosedur, pelaksanaan, pelaporan penilaian dan kelulusan mahasiswa \n9) Bentuk, metode pembelajaran \n10) Surat Tugas Tim\n11) Barchart \n12) Kuesioner  untuk Alumni dan takeholder\n13) Berita acara \n14) Validasi kurikulum ', 'a', '-', '0', 1, '2022-01-13 13:42:05'),
(777, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR ISI PEMBELAJARAN', 'STD-01.02/SPMI', 'Wakil Direktur I harus menetapkan Pedoman  Penyusunan dan Pengembangan Kurikulum yang mengacu pada SN DIikti dan dilakukan peninjauan ulang minimal 4 tahun sekali.', '3', 'Dokumen kurikulum \n1) Profil lulusan\n2) Penetapan kemampuan lulusan \n3) Pedoman Perumusan Capaian Pembelajaran Lulusan (CPL) \n4) Pembentukan mata kuliah: pemilihan bahan kajian, mata kuliah dan bobot sks\n5) Mata kuliah dan struktur kurikulum\n6) Capaian Pembelajaran Mata Kuliah (CPMK)\n7) Rencana Capaian Pembelajaran\n8) Penilaian: prinsip, teknik,instrumen, mekanisme, prosedur, pelaksanaan, pelaporan penilaian dan kelulusan mahasiswa \n9) Bentuk, metode pembelajaran \n10) Surat Tugas Tim\n11) Barchart \n12) Kuesioner  untuk Alumni dan takeholder\n13) Berita acara \n14) Validasi kurikulum ', 'a', 'Dokumen', 'Kurikulum, Profil lulusan, Penetapan kemampuan  lulusan, Capaian Pembelajaran Lulusan, Pembentukan mata kuliah: Mata kuliah dalam struktur kurikulum, Rumusan CPMK, Rencana Pembelajaran Semester, Penilaian pembelajaran, Bentuk, metode pembelajaran,   Surat Tugas Tim, Barchart,  Kuesioner Alumni dan Stakeholder, Berita acara,  Validasi kurikulum.', 1, '2022-01-13 13:52:28'),
(778, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR ISI PEMBELAJARAN', 'STD-01.02/SPMI', 'Ketua Jurusan/Kepala Program Studi berkoordinasi dengan P3AI harus melakukan evaluasi dan pemutakahiran kurikulum secara berkala minimal satu kali dalam 4 tahun dengan melibatkan pemangku kepentingan internal dan eksternal serta direview oleh pakar bidang ilmu program studi, industri, asosiasi dan sesuai dengan perkembangan ilmu pengetahuan dan teknologi serta kebutuhan pengguna', '4', '0', '0', '0', '0', 1, '2022-01-13 13:53:04'),
(779, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR ISI PEMBELAJARAN', 'STD-01.02/SPMI', 'Ketua Jurusan/Kepala Program Studi berkoordinasi dengan P3AI harus melakukan evaluasi dan pemutakahiran kurikulum secara berkala minimal satu kali dalam 4 tahun dengan melibatkan pemangku kepentingan internal dan eksternal serta direview oleh pakar bidang ilmu program studi, industri, asosiasi dan sesuai dengan perkembangan ilmu pengetahuan dan teknologi serta kebutuhan pengguna', '4', 'Tersedianya bukti sahih terkait evaluasi dan pemutakhiran kurikulum yang melibatkan pemangku kepentingan, pakar bidang ilmu program studim industrim asosiasi dan pengguna', 'a', '-', '0', 1, '2022-01-13 13:53:32'),
(780, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR ISI PEMBELAJARAN', 'STD-01.02/SPMI', 'Ketua Jurusan/Kepala Program Studi berkoordinasi dengan P3AI harus melakukan evaluasi dan pemutakahiran kurikulum secara berkala minimal satu kali dalam 4 tahun dengan melibatkan pemangku kepentingan internal dan eksternal serta direview oleh pakar bidang ilmu program studi, industri, asosiasi dan sesuai dengan perkembangan ilmu pengetahuan dan teknologi serta kebutuhan pengguna', '4', 'Tersedianya bukti sahih terkait evaluasi dan pemutakhiran kurikulum yang melibatkan pemangku kepentingan, pakar bidang ilmu program studim industrim asosiasi dan pengguna', 'a', 'Dokumen', 'Laporan evaluasi dan pemutakhiran kurikulum yang melibatkan pemangku kepentingan, pakar bidang ilmu program studim industrim asosiasi dan pengguna', 1, '2022-01-13 13:53:53'),
(781, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR ISI PEMBELAJARAN', 'STD-01.02/SPMI', 'Ketua Jurusan/Kepala Program Studi berkoordinasi dengan P3AI harus memastikan kesesuaian capaian pembelajaran dengan profil lulusan dan jenjang KKNI/SKKNI serta dimutakhirkan secara berkala setiap 4 sampai dengan 5 tahun sesuai perkembangan ilmu penegtahuan dan teknologi serta kebutuhan pengguna', '5', '0', '0', '0', '0', 1, '2022-01-13 13:54:20'),
(782, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR ISI PEMBELAJARAN', 'STD-01.02/SPMI', 'Ketua Jurusan/Kepala Program Studi berkoordinasi dengan P3AI harus memastikan kesesuaian capaian pembelajaran dengan profil lulusan dan jenjang KKNI/SKKNI serta dimutakhirkan secara berkala setiap 4 sampai dengan 5 tahun sesuai perkembangan ilmu penegtahuan dan teknologi serta kebutuhan pengguna', '5', 'Tersedianya bukti sahih terkait kesesuaian capaian pembelajaran dengan profil lulusan dan\njenjang KKNI/SKKNI serta dimutakhirkan secara berkala setiap 4 sampai dengan 5 tahun sesuai perkembangan ilmu penegtahuan dan teknologi serta kebutuhan pengguna\n', 'a', '-', '0', 1, '2022-01-13 13:54:58'),
(783, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR ISI PEMBELAJARAN', 'STD-01.02/SPMI', 'Ketua Jurusan/Kepala Program Studi berkoordinasi dengan P3AI harus memastikan kesesuaian capaian pembelajaran dengan profil lulusan dan jenjang KKNI/SKKNI serta dimutakhirkan secara berkala setiap 4 sampai dengan 5 tahun sesuai perkembangan ilmu penegtahuan dan teknologi serta kebutuhan pengguna', '5', 'Tersedianya bukti sahih terkait kesesuaian capaian pembelajaran dengan profil lulusan dan\njenjang KKNI/SKKNI serta dimutakhirkan secara berkala setiap 4 sampai dengan 5 tahun sesuai perkembangan ilmu penegtahuan dan teknologi serta kebutuhan pengguna\n', 'a', 'Dokumen', 'Laporan kesesuaian capaian pembelajaran dengan profil lulusan dan jenjang KKNI/ SKKNI serta dimutakhirkan secara berkala setiap 4 sampai dengan 5 tahun sesuai perkembangan ilmu penegtahuan dan teknologi serta kebutuhan pengguna', 1, '2022-01-13 13:56:43'),
(784, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR ISI PEMBELAJARAN', 'STD-01.02/SPMI', 'Ketua Jurusan/Kepala Program Studi berkoordinasi dengan P3AI harus memastikan ketepatan struktur kurikulum dalam\npembentukan capaian\npembelajaran dan dimutkhirkan secara berkala setiap 4 sampai dengan 5 tahun sesuai perkembangan ilmu pengetahuan dan teknologi serta kebutuhan pengguna', '6', '0', '0', '0', '0', 1, '2022-01-13 13:57:26'),
(785, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR ISI PEMBELAJARAN', 'STD-01.02/SPMI', 'Ketua Jurusan/Kepala Program Studi berkoordinasi dengan P3AI harus memastikan ketepatan struktur kurikulum dalam\npembentukan capaian\npembelajaran dan dimutkhirkan secara berkala setiap 4 sampai dengan 5 tahun sesuai perkembangan ilmu pengetahuan dan teknologi serta kebutuhan pengguna', '6', 'Tersedianya bukti sahih terkait ketepatan struktur kurikulum dalam pembentukan capaian pembelajaran ', 'a', '-', '0', 1, '2022-01-13 13:58:00'),
(786, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR ISI PEMBELAJARAN', 'STD-01.02/SPMI', 'Ketua Jurusan/Kepala Program Studi berkoordinasi dengan P3AI harus memastikan ketepatan struktur kurikulum dalam\npembentukan capaian\npembelajaran dan dimutkhirkan secara berkala setiap 4 sampai dengan 5 tahun sesuai perkembangan ilmu pengetahuan dan teknologi serta kebutuhan pengguna', '6', 'Tersedianya bukti sahih terkait ketepatan struktur kurikulum dalam pembentukan capaian pembelajaran ', 'a', 'Dokumen', 'Laporan hasil ketepatan struktur kurikulum dalam pembentukan capaian pembelajaran ', 1, '2022-01-13 13:58:26'),
(787, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR ISI PEMBELAJARAN', 'STD-01.02/SPMI', 'Ketua Jurusan/Kepala Program Studi berkoordinasi dengan P3AI harus memastikan ketepatan struktur kurikulum dalam\npembentukan capaian\npembelajaran dan dimutkhirkan secara berkala setiap 4 sampai dengan 5 tahun sesuai perkembangan ilmu pengetahuan dan teknologi serta kebutuhan pengguna', '6', 'Tersedianya bukti sahih terkait pemutakhiran kurikulum secara berkala setiap  4 sampai dengan 5 tahun', 'b', '-', '0', 1, '2022-01-13 13:58:52'),
(788, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR ISI PEMBELAJARAN', 'STD-01.02/SPMI', 'Ketua Jurusan/Kepala Program Studi berkoordinasi dengan P3AI harus memastikan ketepatan struktur kurikulum dalam\npembentukan capaian\npembelajaran dan dimutkhirkan secara berkala setiap 4 sampai dengan 5 tahun sesuai perkembangan ilmu pengetahuan dan teknologi serta kebutuhan pengguna', '6', 'Tersedianya bukti sahih terkait pemutakhiran kurikulum secara berkala setiap  4 sampai dengan 5 tahun', 'b', 'Dokumen', 'Laporan hasil pemutakhiran kurikulum secara berkala setiap  4 sampai dengan 5 tahun', 1, '2022-01-13 13:59:14'),
(789, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR ISI PEMBELAJARAN', 'STD-01.02/SPMI', 'Ketua Jurusan/Kepala Program Studi harus menyusun pedoman perumusan tingkat kedalaman dan keluasan materi pembelajaran  untuk program studi yang berada dalam pengelolaannya yang mengacui pada deskripsi capaian Pembelajaran lulusan dari KKNI dan dilakukan peninjauan ulang minimal 4 tahun sekali', '7', '0', '0', '0', '0', 1, '2022-01-13 13:59:42'),
(790, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR ISI PEMBELAJARAN', 'STD-01.02/SPMI', 'Ketua Jurusan/Kepala Program Studi harus menyusun pedoman perumusan tingkat kedalaman dan keluasan materi pembelajaran  untuk program studi yang berada dalam pengelolaannya yang mengacui pada deskripsi capaian Pembelajaran lulusan dari KKNI dan dilakukan peninjauan ulang minimal 4 tahun sekali', '7', 'Tersedianya pedoman perumusan tingkat kedalaman dan keluasan materi pembelajaran  untuk program studi yang berada dalam pengelolaannya yang mengacui pada deskripsi capaian Pembelajaran lulusan dari KKNI ', 'a', '-', '0', 1, '2022-01-13 14:02:41'),
(791, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR ISI PEMBELAJARAN', 'STD-01.02/SPMI', 'Ketua Jurusan/Kepala Program Studi harus menyusun pedoman perumusan tingkat kedalaman dan keluasan materi pembelajaran  untuk program studi yang berada dalam pengelolaannya yang mengacui pada deskripsi capaian Pembelajaran lulusan dari KKNI dan dilakukan peninjauan ulang minimal 4 tahun sekali', '7', 'Tersedianya pedoman perumusan tingkat kedalaman dan keluasan materi pembelajaran  untuk program studi yang berada dalam pengelolaannya yang mengacui pada deskripsi capaian Pembelajaran lulusan dari KKNI ', 'a', 'Dokumen', 'Pedoman perumusan tingkat kedalaman dan keluasan materi pembelajaran', 1, '2022-01-13 14:03:06'),
(792, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR ISI PEMBELAJARAN', 'STD-01.02/SPMI', 'Ketua Jurusan/Kepala Program Studi harus memastikan Lulusan program diploma tiga paling sedikit menguasai konsep teoritis  bidang pengetahuan secara umum 40%  dan keterampilan tertentu secara umum 60% dan dilakukan peninjauan minimal 1 kali dalam 2 tahun', '8', '0', '0', '0', '0', 1, '2022-01-13 14:03:44'),
(793, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR ISI PEMBELAJARAN', 'STD-01.02/SPMI', 'Ketua Jurusan/Kepala Program Studi harus memastikan Lulusan program diploma tiga paling sedikit menguasai konsep teoritis  bidang pengetahuan secara umum 40%  dan keterampilan tertentu secara umum 60% dan dilakukan peninjauan minimal 1 kali dalam 2 tahun', '8', 'Tersedianya bukti sahih terkait Lulusan program diploma tiga paling sedikit menguasai konsep teoritis  bidang pengetahuan secara umum 40%  dan keterampilan tertentu secara umum 60%', 'a', '-', '0', 1, '2022-01-13 14:04:13'),
(794, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR ISI PEMBELAJARAN', 'STD-01.02/SPMI', 'Ketua Jurusan/Kepala Program Studi harus memastikan Lulusan program diploma tiga paling sedikit menguasai konsep teoritis  bidang pengetahuan secara umum 40%  dan keterampilan tertentu secara umum 60% dan dilakukan peninjauan minimal 1 kali dalam 2 tahun', '8', 'Tersedianya bukti sahih terkait Lulusan program diploma tiga paling sedikit menguasai konsep teoritis  bidang pengetahuan secara umum 40%  dan keterampilan tertentu secara umum 60%', 'a', 'Dokumen', 'Struktur bahan kajian dan matakuliah yang menunjukkan persentase antara bidang pengetahuan dan keterampilan (40% dan 60%)', 1, '2022-01-13 14:04:39'),
(795, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR ISI PEMBELAJARAN', 'STD-01.02/SPMI', 'Ketua Jurusan/Kepala Program Studi harus memastikan Lulusan program diploma tiga paling sedikit menguasai konsep teoritis  bidang pengetahuan secara umum 40%  dan keterampilan tertentu secara umum 60% dan dilakukan peninjauan minimal 1 kali dalam 2 tahun', '8', 'Terlaksananya peninjauan ulang struktur bahan kajian dan matakuliah', 'b', '-', '0', 1, '2022-01-13 14:05:03'),
(796, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR ISI PEMBELAJARAN', 'STD-01.02/SPMI', 'Ketua Jurusan/Kepala Program Studi harus memastikan Lulusan program diploma tiga paling sedikit menguasai konsep teoritis  bidang pengetahuan secara umum 40%  dan keterampilan tertentu secara umum 60% dan dilakukan peninjauan minimal 1 kali dalam 2 tahun', '8', 'Terlaksananya peninjauan ulang struktur bahan kajian dan matakuliah', 'b', 'Dokumen', 'Laporan peninjauan ulang dan verifikasi struktur bahan kajian dan matakuliah', 1, '2022-01-13 14:05:28'),
(797, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR ISI PEMBELAJARAN', 'STD-01.02/SPMI', 'Wakil Direktur I harus menetapkan Pedoman pelaksanaan kurikulum yang mencakup pemantauan dan peninjauan kurikulum yang mempertimbangkan umpan balik dari para pemangku kepentingan, pencapaian isu-isu strategis untuk menjamin kesesuaian dan kemutakhirannya dan dilakukan peninjauan ulang minimal 1 kali dalam 4 tahun', '9', '0', '0', '0', '0', 1, '2022-01-13 14:06:48'),
(798, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR ISI PEMBELAJARAN', 'STD-01.02/SPMI', 'Wakil Direktur I harus menetapkan Pedoman pelaksanaan kurikulum yang mencakup pemantauan dan peninjauan kurikulum yang mempertimbangkan umpan balik dari para pemangku kepentingan, pencapaian isu-isu strategis untuk menjamin kesesuaian dan kemutakhirannya dan dilakukan peninjauan ulang minimal 1 kali dalam 4 tahun', '9', 'Tersedianya pedoman pelaksanaan kurikulum yang mencakup pemantauan dan peninjauan kurikulum,  umpan balik dari para pemangku kepentingan, pencapaian isu-isu strategis untuk menjamin kesesuaian dan kemutakhirannya', 'a', '-', '0', 1, '2022-01-13 14:07:18'),
(799, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR ISI PEMBELAJARAN', 'STD-01.02/SPMI', 'Wakil Direktur I harus menetapkan Pedoman pelaksanaan kurikulum yang mencakup pemantauan dan peninjauan kurikulum yang mempertimbangkan umpan balik dari para pemangku kepentingan, pencapaian isu-isu strategis untuk menjamin kesesuaian dan kemutakhirannya dan dilakukan peninjauan ulang minimal 1 kali dalam 4 tahun', '9', 'Tersedianya pedoman pelaksanaan kurikulum yang mencakup pemantauan dan peninjauan kurikulum,  umpan balik dari para pemangku kepentingan, pencapaian isu-isu strategis untuk menjamin kesesuaian dan kemutakhirannya', 'a', 'Dokumen', 'Pedoman Pelaksanaan kurikulum yang mencakup: 1) pemantauan dan peninjauan kurikulum; 2) umpan balik dari stakeholder; 3) isu-isu strategis', 1, '2022-01-13 14:07:39'),
(800, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR ISI PEMBELAJARAN', 'STD-01.02/SPMI', 'Wakil Direktur I harus menetapkan Pedoman pelaksanaan kurikulum yang mencakup pemantauan dan peninjauan kurikulum yang mempertimbangkan umpan balik dari para pemangku kepentingan, pencapaian isu-isu strategis untuk menjamin kesesuaian dan kemutakhirannya dan dilakukan peninjauan ulang minimal 1 kali dalam 4 tahun', '9', 'Terlaksananya peninjauan ulang Pedoman pelaksanaan kurikulum ', 'b', '-', '0', 1, '2022-01-13 14:08:12'),
(801, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR ISI PEMBELAJARAN', 'STD-01.02/SPMI', 'Wakil Direktur I harus menetapkan Pedoman pelaksanaan kurikulum yang mencakup pemantauan dan peninjauan kurikulum yang mempertimbangkan umpan balik dari para pemangku kepentingan, pencapaian isu-isu strategis untuk menjamin kesesuaian dan kemutakhirannya dan dilakukan peninjauan ulang minimal 1 kali dalam 4 tahun', '9', 'Terlaksananya peninjauan ulang Pedoman pelaksanaan kurikulum ', 'b', 'Dokumen', 'Laporan peninjauan ulang dan verifikasi', 1, '2022-01-13 14:08:51'),
(802, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR ISI PEMBELAJARAN', 'STD-01.02/SPMI', 'Wakil Direktur I harus menetapkan Pedoman pelaksanaan kurikulum yang mencakup pemantauan dan peninjauan kurikulum yang mempertimbangkan umpan balik dari para pemangku kepentingan, pencapaian isu-isu strategis untuk menjamin kesesuaian dan kemutakhirannya dan dilakukan peninjauan ulang minimal 1 kali dalam 4 tahun', '9', 'Terlaksananya peninjauan ulang Pedoman pelaksanaan kurikulum ', 'b', 'Dokumen', 'Laporan peninjauan ulang dan verifikasi.', 1, '2022-01-13 14:09:09'),
(803, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR ISI PEMBELAJARAN', 'STD-01.02/SPMI', 'Wakil Direktur I harus memastikan capaian Pembelajaran lulusan diraih melalui proses pembelajaran yang mengutamakan pengembangan kreativitas, kapasitas, kepribadian, dan kebutuhan mahasiswa, serta mengembangkan kemandirian dalam mencari dan menemukan pengetahuan mengacu pada SN Dikti ', '10', '0', '0', '0', '0', 1, '2022-01-13 14:09:34'),
(804, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR ISI PEMBELAJARAN', 'STD-01.02/SPMI', 'Wakil Direktur I harus memastikan capaian Pembelajaran lulusan diraih melalui proses pembelajaran yang mengutamakan pengembangan kreativitas, kapasitas, kepribadian, dan kebutuhan mahasiswa, serta mengembangkan kemandirian dalam mencari dan menemukan pengetahuan mengacu pada SN Dikti ', '10', 'Tersedianya  bukti capaian Pembelajaran lulusan diraih melalui proses pembelajaran yang mengutamakan pengembangan kreativitas, kapasitas, kepribadian, dan kebutuhan mahasiswa, serta mengembangkan kemandirian dalam mencari dan menemukan pengetahuan  ', 'a', '-', '0', 1, '2022-01-13 14:10:00'),
(805, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR ISI PEMBELAJARAN', 'STD-01.02/SPMI', 'Wakil Direktur I harus memastikan capaian Pembelajaran lulusan diraih melalui proses pembelajaran yang mengutamakan pengembangan kreativitas, kapasitas, kepribadian, dan kebutuhan mahasiswa, serta mengembangkan kemandirian dalam mencari dan menemukan pengetahuan mengacu pada SN Dikti ', '10', 'Tersedianya  bukti capaian Pembelajaran lulusan diraih melalui proses pembelajaran yang mengutamakan pengembangan kreativitas, kapasitas, kepribadian, dan kebutuhan mahasiswa, serta mengembangkan kemandirian dalam mencari dan menemukan pengetahuan  ', 'a', 'Dokumen', 'Laporan hasil capaian Pembelajaran lulusan ', 1, '2022-01-13 14:10:15'),
(806, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR ISI PEMBELAJARAN', 'STD-01.02/SPMI', 'Ketua Jurusan/Kepala Program Studi harus melaksanakan proses pengendalian isi pembelajaran minimal 1 kali per tahun dengan cara memeriksa dan mempelajari catatan hasil evaluasi yang telah dilakukan pada tahap sebelumnya', '11', '0', '0', '0', '0', 1, '2022-01-13 14:10:42'),
(807, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR ISI PEMBELAJARAN', 'STD-01.02/SPMI', 'Ketua Jurusan/Kepala Program Studi harus melaksanakan proses pengendalian isi pembelajaran minimal 1 kali per tahun dengan cara memeriksa dan mempelajari catatan hasil evaluasi yang telah dilakukan pada tahap sebelumnya', '11', 'Tersedianya bukti pelaksanaan monitoring dan evaluasi di tingkat jurusan yang dilaksanakan oleh GKMI jurusan', 'a', '-', '0', 1, '2022-01-13 14:11:06'),
(808, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR ISI PEMBELAJARAN', 'STD-01.02/SPMI', 'Ketua Jurusan/Kepala Program Studi harus melaksanakan proses pengendalian isi pembelajaran minimal 1 kali per tahun dengan cara memeriksa dan mempelajari catatan hasil evaluasi yang telah dilakukan pada tahap sebelumnya', '11', 'Tersedianya bukti pelaksanaan monitoring dan evaluasi di tingkat jurusan yang dilaksanakan oleh GKMI jurusan', 'a', 'Dokumen', 'Pelaksanaan monitoring dan evaluasi di tingkat jurusan yang dilaksanakan oleh GKMI-J', 1, '2022-01-13 14:11:26'),
(809, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR ISI PEMBELAJARAN', 'STD-01.02/SPMI', 'Ketua Jurusan/Kepala Program Studi harus melaksanakan proses pengendalian isi pembelajaran minimal 1 kali per tahun dengan cara memeriksa dan mempelajari catatan hasil evaluasi yang telah dilakukan pada tahap sebelumnya', '11', 'Tersedianya bukti laporan hasil pelaksanaan monitoring dan evaluasi oleh GKMI Jurusan', 'b', '-', '0', 1, '2022-01-13 14:12:02'),
(810, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR ISI PEMBELAJARAN', 'STD-01.02/SPMI', 'Ketua Jurusan/Kepala Program Studi harus melaksanakan proses pengendalian isi pembelajaran minimal 1 kali per tahun dengan cara memeriksa dan mempelajari catatan hasil evaluasi yang telah dilakukan pada tahap sebelumnya', '11', 'Tersedianya bukti laporan hasil pelaksanaan monitoring dan evaluasi oleh GKMI Jurusan', 'b', 'Dokumen', 'Laporan hasil pelaksanaan evaluasi oleh GKMI-J', 1, '2022-01-13 14:12:21'),
(811, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR ISI PEMBELAJARAN', 'STD-01.02/SPMI', 'Ketua Jurusan/Kepala Program Studi harus melaksanakan proses pengendalian isi pembelajaran minimal 1 kali per tahun dengan cara memeriksa dan mempelajari catatan hasil evaluasi yang telah dilakukan pada tahap sebelumnya', '11', 'Tersedianya bukti pelaksanaan RTM di tingkat jurusan', 'c', '-', '0', 1, '2022-01-13 14:12:53'),
(812, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR ISI PEMBELAJARAN', 'STD-01.02/SPMI', 'Ketua Jurusan/Kepala Program Studi harus melaksanakan proses pengendalian isi pembelajaran minimal 1 kali per tahun dengan cara memeriksa dan mempelajari catatan hasil evaluasi yang telah dilakukan pada tahap sebelumnya', '11', 'Tersedianya bukti pelaksanaan RTM di tingkat jurusan', 'c', 'Dokumen', 'Pelaksanaan Rapat Tinjauan Manajemen (RTM) di tingkat jurusan', 1, '2022-01-13 14:13:18'),
(813, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR ISI PEMBELAJARAN', 'STD-01.02/SPMI', 'Ketua Jurusan/Kepala Program Studi harus melaksanakan proses pengendalian isi pembelajaran minimal 1 kali per tahun dengan cara memeriksa dan mempelajari catatan hasil evaluasi yang telah dilakukan pada tahap sebelumnya', '11', 'Tersedianya bukti pengendalian dan tindak lanjut hasil RTM', 'd', '-', '0', 1, '2022-01-13 14:13:50'),
(814, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR ISI PEMBELAJARAN', 'STD-01.02/SPMI', 'Ketua Jurusan/Kepala Program Studi harus melaksanakan proses pengendalian isi pembelajaran minimal 1 kali per tahun dengan cara memeriksa dan mempelajari catatan hasil evaluasi yang telah dilakukan pada tahap sebelumnya', '11', 'Tersedianya bukti pengendalian dan tindak lanjut hasil RTM', 'd', 'Dokumen', 'Pengendalian dan tndaklanjut hasil RTM', 1, '2022-01-13 14:14:35'),
(815, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR ISI PEMBELAJARAN', 'STD-01.02/SPMI', 'SPMI harus  melaksanakan monitoring, evaluasi, pengendalian dan peningkatan terhadap isi pembelajaran dari semua program studi di Politeknik Negeri Medan  di setiap akhir tahun akademik', '12', '0', '0', '0', '0', 1, '2022-01-13 14:15:56'),
(816, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR ISI PEMBELAJARAN', 'STD-01.02/SPMI', 'SPMI harus  melaksanakan monitoring, evaluasi, pengendalian dan peningkatan terhadap isi pembelajaran dari semua program studi di Politeknik Negeri Medan  di setiap akhir tahun akademik', '12', 'Tersedianya  lingkup Audit Mutu Internal (AMI)', 'a', '-', '0', 1, '2022-01-13 14:16:31'),
(817, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR ISI PEMBELAJARAN', 'STD-01.02/SPMI', 'SPMI harus  melaksanakan monitoring, evaluasi, pengendalian dan peningkatan terhadap isi pembelajaran dari semua program studi di Politeknik Negeri Medan  di setiap akhir tahun akademik', '12', 'Tersedianya  lingkup Audit Mutu Internal (AMI)', 'a', 'Dokumen', 'Lingkup AMI', 1, '2022-01-13 14:16:48'),
(818, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR ISI PEMBELAJARAN', 'STD-01.02/SPMI', 'SPMI harus  melaksanakan monitoring, evaluasi, pengendalian dan peningkatan terhadap isi pembelajaran dari semua program studi di Politeknik Negeri Medan  di setiap akhir tahun akademik', '12', 'Tersedianya jadwal pelaksanaan AMI', 'b', '-', '0', 1, '2022-01-13 14:17:40'),
(819, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR ISI PEMBELAJARAN', 'STD-01.02/SPMI', 'SPMI harus  melaksanakan monitoring, evaluasi, pengendalian dan peningkatan terhadap isi pembelajaran dari semua program studi di Politeknik Negeri Medan  di setiap akhir tahun akademik', '12', 'Tersedianya jadwal pelaksanaan AMI', 'b', 'Dokumen', 'Jadwal pelaksanaan AMI', 1, '2022-01-13 14:17:56'),
(820, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR ISI PEMBELAJARAN', 'STD-01.02/SPMI', 'SPMI harus  melaksanakan monitoring, evaluasi, pengendalian dan peningkatan terhadap isi pembelajaran dari semua program studi di Politeknik Negeri Medan  di setiap akhir tahun akademik', '12', 'Tersedianya penugasan (SK) Auditor AMI', 'c', '-', '0', 1, '2022-01-13 14:18:22'),
(821, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Direktur melakukan kegiatan pemantauan/evaluasi mutu lulusan secara rutin minimal 1 kali per tahun dengan melibatkan SPMI, AMI, dan GKMIJ. ', '49', 'Tersedianya penugasan (SK) Auditor AMI', 'c', 'Dokumen', 'SK Auditor AMI.', 1, '2022-01-13 14:18:47'),
(822, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR ISI PEMBELAJARAN', 'STD-01.02/SPMI', 'SPMI harus  melaksanakan monitoring, evaluasi, pengendalian dan peningkatan terhadap isi pembelajaran dari semua program studi di Politeknik Negeri Medan  di setiap akhir tahun akademik', '12', 'Tersedianya bukti sahih pelaksanaan Audit Mutu Internal', 'd', '-', '0', 1, '2022-01-13 14:19:15'),
(823, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR ISI PEMBELAJARAN', 'STD-01.02/SPMI', 'SPMI harus  melaksanakan monitoring, evaluasi, pengendalian dan peningkatan terhadap isi pembelajaran dari semua program studi di Politeknik Negeri Medan  di setiap akhir tahun akademik', '12', 'Tersedianya bukti sahih pelaksanaan Audit Mutu Internal', 'd', 'Dokumen', 'Laporan Audit ', 1, '2022-01-13 14:20:01'),
(824, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR ISI PEMBELAJARAN', 'STD-01.02/SPMI', 'SPMI harus  melaksanakan monitoring, evaluasi, pengendalian dan peningkatan terhadap isi pembelajaran dari semua program studi di Politeknik Negeri Medan  di setiap akhir tahun akademik', '12', 'Terlaksananya Rapat Tinjauan Manajemen (RTM)', 'e', '-', '0', 1, '2022-01-13 14:21:13'),
(825, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Direktur melakukan kegiatan pemantauan/evaluasi mutu lulusan secara rutin minimal 1 kali per tahun dengan melibatkan SPMI, AMI, dan GKMIJ. ', '49', 'Terlaksananya Rapat Tinjauan Manajemen (RTM)', 'e', 'Dokumen', 'Jadwal pelaksanaan RTM dan dokumentasi.', 1, '2022-01-13 14:21:46'),
(826, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR ISI PEMBELAJARAN', 'STD-01.02/SPMI', 'SPMI harus  melaksanakan monitoring, evaluasi, pengendalian dan peningkatan terhadap isi pembelajaran dari semua program studi di Politeknik Negeri Medan  di setiap akhir tahun akademik', '12', 'Tersedianya Hasil RTM (peningkatan efektivitas SPMI dan prosesnya)', 'f', '-', '0', 1, '2022-01-13 14:22:38'),
(827, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Direktur melakukan kegiatan pemantauan/evaluasi mutu lulusan secara rutin minimal 1 kali per tahun dengan melibatkan SPMI, AMI, dan GKMIJ. ', '49', 'Tersedianya Hasil RTM (peningkatan efektivitas SPMI dan prosesnya)', 'f', 'Dokumen', 'Hasil RTM (Peningkatan efektivitas SPMI dan prosesnya).', 1, '2022-01-13 14:23:04'),
(828, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR ISI PEMBELAJARAN', 'STD-01.02/SPMI', 'SPMI harus  melaksanakan monitoring, evaluasi, pengendalian dan peningkatan terhadap isi pembelajaran dari semua program studi di Politeknik Negeri Medan  di setiap akhir tahun akademik', '12', 'Terlaksananya perbaikan mutu secara berkelanjutan (Continuous Quality Improvement/CQI)', 'g', '-', '0', 1, '2022-01-13 14:23:37'),
(829, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Direktur melakukan kegiatan pemantauan/evaluasi mutu lulusan secara rutin minimal 1 kali per tahun dengan melibatkan SPMI, AMI, dan GKMIJ. ', '49', 'Terlaksananya perbaikan mutu secara berkelanjutan (Continuous Quality Improvement/CQI)', 'g', 'Dokumen', 'CQI/Kaizen.', 1, '2022-01-13 14:24:16'),
(830, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', '0', '0', '0', '0', '0', '0', 1, '2022-01-13 14:25:03'),
(831, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'P3AI dan SPMI harus berkoordinasi dengan Wakil Direktur I untuk menyediakan pedoman tertulis tentang perumusan karakteristik proses pembelajaran yang mengacu pada Standar Nasional Pendidikan Tinggi dan dilakukan peninjauan pada setiap awal tahun akademik.', '1', '0', '0', '0', '0', 1, '2022-01-13 14:26:37'),
(832, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'P3AI dan SPMI harus berkoordinasi dengan Wakil Direktur I untuk menyediakan pedoman tertulis tentang perumusan karakteristik proses pembelajaran yang mengacu pada Standar Nasional Pendidikan Tinggi dan dilakukan peninjauan pada setiap awal tahun akademik.', '1', 'Tersedianya  pedoman tertulis tentang perumusan karakteristik proses pembelajaran untuk setiap program studi yang  mengacu pada SN Dikti ', 'a', '-', '0', 1, '2022-01-13 14:27:01'),
(833, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'P3AI dan SPMI harus berkoordinasi dengan Wakil Direktur I untuk menyediakan pedoman tertulis tentang perumusan karakteristik proses pembelajaran yang mengacu pada Standar Nasional Pendidikan Tinggi dan dilakukan peninjauan pada setiap awal tahun akademik.', '1', 'Tersedianya  pedoman tertulis tentang perumusan karakteristik proses pembelajaran untuk setiap program studi yang  mengacu pada SN Dikti ', 'a', 'Dokumen', 'Pedoman tertulis perumusan karakteristik pembelajaran sesuai SN Dikti', 1, '2022-01-13 14:27:18'),
(834, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'P3AI dan SPMI harus berkoordinasi dengan Wakil Direktur I untuk menyediakan pedoman tertulis tentang perumusan karakteristik proses pembelajaran yang mengacu pada Standar Nasional Pendidikan Tinggi dan dilakukan peninjauan pada setiap awal tahun akademik.', '1', 'Terlaksananya  peninjauan ulang terkait pedoman karakteristik proses pembelajaran ', 'b', '-', '0', 1, '2022-01-13 14:28:15'),
(835, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'P3AI dan SPMI harus berkoordinasi dengan Wakil Direktur I untuk menyediakan pedoman tertulis tentang perumusan karakteristik proses pembelajaran yang mengacu pada Standar Nasional Pendidikan Tinggi dan dilakukan peninjauan pada setiap awal tahun akademik.', '1', 'Terlaksananya  peninjauan ulang terkait pedoman karakteristik proses pembelajaran ', 'b', 'Dokumen', 'Peninjauan karakterisitk proses pembelajaran', 1, '2022-01-13 14:28:40'),
(836, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Direktur  harus memenuhi seluruh aspek penunjang yang diperlukan untuk mewujudkan karakteristik proses pembelajaran ideal pada semua program studi.', '2', '0', '0', '0', '0', 1, '2022-01-13 14:29:11'),
(837, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Direktur  harus memenuhi seluruh aspek penunjang yang diperlukan untuk mewujudkan karakteristik proses pembelajaran ideal pada semua program studi.', '2', 'Terpenuhinya aspek penunjang yang diperlukan untuk mewujudkan karakteristik proses pembelajaran ideal pada semua program studi, seperti : Lingkungan belajar yang kondusif, sumber belajar dan media pembelajaran.', 'a', '-', '0', 1, '2022-01-13 14:29:33'),
(838, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Direktur  harus memenuhi seluruh aspek penunjang yang diperlukan untuk mewujudkan karakteristik proses pembelajaran ideal pada semua program studi.', '2', 'Terpenuhinya aspek penunjang yang diperlukan untuk mewujudkan karakteristik proses pembelajaran ideal pada semua program studi, seperti : Lingkungan belajar yang kondusif, sumber belajar dan media pembelajaran.', 'a', 'Dokumen', 'Ceklist aspek penunjang karakteristik proses pembelajaran', 1, '2022-01-13 14:29:48'),
(839, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Dosen harus memenuhi karakteristik proses pembelajaran yang bersifat: interaktif, holistik, integratif, saintifik, kontekstual, tematik, efektif, kolaboratif, dan berpusat pada mahasiswa pada setiap mata kuliah yang diampunya', '3', '0', '0', '0', '0', 1, '2022-01-13 14:30:21'),
(840, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Dosen harus memenuhi karakteristik proses pembelajaran yang bersifat: interaktif, holistik, integratif, saintifik, kontekstual, tematik, efektif, kolaboratif, dan berpusat pada mahasiswa pada setiap mata kuliah yang diampunya', '3', 'Tersedianya bukti  Dosen memenuhi karakteristik proses pembelajaran yang bersifat: interaktif, holistik, integratif, saintifik, kontekstual, tematik, efektif, kolaboratif, dan berpusat pada mahasiswa pada setiap mata kuliah yang diampunya', 'a', '-', '0', 1, '2022-01-13 14:32:21'),
(841, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Dosen harus memenuhi karakteristik proses pembelajaran yang bersifat: interaktif, holistik, integratif, saintifik, kontekstual, tematik, efektif, kolaboratif, dan berpusat pada mahasiswa pada setiap mata kuliah yang diampunya', '3', 'Tersedianya bukti  Dosen memenuhi karakteristik proses pembelajaran yang bersifat: interaktif, holistik, integratif, saintifik, kontekstual, tematik, efektif, kolaboratif, dan berpusat pada mahasiswa pada setiap mata kuliah yang diampunya', 'a', 'Dokumen', 'Rencana Pembelajaran Semester (RPS)', 1, '2022-01-13 14:33:40'),
(842, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Dosen harus memenuhi karakteristik proses pembelajaran yang bersifat: interaktif, holistik, integratif, saintifik, kontekstual, tematik, efektif, kolaboratif, dan berpusat pada mahasiswa pada setiap mata kuliah yang diampunya', '3', 'Tersedianya RPS sesuai dengan jumlah mata kuilah pada semester berjalan dan telah divalidasi', 'b', '-', '0', 1, '2022-01-13 14:34:14'),
(843, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Dosen harus memenuhi karakteristik proses pembelajaran yang bersifat: interaktif, holistik, integratif, saintifik, kontekstual, tematik, efektif, kolaboratif, dan berpusat pada mahasiswa pada setiap mata kuliah yang diampunya', '3', 'Tersedianya RPS sesuai dengan jumlah mata kuilah pada semester berjalan dan telah divalidasi', 'b', 'Dokumen', 'Rekapitulasi RPS untuk semua matakuliah pada setiap program studi', 1, '2022-01-13 14:34:31'),
(849, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Wakil Direktur I Politeknik Negeri Medan harus melakukan monitoring dan evaluasi terhadap karakteristik proses pembelajaran secara regular pada semua program studi', '4', '0', '0', '0', '0', 1, '2022-01-13 14:45:58'),
(850, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Wakil Direktur I Politeknik Negeri Medan harus melakukan monitoring dan evaluasi terhadap karakteristik proses pembelajaran secara regular pada semua program studi', '4', 'Terlaksananya monitoring dan evaluasi terhadap karakteristik proses pembelajaran secara regular pada semua program studi', 'a', '-', '0', 1, '2022-01-13 14:46:26'),
(851, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Wakil Direktur I Politeknik Negeri Medan harus melakukan monitoring dan evaluasi terhadap karakteristik proses pembelajaran secara regular pada semua program studi', '4', 'Terlaksananya monitoring dan evaluasi terhadap karakteristik proses pembelajaran secara regular pada semua program studi', 'a', 'Dokumen', 'Laporan kegiatan monitoring dan evaluasi karekterisitik proses pembelajaran', 1, '2022-01-13 14:47:34'),
(852, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Wakil Direktur I Politeknik Negeri Medan harus melakukan monitoring dan evaluasi terhadap karakteristik proses pembelajaran secara regular pada semua program studi', '4', 'Tersedianya laporan hasil pelaksanaan monitoring dan evaluasi terhadap karakterisitik proses pembelajaran secara reguler (minimal 1 bulan sebelum awal semester baru', 'b', '-', '0', 1, '2022-01-13 14:48:11'),
(853, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Wakil Direktur I Politeknik Negeri Medan harus melakukan monitoring dan evaluasi terhadap karakteristik proses pembelajaran secara regular pada semua program studi', '4', 'Tersedianya laporan hasil pelaksanaan monitoring dan evaluasi terhadap karakterisitik proses pembelajaran secara reguler (minimal 1 bulan sebelum awal semester baru', 'b', 'Dokumen', 'Laporan kegiatan monitoring dan evaluasi karekterisitik proses pembelajaran', 1, '2022-01-13 14:51:12'),
(854, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Wakil Direktur I harus mengeluarkan Panduan Baku Penyusunan Rencana Pembelajaran Semester (RPS) dan dilakukan peninjauan ulang pada setiap akhir tahun akademik', '5', '0', '0', '0', '0', 1, '2022-01-13 14:52:24'),
(855, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Wakil Direktur I harus mengeluarkan Panduan Baku Penyusunan Rencana Pembelajaran Semester (RPS) dan dilakukan peninjauan ulang pada setiap akhir tahun akademik', '5', 'Tersedianya kebijakan Penyusunan Rencana Pembelajaran Semester ', 'a', '-', '0', 1, '2022-01-13 14:52:55'),
(856, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Wakil Direktur I harus mengeluarkan Panduan Baku Penyusunan Rencana Pembelajaran Semester (RPS) dan dilakukan peninjauan ulang pada setiap akhir tahun akademik', '5', 'Tersedianya kebijakan Penyusunan Rencana Pembelajaran Semester ', 'a', 'Dokumen', 'Kebijakan Penyusunan Rencana Pembelajaran Semester', 1, '2022-01-13 14:53:15'),
(857, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Wakil Direktur I harus mengeluarkan Panduan Baku Penyusunan Rencana Pembelajaran Semester (RPS) dan dilakukan peninjauan ulang pada setiap akhir tahun akademik', '5', 'Tersedianya Panduan Baku Penyusunan Rencana Pembelajaran Semester (RPS) ', 'b', '-', '0', 1, '2022-01-13 14:53:54'),
(858, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Wakil Direktur I harus mengeluarkan Panduan Baku Penyusunan Rencana Pembelajaran Semester (RPS) dan dilakukan peninjauan ulang pada setiap akhir tahun akademik', '5', 'Tersedianya Panduan Baku Penyusunan Rencana Pembelajaran Semester (RPS) ', 'b', 'Dokumen', 'Panduan Baku Penyusunan RPS ', 1, '2022-01-13 14:54:23'),
(859, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Wakil Direktur I harus mengeluarkan Panduan Baku Penyusunan Rencana Pembelajaran Semester (RPS) dan dilakukan peninjauan ulang pada setiap akhir tahun akademik', '5', 'Terlaksananya peninjauan ulang RPS pada setiap akhir tahun akademik', 'c', '-', '0', 1, '2022-01-13 15:00:51'),
(860, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Wakil Direktur I harus mengeluarkan Panduan Baku Penyusunan Rencana Pembelajaran Semester (RPS) dan dilakukan peninjauan ulang pada setiap akhir tahun akademik', '5', 'Terlaksananya peninjauan ulang RPS pada setiap akhir tahun akademik', 'c', 'Dokumen', 'Laporan kegiatan Peninjauan ulang RPS ', 1, '2022-01-13 15:01:19'),
(861, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Ketua Jurusan/Kepala Program Studi harus memastikan ketersediaan Rencana Pembelajaran Semester (RPS)  sebelum awal semester untuk setiap mata kuliah pada semester tersebut dan menyesuaikannya dengan perkembangan ilmu pengetahuan dan teknologi', '6', '0', '0', '0', '0', 1, '2022-01-13 15:04:21'),
(862, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Ketua Jurusan/Kepala Program Studi harus memastikan ketersediaan Rencana Pembelajaran Semester (RPS)  sebelum awal semester untuk setiap mata kuliah pada semester tersebut dan menyesuaikannya dengan perkembangan ilmu pengetahuan dan teknologi', '6', 'Tersedianya pelaksanaan penyusunan  RPS oleh dosen untuk  mata kuliah yang diampunya yang difasilitasi oleh Ketua Jurusan/KPS', 'a', '-', '0', 1, '2022-01-13 15:04:56'),
(863, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Ketua Jurusan/Kepala Program Studi harus memastikan ketersediaan Rencana Pembelajaran Semester (RPS)  sebelum awal semester untuk setiap mata kuliah pada semester tersebut dan menyesuaikannya dengan perkembangan ilmu pengetahuan dan teknologi', '6', 'Tersedianya pelaksanaan penyusunan  RPS oleh dosen untuk  mata kuliah yang diampunya yang difasilitasi oleh Ketua Jurusan/KPS', 'a', 'Dokumen', 'Laporan kegiatan pelaksanaan penyusunan RPS', 1, '2022-01-13 15:06:04'),
(864, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Ketua Jurusan/Kepala Program Studi harus memastikan ketersediaan Rencana Pembelajaran Semester (RPS)  sebelum awal semester untuk setiap mata kuliah pada semester tersebut dan menyesuaikannya dengan perkembangan ilmu pengetahuan dan teknologi', '6', 'Terlaksananya peninjauan ulang RPS untuk menyesuaikan dengan perkembangan ilmu pengetahuan dan teknologi pada setiap awal semester (1 bulan sebelum pelaksanan awal semester)', 'b', '-', '0', 1, '2022-01-13 15:06:44'),
(865, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Ketua Jurusan/Kepala Program Studi harus memastikan ketersediaan Rencana Pembelajaran Semester (RPS)  sebelum awal semester untuk setiap mata kuliah pada semester tersebut dan menyesuaikannya dengan perkembangan ilmu pengetahuan dan teknologi', '6', 'Terlaksananya peninjauan ulang RPS untuk menyesuaikan dengan perkembangan ilmu pengetahuan dan teknologi pada setiap awal semester (1 bulan sebelum pelaksanan awal semester)', 'b', 'Dokumen', 'Laporan hasil peninjauan ulang RPS untuk semua mata kuliah yang akan digunakan pada tahun akademik berikutnya ', 1, '2022-01-13 15:09:04'),
(866, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Ketua Jurusan/Kepala Program Studi harus memastikan ketersediaan Rencana Pembelajaran Semester (RPS)  sebelum awal semester untuk setiap mata kuliah dan telah dilakukan peninjuan sebelumnya untuk menyesuaikannya dengan perkembangan ilmu pengetahuan dan teknologi', '7', '0', '0', '0', '0', 1, '2022-01-13 15:09:43'),
(867, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Ketua Jurusan/Kepala Program Studi harus memastikan ketersediaan Rencana Pembelajaran Semester (RPS)  sebelum awal semester untuk setiap mata kuliah dan telah dilakukan peninjuan sebelumnya untuk menyesuaikannya dengan perkembangan ilmu pengetahuan dan teknologi', '7', 'Tersedianya  Rencana Pembelajaran Semester (RPS) untuk  setiap mata kuliah sebelum awal semester berjalan', 'a', '-', '0', 1, '2022-01-13 15:10:09'),
(868, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Ketua Jurusan/Kepala Program Studi harus memastikan ketersediaan Rencana Pembelajaran Semester (RPS)  sebelum awal semester untuk setiap mata kuliah dan telah dilakukan peninjuan sebelumnya untuk menyesuaikannya dengan perkembangan ilmu pengetahuan dan teknologi', '7', 'Tersedianya  Rencana Pembelajaran Semester (RPS) untuk  setiap mata kuliah sebelum awal semester berjalan', 'a', 'Dokumen', 'Rekapitulasi kesesuain jumlah RPS dengan sebaran matakuliah setiap semester', 1, '2022-01-13 15:11:48'),
(869, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Ketua Jurusan/Kepala Program Studi harus memastikan ketersediaan Rencana Pembelajaran Semester (RPS)  sebelum awal semester untuk setiap mata kuliah dan telah dilakukan peninjuan sebelumnya untuk menyesuaikannya dengan perkembangan ilmu pengetahuan dan teknologi', '7', 'Tersedianya bukti telah dilakukannya peninjauan RPS oleh dosen pengampu secara mandiri atau bersama dalam kelompok keahlian suatu bidang ilmu pengetahuan dan/atau teknologi untuk memastikan kesesuaiannya dengan perkembangan ilmu pengetahuan dan teknologi ', 'b', '-', '0', 1, '2022-01-13 15:13:36'),
(870, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Ketua Jurusan/Kepala Program Studi harus memastikan ketersediaan Rencana Pembelajaran Semester (RPS)  sebelum awal semester untuk setiap mata kuliah dan telah dilakukan peninjuan sebelumnya untuk menyesuaikannya dengan perkembangan ilmu pengetahuan dan teknologi', '7', 'Tersedianya bukti telah dilakukannya peninjauan RPS oleh dosen pengampu secara mandiri atau bersama dalam kelompok keahlian suatu bidang ilmu pengetahuan dan/atau teknologi untuk memastikan kesesuaiannya dengan perkembangan ilmu pengetahuan dan teknologi ', 'b', 'Dokumen', 'Laporan kegiatan peninjauan RPS', 1, '2022-01-13 15:13:55');
INSERT INTO `standar` (`standarid`, `kodestandar`, `namastandar`, `namasubstandar`, `kodesubstandar`, `namapernyataan`, `kodepernyataan`, `namaindikator`, `kodeindikator`, `catatanindikator`, `namadokumen`, `userid`, `createdDate`) VALUES
(871, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Direktur dibantu Wakil Direktur II harus menetapkan pedoman yang komprehensif dan rinci tentang penerapan sistem penugasan dosen berdasarkan kebutuhan, kualifikasi, keahlian dan pengalaman dalam proses pembelajaran dan dilakukan evaluasi terkait pedoman tersebut minimal satu kali dalam 2 tahun', '8', '0', '0', '0', '0', 1, '2022-01-13 15:14:28'),
(872, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Direktur dibantu Wakil Direktur II harus menetapkan pedoman yang komprehensif dan rinci tentang penerapan sistem penugasan dosen berdasarkan kebutuhan, kualifikasi, keahlian dan pengalaman dalam proses pembelajaran dan dilakukan evaluasi terkait pedoman tersebut minimal satu kali dalam 2 tahun', '8', 'Tersedianya pedoman yang komprehensif dan rinci tentang penerapan sistem penugasan dosen berdasarkan kebutuhan, kualifikasi, keahlian dan pengalaman dalam proses pembelajaran', 'a', '-', '0', 1, '2022-01-13 15:14:48'),
(873, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Direktur dibantu Wakil Direktur II harus menetapkan pedoman yang komprehensif dan rinci tentang penerapan sistem penugasan dosen berdasarkan kebutuhan, kualifikasi, keahlian dan pengalaman dalam proses pembelajaran dan dilakukan evaluasi terkait pedoman tersebut minimal satu kali dalam 2 tahun', '8', 'Tersedianya pedoman yang komprehensif dan rinci tentang penerapan sistem penugasan dosen berdasarkan kebutuhan, kualifikasi, keahlian dan pengalaman dalam proses pembelajaran', 'a', 'Dokumen', 'Pedoman penerapan sistem penugasan dosen ', 1, '2022-01-13 15:15:05'),
(874, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Direktur dibantu Wakil Direktur II harus menetapkan pedoman yang komprehensif dan rinci tentang penerapan sistem penugasan dosen berdasarkan kebutuhan, kualifikasi, keahlian dan pengalaman dalam proses pembelajaran dan dilakukan evaluasi terkait pedoman tersebut minimal satu kali dalam 2 tahun', '8', 'Terlaksananya evaluasi pedoman penerapan sistem penugasan dosen berdasarkan kebutuhan, kualifikasi, keahlian dan pengalaman dalam proses pembelajaran', 'b', '-', '0', 1, '2022-01-13 15:15:32'),
(875, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Direktur dibantu Wakil Direktur II harus menetapkan pedoman yang komprehensif dan rinci tentang penerapan sistem penugasan dosen berdasarkan kebutuhan, kualifikasi, keahlian dan pengalaman dalam proses pembelajaran dan dilakukan evaluasi terkait pedoman tersebut minimal satu kali dalam 2 tahun', '8', 'Terlaksananya evaluasi pedoman penerapan sistem penugasan dosen berdasarkan kebutuhan, kualifikasi, keahlian dan pengalaman dalam proses pembelajaran', 'b', 'Dokumen', 'Laporan hasil evaluasi penerapan sistem penugasan dosen ', 1, '2022-01-13 15:15:48'),
(876, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'P3AI bersama SPMI berkoordinasi dengan Wakil Direktur I menyusun pedoman yang komprehensif dan rinci tentang penetapan strategi, metode dan media pembelajaran, serta penilaian pembelajaran dan melakukan peninjauan ulang minimal satu kali dalam 2 tahun', '9', '0', '0', '0', '0', 1, '2022-01-13 15:16:46'),
(877, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'P3AI bersama SPMI berkoordinasi dengan Wakil Direktur I menyusun pedoman yang komprehensif dan rinci tentang penetapan strategi, metode dan media pembelajaran, serta penilaian pembelajaran dan melakukan peninjauan ulang minimal satu kali dalam 2 tahun', '9', 'Tersedianya pedoman yang komprehensif dan rinci tentang penetapan strategi, metode dan media pembelajaran, serta penilaian pembelajaran', 'a', '-', '0', 1, '2022-01-13 15:17:09'),
(878, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'P3AI bersama SPMI berkoordinasi dengan Wakil Direktur I menyusun pedoman yang komprehensif dan rinci tentang penetapan strategi, metode dan media pembelajaran, serta penilaian pembelajaran dan melakukan peninjauan ulang minimal satu kali dalam 2 tahun', '9', 'Tersedianya pedoman yang komprehensif dan rinci tentang penetapan strategi, metode dan media pembelajaran, serta penilaian pembelajaran', 'a', 'Dokumen', 'Pedoman yang komprehensif dan rinci tentang penetapan strategi, metode dan media pembelajaran, serta penilaian pembelajaran', 1, '2022-01-13 15:17:27'),
(879, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'P3AI bersama SPMI berkoordinasi dengan Wakil Direktur I menyusun pedoman yang komprehensif dan rinci tentang penetapan strategi, metode dan media pembelajaran, serta penilaian pembelajaran dan melakukan peninjauan ulang minimal satu kali dalam 2 tahun', '9', 'Tersedianya peninjauan ulang pedoman komprehensif dan rinci tentang penetapan strategi, metode dan media pembelajaran, serta penilaian pembelajaran', 'b', '-', '0', 1, '2022-01-13 15:17:53'),
(880, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'P3AI bersama SPMI berkoordinasi dengan Wakil Direktur I menyusun pedoman yang komprehensif dan rinci tentang penetapan strategi, metode dan media pembelajaran, serta penilaian pembelajaran dan melakukan peninjauan ulang minimal satu kali dalam 2 tahun', '9', 'Tersedianya peninjauan ulang pedoman komprehensif dan rinci tentang penetapan strategi, metode dan media pembelajaran, serta penilaian pembelajaran', 'b', 'Dokumen', 'Peninjauan ulang pedoman komprehensif dan rinci tentang penetapan strategi, metode dan media pembelajaran, serta penilaian pembelajaran', 1, '2022-01-13 15:18:13'),
(881, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Wakil Direktur I menetapkan pedoman yang komprehensif dan rinci tentang penetapan strategi, metode dan media pembelajaran, serta penilaian pembelajaran, disosialisasikan minimal satu kali dalam setiap awal tahun akademik dan didokumentasikan serta dapat diakses oleh dosen dan mahasiswa ', '10', '0', '0', '0', '0', 1, '2022-01-13 15:18:52'),
(882, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Wakil Direktur I menetapkan pedoman yang komprehensif dan rinci tentang penetapan strategi, metode dan media pembelajaran, serta penilaian pembelajaran, disosialisasikan minimal satu kali dalam setiap awal tahun akademik dan didokumentasikan serta dapat diakses oleh dosen dan mahasiswa ', '10', 'Terlaksananya penetapan, sosialisasi dan dokumentasi pedoman yang komprehensif dan rinci tentang penetapan strategi, metode dan media pembelajaran, serta penilaian pembelajaran', 'a', '-', '0', 1, '2022-01-13 15:19:14'),
(883, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Wakil Direktur I menetapkan pedoman yang komprehensif dan rinci tentang penetapan strategi, metode dan media pembelajaran, serta penilaian pembelajaran, disosialisasikan minimal satu kali dalam setiap awal tahun akademik dan didokumentasikan serta dapat diakses oleh dosen dan mahasiswa ', '10', 'Terlaksananya penetapan, sosialisasi dan dokumentasi pedoman yang komprehensif dan rinci tentang penetapan strategi, metode dan media pembelajaran, serta penilaian pembelajaran', 'a', 'Dokumen', 'Penetapan, sosialisasi dan dokumentasi   pedoman yang komprehensif dan rinci tentang penetapan strategi, metode dan media pembelajaran, serta penilaian pembelajaran', 1, '2022-01-13 15:19:38'),
(884, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Ketua Jurusan/Kepala Program Studi harus memastikan bahwa proses pembelajaran semua mata kuliah berlangsung dalam bentuk interaksi antara Dosen, mahasiswa dan sumber belajar dalam lingkungan belajar tertentu dan terlaksana sesuai dengan Rencana Pembelajaran Semester (RPS) yang telah disusun untuk setiap semester', '11', '0', '0', '0', '0', 1, '2022-01-13 15:20:03'),
(885, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Ketua Jurusan/Kepala Program Studi harus memastikan bahwa proses pembelajaran semua mata kuliah berlangsung dalam bentuk interaksi antara Dosen, mahasiswa dan sumber belajar dalam lingkungan belajar tertentu dan terlaksana sesuai dengan Rencana Pembelajaran Semester (RPS) yang telah disusun untuk setiap semester', '11', 'Terlaksananya  proses pembelajaran semua mata kuliah yang berlangsung dalam bentuk interaksi antara Dosen, mahasiswa dan sumber belajar dalam lingkungan belajar tertentu dan sesuai dengan Rencana Pembelajaran Semester (RPS) yang telah disusun untuk setiap semester', 'a', '-', '0', 1, '2022-01-13 15:20:31'),
(886, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Ketua Jurusan/Kepala Program Studi harus memastikan bahwa proses pembelajaran semua mata kuliah berlangsung dalam bentuk interaksi antara Dosen, mahasiswa dan sumber belajar dalam lingkungan belajar tertentu dan terlaksana sesuai dengan Rencana Pembelajaran Semester (RPS) yang telah disusun untuk setiap semester', '11', 'Terlaksananya  proses pembelajaran semua mata kuliah yang berlangsung dalam bentuk interaksi antara Dosen, mahasiswa dan sumber belajar dalam lingkungan belajar tertentu dan sesuai dengan Rencana Pembelajaran Semester (RPS) yang telah disusun untuk setiap semester', 'a', 'Dokumen', 'Pelaksanaan proses pembelajaran (Jadwal Perkuliahan, Daftar hadir mahasiswa, dosen, kontrak materi kuliah yang menggambarkan sumber belajar, RPS, Modul/Bahan Ajar)', 1, '2022-01-13 15:20:56'),
(887, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Ketua Jurusan/Kepala Program Studi harus memastikan bahwa proses pembelajaran semua mata kuliah berlangsung dalam bentuk interaksi antara Dosen, mahasiswa dan sumber belajar dalam lingkungan belajar tertentu dan terlaksana sesuai dengan Rencana Pembelajaran Semester (RPS) yang telah disusun untuk setiap semester', '11', 'Tersedianya bukti sistem pelaksanaan pemantauan proses pembelajaran yang dilaksanakan secara periodik', 'b', '-', '0', 1, '2022-01-13 15:21:20'),
(888, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Ketua Jurusan/Kepala Program Studi harus memastikan bahwa proses pembelajaran semua mata kuliah berlangsung dalam bentuk interaksi antara Dosen, mahasiswa dan sumber belajar dalam lingkungan belajar tertentu dan terlaksana sesuai dengan Rencana Pembelajaran Semester (RPS) yang telah disusun untuk setiap semester', '11', 'Tersedianya bukti sistem pelaksanaan pemantauan proses pembelajaran yang dilaksanakan secara periodik', 'b', 'Dokumen', 'Laporan hasil monitoring pelaksanaan proses pembelajaran ', 1, '2022-01-13 15:21:40'),
(889, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Ketua Jurusan/Kepala Program Studi Diploma 3, Diploma 4 dan Magister Terapan harus berkoordinasi dengan Pusat Penelitian dan Pengabdian kepada Masyarakat dalam proses pembelajaran terkait Pengabdian kepada Masyarakat harus mengacu pada Standar Nasional Pendidikan Tinggi Pengabdian kepada Masyarakat dan dievaluasi pelaksanaannya pada setiap akhir semester', '12', '0', '0', '0', '0', 1, '2022-01-13 15:22:17'),
(890, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Ketua Jurusan/Kepala Program Studi Diploma 3, Diploma 4 dan Magister Terapan harus berkoordinasi dengan Pusat Penelitian dan Pengabdian kepada Masyarakat dalam proses pembelajaran terkait Pengabdian kepada Masyarakat harus mengacu pada Standar Nasional Pendidikan Tinggi Pengabdian kepada Masyarakat dan dievaluasi pelaksanaannya pada setiap akhir semester', '12', 'Tersedianya laporan hasil pengabdian kepada masyarakat yang dilaksanakan oleh Dosen tetap program studi dengan melibatkan mahasiswa program studi', 'a', '-', '0', 1, '2022-01-13 15:22:41'),
(891, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Ketua Jurusan/Kepala Program Studi Diploma 3, Diploma 4 dan Magister Terapan harus berkoordinasi dengan Pusat Penelitian dan Pengabdian kepada Masyarakat dalam proses pembelajaran terkait Pengabdian kepada Masyarakat harus mengacu pada Standar Nasional Pendidikan Tinggi Pengabdian kepada Masyarakat dan dievaluasi pelaksanaannya pada setiap akhir semester', '12', 'Tersedianya laporan hasil pengabdian kepada masyarakat yang dilaksanakan oleh Dosen tetap program studi dengan melibatkan mahasiswa program studi', 'a', 'Dokumen', 'Laporan hasil pengabdian kepada masyarakat yang dilaksanakan oleh Dosen tetap program studi dengan melibatkan mahasiswa program studi', 1, '2022-01-13 15:22:59'),
(892, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Ketua Jurusan/Kepala Program Studi Diploma 3, Diploma 4 dan Magister Terapan harus berkoordinasi dengan Pusat Penelitian dan Pengabdian kepada Masyarakat dalam proses pembelajaran terkait Pengabdian kepada Masyarakat harus mengacu pada Standar Nasional Pendidikan Tinggi Pengabdian kepada Masyarakat dan dievaluasi pelaksanaannya pada setiap akhir semester', '12', 'Tersedianya laporan evaluasi pelaksanaan pengabdian masyarakat yang dilaksanakan oleh Dosen tetap program studi dengan melibatkan mahasiswa program studi', 'b', '-', '0', 1, '2022-01-13 15:24:27'),
(893, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Ketua Jurusan/Kepala Program Studi Diploma 3, Diploma 4 dan Magister Terapan harus berkoordinasi dengan Pusat Penelitian dan Pengabdian kepada Masyarakat dalam proses pembelajaran terkait Pengabdian kepada Masyarakat harus mengacu pada Standar Nasional Pendidikan Tinggi Pengabdian kepada Masyarakat dan dievaluasi pelaksanaannya pada setiap akhir semester', '12', 'Tersedianya laporan evaluasi pelaksanaan pengabdian masyarakat yang dilaksanakan oleh Dosen tetap program studi dengan melibatkan mahasiswa program studi', 'b', 'Dokumen', 'Laporan evaluasi pelaksanaan pengabdian masyarakat yang dilaksanakan oleh Dosen tetap program studi dengan melibatkan mahasiswa program studi', 1, '2022-01-13 15:24:49'),
(894, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Ketua Jurusan/Kepala Program Studi Diploma 4 dan Magister Terapan harus berkoordinasi dengan Pusat Penelitian dan Pengabdian kepada Masyarakat dalam proses pembelajaran terkait Penelitian harus mengacu pada Standar Nasional Pendidikan Tinggi Penelitian  dan dievaluasi pelaksanaannya pada setiap akhir semester', '13', '0', '0', '0', '0', 1, '2022-01-13 15:25:45'),
(895, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Ketua Jurusan/Kepala Program Studi Diploma 4 dan Magister Terapan harus berkoordinasi dengan Pusat Penelitian dan Pengabdian kepada Masyarakat dalam proses pembelajaran terkait Penelitian harus mengacu pada Standar Nasional Pendidikan Tinggi Penelitian  dan dievaluasi pelaksanaannya pada setiap akhir semester', '13', 'Tersedianya laporan hasil penelitian yang dilaksanakan oleh Dosen tetap program studi dengan melibatkan mahasiswa program studi', 'a', '-', '0', 1, '2022-01-13 15:26:12'),
(896, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Ketua Jurusan/Kepala Program Studi Diploma 4 dan Magister Terapan harus berkoordinasi dengan Pusat Penelitian dan Pengabdian kepada Masyarakat dalam proses pembelajaran terkait Penelitian harus mengacu pada Standar Nasional Pendidikan Tinggi Penelitian  dan dievaluasi pelaksanaannya pada setiap akhir semester', '13', 'Tersedianya laporan hasil penelitian yang dilaksanakan oleh Dosen tetap program studi dengan melibatkan mahasiswa program studi', 'a', 'Dokumen', 'Laporan hasil penelitian yang dilaksanakan oleh Dosen tetap program studi dengan melibatkan mahasiswa program studi', 1, '2022-01-13 15:26:33'),
(897, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Ketua Jurusan/Kepala Program Studi Diploma 4 dan Magister Terapan harus berkoordinasi dengan Pusat Penelitian dan Pengabdian kepada Masyarakat dalam proses pembelajaran terkait Penelitian harus mengacu pada Standar Nasional Pendidikan Tinggi Penelitian  dan dievaluasi pelaksanaannya pada setiap akhir semester', '13', 'Tersedianya laporan evaluasi pelaksanaan penelitian yang dilaksanakan oleh Dosen tetap program studi dengan melibatkan mahasiswa program studi', 'b', '-', '0', 1, '2022-01-13 15:26:57'),
(898, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Ketua Jurusan/Kepala Program Studi Diploma 4 dan Magister Terapan harus berkoordinasi dengan Pusat Penelitian dan Pengabdian kepada Masyarakat dalam proses pembelajaran terkait Penelitian harus mengacu pada Standar Nasional Pendidikan Tinggi Penelitian  dan dievaluasi pelaksanaannya pada setiap akhir semester', '13', 'Tersedianya laporan evaluasi pelaksanaan penelitian yang dilaksanakan oleh Dosen tetap program studi dengan melibatkan mahasiswa program studi', 'b', 'Dokumen', 'Laporan evaluasi pelaksanaan penelitian yang dilaksanakan oleh Dosen tetap program studi dengan melibatkan mahasiswa program studi', 1, '2022-01-13 15:27:21'),
(899, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Ketua Jurusan/Kepala Program Studi Diploma 3 harus berkoordinasi dengan Wakil Direktur I untuk memastikan pembelajaran yang dilaksanakan dalam bentuk  praktikum, praktik studio, praktik bengkel, atau  praktik lapangan â‰¥ 50% dari jam pembelajran total selama masa pendidikan', '14', '0', '0', '0', '0', 1, '2022-01-13 15:28:06'),
(900, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Ketua Jurusan/Kepala Program Studi Diploma 3 harus berkoordinasi dengan Wakil Direktur I untuk memastikan pembelajaran yang dilaksanakan dalam bentuk  praktikum, praktik studio, praktik bengkel, atau  praktik lapangan â‰¥ 50% dari jam pembelajran total selama masa pendidikan', '14', 'Tersedianya bukti sahih terkait pembelajaran yang dilaksanakan dalam bentuk  praktikum, praktik studio, praktik bengkel, atau  praktik lapangan â‰¥ 50% dari jam pembelajran total selama masa pendidikan yangtersaji dalam Tabel 5.a. LKPS', 'a', '-', '0', 1, '2022-01-13 15:28:29'),
(901, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Ketua Jurusan/Kepala Program Studi Diploma 3 harus berkoordinasi dengan Wakil Direktur I untuk memastikan pembelajaran yang dilaksanakan dalam bentuk  praktikum, praktik studio, praktik bengkel, atau  praktik lapangan â‰¥ 50% dari jam pembelajran total selama masa pendidikan', '14', 'Tersedianya bukti sahih terkait pembelajaran yang dilaksanakan dalam bentuk  praktikum, praktik studio, praktik bengkel, atau  praktik lapangan â‰¥ 50% dari jam pembelajran total selama masa pendidikan yangtersaji dalam Tabel 5.a. LKPS', 'a', 'Dokumen', 'Tabel 5.a. LKPS', 1, '2022-01-13 15:29:01'),
(902, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Ketua Jurusan/Kepala Program Studi Diploma 4 harus berkoordinasi dengan Wakil Direktur I untuk memastikan pembelajaran yang dilaksanakan dalam bentuk  praktikum, praktik studio, praktik bengkel, atau  praktik lapangan â‰¥ 30% dari jam pembelajran total selama masa pendidikan', '15', '0', '0', '0', '0', 1, '2022-01-13 15:29:44'),
(903, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Ketua Jurusan/Kepala Program Studi Diploma 4 harus berkoordinasi dengan Wakil Direktur I untuk memastikan pembelajaran yang dilaksanakan dalam bentuk  praktikum, praktik studio, praktik bengkel, atau  praktik lapangan â‰¥ 30% dari jam pembelajran total selama masa pendidikan', '15', 'Tersedianya bukti sahih terkait pembelajaran yang dilaksanakan dalam bentuk  praktikum, praktik studio, praktik bengkel, atau  praktik lapangan â‰¥ 30% dari jam pembelajran total selama masa pendidikan yangtersaji dalam Tabel 5.a. LKPS', 'a', '-', '0', 1, '2022-01-13 15:30:27'),
(904, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Ketua Jurusan/Kepala Program Studi Diploma 4 harus berkoordinasi dengan Wakil Direktur I untuk memastikan pembelajaran yang dilaksanakan dalam bentuk  praktikum, praktik studio, praktik bengkel, atau  praktik lapangan â‰¥ 30% dari jam pembelajran total selama masa pendidikan', '15', 'Tersedianya bukti sahih terkait pembelajaran yang dilaksanakan dalam bentuk  praktikum, praktik studio, praktik bengkel, atau  praktik lapangan â‰¥ 30% dari jam pembelajran total selama masa pendidikan yangtersaji dalam Tabel 5.a. LKPS', 'a', 'Dokumen', 'Tabel 5.a. LKPS', 1, '2022-01-13 15:30:47'),
(905, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Direktur harus menetapkan kebijakan dan pedoman yang komprehensif dan rinci untuk mengintegrasikan kegiatan peneltiian dan pengabdian kepada masyarakat ke dalam pembelajaran dan melakukan evaluasi, pengendalian, dan peningkatan kualitas secara bekelanjutan', '16', '0', '0', '0', '0', 1, '2022-01-13 15:31:23'),
(906, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Direktur harus menetapkan kebijakan dan pedoman yang komprehensif dan rinci untuk mengintegrasikan kegiatan peneltiian dan pengabdian kepada masyarakat ke dalam pembelajaran dan melakukan evaluasi, pengendalian, dan peningkatan kualitas secara bekelanjutan', '16', 'Tersedianya kebijakan dan pedoman yang komprehensif dan rinci untuk mengintegrasikan kegiatan peneltiian dan pengabdian kepada masyarakat ke dalam pembelajaran', 'a', '-', '0', 1, '2022-01-13 15:31:46'),
(907, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Direktur harus menetapkan kebijakan dan pedoman yang komprehensif dan rinci untuk mengintegrasikan kegiatan peneltiian dan pengabdian kepada masyarakat ke dalam pembelajaran dan melakukan evaluasi, pengendalian, dan peningkatan kualitas secara bekelanjutan', '16', 'Tersedianya kebijakan dan pedoman yang komprehensif dan rinci untuk mengintegrasikan kegiatan peneltiian dan pengabdian kepada masyarakat ke dalam pembelajaran', 'a', 'Dokumen', 'Kebijakan dan pedoman yang komprehensif dan rinci untuk mengintegrasikan kegiatan peneltiian dan pengabdian kepada masyarakat ke dalam pembelajaran', 1, '2022-01-13 15:32:05'),
(908, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Direktur harus menetapkan kebijakan dan pedoman yang komprehensif dan rinci untuk mengintegrasikan kegiatan peneltiian dan pengabdian kepada masyarakat ke dalam pembelajaran dan melakukan evaluasi, pengendalian, dan peningkatan kualitas secara bekelanjutan', '16', 'Terlaksananya kegiatan evaluasi, pengendalian dan peningkatan kualitas kegiatan penelitian dan pengabdian kepada masyarakat dalam pembelajaran', 'b', '-', '0', 1, '2022-01-13 15:32:40'),
(909, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Direktur harus menetapkan kebijakan dan pedoman yang komprehensif dan rinci untuk mengintegrasikan kegiatan peneltiian dan pengabdian kepada masyarakat ke dalam pembelajaran dan melakukan evaluasi, pengendalian, dan peningkatan kualitas secara bekelanjutan', '16', 'Terlaksananya kegiatan evaluasi, pengendalian dan peningkatan kualitas kegiatan penelitian dan pengabdian kepada masyarakat dalam pembelajaran', 'b', 'Dokumen', 'Kegiatan evaluasi, pengendalian dan peningkatan kualitas kegiatan penelitian dan pengabdian kepada masyarakat dalam pembelajaran', 1, '2022-01-13 15:32:58'),
(910, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Direktur harus menetapkan kebijakan dan pedoman yang komprehensif dan rinci untuk mengintegrasikan kegiatan peneltiian dan pengabdian kepada masyarakat ke dalam pembelajaran dan melakukan evaluasi, pengendalian, dan peningkatan kualitas secara bekelanjutan', '16', 'Tersedianya bukti sahih bahwa SPMI melakukan monitoring dan evaluasi integrasi penelitian dan PkM terhadap pembelajaran yang ditindaklanjuti secara berkelanjutan', 'c', '-', '0', 1, '2022-01-13 15:33:38'),
(911, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Direktur harus menetapkan kebijakan dan pedoman yang komprehensif dan rinci untuk mengintegrasikan kegiatan peneltiian dan pengabdian kepada masyarakat ke dalam pembelajaran dan melakukan evaluasi, pengendalian, dan peningkatan kualitas secara bekelanjutan', '16', 'Tersedianya bukti sahih bahwa SPMI melakukan monitoring dan evaluasi integrasi penelitian dan PkM terhadap pembelajaran yang ditindaklanjuti secara berkelanjutan', 'c', 'Dokumen', 'SPMI melakukan monitoring dan evaluasi integrasi penelitian dan PkM terhadap pembelajaran yang ditindaklanjuti secara berkelanjutan', 1, '2022-01-13 15:33:56'),
(912, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Ketua Jurusan/Kepala Program Studi harus memastikan bahwa Proses pembelajaran melalui kegiatan kurikuler dilakukan secara sistematis dan terstruktur melalui berbagai mata kuliah dan dengan beban belajar yang terukur pada setiap  awal semester', '17', '0', '0', '0', '0', 1, '2022-01-13 15:34:56'),
(913, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Ketua Jurusan/Kepala Program Studi harus memastikan bahwa Proses pembelajaran melalui kegiatan kurikuler dilakukan secara sistematis dan terstruktur melalui berbagai mata kuliah dan dengan beban belajar yang terukur pada setiap  awal semester', '17', 'Tersedianya bukti sahih yang memastikan bahwa proses pembelajaran melalui kegiatan kurikuler dilakukan secara sistematis dan terstruktur melalui berbagai mata kuliah dan dengan beban belajar yang terukur pada setiap  awal semester', 'a', '-', '0', 1, '2022-01-13 15:35:15'),
(914, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Ketua Jurusan/Kepala Program Studi harus memastikan bahwa Proses pembelajaran melalui kegiatan kurikuler dilakukan secara sistematis dan terstruktur melalui berbagai mata kuliah dan dengan beban belajar yang terukur pada setiap  awal semester', '17', 'Tersedianya bukti sahih yang memastikan bahwa proses pembelajaran melalui kegiatan kurikuler dilakukan secara sistematis dan terstruktur melalui berbagai mata kuliah dan dengan beban belajar yang terukur pada setiap  awal semester', 'a', 'Dokumen', 'Pelaksanaan proses pembelajaran ', 1, '2022-01-13 15:35:31'),
(915, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Dosen dapat memilih satu atau gabungan dari beberapa metode pembelajaran dalam pelaksanaan pembelajaran pada mata kuliah untuk memenuhi capaian pembelajaran lulusan dan dievaluasi pelaksanaannya setiap akhir semester ', '18', '0', '0', '0', '0', 1, '2022-01-13 15:36:01'),
(916, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Dosen dapat memilih satu atau gabungan dari beberapa metode pembelajaran dalam pelaksanaan pembelajaran pada mata kuliah untuk memenuhi capaian pembelajaran lulusan dan dievaluasi pelaksanaannya setiap akhir semester ', '18', 'Terlaksananya pembelajaran dengan menggunakan satu atau gabungan metode pembelajaran pada mata kuliah yang berupa: diskusi kelompok, simulasi, studi kasus, Pembelajaran kolaboratif, Pembelajaran kooperatif, Pembelajaran berbasis proyek, Pembelajaran berbasis masalah, atau metode Pembelajaran lain', 'a', '-', '0', 1, '2022-01-13 15:36:48'),
(917, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Dosen dapat memilih satu atau gabungan dari beberapa metode pembelajaran dalam pelaksanaan pembelajaran pada mata kuliah untuk memenuhi capaian pembelajaran lulusan dan dievaluasi pelaksanaannya setiap akhir semester ', '18', 'Terlaksananya pembelajaran dengan menggunakan satu atau gabungan metode pembelajaran pada mata kuliah yang berupa: diskusi kelompok, simulasi, studi kasus, Pembelajaran kolaboratif, Pembelajaran kooperatif, Pembelajaran berbasis proyek, Pembelajaran berbasis masalah, atau metode Pembelajaran lain', 'a', 'Dokumen', 'Dokumen pelaksanaan proses pembelajaran', 1, '2022-01-13 15:37:28'),
(918, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Dosen dapat memilih satu atau gabungan dari beberapa metode pembelajaran dalam pelaksanaan pembelajaran pada mata kuliah untuk memenuhi capaian pembelajaran lulusan dan dievaluasi pelaksanaannya setiap akhir semester ', '18', 'Terdapat bukti sahih yang menunjukkan metode pembelajaran yang dilaksanakan sesuai dengan capaian pembelajaran yang direncanakan pada 75% s.d. 100% mata kuliah', 'b', '-', '0', 1, '2022-01-13 15:38:21'),
(919, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Dosen dapat memilih satu atau gabungan dari beberapa metode pembelajaran dalam pelaksanaan pembelajaran pada mata kuliah untuk memenuhi capaian pembelajaran lulusan dan dievaluasi pelaksanaannya setiap akhir semester ', '18', 'Terdapat bukti sahih yang menunjukkan metode pembelajaran yang dilaksanakan sesuai dengan capaian pembelajaran yang direncanakan pada 75% s.d. 100% mata kuliah', 'b', 'Dokumen', 'RPS', 1, '2022-01-13 15:38:40'),
(920, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Dosen dapat memilih satu atau gabungan dari beberapa metode pembelajaran dalam pelaksanaan pembelajaran pada mata kuliah untuk memenuhi capaian pembelajaran lulusan dan dievaluasi pelaksanaannya setiap akhir semester ', '18', 'Terlaksananya evaluasi pemilihan metode pembelajaran oleh dosen yang difasilitasi jurusan', 'c', '-', '0', 1, '2022-01-13 15:39:15'),
(921, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Dosen dapat memilih satu atau gabungan dari beberapa metode pembelajaran dalam pelaksanaan pembelajaran pada mata kuliah untuk memenuhi capaian pembelajaran lulusan dan dievaluasi pelaksanaannya setiap akhir semester ', '18', 'Terlaksananya evaluasi pemilihan metode pembelajaran oleh dosen yang difasilitasi jurusan', 'c', 'Dokumen', 'Laporan hasil evaluasi pemilihan/ penggunaan metode pembelajaran oleh dosen pada setiap mata kuliah', 1, '2022-01-13 15:39:36'),
(922, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Dosen dapat menggunakan satu atau gabungan dari beberapa bentuk pembelajaran dalam setiap mata kuliah yang diampunya dan dievaluasi pelaksanaannya pada setiap akhir semester', '19', '0', '0', '0', '0', 1, '2022-01-13 15:40:12'),
(923, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Dosen dapat menggunakan satu atau gabungan dari beberapa bentuk pembelajaran dalam setiap mata kuliah yang diampunya dan dievaluasi pelaksanaannya pada setiap akhir semester', '19', 'Terlaksananya proses pembelajaran dengan menggunakan satu atau gabungan dari beberapa bentuk pembelajaran dalam setiap mata kuliah yang diampu dosen', 'a', '-', '0', 1, '2022-01-13 15:40:51'),
(924, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Dosen dapat menggunakan satu atau gabungan dari beberapa bentuk pembelajaran dalam setiap mata kuliah yang diampunya dan dievaluasi pelaksanaannya pada setiap akhir semester', '19', 'Terlaksananya proses pembelajaran dengan menggunakan satu atau gabungan dari beberapa bentuk pembelajaran dalam setiap mata kuliah yang diampu dosen', 'a', 'Dokumen', 'Dokumen pelaksanaan proses pembelajaran', 1, '2022-01-13 15:41:09'),
(925, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Dosen pada Program Studi Diploma 4 wajib  menambahkan bentuk pembelajaran yang berupa penelitian dan perancangan atau pengembangan sebagai bentuk pembelajaran dan kegiatan mahasiswa dibawah bimbingan dosen dalam rangka pengembangan sikap, pengetahuan, keterampilan, pengalaman otentik, serta meningkatkan kesejahteraan masyarakat dan daya saing bangsa yang pelaksanaannya dievaluasi pada setiap akhir semester ', '20', '0', '0', '0', '0', 1, '2022-01-13 15:41:46'),
(926, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Dosen pada Program Studi Diploma 4 wajib  menambahkan bentuk pembelajaran yang berupa penelitian dan perancangan atau pengembangan sebagai bentuk pembelajaran dan kegiatan mahasiswa dibawah bimbingan dosen dalam rangka pengembangan sikap, pengetahuan, keterampilan, pengalaman otentik, serta meningkatkan kesejahteraan masyarakat dan daya saing bangsa yang pelaksanaannya dievaluasi pada setiap akhir semester ', '20', 'Terlaksananya bentuk pembelajaran yang berupa penelitian dan perancangan atau pengembangan sebagai bentuk pembelajaran dan kegiatan mahasiswa dibawah bimbingan dosen  ', 'a', '-', '0', 1, '2022-01-13 15:42:12'),
(927, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Dosen pada Program Studi Diploma 4 wajib  menambahkan bentuk pembelajaran yang berupa penelitian dan perancangan atau pengembangan sebagai bentuk pembelajaran dan kegiatan mahasiswa dibawah bimbingan dosen dalam rangka pengembangan sikap, pengetahuan, keterampilan, pengalaman otentik, serta meningkatkan kesejahteraan masyarakat dan daya saing bangsa yang pelaksanaannya dievaluasi pada setiap akhir semester ', '20', 'Terlaksananya bentuk pembelajaran yang berupa penelitian dan perancangan atau pengembangan sebagai bentuk pembelajaran dan kegiatan mahasiswa dibawah bimbingan dosen  ', 'a', 'Dokumen', 'Laporan hasil penelitian', 1, '2022-01-13 15:42:30'),
(928, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Dosen pada Program Studi Diploma 4 wajib  menambahkan bentuk pembelajaran yang berupa penelitian dan perancangan atau pengembangan sebagai bentuk pembelajaran dan kegiatan mahasiswa dibawah bimbingan dosen dalam rangka pengembangan sikap, pengetahuan, keterampilan, pengalaman otentik, serta meningkatkan kesejahteraan masyarakat dan daya saing bangsa yang pelaksanaannya dievaluasi pada setiap akhir semester ', '20', 'Terlaksananya evaluasi pelaksanaan bentuk pembelajran penelitian dan perancangan atau pengembangan', 'b', '-', '0', 1, '2022-01-13 15:43:11'),
(929, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Dosen pada Program Studi Diploma 4 wajib  menambahkan bentuk pembelajaran yang berupa penelitian dan perancangan atau pengembangan sebagai bentuk pembelajaran dan kegiatan mahasiswa dibawah bimbingan dosen dalam rangka pengembangan sikap, pengetahuan, keterampilan, pengalaman otentik, serta meningkatkan kesejahteraan masyarakat dan daya saing bangsa yang pelaksanaannya dievaluasi pada setiap akhir semester ', '20', 'Terlaksananya evaluasi pelaksanaan bentuk pembelajran penelitian dan perancangan atau pengembangan', 'b', 'Dokumen', 'Laporan evaluasi pelaksanaan bentuk pembelajran penelitian dan perancangan atau pengembangan', 1, '2022-01-13 15:43:32'),
(930, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Dosen pada Program Studi Diploma 4 wajib  menambahkan bentuk pembelajaran yang berupa berupa Pengabdian kepada Masyarakat sebagai kegiatan mahasiswa di bawah bimbingan Dosen dalam rangka memanfaatkan ilmu pengetahuan dan teknologi untuk memajukan kesejahteraan masyarakat dan mencerdaskan kehidupan bangsa yang pelaksanaannya dievaluasi pada setiap akhir semester', '21', '0', '0', '0', '0', 1, '2022-01-13 15:44:22'),
(931, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Dosen pada Program Studi Diploma 4 wajib  menambahkan bentuk pembelajaran yang berupa berupa Pengabdian kepada Masyarakat sebagai kegiatan mahasiswa di bawah bimbingan Dosen dalam rangka memanfaatkan ilmu pengetahuan dan teknologi untuk memajukan kesejahteraan masyarakat dan mencerdaskan kehidupan bangsa yang pelaksanaannya dievaluasi pada setiap akhir semester', '21', 'Terlaksananya bentuk pembelajaran yang berupa berupa Pengabdian kepada Masyarakat ', 'a', '-', '0', 1, '2022-01-13 15:44:45'),
(932, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Dosen pada Program Studi Diploma 4 wajib  menambahkan bentuk pembelajaran yang berupa berupa Pengabdian kepada Masyarakat sebagai kegiatan mahasiswa di bawah bimbingan Dosen dalam rangka memanfaatkan ilmu pengetahuan dan teknologi untuk memajukan kesejahteraan masyarakat dan mencerdaskan kehidupan bangsa yang pelaksanaannya dievaluasi pada setiap akhir semester', '21', 'Terlaksananya bentuk pembelajaran yang berupa berupa Pengabdian kepada Masyarakat ', 'a', 'Dokumen', 'Laporan hasil pengebdian', 1, '2022-01-13 15:45:02'),
(933, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Dosen pada Program Studi Diploma 4 wajib  menambahkan bentuk pembelajaran yang berupa berupa Pengabdian kepada Masyarakat sebagai kegiatan mahasiswa di bawah bimbingan Dosen dalam rangka memanfaatkan ilmu pengetahuan dan teknologi untuk memajukan kesejahteraan masyarakat dan mencerdaskan kehidupan bangsa yang pelaksanaannya dievaluasi pada setiap akhir semester', '21', 'Tersedianya hasil laporan evaluasi proses pembelajaran yang terkait dengan PkM', 'b', '-', '0', 1, '2022-01-13 15:45:27'),
(934, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Dosen pada Program Studi Diploma 4 wajib  menambahkan bentuk pembelajaran yang berupa berupa Pengabdian kepada Masyarakat sebagai kegiatan mahasiswa di bawah bimbingan Dosen dalam rangka memanfaatkan ilmu pengetahuan dan teknologi untuk memajukan kesejahteraan masyarakat dan mencerdaskan kehidupan bangsa yang pelaksanaannya dievaluasi pada setiap akhir semester', '21', 'Tersedianya hasil laporan evaluasi proses pembelajaran yang terkait dengan PkM', 'b', 'Dokumen', 'Laporan hasil evaluasi proses pembelajaran yang terkait dengan PkM', 1, '2022-01-13 15:46:01'),
(935, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Ketua Jurusan/Kepala Program Studi harus memastikan setiap Dosen harus harus hadir memberikan  kuliah untuk setiap matakuliah yang diampunya minimal 15 minggu dalam setiap semester', '22', '0', '0', '0', '0', 1, '2022-01-13 15:46:29'),
(936, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Ketua Jurusan/Kepala Program Studi harus memastikan setiap Dosen harus harus hadir memberikan  kuliah untuk setiap matakuliah yang diampunya minimal 15 minggu dalam setiap semester', '22', 'Tersedianya bukti sahih terkait kehadiran Dosen dalam memberikan  kuliah untuk setiap matakuliah yang diampunya minimal 15 minggu ', 'a', '-', '0', 1, '2022-01-13 15:46:58'),
(937, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Ketua Jurusan/Kepala Program Studi harus memastikan setiap Dosen harus harus hadir memberikan  kuliah untuk setiap matakuliah yang diampunya minimal 15 minggu dalam setiap semester', '22', 'Tersedianya bukti sahih terkait kehadiran Dosen dalam memberikan  kuliah untuk setiap matakuliah yang diampunya minimal 15 minggu ', 'a', 'Dokumen', 'Dokumen pelaksanaan proses pembelajaran dan monitoring pembelajaran', 1, '2022-01-13 15:47:17'),
(938, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Direktur harus menetapkan kebijakan suasana akademik yang komprehensif dan rinci yang mencakup: otonomi keilmuan, kebebasan akademik, dan kebebasan mimbar akademik', '23', '0', '0', '0', '0', 1, '2022-01-13 15:47:49'),
(939, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Direktur harus menetapkan kebijakan suasana akademik yang komprehensif dan rinci yang mencakup: otonomi keilmuan, kebebasan akademik, dan kebebasan mimbar akademik', '23', 'Tersedianya dokumen formal kebijakan suasana akademik yang mencakup: otonomi keilmuan, kebebasan akademik, dan kebebasan mimbar akademik', 'a', '-', '0', 1, '2022-01-13 15:48:20'),
(940, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Direktur harus menetapkan kebijakan suasana akademik yang komprehensif dan rinci yang mencakup: otonomi keilmuan, kebebasan akademik, dan kebebasan mimbar akademik', '23', 'Tersedianya dokumen formal kebijakan suasana akademik yang mencakup: otonomi keilmuan, kebebasan akademik, dan kebebasan mimbar akademik', 'a', 'Dokumen', 'Kebijakan suasana akademik yang mencakup: otonomi keilmuan, kebebasan akademik, dan kebebasan mimbar akademik', 1, '2022-01-13 15:48:39'),
(941, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Direktur harus menetapkan kebijakan suasana akademik yang komprehensif dan rinci yang mencakup: otonomi keilmuan, kebebasan akademik, dan kebebasan mimbar akademik', '23', 'Tersedianya bukti yang sahih tentang terbangunnya suasana akademik yang kondusif ', 'b', '-', '0', 1, '2022-01-13 15:49:05'),
(942, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Direktur harus menetapkan kebijakan suasana akademik yang komprehensif dan rinci yang mencakup: otonomi keilmuan, kebebasan akademik, dan kebebasan mimbar akademik', '23', 'Tersedianya bukti yang sahih tentang terbangunnya suasana akademik yang kondusif ', 'b', 'Dokumen', 'Dokumentasi dan laporan kegiatan membangun suasana akademik ', 1, '2022-01-13 15:49:23'),
(943, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Direktur bersama Wakil Direktur I, II, III dan IV harus berkoordinasi untuk melakukan analisis dan perencanaan strategis pengembangan suasana akademik dan implementasinya secara efektif dan efisien ', '24', '0', '0', '0', '0', 1, '2022-01-13 15:50:01'),
(944, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Direktur bersama Wakil Direktur I, II, III dan IV harus berkoordinasi untuk melakukan analisis dan perencanaan strategis pengembangan suasana akademik dan implementasinya secara efektif dan efisien ', '24', 'Tersedianya bukti sahih terkait analisis dan perencanaan strategis pengembangan suasana akademik dan implementasinya secara efektif dan efisien ', 'a', '-', '0', 1, '2022-01-13 15:50:27'),
(945, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Direktur bersama Wakil Direktur I, II, III dan IV harus berkoordinasi untuk melakukan analisis dan perencanaan strategis pengembangan suasana akademik dan implementasinya secara efektif dan efisien ', '24', 'Tersedianya bukti sahih terkait analisis dan perencanaan strategis pengembangan suasana akademik dan implementasinya secara efektif dan efisien ', 'a', 'Dokumen', 'Analisis dan perencanaan strategis pengembangan suasana akademik dan implementasinya secara efektif dan efisien ', 1, '2022-01-13 15:50:46'),
(946, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Direktur harus menetapkan kebijakan tentang masa dan beban penyelenggaraan program pendidikan untuk semua jenjang program pendidikan  yang mengacu kepada SN-DIKTI  dilakukan peninjauan untuk menyesuaikannya dengan perubahan peraturan perundang-perundangan pendidikan tinggi khususnya pendidikan vokasi', '25', '0', '0', '0', '0', 1, '2022-01-13 15:51:25'),
(947, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Direktur harus menetapkan kebijakan tentang masa dan beban penyelenggaraan program pendidikan untuk semua jenjang program pendidikan  yang mengacu kepada SN-DIKTI  dilakukan peninjauan untuk menyesuaikannya dengan perubahan peraturan perundang-perundangan pendidikan tinggi khususnya pendidikan vokasi', '25', 'Tersedia kebijakan tentang masa dan beban penyelenggaraan program pendidikan untuk semua jenjang program pendidikan  yang mengacu kepada SN-DIKTI  dan dilakukan peninjauan untuk menyesuaikannya dengan perubahan peraturan perundang-undangan ', 'a', '-', '0', 1, '2022-01-13 15:51:47'),
(948, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Direktur harus menetapkan kebijakan tentang masa dan beban penyelenggaraan program pendidikan untuk semua jenjang program pendidikan  yang mengacu kepada SN-DIKTI  dilakukan peninjauan untuk menyesuaikannya dengan perubahan peraturan perundang-perundangan pendidikan tinggi khususnya pendidikan vokasi', '25', 'Tersedia kebijakan tentang masa dan beban penyelenggaraan program pendidikan untuk semua jenjang program pendidikan  yang mengacu kepada SN-DIKTI  dan dilakukan peninjauan untuk menyesuaikannya dengan perubahan peraturan perundang-undangan ', 'a', 'Dokumen', 'Kebijakan tentang masa dan beban penyelenggaraan program pendidikan/Buku Peraturan Akademik Politeknik Negeri Medan', 1, '2022-01-13 15:52:03'),
(949, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Wakil Direktur I harus mensosialisasikan kebijakan tentang masa dan beban penyelenggaraan program pendidikan untuk semua jenjang program pendidikan pada setiap awal tahun akademik', '26', '0', '0', '0', '0', 1, '2022-01-13 15:52:38'),
(950, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Wakil Direktur I harus mensosialisasikan kebijakan tentang masa dan beban penyelenggaraan program pendidikan untuk semua jenjang program pendidikan pada setiap awal tahun akademik', '26', 'Tersosialisasinya kebijakan tentang masa dan beban penyelenggaraan program pendidikan untuk semua jenjang program pendidikan  ', 'a', '-', '0', 1, '2022-01-13 15:53:17'),
(951, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Wakil Direktur I harus mensosialisasikan kebijakan tentang masa dan beban penyelenggaraan program pendidikan untuk semua jenjang program pendidikan pada setiap awal tahun akademik', '26', 'Tersosialisasinya kebijakan tentang masa dan beban penyelenggaraan program pendidikan untuk semua jenjang program pendidikan  ', 'a', 'Dokumen', 'Laporan kegiatan sosialisasi kebijakan masa dan penyelenggaraan program pendidika', 1, '2022-01-13 15:53:51'),
(952, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Direktur wajib memfasilitasi pelaksanaan pemenuhan masa dan beban belajar dalam proses Pembelajaran sesuai dengan SN Dikti dan peraturan yang berlaku di Lingkungan Politeknik Negeri Medan dan dilakukan evaluasi pada setiap akhir tahun akademik', '27', '0', '0', '0', '0', 1, '2022-01-13 15:54:21'),
(953, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Direktur wajib memfasilitasi pelaksanaan pemenuhan masa dan beban belajar dalam proses Pembelajaran sesuai dengan SN Dikti dan peraturan yang berlaku di Lingkungan Politeknik Negeri Medan dan dilakukan evaluasi pada setiap akhir tahun akademik', '27', 'Tersedianya bukti sahih terkait fasilitasi pelaksanaan pemenuhan masa dan  beban belajar ', 'a', '-', '0', 1, '2022-01-13 15:54:47'),
(954, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Direktur wajib memfasilitasi pelaksanaan pemenuhan masa dan beban belajar dalam proses Pembelajaran sesuai dengan SN Dikti dan peraturan yang berlaku di Lingkungan Politeknik Negeri Medan dan dilakukan evaluasi pada setiap akhir tahun akademik', '27', 'Tersedianya bukti sahih terkait fasilitasi pelaksanaan pemenuhan masa dan  beban belajar ', 'a', 'Dokumen', 'Kebijakan dan pedoman terkait pelaksanaan pemenuhan masa dan beban belajar ', 1, '2022-01-13 15:55:04'),
(955, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Direktur wajib memfasilitasi pelaksanaan pemenuhan masa dan beban belajar dalam proses Pembelajaran sesuai dengan SN Dikti dan peraturan yang berlaku di Lingkungan Politeknik Negeri Medan dan dilakukan evaluasi pada setiap akhir tahun akademik', '27', 'Tersedianya bukti sahih terkait telah terevaluasinya fasilitasi pelaksanaan pemenuhan masa dan beban belajar', 'b', '-', '0', 1, '2022-01-13 15:56:10'),
(956, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Direktur wajib memfasilitasi pelaksanaan pemenuhan masa dan beban belajar dalam proses Pembelajaran sesuai dengan SN Dikti dan peraturan yang berlaku di Lingkungan Politeknik Negeri Medan dan dilakukan evaluasi pada setiap akhir tahun akademik', '27', 'Tersedianya bukti sahih terkait telah terevaluasinya fasilitasi pelaksanaan pemenuhan masa dan beban belajar', 'b', 'Dokumen', 'Laporan hasil evaluasi terkait fasilitasi pelaksanaan pemenuhan masa dan beban belajar', 1, '2022-01-13 15:56:27'),
(957, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Direktur harus memenuhi kebutuhan sistem dan layanan akademik online pada semua program studi pada setiap awal semester', '28', '0', '0', '0', '0', 1, '2022-01-13 15:56:59'),
(958, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Direktur harus memenuhi kebutuhan sistem dan layanan akademik online pada semua program studi pada setiap awal semester', '28', 'Tersedianya sahih terkait pemenuhan kebutuhan sisten dan layanan akademik online pada semua program studi', 'a', '-', '0', 1, '2022-01-13 15:57:19');
INSERT INTO `standar` (`standarid`, `kodestandar`, `namastandar`, `namasubstandar`, `kodesubstandar`, `namapernyataan`, `kodepernyataan`, `namaindikator`, `kodeindikator`, `catatanindikator`, `namadokumen`, `userid`, `createdDate`) VALUES
(959, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Direktur harus memenuhi kebutuhan sistem dan layanan akademik online pada semua program studi pada setiap awal semester', '28', 'Tersedianya sahih terkait pemenuhan kebutuhan sisten dan layanan akademik online pada semua program studi', 'a', 'Dokumen', 'Aplikasi SIAKAD, SIPADI', 1, '2022-01-13 15:57:47'),
(960, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'Direktur harus memenuhi kebutuhan sistem dan layanan akademik online pada semua program studi pada setiap awal semester', '28', 'Tersedianya sahih terkait pemenuhan kebutuhan sisten dan layanan akademik online pada semua program studi', 'a', 'Dokumen', 'Pedoman penggunaan aplikasi', 1, '2022-01-13 15:58:05'),
(961, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'SPMI harus  melaksanakan monitoring, evaluasi, pengendalian dan peningkatan terhadap proses pembelajaran dari semua program studi di Politeknik Negeri Medan  di setiap akhir tahun akademik', '29', '0', '0', '0', '0', 1, '2022-01-13 15:58:40'),
(962, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'SPMI harus  melaksanakan monitoring, evaluasi, pengendalian dan peningkatan terhadap proses pembelajaran dari semua program studi di Politeknik Negeri Medan  di setiap akhir tahun akademik', '29', 'Tersedianya  lingkup Audit Mutu Internal (AMI)', 'a', '-', '0', 1, '2022-01-13 15:59:05'),
(963, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR ISI PEMBELAJARAN', 'STD-01.02/SPMI', 'SPMI harus  melaksanakan monitoring, evaluasi, pengendalian dan peningkatan terhadap isi pembelajaran dari semua program studi di Politeknik Negeri Medan  di setiap akhir tahun akademik', '12', 'Tersedianya  lingkup Audit Mutu Internal (AMI)', 'a', 'Dokumen', 'Lingkup AMI.', 1, '2022-01-13 15:59:29'),
(964, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'SPMI harus  melaksanakan monitoring, evaluasi, pengendalian dan peningkatan terhadap proses pembelajaran dari semua program studi di Politeknik Negeri Medan  di setiap akhir tahun akademik', '29', 'Tersedianya jadwal pelaksanaan AMI', 'b', '-', '0', 1, '2022-01-13 16:00:01'),
(965, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR ISI PEMBELAJARAN', 'STD-01.02/SPMI', 'SPMI harus  melaksanakan monitoring, evaluasi, pengendalian dan peningkatan terhadap isi pembelajaran dari semua program studi di Politeknik Negeri Medan  di setiap akhir tahun akademik', '12', 'Tersedianya jadwal pelaksanaan AMI', 'b', 'Dokumen', 'Jadwal pelaksanaan AMI.', 1, '2022-01-13 16:01:12'),
(966, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'SPMI harus  melaksanakan monitoring, evaluasi, pengendalian dan peningkatan terhadap proses pembelajaran dari semua program studi di Politeknik Negeri Medan  di setiap akhir tahun akademik', '29', 'Tersedianya penugasan (SK) Auditor AMI', 'c', '-', '0', 1, '2022-01-13 16:01:32'),
(967, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Direktur melakukan kegiatan pemantauan/evaluasi mutu lulusan secara rutin minimal 1 kali per tahun dengan melibatkan SPMI, AMI, dan GKMIJ. ', '49', 'Tersedianya penugasan (SK) Auditor AMI', 'c', 'Dokumen', 'Surat Keputusan Auditor AMI.', 1, '2022-01-13 16:02:13'),
(968, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'SPMI harus  melaksanakan monitoring, evaluasi, pengendalian dan peningkatan terhadap proses pembelajaran dari semua program studi di Politeknik Negeri Medan  di setiap akhir tahun akademik', '29', 'Tersedianya bukti sahih pelaksanaan AMI (Audit dokumen dan Audit Lapangan)', 'd', '-', '0', 1, '2022-01-13 16:03:45'),
(969, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Direktur melakukan kegiatan pemantauan/evaluasi mutu lulusan secara rutin minimal 1 kali per tahun dengan melibatkan SPMI, AMI, dan GKMIJ. ', '49', 'Tersedianya bukti sahih pelaksanaan AMI (Audit dokumen dan Audit Lapangan)', 'd', 'Dokumen', 'Laporan Audit.', 1, '2022-01-13 16:04:07'),
(970, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'SPMI harus  melaksanakan monitoring, evaluasi, pengendalian dan peningkatan terhadap proses pembelajaran dari semua program studi di Politeknik Negeri Medan  di setiap akhir tahun akademik', '29', 'Terlaksananya Rapat Tinjauan Manajemen (RTM)', 'e', '-', '0', 1, '2022-01-13 16:04:38'),
(971, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Direktur melakukan kegiatan pemantauan/evaluasi mutu lulusan secara rutin minimal 1 kali per tahun dengan melibatkan SPMI, AMI, dan GKMIJ. ', '49', 'Terlaksananya Rapat Tinjauan Manajemen (RTM)', 'e', 'Dokumen', 'Jadwal pelaksanaan Rapat Tinjauan Manajemen dan dokumentasi', 1, '2022-01-13 16:05:24'),
(972, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'SPMI harus  melaksanakan monitoring, evaluasi, pengendalian dan peningkatan terhadap proses pembelajaran dari semua program studi di Politeknik Negeri Medan  di setiap akhir tahun akademik', '29', 'Tersedianya Hasil RTM (peningkatan efektivitas SPMI dan prosesnya)', 'f', '-', '0', 1, '2022-01-13 16:05:55'),
(973, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Direktur melakukan kegiatan pemantauan/evaluasi mutu lulusan secara rutin minimal 1 kali per tahun dengan melibatkan SPMI, AMI, dan GKMIJ. ', '49', 'Tersedianya Hasil RTM (peningkatan efektivitas SPMI dan prosesnya)', 'f', 'Dokumen', 'Hasil Rapat Tinjauan Manajemen (Peningkatan efektivitas SPMI dan prosesnya).', 1, '2022-01-13 16:06:31'),
(974, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PROSES PEMBELAJARAN', 'STD-01.03/SPMI', 'SPMI harus  melaksanakan monitoring, evaluasi, pengendalian dan peningkatan terhadap proses pembelajaran dari semua program studi di Politeknik Negeri Medan  di setiap akhir tahun akademik', '29', 'Terlaksananya perbaikan mutu secara berkelanjutan (Continuous Quality Improvement/CQI)', 'g', '-', '0', 1, '2022-01-13 16:06:56'),
(975, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Direktur melakukan kegiatan pemantauan/evaluasi mutu lulusan secara rutin minimal 1 kali per tahun dengan melibatkan SPMI, AMI, dan GKMIJ. ', '49', 'Terlaksananya perbaikan mutu secara berkelanjutan (Continuous Quality Improvement/CQI)', 'g', 'Dokumen', 'CQI atau Kaizen', 1, '2022-01-13 16:07:19'),
(976, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PENILAIAN PEMBELAJARAN', 'STD-01.04/SPMI', '0', '0', '0', '0', '0', '0', 1, '2022-01-14 09:27:07'),
(977, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PENILAIAN PEMBELAJARAN', 'STD-01.04/SPMI', 'Wakil Direktur I harus menetapkan pedoman  penilaian pembelajaran dan kelulusan mahasiswa  dan dilakukan peninjauan pada setiap awal tahun akademik', '1', '0', '0', '0', '0', 1, '2022-01-14 09:27:27'),
(978, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PENILAIAN PEMBELAJARAN', 'STD-01.04/SPMI', 'Wakil Direktur I harus menetapkan pedoman  penilaian pembelajaran dan kelulusan mahasiswa  dan dilakukan peninjauan pada setiap awal tahun akademik', '1', 'Tersedia pedoman  penilaian pembelajaran yang mencakup prinsip penilaian, teknik dan instrumen penilaian, mekanisme dan prosedur penilaian, pelaporan penilaian dan kelulusan mahasiswa', 'a', '-', '0', 1, '2022-01-14 09:27:49'),
(979, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PENILAIAN PEMBELAJARAN', 'STD-01.04/SPMI', 'Wakil Direktur I harus menetapkan pedoman  penilaian pembelajaran dan kelulusan mahasiswa  dan dilakukan peninjauan pada setiap awal tahun akademik', '1', 'Tersedia pedoman  penilaian pembelajaran yang mencakup prinsip penilaian, teknik dan instrumen penilaian, mekanisme dan prosedur penilaian, pelaporan penilaian dan kelulusan mahasiswa', 'a', 'Dokumen', ' Pedoman  penilaian pembelajaran yang mencakup prinsip penilaian, teknik dan instrumen penilaian, mekanisme dan prosedur penilaian, pelaporan penilaian dan kelulusan mahasiswa ', 1, '2022-01-14 09:28:07'),
(980, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PENILAIAN PEMBELAJARAN', 'STD-01.04/SPMI', 'Wakil Direktur I harus menetapkan pedoman  penilaian pembelajaran dan kelulusan mahasiswa  dan dilakukan peninjauan pada setiap awal tahun akademik', '1', 'Tersedianya bukti peninjauan terhadap pedoman penilaian pembelajaran pada setiap awal tahun akademik ', 'b', '-', '0', 1, '2022-01-14 09:28:31'),
(981, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PENILAIAN PEMBELAJARAN', 'STD-01.04/SPMI', 'Wakil Direktur I harus menetapkan pedoman  penilaian pembelajaran dan kelulusan mahasiswa  dan dilakukan peninjauan pada setiap awal tahun akademik', '1', 'Tersedianya bukti peninjauan terhadap pedoman penilaian pembelajaran pada setiap awal tahun akademik ', 'b', 'Dokumen', 'Laporan kegaiatan Peninjauan pedoman penilaian pembelajaran', 1, '2022-01-14 09:28:48'),
(982, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PENILAIAN PEMBELAJARAN', 'STD-01.04/SPMI', 'Wakil Direktur I harus  mensosialisasikan pedoman penilaian pembelajaran dan kelulusan  kepada seluruh dosen minimal satu kali pada setiap awal tahun akademik', '2', '0', '0', '0', '0', 1, '2022-01-14 09:29:25'),
(983, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PENILAIAN PEMBELAJARAN', 'STD-01.04/SPMI', 'Wakil Direktur I harus  mensosialisasikan pedoman penilaian pembelajaran dan kelulusan  kepada seluruh dosen minimal satu kali pada setiap awal tahun akademik', '2', 'Tersosialisasinya pedoman penilaian pembelajaran kepada seluruh dosen', 'a', '-', '0', 1, '2022-01-14 09:29:56'),
(984, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PENILAIAN PEMBELAJARAN', 'STD-01.04/SPMI', 'Wakil Direktur I harus  mensosialisasikan pedoman penilaian pembelajaran dan kelulusan  kepada seluruh dosen minimal satu kali pada setiap awal tahun akademik', '2', 'Tersosialisasinya pedoman penilaian pembelajaran kepada seluruh dosen', 'a', 'Dokumen', 'Laporan kegiatan sosialisasi pedoman penilaian pembelajaran ', 1, '2022-01-14 09:30:13'),
(985, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PENILAIAN PEMBELAJARAN', 'STD-01.04/SPMI', 'Ketua Jurusan/Kepala Program Studi harus memastikan Dosen menerapkan prinsip, teknik dan instrumen penilaian proses dan hasil belajar mahasiswa pada setiap mata kuliah yang diiampunya pada setiap semester', '3', '0', '0', '0', '0', 1, '2022-01-14 09:30:38'),
(986, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PENILAIAN PEMBELAJARAN', 'STD-01.04/SPMI', 'Ketua Jurusan/Kepala Program Studi harus memastikan Dosen menerapkan prinsip, teknik dan instrumen penilaian proses dan hasil belajar mahasiswa pada setiap mata kuliah yang diiampunya pada setiap semester', '3', 'Tersedianya bukti dosen menerapkan prinsip  penilaian pembelajaran pada setiap mata kuliah yang diampunya pada setiap semester', 'a', '-', '0', 1, '2022-01-14 09:31:10'),
(987, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PENILAIAN PEMBELAJARAN', 'STD-01.04/SPMI', 'Ketua Jurusan/Kepala Program Studi harus memastikan Dosen menerapkan prinsip, teknik dan instrumen penilaian proses dan hasil belajar mahasiswa pada setiap mata kuliah yang diiampunya pada setiap semester', '3', 'Tersedianya bukti dosen menerapkan prinsip  penilaian pembelajaran pada setiap mata kuliah yang diampunya pada setiap semester', 'a', 'Dokumen', 'Formulir penilaian pembelajaran', 1, '2022-01-14 09:31:30'),
(988, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PENILAIAN PEMBELAJARAN', 'STD-01.04/SPMI', 'Ketua Jurusan/Kepala Program Studi harus memastikan Dosen menerapkan prinsip, teknik dan instrumen penilaian proses dan hasil belajar mahasiswa pada setiap mata kuliah yang diiampunya pada setiap semester', '3', 'Tersedianya bukti dosen menerapkan prinsip  penilaian pembelajaran pada setiap mata kuliah yang diampunya pada setiap semester', 'a', 'Dokumen', 'RPS', 1, '2022-01-14 09:31:50'),
(989, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PENILAIAN PEMBELAJARAN', 'STD-01.04/SPMI', 'Ketua Jurusan/Kepala Program Studi harus memastikan Dosen melaksanakan proses penilaian sesuai dengan tahap, kriteria, indikator, dan bobot penilaian yang memuat prinsip penilaian, memberikan umpan balik dan kesempatan untuk mempertanyakan hasil penilaian kepada mahasiswa, dan mendokumentasikan penilaian proses dan hasil belajar mahasiswa secara akuntabel dan transparan pada setiap akhir semester', '4', '0', '0', '0', '0', 1, '2022-01-14 09:33:01'),
(990, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PENILAIAN PEMBELAJARAN', 'STD-01.04/SPMI', 'Ketua Jurusan/Kepala Program Studi harus memastikan Dosen melaksanakan proses penilaian sesuai dengan tahap, kriteria, indikator, dan bobot penilaian yang memuat prinsip penilaian, memberikan umpan balik dan kesempatan untuk mempertanyakan hasil penilaian kepada mahasiswa, dan mendokumentasikan penilaian proses dan hasil belajar mahasiswa secara akuntabel dan transparan pada setiap akhir semester', '4', 'Terlaksananya proses penilaian sesuai dengan tahap, kriteria, indikator, dan bobot penilaian yang memuat prinsip penilaian, umpan balik, dan dokumentasi penilaian proses dan hasil belajar mahasiswa', 'a', '-', '0', 1, '2022-01-14 09:33:33'),
(991, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PENILAIAN PEMBELAJARAN', 'STD-01.04/SPMI', 'Ketua Jurusan/Kepala Program Studi harus memastikan Dosen melaksanakan proses penilaian sesuai dengan tahap, kriteria, indikator, dan bobot penilaian yang memuat prinsip penilaian, memberikan umpan balik dan kesempatan untuk mempertanyakan hasil penilaian kepada mahasiswa, dan mendokumentasikan penilaian proses dan hasil belajar mahasiswa secara akuntabel dan transparan pada setiap akhir semester', '4', 'Terlaksananya proses penilaian sesuai dengan tahap, kriteria, indikator, dan bobot penilaian yang memuat prinsip penilaian, umpan balik, dan dokumentasi penilaian proses dan hasil belajar mahasiswa', 'a', 'Dokumen', 'Formulir penilaian proses dan hasil belajar mahasiswa', 1, '2022-01-14 09:33:56'),
(992, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PENILAIAN PEMBELAJARAN', 'STD-01.04/SPMI', 'Ketua Jurusan/Kepala Program Studi harus memastikan Dosen melaksanakan proses penilaian sesuai dengan tahap, kriteria, indikator, dan bobot penilaian yang memuat prinsip penilaian, memberikan umpan balik dan kesempatan untuk mempertanyakan hasil penilaian kepada mahasiswa, dan mendokumentasikan penilaian proses dan hasil belajar mahasiswa secara akuntabel dan transparan pada setiap akhir semester', '4', 'Terlaksananya proses penilaian sesuai dengan tahap, kriteria, indikator, dan bobot penilaian yang memuat prinsip penilaian, umpan balik, dan dokumentasi penilaian proses dan hasil belajar mahasiswa', 'a', 'Dokumen', 'Kontrak Materi Perkuliahan', 1, '2022-01-14 09:34:20'),
(993, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PENILAIAN PEMBELAJARAN', 'STD-01.04/SPMI', 'Ketua Jurusan/Kepala Program Studi harus memastikan Dosen melaksanakan proses penilaian sesuai dengan tahap, kriteria, indikator, dan bobot penilaian yang memuat prinsip penilaian, memberikan umpan balik dan kesempatan untuk mempertanyakan hasil penilaian kepada mahasiswa, dan mendokumentasikan penilaian proses dan hasil belajar mahasiswa secara akuntabel dan transparan pada setiap akhir semester', '4', 'Terlaksananya proses penilaian sesuai dengan tahap, kriteria, indikator, dan bobot penilaian yang memuat prinsip penilaian, umpan balik, dan dokumentasi penilaian proses dan hasil belajar mahasiswa', 'a', 'Dokumen', 'RPS', 1, '2022-01-14 09:34:42'),
(994, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PENILAIAN PEMBELAJARAN', 'STD-01.04/SPMI', 'Kajur/Kepala Program Studi harus dapat memastikan pelaksanaan penilaian dilakukan oleh Dosen pengampu atau tim Dosen pengampu, atau tim Dosen Pengampu dan mahasiswa, dalam rangka pemenuhan capaian Pembelajaran lulusan pada setiap semester', '5', '0', '0', '0', '0', 1, '2022-01-14 09:35:16'),
(995, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PENILAIAN PEMBELAJARAN', 'STD-01.04/SPMI', 'Kajur/Kepala Program Studi harus dapat memastikan pelaksanaan penilaian dilakukan oleh Dosen pengampu atau tim Dosen pengampu, atau tim Dosen Pengampu dan mahasiswa, dalam rangka pemenuhan capaian Pembelajaran lulusan pada setiap semester', '5', 'Tersedianya bukti sahih pelaksanaan penilaian dalam rangka pemenuhan capaian Pembelajaran lulusan', 'a', '-', '0', 1, '2022-01-14 09:35:36'),
(996, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PENILAIAN PEMBELAJARAN', 'STD-01.04/SPMI', 'Kajur/Kepala Program Studi harus dapat memastikan pelaksanaan penilaian dilakukan oleh Dosen pengampu atau tim Dosen pengampu, atau tim Dosen Pengampu dan mahasiswa, dalam rangka pemenuhan capaian Pembelajaran lulusan pada setiap semester', '5', 'Tersedianya bukti sahih pelaksanaan penilaian dalam rangka pemenuhan capaian Pembelajaran lulusan', 'a', 'Dokumen', 'Formulir Penilaian proses dan hasil belajar mahasiswa', 1, '2022-01-14 09:35:54'),
(997, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PENILAIAN PEMBELAJARAN', 'STD-01.04/SPMI', 'Ketua Jurusan/Kepala Program Studi harus memberikan pelaporan penilaian berupa kualifikasi keberhasilan mahasiswa dalam menempuh suatu mata kuliah yang dinyatakan dalam kisaran huruf A sampai huruf E pada setiap akhir semester', '6', '0', '0', '0', '0', 1, '2022-01-14 09:36:14'),
(998, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PENILAIAN PEMBELAJARAN', 'STD-01.04/SPMI', 'Ketua Jurusan/Kepala Program Studi harus memberikan pelaporan penilaian berupa kualifikasi keberhasilan mahasiswa dalam menempuh suatu mata kuliah yang dinyatakan dalam kisaran huruf A sampai huruf E pada setiap akhir semester', '6', 'Terlaksananya pelaporan penilaian  keberhasilan mahasiswa dalam menempuh suatu mata kuliah', 'a', '-', '0', 1, '2022-01-14 09:36:34'),
(999, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PENILAIAN PEMBELAJARAN', 'STD-01.04/SPMI', 'Ketua Jurusan/Kepala Program Studi harus memberikan pelaporan penilaian berupa kualifikasi keberhasilan mahasiswa dalam menempuh suatu mata kuliah yang dinyatakan dalam kisaran huruf A sampai huruf E pada setiap akhir semester', '6', 'Terlaksananya pelaporan penilaian  keberhasilan mahasiswa dalam menempuh suatu mata kuliah', 'a', 'Dokumen', 'Laporan kegiatan rapat evaluasi tingkat jurusan ', 1, '2022-01-14 09:36:51'),
(1000, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PENILAIAN PEMBELAJARAN', 'STD-01.04/SPMI', 'Ketua Jurusan/Kepala Program Studi harus memberikan pelaporan penilaian berupa kualifikasi keberhasilan mahasiswa dalam menempuh suatu mata kuliah yang dinyatakan dalam kisaran huruf A sampai huruf E pada setiap akhir semester', '6', 'Tersedianya bukti sahih pelaporan penilaian keberhasilan mahasiswa ', 'b', '-', '0', 1, '2022-01-14 09:37:19'),
(1001, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PENILAIAN PEMBELAJARAN', 'STD-01.04/SPMI', 'Ketua Jurusan/Kepala Program Studi harus memberikan pelaporan penilaian berupa kualifikasi keberhasilan mahasiswa dalam menempuh suatu mata kuliah yang dinyatakan dalam kisaran huruf A sampai huruf E pada setiap akhir semester', '6', 'Tersedianya bukti sahih pelaporan penilaian keberhasilan mahasiswa ', 'b', 'Dokumen', 'Laporan evaluasi akhir setiap program studi', 1, '2022-01-14 09:37:39'),
(1002, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PENILAIAN PEMBELAJARAN', 'STD-01.04/SPMI', 'Ketua Jurusan/Kepala Program Studi harus memberikan pelaporan penilaian berupa kualifikasi keberhasilan mahasiswa dalam menempuh suatu mata kuliah yang dinyatakan dalam kisaran huruf A sampai huruf E pada setiap akhir semester', '6', 'Tersedianya pengumuman penilaian keberhasilan mahasiswa pada Web resmi Jurusan/Institusi', 'c', '-', '0', 1, '2022-01-14 09:38:02'),
(1003, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PENILAIAN PEMBELAJARAN', 'STD-01.04/SPMI', 'Ketua Jurusan/Kepala Program Studi harus memberikan pelaporan penilaian berupa kualifikasi keberhasilan mahasiswa dalam menempuh suatu mata kuliah yang dinyatakan dalam kisaran huruf A sampai huruf E pada setiap akhir semester', '6', 'Tersedianya pengumuman penilaian keberhasilan mahasiswa pada Web resmi Jurusan/Institusi', 'c', 'Dokumen', 'Pelaporan niliai pada Web resmi Jurusan/Institusi', 1, '2022-01-14 09:38:24'),
(1004, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PENILAIAN PEMBELAJARAN', 'STD-01.04/SPMI', 'Wakil Direktur I harus menetapkan cara penghitungan Indeks Prestasi Semester (IPS) dan Indeks Prestasi Kumulatif mengacu pada SN Dikti untuk penilaian keberhasilan proses belajar mahasiswa', '7', '0', '0', '0', '0', 1, '2022-01-14 09:39:17'),
(1005, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PENILAIAN PEMBELAJARAN', 'STD-01.04/SPMI', 'Wakil Direktur I harus menetapkan cara penghitungan Indeks Prestasi Semester (IPS) dan Indeks Prestasi Kumulatif mengacu pada SN Dikti untuk penilaian keberhasilan proses belajar mahasiswa', '7', 'Tersedianya cara penghitungan Indeks Prestasi Semester (IPS) dan Indeks Prestasi Kumulatif mengacu pada SN Dikti untuk penilaian keberhasilan proses belajar mahasiswa', 'a', '-', '0', 1, '2022-01-14 09:39:41'),
(1006, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PENILAIAN PEMBELAJARAN', 'STD-01.04/SPMI', 'Wakil Direktur I harus menetapkan cara penghitungan Indeks Prestasi Semester (IPS) dan Indeks Prestasi Kumulatif mengacu pada SN Dikti untuk penilaian keberhasilan proses belajar mahasiswa', '7', 'Tersedianya cara penghitungan Indeks Prestasi Semester (IPS) dan Indeks Prestasi Kumulatif mengacu pada SN Dikti untuk penilaian keberhasilan proses belajar mahasiswa', 'a', 'Dokumen', 'Buku Peraturan Akademik Politeknik Negeri Medan', 1, '2022-01-14 09:39:58'),
(1007, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PENILAIAN PEMBELAJARAN', 'STD-01.04/SPMI', 'Mahasiswa program Diploma 3 dinyatakan lulus apabila telah menempuh seluruh beban belajar yang ditetapkan dan memiliki capaian Pembelajaran lulusan yang ditargetkan oleh Program Studi dengan Indeks Prestasi Kumulatif (IPK) lebih besar atau sama dengan 2,00 (dua koma nol nol).', '8', '0', '0', '0', '0', 1, '2022-01-14 09:41:30'),
(1008, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PENILAIAN PEMBELAJARAN', 'STD-01.04/SPMI', 'Mahasiswa program Diploma 3 dinyatakan lulus apabila telah menempuh seluruh beban belajar yang ditetapkan dan memiliki capaian Pembelajaran lulusan yang ditargetkan oleh Program Studi dengan Indeks Prestasi Kumulatif (IPK) lebih besar atau sama dengan 2,00 (dua koma nol nol).', '8', 'Tersedianya bukti sahih terkait kelulusan mahasiswa sesuai dengan peraturan yang berlaku', 'a', '-', '0', 1, '2022-01-14 09:42:28'),
(1009, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PENILAIAN PEMBELAJARAN', 'STD-01.04/SPMI', 'Mahasiswa program Diploma 3 dinyatakan lulus apabila telah menempuh seluruh beban belajar yang ditetapkan dan memiliki capaian Pembelajaran lulusan yang ditargetkan oleh Program Studi dengan Indeks Prestasi Kumulatif (IPK) lebih besar atau sama dengan 2,00 (dua koma nol nol).', '8', 'Tersedianya bukti sahih terkait kelulusan mahasiswa sesuai dengan peraturan yang berlaku', 'a', 'Dokumen', 'Marksheet dan Laporan Akhir Evaluasi Program Studi', 1, '2022-01-14 09:42:47'),
(1010, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PENILAIAN PEMBELAJARAN', 'STD-01.04/SPMI', 'Wakil Direktur I harus memastikan Mahasiswa yang dinyatakan lulus berhak memperoleh: ijazah, dan sertifikat kompetensi sesuai dengan keahlian dalam cabang ilmunya dan/atau memiliki prestasi di luar Program Studinya, gelar,  dan surat keterangan pendamping ijazah sesuai peraturan yang berlaku di Politeknik Negeri Medan', '9', '0', '0', '0', '0', 1, '2022-01-14 09:43:29'),
(1011, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PENILAIAN PEMBELAJARAN', 'STD-01.04/SPMI', 'Wakil Direktur I harus memastikan Mahasiswa yang dinyatakan lulus berhak memperoleh: ijazah, dan sertifikat kompetensi sesuai dengan keahlian dalam cabang ilmunya dan/atau memiliki prestasi di luar Program Studinya, gelar,  dan surat keterangan pendamping ijazah sesuai peraturan yang berlaku di Politeknik Negeri Medan', '9', 'Tersedianya bukti sahih berupa ijazah dan sertifikat kompetensi dan surat keterangan pendamping ijazah', 'a', '-', '0', 1, '2022-01-14 09:44:01'),
(1012, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PENILAIAN PEMBELAJARAN', 'STD-01.04/SPMI', 'Wakil Direktur I harus memastikan Mahasiswa yang dinyatakan lulus berhak memperoleh: ijazah, dan sertifikat kompetensi sesuai dengan keahlian dalam cabang ilmunya dan/atau memiliki prestasi di luar Program Studinya, gelar,  dan surat keterangan pendamping ijazah sesuai peraturan yang berlaku di Politeknik Negeri Medan', '9', 'Tersedianya bukti sahih berupa ijazah dan sertifikat kompetensi dan surat keterangan pendamping ijazah', 'a', 'Dokumen', 'Ijazah, sertifikat kompetensi, gelar dan surat keterangan pendamping ijazah', 1, '2022-01-14 09:44:22'),
(1013, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PENILAIAN PEMBELAJARAN', 'STD-01.04/SPMI', 'Ketua jurusan harus menyatakan mahasiswa lulus dari program pendidikan jika mahasiswa tersebut telah menempuh seluruh beban belajar yang ditetapkan dan memiliki capaian pembelajaran lulusan yang ditargetkan sesuai dengan Panduan Akademik Politeknik Negeri Medan untuk masing-masing jenjang pendidikan', '10', '0', '0', '0', '0', 1, '2022-01-14 09:44:56'),
(1014, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PENILAIAN PEMBELAJARAN', 'STD-01.04/SPMI', 'Ketua jurusan harus menyatakan mahasiswa lulus dari program pendidikan jika mahasiswa tersebut telah menempuh seluruh beban belajar yang ditetapkan dan memiliki capaian pembelajaran lulusan yang ditargetkan sesuai dengan Panduan Akademik Politeknik Negeri Medan untuk masing-masing jenjang pendidikan', '10', 'Tersedianya ijazah, sertifikat kompetensi, gelar dan surat keterangan pendamping ijazah', 'a', '-', '0', 1, '2022-01-14 09:45:18'),
(1015, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PENILAIAN PEMBELAJARAN', 'STD-01.04/SPMI', 'Ketua jurusan harus menyatakan mahasiswa lulus dari program pendidikan jika mahasiswa tersebut telah menempuh seluruh beban belajar yang ditetapkan dan memiliki capaian pembelajaran lulusan yang ditargetkan sesuai dengan Panduan Akademik Politeknik Negeri Medan untuk masing-masing jenjang pendidikan', '10', 'Tersedianya ijazah, sertifikat kompetensi, gelar dan surat keterangan pendamping ijazah', 'a', 'Dokumen', 'Ijazah, sertifikat kompetensi, gelar dan surat keterangan pendamping ijazah', 1, '2022-01-14 09:45:34'),
(1016, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PENILAIAN PEMBELAJARAN', 'STD-01.04/SPMI', 'Ketua Jurusan/Kepala Program Studi Diploma 3 dan Diploma 4 harus memastikan jumlah matakuliah yang dikembangkan berdasarkan hasil/integrasi kegiatan penelitian dan pengabdian kepada masyarakat dalam pembelajaran oleh dosen tetap program studi dalam 3 tahun terakhir ', '11', '0', '0', '0', '0', 1, '2022-01-14 10:01:36'),
(1017, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PENILAIAN PEMBELAJARAN', 'STD-01.04/SPMI', 'Ketua Jurusan/Kepala Program Studi Diploma 3 dan Diploma 4 harus memastikan jumlah matakuliah yang dikembangkan berdasarkan hasil/integrasi kegiatan penelitian dan pengabdian kepada masyarakat dalam pembelajaran oleh dosen tetap program studi dalam 3 tahun terakhir ', '11', 'Tersedianya bukti sahih terkait jumlah mata kuliah yang dikembangkan berdasarkan hasil/integrasi kegiatan penelitian dan pengabdian kepada masyarakat dalam pembelajaran oleh dosen tetap program studi dalam 3 tahun terakhir > 3 (Tabel 5.c LKPS)', 'a', '-', '0', 1, '2022-01-14 10:01:58'),
(1018, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PENILAIAN PEMBELAJARAN', 'STD-01.04/SPMI', 'Ketua Jurusan/Kepala Program Studi Diploma 3 dan Diploma 4 harus memastikan jumlah matakuliah yang dikembangkan berdasarkan hasil/integrasi kegiatan penelitian dan pengabdian kepada masyarakat dalam pembelajaran oleh dosen tetap program studi dalam 3 tahun terakhir ', '11', 'Tersedianya bukti sahih terkait jumlah mata kuliah yang dikembangkan berdasarkan hasil/integrasi kegiatan penelitian dan pengabdian kepada masyarakat dalam pembelajaran oleh dosen tetap program studi dalam 3 tahun terakhir > 3 (Tabel 5.c LKPS)', 'a', 'Dokumen', 'Laporan jumlah mata kuliah yang dikembangkan berdasarkan hasil/integrasi kegiatan penelitian dan pengabdian kepada masyarakat dalam pembelajaran oleh dosen tetap program studi', 1, '2022-01-14 10:02:26'),
(1019, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PENILAIAN PEMBELAJARAN', 'STD-01.04/SPMI', 'Ketua Jurusan/Kepala Program Studi Magister Terapan harus memastikan jumlah matakuliah yang dikembangkan berdasarkan hasil/integrasi kegiatan penelitian dan pengabdian kepada masyarakat dalam pembelajaran oleh dosen tetap program studi dalam 3 tahun terakhir â‰¥ 50%', '12', '0', '0', '0', '0', 1, '2022-01-14 10:03:10'),
(1020, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PENILAIAN PEMBELAJARAN', 'STD-01.04/SPMI', 'Ketua Jurusan/Kepala Program Studi Magister Terapan harus memastikan jumlah matakuliah yang dikembangkan berdasarkan hasil/integrasi kegiatan penelitian dan pengabdian kepada masyarakat dalam pembelajaran oleh dosen tetap program studi dalam 3 tahun terakhir â‰¥ 50%', '12', 'Tersedianya bukti sahih terkait jumlah mata kuliah yang dikembangkan berdasarkan hasil/integrasi kegiatan penelitian dan pengabdian kepada masyarakat dalam pembelajaran oleh dosen tetap program studi dalam 3 tahun terakhir ', 'a', '-', '0', 1, '2022-01-14 10:03:52'),
(1021, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PENILAIAN PEMBELAJARAN', 'STD-01.04/SPMI', 'Ketua Jurusan/Kepala Program Studi Magister Terapan harus memastikan jumlah matakuliah yang dikembangkan berdasarkan hasil/integrasi kegiatan penelitian dan pengabdian kepada masyarakat dalam pembelajaran oleh dosen tetap program studi dalam 3 tahun terakhir â‰¥ 50%', '12', 'Tersedianya bukti sahih terkait jumlah mata kuliah yang dikembangkan berdasarkan hasil/integrasi kegiatan penelitian dan pengabdian kepada masyarakat dalam pembelajaran oleh dosen tetap program studi dalam 3 tahun terakhir ', 'a', 'Dokumen', 'Laporan jumlah mata kuliah yang dikembangkan berdasarkan hasil/integrasi kegiatan penelitian dan pengabdian kepada masyarakat dalam pembelajaran oleh dosen tetap program studi', 1, '2022-01-14 10:04:29'),
(1022, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PENILAIAN PEMBELAJARAN', 'STD-01.04/SPMI', 'Ketua Jurusan/Kepala Program Studi harus memastikan keterlaksanaan dan keberkalaan program dan kegiatan ilmiah untuk meningkatkan suasana akademik yang terjadwal dan dilaksanakan setiap bulan', '13', '0', '0', '0', '0', 1, '2022-01-14 10:05:19'),
(1023, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PENILAIAN PEMBELAJARAN', 'STD-01.04/SPMI', 'Ketua Jurusan/Kepala Program Studi harus memastikan keterlaksanaan dan keberkalaan program dan kegiatan ilmiah untuk meningkatkan suasana akademik yang terjadwal dan dilaksanakan setiap bulan', '13', 'Tersedianya laporan kegiatan ilmiah yang terjadwal di setiap program studi/jurusan', 'a', '-', '0', 1, '2022-01-14 10:05:43'),
(1024, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PENILAIAN PEMBELAJARAN', 'STD-01.04/SPMI', 'Ketua Jurusan/Kepala Program Studi harus memastikan keterlaksanaan dan keberkalaan program dan kegiatan ilmiah untuk meningkatkan suasana akademik yang terjadwal dan dilaksanakan setiap bulan', '13', 'Tersedianya laporan kegiatan ilmiah yang terjadwal di setiap program studi/jurusan', 'a', 'Dokumen', 'Laporan kegiatan ilmiah yang terjadwal di setiap program studi/jurusan', 1, '2022-01-14 10:06:05'),
(1025, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PENILAIAN PEMBELAJARAN', 'STD-01.04/SPMI', 'Ketua Jurusan/Kepala Program Studi harus memastikan tingkat kepuasan mahasiswa terhadap proses pendidikan di program studi â‰¥ 70% dan dievaluasi pelaksanaannya minimal dua kali dalam setiap semester', '14', '0', '0', '0', '0', 1, '2022-01-14 10:07:30'),
(1026, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PENILAIAN PEMBELAJARAN', 'STD-01.04/SPMI', 'Ketua Jurusan/Kepala Program Studi harus memastikan tingkat kepuasan mahasiswa terhadap proses pendidikan di program studi â‰¥ 70% dan dievaluasi pelaksanaannya minimal dua kali dalam setiap semester', '14', 'Tersedianya instrumen pengukuran tingkat kepuasan mahasiswa ', 'a', '-', '0', 1, '2022-01-14 10:07:58'),
(1027, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PENILAIAN PEMBELAJARAN', 'STD-01.04/SPMI', 'Ketua Jurusan/Kepala Program Studi harus memastikan tingkat kepuasan mahasiswa terhadap proses pendidikan di program studi â‰¥ 70% dan dievaluasi pelaksanaannya minimal dua kali dalam setiap semester', '14', 'Tersedianya instrumen pengukuran tingkat kepuasan mahasiswa ', 'a', 'Dokumen', 'Instrumen pengukuran tingkat kepuasan mahasiswa ', 1, '2022-01-14 10:08:33'),
(1028, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PENILAIAN PEMBELAJARAN', 'STD-01.04/SPMI', 'Ketua Jurusan/Kepala Program Studi harus memastikan tingkat kepuasan mahasiswa terhadap proses pendidikan di program studi â‰¥ 70% dan dievaluasi pelaksanaannya minimal dua kali dalam setiap semester', '14', 'Tersedianya bukti sahih hasil analisis tingkat kepuasan mahasiswa yang tersaji dalam  Tabel 5.c LKPS  â‰¥ 70%', 'b', '-', '0', 1, '2022-01-14 10:09:01'),
(1029, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PENILAIAN PEMBELAJARAN', 'STD-01.04/SPMI', 'Ketua Jurusan/Kepala Program Studi harus memastikan tingkat kepuasan mahasiswa terhadap proses pendidikan di program studi â‰¥ 70% dan dievaluasi pelaksanaannya minimal dua kali dalam setiap semester', '14', 'Tersedianya bukti sahih hasil analisis tingkat kepuasan mahasiswa yang tersaji dalam  Tabel 5.c LKPS  â‰¥ 70%', 'b', 'Dokumen', 'Tabel 5.c LKPS', 1, '2022-01-14 10:09:21'),
(1030, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PENILAIAN PEMBELAJARAN', 'STD-01.04/SPMI', 'Ketua Jurusan/Kepala Program Studi harus memastikan tingkat kepuasan mahasiswa terhadap proses pendidikan di program studi â‰¥ 70% dan dievaluasi pelaksanaannya minimal dua kali dalam setiap semester', '14', 'Terlaksananya evaluasi hasil pengukuran tingkat kepuasan mahasiswa dan tindak lanjut hasil pengukuran', 'c', '-', '0', 1, '2022-01-14 10:09:47'),
(1031, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PENILAIAN PEMBELAJARAN', 'STD-01.04/SPMI', 'Ketua Jurusan/Kepala Program Studi harus memastikan tingkat kepuasan mahasiswa terhadap proses pendidikan di program studi â‰¥ 70% dan dievaluasi pelaksanaannya minimal dua kali dalam setiap semester', '14', 'Terlaksananya evaluasi hasil pengukuran tingkat kepuasan mahasiswa dan tindak lanjut hasil pengukuran', 'c', 'Dokumen', 'Evaluasi dan tindak lanjut hasil pengukuran', 1, '2022-01-14 10:10:03'),
(1032, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PENILAIAN PEMBELAJARAN', 'STD-01.04/SPMI', 'SPMI harus  melaksanakan monitoring, evaluasi, pengendalian dan peningkatan terhadap penilaian pembelajaran dari semua program studi di Politeknik Negeri Medan  di setiap akhir tahun akademik', '15', '0', '0', '0', '0', 1, '2022-01-14 10:37:05'),
(1033, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PENILAIAN PEMBELAJARAN', 'STD-01.04/SPMI', 'SPMI harus  melaksanakan monitoring, evaluasi, pengendalian dan peningkatan terhadap penilaian pembelajaran dari semua program studi di Politeknik Negeri Medan  di setiap akhir tahun akademik', '15', 'Tersedianya  lingkup Audit Mutu Internal (AMI)', 'a', '-', '0', 1, '2022-01-14 10:37:35'),
(1034, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR ISI PEMBELAJARAN', 'STD-01.02/SPMI', 'SPMI harus  melaksanakan monitoring, evaluasi, pengendalian dan peningkatan terhadap isi pembelajaran dari semua program studi di Politeknik Negeri Medan  di setiap akhir tahun akademik', '12', 'Tersedianya  lingkup Audit Mutu Internal (AMI)', 'a', 'Dokumen', 'Lingkup Audit Mutu Internal', 1, '2022-01-14 10:38:05'),
(1035, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PENILAIAN PEMBELAJARAN', 'STD-01.04/SPMI', 'SPMI harus  melaksanakan monitoring, evaluasi, pengendalian dan peningkatan terhadap penilaian pembelajaran dari semua program studi di Politeknik Negeri Medan  di setiap akhir tahun akademik', '15', 'Tersedianya jadwal pelaksanaan AMI', 'b', '-', '0', 1, '2022-01-14 10:38:30'),
(1036, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR ISI PEMBELAJARAN', 'STD-01.02/SPMI', 'SPMI harus  melaksanakan monitoring, evaluasi, pengendalian dan peningkatan terhadap isi pembelajaran dari semua program studi di Politeknik Negeri Medan  di setiap akhir tahun akademik', '12', 'Tersedianya jadwal pelaksanaan AMI', 'b', 'Dokumen', 'Jadwal pelaksanaan Audit Mutu Internal', 1, '2022-01-14 10:39:03'),
(1037, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PENILAIAN PEMBELAJARAN', 'STD-01.04/SPMI', 'SPMI harus  melaksanakan monitoring, evaluasi, pengendalian dan peningkatan terhadap penilaian pembelajaran dari semua program studi di Politeknik Negeri Medan  di setiap akhir tahun akademik', '15', 'Tersedianya penugasan (SK) Auditor AMI', 'c', '-', '0', 1, '2022-01-14 10:39:34'),
(1038, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Direktur melakukan kegiatan pemantauan/evaluasi mutu lulusan secara rutin minimal 1 kali per tahun dengan melibatkan SPMI, AMI, dan GKMIJ. ', '49', 'Tersedianya penugasan (SK) Auditor AMI', 'c', 'Dokumen', 'SK Auditor Audit Mutu Internal', 1, '2022-01-14 10:40:12'),
(1039, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PENILAIAN PEMBELAJARAN', 'STD-01.04/SPMI', 'SPMI harus  melaksanakan monitoring, evaluasi, pengendalian dan peningkatan terhadap penilaian pembelajaran dari semua program studi di Politeknik Negeri Medan  di setiap akhir tahun akademik', '15', 'Tersedianya bukti sahih pelaksanaan AMI (Audit dokumen dan Audit Lapangan)', 'd', '-', '0', 1, '2022-01-14 10:41:00'),
(1040, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Direktur melakukan kegiatan pemantauan/evaluasi mutu lulusan secara rutin minimal 1 kali per tahun dengan melibatkan SPMI, AMI, dan GKMIJ. ', '49', 'Tersedianya bukti sahih pelaksanaan AMI (Audit dokumen dan Audit Lapangan)', 'd', 'Dokumen', 'Laporan Audit;', 1, '2022-01-14 10:42:12'),
(1041, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PENILAIAN PEMBELAJARAN', 'STD-01.04/SPMI', 'SPMI harus  melaksanakan monitoring, evaluasi, pengendalian dan peningkatan terhadap penilaian pembelajaran dari semua program studi di Politeknik Negeri Medan  di setiap akhir tahun akademik', '15', 'Terlaksananya Rapat Tinjauan Manajemen (RTM)', 'e', '-', '0', 1, '2022-01-14 10:43:02'),
(1042, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Direktur melakukan kegiatan pemantauan/evaluasi mutu lulusan secara rutin minimal 1 kali per tahun dengan melibatkan SPMI, AMI, dan GKMIJ. ', '49', 'Terlaksananya Rapat Tinjauan Manajemen (RTM)', 'e', 'Dokumen', 'Jadwal pelaksanaan RTM dan dokumentasi;', 1, '2022-01-14 10:43:37'),
(1043, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PENILAIAN PEMBELAJARAN', 'STD-01.04/SPMI', 'SPMI harus  melaksanakan monitoring, evaluasi, pengendalian dan peningkatan terhadap penilaian pembelajaran dari semua program studi di Politeknik Negeri Medan  di setiap akhir tahun akademik', '15', 'Tersedianya Hasil RTM (peningkatan efektivitas SPMI dan prosesnya)', 'f', '-', '0', 1, '2022-01-14 10:43:59'),
(1044, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Direktur melakukan kegiatan pemantauan/evaluasi mutu lulusan secara rutin minimal 1 kali per tahun dengan melibatkan SPMI, AMI, dan GKMIJ. ', '49', 'Tersedianya Hasil RTM (peningkatan efektivitas SPMI dan prosesnya)', 'f', 'Dokumen', 'Hasil Rapat Tinjauan Manajemen (Peningkatan efektivitas SPMI dan prosesnya)', 1, '2022-01-14 10:44:27'),
(1045, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR PENILAIAN PEMBELAJARAN', 'STD-01.04/SPMI', 'SPMI harus  melaksanakan monitoring, evaluasi, pengendalian dan peningkatan terhadap penilaian pembelajaran dari semua program studi di Politeknik Negeri Medan  di setiap akhir tahun akademik', '15', 'Terlaksananya perbaikan mutu secara berkelanjutan (Continuous Quality Improvement/CQI)', 'g', '-', '0', 1, '2022-01-14 10:45:56'),
(1046, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR KOMPETENSI LULUSAN', 'STD-01.01/SPMI', 'Direktur melakukan kegiatan pemantauan/evaluasi mutu lulusan secara rutin minimal 1 kali per tahun dengan melibatkan SPMI, AMI, dan GKMIJ. ', '49', 'Terlaksananya perbaikan mutu secara berkelanjutan (Continuous Quality Improvement/CQI)', 'g', 'Dokumen', 'CQI atau Kaizen.', 1, '2022-01-14 10:46:26'),
(1047, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'STD-01.05/SPMI', '0', '0', '0', '0', '0', '0', 1, '2022-01-14 11:13:30'),
(1048, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'STD-01.05/SPMI', 'Dosen wajib memiliki kualifikasi akademik dan kompetensi pendidik, sehat jasmani dan rohani, serta memiliki kemampuan untuk menyelenggarakan\npendidikan dalam rangka pemenuhan capaian Pembelajaran lulusan', '1', '0', '0', '0', '0', 1, '2022-01-14 11:15:05'),
(1049, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'STD-01.05/SPMI', 'Dosen wajib memiliki kualifikasi akademik dan kompetensi pendidik, sehat jasmani dan rohani, serta memiliki kemampuan untuk menyelenggarakan\npendidikan dalam rangka pemenuhan capaian Pembelajaran lulusan', '1', 'Tersedia bukti sahih terkait kualifikasi akademik dan kompetensi pendidik, sehat jasmani dan rohani, serta memiliki kemampuan untuk menyelenggarakan\npendidikan dalam rangka pemenuhan capaian Pembelajaran lulusan.', 'a', '-', '0', 1, '2022-01-14 11:15:28'),
(1050, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'STD-01.05/SPMI', 'Dosen wajib memiliki kualifikasi akademik dan kompetensi pendidik, sehat jasmani dan rohani, serta memiliki kemampuan untuk menyelenggarakan\npendidikan dalam rangka pemenuhan capaian Pembelajaran lulusan', '1', 'Tersedia bukti sahih terkait kualifikasi akademik dan kompetensi pendidik, sehat jasmani dan rohani, serta memiliki kemampuan untuk menyelenggarakan\npendidikan dalam rangka pemenuhan capaian Pembelajaran lulusan.', 'a', 'Dokumen', 'Tabel kualifikasi akademik dan kompetensi pendidik', 1, '2022-01-14 11:15:48'),
(1051, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'STD-01.05/SPMI', 'Dosen program diploma empat harus berkualifikasi akademik paling rendah lulusan magister atau magister terapan yang relevan dengan Program Studi', '2', '0', '0', '0', '0', 1, '2022-01-14 11:18:49'),
(1052, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'STD-01.05/SPMI', 'Dosen program diploma empat harus berkualifikasi akademik paling rendah lulusan magister atau magister terapan yang relevan dengan Program Studi', '2', 'Tersedia kebijakan formal terkait kualifikasi akademik dosen untuk mengajar sesuai dengan jenjang program pendidikan', 'a', '-', '0', 1, '2022-01-14 11:19:09'),
(1053, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'STD-01.05/SPMI', 'Dosen program diploma empat harus berkualifikasi akademik paling rendah lulusan magister atau magister terapan yang relevan dengan Program Studi', '2', 'Tersedia kebijakan formal terkait kualifikasi akademik dosen untuk mengajar sesuai dengan jenjang program pendidikan', 'a', 'Dokumen', 'Kebijakan kualifikasi akademik dosen', 1, '2022-01-14 11:19:24'),
(1054, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'STD-01.05/SPMI', 'Direktur harus menetapkan pedoman perhitungan beban kerja dosen yang didasarkan pada kegiatan pokok Dosen, kegiatan dalam bentuk pelaksanaan tugas tambahan dan kegiatan penunjang.pada setiap akhir tahun akademik', '3', '0', '0', '0', '0', 1, '2022-01-14 11:21:26'),
(1055, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'STD-01.05/SPMI', 'Direktur harus menetapkan pedoman perhitungan beban kerja dosen yang didasarkan pada kegiatan pokok Dosen, kegiatan dalam bentuk pelaksanaan tugas tambahan dan kegiatan penunjang.pada setiap akhir tahun akademik', '3', 'Tersedianya  pedoman terkait perhitungan beban kerja dosen yang didasarkan pada kegiatan pokok Dosen, (1) perencanaan, pelaksanaan, dan pengendalian proses Pembelajaran; (2) pelaksanaan evaluasi hasil Pembelajaran; (3) pembimbingan dan pelatihan; (4) Penelitian; dan (5) Pengabdian kepada Masyarakat, kegiatan dalam bentuk pelaksanaan tugasntambahan dan kegiatan penunjang.pada setiap akhir tahun akademik', 'a', '-', '0', 1, '2022-01-14 11:21:48'),
(1056, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'STD-01.05/SPMI', 'Direktur harus menetapkan pedoman perhitungan beban kerja dosen yang didasarkan pada kegiatan pokok Dosen, kegiatan dalam bentuk pelaksanaan tugas tambahan dan kegiatan penunjang.pada setiap akhir tahun akademik', '3', 'Tersedianya  pedoman terkait perhitungan beban kerja dosen yang didasarkan pada kegiatan pokok Dosen, (1) perencanaan, pelaksanaan, dan pengendalian proses Pembelajaran; (2) pelaksanaan evaluasi hasil Pembelajaran; (3) pembimbingan dan pelatihan; (4) Penelitian; dan (5) Pengabdian kepada Masyarakat, kegiatan dalam bentuk pelaksanaan tugasntambahan dan kegiatan penunjang.pada setiap akhir tahun akademik', 'a', 'Dokumen', 'Pedoman perhitungan beban kerja dosen', 1, '2022-01-14 11:22:08'),
(1057, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'STD-01.05/SPMI', 'Ketua Jurusan harus memastikan Dosen menyusun laporan kinerja sesuai dengan pedoman perhitungan beban kerja dosen pada setiap akhir tahun ', '4', '0', '0', '0', '0', 1, '2022-01-14 11:22:41'),
(1058, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'STD-01.05/SPMI', 'Ketua Jurusan harus memastikan Dosen menyusun laporan kinerja sesuai dengan pedoman perhitungan beban kerja dosen pada setiap akhir tahun ', '4', 'Tersedianya bukti laporan kinerja sesuai dengan pedoman perhitungan beban kerja dosen pada setiap akhir tahun akademik dan diketuhui oleh Ketua Jurusan', 'a', '-', '0', 1, '2022-01-14 11:23:40'),
(1059, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'STD-01.05/SPMI', 'Ketua Jurusan harus memastikan Dosen menyusun laporan kinerja sesuai dengan pedoman perhitungan beban kerja dosen pada setiap akhir tahun ', '4', 'Tersedianya bukti laporan kinerja sesuai dengan pedoman perhitungan beban kerja dosen pada setiap akhir tahun akademik dan diketuhui oleh Ketua Jurusan', 'a', 'Dokumen', 'Laporan kinerja dosen', 1, '2022-01-14 11:23:58'),
(1060, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'STD-01.05/SPMI', 'Ketua Jurusan harus memastikan Dosen menyusun laporan kinerja sesuai dengan pedoman perhitungan beban kerja dosen pada setiap akhir tahun ', '4', 'Beban kerja pada kegiatan pokok Dosen disesuaikan dengan besarnya beban tugas tambahan, bagi Dosen yang mendapatkan tugas tambahan', 'b', '-', '0', 1, '2022-01-14 11:24:51'),
(1061, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'STD-01.05/SPMI', 'Ketua Jurusan harus memastikan Dosen menyusun laporan kinerja sesuai dengan pedoman perhitungan beban kerja dosen pada setiap akhir tahun ', '4', 'Beban kerja pada kegiatan pokok Dosen disesuaikan dengan besarnya beban tugas tambahan, bagi Dosen yang mendapatkan tugas tambahan', 'b', 'Dokumen', 'Pedoman perhitungan beban kerja dosen', 1, '2022-01-14 11:25:09'),
(1062, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'STD-01.05/SPMI', 'Wakil Direktur II harus memastikan Dosen yang mengajar di lingkungan Politeknik Negeri Medan terdiiri atas Dosen tetap dan Dosen tidak tetap dan dilaksanakan evaluasi pada setiap akhir tahun akademik', '5', '0', '0', '0', '0', 1, '2022-01-14 11:25:35'),
(1063, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'STD-01.05/SPMI', 'Wakil Direktur II harus memastikan Dosen yang mengajar di lingkungan Politeknik Negeri Medan terdiiri atas Dosen tetap dan Dosen tidak tetap dan dilaksanakan evaluasi pada setiap akhir tahun akademik', '5', 'Tersedianya data dosen tetap dan tidak tetap yang mengajar di Politeknik Negeri Medan', 'a', '-', '0', 1, '2022-01-14 11:25:57'),
(1064, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'STD-01.05/SPMI', 'Wakil Direktur II harus memastikan Dosen yang mengajar di lingkungan Politeknik Negeri Medan terdiiri atas Dosen tetap dan Dosen tidak tetap dan dilaksanakan evaluasi pada setiap akhir tahun akademik', '5', 'Tersedianya data dosen tetap dan tidak tetap yang mengajar di Politeknik Negeri Medan', 'a', 'Dokumen', 'Surat Keterangan penempatan tugas dosen sesuai PD Dikti', 1, '2022-01-14 11:26:13'),
(1065, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'STD-01.05/SPMI', 'Jumlah Dosen Tetap Program Studi (DTPS) untuk Program Diploma 3 dan Diploma 4 yang  ditugaskan sebagai pengampu mata kuliah dengan bidang keahlian yang sesuai dengan kompetensi inti program studi â‰¥ 12', '6', '0', '0', '0', '0', 1, '2022-01-14 11:26:35'),
(1066, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'STD-01.05/SPMI', 'Jumlah Dosen Tetap Program Studi (DTPS) untuk Program Diploma 3 dan Diploma 4 yang  ditugaskan sebagai pengampu mata kuliah dengan bidang keahlian yang sesuai dengan kompetensi inti program studi â‰¥ 12', '6', 'Tersedianya bukti sahih terkait kecukupan jumlah DTPS yang tersaji dalam  Tabel 3.a.1) LKPS', 'a', '-', '0', 1, '2022-01-14 11:26:55');
INSERT INTO `standar` (`standarid`, `kodestandar`, `namastandar`, `namasubstandar`, `kodesubstandar`, `namapernyataan`, `kodepernyataan`, `namaindikator`, `kodeindikator`, `catatanindikator`, `namadokumen`, `userid`, `createdDate`) VALUES
(1067, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'STD-01.05/SPMI', 'Jumlah Dosen Tetap Program Studi (DTPS) untuk Program Diploma 3 dan Diploma 4 yang  ditugaskan sebagai pengampu mata kuliah dengan bidang keahlian yang sesuai dengan kompetensi inti program studi â‰¥ 12', '6', 'Tersedianya bukti sahih terkait kecukupan jumlah DTPS yang tersaji dalam  Tabel 3.a.1) LKPS', 'a', 'Dokumen', 'Laporan kecukupan jumlah DTPS dalam Tabel 3.a.1 LKPS', 1, '2022-01-14 11:27:16'),
(1068, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'STD-01.05/SPMI', 'Jumlah Dosen Tetap Program Studi untuk Program Magister Terapan yang  ditugaskan sebagai pengampu mata kuliah dengan bidang keahlian yang sesuai dengan kompetensi inti program studi â‰¥ 6', '7', '0', '0', '0', '0', 1, '2022-01-14 11:27:45'),
(1069, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'STD-01.05/SPMI', 'Jumlah Dosen Tetap Program Studi untuk Program Magister Terapan yang  ditugaskan sebagai pengampu mata kuliah dengan bidang keahlian yang sesuai dengan kompetensi inti program studi â‰¥ 6', '7', 'Tersedianya bukti sahih terkait kecukupan jumlah DTPS yang tersaji dalam  Tabel 3.a.1 LKPS', 'a', '-', '0', 1, '2022-01-14 11:28:09'),
(1070, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'STD-01.05/SPMI', 'Jumlah Dosen Tetap Program Studi untuk Program Magister Terapan yang  ditugaskan sebagai pengampu mata kuliah dengan bidang keahlian yang sesuai dengan kompetensi inti program studi â‰¥ 6', '7', 'Tersedianya bukti sahih terkait kecukupan jumlah DTPS yang tersaji dalam  Tabel 3.a.1 LKPS', 'a', 'Dokumen', 'Laporan kecukupan jumlah DTPS dalam Tabel 3.a.1 LKPS', 1, '2022-01-14 11:28:43'),
(1071, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'STD-01.05/SPMI', 'Direktur harus memastikan Rasio Jumlah Dosen Tetap yang memenuhi persyaratan dosen terhadap jumlah program studi  â‰¥ 12', '8', '0', '0', '0', '0', 1, '2022-01-14 11:33:37'),
(1072, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'STD-01.05/SPMI', 'Direktur harus memastikan Rasio Jumlah Dosen Tetap yang memenuhi persyaratan dosen terhadap jumlah program studi  â‰¥ 12', '8', 'Tersedianya bukti sahih terkait kecukupan jumlah DTPS yang tersaji dalam  Tabel 3.a.1 LKPT Kecukupan Dosen Perguruan Tinggi', 'a', '-', '0', 1, '2022-01-14 11:36:08'),
(1073, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'STD-01.05/SPMI', 'Direktur harus memastikan Rasio Jumlah Dosen Tetap yang memenuhi persyaratan dosen terhadap jumlah program studi  â‰¥ 12', '8', 'Tersedianya bukti sahih terkait kecukupan jumlah DTPS yang tersaji dalam  Tabel 3.a.1 LKPT Kecukupan Dosen Perguruan Tinggi', 'a', 'Dokumen', 'Tabel 3.a.1 LKPT Kecukupan Dosen Perguruan Tinggi', 1, '2022-01-14 11:36:31'),
(1074, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'STD-01.05/SPMI', 'Wakil Direktur II berkoordinasi dengan Direktur untuk memastikan Persentase jumlah dosen yang memiliki jabatan fungsional minimal Lektor Kepala terhadap jumlah seluruh dosen tetap  â‰¥ 25% dari jumlah dosen tetap di Politeknik Negeri Medan', '9', '0', '0', '0', '0', 1, '2022-01-14 11:37:41'),
(1075, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'STD-01.05/SPMI', 'Wakil Direktur II berkoordinasi dengan Direktur untuk memastikan Persentase jumlah dosen yang memiliki jabatan fungsional minimal Lektor Kepala terhadap jumlah seluruh dosen tetap  â‰¥ 25% dari jumlah dosen tetap di Politeknik Negeri Medan', '9', 'Tersedianya bukti sahih yang tersaji pada Tabel 3.a.2 LKPT Jabatan Fungsional Dosen Lektor Kepala â‰¥ 25% terhadap jumlah dosen tetap', 'a', '-', '0', 1, '2022-01-14 11:38:05'),
(1076, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'STD-01.05/SPMI', 'Wakil Direktur II berkoordinasi dengan Direktur untuk memastikan Persentase jumlah dosen yang memiliki jabatan fungsional minimal Lektor Kepala terhadap jumlah seluruh dosen tetap  â‰¥ 25% dari jumlah dosen tetap di Politeknik Negeri Medan', '9', 'Tersedianya bukti sahih yang tersaji pada Tabel 3.a.2 LKPT Jabatan Fungsional Dosen Lektor Kepala â‰¥ 25% terhadap jumlah dosen tetap', 'a', 'Dokumen', 'Tabel 3.a.2) LKPT Jabatan Fungsional Dosen Lektor Kepala â‰¥ 25% terhadap jumlah dosen tetap', 1, '2022-01-14 11:38:18'),
(1077, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'STD-01.05/SPMI', 'Ketua Jurusan/Kepala Program Studi Diploma 3 harus memastikan Jumlah Dosen Tetap Program Studi  (DTPS) yang berpendidikan tertinggi Doktor/Doktor Terapan  â‰¥ 30% dari jumlah dosen tetap dengan bidang keahlian sesuai program studi ', '10', '0', '0', '0', '0', 1, '2022-01-14 11:38:44'),
(1078, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'STD-01.05/SPMI', 'Ketua Jurusan/Kepala Program Studi Diploma 3 harus memastikan Jumlah Dosen Tetap Program Studi  (DTPS) yang berpendidikan tertinggi Doktor/Doktor Terapan  â‰¥ 30% dari jumlah dosen tetap dengan bidang keahlian sesuai program studi ', '10', 'Tersedianya bukti sahih kualifikasi akademik DTPS yang tersaji pada Tabel 3.a.1. LKPS ', 'a', '-', '0', 1, '2022-01-14 11:39:03'),
(1079, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'STD-01.05/SPMI', 'Ketua Jurusan/Kepala Program Studi Diploma 3 harus memastikan Jumlah Dosen Tetap Program Studi  (DTPS) yang berpendidikan tertinggi Doktor/Doktor Terapan  â‰¥ 30% dari jumlah dosen tetap dengan bidang keahlian sesuai program studi ', '10', 'Tersedianya bukti sahih kualifikasi akademik DTPS yang tersaji pada Tabel 3.a.1. LKPS ', 'a', 'Dokumen', 'Tabel 3.a.1. LKPS Kualifikasi akademik ', 1, '2022-01-14 11:39:18'),
(1080, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'STD-01.05/SPMI', 'Ketua Jurusan/Kepala Program Studi Diploma 4 harus memastikan Jumlah Dosen Tetap Program Studi  (DTPS) yang berpendidikan tertinggi Doktor/Doktor Terapan  â‰¥ 50% dari jumlah dosen tetap dengan bidang keahlian sesuai program studi ', '11', '0', '0', '0', '0', 1, '2022-01-14 11:39:38'),
(1081, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'STD-01.05/SPMI', 'Ketua Jurusan/Kepala Program Studi Diploma 4 harus memastikan Jumlah Dosen Tetap Program Studi  (DTPS) yang berpendidikan tertinggi Doktor/Doktor Terapan  â‰¥ 50% dari jumlah dosen tetap dengan bidang keahlian sesuai program studi ', '11', 'Tersedianya bukti sahih kualifikasi akademik DTPS yang tersaji pada Tabel 3.a.1. LKPS ', 'a', '-', '0', 1, '2022-01-14 11:39:58'),
(1082, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'STD-01.05/SPMI', 'Ketua Jurusan/Kepala Program Studi Diploma 3 harus memastikan Jumlah Dosen Tetap Program Studi  (DTPS) yang berpendidikan tertinggi Doktor/Doktor Terapan  â‰¥ 30% dari jumlah dosen tetap dengan bidang keahlian sesuai program studi ', '10', 'Tersedianya bukti sahih kualifikasi akademik DTPS yang tersaji pada Tabel 3.a.1. LKPS ', 'a', 'Dokumen', 'Tabel 3.a.1 LKPS Kualifikasi akademik ', 1, '2022-01-14 11:40:28'),
(1083, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'STD-01.05/SPMI', 'Ketua Jurusan/Kepala Program Studi Diploma 3, Diploma 4 dan Magister Terapan harus memastikan Jumlah Dosen Tetap Program Studi  (DTPS) yang memiliki jabatan akademik Guru Besar dan Lektor Kepala  â‰¥ 70% dari jumlah dosen tetap dengan bidang keahlian sesuai program studi.', '12', '0', '0', '0', '0', 1, '2022-01-14 11:41:02'),
(1084, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'STD-01.05/SPMI', 'Ketua Jurusan/Kepala Program Studi Diploma 3, Diploma 4 dan Magister Terapan harus memastikan Jumlah Dosen Tetap Program Studi  (DTPS) yang memiliki jabatan akademik Guru Besar dan Lektor Kepala  â‰¥ 70% dari jumlah dosen tetap dengan bidang keahlian sesuai program studi.', '12', 'Tersedianya bukti sahih Jabatan Akademik DTPS yang tersaji pada Tabel 3.a.1 LKPS ', 'a', '-', '0', 1, '2022-01-14 11:41:27'),
(1085, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'STD-01.05/SPMI', 'Ketua Jurusan/Kepala Program Studi Diploma 3, Diploma 4 dan Magister Terapan harus memastikan Jumlah Dosen Tetap Program Studi  (DTPS) yang memiliki jabatan akademik Guru Besar dan Lektor Kepala  â‰¥ 70% dari jumlah dosen tetap dengan bidang keahlian sesuai program studi.', '12', 'Tersedianya bukti sahih Jabatan Akademik DTPS yang tersaji pada Tabel 3.a.1 LKPS ', 'a', 'Dokumen', 'Tabel 3.a.1 LKPS Jabatan Akademik DTPS ', 1, '2022-01-14 11:41:46'),
(1086, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'STD-01.05/SPMI', 'Ketua Jurusan/Kepala Program Studi Diploma 3 dan Diploma 4 harus memastikan Jumlah Dosen Tetap Program Studi yang memiliki sertifikat kompetensi, profesi, dan/atau industri â‰¥ 50% dari jumlah Dosen Tetap dengan bidang keahlian sesuai kompetensi inti program studi', '13', '0', '0', '0', '0', 1, '2022-01-14 11:42:08'),
(1087, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'STD-01.05/SPMI', 'Ketua Jurusan/Kepala Program Studi Diploma 3 dan Diploma 4 harus memastikan Jumlah Dosen Tetap Program Studi yang memiliki sertifikat kompetensi, profesi, dan/atau industri â‰¥ 50% dari jumlah Dosen Tetap dengan bidang keahlian sesuai kompetensi inti program studi', '13', 'Tersedianya bukti sahih Sertifikasi kompetensi/ profesi/industri DTPS yang tersaji pada Tabel 3.a.1 LKPS', 'a', '-', '0', 1, '2022-01-14 11:43:10'),
(1088, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'STD-01.05/SPMI', 'Ketua Jurusan/Kepala Program Studi Diploma 3 dan Diploma 4 harus memastikan Jumlah Dosen Tetap Program Studi yang memiliki sertifikat kompetensi, profesi, dan/atau industri â‰¥ 50% dari jumlah Dosen Tetap dengan bidang keahlian sesuai kompetensi inti program studi', '13', 'Tersedianya bukti sahih Sertifikasi kompetensi/ profesi/industri DTPS yang tersaji pada Tabel 3.a.1 LKPS', 'a', 'Dokumen', 'Sertifikasi kompetensi/ profesi/industri DTPS yang tersaji pada Tabel 3.a.1 LKPS', 1, '2022-01-14 11:43:29'),
(1089, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'STD-01.05/SPMI', 'Wakil Direktur II berkoordinasi dengan Direktur  harus memastikan Jumlah Dosen  yang memiliki sertifikat kompetensi, profesi, dan/atau industri â‰¥ 50% dari jumlah seluruh Dosen Tetap ', '14', '0', '0', '0', '0', 1, '2022-01-14 11:44:27'),
(1090, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'STD-01.05/SPMI', 'Wakil Direktur II berkoordinasi dengan Direktur  harus memastikan Jumlah Dosen  yang memiliki sertifikat kompetensi, profesi, dan/atau industri â‰¥ 50% dari jumlah seluruh Dosen Tetap ', '14', 'Tersedianya bukti sahih Sertifikasi kompetensi/ profesi/industri yang tersaji pada Tabel 3.a.3 LKPT Sertifikasi Dosen', 'a', '-', '0', 1, '2022-01-14 11:44:52'),
(1091, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'STD-01.05/SPMI', 'Wakil Direktur II berkoordinasi dengan Direktur  harus memastikan Jumlah Dosen  yang memiliki sertifikat kompetensi, profesi, dan/atau industri â‰¥ 50% dari jumlah seluruh Dosen Tetap ', '14', 'Tersedianya bukti sahih Sertifikasi kompetensi/ profesi/industri yang tersaji pada Tabel 3.a.3 LKPT Sertifikasi Dosen', 'a', 'Dokumen', 'Sertifikasi kompetensi/ profesi/industri yang tersaji pada Tabel 3.a.3) LKPT Sertifikasi Dosen', 1, '2022-01-14 11:45:07'),
(1092, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'STD-01.05/SPMI', 'Ketua Jurusan/Kepala Program Studi Diploma 3 harus memastikan Rasio jumlah mahasiswa program studi terhadap jumlah Dosen Tetap Program Studi untuk kelompok Sains Teknologi  adalah lebih besar atau sama dengan 10 tetapi kecil dari atau sama dengan 20, sedangkan untuk kelompok Sosial Humaniora lebih besar atau sama dengan 15 tetapi kecil dari atau sama dengan 25', '15', '0', '0', '0', '0', 1, '2022-01-14 11:45:28'),
(1093, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'STD-01.05/SPMI', 'Ketua Jurusan/Kepala Program Studi Diploma 3 harus memastikan Rasio jumlah mahasiswa program studi terhadap jumlah Dosen Tetap Program Studi untuk kelompok Sains Teknologi  adalah lebih besar atau sama dengan 10 tetapi kecil dari atau sama dengan 20, sedangkan untuk kelompok Sosial Humaniora lebih besar atau sama dengan 15 tetapi kecil dari atau sama dengan 25', '15', 'Tersedianya bukti sahih Rasio jumlah mahasiswa program studi terhadap jumlah DTPS yang tersaji pada Tabel 2.a LKPS dan  Tabel 3.a.1 LKPS, untuk kelompok Sains Teknologi 10 â‰¤ Rasio Mahasiswa terhadap Dosen  â‰¤ 20', 'a', '-', '0', 1, '2022-01-14 11:46:10'),
(1094, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'STD-01.05/SPMI', 'Ketua Jurusan/Kepala Program Studi Diploma 3 harus memastikan Rasio jumlah mahasiswa program studi terhadap jumlah Dosen Tetap Program Studi untuk kelompok Sains Teknologi  adalah lebih besar atau sama dengan 10 tetapi kecil dari atau sama dengan 20, sedangkan untuk kelompok Sosial Humaniora lebih besar atau sama dengan 15 tetapi kecil dari atau sama dengan 25', '15', 'Tersedianya bukti sahih Rasio jumlah mahasiswa program studi terhadap jumlah DTPS yang tersaji pada Tabel 2.a LKPS dan  Tabel 3.a.1 LKPS, untuk kelompok Sains Teknologi 10 â‰¤ Rasio Mahasiswa terhadap Dosen  â‰¤ 20', 'a', 'Dokumen', 'Rasio jumlah mahasiswa program studi terhadap jumlah DTPS yang tersaji pada Tabel 2.a LKPS dan Tabel 3.a.1 LKPS, untuk kelompok Sains Teknologi 10 â‰¤ RMD  â‰¤ 20', 1, '2022-01-14 11:46:43'),
(1095, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'STD-01.05/SPMI', 'Ketua Jurusan/Kepala Program Studi Diploma 3 harus memastikan Rasio jumlah mahasiswa program studi terhadap jumlah Dosen Tetap Program Studi untuk kelompok Sains Teknologi  adalah lebih besar atau sama dengan 10 tetapi kecil dari atau sama dengan 20, sedangkan untuk kelompok Sosial Humaniora lebih besar atau sama dengan 15 tetapi kecil dari atau sama dengan 25', '15', 'Tersedianya bukti sahih Rasio jumlah mahasiswa program\nstudi terhadap jumlah DTPS yang tersaji pada Tabel 2.a LKPS dan  Tabel 3.a.1 LKPS, untuk kelompok Sosial Humaniora 15 â‰¤ Rasio Mahasiswa terhadap Dosen  â‰¤ 25\n', 'b', '-', '0', 1, '2022-01-14 11:47:25'),
(1096, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'STD-01.05/SPMI', 'Ketua Jurusan/Kepala Program Studi Diploma 3 harus memastikan Rasio jumlah mahasiswa program studi terhadap jumlah Dosen Tetap Program Studi untuk kelompok Sains Teknologi  adalah lebih besar atau sama dengan 10 tetapi kecil dari atau sama dengan 20, sedangkan untuk kelompok Sosial Humaniora lebih besar atau sama dengan 15 tetapi kecil dari atau sama dengan 25', '15', 'Tersedianya bukti sahih Rasio jumlah mahasiswa program\nstudi terhadap jumlah DTPS yang tersaji pada Tabel 2.a LKPS dan  Tabel 3.a.1 LKPS, untuk kelompok Sosial Humaniora 15 â‰¤ Rasio Mahasiswa terhadap Dosen  â‰¤ 25\n', 'b', 'Dokumen', 'Rasio jumlah mahasiswa program studi terhadap jumlah DTPS yang tersaji pada Tabel 2.a LKPS dan Tabel 3.a.1 LKPS, untuk kelompok Sosial Humaniora 15 â‰¤ RMD â‰¤ 25', 1, '2022-01-14 11:47:43'),
(1097, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'STD-01.05/SPMI', 'Ketua Jurusan/Kepala Program Studi Diploma  4 harus memastikan Rasio jumlah mahasiswa program studi terhadap jumlah Dosen Tetap Program Studi untuk kelompok Sains Teknologi  adalah lebih besar atau sama dengan 15 tetapi kecil dari atau sama dengan 25, sedangkan untuk kelompok Sosial Humaniora lebih besar atau sama dengan 25 tetapi kecil dari atau sama dengan 35', '16', '0', '0', '0', '0', 1, '2022-01-14 11:49:06'),
(1098, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'STD-01.05/SPMI', 'Ketua Jurusan/Kepala Program Studi Diploma  4 harus memastikan Rasio jumlah mahasiswa program studi terhadap jumlah Dosen Tetap Program Studi untuk kelompok Sains Teknologi  adalah lebih besar atau sama dengan 15 tetapi kecil dari atau sama dengan 25, sedangkan untuk kelompok Sosial Humaniora lebih besar atau sama dengan 25 tetapi kecil dari atau sama dengan 35', '16', 'Tersedianya bukti sahih Rasio jumlah mahasiswa program studi terhadap jumlah DTPS yang tersaji pada Tabel 2.a LKPS dan Tabel 3.a.1 LKPS, untuk kelompok Sains Teknologi 15 â‰¤ Rasio Mahasiswa terhadap Dosen  â‰¤ 25', 'a', '-', '0', 1, '2022-01-14 11:49:28'),
(1099, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'STD-01.05/SPMI', 'Ketua Jurusan/Kepala Program Studi Diploma  4 harus memastikan Rasio jumlah mahasiswa program studi terhadap jumlah Dosen Tetap Program Studi untuk kelompok Sains Teknologi  adalah lebih besar atau sama dengan 15 tetapi kecil dari atau sama dengan 25, sedangkan untuk kelompok Sosial Humaniora lebih besar atau sama dengan 25 tetapi kecil dari atau sama dengan 35', '16', 'Tersedianya bukti sahih Rasio jumlah mahasiswa program studi terhadap jumlah DTPS yang tersaji pada Tabel 2.a LKPS dan Tabel 3.a.1 LKPS, untuk kelompok Sains Teknologi 15 â‰¤ Rasio Mahasiswa terhadap Dosen  â‰¤ 25', 'a', 'Dokumen', 'Rasio jumlah mahasiswa program studi terhadap jumlah DTPS yang tersaji pada Tabel 2.a LKPS dan Tabel 3.a.1 LKPS, untuk kelompok Sains Teknologi 15 â‰¤ RMD  â‰¤ 25', 1, '2022-01-14 11:49:48'),
(1100, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'STD-01.05/SPMI', 'Ketua Jurusan/Kepala Program Studi Diploma  4 harus memastikan Rasio jumlah mahasiswa program studi terhadap jumlah Dosen Tetap Program Studi untuk kelompok Sains Teknologi  adalah lebih besar atau sama dengan 15 tetapi kecil dari atau sama dengan 25, sedangkan untuk kelompok Sosial Humaniora lebih besar atau sama dengan 25 tetapi kecil dari atau sama dengan 35', '16', 'Tersedianya bukti sahih Rasio jumlah mahasiswa program\nstudi terhadap jumlah DTPS yang tersaji pada Tabel 2.a LKPS dan \nTabel 3.a.1) LKPS, untuk kelompok Sosial Humaniora 25 â‰¤ Rasio Mahasiswa terhadap Dosen  â‰¤ 35', 'b', '-', '0', 1, '2022-01-14 11:50:10'),
(1101, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'STD-01.05/SPMI', 'Ketua Jurusan/Kepala Program Studi Diploma  4 harus memastikan Rasio jumlah mahasiswa program studi terhadap jumlah Dosen Tetap Program Studi untuk kelompok Sains Teknologi  adalah lebih besar atau sama dengan 15 tetapi kecil dari atau sama dengan 25, sedangkan untuk kelompok Sosial Humaniora lebih besar atau sama dengan 25 tetapi kecil dari atau sama dengan 35', '16', 'Tersedianya bukti sahih Rasio jumlah mahasiswa program\nstudi terhadap jumlah DTPS yang tersaji pada Tabel 2.a LKPS dan \nTabel 3.a.1) LKPS, untuk kelompok Sosial Humaniora 25 â‰¤ Rasio Mahasiswa terhadap Dosen  â‰¤ 35', 'b', 'Dokumen', 'Rasio jumlah mahasiswa program studi terhadap jumlah DTPS yang tersaji pada Tabel 2.a LKPS dan Tabel 3.a.1 LKPS, untuk kelompok Sosial Humaniora 25 â‰¤ RMD â‰¤ 35', 1, '2022-01-14 11:50:39'),
(1102, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'STD-01.05/SPMI', 'Wakil Direktur I berkoordinasi dengan Direktur harus memastikan Rasio jumlah mahasiswa terhadap jumlah dosen tetap adalah besar dari atau sama dengan 12 dan kecil dari atau sama dengan 24', '17', '0', '0', '0', '0', 1, '2022-01-14 11:51:03'),
(1103, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'STD-01.05/SPMI', 'Wakil Direktur I berkoordinasi dengan Direktur harus memastikan Rasio jumlah mahasiswa terhadap jumlah dosen tetap adalah besar dari atau sama dengan 12 dan kecil dari atau sama dengan 24', '17', 'Tersedianya bukti sahih terkait Rasio jumlah mahasiswa terhadap jumlah dosen tetap (RMDT) adalah besar dari atau sama dengan 12 dan kecil dari atau sama dengan 24 yang tersaji pada Tabel 3.b LKPT Beban Kerja Dosen', 'a', '-', '0', 1, '2022-01-14 11:51:22'),
(1104, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'STD-01.05/SPMI', 'Wakil Direktur I berkoordinasi dengan Direktur harus memastikan Rasio jumlah mahasiswa terhadap jumlah dosen tetap adalah besar dari atau sama dengan 12 dan kecil dari atau sama dengan 24', '17', 'Tersedianya bukti sahih terkait Rasio jumlah mahasiswa terhadap jumlah dosen tetap (RMDT) adalah besar dari atau sama dengan 12 dan kecil dari atau sama dengan 24 yang tersaji pada Tabel 3.b LKPT Beban Kerja Dosen', 'a', 'Dokumen', 'Tabel 3.b LKPT Beban Kerja Dosen', 1, '2022-01-14 11:51:38'),
(1105, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'STD-01.05/SPMI', 'Ketua Jurusan/Kepala Program Studi Diploma 3, Diploma  4 dan Magister Terapan harus memastikan Penugasan Dosen Tetap Program Studi sebagai pembimbing utama tugas akhir mahasiswa di program studi pada satu semester adalah  â‰¤ 6', '18', '0', '0', '0', '0', 1, '2022-01-14 11:51:59'),
(1106, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'STD-01.05/SPMI', 'Ketua Jurusan/Kepala Program Studi Diploma 3, Diploma  4 dan Magister Terapan harus memastikan Penugasan Dosen Tetap Program Studi sebagai pembimbing utama tugas akhir mahasiswa di program studi pada satu semester adalah  â‰¤ 6', '18', 'Tersedianya bukti sahih penugasan DTPS sebagai pembimbing utama (Tabel 3.a.2 LKPS Penugasan DTPS sebagai pembimbing utama)', 'a', '-', '0', 1, '2022-01-14 11:52:18'),
(1107, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'STD-01.05/SPMI', 'Ketua Jurusan/Kepala Program Studi Diploma 3, Diploma  4 dan Magister Terapan harus memastikan Penugasan Dosen Tetap Program Studi sebagai pembimbing utama tugas akhir mahasiswa di program studi pada satu semester adalah  â‰¤ 6', '18', 'Tersedianya bukti sahih penugasan DTPS sebagai pembimbing utama (Tabel 3.a.2 LKPS Penugasan DTPS sebagai pembimbing utama)', 'a', 'Dokumen', 'Tabel 3.a.2 LKPS Penugasan DTPS sebagai pembimbing utama', 1, '2022-01-14 11:52:33'),
(1108, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'STD-01.05/SPMI', 'Ketua Jurusan/Kepala Program Studi Diploma 3, Diploma  4 dan Magister Terapan harus memastikan Ekuivalensi Waktu Mengajar Penuh Dosen Tetap Program Studi adalah lebih besar atau sama dengan 12 dan kecil dari atau sama dengan 16', '19', '0', '0', '0', '0', 1, '2022-01-19 13:46:55'),
(1109, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'STD-01.05/SPMI', 'Ketua Jurusan/Kepala Program Studi Diploma 3, Diploma  4 dan Magister Terapan harus memastikan Ekuivalensi Waktu Mengajar Penuh Dosen Tetap Program Studi adalah lebih besar atau sama dengan 12 dan kecil dari atau sama dengan 16', '19', 'Tersedianya bukti sahih yang tersaji pada Tabel 3.a.3 LKPS  Ekuivalensi Waktu Mengajar (EWM)', 'A', '-', '0', 1, '2022-01-19 13:47:23'),
(1110, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'STD-01.05/SPMI', 'Ketua Jurusan/Kepala Program Studi Diploma 3, Diploma  4 dan Magister Terapan harus memastikan Ekuivalensi Waktu Mengajar Penuh Dosen Tetap Program Studi adalah lebih besar atau sama dengan 12 dan kecil dari atau sama dengan 16', '19', 'Tersedianya bukti sahih yang tersaji pada Tabel 3.a.3 LKPS  Ekuivalensi Waktu Mengajar (EWM)', 'A', 'Dokumen', 'Tabel 3.a.3 LKPS Ekuivalensi WM', 1, '2022-01-19 13:47:40'),
(1111, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'STD-01.05/SPMI', 'Ketua Jurusan/Kepala Program Studi Diploma 3, Diploma 4 dan Magister Terapan harus memastikan jumlah dosen tidak tetap yang ditugaskan sebagai pengampu matakuilah di program studi  adalah â‰¤ 10% dari jumlah Dosen Tetap yang ditugaskan sebagai pengampu mata kuliah di program studi dan memenuhi kualifikasi yang sudah ditetapkan di Politeknik Negeri Medan dan dievaluasi pelaksanaannya setiap akhir semester', '20', '0', '0', '0', '0', 1, '2022-01-19 13:48:09'),
(1112, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'STD-01.05/SPMI', 'Ketua Jurusan/Kepala Program Studi Diploma 3, Diploma 4 dan Magister Terapan harus memastikan jumlah dosen tidak tetap yang ditugaskan sebagai pengampu matakuilah di program studi  adalah â‰¤ 10% dari jumlah Dosen Tetap yang ditugaskan sebagai pengampu mata kuliah di program studi dan memenuhi kualifikasi yang sudah ditetapkan di Politeknik Negeri Medan dan dievaluasi pelaksanaannya setiap akhir semester', '20', 'Tersedianya bukti persentase  Dosen tidak tetap  yang tersaji pada Tabel 3.a.4) LKPS', 'a', '-', '0', 1, '2022-01-19 13:48:34'),
(1113, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'STD-01.05/SPMI', 'Ketua Jurusan/Kepala Program Studi Diploma 3, Diploma 4 dan Magister Terapan harus memastikan jumlah dosen tidak tetap yang ditugaskan sebagai pengampu matakuilah di program studi  adalah â‰¤ 10% dari jumlah Dosen Tetap yang ditugaskan sebagai pengampu mata kuliah di program studi dan memenuhi kualifikasi yang sudah ditetapkan di Politeknik Negeri Medan dan dievaluasi pelaksanaannya setiap akhir semester', '20', 'Tersedianya bukti persentase  Dosen tidak tetap  yang tersaji pada Tabel 3.a.4) LKPS', 'a', 'Dokumen', 'Data persentase  Dosen tidak tetap  yang tersaji pada Tabel 3.a.4 LKPS', 1, '2022-01-19 13:48:53'),
(1114, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'STD-01.05/SPMI', 'Ketua Jurusan/Kepala Program Studi Diploma 3, Diploma 4 dan Magister Terapan harus memastikan jumlah dosen tidak tetap yang ditugaskan sebagai pengampu matakuilah di program studi  adalah â‰¤ 10% dari jumlah Dosen Tetap yang ditugaskan sebagai pengampu mata kuliah di program studi dan memenuhi kualifikasi yang sudah ditetapkan di Politeknik Negeri Medan dan dievaluasi pelaksanaannya setiap akhir semester', '20', 'Tersedianya bukti sahih terkait kualifikasi Dosen tidak tetap dan evaluasi penugasan ', 'b', '-', '0', 1, '2022-01-19 13:49:21'),
(1115, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'STD-01.05/SPMI', 'Ketua Jurusan/Kepala Program Studi Diploma 3, Diploma 4 dan Magister Terapan harus memastikan jumlah dosen tidak tetap yang ditugaskan sebagai pengampu matakuilah di program studi  adalah â‰¤ 10% dari jumlah Dosen Tetap yang ditugaskan sebagai pengampu mata kuliah di program studi dan memenuhi kualifikasi yang sudah ditetapkan di Politeknik Negeri Medan dan dievaluasi pelaksanaannya setiap akhir semester', '20', 'Tersedianya bukti sahih terkait kualifikasi Dosen tidak tetap dan evaluasi penugasan ', 'b', 'Dokumen', 'Rekapitulasi data kualifikasi dosen tidak tetap (Sertifikat yang dimiliki dan publikasi, Surat lamaran, dan persyaratan lain yang harus dipenuhi sesuai ketentuan) ', 1, '2022-01-19 13:49:37'),
(1116, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'STD-01.05/SPMI', 'Wakil Direktur I dan II harus memastikan persentase  jumlah dosen tidak tetap terhadap jumlah seluruh dosen (dosen tetap dan dosen tidak tetap)  adalah â‰¤ 10%  dan memenuhi kualifikasi yang sudah ditetapkan di Politeknik Negeri Medan dan dievaluasi pelaksanaannya setiap akhir semester', '21', '0', '0', '0', '0', 1, '2022-01-19 13:50:06'),
(1117, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'STD-01.05/SPMI', 'Wakil Direktur I dan II harus memastikan persentase  jumlah dosen tidak tetap terhadap jumlah seluruh dosen (dosen tetap dan dosen tidak tetap)  adalah â‰¤ 10%  dan memenuhi kualifikasi yang sudah ditetapkan di Politeknik Negeri Medan dan dievaluasi pelaksanaannya setiap akhir semester', '21', 'Tersedianya bukti persentase  Dosen tidak tetap  yang tersaji pada Tabel 3.a.4 LKPT Dosen Tidak Tetap', 'a', '-', '0', 1, '2022-01-19 13:50:33'),
(1118, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'STD-01.05/SPMI', 'Wakil Direktur I dan II harus memastikan persentase  jumlah dosen tidak tetap terhadap jumlah seluruh dosen (dosen tetap dan dosen tidak tetap)  adalah â‰¤ 10%  dan memenuhi kualifikasi yang sudah ditetapkan di Politeknik Negeri Medan dan dievaluasi pelaksanaannya setiap akhir semester', '21', 'Tersedianya bukti persentase  Dosen tidak tetap  yang tersaji pada Tabel 3.a.4 LKPT Dosen Tidak Tetap', 'a', 'Dokumen', 'Data persentase  Dosen tidak tetap  yang tersaji pada Tabel 3.a.4 LKPT Dosen Tidak Tetap', 1, '2022-01-19 13:50:53'),
(1119, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'STD-01.05/SPMI', 'Wakil Direktur I dan II harus memastikan persentase  jumlah dosen tidak tetap terhadap jumlah seluruh dosen (dosen tetap dan dosen tidak tetap)  adalah â‰¤ 10%  dan memenuhi kualifikasi yang sudah ditetapkan di Politeknik Negeri Medan dan dievaluasi pelaksanaannya setiap akhir semester', '21', 'Tersedianya bukti sahih terkait kualifikasi Dosen tidak tetap dan evaluasi penugasan ', 'b', '-', '0', 1, '2022-01-19 13:51:20'),
(1120, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'STD-01.05/SPMI', 'Ketua Jurusan/Kepala Program Studi Diploma 3, Diploma 4 dan Magister Terapan harus memastikan jumlah dosen tidak tetap yang ditugaskan sebagai pengampu matakuilah di program studi  adalah â‰¤ 10% dari jumlah Dosen Tetap yang ditugaskan sebagai pengampu mata kuliah di program studi dan memenuhi kualifikasi yang sudah ditetapkan di Politeknik Negeri Medan dan dievaluasi pelaksanaannya setiap akhir semester', '20', 'Tersedianya bukti sahih terkait kualifikasi Dosen tidak tetap dan evaluasi penugasan ', 'b', 'Dokumen', 'Rekapitulasi data kualifikasi dosen tidak tetap (Sertifikat yang dimiliki dan publikasi, Surat lamaran, dan persyaratan lain yang harus dipenuhi sesuai ketentuan). ', 1, '2022-01-19 13:52:26'),
(1121, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'STD-01.05/SPMI', 'Ketua Jurusan/Kepala Program Studi Diploma 3 dan Diploma 4  harus memastikan persentase keterlibatan dosen industri/praktisi dalam mengampu matakuliah kompetensi adalah â‰¥ 20% dari jumlah matakuliah kompetensi dan sesuai dengan kualifikasi yang ditetapkan Politeknik Negeri  Medan untuk Dosen industri/praktisi', '22', '0', '0', '0', '0', 1, '2022-01-19 13:52:59'),
(1122, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'STD-01.05/SPMI', 'Ketua Jurusan/Kepala Program Studi Diploma 3 dan Diploma 4  harus memastikan persentase keterlibatan dosen industri/praktisi dalam mengampu matakuliah kompetensi adalah â‰¥ 20% dari jumlah matakuliah kompetensi dan sesuai dengan kualifikasi yang ditetapkan Politeknik Negeri  Medan untuk Dosen industri/praktisi', '22', 'Tersedianya bukti sahih terkait persentase keterlibatan dosen industri/praktisi dalam mengampu matakuliah kompetensi (PMKI) adalah â‰¥ 20%  yang tersaji pada Tabel 3.a.5) LKPS', 'a', '-', '0', 1, '2022-01-19 13:53:21'),
(1123, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'STD-01.05/SPMI', 'Ketua Jurusan/Kepala Program Studi Diploma 3 dan Diploma 4  harus memastikan persentase keterlibatan dosen industri/praktisi dalam mengampu matakuliah kompetensi adalah â‰¥ 20% dari jumlah matakuliah kompetensi dan sesuai dengan kualifikasi yang ditetapkan Politeknik Negeri  Medan untuk Dosen industri/praktisi', '22', 'Tersedianya bukti sahih terkait persentase keterlibatan dosen industri/praktisi dalam mengampu matakuliah kompetensi (PMKI) adalah â‰¥ 20%  yang tersaji pada Tabel 3.a.5) LKPS', 'a', 'Dokumen', 'Persentase keterlibatan dosen industri/praktisi dalam mengampu matakuliah kompetensi (PMKI) adalah â‰¥ 20%  yang tersaji pada Tabel 3.a.5) LKPS', 1, '2022-01-19 13:53:41'),
(1124, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'STD-01.05/SPMI', 'Ketua Jurusan/Kepala Program Studi Diploma 3 dan Diploma 4  harus memastikan persentase keterlibatan dosen industri/praktisi dalam mengampu matakuliah kompetensi adalah â‰¥ 20% dari jumlah matakuliah kompetensi dan sesuai dengan kualifikasi yang ditetapkan Politeknik Negeri  Medan untuk Dosen industri/praktisi', '22', 'Tersedianya kualifikasi untuk dosen industri/praktisi', 'b', '-', '0', 1, '2022-01-19 13:54:03'),
(1125, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'STD-01.05/SPMI', 'Ketua Jurusan/Kepala Program Studi Diploma 3 dan Diploma 4  harus memastikan persentase keterlibatan dosen industri/praktisi dalam mengampu matakuliah kompetensi adalah â‰¥ 20% dari jumlah matakuliah kompetensi dan sesuai dengan kualifikasi yang ditetapkan Politeknik Negeri  Medan untuk Dosen industri/praktisi', '22', 'Tersedianya kualifikasi untuk dosen industri/praktisi', 'b', 'Dokumen', ' kualifikasi untuk dosen industri/praktis', 1, '2022-01-19 13:54:30'),
(1126, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'STD-01.05/SPMI', 'Ketua Jurusan/Kepala Program Studi Diploma 3   harus memastikan jumlah pengakuan/rekognisi atas kepakaran/prestasi/ kinerja Dosen Tetap Program Studi terhadap jumlah Dosen Tetap dalam 3 tahun terakhir adalah â‰¥ 0,25 ', '23', '0', '0', '0', '0', 1, '2022-01-19 13:54:59'),
(1127, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'STD-01.05/SPMI', 'Ketua Jurusan/Kepala Program Studi Diploma 3   harus memastikan jumlah pengakuan/rekognisi atas kepakaran/prestasi/ kinerja Dosen Tetap Program Studi terhadap jumlah Dosen Tetap dalam 3 tahun terakhir adalah â‰¥ 0,25 ', '23', '\"Tersedianya  bukti sahih Pengakuan/rekognisi\natas kepakaran/ prestasi/kinerja DTPS.\nTabel 3.b.1) LKPS\"', 'a', '-', '0', 1, '2022-01-19 13:57:42'),
(1128, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'STD-01.05/SPMI', 'Ketua Jurusan/Kepala Program Studi Diploma 3   harus memastikan jumlah pengakuan/rekognisi atas kepakaran/prestasi/ kinerja Dosen Tetap Program Studi terhadap jumlah Dosen Tetap dalam 3 tahun terakhir adalah â‰¥ 0,25 ', '23', '\"Tersedianya  bukti sahih Pengakuan/rekognisi\natas kepakaran/ prestasi/kinerja DTPS.\nTabel 3.b.1) LKPS\"', 'a', 'Dokumen', '\"Pengakuan/ rekognisi atas kepakaran/ prestasi/kinerja DTPS. Tabel 3.b.1) LKPS\"', 1, '2022-01-19 13:58:01'),
(1129, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'STD-01.05/SPMI', 'Ketua Jurusan/Kepala Program Studi Diploma 4   harus memastikan jumlah pengakuan/rekognisi atas kepakaran/prestasi/ kinerja Dosen Tetap Program Studi terhadap jumlah Dosen Tetap dalam 3 tahun terakhir adalah â‰¥ 0,5', '24', '0', '0', '0', '0', 1, '2022-01-19 13:59:31'),
(1130, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'STD-01.05/SPMI', 'Ketua Jurusan/Kepala Program Studi Diploma 4   harus memastikan jumlah pengakuan/rekognisi atas kepakaran/prestasi/ kinerja Dosen Tetap Program Studi terhadap jumlah Dosen Tetap dalam 3 tahun terakhir adalah â‰¥ 0,5', '24', '\"Tersedianya  bukti sahih Pengakuan/rekognisiatas kepakaran/ prestasi/kinerja DTPS Tabel 3.b.1) LKPS\"', 'a', '-', '0', 1, '2022-01-19 14:00:05'),
(1131, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'STD-01.05/SPMI', 'Ketua Jurusan/Kepala Program Studi Diploma 4   harus memastikan jumlah pengakuan/rekognisi atas kepakaran/prestasi/ kinerja Dosen Tetap Program Studi terhadap jumlah Dosen Tetap dalam 3 tahun terakhir adalah â‰¥ 0,5', '24', '\"Tersedianya  bukti sahih Pengakuan/rekognisiatas kepakaran/ prestasi/kinerja DTPS Tabel 3.b.1) LKPS\"', 'a', 'Dokumen', '\"Pengakuan/ rekognisi atas kepakaran/ prestasi/kinerja DTPS. Tabel 3.b.1) LKPS\"', 1, '2022-01-19 14:00:26'),
(1132, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'STD-01.05/SPMI', 'Ketua Jurusan/Kepala Program Studi Magister Terapan  harus memastikan jumlah pengakuan/rekognisi atas kepakaran/prestasi/ kinerja Dosen Tetap Program Studi terhadap jumlah Dosen Tetap dalam 3 tahun terakhir adalah â‰¥ 1', '25', '0', '0', '0', '0', 1, '2022-01-19 14:23:07'),
(1133, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'STD-01.05/SPMI', 'Ketua Jurusan/Kepala Program Studi Magister Terapan  harus memastikan jumlah pengakuan/rekognisi atas kepakaran/prestasi/ kinerja Dosen Tetap Program Studi terhadap jumlah Dosen Tetap dalam 3 tahun terakhir adalah â‰¥ 1', '25', '\"Tersedianya  bukti sahih Pengakuan/rekognisiatas kepakaran/ prestasi/kinerja DTPS. Tabel 3.b.1 LKPS\"', 'a', '-', '0', 1, '2022-01-19 14:31:57'),
(1134, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'STD-01.05/SPMI', 'Ketua Jurusan/Kepala Program Studi Magister Terapan  harus memastikan jumlah pengakuan/rekognisi atas kepakaran/prestasi/ kinerja Dosen Tetap Program Studi terhadap jumlah Dosen Tetap dalam 3 tahun terakhir adalah â‰¥ 1', '25', '\"Tersedianya  bukti sahih Pengakuan/rekognisiatas kepakaran/ prestasi/kinerja DTPS Tabel 3.b.1 LKPS\"', 'a', 'Dokumen', '\"Pengakuan/ rekognisi atas kepakaran/ prestasi/kinerja DTPS. Tabel 3.b.1 LKPS\"', 1, '2022-01-19 14:24:02'),
(1136, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'STD-01.05/SPMI', 'Direktur  harus memastikan rata jumlah pengakuan/rekognisi atas kepakaran/prestasi/ kinerja Dosen terhadap jumlah Dosen Tetap dalam 3 tahun terakhir adalah â‰¥ 0,25', '26', '0', '0', '0', '0', 1, '2022-01-19 14:34:18'),
(1137, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'STD-01.05/SPMI', 'Direktur  harus memastikan rata jumlah pengakuan/rekognisi atas kepakaran/prestasi/ kinerja Dosen terhadap jumlah Dosen Tetap dalam 3 tahun terakhir adalah â‰¥ 0,25', '26', 'Tersedianya  bukti sahih terkait rata-rata jumlah pengakuan/rekognisi atas kepakaran/prestasi/kinerja Dosen terhadap jumlah Dosen TetapTabel 3.d LKPT Rekognisi Dosen', 'a', '-', '0', 1, '2022-01-19 14:34:51'),
(1138, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'STD-01.05/SPMI', 'Direktur  harus memastikan rata jumlah pengakuan/rekognisi atas kepakaran/prestasi/ kinerja Dosen terhadap jumlah Dosen Tetap dalam 3 tahun terakhir adalah â‰¥ 0,25', '26', 'Tersedianya  bukti sahih terkait rata-rata jumlah pengakuan/rekognisi atas kepakaran/prestasi/kinerja Dosen terhadap jumlah Dosen TetapTabel 3.d LKPT Rekognisi Dosen', 'a', 'Dokumen', '\"Pengakuan/ rekognisi atas kepakaran/ prestasi/kinerja Dosen terhadap jumlah Dosen TetapTabel 3.d LKPT Rekognisi Dosen\"', 1, '2022-01-19 14:35:16'),
(1139, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'STD-01.05/SPMI', 'Rata-rata hasil kinerja dosen yang digunakan oleh masyarakat atau mendapat Rekognisi Internasional', '27', '0', '0', '0', '0', 1, '2022-01-19 14:36:00'),
(1140, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'STD-01.05/SPMI', 'Rata-rata hasil kinerja dosen yang digunakan oleh masyarakat atau mendapat Rekognisi Internasional', '27', 'Tersedianya bukti sahih terkait hasil rekognisi dosen untuk luaran ilmiah terindeks global  â‰¥ 0,1 dari jumlah dosen tetap setiap tahunnya, atau', 'a', '-', '0', 1, '2022-01-19 14:36:24'),
(1141, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'STD-01.05/SPMI', 'Rata-rata hasil kinerja dosen yang digunakan oleh masyarakat atau mendapat Rekognisi Internasional', '27', 'Tersedianya bukti sahih terkait hasil rekognisi dosen untuk luaran ilmiah terindeks global  â‰¥ 0,1 dari jumlah dosen tetap setiap tahunnya, atau', 'a', 'Dokumen', 'Tabel Rekognisi dosen untuk luaran ilmiah terindeks global', 1, '2022-01-19 14:36:44'),
(1142, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'STD-01.05/SPMI', 'Rata-rata hasil kinerja dosen yang digunakan oleh masyarakat atau mendapat Rekognisi Internasional', '27', 'Tersedianya bukti sahih terkait hasil rekognisi dosen untuk konferensi/ seminar internasional sebagai diseminasi luaran ilmiah  â‰¥ 0,1 dari jumlah dosen tetap setiap tahunnya, atau ', 'b', '-', '0', 1, '2022-01-19 14:37:15'),
(1143, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'STD-01.05/SPMI', 'Rata-rata hasil kinerja dosen yang digunakan oleh masyarakat atau mendapat Rekognisi Internasional', '27', 'Tersedianya bukti sahih terkait hasil rekognisi dosen untuk konferensi/ seminar internasional sebagai diseminasi luaran ilmiah  â‰¥ 0,1 dari jumlah dosen tetap setiap tahunnya, atau ', 'b', 'Dokumen', 'Tabel Rekognisi dosen untuk  konferensi/seminar internasional sebagai diseminasi luaran ilmiah', 1, '2022-01-19 14:37:31'),
(1144, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'STD-01.05/SPMI', 'Rata-rata hasil kinerja dosen yang digunakan oleh masyarakat atau mendapat Rekognisi Internasional', '27', 'Tersedianya bukti sahih hasil rekognisi dosen pada media nasional dan internasional sebagai diseminasi luaran ilmiah â‰¥ 0,2 dari jumlah dosen tetap Politeknik Negeri Medan setiap tahunnya', 'c', '-', '0', 1, '2022-01-19 14:37:57'),
(1145, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'STD-01.05/SPMI', 'Rata-rata hasil kinerja dosen yang digunakan oleh masyarakat atau mendapat Rekognisi Internasional', '27', 'Tersedianya bukti sahih hasil rekognisi dosen pada media nasional dan internasional sebagai diseminasi luaran ilmiah â‰¥ 0,2 dari jumlah dosen tetap Politeknik Negeri Medan setiap tahunnya', 'c', 'Dokumen', 'Tabel Rekognisi dosen untuk media nasional dan internasional sebagai diseminasi luaran ilmiah', 1, '2022-01-19 14:38:12');

-- --------------------------------------------------------

--
-- Table structure for table `standarspmi`
--

CREATE TABLE `standarspmi` (
  `standarId` int(11) NOT NULL,
  `kodeStandar` varchar(50) NOT NULL,
  `namaStandar` varchar(100) NOT NULL,
  `userid` int(11) NOT NULL,
  `createdDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `standarspmi`
--

INSERT INTO `standarspmi` (`standarId`, `kodeStandar`, `namaStandar`, `userid`, `createdDate`) VALUES
(1, 'STD-01/SPMI', 'STANDAR PENDIDIKAN', 1, '2022-01-16 14:51:36'),
(2, 'STD-02/SPMI', 'STANDAR PENELITIAN', 1, '2022-01-16 14:51:45'),
(3, 'STD-03/SPMI', 'STANDAR PENGABDIAN', 1, '2022-01-16 14:51:50');

-- --------------------------------------------------------

--
-- Table structure for table `substandar`
--

CREATE TABLE `substandar` (
  `subStandarId` int(11) NOT NULL,
  `kodeStandar` varchar(100) NOT NULL,
  `kodeSubStandar` varchar(100) NOT NULL,
  `namaSubStandar` text NOT NULL,
  `linkStandarSPMI` text NOT NULL,
  `userid` int(11) NOT NULL,
  `createdDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `substandar`
--

INSERT INTO `substandar` (`subStandarId`, `kodeStandar`, `kodeSubStandar`, `namaSubStandar`, `linkStandarSPMI`, `userid`, `createdDate`) VALUES
(1, 'STD-01/SPMI', 'STD-01.05/SPMI', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'http://polmed', 1, '2022-01-16 15:02:20'),
(2, 'STD-01/SPMI', 'STD-01.02/SPMI', 'STANDAR ISI PEMBELAJARAN', 'http://polmed', 1, '2022-01-16 15:02:25'),
(3, 'STD-01/SPMI', 'STD-01.01/SPMI', 'STANDAR KOMPETENSI LULUSAN', 'http://polmed', 1, '2022-01-16 15:02:29'),
(4, 'STD-01/SPMI', 'STD-01.04/SPMI', 'STANDAR PENILAIAN PEMBELAJARAN', 'http://polmed', 1, '2022-01-16 15:02:33'),
(5, 'STD-01/SPMI', 'STD-01.03/SPMI', 'STANDAR PROSES PEMBELAJARAN', 'http://polmed', 1, '2022-01-16 15:02:37');

-- --------------------------------------------------------

--
-- Table structure for table `tahun`
--

CREATE TABLE `tahun` (
  `idTahun` int(11) NOT NULL,
  `namaTahun` varchar(200) NOT NULL,
  `status` double NOT NULL,
  `userid` int(11) NOT NULL,
  `createdDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tahun`
--

INSERT INTO `tahun` (`idTahun`, `namaTahun`, `status`, `userid`, `createdDate`) VALUES
(16, '2021', 1, 1, '2022-01-04 19:47:15'),
(21, '2022', 0, 1, '2022-01-05 14:25:45'),
(22, '2023', 0, 1, '2022-01-07 06:31:09'),
(23, '2020', 0, 1, '2022-01-07 06:31:35'),
(24, '2024', 0, 1, '2022-01-07 06:31:35');

-- --------------------------------------------------------

--
-- Table structure for table `tc`
--

CREATE TABLE `tc` (
  `idTC` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `periode` int(15) NOT NULL,
  `standarid` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `idJenjang` int(11) NOT NULL,
  `berlaku` date NOT NULL,
  `expired` date NOT NULL,
  `userid` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `createdDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tingkatanpt`
--

CREATE TABLE `tingkatanpt` (
  `tingkatanid` int(11) NOT NULL,
  `tingkatan` varchar(200) NOT NULL,
  `userid` int(11) NOT NULL,
  `createdDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tingkatanpt`
--

INSERT INTO `tingkatanpt` (`tingkatanid`, `tingkatan`, `userid`, `createdDate`) VALUES
(5, 'Diploma 3', 1, '2021-11-30 09:42:40'),
(6, 'Sarjana Terapan', 1, '2021-11-03 20:14:38'),
(8, 'Magister Terapan', 1, '2021-11-30 09:42:55');

-- --------------------------------------------------------

--
-- Table structure for table `tools`
--

CREATE TABLE `tools` (
  `idTools` int(11) NOT NULL,
  `namaTools` varchar(200) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tools`
--

INSERT INTO `tools` (`idTools`, `namaTools`, `status`) VALUES
(1, 'Add', '1'),
(2, 'Edit', '2'),
(3, 'Delete', '3'),
(4, 'Select', '4'),
(5, 'Print', '5'),
(6, 'Check', '6');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userid` int(11) NOT NULL,
  `nip` varchar(16) DEFAULT NULL,
  `nidn` varchar(30) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `frontTitle` varchar(20) NOT NULL,
  `endTitle` varchar(20) NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `tanggalLahir` date NOT NULL,
  `pascasarjana` varchar(40) NOT NULL,
  `jabatan` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `token` text NOT NULL,
  `imageProfile` varchar(100) NOT NULL DEFAULT 'user-default.png',
  `role` int(11) NOT NULL,
  `idprogramstudi` int(11) NOT NULL,
  `createdDate` datetime NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userid`, `nip`, `nidn`, `firstName`, `lastName`, `frontTitle`, `endTitle`, `gender`, `tanggalLahir`, `pascasarjana`, `jabatan`, `email`, `password`, `token`, `imageProfile`, `role`, `idprogramstudi`, `createdDate`, `status`) VALUES
(1, '343434343', '7878', 'Super', 'User', 'Mr', 'Sp.PD', 1, '2011-11-10', 'Sastra', 'd', 'simutu@hexcod.com', '55131f0ffa8c6ddfc0101afc7400f576', '', 'e41bd346fbbdd0c25f1e71e1275b9557.jpg', 1, 10051, '2021-11-12 02:09:09', 1),
(74, '1977070120021220', '0001077702', 'Vivianti', 'Novita', '', 'S.E., M.Si.', 0, '1977-07-01', 'S2', 'Lektor', 'viviantinovita@polmed.ac.id', '54fbc9f34c428ffc7f03d9542b73e6e4', '-', '', 9, 10051, '2021-11-18 14:42:13', 1),
(76, '1980092420150420', '0124098003', 'Nurlinda', '-', 'Dr.', 'S.E., Ak., M.Si., CA', 0, '1980-09-24', 'S3', 'Lektor', 'nurlinda@polmed.ac.id', '96ecc6e2ad8c7835b4839c75e9d8c5bf', '-', '', 4, 10048, '2021-11-18 13:32:37', 1),
(78, '1981031020150410', '-', 'Junus', 'Sinuraya', '', 'M.Kom', 1, '2021-11-20', '-', '-', 'junussinuraya@polmed.ac.id', 'e5849ddc7bf0abc46e29d96a05883df7', '-', '-', 10, 10046, '2021-11-20 04:53:58', 1),
(86, '1971061120021220', '-', 'Enda', 'Yunita Surbakti', '', 'S.E., Ak., M.Si.', 1, '2022-01-10', '-', '-', 'endayunita@polmed.ac.id', '4fbb7be67eef9f72773e4d8911dc85c3', '-', '-', 3, 10051, '2022-01-10 11:46:54', 1),
(87, '123456', '-', 'Nursiah', 'Fitri', '', 'MSI', 1, '2022-01-13', '-', '-', 'fitri@polmed.ac.id', 'e10adc3949ba59abbe56e057f20f883e', '-', '-', 3, 10053, '2022-01-13 16:32:27', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access`
--
ALTER TABLE `access`
  ADD PRIMARY KEY (`accessid`),
  ADD KEY `roleid` (`roleid`),
  ADD KEY `menuid` (`menuid`);

--
-- Indexes for table `audit`
--
ALTER TABLE `audit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `audit_old`
--
ALTER TABLE `audit_old`
  ADD PRIMARY KEY (`auditid`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `bentukpt`
--
ALTER TABLE `bentukpt`
  ADD PRIMARY KEY (`bentukptid`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`depid`),
  ADD KEY `userid` (`userid`),
  ADD KEY `institusiid` (`institusiid`);

--
-- Indexes for table `dokumen`
--
ALTER TABLE `dokumen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`),
  ADD KEY `penilaian` (`penilaian`);

--
-- Indexes for table `enrollment`
--
ALTER TABLE `enrollment`
  ADD PRIMARY KEY (`enrollmentid`),
  ADD KEY `userid` (`userid`),
  ADD KEY `roleid` (`roleid`);

--
-- Indexes for table `indikator`
--
ALTER TABLE `indikator`
  ADD PRIMARY KEY (`indikatorId`),
  ADD KEY `kodeIndikator` (`kodeIndikator`),
  ADD KEY `userid` (`userid`),
  ADD KEY `kodePernyataan` (`kodePernyataan`);

--
-- Indexes for table `indikatordokumen`
--
ALTER TABLE `indikatordokumen`
  ADD PRIMARY KEY (`indikatorDokumenId`),
  ADD KEY `userid` (`userid`),
  ADD KEY `kodeIndikator` (`kodeIndikator`);

--
-- Indexes for table `institusi`
--
ALTER TABLE `institusi`
  ADD PRIMARY KEY (`institusiid`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `institusidokumen`
--
ALTER TABLE `institusidokumen`
  ADD PRIMARY KEY (`dokumeninstitusiid`),
  ADD KEY `userid` (`userid`),
  ADD KEY `institusiid` (`institusiid`);

--
-- Indexes for table `istitusicomplete`
--
ALTER TABLE `istitusicomplete`
  ADD PRIMARY KEY (`institusicompleteid`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`idJabatan`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `jadwalpelaksanaan`
--
ALTER TABLE `jadwalpelaksanaan`
  ADD PRIMARY KEY (`idJadwalPelaksanaan`),
  ADD KEY `idUnit` (`idUnit`),
  ADD KEY `idtahun` (`idtahun`),
  ADD KEY `idperiode` (`idperiode`),
  ADD KEY `jadwalPelaksanaan_ibfk_3` (`userid`);

--
-- Indexes for table `jenisps`
--
ALTER TABLE `jenisps`
  ADD PRIMARY KEY (`jenisid`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `jenjang`
--
ALTER TABLE `jenjang`
  ADD PRIMARY KEY (`idJenjang`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`jurusanid`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `keys`
--
ALTER TABLE `keys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lampirandokumen`
--
ALTER TABLE `lampirandokumen`
  ADD PRIMARY KEY (`idLampiranDokumen`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `limits`
--
ALTER TABLE `limits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`logid`);

--
-- Indexes for table `loginstatus`
--
ALTER TABLE `loginstatus`
  ADD PRIMARY KEY (`loginid`);

--
-- Indexes for table `lokasi`
--
ALTER TABLE `lokasi`
  ADD PRIMARY KEY (`idLokasi`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pelaksanaan`
--
ALTER TABLE `pelaksanaan`
  ADD PRIMARY KEY (`idPelaksanaan`),
  ADD KEY `idprogramstudi` (`idprogramstudi`),
  ADD KEY `idTC` (`idTC`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `pelaksanaanaudit`
--
ALTER TABLE `pelaksanaanaudit`
  ADD PRIMARY KEY (`idPelaksanaanAudit`),
  ADD KEY `idTC` (`idTC`),
  ADD KEY `auditid` (`auditid`),
  ADD KEY `idprogramstudi` (`idprogramstudi`);

--
-- Indexes for table `penanggungjawab`
--
ALTER TABLE `penanggungjawab`
  ADD PRIMARY KEY (`idPenanggungJawab`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `penetapandepartemen`
--
ALTER TABLE `penetapandepartemen`
  ADD PRIMARY KEY (`idPenetapanDepartemen`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `penetapandetailspmi`
--
ALTER TABLE `penetapandetailspmi`
  ADD PRIMARY KEY (`penetapanDetailId`);

--
-- Indexes for table `penetapaninstitusi`
--
ALTER TABLE `penetapaninstitusi`
  ADD PRIMARY KEY (`idPenetapanInstitusi`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `penetapanstandarspmi`
--
ALTER TABLE `penetapanstandarspmi`
  ADD PRIMARY KEY (`penetapanid`),
  ADD KEY `periode` (`periode`),
  ADD KEY `idprogramstudi` (`idprogramstudi`);

--
-- Indexes for table `pengelolanpt`
--
ALTER TABLE `pengelolanpt`
  ADD PRIMARY KEY (`pengelolaanptid`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `penilaian`
--
ALTER TABLE `penilaian`
  ADD PRIMARY KEY (`idPenilaian`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `peringkatakreditasi`
--
ALTER TABLE `peringkatakreditasi`
  ADD PRIMARY KEY (`rankid`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `periode`
--
ALTER TABLE `periode`
  ADD PRIMARY KEY (`idPeriode`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `pernyataan`
--
ALTER TABLE `pernyataan`
  ADD PRIMARY KEY (`pernyataanId`),
  ADD KEY `kodeSubStandar` (`kodeSubStandar`),
  ADD KEY `userid` (`userid`),
  ADD KEY `kodePernyataan` (`kodePernyataan`);

--
-- Indexes for table `programstudi`
--
ALTER TABLE `programstudi`
  ADD PRIMARY KEY (`idprogramstudi`),
  ADD KEY `userid` (`userid`),
  ADD KEY `jurusanid` (`jurusanKode`),
  ADD KEY `jurusanid_2` (`jurusanKode`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`roleid`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `ruanglingkup`
--
ALTER TABLE `ruanglingkup`
  ADD PRIMARY KEY (`lingkupid`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `sidemenu`
--
ALTER TABLE `sidemenu`
  ADD PRIMARY KEY (`menuid`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `standar`
--
ALTER TABLE `standar`
  ADD PRIMARY KEY (`standarid`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `standarspmi`
--
ALTER TABLE `standarspmi`
  ADD PRIMARY KEY (`standarId`),
  ADD KEY `userid` (`userid`),
  ADD KEY `kodeStandar` (`kodeStandar`);

--
-- Indexes for table `substandar`
--
ALTER TABLE `substandar`
  ADD PRIMARY KEY (`subStandarId`),
  ADD KEY `userid` (`userid`),
  ADD KEY `kodeStandar` (`kodeStandar`),
  ADD KEY `kodeSubStandar` (`kodeSubStandar`);

--
-- Indexes for table `tahun`
--
ALTER TABLE `tahun`
  ADD PRIMARY KEY (`idTahun`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `tc`
--
ALTER TABLE `tc`
  ADD PRIMARY KEY (`idTC`),
  ADD KEY `userid` (`userid`),
  ADD KEY `idJenjang` (`idJenjang`),
  ADD KEY `standarid` (`id`),
  ADD KEY `standarid_2` (`standarid`),
  ADD KEY `tahun` (`tahun`);

--
-- Indexes for table `tingkatanpt`
--
ALTER TABLE `tingkatanpt`
  ADD PRIMARY KEY (`tingkatanid`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `tools`
--
ALTER TABLE `tools`
  ADD PRIMARY KEY (`idTools`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userid`),
  ADD UNIQUE KEY `nip` (`nip`),
  ADD KEY `idprogramstudi` (`idprogramstudi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `access`
--
ALTER TABLE `access`
  MODIFY `accessid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `audit`
--
ALTER TABLE `audit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `audit_old`
--
ALTER TABLE `audit_old`
  MODIFY `auditid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bentukpt`
--
ALTER TABLE `bentukpt`
  MODIFY `bentukptid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `depid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dokumen`
--
ALTER TABLE `dokumen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT for table `enrollment`
--
ALTER TABLE `enrollment`
  MODIFY `enrollmentid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `indikator`
--
ALTER TABLE `indikator`
  MODIFY `indikatorId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `indikatordokumen`
--
ALTER TABLE `indikatordokumen`
  MODIFY `indikatorDokumenId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=197;

--
-- AUTO_INCREMENT for table `institusi`
--
ALTER TABLE `institusi`
  MODIFY `institusiid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `institusidokumen`
--
ALTER TABLE `institusidokumen`
  MODIFY `dokumeninstitusiid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `istitusicomplete`
--
ALTER TABLE `istitusicomplete`
  MODIFY `institusicompleteid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `idJabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jadwalpelaksanaan`
--
ALTER TABLE `jadwalpelaksanaan`
  MODIFY `idJadwalPelaksanaan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jenisps`
--
ALTER TABLE `jenisps`
  MODIFY `jenisid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jenjang`
--
ALTER TABLE `jenjang`
  MODIFY `idJenjang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `jurusanid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `keys`
--
ALTER TABLE `keys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `lampirandokumen`
--
ALTER TABLE `lampirandokumen`
  MODIFY `idLampiranDokumen` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `limits`
--
ALTER TABLE `limits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `logid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loginstatus`
--
ALTER TABLE `loginstatus`
  MODIFY `loginid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lokasi`
--
ALTER TABLE `lokasi`
  MODIFY `idLokasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pelaksanaan`
--
ALTER TABLE `pelaksanaan`
  MODIFY `idPelaksanaan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pelaksanaanaudit`
--
ALTER TABLE `pelaksanaanaudit`
  MODIFY `idPelaksanaanAudit` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `penanggungjawab`
--
ALTER TABLE `penanggungjawab`
  MODIFY `idPenanggungJawab` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `penetapandepartemen`
--
ALTER TABLE `penetapandepartemen`
  MODIFY `idPenetapanDepartemen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `penetapandetailspmi`
--
ALTER TABLE `penetapandetailspmi`
  MODIFY `penetapanDetailId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `penetapaninstitusi`
--
ALTER TABLE `penetapaninstitusi`
  MODIFY `idPenetapanInstitusi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `penetapanstandarspmi`
--
ALTER TABLE `penetapanstandarspmi`
  MODIFY `penetapanid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pengelolanpt`
--
ALTER TABLE `pengelolanpt`
  MODIFY `pengelolaanptid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `penilaian`
--
ALTER TABLE `penilaian`
  MODIFY `idPenilaian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `peringkatakreditasi`
--
ALTER TABLE `peringkatakreditasi`
  MODIFY `rankid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `periode`
--
ALTER TABLE `periode`
  MODIFY `idPeriode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `pernyataan`
--
ALTER TABLE `pernyataan`
  MODIFY `pernyataanId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `programstudi`
--
ALTER TABLE `programstudi`
  MODIFY `idprogramstudi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10054;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `roleid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `ruanglingkup`
--
ALTER TABLE `ruanglingkup`
  MODIFY `lingkupid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sidemenu`
--
ALTER TABLE `sidemenu`
  MODIFY `menuid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `standar`
--
ALTER TABLE `standar`
  MODIFY `standarid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1146;

--
-- AUTO_INCREMENT for table `standarspmi`
--
ALTER TABLE `standarspmi`
  MODIFY `standarId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `substandar`
--
ALTER TABLE `substandar`
  MODIFY `subStandarId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tahun`
--
ALTER TABLE `tahun`
  MODIFY `idTahun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tc`
--
ALTER TABLE `tc`
  MODIFY `idTC` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tingkatanpt`
--
ALTER TABLE `tingkatanpt`
  MODIFY `tingkatanid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tools`
--
ALTER TABLE `tools`
  MODIFY `idTools` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `access`
--
ALTER TABLE `access`
  ADD CONSTRAINT `access_ibfk_1` FOREIGN KEY (`roleid`) REFERENCES `role` (`roleid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `access_ibfk_2` FOREIGN KEY (`menuid`) REFERENCES `sidemenu` (`menuid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `audit_old`
--
ALTER TABLE `audit_old`
  ADD CONSTRAINT `audit_old_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`);

--
-- Constraints for table `bentukpt`
--
ALTER TABLE `bentukpt`
  ADD CONSTRAINT `bentukpt_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `department`
--
ALTER TABLE `department`
  ADD CONSTRAINT `department_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `department_ibfk_2` FOREIGN KEY (`institusiid`) REFERENCES `institusi` (`institusiid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dokumen`
--
ALTER TABLE `dokumen`
  ADD CONSTRAINT `dokumen_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `enrollment`
--
ALTER TABLE `enrollment`
  ADD CONSTRAINT `enrollment_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `enrollment_ibfk_2` FOREIGN KEY (`roleid`) REFERENCES `role` (`roleid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `indikator`
--
ALTER TABLE `indikator`
  ADD CONSTRAINT `indikator_ibfk_3` FOREIGN KEY (`kodePernyataan`) REFERENCES `pernyataan` (`kodePernyataan`),
  ADD CONSTRAINT `indikator_ibfk_4` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`);

--
-- Constraints for table `indikatordokumen`
--
ALTER TABLE `indikatordokumen`
  ADD CONSTRAINT `indikatorDokumen_ibfk_4` FOREIGN KEY (`kodeIndikator`) REFERENCES `indikator` (`kodeIndikator`),
  ADD CONSTRAINT `indikatorDokumen_ibfk_5` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`);

--
-- Constraints for table `institusi`
--
ALTER TABLE `institusi`
  ADD CONSTRAINT `institusi_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `institusidokumen`
--
ALTER TABLE `institusidokumen`
  ADD CONSTRAINT `institusiDokumen_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `institusiDokumen_ibfk_2` FOREIGN KEY (`institusiid`) REFERENCES `institusi` (`institusiid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `istitusicomplete`
--
ALTER TABLE `istitusicomplete`
  ADD CONSTRAINT `istitusiComplete_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD CONSTRAINT `jabatan_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `jadwalpelaksanaan`
--
ALTER TABLE `jadwalpelaksanaan`
  ADD CONSTRAINT `jadwalPelaksanaan_ibfk_3` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`);

--
-- Constraints for table `jenisps`
--
ALTER TABLE `jenisps`
  ADD CONSTRAINT `jenisps_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `jenjang`
--
ALTER TABLE `jenjang`
  ADD CONSTRAINT `jenjang_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`);

--
-- Constraints for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD CONSTRAINT `jurusan_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lampirandokumen`
--
ALTER TABLE `lampirandokumen`
  ADD CONSTRAINT `lampiranDokumen_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lokasi`
--
ALTER TABLE `lokasi`
  ADD CONSTRAINT `lokasi_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`);

--
-- Constraints for table `pelaksanaan`
--
ALTER TABLE `pelaksanaan`
  ADD CONSTRAINT `pelaksanaan_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`),
  ADD CONSTRAINT `pelaksanaan_ibfk_2` FOREIGN KEY (`idTC`) REFERENCES `tc` (`idTC`),
  ADD CONSTRAINT `pelaksanaan_ibfk_3` FOREIGN KEY (`idprogramstudi`) REFERENCES `programstudi` (`idprogramstudi`);

--
-- Constraints for table `pelaksanaanaudit`
--
ALTER TABLE `pelaksanaanaudit`
  ADD CONSTRAINT `pelaksanaanAudit_ibfk_2` FOREIGN KEY (`idTC`) REFERENCES `tc` (`idTC`),
  ADD CONSTRAINT `pelaksanaanAudit_ibfk_3` FOREIGN KEY (`auditid`) REFERENCES `audit_old` (`auditid`),
  ADD CONSTRAINT `pelaksanaanAudit_ibfk_4` FOREIGN KEY (`idprogramstudi`) REFERENCES `programstudi` (`idprogramstudi`);

--
-- Constraints for table `penanggungjawab`
--
ALTER TABLE `penanggungjawab`
  ADD CONSTRAINT `penanggungJawab_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`);

--
-- Constraints for table `penetapandepartemen`
--
ALTER TABLE `penetapandepartemen`
  ADD CONSTRAINT `penetapanDepartemen_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`);

--
-- Constraints for table `penetapaninstitusi`
--
ALTER TABLE `penetapaninstitusi`
  ADD CONSTRAINT `penetapanInstitusi_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`);

--
-- Constraints for table `penetapanstandarspmi`
--
ALTER TABLE `penetapanstandarspmi`
  ADD CONSTRAINT `penetapanStandarSPMI_ibfk_1` FOREIGN KEY (`periode`) REFERENCES `periode` (`idPeriode`),
  ADD CONSTRAINT `penetapanStandarSPMI_ibfk_2` FOREIGN KEY (`idprogramstudi`) REFERENCES `programstudi` (`idprogramstudi`);

--
-- Constraints for table `pengelolanpt`
--
ALTER TABLE `pengelolanpt`
  ADD CONSTRAINT `pengelolanpt_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `penilaian`
--
ALTER TABLE `penilaian`
  ADD CONSTRAINT `penilaian_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`);

--
-- Constraints for table `peringkatakreditasi`
--
ALTER TABLE `peringkatakreditasi`
  ADD CONSTRAINT `peringkatAkreditasi_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pernyataan`
--
ALTER TABLE `pernyataan`
  ADD CONSTRAINT `pernyataan_ibfk_2` FOREIGN KEY (`kodeSubStandar`) REFERENCES `substandar` (`kodeSubStandar`),
  ADD CONSTRAINT `pernyataan_ibfk_3` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`);

--
-- Constraints for table `programstudi`
--
ALTER TABLE `programstudi`
  ADD CONSTRAINT `programStudi_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `role`
--
ALTER TABLE `role`
  ADD CONSTRAINT `role_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ruanglingkup`
--
ALTER TABLE `ruanglingkup`
  ADD CONSTRAINT `ruanglingkup_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sidemenu`
--
ALTER TABLE `sidemenu`
  ADD CONSTRAINT `sideMenu_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `standar`
--
ALTER TABLE `standar`
  ADD CONSTRAINT `standar_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `standarspmi`
--
ALTER TABLE `standarspmi`
  ADD CONSTRAINT `standarSPMI_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`);

--
-- Constraints for table `substandar`
--
ALTER TABLE `substandar`
  ADD CONSTRAINT `subStandar_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`),
  ADD CONSTRAINT `subStandar_ibfk_2` FOREIGN KEY (`kodeStandar`) REFERENCES `standarspmi` (`kodeStandar`);

--
-- Constraints for table `tahun`
--
ALTER TABLE `tahun`
  ADD CONSTRAINT `tahun_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`);

--
-- Constraints for table `tc`
--
ALTER TABLE `tc`
  ADD CONSTRAINT `TC_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`),
  ADD CONSTRAINT `TC_ibfk_3` FOREIGN KEY (`id`) REFERENCES `dokumen` (`id`),
  ADD CONSTRAINT `TC_ibfk_4` FOREIGN KEY (`standarid`) REFERENCES `standar` (`standarid`),
  ADD CONSTRAINT `TC_ibfk_5` FOREIGN KEY (`idJenjang`) REFERENCES `jenjang` (`idJenjang`),
  ADD CONSTRAINT `TC_ibfk_6` FOREIGN KEY (`tahun`) REFERENCES `tahun` (`idTahun`);

--
-- Constraints for table `tingkatanpt`
--
ALTER TABLE `tingkatanpt`
  ADD CONSTRAINT `tingkatanpt_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
