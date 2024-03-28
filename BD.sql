-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 28 mars 2024 à 02:30
-- Version du serveur : 10.4.24-MariaDB
-- Version de PHP : 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `swiftminder`
--

-- --------------------------------------------------------

--
-- Structure de la table `annexe`
--

CREATE TABLE `annexe` (
  `IdAnnexe` int(11) NOT NULL,
  `NomAnnexe` varchar(255) NOT NULL,
  `Localisation` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `IdArticle` int(11) NOT NULL,
  `IdJournaliste` int(11) NOT NULL,
  `Titre` varchar(255) NOT NULL,
  `Description` varchar(1100) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `billet`
--

CREATE TABLE `billet` (
  `IdBillet` int(11) NOT NULL,
  `IdRencontre` int(11) NOT NULL,
  `PrixBillet` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `candidat`
--

CREATE TABLE `candidat` (
  `idC` int(11) NOT NULL,
  `nomC` varchar(255) NOT NULL,
  `prenomC` varchar(255) NOT NULL,
  `ageC` int(11) NOT NULL,
  `imgCpath` varchar(255) NOT NULL,
  `idElection` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `candidat`
--

INSERT INTO `candidat` (`idC`, `nomC`, `prenomC`, `ageC`, `imgCpath`, `idElection`) VALUES
(1, 'moshen', 'hsan', 30, '/images/IMAGE1 (7).png', 20),
(2, 'ahmed', 'ahmed', 65, '/images/IMAGE1 (3).png', 18),
(3, 'ali', 'aloulou', 70, '/images/IMAGE1 (11).png', 20);

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `IdCommande` int(11) NOT NULL,
  `IdUser` int(11) NOT NULL,
  `Somme` int(11) NOT NULL,
  `idproduit` int(11) NOT NULL,
  `quantite` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `contrat`
--

CREATE TABLE `contrat` (
  `contrat_id` int(11) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `date_debut` date DEFAULT NULL,
  `date_fin` date DEFAULT NULL,
  `Salaire` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `evenement`
--

CREATE TABLE `evenement` (
  `idE` int(11) NOT NULL,
  `nomE` varchar(255) NOT NULL,
  `dateE` date NOT NULL,
  `posteE` varchar(255) NOT NULL,
  `periodeP` varchar(255) NOT NULL,
  `imgEpath` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `evenement`
--

INSERT INTO `evenement` (`idE`, `nomE`, `dateE`, `posteE`, `periodeP`, `imgEpath`) VALUES
(12, 'nihed', '2024-03-02', 'azert', '3ans', 'Election/images/IMAGE1 (2).png'),
(14, 'Electionelection', '2024-03-01', 'azertty', '5ans', '/images/back (1).png'),
(15, 'bb', '2024-03-02', 'b', '5ans', '/images/deleteIcon (1).png'),
(17, 'g', '2024-01-29', 'g', 'g', '/images/IMAGE1 (8).png'),
(18, 'ELectionTest', '2024-03-04', 'azerty', 'azer', '/images/IMAGE1 (4).png'),
(19, 'aa', '2024-03-20', 'aa', '4ans', '/images/IMAGE1.png'),
(20, 'ElectionTEstss', '2024-03-04', 'aze', '2ans', '/images/IMAGE1 (4).png'),
(21, 'ElectionUne', '2024-03-04', 'Coach', '4ans', '/images/background1 (4).png'),
(22, 'ElectionDeux', '2024-03-05', 'Coach', '3ans', '/images/vote12.png'),
(23, 'ElectionImen', '2024-03-21', 'Imen', '3ans', '/images/deleteIcon.png'),
(25, 'name', '2024-03-05', 'president', '2ans', '/Eelection/images/back (1).png');

-- --------------------------------------------------------

--
-- Structure de la table `joueur`
--

CREATE TABLE `joueur` (
  `id` int(11) NOT NULL,
  `Nom` varchar(255) NOT NULL,
  `Prenom` varchar(255) NOT NULL,
  `Age` int(11) NOT NULL,
  `Position` varchar(255) NOT NULL,
  `Hauteur` int(11) NOT NULL,
  `Poids` int(11) NOT NULL,
  `Piedfort` varchar(255) NOT NULL,
  `imagePath` varchar(255) DEFAULT NULL,
  `Link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `joueur`
--

INSERT INTO `joueur` (`id`, `Nom`, `Prenom`, `Age`, `Position`, `Hauteur`, `Poids`, `Piedfort`, `imagePath`, `Link`) VALUES
(47, 'Varane', 'Raphael', 30, 'DC', 192, 85, 'Droite', 'icon.png', 'https://www.instagram.com/raphaelvarane/?hl=en'),
(49, 'Bellingham', 'jude', 20, 'MO', 189, 89, 'Droite', 'icon.png', 'https://www.instagram.com/judebellingham/?hl=en'),
(50, 'Carvajal', 'dani', 31, 'AD', 172, 71, 'Droite', 'icon.png', 'https://www.instagram.com/dani.carvajal.2/?hl=en'),
(54, 'Kaka', 'Ricardo', 45, 'AL', 187, 65, 'Droite', 'icon.png', 'https://www.instagram.com/kaka/?hl=en'),
(62, 'aaas', 'ss', 15, 'AL', 5135, 26, 'Gauche', 'icon.png', 'http://localhost/phpmyadmin/index.php?route=/sql&pos=0&db=swiftminder&table=commande');

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `IdProduit` int(11) NOT NULL,
  `NomProduit` varchar(255) NOT NULL,
  `PrixProduit` int(11) NOT NULL,
  `TailleProduit` varchar(5) NOT NULL,
  `Type` varchar(255) NOT NULL,
  `QauntiteProduit` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`IdProduit`, `NomProduit`, `PrixProduit`, `TailleProduit`, `Type`, `QauntiteProduit`, `image`) VALUES
(13, 'maryoul', 120, 'S', 'T-SHIRT', 4, 'file:/C:/Users/tun/Desktop/projet/Oussamaassal2.0/src/main/resources/Boutique/t-shirt.jpg'),
(14, 'cappuche', 100, 'S', 'CAPPUCHE', 34, 'file:/C:/Users/tun/Desktop/projet/Oussamaassal2.0/src/main/resources/Boutique/istockphoto-1322405792-612x612.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `reclamation`
--

CREATE TABLE `reclamation` (
  `IdReclamation` int(11) NOT NULL,
  `IdUser` int(11) NOT NULL,
  `Titre` varchar(255) NOT NULL,
  `Description` varchar(1000) NOT NULL,
  `Etat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `reclamation`
--

INSERT INTO `reclamation` (`IdReclamation`, `IdUser`, `Titre`, `Description`, `Etat`) VALUES
(1, 3, 'retard de livraison', 'il a erter livreeee', 1);

-- --------------------------------------------------------

--
-- Structure de la table `rencontre`
--

CREATE TABLE `rencontre` (
  `IdRencontre` int(11) NOT NULL,
  `DateRebcontre` date NOT NULL,
  `Adversaire` varchar(255) NOT NULL,
  `Score` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE `reservation` (
  `ReservationID` int(11) NOT NULL,
  `idTerrain` int(11) DEFAULT NULL,
  `DateReservation` varchar(255) DEFAULT NULL,
  `Note` varchar(255) DEFAULT NULL,
  `Emplacement` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `reservation`
--

INSERT INTO `reservation` (`ReservationID`, `idTerrain`, `DateReservation`, `Note`, `Emplacement`) VALUES
(20, 36, '10-11:30', 'vvknv', NULL),
(23, 36, '10-11:30', 'RIFEDDDDD', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `terrain`
--

CREATE TABLE `terrain` (
  `id` int(11) NOT NULL,
  `nom_terrain` varchar(255) NOT NULL,
  `adresse` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `geo_x` double DEFAULT NULL,
  `geo_y` double DEFAULT NULL,
  `ouverture` time DEFAULT NULL,
  `fermeture` time DEFAULT NULL,
  `datedispo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `terrain`
--

INSERT INTO `terrain` (`id`, `nom_terrain`, `adresse`, `description`, `geo_x`, `geo_y`, `ouverture`, `fermeture`, `datedispo`) VALUES
(36, 'Esprit 3', 'Sfax', 'Terrain esprit ', 0, 0, '07:34:00', '13:34:00', '8 février 2024 - 29 février 2024');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `idUser` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `motdepasse` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `numtel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`idUser`, `email`, `motdepasse`, `role`, `numtel`) VALUES
(1, 'os@gmail.com', '$2a$12$cwjpl3NnypAGvGG99yprTeFk9L2gkpqqw0rTAQWXmY7gW6JjZ6NMe', 'admin', 53156311),
(2, 'ahmedoussama.Assal@gmail.com', '$2a$12$n6Be08kUya2MKvAg20/ymOB5.BqfzEpwFErZRhyvZ8jnJx6hPw.0i', 'Membre', 23872087),
(3, 'ahmedoussama.assal@esprit.tn', '$2a$12$Koag3fcYL/GcHFRjjFZJ3OJsYiAvIXWCjizKKqgcXR/XjhZARXQM.', 'Membre', 23872087),
(4, 'iheb@gmail.com', '$2a$12$Gogc3Q2GL3vC5LaeeP4Km.8hbluPa3.ecGuZuriPFUabdeFV8C986', 'Moderateur', 661234),
(5, 'ahmedoussaama@gmail.com', '$2a$12$eFOhA26Oq/mGSNdVA33kE.vIYrZsmkUnC3r3PqCihoNsYPAiz4uyC', 'Membre', 53099828),
(6, 'molka.benhmida@esprit.tn', '$2a$12$u3yDKJb9vbGZH2YxFcftauwOUjXlAd409y9eljqzzRRGuW//FAEHi', 'Journaliste', 53099828),
(7, 'ahmedoussamaassal@gmail.com', '$2a$12$hOEPbNQuHJzw7MtgUANtHu3Q41EVRnQytoauy9Ck4NXM58YFCKGfu', 'Membre', 23872087);

-- --------------------------------------------------------

--
-- Structure de la table `vote`
--

CREATE TABLE `vote` (
  `idV` int(11) NOT NULL,
  `idCandidatV` int(11) NOT NULL,
  `idElectionV` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `vote`
--

INSERT INTO `vote` (`idV`, `idCandidatV`, `idElectionV`) VALUES
(1, 1, 15),
(2, 1, 16),
(8, 3, 18),
(10, 2, 18),
(11, 0, 22),
(12, 0, 22);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `annexe`
--
ALTER TABLE `annexe`
  ADD PRIMARY KEY (`IdAnnexe`);

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`IdArticle`),
  ADD KEY `const` (`IdJournaliste`);

--
-- Index pour la table `billet`
--
ALTER TABLE `billet`
  ADD PRIMARY KEY (`IdBillet`),
  ADD KEY `Billet` (`IdRencontre`);

--
-- Index pour la table `candidat`
--
ALTER TABLE `candidat`
  ADD PRIMARY KEY (`idC`),
  ADD KEY `idElection` (`idElection`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`IdCommande`),
  ADD KEY `commande_ibfk_1` (`idproduit`);

--
-- Index pour la table `contrat`
--
ALTER TABLE `contrat`
  ADD PRIMARY KEY (`contrat_id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Index pour la table `evenement`
--
ALTER TABLE `evenement`
  ADD PRIMARY KEY (`idE`);

--
-- Index pour la table `joueur`
--
ALTER TABLE `joueur`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`IdProduit`);

--
-- Index pour la table `reclamation`
--
ALTER TABLE `reclamation`
  ADD PRIMARY KEY (`IdReclamation`);

--
-- Index pour la table `rencontre`
--
ALTER TABLE `rencontre`
  ADD PRIMARY KEY (`IdRencontre`);

--
-- Index pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`ReservationID`),
  ADD KEY `Choixterrain` (`idTerrain`);

--
-- Index pour la table `terrain`
--
ALTER TABLE `terrain`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`idUser`);

--
-- Index pour la table `vote`
--
ALTER TABLE `vote`
  ADD PRIMARY KEY (`idV`),
  ADD KEY `idCandidatV` (`idCandidatV`),
  ADD KEY `idElectionV` (`idElectionV`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `annexe`
--
ALTER TABLE `annexe`
  MODIFY `IdAnnexe` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `IdArticle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `billet`
--
ALTER TABLE `billet`
  MODIFY `IdBillet` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `candidat`
--
ALTER TABLE `candidat`
  MODIFY `idC` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `IdCommande` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `contrat`
--
ALTER TABLE `contrat`
  MODIFY `contrat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `evenement`
--
ALTER TABLE `evenement`
  MODIFY `idE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT pour la table `joueur`
--
ALTER TABLE `joueur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `IdProduit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `reclamation`
--
ALTER TABLE `reclamation`
  MODIFY `IdReclamation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `rencontre`
--
ALTER TABLE `rencontre`
  MODIFY `IdRencontre` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `ReservationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT pour la table `terrain`
--
ALTER TABLE `terrain`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `vote`
--
ALTER TABLE `vote`
  MODIFY `idV` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `const` FOREIGN KEY (`IdJournaliste`) REFERENCES `user` (`idUser`);

--
-- Contraintes pour la table `billet`
--
ALTER TABLE `billet`
  ADD CONSTRAINT `billet_ibfk_1` FOREIGN KEY (`IdRencontre`) REFERENCES `rencontre` (`IdRencontre`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `candidat`
--
ALTER TABLE `candidat`
  ADD CONSTRAINT `candidat_ibfk_1` FOREIGN KEY (`idElection`) REFERENCES `evenement` (`idE`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `commande_ibfk_1` FOREIGN KEY (`idproduit`) REFERENCES `produit` (`IdProduit`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `contrat`
--
ALTER TABLE `contrat`
  ADD CONSTRAINT `contrat_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `joueur` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Contraintes pour la table `reclamation`
--
ALTER TABLE `reclamation`
  ADD CONSTRAINT `reclamation_ibfk_1` FOREIGN KEY (`IdUser`) REFERENCES `user` (`IdUser`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`idTerrain`) REFERENCES `terrain` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
