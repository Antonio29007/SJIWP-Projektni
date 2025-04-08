-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 20, 2025 at 09:22 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

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
(1, 'Dom sportova', 9652, 'Daruvar');

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
(1, 'RK Daruvar', 'Daruvar', '2025-03-20 21:18:59', 55),
(2, 'RK Pakrac', 'Pakrac', '2025-03-02 21:19:57', 48);

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
(2, 'Marko', 'Maric');

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
(1, 1, 2, '2025-03-20 21:20:46', 8000, 2, 1, 30, 28);

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
  MODIFY `ID_dvorane` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `igraci`
--
ALTER TABLE `igraci`
  MODIFY `ID_igraca` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `klub`
--
ALTER TABLE `klub`
  MODIFY `ID_kluba` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `strijelci`
--
ALTER TABLE `strijelci`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sudci`
--
ALTER TABLE `sudci`
  MODIFY `ID_sudca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `utakmica`
--
ALTER TABLE `utakmica`
  MODIFY `ID_utakmice` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
