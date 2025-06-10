CREATE TABLE `Animals` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `species_id` int(11) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `habitat_id` int(11) DEFAULT NULL
);


INSERT INTO `Animals` (`id`, `name`, `species_id`, `img`, `habitat_id`) VALUES
(6, 'JAVA', 1, 'tigre.jpg', 2),
(7, 'MONTY', 13, 'seprentmarais1.jpg', 3),
(8, 'MONGO', 6, 'bebegorille.jpg', 2),
(9, 'SHELL', 3, 'giraffedesktop.jpg', 1),
(46, 'DOCKER', 2, 'will-shirley-xRKcHoCOA4Y-unsplash.jpg', 1),
(47, 'REACT', 10, 'lionsavane.jpg', 1),
(48, 'GITHUB', 5, 'jaguar.jpg', 2),
(49, 'FIGMA', 9, 'tortuemarais.jpg', 3),
(50, 'NODE', 4, 'flamantmarais.jpg', 3);


CREATE TABLE `Habitats` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `img` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `commentaire` text DEFAULT NULL
);


INSERT INTO `Habitats` (`id`, `name`, `img`, `description`, `commentaire`) VALUES
(1, 'Savane', 'couvsavane.jpg', 'Un vaste espace ouvert où vous rencontrerez des lions majestueux, des girafes gracieuses et des éléphants impressionnants. Ce décor vous transporte dans les plaines africaines avec sa végétation clairsemée et son climat aride. Vous pourrez également y croiser des zèbres, des guépards et des rhinocéros.', 'Rien a signaler concernant l\'état de l\'habitat pour le moment car les animaux se sentent parfaitement bien'),
(2, 'Jungle', 'couvjungle.jpg', 'Une forêt dense et humide qui abrite une variété d\'animaux tropicaux comme les singes, les perroquets et les tigres. La jungle recrée une atmosphère luxuriante, idéale pour les espèces qui prospèrent dans des environnements chauds et humides.  Parmi les autres habitants de la jungle, vous trouverez des léopards, des gorilles, des jaguars et des paresseux.', 'Les conditions de l\'habitat sont idéales pour les animaux tropicaux. L\'humidité et la densité végétale permettent un environnement proche de leur milieu naturel. Aucun problème de santé ou de comportement n\'a été signalé'),
(3, 'Marais', 'croco.jpg', 'Un écosystème aquatique fascinant peuplé d\'animaux semi-aquatiques tels que les crocodiles, les hippopotames et les tortues. Cet habitat est conçu pour refléter les zones humides et marécageuses où vivent ces animaux. Vous pourrez également observer des grenouilles, des ibis, des castors, des loutres et des flamants roses.', 'Le marais offre un milieu parfaitement adapté aux espèces aquatiques et semi-aquatiques. Les animaux montrent des signes de confort et de bonne adaptation. Aucun incident ou anomalie n\'a été détecté');


CREATE TABLE `Roles` (
  `id` int(11) NOT NULL,
  `role` varchar(50) NOT NULL
);


INSERT INTO `Roles` (`id`, `role`) VALUES
(1, 'administrateur'),
(2, 'veterinaire'),
(3, 'employe');


CREATE TABLE `Services` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL
);


INSERT INTO `Services` (`id`, `name`, `description`, `img`, `id_user`) VALUES
(1, 'Restauration', 'Un restaurant est disponible pour l\'ensemble du zoo, offrant des plats bio et locaux, en accord avec les valeurs écologiques du parc. Il se situe au centre du zoo, afin que chaque visiteur puisse s\'y rendre facilement après avoir exploré les habitats.', 'restauzoo.jpg', NULL),
(2, 'Visite guidée des Habitats', 'Participez à une visite guidée gratuite pour découvrir les secrets d\'Arcadia et en apprendre davantage sur les animaux et leurs écosystèmes, guidé par un expert passionné qui saura répondre à toutes vos questions.', 'visite.jpg', NULL),
(3, 'Visite du Zoo en petit train', 'Découvrez le zoo à bord d\'un petit train pour une visite confortable et panoramique. Ce service est proposé à un tarif abordable pour profiter du parc sans se fatiguer.', 'visitetrain.jpg', NULL);


CREATE TABLE `Species` (
  `id` int(11) NOT NULL,
  `species` varchar(50) DEFAULT NULL
);

INSERT INTO `Species` (`id`, `species`) VALUES
(1, 'Tigre du Bengale'),
(2, 'Éléphant d\'Afrique'),
(3, 'Girafe du Niger'),
(4, 'Flamant rose'),
(5, 'Jaguar'),
(6, 'Gorille de l\'Est'),
(7, 'Crocodile du Nil'),
(8, 'Rhinocéros blanc'),
(9, 'Tortue des marais'),
(10, 'Lion d\'Afrique'),
(11, 'Hyène tachetée'),
(12, 'Hippopotame commun'),
(13, 'Python réticulé');


