-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : sam. 27 nov. 2021 à 18:56
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
(1, 'La cinquième vague de l’épidémie de Covid-19 en France oblige le gouvernement à agir', '                    « Le maître du temps, c’est le virus, malheureusement », avait reconnu Emmanuel Macron, en mars. Huit mois plus tard, le scénario se répète, comme une malédiction. Si le Covid-19 n’a jamais véritablement disparu du paysage, le président de la République pensait avoir tenu la question sanitaire à distance grâce à la progression spectaculaire de la vaccination au cours de l’été. Le sujet semblait suffisamment éloigné pour permettre au locataire de l’Elysée de se projeter vers l’élection présidentielle d’avril 2022 en vantant un message positif fait de relance économique, de réindustrialisation et, plus globalement, d’« espérance ».\r\n\r\nLas, à cinq mois du scrutin, le coronavirus, qui a contaminé jusqu’au premier ministre, Jean Castex et à la ministre de l’insertion, Brigitte Klinkert, dicte de nouveau l’agenda sanitaire et politico-médiatique. Mardi 23 novembre, 30 000 nouveaux cas ont été enregistrés lors des dernières vingt-quatre heures – soit un niveau qui n’avait plus été observé depuis le printemps –, et 6 000 classes ont dû être fermées.                ', 6, 0),
(2, 'Covid-19 : Omicron, le nouveau variant, est classé « préoccupant » par l’OMS', 'Selon le groupe d’experts de l’OMS, les données préliminaires suggèrent qu’il existe « un risque accru de réinfection » avec Omicron, par rapport aux autres variants préoccupants.\r\n\r\nDes responsables de l’Union européenne (UE), réunis en urgence pour faire face à la menace, ont recommandé vendredi aux vingt-sept pays de l’UE de suspendre les voyages en provenance de cette région.\r\n\r\n« Les Etats membres se sont entendus pour imposer rapidement des restrictions sur tous les voyages vers l’UE en provenance de sept pays de la région d’Afrique australe : Botswana, Eswatini, Lesotho, Mozambique, Namibie, Afrique du Sud, Zimbabwe », a tweeté Eric Mamer, porte-parole de la Commission européenne. Ces restrictions comprennent une suspension des vols, selon cette recommandation, a précisé un porte-parole.\r\n\r\nLe président américain, Joe Biden, a estimé que l’apparition de ce nouveau variant devait inciter le reste du monde à donner plus de vaccins aux pays plus pauvres. « Les informations sur ce nouveau variant devraient rendre plus évident que jamais le fait que cette pandémie ne prendra pas fin sans vaccinations au niveau mondial. Les Etats-Unis ont déjà donné plus de vaccins à d’autres pays que tous les autres pays additionnés. Il est temps que d’autres pays fassent autant que l’Amérique en termes de rapidité et de générosité », a dit le président américain dans un communiqué.', 6, 0),
(16, 'Ugo (Koh-Lanta) s\'est séparé de son épouse : il révèle avoir retrouvé l\'amour trois mois avant leur divorce', 'Ugo est loin d\'avoir dit son dernier mot dans l\'aventure All Stars de Koh-Lanta ! Tout juste sorti de l\'île des bannis après deux semaines, il est toujours en lice pour remporter les 100 000 euros promis au vainqueur. Mais au-delà de l\'argent, il a surtout acquis la sympathie du public, qui l\'a érigé en nouveau héros du programme animé par Denis Brogniart. Exit Claude Dartois : désormais c\'est lui le chouchou des téléspectateurs. Une popularité qu\'il doit à sa combativité et sa régularité sur les épreuves. Pourtant l\'aventurier avait de quoi être chamboulé durant cette aventure. Juste avant de s\'envoler pour la Polynésie française, il a divorcé de la mère de son fils Lou, âgé de dix ans.\r\n\r\n&quot;J\'ai mis mon fils dans la confidence et tout s\'est bien passé avec sa maman, dont je venais de divorcer avant de partir à Koh-Lanta&quot;, a-t-il révélé dans les colonnes de Télé Star, avant de révéler dans la foulée être de nouveau en couple : &quot;J\'avais aussi confiance en Lisa, ma nouvelle compagne, que j\'avais rencontrée trois mois auparavant.&quot;\r\nUgo en couple avec Lisa\r\n\r\nSi pour certains cette mystérieuse Lisa est une parfaite inconnue, d\'autres la connaissent déjà bien. En effet l\'aventurier de Koh-Lanta s\'est déjà plusieurs fois affiché en sa compagnie sur sa page Instagram. En octobre dernier, tous deux s\'étaient offert une petite escapade en Grèce. Le couple s\'était alors immortalisé plus amoureux que jamais en posant sur une falaise de Santorin.\r\n\r\nEn ce qui concerne son parcours au sein de Koh-Lanta, sur lequel Ugo s\'est également confié au cours de cette interview pour Télé Star, l\'aventurier a avoué devoir grandement sa place à ses &quot;immunités gagnées&quot;. D\'ailleurs il a bien conscience qu\'il commence à être un ennemi redoutable dans l\'esprit de ses concurrents : &quot;Je sais que je commence à faire peur, et pas qu\'à Claude. Je gagne tout, je suis le grain de sable dans la mécanique des garçons.&quot; Sera-t-il sacré champion de cette saison ? Il faudra s\'armer d\'encore un peu de patience avant de le découvrir !', 7, 0);

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
  MODIFY `id` tinyint(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` tinyint(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `Fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
