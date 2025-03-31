<?php
return [
    'db' => [
        'host' => 'db',//localhost
        'dbname' => 'zoo_arcadia',//database //nom de votre base de données (!database mieux vaut dbname)
        'username' => 'utilisateur_zoo', //le nom d'utilisateur MySQL
        'password' => 'Z00_Arcadia!2024', //le mot de passe
        'charset' => 'utf8mb4',
    ],
];
?>


  <!-- mysql -u utilisateur_zoo -pZ00_Arcadia!2024 zoo_arcadia -->
<!--?php
$host = "localhost";
$dbname = "zoo_arcadia";
$user = "root";
$password = "G1i9e6t3"; // Mettez le mot de passe si nécessaire

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

?>-->

<!-- connexion services -->
<?php
$config = [
    'db' => [
        'host' => 'db',//localhost
        'database' => 'zoo_arcadia',
        'username' => 'utilisateur_zoo',//utilisateur_zoo //root
        'password' => 'Z00_Arcadia!2024',//Z00_Arcadia!2024 //G1i9e6t3
        'charset' => 'utf8mb4',
    ],
];

try {
    $pdo = new PDO(
        "mysql:host={$config['db']['host']};dbname={$config['db']['database']};charset={$config['db']['charset']}",
        $config['db']['username'],
        $config['db']['password']
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

// Renvoyer la variable $pdo pour pouvoir l'utiliser dans d'autres fichiers.
return $pdo;
?>
