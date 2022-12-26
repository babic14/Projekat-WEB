-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 26, 2022 at 02:35 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projekat`
--

-- --------------------------------------------------------

--
-- Table structure for table `igrica`
--

CREATE TABLE `igrica` (
  `id` int(6) UNSIGNED NOT NULL,
  `ime` varchar(100) NOT NULL,
  `imekreatora` varchar(30) NOT NULL,
  `opis` varchar(500) NOT NULL,
  `vreme` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `igrica`
--

INSERT INTO `igrica` (`id`, `ime`, `imekreatora`, `opis`, `vreme`) VALUES
(1, 'Counter-Strike: Global Offensive', 'Valve', 'Takticka pucacina iz prvog lica. To je cetvrta igrica u Counter-Strike serijalu. Poseduje stare mape sa redizajniranim teksturama, kao i potpuno nove mape, rankove i modove. Igra je na lansiranju bila dobro prihvaćena od strane kritike, ali ne i od strane igraca.\r\n', '21. avgust 2012.'),
(2, 'League of Legends', 'Riot Games', 'Visekorisnicka onlajn borbena arena koju je razvila i izdala kompanija Riot Games za Windows i MacOS. Igra koristi Frimium model i podržana je mikrotransakcijama, inspirisana igrama kao što su Warcraft III: The Frozen Throne i Defense of the Ancients.', '27. oktobar 2009.'),
(3, 'Rocket League', 'Psyonix', 'Fudbalska video-igra koju je razvio i objavio Psyonix. Igra je prvi put objavljena za Microsoft Windows i Playstation 4 u julu 2015. godine, a portovi za Xbox One i Nintendo Switch su objavljeni kasnije.  Igra je postala besplatna u septembru 2020. godine.', '7. jul 2015.'),
(4, 'God of War Ragnarök', 'Santa Monica Studio', 'Akciono-avanturisticka igra koju je objavio  Sony Interactive Entertainment. Objavljen je sirom sveta u novembru 2022. za PlayStation 4 i PlayStation 5, oznacavajuci prvo izdanje za vise generacija u seriji God of War. To je deveti deo u seriji, deveti hronoloski i nastavak God of War iz 2018.', '9. novembar 2022.');

-- --------------------------------------------------------

--
-- Table structure for table `komentari`
--

CREATE TABLE `komentari` (
  `id` int(6) UNSIGNED NOT NULL,
  `id_igrice` int(6) UNSIGNED NOT NULL,
  `ime_korisnika` varchar(30) NOT NULL,
  `opis` varchar(200) DEFAULT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `komentari`
--

INSERT INTO `komentari` (`id`, `id_igrice`, `ime_korisnika`, `opis`, `reg_date`) VALUES
(27, 2, 'pedja_babic', 'teter', '2022-12-21 17:39:53');

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `id` int(6) UNSIGNED NOT NULL,
  `username` varchar(30) NOT NULL,
  `sifra` varchar(30) NOT NULL,
  `vreme` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `administrator` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`id`, `username`, `sifra`, `vreme`, `administrator`) VALUES
(1, 'pedja_babic', '123', '2022-12-19 12:46:40', 1),
(2, 'basca', '567', '2022-12-19 12:47:26', 1),
(3, 'vucko', '1234', '2022-12-19 12:47:55', 0),
(4, 'lukarvucicevic', 'luka123', '2022-12-21 16:35:05', 0),
(5, 'lukavucicevic', 'pedjajepicka', '2022-12-26 13:26:03', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `igrica`
--
ALTER TABLE `igrica`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `komentari`
--
ALTER TABLE `komentari`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_igrice` (`id_igrice`);

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `igrica`
--
ALTER TABLE `igrica`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `komentari`
--
ALTER TABLE `komentari`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `komentari`
--
ALTER TABLE `komentari`
  ADD CONSTRAINT `komentari_ibfk_1` FOREIGN KEY (`id_igrice`) REFERENCES `igrica` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
