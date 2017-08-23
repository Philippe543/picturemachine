-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Mer 23 Août 2017 à 21:54
-- Version du serveur :  10.1.21-MariaDB
-- Version de PHP :  5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `timemachine`
--
CREATE DATABASE IF NOT EXISTS `timemachine` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `timemachine`;

-- --------------------------------------------------------

--
-- Structure de la table `comments_picture`
--

CREATE TABLE `comments_picture` (
  `id` int(3) NOT NULL,
  `content` text NOT NULL,
  `pictures_id` int(3) NOT NULL,
  `users_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `comments_story`
--

CREATE TABLE `comments_story` (
  `id` int(3) NOT NULL,
  `content` text NOT NULL,
  `stories_id` int(3) NOT NULL,
  `users_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `pictures`
--

CREATE TABLE `pictures` (
  `id` int(3) NOT NULL,
  `title` varchar(255) NOT NULL,
  `header` varchar(255) DEFAULT NULL,
  `content` text,
  `date_record` datetime NOT NULL,
  `date_picture` year(4) NOT NULL,
  `country` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `users_id` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `pictures`
--

INSERT INTO `pictures` (`id`, `title`, `header`, `content`, `date_record`, `date_picture`, `country`, `city`, `photo`, `users_id`) VALUES
(36, 'statue de la liberté', 'statue de la liberté', 'statue de la liberté', '2017-08-17 14:41:50', 2017, 'Etats-unis', 'New York', '_NewYork-CityMain-780x520-20.jpg', 24),
(37, 'Empire state Building', 'Empire state Building', 'Empire state Building', '2017-08-17 14:43:14', 2014, 'Etats-unis', 'New York', '_New-York Empire State Building.jpg', 24),
(38, 'Golden Gate Bridge', 'Golden Gate Bridge', 'Golden Gate Bridge', '2017-08-17 14:44:54', 2015, 'Etats-unis', 'san Francisco', '_san-francisco-news-summer-code-camp.jpg', 24),
(39, 'Place Saint Marc', 'La place Saint Marc à Venise', 'La place Saint Marc à Venise', '2017-08-17 14:48:46', 2017, 'Italie', 'Venise', '_le grandcanalvenise.jpg', 25),
(40, 'La tour de Pise', 'La tour de Pise', 'La tour de Pise', '2017-08-17 14:51:06', 2014, 'Italie', 'Pise', '_tour-pise-1.jpg', 25),
(41, 'Le Colisée de Rome', 'Le Colisée de Rome', 'Le Colisée de Rome', '2017-08-17 15:00:14', 2015, 'Italie', 'Rome', '_800px-Colosseum_Roma_2009-720x340.jpg', 26),
(42, 'Grand Canyon', 'Grand Canyon', 'Grand Canyon', '2017-08-17 15:24:36', 2017, 'Etats-unis', 'Grand Canyon', '_Stock_Grand_Canyon_084fa36e-0a2d-4560-9dbd-bbd0d93d6eb8.jpg', 27),
(44, 'Métro 1930 Paris', 'Station de métro Porte d\'Italie en 1930', 'Station de métro Porte d\'Italie en 1930 à Paris', '2017-08-22 17:22:48', 1930, 'France', 'Paris', '_Paris metro 1930.jpg', 23),
(45, 'Un Tramway à Paris en 1900', 'Un Tramway à Paris en 1900', 'Un Tramway à Paris en 1900', '2017-08-22 17:27:31', 1901, 'France', 'Paris', '_1tramvap2.jpg', 23),
(46, 'Arcachon 1930', 'Arcachon 1930', 'La jetée d\'Eyrac et le Casino', '2017-08-22 17:35:08', 1930, 'France', 'Arcachon', '_arcachon 1930.jpg', 23),
(47, 'Chamonix 1914', 'Chamonix Palace', 'Chamonix Palace', '2017-08-22 17:40:03', 1914, 'France', 'chamonix', '_CHAMONIX-PALACE.jpg', 23),
(48, 'Barcelone 2015', 'La sagrada Familia à Barcelone en 1915', 'La sagrada Familia à Barcelone en 1915', '2017-08-22 17:43:20', 2015, 'Espagne', 'Barcelone', '_barcelona-Sagrada-Familia-1112x630.jpg', 23),
(49, 'Viaduc de Millau', 'Course du Viaduc de Millau en 2016', 'Course du Viaduc de Millau en 2016', '2017-08-22 17:45:45', 2016, 'France', 'Millau', '_161_1_164838.jpg', 23),
(50, 'Chateau de Chambord', 'Chateau de Chambord', 'Chateau de Chambord', '2017-08-22 17:48:13', 2015, 'France', 'chambord', '_chateau-chambord-vallee-loire.jpg', 23),
(51, 'Pointe du Raz', 'Pointe du Raz', 'Pointe du Raz', '2017-08-22 17:50:44', 2007, 'France', 'Pointe du Raz', '_1200px-Bretagne_Finistere_PointeduRaz15119.jpg', 23),
(52, 'Saline d\'Arc et Senans', 'Saline d\'Arc et Senans', 'Saline d\'Arc et Senans', '2017-08-22 18:00:31', 2003, 'France', 'Arc et Senans', '_salines-arc-et-senans.jpg', 23),
(53, 'Cathedrale de Strasbourg', 'Cathedrale de Strasbourg', 'Cathedrale de Strasbourg', '2017-08-22 18:07:25', 2002, 'France', 'strasbourg', '_cathedrale-strasbourg-133925.jpg', 23),
(54, 'Maison à colombages à Troyes', 'Maison à colombages à Troyes', 'Maison à colombages à Troyes', '2017-08-22 18:22:24', 2005, 'france', 'Troyes', '_44_a_52_rue_kleber_hdr2_0.jpg', 23),
(55, 'Tour Eiffel Citroen Paris 1925', 'Tour Eiffel Citroen Paris 1925', 'Tour Eiffel Citroen Paris 1925', '2017-08-22 18:26:18', 1925, 'France', 'Paris', '_le-storytelling-sebastien-durand-conseil-communication-le-blog-citroen.jpg', 23),
(56, 'Le jet d\'eau à Genève', 'Le jet d\'eau à Genève', 'Le jet d\'eau à Genève', '2017-08-22 18:31:59', 1985, 'Suisse', 'Genève', '_genevejeteau.jpg', 23),
(57, 'Les Invalides vus du ciel', 'Les Invalides vus du ciel', 'Les invalides vus du ciel lors de la seconde guerre mondiale', '2017-08-23 09:57:20', 1942, 'France', 'Paris', '_paris_2 guerre mondiale_invalide.jpg', 23),
(58, 'Caen en 1944', 'Caen en 1944', 'Caen après les bombardements en 1944', '2017-08-23 09:59:57', 1944, 'France', 'Caen', '_Caen_in_ruins.jpg', 23),
(59, 'Le Havre après les bombardements', 'Le Havre après les bombardements', 'Le Havre après les bombardements de 1944', '2017-08-23 10:03:12', 1944, 'France', 'Le Havre', '_Le Havreapresbombardement.jpg', 23),
(60, 'La 2ième DB à Paris', 'La 2ième DB à Paris', 'La 2ième DB à Paris lors de la libération de Paris', '2017-08-23 10:06:54', 1944, 'France', 'Paris', '_un-blinde-de-la-2e-db-fonce-vers-paris.jpg', 23),
(61, 'Le Débarquement en Normandie', 'Débarquement en Normandie en 1944', 'Débarquement en Normandie en 1944', '2017-08-23 10:15:01', 1944, 'France', 'Normandie', '_invasion-normandie-juin-1944.jpg', 23),
(62, 'Paris sous l\'occupation', 'Paris sous l\'occupation', 'Paris sous l\'occupation', '2017-08-23 10:18:24', 1941, 'France', 'Paris', '_Parissousoccupation.jpg', 23),
(63, 'Carte du débarquement en Provence', 'Carte du débarquement en Provence', 'Carte du débarquement en Provence', '2017-08-23 10:21:03', 1944, 'France', 'Provence', '_carte du debarquement en Provence.jpg', 23),
(64, 'La Résistance en France', 'La Résistance en France', 'La Résistance en France', '2017-08-23 10:28:29', 1943, 'France', 'le Vercors', '_resistancefrancaise.jpg', 23),
(65, 'La bataille de dunkerque', 'La bataille de dunkerque', 'La bataille de dunkerque', '2017-08-23 10:31:43', 1940, 'France', 'dunkerque', '_dunkerque-bombarde-dynamof.jpg', 23),
(66, 'Une Aston Martin au Mans en 1953', 'Une Aston Martin au Mans en 1953', 'Une Aston Martin au Mans en 1953', '2017-08-23 10:39:22', 1953, 'France', 'Le Mans', '_lemans-aston-martin-headquarters-throwback-2015-aston-martin-racing-at-the-hotel-de-france.jpg', 23),
(67, 'La sécurtité routière à Paris en 1955', 'La sécurtité routière à Paris en 1955', 'La sécurtité routière à Paris en 1955', '2017-08-23 10:42:42', 1955, 'France', 'Paris', '_2cv police1955.jpg', 23),
(68, 'Avion DC4 en 1956', 'Avion DC4 en 1956', 'Avion DC4 en 1956', '2017-08-23 10:48:25', 1956, 'France', 'Le Bourget', '_1200px-Douglas_C-54_Skymaster_USAF.JPG', 23),
(69, 'Arcachon en 1954', 'Arcachon en 1954', 'Arcachon en 1954', '2017-08-23 10:57:51', 1954, 'France', 'Arcachon', '_ARCACHON_1954.jpg', 23),
(70, 'Tour de France en 1954 en Auvergne', 'Tour de France en 1954 en Auvergne', 'Tour de France en 1954 en Auvergne', '2017-08-23 11:04:56', 1954, 'France', 'Auvergne', '_tour de France1954auvergne.jpg', 23),
(72, 'Remiremont en 1957', 'Remiremont en 1957', 'Remiremont en 1957', '2017-08-23 11:12:12', 1957, 'France', 'Remiremont', '_Remiremont- Grande Rue dans les annees 50.JPG', 23),
(73, 'Saint Gilles Croix de vie en 1951', 'Saint Gilles Croix de vie en 1951', 'Saint Gilles Croix de vie en 1951', '2017-08-23 11:21:32', 1951, 'France', 'Saint Gilles Croix de Vie', '_st-gilles-un-appel-vos-souvenirs-dans-les-annees-50.jpg', 23),
(74, 'La Grande Motte en 1960', 'La Grande Motte en 1960', 'La Grande Motte en 1960', '2017-08-23 11:29:37', 1960, 'France', 'La Grande Motte', '_La Grande Motte en 1960.jpg', 23),
(75, 'Breteuil sur Noye en 1960', 'Breteuil sur Noye en 1960', 'Breteuil sur Noye en 1960', '2017-08-23 11:37:24', 1960, 'France', 'Breuteuil sur Noye', '_Breteuil sur Noye 1960.jpg', 23),
(76, 'Le France au Havre', 'Le France au Havre', 'Le France au Havre', '2017-08-23 11:50:40', 1963, 'France', 'Le Havre', '_Le France1963.jpg', 23),
(77, 'Le France au Havre', 'Le France au Havre', 'Le France au Havre', '2017-08-23 12:04:21', 1976, 'France', 'Paris', '_Beaubourg1976.jpg', 23),
(78, 'Cité des sciences et de l\'industrie', 'Cité des sciences et de l\'industrie', 'Cité des sciences et de l\'industrie', '2017-08-23 12:10:40', 1987, 'France', 'Paris', '_citedessciences.jpg', 23),
(79, 'Pyramide du Louvre', 'Pyramide du Louvre', 'Pyramide du Louvre', '2017-08-23 12:13:32', 1989, 'France', 'Paris', '_Le-Louvre-pyramide.jpg', 23),
(81, 'Eurodisney', 'Eurodisney', 'Eurodisney', '2017-08-23 12:20:52', 1993, 'France', 'Eurodisney', '_Eurodisney.jpg', 23),
(82, 'Musée du quai Branly', 'Musée du quai Branly', 'Musée du quai Branly', '2017-08-23 12:30:09', 2007, 'France', 'Paris', '_Quai_Branly.jpg', 23),
(83, 'La Bibliothèque Nationale de France', 'La Bibliothèque Nationale de France', 'La Bibliothèque Nationale de France', '2017-08-23 12:33:46', 1997, 'France', 'Paris', '_this-aerial-picture-taken-639a-diaporama.jpg', 23),
(84, 'Le Louvre Lens', 'Le Louvre Lens', 'Le Louvre Lens', '2017-08-23 12:39:55', 2013, 'France', 'Lens', '_louvre-lens.jpg', 23),
(85, 'Centre Pompidou Metz', 'Centre Pompidou Metz', 'Centre Pompidou Metz', '2017-08-23 12:42:25', 2012, 'France', 'Metz', '_general-view-of-the-centre-pompidou-metz-museum-in-the-eastern-city-of-metz_1188535.jpg', 23),
(86, 'Musée de la Méditerranée', 'Musée de la Méditerranée', 'Musée de la Méditerranée', '2017-08-23 12:47:52', 2014, 'France', 'Marseille', '_mucem_marseille.jpg', 23),
(87, 'Grande Arche de la Défense', 'Grande Arche de la Défense', 'Grande Arche de la Défense', '2017-08-23 12:52:35', 1989, 'France', 'Paris la Défense', '_grande-arche-de-la-defense.jpg', 23),
(88, 'Le CNIT La Défense', 'Le CNIT La Défense', 'Le CNIT La Défense', '2017-08-23 12:57:19', 1959, 'France', 'Paris la Défense', '_Le CNIT de la Defense.jpg', 23),
(89, 'Berlin', 'Berlin', 'Berlin', '2017-08-23 14:08:05', 1962, 'Allemagne', 'Berlin', '_Berlin.1---1962.png', 23),
(90, 'Berlin', 'Berlin', 'Berlin', '2017-08-23 14:09:08', 2014, 'Allemagne', 'Berlin', '_Berlin.1---2014.png', 23),
(91, 'Berlin', 'Berlin', 'Berlin', '2017-08-23 14:09:47', 1989, 'Allemagne', 'Berlin', '_Berlin.2---1989.png', 23),
(92, 'Berlin', 'Berlin', 'Berlin', '2017-08-23 14:10:41', 2015, 'Allemagne', 'Berlin', '_Berlin.2---2015.png', 23),
(93, 'Berlin', 'Berlin', 'Berlin', '2017-08-23 14:11:28', 1974, 'Allemagne', 'Berlin', '_Berlin.3---1974.png', 23),
(94, 'Berlin', 'Berlin', 'Berlin', '2017-08-23 14:12:14', 2014, 'Allemagne', 'Berlin', '_Berlin.3---2014.png', 23),
(95, 'Berlin', 'Berlin', 'Berlin', '2017-08-23 14:13:30', 1973, 'Allemagne', 'Berlin', '_Berlin.4---1973.png', 23),
(96, 'Berlin', 'Berlin', 'Berlin', '2017-08-23 14:14:37', 2014, 'Allemagne', 'Berlin', '_Berlin.4---2014.png', 23),
(97, 'Berlin', 'Berlin', 'Berlin', '2017-08-23 14:15:47', 1973, 'Allemagne', 'Berlin', '_Berlin.5---1973.png', 23),
(98, 'Berlin', 'Berlin', 'Berlin', '2017-08-23 14:17:41', 2014, 'Allemagne', 'Berlin', '_Berlin.5---2014.png', 23),
(99, 'Dubai', 'Dubai', 'Dubai', '2017-08-23 14:19:46', 2005, 'Emirats arabes Unis', 'Dubai', '_Dubai.1---2005.png', 23),
(100, 'Dubai', 'Dubai', 'Dubai', '2017-08-23 14:20:53', 2014, 'Emirats arabes Unis', 'Dubai', '_Dubai.1---2014.png', 23),
(103, 'Dubai', 'Dubai', 'Dubai', '2017-08-23 14:23:31', 2015, 'Emirats arabes Unis', 'Dubai', '_Dubai.2----2015.png', 23),
(104, 'Dubai', 'Dubai', 'Dubai', '2017-08-23 14:24:24', 2005, 'Emirats arabes Unis', 'Dubai', '_Dubai.3---2005.png', 23),
(105, 'Dubai', 'Dubai', 'Dubai', '2017-08-23 14:25:08', 2016, 'Emirats arabes Unis', 'Dubai', '_Dubai.3---2016.png', 23),
(106, 'Dubai', 'Dubai', 'Dubai', '2017-08-23 14:27:22', 2000, 'Emirats arabes Unis', 'Dubai', '_Dubai.2---2000.png', 23),
(107, 'Dubai', 'Dubai', 'Dubai', '2017-08-23 14:27:59', 1981, 'Emirats arabes Unis', 'Dubai', '_Dubai.4---1981.png', 23),
(108, 'Dubai', 'Dubai', 'Dubai', '2017-08-23 14:28:30', 2016, 'Emirats arabes Unis', 'Dubai', '_Dubai.4---2016.png', 23),
(109, 'Los Angeles 1927', 'Los angeles 1927', 'Los angeles 1927', '2017-08-23 14:30:04', 1927, 'Etats-unis', 'Los angeles', '_L-A.1---1927.png', 23),
(110, 'Los Angeles 2010', 'Los Angeles 2010', 'Los Angeles 2010', '2017-08-23 14:31:22', 2010, 'Etats-unis', 'Los angeles', '_L-A.1---2010.png', 23),
(111, 'Los Angeles 1955', 'Los Angeles 1955', 'Los Angeles 1955', '2017-08-23 14:32:12', 1955, 'Etats-unis', 'Los angeles', '_L-A.2---1955.png', 23),
(112, 'Los Angeles 2010', 'Los Angeles 2010', 'Los Angeles 2010', '2017-08-23 14:33:10', 2010, 'Etats-unis', 'Los angeles', '_L-A.2---2010.png', 23),
(113, 'Los Angeles 1939', 'Los Angeles 1939', 'Los Angeles 1939', '2017-08-23 14:34:09', 1939, 'Etats-unis', 'Los Angeles', '_L-A.3---1939.png', 23),
(114, 'Los Angeles 2011', 'Los Angeles 2011', 'Los Angeles 2011', '2017-08-23 14:35:32', 2011, 'Etats-unis', 'Los Angeles', '_L-A.3---2011.png', 23),
(115, 'Los Angeles 1938', 'Los Angeles 1938', 'Los Angeles 1938', '2017-08-23 14:36:24', 1938, 'Etats-unis', 'Los Angeles', '_L-A.4---1938.png', 23),
(116, 'Los Angeles 2011', 'Los Angeles 2011', 'Los Angeles 2011', '2017-08-23 14:37:15', 2011, 'Etats-unis', 'Los Angeles', '_L-A.4---2011.png', 23),
(117, 'Los Angeles 1927', 'Los Angeles 1927', 'Los Angeles 1927', '2017-08-23 14:38:04', 1927, 'Etats-unis', 'Los Angeles', '_L-A.5---1927.png', 23),
(118, 'Los Angeles 2011', 'Los Angeles 2011', 'Los Angeles 2011', '2017-08-23 14:38:44', 2011, 'Etats-unis', 'Los Angeles', '_L-A.5---2011.png', 23),
(119, 'Shanghai 1971', 'Shanghai 1971', 'Shanghai 1971', '2017-08-23 14:40:33', 1971, 'chine', 'Shanghai', '_Shanghai.1---1971.png', 23),
(120, 'Shanghai 2013', 'Shanghai 2013', 'Shanghai 2013', '2017-08-23 14:41:43', 2013, 'chine', 'Shanghai', '_Shanghai.1---2013.png', 23),
(121, 'Shanghai 1998', 'Shanghai 1998', 'Shanghai 1998', '2017-08-23 14:42:37', 1998, 'chine', 'Shanghai', '_Shanghai.2---1998.png', 23),
(122, 'Shanghai 2014', 'Shanghai 2014', 'Shanghai 2014', '2017-08-23 14:43:27', 2014, 'chine', 'Shanghai', '_Shanghai.2---2014.png', 23),
(123, 'Shanghai 2014', 'Shanghai 2014', 'Shanghai 2014', '2017-08-23 14:44:12', 2014, 'chine', 'Shanghai', '_Shanghai.3---2014.png', 23),
(124, 'Shanghai 1999', 'Shanghai 1999', 'Shanghai 1999', '2017-08-23 14:45:26', 1999, 'chine', 'shanghai', '_Shanghai.4---1999.png', 23),
(125, 'Shanghai 2013', 'Shanghai 2013', 'Shanghai 2013', '2017-08-23 14:46:17', 2013, 'Chine', 'Shanghai', '_Shanghai.4---2013.png', 23),
(126, 'Shanghai 2000', 'Shanghai 2000', 'Shanghai 2000', '2017-08-23 14:47:11', 2000, 'Chine', 'Shanghai', '_Shanghai.5---2000.png', 23),
(127, 'Shanghai 2014', 'Shanghai 2014', 'Shanghai 2014', '2017-08-23 14:47:57', 2014, 'Chine', 'Shanghai', '_Shanghai.5---2014.png', 23),
(128, 'Tokyo 1945', 'Tokyo 1945', 'Tokyo 1945', '2017-08-23 14:50:06', 1945, 'Japon', 'Tokyo', '_Tokyo.1---1945.png', 23),
(129, 'Tokyo 2016', 'Tokyo 2016', 'Tokyo 2016', '2017-08-23 14:51:08', 2016, 'Japon', 'Tokyo', '_Tokyo.1---2016.png', 23),
(130, 'Tokyo 1945', 'Tokyo 1945', 'Tokyo 1945', '2017-08-23 14:51:57', 1945, 'Japon', 'Tokyo', '_Tokyo.2---1945.png', 23),
(131, 'Tokyo 2015', 'Tokyo 2015', 'Tokyo 2015', '2017-08-23 14:52:52', 2015, 'Japon', 'Tokyo', '_Tokyo.2---2015.png', 23),
(132, 'Tokyo 1971', 'Tokyo 1971', 'Tokyo 1971', '2017-08-23 14:56:57', 1971, 'Japon', 'Tokyo', '_Tokyo.3---1971.png', 23),
(133, 'Tokyo 2014', 'Tokyo 2014', 'Tokyo 2014', '2017-08-23 14:57:59', 2014, 'Japon', 'Tokyo', '_Tokyo.3---2014.png', 23),
(134, 'Tokyo 1945', 'Tokyo 1945', 'Tokyo 1945', '2017-08-23 14:59:22', 1945, 'Japon', 'Tokyo', '_Tokyo.4---1945.png', 23),
(135, 'Tokyo 2016', 'Tokyo 2016', 'Tokyo 2016', '2017-08-23 15:00:10', 2016, 'Japon', 'Tokyo', '_Tokyo.4---2016.png', 23),
(136, 'Tokyo 1945', 'Tokyo 1945', 'Tokyo 1945', '2017-08-23 15:00:52', 1945, 'Japon', 'Tokyo', '_Tokyo.5--1945.png', 23),
(137, 'Tokyo 2016', 'Tokyo 2016', 'Tokyo 2016', '2017-08-23 15:01:55', 2016, 'Japon', 'Tokyo', '_Tokyo.5---2016.png', 23),
(138, 'Champs de Mars', 'Champs de Mars', 'Champs de Mars', '2017-08-23 15:04:00', 2000, 'France', 'Paris', '_Champ-de-Mars.jpg', 23),
(139, 'Champs de Mars', 'Champs de Mars', 'Champs de Mars', '2017-08-23 15:04:50', 2007, 'France', 'Paris', '_Champs_de_Mars.jpg', 23),
(140, 'Champs Elysées 1900', 'Champs Elysées 1900', 'Champs Elysées 1900', '2017-08-23 15:05:54', 0000, 'France', 'Paris', '_Paris_1.jpg', 23),
(141, 'Avenue de l\'Opéra 1900', 'Avenue de l\'Opéra 1900', 'Avenue de l\'Opéra 1900', '2017-08-23 15:07:25', 1901, 'France', 'Paris', '_Paris_2.jpg', 23),
(142, 'Place Saint Michel Paris 1923', 'Place Saint Michel Paris 1923', 'Place Saint Michel Paris 1923', '2017-08-23 15:08:47', 1923, 'France', 'Paris', '_Paris_3.jpg', 23),
(144, 'Palais des pays étrangers Paris 1889', 'Palais des pays étrangers Paris 1889', 'Palais des pays étrangers Paris 1889', '2017-08-23 15:18:09', 1901, 'France', 'Paris', '_Paris_4.jpg', 23),
(145, 'Tour Eiffel 1889', 'Tour Eiffel 1889', 'Tour Eiffel 1889', '2017-08-23 15:19:38', 1901, 'France', 'Paris', '_Paris_5.jpg', 23),
(146, 'Champs de Mars 1889', 'Champs de Mars 1889', 'Champs de Mars 1889', '2017-08-23 15:20:49', 1901, 'France', 'Paris', '_Paris_6.jpg', 23),
(147, 'Tour Eiffel 1889', 'Tour Eiffel 1889', 'Tour Eiffel 1889', '2017-08-23 15:22:32', 1901, 'France', 'Paris', '_Tower in 1889 for Exhibition.jpg', 23),
(148, 'Bangkok', 'Vue de la ville.', NULL, '0000-00-00 00:00:00', 2008, 'Thailande', 'Bangkok', '5-BKK-1-2008.jpg', 1),
(149, 'Bangkok', 'Vue de la ville n2.', NULL, '2017-08-15 00:00:00', 2008, 'Thailande', 'Bangkok', '6-BKK-2-2008.jpg', 1),
(150, 'Vacances à Bangkok', 'Vue de la ville n3.', 'Vue depuis une chambre d’hôtel.', '2017-08-15 00:00:00', 2008, 'Thaïlande', 'Bangkok', '7-BKK-3-2008.jpg', 1),
(151, 'Bangkok 4', 'Vue de la ville n4.', 'Priviliegiez le skytrain ou les tuktuk.', '2017-08-15 00:00:00', 2008, 'Thaïlande', 'Bangkok', '8-BKK-4-2008.jpg', 1),
(152, 'Bangkok sur le fleuve', 'Ballade en bateau', NULL, '2017-08-15 00:00:00', 2008, 'Thaïlande', 'Bangkok', '9-BKK-5-2008.jpg', 1),
(153, 'Bangkok temple', NULL, 'Le temple ou il y a le grand boudha allongé.', '2017-08-15 00:00:00', 2008, 'Thaïlande', 'Bangkok', '10-BKK-6-2008.jpg', 1),
(156, 'Cambodge 2008', 'Attention, passage d’éléphants!', NULL, '2017-08-15 00:00:00', 2008, 'Cambodge', 'Siem Reap', '13-Camb-1-2008.jpg', 1),
(157, 'Angkor Wat', 'Vieux temple', 'Il fesait une chaleur épouvantable et l\'air était saturé d\'humidité. On pouvait essorer nos vêtements!', '2017-08-15 00:00:00', 2008, 'Cambodge', 'Siem Reap', '14-Camb-2-2008.jpg', 1),
(159, 'Cambodge, photo 4', 'Dans un couloir d\'un vieux temple à Angkor Wat.', NULL, '2017-08-15 00:00:00', 2008, 'Cambodge', 'Siem Reap', '15-Camb-3-2008.jpg', 1),
(161, 'Angkor Wat - voyage 2008', 'La cour d\'un palais', NULL, '2017-08-15 00:00:00', 2008, 'Cambodge', 'Siem Reap', '17-Camb-5-2008.jpg', 1),
(164, 'Vue sur le lac Niassa...', 'depuis la fenêtre de la petite case que j\'occupe.', 'Le lac Niassa est en réalité le lac Malawi sur les cartes du monde. Il est appellé différemment selon que l\'on est au Mozambique ou partout ailleurs dans le monde.', '2017-08-15 00:00:00', 2009, 'Mozambique', 'Chuwanga', '21-Mozambique-2-2009.jpg', 1),
(165, 'Vue sur le lac Niassa', NULL, 'En ballade avant de partir de cette région et de retrouver Paris.', '2017-08-15 00:00:00', 2009, 'Mozanbique', 'Metangula', '22-Mozambique-3-2009.jpg', 1),
(166, 'Habitations à Metangula', NULL, 'Il y a de plus belles maisons de style colonial portugais mais pas sur cette photo.', '2017-08-15 00:00:00', 2009, 'Mozambique', 'Metangula', '23-Mozambique-4-2009.jpg', 1),
(167, 'Un bateau de transport de fret et de passagers sur le lac Niassa', NULL, 'Ce bateau a été mis en service dans les années 1950 et il flotte toujours!', '2017-08-15 00:00:00', 2009, 'Mozambique', 'Metangula', '24-Mozambique-5-2009.jpg', 1);

-- --------------------------------------------------------

--
-- Structure de la table `pictures_has_stories`
--

CREATE TABLE `pictures_has_stories` (
  `pictures_id` int(3) NOT NULL,
  `stories_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `stories`
--

CREATE TABLE `stories` (
  `id` int(3) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text,
  `users_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `tags_picture`
--

CREATE TABLE `tags_picture` (
  `id` int(3) NOT NULL,
  `tag_word` varchar(45) DEFAULT NULL,
  `pictures_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tags_picture`
--

INSERT INTO `tags_picture` (`id`, `tag_word`, `pictures_id`) VALUES
(15, 'statue de la liberté ', 36),
(16, 'New York', 36),
(17, 'Etats Unis', 36),
(18, 'Empire State Building', 37),
(19, 'New York', 37),
(20, 'Etats Unis', 37),
(21, 'pont', 38),
(22, 'Golden Gate Bridge', 38),
(23, 'Etats unis', 38),
(24, 'paysage', 38),
(25, 'Venise', 39),
(26, 'Grand Canal', 39),
(27, 'Italie', 39),
(28, 'Tour de Pise', 40),
(29, 'Pise', 40),
(30, 'Italie', 40),
(31, 'colisée', 41),
(32, 'rome', 41),
(33, 'Italie', 41),
(34, 'Grand Canyon', 42),
(35, 'Nevada', 42),
(36, 'Etats Unis', 42),
(41, 'PARIS', 44),
(42, 'MéTRO', 44),
(43, 'PORTE D\'ITALIE', 44),
(44, '1930', 44),
(45, 'TRAMWAY', 45),
(46, 'PARIS', 45),
(47, '1900', 45),
(48, 'ARCACHON', 46),
(49, '1930', 46),
(50, 'EYRAC', 46),
(51, 'CASINO', 46),
(52, 'CHAMONIX PALACE', 47),
(53, 'CHAMONIX', 47),
(54, 'ALPES', 47),
(55, '1914', 47),
(56, 'BARCELONE', 48),
(57, 'BARCELONA', 48),
(58, 'ESPAGNE', 48),
(59, 'SPAIN', 48),
(60, 'SAGRADA FAMILIA', 48),
(61, 'MILLAU', 49),
(62, 'FRANCE', 49),
(63, 'VIADUC', 49),
(64, 'CHATEAU DE CHAMBORD', 50),
(65, 'VALLéE DE LOIRE', 50),
(66, 'MONUMENT', 50),
(67, 'POINTE DU RAZ', 51),
(68, 'FINISTERE', 51),
(69, 'PHARE', 51),
(70, 'BRETAGNE', 51),
(71, 'SALINE', 52),
(72, 'ARC ET SENANS', 52),
(73, 'CATHEDRALE', 53),
(74, 'STRASBOURG', 53),
(75, 'ALSACE', 53),
(76, 'FRANCE', 53),
(77, 'MONUMENT', 53),
(78, 'MAISONS à COLOMBAGES', 54),
(79, 'TROYES', 54),
(80, 'FRANCE,', 54),
(81, 'TOUR EIFFEL', 55),
(82, 'CITROEN', 55),
(83, 'PARIS', 55),
(84, '1925,', 55),
(85, 'GENèVE', 56),
(86, 'JET D\'EAU', 56),
(87, 'SUISSE', 56),
(88, 'PARIS', 57),
(89, 'SECONDE GUERRE MONDIALE', 57),
(90, '1939-1945', 57),
(91, '', 57),
(92, 'CAEN', 58),
(93, 'SECONDE GUERRE MONDIALE', 58),
(94, '1939-1945', 58),
(95, 'NORMANDIE', 58),
(96, 'BOMBARDEMENT', 58),
(97, 'LE HAVRE', 59),
(98, 'BOMBARDEMENT', 59),
(99, 'SECONDE GUERRE MONDIALE,', 59),
(100, 'PARIS', 60),
(101, 'SECONDE GUERRE MONDIALE', 60),
(102, '1939-1945', 60),
(103, '2IèME DB', 60),
(104, 'SECONDE GUERRE MONDIALE', 61),
(105, '1939-1945', 61),
(106, 'NORMANDIE', 61),
(107, 'LIBéRATION', 61),
(108, 'DéBARQUEMENT,', 61),
(109, 'SECONDE GUERRE MONDIALE', 62),
(110, '1939-1945', 62),
(111, 'PARIS', 62),
(112, 'OCCUPATION,', 62),
(113, 'SECONDE GUERRE MONDIALE', 63),
(114, '1939-1945', 63),
(115, 'PROVENCE', 63),
(116, 'LIBéRATION', 63),
(117, 'DéBARQUEMENT,', 63),
(118, 'SECONDE GUERRE MONDIALE', 64),
(119, '1939-1945', 64),
(120, 'LE VERCORS', 64),
(121, 'RéSISTANCE,', 64),
(122, 'SECONDE GUERRE MONDIALE', 65),
(123, '1939-1945', 65),
(124, 'BATAILLE', 65),
(125, 'DUNKERQUE,', 65),
(126, 'ASTON MARTIN', 66),
(127, 'VOITURE', 66),
(128, 'ANNéES 50', 66),
(129, 'FRANCE', 66),
(130, 'LE MANS', 66),
(131, 'ANNéES 50', 67),
(132, 'FRANCE PARIS', 67),
(133, 'VOITURE', 67),
(134, 'POLICE', 67),
(135, '2CV', 67),
(136, 'ANNéES 50', 68),
(137, 'FRANCE', 68),
(138, 'LE BOURGET', 68),
(139, 'DC4', 68),
(140, 'AVION,', 68),
(141, 'ANNéES 50', 69),
(142, 'FRANCE', 69),
(143, 'ARCACHON ', 69),
(144, 'VOITURE', 69),
(145, 'PAYSAGE', 69),
(146, 'TOUR DE FRANCE', 70),
(147, 'ANNéES 50', 70),
(148, 'AUVERGNE', 70),
(159, 'ANNéES 50', 72),
(160, 'FRANCE', 72),
(161, 'REMIREMONT', 72),
(162, 'PAYSAGE', 72),
(163, 'ALSACE', 72),
(164, 'ANNéES 50', 73),
(165, 'FRANCE', 73),
(166, 'SAINT GILLES CROIX DE VIE', 73),
(167, 'PLAGE', 73),
(168, 'ANNéES 60', 74),
(169, 'FRANCE', 74),
(170, 'LA GRANDE MOTTE', 74),
(171, 'ANNéES 60', 75),
(172, 'FRANCE', 75),
(173, 'BREUTEUIL SUR NOYE', 75),
(174, 'ANNéES 60', 76),
(175, 'FRANCE', 76),
(176, 'LE HAVRE', 76),
(177, 'PAQUEBOT', 76),
(178, 'NAVIRE', 76),
(179, 'ANNéES 70', 77),
(180, 'PARIS', 77),
(181, 'BEAUBOURG', 77),
(182, 'ANNéES 80', 78),
(183, 'PARIS', 78),
(184, 'CITé DES SCIENCES ET DE L\'INDUSTRIE,', 78),
(185, 'ANNéES 80', 79),
(186, 'PARIS', 79),
(187, 'PYRAMIDE DU LOUVRE', 79),
(191, 'ANNéES 90', 81),
(192, 'FRANCE', 81),
(193, 'EURODISNEY', 81),
(194, 'PARC D\'ATTRACTION', 81),
(195, 'ANNéES 2000', 82),
(196, 'PARIS', 82),
(197, 'MUSéE DU QUAI BRANLY', 82),
(198, 'ANNéES 90', 83),
(199, 'FRANCE', 83),
(200, 'PARIS', 83),
(201, 'BNF', 83),
(202, 'BIBLIOTHèQUE NATIONALE DE FRANCE', 83),
(203, 'ANNéES 2010', 84),
(204, 'LE LOUVRE LENS', 84),
(205, 'MONUMENT', 84),
(206, 'ANNéES 2010', 85),
(207, 'CENTRE POMPIDOU METZ,', 85),
(208, 'ANNéES 2010', 86),
(209, 'MARSEILLE', 86),
(210, 'MUSéE DE LA MéDITERRANéE', 86),
(211, 'MUCEM', 86),
(212, 'FRANCE', 86),
(213, 'MUSéE', 86),
(214, 'ANNéES 80', 87),
(215, 'PARIS', 87),
(216, 'PARIS LA DéFENSE', 87),
(217, 'GRANDE ARCHE', 87),
(218, 'ANNéES 50', 88),
(219, 'PARIS', 88),
(220, 'PARIS LA DéFENSE', 88),
(221, 'CNIT', 88),
(222, 'ALLEMAGNE', 89),
(223, 'BERLIN,', 89),
(224, 'ALLEMAGNE', 90),
(225, 'BERLIN,', 90),
(226, 'ALLEMAGNE', 91),
(227, 'BERLIN,', 91),
(228, 'ALLEMAGNE', 92),
(229, 'BERLIN,', 92),
(230, 'ALLEMAGNE', 93),
(231, 'BERLIN,', 93),
(232, 'ALLEMAGNE', 94),
(233, 'BERLIN,', 94),
(234, 'ALLEMAGNE', 95),
(235, 'BERLIN,', 95),
(236, 'ALLEMAGNE', 96),
(237, 'BERLIN,', 96),
(238, 'ALLEMAGNE', 97),
(239, 'BERLIN,', 97),
(240, 'ALLEMAGNE', 98),
(241, 'BERLIN,', 98),
(242, 'EMIRATS ARABES UNIS', 99),
(243, 'DUBAI', 99),
(244, 'EMIRATS ARABES UNIS', 100),
(245, 'DUBAI', 100),
(250, 'EMIRATS ARABES UNIS', 103),
(251, 'DUBAI', 103),
(252, 'EMIRATS ARABES UNIS', 104),
(253, 'DUBAI', 104),
(254, 'EMIRATS ARABES UNIS', 105),
(255, 'DUBAI', 105),
(256, 'EMIRATS ARABES UNIS', 106),
(257, 'DUBAI', 106),
(258, 'EMIRATS ARABES UNIS', 107),
(259, 'DUBAI', 107),
(260, 'EMIRATS ARABES UNIS', 108),
(261, 'DUBAI', 108),
(262, 'ETATS UNIS', 109),
(263, 'LOS ANGELES,', 109),
(264, 'ETATS UNIS', 110),
(265, 'LOS ANGELES,', 110),
(266, 'ETATS UNIS', 111),
(267, 'LOS ANGELES,', 111),
(268, 'ETATS UNIS', 112),
(269, 'LOS ANGELES,', 112),
(270, 'ETATS UNIS', 113),
(271, 'LOS ANGELES,', 113),
(272, 'ETATS UNIS', 114),
(273, 'LOS ANGELES,', 114),
(274, 'ETATS UNIS', 115),
(275, 'LOS ANGELES,', 115),
(276, 'ETATS UNIS', 116),
(277, 'LOS ANGELES,', 116),
(278, 'ETATS UNIS', 117),
(279, 'LOS ANGELES,', 117),
(280, 'ETATS UNIS', 118),
(281, 'LOS ANGELES,', 118),
(282, 'CHINE', 119),
(283, 'SHANGHAI,', 119),
(284, 'CHINE', 120),
(285, 'SHANGHAI,', 120),
(286, 'CHINE', 121),
(287, 'SHANGHAI,', 121),
(288, 'CHINE', 122),
(289, 'SHANGHAI,', 122),
(290, 'CHINE', 123),
(291, 'SHANGHAI,', 123),
(292, 'CHINE', 124),
(293, 'SHANGHAI,', 124),
(294, 'CHINE', 125),
(295, 'SHANGHAI,', 125),
(296, 'CHINE', 126),
(297, 'SHANGHAI,', 126),
(298, 'CHINE', 127),
(299, 'SHANGHAI,', 127),
(300, 'JAPON', 128),
(301, 'TOKYO', 128),
(302, 'JAPON', 129),
(303, 'TOKYO', 129),
(304, 'JAPON', 130),
(305, 'TOKYO', 130),
(306, 'JAPON', 131),
(307, 'TOKYO', 131),
(308, 'JAPON', 132),
(309, 'TOKYO', 132),
(310, 'JAPON', 133),
(311, 'TOKYO', 133),
(312, 'JAPON', 134),
(313, 'TOKYO', 134),
(314, 'JAPON', 135),
(315, 'TOKYO', 135),
(316, 'JAPON', 136),
(317, 'TOKYO', 136),
(318, 'JAPON', 137),
(319, 'TOKYO', 137),
(320, 'FRANCE', 138),
(321, 'PARIS', 138),
(322, 'CHAMPS DE MARS', 138),
(323, 'FRANCE', 139),
(324, 'PARIS', 139),
(325, 'CHAMPS DE MARS', 139),
(326, 'FRANCE', 140),
(327, 'PARIS', 140),
(328, 'CHAMPS ELYSéES', 140),
(329, 'FRANCE', 141),
(330, 'PARIS', 141),
(331, 'AVENUE DE L\'OPéRA', 141),
(332, 'FRANCE', 142),
(333, 'PARIS', 142),
(334, 'PLACE SAINT MICHEL', 142),
(338, 'FRANCE', 144),
(339, 'PARIS', 144),
(340, 'PALAIS DES PAYS éTRANGERS', 144),
(341, 'FRANCE', 145),
(342, 'PARIS', 145),
(343, 'TOUR EIFFEL', 145),
(344, 'FRANCE', 146),
(345, 'PARIS', 146),
(346, 'CHAMPS DE MARS', 146),
(347, 'FRANCE', 147),
(348, 'PARIS', 147),
(349, 'TOUR EIFFEL', 147);

-- --------------------------------------------------------

--
-- Structure de la table `tags_theme`
--

CREATE TABLE `tags_theme` (
  `id` int(3) NOT NULL,
  `keywords` varchar(45) DEFAULT NULL,
  `stories_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(3) NOT NULL,
  `firstname` varchar(45) NOT NULL,
  `lastname` varchar(45) NOT NULL,
  `gender` enum('m','f') NOT NULL,
  `pseudo` varchar(45) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `gender`, `pseudo`, `email`, `password`, `status`) VALUES
(1, 'Jacques', 'Maa', '', 'philippe', 'jacquesdurand@gmail.com', '123sol', 0),
(7, 'Jacques', 'Martin', 'm', 'philippe2', 'jacquesdurand2@gmail.com', '123sol', 0),
(9, 'Jacques', 'Martin', 'm', 'philippe3', 'jacquesdurand3@gmail.com', '123sol', 0),
(11, 'Jacques', 'Martin', 'm', 'philippe4', 'jacquesdurand4@gmail.com', '123sol', 0),
(12, 'Jacques', 'Martin', 'm', 'philippe5', 'jacquesdurand5@gmail.com', '123sol', 0),
(13, 'Paul', 'Durand', 'm', 'pauldurand', 'pauldurand@gmail.com', '123sol', 0),
(14, 'Paul', 'Du', 'm', 'pauldurand1', 'pauldurand1@gmail.com', '123sol', 0),
(15, 'Paul', 'Dur', 'm', 'pauldurand2', 'pauldurand2@gmail.com', '123sol', 0),
(16, 'Paul', 'Dur', 'm', 'pauldurand3', 'pauldurand3@gmail.com', '123sol', 0),
(17, 'Paul', 'Dur', 'm', 'pauldurand4', 'pauldurand4@gmail.com', '123sol', 0),
(18, 'Paul', 'Dur', 'm', 'pauldurand5', 'pauldurand5@gmail.com', '123sol', 0),
(19, 'Paul', 'Dur', 'm', 'pauldurand6', 'pauldurand6@gmail.com', '123sol', 0),
(21, 'Paul', 'Dur', 'm', 'pauldurand7', 'pauldurand7@gmail.com', '123sol', 0),
(22, 'Paul', 'Dur', 'm', 'pauldurand8', 'pauldurand8@gmail.com', '123sol', 0),
(23, 'admin', 'admin', 'm', 'admin', 'admin@gmail.com', 'admin', 1),
(24, 'Utilisateura', 'Utilisateura', 'm', 'Utilisateura', 'utilisateura@gmail.com', '123sol', 0),
(25, 'Utilisateurb', 'Utilisateurb', 'm', 'Utilisateurb', 'utilisateurb@gmail.com', '123sol', 0),
(26, 'Utilisateurc', 'Utilisateurc', 'm', 'Utilisateurc', 'utilisateurc@gmail.com', '123sol', 0),
(27, 'Utilisateurd', 'Utilisateurd', 'm', 'Utilisateurd', 'utilisateurdb@gmail.com', '123sol', 0);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `comments_picture`
--
ALTER TABLE `comments_picture`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_comments_picture_pictures1_idx` (`pictures_id`),
  ADD KEY `fk_comments_picture_users1_idx` (`users_id`);

--
-- Index pour la table `comments_story`
--
ALTER TABLE `comments_story`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_comments_story_stories1_idx` (`stories_id`),
  ADD KEY `fk_comments_story_users1_idx` (`users_id`);

--
-- Index pour la table `pictures`
--
ALTER TABLE `pictures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pictures_users1_idx` (`users_id`);

--
-- Index pour la table `pictures_has_stories`
--
ALTER TABLE `pictures_has_stories`
  ADD PRIMARY KEY (`pictures_id`,`stories_id`),
  ADD KEY `fk_pictures_has_stories_pictures1_idx` (`pictures_id`),
  ADD KEY `fk_pictures_has_stories_stories1_idx` (`stories_id`);

--
-- Index pour la table `stories`
--
ALTER TABLE `stories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_stories_users1_idx` (`users_id`);

--
-- Index pour la table `tags_picture`
--
ALTER TABLE `tags_picture`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tags ingredient_pictures1_idx` (`pictures_id`);

--
-- Index pour la table `tags_theme`
--
ALTER TABLE `tags_theme`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tags_theme_stories1_idx` (`stories_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`),
  ADD UNIQUE KEY `pseudo_UNIQUE` (`pseudo`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `comments_picture`
--
ALTER TABLE `comments_picture`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `comments_story`
--
ALTER TABLE `comments_story`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `pictures`
--
ALTER TABLE `pictures`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=168;
--
-- AUTO_INCREMENT pour la table `tags_picture`
--
ALTER TABLE `tags_picture`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=350;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `comments_picture`
--
ALTER TABLE `comments_picture`
  ADD CONSTRAINT `fk_comments_picture_pictures1` FOREIGN KEY (`pictures_id`) REFERENCES `pictures` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_comments_picture_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `comments_story`
--
ALTER TABLE `comments_story`
  ADD CONSTRAINT `fk_comments_story_stories1` FOREIGN KEY (`stories_id`) REFERENCES `stories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_comments_story_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `pictures`
--
ALTER TABLE `pictures`
  ADD CONSTRAINT `fk_pictures_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Contraintes pour la table `pictures_has_stories`
--
ALTER TABLE `pictures_has_stories`
  ADD CONSTRAINT `fk_pictures_has_stories_pictures1` FOREIGN KEY (`pictures_id`) REFERENCES `pictures` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_pictures_has_stories_stories1` FOREIGN KEY (`stories_id`) REFERENCES `stories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `stories`
--
ALTER TABLE `stories`
  ADD CONSTRAINT `fk_stories_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `tags_picture`
--
ALTER TABLE `tags_picture`
  ADD CONSTRAINT `fk_tags ingredient_pictures1` FOREIGN KEY (`pictures_id`) REFERENCES `pictures` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `tags_theme`
--
ALTER TABLE `tags_theme`
  ADD CONSTRAINT `fk_tags_theme_stories1` FOREIGN KEY (`stories_id`) REFERENCES `stories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
