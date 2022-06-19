-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 25 mai 2022 à 02:17
-- Version du serveur : 10.4.22-MariaDB
-- Version de PHP : 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projet`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_nom` varchar(50) NOT NULL,
  `admin_prenom` varchar(50) NOT NULL,
  `admin_cin` varchar(50) NOT NULL,
  `admin_age` int(11) NOT NULL,
  `admin_email` varchar(50) NOT NULL,
  `admin_password` varchar(50) NOT NULL,
  `admin_image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `contrat`
--

CREATE TABLE `contrat` (
  `con_id` int(11) NOT NULL,
  `con_marque` int(11) NOT NULL,
  `con_infleunceur` int(11) NOT NULL,
  `con_nom` varchar(50) NOT NULL,
  `con_duree` varchar(100) NOT NULL,
  `con_montant` float NOT NULL,
  `con_description` text NOT NULL,
  `con_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `influenceur`
--

CREATE TABLE `influenceur` (
  `inf_id` int(11) NOT NULL,
  `inf_nom` varchar(50) NOT NULL,
  `inf_prenom` varchar(50) NOT NULL,
  `inf_username` varchar(50) NOT NULL,
  `inf_age` int(11) NOT NULL,
  `inf_email` varchar(50) NOT NULL,
  `inf_password` varchar(100) NOT NULL,
  `inf_facebook` varchar(100) NOT NULL,
  `inf_instagram` varchar(100) NOT NULL,
  `inf_youtube` varchar(100) NOT NULL,
  `inf_image` varchar(100) NOT NULL,
  `inf_status` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `marque`
--

CREATE TABLE `marque` (
  `mar_id` int(11) NOT NULL,
  `mar_nom` varchar(50) NOT NULL,
  `mar_prenom` varchar(50) NOT NULL,
  `mar_entreprise` varchar(50) NOT NULL,
  `mar_ice` int(11) NOT NULL,
  `mar_rc` int(11) NOT NULL,
  `mar_date` date NOT NULL,
  `mar_email` varchar(50) NOT NULL,
  `mar_site` varchar(50) NOT NULL,
  `mar_password` varchar(50) NOT NULL,
  `mar_image` varchar(100) NOT NULL,
  `mar_status` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `msg_id` int(11) NOT NULL,
  `msg_infleunceur` int(11) NOT NULL,
  `msq_marque` int(11) NOT NULL,
  `msg_inf` text NOT NULL,
  `msg_sender` varchar(50) NOT NULL,
  `msg_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `suppression`
--

CREATE TABLE `suppression` (
  `sup_id` int(11) NOT NULL,
  `sup_infleunceur` int(11) NOT NULL,
  `sup_marque` int(11) NOT NULL,
  `sup_date` date NOT NULL,
  `sup_demande` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Index pour la table `contrat`
--
ALTER TABLE `contrat`
  ADD PRIMARY KEY (`con_id`),
  ADD KEY `contrat _marque` (`con_marque`),
  ADD KEY `contrat_inf` (`con_infleunceur`);

--
-- Index pour la table `influenceur`
--
ALTER TABLE `influenceur`
  ADD PRIMARY KEY (`inf_id`);

--
-- Index pour la table `marque`
--
ALTER TABLE `marque`
  ADD PRIMARY KEY (`mar_id`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`msg_id`),
  ADD KEY `mes_infleunceur` (`msg_infleunceur`),
  ADD KEY `res_marque` (`msq_marque`);

--
-- Index pour la table `suppression`
--
ALTER TABLE `suppression`
  ADD PRIMARY KEY (`sup_id`),
  ADD KEY `infleunceur` (`sup_infleunceur`),
  ADD KEY `marque` (`sup_marque`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `contrat`
--
ALTER TABLE `contrat`
  MODIFY `con_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `influenceur`
--
ALTER TABLE `influenceur`
  MODIFY `inf_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `marque`
--
ALTER TABLE `marque`
  MODIFY `mar_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pour la table `suppression`
--
ALTER TABLE `suppression`
  MODIFY `sup_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `contrat`
--
ALTER TABLE `contrat`
  ADD CONSTRAINT `contrat _marque` FOREIGN KEY (`con_marque`) REFERENCES `marque` (`mar_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `contrat_inf` FOREIGN KEY (`con_infleunceur`) REFERENCES `influenceur` (`inf_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `mes_infleunceur` FOREIGN KEY (`msg_infleunceur`) REFERENCES `influenceur` (`inf_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `res_marque` FOREIGN KEY (`msq_marque`) REFERENCES `marque` (`mar_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `suppression`
--
ALTER TABLE `suppression`
  ADD CONSTRAINT `infleunceur` FOREIGN KEY (`sup_infleunceur`) REFERENCES `influenceur` (`inf_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `marque` FOREIGN KEY (`sup_marque`) REFERENCES `marque` (`mar_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
