-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  Dim 29 mars 2020 à 08:52
-- Version du serveur :  10.1.40-MariaDB
-- Version de PHP :  7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `Kino_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `Film`
--

CREATE TABLE `Film` (
  `id` int(11) NOT NULL,
  `name` varchar(20) CHARACTER SET latin1 NOT NULL,
  `beschreibung` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `dauer` int(11) DEFAULT NULL,
  `date_sortie` date DEFAULT NULL,
  `autor` varchar(15) CHARACTER SET latin1 DEFAULT NULL,
  `image` longtext CHARACTER SET latin1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `Film`
--

INSERT INTO `Film` (`id`, `name`, `beschreibung`, `dauer`, `date_sortie`, `autor`, `image`) VALUES
(78, 'Joker', '1981 in Gotham City: Arthur Fleck hat sich geirrt. Sein Dasein ist keine KomÃ¶die, sondern eine Tragoedie...', 122, '2019-10-10', 'Todd Phillips', 'http://localhost/Kino/images/Joker.jpg'),
(82, 'Morbius', 'In MORBIUS verkoerpert Jared Leto eindrucksvoll eine der geheimnisvollsten Figuren im Marvel-Universum.', 96, '2020-10-06', 'Todd Matt Sazam', 'http://localhost/Kino/images/Morbius.jpg'),
(84, 'Peter Hase 2', 'Zweites aufregendes Kinoabenteuer fuer Peter Hase mit Domhnall Gleeson und Rose Byrne.', 80, '2020-07-30', 'Will Gluck', 'http://localhost/Kino/images/Hase.jpg'),
(85, 'Narziss und Goldmund', 'Film von Hermann gleichnamigem Roman ueber die Freundschaft zwischen zwei gegensaetzlichen Maennern.', 118, '2020-03-12', 'Stefan Ruzowit', 'http://localhost/Kino/images/Narziss.jpg'),
(88, 'Night Life', 'Regisseur Simon Verhoeven schickt Elyas MBarek und Palina Rojinski auf das verrueckteste Date aller Zeiten.', 115, '2020-02-13', 'Simon Verhoeven', 'http://localhost/Kino/images/Night.jpg'),
(89, 'Hotel Beograd', 'Die serbische Romantik-Komoedie HOTEL BELGRAD im CinemaxX auf der groÃŸen Leinwand.', 106, '2020-03-19', 'Konstantin Stat', 'http://localhost/Kino/images/Hotel.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `Raum`
--

CREATE TABLE `Raum` (
  `id` int(11) NOT NULL,
  `nummer` int(11) NOT NULL,
  `Film_id` int(11) DEFAULT NULL,
  `kapazitat` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `Raum`
--

INSERT INTO `Raum` (`id`, `nummer`, `Film_id`, `kapazitat`) VALUES
(139, 1, 78, 10),
(140, 2, 82, 10),
(141, 3, 84, 10),
(142, 4, 85, 10),
(145, 5, 88, 10),
(146, 6, 89, 10),
(151, 1, 78, 10),
(152, 1, 78, 10),
(153, 2, 82, 10),
(154, 3, 84, 10),
(155, 4, 85, 10),
(156, 5, 88, 10),
(157, 6, 89, 10);

--
-- Déclencheurs `Raum`
--
DELIMITER $$
CREATE TRIGGER `Update_Raum_Termin` AFTER UPDATE ON `Raum` FOR EACH ROW BEGIN
   IF OLD.Film_id <> new.Film_id THEN
        UPDATE Termin set Film_id = new.Film_id where Raum_id = new.id; 
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `Reservation`
--

CREATE TABLE `Reservation` (
  `id` int(11) NOT NULL,
  `Termin_id` int(11) NOT NULL,
  `User_id` int(11) NOT NULL,
  `Sitz_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déclencheurs `Reservation`
--
DELIMITER $$
CREATE TRIGGER `Sitz_Verfugbarkeit` AFTER DELETE ON `Reservation` FOR EACH ROW BEGIN
    UPDATE SITZ set verfugbar = 1 where id = old.Sitz_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `Sitz`
--

