<?php
$dsn = "mysql:host=db;dbname=zoo_arcadia;charset=utf8mb4";
$username = "utilisateur_zoo";
$password = "Z00_Arcadia!2024";

try {
    $pdo = new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
    echo "✅ Connexion réussie à la base de données !";
} catch (PDOException $e) {
    echo "❌ Erreur de connexion : " . $e->getMessage();
}
?>
