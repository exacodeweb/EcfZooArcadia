<?php
$dsn = 'mysql:host=db;dbname=zoo_arcadia;charset=utf8mb4'; //nom de votre base de données //localhost
$username = 'utilisateur_zoo';//le nom d'utilisateur MySQL
$password = 'Z00_Arcadia!2024'; //le mot de passe
$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

try {
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>