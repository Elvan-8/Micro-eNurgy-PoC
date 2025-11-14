-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Gegenereerd op: 14 nov 2025 om 15:28
-- Serverversie: 8.0.40
-- PHP-versie: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `micro_enurgy_poc`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `exercises`
--

CREATE TABLE `exercises` (
  `excercise_id` int NOT NULL,
  `titel` varchar(255) NOT NULL,
  `beschrijving` text NOT NULL,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Gegevens worden geëxporteerd voor tabel `exercises`
--

INSERT INTO `exercises` (`excercise_id`, `titel`, `beschrijving`, `user_id`) VALUES
(1, 'Eerste oefening', 'Dit is hoe je de oefening uitvoert.', 1),
(2, 'Oefening 2', 'Deze oefening is echt heel goed.', 2),
(3, '<script>alert(\'Ik ben gehackt\');</script>', '', 1),
(4, 'Meester oefening', 'Als je deze oefening uitvoert dan ben je meester over je eigen meesterschap.', 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `user_id` int NOT NULL,
  `naam` varchar(255) NOT NULL,
  `wachtwoord` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`user_id`, `naam`, `wachtwoord`) VALUES
(1, 'Test gebruiker', '$2y$10$mBbVt3gcUgTXHC4X1GGuLOqVGyFsgGpiA2ISkwFKDbPA2O3VbN.w.'),
(2, 'Test gebruiker 2', '');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `exercises`
--
ALTER TABLE `exercises`
  ADD PRIMARY KEY (`excercise_id`),
  ADD KEY `fk_exercises_users` (`user_id`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `exercises`
--
ALTER TABLE `exercises`
  MODIFY `excercise_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `exercises`
--
ALTER TABLE `exercises`
  ADD CONSTRAINT `fk_exercises_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