CREATE TABLE `Sitz` (
  `id` int(11) NOT NULL,
  `nummer` int(11) NOT NULL,
  `verfugbar` tinyint(1) NOT NULL,
  `Raum_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `Sitz`
--

INSERT INTO `Sitz` (`id`, `nummer`, `verfugbar`, `Raum_id`) VALUES
(405, 1, 0, 139),
(406, 2, 1, 139),
(407, 3, 1, 139),
(408, 4, 1, 139),
(409, 5, 1, 139),
(410, 6, 1, 139),
(411, 7, 1, 139),
(412, 8, 1, 139),
(413, 9, 1, 139),
(414, 10, 1, 139),
(415, 1, 1, 140),
(416, 2, 1, 140),
(417, 3, 1, 140),
(418, 4, 1, 140),
(419, 5, 1, 140),
(420, 6, 1, 140),
(421, 7, 1, 140),
(422, 8, 1, 140),
(423, 9, 1, 140),
(424, 10, 1, 140),
(425, 1, 1, 141),
(426, 2, 1, 141),
(427, 3, 1, 141),
(428, 4, 1, 141),
(429, 5, 1, 141),
(430, 6, 1, 141),
(431, 7, 1, 141),
(432, 8, 1, 141),
(433, 9, 1, 141),
(434, 10, 1, 141),
(435, 1, 1, 142),
(436, 2, 1, 142),
(437, 3, 1, 142),
(438, 4, 1, 142),
(439, 5, 1, 142),
(440, 6, 1, 142),
(441, 7, 1, 142),
(442, 8, 1, 142),
(443, 9, 1, 142),
(444, 10, 1, 142),
(445, 1, 0, 145),
(446, 2, 1, 145),
(447, 3, 1, 145),
(448, 4, 1, 145),
(449, 5, 1, 145),
(450, 6, 1, 145),
(451, 7, 1, 145),
(452, 8, 1, 145),
(453, 9, 1, 145),
(454, 10, 1, 145),
(455, 1, 1, 146),
(456, 2, 1, 146),
(457, 3, 1, 146),
(458, 4, 1, 146),
(459, 5, 1, 146),
(460, 6, 1, 146),
(461, 7, 1, 146),
(462, 8, 1, 146),
(463, 9, 1, 146),
(464, 10, 1, 146),
(465, 1, 1, 151),
(466, 2, 1, 151),
(467, 3, 1, 151),
(468, 4, 1, 151),
(469, 5, 1, 151),
(470, 6, 1, 151),
(471, 7, 1, 151),
(472, 8, 1, 151),
(473, 9, 1, 151),
(474, 10, 1, 151),
(475, 1, 1, 152),
(476, 2, 1, 152),
(477, 3, 1, 152),
(478, 4, 1, 152),
(479, 5, 1, 152),
(480, 6, 1, 152),
(481, 7, 1, 152),
(482, 8, 1, 152),
(483, 9, 1, 152),
(484, 10, 1, 152),
(485, 1, 1, 153),
(486, 2, 1, 153),
(487, 3, 1, 153),
(488, 4, 1, 153),
(489, 5, 1, 153),
(490, 6, 1, 153),
(491, 7, 1, 153),
(492, 8, 1, 153),
(493, 9, 1, 153),
(494, 10, 1, 153),
(495, 1, 1, 154),
(496, 2, 1, 154),
(497, 3, 1, 154),
(498, 4, 1, 154),
(499, 5, 1, 154),
(500, 6, 1, 154),
(501, 7, 1, 154),
(502, 8, 1, 154),
(503, 9, 1, 154),
(504, 10, 1, 154),
(505, 1, 1, 155),
(506, 2, 1, 155),
(507, 3, 1, 155),
(508, 4, 1, 155),
(509, 5, 1, 155),
(510, 6, 1, 155),
(511, 7, 1, 155),
(512, 8, 1, 155),
(513, 9, 1, 155),
(514, 10, 1, 155),
(515, 1, 1, 156),
(516, 2, 1, 156),
(517, 3, 1, 156),
(518, 4, 1, 156),
(519, 5, 1, 156),
(520, 6, 1, 156),
(521, 7, 1, 156),
(522, 8, 1, 156),
(523, 9, 1, 156),
(524, 10, 1, 156),
(525, 1, 1, 157),
(526, 2, 1, 157),
(527, 3, 1, 157),
(528, 4, 1, 157),
(529, 5, 1, 157),
(530, 6, 1, 157),
(531, 7, 1, 157),
(532, 8, 1, 157),
(533, 9, 1, 157),
(534, 10, 1, 157);

-- --------------------------------------------------------

--
-- Structure de la table `Termin`
--

CREATE TABLE `Termin` (
  `id` int(11) NOT NULL,
  `Film_id` int(11) NOT NULL,
  `Raum_id` int(11) NOT NULL,
  `datum` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `Termin`
--

INSERT INTO `Termin` (`id`, `Film_id`, `Raum_id`, `datum`) VALUES
(127, 78, 139, '2020-04-01 14:30:00'),
(128, 78, 152, '2020-04-01 21:45:00'),
(129, 82, 140, '2020-04-02 14:30:00'),
(130, 82, 153, '2020-04-02 21:45:00'),
(132, 84, 141, '2020-04-01 14:30:00'),
(133, 84, 154, '2020-04-01 21:45:00'),
(134, 85, 155, '2020-04-02 14:30:00'),
(135, 85, 142, '2020-04-02 21:45:00'),
(136, 88, 145, '2020-04-01 14:30:00'),
(137, 88, 156, '2020-04-02 21:45:00'),
(138, 89, 146, '2020-04-03 12:30:00'),
(139, 89, 157, '2020-04-03 22:30:00'),
(140, 78, 151, '2020-04-03 18:45:00');

-- --------------------------------------------------------

--
-- Structure de la table `User`
--

CREATE TABLE `User` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `passwort` varchar(30) NOT NULL,
  `nachname` varchar(15) NOT NULL,
  `vorname` varchar(15) NOT NULL,
  `adresse` varchar(255) DEFAULT NULL,
  `geschlecht` varchar(10) NOT NULL,
  `geburtsdatum` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Film`
--
ALTER TABLE `Film`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Index pour la table `Raum`
--
ALTER TABLE `Raum`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_RFilm` (`Film_id`);

--
-- Index pour la table `Reservation`
--
ALTER TABLE `Reservation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Sitz_id` (`Sitz_id`),
  ADD KEY `FK_ReTermin` (`Termin_id`),
  ADD KEY `FK_ReUser` (`User_id`);

--
-- Index pour la table `Sitz`
--
ALTER TABLE `Sitz`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_Sraum` (`Raum_id`);

--
-- Index pour la table `Termin`
--
ALTER TABLE `Termin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Raum_id` (`Raum_id`,`datum`),
  ADD KEY `FK_TFilm` (`Film_id`);

--
-- Index pour la table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Film`
--
ALTER TABLE `Film`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT pour la table `Raum`
--
ALTER TABLE `Raum`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=158;

--
-- AUTO_INCREMENT pour la table `Reservation`
--
ALTER TABLE `Reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pour la table `Sitz`
--
ALTER TABLE `Sitz`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=535;

--
-- AUTO_INCREMENT pour la table `Termin`
--
ALTER TABLE `Termin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

--
-- AUTO_INCREMENT pour la table `User`
--
ALTER TABLE `User`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Raum`
--
ALTER TABLE `Raum`
  ADD CONSTRAINT `FK_RFilm` FOREIGN KEY (`Film_id`) REFERENCES `Film` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Contraintes pour la table `Reservation`
--
ALTER TABLE `Reservation`
  ADD CONSTRAINT `FK_ReSitz` FOREIGN KEY (`Sitz_id`) REFERENCES `Sitz` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_ReTermin` FOREIGN KEY (`Termin_id`) REFERENCES `Termin` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_ReUser` FOREIGN KEY (`User_id`) REFERENCES `User` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `Sitz`
--
ALTER TABLE `Sitz`
  ADD CONSTRAINT `FK_Sraum` FOREIGN KEY (`Raum_id`) REFERENCES `Raum` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `Termin`
--
ALTER TABLE `Termin`
  ADD CONSTRAINT `FK_TFilm` FOREIGN KEY (`Film_id`) REFERENCES `Film` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_TRaum` FOREIGN KEY (`Raum_id`) REFERENCES `Raum` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
