-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2021. Nov 30. 09:28
-- Kiszolgáló verziója: 10.4.21-MariaDB
-- PHP verzió: 7.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `yii2test`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `dw_basket`
--

CREATE TABLE `dw_basket` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) DEFAULT '',
  `price` int(11) DEFAULT NULL,
  `on_sale` tinytext DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `dw_basket`
--

INSERT INTO `dw_basket` (`id`, `name`, `price`, `on_sale`) VALUES
(1, 'Termék 1', 2000, '0'),
(2, 'Termék 2', 2500, '0');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `dw_news`
--

CREATE TABLE `dw_news` (
  `id` int(11) UNSIGNED NOT NULL,
  `label` varchar(100) DEFAULT '',
  `shortDescription` varchar(255) DEFAULT '',
  `description` longtext DEFAULT NULL,
  `listIMG` varchar(100) DEFAULT '',
  `pageIMG` varchar(100) DEFAULT '',
  `active` int(1) UNSIGNED DEFAULT 1,
  `insertWhen` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `dw_news`
--

INSERT INTO `dw_news` (`id`, `label`, `shortDescription`, `description`, `listIMG`, `pageIMG`, `active`, `insertWhen`) VALUES
(1, 'első', 'rövid leírás', 'leírás nagyon-nagyon hosszasan', '1.JPG', '1.JPG', 1, '2018-10-13 00:00:00'),
(2, 'második', 'rövid leírás', 'leírás nagyon-nagyon hosszasan', '2.JPG', '2.JPG', 1, '2018-10-13 00:00:00');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `dw_basket`
--
ALTER TABLE `dw_basket`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `dw_news`
--
ALTER TABLE `dw_news`
  ADD PRIMARY KEY (`id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `dw_basket`
--
ALTER TABLE `dw_basket`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT a táblához `dw_news`
--
ALTER TABLE `dw_news`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
