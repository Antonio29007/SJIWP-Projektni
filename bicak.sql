-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 13, 2025 at 11:07 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bicak`
--

-- --------------------------------------------------------

--
-- Table structure for table `dvorana`
--

CREATE TABLE `dvorana` (
  `ID_dvorane` int(11) NOT NULL,
  `naziv` varchar(25) NOT NULL,
  `kapacitet` int(11) NOT NULL,
  `mjesto` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dvorana`
--

INSERT INTO `dvorana` (`ID_dvorane`, `naziv`, `kapacitet`, `mjesto`) VALUES
(1, 'Arena Zagreb', 15000, 'Zagreb'),
(2, 'Srednja škola Jelkovec', 2000, 'Sesvete'),
(3, 'Trogir', 5000, 'Trogir'),
(4, 'Zatika', 3700, 'Poreč'),
(5, 'Labin', 700, 'Labin'),
(6, 'Zrinjevac', 1500, 'Osijek'),
(7, 'Zamet', 2350, 'Rijeka'),
(8, 'Metković', 2000, 'Metković'),
(9, 'Osnovna škola Dinka Lučić', 1800, 'Našice'),
(10, 'Mladost', 1200, 'Čakovec'),
(11, 'Srednja škola Velika Gori', 2000, 'Velika Gorica'),
(12, 'Cibalia', 2000, 'Vinkovci'),
(13, 'Moslava', 1000, 'Kutina'),
(14, 'Varaždin', 2500, 'Varaždin'),
(15, 'OS Dubrava', 1200, 'Zagreb'),
(16, '3. Maj', 1500, 'Karlovac'),
(17, 'Kutija šibica', 5000, 'Zagreb'),
(18, 'Športska dvorana Rudar', 500, 'Samobor');

-- --------------------------------------------------------

--
-- Table structure for table `igraci`
--

