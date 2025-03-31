<?php
die('Fichier chargé avec succès');
// Vérification et inclusion du fichier de configuration
if (!file_exists('../config/config.php')) {//../config/config.php
    http_response_code(500);
    echo json_encode(["error" => "Erreur : Fichier de configuration introuvable !"]);
    exit;
}
require_once '../config/config.php';//../config/config.php

// Vérification des variables de connexion
if (!isset($host, $dbname, $user, $password)) {
    http_response_code(500);
    echo json_encode(["error" => "Erreur : Informations de connexion non définies."]);
    exit;
}

try {
    // Connexion à la base de données
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Requête pour récupérer les avis
    $stmt = $pdo->prepare("SELECT message, auteur FROM avis WHERE statut = 'approuve' ORDER BY date_creation DESC LIMIT 20");
    $stmt->execute();
    $avis = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // En-têtes et réponse JSON
    header("Content-Type: application/json");
    header("Access-Control-Allow-Origin: *");
    echo json_encode($avis);
} catch (PDOException $e) {
    // Gestion des erreurs
    http_response_code(500);
    error_log($e->getMessage(), 3, '../logs/db_errors.log'); // Modifier le chemin si nécessaire
    echo json_encode(["error" => "Erreur lors de la récupération des avis."]);
}


// Test
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>













<!--?php
require_once '../config/config.php'; // Inclure les informations de configuration

try {
    // Connexion à la base de données
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Limiter le nombre d'avis retournés à 20  -->  <!-- avis_2--> <!--
    $stmt = $pdo->prepare("SELECT message, auteur FROM avis WHERE statut = 'approuve' ORDER BY date_creation DESC LIMIT 20");
    $stmt->execute();

    // Récupérer les données
    $avis = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Définir les en-têtes
    header("Content-Type: application/json");
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET");

    // Retourner les données en JSON
    echo json_encode($avis);
} catch (PDOException $e) {
    // En cas d'erreur, renvoyer un code d'erreur HTTP et un message JSON
    http_response_code(500);
    error_log($e->getMessage(), 3, '../logs/db_errors.log'); // Consigner l'erreur dans un fichier de log
    echo json_encode(["error" => "Erreur lors de la récupération des avis."]);
}
?> -->















<!--?php
require_once '../config/config.php'; // Assurez-vous que ce fichier contient les informations de connexion à la BDD

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Requête pour récupérer les avis approuvés --> <!-- avis_2--> <!--
    $stmt = $pdo->prepare("SELECT message, auteur FROM avis WHERE statut = 'approuve' ORDER BY date_creation DESC");

    $stmt->execute();

    // Récupérer les données sous forme de tableau
    $avis = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Renvoyer les données en JSON
    header('Content-Type: application/json');
    echo json_encode($avis);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["error" => "Erreur de connexion à la base de données : " . $e->getMessage()]);
}
?> -->















<!--?php
require 'db_config.php';

try {                                               // avis_2 //
    $stmt = $pdo->prepare("SELECT message, auteur FROM avis WHERE statut = 'valide' ORDER BY date_creation DESC");
    $stmt->execute();
    $avis = $stmt->fetchAll(PDO::FETCH_ASSOC);

    header('Content-Type: application/json');
    echo json_encode($avis);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["error" => "Erreur lors de la récupération des avis."]);
}
?> -->