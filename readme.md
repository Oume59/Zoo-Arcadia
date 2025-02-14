🦁 Projet Arcadia - Gestion d'un Zoo

📖 Présentation du projet

Le projet Arcadia est une application web permettant de gérer un zoo de manière efficace. L'application offre des fonctionnalités pour différents acteurs (visiteurs, vétérinaires et employés) et permet de suivre la santé des animaux, gérer les avis et enregistrer les consommations alimentaires quotidiennes.

🛠️ Technologies utilisées

Langage : PHP (MVC)

Base de données : MySQL (relationnelle) & MongoDB (NoSQL)

Frameworks/Librairies : JavaScript (vanilla), HTML5, CSS3

Hébergement : Heroku

Outils : Git, XAMPP

👥 Rôles et fonctionnalités

🧑‍🤝‍🧑 Visiteurs

Consulter les informations sur les animaux.

Laisser un avis avec pseudo et contenu.

Affichage des avis après validation par un employé.

🩺 Vétérinaires

Ajouter, modifier et supprimer des rapports vétérinaires.

Saisir les détails de l'état de santé, des traitements et des recommandations alimentaires.

🛠️ Employés

Valider ou supprimer les avis des visiteurs.

Enregistrer la consommation alimentaire quotidienne des animaux.

Gérer les services associés au zoo.

🔒 Sécurité et bonnes pratiques

Protection CSRF : Jeton unique pour chaque formulaire.

Validation et nettoyage des données : htmlspecialchars et strip_tags.

Sécurité des cookies : HttpOnly et Secure.

Requêtes SQL sécurisées : Requêtes préparées avec PDO.

⚙️ Installation locale

Cloner le dépôt :

git clone https://github.com/mon_projet_arcadia.git

Configurer les dépendances :

composer install

Configurer la base de données :

Importer le fichier database.sql.

Modifier les paramètres dans le fichier .env.

Lancer l'application :

Lancer XAMPP et démarrer Apache et MySQL.

Accéder à http://localhost/arcadia.

🚀 Déploiement sur Heroku

Connexion à Heroku :

heroku login

Déployer les modifications :

git push heroku main

📈 Améliorations futures

Mise en place d'un système d'authentification renforcé.

Optimisation des performances des requêtes MongoDB.

Ajout de statistiques sur la fréquentation du zoo.

🔔 Auteur : OULD YOUCEF Mélissa - 13/02/2025

🎯 Bon développement !


🦁 Zoo Arcadia - Documentation du projet

🌱 Description du projet

Le Zoo Arcadia, situé en Bretagne, est un acteur majeur de la protection animale et de la sensibilisation écologique. Ce projet a pour but de moderniser sa communication et offrir une expérience immersive et intuitive à ses visiteurs. Une application web a donc été développée dans le but de présenter les animaux, leurs habitats et les services disponibles, tout en mettant en avant les actions écologiques et les valeurs du zoo. Cette application permet aux visiteurs d'accéder à des informations détaillées sur les animaux et leurs habitats, ainsi que sur les horaires, avis et services du zoo. Un espace d'avis permet également aux visiteurs de partager leur expérience, sous modération d'un employé. Le projet intègre (sur dashboard) des fonctionnalités adaptées aux besoins internes : le vétérinaire peut saisir des rapports de santé et des recommandations alimentaires ainsi qu’un avis sur l’état des habitats. L’employé gère les avis, les services, les contacts, les consommations alimentaires quotidiennes des animaux. L'administrateur supervise les comptes utilisateurs, les animaux, les espèces, les habitats, les services et les statistiques. L'interface de l'application adopte un design éco-responsable, reflétant l'engagement écologique d'Arcadia. Ce projet vise ainsi à améliorer l'expérience des visiteurs, à optimiser la gestion interne et à promouvoir les valeurs environnementales du zoo de manière moderne et accessible à tous.

🛠️ Technologies utilisées

Front-end : HTML5, CSS3 (Bootstrap), JavaScript

Back-end : PHP (MVC) 8.2 avec PDO et design pattern Singleton

Base de données : MySQL (AlwaysData) pour les données relationnelles et MongoDB Atlas & Compass pour les données non relationnelles (NoSQL)

Gestion des e-mails : PHPMailer

Variables d'environnement : Dotenv

Conteneurisation : Docker

Déploiement : Heroku

Gestion des dépendances : Composer

Maquettage : Figma, Looping

Gestion de projet : Trello

🎯 Fonctionnalités principales

Visiteurs : Consultation d'informations sur les habitats, services et animaux, contact et soumission d'avis modérés.

DASHBOARD :

Vétérinaire : Rédaction de rapports sur la santé et l'alimentation des animaux et sur l'état des habitats.

Employé : Gestion des avis, des services, gestion de la rubrique contact et enregistrement des rations alimentaires quotidiennes.

Administrateur : Supervision des comptes utilisateurs, gestion des habitats, services, animaux, espèces, horaires et statistiques.

⚙️ Installation et déploiement

1️⃣ Prérequis

PHP 8.2 ou supérieur

MySQL/MongoDB

Composer

Docker

2️⃣ Cloner le dépôt

git clone https://github.com/Oume59/Zoo-Arcadia.git
cd arcadia

3️⃣ Installer les dépendances

composer install

4️⃣ Configurer les variables d'environnement

Créez un fichier .env à la racine avec les éléments nécessaires (exemples) :

DB_HOST=localhost
DB_NAME=ArcadiaZoo
DB_USER=root
DB_PASS=motdepasse
MONGODB_URI=mongodb+srv://utilisateur:motdepasse@cluster.mongodb.net
MONGODB_DB=ARCADIA
SMTP_HOST=smtp.exemple.com
SMTP_USER=utilisateur@exemple.com
SMTP_PASS=motdepasse

5️⃣ Importer la base de données

Pour MySQL :

mysql -u root -p < database.sql

Pour MongoDB :

mongoimport --host localhost --db ARCADIA --collection consultations --file data.json

6️⃣ Lancer l'application localement

Avec Docker :

docker-compose up

Sans Docker :

php -S localhost:8000 -t Public

7️⃣ Déployer sur Heroku

heroku login
heroku create zooarcadia
heroku config:set DB_HOST=... DB_USER=... DB_PASS=...
git add .
git commit -m "Déploiement Heroku"
git push heroku main
heroku open

👥 Contributeurs

Mélissa Ould Youcef, Développeuse Web Full-Stack in Training 🖥️

Merci d'utiliser Arcadia Zoo et de contribuer à la gestion et à la protection des animaux ! 🐾

