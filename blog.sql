-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : mer. 01 déc. 2021 à 21:31
-- Version du serveur :  5.7.34
-- Version de PHP : 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `blog`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `id` tinyint(3) NOT NULL,
  `title` varchar(535) NOT NULL,
  `content` text NOT NULL,
  `user_id` tinyint(3) NOT NULL,
  `is_deleted` tinyint(4) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id`, `title`, `content`, `user_id`, `is_deleted`) VALUES
(2, 'Covid-19 : Omicron, le nouveau variant, est classé « préoccupant » par l’OMS', 'Selon le groupe d’experts de l’OMS, les données préliminaires suggèrent qu’il existe « un risque accru de réinfection » avec Omicron, par rapport aux autres variants préoccupants.\r\n\r\nDes responsables de l’Union européenne (UE), réunis en urgence pour faire face à la menace, ont recommandé vendredi aux vingt-sept pays de l’UE de suspendre les voyages en provenance de cette région.\r\n\r\n« Les Etats membres se sont entendus pour imposer rapidement des restrictions sur tous les voyages vers l’UE en provenance de sept pays de la région d’Afrique australe : Botswana, Eswatini, Lesotho, Mozambique, Namibie, Afrique du Sud, Zimbabwe », a tweeté Eric Mamer, porte-parole de la Commission européenne. Ces restrictions comprennent une suspension des vols, selon cette recommandation, a précisé un porte-parole.\r\n\r\nLe président américain, Joe Biden, a estimé que l’apparition de ce nouveau variant devait inciter le reste du monde à donner plus de vaccins aux pays plus pauvres. « Les informations sur ce nouveau variant devraient rendre plus évident que jamais le fait que cette pandémie ne prendra pas fin sans vaccinations au niveau mondial. Les Etats-Unis ont déjà donné plus de vaccins à d’autres pays que tous les autres pays additionnés. Il est temps que d’autres pays fassent autant que l’Amérique en termes de rapidité et de générosité », a dit le président américain dans un communiqué.', 6, 0);

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id` tinyint(3) NOT NULL,
  `label` varchar(100) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id`, `label`, `is_deleted`) VALUES
(1, 'Avengers', 0),
(2, 'Méchants', 0),
(3, 'Héros', 0);

-- --------------------------------------------------------

--
-- Structure de la table `categorie_article`
--

CREATE TABLE `categorie_article` (
  `id` tinyint(3) NOT NULL,
  `categorie_id` tinyint(3) NOT NULL,
  `article_id` tinyint(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` tinyint(3) NOT NULL,
  `pseudo` varchar(20) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `accepted` tinyint(1) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `pseudo`, `email`, `password`, `accepted`, `is_deleted`) VALUES
(6, 'lory', 'lory@lory.fr', '$2y$10$/Dro9cXNpKv8m5h.11K0H.uYmJofQEFEoYkrMNEivGMa875BFAB4W', 1, 0),
(7, 'Arthur', 'arthur@arthur.fr', '$2y$10$4Vm.7FGHV1QjHqMt.YjDxOrmELPPqC9Jfs90ogO5uD.XqQJOvert.', 1, 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Fk_user_id` (`user_id`);

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `label` (`label`);

--
-- Index pour la table `categorie_article`
--
ALTER TABLE `categorie_article`
  ADD PRIMARY KEY (`id`,`categorie_id`,`article_id`),
  ADD KEY `fk_c_a_article` (`article_id`),
  ADD KEY `fk_c_a_categorie` (`categorie_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `pseudo` (`pseudo`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `id` tinyint(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id` tinyint(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `categorie_article`
--
ALTER TABLE `categorie_article`
  MODIFY `id` tinyint(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` tinyint(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
