-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Mar 19 Septembre 2017 à 13:40
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
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `confirmation_token` varchar(180) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `pro` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `confirmation_token`, `password_requested_at`, `roles`, `pro`) VALUES
(1, 'jack56', 'jack56', 'jacqueline.vallier@yahoo.fr', 'jacqueline.vallier@yahoo.fr', 1, 'z12EupN1cEkWRXLQRXkj2bh06/UJW/vyI0jUb0V.SWQ', 'ek4IlW/UlJwHAw67EXLHXW8IVXD7zXaS4J2vJhLb00FBAujIuK1KXeGIsyJjSAIJkVB6KnyDC9cQyWOlCYMGWg==', '2017-09-18 14:52:25', 'YyZisyiC5bPMOWfaADudAeseV_jSy8WNlddlaU0vZUY', '2017-08-26 16:46:40', 'a:0:{}', 0),
(2, 'admin', 'admin', 'admin@webmaster.com', 'admin@webmaster.com', 1, 'HWJqH6VB5uPARZQ2GiDHfPnOSs.6W/Jj2rtbhdOlDxc', 'IsZKpE27NJPq4TVlCU5Yp+YXELZMnXKz2sov86110ooTMAtcaCx+fJmx1lBrhTAE57vDUmVfypVgOaSOLN1BHQ==', '2017-09-19 10:15:07', NULL, NULL, 'a:1:{i:0;s:10:"ROLE_ADMIN";}', 0),
(3, 'jeap', 'jeap', 'jeap.mamy@hotmail.fr', 'jeap.mamy@hotmail.fr', 1, 'ZJlrgi/6qKUKzjHePx.SM3g6biMPemWVagSglxZsb4g', 'WbLLLHx5KvbRHEZWqGpQO/rFAdU5/uIZVjRv8EeorPN+5cSgMev6W7I6wbG6VUA3qQ/BAx1Hs7et815xXzroUw==', '2017-09-12 19:01:42', NULL, NULL, 'a:0:{}', 0),
(4, 'jane', 'jane', 'janedoe@gmail.com', 'janedoe@gmail.com', 1, 'HqWIW1Pu.JuOdnVN.e0vAf9HIaSbRvwLFrK4Qjjtmes', 'K0ahXvlFEw/GDEh/2nuNsV8SmbB/4DLsE8eFW4l2B/hSjUF21ky3AYLh93djmj7oNT9+HJZ4ckXBg0orUH8CsA==', '2017-08-29 19:01:27', NULL, NULL, 'a:0:{}', 0),
(5, 'naturaliste', 'naturaliste', 'jeap.mamy@gmail.com', 'jeap.mamy@gmail.com', 1, 'A4T9rPB7yBiiuPLmODHhP/HuK0Pm.dHqOFQkO9UZJNI', 'r+NTGMfrs63Vtc6bCd8XPSNf7/83u1ApAmzBJDCm7WsBvLggS4B1nP+IAO4tP+bnLsr4qopsR5G8Tg9waikQPQ==', '2017-09-18 14:46:12', NULL, NULL, 'a:1:{i:0;s:10:"ROLE_ADMIN";}', 0);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D64992FC23A8` (`username_canonical`),
  ADD UNIQUE KEY `UNIQ_8D93D649A0D96FBF` (`email_canonical`),
  ADD UNIQUE KEY `UNIQ_8D93D649C05FB297` (`confirmation_token`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
