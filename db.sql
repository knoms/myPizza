-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Erstellungszeit: 28. Dez 2018 um 19:35
-- Server-Version: 10.1.36-MariaDB
-- PHP-Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `myPizza`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `mp_menu`
--

CREATE TABLE `mp_menu` (
  `MenuID` int(11) NOT NULL,
  `Name` varchar(32) COLLATE utf8_german2_ci NOT NULL,
  `Size` char(1) COLLATE utf8_german2_ci NOT NULL,
  `Preis` decimal(4,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

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
  MODIFY `MenuID` int(11) NOT NULL AUTO_INCREMENT;

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
