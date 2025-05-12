<?php
$host = 'localhost';
$dbname = 'zoo_arcadia';//votre_base_de_donnees
$username = 'utilisateur_zoo';//votre_utilisateur
$password = 'Z00_Arcadia!2024';//votre_mot_de_passe

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
?>
<!-- // includes/config.php -->

<!--?php
return [
    'db' => [
        'host' => 'localhost',
        'database' => 'zoo_arcadia', //nom de votre base de données
        'username' => 'utilisateur_zoo', //le nom d'utilisateur MySQL
        'password' => 'Z00_Arcadia!2024', //le mot de passe
        'charset' => 'utf8mb4',
    ],
];
?>
