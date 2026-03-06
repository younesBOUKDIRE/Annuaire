-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 06 mars 2026 à 18:12
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `annuaire`
--

-- --------------------------------------------------------

--
-- Structure de la table `avis`
--

CREATE TABLE `avis` (
  `id` int(11) NOT NULL,
  `entreprise_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `note` int(11) DEFAULT NULL CHECK (`note` between 1 and 5),
  `commentaire` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `avis`
--

INSERT INTO `avis` (`id`, `entreprise_id`, `user_id`, `note`, `commentaire`, `created_at`) VALUES
(1, 2, 1, 5, 'test', '2026-02-08 14:43:49'),
(2, 2, 1, 1, 'zzz', '2026-02-08 14:43:55'),
(3, 3, 1, 5, 'test', '2026-02-08 14:48:05'),
(4, 1, 1, 3, 'test', '2026-02-08 15:12:42'),
(5, 4, 1, 2, 'test', '2026-02-08 15:13:01');

-- --------------------------------------------------------

--
-- Structure de la table `entreprises`
--

CREATE TABLE `entreprises` (
  `id` int(11) NOT NULL,
  `nom` varchar(200) DEFAULT NULL,
  `categorie` varchar(100) DEFAULT NULL,
  `adresse` text DEFAULT NULL,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `site_web` varchar(200) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `note_moyenne` decimal(2,1) DEFAULT 0.0,
  `nombre_avis` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `entreprises`
--

INSERT INTO `entreprises` (`id`, `nom`, `categorie`, `adresse`, `latitude`, `longitude`, `telephone`, `email`, `site_web`, `description`, `logo`, `created_by`, `note_moyenne`, `nombre_avis`) VALUES
(1, 'test', 'test', 'casablanca', 33.35329449, -7.16054688, NULL, NULL, NULL, NULL, 'test.png', 3, 3.0, 1),
(2, 'e', 'e', 'e', 33.60986627, -7.40224609, NULL, NULL, NULL, NULL, '', 3, 3.0, 2),
(3, 'BOUKDIRE', 'Younes', 'agadir', 33.55322000, -7.49373913, NULL, NULL, NULL, NULL, 'WhatsApp Image 2026-02-05 at 17.53.37 (1).jpeg', 3, 5.0, 1),
(4, 'alsa', 'bus', 'Ain Sebaa', 33.54536635, -7.59476512, '0649454062', 'younes.boukdir.3@gmail.com', 'https://www.alsa.ma/', 'test', '1770562758_images.png', 3, 2.0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('USER','ADMIN') DEFAULT 'USER'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`) VALUES
(1, 'Younes BOUKDIRE', 'younes.boukdir.3@gmail.com', '$2y$10$7GSekMbwkTgto2rw5tHcQekJyTCrhP0qaM/4ghYNEAYW/g3fnn32a', 'USER'),
(3, 'Admin', 'admin@annuaire.com', '$2y$10$eXAUZSkOI2OKMGhIXs3cU.6D8q4klhcDQq6R5zPVgO8gStUbAlVY2', 'ADMIN'),
(4, 'Younes BOUKDIRE', 'younes', '$2y$10$oyH0RHlli8Dt5fKYBCp2iuuw8ctarGfKDszj4Sa2wmo0DXSmTNoVC', 'USER');
--admin password is admin123

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `avis`
--
ALTER TABLE `avis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `entreprise_id` (`entreprise_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `entreprises`
--
ALTER TABLE `entreprises`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `avis`
--
ALTER TABLE `avis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `entreprises`
--
ALTER TABLE `entreprises`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `avis`
--
ALTER TABLE `avis`
  ADD CONSTRAINT `avis_ibfk_1` FOREIGN KEY (`entreprise_id`) REFERENCES `entreprises` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `avis_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `entreprises`
--
ALTER TABLE `entreprises`
  ADD CONSTRAINT `entreprises_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