CREATE TABLE `Utilisateurs` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_role` int(11) DEFAULT NULL
);


INSERT INTO `Utilisateurs` (`id`, `username`, `email`, `password`, `id_role`) VALUES
(4, 'jose', 'joseoumearcadia@gmail.com', '$2y$10$L2wyw2m..h2/uXLDB9DBpeu/tCN4NJiULcX97YIgMG8r1Uc70VKj.', 1),
(42, 'Goku', 'gokuveterinairearcadia@gmail.com', '$2y$10$IS.ctCxdgRZivO.AXDg9c.QlW1eUC4jvW8up6QDtcEdeRtxzNoj1O', 2),
(44, 'Bulma', 'bulmaemployearcadia@gmail.com', '$2y$10$fEiG3nVTNuWmP95iVJw9nerNU7d.QrVxw/aduzts1M7ZtDflIM5bK', 3);


CREATE TABLE `Veterinary_report` (
  `id` int(11) NOT NULL,
  `date_report` date DEFAULT curdate(),
  `details` text DEFAULT NULL,
  `health_state` varchar(255) DEFAULT NULL,
  `food` varchar(255) DEFAULT NULL,
  `animal_id` int(11) NOT NULL,
  `daily_food` text DEFAULT NULL,
  `daily_food_date` date DEFAULT NULL,
  `daily_food_time` time DEFAULT NULL
);



INSERT INTO `Veterinary_report` (`id`, `date_report`, `details`, `health_state`, `food`, `animal_id`, `daily_food`, `daily_food_date`, `daily_food_time`) VALUES
(1, '2024-12-11', 'Surveiller que son petit se porte bien ce qui soulagera le stress', 'Stress léger', '7 oignons, 3 bananes, 1 kg de carottes et 750 g de pommes /J', 9, '3 KG de fruits mixtes', '2025-01-08', '09:00:00'),
(2, '2024-12-13', 'JAVA doit bien s\'hydrater', 'Bonne Santé Générale', '3 kg/J de poulet uniquement pour éviter l\'indigestion', 6, '3 KG de poulet pour la journée de JAVA ', '2025-01-09', '10:06:00'),
(3, '2024-12-12', 'La mutation se passe bien', 'Changement de peau', '2 Rats/J', 7, '1 rat gris donné ce matin, 2eme vers 17h', '2025-01-09', '11:07:00'),
(5, '2024-12-13', 'MONGO est en très bonne santé', 'En attente de vaccination', 'Lait de substitution enrichi en calcium  : 500 ml, purée de patate douce : 150 g, Banane : 150 g Papaye : 100 g Mangue : 100 g Raisins secs, 50 g, Feuilles d\'épinard : 200 g Brocoli : 100 g Concombre : 50 g', 8, '250 ml de lait de substitution ce matin (250ml à donner en fin de journée) / 100 g de purée de Mangue / 70 g de concombre / 100 g de banane ', '2025-01-10', '09:00:00'),
(8, '2024-12-25', 'Vérifier l\'absence de parasites sur son pelage et surveiller son activité nocturne', 'Très bonne condition physique', '2 kg de viande de cerf, 500 g de volaille, et 200 g de foie de bœuf /J', 48, '1.5 kg de viande de cerf ce matin, 250 g de volaille / quantité suffisante jusqu\'à 19 h ', '2025-01-11', '09:12:00'),
(9, '2024-12-27', 'Veiller à ce qu\'il reste hydraté en période chaude et vérifier ses interactions sociales avec le groupe', 'Bonne santé générale', '5 kg de viande rouge (zèbre ou bœuf), 1 kg d\'os charnus, et 500 ml d\'eau /J', 47, 'Vérification du bon fonctionnement de la fontaine à eau de l\'enclos OK / 5 kg de viande de boeuf pour la journée et 750 g d\'os charnus ', '2025-01-13', '10:15:00'),
(10, '2024-12-13', 'Surveiller les défenses pour détecter d\'éventuels signes d\'usure ou de fissures', 'Légère fatigue, probablement due aux températures élevées', '30 kg d\'herbes fraîches, 10 kg de branches d\'acacia, et 20 litres d\'eau /J', 46, '30 kg d\'herbes fraîches déposé ce matin / cuve d\'eau à son maximum (100 L) / 8 kg de branches d\'acacia', '2025-01-09', '10:15:00'),
(11, '2025-01-02', 'Observer son comportement pour détecter d\'éventuels signes de stress en cas de surpopulation dans le marais', 'Bonne santé', '500 g de crevettes, 200 g de petits poissons, et 300 g d\'algues aquatiques /J', 50, 'commande d\'algues non réceptionnée donc 650 g de crevettes pour la journée et 350 g de petits poissons', '2025-01-14', '09:20:00'),
(12, '2025-01-04', 'Assurer une eau propre et vérifier la croissance de sa carapace', 'Croissance normale', '300 g de plantes aquatiques, 100 g d\'insectes (larves ou escargots), et 100 g de légumes verts (épinards) /J', 49, '300 g de plantes aquatiques / 100 g de larves et 100 g d\'épinards ', '2025-01-15', '09:30:00');


ALTER TABLE `Animals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `species_id` (`species_id`),
  ADD KEY `fk_habitat_id` (`habitat_id`);


ALTER TABLE `Habitats`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `Roles`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `Services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_services_user` (`id_user`);


ALTER TABLE `Species`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `Utilisateurs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_role` (`id_role`);


ALTER TABLE `Veterinary_report`
  ADD PRIMARY KEY (`id`),
  ADD KEY `animal_id` (`animal_id`);


ALTER TABLE `Animals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;


ALTER TABLE `Habitats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;


ALTER TABLE `Roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;


ALTER TABLE `Services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;


ALTER TABLE `Species`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;


ALTER TABLE `Utilisateurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;


ALTER TABLE `Veterinary_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;


ALTER TABLE `Animals`
  ADD CONSTRAINT `fk_species_id` FOREIGN KEY (`species_id`) REFERENCES `Species` (`id`),
  ADD CONSTRAINT `fk_habitat_id` FOREIGN KEY (`habitat_id`) REFERENCES `Habitats` (`id`);


ALTER TABLE `Utilisateurs`
  ADD CONSTRAINT `Utilisateurs_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `Roles` (`id`);


ALTER TABLE `Veterinary_report`
  ADD CONSTRAINT `Veterinary_report_ibfk_1` FOREIGN KEY (`animal_id`) REFERENCES `Animals` (`id`);
COMMIT;