CREATE TABLE `igraci` (
  `ID_igraca` int(11) NOT NULL,
  `ime` varchar(25) NOT NULL,
  `prezime` varchar(25) NOT NULL,
  `datum_rodenja` datetime NOT NULL,
  `pozicija` enum('golman','lijevo krilo','desno krilo','lijevi vanjski','desni vanjski','srednji vanjski','pivot','','','','') NOT NULL,
  `klub_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `igraci`
--

INSERT INTO `igraci` (`ID_igraca`, `ime`, `prezime`, `datum_rodenja`, `pozicija`, `klub_ID`) VALUES
(1, 'Matej', ' Mandić', '2002-05-02 16:15:11', 'golman', 1),
(2, 'Ante', ' Grbavac', '1998-04-25 16:38:46', 'golman', 1),
(3, 'Davor', ' Ćavar ', '1995-09-12 16:39:08', 'lijevo krilo', 1),
(4, 'Jakov ', 'Celegin', '1998-03-14 16:39:32', 'lijevo krilo', 1),
(5, 'Maksimilijan  ', 'Molc', '1998-02-22 16:39:54', 'desno krilo', 1),
(6, 'Paolo', ' Kraljević ', '1999-02-19 16:40:19', 'desno krilo', 1),
(7, 'Adin ', 'Faljić ', '1997-04-01 16:40:38', 'pivot', 1),
(8, 'Roko ', 'Trivković', '1998-10-10 16:41:07', 'pivot', 1),
(9, 'Jakov ', 'Gojun', '1996-05-17 16:41:30', 'lijevi vanjski', 1),
(10, 'Zvonimir', ' Srna', '1998-02-13 16:41:59', 'lijevi vanjski', 1),
(11, 'Ivano', ' Pavlović ', '1999-03-03 16:42:29', 'srednji vanjski', 1),
(12, 'Luka Lovre', ' Klarica', '1999-01-05 16:43:00', 'desno krilo', 1),
(13, 'Antun', ' Šarić', '1998-05-12 16:43:28', 'golman', 2),
(14, 'Aleksandar', 'Bakić', '2000-09-03 16:44:53', 'lijevo krilo', 2),
(15, 'Loris ', 'Hromin', '2000-05-05 16:45:18', 'desno krilo', 2),
(16, 'Leon ', 'Vučko', '1997-10-10 16:45:38', 'pivot', 2),
(17, 'Lucijan ', 'Krajcar', '1999-03-20 16:46:15', 'lijevi vanjski', 2),
(18, 'Mislav ', 'Grgić', '1999-01-05 16:46:36', 'srednji vanjski', 2),
(19, 'Petar ', 'Krupić', '1996-06-20 16:46:55', 'desni vanjski', 2),
(20, 'Marko', 'Markonix', '2025-04-17 00:00:00', 'lijevo krilo', 11),
(21, 'Fran', 'Maroši', '2025-04-23 00:00:00', 'lijevo krilo', 16),
(22, 'Marko', 'Lončarević', '2025-01-07 00:00:00', 'pivot', 15),
(23, 'petar', 'dujmenović', '2025-04-19 00:00:00', 'golman', 4);

-- --------------------------------------------------------

--
-- Table structure for table `klub`
--

CREATE TABLE `klub` (
  `ID_kluba` int(11) NOT NULL,
  `naziv` varchar(25) NOT NULL,
  `mjesto` varchar(25) NOT NULL,
  `datum_osnivanja` datetime NOT NULL,
  `ukupni_bodovi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `klub`
--

INSERT INTO `klub` (`ID_kluba`, `naziv`, `mjesto`, `datum_osnivanja`, `ukupni_bodovi`) VALUES
(1, 'RK Zagreb', 'Zagreb', '1922-03-15 15:19:32', 33),
(2, 'RK Nexe', 'Našice', '1959-07-16 15:21:25', 21),
(3, 'RK Čakovec', 'Čakovec', '2013-05-20 15:21:52', 7),
(4, 'RK Sesvete', 'Sesvete', '2000-09-10 15:22:21', 12),
(5, 'RK Vinkovci', 'Vinkovci', '2000-02-09 15:22:57', 15),
(6, 'RK Gorica', 'Velika Gorica', '1955-07-22 15:23:38', 7),
(7, 'RK Poreč', 'Poreč', '1968-05-20 15:24:13', 9),
(8, 'RK Trogir', 'Trogir', '2025-03-30 15:24:51', 6),
(9, 'RK Osijek', 'Osijek', '1999-07-09 15:25:16', 18),
(10, 'RK Rudar', 'Samobor', '1959-09-14 15:25:54', 12),
(11, 'RK Varaždin', 'Varaždin', '1955-05-04 15:26:31', 10),
(12, 'RK Moslavina', 'Kutina', '1998-01-16 15:26:57', 12),
(13, 'RK Zamet ', 'Rijeka', '1957-08-08 15:27:27', 9),
(14, 'RK Dubrava', 'Zagreb', '1953-06-06 15:27:53', 7),
(15, 'RK Metković', 'Metković', '1963-09-29 15:28:25', 6),
(16, 'RK Karlovac', 'Karlovac', '2017-02-27 15:29:02', 6);

-- --------------------------------------------------------

--
-- Table structure for table `strijelci`
--

CREATE TABLE `strijelci` (
  `ID` int(11) NOT NULL,
  `utakmica_ID` int(11) NOT NULL,
  `igrac_ID` int(11) NOT NULL,
  `broj_golova` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `strijelci`
--

INSERT INTO `strijelci` (`ID`, `utakmica_ID`, `igrac_ID`, `broj_golova`) VALUES
(1, 1, 3, 14);

-- --------------------------------------------------------

--
-- Table structure for table `sudci`
--

CREATE TABLE `sudci` (
  `ID_sudca` int(11) NOT NULL,
  `ime` varchar(25) NOT NULL,
  `prezime` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sudci`
--

INSERT INTO `sudci` (`ID_sudca`, `ime`, `prezime`) VALUES
(1, 'Pero', 'Peric'),
(2, 'Marko', 'Maric'),
(3, 'Josip ', 'Cepanec'),
(4, 'Dalibor', 'Dragočajac​'),
(5, 'Matija', 'Cingesar'),
(6, 'Matej ', 'Pavlović​');

-- --------------------------------------------------------

--
-- Table structure for table `utakmica`
--

CREATE TABLE `utakmica` (
  `ID_utakmice` int(11) NOT NULL,
  `dvorana_ID` int(11) NOT NULL,
  `sudac_ID` int(11) NOT NULL,
  `datum_i_vrijeme_utakmice` datetime NOT NULL,
  `broj_gledatelja` int(11) NOT NULL,
  `klub_ID_gosti` int(11) NOT NULL,
  `klub_ID_domaci` int(11) NOT NULL,
  `gosti_golovi` int(11) NOT NULL,
  `domaci_golovi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `utakmica`
--

INSERT INTO `utakmica` (`ID_utakmice`, `dvorana_ID`, `sudac_ID`, `datum_i_vrijeme_utakmice`, `broj_gledatelja`, `klub_ID_gosti`, `klub_ID_domaci`, `gosti_golovi`, `domaci_golovi`) VALUES
(1, 1, 3, '2024-09-05 15:31:36', 200, 9, 1, 24, 38),
(2, 11, 6, '2024-09-07 20:00:00', 400, 14, 6, 25, 38),
(3, 8, 1, '2024-09-07 20:00:00', 100, 8, 15, 21, 24),
(4, 2, 6, '2024-09-07 20:00:00', 150, 13, 4, 26, 43),
(5, 14, 6, '2025-03-30 15:37:06', 230, 16, 11, 21, 30),
(6, 4, 3, '2024-09-08 18:00:00', 400, 10, 7, 23, 26),
(7, 9, 1, '2024-09-10 20:00:00', 60, 12, 2, 23, 37),
(8, 16, 5, '2024-09-11 19:00:00', 100, 3, 5, 36, 38),
(9, 12, 4, '2024-09-14 18:00:00', 70, 7, 13, 24, 27),
(10, 10, 4, '2024-09-14 19:00:00', 150, 5, 2, 24, 42),
(11, 9, 6, '2024-09-14 19:00:00', 76, 14, 12, 23, 28),
(12, 2, 1, '2024-09-14 19:30:00', 130, 11, 3, 34, 40),
(13, 16, 5, '2024-09-14 20:30:00', 70, 6, 16, 24, 32),
(14, 6, 3, '2024-09-15 18:00:00', 160, 15, 9, 29, 36),
(15, 18, 2, '2024-09-15 18:30:00', 80, 8, 10, 31, 35),
(16, 15, 3, '2024-09-20 20:00:00', 60, 16, 14, 26, 28),
(17, 11, 1, '2024-09-21 18:00:00', 45, 3, 6, 20, 38),
(18, 8, 4, '2024-09-21 18:00:00', 50, 10, 15, 27, 28),
(19, 2, 6, '2024-09-21 19:00:00', 90, 12, 5, 23, 32),
(20, 14, 3, '2024-09-22 19:00:00', 140, 2, 11, 29, 33),
(21, 3, 2, '2024-09-22 19:00:00', 110, 13, 8, 28, 32),
(22, 12, 1, '2024-09-22 19:00:00', 90, 9, 4, 28, 34),
(23, 2, 5, '2024-09-28 18:00:00', 60, 11, 5, 26, 32),
(24, 1, 4, '2024-09-28 18:00:00', 125, 8, 1, 26, 40),
(25, 7, 2, '2024-09-28 18:00:00', 40, 15, 13, 25, 28),
(26, 9, 5, '2024-09-28 19:00:00', 70, 14, 3, 30, 34),
(27, 10, 5, '2024-09-28 19:00:00', 65, 7, 4, 26, 34),
(28, 12, 2, '2024-09-29 17:00:00', 140, 6, 2, 31, 39),
(29, 4, 2, '2024-09-29 18:00:00', 70, 10, 9, 28, 33),
(30, 13, 6, '2024-09-29 18:30:00', 60, 16, 12, 23, 34),
(31, 1, 4, '2025-03-30 16:01:39', 200, 4, 1, 21, 34),
(32, 15, 5, '2024-10-02 19:30:00', 90, 2, 14, 26, 41),
(33, 8, 2, '2024-10-04 19:00:00', 230, 1, 15, 36, 23),
(34, 6, 1, '2024-10-05 17:00:00', 80, 3, 16, 31, 35),
(35, 18, 6, '2024-10-05 18:30:00', 50, 13, 10, 30, 34),
(36, 14, 3, '2024-10-05 19:00:00', 80, 12, 11, 36, 29),
(37, 12, 5, '2024-10-05 19:00:00', 40, 4, 8, 24, 28),
(38, 6, 4, '2024-10-06 17:00:00', 70, 9, 7, 29, 22),
(39, 11, 2, '2024-10-06 18:00:00', 60, 5, 6, 35, 27),
(40, 1, 5, '2024-10-11 18:00:00', 200, 10, 1, 25, 45),
(41, 12, 6, '2024-10-12 16:00:00', 50, 15, 4, 26, 29),
(42, 12, 4, '2024-10-12 19:00:00', 120, 14, 5, 29, 31),
(43, 14, 1, '2025-03-30 16:10:32', 80, 6, 11, 27, 31),
(44, 13, 4, '2025-03-30 16:11:02', 70, 3, 12, 31, 33),
(45, 4, 6, '2024-10-13 18:00:00', 65, 8, 7, 25, 30),
(46, 6, 3, '2024-10-13 18:00:00', 130, 13, 9, 28, 29),
(47, 7, 6, '2024-10-18 18:00:00', 85, 1, 13, 47, 25),
(48, 15, 2, '2024-10-19 18:00:00', 110, 11, 14, 30, 30),
(49, 18, 4, '2024-10-19 18:00:00', 60, 4, 10, 31, 32),
(50, 10, 5, '2024-10-19 19:00:00', 80, 2, 3, 31, 27),
(51, 1, 2, '2025-01-28 18:34:00', 0, 2, 1, 19, 20),
(52, 1, 2, '2025-01-11 18:41:00', 0, 1, 2, 26, 30),
(53, 1, 2, '2025-01-11 18:41:00', 0, 1, 2, 26, 30),
(54, 1, 2, '2025-03-07 18:43:00', 0, 2, 1, 32, 20),
(55, 1, 2, '2025-03-14 18:44:00', 0, 2, 1, 25, 30),
(56, 1, 2, '2025-03-31 18:44:00', 0, 2, 1, 15, 30),
(57, 1, 2, '2025-03-31 18:46:00', 0, 2, 1, 12, 25),
(58, 12, 4, '2025-03-31 18:46:00', 0, 7, 5, 23, 21),
(59, 1, 6, '2025-03-31 18:48:00', 0, 10, 1, 10, 39),
(60, 6, 1, '2025-03-31 18:58:00', 0, 8, 9, 20, 25),
(61, 9, 2, '2025-03-31 19:02:00', 0, 9, 3, 20, 12);

--
-- Triggers `utakmica`
--
DELIMITER $$
CREATE TRIGGER `update_bodovi` AFTER INSERT ON `utakmica` FOR EACH ROW BEGIN
    DECLARE bodovi_domaci INT;
    DECLARE bodovi_gosti INT;
    
    -- Ako je domaći klub pobjednik
    IF NEW.domaci_golovi > NEW.gosti_golovi THEN
        SET bodovi_domaci = 3;
        SET bodovi_gosti = 0;
    -- Ako je gostujući klub pobjednik
    ELSEIF NEW.gosti_golovi > NEW.domaci_golovi THEN
        SET bodovi_domaci = 0;
        SET bodovi_gosti = 3;
    -- Ako je neriješen rezultat
    ELSE
        SET bodovi_domaci = 1;
        SET bodovi_gosti = 1;
    END IF;
    
    -- Ažuriraj bodove za domaći klub
    UPDATE klub
    SET ukupni_bodovi = ukupni_bodovi + bodovi_domaci
    WHERE ID_kluba = NEW.klub_ID_domaci;
    
    -- Ažuriraj bodove za gostujući klub
    UPDATE klub
    SET ukupni_bodovi = ukupni_bodovi + bodovi_gosti
    WHERE ID_kluba = NEW.klub_ID_gosti;
    
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dvorana`
--
ALTER TABLE `dvorana`
  ADD PRIMARY KEY (`ID_dvorane`);

--
-- Indexes for table `igraci`
--
ALTER TABLE `igraci`
  ADD PRIMARY KEY (`ID_igraca`),
  ADD KEY `klub_ID` (`klub_ID`);

--
-- Indexes for table `klub`
--
ALTER TABLE `klub`
  ADD PRIMARY KEY (`ID_kluba`);

--
-- Indexes for table `strijelci`
--
ALTER TABLE `strijelci`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `utakmica_ID` (`utakmica_ID`),
  ADD KEY `igrac_ID` (`igrac_ID`);

--
-- Indexes for table `sudci`
--
ALTER TABLE `sudci`
  ADD PRIMARY KEY (`ID_sudca`);

--
-- Indexes for table `utakmica`
--
ALTER TABLE `utakmica`
  ADD PRIMARY KEY (`ID_utakmice`),
  ADD KEY `dvorana_ID` (`dvorana_ID`),
  ADD KEY `sudac_ID` (`sudac_ID`),
  ADD KEY `klub_ID_gosti` (`klub_ID_gosti`),
  ADD KEY `klub_ID_domaci` (`klub_ID_domaci`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dvorana`
--
ALTER TABLE `dvorana`
  MODIFY `ID_dvorane` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `igraci`
--
ALTER TABLE `igraci`
  MODIFY `ID_igraca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `klub`
--
ALTER TABLE `klub`
  MODIFY `ID_kluba` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `strijelci`
--
ALTER TABLE `strijelci`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sudci`
--
ALTER TABLE `sudci`
  MODIFY `ID_sudca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `utakmica`
--
ALTER TABLE `utakmica`
  MODIFY `ID_utakmice` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `igraci`
--
ALTER TABLE `igraci`
  ADD CONSTRAINT `igraci_ibfk_1` FOREIGN KEY (`klub_ID`) REFERENCES `klub` (`ID_kluba`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `strijelci`
--
ALTER TABLE `strijelci`
  ADD CONSTRAINT `strijelci_ibfk_1` FOREIGN KEY (`igrac_ID`) REFERENCES `igraci` (`ID_igraca`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `strijelci_ibfk_2` FOREIGN KEY (`utakmica_ID`) REFERENCES `utakmica` (`ID_utakmice`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `utakmica`
--
ALTER TABLE `utakmica`
  ADD CONSTRAINT `utakmica_ibfk_1` FOREIGN KEY (`sudac_ID`) REFERENCES `sudci` (`ID_sudca`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `utakmica_ibfk_2` FOREIGN KEY (`dvorana_ID`) REFERENCES `dvorana` (`ID_dvorane`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `utakmica_ibfk_3` FOREIGN KEY (`klub_ID_gosti`) REFERENCES `klub` (`ID_kluba`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `utakmica_ibfk_4` FOREIGN KEY (`klub_ID_domaci`) REFERENCES `klub` (`ID_kluba`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
