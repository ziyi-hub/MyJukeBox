-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : Dim 07 mars 2021 à 00:16
-- Version du serveur :  10.4.14-MariaDB
-- Version de PHP : 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `myjukebox`
--

-- --------------------------------------------------------

--
-- Structure de la table `constitutionfile`
--

CREATE TABLE `constitutionfile` (
  `ordre` int(11) NOT NULL,
  `IDMusique` int(11) NOT NULL,
  `IDFile` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `constitutionplaylist`
--

CREATE TABLE `constitutionplaylist` (
  `IDMusique` int(11) NOT NULL,
  `IDPlaylist` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `fileattente`
--

CREATE TABLE `fileattente` (
  `IDFile` int(11) NOT NULL,
  `IDSalon` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `fileattente`
--

INSERT INTO `fileattente` (`IDFile`, `IDSalon`) VALUES
(1, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `musique`
--

CREATE TABLE `musique` (
  `IDMusique` int(11) NOT NULL,
  `Titre` varchar(100) NOT NULL,
  `Artiste` varchar(50) DEFAULT NULL,
  `NomAlbum` varchar(100) DEFAULT NULL,
  `Genre` varchar(100) DEFAULT NULL,
  `Duree` int(8) DEFAULT NULL,
  `lien` varchar(100) DEFAULT NULL,
  `lienimg` varchar(100) DEFAULT NULL,
  `bitsrate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `musique`
--

INSERT INTO `musique` (`IDMusique`, `Titre`, `Artiste`, `NomAlbum`, `Genre`, `Duree`, `lien`, `lienimg`, `bitsrate`) VALUES
(1, 'Stairway to Heaven', 'Led Zeppelin', 'Led Zeppelin IV', 'Rock Progressif', 481, 'web/musiques/led-zeppelin-stairway-to-heaven.mp3', 'web/images/led-zeppelin-stairway-to-heaven.jpg', 248000),
(2, 'The Show Must Go On', 'Queen', 'Innuendo', 'Classic Rock', 263, 'web/musiques/queen-the-show-must-go-on.mp3', 'web/images/queen-the-show-must-go-on.png', 273000),
(4, 'Take Me Home, Country Roads', 'John Denver', 'Poems, Prayers & Promises', 'Country', 24, 'web/musiques/john-denver-take-me-home-country-road.mp3', 'web/images/PoemsPrayersAndPromises.jpg', 320000),
(5, 'Burning Love', 'Elvis Presley', 'Separate Ways', 'Rock', 21, 'web/musiques/elvis-presley-burning-love-testaudio.mp3', 'web/images/Elvis_Separate_Ways.jpg', 320000),
(7, 'Like a Rolling Stone', 'Bob Dylan', 'Highway 61 Revisited', 'Folk Rock', 21, 'web/musiques/elvis-presley-burning-love-testaudio.mp3', 'web/images/Elvis_Separate_Ways.jpg', 320000),
(8, 'Imagine', ' John Lennon', 'Imagine', 'Pop Rock', 21, 'web/musiques/elvis-presley-burning-love-testaudio.mp3', 'web/images/Elvis_Separate_Ways.jpg', 320000),
(10, 'Satisfaction', 'The Rolling Stones', 'Out of Our Heads', 'Rock', 21, 'web/musiques/elvis-presley-burning-love-testaudio.mp3', 'web/images/Elvis_Separate_Ways.jpg', 320000),
(11, 'Whats Going On', 'Marvin Gaye', 'Whats Going On', 'Soul', 21, 'web/musiques/elvis-presley-burning-love-testaudio.mp3', 'web/images/Elvis_Separate_Ways.jpg', 320000),
(13, 'Fast Car', 'Tracy Chapman', 'Tracy Chapman', 'Folk', 21, 'web/musiques/elvis-presley-burning-love-testaudio.mp3', 'web/images/Elvis_Separate_Ways.jpg', 320000),
(14, 'Respect', 'Aretha Franklin', 'I Never Loved a Man the Way I Love You', 'R&B Soul', 21, 'web/musiques/elvis-presley-burning-love-testaudio.mp3', 'web/images/Elvis_Separate_Ways.jpg', 320000),
(19, 'Cry me a River', 'Justin Timberlake', 'Justified', 'Pop R&B', 24, 'web/musiques/john-denver-take-me-home-country-road.mp3', 'web/images/PoemsPrayersAndPromises.jpg', 320000),
(22, 'Stayin Alive', 'Bee Gees', 'Stayin Alive', 'Disco', 24, 'web/musiques/john-denver-take-me-home-country-road.mp3', 'web/images/PoemsPrayersAndPromises.jpg', 320000),
(28, 'Whats Going On', 'Marvin Gaye', 'Whats Going On', 'Soul', 21, 'web/musiques/elvis-presley-burning-love-testaudio.mp3', 'web/images/Elvis_Separate_Ways.jpg', 320000),
(29, 'Clocks', 'Coldplay', 'A Rush of Blood to the Head', 'Rock alternatif', 21, 'web/musiques/elvis-presley-burning-love-testaudio.mp3', 'web/images/Elvis_Separate_Ways.jpg', 320000),
(30, 'Fast Car', 'Tracy Chapman', 'Tracy Chapman', 'Folk', 21, 'web/musiques/elvis-presley-burning-love-testaudio.mp3', 'web/images/Elvis_Separate_Ways.jpg', 320000),
(31, 'Respect', 'Aretha Franklin', 'I Never Loved a Man the Way I Love You', 'R&B Soul', 21, 'web/musiques/elvis-presley-burning-love-testaudio.mp3', 'web/images/Elvis_Separate_Ways.jpg', 320000),
(33, 'Hey Jude ', 'The Beatles', 'Hey Jude', 'Pop Rock', 24, 'web/musiques/john-denver-take-me-home-country-road.mp3', 'web/images/PoemsPrayersAndPromises.jpg', 320000),
(34, 'What d I Say', 'Ray Charles', 'What d I Say', 'Jazz Soul R&B', 24, 'web/musiques/john-denver-take-me-home-country-road.mp3', 'web/images/PoemsPrayersAndPromises.jpg', 320000),
(35, 'Smells Like Teen Spirit', 'Nirvana', 'Nevermind', 'Grunge Rock alternatif', 24, 'web/musiques/john-denver-take-me-home-country-road.mp3', 'web/images/PoemsPrayersAndPromises.jpg', 320000),
(36, 'Cry me a River', 'Justin Timberlake', 'Justified', 'Pop R&B', 24, 'web/musiques/john-denver-take-me-home-country-road.mp3', 'web/images/PoemsPrayersAndPromises.jpg', 320000),
(39, 'Stayin Alive', 'Bee Gees', 'Stayin Alive', 'Disco', 24, 'web/musiques/john-denver-take-me-home-country-road.mp3', 'web/images/PoemsPrayersAndPromises.jpg', 320000);

-- --------------------------------------------------------

--
-- Structure de la table `playlist`
--

CREATE TABLE `playlist` (
  `IDPlaylist` int(11) NOT NULL,
  `IDUtilisateur` int(11) DEFAULT NULL,
  `Duree` int(8) DEFAULT NULL,
  `favori` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `salonprive`
--

CREATE TABLE `salonprive` (
  `IDSalon` int(11) NOT NULL,
  `IDUtilisateur` int(11) NOT NULL,
  `NomSalon` varchar(50) NOT NULL,
  `CodeSalon` int(11) NOT NULL,
  `NombreParticipants` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `IDUtilisateur` int(11) NOT NULL,
  `NomUtilisateur` varchar(100) NOT NULL,
  `MotDePasse` varchar(100) NOT NULL,
  `RoleID` int(11) DEFAULT NULL,
  `Credits` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `historique`
--

CREATE TABLE `historique` (
                              `ordre` int(11) NOT NULL,
                              `IDMusique` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


--
-- Index pour la table `constitutionfile`
--
ALTER TABLE `constitutionfile`
  ADD PRIMARY KEY (`ordre`),
  ADD KEY `FK_consitutionfile_file` (`IDFile`),
  ADD KEY `FK_constituionfile_musique` (`IDMusique`);

--
-- Index pour la table `constitutionplaylist`
--
ALTER TABLE `constitutionplaylist`
  ADD PRIMARY KEY (`IDMusique`,`IDPlaylist`),
  ADD KEY `Playlist` (`IDPlaylist`),
  ADD KEY `Musique` (`IDMusique`);

--
-- Index pour la table `fileattente`
--
ALTER TABLE `fileattente`
  ADD PRIMARY KEY (`IDFile`);

--
-- Index pour la table `musique`
--
ALTER TABLE `musique`
  ADD PRIMARY KEY (`IDMusique`);

--
-- Index pour la table `playlist`
--
ALTER TABLE `playlist`
  ADD PRIMARY KEY (`IDPlaylist`),
  ADD KEY `Utilisateur` (`IDUtilisateur`);

--
-- Index pour la table `salonprive`
--
ALTER TABLE `salonprive`
  ADD PRIMARY KEY (`IDSalon`),
  ADD KEY `Utilisateur` (`IDUtilisateur`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`IDUtilisateur`);


--
-- Index pour la table `historique`
--
ALTER TABLE `historique`
    ADD PRIMARY KEY (`ordre`),
  ADD KEY `FKIDMusique` (`IDMusique`);


--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `constitutionfile`
--
ALTER TABLE `constitutionfile`
  MODIFY `ordre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=256;

--
-- AUTO_INCREMENT pour la table `fileattente`
--
ALTER TABLE `fileattente`
  MODIFY `IDFile` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `musique`
--
ALTER TABLE `musique`
  MODIFY `IDMusique` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `playlist`
--
ALTER TABLE `playlist`
  MODIFY `IDPlaylist` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `salonprive`
--
ALTER TABLE `salonprive`
  MODIFY `IDSalon` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `IDUtilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `historique`
--
ALTER TABLE `historique`
    MODIFY `ordre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `constitutionfile`
--
ALTER TABLE `constitutionfile`
  ADD CONSTRAINT `FK_consitutionfile_file` FOREIGN KEY (`IDFile`) REFERENCES `fileattente` (`IDFile`),
  ADD CONSTRAINT `FK_constituionfile_musique` FOREIGN KEY (`IDMusique`) REFERENCES `musique` (`IDMusique`);

--
-- Contraintes pour la table `constitutionplaylist`
--
ALTER TABLE `constitutionplaylist`
  ADD CONSTRAINT `FK_consitutionplaylist_playlist` FOREIGN KEY (`IDPlaylist`) REFERENCES `playlist` (`IDPlaylist`),
  ADD CONSTRAINT `FK_constituionplaylist_musique` FOREIGN KEY (`IDMusique`) REFERENCES `musique` (`IDMusique`);

--
-- Contraintes pour la table `playlist`
--
ALTER TABLE `playlist`
  ADD CONSTRAINT `FK_playlist_utilisateur` FOREIGN KEY (`IDUtilisateur`) REFERENCES `utilisateur` (`IDUtilisateur`);

--
-- Contraintes pour la table `salonprive`
--
ALTER TABLE `salonprive`
  ADD CONSTRAINT `FK_salonprive_utilisateur` FOREIGN KEY (`IDUtilisateur`) REFERENCES `utilisateur` (`IDUtilisateur`);

--
-- Contraintes pour la table `historique`
--
ALTER TABLE `historique`
    ADD CONSTRAINT `FKIDMusique` FOREIGN KEY (`IDMusique`) REFERENCES `musique` (`IDMusique`);

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
