-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 02 août 2022 à 07:47
-- Version du serveur : 8.0.29
-- Version de PHP : 8.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `boutique_en_ligne`
--

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

DROP TABLE IF EXISTS `commande`;
CREATE TABLE IF NOT EXISTS `commande` (
  `id` int NOT NULL,
  `id_user` int NOT NULL,
  `id_produit` int NOT NULL,
  `prix` int NOT NULL,
  `date` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `droit`
--

DROP TABLE IF EXISTS `droit`;
CREATE TABLE IF NOT EXISTS `droit` (
  `id` int NOT NULL AUTO_INCREMENT,
  `role` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `facture`
--

DROP TABLE IF EXISTS `facture`;
CREATE TABLE IF NOT EXISTS `facture` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `file` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

DROP TABLE IF EXISTS `produit`;
CREATE TABLE IF NOT EXISTS `produit` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `img` text NOT NULL,
  `prix` varchar(255) NOT NULL,
  `id_catégorie` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id`, `nom`, `description`, `img`, `prix`, `id_catégorie`) VALUES
(1, 'OG Kush', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus nihil porro distinctio et consequuntur obcaecati, placeat dolores nisi, debitis, perferendis autem officia animi aperiam! Assumenda optio deleniti ducimus atque at.', 'images/p1.png', '10', 1),
(5, 'Orange Bud', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum magni, provident quas laboriosam reiciendis asperiores ullam eos exercitationem quae, recusandae quibusdam facere veritatis quis? Ad fugit eos vitae quod nobis.', 'images/p2.png', '10', 0),
(6, 'Gorilla glue', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum magni, provident quas laboriosam reiciendis asperiores ullam eos exercitationem quae, recusandae quibusdam facere veritatis quis? Ad fugit eos vitae quod nobis.', 'images/p3.png', '10', 0),
(7, 'White Widow', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum magni, provident quas laboriosam reiciendis asperiores ullam eos exercitationem quae, recusandae quibusdam facere veritatis quis? Ad fugit eos vitae quod nobis.', 'images/p4.png', '10', 0),
(8, 'Banana kush', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum magni, provident quas laboriosam reiciendis asperiores ullam eos exercitationem quae, recusandae quibusdam facere veritatis quis? Ad fugit eos vitae quod nobis.', 'images/p5.png', '10', 0),
(9, 'Bublble kush', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum magni, provident quas laboriosam reiciendis asperiores ullam eos exercitationem quae, recusandae quibusdam facere veritatis quis? Ad fugit eos vitae quod nobis.', 'images/p6.png', '10', 0);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_droit` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `nom`, `prenom`, `email`, `adresse`, `password`, `id_droit`) VALUES
(10, 'admin2', 'admin2', 'admin2@laplateforme.io', 'feur', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 1337);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
