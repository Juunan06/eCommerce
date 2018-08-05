-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  Dim 05 août 2018 à 10:29
-- Version du serveur :  5.7.19
-- Version de PHP :  5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `eboutique`
--
CREATE DATABASE IF NOT EXISTS `eboutique` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `eboutique`;

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
  `article_id` int(11) NOT NULL AUTO_INCREMENT,
  `article_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `article_desc` text COLLATE utf8mb4_unicode_ci,
  `article_price` decimal(10,2) DEFAULT NULL,
  `article_img` text COLLATE utf8mb4_unicode_ci,
  `category_id` int(11) DEFAULT NULL,
  `article_qte` int(11) DEFAULT NULL,
  PRIMARY KEY (`article_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`article_id`, `article_name`, `article_desc`, `article_price`, `article_img`, `category_id`, `article_qte`) VALUES
(1, 'Blabla', 'Lorem ipsum sit amet', '1200.00', 'https://s1.qwant.com/thumbr/700x0/a/2/6bd7d9dfd68497cecde8d40dd476c96febf8f980c98cb386336b4610b2c991/Lorem-Ipsum.jpg?u=http%3A%2F%2Fvkwins.com%2Fwp-content%2Fuploads%2F2017%2F10%2FLorem-Ipsum.jpg&q=0&b=1&p=0&a=1', 1, 200),
(2, 'BLublu', 'Lorijsdofnsdofnsf', '120.00', 'https://s1.qwant.com/thumbr/700x0/a/2/6bd7d9dfd68497cecde8d40dd476c96febf8f980c98cb386336b4610b2c991/Lorem-Ipsum.jpg?u=http%3A%2F%2Fvkwins.com%2Fwp-content%2Fuploads%2F2017%2F10%2FLorem-Ipsum.jpg&q=0&b=1&p=0&a=1', 1, 200),
(3, 'dfij', 'bshdijbsv', '152.00', 'https://images.pexels.com/photos/9291/nature-bird-flying-red.jpg?cs=srgb&dl=animal-beak-bird-9291.jpg&fm=jpg', 1, 500),
(4, 'dssdsgfgs', 'fssdffsd', '45.00', 'https://images.pexels.com/photos/9291/nature-bird-flying-red.jpg?cs=srgb&dl=animal-beak-bird-9291.jpg&fm=jpg', 2, 42),
(5, 'fsbgdfg', 'dfbdbdb', '12.00', 'https://images.pexels.com/photos/9291/nature-bird-flying-red.jpg?cs=srgb&dl=animal-beak-bird-9291.jpg&fm=jpg', 2, 15),
(6, 'fsvdbfdfb', 'gdfbd', '10.00', 'https://images.pexels.com/photos/9291/nature-bird-flying-red.jpg?cs=srgb&dl=animal-beak-bird-9291.jpg&fm=jpg', 12, 42),
(11, 'az', 'az', '1.00', 'C:\\wamp64\\tmp\\php78D9.tmp', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `article_fournisseur`
--

DROP TABLE IF EXISTS `article_fournisseur`;
CREATE TABLE IF NOT EXISTS `article_fournisseur` (
  `fournisseur_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `quantité` int(11) DEFAULT NULL,
  PRIMARY KEY (`fournisseur_id`,`article_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_desc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_desc`) VALUES
(1, 'Toys', 'Some good toys'),
(2, 'Medic', 'Some Pills'),
(3, 'Food', 'Animal Food');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

DROP TABLE IF EXISTS `commande`;
CREATE TABLE IF NOT EXISTS `commande` (
  `commande_id` int(11) NOT NULL AUTO_INCREMENT,
  `commande_date` datetime DEFAULT NULL,
  `commande_livraison` date DEFAULT NULL,
  `panier_id` int(11) NOT NULL,
  PRIMARY KEY (`commande_id`,`panier_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fournisseur`
--

DROP TABLE IF EXISTS `fournisseur`;
CREATE TABLE IF NOT EXISTS `fournisseur` (
  `fournisseur_id` int(11) NOT NULL AUTO_INCREMENT,
  `fournisseur_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fournisseur_code_compta` int(11) NOT NULL,
  `fournisseur_adress` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fournisseur_postal_code` int(5) DEFAULT NULL,
  `fournisseur_city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fournisseur_mail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fournisseur_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`fournisseur_id`,`fournisseur_code_compta`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

DROP TABLE IF EXISTS `panier`;
CREATE TABLE IF NOT EXISTS `panier` (
  `panier_id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  PRIMARY KEY (`panier_id`,`client_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `panier_article`
--

DROP TABLE IF EXISTS `panier_article`;
CREATE TABLE IF NOT EXISTS `panier_article` (
  `panier_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `qte` int(11) DEFAULT NULL,
  PRIMARY KEY (`panier_id`,`article_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `rank`
--

DROP TABLE IF EXISTS `rank`;
CREATE TABLE IF NOT EXISTS `rank` (
  `rank_id` int(11) NOT NULL AUTO_INCREMENT,
  `rank_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`rank_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `rank`
--

INSERT INTO `rank` (`rank_id`, `rank_name`) VALUES
(1, 'Employee'),
(2, 'Admin');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_login` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `user_last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `user_mail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_adress` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `user_postal_code` int(5) DEFAULT NULL,
  `user_city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `user_date_of_birth` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_secu` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_account_create` datetime NOT NULL,
  `rank_id` int(11) NOT NULL,
  `user_salaire` float DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`user_id`, `user_login`, `user_password`, `user_first_name`, `user_last_name`, `user_mail`, `user_adress`, `user_postal_code`, `user_city`, `user_date_of_birth`, `user_secu`, `user_account_create`, `rank_id`, `user_salaire`) VALUES
(33, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'admin', 'admin@admin.admin', 'admin', 0, 'admin', '2001-01-01', '111111111111111', '2018-08-03 14:57:52', 2, 0),
(34, 'employee', 'fa5473530e4d1a5a1e1eb53d2fedb10c', 'employee', 'employee', 'employee@employee.employee', 'employee', 0, 'employee', '2001-01-01', '111111111111111', '2018-08-03 15:00:01', 1, 0),
(35, 'user', 'ee11cbb19052e40b07aac0ca060c23ee', '', '', 'user@user.user', '', NULL, '', NULL, NULL, '2018-08-03 15:00:45', 0, NULL),
(36, 'test', '098f6bcd4621d373cade4e832627b4f6', '', '', 'test@test.test', '', NULL, '', NULL, NULL, '2018-08-05 10:26:12', 0, NULL),
(37, 'test2', '25ca6a09d2eecbe5350f43565dd95217', '', '', 'test2@test2.test2', '', NULL, '', NULL, NULL, '2018-08-05 10:27:02', 0, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
