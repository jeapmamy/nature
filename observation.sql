-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Mar 19 Septembre 2017 à 13:44
-- Version du serveur :  5.7.14
-- Version de PHP :  7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `nao`
--

-- --------------------------------------------------------

--
-- Structure de la table `observation`
--

CREATE TABLE `observation` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `latitude` decimal(10,6) NOT NULL,
  `longitude` decimal(10,6) NOT NULL,
  `statut` tinyint(1) NOT NULL,
  `user_id` int(11) NOT NULL,
  `espece_id` int(11) NOT NULL,
  `image_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `observation`
--

INSERT INTO `observation` (`id`, `date`, `latitude`, `longitude`, `statut`, `user_id`, `espece_id`, `image_id`) VALUES
(1, '2017-08-31', '48.850258', '2.364807', 1, 1, 7, NULL),
(2, '2017-08-31', '49.435985', '1.095886', 1, 2, 12, NULL),
(4, '2017-09-01', '45.552525', '4.965820', 1, 2, 15, NULL),
(5, '2017-09-01', '42.747012', '0.000000', 1, 2, 35, NULL),
(6, '2017-09-01', '44.964798', '-0.571289', 1, 2, 4074, NULL),
(7, '2017-09-01', '44.590467', '-1.142578', 1, 2, 1755, NULL),
(9, '2017-09-04', '47.989922', '0.131836', 1, 2, 2709, NULL),
(11, '2017-09-10', '50.764259', '1.977539', 1, 2, 7, NULL),
(13, '2017-09-10', '44.715514', '6.372070', 1, 2, 39, NULL),
(15, '2017-09-13', '45.929758', '3.200683', 1, 2, 7, NULL),
(16, '2017-09-13', '42.811522', '0.520477', 0, 1, 38, NULL),
(17, '2017-09-13', '42.798625', '-0.139160', 0, 1, 38, NULL),
(18, '2017-09-13', '43.216386', '-0.974122', 0, 1, 35, NULL),
(19, '2017-09-14', '44.734248', '-0.314942', 1, 2, 35, NULL),
(20, '2017-09-14', '42.562791', '2.673339', 1, 2, 35, NULL),
(21, '2017-09-09', '45.632478', '4.826659', 1, 2, 2709, NULL),
(22, '2017-09-01', '48.645976', '4.948425', 1, 2, 2709, NULL),
(23, '2017-09-07', '44.952360', '-0.402833', 1, 2, 35, NULL),
(24, '2017-09-14', '50.641797', '1.970214', 1, 2, 891, NULL),
(28, '2017-09-14', '48.563158', '-4.182130', 1, 2, 832, NULL),
(29, '2017-09-15', '44.809122', '-0.490265', 1, 2, 155, NULL),
(30, '2017-09-15', '45.552525', '-0.578156', 1, 2, 155, 1),
(31, '2017-09-16', '45.552525', '3.157196', 1, 2, 732, 2),
(32, '2017-09-17', '44.245199', '-0.138702', 0, 1, 155, 3),
(33, '2017-09-01', '46.498392', '5.090790', 0, 1, 155, 4),
(34, '2017-09-15', '44.577948', '2.409667', 0, 1, 242, 5),
(35, '2017-09-17', '45.755260', '3.200683', 0, 1, 2720, 6),
(36, '2017-09-17', '47.875928', '-2.085588', 1, 2, 155, 7),
(37, '2017-09-17', '47.875927', '-2.085591', 1, 2, 1755, NULL),
(38, '2017-09-17', '47.875928', '-2.085588', 0, 1, 1755, NULL),
(39, '2017-09-10', '46.061035', '2.761230', 1, 2, 1147, NULL),
(40, '2017-08-18', '46.551967', '-1.780844', 0, 1, 1147, 8);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `observation`
--
ALTER TABLE `observation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_C576DBE03DA5256D` (`image_id`),
  ADD KEY `IDX_C576DBE0A76ED395` (`user_id`),
  ADD KEY `IDX_C576DBE02D191E7A` (`espece_id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `observation`
--
ALTER TABLE `observation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `observation`
--
ALTER TABLE `observation`
  ADD CONSTRAINT `FK_C576DBE02D191E7A` FOREIGN KEY (`espece_id`) REFERENCES `espece` (`ID`),
  ADD CONSTRAINT `FK_C576DBE03DA5256D` FOREIGN KEY (`image_id`) REFERENCES `image` (`id`),
  ADD CONSTRAINT `FK_C576DBE0A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
