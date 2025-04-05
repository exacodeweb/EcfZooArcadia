<?php 
$host = "db";
$dbname = "zoo_arcadia";
$username = "utilisateur_zoo";
$password = "Z00_Arcadia!2024";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>


<!--?php
require_once __DIR__ . '/../vendor/autoload.php'; // Chargement des dépendances

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

// Connexion PDO à la base de données
try {
    $pdo = new PDO(
        "mysql:host=" . $_ENV['DB_HOST'] . ";dbname=" . $_ENV['DB_NAME'] . ";charset=utf8mb4",
        $_ENV['DB_USER'],
        $_ENV['DB_PASS'],
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>

-->
<!--
📂 1. Organisation des fichiers
Les développeurs professionnels utilisent une structure de projet bien définie.

📌 Exemple d’organisation pour un site web :

bash
Copier
Modifier
/mon_projet/
│── /public/           # Contient les fichiers accessibles par les visiteurs (index.php, styles.css)
│── /config/           # Contient les fichiers de configuration (connexion BDD, variables globales)
│── /includes/         # Contient des fichiers réutilisables (header.php, footer.php, navbar.php)
│── /models/           # Contient les fichiers liés à la base de données (User.php, Vehicule.php)
│── /controllers/      # Contient la logique (gestion des formulaires, sessions, sécurité)
│── /views/            # Contient les pages HTML/PHP (galerie, détails véhicule)
│── /vendor/           # Contient les dépendances si tu utilises Composer
│── .env               # Contient les variables d’environnement (NON ACCESSIBLE aux visiteurs)
│── .gitignore         # Empêche l’envoi de certains fichiers sur GitHub
│── index.php          # Fichier principal qui charge l’application
│── composer.json      # Gestionnaire de dépendances PHP
🔄 2. Centralisation de la connexion à la base de données
Les pros utilisent un seul fichier de connexion à la base de données qui sera inclus partout.

📌 Fichier /config/database.php

php
Copier
Modifier
<!?php
require_once __DIR__ . '/../vendor/autoload.php'; // Chargement des dépendances

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

// Connexion PDO à la base de données
try {
    $pdo = new PDO(
        "mysql:host=" . $_ENV['DB_HOST'] . ";dbname=" . $_ENV['DB_NAME'] . ";charset=utf8mb4",
        $_ENV['DB_USER'],
        $_ENV['DB_PASS'],
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>
✅ Avantage :

Une seule connexion pour tout le projet

Facile à modifier si les identifiants changent

Sécurisé avec .env (voir plus bas)

🔐 3. Stockage sécurisé des variables sensibles avec .env
Les pros ne mettent pas les identifiants en dur dans le code.
Ils les stockent dans un fichier .env.

📌 Fichier .env (placé à la racine du projet)

ini
Copier
Modifier
DB_HOST=localhost
DB_NAME=garage_vincent_parrot
DB_USER=root
DB_PASS=G1i9e6t3
✅ Pourquoi faire ça ?

Permet de changer les valeurs facilement

Ne doit pas être partagé sur GitHub (.gitignore l’exclut)

⚙️ 4. Utilisation des "includes" pour éviter la duplication
Les professionnels ne réécrivent pas le même code dans chaque fichier.
Ils utilisent include ou require pour charger les fichiers importants.

📌 Exemple : Inclusion du fichier de connexion
Dans chaque fichier qui a besoin de la base de données, on ajoute :

php
Copier
Modifier
require_once __DIR__ . '/../config/database.php';
🔥 Avantage :

Une seule connexion PDO, facile à gérer

Pas de duplication de code

🎭 5. Séparer le code en Modèle / Vue / Contrôleur (MVC)
Dans les gros projets, on sépare le code en trois parties :

📌 Modèle (models/) : Gère la base de données (CRUD)

📌 Vue (views/) : Affiche les pages HTML/PHP

📌 Contrôleur (controllers/) : Gère la logique

📌 Exemple : Gestion des utilisateurs avec un modèle (models/User.php)
php
Copier
Modifier
<!?php
require_once __DIR__ . '/../config/database.php';

class User {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getUserByEmail($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM utilisateurs WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch();
    }
}
?>
🔥 Avantage :

Le fichier User.php gère tous les accès à la table utilisateurs.

Réutilisable dans plusieurs pages sans dupliquer le code.

📤 6. Gestion des formulaires et récupération des données
Les formulaires doivent être envoyés à un contrôleur qui les traite.

📌 Exemple : Formulaire de connexion (views/login.php)
html
Copier
Modifier
<form action="/controllers/login.php" method="POST">
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Mot de passe" required>
    <button type="submit">Connexion</button>
</form>
📌 Exemple : Contrôleur de connexion (controllers/login.php)
php
Copier
Modifier
<!?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/User.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $userModel = new User($pdo);
    $user = $userModel->getUserByEmail($email);

    if ($user && password_verify($password, $user["motDePasse"])) {
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["role"] = $user["role"];
        header("Location: /views/dashboard.php");
        exit;
    } else {
        echo "Identifiants incorrects.";
    }
}
?>
🔥 Avantage :

Séparation claire entre la vue (formulaire) et le traitement (contrôleur).

Réutilisable : on peut appeler User.php ailleurs sans le dupliquer.

✅ Conclusion : Comment centraliser et structurer un projet comme un pro ?
1️⃣ Créer un dossier /config/ pour stocker la configuration (database.php, .env).
2️⃣ Créer un dossier /models/ pour gérer les accès aux données (ex: User.php).
3️⃣ Créer un dossier /controllers/ pour traiter les formulaires et gérer la logique.
4️⃣ Créer un dossier /views/ pour afficher les pages HTML/PHP.
5️⃣ Inclure les fichiers nécessaires (require_once) pour éviter la duplication.
6️⃣ Utiliser un fichier .env pour stocker les identifiants de la base de données.
7️⃣ Séparer le code en Modèle / Vue / Contrôleur (MVC) pour un projet propre et maintenable.

💡 Si tu appliques ces principes, ton projet sera organisé et facile à maintenir ! 🚀
-->
