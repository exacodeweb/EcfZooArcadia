-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 16 jan. 2025 à 23:26
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `zoo_arcadia`
--

-- --------------------------------------------------------

--
-- Structure de la table `animaux`
--

CREATE TABLE `animaux` (
  `id` int(11) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `race` varchar(50) NOT NULL,
  `images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`images`)),
  `habitat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `animaux`
--

INSERT INTO `animaux` (`id`, `prenom`, `race`, `images`, `habitat_id`) VALUES
(1, 'Léo', 'Lion', '[\"leo1.jpg\", \"leo2.jpg\"]', 1),
(2, 'Zara', 'Zèbre', '[\"zara1.jpg\", \"zara2.jpg\"]', 1),
(3, 'Kiki', 'Perroquet', '[\"kiki1.jpg\", \"kiki2.jpg\"]', 2),
(4, 'Luna', 'Lémurien', '[\"luna1.jpg\", \"luna2.jpg\"]', 2),
(5, 'Rocky', 'Chèvre de montagne', '[\"rocky1.jpg\", \"rocky2.jpg\"]', 3),
(6, 'Blizzard', 'Léopard des neiges', '[\"blizzard1.jpg\", \"blizzard2.jpg\"]', 3);

-- --------------------------------------------------------

--
-- Structure de la table `avis`
--

CREATE TABLE `avis` (
  `id` int(11) NOT NULL,
  `message` text NOT NULL,
  `auteur` varchar(100) NOT NULL,
  `statut` enum('en_attente','approuve','refuse') DEFAULT 'en_attente',
  `date_creation` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `avis`
--

INSERT INTO `avis` (`id`, `message`, `auteur`, `statut`, `date_creation`) VALUES
(1, 'Une expérience incroyable !', 'Jean Dupont', 'approuve', '2024-12-28 21:48:04'),
(2, 'Test verification', 'John Doe', 'approuve', '2025-01-04 11:53:17'),
(3, 'Test vérification', 'John Doe', 'approuve', '2025-01-04 13:30:44'),
(4, '', '', 'refuse', '2025-01-04 13:37:00'),
(5, 'Test Vérification 01', 'John Doe', 'approuve', '2025-01-04 14:12:44'),
(6, 'Test Vérification 02', 'John Doe', 'approuve', '2025-01-04 14:13:24'),
(7, '', '', 'refuse', '2025-01-04 22:53:11'),
(0, 'Test Vérification 03', 'John Doe', 'approuve', '2025-01-05 23:03:20'),
(0, '', '', 'en_attente', '2025-01-09 15:51:49');

-- --------------------------------------------------------

--
-- Structure de la table `avisusers`
--

CREATE TABLE `avisusers` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `note` int(11) NOT NULL,
  `profile_pic` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_approved` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `avisusers`
--

INSERT INTO `avisusers` (`id`, `nom`, `email`, `message`, `note`, `profile_pic`, `created_at`, `is_approved`) VALUES
(1, 'Paul Martin', 'paul.martin@example.com', 'Très bon accueil, je reviendrai sans hésiter.', 5, '67495eb010662.jpg', '2024-11-29 06:26:56', 0),
(2, 'Paul Martin', 'paul.martin@example.com', 'Très bon accueil, je reviendrai sans hésiter.', 5, '67495efd5bfa0.jpg', '2024-11-29 06:28:13', 0);

-- --------------------------------------------------------

--
-- Structure de la table `habitats`
--

CREATE TABLE `habitats` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`images`)),
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `habitats`
--

INSERT INTO `habitats` (`id`, `nom`, `images`, `description`) VALUES
(1, 'Savane', '[\"savane1.jpg\", \"savane2.jpg\"]', 'Un habitat spacieux qui imite les plaines africaines.'),
(2, 'Forêt tropicale', '[\"foret1.jpg\", \"foret2.jpg\"]', 'Une forêt dense avec un environnement humide et chaud.'),
(3, 'Montagne', '[\"montagne1.jpg\", \"montagne2.jpg\"]', 'Un habitat rocheux et frais pour les animaux de haute altitude.');

-- --------------------------------------------------------

--
-- Structure de la table `rapports_veterinaires`
--

CREATE TABLE `rapports_veterinaires` (
  `id` int(11) NOT NULL,
  `etat` varchar(50) NOT NULL,
  `nourriture` varchar(100) NOT NULL,
  `grammage` decimal(5,2) NOT NULL,
  `date` date NOT NULL,
  `detail_etat` text DEFAULT NULL,
  `animal_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `rapports_veterinaires`
--

INSERT INTO `rapports_veterinaires` (`id`, `etat`, `nourriture`, `grammage`, `date`, `detail_etat`, `animal_id`) VALUES
(1, 'Bonne santé', 'Viande', 5.00, '2024-12-01', 'Aucun problème détecté.', 1),
(2, 'Bonne santé', 'Herbes fraîches', 4.50, '2024-12-03', NULL, 2),
(3, 'Plume en bon état', 'Graines', 1.20, '2024-12-04', 'Léger stress détecté.', 3),
(4, 'Active', 'Fruits', 2.30, '2024-12-05', 'Poids légèrement en dessous de la moyenne.', 4),
(5, 'Robuste', 'Herbes sèches', 6.00, '2024-12-06', NULL, 5),
(6, 'Blessure soignée', 'Viande', 4.80, '2024-12-07', 'La patte arrière est en voie de guérison.', 6);

-- --------------------------------------------------------

--
-- Structure de la table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `images` varchar(255) DEFAULT NULL,
  `date_creation` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `services`
--

INSERT INTO `services` (`id`, `nom`, `description`, `images`, `date_creation`) VALUES
(1, 'Restauration', 'Une sélection de plats locaux et internationaux.', 'restauration.jpg', '2024-12-25 08:45:06'),
(2, 'Visite des habitats avec guide', 'Explorez les habitats des animaux avec un guide. Gratuit.', 'guide_habitats.jpg', '2024-12-25 08:45:06'),
(3, 'Visite en petit train', 'Un tour complet du zoo à bord de notre petit train.', 'petit_train.jpg', '2024-12-25 08:45:06');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `role` enum('admin','veterinaire','employe') NOT NULL,
  `date_creation` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `nom`, `prenom`, `email`, `mot_de_passe`, `role`, `date_creation`) VALUES
(1, 'Admin', 'José', 'admin@example.com', '$2y$10$WUY8DojQoQivduVD6p0lUuMFgAE2b.KgtWeogNxDHO/DgzgNrVzc.', 'admin', '2024-11-16 21:07:45'),
(2, 'Employe', 'Martin', 'employe@example.com', '$2y$10$JJDKqJ8eoNwHuVNUE7vK.eh5OZXa.pETY4hnknNMgQAwxIQub7xdK', 'employe', '2024-11-16 21:07:45'),
(3, 'Docteur', 'Roux', 'veterinaire@example.com', '$2y$10$k36Yi8g3nHIuFytC1l/lJuVw6uy3LmjqwkhWTzt54zfkf.Ynb4wYm', 'veterinaire', '2024-11-16 21:07:45');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `avisusers`
--
ALTER TABLE `avisusers`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `avisusers`
--
ALTER TABLE `avisusers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
