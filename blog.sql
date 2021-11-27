CREATE TABLE `article` (
  `id` tinyint(3) NOT NULL,
  `title` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `user_id` tinyint(3) NOT NULL,
  `is_deleted` tinyint(4) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



INSERT INTO `article` (`id`, `title`, `content`, `user_id`, `is_deleted`) VALUES
(1, 'La cinquième vague de l’épidémie de Covid-19 en France oblige le gouvernement à agir', '                    « Le maître du temps, c’est le virus, malheureusement », avait reconnu Emmanuel Macron, en mars. Huit mois plus tard, le scénario se répète, comme une malédiction. Si le Covid-19 n’a jamais véritablement disparu du paysage, le président de la République pensait avoir tenu la question sanitaire à distance grâce à la progression spectaculaire de la vaccination au cours de l’été. Le sujet semblait suffisamment éloigné pour permettre au locataire de l’Elysée de se projeter vers l’élection présidentielle d’avril 2022 en vantant un message positif fait de relance économique, de réindustrialisation et, plus globalement, d’« espérance ».\r\n\r\nLas, à cinq mois du scrutin, le coronavirus, qui a contaminé jusqu’au premier ministre, Jean Castex et à la ministre de l’insertion, Brigitte Klinkert, dicte de nouveau l’agenda sanitaire et politico-médiatique. Mardi 23 novembre, 30 000 nouveaux cas ont été enregistrés lors des dernières vingt-quatre heures – soit un niveau qui n’avait plus été observé depuis le printemps –, et 6 000 classes ont dû être fermées.                ', 6, 0),
(2, 'Covid-19 : Omicron, le nouveau variant, est classé « préoccupant » par l’OMS', 'Selon le groupe d’experts de l’OMS, les données préliminaires suggèrent qu’il existe « un risque accru de réinfection » avec Omicron, par rapport aux autres variants préoccupants.\r\n\r\nDes responsables de l’Union européenne (UE), réunis en urgence pour faire face à la menace, ont recommandé vendredi aux vingt-sept pays de l’UE de suspendre les voyages en provenance de cette région.\r\n\r\n« Les Etats membres se sont entendus pour imposer rapidement des restrictions sur tous les voyages vers l’UE en provenance de sept pays de la région d’Afrique australe : Botswana, Eswatini, Lesotho, Mozambique, Namibie, Afrique du Sud, Zimbabwe », a tweeté Eric Mamer, porte-parole de la Commission européenne. Ces restrictions comprennent une suspension des vols, selon cette recommandation, a précisé un porte-parole.\r\n\r\nLe président américain, Joe Biden, a estimé que l’apparition de ce nouveau variant devait inciter le reste du monde à donner plus de vaccins aux pays plus pauvres. « Les informations sur ce nouveau variant devraient rendre plus évident que jamais le fait que cette pandémie ne prendra pas fin sans vaccinations au niveau mondial. Les Etats-Unis ont déjà donné plus de vaccins à d’autres pays que tous les autres pays additionnés. Il est temps que d’autres pays fassent autant que l’Amérique en termes de rapidité et de générosité », a dit le président américain dans un communiqué.', 6, 0);



CREATE TABLE `categorie` (
  `id` tinyint(3) NOT NULL,
  `label` varchar(100) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



INSERT INTO `categorie` (`id`, `label`, `is_deleted`) VALUES
(0, 'Héros', 0),
(1, 'Avengers', 0),
(2, 'Méchants', 0);



CREATE TABLE `user` (
  `id` tinyint(3) NOT NULL,
  `pseudo` varchar(20) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `accepted` tinyint(1) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



INSERT INTO `user` (`id`, `pseudo`, `email`, `password`, `accepted`, `is_deleted`) VALUES
(6, 'lory', 'lory@lory.fr', '$2y$10$/Dro9cXNpKv8m5h.11K0H.uYmJofQEFEoYkrMNEivGMa875BFAB4W', 1, 0);


ALTER TABLE `article`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Fk_user_id` (`user_id`);


ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `label` (`label`);


ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `pseudo` (`pseudo`);



ALTER TABLE `article`
  MODIFY `id` tinyint(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;


ALTER TABLE `user`
  MODIFY `id` tinyint(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;


ALTER TABLE `article`
  ADD CONSTRAINT `Fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);