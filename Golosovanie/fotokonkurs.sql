-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Loomise aeg: Aprill 17, 2025 kell 09:51 EL
-- Serveri versioon: 10.4.32-MariaDB
-- PHP versioon: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Andmebaas: `nikkon`
--

-- --------------------------------------------------------

--
-- Tabeli struktuur tabelile `fotokonkurs`
--

CREATE TABLE `fotokonkurs` (
  `id` int(11) NOT NULL,
  `fotoNimetus` varchar(50) DEFAULT NULL,
  `pilt` text DEFAULT NULL,
  `autor` varchar(50) DEFAULT NULL,
  `punktid` int(11) DEFAULT 0,
  `lisamisAeg` date DEFAULT NULL,
  `komentaarid` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Andmete tõmmistamine tabelile `fotokonkurs`
--

INSERT INTO `fotokonkurs` (`id`, `fotoNimetus`, `pilt`, `autor`, `punktid`, `lisamisAeg`, `komentaarid`) VALUES
(1, '\"Russ\"', 'https://img.gazeta.ru/files3/901/10129901/AGf8qeN7itA-pic905-895x505-42072.jpg', 'Narod', 9, '2025-04-18', 'üpölkmnb');

--
-- Indeksid tõmmistatud tabelitele
--

--
-- Indeksid tabelile `fotokonkurs`
--
ALTER TABLE `fotokonkurs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT tõmmistatud tabelitele
--

--
-- AUTO_INCREMENT tabelile `fotokonkurs`
--
ALTER TABLE `fotokonkurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
