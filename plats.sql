-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 15 fév. 2023 à 00:27
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `plats`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `IDCATEGORIE` varchar(13) NOT NULL,
  `NOMCATEGORIE` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`IDCATEGORIE`, `NOMCATEGORIE`) VALUES
('61b76bccdadb9', 'Dessert');

-- --------------------------------------------------------

--
-- Structure de la table `commander`
--

CREATE TABLE `commander` (
  `IDPRODUIT` varchar(13) NOT NULL,
  `IDUSER` varchar(13) NOT NULL,
  `QUANTITE` int(11) DEFAULT NULL,
  `IDCOMMANDE` varchar(13) NOT NULL,
  `DATE` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `contenir`
--

CREATE TABLE `contenir` (
  `IDPRODUIT` varchar(13) NOT NULL,
  `IDINGREDIENT` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `contenir`
--

INSERT INTO `contenir` (`IDPRODUIT`, `IDINGREDIENT`) VALUES
('61b76b209165f', '61b764a891306'),
('61b76b209165f', '61b89019a63fd'),
('61b894616d2b4', '61b89019a63fd'),
('63e278179fb00', '63e278b09cef8');

-- --------------------------------------------------------

--
-- Structure de la table `ingredients`
--

CREATE TABLE `ingredients` (
  `IDINGREDIENT` varchar(13) NOT NULL,
  `NOMINGREDIENT` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `ingredients`
--

INSERT INTO `ingredients` (`IDINGREDIENT`, `NOMINGREDIENT`) VALUES
('61b764a891306', 'Ananas'),
('61b89019a63fd', 'Fraise'),
('63e278b09cef8', 'Oeuf');

-- --------------------------------------------------------

--
-- Structure de la table `origine`
--

CREATE TABLE `origine` (
  `IDORIGINE` varchar(13) NOT NULL,
  `NOMORIGINE` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `origine`
--

INSERT INTO `origine` (`IDORIGINE`, `NOMORIGINE`) VALUES
('61b764c4059af', 'France');

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

CREATE TABLE `panier` (
  `IDPANIER` varchar(13) NOT NULL,
  `IDUSER` varchar(13) NOT NULL,
  `IDPRODUIT` varchar(13) NOT NULL,
  `QUANTITE` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `IDPRODUIT` varchar(13) NOT NULL,
  `IDTYPE` varchar(13) NOT NULL,
  `IDCATEGORIE` varchar(13) NOT NULL,
  `IDORIGINE` varchar(13) NOT NULL,
  `NOMPRODUIT` varchar(30) DEFAULT NULL,
  `PRIXPRODUIT` float DEFAULT NULL,
  `POIDSPRODUIT` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`IDPRODUIT`, `IDTYPE`, `IDCATEGORIE`, `IDORIGINE`, `NOMPRODUIT`, `PRIXPRODUIT`, `POIDSPRODUIT`) VALUES
('61b76b209165f', '61b76c36ee798', '61b76bccdadb9', '61b764c4059af', 'Tarte aux pommes', 5.5, 200),
('61b894616d2b4', '61b76c36ee798', '61b76bccdadb9', '61b764c4059af', 'Tarte à la fraise', 8, 500),
('63e278179fb00', '61b76c36ee798', '61b76bccdadb9', '61b764c4059af', 'Mousse au chocolat', 3.9, 200);

-- --------------------------------------------------------

--
-- Structure de la table `type`
--

CREATE TABLE `type` (
  `IDTYPE` varchar(13) NOT NULL,
  `NOMTYPE` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `type`
--

INSERT INTO `type` (`IDTYPE`, `NOMTYPE`) VALUES
('61b76c36ee798', 'Végétarien');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` varchar(13) NOT NULL,
  `code_client` varchar(6) DEFAULT NULL,
  `password` varchar(80) DEFAULT NULL,
  `permissions` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`IDCATEGORIE`);

--
-- Index pour la table `commander`
--
ALTER TABLE `commander`
  ADD PRIMARY KEY (`IDCOMMANDE`,`IDPRODUIT`,`IDUSER`),
  ADD KEY `FK_COMMANDER` (`IDUSER`),
  ADD KEY `FK_COMMANDER2` (`IDPRODUIT`);

--
-- Index pour la table `contenir`
--
ALTER TABLE `contenir`
  ADD PRIMARY KEY (`IDPRODUIT`,`IDINGREDIENT`),
  ADD KEY `FK_CONTENIR` (`IDINGREDIENT`);

--
-- Index pour la table `ingredients`
--
ALTER TABLE `ingredients`
  ADD PRIMARY KEY (`IDINGREDIENT`);

--
-- Index pour la table `origine`
--
ALTER TABLE `origine`
  ADD PRIMARY KEY (`IDORIGINE`);

--
-- Index pour la table `panier`
--
ALTER TABLE `panier`
  ADD PRIMARY KEY (`IDPANIER`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`IDPRODUIT`),
  ADD KEY `FK_ETRE_DE_CATEGORIE` (`IDCATEGORIE`),
  ADD KEY `FK_ETRE_DE_TYPE` (`IDTYPE`),
  ADD KEY `FK_VENIR_DE` (`IDORIGINE`);

--
-- Index pour la table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`IDTYPE`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commander`
--
ALTER TABLE `commander`
  ADD CONSTRAINT `FK_COMMANDER` FOREIGN KEY (`IDUSER`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `FK_COMMANDER2` FOREIGN KEY (`IDPRODUIT`) REFERENCES `produit` (`IDPRODUIT`);

--
-- Contraintes pour la table `contenir`
--
ALTER TABLE `contenir`
  ADD CONSTRAINT `FK_CONTENIR` FOREIGN KEY (`IDINGREDIENT`) REFERENCES `ingredients` (`IDINGREDIENT`),
  ADD CONSTRAINT `FK_CONTENIR2` FOREIGN KEY (`IDPRODUIT`) REFERENCES `produit` (`IDPRODUIT`);

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `FK_ETRE_DE_CATEGORIE` FOREIGN KEY (`IDCATEGORIE`) REFERENCES `categorie` (`IDCATEGORIE`),
  ADD CONSTRAINT `FK_ETRE_DE_TYPE` FOREIGN KEY (`IDTYPE`) REFERENCES `type` (`IDTYPE`),
  ADD CONSTRAINT `FK_VENIR_DE` FOREIGN KEY (`IDORIGINE`) REFERENCES `origine` (`IDORIGINE`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
