# EcfZooArcadia - Installation et Déploiement avec Docker

## 📌 Présentation

EcfZooArcadia est un projet web qui utilise Docker pour la gestion des services PHP, MySQL et phpMyAdmin.

🚀 Installation en local

## 1️⃣ Prérequis

Assurez-vous d'avoir installé :

Docker Desktop

Git

## 2️⃣ Récupération du projet

Clonez le dépôt GitHub en local :

 git clone https://github.com/VOTRE-UTILISATEUR/EcfZooArcadia.git
 cd EcfZooArcadia

## 3️⃣ Lancement des conteneurs

Exécutez la commande suivante pour construire et démarrer les conteneurs :

 docker-compose up -d --build

Vérifiez que les conteneurs tournent bien :

 docker ps -a

## 4️⃣ Accès aux services

🌐 Site Web : http://localhost:8087

🛠 phpMyAdmin : http://localhost:8088

### 📂 Importation de la base de données

Si vous avez un fichier de sauvegarde zoo_arcadia.sql, importez-le avec :

docker exec -i ecfzooarcadia_v.1.0.0_mysql mysql -u root -pZ00_Arcadia!2024 zoo_arcadia < zoo_arcadia.sql

Ou via phpMyAdmin :

Aller sur http://localhost:8088

Se connecter :

Serveur : ecfzooarcadia_v.1.0.0_mysql

Utilisateur : utilisateur_zoo

Mot de passe : Z00_Arcadia!2024  (!la touche Z plus zéro du clavier numérique)

Sélectionner la base zoo_arcadia

Importer le fichier backup/zoo_arcadia.sql

### 🔑 Connexion aux comptes utilisateurs

Essayer ces identifiants dans l’espace admin/employé :

Admin

Email : admin@example.com

Mot de passe : José!2024

Employé

Email : employe@example.com

Mot de passe : Martin!2024

Vétérinaire

Email : veterinaire@example.com

Mot de passe : vet123

🛑 Arrêter et supprimer les conteneurs

Pour arrêter les services :

 docker-compose down

Pour reconstruire les conteneurs après modification du docker-compose.yml :

 docker-compose up -d --build

✨ Informations supplémentaires

Base de données : MySQL 5.7

Serveur Web : Apache + PHP 8.1

Gestion via Docker Compose

📢 Auteur

Projet réalisé par [Giet Franck].

## Contribuer

📌 Contributions
Le projet Zoo-Arcadia est un travail collaboratif. Si vous souhaitez contribuer, veuillez suivre les étapes ci-dessous pour assurer une gestion harmonieuse du projet.
Si vous souhaitez contribuer à ce projet, voici les étapes à suivre :

1. Forkez ce dépôt.
2. Créez une branche pour votre fonctionnalité (`git checkout -b feature/nom-fonctionnalité`).
3. Commitez vos changements (`git commit -am 'Ajout de nouvelle fonctionnalité'`).
4. Poussez votre branche (`git push origin feature/nom-fonctionnalité`).
5. Soumettez une pull request pour que vos changements soient révisés et intégrés.
