-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 22 Cze 2022, 15:08
-- Wersja serwera: 10.4.24-MariaDB
-- Wersja PHP: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `comamzrobicdb`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `categoryName` varchar(20) COLLATE utf8_polish_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `categories`
--

INSERT INTO `categories` (`ID`, `categoryName`) VALUES
(1, 'Rozrywka'),
(2, 'Obowiązki'),
(4, 'Szkoła i Uczelnia');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `roleName` varchar(20) COLLATE utf8_polish_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `roles`
--

INSERT INTO `roles` (`ID`, `roleName`) VALUES
(1, 'headAdmin'),
(2, 'admin'),
(3, 'user'),
(4, 'rootAdmin'),
(6, 'banned');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `status`
--

CREATE TABLE IF NOT EXISTS `status` (
  `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `statusName` varchar(20) COLLATE utf8_polish_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `status`
--

INSERT INTO `status` (`ID`, `statusName`) VALUES
(1, 'W trakcie '),
(2, 'Zrealizowane'),
(3, 'Nie zaczęte');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `thingstodo`
--

CREATE TABLE IF NOT EXISTS `thingstodo` (
  `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `userID` int(10) UNSIGNED NOT NULL,
  `catID` int(10) UNSIGNED NOT NULL,
  `statusID` int(10) UNSIGNED NOT NULL DEFAULT 3,
  `text` text COLLATE utf8_polish_ci NOT NULL,
  `deadLineDate` date NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`ID`),
  KEY `userID` (`userID`),
  KEY `catID` (`catID`),
  KEY `statusID` (`statusID`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `thingstodo`
--

INSERT INTO `thingstodo` (`ID`, `userID`, `catID`, `statusID`, `text`, `deadLineDate`, `date`) VALUES
(9, 13, 1, 3, 'cfqawfdqw', '2022-06-30', '2022-06-20 08:53:23'),
(10, 13, 1, 3, 'wefew', '2022-06-28', '2022-06-20 10:49:04'),
(11, 13, 1, 1, 'fdeqwfw', '2022-06-22', '2022-06-20 15:36:58'),
(12, 13, 2, 3, 'dfwefw', '2022-06-29', '2022-06-20 14:59:20'),
(14, 13, 4, 3, 'cqaewc', '2022-06-28', '2022-06-20 14:59:26'),
(16, 13, 1, 3, 'dawq', '2022-06-28', '2022-06-20 10:57:13'),
(17, 13, 1, 2, 'dwqdq', '2022-07-09', '2022-06-20 15:36:50');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `email` varchar(1000) COLLATE utf8_polish_ci NOT NULL,
  `roleID` int(10) UNSIGNED NOT NULL DEFAULT 3,
  `data` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`ID`),
  KEY `roleID` (`roleID`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`ID`, `username`, `password`, `email`, `roleID`, `data`) VALUES
(8, 'arek', '$2y$10$/xhbxUiRhbJ8UuoyXCJ0weThn9QGSkuze6RSNA9/NvNghnOl.9N86', '123@gmail.com', 1, '2022-06-14 20:03:12'),
(9, 'ania', '$2y$10$XC.aX93LJlc16AObrAr/ze4B.XUoOSBheERCiUh3/FpOWopFmbOn.', '123@gmail.com', 2, '2022-05-31 11:26:04'),
(11, 'user', '$2y$10$UTzO8xcfHCWgP65ciZsB1.Nm/jHAZ4Dq9l6p4dnttCCFiLMxKmYZ6', 'mail@mail.pl', 6, '2022-06-14 14:55:35'),
(12, 'szary', '$2y$10$IG0Nn2Z5tNhzEbNaAtnqy.J8yj2a1ExjCBWfLPVUq6ilG9j/wgQqK', 'szary@gmail.com', 6, '2022-06-19 07:21:54'),
(13, 'SebverPL', '$2y$10$OrwQpFITYeBjK/pqrxh7IelWsN0zWb./693LWW132uFIiKHjsN476', 'sebastian.jurek2000@gmail.com', 4, '2022-06-14 20:07:19');

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `thingstodo`
--
ALTER TABLE `thingstodo`
  ADD CONSTRAINT `thingstodo_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`ID`),
  ADD CONSTRAINT `thingstodo_ibfk_2` FOREIGN KEY (`catID`) REFERENCES `categories` (`ID`),
  ADD CONSTRAINT `thingstodo_ibfk_3` FOREIGN KEY (`statusID`) REFERENCES `status` (`ID`);

--
-- Ograniczenia dla tabeli `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`roleID`) REFERENCES `roles` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
