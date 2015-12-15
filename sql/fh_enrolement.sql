-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 15. Dez 2015 um 14:11
-- Server-Version: 10.0.17-MariaDB
-- PHP-Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `fhweb`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `fh_enrolement`
--

CREATE TABLE `fh_enrolement` (
  `institution` text NOT NULL,
  `partner` text NOT NULL,
  `street` text NOT NULL,
  `postalcode` int(4) NOT NULL,
  `city` text NOT NULL,
  `website` text NOT NULL,
  `email` text NOT NULL,
  `phonenumber` text NOT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `fh_enrolement`
--

INSERT INTO `fh_enrolement` (`institution`, `partner`, `street`, `postalcode`, `city`, `website`, `email`, `phonenumber`, `date`) VALUES
('FHNW', 'Jenny Ruppen', 'Von Roll Strasse 12', 4600, 'Olten', 'http://www.fhnw.ch/', 'jenny.ruppen@students.fhnw.ch', '0797473962', '2015-12-08');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `fh_enrolement`
--
ALTER TABLE `fh_enrolement`
  ADD PRIMARY KEY (`email`(100));

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
