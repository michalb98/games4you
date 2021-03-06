-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 03 Wrz 2021, 23:37
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
(1, 30, 'Michał', 'Błaszczyk', '99-300', 'Kutno', 'Łokietka', '6', '60', 'darx12311@gmail.com');

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

--
-- Zrzut danych tabeli `discount_code`
--

INSERT INTO `discount_code` (`ID_Discount_code`, `Code`, `Valid_from`, `Valid_to`, `Value`) VALUES
(6, '14ec40cac8f4db45f8ad91445811a3c5', '2021-08-26', '2021-11-26', 159.99),
(7, '2086e69a8e14609742fec3a6fc154ae1', '2021-08-31', '2021-12-01', 89.99),
(8, 'c2f9dc7a1ac27b4f40f8f7ffb643fc38', '2021-08-31', '2021-12-01', 249.99),
(9, 'a97b5f6681c038c6d64d2d46c2dc1334', '2021-08-31', '2021-12-01', 99.99);

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
(1, 'Days Gone', 130.07, 159.99, 'Jedź i walcz w zabójczej, postpandemicznej Ameryce. W tej przygodowej grze akcji z otwartym światem zagrasz jako Deacon St. John, walczący o przetrwanie włóczęga i łowca nagród, przemierzający zniszczoną drogę w poszukiwaniu powodów, by dalej żyć.', 'Days Gone  to klasyczna przygodowa gra akcji, w której kamera znajduje się stale za plecami głównego bohatera. Podczas rozgrywki eksplorujemy obszerną sandboksową mapę, wykonujemy zadania (główne i poboczne – np. czyszczenie obozów z bandytów czy polowanie na zwierzęta) i walczymy z wrogami – zarówno ludźmi, jak i z rozmaitymi rodzajami groźnych ofiar wirusa. Te ostatnie często poruszają się w hordach liczących nawet kilkaset osobników, a do tego posiadają własne potrzeby i regulujący ich zachowanie cykl dobowy. Ciekawym detalem urozmaicającym zabawę jest częściowa interaktywność otoczenia – mamy możliwość m.in. popychania przeciwników na obiekty lub przecinania lin podtrzymujących ścięte drzewa. Twórcy położyli też duży nacisk na taktykę i planowanie – szczególnie w przypadku starć z ludzkimi wrogami. Walczymy, korzystając z rozbudowanego arsenału, m.in. karabinów maszynowych, shotgunów czy snajperek. Deacon dysponuje również kilkoma specjalnymi umiejętnościami, takimi jak np. spowalnianie czasu w trakcie walki (klasyczny bullet time) czy tzw. survival vision, umożliwiające podkreślanie ważnych przedmiotów i przeciwników, dzięki czemu łatwiej jest dostrzec, co i kto nas otacza – i gdzie mogą kryć się potencjalne zagrożenia. W miarę postępów w rozgrywce bohater może uczyć się nowych rzeczy i stopniowo rozwijać statystyki (takie jak życie czy wytrzymałość). Gra posiada rozbudowany, ale relatywnie prosty w obsłudze system rzemiosła, na potrzeby którego zbieramy duże ilości przeróżnych materiałów. Duże znaczenie dla rozgrywki ma także motocykl, którym poruszamy się po mapie. Mamy możliwość dostosowywania jego wyglądu, parametrów technicznych (np. poprzez zmianę opon czy silnika), a także zdobywania innych usprawnień, takich jak torby umożliwiające przewożenie większej liczby przedmiotów. Co ciekawe, nasz stalowy rumak wymaga benzyny, o której zapas trzeba się zatroszczyć, jeśli nie chcemy utknąć na niebezpiecznym pustkowiu.', 6, 2, 1, 1),
(2, 'Phasmophobia', 40.64, 49.99, 'Phasmophobia jest nietypowym survival horrorem, który został opracowany z myślą o 4-osobowym trybie kooperacyjnym. Tytuł oferuje też wsparcie dla wirtualnej rzeczywistości. Za jego opracowane i wydanie odpowiada niezależne studio Kinetic.', 'W Phasmophobia akcję obserwujemy z perspektywy pierwszoosobowej. Zabawa polega na eksplorowaniu nawiedzonych miejsc i zbieraniu dowodów na istnienie duchów. Wykorzystujemy do tego celu specjalny sprzęt, taki jak mierniki pola elektromagnetycznego, kamery CTTV czy detektory ruchu (częścią sprzętu zarządzamy z ciężarówki będącej naszą bazą – odpowiada za to jeden z członków zespołu). Warto odnotować, że czym dłużej znajdujemy się w danej lokalizacji (deweloperzy przygotowali kilka odmiennych miejsc – mamy do wyboru posiadłość, więzienie, farmę, szkołę czy szpital), tym bardziej niebezpieczna się ona staje. W grze można znaleźć przeszło dziesięć unikatowych typów duchów – każdy z nich posiada wyjątkowe cechy, dzięki czemu kolejne dochodzenia zauważalnie różnią się od siebie. Co ciekawe, gra wykorzystuje też funkcję wykrywania mowy, dzięki której czasem możemy wchodzić w interakcje z duchami używając swojego własnego głosu.', 1, 7, 1, 1),
(30, 'The Sims 4', 81.29, 99.99, 'Poczuj moc tworzenia i kontrolowania własnych postaci w wirtualnym świecie, w którym nie ma ograniczeń. Doświadczaj wolności w zabawie, rządź i pogrywaj z życiem!', '\"Puść wodze wyobraźni i stwórz wyjątkowy świat Simów. Odkrywaj bogactwo opcji i dostosowuj najdrobniejsze szczegóły dotyczące Simów, ich domów i nie tylko. Wybierz wygląd, zachowanie i ubiór Simów. Określ, jak będą spędzać codzienne życie. Projektuj i buduj wyjątkowe domy dla każdej z rodzin, a potem wyposażaj je, dodając ulubione meble i dekoracje. Odwiedzaj różnorodne otoczenia, w których możesz poznawać innych Simów i ich historie. Odkrywaj piękne lokacje z niepowtarzalnym klimatem i funduj Simom spontaniczne przygody. Przeżywaj razem z nimi radości i smutki codzienności i rozgrywaj realistyczne lub kompletnie zakręcone scenariusze. Opowiadaj historie Simów tak, jak chcesz, buduj ich związki, rozwijaj kariery, wypełniaj życiowe aspiracje i zanurz się w świecie tej wyjątkowej gry, w której możliwości są naprawdę nieograniczone.', 1, 11, 1, 2),
(31, 'Grand Theft Auto V', 97.55, 119.99, 'GRAND THEFT AUTO V na PC pozwala graczom zobaczyć ogromny świat Los Santos i hrabstwa Blaine w rozdzielczości sięgającej 4K i lepszej oraz w 60 klatkach na sekundę.', '<p>Gdy młody opryszek, emerytowany rabuś oraz przerażający psychol wplątują się w gangsterskie porachunki i interesy świata zbrodni, rządu USA i przemysłu rozrywkowego, muszą wykonać serię niebezpiecznych napad&oacute;w, aby przetrwać w bezlitosnym świecie, w kt&oacute;rym zdrada czyha na każdym kroku.<br /><br />Grand Theft Auto V na PC pozwala graczom zobaczyć ogromny świat Los Santos i hrabstwa Blaine w rozdzielczości sięgającej 4K i lepszej oraz w 60 klatkach na sekundę.<br /><br />GTA V na PC zapewnia graczom wiele możliwości dostosowania gry do posiadanego komputera, m.in. 25 r&oacute;żnych ustawień jakości tekstur, cieniowania, teselacji czy antyaliasingu, a także zaawansowaną obsługę sterowania myszą i klawiaturą. Dodatkowo wprowadzono suwak gęstości zaludnienia, kt&oacute;ry reguluje natężenie ruchu ulicznego i pieszych, a także obsługę kontroler&oacute;w bez potrzeby instalowania dodatkowych sterownik&oacute;w, konfiguracji z dwoma bądź trzema monitorami i wyświetlania w trybie tr&oacute;jwymiarowym.<br /><br />Grand Theft Auto V na PC zawiera także Grand Theft Auto Online, kt&oacute;re zapewnia rozgrywkę dla 30 graczy i dodatkowo 2 widz&oacute;w jednocześnie. Wraz z Grand Theft Auto Online na PC natychmiastowo dostępne są wszystkie usprawnienia rozgrywki i dodatki stworzone od premiery Grand Theft Auto Online, w tym Napady oraz tryby Adwersarz.<br /><br />Grand Theft Auto V i Grand Theft Auto Online na PC zawierać będą r&oacute;wnież tryb pierwszej osoby, kt&oacute;ry pozwoli graczom zobaczyć niezwykle dopracowany świat Los Santos i Blaine County z zupełnie nowej perspektywy.<br /><br />Wraz z Grand Theft Auto V na PC dostępny jest r&oacute;wnież edytor Rockstar, potężne narzędzie, kt&oacute;re pozwala graczom spojrzeć na Grand Theft Auto V i Grand Theft Auto Online z zupełnie nowej perspektywy. Tryb reżyserski umożliwia graczom inscenizowanie własnych historii z wykorzystaniem postaci znanych z trybu fabularnego, pieszych, a nawet zwierząt. Opr&oacute;cz zaawansowanych funkcji kamery i montażu, w tym przyspieszenia/spowolnienia oraz zestawu filtr&oacute;w, gracze mogą także korzystać z utwor&oacute;w pojawiających się w stacjach radiowych GTA V oraz kontrolować dynamikę podkładu muzycznego. Ukończone filmy można udostępniać z edytora Rockstar bezpośrednio na YouTube bądź w Social Club.<br /><br />Znani ze ścieżki dźwiękowej do gry The Alchemist and Oh No wracają jako gospodarze nowej stacji radiowej The Lab FM. Usłyszeć w niej będzie można nowe, ekskluzywne utwory prosto od tego utalentowanego duetu. Wśr&oacute;d artyst&oacute;w, kt&oacute;rzy także wzięli udział w nagraniach, są m.in. Earl Sweatshirt, Freddie Gibbs, Little Dragon, Killer Mike i Sam Herring z Future Islands. Gracze mogą r&oacute;wnież odkrywać Los Santos i hrabstwo Blaine, słuchając wybranej przez siebie muzyki za pomocą Własnego radia, nowej stacji radiowej, do kt&oacute;rej każdy może dodać swoje ulubione utwory.<br /><br />Dostęp do zawartości specjalnej wymaga założenia konta Rockstar Games Social Club. Więcej informacji na&nbsp;<a href=\"https://support.rockstargames.com/articles/203495713/Exclusive-PS4-Xbox-One-and-PC-Content-for-Returning-Players-in-Grand-Theft-Auto-V\" target=\"_blank\" rel=\"noopener\">http://rockstargames.com/v/bonuscontent</a>.</p>', 1, 1, 1, 7),
(32, 'Forza Horizon 4', 162.59, 199.99, 'Dynamiczne pory roku całkowicie zmienią największy motoryzacyjny festiwal świata. Weź w niej udział samodzielnie lub stwórz drużynę wraz z innymi graczami.', 'Dynamiczne pory roku całkowicie zmienią największy motoryzacyjny festiwal świata. Weź w niej udział samodzielnie lub stwórz drużynę wraz z innymi graczami. Podziwiaj historyczne zakątki Brytanii, przemierzając wspólny otwarty świat w jednym z 450 różnych modeli samochodów do zebrania i zmodyfikowania. Wyścigi, popisy kaskaderskie, budowanie i eksploracja – wybierz swoją specjalność i zostań supergwiazdą Horizon.', 2, 5, 1, 1),
(37, 'Wiedźmin 3 Dziki Gon', 81.29, 99.99, 'Wejdź w rolę profesjonalnego zab&oacute;jcy potwor&oacute;w, Geralta z Rivii. Przemierzaj ogarnięte wojną Kr&oacute;lestwa P&oacute;łnocy idąc śladami Ciri, dziewczyny z prastarej przepowiedni, kt&oacute;rej magiczny talent może zniszczyć świat.', '<p>Wiedźmin: Dziki Gon to osadzona w olśniewającym uniwersum fantasy gra RPG nowej generacji, w kt&oacute;rej nacisk położono na otwarty świat, bogatą fabułę, trudne wybory i rzeczywiste konsekwencje. W grze wcielasz się w Geralta z Rivii &mdash; zawodowego łowcę potwor&oacute;w, kt&oacute;remu powierzono zadanie odszukania dziecka z prastarej przepowiedni. Czeka na ciebie ogromny, otwarty świat pełen kupieckich miast, wysp pirat&oacute;w, niebezpiecznych g&oacute;rskich przełęczy i zapomnianych jaskiń.</p>\r\n<h2>GŁ&Oacute;WNE CECHY GRY</h2>\r\n<p><strong>GRAJ JAKO DOSKONALE WYSZKOLONY ŁOWCA POTWOR&Oacute;W</strong><br />Wiedźmini &mdash; od wczesnego dzieciństwa poddawani mutacjom i rygorystycznym treningom &mdash; cechują się nadludzkimi zdolnościami, siłą oraz refleksem. Choć nie cieszą się zaufaniem społeczeństwa, stanowią jedyną przeciwwagę dla mnogości gnębiących świat potwor&oacute;w.<br /><br /></p>\r\n<ul>\r\n<li>Siej postrach wśr&oacute;d wrog&oacute;w jako zawodowy łowca potwor&oacute;w uzbrojony w szereg broni, kt&oacute;re możesz ulepszać, oraz eliksiry mutagenne i magię bojową.</li>\r\n<li>Poluj na r&oacute;żnorodne niespotykane stwory &mdash; od dzikich bestii grasujących na g&oacute;rskich przełęczach po magiczne drapieżniki czające się w zaułkach gęsto zaludnionych miast.</li>\r\n<li>Zapłatę wykorzystuj na ulepszanie uzbrojenia i pancerza lub wydawaj na zakłady w wyścigach konnych, grę w karty, pojedynki na pięści i inne nocne rozrywki.</li>\r\n</ul>\r\n<p><img style=\"display: block; margin-left: auto; margin-right: auto;\" src=\"https://cdn.cloudflare.steamstatic.com/steam/apps/292030/extras/W3_1.gif?t=1621939214\" /><br /><br /><strong>WKROCZ DO OTWARTEGO, MROCZNEGO ŚWIATA FANTASY</strong><br />Olbrzymi, otwarty świat Wiedźmina, stworzony z myślą o niekończących się przygodach, wyznacza nowe standardy w zakresie rozmiaru, głębi i złożoności.<br /><br /></p>\r\n<ul>\r\n<li>Podr&oacute;żuj przez fantastyczny otwarty świat: badaj zapomniane ruiny, jaskinie i wraki okręt&oacute;w; odwiedzaj miasta, by handlować z kupcami oraz krasnoludzkimi kowalami; poluj na wielkich r&oacute;wninach, w g&oacute;rach i na morzu.</li>\r\n<li>Utrzymuj kontakty ze zdradzieckimi generałami, przebiegłymi wiedźmami i zepsutymi członkami rodzin kr&oacute;lewskich, by otrzymywać zlecenia na swe mroczne usługi.</li>\r\n<li>Dokonuj wybor&oacute;w wykraczających poza prosty podział na dobro i zło, a następnie mierz się z daleko idącymi konsekwencjami.</li>\r\n</ul>\r\n<p><img style=\"display: block; margin-left: auto; margin-right: auto;\" src=\"https://cdn.cloudflare.steamstatic.com/steam/apps/292030/extras/W3_3.gif?t=1621939214\" /><br /><br /><strong>PODĄŻAJ TROPEM DZIECKA Z PRZEPOWIEDNI</strong><br />Przyjmij najważniejsze w życiu zlecenie i spr&oacute;buj odnaleźć dziecko z przepowiedni, kt&oacute;re może uratować świat lub pogrążyć go w ruinie.<br /><br /></p>\r\n<ul>\r\n<li>Przemierzaj ogarnięty wojną świat tropem żywej broni, dziecka ze starożytnej elfiej legendy.</li>\r\n<li>Stań do nier&oacute;wnej walki z okrutnymi władcami, duchami dziczy, a nawet grozą z innego wymiaru.</li>\r\n<li>Wybierz własną drogę w świecie, kt&oacute;ry być może nie zasługuje na ratunek.</li>\r\n</ul>\r\n<p><img style=\"display: block; margin-left: auto; margin-right: auto;\" src=\"https://cdn.cloudflare.steamstatic.com/steam/apps/292030/extras/W3_2.gif?t=1621939214\" /><br /><br /><strong>PEŁNE WYKORZYSTANIE POTENCJAŁU SYSTEM&Oacute;W NOWEJ GENERACJI</strong></p>\r\n<ul>\r\n<li>Zaprojektowany wyłącznie z myślą o systemach nowej generacji silnik REDengine 3 budzi do życia wielobarwny, szczeg&oacute;łowy i naturalnie wyglądający świat fantasy.</li>\r\n<li>Dynamiczne zmiany pogody oraz cykl dnia i nocy wpływają na zachowanie mieszkańc&oacute;w miast i potwor&oacute;w w dziczy.</li>\r\n<li>Zar&oacute;wno wątek gł&oacute;wny, jak i poboczne przygody postawią przed tobą wiele trudnych wybor&oacute;w &ndash; będziesz mieć większy wpływ na otoczenie, niż kiedykolwiek przedtem.</li>\r\n</ul>\r\n<p><img style=\"display: block; margin-left: auto; margin-right: auto;\" src=\"https://cdn.cloudflare.steamstatic.com/steam/apps/292030/extras/W3_4.gif?t=1621939214\" /></p>', 2, 10, 1, 4),
(38, 'Cyberpunk 2077', 162.59, 199.99, 'Cyberpunk 2077 to rozgrywająca się w otwartym świecie przygoda, kt&oacute;rej akcja toczy się w Night City, megalopolis rządzonym przez obsesyjną pogoń za władzą, sławą i przerabianiem własnego ciała. Nazywasz się V i musisz&nbsp;klucz.', '<p><img style=\"display: block; margin-left: auto; margin-right: auto;\" src=\"https://cdn.akamai.steamstatic.com/steam/apps/1091500/extras/01._About_the_Game_PL.png?t=1621944801\" /><br /><br />Cyberpunk 2077 to rozgrywająca się w otwartym świecie przygoda, kt&oacute;rej akcja toczy się w Night City, megalopolis rządzonym przez obsesyjną pogoń za władzą, sławą i przerabianiem własnego ciała. Nazywasz się V i musisz zdobyć jedyny w swoim rodzaju implant &mdash; klucz do nieśmiertelności. Stw&oacute;rz własny styl gry i ruszaj na podb&oacute;j potężnego miasta przyszłości, kt&oacute;rego historię kształtują twoje decyzje.<br /><br /><img style=\"display: block; margin-left: auto; margin-right: auto;\" src=\"https://cdn.akamai.steamstatic.com/steam/apps/1091500/extras/02._Mercenary_Outlaw_PL.png?t=1621944801\" /><br /><br />Zostań cyberpunkiem, uzbrojonym po zęby wolnym strzelcem, i stań się legendą najbardziej niebezpiecznego miasta przyszłości.<br /><br /><img style=\"display: block; margin-left: auto; margin-right: auto;\" src=\"https://cdn.akamai.steamstatic.com/steam/apps/1091500/extras/03._City_of_the_Future_PL.png?t=1621944801\" /><br /><br />Witaj w Night City &mdash; stworzonym z rozmachem mieście przyszłości, w kt&oacute;rym zatracisz się bez pamięci.<br /><br /><img style=\"display: block; margin-left: auto; margin-right: auto;\" src=\"https://cdn.akamai.steamstatic.com/steam/apps/1091500/extras/04._Eternal_Life_PL.png?t=1621944801\" /><br /><br />Zdobądź najpotężniejszy wszczep w Night City i zmierz się z tymi, kt&oacute;rzy trzęsą całym miastem.<br /><br /><img style=\"display: block; margin-left: auto; margin-right: auto;\" src=\"https://cdn.akamai.steamstatic.com/steam/apps/1091500/extras/05._Featuring_Keanu_Reeves_PL.png?t=1621944801\" /><br /><br /><img style=\"display: block; margin-left: auto; margin-right: auto;\" src=\"https://cdn.akamai.steamstatic.com/steam/apps/1091500/extras/Cyberpunk2077_UpdatedPreorderIncentive_PL.png?t=1621944801\" /><br /><br /><img style=\"display: block; margin-left: auto; margin-right: auto;\" src=\"https://cdn.akamai.steamstatic.com/steam/apps/1091500/extras/06._Social-Media_PL.png?t=1621944801\" /></p>', 1, 10, 1, 4),
(39, 'This War of Mine', 48.77, 59.99, 'W grze nie wcielasz się w elitarnego żołnierza. Stajesz na czele grupki cywilów, starających się przeżyć w oblężonym mieście, zmagając się z brakiem żywności, lekarstw i ciągłym zagrożeniem ze strony snajperów i szabrowników.', 'W This War of Mine nie wcielasz się w rolę elitarnego żołnierza, lecz w grupę cywilów, którzy starają się przetrwać w oblężonym mieście, zmagając się z brakiem żywności, lekarstw i ciągłym zagrożeniem ze strony snajperów oraz szabrowników. Gra dostarcza przeżyć wojennych ukazanych z zupełnie wyjątkowej perspektywy.\r\n\r\nTempo rozgrywki jest oparte na cyklu dobowym. W ciągu dnia snajperzy uniemożliwiają ci opuszczanie schronienia, więc skupiaj się wtedy na utrzymywaniu go w jak najlepszym stanie, tworzeniu przedmiotów, wymienianiu się nimi oraz zajmowaniu się ocalałymi. Z kolei w nocy zabieraj jednego ze swoich ludzi na przeszukiwanie różnorodnych miejsc, starając się znaleźć rzeczy, które pomogą ci przetrwać.\r\n\r\nPodejmuj decyzje w sprawach życia i śmierci, kierując się własnym sumieniem. Postaraj się, by przeżyli wszyscy z twojego schronienia, lub poświęć kogoś, by mogli przetrwać inni. Podczas wojny nie ma dobrych i złych wyborów – jest tylko przetrwanie. Im szybciej to zrozumiesz, tym lepiej.', 1, 4, 1, 1),
(40, 'Ghost of Tsushima', 243.89, 299.99, 'Odkrywaj piękno Tsushimy w tej osadzonej w otwartym świecie przygodowej grze akcji stworzonej przez Sucker Punch Productions i PlayStation Studios, dostępnej na PS5 i PS4.', 'Rok 1274. Na kontynencie azjatyckim praktycznie niepodzielnie rządzi imperium mongolskie. Jego władcy łakomym okiem spoglądają na bogactwa feudalnej Japonii. Chan Kubilaj decyduje się w końcu na dokonanie inwazji. Jej pierwszym celem jest położona dokładnie pośrodku Cieśniny Koreańskiej wyspa Cuszima. Podczas ataku wojska mongolskie masakrują większość samurajów mieszkających na wyspie. Głównemu bohaterowi gry – Jinowi Sakai – cudem udaje się przetrwać tragiczną w skutkach bitwę. Od tego momentu głównym celem protagonisty staje się powstrzymanie Mongołów. Jednak aby tego dokonać, będzie musiał zapomnieć o samurajskich tradycjach.', 2, 3, 4, 9),
(42, 'Gears 5', 81.29, 99.99, 'Piąta część popularnego cyklu TPS-ów, w której wcielamy się w znaną z Gears of War 4 Kait Diaz. Protagonistka wyrusza w podróż do odległego zakątka planety Sera, by rozwikłać zagadkę trapiących ją koszmarów.', 'Akcja Gears 5 toczy się po wydarzeniach przedstawionych w czwartej części serii. W roli głównej obsadzono Kait Diaz, która w towarzystwie Delmonta Walkera udaje się w długą podróż przez malownicze, ale i pełne niebezpieczeństw zakątki planety Sera. Protagonistka zamierza dowiedzieć się więcej na temat pochodzenia Szarańczy (ang. Locust) i odkryć źródło trapiących ją koszmarów, w których, jak wierzy, kryje się jakaś wiadomość. Jedną z głównych osi fabularnych jest również uruchomienie Młota Świtu, czyli potężnej broni energetycznej atakującej z orbity.', 1, 2, 2, 8),
(43, 'Resident Evil Village', 203.24, 249.99, 'Oto survival horror, jakiego jeszcze nie było — ósma odsłona legendarnej serii Resident Evil. Realistyczna grafika, pierwszoosobowa akcja i mistrzowska fabuła sprawią, że poczucie zagrożenia będzie rzeczywiste jak nigdy.', 'Rok 1274. Na kontynencie azjatyckim praktycznie niepodzielnie rządzi imperium mongolskie. Jego władcy łakomym okiem spoglądają na bogactwa feudalnej Japonii. Chan Kubilaj decyduje się w końcu na dokonanie inwazji. Jej pierwszym celem jest położona dokładnie pośrodku Cieśniny Koreańskiej wyspa Cuszima. Podczas ataku wojska mongolskie masakrują większość samurajów mieszkających na wyspie. Głównemu bohaterowi gry – Jinowi Sakai – cudem udaje się przetrwać tragiczną w skutkach bitwę. Od tego momentu głównym celem protagonisty staje się powstrzymanie Mongołów. Jednak aby tego dokonać, będzie musiał zapomnieć o samurajskich tradycjach.', 0, 7, 1, 1),
(45, 'Car Mechanic Simulator 2021', 73.16, 89.99, 'Wspinaj się po drabinie kariery jako mechanik samochodowy. To realistyczny symulator mechanika samochodowego. Naprawiaj auta klientów, kupuj własne auta, naprawiaj je, sprzedawaj albo dodaj do swojej kolekcji!', '<p><strong>Car Mechanic Simulator 2021</strong> to produkcja o dobrze ugruntowanej bazie graczy. Rozpocznij jako nowy właściciel garażu I rozwijaj swoje serwisowe imperium. Ubrudź sobie ręce w pełnej detali, realistycznej symulacji. Przygotuj się na ponad 4000 unikatowych części i ponad 72 samochody. Podwijaj rękawy i zanurz się w realistycznej przestrzeni swojego garażu. <br /><br />Inwestuj w nowy sprzęt i rozwijaj swoją przestrzeń aby rozszerzać działalność swojego serwisu. Naprawiaj, serwisuj, testuj, lakieruj, tuninguj i odnawiaj samochody. Odwiedź aukcje samochodowe i przeglądaj pojazdy w r&oacute;żnorodnej kondycji. Jeżeli czujesz, że to Tw&oacute;j szczęśliwy dzień, odwiedź stodoły. Niekt&oacute;re z nich kryją nie lada skarby &ndash; trzeba je tylko odnaleźć.</p>', 9, 11, 1, 1),
(50, 'Assassin&#39;s Creed Odyssey', 203.24, 249.99, 'Weź los we własne ręce w Assassin&#39;s Creed Odyssey. Od wyrzutka aż po żywą legendę, wyrusz w podróż, która odkryje przed tobą tajemnice twojej przeszłości i odmieni losy starożytnej Grecji.', 'Weź los we własne ręce w Assassin&#39;s Creed® Odyssey.\r\nOd wyrzutka aż po żywą legendę, wyrusz w podróż, która odkryje przed tobą tajemnice twojej przeszłości i odmieni losy starożytnej Grecji.\r\n\r\nWYRUSZ DO STAROŻYTNEJ GRECJI\r\nOd gęstych i bujnych lasów, po wulkaniczne wyspy i zatłoczone miasta, wyrusz w pełną odkryć i potyczek podróż przez rozdarty wojną świat, stworzony przez bogów i ludzi.\r\n\r\nZAPISZ WŁASNĄ LEGENDĘ\r\nTwoje decyzje będą wpływały na przebieg odysei. Zobacz szereg możliwych zakończeń dzięki zupełnie nowemu systemowi dialogów i mechanice dokonywania wyborów. Dobieraj wyposażenie, ulepszaj statek i rozwijaj specjalne umiejętności, by stać się legendą.\r\n\r\nWALCZ NA NIESPOTYKANĄ DOTĄD SKALĘ\r\nPokaż, jaki z ciebie wojownik, biorąc udział w wielkich bitwach pomiędzy Spartą i Atenami u boku setek innych żołnierzy lub taranuj i przebijaj się przez całe floty w bitwach morskich, toczonych na całym Morzu Egejskim.\r\n\r\nONIEMIEJESZ Z WRAŻENIA\r\nZyskaj zupełnie nowe spojrzenie na przygodę dzięki Tobii Eye Tracking. Funkcja rozszerzonego widoku zapewnia szerszą perspektywę, a efekty dynamicznego oświetlenia i słońca pozwalają zatracić się w piaszczystych wydmach zgodnie z miejscem, na które patrzysz. Oznaczanie, celowanie i blokowanie celów staje się o wiele bardziej naturalne, kiedy można zrobić to samym spojrzeniem. Pozwól, by oczy zaprowadziły Cię do celu i wzbogaciły rozgrywkę.\r\nOdwiedź stronę internetową Tobii, by sprawdzić listę kompatybilnych urządzeń.', 5, 1, 1, 3),
(51, 'Life is Strange', 58.53, 71.99, 'Główną bohaterką jest osiemnastoletnia Max Caulfield, która po latach powraca do rodzinnego miasteczka Arcadia Bay w Oregonie.Hej', 'Fabuła Life is Strange przenosi nas do fikcyjnego amerykańskiego miasteczka Arcadia Bay w stanie Oregon. Po 5 latach przybywa do niego Max Caulfield, wkraczająca w dorosłość główna bohaterka gry, która wróciła w rodzinne strony, by rozpocząć naukę w Blackwell Academy, prestiżowej szkole wyższej dla pasjonatów fotografii. Na miejscu spotyka się ponownie ze swoją dawną przyjaciółką, Chloe Price. Razem z nią stara się rozwiązać zagadkę tajemniczego zaginięcia innej studentki Blackwell – Rachel Amber. Już na samym początku przygody Max odkrywa, że posiada moc manipulowania czasem, co jest jedynie początkiem dziwnych, niewytłumaczalnych zdarzeń i wydaje się w jakiś sposób powiązane z nękającymi ją wizjami gigantycznego tornada uderzającego w miasto.', 4, 6, 1, 1),
(52, 'Outlast 2', 87.80, 107.99, 'W Outlast 2 poznajesz Sullivan Knoth i jego zwolenników, którzy pozostawili nasz podły świat, aby stworzyć Temple Gate, miasto na odludziu daleko od cywilizacji.', 'W Outlast 2 poznajesz Sullivan Knoth i jego zwolenników, którzy pozostawili nasz podły świat, aby stworzyć Temple Gate, miasto na odludziu daleko od cywilizacji. Knoth i jego świta przygotowują się do utrapień końca czasów, a ty jesteś w samym środku tych przygotowań.\r\n\r\nWcielasz się w postać Blake\'a Langermanna, kamerzysty pracującego z twoją żoną Lynn. Jesteście dziennikarzami śledczymi, którzy pragną zaryzykować i wnikliwie szukać, by odkrywać historie, których inni nie ośmieliliby się dotknąć.\r\n\r\nIdziesz tropem wskazówek, które zaczynają się pozornie niemożliwym morderstwem ciężarnej kobiety znanej tylko jako Jane Doe.\r\n\r\nŚledztwo doprowadziło cię daleko do pustyni Arizony, do takiej ciemności, że nikt nie byłby w stanie jej rozjaśnić, i do tak głębokiego zafałszowania, że jedynym zdrowym wyjściem wydaje się tylko szaleństwo.', 3, 7, 1, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `game_key`
--

CREATE TABLE `game_key` (
  `ID_Game_key` int(9) NOT NULL,
  `ID_Game` int(6) NOT NULL,
  `Game_key` varchar(200) COLLATE utf8_polish_ci NOT NULL,
  `Key_bought` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `game_key`
--

INSERT INTO `game_key` (`ID_Game_key`, `ID_Game`, `Game_key`, `Key_bought`) VALUES
(1, 38, 'RTAMT-DTC65-8EA6B', 1),
(2, 1, 'RTAMT-DTC65-8EA6C', 0),
(3, 2, 'ATAMT-DTC65-8EA6B', 0),
(4, 31, 'ATAMT-DTC65-8EA6D', 0),
(5, 37, 'RTAMT-DTC65-8EA6W', 0),
(6, 39, 'RTAMT-DTC65-8EA6B', 0),
(7, 32, 'FHAMT-DTC65-8EA6W', 0),
(8, 43, 'REAMT-DTC65-8EA6D', 1),
(9, 30, 'TSAMT-DTC65-8EA6D', 0),
(10, 38, 'IPCZ6-E7DSQ-0GKS5', 1),
(11, 38, 'DPYNO-7GLZF-7E747', 0),
(12, 1, 'INW2T-5JR2L-3LVR7', 0),
(13, 1, 'JEVBZ-JTIGC-YXTCS', 0),
(14, 32, 'G7MZU-G6O8D-N3JIF', 0),
(15, 42, 'YUU00-XPJ5I-ZU5PF', 1),
(16, 42, 'J5RF1-JZ3J6-VAYQ8', 0),
(17, 40, 'RJN5X-5J374-TMFN8', 0),
(18, 40, 'GT4TS-DQDZH-SM3DG', 0),
(19, 1, 'LMT45-ODI73-34582', 0),
(20, 45, '99CKR-HTA71-84MIR', 1),
(21, 45, '69QDN-T57FG-I9ESK', 0),
(22, 45, '43TJN-8RS8I-CANO5', 0),
(23, 45, '2PR7F-7RGL6-N9QP2', 0),
(24, 45, '31BCQ-BQ45F-IA8L6', 0),
(45, 50, 'I5ELK-9D546-C6PG7', 0),
(46, 50, '88H22-C5F49-DIQS8', 0),
(47, 50, 'TRH31-RE216-53S68', 0),
(48, 50, 'NNGBM-J9TH3-P7F27', 0),
(49, 50, 'D2Q2H-P2P1Q-O8E16', 0),
(50, 45, '21J36-7SDAB-PSARM', 0),
(51, 45, '73T3J-6PMPT-6L1SQ', 0),
(53, 45, '61QQP-6J5HJ-J7K44', 0),
(54, 45, 'EMQNG-1N35O-3DJ3H', 0),
(55, 45, 'JDKSA-74P8F-DJ85P', 0),
(56, 1, 'KAIM3-5798C-NQ8S4', 0),
(57, 1, 'JB25H-LFBQF-BCO5S', 0),
(58, 51, '73B8F-GT8KH-43DO7', 0),
(59, 51, '286Q3-1F2D2-76639', 0),
(60, 51, 'TGJM7-633CF-RMC7P', 0),
(61, 51, 'C56JK-895QM-46526', 0),
(62, 52, '6H7H4-475MC-P75OR', 0),
(63, 52, 'CLG77-5N5S9-7SGFA', 0),
(64, 52, '64B3J-4I8L3-QPHL6', 0),
(65, 37, '4257R-Q93BN-ET5E7', 0),
(66, 37, '5196R-G9M85-JHDC9', 0);

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
(14, 38, 1, 5),
(18, 42, 1, 1),
(19, 37, 1, 5);

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
-- Struktura tabeli dla tabeli `issue`
--

CREATE TABLE `issue` (
  `ID_Issue` int(2) NOT NULL,
  `Issue` varchar(250) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `issue`
--

INSERT INTO `issue` (`ID_Issue`, `Issue`) VALUES
(1, 'Problem z produktem'),
(2, 'Problem ze zwrotem'),
(3, 'Problem z kontem'),
(5, 'Błąd na stronie'),
(6, 'Kod rabatowy'),
(7, 'Pytanie'),
(8, 'Inny problem');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `notices`
--

CREATE TABLE `notices` (
  `ID_Notices` int(9) NOT NULL,
  `ID_User` int(7) NOT NULL,
  `ID_Issue` int(2) NOT NULL,
  `Notice` varchar(2000) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `notices`
--

INSERT INTO `notices` (`ID_Notices`, `ID_User`, `ID_Issue`, `Notice`) VALUES
(3, 1, 2, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris non ex non massa placerat molestie sit amet a nisl. Nulla ac nisl sit amet dolor euismod vulputate. Quisque ullamcorper nisi eros, vel faucibus odio dapibus vitae. Vestibulum semper finibus rutrum. Quisque ac suscipit justo. Quisque sed felis et mauris tincidunt elementum. Integer quis turpis non eros feugiat porta. Pellentesque non nibh tortor. Sed in nisi id risus ornare dignissim. Praesent porttitor consectetur accumsan. Vestibulum ante eros, ullamcorper ac urna eu, aliquet euismod elit. Nam mauris urna, consectetur in ipsum id, bibendum ornare dui. Vestibulum rhoncus congue nisl, sit amet euismod nisi tincidunt quis. Praesent euismod dui sapien, euismod interdum neque dapibus nec.'),
(4, 1, 6, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris non ex non massa placerat molestie sit amet a nisl. Nulla ac nisl sit amet dolor euismod vulputate. Quisque ullamcorper nisi eros, vel faucibus odio dapibus vitae. Vestibulum semper finibus rutrum. Quisque ac suscipit justo. Quisque sed felis et mauris tincidunt elementum. Integer quis turpis non eros feugiat porta. Pellentesque non nibh tortor. Sed in nisi id risus ornare dignissim. Praesent porttitor consectetur accumsan. Vestibulum ante eros, ullamcorper ac urna eu, aliquet euismod elit. Nam mauris urna, consectetur in ipsum id, bibendum ornare dui. Vestibulum rhoncus congue nisl, sit amet euismod nisi tincidunt quis. Praesent euismod dui sapien, euismod interdum neque dapibus nec.');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `orders`
--

CREATE TABLE `orders` (
  `ID_Order` int(9) NOT NULL,
  `ID_Transaction` int(9) NOT NULL,
  `ID_Order_number` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `orders`
--

INSERT INTO `orders` (`ID_Order`, `ID_Transaction`, `ID_Order_number`) VALUES
(1, 1, 1),
(2, 2, 2),
(12, 12, 9),
(13, 13, 10),
(14, 14, 11),
(15, 15, 12),
(16, 16, 13),
(17, 17, 14),
(18, 18, 14),
(19, 19, 15),
(20, 20, 16),
(21, 21, 16);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `order_number`
--

CREATE TABLE `order_number` (
  `ID_Order_number` int(9) NOT NULL,
  `Order_number` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `ID_Discount_code` int(9) DEFAULT NULL,
  `Order_value` float NOT NULL,
  `Discount_value` float NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `order_number`
--

INSERT INTO `order_number` (`ID_Order_number`, `Order_number`, `ID_Discount_code`, `Order_value`, `Discount_value`) VALUES
(9, '202108241', NULL, 199.99, 0),
(10, '2021082610', NULL, 159.99, 0),
(11, '2021083111', NULL, 89.99, 0),
(12, '2021083112', NULL, 199.99, 0),
(13, '2021083113', NULL, 99.99, 0),
(14, '2021083114', NULL, 199.98, 0),
(15, '2021083115', NULL, 249.99, 0),
(16, '2021083116', NULL, 339.98, 0);

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
-- Struktura tabeli dla tabeli `rank`
--

CREATE TABLE `rank` (
  `ID_Rank` int(2) NOT NULL,
  `Rank` varchar(250) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `rank`
--

INSERT INTO `rank` (`ID_Rank`, `Rank`) VALUES
(1, 'Użytkownik'),
(2, 'Administrator');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `returns`
--

CREATE TABLE `returns` (
  `ID_Return` int(9) NOT NULL,
  `ID_Transaction` int(9) NOT NULL,
  `ID_Discount_code` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `returns`
--

INSERT INTO `returns` (`ID_Return`, `ID_Transaction`, `ID_Discount_code`) VALUES
(5, 13, 6),
(6, 14, 7),
(7, 19, 8),
(8, 18, 9);

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
  `ID_Game_key` int(9) DEFAULT NULL,
  `ID_User` int(7) NOT NULL,
  `ID_Payment_method` int(2) NOT NULL,
  `ID_Return` int(9) DEFAULT NULL,
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

INSERT INTO `transaction` (`ID_Transaction`, `ID_Game`, `ID_Game_key`, `ID_User`, `ID_Payment_method`, `ID_Return`, `ID_Discount_code`, `Price_netto`, `Price_brutto`, `Quantity`, `Data`, `Show_key`) VALUES
(12, 38, 1, 1, 1, NULL, NULL, 162.59, 199.99, 1, '2021-08-24', 1),
(13, 1, NULL, 1, 2, 5, 6, 130.07, 159.99, 1, '2021-08-26', 0),
(14, 45, NULL, 1, 4, 6, 7, 73.16, 89.99, 1, '2021-08-31', 0),
(15, 38, 10, 1, 1, NULL, NULL, 162.59, 199.99, 1, '2021-08-31', 1),
(16, 42, 15, 1, 3, NULL, NULL, 81.29, 99.99, 1, '2021-08-31', 1),
(17, 37, 5, 1, 2, NULL, NULL, 81.29, 99.99, 2, '2021-08-31', 1),
(18, 37, NULL, 1, 2, 8, 9, 81.29, 99.99, 2, '2021-08-31', 0),
(19, 50, NULL, 1, 2, 7, 8, 203.24, 249.99, 1, '2021-08-31', 0),
(20, 43, 8, 1, 1, NULL, NULL, 203.24, 249.99, 1, '2021-08-31', 0),
(21, 45, 20, 1, 1, NULL, NULL, 73.16, 89.99, 1, '2021-08-31', 0);

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
  `ID_Additional_data` int(7) DEFAULT NULL,
  `ID_Rank` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `user`
--

INSERT INTO `user` (`ID_User`, `Login`, `Password`, `ID_Additional_data`, `ID_Rank`) VALUES
(0, 'Użytkownik usunięty', '', NULL, 1),
(1, 'darx12311', '84f3773a2f6d75b4f2318d4ec8c826b311ab69679f2e4aafc1e8e74593e5a734ae60248895b4891e75584e35b40d1e1eace5f284cc18bdb826b0cb43d0cfca4b', 1, 2);

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
-- Indeksy dla tabeli `game_key`
--
ALTER TABLE `game_key`
  ADD PRIMARY KEY (`ID_Game_key`),
  ADD KEY `ID_Game` (`ID_Game`);

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
-- Indeksy dla tabeli `issue`
--
ALTER TABLE `issue`
  ADD PRIMARY KEY (`ID_Issue`);

--
-- Indeksy dla tabeli `notices`
--
ALTER TABLE `notices`
  ADD PRIMARY KEY (`ID_Notices`),
  ADD KEY `ID_Issue` (`ID_Issue`),
  ADD KEY `ID_User` (`ID_User`);

--
-- Indeksy dla tabeli `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`ID_Order`),
  ADD KEY `ID_Transaction` (`ID_Transaction`),
  ADD KEY `ID_Order_number` (`ID_Order_number`);

--
-- Indeksy dla tabeli `order_number`
--
ALTER TABLE `order_number`
  ADD PRIMARY KEY (`ID_Order_number`),
  ADD KEY `ID_Discount_code` (`ID_Discount_code`);

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
-- Indeksy dla tabeli `rank`
--
ALTER TABLE `rank`
  ADD PRIMARY KEY (`ID_Rank`);

--
-- Indeksy dla tabeli `returns`
--
ALTER TABLE `returns`
  ADD PRIMARY KEY (`ID_Return`),
  ADD KEY `ID_Discount_code` (`ID_Discount_code`),
  ADD KEY `ID_Transaction` (`ID_Transaction`);

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
  ADD KEY `ID_Discount_code` (`ID_Discount_code`),
  ADD KEY `ID_Game_key` (`ID_Game_key`),
  ADD KEY `ID_Return` (`ID_Return`),
  ADD KEY `ID_Payment_method` (`ID_Payment_method`);

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
  ADD KEY `ID_Additional_data` (`ID_Additional_data`),
  ADD KEY `ID_Rank` (`ID_Rank`);

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
  MODIFY `ID_Additional_data` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT dla tabeli `countries`
--
ALTER TABLE `countries`
  MODIFY `ID_Country` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT dla tabeli `discount_code`
--
ALTER TABLE `discount_code`
  MODIFY `ID_Discount_code` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT dla tabeli `game`
--
ALTER TABLE `game`
  MODIFY `ID_Game` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT dla tabeli `game_key`
--
ALTER TABLE `game_key`
  MODIFY `ID_Game_key` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT dla tabeli `game_rating`
--
ALTER TABLE `game_rating`
  MODIFY `ID_Game_rating` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT dla tabeli `game_tags`
--
ALTER TABLE `game_tags`
  MODIFY `ID_Game_tags` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `issue`
--
ALTER TABLE `issue`
  MODIFY `ID_Issue` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT dla tabeli `notices`
--
ALTER TABLE `notices`
  MODIFY `ID_Notices` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT dla tabeli `orders`
--
ALTER TABLE `orders`
  MODIFY `ID_Order` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT dla tabeli `order_number`
--
ALTER TABLE `order_number`
  MODIFY `ID_Order_number` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

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
-- AUTO_INCREMENT dla tabeli `rank`
--
ALTER TABLE `rank`
  MODIFY `ID_Rank` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `returns`
--
ALTER TABLE `returns`
  MODIFY `ID_Return` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT dla tabeli `tag`
--
ALTER TABLE `tag`
  MODIFY `ID_Tag` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT dla tabeli `transaction`
--
ALTER TABLE `transaction`
  MODIFY `ID_Transaction` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT dla tabeli `type`
--
ALTER TABLE `type`
  MODIFY `ID_Type` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT dla tabeli `user`
--
ALTER TABLE `user`
  MODIFY `ID_User` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

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
-- Ograniczenia dla tabeli `game_key`
--
ALTER TABLE `game_key`
  ADD CONSTRAINT `game_key_ibfk_1` FOREIGN KEY (`ID_Game`) REFERENCES `game` (`ID_Game`);

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
-- Ograniczenia dla tabeli `notices`
--
ALTER TABLE `notices`
  ADD CONSTRAINT `notices_ibfk_1` FOREIGN KEY (`ID_Issue`) REFERENCES `issue` (`ID_Issue`),
  ADD CONSTRAINT `notices_ibfk_2` FOREIGN KEY (`ID_User`) REFERENCES `user` (`ID_User`);

--
-- Ograniczenia dla tabeli `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`ID_Transaction`) REFERENCES `transaction` (`ID_Transaction`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`ID_Order_number`) REFERENCES `order_number` (`ID_Order_number`);

--
-- Ograniczenia dla tabeli `order_number`
--
ALTER TABLE `order_number`
  ADD CONSTRAINT `order_number_ibfk_1` FOREIGN KEY (`ID_Discount_code`) REFERENCES `discount_code` (`ID_Discount_code`);

--
-- Ograniczenia dla tabeli `returns`
--
ALTER TABLE `returns`
  ADD CONSTRAINT `returns_ibfk_1` FOREIGN KEY (`ID_Discount_code`) REFERENCES `discount_code` (`ID_Discount_code`),
  ADD CONSTRAINT `returns_ibfk_2` FOREIGN KEY (`ID_Transaction`) REFERENCES `transaction` (`ID_Transaction`);

--
-- Ograniczenia dla tabeli `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`ID_Game`) REFERENCES `game` (`ID_Game`),
  ADD CONSTRAINT `transaction_ibfk_2` FOREIGN KEY (`ID_User`) REFERENCES `user` (`ID_User`),
  ADD CONSTRAINT `transaction_ibfk_3` FOREIGN KEY (`ID_Discount_code`) REFERENCES `discount_code` (`ID_Discount_code`),
  ADD CONSTRAINT `transaction_ibfk_4` FOREIGN KEY (`ID_Game_key`) REFERENCES `game_key` (`ID_Game_key`),
  ADD CONSTRAINT `transaction_ibfk_5` FOREIGN KEY (`ID_Return`) REFERENCES `returns` (`ID_Return`),
  ADD CONSTRAINT `transaction_ibfk_6` FOREIGN KEY (`ID_Payment_method`) REFERENCES `payment_method` (`ID_Payment_method`);

--
-- Ograniczenia dla tabeli `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`ID_Additional_data`) REFERENCES `additional_data` (`ID_Additional_data`),
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`ID_Rank`) REFERENCES `rank` (`ID_Rank`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
