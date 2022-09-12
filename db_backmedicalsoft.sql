-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 27 oct. 2020 à 20:18
-- Version du serveur :  5.7.31
-- Version de PHP : 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `db_backmedicalsoft`
--

-- --------------------------------------------------------

--
-- Structure de la table `examen_labo`
--

DROP TABLE IF EXISTS `examen_labo`;
CREATE TABLE IF NOT EXISTS `examen_labo` (
  `id_examen` int(11) NOT NULL AUTO_INCREMENT,
  `glycemie` varchar(100) NOT NULL,
  `selles` varchar(100) NOT NULL,
  `sang` varchar(100) NOT NULL,
  `urines` varchar(100) NOT NULL,
  `crachat` varchar(100) NOT NULL,
  `date_examen` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `publier` tinyint(4) NOT NULL DEFAULT '0',
  `signes_vitaux_id` int(11) NOT NULL,
  PRIMARY KEY (`id_examen`),
  KEY `signes_vitaux_id` (`signes_vitaux_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `examen_labo`
--

INSERT INTO `examen_labo` (`id_examen`, `glycemie`, `selles`, `sang`, `urines`, `crachat`, `date_examen`, `publier`, `signes_vitaux_id`) VALUES
(1, 'tes', 'tes', 'tes', 'tes', 'tes', '2020-10-27 16:19:12', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `facture`
--

DROP TABLE IF EXISTS `facture`;
CREATE TABLE IF NOT EXISTS `facture` (
  `id_facture` int(11) NOT NULL AUTO_INCREMENT,
  `designation` varchar(255) NOT NULL,
  `quantite` int(11) NOT NULL,
  `prix_unitaire` int(11) NOT NULL,
  `dateJour` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_patient_fac` int(11) NOT NULL,
  PRIMARY KEY (`id_facture`),
  KEY `id_patient_fac` (`id_patient_fac`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `facture`
--

INSERT INTO `facture` (`id_facture`, `designation`, `quantite`, `prix_unitaire`, `dateJour`, `id_patient_fac`) VALUES
(1, 'LIT', 2, 10, '2020-10-27 03:33:27', 1);

-- --------------------------------------------------------

--
-- Structure de la table `fiche_medicale`
--

DROP TABLE IF EXISTS `fiche_medicale`;
CREATE TABLE IF NOT EXISTS `fiche_medicale` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_creation` date NOT NULL,
  `description` text NOT NULL,
  `patient_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `patient_id` (`patient_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `fiche_medicale`
--

INSERT INTO `fiche_medicale` (`id`, `date_creation`, `description`, `patient_id`) VALUES
(1, '2020-10-25', 'test', 1);

-- --------------------------------------------------------

--
-- Structure de la table `frais`
--

DROP TABLE IF EXISTS `frais`;
CREATE TABLE IF NOT EXISTS `frais` (
  `id_frais` int(11) NOT NULL AUTO_INCREMENT,
  `type_frais` varchar(100) NOT NULL,
  `prix_unitaire` int(11) NOT NULL,
  `qte` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `patient_frais_id` int(11) NOT NULL,
  PRIMARY KEY (`id_frais`),
  KEY `patient_frais_id` (`patient_frais_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `frais`
--

INSERT INTO `frais` (`id_frais`, `type_frais`, `prix_unitaire`, `qte`, `date_created`, `patient_frais_id`) VALUES
(1, 'FICHE ', 4, 3, '2020-10-27 03:03:02', 1);

-- --------------------------------------------------------

--
-- Structure de la table `ordonnance_medicale`
--

DROP TABLE IF EXISTS `ordonnance_medicale`;
CREATE TABLE IF NOT EXISTS `ordonnance_medicale` (
  `id_ordonnance` int(11) NOT NULL AUTO_INCREMENT,
  `description_medicament` text NOT NULL,
  `examen_id` int(11) NOT NULL,
  `date_prescription` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `patient_ordo_id` int(11) NOT NULL,
  PRIMARY KEY (`id_ordonnance`),
  KEY `examen_id` (`examen_id`),
  KEY `patient_ordo_id` (`patient_ordo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ordonnance_medicale`
--

INSERT INTO `ordonnance_medicale` (`id_ordonnance`, `description_medicament`, `examen_id`, `date_prescription`, `patient_ordo_id`) VALUES
(1, 'Test dhjdjdjdj', 1, '2020-10-27 19:07:03', 1);

-- --------------------------------------------------------

--
-- Structure de la table `patient`
--

DROP TABLE IF EXISTS `patient`;
CREATE TABLE IF NOT EXISTS `patient` (
  `id_patient` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `postnom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `sexe` varchar(20) NOT NULL,
  `lieu_naissance` varchar(100) NOT NULL,
  `date_naissance` date NOT NULL,
  `age` int(11) NOT NULL,
  `telephone` varchar(100) NOT NULL,
  `profession` varchar(255) NOT NULL,
  `etat_civil` varchar(50) NOT NULL,
  `adresse_domicile` varchar(255) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_patient`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `patient`
--

INSERT INTO `patient` (`id_patient`, `nom`, `postnom`, `prenom`, `sexe`, `lieu_naissance`, `date_naissance`, `age`, `telephone`, `profession`, `etat_civil`, `adresse_domicile`, `create_date`) VALUES
(1, 'test', 'test', 'test', 'M', 'test', '2020-10-25', 20, '0000121', 'LIBERALE', 'CELIBATAIRE', 'TEST', '2020-10-25 19:00:05');

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `roles` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`id`, `roles`) VALUES
(1, 'Medecin'),
(2, 'Comptable'),
(3, 'Infirmier'),
(4, 'Receptionniste'),
(5, 'Laborantin');

-- --------------------------------------------------------

--
-- Structure de la table `signes_vitaux`
--

DROP TABLE IF EXISTS `signes_vitaux`;
CREATE TABLE IF NOT EXISTS `signes_vitaux` (
  `id_signe` int(11) NOT NULL AUTO_INCREMENT,
  `taille` decimal(65,2) NOT NULL DEFAULT '2.00',
  `poids` decimal(65,2) NOT NULL DEFAULT '2.00',
  `frequence` varchar(255) NOT NULL,
  `temperature` decimal(65,2) NOT NULL DEFAULT '2.00',
  `tension` decimal(65,2) NOT NULL DEFAULT '2.00',
  `patient_signe_id` int(11) NOT NULL,
  `dateCreation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_signe`),
  KEY `patient_signe_id` (`patient_signe_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `signes_vitaux`
--

INSERT INTO `signes_vitaux` (`id_signe`, `taille`, `poids`, `frequence`, `temperature`, `tension`, `patient_signe_id`, `dateCreation`) VALUES
(1, '2.00', '2.00', 'Normal', '2.00', '2.00', 1, '2020-10-25 21:13:25');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `matricule` varchar(100) NOT NULL,
  `nom_user` varchar(100) NOT NULL,
  `postnom_user` varchar(100) NOT NULL,
  `prenom_user` varchar(100) NOT NULL,
  `sexe_user` varchar(30) NOT NULL,
  `lieu_naissance_user` varchar(100) NOT NULL,
  `date_naissance_user` date NOT NULL,
  `login_user` varchar(255) NOT NULL,
  `motdepasse_user` varchar(255) NOT NULL,
  `fonction_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fonction_id` (`fonction_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `matricule`, `nom_user`, `postnom_user`, `prenom_user`, `sexe_user`, `lieu_naissance_user`, `date_naissance_user`, `login_user`, `motdepasse_user`, `fonction_id`) VALUES
(1, '202012101', 'BACKY', 'BACKY', 'BACKY', 'Feminin', 'Kinshasa', '2020-03-24', 'BACKY', '11111', 1),
(2, '202013319', 'JNT', 'JNT', 'JNT', 'Masculin', 'Lubumbashi', '2020-02-17', 'JNT', '00000', 2),
(3, '202014422', 'TATI', 'TATI', 'TATI', 'Feminin', 'TATI', '2020-05-03', 'TATI', '2222', 3),
(4, '202025566', 'TITO', 'TITO', 'TITO', 'Masculin', 'Lubumbashi', '2020-09-13', 'TITO', '3333', 5),
(5, '202028811', 'TITI', 'TITI', 'TITI', 'Feminin', 'TITI', '2020-01-31', 'TITI', '4444', 4);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `examen_labo`
--
ALTER TABLE `examen_labo`
  ADD CONSTRAINT `examen_labo_ibfk_1` FOREIGN KEY (`signes_vitaux_id`) REFERENCES `signes_vitaux` (`id_signe`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `facture`
--
ALTER TABLE `facture`
  ADD CONSTRAINT `facture_ibfk_1` FOREIGN KEY (`id_patient_fac`) REFERENCES `patient` (`id_patient`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `fiche_medicale`
--
ALTER TABLE `fiche_medicale`
  ADD CONSTRAINT `fiche_medicale_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`id_patient`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `frais`
--
ALTER TABLE `frais`
  ADD CONSTRAINT `frais_ibfk_1` FOREIGN KEY (`patient_frais_id`) REFERENCES `patient` (`id_patient`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `ordonnance_medicale`
--
ALTER TABLE `ordonnance_medicale`
  ADD CONSTRAINT `ordonnance_medicale_ibfk_1` FOREIGN KEY (`examen_id`) REFERENCES `examen_labo` (`id_examen`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ordonnance_medicale_ibfk_2` FOREIGN KEY (`patient_ordo_id`) REFERENCES `patient` (`id_patient`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `signes_vitaux`
--
ALTER TABLE `signes_vitaux`
  ADD CONSTRAINT `signes_vitaux_ibfk_1` FOREIGN KEY (`patient_signe_id`) REFERENCES `patient` (`id_patient`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `utilisateur_ibfk_1` FOREIGN KEY (`fonction_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
