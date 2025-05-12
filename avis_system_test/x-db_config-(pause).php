<?php
$host = "db";//localhost
$dbname = "zoo_arcadia";//
$user = "utilisateur_zoo";//root
$password = "Z00_Arcadia!2024";//G1i9e6t3 // Mettez le mot de passe si nécessaire

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
?>
