-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Vært: 127.0.0.1
-- Genereringstid: 04. 03 2021 kl. 08:36:41
-- Serverversion: 10.4.17-MariaDB
-- PHP-version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ocean_race`
--

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `ships`
--

CREATE TABLE `ships` (
  `shipID` int(11) NOT NULL,
  `shipName` varchar(256) COLLATE latin1_danish_ci NOT NULL,
  `shipRank` int(11) NOT NULL,
  `shipScore` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_danish_ci;

--
-- Data dump for tabellen `ships`
--

INSERT INTO `ships` (`shipID`, `shipName`, `shipRank`, `shipScore`) VALUES
(1, 'DongFeng Race Team', 1, 73),
(2, 'MAPFRE', 2, 70),
(3, 'Team Brunel', 3, 69),
(4, 'team AkzoNobel', 4, 59),
(5, 'Vestas 11th Hour Racing', 5, 39),
(6, 'Turn the Tide on Plastic', 6, 32),
(7, 'Team Sun Hung Kai/Scallywag', 7, 31);

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `user`
--

CREATE TABLE `user` (
  `userID` int(11) NOT NULL,
  `userName` varchar(25) COLLATE latin1_danish_ci NOT NULL,
  `password` varchar(25) COLLATE latin1_danish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_danish_ci;

--
-- Data dump for tabellen `user`
--

INSERT INTO `user` (`userID`, `userName`, `password`) VALUES
(1, 'Admin', 'Passw0rd');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `visit`
--

CREATE TABLE `visit` (
  `visitID` int(11) NOT NULL,
  `visitCount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_danish_ci;

--
-- Data dump for tabellen `visit`
--

INSERT INTO `visit` (`visitID`, `visitCount`) VALUES
(1, 0);

--
-- Begrænsninger for dumpede tabeller
--

--
-- Indeks for tabel `ships`
--
ALTER TABLE `ships`
  ADD PRIMARY KEY (`shipID`);

--
-- Indeks for tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`);

--
-- Indeks for tabel `visit`
--
ALTER TABLE `visit`
  ADD PRIMARY KEY (`visitID`);

--
-- Brug ikke AUTO_INCREMENT for slettede tabeller
--

--
-- Tilføj AUTO_INCREMENT i tabel `ships`
--
ALTER TABLE `ships`
  MODIFY `shipID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Tilføj AUTO_INCREMENT i tabel `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tilføj AUTO_INCREMENT i tabel `visit`
--
ALTER TABLE `visit`
  MODIFY `visitID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
