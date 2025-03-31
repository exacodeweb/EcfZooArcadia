<?php
$host = 'localhost';
$dbname = 'zoo_arcadia';
$username = 'utilisateur_zoo';//root
$password = 'Z00_Arcadia!2024';//

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
?>
