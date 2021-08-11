-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 10 Sie 2021, 20:35
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
  `Postal_code` varchar(7) COLLATE utf8_polish_ci DEFAULT NULL,
  `City` varchar(200) COLLATE utf8_polish_ci DEFAULT NULL,
  `Street` varchar(200) COLLATE utf8_polish_ci DEFAULT NULL,
  `Street_number` varchar(5) COLLATE utf8_polish_ci DEFAULT NULL,
  `House_number` varchar(5) COLLATE utf8_polish_ci DEFAULT NULL,
  `Email` varchar(250) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `additional_data`
--

INSERT INTO `additional_data` (`ID_Additional_data`, `ID_Country`, `Name`, `Surname`, `Postal_code`, `City`, `Street`, `Street_number`, `House_number`, `Email`) VALUES
(1, 30, 'Michał', 'Błaszczyk', '99-300', 'Kutno', 'Łokietka', '6', '60', 'darx12311@gmail.com'),
(5, 0, '', '', '', '', '', '', '', 'test@test.test'),
(6, 30, '', '', '', '', '', '', '', 'test2@test.test');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `countries`
--

CREATE TABLE `countries` (
  `ID_Country` int(3) NOT NULL,
  `Country` varchar(250) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `countries`
--

INSERT INTO `countries` (`ID_Country`, `Country`) VALUES
(0, 'Wybierz swój kraj...'),
(1, 'Albania'),
(2, 'Andora'),
(3, 'Austria'),
(4, 'Belgia'),
(5, 'Białoruś'),
(6, 'Bośnia i Hercegowina'),
(7, 'Bułgaria'),
(8, 'Chorwacja'),
(9, 'Czarnogóra'),
(10, 'Czechy'),
(11, 'Dania'),
(12, 'Estonia'),
(13, 'Finlandia'),
(14, 'Francja'),
(15, 'Grecja'),
(16, 'Hiszpania'),
(17, 'Holandia'),
(18, 'Irlandia'),
(19, 'Islandia'),
(20, 'Liechtenstein'),
(21, 'Litwa'),
(22, 'Luksemburg'),
(23, 'Łotwa'),
(24, 'Macedonia Północna'),
(25, 'Malta'),
(26, 'Mołdawia'),
(27, 'Monako'),
(28, 'Niemcy'),
(29, 'Norwegia'),
(30, 'Polska'),
(31, 'Portugalia'),
(32, 'Rosja'),
(33, 'Rumunia'),
(34, 'San Marino'),
(35, 'Serbia'),
(36, 'Słowacja'),
(37, 'Słowenia'),
(38, 'Szwajcaria'),
(39, 'Szwecja'),
(40, 'Turcja'),
(41, 'Ukraina'),
(42, 'Watykan'),
(43, 'Węgry'),
(44, 'Wielka Brytania'),
(45, 'Włochy');

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
  `Description` varchar(5000) COLLATE utf8_polish_ci NOT NULL,
  `Quantity` int(3) NOT NULL,
  `ID_Type` int(3) NOT NULL,
  `ID_Version` int(3) NOT NULL,
  `ID_Platform` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `game`
--

INSERT INTO `game` (`ID_Game`, `Title`, `Price_netto`, `Price_brutto`, `Short_description`, `Description`, `Quantity`, `ID_Type`, `ID_Version`, `ID_Platform`) VALUES
(1, 'Days Gone', 130.07, 159.99, 'Jedź i walcz w zabójczej, postpandemicznej Ameryce. W tej przygodowej grze akcji z otwartym światem zagrasz jako Deacon St. John, walczący o przetrwanie włóczęga i łowca nagród, przemierzający zniszczoną drogę w poszukiwaniu powodów, by dalej żyć.', 'Days Gone  to klasyczna przygodowa gra akcji, w której kamera znajduje się stale za plecami głównego bohatera. Podczas rozgrywki eksplorujemy obszerną sandboksową mapę, wykonujemy zadania (główne i poboczne – np. czyszczenie obozów z bandytów czy polowanie na zwierzęta) i walczymy z wrogami – zarówno ludźmi, jak i z rozmaitymi rodzajami groźnych ofiar wirusa. Te ostatnie często poruszają się w hordach liczących nawet kilkaset osobników, a do tego posiadają własne potrzeby i regulujący ich zachowanie cykl dobowy. Ciekawym detalem urozmaicającym zabawę jest częściowa interaktywność otoczenia – mamy możliwość m.in. popychania przeciwników na obiekty lub przecinania lin podtrzymujących ścięte drzewa. Twórcy położyli też duży nacisk na taktykę i planowanie – szczególnie w przypadku starć z ludzkimi wrogami. Walczymy, korzystając z rozbudowanego arsenału, m.in. karabinów maszynowych, shotgunów czy snajperek. Deacon dysponuje również kilkoma specjalnymi umiejętnościami, takimi jak np. spowalnianie czasu w trakcie walki (klasyczny bullet time) czy tzw. survival vision, umożliwiające podkreślanie ważnych przedmiotów i przeciwników, dzięki czemu łatwiej jest dostrzec, co i kto nas otacza – i gdzie mogą kryć się potencjalne zagrożenia. W miarę postępów w rozgrywce bohater może uczyć się nowych rzeczy i stopniowo rozwijać statystyki (takie jak życie czy wytrzymałość). Gra posiada rozbudowany, ale relatywnie prosty w obsłudze system rzemiosła, na potrzeby którego zbieramy duże ilości przeróżnych materiałów. Duże znaczenie dla rozgrywki ma także motocykl, którym poruszamy się po mapie. Mamy możliwość dostosowywania jego wyglądu, parametrów technicznych (np. poprzez zmianę opon czy silnika), a także zdobywania innych usprawnień, takich jak torby umożliwiające przewożenie większej liczby przedmiotów. Co ciekawe, nasz stalowy rumak wymaga benzyny, o której zapas trzeba się zatroszczyć, jeśli nie chcemy utknąć na niebezpiecznym pustkowiu.', 50, 2, 1, 1),
(2, 'Phasmophobia', 40.64, 49.99, 'Phasmophobia jest nietypowym survival horrorem, który został opracowany z myślą o 4-osobowym trybie kooperacyjnym. Tytuł oferuje też wsparcie dla wirtualnej rzeczywistości. Za jego opracowane i wydanie odpowiada niezależne studio Kinetic Games.', 'W Phasmophobia akcję obserwujemy z perspektywy pierwszoosobowej. Zabawa polega na eksplorowaniu nawiedzonych miejsc i zbieraniu dowodów na istnienie duchów. Wykorzystujemy do tego celu specjalny sprzęt, taki jak mierniki pola elektromagnetycznego, kamery CTTV czy detektory ruchu (częścią sprzętu zarządzamy z ciężarówki będącej naszą bazą – odpowiada za to jeden z członków zespołu). Warto odnotować, że czym dłużej znajdujemy się w danej lokalizacji (deweloperzy przygotowali kilka odmiennych miejsc – mamy do wyboru posiadłość, więzienie, farmę, szkołę czy szpital), tym bardziej niebezpieczna się ona staje. W grze można znaleźć przeszło dziesięć unikatowych typów duchów – każdy z nich posiada wyjątkowe cechy, dzięki czemu kolejne dochodzenia zauważalnie różnią się od siebie. Co ciekawe, gra wykorzystuje też funkcję wykrywania mowy, dzięki której czasem możemy wchodzić w interakcje z duchami używając swojego własnego głosu.', 20, 7, 1, 1),
(30, 'The Sims 4', 81.29, 99.99, 'Poczuj moc tworzenia i kontrolowania własnych postaci w wirtualnym świecie, w którym nie ma ograniczeń. Doświadczaj wolności w zabawie, rządź i pogrywaj z życiem!', '\"Puść wodze wyobraźni i stwórz wyjątkowy świat Simów. Odkrywaj bogactwo opcji i dostosowuj najdrobniejsze szczegóły dotyczące Simów, ich domów i nie tylko. Wybierz wygląd, zachowanie i ubiór Simów. Określ, jak będą spędzać codzienne życie. Projektuj i buduj wyjątkowe domy dla każdej z rodzin, a potem wyposażaj je, dodając ulubione meble i dekoracje. Odwiedzaj różnorodne otoczenia, w których możesz poznawać innych Simów i ich historie. Odkrywaj piękne lokacje z niepowtarzalnym klimatem i funduj Simom spontaniczne przygody. Przeżywaj razem z nimi radości i smutki codzienności i rozgrywaj realistyczne lub kompletnie zakręcone scenariusze. Opowiadaj historie Simów tak, jak chcesz, buduj ich związki, rozwijaj kariery, wypełniaj życiowe aspiracje i zanurz się w świecie tej wyjątkowej gry, w której możliwości są naprawdę nieograniczone.', 20, 11, 1, 2),
(31, 'Grand Theft Auto V', 97.55, 119.99, 'Grand Theft Auto V na PC pozwala graczom zobaczyć ogromny świat Los Santos i hrabstwa Blaine w rozdzielczości sięgającej 4K i lepszej oraz w 60 klatkach na sekundę.', 'Gdy młody opryszek, emerytowany rabuś oraz przerażający psychol wplątują się w gangsterskie porachunki i interesy świata zbrodni, rządu USA i przemysłu rozrywkowego, muszą wykonać serię niebezpiecznych napadów, aby przetrwać w bezlitosnym świecie, w którym zdrada czyha na każdym kroku.', 20, 1, 1, 7),
(32, 'Forza Horizon 4', 162.59, 199.99, 'Dynamiczne pory roku całkowicie zmienią największy motoryzacyjny festiwal świata. Weź w niej udział samodzielnie lub stwórz drużynę wraz z innymi graczami.', 'Dynamiczne pory roku całkowicie zmienią największy motoryzacyjny festiwal świata. Weź w niej udział samodzielnie lub stwórz drużynę wraz z innymi graczami. Podziwiaj historyczne zakątki Brytanii, przemierzając wspólny otwarty świat w jednym z 450 różnych modeli samochodów do zebrania i zmodyfikowania. Wyścigi, popisy kaskaderskie, budowanie i eksploracja – wybierz swoją specjalność i zostań supergwiazdą Horizon.', 20, 5, 1, 1),
(37, 'Wiedźmin 3 Dziki Gon', 81.29, 99.99, 'Wejdź w rolę profesjonalnego zabójcy potworów, Geralta z Rivii. Przemierzaj ogarnięte wojną Królestwa Północy idąc śladami Ciri, dziewczyny z prastarej przepowiedni, której magiczny talent może zniszczyć świat.', 'Wiedźmin: Dziki Gon to osadzona w olśniewającym uniwersum fantasy gra RPG nowej generacji, w której nacisk położono na otwarty świat, bogatą fabułę, trudne wybory i rzeczywiste konsekwencje. W grze wcielasz się w Geralta z Rivii — zawodowego łowcę potworów, któremu powierzono zadanie odszukania dziecka z prastarej przepowiedni. Czeka na ciebie ogromny, otwarty świat pełen kupieckich miast, wysp piratów, niebezpiecznych górskich przełęczy i zapomnianych jaskiń.', 50, 10, 1, 4),
(38, 'Cyberpunk 2077', 162.59, 199.99, 'Cyberpunk 2077 to rozgrywająca się w otwartym świecie przygoda, której akcja toczy się w Night City, megalopolis rządzonym przez obsesyjną pogoń za władzą, sławą i przerabianiem własnego ciała. Nazywasz się V i musisz zdobyć implant.', 'Cyberpunk 2077 to rozgrywająca się w otwartym świecie przygoda, której akcja toczy się w Night City, megalopolis rządzonym przez obsesyjną pogoń za władzą, sławą i przerabianiem własnego ciała. Nazywasz się V i musisz zdobyć jedyny w swoim rodzaju implant — klucz do nieśmiertelności. Stwórz własny styl gry i ruszaj na podbój potężnego miasta przyszłości, którego historię kształtują twoje decyzje.', 50, 10, 1, 4),
(39, 'This War of Mine', 48.77, 59.99, 'W grze nie wcielasz się w elitarnego żołnierza. Stajesz na czele grupki cywilów, starających się przeżyć w oblężonym mieście, zmagając się z brakiem żywności, lekarstw i ciągłym zagrożeniem ze strony snajperów i szabrowników.', 'W This War of Mine nie wcielasz się w rolę elitarnego żołnierza, lecz w grupę cywilów, którzy starają się przetrwać w oblężonym mieście, zmagając się z brakiem żywności, lekarstw i ciągłym zagrożeniem ze strony snajperów oraz szabrowników. Gra dostarcza przeżyć wojennych ukazanych z zupełnie wyjątkowej perspektywy.\r\n\r\nTempo rozgrywki jest oparte na cyklu dobowym. W ciągu dnia snajperzy uniemożliwiają ci opuszczanie schronienia, więc skupiaj się wtedy na utrzymywaniu go w jak najlepszym stanie, tworzeniu przedmiotów, wymienianiu się nimi oraz zajmowaniu się ocalałymi. Z kolei w nocy zabieraj jednego ze swoich ludzi na przeszukiwanie różnorodnych miejsc, starając się znaleźć rzeczy, które pomogą ci przetrwać.\r\n\r\nPodejmuj decyzje w sprawach życia i śmierci, kierując się własnym sumieniem. Postaraj się, by przeżyli wszyscy z twojego schronienia, lub poświęć kogoś, by mogli przetrwać inni. Podczas wojny nie ma dobrych i złych wyborów – jest tylko przetrwanie. Im szybciej to zrozumiesz, tym lepiej.', 25, 4, 1, 1),
(40, 'Ghost of Tsushima', 243.89, 299.99, 'Odkrywaj piękno Tsushimy w tej osadzonej w otwartym świecie przygodowej grze akcji stworzonej przez Sucker Punch Productions i PlayStation Studios, dostępnej na PS5 i PS4.', 'Rok 1274. Na kontynencie azjatyckim praktycznie niepodzielnie rządzi imperium mongolskie. Jego władcy łakomym okiem spoglądają na bogactwa feudalnej Japonii. Chan Kubilaj decyduje się w końcu na dokonanie inwazji. Jej pierwszym celem jest położona dokładnie pośrodku Cieśniny Koreańskiej wyspa Cuszima. Podczas ataku wojska mongolskie masakrują większość samurajów mieszkających na wyspie. Głównemu bohaterowi gry – Jinowi Sakai – cudem udaje się przetrwać tragiczną w skutkach bitwę. Od tego momentu głównym celem protagonisty staje się powstrzymanie Mongołów. Jednak aby tego dokonać, będzie musiał zapomnieć o samurajskich tradycjach.', 25, 3, 4, 9),
(42, 'Gears 5', 81.29, 99.99, 'Piąta część popularnego cyklu TPS-ów, w której wcielamy się w znaną z Gears of War 4 Kait Diaz. Protagonistka wyrusza w podróż do odległego zakątka planety Sera, by rozwikłać zagadkę trapiących ją koszmarów.', 'Akcja Gears 5 toczy się po wydarzeniach przedstawionych w czwartej części serii. W roli głównej obsadzono Kait Diaz, która w towarzystwie Delmonta Walkera udaje się w długą podróż przez malownicze, ale i pełne niebezpieczeństw zakątki planety Sera. Protagonistka zamierza dowiedzieć się więcej na temat pochodzenia Szarańczy (ang. Locust) i odkryć źródło trapiących ją koszmarów, w których, jak wierzy, kryje się jakaś wiadomość. Jedną z głównych osi fabularnych jest również uruchomienie Młota Świtu, czyli potężnej broni energetycznej atakującej z orbity.', 50, 2, 2, 8),
(43, 'Resident Evil Village', 203.24, 249.99, 'Oto survival horror, jakiego jeszcze nie było — ósma odsłona legendarnej serii Resident Evil. Realistyczna grafika, pierwszoosobowa akcja i mistrzowska fabuła sprawią, że poczucie zagrożenia będzie rzeczywiste jak nigdy.', 'Rok 1274. Na kontynencie azjatyckim praktycznie niepodzielnie rządzi imperium mongolskie. Jego władcy łakomym okiem spoglądają na bogactwa feudalnej Japonii. Chan Kubilaj decyduje się w końcu na dokonanie inwazji. Jej pierwszym celem jest położona dokładnie pośrodku Cieśniny Koreańskiej wyspa Cuszima. Podczas ataku wojska mongolskie masakrują większość samurajów mieszkających na wyspie. Głównemu bohaterowi gry – Jinowi Sakai – cudem udaje się przetrwać tragiczną w skutkach bitwę. Od tego momentu głównym celem protagonisty staje się powstrzymanie Mongołów. Jednak aby tego dokonać, będzie musiał zapomnieć o samurajskich tradycjach.', 20, 7, 1, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `game_rating`
--

CREATE TABLE `game_rating` (
  `ID_Game_rating` int(9) NOT NULL,
  `ID_Game` int(6) NOT NULL,
  `ID_User` int(7) NOT NULL,
  `Rating` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `game_rating`
--

INSERT INTO `game_rating` (`ID_Game_rating`, `ID_Game`, `ID_User`, `Rating`) VALUES
(1, 38, 1, 5);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `game_tags`
--

CREATE TABLE `game_tags` (
  `ID_Game_tags` int(7) NOT NULL,
  `ID_Game` int(6) NOT NULL,
  `ID_Tag` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `game_tags`
--

INSERT INTO `game_tags` (`ID_Game_tags`, `ID_Game`, `ID_Tag`) VALUES
(1, 1, 8),
(2, 1, 17);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `orders`
--

CREATE TABLE `orders` (
  `ID_Order` int(9) NOT NULL,
  `ID_Transaction` int(9) NOT NULL,
  `Order_number` varchar(256) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `orders`
--

INSERT INTO `orders` (`ID_Order`, `ID_Transaction`, `Order_number`) VALUES
(1, 1, '6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b'),
(2, 2, '6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b'),
(3, 2, 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `payment_method`
--

CREATE TABLE `payment_method` (
  `ID_Payment_method` int(2) NOT NULL,
  `Payment_method` varchar(100) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `payment_method`
--

INSERT INTO `payment_method` (`ID_Payment_method`, `Payment_method`) VALUES
(1, 'Mastercard'),
(2, 'Visa'),
(3, 'Paysafecard'),
(4, 'Skrill'),
(5, 'PayPal');

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
  `ID_Discount_code` int(9) DEFAULT NULL,
  `Price_netto` float(5,2) NOT NULL,
  `Price_brutto` float(5,2) NOT NULL,
  `Quantity` int(2) NOT NULL,
  `Data` date NOT NULL,
  `Show_key` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `transaction`
--

INSERT INTO `transaction` (`ID_Transaction`, `ID_Game`, `ID_User`, `ID_Discount_code`, `Price_netto`, `Price_brutto`, `Quantity`, `Data`, `Show_key`) VALUES
(1, 38, 1, NULL, 162.59, 199.99, 1, '2021-08-09', 0),
(2, 1, 1, NULL, 109.00, 169.00, 1, '2021-08-09', 0);

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
  `Login` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `Password` varchar(512) COLLATE utf8_polish_ci NOT NULL,
  `ID_Additional_data` int(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `user`
--

INSERT INTO `user` (`ID_User`, `Login`, `Password`, `ID_Additional_data`) VALUES
(0, 'Użytkownik usunięty', '', NULL),
(1, 'darx12311', '84f3773a2f6d75b4f2318d4ec8c826b311ab69679f2e4aafc1e8e74593e5a734ae60248895b4891e75584e35b40d1e1eace5f284cc18bdb826b0cb43d0cfca4b', 1),
(6, 'test1', '84f3773a2f6d75b4f2318d4ec8c826b311ab69679f2e4aafc1e8e74593e5a734ae60248895b4891e75584e35b40d1e1eace5f284cc18bdb826b0cb43d0cfca4b', 5),
(7, 'test2', '84f3773a2f6d75b4f2318d4ec8c826b311ab69679f2e4aafc1e8e74593e5a734ae60248895b4891e75584e35b40d1e1eace5f284cc18bdb826b0cb43d0cfca4b', 6);

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
  ADD PRIMARY KEY (`ID_Additional_data`),
  ADD KEY `ID_Country` (`ID_Country`);

--
-- Indeksy dla tabeli `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`ID_Country`);

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
-- Indeksy dla tabeli `game_rating`
--
ALTER TABLE `game_rating`
  ADD PRIMARY KEY (`ID_Game_rating`),
  ADD KEY `ID_Game` (`ID_Game`),
  ADD KEY `ID_User` (`ID_User`);

--
-- Indeksy dla tabeli `game_tags`
--
ALTER TABLE `game_tags`
  ADD PRIMARY KEY (`ID_Game_tags`),
  ADD KEY `ID_Game` (`ID_Game`),
  ADD KEY `ID_Tag` (`ID_Tag`);

--
-- Indeksy dla tabeli `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`ID_Order`),
  ADD KEY `ID_Transaction` (`ID_Transaction`);

--
-- Indeksy dla tabeli `payment_method`
--
ALTER TABLE `payment_method`
  ADD PRIMARY KEY (`ID_Payment_method`);

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
  ADD PRIMARY KEY (`ID_Transaction`),
  ADD KEY `ID_Game` (`ID_Game`),
  ADD KEY `ID_User` (`ID_User`),
  ADD KEY `ID_Discount_code` (`ID_Discount_code`);

--
-- Indeksy dla tabeli `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`ID_Type`);

--
-- Indeksy dla tabeli `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID_User`),
  ADD KEY `ID_Additional_data` (`ID_Additional_data`);

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
  MODIFY `ID_Additional_data` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT dla tabeli `countries`
--
ALTER TABLE `countries`
  MODIFY `ID_Country` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT dla tabeli `discount_code`
--
ALTER TABLE `discount_code`
  MODIFY `ID_Discount_code` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `game`
--
ALTER TABLE `game`
  MODIFY `ID_Game` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT dla tabeli `game_rating`
--
ALTER TABLE `game_rating`
  MODIFY `ID_Game_rating` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT dla tabeli `game_tags`
--
ALTER TABLE `game_tags`
  MODIFY `ID_Game_tags` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `orders`
--
ALTER TABLE `orders`
  MODIFY `ID_Order` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `payment_method`
--
ALTER TABLE `payment_method`
  MODIFY `ID_Payment_method` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
  MODIFY `ID_Transaction` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `type`
--
ALTER TABLE `type`
  MODIFY `ID_Type` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT dla tabeli `user`
--
ALTER TABLE `user`
  MODIFY `ID_User` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT dla tabeli `version`
--
ALTER TABLE `version`
  MODIFY `ID_Version` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `additional_data`
--
ALTER TABLE `additional_data`
  ADD CONSTRAINT `additional_data_ibfk_1` FOREIGN KEY (`ID_Country`) REFERENCES `countries` (`ID_Country`);

--
-- Ograniczenia dla tabeli `game`
--
ALTER TABLE `game`
  ADD CONSTRAINT `game_ibfk_1` FOREIGN KEY (`ID_Platform`) REFERENCES `platform` (`ID_Platform`),
  ADD CONSTRAINT `game_ibfk_2` FOREIGN KEY (`ID_Type`) REFERENCES `type` (`ID_Type`),
  ADD CONSTRAINT `game_ibfk_3` FOREIGN KEY (`ID_Version`) REFERENCES `version` (`ID_Version`);

--
-- Ograniczenia dla tabeli `game_rating`
--
ALTER TABLE `game_rating`
  ADD CONSTRAINT `game_rating_ibfk_1` FOREIGN KEY (`ID_Game`) REFERENCES `game` (`ID_Game`),
  ADD CONSTRAINT `game_rating_ibfk_2` FOREIGN KEY (`ID_User`) REFERENCES `user` (`ID_User`);

--
-- Ograniczenia dla tabeli `game_tags`
--
ALTER TABLE `game_tags`
  ADD CONSTRAINT `game_tags_ibfk_1` FOREIGN KEY (`ID_Game`) REFERENCES `game` (`ID_Game`),
  ADD CONSTRAINT `game_tags_ibfk_2` FOREIGN KEY (`ID_Tag`) REFERENCES `tag` (`ID_Tag`);

--
-- Ograniczenia dla tabeli `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`ID_Transaction`) REFERENCES `transaction` (`ID_Transaction`);

--
-- Ograniczenia dla tabeli `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`ID_Game`) REFERENCES `game` (`ID_Game`),
  ADD CONSTRAINT `transaction_ibfk_2` FOREIGN KEY (`ID_User`) REFERENCES `user` (`ID_User`),
  ADD CONSTRAINT `transaction_ibfk_3` FOREIGN KEY (`ID_Discount_code`) REFERENCES `discount_code` (`ID_Discount_code`);

--
-- Ograniczenia dla tabeli `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`ID_Additional_data`) REFERENCES `additional_data` (`ID_Additional_data`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
