-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 23, 2015 at 08:13 AM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sig_kaltim`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
`idadmin` int(2) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `tlp` varchar(30) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`idadmin`, `username`, `password`, `nama_lengkap`, `email`, `tlp`) VALUES
(1, 'novalnauw', '29c0e233dac1f8891d6bc32449b39a71', 'Nauw Noval', 'novalsmith69@gmail.com', '082230881021');

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE IF NOT EXISTS `berita` (
`idberita` int(5) NOT NULL,
  `waktu` varchar(35) NOT NULL,
  `idkategori` int(5) NOT NULL,
  `judulberita` varchar(255) NOT NULL,
  `isiberita` text NOT NULL,
  `gambar_besar` blob NOT NULL,
  `gambar_kecil` blob NOT NULL,
  `status` varchar(20) NOT NULL,
  `status_popular` varchar(30) NOT NULL,
  `lat_wisata` varchar(30) NOT NULL,
  `long_wisata` varchar(30) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `berita`
--

INSERT INTO `berita` (`idberita`, `waktu`, `idkategori`, `judulberita`, `isiberita`, `gambar_besar`, `gambar_kecil`, `status`, `status_popular`, `lat_wisata`, `long_wisata`) VALUES
(1, 'Senin 21 Desember 2015', 1, 'Pemrograman Terbaik', '<p>Pemrograman TerbaikPemrograman TerbaikPemrograman TerbaikPemrograman TerbaikPemrograman TerbaikPemrograman TerbaikPemrograman TerbaikPemrograman TerbaikPemrograman TerbaikPemrograman TerbaikPemrograman TerbaikPemrograman TerbaikPemrograman TerbaikPemrograman TerbaikPemrograman TerbaikPemrograman TerbaikPemrograman TerbaikPemrograman TerbaikPemrograman TerbaikPemrograman TerbaikPemrograman TerbaikPemrograman TerbaikPemrograman TerbaikPemrograman TerbaikPemrograman TerbaikPemrograman TerbaikPemrograman TerbaikPemrograman TerbaikPemrograman TerbaikPemrograman TerbaikPemrograman TerbaikPemrograman TerbaikPemrograman TerbaikPemrograman TerbaikPemrograman TerbaikPemrograman TerbaikPemrograman TerbaikPemrograman TerbaikPemrograman TerbaikPemrograman TerbaikPemrograman TerbaikPemrograman TerbaikPemrograman TerbaikPemrograman TerbaikPemrograman Terbaik</p>', 0x7369672d6b616c74696d2d30312d35382d31382d30352d31322d31352d31323032373531355f3933313535313836303232343639375f313939313733303133363736313438313138385f6e2e6a7067, 0x7369672d6b616c74696d2d30312d35382d31382d30352d31322d31352d31323032373531355f3933313535313836303232343639375f313939313733303133363736313438313138385f6e2e6a7067, 'publish', 'popular', '-0.377286', '117.230119');

-- --------------------------------------------------------

--
-- Table structure for table `galery`
--

CREATE TABLE IF NOT EXISTS `galery` (
`id_galery` int(5) NOT NULL,
  `idberita` int(5) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `gambar_besar_gal` blob NOT NULL,
  `gambar_kecil_gal` blob NOT NULL,
  `ket_galery` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `header`
--

CREATE TABLE IF NOT EXISTS `header` (
`idheader` int(5) NOT NULL,
  `kategori` varchar(30) NOT NULL,
  `statusheader` varchar(20) NOT NULL,
  `gambar` blob NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `header`
--

INSERT INTO `header` (`idheader`, `kategori`, `statusheader`, `gambar`) VALUES
(1, 'header', 'aktif', 0x7369672d6b616c74696d2d30332d33372d35372d30352d31322d31352d77616c702e676966),
(2, 'iklan', 'aktif', 0x7369672d6b616c74696d2d30322d35302d30312d31362d31312d31352d74616c6b206c6573732e6a7067);

-- --------------------------------------------------------

--
-- Table structure for table `info_hotel`
--

CREATE TABLE IF NOT EXISTS `info_hotel` (
`id_info_hotel` int(5) NOT NULL,
  `idberita` int(5) NOT NULL,
  `nama_hotel` varchar(100) NOT NULL,
  `keterangan_hotel` text NOT NULL,
  `gambar_besar_hotel` blob NOT NULL,
  `gambar_kecil_hotel` blob NOT NULL,
  `lat_hotel` varchar(30) NOT NULL,
  `long_hotel` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `info_kerajinan`
--

CREATE TABLE IF NOT EXISTS `info_kerajinan` (
`id_kerajinan` int(5) NOT NULL,
  `idberita` int(5) NOT NULL,
  `nama_kerajinan` varchar(100) NOT NULL,
  `ket_kerajinan` text NOT NULL,
  `gambar_besar_k` blob NOT NULL,
  `gambar_kecil_k` blob NOT NULL,
  `lat_kerajinan` varchar(30) NOT NULL,
  `long_kerajinan` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `info_rumah_sakit`
--

CREATE TABLE IF NOT EXISTS `info_rumah_sakit` (
`id_rumah_sakit` int(5) NOT NULL,
  `idberita` int(5) NOT NULL,
  `nama_rs` varchar(100) NOT NULL,
  `ket_rs` text NOT NULL,
  `gambar_besar_rs` blob NOT NULL,
  `gambar_kecil_rs` blob NOT NULL,
  `lat_rs` varchar(30) NOT NULL,
  `long_rs` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `info_tour_travel`
--

CREATE TABLE IF NOT EXISTS `info_tour_travel` (
`id_tour_travel` int(5) NOT NULL,
  `idberita` int(5) NOT NULL,
  `nama_tour_travel` varchar(100) NOT NULL,
  `ket_tour_travel` text NOT NULL,
  `gambar_besar_tour` blob NOT NULL,
  `gambar_kecil_tour` blob NOT NULL,
  `lat_tour_travel` varchar(30) NOT NULL,
  `long_tour_travel` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE IF NOT EXISTS `kategori` (
`idkategori` int(5) NOT NULL,
  `namakategori` varchar(100) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`idkategori`, `namakategori`) VALUES
(1, 'PHP OOP 5');

-- --------------------------------------------------------

--
-- Table structure for table `komentar_berita`
--

CREATE TABLE IF NOT EXISTS `komentar_berita` (
`idkomentar_berita` int(5) NOT NULL,
  `idberita` int(5) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `isikomentar` text NOT NULL,
  `waktu` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `money_ch`
--

CREATE TABLE IF NOT EXISTS `money_ch` (
`id_money` int(5) NOT NULL,
  `idberita` int(5) NOT NULL,
  `nama_money` varchar(100) NOT NULL,
  `ket_money` text NOT NULL,
  `gambar_besar_money` blob NOT NULL,
  `gambar_kecil_money` blob NOT NULL,
  `lat_money` varchar(30) NOT NULL,
  `long_money` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `profil`
--

CREATE TABLE IF NOT EXISTS `profil` (
`idprofil` int(1) NOT NULL,
  `isi_profil` text NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `profil`
--

INSERT INTO `profil` (`idprofil`, `isi_profil`) VALUES
(1, '<p> </p>\r\n<h2 align="center"><h1 align="center">Salam...</h1></h2>\r\n<p>Selamat datang diwebsite resmi kami ( Website Sistem Informasi Geografis Kalimantan Timur ).  ini adalah profil tentang daerah Kaltim pemerintah Daerah.</p>\r\n<p>percobaan percobaan perjsdhfjksdf sdhfuisdhiufs dfiusidufg sdgiusiughfusdg soiugiusoiguf goiusgiousiofg sofiguosiufg sfgiou9sofiugsfg sfoiguosfgsofugoisf gsofiugosifgoisoifdgs goiusoifgiskiopfgosf gsfoiugosufoigus gfoisjfogijsf goisfogsofijgoijsfg sfoiugoisf gsoifjgiosf mg9ijsfoijgmsfgijsof gsofijgoisfgsofijgoijsf gsoijgosijfg sfogijsfogs fgiojsfoig sgiojsfoig sfoijgoisfgosifugimsf gosjifgksoifgjosif gsoifjgoisf gsfoijgoijsf gsfiojgioksf goisjggfsg.</p>\r\n<p>klik disini <a title="kunjungi google" href="http://www.google.com" target="_blank">Klik disini </a></p>\r\n<p> </p>\r\n<p><img title="walpaper gambar baner sig kalitm Skripsi" src="../../asset/upload/baner_web/sig-kaltim-02-05-45-16-11-15-walp.gif" alt="" width="1233" height="171" /></p>\r\n<h2>Visi</h2>\r\n<p> </p>\r\n<p>hsdgjfgshdfjskdhfjhksjdksjfjskdf sdkjflksdjlgkjsdlkgjsf gsfkjgolksfjgklsjflkgs fglkjsflkgjsklfjglsjfg sflkgjslkfjglsfkjglsfjgksf gsflkjglksfjgksfjgkslfjgisfugoisf gslfkjgoksfjogjsf gsflijgosifjgiojsdfogjsf gksljfgsoifjgisfjogsf g;lksjfgjosifjoi9gjsfoijgoisjfpiogjpfiogjdpsiofg sdfoigjdofjgsdfmgjoisdfjkg sdfgiojkdfopgjk[srgt spoksdfpogkpofg fihoisfjkghoijsfiojhposifh fkhoisjkhpifghkposfkgopskfpogkhs[pfs fgh;lkfhpofgkhopgkfs hfghoijfosjhfghoifjdfoih dghkijoifgdhiosfghjofdjhoifgjhoidfjtoihjf dhijdiofjhofjg hddoifjhoijdphidg gigpoihjpiodjgihjfoih goihjdfpitjhpiofghfdohijofidjhoifjdfohoifdjoigjhfdjhf fghfdihofd.</p>\r\n<h2>Misi</h2>\r\n<p>shgdfvjsdghfhsiduhf sdfiuhidsuhiudshigud fgjdiofugjisdjoigjidojg dkfjgoidsjfg9ijs9dfg dsfogifuj9idsfjg9jsd9ifjgdf goisjdf9igjs9d8ufg98usdjf godfijg9ijsd9ifjgsd fgoijdifgjsiodf gdfiuhgiudhfgjiodjfgm dfigj9djfigsd fgoisjd9ifgjodsij dfogijosdifjgoijdgo gpofiksodifjkgsoipdg dgoijsodifgjoijdfog goijodfijghojisjiu-0shsf thpdf0pgokhpofd hofdihpifjhdf hoifjodijfghh fdijhoifjhiofd hoifdjoihjdf0ohmdfih90fdih,fdih09gi0fdhkldf hofdihifdg h</p>\r\n<p><img src="http://www.seasite.niu.edu/indonesian/indonesian-map/kaltim/kaltimtotal.jpg" alt="map" width="266" height="367" /></p>');

-- --------------------------------------------------------

--
-- Table structure for table `transportasi`
--

CREATE TABLE IF NOT EXISTS `transportasi` (
`id_transport` int(5) NOT NULL,
  `idberita` int(5) NOT NULL,
  `nama_transport` varchar(100) NOT NULL,
  `ket_transport` text NOT NULL,
  `gambar_besar_t` varchar(100) NOT NULL,
  `gambar_kecil_t` varchar(100) NOT NULL,
  `lat_transport` varchar(30) NOT NULL,
  `long_transport` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
 ADD PRIMARY KEY (`idadmin`);

--
-- Indexes for table `berita`
--
ALTER TABLE `berita`
 ADD PRIMARY KEY (`idberita`), ADD KEY `idkategori` (`idkategori`);

--
-- Indexes for table `galery`
--
ALTER TABLE `galery`
 ADD PRIMARY KEY (`id_galery`), ADD KEY `idberita` (`idberita`), ADD KEY `idberita_2` (`idberita`);

--
-- Indexes for table `header`
--
ALTER TABLE `header`
 ADD PRIMARY KEY (`idheader`);

--
-- Indexes for table `info_hotel`
--
ALTER TABLE `info_hotel`
 ADD PRIMARY KEY (`id_info_hotel`), ADD KEY `idberita` (`idberita`);

--
-- Indexes for table `info_kerajinan`
--
ALTER TABLE `info_kerajinan`
 ADD PRIMARY KEY (`id_kerajinan`), ADD KEY `idberita` (`idberita`);

--
-- Indexes for table `info_rumah_sakit`
--
ALTER TABLE `info_rumah_sakit`
 ADD PRIMARY KEY (`id_rumah_sakit`), ADD KEY `idberita` (`idberita`);

--
-- Indexes for table `info_tour_travel`
--
ALTER TABLE `info_tour_travel`
 ADD PRIMARY KEY (`id_tour_travel`), ADD KEY `idberita` (`idberita`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
 ADD PRIMARY KEY (`idkategori`);

--
-- Indexes for table `komentar_berita`
--
ALTER TABLE `komentar_berita`
 ADD PRIMARY KEY (`idkomentar_berita`), ADD KEY `idberita` (`idberita`), ADD KEY `idberita_2` (`idberita`), ADD KEY `idberita_3` (`idberita`);

--
-- Indexes for table `money_ch`
--
ALTER TABLE `money_ch`
 ADD PRIMARY KEY (`id_money`), ADD KEY `idberita` (`idberita`);

--
-- Indexes for table `profil`
--
ALTER TABLE `profil`
 ADD PRIMARY KEY (`idprofil`);

--
-- Indexes for table `transportasi`
--
ALTER TABLE `transportasi`
 ADD PRIMARY KEY (`id_transport`), ADD KEY `idberita` (`idberita`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
MODIFY `idadmin` int(2) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `berita`
--
ALTER TABLE `berita`
MODIFY `idberita` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `galery`
--
ALTER TABLE `galery`
MODIFY `id_galery` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `header`
--
ALTER TABLE `header`
MODIFY `idheader` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `info_hotel`
--
ALTER TABLE `info_hotel`
MODIFY `id_info_hotel` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `info_kerajinan`
--
ALTER TABLE `info_kerajinan`
MODIFY `id_kerajinan` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `info_rumah_sakit`
--
ALTER TABLE `info_rumah_sakit`
MODIFY `id_rumah_sakit` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `info_tour_travel`
--
ALTER TABLE `info_tour_travel`
MODIFY `id_tour_travel` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
MODIFY `idkategori` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `komentar_berita`
--
ALTER TABLE `komentar_berita`
MODIFY `idkomentar_berita` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `money_ch`
--
ALTER TABLE `money_ch`
MODIFY `id_money` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `profil`
--
ALTER TABLE `profil`
MODIFY `idprofil` int(1) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `transportasi`
--
ALTER TABLE `transportasi`
MODIFY `id_transport` int(5) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `berita`
--
ALTER TABLE `berita`
ADD CONSTRAINT `berita_ibfk_1` FOREIGN KEY (`idkategori`) REFERENCES `kategori` (`idkategori`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `galery`
--
ALTER TABLE `galery`
ADD CONSTRAINT `galeryberita` FOREIGN KEY (`idberita`) REFERENCES `berita` (`idberita`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `info_hotel`
--
ALTER TABLE `info_hotel`
ADD CONSTRAINT `judulberita` FOREIGN KEY (`idberita`) REFERENCES `berita` (`idberita`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `info_kerajinan`
--
ALTER TABLE `info_kerajinan`
ADD CONSTRAINT `kerajinan` FOREIGN KEY (`idberita`) REFERENCES `berita` (`idberita`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `info_rumah_sakit`
--
ALTER TABLE `info_rumah_sakit`
ADD CONSTRAINT `beritass` FOREIGN KEY (`idberita`) REFERENCES `berita` (`idberita`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `info_tour_travel`
--
ALTER TABLE `info_tour_travel`
ADD CONSTRAINT `tour` FOREIGN KEY (`idberita`) REFERENCES `berita` (`idberita`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `komentar_berita`
--
ALTER TABLE `komentar_berita`
ADD CONSTRAINT `berriiitasss` FOREIGN KEY (`idberita`) REFERENCES `berita` (`idberita`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `money_ch`
--
ALTER TABLE `money_ch`
ADD CONSTRAINT `moneyberita` FOREIGN KEY (`idberita`) REFERENCES `berita` (`idberita`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transportasi`
--
ALTER TABLE `transportasi`
ADD CONSTRAINT `transport` FOREIGN KEY (`idberita`) REFERENCES `berita` (`idberita`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
