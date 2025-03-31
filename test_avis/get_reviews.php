<?php
header('Content-Type: application/json');
require './config1.php'; // Pour la connexion à la base de données

try {
    // Connexion à la base de données
    $db = new PDO('mysql:host=localhost;dbname=zoo_arcadia;charset=utf8mb4', 'root', 'G1i9e6t3');

    // Requête SQL pour récupérer les avis approuvés, triés par date décroissante
    $query = $db->prepare("SELECT message, auteur, statut, date_creation 
                           FROM avis 
                           WHERE statut = 'approuve' 
                           ORDER BY date_creation DESC");
    $query->execute();
    $avis = $query->fetchAll(PDO::FETCH_ASSOC);

    // Retourne les avis en format JSON
    echo json_encode($avis);
} catch (Exception $e) {
    // Gestion des erreurs
    echo json_encode(['error' => 'Erreur lors de la récupération des avis : ' . $e->getMessage()]);
}