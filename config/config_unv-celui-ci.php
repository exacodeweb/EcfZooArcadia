<?php
// Paramètres de la base de données
define('DB_HOST', 'db'); //localhost
define('DB_NAME', 'zoo_arcadia'); //teaxwxme_zoo_arcadia
define('DB_USER', 'utilisateur_zoo'); //teaxwxme_utilisateur_
define('DB_PASS', 'Z00_Arcadia!2024'); //Z00_Arcadia!2024
define('DB_CHARSET', 'utf8mb4');

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
} catch (PDOException $e) {
  die("Erreur de connexion à la base de données : " . $e->getMessage());
}


// URL de base du site (utile pour les liens dynamiques)
define('BASE_URL', 'http://localhost/teaxwxme_zoo_arcadia/');

// Chemin vers les assets (images, CSS, JS)
define('ASSETS_PATH', BASE_URL . 'assets/');

// Configuration de l'application (ex: mode debug)
define('DEBUG_MODE', true);


// 🔹 Fonction pour afficher les erreurs en mode debug
if (DEBUG_MODE) {
  error_reporting(E_ALL);
  ini_set('display_errors', '1');
} else {
  error_reporting(0);
  ini_set('display_errors', '0');
}
/*?>*/
/*
<!-- require_once __DIR__ . '/../config/config_unv.php'; -->*/

/*
Résumé des différences principales :
  Méthode	Simplicité	Centralisation	Flexibilité	Extensibilité
  1er bloc : define()	Très simple et rapide	Faible (pas de centralisation facile)	Faible (peu flexible)	Faible (pas extensible facilement)
  2e bloc : Fichier avec tableau	Modéré	Bonne (structure centralisée)	Modéré (doit être intégré manuellement dans chaque fichier)	Bonne (facilement extensible)
 celui-ci => 3e bloc : Fichier avec require	Modéré	Très bonne (gère un tableau centralisé)	Très bonne (adaptable aux besoins)	Excellente (facile à gérer plusieurs environnements)
*/
?>
<?php
return [
    'db' => [
        'host' => 'db',  // Ton hôte de base de données : localhost
        'dbname' => 'zoo_arcadia',  // Ton nom de base de données : nom_de_la_base
        'charset' => 'utf8mb4',  // Le jeu de caractères
        'username' => 'utilisateur_zoo',  // Ton utilisateur de base de données : root
        'password' => 'Z00_Arcadia!2024',  // Ton mot de passe ZOO_Arcadia!2024  //Zoo8087arcadia
    ],
];

try {
  $pdo = new PDO(
      "mysql:host={$config['db']['host']};dbname={$config['db']['dbname']};charset={$config['db']['charset']}",
      $config['db']['username'],
      $config['db']['password']
  );
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo "Connexion réussie"; // Pour vérifier si la connexion fonctionne
} catch (PDOException $e) {
  die("Erreur de connexion : " . $e->getMessage());
}




//---------------------------------------------- version modulaire -----------------------------------------------------
//<?php
// Paramètres de la base de données
//define('DB_HOST', 'db');
//define('DB_NAME', 'zoo_arcadia');
//define('DB_USER', 'utilisateur_zoo');
//define('DB_PASS', 'Z00_Arcadia!2024');
//define('DB_CHARSET', 'utf8mb4');

// URL de base du site (utile pour les liens dynamiques)
//define('BASE_URL', 'http://localhost/teaxwxme_zoo_arcadia/');

// Chemin vers les assets (images, CSS, JS)
//define('ASSETS_PATH', BASE_URL . 'assets/');

// Configuration de l'application
//define('DEBUG_MODE', true);

// Affichage des erreurs si debug activé
//if (DEBUG_MODE) {
   // error_reporting(E_ALL);
    //ini_set('display_errors', '1');
//} else {
    //error_reporting(0);
    //ini_set('display_errors', '0');
//}

// Connexion à la base de données avec PDO
//try {
    //$pdo = new PDO(
        //"mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET,
        //DB_USER,
        //DB_PASS,
        //[
            //PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            //PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            //PDO::ATTR_EMULATE_PREPARES => false
        //]
    //);
    // echo "Connexion réussie"; // Tu peux décommenter pour tester
//} catch (PDOException $e) {
    //die("Erreur de connexion à la base de données : " . $e->getMessage());
//}
/*?>*/

