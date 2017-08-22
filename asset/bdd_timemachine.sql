-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Mar 22 Août 2017 à 17:35
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
(43, 'test d\'insertion', 'c\'est un test', 'blablabla', '2017-08-21 15:51:20', 2017, 'france', 'paris', '_20-Mozambique-1-2009.jpg', 23);

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
(37, 'MINUSCULE', 43),
(38, 'CAPITALE', 43),
(39, 'MAJUSCULE', 43);

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
(1, 'Jacques', 'Maa', 'f', 'philippe', 'jacquesdurand@gmail.com', '123sol', 0),
(7, 'Jacques', 'Martin', 'f', 'philippe2', 'jacquesdurand2@gmail.com', '123sol', 0),
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
(21, 'Paul', 'Dur', 'f', 'pauldurand7', 'pauldurand7@gmail.com', '123sol', 0),
(22, 'Paul', 'Dur', 'm', 'pauldurand8', 'pauldurand8@gmail.com', '123sol', 0),
(23, 'admin', 'admin', 'm', 'admin', 'admin@gmail.com', 'admin', 1),
(24, 'Urilisateura', 'Utilisateura', 'm', 'Utilisateura', 'utilisateura@gmail.com', '123sol', 0),
(25, 'Urilisateurb', 'Utilisateurb', 'm', 'Utilisateurb', 'utilisateurb@gmail.com', '123sol', 0),
(26, 'Urilisateurc', 'Utilisateurc', 'm', 'Utilisateurc', 'utilisateurc@gmail.com', '123sol', 0),
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
  ADD KEY `fk_tags ingredient_pictures1_idx` (`pictures_id`),
  ADD KEY `pictures_id` (`pictures_id`);

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
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT pour la table `tags_picture`
--
ALTER TABLE `tags_picture`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
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
