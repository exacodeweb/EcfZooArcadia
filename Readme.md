📌 Introduction au Projet Zoo-Arcadia
1️⃣ Présentation du Projet 📌

Brève présentation du projet :
"Zoo-Arcadia est une plateforme numérique dédiée à la gestion d’un zoo, permettant de suivre les animaux, les employés et les visiteurs."

2️⃣ Description du Projet 🔍

Objectifs du projet (ex. améliorer la gestion des animaux, des enclos, du personnel...)

Technologies utilisées (PHP, MySQL, Docker, PHPMyAdmin...)

Explication du besoin : pourquoi ce projet ?

3️⃣ Fonctionnalités du Projet ⚙️

Gestion des animaux (ajout, modification, suivi des soins)

Gestion des enclos et habitats

Gestion des employés et plannings

Statistiques sur les visiteurs et les revenus

Interface d’administration


📌 Guide détaillé pour installer et configurer le projet sur Docker avec MySQL et PHPMyAdmin
Ce guide explique comment installer, configurer et exécuter le projet sur Docker, tout en résolvant les erreurs liées aux extensions PHP et à l'accès à la base de données.

🔹 1️⃣ Prérequis : Ce qu'il faut avant de commencer
Avant de commencer l’installation et la configuration du projet, assurez-vous d’avoir les outils suivants installés sur votre machine.

✅ 1. Installer Docker Desktop
Docker est un outil de virtualisation permettant d’exécuter des applications dans des conteneurs. Il est essentiel pour faire tourner l’environnement du projet.

Installation :

Téléchargez Docker Desktop depuis le site officiel : https://www.docker.com/products/docker-desktop

Installez-le en suivant les instructions adaptées à votre système d’exploitation (Windows, macOS, Linux).

Vérifiez que Docker fonctionne en ouvrant un terminal et en tapant :

sh Commende
Copier
Modifier
docker --version
Si tout est bien installé, vous devriez voir la version de Docker affichée.

✅ 2. Installer Git
Git est un outil de gestion de versions permettant de cloner le projet depuis GitHub.

Installation :

Téléchargez et installez Git depuis https://git-scm.com/downloads.

Vérifiez l’installation en tapant dans un terminal :

sh Commende
Copier
Modifier
git --version
Si Git est installé, la version s'affichera.

✅ 3. Avoir un compte GitHub et l'accès au dépôt
Le projet est hébergé sur GitHub. Vous devez :

Créer un compte si vous n’en avez pas : https://github.com/

Demander l’accès au dépôt du projet (si privé).

✅ 4. Installer un éditeur de code
Un éditeur de code est nécessaire pour modifier et configurer le projet. Voici quelques options recommandées :

VS Code (recommandé) : https://code.visualstudio.com/

PHPStorm (payant, mais puissant) : https://www.jetbrains.com/phpstorm/

Notepad++ (léger et gratuit) : https://notepad-plus-plus.org/downloads/

🔹 Résumé des étapes
✅ Avoir installé Docker Desktop sur l'ordinateur.
✅ Avoir installé Git (pour cloner le projet depuis GitHub).
✅ Avoir un compte GitHub et l'accès au dépôt du projet.
✅ Disposer d’un éditeur de code (ex : VS Code, PHPStorm, Notepad++...).


🔹 2️⃣ Cloner le projet GitHub sur l'ordinateur

📍 A. Ouvrir PowerShell et aller dans le disque D:
powershell Commende
Copier
Modifier
cd D:

📍 B. Créer un dossier pour le projet
powershell Commende
Copier
Modifier
mkdir zoo-arcadia
cd zoo-arcadia

📍 C. Cloner le dépôt GitHub
powershell Commende
Copier
Modifier
git clone https://github.com/ton-utilisateur/nom-du-repo.git
(Remplace ton-utilisateur et nom-du-repo par les bons noms.)

📍 D. Aller dans le dossier cloné
powershell Commende
Copier
Modifier
cd nom-du-repo

🔹 3️⃣ Vérifier et Installer les extensions PHP manquantes
📍 A. Vérifier les extensions PDO et MySQLi
Se connecter au conteneur Apache :

powershell Commende
Copier
Modifier
docker exec -it ecfzooarcadia_v01_apache bash
Puis exécuter :

bash Commende
Copier
Modifier
php -m | grep pdo_mysql
php -m | grep mysqli
Si ces extensions ne sont pas listées, il faut les ajouter dans le Dockerfile.

📍 B. Modifier le Dockerfile
Dans le fichier Dockerfile, ajouter cette ligne :

