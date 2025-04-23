<?php
require 'db_config.php';

try {
    $stmt = $pdo->prepare("SELECT message, auteur FROM avis WHERE statut = 'valide' ORDER BY date_creation DESC");
    $stmt->execute();
    $avis = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Envoyer les avis au format JSON
    header('Content-Type: application/json');
    echo json_encode($avis);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["error" => "Erreur lors de la récupération des avis."]);
}
?>


<?php
require 'db_config.php';

try {
    // Préparez et exécutez la requête
    $stmt = $pdo->prepare("SELECT message, auteur FROM avis WHERE statut = 'valide' ORDER BY date_creation DESC");
    $stmt->execute();
    $avis = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Envoyez les avis en format JSON
    header('Content-Type: application/json');
    echo json_encode($avis);
} catch (PDOException $e) {
    // Gestion des erreurs
    http_response_code(500);
    echo json_encode(["error" => "Erreur lors de la récupération des avis."]);
}
?> 

<!-- 
API de type GET qui :

Se connecte à une base de données (db_config.php),

Récupère des avis approuvés (statut = 'valide'),

Retourne ces avis au format JSON,

Et peut être utilisé par un client frontend (comme un script JS) via fetch() ou autre.
-->