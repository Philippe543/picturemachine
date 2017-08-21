-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Lun 21 Août 2017 à 10:43
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
  `date_picture` date NOT NULL,
  `country` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `users_id` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `pictures`
--

INSERT INTO `pictures` (`id`, `title`, `header`, `content`, `date_record`, `date_picture`, `country`, `city`, `photo`, `users_id`) VALUES
(36, 'statue de la liberté', 'statue de la liberté', 'statue de la liberté', '2017-08-17 14:41:50', '2017-10-01', 'Etats-unis', 'New York', '_NewYork-CityMain-780x520-20.jpg', 24),
(37, 'Empire state Building', 'Empire state Building', 'Empire state Building', '2017-08-17 14:43:14', '2014-10-15', 'Etats-unis', 'New York', '_New-York Empire State Building.jpg', 24),
(38, 'Golden Gate Bridge', 'Golden Gate Bridge', 'Golden Gate Bridge', '2017-08-17 14:44:54', '2015-03-25', 'Etats-unis', 'san Francisco', '_san-francisco-news-summer-code-camp.jpg', 24),
(39, 'Place Saint Marc', 'La place Saint Marc à Venise', 'La place Saint Marc à Venise', '2017-08-17 14:48:46', '2017-10-01', 'Italie', 'Venise', '_le grandcanalvenise.jpg', 25),
(40, 'La tour de Pise', 'La tour de Pise', 'La tour de Pise', '2017-08-17 14:51:06', '2014-10-15', 'Italie', 'Pise', '_tour-pise-1.jpg', 25),
(41, 'Le Colisée de Rome', 'Le Colisée de Rome', 'Le Colisée de Rome', '2017-08-17 15:00:14', '2015-03-25', 'Italie', 'Rome', '_800px-Colosseum_Roma_2009-720x340.jpg', 26),
(42, 'Grand Canyon', 'Grand Canyon', 'Grand Canyon', '2017-08-17 15:24:36', '2017-10-01', 'Etats-unis', 'Grand Canyon', '_Stock_Grand_Canyon_084fa36e-0a2d-4560-9dbd-bbd0d93d6eb8.jpg', 27);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `pictures`
--
ALTER TABLE `pictures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pictures_users1_idx` (`users_id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `pictures`
--
ALTER TABLE `pictures`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `pictures`
--
ALTER TABLE `pictures`
  ADD CONSTRAINT `fk_pictures_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