dockerfile
Copier
Modifier ajouter
RUN docker-php-ext-install pdo pdo_mysql mysqli
📍 C. Reconstruire l’image Docker
Après la modification du Dockerfile, exécuter :

powershell Commende
Copier
Modifier
docker-compose up --build -d
Puis revérifier avec :

powershell Commende
Copier
Modifier
docker exec -it ecfzooarcadia_v01_apache bash
php -m | grep PDO
php -m | grep pdo_mysql

🔹 4️⃣ Configuration de la base de données MySQL
📍 A. Vérifier la connexion MySQL
Se connecter au conteneur MySQL :

powershell Commende
Copier
Modifier
docker exec -it ecfzooarcadia_v01_mysql bash
mysql -u root -p
(Le mot de passe root est G1i9e6t3 selon ta config.)

📍 B. Créer un utilisateur MySQL et lui donner les accès
Si l’utilisateur utilisateur_zoo n’existe pas ou pose problème, exécuter :

sql Commende
Copier
Modifier
DROP USER IF EXISTS 'utilisateur_zoo'@'%'; 
CREATE USER 'utilisateur_zoo'@'%' IDENTIFIED BY 'Z00_Arcadia!2024';
GRANT ALL PRIVILEGES ON zoo_arcadia.* TO 'utilisateur_zoo'@'%';
FLUSH PRIVILEGES;
Puis quitter MySQL :

sql Commende
Copier
Modifier
EXIT;

🔹 5️⃣ Importer la base de données
📍 A. Ouvrir PHPMyAdmin
Lancer PHPMyAdmin en accédant à l’URL :

bash Commende
Copier
Modifier
http://localhost:8086/index.php
📍 B. Se connecter
Utilisateur : utilisateur_zoo

Mot de passe : Z00_Arcadia!2024

📍 C. Importer la base
Aller dans l'onglet Importation.

Sélectionner le fichier zoo_arcadia.sql.

Lancer l'importation.

Vérifier que la base zoo_arcadia est bien importée avec :

sql Commende
Copier
Modifier
SHOW DATABASES;

<!------------------------------------------->
📍 D. Vérifier que la base de données a été correctement importée avec PHPMyAdmin
Une fois l'importation terminée, vous pouvez vérifier que la base de données zoo_arcadia a bien été importée.
Dans PHPMyAdmin, ouvrez l'onglet Bases de données pour vérifier que la base de données apparaît bien dans la liste. Vous pouvez également exécuter la commande suivante dans l'onglet SQL pour lister toutes les bases de données :

//sql Commende
//Copier
//Modifier
//SHOW DATABASES;
//Si zoo_arcadia est présente dans la liste, cela signifie que l'importation a réussi.


📍 E. Vérification de l'importation de la base de données en ligne de commande
Si vous préférez utiliser la ligne de commande pour vérifier l'importation, voici les étapes à suivre :

Se connecter au conteneur MySQL :
Exécutez la commande suivante dans PowerShell ou le terminal pour vous connecter au conteneur MySQL :

bash Commende

docker exec -it ecfzooarcadia_v01_mysql bash
Se connecter à MySQL :
Ensuite, connectez-vous à MySQL avec la commande suivante. Il vous sera demandé de fournir le mot de passe (G1i9e6t3) :

bash Commende

mysql -u root -p
Vérifier les bases de données :
Une fois connecté à MySQL, exécutez la commande suivante pour lister toutes les bases de données :

sql Commende

SHOW DATABASES;
La base zoo_arcadia devrait apparaître dans la liste. Si elle y est, l'importation a été un succès.

Quitter MySQL et le conteneur :
Après avoir vérifié que la base est bien présente, quittez MySQL en exécutant :

sql Commende
EXIT;
Et pour quitter le conteneur, tapez :

bash Commende
exit

<!------------------------------------------->

🔹 6️⃣ Vérifier et ajuster la configuration du projet
📍 A. Modifier le fichier config/config.php
S’assurer que les identifiants de connexion à la base sont corrects :

- php Commende

define('DB_HOST', 'db'); 
define('DB_NAME', 'zoo_arcadia');
define('DB_USER', 'utilisateur_zoo');
define('DB_PASS', 'Z00_Arcadia!2024');
📍 B. Vérifier docker-compose.yml
Vérifier que MySQL est bien configuré :

- yaml Commende

