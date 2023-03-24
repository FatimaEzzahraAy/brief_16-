-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 17 mars 2023 à 22:58
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
-- Base de données : `gestion_bibliotheque`
--

-- --------------------------------------------------------

--
-- Structure de la table `adherent`
--

CREATE TABLE `adherent` (
  `Id_ad` int(11) NOT NULL,
  `Nom_ad` varchar(50) DEFAULT NULL,
  `Add_ad` text DEFAULT NULL,
  `Email_ad` varchar(255) DEFAULT NULL,
  `Tel_ad` int(11) DEFAULT NULL,
  `Cin_ad` varchar(50) DEFAULT NULL,
  `DateN_ad` date DEFAULT NULL,
  `Type_ad` varchar(50) DEFAULT NULL,
  `Surnom_ad` varchar(255) DEFAULT NULL,
  `Password` varchar(500) DEFAULT NULL,
  `DateO_cpt_ad` date DEFAULT NULL,
  `Penalite_ad` varchar(50) DEFAULT NULL,
  `Desactiver` varchar(3) NOT NULL DEFAULT 'non'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `adherent`
--

INSERT INTO `adherent` (`Id_ad`, `Nom_ad`, `Add_ad`, `Email_ad`, `Tel_ad`, `Cin_ad`, `DateN_ad`, `Type_ad`, `Surnom_ad`, `Password`, `DateO_cpt_ad`, `Penalite_ad`, `Desactiver`) VALUES
(1, 'dupont', '0000-00-00', 'dupont@gmail.com', 234596977, 'SDF22', '1987-03-23', 'Fonctionnaire', 'Dup', 'dup909', '2023-03-01', '0', 'non'),
(2, 'Martin', '1985-07-22', 'martin@example.com', 654321098, 'AZ012345', '1975-01-01', 'Membre', 'Marty', 'p@ssw0rd', '2023-02-01', '3', 'oui'),
(3, 'Dubois', '1998-02-12', 'dubois@example.com', 607080910, 'BC987654', '1985-06-23', 'VIP', 'Dudu', 'dubois123', '2023-01-02', '0', 'non'),
(4, 'Garcia', '1972-11-09', 'garcia@example.com', 102030405, 'FG123456', '1965-04-17', 'Membre', 'Garci', 'pass123', '2022-12-01', '0', 'non'),
(5, 'Garcia', '1972-11-09', 'garcia@example.com', 102030405, 'FG123456', '1965-04-17', 'Membre', 'Garci', 'pass123', '2022-01-03', '0', 'non'),
(6, 'Lopez', '1980-09-15', 'lopez@example.com', 708091011, 'IJ987654', '1970-11-20', 'VIP', 'Lop1', 'lop1234', '2022-03-01', '0', 'non'),
(7, 'Lopez', '1980-09-15', 'lopez@example.com', 708091011, 'IJ987654', '1970-11-20', 'VIP', 'Lop', 'lop1234', '2022-03-01', '0', 'non'),
(18, 'fatimaEzzahra', 'Tanger', 'fatimaEzzahra@exemple.fr', 743215678, 'TR4567', '1986-02-28', 'Type', 'fatimaEzzahra', 'fatimaEzzahra', '2023-03-10', '0', 'non');

-- --------------------------------------------------------

--
-- Structure de la table `bibliothécaire`
--

CREATE TABLE `bibliothécaire` (
  `Id_biblio` int(11) NOT NULL,
  `Login` varchar(255) DEFAULT NULL,
  `Password_biblio` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `bibliothécaire`
--

INSERT INTO `bibliothécaire` (`Id_biblio`, `Login`, `Password_biblio`) VALUES
(1, 'Sophia', 'sophia1023'),
(2, 'bibliothecaire1', 'secret123'),
(3, 'Mohammed', 'secret123'),
(4, 'Samira', 'mypassword123'),
(5, 'Samir123', 'mysecret123'),
(6, 'Atlas', 'atlas7070');

-- --------------------------------------------------------

--
-- Structure de la table `emprunt`
--

CREATE TABLE `emprunt` (
  `Id_emp` int(11) NOT NULL,
  `Date_emp` date DEFAULT NULL,
  `DateR` date DEFAULT NULL,
  `DateR_eff` datetime DEFAULT NULL,
  `Id_rev` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `emprunt`
--

INSERT INTO `emprunt` (`Id_emp`, `Date_emp`, `DateR`, `DateR_eff`, `Id_rev`) VALUES
(4, '2023-03-16', NULL, NULL, 38),
(6, '2023-03-16', NULL, '2023-03-28 13:30:35', 41),
(14, '2023-03-10', NULL, '2023-03-17 00:00:00', 42);

-- --------------------------------------------------------

--
-- Structure de la table `ouvrage`
--

CREATE TABLE `ouvrage` (
  `Id_ouv` int(11) NOT NULL,
  `Titre` varchar(255) DEFAULT NULL,
  `Nom_aut` varchar(255) DEFAULT NULL,
  `Img_couv` varchar(255) DEFAULT NULL,
  `Etat` varchar(50) DEFAULT NULL,
  `Type_ouv` varchar(50) DEFAULT NULL,
  `Date_adit` date DEFAULT NULL,
  `Date_ach` date DEFAULT NULL,
  `Nbr_page` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `ouvrage`
--

INSERT INTO `ouvrage` (`Id_ouv`, `Titre`, `Nom_aut`, `Img_couv`, `Etat`, `Type_ouv`, `Date_adit`, `Date_ach`, `Nbr_page`) VALUES
(2, 'The Great Gatsby', 'F. Scott Fitzgerald', 'the great gatsby.jpg', 'new', 'novel', '2022-01-01', '2022-01-15', 180),
(3, 'Le Petit Prince', 'Antoine de Saint-Exupéry', 'le petit prince.jpeg', 'neuf', 'livre', '2022-01-01', '2022-01-15', 120),
(4, 'Harry Potter and the Philosopher\'s Stone', 'J.K. Rowling', 'Harry Potter Stone.jpg', 'neuf', 'roman', '2022-02-01', '2022-02-15', 223),
(5, 'Les Misérables', 'Victor Hugo', 'miserables.jfif', 'neuf', 'roman', '2022-03-01', '2022-03-15', 1488),
(6, 'Harry Potter and the Philosopher\'s Stone', 'J.K. Rowling', 'Harry Potter Stone.jpg', 'occasion', 'roman', '2022-06-01', '2022-06-15', 256),
(7, 'La Peste', 'Albert Camus', 'La Peste.jpg', 'neuf', 'roman', '2023-01-02', '2023-01-18', 320),
(8, 'Le Comte de Monte-Cristo', 'Alexandre Dumas', 'Le Comte de Monte Cristo.jpg', 'occasion', 'roman', '2022-09-10', '2022-10-02', 1232),
(9, 'Le Mythe de Sisyphe', 'Albert Camus', 'Le Mythe de Sisyphe.jpg', 'neuf', 'essai', '2023-02-20', '2023-03-05', 256),
(10, '1984', 'George Orwell', '1984.jfif', 'neuf', 'roman', '2023-02-25', '2023-03-01', 368),
(11, 'Les Misérables', 'Victor Hugo', 'miserables.jfif', 'occasion', 'roman', '2023-01-15', '2023-02-01', 1488),
(12, 'Les Misérables', 'Victor Hugo', 'miserables.jfif', 'occasion', 'roman', '2023-01-15', '2023-02-01', 1488),
(13, 'Les Misérables', 'Victor Hugo', 'miserables.jfif', 'Bon état', 'roman', '2023-01-15', '2023-02-01', 1488),
(14, 'Les Misérables', 'Victor Hugo', 'miserables.jfif', 'Bon état', 'roman', '2023-01-15', '2023-02-01', 1488),
(15, 'Les Misérables', 'Victor Hugo', 'miserables.jfif', 'Bon état', 'roman', '2023-01-15', '2023-02-01', 1488);

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE `reservation` (
  `Id_rev` int(11) NOT NULL,
  `Date_rev` datetime DEFAULT NULL,
  `Id_ad` int(11) NOT NULL,
  `Id_ouv` int(11) NOT NULL,
  `Expire` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reservation`
--

INSERT INTO `reservation` (`Id_rev`, `Date_rev`, `Id_ad`, `Id_ouv`, `Expire`) VALUES
(38, '2016-03-23 09:58:15', 18, 3, 'non'),
(39, '2016-03-23 10:00:26', 18, 8, 'oui'),
(41, '2016-03-23 10:14:55', 18, 8, 'oui'),
(42, '2023-03-17 09:58:15', 2, 2, 'non');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `adherent`
--
ALTER TABLE `adherent`
  ADD PRIMARY KEY (`Id_ad`);

--
-- Index pour la table `bibliothécaire`
--
ALTER TABLE `bibliothécaire`
  ADD PRIMARY KEY (`Id_biblio`);

--
-- Index pour la table `emprunt`
--
ALTER TABLE `emprunt`
  ADD PRIMARY KEY (`Id_emp`),
  ADD UNIQUE KEY `Id_rev` (`Id_rev`);

--
-- Index pour la table `ouvrage`
--
ALTER TABLE `ouvrage`
  ADD PRIMARY KEY (`Id_ouv`);

--
-- Index pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`Id_rev`),
  ADD KEY `Id_ad` (`Id_ad`),
  ADD KEY `Id_ouv` (`Id_ouv`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `adherent`
--
ALTER TABLE `adherent`
  MODIFY `Id_ad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `bibliothécaire`
--
ALTER TABLE `bibliothécaire`
  MODIFY `Id_biblio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `emprunt`
--
ALTER TABLE `emprunt`
  MODIFY `Id_emp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `ouvrage`
--
ALTER TABLE `ouvrage`
  MODIFY `Id_ouv` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT pour la table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `Id_rev` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `emprunt`
--
ALTER TABLE `emprunt`
  ADD CONSTRAINT `emprunt_ibfk_1` FOREIGN KEY (`Id_rev`) REFERENCES `reservation` (`Id_rev`);

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`Id_ad`) REFERENCES `adherent` (`Id_ad`),
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`Id_ouv`) REFERENCES `ouvrage` (`Id_ouv`);

DELIMITER $$
--
-- Évènements
--
CREATE DEFINER=`root`@`localhost` EVENT `AnnulerReservation` ON SCHEDULE EVERY 1 SECOND STARTS '2023-03-01 09:32:10' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE `reservation` SET `Expire` = 'non' WHERE TIMESTAMPDIFF(HOUR, `Date_rev`, NOW()) > 24 AND(SELECT emprunt.Id_rev FROM emprunt WHERE emprunt.Id_rev is null)$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
