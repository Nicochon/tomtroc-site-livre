-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : db
-- Généré le : jeu. 27 juin 2024 à 08:26
-- Version du serveur : 5.6.51
-- Version de PHP : 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `Projet6_Mission`
--
CREATE DATABASE IF NOT EXISTS `Projet6_Mission` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `Projet6_Mission`;

-- --------------------------------------------------------

--
-- Structure de la table `book`
--

CREATE TABLE `book` (
  `id_Book` int(11) NOT NULL,
  `title` text NOT NULL,
  `author` text NOT NULL,
  `owner_Id` int(11) NOT NULL,
  `content` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `book`
--

INSERT INTO `book` (`id_Book`, `title`, `author`, `owner_Id`, `content`, `date`, `status`) VALUES
(29, 'Gargantua ', 'Rabelais', 11, 'François Rabelais a donné naissance au mythe de Gargantua en 1534. Le vrai titre de l’ouvrage est La vie très horrifique du grand Gargantua, père de Pantagruel, jadis composée par M. Alcofribas abstracteur de quintessence.', '2024-03-29 08:46:59', 'Disponible'),
(40, 'Bonjour tristesse', 'Françoise Sagan', 11, 'Bonjour tristesse est le premier roman de Françoise Sagan, publié le 15 mars 1954 alors qu&#039;elle n&#039;a que 18 ans. Cette œuvre connaît un succès de scandale foudroyant et est récompensée du prix des Critiques la même année. Son titre est tiré du deuxième vers du poème « À peine défigurée » du recueil La Vie immédiate de Paul Éluard1.', '2024-03-29 09:01:05', 'Disponible'),
(41, 'Cyrano de Bergerac ', 'Edmond Rostand', 11, 'Cyrano de Bergerac est l&#039;une des pièces les plus populaires du théâtre français, et la plus célèbre de son auteur, Edmond Rostand. Librement inspirée de la vie et de l&#039;œuvre de l&#039;écrivain libertin Savinien de Cyrano de Bergerac (1619-1655), elle est représentée pour la première fois le 28 décembre 18971, au Théâtre de la Porte-Saint-Martin, à Paris2.\r\n\r\nÀ une époque où le drame romantique a disparu au profit de dramaturges qui reprennent les recettes de la comédie dans le vaudeville (les Labiche et Feydeau sont toujours à l&#039;affiche) ou de pionniers du théâtre moderne (Tchekhov, Ibsen, Strindberg), le succès en était si peu assuré qu&#039;Edmond Rostand lui-même, redoutant un échec, se confondit en excuses auprès de l&#039;acteur Coquelin, le jour de la générale. La pièce est pourtant un triomphe, et Rostand reçoit la Légion d&#039;honneur quelques jours plus tard, le 1er janvier 1898.\r\n\r\nLe succès de la pièce ne s&#039;est jamais démenti, en France (où elle est la pièce la plus jouée3) comme à l&#039;étranger. Le personnage de Cyrano est devenu, dans la littérature française, un archétype humain au même titre que Hamlet ou Don Quichotte (auquel il tire son chapeau dans la pièce), au point que ses éléments biographiques inventés pour l&#039;occasion occultent parfois ceux de son modèle historique.', '2024-03-29 09:01:58', 'Indisponnible'),
(42, 'Du côté de chez Swann', 'Marcel Proust', 11, 'Du côté de chez Swann est le premier volume du roman de Marcel Proust, À la recherche du temps perdu. Il est composé de trois parties,', '2024-03-29 09:06:02', 'Disponible'),
(45, 'Madame Bovary', 'Gustave Flaubert', 12, 'Madame Bovary. Mœurs de province, couramment abrégé en Madame Bovary, est un roman de Gustave Flaubert paru en 1857 chez Michel Lévy frères, après une préparution en 1856 dans la Revue de Paris. Il s&#039;agit d&#039;une œuvre majeure de la littérature française. L&#039;histoire est celle de l&#039;épouse d&#039;un médecin de province, Emma Bovary, qui lie des relations adultères et vit au-dessus de ses moyens, essayant ainsi d&#039;éviter l’ennui, la banalité et la médiocrité de la vie provinciale.\r\n\r\nÀ sa parution, le roman fut attaqué par le procureur de Paris du Second Empire pour immoralité et obscénité. Le procès de Flaubert, commencé en janvier 1857, fit connaître l’histoire en France. Après l&#039;acquittement de l&#039;auteur le 7 février 1857, le roman fut édité en deux volumes le 15 avril 1857 chez Michel Lévy frères. La première édition de 6 750 exemplaires fut un succès instantané : elle fut vendue en deux mois. Il est considéré comme l&#039;un des premiers exemples d&#039;un roman réaliste.', '2024-03-29 09:10:52', 'Indisponible'),
(46, 'Le Petit Prince', 'Antoine de Saint-Exupéry', 12, 'Le Petit Prince est une œuvre de langue française, la plus connue d&#039;Antoine de Saint-Exupéry. Publié en 1943 à New York simultanément à sa traduction anglaise1, c&#039;est une œuvre poétique et philosophique sous l&#039;apparence d&#039;un conte pour enfants.\r\n\r\nTraduit en cinq cent trente-cinq langues et dialectes différents2, Le Petit Prince est l&#039;ouvrage le plus traduit au monde après la Bible3.\r\n\r\nLe langage, simple et dépouillé, parce qu&#039;il est destiné à être compris par des enfants, est en réalité pour le narrateur le véhicule privilégié d&#039;une conception symbolique de la vie. Chaque chapitre relate une rencontre du petit prince qui laisse celui-ci perplexe, par rapport aux comportements absurdes des « grandes personnes ». Ces différentes rencontres peuvent être lues comme une allégorie.\r\n\r\nLes aquarelles font partie du texte4 et participent à cette pureté du langage : dépouillement et profondeur sont les qualités maîtresses de l&#039;œuvre.\r\n\r\nOn peut y lire une invitation de l&#039;auteur à retrouver l&#039;enfant en soi, car « toutes les grandes personnes ont d&#039;abord été des enfants. (Mais peu d&#039;entre elles s&#039;en souviennent.) ». L&#039;ouvrage est dédié à Léon Werth, mais « quand il était petit garçon ».', '2024-03-29 09:11:26', 'Disponible'),
(47, 'Vingt Mille Lieues sous les mers', 'Jules Verne', 13, 'Vingt Mille Lieues sous les mers est un roman d&#039;aventures de Jules Verne, paru en 1869-1870. Il relate le voyage de trois naufragés capturés par le capitaine Nemo, mystérieux inventeur qui parcourt les fonds des mers à bord du Nautilus, un sous-marin très en avance sur les technologies de l&#039;époque.\r\n\r\nIl est l&#039;un des dix livres les plus traduits au monde (174 langues d&#039;après certaines sources1,2). La recherche officielle comptabilise (chiffres de 2005), 57 langues3. Il a fait l&#039;objet de nombreuses adaptations que ce soit, entre autres, au cinéma, à la télévision ou en bande dessinée.', '2024-03-29 10:03:06', 'Disponible'),
(48, 'Voyage au bout de la nuit', 'Louis-Ferdinand Céline', 11, 'Voyage au bout de la nuit est le premier roman de Louis-Ferdinand Céline, publié le 15 octobre 1932. Avec ce livre, l&#039;auteur obtient le prix Renaudot, manquant de deux voix le prix Goncourt1. Il constitue une œuvre devenue classique du xxe siècle, traduite en 37 langues2.\r\n\r\nLe titre dérive d&#039;un couplet d&#039;une chanson chantée par l&#039;officier suisse Thomas Legler : «  Notre vie est un voyage / Dans l&#039;Hiver et dans la Nuit / Nous cherchons notre passage / Dans le Ciel où rien ne luit », datée de 1793 et placée à l&#039;exergue du roman3, alors qu&#039;il était au service de Napoléon Bonaparte, pendant la Bataille de la Bérézina.\r\n\r\nLe roman est notamment célèbre pour son style, imité de la langue parlée et teinté d&#039;argot, qui a largement influencé la littérature française contemporaine. Il s&#039;inspire principalement de l&#039;expérience personnelle de Céline à travers son personnage principal Ferdinand Bardamu, double littéraire de l&#039;auteur. Louis-Ferdinand Céline a participé à la Première Guerre mondiale en 1914 et celle-ci lui a révélé l&#039;absurdité du monde. Il qualifie la guerre d&#039;« abattoir international en folie »4 et expose ce qui est pour lui la seule façon raisonnable de résister à une telle folie : la lâcheté. Il est hostile à toute forme d&#039;héroïsme, celui-là même qui va de pair avec la violence et la guerre. Pour lui, cette dernière met en évidence la pourriture du monde, qui est un thème récurrent du roman.\r\n\r\nNéanmoins, Voyage au bout de la nuit constitue bien plus qu&#039;une simple critique de la guerre. C&#039;est à l&#039;égard de l&#039;humanité entière que le narrateur exprime sa perplexité et son mépris : braves ou lâches, colonisateurs ou colonisés, Blancs ou Noirs, Américains ou Européens, pauvres ou riches. Céline n&#039;épargne véritablement personne dans sa vision désespérée et, pour son personnage principal, rien ne semble avoir finalement d&#039;importance face au caractère dérisoire du monde où tout se termine inéluctablement de la même façon. On peut y voir une réflexion nihiliste.', '2024-03-29 10:28:30', 'Indisponible'),
(60, 'Le petit prince', 'Antoine de Saint-Exupéry', 11, 'Le Petit Prince est une œuvre de langue française, la plus connue d&#039;Antoine de Saint-Exupéry. Publié en 1943 à New York simultanément à sa traduction anglaise1, c&#039;est une œuvre poétique et philosophique sous l&#039;apparence d&#039;un conte pour enfants.\r\n\r\nTraduit en cinq cent trente-cinq langues et dialectes différents2, Le Petit Prince est l&#039;ouvrage le plus traduit au monde après la Bible3.\r\n\r\nLe langage, simple et dépouillé, parce qu&#039;il est destiné à être compris par des enfants, est en réalité pour le narrateur le véhicule privilégié d&#039;une conception symbolique de la vie. Chaque chapitre relate une rencontre du petit prince qui laisse celui-ci perplexe, par rapport aux comportements absurdes des « grandes personnes ». Ces différentes rencontres peuvent être lues comme une allégorie.\r\n\r\nLes aquarelles font partie du texte4 et participent à cette pureté du langage : dépouillement et profondeur sont les qualités maîtresses de l&#039;œuvre.', '2024-04-11 10:14:30', 'Disponible');

-- --------------------------------------------------------

--
-- Structure de la table `conversations`
--

CREATE TABLE `conversations` (
  `id_conversation` int(11) NOT NULL,
  `id_sender` int(11) NOT NULL,
  `id_recipient` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `conversations`
--

INSERT INTO `conversations` (`id_conversation`, `id_sender`, `id_recipient`, `date`) VALUES
(3, 11, 14, '2024-06-13 10:50:18'),
(8, 13, 11, '2024-06-06 13:51:39'),
(9, 11, 12, '2024-06-06 13:51:48');

-- --------------------------------------------------------

--
-- Structure de la table `img`
--

CREATE TABLE `img` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `owner_Id` int(11) NOT NULL,
  `type` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `img`
--

INSERT INTO `img` (`id`, `name`, `owner_Id`, `type`) VALUES
(56, '56_photoBook.jpg', 40, 'book'),
(57, '57_photoBook.jpg', 41, 'book'),
(58, '58_photoBook.jpg', 42, 'book'),
(63, '63_photoBook.jpg', 46, 'book'),
(64, '64_photoAdmin.jpg', 13, 'admin'),
(65, '65_photoBook.jpg', 47, 'book'),
(66, '66_photoBook.jpg', 48, 'book'),
(148, '148_photoBook.jpg', 49, 'book'),
(186, '186_photoAdmin.jpeg', 12, 'admin'),
(196, '196_photoAdmin.jpg', 45, 'book'),
(202, '202_photoBook.jpg', 60, 'book'),
(244, '239_photoAdmin.jpg', 29, 'book'),
(251, '251_photoAdmin.jpg', 11, 'admin'),
(254, '252_photoAdmin.jpg', 14, 'admin');

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `id_message` int(11) NOT NULL,
  `content` text NOT NULL,
  `id_owner` int(11) NOT NULL,
  `id_recipient` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_conversation` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`id_message`, `content`, `id_owner`, `id_recipient`, `date`, `id_conversation`) VALUES
(1, 'bonjour romain', 11, 14, '2024-05-02 07:12:41', 3),
(3, 'bonjour nicolas', 13, 11, '2024-05-02 07:13:37', 8),
(4, 'bonjour ca va ?', 14, 11, '2024-05-02 07:35:41', 3),
(5, 'ca va et toi ?', 11, 14, '2024-05-02 14:17:01', 3),
(6, 'tu fais quoi demain ?', 11, 14, '2024-05-02 14:20:45', 3),
(7, 'rien de spécial', 14, 11, '2024-05-02 14:24:07', 3),
(10, 'salut tata', 11, 13, '2024-05-02 14:26:08', 8),
(13, 'test', 11, 14, '2024-05-03 06:19:28', 3),
(15, 'ca va ?', 11, 13, '2024-05-03 06:20:52', 8),
(22, 'test', 11, 14, '2024-05-03 09:55:58', 3),
(24, 'test', 11, 14, '2024-05-03 10:22:51', 3),
(25, 'test', 11, 14, '2024-05-07 11:04:50', 3),
(26, 'test2', 11, 14, '2024-05-07 11:04:59', 3),
(27, 'bonjour', 11, 12, '2024-05-07 11:05:50', 9),
(28, 'bien recu', 14, 11, '2024-05-07 11:06:43', 3),
(29, 'bonjour', 11, 14, '2024-05-30 14:17:46', 3),
(30, 'test', 11, 14, '2024-06-06 13:50:38', 3),
(31, 'test', 11, 14, '2024-06-06 13:50:57', 3),
(32, 'test', 11, 14, '2024-06-06 13:51:08', 3),
(33, 'test', 11, 14, '2024-06-06 13:51:15', 3),
(34, 'test', 11, 13, '2024-06-06 13:51:39', 8),
(35, 'test', 11, 12, '2024-06-06 13:51:48', 9),
(36, 'test', 11, 14, '2024-06-06 13:53:40', 3),
(37, 'test', 11, 14, '2024-06-13 08:21:39', 3),
(38, 'toto', 11, 14, '2024-06-13 10:50:18', 3);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `pseudo` text NOT NULL,
  `password` text NOT NULL,
  `email` text NOT NULL,
  `dateUser` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `pseudo`, `password`, `email`, `dateUser`) VALUES
(10, 'NicolasRivier', '$2y$10$pflOtQm4aNfu7jSf4tP7TOZrhdn6TFx2C4rUdXk6XYCbhcgKa5j8a', 'n.rivier@algo-factory', '2024-03-14 10:21:19'),
(11, 'Nicolas', '$2y$10$PcZ.Xa8d8ZbznPk7v7dVded3bG4SRG6CKzsK0oduDQa3gLX5i69aW', 'n.rivier@algo-factory.com', '2024-03-21 07:24:08'),
(12, 'fred', '$2y$10$sdehj0E//zF2PS9dtTF8aOec6dLIpwwQl60br9cBtwUtKriiNEpYe', 'f.bonain@algo-factory.com', '2024-03-21 10:29:06'),
(13, 'tata', '$2y$10$WneNQxJ0Supxu39HGPNwuOhZ5D/lsDjdnI6MN4SHecTANYxc7sdie', 'tata@toto.com', '2024-03-28 09:04:37'),
(14, 'romain', '$2y$10$6I4FStv6nsrxP1GXYq5aeulRa1dbT/.sWQw2WragyLC.kQ6XWV9xi', 'romain@romain.com', '2024-03-29 10:04:49'),
(15, 'Laurent', '$2y$10$NDn1nZrJKlc.jj5gAcxv3.cz0f7i3dSwdPEYosLLV4At5A8XPfA4K', 'l.paganin@algo-factory.com', '2024-05-30 14:06:10');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id_Book`);

--
-- Index pour la table `conversations`
--
ALTER TABLE `conversations`
  ADD PRIMARY KEY (`id_conversation`);

--
-- Index pour la table `img`
--
ALTER TABLE `img`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id_message`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `book`
--
ALTER TABLE `book`
  MODIFY `id_Book` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT pour la table `conversations`
--
ALTER TABLE `conversations`
  MODIFY `id_conversation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `img`
--
ALTER TABLE `img`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=255;

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `id_message` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
