-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 05 avr. 2024 à 16:41
-- Version du serveur : 10.4.25-MariaDB
-- Version de PHP : 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `fitness_drive`
--
CREATE DATABASE IF NOT EXISTS `fitness_drive` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `fitness_drive`;

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `contact`
--

INSERT INTO `contact` (`id`, `name`, `email`, `subject`, `message`) VALUES
(4, 'Mistral', 'mistral@exemple.fr', 'Test formulaire contact', 'Message de test de contact franchise'),
(14, 'Albert', 'albert@exemple.fr', 'Test formulaire contact', 'Message de test de contact Structure'),
(15, 'Gamora', 'gamora@exemple.fr', 'testlll', 'encopre test'),
(16, 'Gamora', 'gamora@exemple.fr', 'testlll', 'encopre test');

-- --------------------------------------------------------

--
-- Structure de la table `partners`
--

CREATE TABLE `partners` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name_partner` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `partners`
--

INSERT INTO `partners` (`id`, `user_id`, `name_partner`, `phone`, `is_active`, `name`) VALUES
(1, 1, 'Nimes', '0625968741', 1, 'Mistral'),
(2, 5, 'Montpellier', '0695741203', 1, 'Stark'),
(3, 7, 'Toulouse', '0639874125', 1, 'Ibanez'),
(4, 44, 'Mauguio', '0434859625', 0, 'Mariano'),
(8, 55, 'Carcasonne', '0625263698', 0, 'Chevalier');

-- --------------------------------------------------------

--
-- Structure de la table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL,
  `title` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `permissions`
--

INSERT INTO `permissions` (`id`, `title`, `description`, `is_active`) VALUES
(1, 'Distributeur de Boisson', 'Eau, soda, boisson énergisante...', 1),
(2, 'Distributeur de Nourriture', 'Barre vitaminée, chocolatée, chips...', 1),
(3, 'Vente de produit de la Marque', 'Sportif, vêtement, poster...', 1),
(4, 'Gérer le planning', 'Application de gestion de planning des coachs sportif', 1),
(5, 'Coach Sportif', 'Caoch sportif selon la catégorie', 1),
(6, 'Newsletter', 'Envoi de newsletter', 1),
(7, 'Douche', 'Salle de douche (max 10) avec vestiaire privée ', 1),
(8, 'Vestiaire', 'Vestiaire collectif ', 1),
(9, 'Appli Sportive', 'Application Fitness Drive payante, à télécharger réservé aux sportif ', 1),
(14, 'Chaîne Télévision sportive', 'Compte à une plateforme', 1),
(15, 'Serviettes', 'Mise à disposition de serviette', 1);

-- --------------------------------------------------------

--
-- Structure de la table `structures`
--

CREATE TABLE `structures` (
  `id` int(11) NOT NULL,
  `partner_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name_structure` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zipcode` int(11) NOT NULL,
  `city` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `full_description` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_description` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `structures`
--

INSERT INTO `structures` (`id`, `partner_id`, `user_id`, `name_structure`, `address`, `zipcode`, `city`, `phone`, `is_active`, `full_description`, `short_description`) VALUES
(1, 1, 3, 'Albert', '3 avenue Jean Jaures', 30000, 'Nimes', '0430691260', 1, NULL, 'Première Structure pour la franchise de Nimes de Mr Mistral'),
(2, 2, 6, 'Steve', '647 avenue de la justice', 34090, 'Montpellier', '0467728684', 1, NULL, 'Première structure de la franchise de Montpellier'),
(3, 3, 8, 'Trinhduc', '12 rue du ballon rond', 31000, 'Toulouse', '0541036574', 1, NULL, NULL),
(4, 2, 24, 'Gamora', '3 rue de la défense', 34000, 'Montpellier', '0639854123', 1, NULL, NULL),
(14, 4, 54, 'TinoRossi', '26 boulevard du papa noel', 34130, 'Mauguio', '0636985478', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `structure_permission`
--

CREATE TABLE `structure_permission` (
  `structure_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `structure_permission`
--

