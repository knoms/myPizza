-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 05. Jan 2019 um 21:11
-- Server-Version: 10.1.37-MariaDB
-- PHP-Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `mypizza`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `mp_menu`
--

CREATE TABLE `mp_menu` (
  `MenuID` int(11) NOT NULL,
  `Name` varchar(32) COLLATE utf8_german2_ci NOT NULL,
  `Preis` decimal(4,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

--
-- Daten für Tabelle `mp_menu`
--

INSERT INTO `mp_menu` (`MenuID`, `Name`, `Preis`) VALUES
(1, 'Pizza Margherita', '6.00'),


(2, 'Pizza Salami', '7.00'),

(3, 'Pizza Champignon', '7.50'),

(4, 'Pizza Paprika', '7.80'),

(5, 'Pizza Peperoni Speciale', '8.00'),

(6, 'Pizza Ruccola', '8.00');


--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `mp_menu`
--
ALTER TABLE `mp_menu`
  ADD PRIMARY KEY (`MenuID`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `mp_menu`
--
ALTER TABLE `mp_menu`
  MODIFY `MenuID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
