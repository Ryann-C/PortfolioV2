-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 22 fév. 2024 à 09:07
-- Version du serveur : 8.2.0
-- Version de PHP : 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `test_t84_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `candidat`
--

DROP TABLE IF EXISTS `candidat`;
CREATE TABLE IF NOT EXISTS `candidat` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `reponses_bloc1`
--

DROP TABLE IF EXISTS `reponses_bloc1`;
CREATE TABLE IF NOT EXISTS `reponses_bloc1` (
  `id` int NOT NULL AUTO_INCREMENT,
  `reponse_1` varchar(255) DEFAULT NULL,
  `reponse_2` varchar(255) DEFAULT NULL,
  `reponse_3` varchar(255) DEFAULT NULL,
  `reponse_4` varchar(255) DEFAULT NULL,
  `reponse_5` varchar(255) DEFAULT NULL,
  `reponse_6` varchar(255) DEFAULT NULL,
  `reponse_7` varchar(255) DEFAULT NULL,
  `reponse_8` varchar(255) DEFAULT NULL,
  `reponse_9` varchar(255) DEFAULT NULL,
  `reponse_10` varchar(255) DEFAULT NULL,
  `reponse_11` text,
  `reponse_12` varchar(255) DEFAULT NULL,
  `reponse_13` text,
  `reponse_14` varchar(255) DEFAULT NULL,
  `reponse_15` varchar(255) DEFAULT NULL,
  `reponse_16` varchar(255) DEFAULT NULL,
  `reponse_17` varchar(255) DEFAULT NULL,
  `reponse_18` varchar(255) DEFAULT NULL,
  `reponse_19` varchar(255) DEFAULT NULL,
  `reponse_20` varchar(255) DEFAULT NULL,
  `candidat_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `candidat_id` (`candidat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `reponses_bloc2`
--

DROP TABLE IF EXISTS `reponses_bloc2`;
CREATE TABLE IF NOT EXISTS `reponses_bloc2` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `reponse` varchar(255) DEFAULT NULL,
  `candidat_id` int NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `reponses_bloc3`
--

DROP TABLE IF EXISTS `reponses_bloc3`;
CREATE TABLE IF NOT EXISTS `reponses_bloc3` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `reponse` varchar(255) DEFAULT NULL,
  `candidat_id` int DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom_utilisateur` varchar(255) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `nom_utilisateur`, `mot_de_passe`) VALUES
(1, 'banane', '$2y$10$LFz0cffDciqa1c8OKCu85OA/LKZyhpPuU5NjDTPn4w519pv6jqiou');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `reponses_bloc1`
--
ALTER TABLE `reponses_bloc1`
  ADD CONSTRAINT `reponses_bloc1_ibfk_1` FOREIGN KEY (`candidat_id`) REFERENCES `candidat` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