INSERT INTO `structure_permission` (`structure_id`, `permission_id`) VALUES
(2, 1),
(2, 5),
(2, 7),
(3, 3),
(3, 4),
(3, 6),
(4, 1),
(4, 2),
(4, 4),
(4, 5),
(4, 7),
(14, 1),
(14, 5),
(14, 9);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `roles`) VALUES
(1, 'Mistral', 'mistral@exemple.fr', '$2y$13$M41QRb.5XOM90vqeRa4B5e8O03QHabft5zv/3.zNepJ60BiF0/CLq', '[\"ROLE_PARTNER\"]'),
(3, 'Albert', 'albert@exemple.fr', '$2y$13$Kvs/IjMqMBpHVdXFRGfgyOFvBXhhT1jyaudyGaZ7h2Onk3nmy5Gg6', '[\"ROLE_STRUCTURE\"]'),
(4, 'Admin01', 'fitnessdrive.ad01@outlook.com', '$2y$13$7AE12WH3xaI8YHSysnOkDe.l22yjBjdX4BKLoKw75tqTpJmuFmhWK', '[\"ROLE_ADMIN\"]'),
(5, 'Avenger', 'avenger@exemple.fr', '$2y$13$cmL1CJdusv/tzvgzkrPRf.uLDVO7cs0K4sZDERf/0YvCAKwUtrpVS', '[\"ROLE_PARTNER\"]'),
(6, 'Steve', 'steve@exemple.fr', '$2y$13$vkO/NWklbHcCnxFj4Mi12uGyLUkegr0GLUut40aR76xXnP.DM64LW', '[\"ROLE_STRUCTURE\"]'),
(7, 'Ibanez', 'ibanez@exemple.fr', '$2y$13$rNceh7sWORxLWdQ4a9A9.OIq4BqPFqVnPScmIBwMU6hmRfa59F2je', '[\"ROLE_PARTNER\"]'),
(8, 'trinhduc', 'trinhduc@exemple.fr', '$2y$13$/pwcl6YpSaaf4miTCxwNp.oLxk3C50bfkcWo9dZASv/j5iiE9KZaS', '[\"ROLE_STRUCTURE\"]'),
(14, 'StarLord', 'starlord@exemple.fr', '$2y$13$7GhQZbQaYcQHL5PperREv.YqQhtMG0gXR9nzG8JVEsN0iaXS0G9Yi', '[\"ROLE_STRUCTURE\"]'),
(24, 'Gamora', 'gamora@exemple.fr', '$2y$13$x.KyWNB.NqPDMmvInpw8BOAGn66YM5nkJTMTXWOAhSUzqD9EvIg.G', '[\"ROLE_STRUCTURE\"]'),
(34, 'Rocket', 'rocket@exemple.fr', '$2y$13$.25pUO/qhnrWELgHQxcsheI8hMCC11JPpZyk48wBOO.t/xwgKZ4gK', '[\"ROLE_STRUCTURE\"]'),
(44, 'MarianoL', 'mariano@exemple.fr', '$2y$13$cEDfqIy.HVvCelEWRxyNd.vwtBMedmeHiOZ0/Nof/5X2/nLhy3g22', '[\"ROLE_PARTNER\"]'),
(54, 'TinoRossi', 'tinorossi@exemple.fr', '$2y$13$TxoRodUeiI/PK9UxaHiDluLjXBTuUekP9a4aO32vs31eCWYOfRMDK', '[\"ROLE_STRUCTURE\"]'),
(55, 'Chevalier', 'chevalier@exemple.fr', '$2y$13$8Uzwm7deS7HGli4n9jkOfOTgCPED7KGDdxqYqrZHoylG3VoFuM3b.', '[\"ROLE_PARTNER\"]');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `partners`
--
ALTER TABLE `partners`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_EFEB516439407BA8` (`name_partner`),
  ADD UNIQUE KEY `UNIQ_EFEB5164444F97DD` (`phone`),
  ADD UNIQUE KEY `UNIQ_EFEB51645E237E06` (`name`),
  ADD KEY `IDX_EFEB5164A76ED395` (`user_id`);

--
-- Index pour la table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `structures`
--
ALTER TABLE `structures`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_5BBEC55A13F109A8` (`name_structure`),
  ADD UNIQUE KEY `UNIQ_5BBEC55A444F97DD` (`phone`),
  ADD KEY `IDX_5BBEC55A9393F8FE` (`partner_id`),
  ADD KEY `IDX_5BBEC55AA76ED395` (`user_id`);

--
-- Index pour la table `structure_permission`
--
ALTER TABLE `structure_permission`
  ADD PRIMARY KEY (`structure_id`,`permission_id`),
  ADD KEY `IDX_D207A6E42534008B` (`structure_id`),
  ADD KEY `IDX_D207A6E4FED90CCA` (`permission_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_1483A5E9F85E0677` (`username`),
  ADD UNIQUE KEY `UNIQ_1483A5E9E7927C74` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `partners`
--
ALTER TABLE `partners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `structures`
--
ALTER TABLE `structures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `partners`
--
ALTER TABLE `partners`
  ADD CONSTRAINT `FK_EFEB5164A76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `structures`
--
ALTER TABLE `structures`
  ADD CONSTRAINT `FK_5BBEC55A9393F8FE` FOREIGN KEY (`partner_id`) REFERENCES `partners` (`id`),
  ADD CONSTRAINT `FK_5BBEC55AA76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `structure_permission`
--
ALTER TABLE `structure_permission`
  ADD CONSTRAINT `FK_D207A6E42534008B` FOREIGN KEY (`structure_id`) REFERENCES `structures` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_D207A6E4FED90CCA` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
