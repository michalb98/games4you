-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 27 Cze 2021, 21:44
-- Wersja serwera: 10.4.19-MariaDB
-- Wersja PHP: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `sklep`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `additional_data`
--

CREATE TABLE `additional_data` (
  `ID_Additional_data` int(7) NOT NULL,
  `ID_Country` int(3) DEFAULT NULL,
  `Name` varchar(200) COLLATE utf8_polish_ci DEFAULT NULL,
  `Surname` varchar(200) COLLATE utf8_polish_ci DEFAULT NULL,
  `Postal_code` int(5) DEFAULT NULL,
  `City` varchar(200) COLLATE utf8_polish_ci DEFAULT NULL,
  `Street` varchar(200) COLLATE utf8_polish_ci DEFAULT NULL,
  `Street_number` varchar(5) COLLATE utf8_polish_ci DEFAULT NULL,
  `House_number` varchar(5) COLLATE utf8_polish_ci DEFAULT NULL,
  `NIP` varchar(11) COLLATE utf8_polish_ci DEFAULT NULL,
  `Phone_number` varchar(20) COLLATE utf8_polish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `discount_code`
--

CREATE TABLE `discount_code` (
  `ID_Discount_code` int(9) NOT NULL,
  `Code` varchar(250) COLLATE utf8_polish_ci NOT NULL,
  `Valid_from` date NOT NULL,
  `Valid_to` date NOT NULL,
  `Value` float(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `game`
--

CREATE TABLE `game` (
  `ID_Game` int(6) NOT NULL,
  `Title` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `Price_netto` float(5,2) NOT NULL,
  `Price_brutto` float(5,2) NOT NULL,
  `Short_description` varchar(250) COLLATE utf8_polish_ci NOT NULL,
  `Description` varchar(1000) COLLATE utf8_polish_ci NOT NULL,
  `Quantity` int(3) NOT NULL,
  `ID_Type` int(3) NOT NULL,
  `ID_Version` int(3) NOT NULL,
  `ID_Platform` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `game_tags`
--

CREATE TABLE `game_tags` (
  `ID_Game_tags` int(7) NOT NULL,
  `ID_Game` int(6) NOT NULL,
  `ID_Tag` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `platform`
--

CREATE TABLE `platform` (
  `ID_Platform` int(3) NOT NULL,
  `Platform` varchar(100) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `platform`
--

INSERT INTO `platform` (`ID_Platform`, `Platform`) VALUES
(1, 'Steam'),
(2, 'Origin'),
(3, 'Uplay'),
(4, 'GOG'),
(5, 'Battle.net'),
(6, 'Epic Games'),
(7, 'Rockstar Games'),
(8, 'Xbox Live'),
(9, 'PSN'),
(10, 'Nintendo'),
(11, 'DRM Free');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `returns`
--

CREATE TABLE `returns` (
  `ID_Returns` int(9) NOT NULL,
  `ID_Transaction` int(9) NOT NULL,
  `ID_Discount_code` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `tag`
--

CREATE TABLE `tag` (
  `ID_Tag` int(7) NOT NULL,
  `Tag` varchar(100) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `tag`
--

INSERT INTO `tag` (`ID_Tag`, `Tag`) VALUES
(1, 'Survival'),
(2, 'Strzelanka'),
(3, 'FPS'),
(4, 'TPS'),
(5, 'Wieloosobowe'),
(6, 'Battle royal'),
(7, 'PvP'),
(8, 'Akcja'),
(9, 'Sieciowa koopoeracja'),
(10, 'Taktyczna'),
(11, 'Strategia'),
(12, 'Zespołowe'),
(13, 'Trudne'),
(14, 'Skradanie'),
(15, 'Symulatory'),
(16, 'Wyścigowe'),
(17, 'Otwarty świat'),
(18, 'Przygodowe'),
(19, 'Sportowe'),
(20, 'Klimatyczne'),
(21, 'Zręcznościowe'),
(22, 'Destrukcja'),
(23, 'Dzielony ekran'),
(24, 'VR'),
(25, 'Mroczne'),
(26, 'Tajemnicze'),
(27, 'Niezależne'),
(28, 'Śledztwo'),
(29, 'Wczesny dostęp'),
(30, '2D'),
(31, '3D');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `transaction`
--

CREATE TABLE `transaction` (
  `ID_Transaction` int(9) NOT NULL,
  `ID_Game` int(6) NOT NULL,
  `ID_User` int(7) NOT NULL,
  `Price_netto` float(5,2) NOT NULL,
  `Price_brutto` float(5,2) NOT NULL,
  `Show_key` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `type`
--

CREATE TABLE `type` (
  `ID_Type` int(3) NOT NULL,
  `Type` varchar(100) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `type`
--

INSERT INTO `type` (`ID_Type`, `Type`) VALUES
(1, 'Otwarty świat'),
(2, 'Akcja'),
(3, 'Przygodowa'),
(4, 'Strategiczne'),
(5, 'Wyścigowe i sportowe'),
(6, 'Tajemnicze i detektywistyczne '),
(7, 'Horrory'),
(8, 'Science fiction'),
(9, 'Roguelike'),
(10, 'RPG'),
(11, 'Symulacje'),
(12, 'Survival'),
(13, 'Kosmos');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user`
--

CREATE TABLE `user` (
  `ID_User` int(7) NOT NULL,
  `Email` varchar(250) COLLATE utf8_polish_ci NOT NULL,
  `Login` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `Password` varchar(512) COLLATE utf8_polish_ci NOT NULL,
  `ID_Additional_data` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `version`
--

CREATE TABLE `version` (
  `ID_Version` int(3) NOT NULL,
  `Version` varchar(100) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `version`
--

INSERT INTO `version` (`ID_Version`, `Version`) VALUES
(1, 'PC'),
(2, 'Xbox One'),
(3, 'Xbox Series S/X'),
(4, 'PlayStation 4'),
(5, 'PlayStation 5'),
(6, 'Nintendo Switch');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `additional_data`
--
ALTER TABLE `additional_data`
  ADD PRIMARY KEY (`ID_Additional_data`);

--
-- Indeksy dla tabeli `discount_code`
--
ALTER TABLE `discount_code`
  ADD PRIMARY KEY (`ID_Discount_code`);

--
-- Indeksy dla tabeli `game`
--
ALTER TABLE `game`
  ADD PRIMARY KEY (`ID_Game`),
  ADD KEY `ID_Platform` (`ID_Platform`),
  ADD KEY `ID_Type` (`ID_Type`),
  ADD KEY `ID_Version` (`ID_Version`);

--
-- Indeksy dla tabeli `platform`
--
ALTER TABLE `platform`
  ADD PRIMARY KEY (`ID_Platform`);

--
-- Indeksy dla tabeli `returns`
--
ALTER TABLE `returns`
  ADD PRIMARY KEY (`ID_Returns`);

--
-- Indeksy dla tabeli `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`ID_Tag`);

--
-- Indeksy dla tabeli `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`ID_Transaction`);

--
-- Indeksy dla tabeli `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`ID_Type`);

--
-- Indeksy dla tabeli `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID_User`);

--
-- Indeksy dla tabeli `version`
--
ALTER TABLE `version`
  ADD PRIMARY KEY (`ID_Version`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `additional_data`
--
ALTER TABLE `additional_data`
  MODIFY `ID_Additional_data` int(7) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `discount_code`
--
ALTER TABLE `discount_code`
  MODIFY `ID_Discount_code` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `game`
--
ALTER TABLE `game`
  MODIFY `ID_Game` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `platform`
--
ALTER TABLE `platform`
  MODIFY `ID_Platform` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT dla tabeli `returns`
--
ALTER TABLE `returns`
  MODIFY `ID_Returns` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `tag`
--
ALTER TABLE `tag`
  MODIFY `ID_Tag` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT dla tabeli `transaction`
--
ALTER TABLE `transaction`
  MODIFY `ID_Transaction` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `type`
--
ALTER TABLE `type`
  MODIFY `ID_Type` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT dla tabeli `user`
--
ALTER TABLE `user`
  MODIFY `ID_User` int(7) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `version`
--
ALTER TABLE `version`
  MODIFY `ID_Version` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `game`
--
ALTER TABLE `game`
  ADD CONSTRAINT `game_ibfk_1` FOREIGN KEY (`ID_Platform`) REFERENCES `platform` (`ID_Platform`),
  ADD CONSTRAINT `game_ibfk_2` FOREIGN KEY (`ID_Type`) REFERENCES `type` (`ID_Type`),
  ADD CONSTRAINT `game_ibfk_3` FOREIGN KEY (`ID_Version`) REFERENCES `version` (`ID_Version`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