services:
  mysql:
    image: mysql:5.7
    container_name: ecfzooarcadia_v01_mysql
    restart: always
    environment:
      MYSQL_ROOT_PASSWORD: G1i9e6t3
      MYSQL_DATABASE: zoo_arcadia
      MYSQL_USER: utilisateur_zoo
      MYSQL_PASSWORD: Z00_Arcadia!2024
    ports:
      - "3308:3308"
Si des modifications sont apportées, relancer Docker :

powershell Commende
Copier
Modifier
docker-compose down
docker-compose up -d

<!----------------------------------------------------------->

🔹 7️⃣ Accéder au site web
📍 A. Ouvrir le site dans le navigateur
Essayer les URLs suivantes :

PHPMyAdmin :

bash Commende
Copier
Modifier
http://localhost:8086/index.php

Le site web :

bash Commende
Copier
Modifier
http://localhost:8085/index.php

📍 B. Se connecter avec les comptes utilisateurs
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

🔹 8️⃣ Résumé des étapes
1️⃣ Cloner le projet depuis GitHub
2️⃣ Vérifier et installer les extensions PHP (PDO, MySQLi)
3️⃣ Configurer l’accès MySQL et créer l’utilisateur utilisateur_zoo
4️⃣ Importer la base de données zoo_arcadia.sql via PHPMyAdmin
5️⃣ Ajuster config.php et docker-compose.yml si nécessaire
6️⃣ Lancer le site avec docker-compose up -d
7️⃣ Accéder à PHPMyAdmin (localhost:8086) et au site (localhost:8085)
8️⃣ Tester la connexion avec les identifiants fournis (A, B)


9️⃣ Annexe
📌 Configuration Docker avec docker-compose.yml
Ce projet utilise Docker pour simplifier l’installation et l’exécution des services nécessaires (Apache, MySQL, PHPMyAdmin). Le fichier docker-compose.yml définit la structure et les relations entre ces services.

🏗️ Explication des Services
Le fichier docker-compose.yml est organisé en trois services principaux :

Web (Apache + PHP)

Contient le serveur Apache et PHP.

Monte le dossier local contenant l’application dans /var/www/html.

Accessible sur le port 8085.

Dépend du service db (MySQL).

DB (MySQL 5.7)

Contient la base de données MySQL avec un utilisateur dédié.

Initialise la base zoo_arcadia.

Accessible sur le port 3308.

PHPMyAdmin

Interface web pour gérer la base de données.

Accessible sur le port 8086.

📝 Fichier docker-compose.yml
yaml
Copier
Modifier
version: '3.8'

services:
  web:
    build: .  
    container_name: ecfzooarcadia_v01_apache
    volumes:
      - "D:/MesProjets/EcfZooArcadia-V.01/app-v1:/var/www/html"
    ports:
      - "8085:80"
    networks:
      - ecf-network
    depends_on:
      - db

  db:
    image: mysql:5.7
    container_name: ecfzooarcadia_v01_mysql
    environment:
      MYSQL_ROOT_PASSWORD: G1i9e6t3
      MYSQL_DATABASE: zoo_arcadia
      MYSQL_USER: utilisateur_zoo
      MYSQL_PASSWORD: Z00_Arcadia!2024
      MYSQL_INITDB_SKIP_TZINFO: "1"
    command: --character-set-server=utf8mb4 --collation-server=utf8mb4_general_ci
    volumes:
      - db_data:/var/lib/mysql
    networks:
      - ecf-network
    ports:
      - "3308:3308"

  phpmyadmin:
    image: phpmyadmin/phpmyadmin
    container_name: ecfzooarcadia_v01_phpmyadmin
    environment:
      PMA_HOST: ecfzooarcadia_v01_mysql
      MYSQL_ROOT_PASSWORD: G1i9e6t3
    ports:
      - "8086:80"
    networks:
      - ecf-network
    depends_on:
      - db

volumes:
  db_data:
  app_data:

networks:
  ecf-network:
🚀 Lancer le Projet avec Docker
Ouvrir un terminal dans le dossier contenant docker-compose.yml

Exécuter la commande suivante pour démarrer les services :

sh
Copier
Modifier
docker-compose up -d
Vérifier que tout fonctionne :

Application → http://localhost:8085

PHPMyAdmin → http://localhost:8086

Base de données → Accessible via localhost:3308
<!------------------------------------------------->

🛠️ Dépannage (FAQ)
Le port est déjà utilisé ?
👉 Modifier les ports dans docker-compose.yml et relancer.

Erreur de connexion à MySQL ?
👉 Vérifier PMA_HOST et essayer de redémarrer Docker.

