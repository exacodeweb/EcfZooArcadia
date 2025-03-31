<?php
$host = 'db';//localhost
$dbname = 'zoo_arcadia';
$username = 'utilisateur_zoo';
$password = 'Z00_Arcadia!2024';
$charset = 'utf8mb4';

// Configuration des options PDO
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    // Remplacez $conn par $pdo
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=$charset", $username, $password, $options);
} catch (PDOException $e) {
    die('Erreur de connexion à la base de données : ' . $e->getMessage());
}
