-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1:3306
-- Létrehozás ideje: 2022. Dec 21. 17:19
-- Kiszolgáló verziója: 8.0.21
-- PHP verzió: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `secret_server`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `secret`
--

DROP TABLE IF EXISTS `secret`;
CREATE TABLE IF NOT EXISTS `secret` (
  `id` int NOT NULL AUTO_INCREMENT,
  `hash` varchar(256) NOT NULL,
  `secretText` text NOT NULL,
  `createdAt` datetime NOT NULL,
  `expiresAt` datetime DEFAULT NULL,
  `remainingViews` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `secret`
--

INSERT INTO `secret` (`id`, `hash`, `secretText`, `createdAt`, `expiresAt`, `remainingViews`) VALUES
(1, '54353tgdsfgds54354353gsgsd5252', 'Lorem ipsum dolor sit amet plar lorem ipsum dolor sit amet plar', '2022-12-20 18:46:27', '2022-12-20 22:47:27', 7),
(2, '8b4d3bbf3696b55134c8243ce94866014b7583a6581a261bb4eb0e287d23b7c8', 'Lorem ipsum dolor sit amet plar', '2022-12-20 23:05:32', '2022-12-20 23:10:32', 5),
(3, 'a2cc80a40c2ed78918e9941540b85f866366c3f93931163d8f4198c4931ba337', 'Lorem ipsum dolor sit amet plar', '2022-12-20 23:06:16', '2022-12-20 23:11:16', 5),
(4, 'e3b00c959492545c77a8f043c99e40f57baeaa10b788329d195f94a48f9ff8cb', 'Lorem ipsum dolor sit amet plar', '2022-12-20 23:08:10', '2022-12-20 23:13:10', 5),
(5, '4fabaf8e35ee271e410b9dba5a84cb1d6529ccbafce5ffab13022183f6ca653d', 'Lorem ipsum dolor sit amet plar', '2022-12-20 23:08:45', '2022-12-20 23:13:45', 5),
(6, '50d68462cb511b1bb9dec75d288995e3e0fb6133fd0192fa741d775c3b334316', 'Lorem ipsum dolor sit amet plar', '2022-12-20 23:09:12', '2022-12-20 23:14:12', 5),
(7, '15d8f7e6d926671553f02c46a5d72c374dfbb43fff5bb08d009fbc38ee8599fc', 'Lorem ipsum dolor sit amet plar', '2022-12-20 23:09:56', '2022-12-20 23:14:56', 5),
(8, 'bd9aec6b5ca2b467826cae0bddf8e2508652dc196c2cc8ab71800dfe7ac087f0', 'Lorem ipsum dolor sit amet plar', '2022-12-20 23:10:34', '2022-12-20 23:15:34', 5),
(9, '23a8a5418b5711844db6bae0b909bc3ff72cdbabe00e909e155034e5bb2e6e5c', 'Lorem ipsum dolor sit amet plar', '2022-12-20 23:11:17', '2022-12-20 23:16:17', 5),
(10, '46e4afbbcd429dfad1f3e8e22279c144ecfc5a9d81b92e0024f20810d4e91e34', 'Lorem ipsum dolor sit amet plar', '2022-12-20 23:12:18', '2022-12-20 23:17:18', 5),
(11, '9efb25aaf2638bd0f5f464301b9f80144d5e72ebb6fe03a77905cf55e311c605', 'Lorem ipsum dolor sit amet plar', '2022-12-20 23:12:44', '2022-12-20 23:17:44', 5),
(12, 'e344e2aafffda677e65d8bb6cb6a99da3146d8a99645ea1afb63fb14c5963632', 'Lorem ipsum dolor sit amet plar', '2022-12-20 23:13:43', '2022-12-20 23:18:43', 5),
(13, '303c9b2e6b9429f9fe35c7ef742317c6f8d4dd57999efd24338506be2d63cf5f', 'Lorem ipsum dolor sit amet plar', '2022-12-20 23:14:46', '2022-12-20 23:19:46', 5),
(14, '9d01a27f2d42e0b643ffaa96a87c18867bb438c33bb825e8bb464638e04f45db', 'Lorem ipsum dolor sit amet plar', '2022-12-20 23:15:01', '2022-12-20 23:20:01', 5),
(15, 'ea3b8e0af45cbbfd6aaec3e97f492f97e474061d38b2609a3e75e1dae60026e6', 'Lorem ipsum dolor sit amet plar', '2022-12-20 23:15:12', '2022-12-20 23:20:12', 5),
(16, '2fc947ce6a202c8f3117650980b80b8e208c28d94a43c0788da42f37ca1a96d5', 'Lorem ipsum dolor sit amet plar', '2022-12-20 23:17:33', '2022-12-20 23:22:33', 5),
(17, 'daf6c74986277d23e6ed2e8f626770cd15ceea2e59974417be48718fe8e9f751', 'Lorem ipsum dolor sit amet plar', '2022-12-20 23:17:40', '2022-12-20 23:22:40', 5),
(18, '59f18b8f247e8924cd4cbe153664a73341c2c959ee02c04c21fc50983977432a', 'Lorem ipsum dolor sit amet plar', '2022-12-20 23:18:10', '2022-12-20 23:23:10', 5),
(19, '646d9d539fb3000b34892a995489c3d3224579b479bb6b30ff702f701114dbb0', 'Lorem ipsum dolor sit amet plar', '2022-12-20 23:18:22', '2022-12-20 23:23:22', 5),
(20, '3108e19236371c1f84db41fe9abc9e645f126f59866fdc5f5f51a22c2c72f9d2', 'Lorem ipsum dolor sit amet plar', '2022-12-20 23:18:35', '2022-12-20 23:23:35', 5),
(21, 'd723cc2d46c0c5f98ea0960c6d7af96e0ea0c515e8f46c927ba669c9d5eb0181', 'Lorem ipsum dolor sit amet plar', '2022-12-20 23:18:45', '2022-12-20 23:23:45', 5),
(22, '5b58aca2c20f85aa713292961658f01ff92308d6acab8aeaf99504282ef5692e', 'Lorem ipsum dolor sit amet plar', '2022-12-20 23:19:22', '2022-12-20 23:24:22', 5),
(23, '51f3eeb9d27ae888268a67e4142a4dfb79b092caf3c6d2e8b0f76de139a6a55e', 'Lorem ipsum dolor sit amet plar', '2022-12-20 23:19:55', '2022-12-20 23:24:55', 5),
(24, '981989beafaa71de45c6745a84e37a7256889faf8cde70c8cc23cb1055babb39', 'Lorem ipsum dolor sit amet plar', '2022-12-20 23:19:57', '2022-12-20 23:24:57', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