Modification du code non prise en compte ?
👉 Exécuter docker-compose down && docker-compose up -d --build

Merci d'avoir consulté la documentation du projet **Zoo Arcadia**.














🔹 8️⃣ Résumé des étapes
1️⃣ Cloner le projet depuis GitHub
2️⃣ Vérifier et installer les extensions PHP nécessaires (PDO, MySQLi)
3️⃣ Configurer l’accès MySQL et créer l’utilisateur utilisateur_zoo dans votre base de données
4️⃣ Importer la base de données zoo_arcadia.sql via PHPMyAdmin
5️⃣ Ajuster les fichiers config.php et docker-compose.yml si nécessaire pour la configuration de votre environnement
6️⃣ Lancer le site avec la commande docker-compose up -d
7️⃣ Accéder à PHPMyAdmin via localhost:8086 et au site via localhost:8085
8️⃣ Tester la connexion à la base de données avec les identifiants fournis (A, B)

9️⃣ Finaliser l’intégration : vérifiez que toutes les fonctionnalités du site sont opérationnelles, effectuez des tests de performance et assurez-vous que la base de données est bien connectée.


📌 Contributions
Le projet Zoo-Arcadia est un travail collaboratif. Si vous souhaitez contribuer, veuillez suivre les étapes ci-dessous pour assurer une gestion harmonieuse du projet.

1️⃣ Processus de Contribution
Forker le projet : Créez un fork du dépôt GitHub pour travailler sur une branche dédiée.

Créer une branche : Créez une branche spécifique pour votre fonctionnalité ou correction (ex. feature/ajout-animal ou bugfix/correction-base-donnees).

Modifier le code : Apportez vos modifications sur votre branche.

Testez vos modifications : Assurez-vous que votre contribution fonctionne correctement en local.

Pull Request : Une fois vos modifications terminées, ouvrez une Pull Request (PR) pour revue.

2️⃣ Règles de Contribution
Respect du code existant : Conformez-vous à la structure de code et aux bonnes pratiques déjà en place.

Documenter les modifications : Ajoutez des commentaires pertinents dans le code et mettez à jour la documentation si nécessaire.

Tests unitaires : Si applicable, ajoutez des tests unitaires pour vérifier vos modifications.

3️⃣ Revue de Code
Avant qu’une contribution soit intégrée dans la branche principale (main), elle devra être revue par un autre membre de l’équipe. Cela permet de s’assurer que le code est de qualité et fonctionne correctement.

4️⃣ Communication
Utiliser les issues GitHub : Pour discuter des bugs, des nouvelles fonctionnalités, ou des questions générales, utilisez les "issues" sur GitHub.

Commentaires constructifs : Lors de la revue de code, les commentaires doivent être constructifs et orientés vers l'amélioration.

5️⃣ Attribution des Contributions
Chaque contribution sera attribuée à l’auteur de la PR sur GitHub. Les auteurs de la PR doivent s'assurer de mentionner leur contribution dans le changelog si des changements majeurs sont apportés.

📌 Membre de l'Équipe
Nom	Rôle	Responsabilités
[Nom de l'utilisateur]	Développeur Backend	Gestion de la base de données, création des API
[Nom de l'utilisateur]	Développeur Frontend	Développement des pages, intégration des fonctionnalités UI
[Nom de l'utilisateur]	Responsable Documentation	Mise à jour et gestion de la documentation du projet
Cette section permet à tous les membres de l'équipe de savoir comment participer au projet et de gérer les contributions de manière structurée. Elle est particulièrement importante si le projet implique une équipe et que plusieurs personnes travaillent sur différentes parties du code.






## Contribuer

Si vous souhaitez contribuer à ce projet, voici les étapes à suivre :

1. Forkez ce dépôt.
2. Créez une branche pour votre fonctionnalité (`git checkout -b feature/nom-fonctionnalité`).
3. Commitez vos changements (`git commit -am 'Ajout de nouvelle fonctionnalité'`).
4. Poussez votre branche (`git push origin feature/nom-fonctionnalité`).
5. Soumettez une pull request pour que vos changements soient révisés et intégrés.
7. Tests

Si des tests sont inclus dans le projet, mentionnez comment les exécuter.
Inclure des tests unitaires ou fonctionnels avec des outils comme PHPUnit.
Exemple :

markdown
Copier
Modifier
## Tests

Pour exécuter les tests du projet, vous pouvez utiliser PHPUnit :

```bash
php vendor/bin/phpunit
markdown
Copier
Modifier


