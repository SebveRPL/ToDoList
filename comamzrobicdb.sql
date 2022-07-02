-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 14 Cze 2022, 22:09
-- Wersja serwera: 10.4.18-MariaDB
-- Wersja PHP: 8.0.3

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

CREATE TABLE `categories` (
  `ID` int(10) UNSIGNED NOT NULL,
  `categoryName` varchar(20) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

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

CREATE TABLE `roles` (
  `ID` int(10) UNSIGNED NOT NULL,
  `roleName` varchar(20) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

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

CREATE TABLE `status` (
  `ID` int(10) UNSIGNED NOT NULL,
  `statusName` varchar(20) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

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

CREATE TABLE `thingstodo` (
  `ID` int(10) UNSIGNED NOT NULL,
  `userID` int(10) UNSIGNED NOT NULL,
  `catID` int(10) UNSIGNED NOT NULL,
  `statusID` int(10) UNSIGNED NOT NULL DEFAULT 3,
  `text` text COLLATE utf8_polish_ci NOT NULL,
  `deadLineDate` date NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `ID` int(10) UNSIGNED NOT NULL,
  `username` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `email` varchar(1000) COLLATE utf8_polish_ci NOT NULL,
  `roleID` int(10) UNSIGNED NOT NULL DEFAULT 3,
  `data` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`ID`, `username`, `password`, `email`, `roleID`, `data`) VALUES
(8, 'arek', '$2y$10$/xhbxUiRhbJ8UuoyXCJ0weThn9QGSkuze6RSNA9/NvNghnOl.9N86', '123@gmail.com', 1, '2022-06-14 20:03:12'),
(9, 'ania', '$2y$10$XC.aX93LJlc16AObrAr/ze4B.XUoOSBheERCiUh3/FpOWopFmbOn.', '123@gmail.com', 2, '2022-05-31 11:26:04'),
(11, 'user', '$2y$10$UTzO8xcfHCWgP65ciZsB1.Nm/jHAZ4Dq9l6p4dnttCCFiLMxKmYZ6', 'mail@mail.pl', 6, '2022-06-14 14:55:35'),
(12, 'szary', '$2y$10$IG0Nn2Z5tNhzEbNaAtnqy.J8yj2a1ExjCBWfLPVUq6ilG9j/wgQqK', 'szary@gmail.com', 6, '2022-06-14 14:58:42'),
(13, 'SebverPL', '$2y$10$OrwQpFITYeBjK/pqrxh7IelWsN0zWb./693LWW132uFIiKHjsN476', 'sebastian.jurek2000@gmail.com', 4, '2022-06-14 20:07:19');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `thingstodo`
--
ALTER TABLE `thingstodo`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `catID` (`catID`),
  ADD KEY `statusID` (`statusID`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `roleID` (`roleID`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `categories`
--
ALTER TABLE `categories`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `roles`
--
ALTER TABLE `roles`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT dla tabeli `status`
--
ALTER TABLE `status`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `thingstodo`
--
ALTER TABLE `thingstodo`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
