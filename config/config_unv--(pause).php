<?php
// Paramètres de la base de données
define('DB_HOST', 'db');
define('DB_NAME', 'zoo_arcadia');
define('DB_USER', 'utilisateur_zoo');
define('DB_PASS', 'Z00_Arcadia!2024');
define('DB_CHARSET', 'utf8mb4');

// URL de base du site (utile pour les liens dynamiques)
define('BASE_URL', 'http://localhost/teaxwxme_zoo_arcadia/');

// Chemin vers les assets (images, CSS, JS)
define('ASSETS_PATH', BASE_URL . 'assets/');

// Configuration de l'application
define('DEBUG_MODE', true);

// Affichage des erreurs si debug activé
if (DEBUG_MODE) {
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
} else {
    error_reporting(0);
    ini_set('display_errors', '0');
}

// Connexion à la base de données avec PDO
try {
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET,
        DB_USER,
        DB_PASS,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        ]
    );
     //echo "Connexion réussie"; // Tu peux décommenter pour tester
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
?>

