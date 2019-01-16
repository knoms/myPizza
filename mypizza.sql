-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 16. Jan 2019 um 17:38
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
CREATE DATABASE IF NOT EXISTS `mypizza` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `mypizza`;

-- --------------------------------------------------------

--
-- Stellvertreter-Struktur des Views `alreadyordered`
-- (Siehe unten für die tatsächliche Ansicht)
--
CREATE TABLE `alreadyordered` (
`UserID` int(11)
,`OrderID` int(11)
,`Time` datetime
,`Name` varchar(32)
,`Preis` decimal(4,2)
);

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

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `mp_ordered_dishes`
--

CREATE TABLE `mp_ordered_dishes` (
  `MenuID` int(11) NOT NULL,
  `OrderID` int(11) NOT NULL,
  `odID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `mp_orders`
--

CREATE TABLE `mp_orders` (
  `OrderID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Time` datetime NOT NULL,
  `Artikelanzahl` int(11) NOT NULL,
  `Preis` decimal(5,2) NOT NULL,
  `Vk` decimal(4,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `mp_shopping_cart`
--

CREATE TABLE `mp_shopping_cart` (
  `UserID` int(11) NOT NULL,
  `MenuID` int(11) NOT NULL,
  `ItemID` int(11) NOT NULL,
  `Time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `mp_users`
--

CREATE TABLE `mp_users` (
  `UserID` int(11) NOT NULL,
  `Name` varchar(32) COLLATE utf8_german2_ci NOT NULL,
  `Vorname` varchar(32) COLLATE utf8_german2_ci NOT NULL,
  `Strasse` varchar(64) COLLATE utf8_german2_ci NOT NULL,
  `PLZ` varchar(10) COLLATE utf8_german2_ci NOT NULL,
  `Stadt` varchar(64) COLLATE utf8_german2_ci NOT NULL,
  `Email` varchar(64) COLLATE utf8_german2_ci NOT NULL,
  `Pw` char(64) COLLATE utf8_german2_ci NOT NULL COMMENT 'Sha256',
  `Created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Zeitpunkt der Erstellung'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

-- --------------------------------------------------------

--
-- Struktur des Views `alreadyordered`
--
DROP TABLE IF EXISTS `alreadyordered`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `alreadyordered`  AS  select `mp_orders`.`UserID` AS `UserID`,`mp_orders`.`OrderID` AS `OrderID`,`mp_orders`.`Time` AS `Time`,`mp_menu`.`Name` AS `Name`,`mp_menu`.`Preis` AS `Preis` from ((`mp_orders` join `mp_ordered_dishes`) join `mp_menu`) where ((`mp_orders`.`OrderID` = `mp_ordered_dishes`.`OrderID`) and (`mp_menu`.`MenuID` = `mp_ordered_dishes`.`MenuID`)) order by `mp_orders`.`UserID`,`mp_orders`.`Time` ;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `mp_menu`
--
ALTER TABLE `mp_menu`
  ADD PRIMARY KEY (`MenuID`);

--
-- Indizes für die Tabelle `mp_ordered_dishes`
--
ALTER TABLE `mp_ordered_dishes`
  ADD PRIMARY KEY (`odID`),
  ADD KEY `odToOrder` (`OrderID`),
  ADD KEY `odToMenu` (`MenuID`);

--
-- Indizes für die Tabelle `mp_orders`
--
ALTER TABLE `mp_orders`
  ADD PRIMARY KEY (`OrderID`),
  ADD KEY `OrderToUser` (`UserID`);

--
-- Indizes für die Tabelle `mp_shopping_cart`
--
ALTER TABLE `mp_shopping_cart`
  ADD PRIMARY KEY (`ItemID`),
  ADD KEY `scToUser` (`UserID`),
  ADD KEY `scToMenu` (`MenuID`);

--
-- Indizes für die Tabelle `mp_users`
--
ALTER TABLE `mp_users`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `mp_menu`
--
ALTER TABLE `mp_menu`
  MODIFY `MenuID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT für Tabelle `mp_ordered_dishes`
--
ALTER TABLE `mp_ordered_dishes`
  MODIFY `odID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `mp_orders`
--
ALTER TABLE `mp_orders`
  MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `mp_shopping_cart`
--
ALTER TABLE `mp_shopping_cart`
  MODIFY `ItemID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `mp_users`
--
ALTER TABLE `mp_users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `mp_ordered_dishes`
--
ALTER TABLE `mp_ordered_dishes`
  ADD CONSTRAINT `odToMenu` FOREIGN KEY (`MenuID`) REFERENCES `mp_menu` (`MenuID`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `odToOrder` FOREIGN KEY (`OrderID`) REFERENCES `mp_orders` (`OrderID`);

--
-- Constraints der Tabelle `mp_orders`
--
ALTER TABLE `mp_orders`
  ADD CONSTRAINT `OrderToUser` FOREIGN KEY (`UserID`) REFERENCES `mp_users` (`UserID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `mp_shopping_cart`
--
ALTER TABLE `mp_shopping_cart`
  ADD CONSTRAINT `scToMenu` FOREIGN KEY (`MenuID`) REFERENCES `mp_menu` (`MenuID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `scToUser` FOREIGN KEY (`UserID`) REFERENCES `mp_users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
